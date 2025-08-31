<?php

namespace App\Http\Middleware;

use App\Models\Currency;
use Closure;
use Illuminate\Http\Request;

class ApiCurrencyMiddleWare
{
    private  static $currentCurrency = null;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('Currency-Code')) {
            $currency_code = $request->header('Currency-Code');
        } else {
            $currency_code = env('DEFAULT_CURRENCY');
        }

        // Try to get the requested currency
        $currency = Currency::where('code', $currency_code)->first();

        // If currency not found, try to use default USD
        if (!$currency) {
            $currency = Currency::where('code', 'usd')->first();

            // If USD not found, create a default currency
            if (!$currency) {
                $currency = new Currency;
                $currency->name = 'US Dollar';
                $currency->code = 'usd';
                $currency->symbol = '$';
                $currency->rate = 1;
                $currency->alignment = 0;
                $currency->save();
            }
        }

        ApiCurrencyMiddleWare::$currentCurrency = $currency;
        return $next($request);
    }

    public static function currencyData()
    {
        // Ensure we always return a valid currency object
        if (!ApiCurrencyMiddleWare::$currentCurrency) {
            ApiCurrencyMiddleWare::$currentCurrency = Currency::where('code', 'usd')->first();

            // If USD not found, create a default currency
            if (!ApiCurrencyMiddleWare::$currentCurrency) {
                $currency = new Currency;
                $currency->name = 'US Dollar';
                $currency->code = 'usd';
                $currency->symbol = '$';
                $currency->rate = 1;
                $currency->alignment = 0;
                $currency->save();

                ApiCurrencyMiddleWare::$currentCurrency = $currency;
            }
        }

        return ApiCurrencyMiddleWare::$currentCurrency;
    }
}
