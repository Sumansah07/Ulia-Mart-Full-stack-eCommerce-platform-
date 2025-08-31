<div class="offcanvas_menu position-fixed">
    <div class="tt-short-info d-none d-md-none d-lg-none d-xl-block">
        <button class="offcanvas-close"><i class="fa-solid fa-xmark"></i></button>
        <a href="<?php echo e(route('home')); ?>" class="logo-wrapper d-inline-block mb-5"><img
                src="<?php echo e(uploadedAsset(getSetting('navbar_logo'))); ?>" alt="logo"></a>
        <div class="offcanvas-content">
            <h4 class="mb-4"><?php echo e('About Us'); ?></h4>
            <p><?php echo e(getSetting('about_us')); ?></p>
            <a href="<?php echo e(route('home.pages.aboutUs')); ?>" class="btn btn-primary mt-4"><?php echo e('About Us'); ?></a>
        </div>
    </div>

    <div class="mobile-menu d-md-block d-lg-block d-xl-none mb-4">
        <button class="offcanvas-close"><i class="fa-solid fa-xmark"></i></button>

        <nav class="mobile-menu-wrapperoffcanvas-contact">
            <ul>
                <?php if(getSetting('show_theme_changes') != 0 || getSetting('show_theme_changes') == null): ?>
                    <?php if(\App\Models\Theme::where('is_active', 1)->count() > 1): ?>
                        <?php
                            $theme = \App\Models\Theme::where('code', getTheme())->first();
                            $activeThemes = [];
                            if (getSetting('active_themes') != null) {
                                $activeThemes = \App\Models\Theme::whereIn('id', json_decode(getSetting('active_themes')))->get();
                            }
                        ?>
                        <li class="has-submenu mt-5">
                            <a href="javascript:void(0);"><?php echo e(localize('Home')); ?><span class="ms-1 fs-xs float-end"><i
                                        class="fa-solid fa-angle-right"></i></span></a>
                            <ul>
                                <?php $__currentLoopData = $activeThemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('theme.change', $theme->code)); ?>"
                                            class="d-flex align-items-center">
                                            <span><?php echo e(localize($theme->name)); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(!is_null(getSetting('header_menu_labels'))): ?>
                    <?php
                        $labels = json_decode(getSetting('header_menu_labels')) ?? [];
                        $menus = json_decode(getSetting('header_menu_links')) ?? [];
                    ?>

                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuKey => $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e($menuItem); ?>"><?php echo e(localize($labels[$menuKey])); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e(route('home')); ?>"><?php echo e(localize('Home')); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('products.index')); ?>"><?php echo e(localize('Products')); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('home.campaigns')); ?>"><?php echo e(localize('Campaigns')); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('home.coupons')); ?>"><?php echo e(localize('Coupons')); ?></a>
                    </li>
                <?php endif; ?>





                <?php if(getSetting('show_navbar_pages') != 0 || getSetting('show_navbar_pages') == null): ?>
                    <li class="has-submenu">
                        <a href="javascript:void(0)"><?php echo e(localize('Pages')); ?><span class="ms-1 fs-xs float-end"><i
                                    class="fa-solid fa-angle-right"></i></span></a>
                        <ul>
                            <?php
                                $pages = [];
                                if (getSetting('navbar_pages') != null) {
                                    $pages = \App\Models\Page::whereIn('id', json_decode(getSetting('navbar_pages')))->get();
                                }
                            ?>

                            <li><a href="<?php echo e(route('home.blogs')); ?>"><?php echo e(localize('Blogs')); ?></a></li>
                            <li><a href="<?php echo e(route('home.pages.aboutUs')); ?>"><?php echo e(localize('About Us')); ?></a></li>
                            <li><a href="<?php echo e(route('home.pages.contactUs')); ?>"><?php echo e(localize('Contact Us')); ?></a></li>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navbarPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a
                                        href="<?php echo e(route('home.pages.show', $navbarPage->slug)); ?>"><?php echo e($navbarPage->title); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php
                    if (Session::has('locale')) {
                        $locale = Session::get('locale', Config::get('app.locale'));
                    } else {
                        $locale = env('DEFAULT_LANGUAGE');
                    }
                    $currentLanguage = \App\Models\Language::where('code', $locale)->first();

                    if ($currentLanguage == null) {
                        $currentLanguage = \App\Models\Language::where('code', 'en')->first();
                    }
                ?>

                <li class="has-submenu">
                    <a href="javascript:void(0)"><?php echo e($currentLanguage?->name); ?><span class="ms-1 fs-xs float-end"><i
                                class="fa-solid fa-angle-right"></i></span></a>
                    <ul>
                        <?php $__currentLoopData = \App\Models\Language::where('is_active', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="javascript:void(0);" onclick="changeLocaleLanguage(this)"
                                    data-flag="<?php echo e($language->code); ?>">
                                    <?php echo e($language->name); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </li>



                <?php
                    // Use the helper function to get a valid currency
                    $currentCurrency = getValidCurrency();
                ?>

                <li class="has-submenu">
                    <a href="javascript:void(0)" class="text-uppercase"><?php echo e($currentCurrency?->symbol); ?>

                        <?php echo e($currentCurrency?->code); ?><span class="ms-1 fs-xs float-end"><i
                                class="fa-solid fa-angle-right"></i></span></a>
                    <ul>
                        <?php $__currentLoopData = \App\Models\Currency::where('is_active', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a class="text-uppercase" href="javascript:void(0);"
                                    onclick="changeLocaleCurrency(this)" data-currency="<?php echo e($currency->code); ?>">
                                    <?php echo e($currency->symbol); ?> <?php echo e($currency->code); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </li>

                <?php if(auth()->guard()->check()): ?>
                    <li>
                        <a href="<?php echo e(route('logout')); ?>"><?php echo e(localize('Sign Out')); ?></a>
                    </li>
                <?php endif; ?>
                <?php if(auth()->guard()->guest()): ?>
                    <li>
                        <a href="<?php echo e(route('login')); ?>"><?php echo e(localize('Sign In')); ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>

    <div class="offcanvas-contact mt-4">
        <h5 class="mb-4 mt-5"><?php echo e('Contact Info'); ?></h5>
        <address>
            <?php echo e(getSetting('topbar_location')); ?> <br>
            <a href="tel:<?php echo e(getSetting('navbar_contact_number')); ?>"><?php echo e(getSetting('navbar_contact_number')); ?></a> <br>
            <a href="mailto:<?php echo e(getSetting('topbar_email')); ?>"><?php echo e(getSetting('topbar_email')); ?></a>
        </address>
    </div>
    <div class="offcanvas-contact social-contact mt-4">
        <a href="<?php echo e(getSetting('facebook_link')); ?>" target="_blank" class="social-btn"><i
                class="fab fa-facebook-f"></i></a>
        <a href="<?php echo e(getSetting('twitter_link')); ?>" target="_blank" class="social-btn"><i
                class="fab fa-twitter"></i></a>
        <a href="<?php echo e(getSetting('linkedin_link')); ?>" target="_blank" class="social-btn"><i
                class="fab fa-linkedin"></i></a>
        <a href="<?php echo e(getSetting('youtube_link')); ?>" target="_blank" class="social-btn"><i
                class="fab fa-youtube"></i></a>
    </div>
</div>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/inc/offcanvas.blade.php ENDPATH**/ ?>