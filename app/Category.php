<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'user_id'];

    public static function boot()
    {
        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });

        static::saving(function ($category) {
            $category->user_id = $category->user_id ?: auth()->id();
            $category->slug = $category->slug ?: str_slug($category->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
