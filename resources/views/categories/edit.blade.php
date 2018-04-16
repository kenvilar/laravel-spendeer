@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Update Category
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" action="/categories/{{ $category->slug }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" name="name"
                                       value="{{ old('name') ?: $category->name }}">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-info" value="UPDATE">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
