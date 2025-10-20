@extends('layouts.app')

@section('title', 'Advertise With Us')

@section('content')
<div class="overflow-x-hidden">
    <section class="relative bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white py-16 md:py-24 w-full overflow-hidden">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Advertise With <span class="text-blue-400">DailyTimes</span></h1>
            <p class="text-blue-100 max-w-2xl mx-auto text-lg">
                Reach millions of engaged readers with our premium advertising solutions and targeted campaigns.
            </p>
        </div>
        <div class="absolute inset-0 opacity-15 bg-[url('{{ asset('img/news_pattern.png') }}')] bg-cover bg-center"></div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-20">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4">Why Choose DailyTimes?</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">
                Partner with a trusted news platform that delivers quality content to an engaged, diverse audience across multiple demographics and interests.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-20">
            <div class="text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">2M+ Monthly Readers</h3>
                <p class="text-gray-600">Reach a vast audience of engaged readers who trust our content and value quality journalism.</p>
            </div>
            <div class="text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-chart-line text-2xl text-green-600"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">High Engagement</h3>
                <p class="text-gray-600">Our readers spend an average of 4+ minutes per article, ensuring your ads get quality attention.</p>
            </div>
            <div class="text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-target text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Targeted Reach</h3>
                <p class="text-gray-600">Advanced targeting options to reach your ideal audience based on interests, demographics, and behavior.</p>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">Advertising Packages</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Choose from our flexible advertising solutions designed to meet your marketing goals and budget.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Basic Package -->
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-2">Basic</h3>
                        <div class="text-4xl font-bold text-blue-600 mb-2">RM 299</div>
                        <p class="text-gray-500">per month</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Banner ads on homepage</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>50,000 monthly impressions</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Basic analytics reporting</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Email support</span>
                        </li>
                    </ul>
                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        Get Started
                    </button>
                </div>

                <!-- Professional Package -->
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition border-2 border-blue-500 relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</span>
                    </div>
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-2">Professional</h3>
                        <div class="text-4xl font-bold text-blue-600 mb-2">RM 599</div>
                        <p class="text-gray-500">per month</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Premium ad placements</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>150,000 monthly impressions</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Advanced targeting options</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Detailed analytics & insights</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Priority support</span>
                        </li>
                    </ul>
                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        Get Started
                    </button>
                </div>

                <!-- Enterprise Package -->
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-2">Enterprise</h3>
                        <div class="text-4xl font-bold text-blue-600 mb-2">RM 1,299</div>
                        <p class="text-gray-500">per month</p>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Premium + sponsored content</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>500,000+ monthly impressions</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Custom ad formats</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Dedicated account manager</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>24/7 premium support</span>
                        </li>
                    </ul>
                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        Contact Sales
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold mb-6">Ready to Get Started?</h2>
                    <p class="text-gray-600 mb-8 text-lg">
                        Join hundreds of successful brands that trust DailyTimes to deliver their message to the right audience. 
                        Our advertising solutions are designed to maximize your ROI and build lasting connections with your customers.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-600 mr-4"></i>
                            <span class="text-lg">+60 123-456789</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-600 mr-4"></i>
                            <span class="text-lg">advertising@dailytimes.com</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-blue-600 mr-4"></i>
                            <span class="text-lg">Mon-Fri, 9AM-6PM MYT</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg" data-aos="fade-left">
                    <h3 class="text-2xl font-bold mb-6">Contact Our Sales Team</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Your company name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="your@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="+60 123-456789">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Advertising Budget</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option>Under RM 500/month</option>
                                <option>RM 500 - RM 1,000/month</option>
                                <option>RM 1,000 - RM 5,000/month</option>
                                <option>RM 5,000+ /month</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tell us about your advertising goals..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });
</script>
@endsection