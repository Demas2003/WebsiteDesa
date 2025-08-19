@extends('layouts.admin')

@section('title', 'Detail Berita')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold">Detail Berita</h2>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $news->title }}</h3>
                        <div class="mt-2 flex items-center space-x-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $news->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($news->status) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $news->published_at ? 'Dipublikasikan ' . $news->published_at->format('d M Y H:i') : 'Belum dipublikasikan' }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Konten</h4>
                        <div class="mt-2 text-gray-900 prose">
                            {!! $news->content !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Gambar</h4>
                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full rounded">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-image text-gray-400"></i>
                        </div>
                    @endif
                </div>
                
                <div class="mt-4 bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Ringkasan</h4>
                    <p class="text-gray-900">{{ $news->excerpt }}</p>
                </div>
                
                <div class="mt-4 bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Metadata</h4>
                    <div class="text-sm text-gray-900">
                        <p>Dibuat: {{ $news->created_at->format('d M Y H:i') }}</p>
                        <p>Diubah: {{ $news->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.news.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Kembali
            </a>
            <a href="{{ route('admin.news.edit', $news) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Edit Berita
            </a>
        </div>
    </div>
</div>
@endsection
