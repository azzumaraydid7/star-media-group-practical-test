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
        <div class="grid md:grid-cols-3 gap-8">
            <template x-for="(news, index) in [
            { 
                id: 1, 
                title: 'AI Revolution in Education', 
                image: '{{ asset('img/Future_AI_Classroom_Learning.png') }}', 
                content: 'Artificial intelligence is redefining how students learn — from personalized lessons to instant language translation. Schools are adopting AI tutors and automated grading systems, enhancing accessibility and inclusivity worldwide.'
            },
            { 
                id: 2, 
                title: 'Climate Change Impact Intensifies', 
                image: '{{ asset('img/Climate_Apocalypse_Tree_Desolation.png') }}', 
                content: 'Rising sea levels, prolonged droughts, and catastrophic floods signal an alarming acceleration in climate change. Experts call for urgent, unified action before global temperature thresholds are irreversibly crossed.'
            },
            { 
                id: 3, 
                title: 'Tech Giants Face New Regulations', 
                image: '{{ asset('img/Tech_Regulation_Clash_Art.png') }}', 
                content: 'Governments worldwide are tightening control over major tech corporations. New regulations focus on user data protection, monopolistic behavior, and algorithmic transparency to ensure fair competition and privacy.'
            },
            { 
                id: 4, 
                title: 'Local Startups Thriving Post-Pandemic', 
                image: '{{ asset('img/Post_Pandemic_Street_Revival.png') }}', 
                content: 'Entrepreneurs across Asia report renewed investor interest as local economies rebound. Hybrid work models and digital adoption have accelerated innovation in small businesses, sparking a new wave of regional growth.'
            },
            { 
                id: 5, 
                title: 'Sports Events Return with Energy', 
                image: '{{ asset('img/Goal_Celebration_Stadium_Triumph.png') }}', 
                content: 'After years of restrictions, stadiums roar again as fans return to cheer live matches. Sports leagues are experiencing record attendance and engagement both onsite and through streaming platforms.'
            },
            { 
                id: 6, 
                title: 'Global Art Scene Reawakens', 
                image: '{{ asset('img/Art_Reborn_Cosmic_Explosion.png') }}', 
                content: 'Museums and galleries reopen, hosting international exhibitions that highlight resilience and creativity. Artists worldwide are reimagining post-pandemic expression through immersive and digital mediums.'
            }
        ]">
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition cursor-pointer overflow-hidden transform hover:-translate-y-1" data-aos="zoom-in-up" @click="selected === index ? selected = null : selected = index">
                    <img :src="news.image" class="w-full aspect-video object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-xl mb-3 text-gray-900" x-text="news.title"></h3>
                        <p class="text-gray-600 line-clamp-3" x-show="selected !== index" x-text="news.content"></p>
                        <div x-show="selected === index" x-collapse>
                            <p class="text-gray-700 mt-3 leading-relaxed" x-text="news.content + ' Read more insights from experts worldwide on how these trends will redefine the global landscape over the next decade.'"></p>
                            <button class="mt-4 text-blue-600 font-semibold hover:underline">Continue Reading →</button>
                        </div>
                    </div>
                </div>
            </template>
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
