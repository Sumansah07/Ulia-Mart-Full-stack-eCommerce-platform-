<?php

// Start the Laravel application
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

echo "Starting currency rate fix script...\n";

// Check for currencies with null rates
$nullRateCurrencies = Currency::whereNull('rate')->get();
if ($nullRateCurrencies->count() > 0) {
    echo "Found " . $nullRateCurrencies->count() . " currencies with null rates.\n";
    
    foreach ($nullRateCurrencies as $currency) {
        echo "Fixing currency: " . $currency->code . "\n";
        $currency->rate = 1.0; // Set a default rate
        $currency->save();
    }
    
    echo "Fixed all currencies with null rates.\n";
} else {
    echo "No currencies with null rates found.\n";
}

// Check for currencies with zero rates
$zeroRateCurrencies = Currency::where('rate', 0)->get();
if ($zeroRateCurrencies->count() > 0) {
    echo "Found " . $zeroRateCurrencies->count() . " currencies with zero rates.\n";
    
    foreach ($zeroRateCurrencies as $currency) {
        echo "Fixing currency: " . $currency->code . "\n";
        $currency->rate = 1.0; // Set a default rate
        $currency->save();
    }
    
    echo "Fixed all currencies with zero rates.\n";
} else {
    echo "No currencies with zero rates found.\n";
}

// Ensure default currency exists
$defaultCurrencyCode = env('DEFAULT_CURRENCY', 'usd');
$defaultCurrency = Currency::where('code', $defaultCurrencyCode)->first();

if (!$defaultCurrency) {
    echo "Default currency (" . $defaultCurrencyCode . ") not found. Creating it...\n";
    
    $defaultCurrency = new Currency;
    $defaultCurrency->name = 'US Dollar';
    $defaultCurrency->code = 'usd';
    $defaultCurrency->symbol = '$';
    $defaultCurrency->rate = 1.0;
    $defaultCurrency->alignment = 0;
    $defaultCurrency->is_active = 1;
    $defaultCurrency->save();
    
    echo "Created default USD currency.\n";
    
    // Update environment variables
    Artisan::call('env:set', ['key' => 'DEFAULT_CURRENCY', 'value' => 'usd']);
    Artisan::call('env:set', ['key' => 'DEFAULT_CURRENCY_RATE', 'value' => '1']);
    Artisan::call('env:set', ['key' => 'DEFAULT_CURRENCY_SYMBOL', 'value' => '$']);
    Artisan::call('env:set', ['key' => 'DEFAULT_CURRENCY_SYMBOL_ALIGNMENT', 'value' => '0']);
}

// Clear cache
echo "Clearing cache...\n";
Artisan::call('cache:clear');
Artisan::call('config:clear');
Artisan::call('view:clear');

echo "Currency rate fix completed successfully!\n";
