<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - DailyTimes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <div x-data="{ open: false }" class="flex">
        <!-- Navigation -->
        <nav class="bg-white fixed top-0 left-0 right-0 z-40">
            <div class="mx-auto pr-4 lg:pr-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-4">
                        <!-- Mobile menu button -->
                        <button @click="open = true" class="lg:hidden focus:outline-none pl-4">
                            <i class="fas fa-bars text-2xl text-gray-700"></i>
                        </button>
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 lg:block hidden pl-2"><span class="text-blue-600">Daily</span>Times</a>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600 hidden sm:block">Welcome, {{ session('user_name') }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar Background Overlay -->
        <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-40 z-40 lg:hidden" x-transition.opacity></div>

        <!-- Sidebar -->
        <div class="w-64 lg:pt-20 bg-white shadow-lg min-h-screen fixed lg:relative z-50 lg:z-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out" :class="open ? 'translate-x-0' : '-translate-x-full'">

            <div class="p-4">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 pb-4 lg:hidden pl-2"><span class="text-blue-600">Daily</span>Times</a>
                <ul class="space-y-2 pt-4">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-gray-700 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.consents') }}" class="flex items-center p-3 text-gray-700 rounded-lg transition-colors {{ request()->routeIs('admin.consents') ? 'bg-blue-100 text-blue-700' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-shield-alt mr-3"></i>
                            Consents
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles') }}" class="flex items-center p-3 text-gray-700 rounded-lg transition-colors {{ request()->routeIs('admin.articles') ? 'bg-blue-100 text-blue-700' : 'hover:bg-gray-100' }}">
                            <i class="fas fa-newspaper mr-3"></i>
                            Articles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-home mr-3"></i>
                            View Site
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 py-8 px-4 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <i class="fas fa-times cursor-pointer" onclick="this.parentElement.parentElement.style.display='none'"></i>
                    </span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <i class="fas fa-times cursor-pointer" onclick="this.parentElement.parentElement.style.display='none'"></i>
                    </span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <i class="fas fa-times cursor-pointer" onclick="this.parentElement.style.display='none'"></i>
                    </span>
                </div>
            @endif

            @hasSection('header')
                <div class="mb-8">
                    @yield('header')
                </div>
            @endif

            @yield('content')
        </div>

    </div>
    @stack('scripts')
</body>

</html>
