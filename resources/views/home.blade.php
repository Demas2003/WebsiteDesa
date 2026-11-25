<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Trengguli - Desa Asri Penuh Kearifan Lokal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/trengguli.css') }}">

    <style>
        /* Tambahkan jarak kanan kiri pada section potensi */
        .potensi {
            padding-left: 32px;
            padding-right: 32px;
            padding-bottom: 16px;
            padding-top: 8px;
        }
        
        @media (max-width: 800px) {
            .potensi {
                padding-left: 12px;
                padding-right: 12px;
            }
        }
        </style>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    
    <!-- Header -->
    <header id="header">
        <div class="container header-container">
            <div class="logo">
                <div class="logo-img">
                    {{-- <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/8721bfa0-739c-4fcb-acbe-6e2f0169eb64.png" alt="Logo Desa Trengguli: Lambang desa dengan ilustrasi gunung, padi, dan rumah adat tradisional" /> --}}
                </div>
                <div class="logo-text">Desa <span>Trengguli</span></div>
            </div>
            
            <nav id="nav">
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#about">Profil Desa</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#potentials">Potensi Desa</a></li>
                    <li><a href="#news">Berita</a></li>
                    <li><a href="#gallery">Galeri</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </nav>
            <a href="/admin/login" class="btn" style="margin-left:24px;display:none;align-items:center;gap:8px;" id="adminLoginBtn">
                <i class="fas fa-user-lock"></i> Login Admin
            </a>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>
    
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Selamat Datang di Website Resmi Desa Trengguli</h1>
            <p>Desa yang asri di tengah alam hijau dengan kearifan lokal yang terjaga.</p>
            <a href="#about" class="btn">Jelajahi Desa</a>
        </div>
        
        <a href="#about" class="hero-scroll">
            <i class="fas fa-chevron-down"></i>
        </a>
    </section>
    
    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <h2 class="section-title">Profil Desa Trengguli</h2>
            
            <div class="about-content">
                <div class="about-text">
                    {!! nl2br(e($profile->description ?? 'Deskripsi desa belum tersedia')) !!}
                </div>
                
                <div class="vision-mission">
                    <div class="vision-card">
                        <h3><i class="fas fa-eye"></i> Visi</h3>
                        <p>{{ $profile->vision ?? 'Visi desa belum tersedia' }}</p>
                    </div>
                    
                    <div class="mission-card">
                        <h3><i class="fas fa-bullseye"></i> Misi</h3>
                        @if($profile && $profile->mission)
                            {!! nl2br(e($profile->mission)) !!}
                        @else
                            <p>Misi desa belum tersedia</p>
                        @endif
                    </div>
                </div>
            </section>

            <section class="potensi" id="potentials">
                <div class="potensi">
                    <h2 class="section-title">Potensi Unggulan Desa</h2>
                    <div class="potensi-grid">
                        @foreach($potentials->take(3) as $potential)
                            <div class="potensi-card">
                                <a href="{{ route('potential.detail', $potential->id) }}">
                                    <div class="potensi-img">
                                        <img src="{{ asset('storage/' . $potential->image) }}" alt="{{ $potential->title }}">

                                    </div>
                                </a>
                                <div class="potensi-desc">
                                    <h3>{{ $potential->title }}</h3>
                                    <p>{{ Str::limit(strip_tags($potential->content), 150) }}</p>
                                </div>
                            </div>
                        @endforeach
            
                        @if($potentials->count() == 0)
                            <div class="col-span-full text-center py-12 text-gray-500">
                                Belum ada potensi desa yang ditambahkan.
                            </div>
                        @endif
                    </div>
            
                    @if($potentials->count() > 3)
                    <div class="potensi-more" style="text-align:right;margin-top:20px;">
                        <a href="{{ route('potential.all') }}" class="btn">Lihat Semua Potensi Desa</a>
                    </div>
                    @endif
                </div>
            </section>

    <!-- News Section -->
    <section class="news" id="news">
        <div class="container">
            <h2 class="section-title">Berita Terbaru</h2>
            
            <div class="news-grid">
                @forelse($news as $item)
                <div class="news-card">
                    <div class="news-img">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" />
                    </div>
                    <div class="news-content">
                        <div class="news-date">{{ $item->published_at?->locale('id')->isoFormat('D MMMM Y') ?? 'Tanggal belum ditentukan' }}</div>
                        <h3 class="news-title">{{ $item->title }}</h3>
                        <p class="news-excerpt">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                        <a href="{{ route('news.detail', $item->slug) }}" class="btn btn-outline">Baca Selengkapnya</a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    Belum ada berita yang dipublikasikan.
                </div>
                @endforelse
            </div>
            
            <div class="news-more">
                <a href="{{ route('news') }}" class="btn">Lihat Semua Berita</a>
            </div>
        </div>
    </section>
    
    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <h2 class="section-title">Layanan Digital Desa</h2>
            
            <div class="services-grid">
                @forelse($services as $service)
                <div class="service-card">
                    <div class="service-icon">
                        <i class="{{ $service->icon }}"></i>
                    </div>
                    <h3 class="service-title">{{ $service->title }}</h3>
                    <p>{{ $service->description }}</p>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    Belum ada layanan yang tersedia.
                </div>
                @endforelse
            </div>
        </div>
    </section>
    
    <!-- Gallery Section -->
    <section class="gallery" id="gallery">
        <div class="container">
            <h2 class="section-title">Galeri Kegiatan</h2>
            
            <div class="gallery-grid">
                @forelse($galleries as $gallery)
                <div class="gallery-item">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" />
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    Belum ada foto dalam galeri.
                </div>
                @endforelse
            </div>
            
            <div class="see-more">
                <a href="{{ route('gallery') }}" class="btn">Lihat Galeri Lengkap</a>
            </div>
        </div>
    </section>
    
    <!-- Modal for Gallery -->
    <div class="modal" id="galleryModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <img class="modal-img" src="" alt="" />
        </div>
    </div>
    
    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-container">
                <div class="footer-about">
                    <h3 class="footer-title">Tentang Desa Trengguli</h3>
                    <p>Desa Trengguli adalah desa yang terletak di kabupaten XXX, provinsi XXX. Dengan kekayaan alam dan budaya yang beragam, kami berkomitmen untuk membangun desa yang mandiri dan sejahtera.</p>
                    
                    <div class="footer-social">
                        @if($profile && $profile->facebook)
                            <a href="https://facebook.com/{{ $profile->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($profile && $profile->instagram)
                            <a href="https://instagram.com/{{ $profile->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($profile && $profile->youtube)
                            <a href="https://youtube.com/{{ $profile->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if($profile && $profile->whatsapp)
                            <a href="https://wa.me/62{{ ltrim($profile->whatsapp, '0') }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        @endif
                    </div>
                </div>
                
                <div class="footer-links">
                    <h3 class="footer-title">Tautan Cepat</h3>
                    <ul>
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#about">Profil Desa</a></li>
                        <li><a href="#services">Layanan Digital</a></li>
                        <li><a href="#news">Berita</a></li>
                        <li><a href="#gallery">Galeri</a></li>
                        <li><a href="#contact">Kontak</a></li>
                    </ul>
                </div>
                
                <div class="footer-contact">
                    <h3 class="footer-title">Kontak Kami</h3>
                    <ul>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $profile->address ?? 'Alamat belum tersedia' }}</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>{{ $profile->phone ?? 'Nomor telepon belum tersedia' }}</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>{{ $profile->email ?? 'Email belum tersedia' }}</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>{{ $profile->office_hours ?? 'Jam operasional belum tersedia' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>© {{ date('Y') }} {{ $profile->village_name ?? 'Desa Trengguli' }}. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
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
        
        // Gallery Lightbox
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
            
            // Hero content should be visible immediately
            document.querySelector('.hero-content').style.opacity = 1;
            document.querySelector('.hero-content').style.transform = 'translateY(0)';
        });
        
        window.addEventListener('scroll', animateOnScroll);
        
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

