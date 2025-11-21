<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index() {
        $articles = Article::where('is_active', true)->get();
        return view('news', compact('articles'));
    }

}
