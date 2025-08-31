<style>
/* Footer Container Width Indicator - Professional Shadow Method */
.footer-container-indicator {
    position: relative;
    /* Subtle inset shadow to show container boundaries */
    box-shadow:
        inset 3px 0 6px -3px rgba(0, 0, 0, 0.15),
        inset -3px 0 6px -3px rgba(0, 0, 0, 0.15);

    /* Alternative: Outset shadow method (uncomment to try) */
    /*
    box-shadow:
        -2px 0 8px -2px rgba(0, 0, 0, 0.1),
        2px 0 8px -2px rgba(0, 0, 0, 0.1);
    */
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .footer-container-indicator {
        /* Lighter shadow on mobile */
        box-shadow:
            inset 2px 0 4px -2px rgba(0, 0, 0, 0.1),
            inset -2px 0 4px -2px rgba(0, 0, 0, 0.1);
    }
}

@media (max-width: 430px) {
    .mobile-center .social-icons {
        margin-top: 6px !important;
    }
    .follow-text {
        font-size: 0.9rem !important;
        line-height: 1.1 !important;
    }
}
</style>

<footer class="main-footer" style="margin-top: 0; background-color: #2d2d2d !important;">
    <div class="container footer-container-indicator">
        <div class="footer-top">
            <div class="row">
                <div class="col-md-2 mb-4 mb-md-0">
                    <div class="footer-logo">
                        <img src="<?php echo e(staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg')); ?>" alt="Uliaa Mart" class="footer-logo img">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4 col-11 mb-4 mb-md-0">
                            <ul class="footer-links">
                                <li>
                                    <a href="#" class="footer-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </a>
                                    <?php echo e(getSetting('topbar_location')); ?>

                                </li>
                                <li>
                                    <a href="tel:<?php echo e(getSetting('navbar_contact_number')); ?>" class="footer-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </a>
                                    <?php echo e(getSetting('navbar_contact_number')); ?>

                                </li>
                                <li>
                                    <a href="mailto:<?php echo e(getSetting('topbar_email')); ?>" class="footer-icon">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <?php echo e(getSetting('topbar_email')); ?>

                                </li>
                            </ul>
                        </div>

                        <div class="col-md-4 col-11 mb-4 mb-md-0">
                            <ul class="footer-links">
                                <li>
                                    <a href="<?php echo e(route('home.pages.privacyPolicy')); ?>" class="footer-icon">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                    <a href="<?php echo e(route('home.pages.privacyPolicy')); ?>">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('home.pages.shippingDeliveryPolicy')); ?>" class="footer-icon">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                    <a href="<?php echo e(route('home.pages.shippingDeliveryPolicy')); ?>">Shipping & Delivery Policy</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('home.pages.returnRefundPolicy')); ?>" class="footer-icon">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                    <a href="<?php echo e(route('home.pages.returnRefundPolicy')); ?>">Return & Refund Policy</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-4 col-11 mb-4 mb-md-0">
                            <ul class="footer-links">
                                <li>
                                    <a href="<?php echo e(route('home.pages.paymentPolicy')); ?>" class="footer-icon">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                    <a href="<?php echo e(route('home.pages.paymentPolicy')); ?>">Payment Policy</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('home.pages.aboutUs')); ?>" class="footer-icon">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                    <a href="<?php echo e(route('home.pages.aboutUs')); ?>">About Us</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('home.pages.contactUs')); ?>" class="footer-icon">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                    <a href="<?php echo e(route('home.pages.contactUs')); ?>">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
    <div class="row align-items-center">
        <div class="col-md-4 text-start ps-4">
            <span class="copyright mb-0">
                <?php echo getSetting('copyright_text'); ?>

            </span>
        </div>
        <div class="col-md-4 text-center d-flex justify-content-center align-items-center">
            <span class="partner-with-text"><?php echo getSetting('partner_with_text'); ?></span>
        </div>
        <div class="col-md-4 text-end d-flex justify-content-end align-items-center mobile-center pe-4">
            <span class="follow-text me-3" style="font-size: 0.9rem; align-self: center; line-height: 1.8;">Follow us:</span>
            <div class="social-icons">
                <a href="<?php echo e(getSetting('facebook_link')); ?>" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="<?php echo e(getSetting('instagram_link', 'https://www.instagram.com/uliaatradingforus/')); ?>" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo e(getSetting('youtube_link')); ?>" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
                <a href="<?php echo e(getSetting('tiktok_link', 'https://www.tiktok.com/@uliaa.mart?_t=ZS-8yNHKZLM09Z&_r=1')); ?>" target="_blank" class="social-icon"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </div>
</div>

    </div>
</footer>

<!-- Back to Top Button -->
<a href="#" class="back-to-top" aria-label="Back to top">
    <i class="fas fa-chevron-up"></i>
</a>

<style>
@media (max-width: 768px) {
    .mobile-center {
        justify-content: center !important;
        text-align: center !important;
        align-items: center !important;
        flex-direction: row !important;
    }
    .mobile-center .social-icons {
        justify-content: center !important;
        align-items: center !important;
        display: flex !important;
    }
    .follow-text {
        align-self: center !important;
        margin-bottom: 0 !important;
    }
}
</style>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/inc/footer.blade.php ENDPATH**/ ?>