<div>
    <div class="flex items-center gap-4 overflow-hidden">
        <div class="items-center gap-2 shrink-0 pl-6 hidden md:flex">
            <span class="uppercase text-xs tracking-wider font-bold text-red-600 bg-red-100 px-2 py-1 rounded">
                Latest
            </span>
            <span class="font-semibold text-sm tracking-wide">
                Headlines
            </span>
        </div>
        <div class="overflow-x-hidden">
            <div class="animate-marquee flex whitespace-nowrap">
                <div class="flex">
                    @if (!empty($latestHeadlines) && $latestHeadlines->count() > 0)
                        @foreach ($latestHeadlines as $headline)
                            <a href="{{ route('article', $headline->slug) }}" class="mx-4 hover:text-blue-300 transition-colors">
                                <span class="px-2 py-1 bg-orange-400 text-stone-600 font-bold text-xs rounded mr-2">
                                    {{ $headline->category->name }}
                                </span>{{ $headline->title }}
                            </a>
                        @endforeach
                    @else
                        <span class="mx-4">🚀 Welcome to DailyTimes — Bringing you the latest updates every hour!</span>
                        <span class="mx-4">📰 Stay informed with real-time news and insights.</span>
                        <span class="mx-4">🌍 Global coverage. Local stories. Trusted reporting.</span>
                    @endif
                </div>

                <div class="flex" aria-hidden="true">
                    @if (!empty($latestHeadlines) && $latestHeadlines->count() > 0)
                        @foreach ($latestHeadlines as $headline)
                            <a href="{{ route('article', $headline->slug) }}" class="mx-4 hover:text-blue-300 transition-colors">
                                <span class="px-2 py-1 bg-orange-400 text-stone-600 font-bold text-xs rounded mr-2">
                                    {{ $headline->category->name }}
                                </span>{{ $headline->title }}
                            </a>
                        @endforeach
                    @else
                        <span class="mx-4">🚀 Welcome to DailyTimes — Bringing you the latest updates every hour!</span>
                        <span class="mx-4">📰 Stay informed with real-time news and insights.</span>
                        <span class="mx-4">🌍 Global coverage. Local stories. Trusted reporting.</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
