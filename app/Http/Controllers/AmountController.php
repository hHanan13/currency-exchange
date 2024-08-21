<?php

namespace App\Http\Controllers;
use App\Models\Amount;
use App\Models\Currency;

use Illuminate\Http\Request;

class AmountController extends Controller
{
    public function index()
    {
        // Retrieve all amounts from the database
        $amounts = Amount::all();
        return view('amounts.index', compact('amounts'));
    }

    public function create()
    {
        $currencies = Currency::all();
        // Show the form to create a new amount
        return view('amounts.create', compact('currencies'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string|max:3',
        ]);

        // Store the new amount in the database
        Amount::create($request->all());

        return redirect()->route('amounts.index')->with('success', 'Amount added successfully!');
    }

    public function edit($id)
    {
        // Find the amount by ID
        $amount = Amount::findOrFail($id);
        $currentCurrency = $amount->currency; 
        return view('amounts.edit', compact('amount', 'currentCurrency'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string|max:3',
        ]);

        // Update the amount in the database
        $amount = Amount::findOrFail($id);
        $amount->currency = $request->currency;
        $amount->amount = $request->amount;
        $amount->save();

        return redirect()->route('amounts.index')->with('success', 'Amount updated successfully!');
    }

    public function destroy($id)
    {
        // Delete the amount from the database
        $amount = Amount::findOrFail($id);
        $amount->delete();

        return redirect()->route('amounts.index')->with('success', 'Amount deleted successfully!');
    }
}
