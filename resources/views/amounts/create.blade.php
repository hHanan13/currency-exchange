@extends('layouts.app')

@section('content')
    <h1>Add New Amount</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('amounts.store') }}" method="POST">
        @csrf
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount" required>

        <label for="currency">Currency:</label>
        <select name="currency" id="currency" required>
            <option value="" disabled selected>Select a currency</option>
            @foreach (config('exchange_rates') as $currency => $rate)
                <option value="{{ $currency }}">{{ $currency }}</option>
            @endforeach
        </select>

        <button type="submit">Add Amount</button>
    </form>
@endsection
