<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'book_id', 'borrowed_at', 'returned_at', 'status'
    ];

    // ارتباط با کتاب
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    // ارتباط با کاربر
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
