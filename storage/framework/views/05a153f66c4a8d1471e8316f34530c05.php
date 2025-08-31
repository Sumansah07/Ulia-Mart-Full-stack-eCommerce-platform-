<!-- Custom CSS for Hero Carousel -->
<style>
    /* Hero Carousel Styles */
    #heroCarousel {
        margin-bottom: 30px;
    }
    
    #heroCarousel .carousel-item {
        min-height: 500px;
    }
    
    #heroCarousel .carousel-indicators {
        bottom: 20px;
    }
    
    #heroCarousel .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 0 5px;
    }
    
    #heroCarousel .carousel-indicators button.active {
        background-color: white;
    }
    
    #heroCarousel .carousel-control-prev,
    #heroCarousel .carousel-control-next {
        width: 50px;
        height: 50px;
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.7;
    }
    
    #heroCarousel .carousel-control-prev {
        left: 20px;
    }
    
    #heroCarousel .carousel-control-next {
        right: 20px;
    }
    
    #heroCarousel .carousel-control-prev:hover,
    #heroCarousel .carousel-control-next:hover {
        opacity: 1;
    }
    
    #heroCarousel .carousel-item h1 {
        font-weight: 700;
        line-height: 1.2;
    }
    
    #heroCarousel .carousel-item p {
        font-size: 16px;
        max-width: 90%;
    }
    
    #heroCarousel .btn {
        border-radius: 4px;
        font-weight: 600;
        padding: 10px 24px;
        transition: all 0.3s ease;
    }
    
    #heroCarousel .btn:hover {
        transform: translateY(-3px);
    }
    
    @media (max-width: 991px) {
        #heroCarousel .carousel-item {
            min-height: auto;
            padding: 40px 0;
        }
        
        #heroCarousel .carousel-item h1 {
            font-size: 2rem;
        }
        
        #heroCarousel .carousel-item p {
            max-width: 100%;
        }
        
        #heroCarousel .carousel-item .col-md-6:first-child {
            margin-bottom: 30px;
        }
    }
</style>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/frontend/default/inc/carousel-styles.blade.php ENDPATH**/ ?>