<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BudgetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentMonth = request('month') ?: Carbon::now()->format('M');

        if (request()->has('month')) {
            $budgets = Budget::byMonth(request('month'))->get();
        } else {
            $budgets = Budget::byMonth('this month')->get();
        }

        return view('budgets.index')->with(['budgets' => $budgets, 'currentMonth' => $currentMonth]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $budget = new Budget();

        $categories = Category::all();

        return view('budgets.create')->with([
            'categories' => $categories,
            'months' => $months,
            'budget' => $budget
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'category_id' => 'required',
            'budget_date' => 'required'
        ]);

        Budget::create(request()->all());

        return redirect('/budgets');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $categories = Category::all();

        return view('budgets.edit')->with([
            'budget' => $budget,
            'categories' => $categories,
            'months' => $months
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $categories = Category::all();

        return view('budgets.edit')->with([
            'budget' => $budget,
            'categories' => $categories,
            'months' => $months
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        $this->validate($request, [
            'amount' => 'required',
            'category_id' => 'required',
            'budget_date' => 'required'
        ]);

        $budget->update(request()->all());

        return redirect('/budgets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect('/budgets');
    }
}
