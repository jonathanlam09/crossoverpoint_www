<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crossover Point</title>
    <link rel="icon" href="<?php echo url('assets/img/logo.png')?>" type="image/icon type">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
</head>
<body>
<style>
    :root {
        --header-height: 80px;
    }

    html, body {
        font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'Segoe UI', sans-serif;
        background-color: white;
        font-size: 14px;
        margin: 0;
        padding: 0;
    }

    /* Header Styles */
    .main-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background: transparent;
        transition: all 0.4s ease;
    }

    .main-header.scrolled {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.05);
    }

    .main-header.scrolled .nav-link,
    .main-header.scrolled .channel-switcher span {
        color: #000 !important;
    }

    .main-header.scrolled .logo-container {
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 40px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .logo-container {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    }

    .logo-container:hover {
        transform: scale(1.05);
    }

    .logo-container img {
        width: 40px;
        height: auto;
    }

    /* Navigation */
    .nav-menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 50px;
        align-items: center;
    }

    .nav-link {
        color: white;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 400;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 1px;
        background: currentColor;
        transition: width 0.3s ease;
    }

    .nav-link:hover {
        color: white;
        opacity: 0.7;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .main-header.scrolled .nav-link:hover {
        color: #000;
    }

    /* Channel Switcher */
    .channel-switcher {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .channel-switcher span {
        color: white!important;
        font-size: 0.8rem;
        font-weight: 400;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 4px 8px;
    }

    .channel-switcher span:hover {
        opacity: 0.7;
    }

    .channel-switcher span.active {
        background: white;
        color: #000!important;
        border-radius: 2px;
    }

    .main-header.scrolled .channel-switcher span.active {
        background: #000;
        color: white!important;
    }

    .channel-divider {
        width: 1px;
        height: 16px;
        background: rgba(255, 255, 255, 0.3);
    }

    .main-header.scrolled .channel-divider {
        background: rgba(0, 0, 0, 0.15);
    }

    /* Mobile Menu */
    .mobile-menu-icon {
        display: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .main-header.scrolled .mobile-menu-icon {
        color: #000;
    }

    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: #000;
        z-index: 9999;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .mobile-menu-overlay.active {
        display: block;
        opacity: 1;
    }

    .mobile-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .mobile-menu-close {
        color: white;
        font-size: 24px;
        cursor: pointer;
    }

    .mobile-menu-logo {
        width: 60px;
        height: 60px;
    }

    .mobile-nav-menu {
        list-style: none;
        padding: 40px 20px;
        margin: 0;
    }

    .mobile-nav-menu li {
        margin-bottom: 30px;
        text-align: center;
    }

    .mobile-nav-menu .nav-link {
        color: white;
        font-size: 1.2rem;
        letter-spacing: 2px;
    }

    .mobile-nav-menu .nav-link:hover {
        opacity: 0.7;
    }

    /* Banner Slider */
    .banner-wrapper {
        height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .banner-container {
        height: 100%;
        width: 100vw;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
    }

    .slider-children {
        min-width: 100vw;
        width: 100vw;
        height: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        filter: grayscale(20%);
    }

    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.4), transparent);
        pointer-events: none;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .nav-menu {
            display: none;
        }

        .mobile-menu-icon {
            display: block;
        }

        .header-container {
            padding: 15px 20px;
        }

        .banner-wrapper {
            height: 60vh;
        }
    }

    @media (max-width: 767px) {
        .logo-container {
            width: 50px;
            height: 50px;
        }

        .logo-container img {
            width: 32px;
        }

        .banner-wrapper {
            height: 50vh;
        }

        .channel-switcher span {
            font-size: 0.75rem;
        }
    }

    /* Utility Classes */
    img {
        max-width: 100%;
        height: auto;
    }

    .memory-card {
        height: 300px;
        transition: all 0.4s ease;
        cursor: pointer;
        background-size: cover;
        filter: grayscale(20%);
    }

    .memory-card:hover {
        filter: grayscale(0%);
        transform: scale(1.02);
    }

    .nav-link,
    .channel-switcher span {
        color: black;
        /* text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6); */
    }
</style>

<section class="banner-section mb-5">
    @if (request()->path() == '/')
    <div class="banner-wrapper">
        <div class="banner-container">
            <div class="slider-children" style="background-image:url('{{ url('assets/img/slider/1.png') }}')"></div>
            <div class="slider-children" style="background-image:url('{{ url('assets/img/slider/2.png') }}')"></div>
            <div class="slider-children" style="background-image:url('{{ url('assets/img/slider/3.png') }}')"></div>
            <div class="slider-children" style="background-image:url('{{ url('assets/img/slider/4.png') }}')"></div>
            <div class="slider-children" style="background-image:url('{{ url('assets/img/slider/5.png') }}')"></div>
            <div class="slider-children" style="background-image:url('{{ url('assets/img/slider/6.png') }}')"></div>
        </div>
        <div class="banner-overlay"></div>
    </div>
    @endif

    <!-- Main Header -->
    <header class="main-header" id="mainHeader">
        <div class="header-container">
            <a href="/" class="logo-container">
                <img src="{{ url('assets/img/logo.png') }}" alt="Logo">
            </a>

            <!-- Desktop Navigation -->
            <ul class="nav-menu">
                <li><a class="nav-link" href="{{ url('/') }}">{{ $channel == 'ENG' ? 'HOME' : '主页' }}</a></li>
                <li><a class="nav-link" href="{{ url('/about-us') }}">{{ $channel == 'ENG' ? 'ABOUT' : '关于我们' }}</a></li>
                <li><a class="nav-link" href="{{ url('testimony') }}">{{ $channel == 'ENG' ? 'TESTIMONIES' : '見證' }}</a></li>
                <li><a class="nav-link" href="{{ url('services?page=1&length=10&type=upcoming') }}">{{ $channel == 'ENG' ? 'Services' : '聚會' }}</a></li>
                <li><a class="nav-link" href="{{ url('events?page=1&length=10&type=upcoming') }}">{{ $channel == 'ENG' ? 'EVENTS' : '活动' }}</a></li>
                <li><a class="nav-link" onclick="smooth_scroll('#contact_us')">{{ $channel == 'ENG' ? 'CONTACT' : '联系我们' }}</a></li>
                <li>
                    <div class="channel-switcher">
                        <span class="{{ $channel == 'CH' ? 'active' : '' }}" onclick="change_channel('CH')">{{ $channel == 'ENG' ? 'CH' : '华' }}</span>
                        <div class="channel-divider"></div>
                        <span class="{{ $channel == 'ENG' ? 'active' : '' }}" onclick="change_channel('ENG')">{{ $channel == 'ENG' ? 'ENG' : '英' }}</span>
                    </div>
                </li>
            </ul>

            <!-- Mobile Menu Toggle -->
            <div class="d-flex align-items-center gap-3">
                <div class="channel-switcher d-lg-none">
                    <span class="{{ $channel == 'CH' ? 'active' : '' }}" onclick="change_channel('CH')">{{ $channel == 'ENG' ? 'CH' : '华' }}</span>
                    <div class="channel-divider"></div>
                    <span class="{{ $channel == 'ENG' ? 'active' : '' }}" onclick="change_channel('ENG')">{{ $channel == 'ENG' ? 'ENG' : '英' }}</span>
                </div>
                <i class="fa fa-bars mobile-menu-icon" onclick="toggleMobileMenu()"></i>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenu">
        <div class="mobile-menu-header">
            <img src="{{ url('assets/img/logo.png') }}" class="mobile-menu-logo" alt="Logo">
            <i class="fa fa-times mobile-menu-close" onclick="toggleMobileMenu()"></i>
        </div>
        <ul class="mobile-nav-menu">
            <li><a class="nav-link" href="{{ url('/') }}">{{ $channel == 'ENG' ? 'HOME' : '主页' }}</a></li>
            <li><a class="nav-link" href="{{ url('/about-us') }}">{{ $channel == 'ENG' ? 'ABOUT' : '关于我们' }}</a></li>
            <li><a class="nav-link" href="{{ url('testimony') }}">{{ $channel == 'ENG' ? 'TESTIMONIES' : '見證' }}</a></li>
            <li><a class="nav-link" href="{{ url('services?page=1&length=10&type=upcoming') }}">{{ $channel == 'ENG' ? 'Services' : '聚會' }}</a></li>
            <li><a class="nav-link" href="{{ url('events?page=1&length=10&type=upcoming') }}">{{ $channel == 'ENG' ? 'EVENTS' : '活动' }}</a></li>
            <li><a class="nav-link" onclick="smooth_scroll('#contact_us'); toggleMobileMenu();">{{ $channel == 'ENG' ? 'CONTACT' : '联系我们' }}</a></li>
        </ul>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(() => {
        // Banner slider
        let slideIndex = 0;
        const totalSlides = $('.slider-children').length;
        
        setInterval(() => {
            slideIndex = (slideIndex + 1) % totalSlides;
            $('.banner-container').css({
                transform: `translateX(${-slideIndex * 100}vw)`,
            });
        }, 5000);

        // Header scroll effect
        $(window).scroll(function() {
            if ($(window).scrollTop() > 100) {
                $('#mainHeader').addClass('scrolled');
            } else {
                $('#mainHeader').removeClass('scrolled');
            }
        });
    });

    function toggleMobileMenu() {
        $('#mobileMenu').toggleClass('active');
        $('body').toggleClass('overflow-hidden');
    }

    function change_channel(val) {
        axios.get(address + 'api/index/language?ch=' + val)
        .then((response) => {
            if(response.data.status) {
                location.reload();
            } else {
                warning_response(response.data.message);
            }
        })
        .catch((err) => {
            error_response(err);
        });
    }

    function smooth_scroll(val) {
        if($('#mobileMenu').hasClass('active')) {
            toggleMobileMenu();
        }
        $(val).get(0).scrollIntoView({
            behavior: 'smooth'
        });
    }
</script>