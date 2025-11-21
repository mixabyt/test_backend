<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
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
}
