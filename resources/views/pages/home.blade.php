@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="overflow-x-hidden">
        <section class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div data-aos="fade-right">
                    <img src="{{ asset('img/3572927.jpg') }}" alt="Headline Image" class="rounded-2xl shadow-xl aspect-video object-cover">
                </div>
                <div class="flex flex-col justify-center" data-aos="fade-left" data-aos-delay="200">
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
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 py-16 border-t border-gray-100" x-data="{ selected: null }">
            <h2 class="text-3xl font-bold mb-10 text-gray-900" data-aos="fade-up">Latest Headlines</h2>
            <div x-data="{ selected: null }" class="grid md:grid-cols-3 gap-8">
                @foreach($news as $index => $newsItem)
                    <div class="bg-white rounded-2xl shadow transition-all duration-500 cursor-pointer overflow-hidden transform hover:-translate-y-1" :class="selected === {{ $index }} ?
                        'ring-4 ring-blue-400 shadow-xl scale-[1.02]' :
                        'hover:shadow-lg h-[25.62rem]'" @click="selected === {{ $index }} ? selected = null : selected = {{ $index }}" x-transition>
                        <img src="{{ asset($newsItem->image) }}" class="w-full aspect-video object-cover">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="font-semibold text-xl text-gray-900">{{ $newsItem->title }}</h3>
                                <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full flex-shrink-0 ml-3">{{ $newsItem->read_minutes }} min read</span>
                            </div>

                            <!-- Collapsed view -->
                            <p class="text-gray-600 line-clamp-3" x-show="selected !== {{ $index }}">{{ $newsItem->content }}</p>

                            <!-- Expanded content -->
                            <div x-show="selected === {{ $index }}">
                                <p class="text-gray-700 mt-3 leading-relaxed">{{ $newsItem->content }} Read more insights from experts worldwide on how these trends will redefine the global landscape over the next decade.
                                </p>
                                <a href="{{ route('article', $newsItem->slug) }}" class="inline-block mt-4 text-blue-600 font-semibold hover:underline transition-colors duration-200">
                                    Continue Reading →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
@endsection
