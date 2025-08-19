@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold">Tambah Layanan Baru</h2>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700">Icon (Font Awesome)</label>
                    <div class="mt-1 flex space-x-4">
                        <select name="icon" id="icon" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            <option value="fas fa-envelope" {{ old('icon') === 'fas fa-envelope' ? 'selected' : '' }}>✉️ Surat</option>
                            <option value="fas fa-comment-alt" {{ old('icon') === 'fas fa-comment-alt' ? 'selected' : '' }}>💬 Pengaduan</option>
                            <option value="fas fa-id-card" {{ old('icon') === 'fas fa-id-card' ? 'selected' : '' }}>🪪 KTP</option>
                            <option value="fas fa-calendar-alt" {{ old('icon') === 'fas fa-calendar-alt' ? 'selected' : '' }}>📅 Kalender</option>
                            <option value="fas fa-hands-helping" {{ old('icon') === 'fas fa-hands-helping' ? 'selected' : '' }}>🤝 Bantuan</option>
                            <option value="fas fa-leaf" {{ old('icon') === 'fas fa-leaf' ? 'selected' : '' }}>🌿 Pertanian</option>
                            <option value="fas fa-heartbeat" {{ old('icon') === 'fas fa-heartbeat' ? 'selected' : '' }}>❤️ Kesehatan</option>
                            <option value="fas fa-graduation-cap" {{ old('icon') === 'fas fa-graduation-cap' ? 'selected' : '' }}>🎓 Pendidikan</option>
                        </select>
                        <div class="w-12 h-12 flex items-center justify-center bg-green-100 text-green-600 rounded-lg" id="iconPreview">
                            <i class="{{ old('icon', 'fas fa-envelope') }}"></i>
                        </div>
                    </div>
                    @error('icon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700">Urutan</label>
                        <input type="number" name="order" id="order" 
                               value="{{ old('order', 0) }}" min="0"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <p class="mt-1 text-sm text-gray-500">Urutan menentukan posisi tampilan layanan</p>
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.services.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Simpan Layanan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Preview icon when selection changes
    const iconSelect = document.getElementById('icon');
    const iconPreview = document.getElementById('iconPreview');
    
    iconSelect.addEventListener('change', function() {
        iconPreview.innerHTML = `<i class="${this.value}"></i>`;
    });
</script>
@endpush
@endsection
