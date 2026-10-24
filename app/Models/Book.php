<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'description', 'cover', 'quantity', 'library_id'
    ];

    // هر کتاب متعلق به یک کتابخانه است
    public function library() {
        return $this->belongsTo(Library::class);
    }

    public function borrowings()
{
    return $this->hasMany(Borrowing::class);
}

}
