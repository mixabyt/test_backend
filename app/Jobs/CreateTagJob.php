<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CreateTagJob implements ShouldQueue
{
    use Queueable;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 5*60;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string  $tagName,
        private Article  $article,
    )
    { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tag = $this->article->tags()->create([
            'name' => $this->tagName,
        ]);
        Article::query()
            ->where('id', '!=', $this->article->id)
            ->whereRaw('content REGEXP ?', ['\b' . $tag->name . '\b'])
//            ->where(function ($query) use ($tag) {
//                $query->where('content', 'like',  $this->tagName . ' %')
//                    ->orWhere('content', 'like', '% ' . $this->tagName . ' %')
//                    ->orWhere('content', 'like', '% ' . $this->tagName)
//                    ->orWhere('content', 'like',  $this->tagName);
//            })
            ->chunk(100, function ($articles) use ($tag) {
                foreach ($articles as $article) {
                    $article->containedTags()->attach($tag);
                }
            });

    }
}
