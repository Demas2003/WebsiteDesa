<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desa Trengguli - Desa Asri Penuh Kearifan Lokal')</title>
    
    <!-- Meta Tags -->
    <meta name="description" content="@yield('description', 'Website resmi Desa Trengguli - Desa asri penuh kearifan lokal dengan potensi pertanian, kerajinan tangan, dan wisata alam yang memukau.')">
    <meta name="keywords" content="Desa Trengguli, desa wisata, pertanian organik, kerajinan tangan, wisata alam">
    <meta name="author" content="Desa Trengguli">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Desa Trengguli - Desa Asri Penuh Kearifan Lokal')">
    <meta property="og:description" content="@yield('description', 'Website resmi Desa Trengguli - Desa asri penuh kearifan lokal dengan potensi pertanian, kerajinan tangan, dan wisata alam yang memukau.')">
    <meta property="og:image" content="@yield('og_image', asset('storage/logo-desa.png'))">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Desa Trengguli - Desa Asri Penuh Kearifan Lokal')">
    <meta property="twitter:description" content="@yield('description', 'Website resmi Desa Trengguli - Desa asri penuh kearifan lokal dengan potensi pertanian, kerajinan tangan, dan wisata alam yang memukau.')">
    <meta property="twitter:image" content="@yield('og_image', asset('storage/logo-desa.png'))">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css'])
    
    <!-- Custom Styles -->
    <style>
    :root {
        --primary: #2e7d32;
        --primary-light: #60ad5e;
        --primary-dark: #005005;
        --secondary: #fbc02d;
        --light: #f8f9fa;
        --dark: #212121;
        --gray: #757575;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        color: var(--dark);
        line-height: 1.6;
        overflow-x: hidden;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    ul {
        list-style: none;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .btn {
        display: inline-block;
        padding: 12px 24px;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary);
    }

    .btn-outline:hover {
        background: var(--primary);
        color: white;
    }

    .section-title {
        text-align: center;
        margin-bottom: 40px;
        position: relative;
        font-size: 2.2rem;
        color: var(--primary-dark);
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: var(--secondary);
        border-radius: 2px;
    }

    /* Preloader */
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--light);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    }

    .preloader.fade-out {
        opacity: 0;
        pointer-events: none;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(46, 125, 50, 0.2);
        border-radius: 50%;
        border-top-color: var(--primary);
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0) translateX(-50%);
        }
        40% {
            transform: translateY(-15px) translateX(-50%);
        }
        60% {
            transform: translateY(-7px) translateX(-50%);
        }
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .section-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1.6rem;
        }
        
        .btn {
            padding: 10px 20px;
        }
    }

    /* Utility Classes */
    .text-center {
        text-align: center;
    }
    
    .mt-4 {
        margin-top: 1rem;
    }
    
    .mb-4 {
        margin-bottom: 1rem;
    }
    
    .py-12 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
    
    .text-gray-500 {
        color: var(--gray);
    }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Modal for Gallery Lightbox -->
    <div class="modal" id="galleryModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <img class="modal-img" src="" alt="" />
        </div>
    </div>

    <!-- JavaScript -->
    @vite(['resources/js/app.js'])
    
    <script>
    // Preloader
    window.addEventListener('load', function() {
        document.querySelector('.preloader').classList.add('fade-out');
        setTimeout(function() {
            document.querySelector('.preloader').style.display = 'none';
        }, 500);
    });

    // Gallery Lightbox
    document.addEventListener('DOMContentLoaded', function() {
        const galleryItems = document.querySelectorAll('.gallery-item');
        const modal = document.getElementById('galleryModal');
        const modalImg = document.querySelector('.modal-img');
        const closeModal = document.querySelector('.close-modal');

        galleryItems.forEach(item => {
            item.addEventListener('click', function() {
                const imgSrc = this.querySelector('img').getAttribute('src');
                const imgAlt = this.querySelector('img').getAttribute('alt');

                modalImg.setAttribute('src', imgSrc);
                modalImg.setAttribute('alt', imgAlt);
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        });

        closeModal.addEventListener('click', function() {
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        });
    });

    // Animation on Scroll
    function animateOnScroll() {
        const elements = document.querySelectorAll('.hero-content, .about-content, .news-card, .service-card, .gallery-item, .section-title');

        elements.forEach(el => {
            const elPosition = el.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elPosition < windowHeight - 100) {
                el.style.opacity = 1;
                el.style.transform = 'translateY(0)';
            }
        });
    }

    // Initialize with some elements visible
    document.addEventListener('DOMContentLoaded', function() {
        animateOnScroll();

        // Set initial styles for animation
        const animateElements = document.querySelectorAll('.hero-content, .about-content, .news-card, .service-card, .gallery-item, .section-title');
        animateElements.forEach(el => {
            el.style.opacity = 0;
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        // Hero content should be visible immediately if exists
        const heroContent = document.querySelector('.hero-content');
        if (heroContent) {
            heroContent.style.opacity = 1;
            heroContent.style.transform = 'translateY(0)';
        }
    });

    window.addEventListener('scroll', animateOnScroll);
