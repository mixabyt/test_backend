<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class LinkTagsToArticleJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Article $article
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        $articleWords = explode(' ',$this->article->content);
        $this->article->containedTags()->detach();

        if (
            !preg_match_all('/\b\w+\b/u', $this->article->content, $articleWords)
        ) {
            return;
        }


        $articleWords = array_unique(
            array_map(function ($word) {
                return Str::lower($word);
            }, $articleWords[0])
        );
        Tag::query()
            ->where('article_id', '!=', $this->article->id)
            ->whereIn('name', $articleWords)
            ->chunk(100, function ($tags) use ($articleWords) {
                foreach ($tags as $tag) {
                    $this->article->containedTags()->attach($tag);
                }
            });
    }
}
