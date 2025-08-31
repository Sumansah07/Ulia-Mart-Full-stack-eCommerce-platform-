<!-- Custom CSS for Grostore Hero Section -->
<style>
    /* Hero Section Styles */
    .hero-section {
        background-color: #ffffff;
        padding: 60px 0;
        min-height: 500px;
        position: relative;
    }

    .social-sidebar {
        z-index: 10;
        left: 20px;
    }

    .social-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #f8f9fa;
        color: #333;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background-color: #006633;
        color: white;
    }

    .subtitle {
        font-size: 18px;
        font-weight: 600;
        color: #ff6b35;
        font-style: italic;
    }

    .hero-title {
        font-weight: 700;
        color: #222;
        line-height: 1.2;
    }

    .hero-text {
        color: #666;
        font-size: 16px;
        max-width: 90%;
    }

    .hero-buttons .btn {
        border-radius: 4px;
        font-weight: 600;
        padding: 10px 24px;
    }

    .hero-buttons .btn-primary {
        background-color: #ff6b35;
        border-color: #ff6b35;
    }

    .hero-buttons .btn-success {
        background-color: #006633;
        border-color: #006633;
    }

    .decorative-leaf {
        max-width: 150px;
        opacity: 0.8;
        z-index: -1;
    }

    .main-product-image {
        max-height: 400px;
        object-fit: contain;
    }

    @media (max-width: 991px) {
        .hero-section {
            padding: 40px 0;
            min-height: auto;
        }
        
        .hero-content {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .hero-text {
            max-width: 100%;
        }
        
        .hero-buttons {
            justify-content: center;
        }
    }
</style>
