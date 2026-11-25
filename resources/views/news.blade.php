<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Desa - Desa Trengguli</title>
    <meta name="description" content="Kumpulan berita dan kegiatan terbaru Desa Trengguli.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/trengguli.css') }}">
    <style>
        .page-section {
            margin-top: 120px;
            margin-bottom: 60px;
        }

        .news-page-grid {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        }

        .news-page-grid .news-card {
            background: #fff;
            display: flex;
            flex-direction: column;
        }

        .news-page-grid .news-content {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .news-page-grid .news-excerpt {
            flex: 1;
        }

        .news-page-grid .news-title a {
            color: inherit;
            transition: color 0.2s ease;
        }

        .news-page-grid .news-title a:hover {
            color: var(--primary);
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
            .news-page-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    @include('components.header')

    <main class="container page-section">
        <h1 class="section-title">Berita Desa</h1>

        @if($news->count() > 0)
            <div class="news-grid news-page-grid">
                @foreach($news as $item)
                    <article class="news-card">
                        <a href="{{ route('news.detail', $item->slug) }}" class="news-img">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                        </a>
                        <div class="news-content">
                            <div class="news-date">
                                <i class="far fa-calendar-alt"></i>
                                {{ $item->published_at?->locale('id')->isoFormat('D MMMM Y') ?? 'Tanggal belum ditentukan' }}
                            </div>
                            <h2 class="news-title">
                                <a href="{{ route('news.detail', $item->slug) }}">{{ $item->title }}</a>
                            </h2>
                            <p class="news-excerpt">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                            <a href="{{ route('news.detail', $item->slug) }}" class="btn btn-outline">Baca Selengkapnya</a>
                        </div>
                    </article>
                @endforeach
            </div>

            {{ $news->links('pagination.simple') }}
        @else
            <div class="empty-state">
                <i class="fas fa-newspaper"></i>
                <h3>Belum ada berita yang dipublikasikan</h3>
                <p>Silakan kembali lagi nanti untuk melihat berita terbaru dari desa kami.</p>
            </div>
        @endif

        <div style="margin-top: 30px; text-align: center;">
            <a href="{{ url('/') }}#news" class="btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </main>

    @include('components.footer', ['profile' => $profile])
    @include('components.site-scripts')
</body>
</html>
