<div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="profileEditModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="margin-top: 5rem;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileEditModalLabel">{{ localize('Update Profile') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="profile-form" action="{{ route('customers.updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="info">
                    <div class="file-upload text-center rounded-3 mb-4">
                        <input type="file" name="avatar">
                        <img src="{{ staticAsset('frontend/default/assets/img/icons/image.svg') }}" alt="dp" class="img-fluid">
                        <p class="text-dark fw-bold mb-2 mt-3">{{ localize('Drop your files here or browse') }}</p>
                        <p class="mb-0 file-name"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Your Name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ localize('Your Company Name') }}" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Email Address') }}</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Phone') }}</label>
                        <input type="text" name="phone" class="form-control" placeholder="{{ localize('Your Phone') }}" value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Zip Code') }}</label>
                        <input type="text" name="postal_code" class="form-control" placeholder="{{ localize('Zip Code') }}" value="{{ auth()->user()->postal_code }}">
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">{{ localize('Category') }}</label>
                        <select name="category" class="form-control">
                            <option value="Clothing" selected>{{ localize('Clothing') }}</option>
                            <option value="Electronics">{{ localize('Electronics') }}</option>
                            <option value="Food">{{ localize('Food') }}</option>
                            <option value="Other">{{ localize('Other') }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Year Established') }}</label>
                        <input type="number" name="year_established" class="form-control" placeholder="{{ localize('Year Established') }}" value="{{ date('Y') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Total Employees') }}</label>
                        <select name="total_employees" class="form-control">
                            <option value="1-10">{{ localize('1-10 People') }}</option>
                            <option value="11-50">{{ localize('11-50 People') }}</option>
                            <option value="50-100" selected>{{ localize('50-100 People') }}</option>
                            <option value="100+">{{ localize('100+ People') }}</option>
                        </select>
                    </div> -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">{{ localize('Update Profile') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>