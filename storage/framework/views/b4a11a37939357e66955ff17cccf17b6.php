<?php if(getSetting('google_login') == '1' || getSetting('facebook_login') == '1'): ?>
    <?php if(getSetting('google_login') == '1'): ?>
        <div class="col-sm-6">
            <a href="<?php echo e(route('social.login', ['provider' => 'google'])); ?>"
                class="btn btn-outline google-btn w-100 text-center d-block"><img
                    src="<?php echo e(staticAsset('frontend/default/assets/img/brands/google.png')); ?>" alt="google"
                    class="me-2"><?php echo e(localize('Google')); ?></a>
        </div>
    <?php endif; ?>

    <?php if(getSetting('facebook_login') == '1'): ?>
        <div class="col-sm-6">
            <a href="<?php echo e(route('social.login', ['provider' => 'facebook'])); ?>"
                class="btn btn-outline google-btn w-100 text-center d-block"><img
                    src="<?php echo e(staticAsset('frontend/default/assets/img/brands/facebook.png')); ?>" alt="facebook"
                    class="me-2"><?php echo e(localize('Facebook')); ?></a>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/inc/social.blade.php ENDPATH**/ ?>