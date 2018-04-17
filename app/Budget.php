<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
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
