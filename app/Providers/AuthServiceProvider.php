<?php

namespace App\Providers;

use App\Policies\ArticlePolicy;
use App\Models\Article;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{


    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
