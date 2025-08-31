@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Tax Calculation Test') }}
@endsection

@section('contents')
<div class="container my-5">
    <h2>Tax Calculation Test - Mixed Cart Scenario</h2>

    @php
        // Simulate a mixed cart scenario with DIFFERENT TAX RATES
        $testCarts = collect([
            (object)[
                'id' => 1,
                'qty' => 2,
                'product_variation' => (object)[
                    'product' => (object)[
                        'id' => 1,
                        'name' => 'Electronics (13% VAT)',
                        'min_price' => 100,
                        'taxes' => collect([
                            (object)['tax_type' => 'percent', 'tax_value' => 13]
                        ])
                    ]
                ]
            ],
            (object)[
                'id' => 2,
                'qty' => 1,
                'product_variation' => (object)[
                    'product' => (object)[
                        'id' => 2,
                        'name' => 'Luxury Item (25% Luxury Tax)',
                        'min_price' => 50,
                        'taxes' => collect([
                            (object)['tax_type' => 'percent', 'tax_value' => 25]
                        ])
                    ]
                ]
            ],
            (object)[
                'id' => 3,
                'qty' => 1,
                'product_variation' => (object)[
                    'product' => (object)[
                        'id' => 3,
                        'name' => 'Essential Food (5% GST)',
                        'min_price' => 40,
                        'taxes' => collect([
                            (object)['tax_type' => 'percent', 'tax_value' => 5]
                        ])
                    ]
                ]
            ],
            (object)[
                'id' => 4,
                'qty' => 3,
                'product_variation' => (object)[
                    'product' => (object)[
                        'id' => 4,
                        'name' => 'Medicine (0% tax)',
                        'min_price' => 30,
                        'taxes' => collect([])
                    ]
                ]
            ]
        ]);

        // Test with 10% coupon discount
        $testCouponCode = 'TEST10';

        // Calculate subtotals
        $totalSubtotal = 0;
        $taxableSubtotal = 0;
        $nonTaxableSubtotal = 0;
        $itemBreakdown = [];

        foreach ($testCarts as $cart) {
            $itemTotal = $cart->product_variation->product->min_price * $cart->qty;
            $totalSubtotal += $itemTotal;

            $hasTax = $cart->product_variation->product->taxes->count() > 0;
            if ($hasTax) {
                $taxableSubtotal += $itemTotal;
            } else {
                $nonTaxableSubtotal += $itemTotal;
            }

            $itemBreakdown[] = [
                'name' => $cart->product_variation->product->name,
                'price' => $cart->product_variation->product->min_price,
                'qty' => $cart->qty,
                'total' => $itemTotal,
                'tax_rate' => $cart->product_variation->product->taxes->first()->tax_value ?? 0,
                'has_tax' => $hasTax
            ];
        }

        $testCouponDiscount = $totalSubtotal * 0.10; // 10% of total

        // OLD (WRONG) Calculation - assumes all products have same tax rate
        $oldTaxCalculation = ($totalSubtotal - $testCouponDiscount) * 0.13; // Wrong: applies 13% to everything
        $oldTotal = $totalSubtotal - $testCouponDiscount + $oldTaxCalculation;

        // NEW (CORRECT) Calculation - handles different tax rates per product
        $newTaxCalculation = 0;
        $taxBreakdown = [];

        foreach ($testCarts as $cart) {
            $product = $cart->product_variation->product;
            if ($product->taxes->count() > 0) {
                $itemSubtotal = $product->min_price * $cart->qty;
                $itemDiscountRatio = $totalSubtotal > 0 ? ($itemSubtotal / $totalSubtotal) : 0;
                $itemCouponDiscount = $testCouponDiscount * $itemDiscountRatio;
                $itemDiscountedPrice = $itemSubtotal - $itemCouponDiscount;

                foreach ($product->taxes as $tax) {
                    if ($tax->tax_type == 'percent') {
                        $itemTax = ($itemDiscountedPrice * $tax->tax_value) / 100;
                        $newTaxCalculation += $itemTax;

                        $taxBreakdown[] = [
                            'product' => $product->name,
                            'discounted_amount' => $itemDiscountedPrice,
                            'tax_rate' => $tax->tax_value,
                            'tax_amount' => $itemTax
                        ];
                    }
                }
            }
        }
        $newTotal = $totalSubtotal - $testCouponDiscount + $newTaxCalculation;
    @endphp

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5>❌ OLD (WRONG) Calculation</h5>
                </div>
                <div class="card-body">
                    <h6>Cart Items:</h6>
                    <ul>
                        @foreach($itemBreakdown as $item)
                            <li>{{ $item['name'] }}: Rs.{{ $item['price'] }} × {{ $item['qty'] }} = Rs.{{ $item['total'] }}</li>
                        @endforeach
                    </ul>

                    <hr>
                    <p><strong>Subtotal:</strong> Rs.{{ number_format($totalSubtotal, 2) }}</p>
                    <p><strong>Coupon Discount (10%):</strong> -Rs.{{ number_format($testCouponDiscount, 2) }}</p>
                    <p><strong>Discounted Subtotal:</strong> Rs.{{ number_format($totalSubtotal - $testCouponDiscount, 2) }}</p>
                    <p class="text-danger"><strong>Tax (13% on ENTIRE discounted amount):</strong> Rs.{{ number_format($oldTaxCalculation, 2) }}</p>
                    <hr>
                    <p><strong>Total:</strong> Rs.{{ number_format($oldTotal, 2) }}</p>

                    <div class="alert alert-danger">
                        <strong>Problem:</strong> Applies same tax rate to all products, including non-taxable ones!
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>✅ NEW (CORRECT) Calculation</h5>
                </div>
                <div class="card-body">
                    <h6>Cart Items:</h6>
                    <ul>
                        @foreach($itemBreakdown as $item)
                            <li>{{ $item['name'] }}: Rs.{{ $item['price'] }} × {{ $item['qty'] }} = Rs.{{ $item['total'] }}
                                @if($item['has_tax'])
                                    <span class="badge bg-info">({{ $item['tax_rate'] }}% tax)</span>
                                @else
                                    <span class="badge bg-secondary">(0% tax)</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <hr>
                    <p><strong>Total Subtotal:</strong> Rs.{{ number_format($totalSubtotal, 2) }}</p>
                    <p><strong>Taxable Subtotal:</strong> Rs.{{ number_format($taxableSubtotal, 2) }}</p>
                    <p><strong>Non-Taxable Subtotal:</strong> Rs.{{ number_format($nonTaxableSubtotal, 2) }}</p>
                    <p><strong>Coupon Discount (10%):</strong> -Rs.{{ number_format($testCouponDiscount, 2) }}</p>

                    <h6 class="text-success">Tax Breakdown (Per Product):</h6>
                    <ul class="text-success">
                        @foreach($taxBreakdown as $tax)
                            <li>{{ $tax['product'] }}: {{ $tax['tax_rate'] }}% × Rs.{{ number_format($tax['discounted_amount'], 2) }} = Rs.{{ number_format($tax['tax_amount'], 2) }}</li>
                        @endforeach
                    </ul>
                    <p class="text-success"><strong>Total Tax:</strong> Rs.{{ number_format($newTaxCalculation, 2) }}</p>
                    <hr>
                    <p><strong>Total:</strong> Rs.{{ number_format($newTotal, 2) }}</p>

                    <div class="alert alert-success">
                        <strong>Correct:</strong> Each product taxed at its own rate, only after proportional discount!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-info">
                <h5>Difference:</h5>
                <p>Old calculation would overcharge by: <strong>Rs.{{ number_format($oldTaxCalculation - $newTaxCalculation, 2) }}</strong></p>
                <p>This happens because the old method applies tax to non-taxable products in the discounted amount.</p>
            </div>
        </div>
    </div>
</div>
@endsection
