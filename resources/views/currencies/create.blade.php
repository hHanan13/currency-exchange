@extends('layouts.app')

@section('content')
    <h1>Add New Currency</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('currencies.store') }}" method="POST">
        @csrf
        <label for="currency">Currency Code:</label>
        <input type="text" name="currency" id="currency" required>

        <label for="rate">Exchange Rate:</label>
        <input type="text" name="rate" id="rate" required>

        <button type="submit">Add Currency</button>
    </form>
@endsection
