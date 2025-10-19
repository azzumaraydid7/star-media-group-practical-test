@extends('layouts.app')

@section('title', 'All Articles - DailyTimes')

@section('content')
    <div class="overflow-x-hidden">
        <!-- Header Section -->
        <section class="max-w-7xl mx-auto px-4 py-12 pb-20">
            <div class="text-center mb-12" data-aos="fade-up">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">
                    All Articles
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Explore our complete collection of news articles and stay informed with the latest stories.
                </p>
            </div>

            <!-- Back to Home Button -->
            <div class="mb-8" data-aos="fade-up">
                <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Home
                </a>
            </div>

            <!-- Articles Grid -->
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($articles as $article)
                        <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <!-- Article Image -->
                            <div class="aspect-video overflow-hidden">
                                <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Article Content -->
                            <div class="p-6">
                                <!-- Article Meta -->
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                        {{ $article->read_minutes }} min read
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        {{ $article->published_at->format('M j, Y') }}
                                    </span>
                                </div>

                                <!-- Article Title -->
                                <h2 class="text-xl font-bold mb-3 text-gray-900 line-clamp-2 hover:text-blue-600 transition-colors duration-200">
                                    <a href="{{ route('article', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h2>

                                <!-- Article Excerpt -->
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ Str::limit($article->content, 120) }}
                                </p>

                                <!-- Read More Button -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        By {{ $article->author ?? 'DailyTimes' }}
                                    </span>
                                    <a href="{{ route('article', $article->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                                        Read More
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center" data-aos="fade-up">
                    {{ $articles->links('pagination::tailwind') }}
                </div>
            @else
                <!-- No Articles Found -->
                <div class="text-center py-16" data-aos="fade-up">
                    <div class="mb-6">
                        <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Articles Found</h3>
                    <p class="text-gray-600 mb-8">There are currently no published articles available.</p>
                    <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                        Back to Home
                    </a>
                </div>
            @endif
        </section>
    </div>
@endsection