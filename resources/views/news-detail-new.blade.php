<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} - Desa Trengguli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/trengguli.css') }}">
        <style>
        /* KECUALI style KHUSUS, JANGAN override .container di sini! */
        .news-title {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--primary);
        }
        .news-date {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 20px;
        }
        .news-img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .news-content {
            font-size: 1.1rem;
            margin-bottom: 30px;
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
            text-align: center;
        }
        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        .back-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @include('components.header')
    <div class="container" style="margin-top: 120px; margin-bottom: 40px;">
        <h1 class="news-title">{{ $news->title }}</h1>
        <div class="news-date">{{ $news->published_at?->locale('id')->isoFormat('D MMMM Y') ?? 'Tanggal belum ditentukan' }}</div>
        <div class="news-meta">
            <span><i class="fas fa-eye"></i> {{ $news->view_count }} kali dilihat</span>
        </div>
        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="news-img" />
        <div class="news-content">
            {!! nl2br(e($news->content)) !!}
        </div>
        <a href="{{ url('/') }}#news" class="btn back-btn"><i class="fas fa-arrow-left"></i> Kembali ke Berita</a>
    </div>
    @include('components.footer', ['profile' => $profile])
    <!-- Tambahkan script JS untuk header jika diperlukan -->
<script>
    // Preloader
    window.addEventListener('load', function() {
        document.querySelector('.preloader').classList.add('fade-out');
        setTimeout(function() {
            document.querySelector('.preloader').style.display = 'none';
        }, 500);
    });

    // Mobile Menu Toggle
    document.getElementById('mobileMenuBtn').addEventListener('click', function() {
        document.getElementById('nav').classList.toggle('active');
        this.innerHTML = document.getElementById('nav').classList.contains('active') ? 
            '<i class="fas fa-times"></i>' : 
            '<i class="fas fa-bars"></i>';
    });

    // Sticky Header
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (window.scrollY > 100) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });

    // Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (document.getElementById('nav').classList.contains('active')) {
                    document.getElementById('nav').classList.remove('active');
                    document.getElementById('mobileMenuBtn').innerHTML = '<i class="fas fa-bars"></i>';
                }
            }
        });
    });

    // Tampilkan tombol Login Admin di desktop
    function showAdminLoginBtn() {
        var btn = document.getElementById('adminLoginBtn');
        if (window.innerWidth >= 992) {
            btn.style.display = 'flex';  
        } else {
            btn.style.display = 'none';
        }
    }
    window.addEventListener('resize', showAdminLoginBtn);
    document.addEventListener('DOMContentLoaded', showAdminLoginBtn);
</script>
</body>
</html>