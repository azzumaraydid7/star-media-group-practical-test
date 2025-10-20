<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DailyTimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">DailyTimes - Admin</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Welcome, {{ session('user_name') }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <div class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-gray-700 bg-blue-100 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.consents') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-shield-alt mr-3"></i>
                            Consents
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-newspaper mr-3"></i>
                            Articles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-home mr-3"></i>
                            View Site
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
                <p class="text-gray-600">Welcome to your admin dashboard</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Consents</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalConsents }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500">
                            <i class="fas fa-newspaper text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Articles</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalArticles }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Recent Activity</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $recentConsents->count() + $recentArticles->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">System Status</p>
                            <p class="text-2xl font-semibold text-green-600">Online</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Consents -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Consents</h3>
                    </div>
                    <div class="p-6">
                        @if($recentConsents->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentConsents as $consent)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $consent->guid }}</p>
                                            <p class="text-sm text-gray-600">Version {{ $consent->version }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-600">{{ Carbon\Carbon::parse($consent->accepted_at)->format('h:i A') }}</p>
                                            <p class="text-sm text-gray-600">{{ Carbon\Carbon::parse($consent->accepted_at)->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.consents') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View all consents →
                                </a>
                            </div>
                        @else
                            <p class="text-gray-500">No consents recorded yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Articles -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Articles</h3>
                    </div>
                    <div class="p-6">
                        @if($recentArticles->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentArticles as $article)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ Str::limit($article->title, 40) }}</p>
                                            <p class="text-sm text-gray-600">
                                                @if($article->is_featured)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Featured
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-600">{{ Carbon\Carbon::parse($article->created_at)->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.articles') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View all articles →
                                </a>
                            </div>
                        @else
                            <p class="text-gray-500">No articles published yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>