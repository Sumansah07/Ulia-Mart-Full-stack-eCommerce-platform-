<?php

namespace App\Http\Middleware;

use App\Models\Location;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Session;

class StockLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Route::has('home')) {
            if (Session::has('stock_location_id')) {
                // do nothing
            } else {
                try {
                    $location = Location::where('is_default', 1)->first();
                    if ($location) {
                        $request->session()->put('stock_location_id', $location->id);
                    } else {
                        // Create a default location if none exists
                        $defaultLocation = new Location();
                        $defaultLocation->name = 'Default Location';
                        $defaultLocation->is_default = 1;
                        $defaultLocation->is_published = 1;
                        $defaultLocation->save();

                        $request->session()->put('stock_location_id', $defaultLocation->id);
                    }
                } catch (\Exception $e) {
                    // Fallback to ID 1 if there's any error
                    $request->session()->put('stock_location_id', 1);
                }
            }
        } else {
            $request->session()->put('stock_location_id',  1);
        }
        return $next($request);
    }
}
