@extends('admin.layouts.app')

@section('title', 'Create Article')

@section('header')
    <div class="flex items-center justify-between pt-16">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Create New Article</h2>
            <p class="text-gray-600">Add a new article to your news site</p>
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

    <!-- Article Form -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
            @csrf

            <!-- Title -->
            <div class="mb-6">
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
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Category <span class="text-red-500">*</span>
                </label>
                <select id="category_id" name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                <input type="text" id="author" name="author" value="{{ old('author') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Enter author name..." required>
            </div>

            <!-- Content (Short Description) -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Short Description (Optional)</label>
                <textarea id="content" name="content" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Brief description or excerpt...">{{ old('content') }}</textarea>
            </div>

            <!-- Image Upload Section -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Article Image</label>

                <!-- Image Upload Area -->
                <div id="imageUploadArea" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors cursor-pointer">
                    <div id="uploadPrompt">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600 mb-2">Click to upload or drag and drop</p>
                        <p class="text-sm text-gray-500">PNG, JPG, GIF up to 10MB</p>
                    </div>
                    <input type="file" id="image" name="image" accept="image/*" class="hidden">
                </div>

                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <div class="relative inline-block">
                        <img id="previewImg" src="" alt="Preview" class="max-w-xs h-48 object-cover rounded-lg shadow-md">
                        <button type="button" id="removeImage" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Article Text (Rich Text Editor) -->
            <div class="mb-6">
                <label for="text" class="block text-sm font-medium text-gray-700 mb-2">Article Content</label>
                <div id="editor" style="height: 300px;"></div>
                <textarea id="text" name="text" class="hidden">{{ old('text') }}</textarea>
            </div>

            <!-- Featured Article -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Featured Article</span>
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.articles') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    Create Article
                </button>
            </div>
        </form>
    </div>

    @include('admin.includes.quill-text-editor-create')
@endsection

@push('scripts')
    <script>
        function generateTitle() {
            const btn = document.getElementById('generateTitleBtn');
            const originalContent = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span class="pl-2">Generating...</span>';

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
