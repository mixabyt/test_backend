<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index() {
        $articles = Article::where('is_active', true)->orderBy('created_at', 'desc')->paginate(10);

        if (request()->get('page', 1) > $articles->lastPage() && $articles->lastPage() > 0) {
            return abort(404);
        }
        return view('news', compact('articles'));
    }

    public function indexpage($id) {
        $article = Article::where('is_active', true)->findOrFail($id);
        $prev = Article::where('is_active', '=', true)->where('id', '<', $article->id,)->orderBy('id', 'desc')->first();
        $next = Article::where('is_active', '=', true)->where('id', '>', $article->id,)->orderBy('id', 'asc')->first();

        $article->content = $article->getContentWithLinks();

        return view('newpage', compact('article', 'prev', 'next'));
    }

}
