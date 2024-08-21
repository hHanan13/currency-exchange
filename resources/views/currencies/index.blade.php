@extends('layouts.app')

@section('content')
    <h1>Currencies</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="{{ route('currencies.create') }}">Add New Currency</a>

    <form action="{{ route('currencies.update') }}" method="POST">
        @csrf
        <table>
            <tr>
                <th>Currency</th>
                <th>Exchange Rate</th>
                <th>Actions</th>
            </tr>
            @foreach($exchangeRates as $currency => $rate)
                <tr>
                    <td>{{ $currency }}</td>
                    <td><input type="text" name="rates[{{ $currency }}]" value="{{ $rate }}"></td>
                    <td>
                        <button type="submit">Update</button>
                        <form action="{{ route('currencies.destroy') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="currency" value="{{ $currency }}">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </form>
@endsection
