<div class="gshop-sidebar bg-white rounded-2 overflow-hidden">
    <!--Filter by search-->
    <div class="sidebar-widget search-widget bg-white py-5 px-4">
        <div class="widget-title d-flex">
            <h6 class="mb-0 flex-shrink-0">{{ localize('Search Now') }}</h6>
            <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span>
        </div>
        <div class="search-form d-flex align-items-center mt-4">
            <input type="hidden" name="view" value="{{ request()->view }}">
            <input type="text" id="search" name="search"
                @isset($searchKey)
       value="{{ $searchKey }}"
       @endisset
                placeholder="{{ localize('Search') }}">
            <button type="submit" class="submit-icon-btn-secondary"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
    <!--Filter by search-->
    <!--Filter by TYPES-->
  <!-- TYPES Section -->
<!-- TYPES Section -->
<!-- <div class="card mb-3"> -->
<div class="border mb-3">
    <div 
        class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom" 
        data-bs-toggle="collapse" 
        data-bs-target="#collapseTypes" 
        aria-expanded="true" 
        style="cursor: pointer;"
    >
        <strong class="text-uppercase small mb-0">{{ localize('TYPES') }}</strong>
        <i class="bi bi-chevron-down"></i>
    </div>

    <div id="collapseTypes" class="collapse show px-3 py-3" style="background-color: #f8f9fa;">
        <ul class="list-unstyled mb-0">
            @php
                $categories = \App\Models\Category::where(function($query) {
                    $query->whereNull('parent_id')
                          ->orWhere('parent_id', 0)
                          ->orWhere('parent_id', '');
                })
                ->orderBy('sorting_order_level', 'asc')
                ->get();
            @endphp

            @foreach ($categories as $category)
                @php
                    $productsCount = \App\Models\ProductCategory::where('category_id', $category->id)->count();
                @endphp
                <li class="mb-2">
                    <label class="form-check d-flex align-items-center">
                    <input type="checkbox" class="form-check-input me-2" style="border: 1px solid #ccc;" />

                        <span class="form-check-label flex-grow-1">
                            {{ $category->collectLocalization('name') }}
                        </span>
                        <span class="badge bg-light text-dark fw-semibold ms-auto">{{ $productsCount }}</span>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>



<!-- PROPERTIES Section -->
<div class="card mb-3">
  <div 
    class="card-header d-flex justify-content-between align-items-center p-3" 
    data-bs-toggle="collapse" 
    data-bs-target="#collapseProps" 
    aria-expanded="true" 
    style="cursor: pointer;"
  >
    <h6 class="mb-0 text-uppercase fw-semibold">{{ localize('PROPERTIES') }}</h6>
    <i class="bi bi-chevron-down transition" 
       style="transition: transform .2s;" 
       data-bs-toggle-icon 
       data-bs-target="#collapseProps"></i>
  </div>
  <div id="collapseProps" class="collapse show">
    <ul class="list-group list-group-flush p-3">
      @foreach(['Green','Seasonal','Organic'] as $prop)
        <li class="list-group-item border-0 px-0 mb-3">
          <div class="form-check">
            <input 
              class="form-check-input me-2" 
              type="checkbox" 
              id="prop-{{ Str::slug($prop) }}"
            >
            <label class="form-check-label" for="prop-{{ Str::slug($prop) }}">
              {{ $prop }}
            </label>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>

<!-- Optional JavaScript to rotate the chevron -->
<script>
  document.querySelectorAll('[data-bs-toggle-icon]').forEach(el => {
    const target = document.querySelector(el.getAttribute('data-bs-target'));
    target.addEventListener('show.bs.collapse', () => el.style.transform = 'rotate(180deg)');
    target.addEventListener('hide.bs.collapse', () => el.style.transform = '');
  });
</script>



    <!--Filter by Price-->
    <div class="sidebar-widget price-filter-widget bg-white py-5 px-4 border-top">
        <div class="widget-title d-flex">
            <!-- <h6 class="mb-0 flex-shrink-0">{{ localize('Filter by Price') }}</h6> -->
            <!-- <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span> -->
        </div>
        <div class="at-pricing-range mt-4">
            <form class="range-slider-form">
                <!-- <div class="price-filter-range"></div> -->
                <!-- <div class="d-flex align-items-center mt-3">
                    <input type="number" min="0" oninput="validity.valid||(value='0');"
                        class="min_price price-range-field price-input price-input-min" name="min_price"
                        data-value="{{ $min_value }}" data-min-range="0">
                    <span class="d-inline-block ms-2 me-2 fw-bold">-</span>

                    <input type="number" max="{{ $max_range }}"
                        oninput="validity.valid||(value='{{ $max_range }}');"
                        class="max_price price-range-field price-input price-input-max" name="max_price"
                        data-value="{{ $max_value }}" data-max-range="{{ $max_range }}">

                </div> -->
                <!-- <button type="submit" class="btn btn-primary btn-sm mt-3">{{ localize('Filter') }}</button> -->
            </form>
        </div>
    </div>
    <!--Filter by Price-->

    <!--Filter by Tags-->
    <div class="sidebar-widget tags-widget py-5 px-4 bg-white">
        <div class="widget-title d-flex">
            <!-- <h6 class="mb-0">{{ localize('Tags') }}</h6> -->
            <!-- <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span> -->
        </div>
        <div class="mt-4 d-flex gap-2 flex-wrap">
            @foreach ($tags as $tag)
                <!-- <a href="{{ route('products.index') }}?&tag_id={{ $tag->id }}" -->
                    <!-- class="btn btn-outline btn-sm">{{ $tag->name }}</a> -->
            @endforeach
        </div>
    </div>
    <!--Filter by Tags-->
</div>
