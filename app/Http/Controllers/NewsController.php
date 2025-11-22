<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index() {
        $articles = Article::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('news', compact('articles'));
    }

    public function indexpage($id) {
        $article = Article::findOrFail($id);
        return view('newpage', compact('article'));
    }

}
