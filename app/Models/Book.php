<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Publisher;
use App\Models\Author;

class Book extends Model

{
    protected $fillable = [
        'author_id',
        'category_id',
        'publisher_id',
        'title',
        // 'author_name',
        'price',
        'published_year',
        'stock',
        'cover',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
