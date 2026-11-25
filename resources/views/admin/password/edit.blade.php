@extends('layouts.admin')

@section('title', 'Ubah Password')

@section('content')
<div class="bg-white rounded-lg shadow-sm max-w-xl">
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold">Ubah Password</h2>
        <p class="mt-1 text-sm text-gray-500">Gunakan password yang kuat dan tidak dipakai di tempat lain.</p>
    </div>

    @if(session('success'))
        <div class="mx-6 mt-6 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-6">
        <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                <input type="password" name="current_password" id="current_password" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" name="password" id="password" required minlength="8"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter.</p>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Simpan Password Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
