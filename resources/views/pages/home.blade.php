@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="overflow-x-hidden">
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
                        <p class="text-gray-700 mb-6 leading-relaxed text-lg">
                            {{ Str::limit($featuredArticle->content, 300) }}
                        </p>
                        <a href="{{ route('article', $featuredArticle->slug) }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 w-max inline-block text-center">
                            Read Full Story →
                        </a>
                    @else
                        <h2 class="text-4xl font-bold mb-5 leading-tight text-gray-900">
                            Breaking: Major Policy Shift Shakes Global Markets
                        </h2>
                        <p class="text-gray-700 mb-6 leading-relaxed text-lg">
                            In an unprecedented move, world markets witnessed a dramatic shift after the signing of a new international
                            trade policy today. Financial experts predict wide-reaching consequences across industries, with both
                            emerging and developed economies bracing for adjustments. Investors are closely watching central bank
                            responses amid uncertainty.
                        </p>
                        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition transform hover:scale-105 w-max">
                            Read Full Story →
                        </button>
                    @endif
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 py-16 flex flex-col md:flex-row md:items-start md:space-x-10">
            <div class="flex-1 border-t border-gray-100 mb-10 md:mb-0" x-data="{ selected: null }">
                <h2 class="text-3xl font-bold mb-10 text-gray-900" data-aos="fade-up">
                    Latest Headlines
                </h2>

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
                                            {{ $newsItem->read_minutes }} min read
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
            </div>

            <aside class="w-full md:w-1/3 border-t border-gray-100 md:pl-4 md:sticky md:top-24 self-start">
                <h2 class="text-3xl font-bold mb-10 text-gray-900" data-aos="fade-up">
                    You Might Also Like
                </h2>

                @if ($randomNews->count() > 0)
                    <div id="random-news-container" class="flex flex-col gap-6">
                        @foreach ($randomNews as $randomItem)
                            <a href="{{ route('article', $randomItem->slug) }}" class="bg-white rounded-xl shadow hover:shadow-lg transition-all duration-300 overflow-hidden flex items-start gap-4 p-4 cursor-pointer hover:-translate-y-1">
                                <!-- Thumbnail -->
                                <div class="flex-shrink-0 w-28 h-20 overflow-hidden rounded-md">
                                    <img src="{{ asset($randomItem->image) }}" alt="{{ $randomItem->title }}" class="w-full h-full object-cover">
                                </div>

                                <!-- Text -->
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
                                            {{ $randomItem->read_minutes }} min read
                                        </span>
                                        <span class="text-blue-600 font-medium hover:underline">
                                            Read →
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </aside>
        </section>

        <section class="bg-gradient-to-r from-blue-600 to-blue-800 py-20 mt-16 text-center text-white" data-aos="fade-up">
            <div class="max-w-4xl mx-auto px-6">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Stay Informed. Stay Ahead.</h2>
                <p class="text-blue-100 text-lg mb-6">
                    Subscribe to DailyTimes and get breaking news alerts, in-depth features, and editorial insights delivered straight to your inbox.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <input type="email" placeholder="Enter your email address" class="px-4 py-3 rounded-lg text-gray-800 focus:ring-2 focus:ring-blue-400 outline-none w-full sm:w-96">
                    <button class="bg-white text-blue-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                        Subscribe →
                    </button>
                </div>
            </div>
        </section>
    </div>

    <script>
        let previousArticleIds = [];

        function refreshRandomNews() {
            let url = '/api/random-news';
            if (previousArticleIds.length > 0) {
                url += '?exclude=' + previousArticleIds.join(',');
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('random-news-container');
                    if (container && data.length > 0) {
                        previousArticleIds = data.map(article => article.id);
                        
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
                                    <!-- Thumbnail -->
                                    <div class="flex-shrink-0 w-28 h-20 overflow-hidden rounded-md">
                                        <img src="${image}" alt="${article.title}" class="w-full h-full object-cover">
                                    </div>

                                    <!-- Text -->
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
                                                ${article.read_minutes} min read
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
                                }, 100 + (index * 150)); // Stagger animation by 150ms per item
                            });
                            
                            setTimeout(() => {
                                container.style.opacity = '1';
                                container.style.transform = 'translateY(0)';
                            }, 200);
                            
                        }, 300);
                    }
                })
                .catch(error => {
                    console.error('Error fetching random news:', error);
                });
        }

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
    </script>
@endsection
