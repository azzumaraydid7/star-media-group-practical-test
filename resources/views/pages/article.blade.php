@extends('layouts.app')

@section('title', $article ? $article->title : 'Article Not Found')

@section('content')
    <div class="overflow-x-hidden">
        <section class="max-w-4xl mx-auto px-4 py-12">
            @if ($article)
                <div data-aos="fade-up">
                    <div class="mb-8">
                        <a href="/" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Home
                        </a>
                    </div>

                    <div class="mb-8">
                        <h1 class="text-4xl font-bold mb-4 text-gray-900">{{ $article->title }}</h1>
                        <div class="flex items-center text-gray-600 mb-6">
                            <span>{{ $article->author ?? 'DailyTimes Group' }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $article->published_at->format('F j, Y') }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $article->read_minutes }} min read</span>
                        </div>
                        @if($article->image && file_exists(public_path($article->image)))
                            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full aspect-video object-cover rounded-2xl shadow-lg">
                        @else
                            <img src="{{ asset('img/default.png') }}" alt="{{ $article->title }}" class="w-full aspect-video object-cover rounded-2xl shadow-lg">
                        @endif
                    </div>

                    <div class="prose prose-lg max-w-none md:text-xl">
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $article->content }}</div>
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">{!! $article->text !!}</div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                Published on {{ $article->published_at->format('F j, Y') }}
                            </div>
                            <a href="{{ route('articles') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                                Read More Articles
                            </a>
                        </div>
                    </div>

                    @if (isset($relatedArticles) && $relatedArticles->count() > 0)
                        <div class="mt-16 h-[36rem] md:h-[26rem]">
                            <h2 class="text-2xl font-bold mb-8 text-gray-900">Related Articles</h2>
                            <div id="relatedArticlesContainer" class="grid md:grid-cols-2 gap-8">
                                @foreach ($relatedArticles as $related)
                                    <a href="{{ route('article', $related->slug) }}" class="flex items-start bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 mb-4">
                                        <div class="w-32 h-full flex-shrink-0">
                                            @if($related->image && file_exists(public_path($related->image)))
                                                <img src="{{ asset($related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ asset('img/default.png') }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>

                                        <div class="p-4 flex flex-col justify-between">
                                            <h3 class="text-base font-semibold text-gray-900 leading-snug line-clamp-2">
                                                {{ Str::limit($related->title, 30) }}
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                                                {{ Str::limit($related->content, 80) }}
                                            </p>

                                            <div class="flex items-center justify-between mt-2 text-xs text-gray-500">
                                                <span>{{ $related->read_minutes }} min read</span>
                                                <span class="text-blue-600 hover:text-blue-800 font-medium">
                                                    Read →
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('relatedArticlesContainer');
    const currentSlug = '{{ $article->slug }}';
    let shownArticleIds = [];

    if (container) {
        const initialArticles = container.querySelectorAll('a[href*="/article/"]');
        initialArticles.forEach(link => {
            const slug = link.href.split('/article/')[1];
        });
        setInterval(refreshRelatedArticles, 5000);
    }

    function refreshRelatedArticles() {
        if (!container) return;

        const excludeParam = shownArticleIds.length > 0 ? `?exclude=${shownArticleIds.join(',')}` : '';

        fetch(`/api/related-articles/${currentSlug}${excludeParam}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    updateRelatedArticles(data);
                    data.forEach(article => {
                        if (!shownArticleIds.includes(article.id)) {
                            shownArticleIds.push(article.id);
                        }
                    });
                } else {
                    shownArticleIds = [];
                    
                    fetch(`/api/related-articles/${currentSlug}`)
                        .then(response => response.json())
                        .then(freshData => {
                            if (freshData && freshData.length > 0) {
                                updateRelatedArticles(freshData);
                                freshData.forEach(article => {
                                    shownArticleIds.push(article.id);
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching fresh articles:', error);
                        });
                }
            })
            .catch(error => {
                console.error('Error fetching related articles:', error);
            });
    }

    function updateRelatedArticles(articles) {
        const container = document.getElementById('relatedArticlesContainer');
        if (!container) return;

        container.style.transition = 'opacity 0.3s ease';
        container.style.opacity = '0';

        setTimeout(() => {
            container.innerHTML = '';
            
            articles.forEach(article => {
                const articleElement = document.createElement('a');
                articleElement.href = `/article/${article.slug}`;
                articleElement.className = 'flex items-start bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 mb-4';
                
                let image = "{{ asset('') }}" + (article.image ? article.image : 'img/default.png');
                
                const limitText = (text, limit) => {
                    return text.length > limit ? text.substring(0, limit) + '...' : text;
                };

                articleElement.innerHTML = `
                    <div class="w-32 h-full flex-shrink-0">
                        <img src="${image}" alt="${article.title}" class="w-full h-full object-cover">
                    </div>

                    <div class="p-4 flex flex-col justify-between">
                        <h3 class="text-base font-semibold text-gray-900 leading-snug line-clamp-2">
                            ${limitText(article.title, 30)}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                            ${limitText(article.content, 80)}
                        </p>

                        <div class="flex items-center justify-between mt-2 text-xs text-gray-500">
                            <span>${article.read_minutes} min read</span>
                            <span class="text-blue-600 hover:text-blue-800 font-medium">
                                Read →
                            </span>
                        </div>
                    </div>
                `;
                
                container.appendChild(articleElement);
            });

            setTimeout(() => {
                container.style.opacity = '1';
            }, 100);
        }, 300);
    }
});
</script>
@endpush
