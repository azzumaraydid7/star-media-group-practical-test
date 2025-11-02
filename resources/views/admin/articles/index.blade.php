@extends('admin.layouts.app')

@section('title', 'Articles Management')

@section('header')
    <div class="flex justify-between items-center pt-16">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Articles Management</h2>
            <p class="text-gray-600">Manage your news articles</p>
        </div>
    </div>
@endsection

@section('content')
    <div x-data="articlesSearch()" x-init="init()">
        <div class="grid grid-cols-1 gap-4 sm:flex justify-between pb-4">
            <form method="GET" action="{{ route('admin.articles') }}" class="flex items-center gap-2 w-full max-w-xl" @submit.prevent="manualSubmit">
                <label for="q" class="sr-only">Search articles</label>
                <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="Search title or author" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" @input="onInput" />
                @if (request('q'))
                    <a href="{{ route('admin.articles') }}" class="px-3 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg" @click.prevent="clear">Clear</a>
                @endif

                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md" :disabled="loading" @click="loading = true; setTimeout(() => loading = false, 1000)">
                    <svg x-show="!loading"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="loading"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 animate-ping">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
            <a href="{{ route('admin.articles.create') }}" class="flex justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Article
            </a>
        </div>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">All Articles</h3>
                    <div class="text-sm text-gray-600">
                        Total: {{ $articles->total() }} articles
                    </div>
                </div>
            </div>

            <div id="articlesList" x-ref="list">
                @if ($articles->count() > 0)

                    {{-- Desktop Table --}}
                    <div class="overflow-x-auto hidden md:block">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Article
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($articles as $article)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if ($article->image && file_exists(public_path($article->image)))
                                                    <img class="h-10 w-10 rounded-lg object-cover mr-4" src="{{ asset($article->image) }}" alt="">
                                                @else
                                                    <div class="h-10 w-10 rounded-lg bg-gray-200 mr-4 flex items-center justify-center">
                                                        <i class="fas fa-image text-gray-400"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ Str::limit($article->title, 50) }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ Str::limit($article->excerpt, 60) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($article->is_featured)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Featured
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    Regular
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $article->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('article', $article->slug) }}" class="text-blue-600 hover:text-blue-900" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button onclick="deleteArticle({{ $article->id }})" class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile Card View --}}
                    <div class="md:hidden divide-y divide-gray-200">
                        @foreach ($articles as $article)
                            <div class="p-4 flex space-x-3">
                                {{-- Image --}}
                                @if ($article->image && file_exists(public_path($article->image)))
                                    <img class="h-16 w-16 rounded-lg object-cover" src="{{ asset($article->image) }}" alt="">
                                @else
                                    <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif

                                {{-- Content --}}
                                <div class="flex-1 space-y-1">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ Str::limit($article->title, 60) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ Str::limit($article->excerpt, 80) }}
                                    </div>

                                    {{-- Status + Date --}}
                                    <div class="flex items-center justify-between text-xs text-gray-500 mt-1">
                                        <span>
                                            @if ($article->is_featured)
                                                🌟 Featured
                                            @else
                                                📝 Regular
                                            @endif
                                        </span>
                                        <span>{{ $article->created_at->format('d M Y') }}</span>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex space-x-3 pt-2">
                                        <a href="{{ route('article', $article->slug) }}" target="_blank" class="text-blue-600 text-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-indigo-600 text-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="deleteArticle({{ $article->id }})" class="text-red-600 text-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $articles->links() }}
                    </div>
                @else
                    <div class="p-6 text-center">
                        <i class="fas fa-newspaper text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-500 mb-4">No articles found.</p>
                        <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Your First Article
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            function articlesSearch() {
                return {
                    q: (document.getElementById('q')?.value || '').trim(),
                    lastSubmittedQuery: (((document.getElementById('q')?.value || '').trim().length >= 5) ? (document.getElementById('q')?.value || '').trim() : ''),
                    loading: false,
                    debounceTimer: null,
                    init() {
                        this.bindPagination();
                    },
                    onInput(e) {
                        this.q = (e.target.value || '').trim();
                        if (this.debounceTimer) clearTimeout(this.debounceTimer);
                        this.debounceTimer = setTimeout(() => {
                            const len = this.q.length;
                            if (len < 5) {
                                if (this.lastSubmittedQuery !== '') {
                                    this.fetchResults();
                                }
                            } else if (this.q !== this.lastSubmittedQuery) {
                                this.fetchResults();
                            }
                        }, 300);
                    },
                    manualSubmit() {
                        this.fetchResults();
                    },
                    clear() {
                        this.q = '';
                        const input = document.getElementById('q');
                        if (input) input.value = '';
                        this.lastSubmittedQuery = '';
                        this.fetchResults();
                    },
                    fetchResults(url = null) {
                        const baseUrl = '{{ route('admin.articles') }}';
                        let requestUrl = url || baseUrl;
                        try {
                            const u = new URL(requestUrl, window.location.origin);
                            if (this.q && this.q.length >= 5) {
                                u.searchParams.set('q', this.q);
                            } else {
                                u.searchParams.delete('q');
                            }
                            requestUrl = u.toString();
                        } catch (e) {
                            requestUrl = baseUrl + (this.q && this.q.length >= 5 ? (`?q=${encodeURIComponent(this.q)}`) : '');
                        }

                        this.loading = true;
                        fetch(requestUrl, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(r => r.text())
                            .then(html => {
                                this.loading = false;
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const newList = doc.querySelector('#articlesList');
                                if (newList) {
                                    this.$refs.list.innerHTML = newList.innerHTML;
                                    this.lastSubmittedQuery = (this.q && this.q.length >= 5) ? this.q : '';
                                    this.bindPagination();
                                    const newUrl = baseUrl + (this.q && this.q.length >= 5 ? (`?q=${encodeURIComponent(this.q)}`) : '');
                                    history.replaceState(null, '', newUrl);
                                }
                            })
                            .catch(() => {
                                this.loading = false;
                            });
                    },
                    bindPagination() {
                        const container = this.$refs.list;
                        if (!container) return;
                        container.querySelectorAll('a[href*="page="]').forEach(a => {
                            a.addEventListener('click', (e) => {
                                e.preventDefault();
                                const href = a.getAttribute('href');
                                this.fetchResults(href);
                            });
                        });
                    }
                }
            }

            function deleteArticle(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/articles/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'The article has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Error', data.message || 'An error occurred while deleting the article.', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error', 'An error occurred while deleting the article.', 'error');
                            });
                    }
                });
            }
        </script>
    @endpush
