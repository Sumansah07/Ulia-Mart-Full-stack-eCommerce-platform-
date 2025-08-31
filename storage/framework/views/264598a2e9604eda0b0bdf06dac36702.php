<?php $__env->startSection('title'); ?>
    <?php echo e(localize('Login')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('contents'); ?>
<style>
    .form-label {
        color: #198754 !important;
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white p-0">
                        <ul class="nav nav-tabs nav-fill">
                            <li class="nav-item">
                                <a class="nav-link py-3" href="<?php echo e(route('register')); ?>"><?php echo e(localize('Register')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active py-3" href="<?php echo e(route('login')); ?>"><?php echo e(localize('Login')); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo e(route('login')); ?>" method="POST" id="login-form">
                            <?php echo csrf_field(); ?>
                            <?php if(getSetting('enable_recaptcha') == 1): ?>
                                <?php echo RecaptchaV3::field('recaptcha_token'); ?>

                            <?php endif; ?>

                            <h4 class="mb-3"><?php echo e(localize('Login to Your Account')); ?></h4>
                            <p class="text-muted mb-4"><?php echo e(localize('Enter your credentials to access your account')); ?></p>

                            <div class="mb-3">
                                <input type="hidden" name="login_with" class="login_with" value="email">
                                <span class="login-email <?php if(old('login_with') == 'phone'): ?> d-none <?php endif; ?>">
                                    <label class="form-label"><?php echo e(localize('Email')); ?></label>
                                    <input type="email" id="email" name="email"
                                        placeholder="your@email.com" class="form-control"
                                        value="<?php echo e(old('email')); ?>" required>
                                    <small class="mt-1 d-block">
                                        <a href="javascript:void(0);" class="login-with-phone-btn"
                                            onclick="handleLoginWithPhone()">
                                            <?php echo e(localize('Login with phone?')); ?></a>
                                    </small>
                                </span>

                                <span class="login-phone <?php if(old('login_with') == 'email' || old('login_with') == ''): ?> d-none <?php endif; ?>">
                                    <label class="form-label"><?php echo e(localize('Phone')); ?></label>
                                    <input type="text" id="phone" name="phone" placeholder="+xxxxxxxxxx"
                                        class="form-control" value="<?php echo e(old('phone')); ?>">
                                    <small class="mt-1 d-block">
                                        <a href="javascript:void(0);" class="login-with-email-btn"
                                            onclick="handleLoginWithEmail()">
                                            <?php echo e(localize('Login with email?')); ?></a>
                                    </small>
                                </span>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label"><?php echo e(localize('Password')); ?></label>
                                    <a href="<?php echo e(route('password.request')); ?>" class="small"><?php echo e(localize('Forgot password?')); ?></a>
                                </div>
                                <input type="password" name="password" id="password"
                                    placeholder="••••••••" class="form-control" required>
                            </div>

                            <?php if(env('DEMO_MODE') == 'On'): ?>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="fw-bold">Admin Access</label>
                                            <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom pb-2">
                                                <small>admin@themetags.com</small>
                                                <small>123456</small>
                                                <button class="btn btn-sm btn-secondary py-0 px-2" type="button"
                                                    onclick="copyAdmin()">Copy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success w-100 sign-in-btn"
                                    style="background-color: #198754; border-color: #198754;"
                                    onclick="handleSubmit()"><?php echo e(localize('Login')); ?></button>
                            </div>

                            <div class="row g-4">
                                <!--social login-->
                                <?php echo $__env->make('frontend.default.inc.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <!--social login-->
                            </div>

                            <div class="text-center mt-4">
                                <p><?php echo e(localize("Don't have an account?")); ?>

                                    <a href="javascript:void(0);" class="text-success fw-bold" onclick="switchToRegister()">
                                        <?php echo e(localize('Create new account')); ?>

                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        "use strict";

        // Switch to register page
        function switchToRegister() {
            window.location.href = "<?php echo e(route('register')); ?>";
        }

        // copyAdmin
        function copyAdmin() {
            $('#email').val('admin@themetags.com');
            $('#password').val('123456');
        }

        // copyCustomer
        function copyCustomer() {
            $('#email').val('customer@themetags.com');
            $('#password').val('123456');
        }
        // copyCustomer
        function copyDeliveryMan() {
            $('#email').val('delivery-man@themetags.com');
            $('#password').val('123456');
        }

        // change input to phone
        function handleLoginWithPhone() {
            $('.login_with').val('phone');

            $('.login-email').addClass('d-none');
            $('.login-email input').prop('required', false);

            $('.login-phone').removeClass('d-none');
            $('.login-phone input').prop('required', true);
        }

        // change input to email
        function handleLoginWithEmail() {
            $('.login_with').val('email');
            $('.login-email').removeClass('d-none');
            $('.login-email input').prop('required', true);

            $('.login-phone').addClass('d-none');
            $('.login-phone input').prop('required', false);
        }


        // disable login button
        function handleSubmit() {
            $('#login-form').on('submit', function(e) {
                $('.sign-in-btn').prop('disabled', true);
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/auth/login.blade.php ENDPATH**/ ?>