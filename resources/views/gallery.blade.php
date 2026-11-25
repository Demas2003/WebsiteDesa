<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Desa - Desa Trengguli</title>
    <meta name="description" content="Galeri foto kegiatan, wisata, produk, dan fasilitas Desa Trengguli.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/trengguli.css') }}">
    <style>
        .page-section {
            margin-top: 120px;
            margin-bottom: 60px;
        }

        .gallery-page-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }

        .gallery-page-grid .gallery-overlay {
            flex-direction: column;
            gap: 10px;
            padding: 20px;
            text-align: center;
        }

        .gallery-page-grid .gallery-overlay i {
            font-size: 1.8rem;
        }

        .gallery-caption strong {
            display: block;
            color: #fff;
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .gallery-caption span {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 0.8rem;
            text-transform: capitalize;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #777;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #ccc;
        }

        @media (max-width: 768px) {
            .gallery-page-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    @include('components.header')

    <main class="container page-section">
        <h1 class="section-title">Galeri Desa</h1>

        @if($galleries->count() > 0)
            <div class="gallery-grid gallery-page-grid">
                @foreach($galleries as $gallery)
                    <div class="gallery-item">
                        <img src="{{ asset('storage/' . $gallery->image) }}"
                             alt="{{ $gallery->title }}">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus"></i>
                            <div class="gallery-caption">
                                <strong>{{ $gallery->title }}</strong>
                                @if($gallery->category)
                                    <span>{{ $gallery->category }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $galleries->links('pagination.simple') }}
        @else
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <h3>Belum ada foto dalam galeri</h3>
                <p>Silakan kembali lagi nanti untuk melihat dokumentasi kegiatan desa kami.</p>
            </div>
        @endif

        <div style="margin-top: 30px; text-align: center;">
            <a href="{{ url('/') }}#gallery" class="btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </main>

    <!-- Modal Lightbox -->
    <div class="modal" id="galleryModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <img class="modal-img" src="" alt="">
        </div>
    </div>

    @include('components.footer', ['profile' => $profile])
    @include('components.site-scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var items = document.querySelectorAll('.gallery-page-grid .gallery-item');
            var modal = document.getElementById('galleryModal');
            var modalImg = modal.querySelector('.modal-img');
            var closeModal = modal.querySelector('.close-modal');

            items.forEach(function (item) {
                item.addEventListener('click', function () {
                    var img = this.querySelector('img');
                    modalImg.setAttribute('src', img.getAttribute('src'));
                    modalImg.setAttribute('alt', img.getAttribute('alt'));
                    modal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                });
            });

            function closeLightbox() {
                modal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }

            closeModal.addEventListener('click', closeLightbox);
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeLightbox();
                }
            });
        });
    </script>
</body>
</html>
