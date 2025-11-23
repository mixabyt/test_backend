<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use phpDocumentor\Reflection\PseudoTypes\IntegerRange;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $fillable = [
        'title',
        'image',
        'content',
        'is_active',
    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags() : HasMany {
        return $this->hasMany(Tag::class);
    }

    public function containedTags() : BelongsToMany {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }

    public function getContentWithLinks() : string {
        $content = $this->content;
        foreach ($this->containedTags as $tag) {
            $content = preg_replace(
                '/\b('.$tag->name.')\b/ui',
                '<a href="' . route("new.page", $tag->article_id) . '">$1</a>',
                $content);
        }
        return $content;
    }
}
