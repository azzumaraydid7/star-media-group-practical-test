<style>
    .consent-modal-container {
        display: none;
    }
    .consent-modal-container.initialized {
        display: flex;
    }
    [x-cloak] { display: none !important; }
</style>

<div x-data="consentModal()" 
     x-show="visible" 
     x-cloak 
     :class="{ 'initialized': initialized }"
     class="consent-modal-container fixed inset-0 items-center justify-center px-4 consent-overlay">
    <div x-show="visible" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

    <div x-show="visible" x-transition @keydown.escape.window="decline()" class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 z-50">
        <h3 class="text-lg font-semibold mb-2">Privacy & Cookies</h3>
        <p class="text-sm text-gray-700 mb-4">
            Cookies are necessary for this website to function properly, for performance measurement, and to provide you with the best experience.
        </p>
        <p class="text-sm text-gray-700 mb-4">
            By continuing to access or use this site, you acknowledge and consent to our use of cookies in accordance with our
            <a href="{{ route('terms') }}" class="underline">Terms & Conditions</a> and
            <a href="{{ route('privacy') }}" class="underline">Privacy Statement</a>.
        </p>

        <div class="flex items-center space-x-3 justify-end">
            <button type="button" @click="decline" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">Decline</button>
            <button type="button" @click="accept" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Accept</button>
        </div>
    </div>

    <script>
        function consentModal() {
            return {
                visible: false,
                initialized: false,
                loading: true,
                init() {
                    this.visible = false;
                    this.initialized = false;
                    this.loading = true;

                    window.addEventListener('consent:init', (e) => {
                        if (e.detail && e.detail.show) {
                            this.open();
                        }
                    });

                    requestAnimationFrame(() => {
                        this.initializeModalState();
                    });
                },
                async initializeModalState() {
                    try {
                        const accepted = document.cookie.split('; ').find(row => row.startsWith('site_consent='));
                        const declined = document.cookie.split('; ').find(row => row.startsWith('site_consent_declined='));

                        const shouldShow = await this.shouldShowModal(accepted, declined);
                        
                        this.loading = false;
                        this.initialized = true;
                        
                        if (shouldShow) {
                            requestAnimationFrame(() => {
                                requestAnimationFrame(() => {
                                    this.open();
                                });
                            });
                        }
                    } catch (error) {
                        console.error('Consent modal initialization error:', error);
                        this.loading = false;
                        this.initialized = true;
                    }
                },
                async shouldShowModal(acceptedCookie, declinedCookie) {
                    if (acceptedCookie) {
                        const isAcceptValid = await this.validateAcceptCookie(acceptedCookie);
                        if (isAcceptValid) {
                            return false;
                        }
                    }

                    return this.checkDeclineCookieExpiry(declinedCookie);
                },
                async validateAcceptCookie(acceptedCookie) {
                    try {
                        const cookieValue = acceptedCookie.split('=')[1];
                        if (!cookieValue) {
                            return false;
                        }

                        const decodedValue = decodeURIComponent(cookieValue);
                        const payload = JSON.parse(decodedValue);

                        if (!payload.guid || !payload.accepted_at || !payload.version) {
                            return false;
                        }

                        const response = await fetch("{{ route('consent.validate') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                            },
                            body: JSON.stringify({
                                guid: payload.guid,
                                accepted_at: payload.accepted_at,
                                version: payload.version
                            })
                        });

                        const result = await response.json();
                        return result.valid === true;

                    } catch (error) {
                        console.warn('Error validating accept cookie:', error);
                        return false;
                    }
                },

                checkDeclineCookieExpiry(declinedCookie) {
                    if (!declinedCookie) {
                        return true;
                    }

                    try {
                        const cookieValue = declinedCookie.split('=')[1];
                        if (!cookieValue) {
                            return true;
                        }

                        const decodedValue = decodeURIComponent(cookieValue);
                        const declineTimestamp = new Date(decodedValue);
                        
                        if (isNaN(declineTimestamp.getTime())) {
                            return true;
                        }

                        const expiryDate = new Date(declineTimestamp);
                        expiryDate.setDate(expiryDate.getDate() + 1);
                        
                        const now = new Date();
                        
                        return now >= expiryDate;
                        
                    } catch (error) {
                        console.warn('Error parsing decline cookie:', error);
                        return true;
                    }
                },
                open() {
                    this.visible = true;

                    document.documentElement.style.overflow = 'hidden';
                    document.body.style.overflow = 'hidden';
                },
                close() {
                    this.visible = false;
                    document.documentElement.style.overflow = '';
                    document.body.style.overflow = '';
                },
                accept() {
                    fetch("{{ route('consent.accept') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                            },
                            body: JSON.stringify({})
                        })
                        .then(r => r.json())
                        .then(json => {
                            if (json && json.guid) {
                                const payload = {
                                    guid: json.guid,
                                    accepted_at: json.accepted_at,
                                    version: json.version
                                };

                                const d = new Date();
                                d.setFullYear(d.getFullYear() + 1);
                                document.cookie = 'site_consent=' + encodeURIComponent(JSON.stringify(payload)) + '; path=/; expires=' + d.toUTCString() + '; SameSite=Lax';

                                this.close();
                            } else {
                                console.error('Consent accept: unexpected response', json);
                                this.close();
                            }
                        })
                        .catch(err => {
                            console.error('Consent accept error', err);
                            this.close();
                        });
                },
                decline() {
                    fetch("{{ route('consent.decline') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': window.Laravel.csrfToken
                            },
                            body: JSON.stringify({})
                        })
                        .then(r => r.json())
                        .then(json => {
                            const d = new Date();
                            d.setDate(d.getDate() + 1);
                            document.cookie = 'site_consent_declined=' + encodeURIComponent(json.timestamp || new Date().toISOString()) + '; path=/; expires=' + d.toUTCString() + '; SameSite=Lax';

                            this.close();
                        })
                        .catch(err => {
                            console.error('Consent decline error', err);
                            const d = new Date();
                            d.setDate(d.getDate() + 1);
                            document.cookie = 'site_consent_declined=' + encodeURIComponent(new Date().toISOString()) + '; path=/; expires=' + d.toUTCString() + '; SameSite=Lax';

                            this.close();
                        });
                }
            }
        }
    </script>
</div>