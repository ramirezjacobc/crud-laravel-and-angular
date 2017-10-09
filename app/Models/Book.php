<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'author', 'published_date', 'user', 'category_id', 'available,'
    ];

    public function category() {
     return $this->hasOne('\App\Models\Category', 'id', 'category_id');
   }
}
