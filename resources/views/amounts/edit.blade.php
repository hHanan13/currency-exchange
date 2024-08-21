@extends('layouts.app')

@section('content')
    <h1>Edit Amount</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('amounts.update', $amount->id) }}" method="POST">
        @csrf
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount" value="{{ $amount->amount }}" required>

        <label for="currency">Currency:</label>
        <select name="currency" id="currency" required>
            <option value="" disabled>Select a currency</option>
            @foreach (config('exchange_rates') as $currency => $rate)
                    <option value="{{ $currency }}" {{ $currency == $currentCurrency ? 'selected' : '' }}>
                        {{ $currency }}
                    </option>
                @endforeach
        </select>

        <button type="submit">Update Amount</button>
    </form>
@endsection
