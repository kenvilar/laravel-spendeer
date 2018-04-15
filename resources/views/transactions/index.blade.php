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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ $transaction->category->name }}</td>
                                <td>{{ $transaction->amount
                             }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection