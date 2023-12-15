<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [];

    public function scopeSearch($query, $search_query)
    {
        $query->where('title','like',"%" . $search_query . "%")
            ->orWhere('slug', 'like', "%" . $search_query . "%" );
    }

}
