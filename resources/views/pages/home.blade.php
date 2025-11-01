@extends('layouts.app')

<div class="overflow-x-hidden">
    @section('content')
        <section class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div data-aos="fade-right">
                    @if ($featuredArticle)
                        <img src="{{ asset($featuredArticle->image) }}" alt="{{ $featuredArticle->title }}" class="rounded-2xl shadow-xl aspect-video object-cover">
                    @else
                        <img src="{{ asset('img/3572927.jpg') }}" alt="Headline Image" class="rounded-2xl shadow-xl aspect-video object-cover">
                    @endif
                </div>
                <div class="flex flex-col justify-center" data-aos="fade-left" data-aos-delay="200">
                    @if ($featuredArticle)
                        <h2 class="text-4xl font-bold mb-5 leading-tight text-gray-900">
                            {{ $featuredArticle->title }}
                        </h2>
                        <p class="text-gray-700 mb-2 leading-relaxed text-lg">
                            {{ Str::limit($featuredArticle->content, 300) }}
                        </p>
                        <p class="text-sm text-gray-500 mb-6">
                            {{ $featuredArticle->published_at->diffForHumans() }}
                        </p>
                        <a href="{{ route('article', $featuredArticle->slug) }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 w-max inline-block text-center">
                            Read Full Story →
                        </a>
                    @else
                        <h2 class="text-4xl font-bold mb-5 leading-tight text-gray-900">
                            Breaking: Major Policy Shift Shakes Global Markets
                        </h2>
                        <p class="text-gray-700 mb-2 leading-relaxed text-lg">
                            In an unprecedented move, world markets witnessed a dramatic shift after the signing of a new international
                            trade policy today. Financial experts predict wide-reaching consequences across industries, with both
                            emerging and developed economies bracing for adjustments. Investors are closely watching central bank
                            responses amid uncertainty.
                        </p>
                        <p class="text-sm text-gray-500 mb-6">
                            Today
                        </p>
                        <a href="{{ route('run.seed') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 w-max inline-flex items-center justify-center text-center" onclick="this.classList.add('bg-gray-400', 'cursor-not-allowed'); this.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'hover:scale-105'); this.innerHTML='<svg class=\'animate-spin -ml-1 mr-3 h-5 w-5 text-white\' xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\'><circle class=\'opacity-25\' cx=\'12\' cy=\'12\' r=\'10\' stroke=\'currentColor\' stroke-width=\'4\'></circle><path class=\'opacity-75\' fill=\'currentColor\' d=\'M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z\'></path></svg>Loading...'; this.style.pointerEvents='none';">
                            <code class="font-mono bg-blue-700/30 px-2 py-1 rounded text-sm">php artisan db:seed</code>
                        </a>
                    @endif
                </div>
            </div>
        </section>
    @endsection
    @section('sticky')
        <section class="max-w-7xl mx-auto px-4 py-16 flex flex-col md:flex-row md:items-start md:space-x-10">
            <div class="flex-1 border-t border-gray-100 mb-10 md:mb-0" x-data="{ selected: null }">
                <div class="group flex items-center pb-2 mb-10" data-aos="fade-up">
                    <div class="w-6 border-t-4 border-stone-600 group-hover:border-stone-400 transition-all duration-2000 ease-in-out"></div>
                    <h2 class="text-3xl font-bold text-gray-900 uppercase mx-2 text-foreground group-hover:text-accent-category transition-colors duration-500 ease-in-out leading-tight">
                        Latest Headlines
                    </h2>
                    <div class="flex-grow h-1 bg-gradient-to-r from-stone-400 to-stone-600 group-hover:from-stone-600 group-hover:to-stone-400 transition-all duration-2000 ease-in-out"></div>
                </div>

                <div class="flex flex-wrap -mx-4">
                    @foreach ($news as $index => $newsItem)
                        <div class="w-full sm:w-1/2 px-4 mb-8">
                            <div class="bg-white rounded-2xl shadow transition-all duration-500 cursor-pointer overflow-hidden transform hover:-translate-y-1" :class="selected === {{ $index }} ?
                                'ring-4 ring-blue-400 shadow-xl scale-[1.02]' :
                                'hover:shadow-lg h-[25.62rem]'" @click="selected === {{ $index }} ? selected = null : selected = {{ $index }}" x-transition>
                                <img src="{{ asset($newsItem->image) }}" class="w-full aspect-video object-cover">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="font-semibold text-xl text-gray-900">{{ $newsItem->title }}</h3>
                                        <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full flex-shrink-0 ml-3">
                                            {{ $featuredArticle->published_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <p class="text-gray-600 line-clamp-3" x-show="selected !== {{ $index }}">
                                        {{ $newsItem->content }}
                                    </p>

                                    <div x-show="selected === {{ $index }}" x-transition>
                                        <p class="text-gray-700 mt-3 leading-relaxed">
                                            {{ $newsItem->content }} Read more insights from experts worldwide
                                            on how these trends redefine the global landscape.
                                        </p>
                                        <a href="{{ route('article', $newsItem->slug) }}" class="inline-block mt-4 text-blue-600 font-semibold hover:underline transition-colors duration-200">
                                            Continue Reading →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="text-center mt-12" data-aos="fade-up">
                    <a href="{{ route('articles') }}" class="inline-flex items-center bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        View More Articles
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <aside class="w-full md:w-1/3 border-t border-gray-100 md:pl-4 md:sticky mt-10 md:mt-0 md:top-24 self-start h-[38rem]">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-3xl font-bold text-gray-900" data-aos="fade-up">
                        You Might Also Like
                    </h2>
                    <div class="flex items-center gap-2">
                        <button id="prevRandomNews" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed" title="Previous articles">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button id="nextRandomNews" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors duration-200" title="Next articles">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                </div>

                @if ($randomNews->count() > 0)
                    <div id="random-news-container" class="flex flex-col gap-6">
                        @foreach ($randomNews as $randomItem)
                            <a href="{{ route('article', $randomItem->slug) }}" class="bg-white rounded-xl shadow hover:shadow-lg transition-all duration-300 overflow-hidden flex items-start gap-4 p-4 cursor-pointer hover:-translate-y-1">
                                <div class="flex-shrink-0 w-28 h-20 overflow-hidden rounded-md">
                                    <img src="{{ asset($randomItem->image) }}" alt="{{ $randomItem->title }}" class="w-full h-full object-cover">
                                </div>

                                <div class="flex flex-col justify-between flex-1">
                                    <div>
                                        <h3 class="font-semibold text-base text-gray-900 leading-tight mb-1 line-clamp-2">
                                            {{ $randomItem->title }}
                                        </h3>
                                        <p class="text-gray-600 text-sm line-clamp-2">
                                            {{ Str::limit($randomItem->content, 80) }}
                                        </p>
                                    </div>

                                    <div class="mt-2 flex items-center justify-between text-xs text-gray-500">
                                        <span class="bg-gray-100 px-2 py-1 rounded-full">
                                            {{ $featuredArticle->published_at->diffForHumans() }}
                                        </span>
                                        <span class="text-blue-600 font-medium hover:underline">
                                            Read →
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center p-8 bg-gray-50 rounded-2xl shadow-inner text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-16 h-16 flex items-center justify-center bg-gray-200 text-gray-500 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.007v.008H12v-.008zm9-3.75a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-1">No Related Articles</h3>
                        <p class="text-gray-500 text-sm max-w-xs">
                            We couldn’t find any related stories at the moment. Check back soon for more updates.
                        </p>
                    </div>
                @endif
            </aside>
        </section>
    @endsection
    @section('content-bottom')
        <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-20 mt-16 text-center text-white" data-aos="fade-up">
            <div class="max-w-4xl mx-auto px-6">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Stay Informed. Stay Ahead.</h2>
                <p class="text-blue-100 text-lg mb-6">
                    Subscribe to DailyTimes and get breaking news alerts, in-depth features, and editorial insights delivered straight to your inbox.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <form id="subscriptionForm" class="flex flex-col sm:flex-row gap-4 justify-center w-full">
                        @csrf
                        <input type="email" id="emailInput" name="email" placeholder="Enter your email address" class="px-4 py-3 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 outline-none w-full sm:w-96" required>
                        <button type="submit" id="subscribeBtn" class="bg-white text-blue-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                            Subscribe →
                        </button>
                    </form>
                </div>
                <div id="subscriptionMessage" class="mt-4 text-center hidden"></div>
            </div>
        </section>
    @endsection
</div>

@push('scripts')
    <script>
        let previousArticleIds = [];
        let newsHistory = [];
        let currentHistoryIndex = -1;
        let isNavigating = false;

        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prevRandomNews');
            const nextBtn = document.getElementById('nextRandomNews');
            
            if (prevBtn) {
                prevBtn.disabled = currentHistoryIndex <= 0;
            }
            if (nextBtn) {
                nextBtn.disabled = currentHistoryIndex >= newsHistory.length - 1;
            }
        }

        function addToHistory(newsData) {
            if (currentHistoryIndex < newsHistory.length - 1) {
                newsHistory = newsHistory.slice(0, currentHistoryIndex + 1);
            }
            
            newsHistory.push(newsData);
            currentHistoryIndex = newsHistory.length - 1;
            
            if (newsHistory.length > 10) {
                newsHistory.shift();
                currentHistoryIndex--;
            }
            
            updateNavigationButtons();
        }

        function navigateToHistory(index) {
            if (index < 0 || index >= newsHistory.length || isNavigating) return;
            
            isNavigating = true;
            currentHistoryIndex = index;
            const newsData = newsHistory[index];
            
            displayNewsData(newsData, false);
            updateNavigationButtons();
            
            setTimeout(() => {
                isNavigating = false;
            }, 500);
        }

        function displayNewsData(data, addToHistoryFlag = true) {
            const container = document.getElementById('random-news-container');
            if (!container || !data || data.length === 0) return;

            if (addToHistoryFlag) {
                addToHistory(data);
            }

            container.style.opacity = '0';
            container.style.transform = 'translateY(10px)';
            container.style.transition = 'all 0.4s ease-in-out';

            setTimeout(() => {
                container.innerHTML = '';

                data.forEach((article, index) => {
                    const articleElement = document.createElement('a');
                    articleElement.href = `/article/${article.slug}`;
                    articleElement.className = 'bg-white rounded-xl shadow hover:shadow-lg transition-all duration-300 overflow-hidden flex items-start gap-4 p-4 cursor-pointer hover:-translate-y-1';
                    let image = "{{ asset('') }}" + (article.image ? article.image : 'img/default.png');

                    articleElement.style.opacity = '0';
                    articleElement.style.transform = 'translateY(20px)';
                    articleElement.style.transition = 'all 0.5s ease-out';

                    articleElement.innerHTML = `
                        <div class="flex-shrink-0 w-28 h-20 overflow-hidden rounded-md">
                            <img src="${image}" alt="${article.title}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex flex-col justify-between flex-1">
                            <div>
                                <h3 class="font-semibold text-base text-gray-900 leading-tight mb-1 line-clamp-2">
                                    ${article.title}
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2">
                                    ${article.content.substring(0, 80)}${article.content.length > 80 ? '...' : ''}
                                </p>
                            </div>

                            <div class="mt-2 flex items-center justify-between text-xs text-gray-500">
                                <span class="bg-gray-100 px-2 py-1 rounded-full">
                                    ${article.published_at_human}
                                </span>
                                <span class="text-blue-600 font-medium hover:underline">
                                    Read →
                                </span>
                            </div>
                        </div>
                    `;

                    container.appendChild(articleElement);

                    setTimeout(() => {
                        articleElement.style.opacity = '1';
                        articleElement.style.transform = 'translateY(0)';
                    }, 100 + (index * 150));
                });

                setTimeout(() => {
                    container.style.opacity = '1';
                    container.style.transform = 'translateY(0)';
                }, 200);

            }, 300);
        }

        function refreshRandomNews() {
            if (isNavigating) return;
            
            let url = '/api/random-news';
            if (previousArticleIds.length > 0) {
                url += '?exclude=' + previousArticleIds.join(',');
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        previousArticleIds = data.map(article => article.id);
                        displayNewsData(data, true);
                    }
                })
                .catch(error => {
                    console.error('Error fetching random news:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const prevBtn = document.getElementById('prevRandomNews');
            const nextBtn = document.getElementById('nextRandomNews');
            
            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    navigateToHistory(currentHistoryIndex - 1);
                });
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    navigateToHistory(currentHistoryIndex + 1);
                });
            }
            
            const container = document.getElementById('random-news-container');
            if (container && container.children.length > 0) {
                fetch('/api/random-news')
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            addToHistory(data);
                            previousArticleIds = data.map(article => article.id);
                        }
                    })
                    .catch(error => {
                        console.error('Error initializing random news history:', error);
                    });
            }
        });

        setInterval(refreshRandomNews, 5000);

        function refreshRandomNewsWithIndicator() {
            const container = document.getElementById('random-news-container');
            if (container) {
                container.style.opacity = '0.7';
                container.style.transition = 'opacity 0.3s ease';

                refreshRandomNews();

                setTimeout(() => {
                    container.style.opacity = '1';
                }, 500);
            }
        }

        setInterval(refreshRandomNewsWithIndicator, 60000);

        document.getElementById('subscriptionForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const emailInput = document.getElementById('emailInput');
            const subscribeBtn = document.getElementById('subscribeBtn');
            const messageDiv = document.getElementById('subscriptionMessage');

            subscribeBtn.disabled = true;
            subscribeBtn.innerHTML = 'Subscribing...';

            const formData = new FormData(form);

            fetch('{{ route('subscribe') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    messageDiv.classList.remove('hidden');

                    if (data.success) {
                        messageDiv.className = 'mt-4 text-center text-green-200 bg-green-600 bg-opacity-20 px-4 py-2 rounded-lg';
                        messageDiv.textContent = data.message;
                        form.reset();
                    } else {
                        messageDiv.className = 'mt-4 text-center text-red-200 bg-red-600 bg-opacity-20 px-4 py-2 rounded-lg';
                        messageDiv.textContent = data.message;
                    }

                    setTimeout(() => {
                        messageDiv.classList.add('hidden');
                    }, 5000);
                })
                .catch(error => {
                    messageDiv.classList.remove('hidden');
                    messageDiv.className = 'mt-4 text-center text-red-200 bg-red-600 bg-opacity-20 px-4 py-2 rounded-lg';
                    messageDiv.textContent = 'Something went wrong. Please try again later.';
                })
                .finally(() => {
                    subscribeBtn.disabled = false;
                    subscribeBtn.innerHTML = 'Subscribe →';
                });
        });
    </script>
@endpush
