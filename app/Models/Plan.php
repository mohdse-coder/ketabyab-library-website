<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name','max_libraries','max_books','price','is_default'
    ];

    public function subscriptions()
    {
        return $this->hasMany(\App\Models\Subscription::class);
    }
}
