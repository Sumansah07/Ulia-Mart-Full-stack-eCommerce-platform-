<?php

// Start the Laravel application
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Update the USD currency to use $ symbol
DB::table('currencies')->where('code', 'usd')->update(['symbol' => '$']);

// Check if NPR currency already exists
$nprCurrency = DB::table('currencies')->where('code', 'npr')->first();

if (!$nprCurrency) {
    // Add NPR currency
    DB::table('currencies')->insert([
        'name' => 'Nepali Rupee',
        'symbol' => 'Rs',
        'code' => 'npr',
        'rate' => 1,
        'alignment' => 0,
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    echo "NPR currency added\n";
} else {
    echo "NPR currency already exists\n";
}

// Clear the cache
Artisan::call('cache:clear');
Artisan::call('view:clear');
Artisan::call('config:clear');

echo "Currency symbols updated\n";
