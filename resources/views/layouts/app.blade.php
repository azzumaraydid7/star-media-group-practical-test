<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'My Site')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .consent-overlay {
            z-index: 9999;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => AOS.init({ duration: 800, once: true }));
    </script>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-gray-800">
                    <span class="text-blue-600">Daily</span>Times
                </a>
                
                <nav class="hidden md:flex space-x-6 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:underline">Home</a>
                    <a href="{{ route('about') }}" class="hover:underline">About / Contact</a>
                    <a href="{{ route('privacy') }}" class="hover:underline">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:underline">Terms & Conditions</a>
                    @if (auth()->guest())
                        <a href="{{ route('login') }}" class="hover:underline">Login</a>
                    @else
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:underline">Logout</button>
                        </form>
                    @endif
                </nav>

                <button id="mobile-menu-button" class="md:hidden p-2 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
            
            <nav id="mobile-menu" class="fixed top-0 right-0 h-full w-80 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 md:hidden">
                <div class="flex flex-col h-full">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Menu</h3>
                        <button id="mobile-menu-close" class="p-2 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="flex flex-col space-y-1 p-4 flex-1">
                        <a href="{{ route('home') }}" class="px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Home</a>
                        <a href="{{ route('about') }}" class="px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">About / Contact</a>
                        <a href="{{ route('privacy') }}" class="px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Privacy Policy</a>
                        <a href="{{ route('terms') }}" class="px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Terms & Conditions</a>
                        @if (auth()->guest())
                            <a href="{{ route('login') }}" class="px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Login</a>
                        @else
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Logout</button>
                            </form>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="mx-auto">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 py-8 grid md:grid-cols-3 gap-8">
            <div>
                <h3 class="font-semibold mb-3 text-white">About DailyTimes</h3>
                <p class="text-sm">
                    Delivering trusted news and insights since 1999. Stay informed with the latest stories that matter most to you.
                </p>
            </div>
            <div>
                <h3 class="font-semibold mb-3 text-white">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Advertise</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-3 text-white">Follow Us</h3>
                <div class="flex space-x-4 text-lg">
                    <a href="#" class="hover:text-blue-400">🌐</a>
                    <a href="#" class="hover:text-blue-400">🐦</a>
                    <a href="#" class="hover:text-blue-400">📷</a>
                </div>
            </div>
        </div>
        <div class="text-center text-sm border-t border-gray-700 py-3">
            © 2025 DailyTimes. All rights reserved.
        </div>
    </footer>

    @include('partials.consent-modal')

    <script>
        window.Laravel = {
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };

        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            
            function openMobileMenu() {
                mobileMenuOverlay.classList.remove('hidden');
                mobileMenu.classList.remove('translate-x-full');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            }
            
            function closeMobileMenu() {
                mobileMenu.classList.add('translate-x-full');
                mobileMenuOverlay.classList.add('hidden');
                document.body.style.overflow = ''; // Restore scrolling
            }
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', openMobileMenu);
            }
            
            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', closeMobileMenu);
            }
            
            if (mobileMenuOverlay) {
                mobileMenuOverlay.addEventListener('click', closeMobileMenu);
            }
            
            // Close menu when clicking on navigation links
            const mobileMenuLinks = mobileMenu.querySelectorAll('a, button[type="submit"]');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
        });

        (function() {
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
                return null;
            }

            function shouldShowConsent() {
                const accepted = getCookie('site_consent');
                const declined = getCookie('site_consent_declined');
                return !accepted && !declined;
            }

            document.addEventListener('DOMContentLoaded', function() {
                const show = shouldShowConsent();
                window.dispatchEvent(new CustomEvent('consent:init', {
                    detail: {
                        show
                    }
                }));
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
