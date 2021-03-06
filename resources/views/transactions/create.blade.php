@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Create Transaction</div>
                    <div class="card-body">
                        <form class="needs-validation" action="/transactions" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">Description</label>
                                <input type="text" id="description" class="form-control" name="description"
                                       value="{{ old('description') }}">
                            </div>
                            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                                <label for="amount">Amount</label>
                                <input type="number" min="1" id="amount" class="form-control" name="amount"
                                       value="{{ old('amount') }}">
                            </div>
                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ $category->id == old('$category_id') ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
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
