@extends('layouts.admin')

@section('title', 'Detail Potensi Desa')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 flex justify-between items-center border-b">
        <h2 class="text-xl font-semibold">Detail Potensi Desa</h2>
        <a href="{{ route('admin.potential.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="p-6">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $potential->title }}</h3>

        @if($potential->image)
            <img src="{{ asset('storage/' . $potential->image) }}"
                 alt="{{ $potential->title }}"
                 class="w-full max-w-xl rounded-lg mb-6 object-cover">
        @endif

        <div class="text-gray-700 leading-relaxed">
            {!! nl2br(e($potential->content)) !!}
        </div>

        @if($potential->map_url)
            <div class="mt-6">
                <a href="{{ $potential->map_url }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <i class="fas fa-map-marker-alt mr-2"></i> Buka Lokasi di Google Maps
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
