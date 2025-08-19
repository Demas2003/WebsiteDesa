<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-green-800 text-white transition-all duration-300" id="sidebar">
        <div class="flex items-center justify-between p-4 border-b border-green-700">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-8 h-8">
                <span class="font-semibold">Admin Panel</span>
            </div>
            <button class="lg:hidden" onclick="toggleSidebar()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <nav class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('admin.dashboard') ? 'bg-green-700' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.news.index') }}" class="flex items-center space-x-2 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('admin.news.*') ? 'bg-green-700' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span>Berita</span>
            </a>
            
            <a href="{{ route('admin.gallery.index') }}" class="flex items-center space-x-2 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('admin.gallery.*') ? 'bg-green-700' : '' }}">
                <i class="fas fa-images"></i>
                <span>Galeri</span>
            </a>
            
            <a href="{{ route('admin.services.index') }}" class="flex items-center space-x-2 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('admin.services.*') ? 'bg-green-700' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Layanan</span>
            </a>
            
            <a href="{{ route('admin.profile.edit') }}" class="flex items-center space-x-2 px-6 py-3 hover:bg-green-700 {{ request()->routeIs('admin.profile.*') ? 'bg-green-700' : '' }}">
                <i class="fas fa-building"></i>
                <span>Profil Desa</span>
            </a>
            
            <a href="#" id="logout-link" class="w-full flex items-center space-x-2 px-6 py-3 hover:bg-green-700 text-left mt-auto">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" style="display: none;">
                @csrf
            </form>
            <script>
                document.getElementById('logout-link').addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('logout-form').submit();
                });
            </script>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Top Bar -->
        <div class="bg-white shadow-sm">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <button class="lg:hidden" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="flex items-center space-x-4">
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="container mx-auto px-4 py-8">
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</body>
</html>
