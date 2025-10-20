<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article - DailyTimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Quill Rich Text Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="mx-auto px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">DailyTimes - Admin</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Welcome, {{ session('user_name') }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <div class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.consents') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-shield-alt mr-3"></i>
                            Consents
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles') }}" class="flex items-center p-3 text-gray-700 bg-blue-100 rounded-lg">
                            <i class="fas fa-newspaper mr-3"></i>
                            Articles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-home mr-3"></i>
                            View Site
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Edit Article</h2>
                        <p class="text-gray-600">Update article information</p>
                    </div>
                    <a href="{{ route('admin.articles') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Articles
                    </a>
                </div>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Edit Form -->
            <div class="bg-white rounded-lg shadow">
                <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6 space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title *
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $article->title) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                Content
                            </label>
                            <textarea id="content" 
                                      name="content" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Brief description of the article...">{{ old('content', $article->content) }}</textarea>
                        </div>

                        <!-- Text -->
                        <div>
                            <label for="text" class="block text-sm font-medium text-gray-700 mb-2">
                                Text *
                            </label>
                            <!-- Rich Text Editor Container -->
                            <div id="editor" class="bg-white border border-gray-300 rounded-md" style="min-height: 300px;"></div>
                            <!-- Hidden textarea to store the content -->
                            <textarea id="text" 
                                      name="text" 
                                      class="hidden"
                                      required>{!! old('text', $article->text) !!}</textarea>
                        </div>


                        <!-- Featured Status -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="is_featured" 
                                       value="1"
                                       {{ old('is_featured', $article->is_featured) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Featured Article</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-1">Featured articles appear prominently on the homepage</p>
                        </div>

                        <!-- Current Image Preview -->
                        @if($article->image)
                            <div id="current-image-section">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Current Image
                                </label>
                                <div class="flex items-start space-x-4">
                                    <img id="current-image-preview" 
                                         src="{{ asset($article->image) }}" 
                                         alt="Article Image" 
                                         class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                                    <div class="flex flex-col space-y-2">
                                        <button type="button" 
                                                id="change-image-btn"
                                                class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Change Image
                                        </button>
                                        <button type="button" 
                                                id="remove-image-btn"
                                                class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
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
                                            <input id="image" 
                                                   name="image" 
                                                   type="file" 
                                                   accept="image/*"
                                                   class="sr-only">
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
                                    <img id="preview-image" 
                                         src="" 
                                         alt="New Image Preview" 
                                         class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                                    <button type="button" 
                                            id="cancel-new-image"
                                            class="px-3 py-1 text-sm bg-gray-600 text-white rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
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
                                    @if($article->is_featured)
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
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium">
                                <i class="fas fa-save mr-2"></i>Update Article
                            </button>
                            <a href="{{ route('article', $article->slug) }}" 
                               target="_blank"
                               class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-medium">
                                <i class="fas fa-eye mr-2"></i>Preview
                            </a>
                        </div>
                        <a href="{{ route('admin.articles') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Initialize Quill editor
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });

        // Load existing content
        var existingContent = document.getElementById('text').value;
        if (existingContent) {
            quill.root.innerHTML = existingContent;
        }

        // Update hidden textarea when content changes
        quill.on('text-change', function() {
            document.getElementById('text').value = quill.root.innerHTML;
        });

        // Ensure content is saved before form submission
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('text').value = quill.root.innerHTML;
        });

        // Image Upload and Preview Functionality
        const imageInput = document.getElementById('image');
        const currentImageSection = document.getElementById('current-image-section');
        const imageUploadSection = document.getElementById('image-upload-section');
        const newImagePreview = document.getElementById('new-image-preview');
        const previewImage = document.getElementById('preview-image');
        const changeImageBtn = document.getElementById('change-image-btn');
        const removeImageBtn = document.getElementById('remove-image-btn');
        const cancelNewImageBtn = document.getElementById('cancel-new-image');
        const removeImageInput = document.getElementById('remove_image');

        // Handle file input change
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        alert('Please select a valid image file.');
                        return;
                    }
                    
                    // Validate file size (10MB)
                    if (file.size > 10 * 1024 * 1024) {
                        alert('File size must be less than 10MB.');
                        return;
                    }

                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        newImagePreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Handle change image button
        if (changeImageBtn) {
            changeImageBtn.addEventListener('click', function() {
                imageUploadSection.classList.remove('hidden');
                removeImageInput.value = '0';
            });
        }

        // Handle remove image button
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        currentImageSection.classList.add('hidden');
                        imageUploadSection.classList.remove('hidden');
                        removeImageInput.value = '1';
                    }
                });
            });
        }

        // Handle cancel new image
        if (cancelNewImageBtn) {
            cancelNewImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                newImagePreview.classList.add('hidden');
                previewImage.src = '';
                
                // If there's a current image, hide upload section
                if (currentImageSection && !currentImageSection.classList.contains('hidden')) {
                    imageUploadSection.classList.add('hidden');
                    removeImageInput.value = '0';
                }
            });
        }

        // Drag and drop functionality
        const dropZone = imageUploadSection?.querySelector('.border-dashed');
        if (dropZone) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropZone.classList.add('border-blue-400', 'bg-blue-50');
            }

            function unhighlight(e) {
                dropZone.classList.remove('border-blue-400', 'bg-blue-50');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length > 0) {
                    imageInput.files = files;
                    imageInput.dispatchEvent(new Event('change'));
                }
            }
        }
    </script>
</body>
</html>