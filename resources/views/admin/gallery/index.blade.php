@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 flex justify-between items-center border-b">
        <h2 class="text-xl font-semibold">Galeri Foto</h2>
        <a href="{{ route('admin.gallery.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            <i class="fas fa-plus"></i> Tambah Foto
        </a>
    </div>
    
    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($galleries as $gallery)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="aspect-w-4 aspect-h-3">
                    <img src="{{ asset('storage/' . $gallery->image) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-medium text-gray-900">{{ $gallery->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $gallery->category }}</p>
                    <div class="mt-4 flex justify-end space-x-2">
                        <a href="{{ route('admin.gallery.edit', $gallery) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" 
                              method="POST" 
                              class="inline" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                Belum ada foto dalam galeri.
            </div>
            @endforelse
        </div>
    </div>
    
    <div class="p-6 border-t">
        {{ $galleries->links() }}
    </div>
</div>
@endsection
