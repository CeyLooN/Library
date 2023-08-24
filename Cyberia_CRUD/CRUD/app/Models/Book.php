<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\BookEditionEnum;

class Book extends Model {
    use HasFactory;

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'bookcategory');
    }


    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    protected $casts = [
        'edition' => BookEditionEnum::class
    ];
}
