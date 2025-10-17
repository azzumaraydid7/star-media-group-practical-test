@extends('layouts.app')

@section('title', 'About & Contact')

@section('content')
<div class="overflow-x-hidden">
    <section class="relative bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white py-16 md:py-24 w-full overflow-hidden">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">About <span class="text-blue-400">DailyTimes</span></h1>
            <p class="text-gray-300 max-w-2xl mx-auto text-lg">
                Trusted journalism, modern perspective — delivering stories that matter since 1999.
            </p>
        </div>
        <div class="absolute inset-0 opacity-10 bg-[url('{{ asset('img/news_pattern.png') }}')] bg-cover bg-center"></div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-20">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div class="aspect-video" data-aos="zoom-in" data-aos-duration="1000">
                <img src="{{ asset('img/DailyTimes_Newsroom_Dusk_Vibe.png') }}" alt="Our newsroom" class="rounded-2xl shadow-lg object-cover w-full h-full">
            </div>
            <div data-aos="fade-left" data-aos-duration="1000">
                <h2 class="text-3xl font-bold mb-4">Our Story</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Founded in 1999, <strong>DailyTimes</strong> started as a small community bulletin and evolved into a global digital news platform.
                    Our core mission has always been to inform, educate, and inspire readers through accurate journalism.
                </p>
                <p class="text-gray-700 leading-relaxed mb-4">
                    From politics to culture, our diverse newsroom blends traditional reporting with modern storytelling.
                    With correspondents in multiple regions, we ensure our readers stay ahead of the latest developments across the world.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Every article is crafted with precision, verified facts, and human insight — because we believe truth builds trust.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-10" data-aos="fade-up">Our Mission & Values</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-50 rounded-2xl shadow hover:shadow-md transition transform hover:-translate-y-1" data-aos="fade-right" data-aos-delay="100">
                    <h3 class="text-xl font-semibold mb-3 text-blue-600">Integrity</h3>
                    <p class="text-gray-700 text-sm">We uphold the highest standards of journalism — factual reporting, balanced viewpoints, and complete transparency in every story.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl shadow hover:shadow-md transition transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-semibold mb-3 text-blue-600">Innovation</h3>
                    <p class="text-gray-700 text-sm">Leveraging data analytics, multimedia storytelling, and emerging tech, we bring news to life for the digital generation.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl shadow hover:shadow-md transition transform hover:-translate-y-1" data-aos="fade-left" data-aos-delay="300">
                    <h3 class="text-xl font-semibold mb-3 text-blue-600">Community</h3>
                    <p class="text-gray-700 text-sm">We believe in giving back. Through partnerships and outreach programs, DailyTimes amplifies local voices and supports public education.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-20">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div data-aos="fade-right" data-aos-duration="1000">
                <h2 class="text-3xl font-bold mb-4">Our Vision for the Future</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    As journalism evolves, so do we. Our vision is to be the most trusted, innovative, and inclusive news platform in the digital era.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    We’re expanding our presence across multiple platforms — from podcasts and newsletters to AI-driven insights — ensuring that credible journalism remains accessible to all.
                </p>
            </div>
            <div class="aspect-video" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('img/Media_Evolution_AI_Journalism.png') }}" alt="Future newsroom" class="rounded-2xl shadow-lg object-cover w-full h-full">
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-20 border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-3">Contact Us</h2>
                <p class="text-gray-600">We’d love to hear from you. Reach out for media inquiries, partnerships, or general feedback.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-10">
                <div data-aos="fade-right">
                    <form class="bg-white p-8 rounded-2xl shadow-md space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" id="name" class="w-full p-3 h-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" class="w-full p-3 h-10 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea id="message" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition w-full">
                            Send Message
                        </button>
                    </form>
                </div>

                <div class="flex flex-col justify-center" data-aos="fade-left">
                    <h3 class="text-xl font-semibold mb-2">Reach Us Directly</h3>
                    <p class="text-gray-700 mb-3">📧 info@dailytimes.com</p>
                    <p class="text-gray-700 mb-3">📍 123 Media Avenue, Kuala Lumpur, Malaysia</p>
                    <p class="text-gray-700 mb-3">☎️ +60 3-4567 8901</p>
                    <p class="text-gray-600 text-sm mt-4">Business Hours: Monday – Friday, 9:00 AM – 6:00 PM</p>
                    <div class="mt-6 flex space-x-4">
                        <a href="#" class="text-blue-600 hover:text-blue-800 transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-blue-400 hover:text-blue-600 transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-pink-600 hover:text-pink-800 transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-800 hover:text-black transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
