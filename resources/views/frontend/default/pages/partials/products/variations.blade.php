@if (count(generateVariationOptions($product->variation_combinations)) > 0)
    @foreach (generateVariationOptions($product->variation_combinations) as $variation)
        <input type="hidden" name="variation_id[]" value="{{ $variation['id'] }}" class="variation-for-cart">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        @if ($variation['id'] == 2)
            <!-- Swatches Color -->
            <div class="product-item swatches-image w-100 mb-4 swatch-0 option1" data-option-index="0">
                <label class="label d-flex align-items-center">{{ $variation['name'] }}:<span class="slVariant ms-1 fw-bold variation-name-{{ $variation['id'] }}"></span></label>
                <ul class="variants-clr swatches d-flex-center pt-1 clearfix">
                    @foreach ($variation['values'] as $key => $value)
                        <li class="swatch x-large {{ $key == 0 ? 'active' : '' }}">
                            <input type="radio" name="variation_value_for_variation_{{ $variation['id'] }}"
                                value="{{ $value['id'] }}" id="val-{{ $value['id'] }}" {{ $key == 0 ? 'checked' : '' }}
                                data-name="{{ $value['name'] }}" class="variation-value">
                            <label for="val-{{ $value['id'] }}">
                                <span style="background-color:{{ $value['code'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $value['name'] }}"></span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- End Swatches Color -->
        @else
            <!-- Swatches Size/Other -->
            <div class="product-item swatches-size w-100 mb-4 swatch-1 option2" data-option-index="1">
                <label class="label d-flex align-items-center">{{ $variation['name'] }}:<span class="slVariant ms-1 fw-bold variation-name-{{ $variation['id'] }}"></span>
                    @if($variation['name'] == 'Size')
                        <a href="#size-chart" class="text-link sizelink text-muted size-chart-link ms-2">{{ localize('Size Guide') }}</a>
                    @endif
                </label>
                <ul class="variants-size size-swatches d-flex-center pt-1 clearfix">
                    @foreach ($variation['values'] as $key => $value)
                        <li class="swatch x-large {{ $key == 0 ? 'active' : '' }}">
                            <input type="radio" name="variation_value_for_variation_{{ $variation['id'] }}"
                                value="{{ $value['id'] }}" id="val-{{ $value['id'] }}" {{ $key == 0 ? 'checked' : '' }}
                                data-name="{{ $value['name'] }}" class="variation-value">
                            <label for="val-{{ $value['id'] }}">
                                <span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $value['name'] }}">{{ $value['name'] }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- End Swatches Size/Other -->
        @endif
    @endforeach
@endif

<script>
    // Initialize variation names
    document.addEventListener('DOMContentLoaded', function() {
        const variationInputs = document.querySelectorAll('.variation-value:checked');
        variationInputs.forEach(function(input) {
            const variationId = input.name.replace('variation_value_for_variation_', '');
            const variationName = input.getAttribute('data-name');
            const nameElement = document.querySelector('.variation-name-' + variationId);
            if (nameElement) {
                nameElement.textContent = variationName;
            }
        });

        // Add event listeners to update variation names when changed
        document.querySelectorAll('.variation-value').forEach(function(input) {
            input.addEventListener('change', function() {
                const variationId = this.name.replace('variation_value_for_variation_', '');
                const variationName = this.getAttribute('data-name');
                const nameElement = document.querySelector('.variation-name-' + variationId);
                if (nameElement) {
                    nameElement.textContent = variationName;
                }

                // Update active class for styling
                const parentList = this.closest('ul');
                if (parentList) {
                    parentList.querySelectorAll('li').forEach(function(li) {
                        li.classList.remove('active');
                    });
                    this.closest('li').classList.add('active');
                }
            });
        });
    });
</script>
