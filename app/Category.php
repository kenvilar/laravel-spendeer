<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function boot()
    {
        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });

        static::saving(function ($category) {
            $category->user_id = $category->user_id ?: auth()->id();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
