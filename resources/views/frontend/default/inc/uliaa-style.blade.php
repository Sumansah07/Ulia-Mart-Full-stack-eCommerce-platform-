<!-- Uliaa Mart Custom Styles -->
<style>
/* Features Section Styles */
.features-section {
    padding: 40px 0;
    margin-top: -20px;
    position: relative;
    z-index: 100;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.feature-item {
    transition: all 0.3s ease;
    border-radius: 8px;
    border: 1px solid #f0f0f0;
    height: 100%;
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.feature-icon {
    margin-bottom: 15px;
}

.feature-icon-circle {
    background-color: var(--primary-color);
    transition: all 0.3s ease;
}

.feature-item:hover .feature-icon-circle {
    transform: scale(1.1);
}

.feature-item h5 {
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--primary-color);
}

/* Base Styles */
:root {
    --primary-color: #006633;
    --secondary-color: #f5b700;
    --text-color: #333333;
    --light-text: #666666;
    --white: #ffffff;
    --light-gray: #f5f5f5;
    --border-color: #e0e0e0;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
    --warning-color: #ffc107;
    --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

/* Top Bar */
.top-bar {
    background-color: var(--primary-color);
    padding: 8px 0;
    font-size: 14px;
    position: relative;
    z-index: 102;
}

.top-date,
.top-link,
.user-icon {
    color: #ffffff;
    text-decoration: none;
}

.top-link {
    display: inline-flex;
    align-items: center;
}

.top-link:hover {
    color: var(--white);
}

.user-icon {
    border-radius: 50%;
    color: #ffffff;
    transition: all 0.3s ease;
}

.user-icon:hover {
    color: #f5b700;
    transform: scale(1.1);
}

.my-account-link {
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    margin-left: -5px;
}

.my-account-link:hover {
    color: #f5b700;
}

/* User Menu Styles */
.gshop-header-user {
    position: relative;
}

.user-icon {
    background: transparent;
    border: none;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.user-icon:hover {
    color: #f5b700;
    transform: scale(1.1);
}

.user-menu-wrapper {
    position: absolute;
    top: 100%;
    right: 0;
    width: 220px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    padding: 10px 0;
    z-index: 1000;
    margin-top: 10px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.gshop-header-user:hover .user-menu-wrapper {
    opacity: 1;
    visibility: visible;
}

.user-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.user-menu li {
    padding: 0;
    margin: 0;
}

.user-menu li a {
    display: block;
    padding: 8px 15px;
    color: #333;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.user-menu li a:hover {
    background-color: #f5f5f5;
    color: var(--primary-color);
}

.offcanvas-body .nav-link:hover {
    background-color: var(--primary-color) !important;
    color: white !important;
}

.auth-container {
    display: flex;
    align-items: center;
}

.auth-links {
    display: flex;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    padding: 4px 10px;
}

.auth-link {
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.auth-link:hover {
    color: #f5b700;
}

.auth-separator {
    color: rgba(255, 255, 255, 0.5);
    margin: 0 8px;
}

.track-icon {
    border-radius: 50%;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.track-icon:hover {
    color: #f5b700;
    transform: scale(1.1);
}

/* Header */
.header-wrapper {
    z-index: 101;
    width: 100%;
}

.main-header {
    background-color: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    padding: 15px 0;
    position: relative;
    z-index: 101;
}

.logo-wrapper {
    display: block;
}

.logo img {
    max-height: 60px;
    max-width: 100%;
    object-fit: contain;
}

/* Search Container */
.search-container {
    display: flex;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    overflow: hidden;
    height: 42px;
}

.search-input {
    flex: 1;
    border: none;
    padding: 0 15px;
    font-size: 14px;
    height: 100%;
}

/* Category Select */
.category-select-wrapper {
    position: relative;
    width: 200px;
    border: 1px solid #ccc;
    background-color: white;
    border-radius: 4px;
    height: 42px;
}

.category-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    border: none;
    background: transparent;
    padding: 0 35px 0 15px;
    font-size: 14px;
    font-weight: 600;
    color: #333;
    height: 100%;
    cursor: pointer;
    width: 100%;
}

/* Fix dropdown option text color */
.category-select option {
    background-color: white;
    color: #333333;
    font-weight: normal;
    padding: 10px;
}

/* Only make the placeholder text uppercase */
.category-select option:first-child {
    text-transform: uppercase;
}

/* Style for selected option */
.category-select option:checked {
    background-color: #f0f0f0;
    color: #006633;
    font-weight: 600;
}

/* Style for hover state */
.category-select option:hover {
    background-color: #f5f5f5;
    color: #006633;
}

.select-arrow {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #333;
    pointer-events: none;
    font-size: 12px;
}

.search-btn {
    background-color: var(--primary-color);
    color: white;
    padding: 0 15px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
}

/* Cart Button */
.gshop-header-cart button {
    background-color: var(--primary-color);
    border-radius: 30px;
    padding: 12px 15px;
    color: white;
    display: flex;
    align-items: center;
}

.cart-counter {
    background-color: #f8f6f6 !important;
    color: #0a0a0a !important;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: -10px;
    right: -10px;
}

/* Contact Icons */
.contact-icons {
    display: flex;
    margin-right: 10px;
}

.whatsapp-icon, .viber-icon {
    font-size: 38px;
    margin-right: 5px;
}

.whatsapp-icon {
    color: #25D366;
}

.viber-icon {
    color: #665CAC;
}

/* Category Menu Dropdown */
.category-dropdown-menu-wrapper {
    position: relative;
}

.category-menu-btn {
    background-color: var(--primary-color);
    color: white;
    border-radius: 4px;
    padding: 8px 15px;
    font-size: 14px;
    font-weight: 500;
    border: none;
}

.category-menu-btn:hover,
.category-menu-btn:focus,
.category-menu-btn:active {
    background-color: #004d26;
    color: white;
}

.category-menu {
    width: 250px;
    padding: 0;
    border-radius: 4px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    max-height: 400px;
    overflow-y: auto;
    z-index: 1050 !important;
}

/* Fix for Bootstrap dropdown */
.dropdown-menu.show {
    display: block !important;
}

.category-menu .dropdown-item {
    padding: 10px 15px;
    font-size: 14px;
    color: #333;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
}

.category-menu .dropdown-item img {
    width: 24px;
    height: 24px;
    margin-right: 10px;
    object-fit: cover;
    border-radius: 4px;
}

.category-menu .dropdown-item:hover,
.category-menu .dropdown-item:focus {
    background-color: var(--primary-color);
    color: white;
}

/* Header Right */
.header-right {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.order-info {
    margin-right: 15px;
    text-align: right;
}

.order-label {
    font-size: 12px;
    color: #666;
}

.phone-number {
    font-weight: 500;
    font-size: 14px;
}

/* Main Navigation */
.nav-wrapper {
    z-index: 100;
    width: 100%;
}

.main-nav {
    background-color: white;
    border-bottom: 1px solid #e0e0e0;
    position: relative;
    z-index: 100;
}

/* Ensure categories are evenly distributed */
.navbar.collapse.navbar-collapse {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.navbar {
    padding: 0;
    display: flex;
    flex-wrap: nowrap;
    justify-content: flex-start;
    gap: 20px;
}

/* Dropdown styles */
.dropdown {
    position: relative;
    display: inline-block;
    margin-right: 15px; /* Increase space between dropdown items */
}

.dropbtn {
    background-color: transparent;
    color: #333;
    padding: 15px 15px; /* Increase horizontal padding */
    font-size: 14px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dropbtn.active-category,
.dropbtn.active-category:hover,
.dropbtn.active-category:focus,
.dropbtn.active-category:active {
    background-color: var(--primary-color) !important;
    color: white !important;
}

.dropbtn:hover {
    background-color: var(--primary-color) !important;
    color: white !important;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 103;
}

/* Style the "View All" links in dropdown menus */
.view-all-link {
    font-weight: bold !important;
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #e9ecef !important;
    color: #006633 !important;
    padding-top: 10px !important;
    padding-bottom: 10px !important;
}

/* Mobile submenu styles */
.submenu {
    display: none !important;
}

.submenu li {
    margin-bottom: 5px;
}

.submenu li a {
    display: block;
    padding: 8px 15px;
    color: #555;
    font-size: 14px;
    text-decoration: none;
    border-left: 2px solid #e0e0e0;
    transition: all 0.3s ease;
}

.submenu li a:hover {
    color: white !important;
    border-left-color: var(--primary-color) !important;
    background-color: var(--primary-color) !important;
}

.dropdown-content a {
    color: #333;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-size: 14px;
    transition: all 0.3s ease;
}

.dropdown-content a:hover {
    background-color: var(--primary-color);
    color: white;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    color: var(--primary-color);
}

.dropbtn.active-category,
.dropbtn.active-category:hover,
.dropbtn.active-category:focus,
.dropbtn.active-category:active {
    background-color: var(--primary-color) !important;
    color: white !important;
}

.main-nav .desktop-dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-size: 14px;
    }

    .main-nav .desktop-dropdown-content a:hover {
        background-color: var(--primary-color) !important;
        color: white !important;
    }

/* Mobile Navigation */
.offcanvas {
    max-width: 300px;
}

.offcanvas .nav-link {
    color: #333;
    padding: 10px 0;
    border-bottom: 1px solid #f1f1f1;
}

.offcanvas .nav-link:hover {
    color: var(--primary-color);
}

.navbar-toggler {
    border: none;
    padding: 0;
    font-size: 20px;
    color: var(--primary-color);
    background: transparent;
}

/* Mobile Search */
.mobile-search {
    background-color: white;
    padding: 10px 0;
    border-bottom: 1px solid #e0e0e0;
}

@media (max-width: 767.98px) {
    .category-select-wrapper {
        max-width: 120px;
        background-color: #006633; /* Ensure mobile has same background */
    }

    .category-select {
        font-size: 12px;
        padding: 0 25px 0 10px;
        color: white; /* Ensure text is white on mobile too */
        font-weight: 600;
    }

    .select-arrow {
        right: 5px;
        color: white; /* Ensure arrow is white on mobile */
    }

    /* Fix mobile search spacing issues - FULL WIDTH */
    .mobile-search {
        padding: 0 !important;
        margin: 0 !important;
        width: 100vw !important;
        position: relative !important;
        left: 50% !important;
        right: 50% !important;
        margin-left: -50vw !important;
        margin-right: -50vw !important;
    }

    .mobile-search .container {
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100% !important;
        width: 100% !important;
    }

    .mobile-search .search-container {
        margin: 0 !important;
        border-radius: 0 !important;
        width: 100% !important;
        height: 50px !important;
        border: 0 !important;
        border: none !important;
        outline: none !important;
    }

    .mobile-search .search-input {
        border: 0 !important;
        border: none !important;
        outline: none !important;
    }

    .mobile-search .search-btn {
        border: 0 !important;
        border: none !important;
        outline: none !important;
    }

    .mobile-search .search-input {
        padding: 0 10px !important;
        font-size: 14px !important;
    }

    .mobile-search .search-btn {
        padding: 0 12px !important;
    }
}

/* Hero Section Fix */
.carousel, .hero-section, .banner-section {
    position: relative;
    z-index: 50;
}

/* API Loading and Error States */
.api-loading {
    opacity: 0.7;
    pointer-events: none;
}

.api-error-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px 15px;
    border-radius: 4px;
    z-index: 9999;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive Styles */
@media (max-width: 767.98px) {
    .top-bar-content {
        text-align: center;
    }

    .top-bar-item {
        justify-content: center;
        width: 100%;
    }
}

@media (min-width: 768px) and (max-width: 1024px) {
    .main-nav .dropbtn,
    .main-nav .tablet-direct-link,
    .main-nav .desktop-dropdown-btn {
        color:#000000 !important;
    }
    .main-nav .dropbtn.active-category,
    .main-nav .tablet-direct-link.active-category,
    .main-nav .desktop-dropdown-btn.active-category {
        background-color: #006633 !important;
        color: #fff !important;
        border-radius: 4px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04) !important;
        z-index: 10 !important;
        position: relative !important;
    }
    .main-nav .dropdown .dropbtn.active-category,
    .main-nav .dropdown button.dropbtn.active-category,
    .main-nav .dropdown a.dropbtn.active-category {
        background-color: #006633 !important;
        color: #fff !important;
        border: 2px solid #006633 !important;
        border-radius: 6px !important;
        outline: 2px solid #006633 !important;
        box-shadow: 0 0 0 2px #00663333 !important;
        z-index: 2000 !important;
        position: relative !important;
        transition: background 0.2s !important;
    }
}
</style>
