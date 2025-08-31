<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CurrencyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if currency is already set in session
        if (Session::has('currency_code')) {
            // Verify that the currency in session actually exists in the database
            $currency_code = Session::get('currency_code');
            $currency = \App\Models\Currency::where('code', $currency_code)->first();

            if (!$currency) {
                // Currency in session doesn't exist in database, reset to default
                $this->setDefaultCurrency($request);
            }
        }
        // Use environment default if available
        elseif (env('DEFAULT_CURRENCY') != null) {
            // Verify that the default currency actually exists in the database
            $currency = \App\Models\Currency::where('code', env('DEFAULT_CURRENCY'))->first();

            if ($currency) {
                $request->session()->put('currency_code', $currency->code);
                $request->session()->put('local_currency_rate', $currency->rate);
                $request->session()->put('currency_symbol', $currency->symbol);
                $request->session()->put('currency_symbol_alignment', $currency->alignment);
            } else {
                // Default currency doesn't exist in database, use USD
                $this->setDefaultCurrency($request);
            }
        }
        // Fallback to USD
        else {
            $this->setDefaultCurrency($request);
        }

        return $next($request);
    }

    /**
     * Set default USD currency if no valid currency is found
     */
    private function setDefaultCurrency($request)
    {
        // Try to get USD from database
        $currency = \App\Models\Currency::where('code', 'usd')->first();

        // If USD exists in database, use it
        if ($currency) {
            $request->session()->put('currency_code', $currency->code);
            $request->session()->put('local_currency_rate', $currency->rate);
            $request->session()->put('currency_symbol', $currency->symbol);
            $request->session()->put('currency_symbol_alignment', $currency->alignment);
        }
        // Otherwise use hardcoded USD values
        else {
            $request->session()->put('currency_code', 'usd');
            $request->session()->put('local_currency_rate', 1);
            $request->session()->put('currency_symbol', '$');
            $request->session()->put('currency_symbol_alignment', 0);
        }
    }
}
