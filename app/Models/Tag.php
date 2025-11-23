<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'name', 'article_id'
    ];

    public function article() {
        return $this->belongsTo(Article::class);
    }

}
