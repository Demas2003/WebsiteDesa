@extends('layouts.app')

@section('title', $news->title)

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('news') }}" class="text-gray-600 hover:text-green-600">Berita</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $news->title }}</span>
        </div>

        <!-- News Content -->
        <article class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ asset('storage/' . $news->image) }}" 
                     alt="{{ $news->title }}" 
                     class="w-full h-full object-cover">
            </div>
            
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $news->title }}</h1>
                
                <div class="flex items-center text-gray-500 text-sm mb-6">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span>{{ $news->published_at->locale('id')->isoFormat('D MMMM Y') }}</span>
                </div>
                
                <div class="prose max-w-none">
                    {!! $news->content !!}
                </div>
                
                <div class="mt-6 pt-6 border-t">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-500 text-sm">Bagikan:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.detail', $news->slug)) }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-700">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.detail', $news->slug)) }}&text={{ urlencode($news->title) }}" 
                               target="_blank"
                               class="text-blue-400 hover:text-blue-500">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . route('news.detail', $news->slug)) }}" 
                               target="_blank"
                               class="text-green-600 hover:text-green-700">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                        
                        <a href="{{ route('news') }}" class="text-green-600 hover:text-green-700">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Berita
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <!-- Related News -->
        @if($relatedNews->isNotEmpty())
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Berita Terkait</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedNews as $item)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <a href="{{ route('news.detail', $item->slug) }}" class="block">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset('storage/' . $item->image) }}" 
                                 alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $item->title }}</h3>
                            <div class="text-sm text-gray-500">
                                {{ $item->published_at->locale('id')->isoFormat('D MMMM Y') }}
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
