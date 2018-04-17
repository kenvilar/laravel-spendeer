@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="col-md-3">
                    <form action="" id="month-form" method="GET">
                        <label for="month">
                            <select tabindex="0" role="button" class="form-control" name="month" id="month"
                                    onchange="document.getElementById('month-form').submit()">
                                <option value="">Please select month</option>
                                <option value="Jan" {{ request('month') === 'Jan' ? 'selected' : '' }}>January</option>
                                <option value="Feb" {{ request('month') === 'Feb' ? 'selected' : '' }}>February</option>
                                <option value="Mar" {{ request('month') === 'Mar' ? 'selected' : '' }}>March</option>
                                <option value="Apr" {{ request('month') === 'Apr' ? 'selected' : '' }}>April</option>
                                <option value="May" {{ request('month') === 'May' ? 'selected' : '' }}>May</option>
                                <option value="Jun" {{ request('month') === 'Jun' ? 'selected' : '' }}>June</option>
                                <option value="Jul" {{ request('month') === 'Jul' ? 'selected' : '' }}>July</option>
                                <option value="Aug" {{ request('month') === 'Aug' ? 'selected' : '' }}>August</option>
                                <option value="Sep" {{ request('month') === 'Sep' ? 'selected' : '' }}>September</option>
                                <option value="Oct" {{ request('month') === 'Oct' ? 'selected' : '' }}>October</option>
                                <option value="Nov" {{ request('month') === 'Nov' ? 'selected' : '' }}>November</option>
                                <option value="Dec" {{ request('month') === 'Dec' ? 'selected' : '' }}>December</option>
                            </select>
                        </label>
                    </form>
                </div>
            </div>
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
                                <td>
                                    <a href="{{ url('/transactions/' . $transaction->id) }}">
                                        {{ $transaction->description }}</a>
                                </td>
                                <td>{{ $transaction->category->name }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>
                                    <a href="{{ url('/transactions/' . $transaction->id) }}"
                                       class="btn btn-info">EDIT</a>
                                    <form action="/transactions/{{ $transaction->id }}" method="POST"
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
                    <div>{{ $transactions->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection