<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'quantity',
        'shelf',
        'description',
        'cover',
    ];

    public function getStockAttribute()
    {
        return $this->attributes['quantity'] - $this->attributes['loaned'];
    }
}
