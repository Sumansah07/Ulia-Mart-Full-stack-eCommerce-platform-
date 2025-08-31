@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Coupon Product Filtering Demo') }}
@endsection

@section('contents')
<div class="container my-5">
    <h2>🎯 Coupon Product/Category Filtering Logic</h2>
    
    @php
        // Example cart
        $cartItems = [
            ['name' => 'Electronics (13% VAT)', 'price' => 100, 'qty' => 2, 'total' => 200, 'tax_rate' => 13, 'category' => 'Electronics'],
            ['name' => 'Luxury Item (25% Luxury Tax)', 'price' => 50, 'qty' => 1, 'total' => 50, 'tax_rate' => 25, 'category' => 'Luxury'],
            ['name' => 'Essential Food (5% GST)', 'price' => 40, 'qty' => 1, 'total' => 40, 'tax_rate' => 5, 'category' => 'Food'],
            ['name' => 'Medicine (0% tax)', 'price' => 30, 'qty' => 3, 'total' => 90, 'tax_rate' => 0, 'category' => 'Medicine']
        ];
        
        $totalSubtotal = 380;
        
        // Scenario 1: Unrestricted Coupon (10% off everything)
        $scenario1 = [
            'name' => 'SAVE10 - 10% off everything',
            'discount_percent' => 10,
            'restrictions' => 'None',
            'eligible_products' => 'All products',
            'eligible_subtotal' => $totalSubtotal,
            'coupon_discount' => $totalSubtotal * 0.10,
            'items' => []
        ];
        
        foreach ($cartItems as $item) {
            $itemDiscount = ($item['total'] / $totalSubtotal) * $scenario1['coupon_discount'];
            $discountedPrice = $item['total'] - $itemDiscount;
            $tax = $item['tax_rate'] > 0 ? ($discountedPrice * $item['tax_rate']) / 100 : 0;
            
            $scenario1['items'][] = [
                'name' => $item['name'],
                'original' => $item['total'],
                'eligible' => true,
                'discount' => $itemDiscount,
                'after_discount' => $discountedPrice,
                'tax' => $tax
            ];
        }
        
        // Scenario 2: Electronics Only Coupon (15% off Electronics category)
        $electronicsSubtotal = 200; // Only Electronics product
        $scenario2 = [
            'name' => 'TECH15 - 15% off Electronics only',
            'discount_percent' => 15,
            'restrictions' => 'Electronics category only',
            'eligible_products' => 'Electronics',
            'eligible_subtotal' => $electronicsSubtotal,
            'coupon_discount' => $electronicsSubtotal * 0.15,
            'items' => []
        ];
        
        foreach ($cartItems as $item) {
            $isEligible = $item['category'] === 'Electronics';
            $itemDiscount = 0;
            $discountedPrice = $item['total'];
            
            if ($isEligible) {
                $itemDiscount = ($item['total'] / $electronicsSubtotal) * $scenario2['coupon_discount'];
                $discountedPrice = $item['total'] - $itemDiscount;
            }
            
            $tax = $item['tax_rate'] > 0 ? ($discountedPrice * $item['tax_rate']) / 100 : 0;
            
            $scenario2['items'][] = [
                'name' => $item['name'],
                'original' => $item['total'],
                'eligible' => $isEligible,
                'discount' => $itemDiscount,
                'after_discount' => $discountedPrice,
                'tax' => $tax
            ];
        }
        
        // Scenario 3: Luxury + Food Coupon (20% off Luxury and Food categories)
        $luxuryFoodSubtotal = 50 + 40; // Luxury + Food
        $scenario3 = [
            'name' => 'PREMIUM20 - 20% off Luxury & Food',
            'discount_percent' => 20,
            'restrictions' => 'Luxury & Food categories only',
            'eligible_products' => 'Luxury Item, Essential Food',
            'eligible_subtotal' => $luxuryFoodSubtotal,
            'coupon_discount' => $luxuryFoodSubtotal * 0.20,
            'items' => []
        ];
        
        foreach ($cartItems as $item) {
            $isEligible = in_array($item['category'], ['Luxury', 'Food']);
            $itemDiscount = 0;
            $discountedPrice = $item['total'];
            
            if ($isEligible) {
                $itemDiscount = ($item['total'] / $luxuryFoodSubtotal) * $scenario3['coupon_discount'];
                $discountedPrice = $item['total'] - $itemDiscount;
            }
            
            $tax = $item['tax_rate'] > 0 ? ($discountedPrice * $item['tax_rate']) / 100 : 0;
            
            $scenario3['items'][] = [
                'name' => $item['name'],
                'original' => $item['total'],
                'eligible' => $isEligible,
                'discount' => $itemDiscount,
                'after_discount' => $discountedPrice,
                'tax' => $tax
            ];
        }
        
        $scenarios = [$scenario1, $scenario2, $scenario3];
    @endphp
    
    <div class="alert alert-info">
        <h5>🎯 Key Point: Coupon Filtering</h5>
        <p>The system now correctly identifies which products are eligible for each coupon and applies discounts only to those products. Tax is then calculated on the correct discounted amounts.</p>
    </div>
    
    @foreach($scenarios as $index => $scenario)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>📋 Scenario {{ $index + 1 }}: {{ $scenario['name'] }}</h5>
                    <small>{{ $scenario['restrictions'] }}</small>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Eligible Products:</strong> {{ $scenario['eligible_products'] }}</p>
                            <p><strong>Eligible Subtotal:</strong> Rs.{{ number_format($scenario['eligible_subtotal'], 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Discount Rate:</strong> {{ $scenario['discount_percent'] }}%</p>
                            <p><strong>Total Discount:</strong> Rs.{{ number_format($scenario['coupon_discount'], 2) }}</p>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Original Price</th>
                                    <th>Eligible?</th>
                                    <th>Discount Applied</th>
                                    <th>After Discount</th>
                                    <th>Tax Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalTax = 0; @endphp
                                @foreach($scenario['items'] as $item)
                                @php $totalTax += $item['tax']; @endphp
                                <tr>
                                    <td><strong>{{ $item['name'] }}</strong></td>
                                    <td>Rs.{{ number_format($item['original'], 2) }}</td>
                                    <td>
                                        @if($item['eligible'])
                                            <span class="badge bg-success">✅ Yes</span>
                                        @else
                                            <span class="badge bg-secondary">❌ No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item['discount'] > 0)
                                            <span class="text-danger">-Rs.{{ number_format($item['discount'], 2) }}</span>
                                        @else
                                            <span class="text-muted">Rs.0.00</span>
                                        @endif
                                    </td>
                                    <td class="text-success">Rs.{{ number_format($item['after_discount'], 2) }}</td>
                                    <td>
                                        @if($item['tax'] > 0)
                                            Rs.{{ number_format($item['tax'], 2) }}
                                        @else
                                            <span class="text-muted">Rs.0.00</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-secondary">
                                <tr>
                                    <th>TOTALS</th>
                                    <th>Rs.{{ number_format($totalSubtotal, 2) }}</th>
                                    <th>-</th>
                                    <th class="text-danger">-Rs.{{ number_format($scenario['coupon_discount'], 2) }}</th>
                                    <th class="text-success">Rs.{{ number_format($totalSubtotal - $scenario['coupon_discount'], 2) }}</th>
                                    <th class="text-primary">Rs.{{ number_format($totalTax, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="alert alert-light">
                        <strong>Final Total:</strong> Rs.{{ number_format($totalSubtotal - $scenario['coupon_discount'] + $totalTax, 2) }}
                        (Subtotal - Discount + Tax)
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-success">
                <h5>✅ How the New System Works:</h5>
                <ol>
                    <li><strong>Coupon Validation:</strong> System checks if coupon has product/category restrictions</li>
                    <li><strong>Eligibility Check:</strong> Each cart item is checked against coupon criteria</li>
                    <li><strong>Selective Discount:</strong> Discount applied only to eligible products</li>
                    <li><strong>Proportional Distribution:</strong> If multiple eligible products, discount distributed proportionally</li>
                    <li><strong>Accurate Tax:</strong> Tax calculated on correct discounted amounts per product</li>
                </ol>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-warning">
                <h5>🔧 Backend Coupon Configuration:</h5>
                <p>In the admin panel, when creating coupons, you can:</p>
                <ul>
                    <li><strong>Leave restrictions empty:</strong> Coupon applies to all products</li>
                    <li><strong>Select specific products:</strong> Coupon applies only to those products</li>
                    <li><strong>Select specific categories:</strong> Coupon applies only to products in those categories</li>
                    <li><strong>Combine both:</strong> Coupon applies to selected products AND categories</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
