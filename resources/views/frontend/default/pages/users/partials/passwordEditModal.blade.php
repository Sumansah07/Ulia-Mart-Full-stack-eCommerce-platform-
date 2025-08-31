<div class="modal fade" id="passwordEditModal" tabindex="-1" aria-labelledby="passwordEditModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="margin-top: 5rem;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordEditModalLabel">{{ localize('Change Password') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="password-reset-form" action="{{ route('customers.updateProfile') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="password">
                    <div class="mb-3">
                        <label class="form-label">{{ localize('New Password') }}</label>
                        <input type="password" name="password" class="form-control" placeholder="******" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ localize('Re-type Password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="******" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">{{ localize('Change Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
