@extends('layouts.app')

@section('content')
    <h1>Amounts</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="{{ route('amounts.create') }}">Add New Amount</a>

    <table>
        <tr>
            <th>Amount</th>
            <th>Currency</th>
            <th>Exchange Value</th>
            <th>Actions</th>
        </tr>
        @foreach($amounts as $amount)
            <tr>
                <td>{{ $amount->amount }}</td>
                <td>{{ $amount->currency }}</td>
                <td>{{ $amount->amount * config('exchange_rates')[$amount->currency] }}</td>
                <td>
                    <a href="{{ route('amounts.edit', $amount->id) }}">Edit</a>
                    <form action="{{ route('amounts.destroy', $amount->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
