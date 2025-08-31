<!--footer section start-->
<style>
/* Admin Footer Styles - Matching Frontend */

/* Make body and html full height */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

/* Make main wrapper flex container */
.tt-main-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    position: relative;
}

/* Make content area grow to fill available space */
.tt-main-wrapper > section,
.tt-main-wrapper > .container,
.tt-main-wrapper > .container-fluid {
    flex: 1;
}

/* Sidebar height adjustment for footer visibility */
.tt-sidebar {
    transition: height 0.3s ease !important;
}

/* When footer is visible, reduce sidebar height */
.footer-visible .tt-sidebar {
    height: calc(100vh - 200px) !important; /* Reduce height to make room for footer */
    overflow: hidden !important;
}

.admin-main-footer {
    background-color: #2d2d2d !important;
    color: white;
    padding: 15px 0 0px 0;
    margin-top: auto;
    width: 100vw !important; /* Full viewport width */
    margin-left: -280px !important; /* Negative margin to extend under sidebar */
    position: relative !important;
    z-index: 1001 !important;
    flex-shrink: 0;
}

.admin-main-footer .container-fluid {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}

/* Adjust footer margin for collapsed sidebar */
.tt-sidebar.collapse ~ .tt-main-wrapper .admin-main-footer {
    margin-left: -80px !important; /* Adjust for collapsed sidebar width */
}

/* Mobile responsive adjustments */
@media (max-width: 991.98px) {
    .admin-main-footer {
        margin-left: 0 !important; /* No negative margin on mobile */
        width: 100% !important;
    }

    .footer-visible .tt-sidebar {
        height: calc(100vh - 150px) !important; /* Smaller reduction on mobile */
    }
}

.admin-footer-top {
    margin-bottom: 20px;
}

.admin-footer-logo {
    text-align: left;
}

.admin-footer-logo img {
    max-width: 120px;
    height: auto;
}

.admin-footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.admin-footer-links li {
    margin-bottom: 10px;
    font-size: 16px; /* Increased from 14px */
    display: flex;
    align-items: center;
    color: #ccc;
}

.admin-footer-links a {
    color: #ccc;
    text-decoration: none;
    transition: all 0.3s ease;
}

.admin-footer-links a:hover {
    color: white;
}

.admin-footer-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #006633;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    color: white;
    margin-right: 10px;
    font-size: 12px;
}

.admin-footer-icon i {
    width: 12px;
    height: 12px;
    font-size: 16px;
}

/* Copyright and Social Media Section */
.admin-footer-bottom {
    border-top: 1px solid #444;
    background-color: #2a2a2a;
    margin-top: 0px;
    margin-bottom: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    line-height: 1 !important;
    min-height: auto !important;
}

.admin-footer-bottom .row {
    margin-bottom: 0 !important;
    align-items: flex-start !important;
    flex-wrap: nowrap !important;
}

.admin-footer-bottom .col-auto {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
    flex: 0 0 auto !important;
    white-space: nowrap !important;
}

.admin-footer-bottom .col-auto:first-child {
    flex: 1 1 auto !important;
    white-space: normal !important;
}

.admin-footer-bottom .admin-social-links {
    flex-wrap: nowrap !important;
    align-items: center !important;
}

/* Aggressive removal of all margins and padding for entire footer */
.admin-main-footer,
.admin-main-footer *,
.admin-footer-top,
.admin-footer-bottom,
.admin-footer-bottom .row,
.admin-footer-bottom .col-auto,
.admin-footer-bottom .col-auto:last-child,
.admin-footer-bottom .col-auto:last-child *,
.admin-footer-bottom .admin-follow-text,
.admin-footer-bottom .admin-social-links,
.admin-footer-bottom .admin-social-icon,
.admin-copyright {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.admin-copyright {
    color: #ccc;
    margin-bottom: 0;
    font-size: 14px;
    line-height: 1.2;
}

.admin-follow-text {
    margin-right: 6px;
    font-size: 12px;
    color: #ccc;
    white-space: nowrap;
    margin-top: 0;
    margin-bottom: 0;
    padding-top: 0;
    padding-bottom: 0;
}

.admin-footer-icon svg {
    stroke: none !important;
    fill: white !important;
    width: 16px;
    height: 16px;
}

.admin-social-links {
    display: flex;
    align-items: flex-start;
    gap: 4px;
    margin-top: 0;
    margin-bottom: 0;
    padding-top: 0;
    padding-bottom: 0;
}

.admin-social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 16px;
    height: 16px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: white;
    transition: all 0.3s ease;
    font-size: 8px;
    text-decoration: none;
    margin-top: 0;
    margin-bottom: 0;
    padding-top: 0;
    padding-bottom: 0;
}

.admin-social-icon:hover {
    background-color: #044b1e;
    color: white;
}

.admin-social-icon i {
    width: 8px;
    height: 8px;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .admin-footer-top {
        padding-left: 5px !important; /* Much less padding on mobile */
    }

    .admin-footer-top .row {
        justify-content: flex-start !important; /* Left align on mobile */
    }

    .admin-footer-logo {
        text-align: left !important; /* Left align logo on mobile */
    }

    .admin-footer-links li {
        font-size: 14px; /* Increased from 12px */
        margin-bottom: 6px;
    }

    .admin-footer-icon {
        width: 20px;
        height: 20px;
        font-size: 10px;
        margin-right: 8px;
    }

    .admin-footer-logo img {
        max-width: 80px; /* Smaller logo on mobile */
        margin-bottom: 8px; /* Add bottom margin on mobile */
    }

    .admin-footer-bottom {
        padding-left: 5px !important; /* Match mobile padding */
        padding-top: 2px !important; /* Same as user mode */
        padding-bottom: 2px !important; /* Same as user mode */
    }

    .admin-copyright {
        font-size: 12px !important; /* Smaller copyright on mobile */
        text-align: left !important; /* Left align on mobile */
    }

    .admin-follow-text {
        font-size: 10px !important; /* Match user mode mobile */
    }

    .admin-social-icon {
        width: 14px !important; /* Smallest mobile icons */
        height: 14px !important;
        font-size: 6px !important;
    }

    .admin-social-icon i {
        width: 6px !important;
        height: 6px !important;
    }

    /* Maintain single line on tablets */
    .admin-footer-bottom .row {
        flex-wrap: nowrap !important;
    }
}

@media (max-width: 576px) {
    .admin-copyright {
        font-size: 10px !important; /* Even smaller copyright on small mobile */
    }

    .admin-follow-text {
        font-size: 9px !important; /* Match user mode small mobile */
    }

    .admin-footer-links li {
        font-size: 13px !important; /* Slightly smaller on small mobile */
    }

    .admin-footer-logo img {
        max-width: 70px !important; /* Even smaller logo on small mobile */
        margin-bottom: 6px !important; /* Smaller bottom margin on small mobile */
    }

    /* Maintain single line on mobile */
    .admin-footer-bottom .row {
        flex-wrap: nowrap !important;
    }

    /* Make social icons even smaller on mobile */
    .admin-social-icon {
        width: 8px !important;
        height: 8px !important;
        font-size: 5px !important;
    }

    .admin-social-icon i {
        width: 2px !important;
        height: 3px !important;
    }
}

/* Extra small devices - 375px and 430px */
@media (max-width: 430px) {
    .admin-copyright {
        font-size: 9px !important; /* Very small copyright for 375px and 430px */
    }

    .admin-follow-text {
        font-size: 8px !important; /* Very small follow text */
    }

    .admin-footer-links li {
        font-size: 12px !important; /* Smaller on 430px */
    }

    .admin-footer-logo img {
        max-width: 60px !important; /* Very small logo for 430px */
        margin-bottom: 5px !important; /* Small bottom margin for 430px */
    }
}

@media (max-width: 375px) {
    .admin-copyright {
        font-size: 8px !important; /* Smallest copyright for 375px */
    }

    .admin-follow-text {
        font-size: 7px !important; /* Smallest follow text */
    }

    .admin-footer-links li {
        font-size: 11px !important; /* Smallest on 375px */
    }

    .admin-footer-logo img {
        max-width: 50px !important; /* Smallest logo for 375px */
        margin-bottom: 4px !important; /* Smallest bottom margin for 375px */
    }
}
</style>

<footer class="admin-main-footer">
    <div class="container-fluid">
        <div class="admin-footer-top" style="padding-left: 50px;">
            <div class="row">
                <div class="col-md-2 mb-4 mb-md-0">
                    <div class="admin-footer-logo">
                        <img src="<?php echo e(staticAsset('frontend/default/assets/images/uliaa-mart-logo.jpeg')); ?>" alt="Uliaa Mart" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4 col-11 mb-4 mb-md-0">
                            <ul class="admin-footer-links">
    <li>
        <span class="admin-footer-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="16" height="16">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
            </svg>
        </span>
        <span style="font-size: 18px;"><?php echo e(getSetting('topbar_location')); ?></span>
    </li>
    <li>
        <a href="tel:<?php echo e(getSetting('navbar_contact_number')); ?>" class="admin-footer-icon">
            <i data-feather="phone"></i>
        </a>
        <span style="font-size: 18px;"><?php echo e(getSetting('navbar_contact_number')); ?></span>
    </li>
    <li>
        <a href="mailto:<?php echo e(getSetting('topbar_email')); ?>" class="admin-footer-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="16" height="16">
                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
        </a>
        <span style="font-size: 18px;"><?php echo e(getSetting('topbar_email')); ?></span>
    </li>
</ul>

                        </div>

                        <div class="col-md-4 col-11 mb-4 mb-md-0">
                            <ul class="admin-footer-links">
                                <li>
                                    <span class="admin-footer-icon">
  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="16" height="16">
    <path d="M10.59 16.59 15.17 12 10.59 7.41 12 6l6 6-6 6-1.41-1.41zM4.59 16.59 9.17 12 4.59 7.41 6 6l6 6-6 6-1.41-1.41z"/>
  </svg>
</span>

                                    <a href="<?php echo e(route('home.pages.privacyPolicy')); ?>"style="font-size: 18px;">Privacy Policy</a>
                                </li>
                                <li>
                                    <span class="admin-footer-icon">
  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="16" height="16">
    <path d="M10.59 16.59 15.17 12 10.59 7.41 12 6l6 6-6 6-1.41-1.41zM4.59 16.59 9.17 12 4.59 7.41 6 6l6 6-6 6-1.41-1.41z"/>
  </svg>
</span>
                                    <a href="<?php echo e(route('home.pages.shippingDeliveryPolicy')); ?>"style="font-size: 18px;">Shipping & Delivery Policy</a>
                                </li>
                                <li>
                                    <span class="admin-footer-icon">
  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="16" height="16">
    <path d="M10.59 16.59 15.17 12 10.59 7.41 12 6l6 6-6 6-1.41-1.41zM4.59 16.59 9.17 12 4.59 7.41 6 6l6 6-6 6-1.41-1.41z"/>
  </svg>
</span>
                                    <a href="<?php echo e(route('home.pages.returnRefundPolicy')); ?>" style="font-size: 18px;">Return & Refund Policy</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-4 col-11 mb-4 mb-md-0">
                            <ul class="admin-footer-links">
                                <li>
                                    <span class="admin-footer-icon">
  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="16" height="16">
    <path d="M10.59 16.59 15.17 12 10.59 7.41 12 6l6 6-6 6-1.41-1.41zM4.59 16.59 9.17 12 4.59 7.41 6 6l6 6-6 6-1.41-1.41z"/>
  </svg>
</span>
                                    <a href="<?php echo e(route('home.pages.paymentPolicy')); ?>" style="font-size: 18px;">Payment Policy</a>

                                </li>
                                <li>
                                   <span class="admin-footer-icon">
  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="16" height="16">
    <path d="M10.59 16.59 15.17 12 10.59 7.41 12 6l6 6-6 6-1.41-1.41zM4.59 16.59 9.17 12 4.59 7.41 6 6l6 6-6 6-1.41-1.41z"/>
  </svg>
</span>
                                    <a href="<?php echo e(route('home.pages.aboutUs')); ?>" style="font-size: 18px;">About Us</a>
                                </li>
                                <li>
                                   <span class="admin-footer-icon">
  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="16" height="16">
    <path d="M10.59 16.59 15.17 12 10.59 7.41 12 6l6 6-6 6-1.41-1.41zM4.59 16.59 9.17 12 4.59 7.41 6 6l6 6-6 6-1.41-1.41z"/>
  </svg>
</span>
                                    <a href="<?php echo e(route('home.pages.contactUs')); ?>" style="font-size: 18px;">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright and Social Media Section -->
        <div class="footer-bottom">
        <div class="row align-items-center">
        <div class="col-md-4 text-start copyright-section">
<style>
.copyright-section {
    padding-left: 70px;
}

@media (max-width: 430px) {
    .copyright-section {
        padding-left: 5px !important;
    }
}

@media (max-width: 390px) {
    .copyright-section {
        padding-left: 5px !important;
    }
}
</style>
            <span class="copyright mb-0">
            <?php echo getSetting('copyright_text'); ?>

            </span>

        </div>
        <div class="col-md-4 text-center d-flex justify-content-center align-items-center">
            <span class="partner-with-text"><?php echo getSetting('partner_with_text'); ?></span>
        </div>
                
        <div class="col-md-4 text-end d-flex justify-content-end align-items-center" style="padding-right: 120px;">
        <span class="follow-text me-1">Follow Us:</span>
        <div class="admin-social-links">
                       <a href="<?php echo e(getSetting('facebook_link')); ?>" target="_blank" class="admin-social-icon">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="14" height="14" fill="white">
    <path d="M279.14 288l14.22-92.66h-88.91V127.47c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S293.11 0 262.43 0c-73.14 0-121.18 44.38-121.18 124.72v70.62H89.09V288h52.16v224h100.2V288z"/>
  </svg>
</a>


<a href="<?php echo e(getSetting('instagram_link', 'https://www.instagram.com/uliaatradingforus/')); ?>" target="_blank" class="admin-social-icon">
  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="14" height="14">
    <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.5a1 1 0 100 2 1 1 0 000-2z"/>
  </svg>
</a>

<a href="<?php echo e(getSetting('youtube_link')); ?>" target="_blank" class="admin-social-icon">
  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="14" height="14">
    <path d="M21.8 8.001s-.2-1.5-.8-2.2c-.8-.9-1.7-.9-2.1-1C16.5 4.5 12 4.5 12 4.5h-.1s-4.5 0-6.9.3c-.4.1-1.3.1-2.1 1-.6.7-.8 2.2-.8 2.2S2 9.8 2 11.6v.8c0 1.8.2 3.6.2 3.6s.2 1.5.8 2.2c.8.9 1.8.9 2.3 1 1.7.2 7.2.3 7.2.3s4.5 0 6.9-.3c.4-.1 1.3-.1 2.1-1 .6-.7.8-2.2.8-2.2s.2-1.8.2-3.6v-.8c0-1.8-.2-3.6-.2-3.6zM10 15.5V8.5l6 3.5-6 3.5z"/>
  </svg>
</a>

<a href="<?php echo e(getSetting('tiktok_link', 'https://www.tiktok.com/@uliaa.mart?_t=ZS-8yNHKZLM09Z&_r=1')); ?>" target="_blank" class="admin-social-icon">
  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="14" height="14">
    <path d="M16 8.245V6.14a6.195 6.195 0 002.57.55h.43V3.12h-.43c-.92 0-1.81-.24-2.58-.7A5.92 5.92 0 0115 0h-3.27v14.01a2.01 2.01 0 01-2.76 1.85A2.01 2.01 0 018.01 13a2 2 0 012.2-1.97v-3.4a5.34 5.34 0 00-.86-.08 5.99 5.99 0 00-5.95 6.01A6.01 6.01 0 008.53 19.5a5.97 5.97 0 006.91-5.91v-3.57c.16.06.34.13.56.18z"/>
  </svg>
</a>


                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>

<!-- JavaScript for sticky footer behavior -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const footer = document.querySelector('.admin-main-footer');
    const body = document.body;

    if (!footer) return;

    function checkFooterVisibility() {
        const footerRect = footer.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        // Check if footer is visible in viewport (with some buffer)
        if (footerRect.top < windowHeight + 100) {
            body.classList.add('footer-visible');
        } else {
            body.classList.remove('footer-visible');
        }
    }

    // Check on scroll
    window.addEventListener('scroll', checkFooterVisibility);

    // Check on resize
    window.addEventListener('resize', checkFooterVisibility);

    // Initial check
    setTimeout(checkFooterVisibility, 100);

    // Also check when page is fully loaded
    window.addEventListener('load', checkFooterVisibility);
});
</script>

<!--footer section end-->
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/backend/inc/footer.blade.php ENDPATH**/ ?>