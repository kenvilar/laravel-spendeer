@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Create Budget
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" action="/budgets" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ $category->id == (old('category_id') ?: $budget->category_id) ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                                <label for="amount">Amount</label>
                                <input type="number" min="1" id="amount" class="form-control" name="amount"
                                       value="{{ old('amount') }}">
                            </div>
                            <div class="form-group {{ $errors->has('budget_date') ? 'has-error' : '' }}">
                                <label for="budget_date">Budget Date</label>
                                <select class="form-control" name="budget_date" id="budget_date">
                                    <option value=""></option>
                                    @foreach($months as $month)
                                        <option value="{{ $month }}"
                                                {{ $month == $budget->getMonth() ? 'selected' : '' }}>
                                            {{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-info" value="SUBMIT">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
