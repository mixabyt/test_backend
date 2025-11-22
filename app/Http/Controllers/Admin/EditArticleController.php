<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class EditArticleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $article = Article::with('tags')->findOrFail($id);
        $this->authorize('update', $article);
        return view('admin.article.edit', compact('article'));
    }
}
