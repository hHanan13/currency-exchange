<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
        public function index()
    {
        $exchangeRates = config('exchange_rates');
        return view('currencies.index', compact('exchangeRates'));
    }

    public function update(Request $request)
    {
        $exchangeRates = $request->input('rates');
        $this->updateConfigFile($exchangeRates);
        return redirect()->route('currencies.index')->with('success', 'Exchange rates updated successfully!');
    }
    public function create()
    {
        return view('currencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|max:3',
            'rate' => 'required|numeric',
        ]);

        // Get the current exchange rates
        $exchangeRates = config('exchange_rates');

        // Add the new currency and rate
        $exchangeRates[$request->currency] = $request->rate;

        // Update the config file
        $this->updateConfigFile($exchangeRates);

        return redirect()->route('currencies.create')->with('success', 'Currency added successfully!');
    }

    private function updateConfigFile(array $exchangeRates)
    {
        $configPath = config_path('exchange_rates.php');
        $content = '<?php return ' . var_export($exchangeRates, true) . ';';
        File::put($configPath, $content);
    }

    public function destroy(Request $request)
    {
        $currency = $request->input('currency');
        $exchangeRates = config('exchange_rates');

        if (isset($exchangeRates[$currency])) {
            unset($exchangeRates[$currency]);
            $this->updateConfigFile($exchangeRates);
            return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully!');
        }

        return redirect()->route('currencies.index')->with('error', 'Currency not found!');
    }
}
