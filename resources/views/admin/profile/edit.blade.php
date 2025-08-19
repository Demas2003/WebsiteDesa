@extends('layouts.admin')

@section('title', 'Edit Profil Desa')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold">Pengaturan Profil Desa</h2>
    </div>
    
    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="p-6">
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="village_name" class="block text-sm font-medium text-gray-700">Nama Desa</label>
                        <input type="text" name="village_name" id="village_name" 
                               value="{{ old('village_name', $profile->village_name ?? '') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        @error('village_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Desa</label>
                        <textarea name="description" id="description" rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('description', $profile->description ?? '') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Deskripsikan secara singkat tentang desa, sejarah, dan keunikannya</p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="vision" class="block text-sm font-medium text-gray-700">Visi</label>
                        <textarea name="vision" id="vision" rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('vision', $profile->vision ?? '') }}</textarea>
                        @error('vision')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mission" class="block text-sm font-medium text-gray-700">Misi</label>
                        <textarea name="mission" id="mission" rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('mission', $profile->mission ?? '') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Pisahkan setiap poin misi dengan baris baru</p>
                        @error('mission')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kontak</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                            <textarea name="address" id="address" rows="3" 
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('address', $profile->address ?? '') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <input type="text" name="phone" id="phone" 
                                       value="{{ old('phone', $profile->phone ?? '') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" 
                                       value="{{ old('email', $profile->email ?? '') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="office_hours" class="block text-sm font-medium text-gray-700">Jam Operasional</label>
                                <input type="text" name="office_hours" id="office_hours" 
                                       value="{{ old('office_hours', $profile->office_hours ?? '') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                       placeholder="Contoh: Senin - Jumat: 08.00 - 16.00 WIB">
                                @error('office_hours')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Media Sosial</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    facebook.com/
                                </span>
                                <input type="text" name="facebook" id="facebook" 
                                       value="{{ old('facebook', $profile->facebook ?? '') }}" 
                                       class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>
                            @error('facebook')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    @
                                </span>
                                <input type="text" name="instagram" id="instagram" 
                                       value="{{ old('instagram', $profile->instagram ?? '') }}" 
                                       class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>
                            @error('instagram')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="youtube" class="block text-sm font-medium text-gray-700">YouTube</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    youtube.com/
                                </span>
                                <input type="text" name="youtube" id="youtube" 
                                       value="{{ old('youtube', $profile->youtube ?? '') }}" 
                                       class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>
                            @error('youtube')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    +62
                                </span>
                                <input type="text" name="whatsapp" id="whatsapp" 
                                       value="{{ old('whatsapp', $profile->whatsapp ?? '') }}" 
                                       class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                       placeholder="8xxxxxxxxxx">
                            </div>
                            @error('whatsapp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
