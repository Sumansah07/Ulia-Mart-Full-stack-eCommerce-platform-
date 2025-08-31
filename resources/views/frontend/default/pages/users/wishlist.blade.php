@extends('frontend.default.layouts.master')

@section('breadcrumb')
    <div class="category-header-bar py-3 mb-4" style="background-color: #f0f0f0;">
        <div class="container">
            <div class="row g-0 align-items-center">
                <div class="col-12">
                    <h2 class="fs-4 fw-bold mb-0 text-uppercase">{{ localize('My Wishlist') }}</h2>
                </div>
                <div class="col-12 mt-1">
                    <div class="d-flex align-items-center flex-wrap">
                        <nav aria-label="breadcrumb" class="me-auto">
                            <ol class="breadcrumb mb-0 d-flex">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ localize('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ localize('My Wishlist') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contents')

    <!--wishlist section start-->
    <section class="wishlist-section pt-4 pb-5">
        <div class="container">
            <div class="rounded-2 overflow-hidden">
                <table class="wishlist-table w-100 bg-white">
                    <thead>
                        <th>{{ localize('Image') }}</th>
                        <th>{{ localize('Product Name') }}</th>
                        <th>{{ localize('U. Price') }}</th>
                        <th>{{ localize('Action') }}</th>
                    </thead>
                    <tbody class="text-center">
                        <!--wishlist listing-->
                        @forelse ($wishlist as $item)
                            <tr>
                                <td class="h-100px">
                                    <img src="{{ uploadedAsset($item->product->thumbnail_image) }}"
                                        alt="{{ $item->product->collectLocalization('name') }}" class="img-fluid"
                                        width="100">
                                </td>
                                <td class="product-title">
                                    <h6 class="mb-0">{{ $item->product->collectLocalization('name') }}
                                    </h6>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold me-2 d-lg-none">{{ localize('Unit Price') }}:</span>
                                    <span class="text-dark fw-bold">
                                        @include('frontend.default.pages.partials.products.pricing-with-tax', [
                                            'product' => $item->product,
                                            'br' => true,
                                        ])
                                    </span>
                                </td>

                                <td>
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-sm ms-5 rounded-1"
                                        onclick="showProductDetailsModal({{ $item->product->id }})">{{ localize('Add to Cart') }}</a>
                                    <a href="{{ route('customers.wishlist.delete', $item->id) }}" class="close-btn ms-3"><i
                                            class="fas fa-close"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4">{{ localize('No data found') }}</td>
                            </tr>
                        @endforelse
                        <!--wishlist listing-->
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--wishlist section end-->
@endsection
