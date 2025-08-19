@extends('layouts.admin')

@section('title', 'Edit Foto')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold">Edit Foto</h2>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Foto</label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title', $gallery->title) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('description', $gallery->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category" id="category" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="kegiatan" {{ old('category', $gallery->category) === 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="wisata" {{ old('category', $gallery->category) === 'wisata' ? 'selected' : '' }}>Wisata</option>
                        <option value="produk" {{ old('category', $gallery->category) === 'produk' ? 'selected' : '' }}>Produk</option>
                        <option value="fasilitas" {{ old('category', $gallery->category) === 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Foto</label>
                    @if($gallery->image)
                        <div class="mt-2 mb-4">
                            <img src="{{ asset('storage/' . $gallery->image) }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="w-48 h-48 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" 
                           class="mt-1 block w-full" accept="image/*">
                    <p class="mt-1 text-sm text-gray-500">
                        Biarkan kosong jika tidak ingin mengubah foto. Format yang didukung: JPG, JPEG, PNG. Ukuran maksimal: 2MB
                    </p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="active" {{ old('status', $gallery->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $gallery->status) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.gallery.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Preview gambar sebelum upload
    const imageInput = document.getElementById('image');
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('img');
                preview.src = e.target.result;
                preview.className = 'mt-2 w-48 h-48 object-cover rounded';
                
                const previewContainer = imageInput.parentElement;
                const existingPreview = previewContainer.querySelector('img');
                if (existingPreview) {
                    existingPreview.remove();
                }
                previewContainer.insertBefore(preview, imageInput.nextSibling);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection
