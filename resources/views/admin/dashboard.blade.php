@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('header')
    <div class="pt-16">
        <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
    </div>
@endsection

@section('content')
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
                                <div class="truncate">
                                    <p class="font-medium text-gray-800 whitespace-nowrap truncate">{{ $article->title }}</p>
                                    <p class="text-sm text-gray-600">
                                        @if($article->is_featured)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Featured
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="text-right pl-2">
                                    <p class="text-sm text-gray-600 whitespace-nowrap">{{ Carbon\Carbon::parse($article->created_at)->format('d M Y') }}</p>
                                    <p class="text-sm text-gray-600 whitespace-nowrap">{{ Carbon\Carbon::parse($article->created_at)->format('h:i A') }}</p>
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
@endsection