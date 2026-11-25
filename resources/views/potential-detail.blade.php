<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $potential->title }} - Potensi Desa Trengguli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/trengguli.css') }}">
    <style>
        .potential-title {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--primary);
        }
        .potential-img-wrap {
            width: 100%;
            max-width: 480px;
            margin: 0 auto 20px auto;
            text-align: center;
            cursor: zoom-in;
            position: relative;
        }
        .potential-img {
            width: 100%;
            max-height: 320px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: box-shadow 0.2s;
        }
        .potential-img:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.14);
        }
        /* Modal styles for zoom */
        .img-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0; top: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.78);
            justify-content: center;
            align-items: center;
        }
        .img-modal.active {
            display: flex;
        }
        .img-modal-content {
            max-width: 92vw;
            max-height: 84vh;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.22);
            background: #fff;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 22px 14px;
        }
        .img-modal-content img {
            width: auto;
            max-width: 80vw;
            max-height: 70vh;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.11);
            transition: transform 0.15s;
            cursor: grab;
            user-select: none;
            touch-action: none;
        }
        .img-modal-close {
            position: absolute;
            top: 8px; right: 10px;
            background: #222;
            color: #fff;
            border: none;
            font-size: 1.7em;
            width: 38px; height: 38px;
            cursor: pointer;
            border-radius: 50%;
            display: flex;
            align-items: center; justify-content: center;
            z-index: 20;
        }
        .potential-content {
            font-size: 1.1rem;
            margin-bottom: 30px;
            line-height: 1.8;
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
        .map-section {
            margin-bottom: 30px;
        }
        .map-embed {
            width: 100%;
            max-width: 800px;
            height: 320px;
            border-radius: 8px;
            border: 0;
            margin-bottom: 10px;
            display: block;
        }
        .share-group {
            display: flex;
            gap: 10px;
            margin: 16px 0 30px 0;
            flex-wrap: wrap;
        }
        .share-btn {
            background: #25d366;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0 16px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            height: 40px;
        }
        .share-btn.copy {
            background: #007bff;
        }
        .share-btn:active {
            opacity: 0.8;
        }
        .share-btn i {
            font-size: 1.2em;
        }
        .copied-tooltip {
            display: inline-block;
            background: #333;
            color: #fff;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 0.95em;
            margin-left: 10px;
            opacity: 0;
            transition: opacity 0.3s;
            position: relative;
            top: -2px;
        }
        .copied-tooltip.active {
            opacity: 1;
        }
    </style>
</head>
<body>
    @include('components.header')
    <div class="container" style="margin-top: 120px; margin-bottom: 40px;">
        <h1 class="potential-title">{{ $potential->title }}</h1>
        
        <div class="potential-img-wrap" id="potentialImgWrap">
            <img src="{{ asset('storage/' . $potential->image) }}" alt="{{ $potential->title }}" class="potential-img" id="potentialImg" />
        </div>
        
        <!-- Modal zoom image -->
        <div class="img-modal" id="imgModal">
            <div class="img-modal-content">
                <button class="img-modal-close" id="imgModalClose" title="Tutup">&times;</button>
                <img src="{{ asset('storage/' . $potential->image) }}" alt="{{ $potential->title }}" id="modalImg" />
                <!-- Tidak ada tombol zoom manual -->
            </div>
        </div>

        <div class="potential-content">
            {!! nl2br(e($potential->content)) !!}
        </div>

        @if($potential->map_url)
        <div class="map-section">
            <h3 style="font-weight:500; margin-bottom:10px;">Lokasi di Google Maps:</h3>
            <iframe class="map-embed" src="{{ $potential->map_url }}" allowfullscreen="" loading="lazy"></iframe>
            <div class="share-group">
                <!-- Share to WhatsApp -->
                <button class="share-btn wa" onclick="shareToWA()">
                    <i class="fab fa-whatsapp"></i> Bagikan ke WhatsApp
                </button>
                <!-- Copy Link -->
                <button class="share-btn copy" onclick="copyLink()">
                    <i class="fas fa-link"></i> Salin Link
                </button>
                <span class="copied-tooltip" id="copiedTooltip">Tersalin!</span>
            </div>
        </div>
        @endif
        
        <a href="{{ url('/') }}#potentials" class="btn back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Potensi Desa
        </a>
    </div>
    @include('components.footer', ['profile' => $profile])
    
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

        // Share to WhatsApp
        function shareToWA() {
            const title = "{{ $potential->title }}";
            const url = window.location.href;
            const waText = encodeURIComponent(`Lihat Potensi Desa "${title}" di Trengguli\n${url}`);
            const waLink = `https://wa.me/?text=${waText}`;
            window.open(waLink, '_blank');
        }

        // Copy Link
        function copyLink() {
            const url = window.location.href;
            navigator.clipboard.writeText(url)
                .then(() => {
                    const tooltip = document.getElementById('copiedTooltip');
                    tooltip.classList.add('active');
                    setTimeout(() => {
                        tooltip.classList.remove('active');
                    }, 2000);
                })
                .catch(() => {
                    alert('Gagal menyalin link!');
                });
        }

        // NATURAL ZOOM & DRAG
        const imgWrap = document.getElementById('potentialImgWrap');
        const imgModal = document.getElementById('imgModal');
        const imgModalClose = document.getElementById('imgModalClose');
        const modalImg = document.getElementById('modalImg');
        let zoomLevel = 1;
        let isDragging = false;
        let startX = 0, startY = 0;
        let imgX = 0, imgY = 0;

        // buka modal
        imgWrap.addEventListener('click', function() {
            imgModal.classList.add('active');
            zoomLevel = 1;
            imgX = 0; imgY = 0;
            applyTransform();
            document.body.style.overflow = 'hidden';
        });

        // tutup modal
        imgModalClose.addEventListener('click', function() {
            imgModal.classList.remove('active');
            document.body.style.overflow = '';
        });

        // klik background tutup modal
        imgModal.addEventListener('click', function(e) {
            if (e.target === imgModal) {
                imgModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // wheel zoom (desktop)
        modalImg.addEventListener('wheel', function(e) {
            e.preventDefault();
            const delta = e.deltaY || e.detail || e.wheelDelta;
            if (delta < 0) {
                zoomLevel = Math.min(zoomLevel + 0.15, 5);
            } else {
                zoomLevel = Math.max(zoomLevel - 0.15, 1);
                if (zoomLevel === 1) { imgX = 0; imgY = 0; }
            }
            applyTransform();
        });

        // drag (desktop)
        modalImg.addEventListener('mousedown', function(e) {
            if (zoomLevel === 1) return;
            isDragging = true;
            startX = e.clientX - imgX;
            startY = e.clientY - imgY;
            modalImg.style.cursor = 'grabbing';
        });
        document.addEventListener('mousemove', function(e) {
            if (isDragging) {
                imgX = e.clientX - startX;
                imgY = e.clientY - startY;
                applyTransform();
            }
        });
        document.addEventListener('mouseup', function() {
            isDragging = false;
            modalImg.style.cursor = 'grab';
        });

        // touch pinch (mobile) & drag
        let lastDistance = null, touchX = 0, touchY = 0;
        modalImg.addEventListener('touchstart', function(e) {
            if (e.touches.length === 2) {
                lastDistance = getTouchDistance(e.touches[0], e.touches[1]);
            }
            if (e.touches.length === 1 && zoomLevel > 1) {
                touchX = e.touches[0].clientX - imgX;
                touchY = e.touches[0].clientY - imgY;
            }
        });
        modalImg.addEventListener('touchmove', function(e) {
            if (e.touches.length === 2) {
                e.preventDefault();
                const newDistance = getTouchDistance(e.touches[0], e.touches[1]);
                if (lastDistance) {
                    const diff = newDistance - lastDistance;
                    if (Math.abs(diff) > 2) {
                        zoomLevel += diff * 0.005;
                        zoomLevel = Math.max(1, Math.min(zoomLevel, 5));
                        applyTransform();
                        lastDistance = newDistance;
                    }
                }
            }
            if (e.touches.length === 1 && zoomLevel > 1) {
                imgX = e.touches[0].clientX - touchX;
                imgY = e.touches[0].clientY - touchY;
                applyTransform();
            }
        });
        modalImg.addEventListener('touchend', function(e) {
            lastDistance = null;
        });

        function getTouchDistance(t1, t2) {
            const dx = t2.clientX - t1.clientX;
            const dy = t2.clientY - t1.clientY;
            return Math.sqrt(dx*dx + dy*dy);
        }

        function applyTransform() {
            modalImg.style.transform = `scale(${zoomLevel}) translate(${imgX/zoomLevel}px,${imgY/zoomLevel}px)`;
            modalImg.style.transition = 'transform 0.1s';
        }

        // double click/double tap reset
        modalImg.addEventListener('dblclick', function() {
            zoomLevel = 1;
            imgX = 0; imgY = 0;
            applyTransform();
        });
        modalImg.addEventListener('touchstart', (function() {
            let lastTap = 0;
            return function(e) {
                const now = Date.now();
                if (now - lastTap < 350) {
                    zoomLevel = 1;
                    imgX = 0; imgY = 0;
                    applyTransform();
                }
                lastTap = now;
            }
        })());
    </script>
</body>
</html>