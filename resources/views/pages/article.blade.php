@extends('layouts.app')

@section('title', $article ? $article->title : 'Article Not Found')

@section('content')
    <div class="overflow-x-hidden">
        <section class="max-w-4xl mx-auto px-4 py-12">
            @if($article)
                <div data-aos="fade-up">
                    <!-- Back Button -->
                    <div class="mb-8">
                        <a href="/" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Home
                        </a>
                    </div>

                    <!-- Article Header -->
                    <div class="mb-8">
                        <h1 class="text-4xl font-bold mb-4 text-gray-900">{{ $article->title }}</h1>
                        <div class="flex items-center text-gray-600 mb-6">
                            <span>{{ $article->author ?? 'DailyTimes Group' }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $article->published_at->format('F j, Y') }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $article->read_minutes }} min read</span>
                        </div>
                        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full aspect-video object-cover rounded-2xl shadow-lg">
                    </div>

                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $article->content }}</div>
                    </div>

                    <!-- Article Footer -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                Published on {{ $article->published_at->format('F j, Y') }}
                            </div>
                            <a href="/" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                                Read More Articles
                            </a>
                        </div>
                    </div>

                    @if(isset($relatedArticles) && $relatedArticles->count() > 0)
                    <!-- Related Articles -->
                    <div class="mt-16">
                        <h2 class="text-2xl font-bold mb-8 text-gray-900">Related Articles</h2>
                        <div class="grid md:grid-cols-2 gap-8">
                            @foreach($relatedArticles as $related)
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <img src="{{ asset($related->image) }}" alt="{{ $related->title }}" class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold mb-2 text-gray-900">{{ $related->title }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($related->content, 120) }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">{{ $related->read_minutes }} min read</span>
                                        <a href="{{ route('article.show', $related->slug) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                            Read More →
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            @else
                <!-- Article Not Found -->
                <div class="text-center py-16" data-aos="fade-up">
                    <h1 class="text-4xl font-bold mb-4 text-gray-900">Article Not Found</h1>
                    <p class="text-gray-600 mb-8">The article you're looking for doesn't exist or has been moved.</p>
                    <a href="/" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                        Back to Home
                    </a>
                </div>
            @endif
        </section>
    </div>
@endsection