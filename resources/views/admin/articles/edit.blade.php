@extends('admin.layouts.app')

@section('title', 'Edit Article')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Edit Article</h2>
            <p class="text-gray-600">Update article information</p>
        </div>
        <a href="{{ route('admin.articles') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Articles
        </a>
    </div>
@endsection

@section('content')
    <!-- Quill Rich Text Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Edit Form -->
    <div class="bg-white rounded-lg shadow-lg">
        <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <!-- Title -->
                <div>
                    <div class="flex justify-between items-center w-full mb-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 my-auto">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <button type="button" id="generateTitleBtn" onclick="generateTitle()" class="px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3 flex items-center m-auto">
                                    <path d="M15.98 1.804a1 1 0 0 0-1.96 0l-.24 1.192a1 1 0 0 1-.784.785l-1.192.238a1 1 0 0 0 0 1.962l1.192.238a1 1 0 0 1 .785.785l.238 1.192a1 1 0 0 0 1.962 0l.238-1.192a1 1 0 0 1 .785-.785l1.192-.238a1 1 0 0 0 0-1.962l-1.192-.238a1 1 0 0 1-.785-.785l-.238-1.192ZM6.949 5.684a1 1 0 0 0-1.898 0l-.683 2.051a1 1 0 0 1-.633.633l-2.051.683a1 1 0 0 0 0 1.898l2.051.684a1 1 0 0 1 .633.632l.683 2.051a1 1 0 0 0 1.898 0l.683-2.051a1 1 0 0 1 .633-.633l2.051-.683a1 1 0 0 0 0-1.898l-2.051-.683a1 1 0 0 1-.633-.633L6.95 5.684ZM13.949 13.684a1 1 0 0 0-1.898 0l-.184.551a1 1 0 0 1-.632.633l-.551.183a1 1 0 0 0 0 1.898l.551.183a1 1 0 0 1 .633.633l.183.551a1 1 0 0 0 1.898 0l.184-.551a1 1 0 0 1 .632-.633l.551-.183a1 1 0 0 0 0-1.898l-.551-.184a1 1 0 0 1-.633-.632l-.183-.551Z" />
                                </svg>
                                <span class="pl-2">Generate</span>
                            </div>
                        </button>
                    </div>
                    <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select id="category_id" name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Author -->
                <div class="mb-6">
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $article->author) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Enter author name..." required>
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Short Description (Optional)
                    </label>
                    <textarea id="content" name="content" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Brief description of the article...">{{ old('content', $article->content) }}</textarea>
                </div>

                <!-- Text -->
                <div>
                    <label for="text" class="block text-sm font-medium text-gray-700 mb-2">
                        Article Content <span class="text-red-500">*</span>
                    </label>
                    <!-- Rich Text Editor Container -->
                    <div id="editor" class="bg-white border border-gray-300 rounded-md" style="min-height: 300px;"></div>
                    <!-- Hidden textarea to store the content -->
                    <textarea id="text" name="text" class="hidden" required>{!! old('text', $article->text) !!}</textarea>
                </div>

                <!-- Featured Status -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $article->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Featured Article</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1">Featured articles appear prominently on the homepage</p>
                </div>

                <!-- Current Image Preview -->
                @if ($article->image)
                    <div id="current-image-section">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Current Image
                        </label>
                        <div class="flex items-start space-x-4">
                            @if ($article->image && file_exists(public_path($article->image)))
                                <img id="current-image-preview" src="{{ asset($article->image) }}" alt="Article Image" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                            @else
                                <img id="current-image-preview" src="{{ asset('img/default.png') }}" alt="Article Image" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                            @endif
                            <div class="flex flex-col space-y-2">
                                <button type="button" id="change-image-btn" class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                    Change Image
                                </button>
                                <button type="button" id="remove-image-btn" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                                    Remove Image
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Image Upload Field -->
                <div id="image-upload-section" class="{{ $article->image ? 'hidden' : '' }}">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Article Image
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Upload a file</span>
                                    <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                    <!-- New Image Preview -->
                    <div id="new-image-preview" class="hidden mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            New Image Preview
                        </label>
                        <div class="flex items-start space-x-4">
                            <img id="preview-image" src="" alt="New Image Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                            <button type="button" id="cancel-new-image" class="px-3 py-1 text-sm bg-gray-600 text-white rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hidden field to indicate image removal -->
                <input type="hidden" id="remove_image" name="remove_image" value="0">

                <!-- Article Info -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Article Information</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-medium">Created:</span> {{ $article->created_at->format('M d, Y H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">Updated:</span> {{ $article->updated_at->format('M d, Y H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">Slug:</span> {{ $article->slug }}
                        </div>
                        <div>
                            <span class="font-medium">Status:</span>
                            @if ($article->is_featured)
                                <span class="text-yellow-600">Featured</span>
                            @else
                                <span class="text-gray-600">Regular</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between">
                <div class="flex space-x-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition-colors">
                        <i class="fas fa-save mr-2"></i>Update Article
                    </button>
                    <a href="{{ route('article', $article->slug) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-medium transition-colors">
                        <i class="fas fa-eye mr-2"></i>Preview
                    </a>
                </div>
                <a href="{{ route('admin.articles') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    @include('admin.includes.quill-text-editor-edit')
@endsection

@push('scripts')
    <script>
        function generateTitle() {
            const btn = document.getElementById('generateTitleBtn');
            const originalContent = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating...';

            $.ajax({
                url: "{{ route('ai.generate.title') }}",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    topic: $('#title').val()
                }),
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    const input = $('#title');
                    const descriptionInput = $('#content');
                    const newText = data.title;
                    const newDescription = data.description;
                    const currentText = input.val();
                    const currentDescription = descriptionInput.val();
                    const typingSpeed = 20;

                    if (input.data('typingTimeouts')) {
                        input.data('typingTimeouts').forEach(timeout => clearTimeout(timeout));
                    }
                    if (descriptionInput.data('typingTimeouts')) {
                        descriptionInput.data('typingTimeouts').forEach(timeout => clearTimeout(timeout));
                    }

                    const timeouts = [];
                    input.data('typingTimeouts', timeouts);
                    descriptionInput.data('typingTimeouts', timeouts);

                    for (let i = 0; i <= currentText.length; i++) {
                        const timeout = setTimeout(() => {
                            input.val(currentText.substring(0, currentText.length - i));
                        }, i * typingSpeed);
                        timeouts.push(timeout);
                    }

                    for (let i = 0; i <= currentDescription.length; i++) {
                        const timeout = setTimeout(() => {
                            descriptionInput.val(currentDescription.substring(0, currentDescription.length - i));
                        }, i * typingSpeed);
                        timeouts.push(timeout);
                    }

                    for (let i = 0; i <= newText.length; i++) {
                        const timeout = setTimeout(() => {
                            input.val(newText.substring(0, i));
                        }, (currentText.length + i) * typingSpeed);
                        timeouts.push(timeout);
                    }

                    for (let i = 0; i <= newDescription.length; i++) {
                        const timeout = setTimeout(() => {
                            descriptionInput.val(newDescription.substring(0, i));
                        }, (currentText.length + i) * typingSpeed);
                        timeouts.push(timeout);
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.error?.message || 'An error occurred while generating the title.'
                    });
                },
                complete: function() {
                    btn.disabled = false;
                    btn.innerHTML = originalContent;
                }
            });
        }
    </script>
@endpush
