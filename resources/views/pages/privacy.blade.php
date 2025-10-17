@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    <section class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white py-20 mb-12">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4" data-aos="fade-up">Privacy Policy</h1>
            <p class="text-gray-300 max-w-2xl mx-auto text-lg" data-aos="fade-up" data-aos-delay="100">
                Your privacy matters to us. This page explains how <span class="text-blue-400 font-semibold">DailyTimes</span> collects, uses, and protects your personal information.
            </p>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-6 pb-20">
        <div class="space-y-12 leading-relaxed">

            <div data-aos="fade-up">
                <h2 class="text-2xl font-semibold mb-3">1. Introduction</h2>
                <p class="text-gray-700">
                    At <strong>DailyTimes</strong>, we are committed to protecting your privacy and ensuring that your personal information is handled responsibly. 
                    This Privacy Policy outlines how we collect, use, store, and disclose your information when you access our website or engage with our services.
                </p>
            </div>

            <div data-aos="fade-up" data-aos-delay="100">
                <h2 class="text-2xl font-semibold mb-3">2. Information We Collect</h2>
                <p class="text-gray-700 mb-2">We may collect the following types of information:</p>
                <ul class="list-disc pl-6 text-gray-700 space-y-1">
                    <li>Personal details such as your name and email address when you subscribe or contact us.</li>
                    <li>Usage data, including pages visited, time spent, and browser information.</li>
                    <li>Cookies and similar technologies for improving your browsing experience.</li>
                </ul>
            </div>

            <div data-aos="fade-up" data-aos-delay="200">
                <h2 class="text-2xl font-semibold mb-3">3. How We Use Your Information</h2>
                <p class="text-gray-700">
                    Your data helps us provide a better reading experience and improve our services. Specifically, we use your information to:
                </p>
                <ul class="list-disc pl-6 text-gray-700 space-y-1 mt-2">
                    <li>Deliver personalized news and content recommendations.</li>
                    <li>Respond to your inquiries and feedback.</li>
                    <li>Analyze site performance and audience trends.</li>
                    <li>Send occasional newsletters or announcements (only with your consent).</li>
                </ul>
            </div>

            <div data-aos="fade-up" data-aos-delay="300">
                <h2 class="text-2xl font-semibold mb-3">4. Data Protection & Security</h2>
                <p class="text-gray-700">
                    We employ strict technical and organizational measures to protect your data against unauthorized access, loss, or misuse. 
                    While we strive for complete security, please understand that no online platform can be entirely risk-free.
                </p>
            </div>

            <div data-aos="fade-up" data-aos-delay="400">
                <h2 class="text-2xl font-semibold mb-3">5. Your Rights</h2>
                <p class="text-gray-700 mb-2">You have the right to:</p>
                <ul class="list-disc pl-6 text-gray-700 space-y-1">
                    <li>Request access, correction, or deletion of your personal data.</li>
                    <li>Withdraw consent to data processing at any time.</li>
                    <li>Opt out of newsletters and marketing communications.</li>
                </ul>
            </div>

            <div data-aos="fade-up" data-aos-delay="500">
                <h2 class="text-2xl font-semibold mb-3">6. Third-Party Services</h2>
                <p class="text-gray-700">
                    Our website may include links to third-party sites or services (such as social media or analytics tools). 
                    These third parties operate under their own privacy policies, which we encourage you to review.
                </p>
            </div>

            <div data-aos="fade-up" data-aos-delay="600">
                <h2 class="text-2xl font-semibold mb-3">7. Updates to This Policy</h2>
                <p class="text-gray-700">
                    We may update this Privacy Policy from time to time to reflect legal, technical, or business developments. 
                    Updates will be posted on this page with the revised effective date.
                </p>
            </div>

            <div data-aos="fade-up" data-aos-delay="700">
                <h2 class="text-2xl font-semibold mb-3">8. Contact Us</h2>
                <p class="text-gray-700">
                    If you have any questions or concerns about our Privacy Policy, please contact us at:
                </p>
                <p class="mt-2 text-gray-700">
                    📧 <a href="mailto:privacy@dailytimes.com" class="text-blue-600 hover:underline">privacy@dailytimes.com</a><br>
                    📍 DailyTimes HQ, 123 Media Avenue, Kuala Lumpur, Malaysia
                </p>
            </div>
        </div>
    </section>
@endsection
