{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} - Desa Trengguli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
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
            background-color: var(--light);
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

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
    <div class="container">
        <h1 class="news-title">{{ $news->title }}</h1>
        <div class="news-date">{{ $news->published_at->locale('id')->isoFormat('D MMMM Y') }}</div>
        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="news-img" />
        <div class="news-content">
            {!! nl2br(e($news->content)) !!}
        </div>
        <a href="{{ url()->previous() }}" class="btn back-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</body>
</html> --}}