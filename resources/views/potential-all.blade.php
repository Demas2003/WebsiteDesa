<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Potensi Desa - Desa Trengguli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/trengguli.css') }}">
    <style>
        .all-potentials {
            margin-top: 120px;
            margin-bottom: 40px;
        }
        .page-title {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: var(--primary);
            text-align: center;
        }
        .potentials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        .potential-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .potential-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }
        .potential-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform 0.2s;
        }
        .potential-card:hover .potential-img {
            transform: scale(1.04);
        }
        .potential-img-link {
            display: block;
            width: 100%;
            height: 220px;
        }
        .potential-desc {
            padding: 20px;
        }
        .potential-desc h3 {
            font-size: 1.4rem;
            margin-bottom: 12px;
            color: var(--primary-dark);
        }
        .potential-desc h3 a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }
        .potential-desc h3 a:hover {
            color: var(--primary);
            text-decoration: underline;
        }
        .potential-desc p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 0;
        }
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #777;
        }
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #ccc;
        }
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: var(--primary);
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        @media (max-width: 768px) {
            .potentials-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .page-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    @include('components.header')
    
    <div class="container all-potentials">
        <h1 class="page-title">Semua Potensi Desa</h1>
        
        @if($potentials->count() > 0)
        <div class="potentials-grid">
            @foreach($potentials as $potential)
            <div class="potential-card">
                <a href="{{ route('potential.detail', $potential->id) }}" class="potential-img-link">
                    <img src="{{ asset('storage/' . $potential->image) }}" alt="{{ $potential->title }}" class="potential-img" />
                </a>
                <div class="potential-desc">
                    <h3>
                        <a href="{{ route('potential.detail', $potential->id) }}">
                            {{ $potential->title }}
                        </a>
                    </h3>
                    <p>{{ Str::limit(strip_tags($potential->content), 150) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin-bottom:32px;">
            {{ $potentials->links('pagination.simple') }}
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Belum ada potensi desa yang ditambahkan</h3>
            <p>Silakan kembali lagi nanti untuk melihat potensi desa kami.</p>
        </div>
        @endif
        
        <a href="{{ url('/') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>
    
    @include('components.footer', ['profile' => $profile])
    
    <script>
        // Preloader
        window.addEventListener('load', function() {
            var preloader = document.querySelector('.preloader');
            if(preloader) {
                preloader.classList.add('fade-out');
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }
        });

        // Mobile Menu Toggle
        var mobileMenuBtn = document.getElementById('mobileMenuBtn');
        if(mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                var nav = document.getElementById('nav');
                nav.classList.toggle('active');
                this.innerHTML = nav.classList.contains('active') ? 
                    '<i class="fas fa-times"></i>' : 
                    '<i class="fas fa-bars"></i>';
            });
        }

        // Sticky Header
        window.addEventListener('scroll', function() {
            var header = document.getElementById('header');
            if(header) {
                if (window.scrollY > 100) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            }
        });

        // Tampilkan tombol Login Admin di desktop
        function showAdminLoginBtn() {
            var btn = document.getElementById('adminLoginBtn');
            if (btn) {
                if (window.innerWidth >= 992) {
                    btn.style.display = 'flex';  
                } else {
                    btn.style.display = 'none';
                }
            }
        }
        window.addEventListener('resize', showAdminLoginBtn);
        document.addEventListener('DOMContentLoaded', showAdminLoginBtn);
    </script>
</body>
</html>