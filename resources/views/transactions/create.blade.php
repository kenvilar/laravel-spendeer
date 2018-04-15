@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Create Transaction
                    </div>
                    <div class="card-body">
                        <form action="/transactions" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" id="description" class="form-control" name="description">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" min="1" id="amount" class="form-control" name="amount">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
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
