<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['amount', 'budget_date', 'category_id', 'user_id'];

    public static function boot()
    {
        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });

        static::saving(function ($budget) {
            $budget->user_id = $budget->user_id ?: auth()->user()->id;
        });

        /*static::updating(function ($category) {
            $category->slug = str_slug($category->name);
        });*/
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function balance()
    {
        return (int)($this->amount - $this->category->transactions->sum('amount'));
    }

    public function scopeByMonth($query, $month = 'this month')
    {
        $query->where('budget_date', '>=', Carbon::parse('first day of ' . $month))
            ->where('budget_date', '<=', Carbon::parse('last day of ' . $month));
    }
}
