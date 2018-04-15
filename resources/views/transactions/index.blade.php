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
                            <th>Description</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
                                <td><a href="{{ url('/transactions/' . $transaction->id) }}">{{ $transaction->description }}</a></td>
                                <td>{{ $transaction->category->name }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>
                                    <a href="{{ url('/transactions/' . $transaction->id) }}" class="btn btn-info">EDIT</a>
                                    <form action="/transactions/{{ $transaction->id }}" method="POST" style="display: inline;">
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
                </div>
            </div>
        </div>
    </div>
@endsection