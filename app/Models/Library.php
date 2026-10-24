<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = [
        'name',
        'description',
        'privacy',
        'cover',
        'user_id',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
