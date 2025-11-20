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
        $articleData = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['tags'] = $data['tags'] ?? [];

        $user = auth()->user();
        $user->articles()->create($articleData);

        return redirect()->route('dashboard');
    }
}
