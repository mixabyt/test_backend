<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\article\StoreArticleRequest;
use App\Jobs\CreateTagJob;
use App\Jobs\LinkTagsToArticleJob;
use App\Models\Article;
use App\Models\Tag;
use http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    private function isColissionn(array $tags): false|RedirectResponse
    {
        $collisions = Tag::whereIn('name', $tags)->get();
        $collisionsName = $collisions->map(function (Tag $tag) {
            return $tag->name;
        })->toArray();

        if (!empty($collisionsName)) {
            return back()->withErrors(['collisions' => 'Тегі повинні бути унікальні. Тегі які потрібно прибрати: ' . implode(', ', $collisionsName)])
                ->withInput();
        }
        return false;
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $tagsInput = $request->input('tags', []);


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $isCollision = $this->isColissionn($tagsInput);
        if ($isCollision) {
            return $isCollision;
        }



        $article = $request->user()->articles()->create($data);
        foreach ($tagsInput as $tag) {
            CreateTagJob::dispatch($tag, $article);
        }
        LinkTagsToArticleJob::dispatch($article);


        usleep( 200 * 1000 );
        return redirect()->route('article.edit', $article->id);
    }


    public function edit(Request $request, int $id)
    {
        $article = Article::with('tags')->findOrFail($id);
        $this->authorize('update', $article);
        return view('admin.article.edit', compact('article'));
    }


    public function update(StoreArticleRequest $request, int $id) : RedirectResponse
    {

        $data = $request->validated();
        $article = Article::with('tags')->findOrFail($id);
        $this->authorize('update', $article);
        $tagsInput = $request->input('tags', []);
        $existingTagsName = $article->tags->pluck('name')->toArray();

        $differenceTags = array_diff($tagsInput, $existingTagsName);


        if ($response = $this->isColissionn($differenceTags)) {
            return $response;
        }

        $toDelete = array_diff($existingTagsName, $tagsInput);

        if (!empty($toDelete)) {
            Tag::whereIn('name', $toDelete)->delete();
        }

        foreach ($differenceTags as $tag) {
            CreateTagJob::dispatch($tag, $article);
        }
        LinkTagsToArticleJob::dispatch($article);


        $data['is_active'] = $request->boolean('is_active');
        $data['tags'] = $request->input('tags', []);
        if ($request->input('delete_image') == 1) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            $article->image = null;
        }

        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
            $article->image = $data['image'];
        }

        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->is_active = $data['is_active'];


        $article->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete', $article);
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return redirect()->route('dashboard');
    }
}
