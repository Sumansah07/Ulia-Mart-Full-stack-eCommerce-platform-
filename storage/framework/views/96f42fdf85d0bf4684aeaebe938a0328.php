<!-- Info Bar Section: Above Footer -->
<section class="info-bar-section" style="background: #006633; color: #fff; padding: 8px 0; border-top: 2px solid #fff; width: 100%;">
    <div class="container-fluid" style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
        <div class="row align-items-center g-2">
            <!-- Center: Listing & Policies -->
            <div class="col-lg-8 col-md-12 col-12 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-start">
                    <span class="me-md-4 mb-2 mb-md-0 move-left-desktop" style="font-size: clamp(0.8rem, 2vw, 1rem); font-weight: 500;">"QUALITY PRODUCTS, REASONABLE PRICE"</span>
                    <span class="move-right-desktop" style="font-size: clamp(0.7rem, 1.5vw, 0.9rem); font-weight: 500;">DOCSCP Listing No: 3-35-387-42/2081/82</span>
                </div>
            </div>
            <!-- Right: Subscribe Input -->
            <div class="col-lg-4 col-md-12 col-12">
                <form action="<?php echo e(route('subscribe.store')); ?>" method="POST" class="d-flex flex-column flex-sm-row align-items-stretch justify-content-center justify-content-lg-end">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex w-100" style="max-width: 350px; margin: 0 auto; gap: 10px;">
                        <button type="submit" class="btn btn-subscribe" style="
                            background: linear-gradient(135deg, #e8f4fd 0%, #d1e7dd 100%);
                            border: 1px solid #ddd;
                            border-radius: 20px;
                            padding: 6px 12px;
                            cursor: pointer;
                            white-space: nowrap;
                            flex: 0 0 auto;
                            min-width: 120px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 6px;
                            font-weight: 600;
                            font-size: 12px;
                            color: #28a745;
                            text-transform: uppercase;
                            transition: all 0.2s ease;
                            position: relative;
                            overflow: visible;
                            ">
                            <!-- Bell Icon -->
                            <div style="
                                width: 20px;
                                height: 20px;
                                background: #28a745;
                                border-radius: 50%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                ">
                                🔔
                            </div>
                            <span>SUBSCRIBE</span>

                            <!-- Pointing Finger -->
                            <div class="pointing-finger" style="
                                position: absolute;
                                right: 0px;
                                top: 80%;
                                transform: translateY(-50%);
                                font-size: 16px;
                                animation: pointPulse 2s infinite ease-in-out;
                                ">
                                👆
                            </div>

                            <!-- Click Effect Lines -->
                            <div class="click-lines" style="
                                position: absolute;
                                right: -20px;
                                top: 30%;
                                ">
                                <div style="width: 10px; height: 1px; background: #666; margin: 1px 0; opacity: 0.6; animation: clickEffect 2s infinite;"></div>
                                <div style="width: 8px; height: 1px; background: #666; margin: 1px 0; opacity: 0.4; animation: clickEffect 2s infinite 0.1s;"></div>
                                <div style="width: 6px; height: 1px; background: #666; margin: 1px 0; opacity: 0.3; animation: clickEffect 2s infinite 0.2s;"></div>
                            </div>
                        </button>
                        <input type="email" name="email" class="form-control" 
                               style="border-radius: 0 4px 4px 0; border: none; padding: 8px 12px; 
                                      font-size: clamp(0.8rem, 1.5vw, 0.9rem); background: #fff; 
                                      color: #333; flex: 1 1 auto; min-width: 150px;" 
                               placeholder="Enter your email" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Custom responsive styles -->
<style>
    .btn-subscribe:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(40, 167, 69, 0.2);
    }

    /* Pointing finger animation */
    @keyframes pointPulse {
        0%, 100% {
            transform: translateY(-50%) scale(1);
            opacity: 0.8;
        }
        50% {
            transform: translateY(-50%) scale(1.1);
            opacity: 1;
        }
    }

    /* Click effect lines animation */
    @keyframes clickEffect {
        0%, 100% {
            opacity: 0.6;
            transform: translateX(0);
        }
        50% {
            opacity: 0.2;
            transform: translateX(3px);
        }
    }
    @media (max-width: 767.98px) {
        .info-bar-section {
            padding: 6px 0 !important;
        }
        .info-bar-section .container-fluid {
            padding: 0 10px !important;
        }
        .info-bar-section .row {
            text-align: center;
        }
        .info-bar-section form {
            margin-top: 10px;
        }
        .info-bar-section form .d-flex {
            flex-direction: column;
        }
        .info-bar-section .btn-subscribe {
            border-radius: 4px 4px 0 0 !important;
            margin-bottom: 0;
        }
        .info-bar-section input[type="email"] {
            border-radius: 0 0 4px 4px !important;
        }
    }
    
    @media (min-width: 768px) and (max-width: 991.98px) {
        .info-bar-section {
            padding: 8px 0 !important;
        }
        .info-bar-section form .d-flex {
            justify-content: center;
        }
    }
    
    @media (max-width: 575.98px) {
        .info-bar-section span {
            font-size: 0.75rem !important;
            margin-bottom: 5px;
        }
        .info-bar-section .btn-subscribe {
            font-size: 0.7rem !important;
            padding: 6px 8px !important;
            min-width: 80px !important;
        }
        .info-bar-section input[type="email"] {
            font-size: 0.75rem !important;
            padding: 6px 8px !important;
        }
    }
    @media (min-width: 992px) {
        .info-bar-section .move-left-desktop {
            margin-left: -60px !important;
            position: relative;
        }
        .info-bar-section .move-right-desktop {
            margin-left: 70px !important;
        }
    }

        @media (max-width: 575.98px) {
        .btn-subscribe {
            width: 30% !important;
            min-width: unset !important;
            margin: 0 auto 8px auto !important;
            font-size: 0.9rem !important;
        }
    }

</style>
<!-- End Info Bar Section -->
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/pages/partials/home/newsletter-subscription.blade.php ENDPATH**/ ?>