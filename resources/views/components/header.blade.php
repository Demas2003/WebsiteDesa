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
                <li><a href="{{ url('/') }}#home">Beranda</a></li>
                <li><a href="{{ url('/') }}#about">Profil Desa</a></li>
                <li><a href="{{ url('/') }}#services">Layanan</a></li>
                <li><a href="{{ url('/') }}#potentials">Potensi Desa</a></li>
                <li><a href="{{ route('news') }}">Berita</a></li>
                <li><a href="{{ route('gallery') }}">Galeri</a></li>
                <li><a href="{{ url('/') }}#contact">Kontak</a></li>
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