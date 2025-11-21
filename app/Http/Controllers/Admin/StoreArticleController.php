<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\article\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class StoreArticleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreArticleRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $tagsInput = $request->input('tags', []);



        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article = $request->user()->articles()->create($data);
        foreach ($tagsInput as $tagName) {
            $article->tags()->create([
                'name' => $tagName
            ]);
        }


        return redirect()->route('dashboard');
    }
}
