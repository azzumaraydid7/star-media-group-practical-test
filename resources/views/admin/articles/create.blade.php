<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Article - DailyTimes</title>
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
        <div class="max-w-7xl mx-auto px-4">
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
                        <a href="{{ route('admin.articles') }}" class="flex items-center p-3 text-white bg-blue-600 rounded-lg">
                            <i class="fas fa-newspaper mr-3"></i>
                            Articles
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
                        <h2 class="text-3xl font-bold text-gray-800">Create New Article</h2>
                        <p class="text-gray-600">Add a new article to your news site</p>
                    </div>
                    <a href="{{ route('admin.articles') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Articles
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

            <!-- Article Form -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                    @csrf
                    
                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>

                    <!-- Author -->
                    <div class="mb-6">
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                        <input type="text" id="author" name="author" value="{{ old('author') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Enter author name..." required>
                    </div>

                    <!-- Content (Short Description) -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Short Description (Optional)</label>
                        <textarea id="content" name="content" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Brief description or excerpt...">{{ old('content') }}</textarea>
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
                                <button type="button" id="removeImage" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600">
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
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Featured Article</span>
                        </label>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.articles') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">
                            Create Article
                        </button>
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
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    ['clean']
                ]
            }
        });

        // Sync Quill content with hidden textarea
        quill.on('text-change', function() {
            document.getElementById('text').value = quill.root.innerHTML;
        });

        // Form submission handler
        document.getElementById('articleForm').addEventListener('submit', function(e) {
            document.getElementById('text').value = quill.root.innerHTML;
        });

        // Image upload functionality
        const imageUploadArea = document.getElementById('imageUploadArea');
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const uploadPrompt = document.getElementById('uploadPrompt');
        const removeImageBtn = document.getElementById('removeImage');

        // Click to upload
        imageUploadArea.addEventListener('click', () => {
            imageInput.click();
        });

        // Drag and drop functionality
        imageUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUploadArea.classList.add('border-blue-400', 'bg-blue-50');
        });

        imageUploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            imageUploadArea.classList.remove('border-blue-400', 'bg-blue-50');
        });

        imageUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUploadArea.classList.remove('border-blue-400', 'bg-blue-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleImageFile(files[0]);
            }
        });

        // File input change
        imageInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleImageFile(e.target.files[0]);
            }
        });

        // Handle image file
        function handleImageFile(file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file.');
                return;
            }

            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB.');
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                uploadPrompt.classList.add('hidden');
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        // Remove image
        removeImageBtn.addEventListener('click', () => {
            imageInput.value = '';
            previewImg.src = '';
            uploadPrompt.classList.remove('hidden');
            imagePreview.classList.add('hidden');
        });
    </script>
</body>
</html>