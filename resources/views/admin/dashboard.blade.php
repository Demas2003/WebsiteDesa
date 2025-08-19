@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Total Berita</p>
                <h3 class="text-2xl font-bold">{{ $newsCount }}</h3>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-newspaper text-blue-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Galeri Foto</p>
                <h3 class="text-2xl font-bold">{{ $galleryCount }}</h3>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-images text-green-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Layanan</p>
                <h3 class="text-2xl font-bold">{{ $servicesCount }}</h3>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-cog text-purple-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Pengunjung Hari Ini</p>
                <h3 class="text-2xl font-bold">{{ $visitorCount }}</h3>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-users text-yellow-500"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent News -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h4 class="text-lg font-semibold">Berita Terbaru</h4>
        </div>
        <div class="p-6">
            @if($recentNews->count() > 0)
                <div class="space-y-4">
                    @foreach($recentNews as $news)
                    <div class="flex items-center space-x-4">
                        @if($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-newspaper text-gray-400"></i>
                            </div>
                        @endif
                        <div>
                            <h5 class="font-medium">{{ $news->title }}</h5>
                            <p class="text-sm text-gray-500">{{ $news->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Belum ada berita.</p>
            @endif
        </div>
    </div>

    <!-- Recent Gallery -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h4 class="text-lg font-semibold">Galeri Terbaru</h4>
        </div>
        <div class="p-6">
            @if($recentGallery->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($recentGallery as $gallery)
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover rounded">
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Belum ada foto.</p>
            @endif
        </div>
    </div>
</div>
@endsection
