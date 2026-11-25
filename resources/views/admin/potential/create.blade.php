@extends('layouts.admin')

@section('title', 'Tambah Potensi Desa')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold">Tambah Potensi Desa</h2>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.potential.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Potensi</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="content" id="content" rows="10" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Tambahkan field map_url di sini -->
                <div>
                    <label for="map_url" class="block text-sm font-medium text-gray-700">Google Maps Embed URL</label>
                    <input type="url" name="map_url" id="map_url" value="{{ old('map_url') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                           placeholder="https://www.google.com/maps/embed?pb=...">
                    @error('map_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">
                        Cara mendapatkan URL: Buka Google Maps → Cari lokasi → Klik "Share" → "Embed a map" → Salin URL embed
                    </p>
                </div>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full" accept="image/*">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.potential.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Simpan Potensi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
        
    // Preview Google Maps jika URL diisi
    document.getElementById('map_url').addEventListener('change', function() {
        const mapUrl = this.value;
        if (mapUrl) {
            // Hapus preview sebelumnya jika ada
            const existingPreview = document.getElementById('map-preview');
            if (existingPreview) {
                existingPreview.remove();
            }
            
            // Buat elemen preview
            const previewDiv = document.createElement('div');
            previewDiv.id = 'map-preview';
            previewDiv.className = 'mt-4 p-4 border rounded-md bg-gray-50';
            previewDiv.innerHTML = `
                <h4 class="text-sm font-medium text-gray-700 mb-2">Preview Peta:</h4>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe src="${mapUrl}" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <p class="mt-2 text-xs text-gray-500">Ini adalah preview peta. Pastikan URL embed Google Maps sudah benar.</p>
            `;
            
            // Sisipkan setelah input map_url
            this.parentNode.appendChild(previewDiv);
        }
    });
</script>
@endpush
@endsection