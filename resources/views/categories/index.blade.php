@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->created_at->format('m/d/Y') }}</td>
                                <td>
                                    <a href="{{ url('/categories/' . $category->slug) }}">{{ $category->name }}</a>
                                </td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <a href="{{ url('/categories/' . $category->slug) }}" class="btn btn-info">EDIT</a>
                                    <form action="/categories/{{ $category->slug }}" method="POST"
                                          style="display: inline;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <label for="delete"></label>
                                        <input type="submit" id="delete" value="DELETE" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>{{ $categories->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
