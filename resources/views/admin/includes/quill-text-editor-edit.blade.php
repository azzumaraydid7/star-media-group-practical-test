<script>
var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            [{ 'indent': '-1' }, { 'indent': '+1' }],
            [{ 'align': [] }],
            ['link', 'image'],
            ['clean']
        ]
    }
});

var existingContent = document.getElementById('text').value;
if (existingContent) {
    quill.root.innerHTML = existingContent;
}

quill.on('text-change', function () {
    document.getElementById('text').value = quill.root.innerHTML;
});

document.querySelector('form').addEventListener('submit', function () {
    document.getElementById('text').value = quill.root.innerHTML;
});

const imageInput = document.getElementById('image');
const currentImageSection = document.getElementById('current-image-section');
const imageUploadSection = document.getElementById('image-upload-section');
const newImagePreview = document.getElementById('new-image-preview');
const previewImage = document.getElementById('preview-image');
const changeImageBtn = document.getElementById('change-image-btn');
const removeImageBtn = document.getElementById('remove-image-btn');
const cancelNewImageBtn = document.getElementById('cancel-new-image');
const removeImageInput = document.getElementById('remove_image');

if (imageInput) {
    imageInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Please select a valid image file.');
                return;
            }

            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB.');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                newImagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
}

if (changeImageBtn) {
    changeImageBtn.addEventListener('click', function () {
        imageUploadSection.classList.remove('hidden');
        removeImageInput.value = '0';
    });
}

if (removeImageBtn) {
    removeImageBtn.addEventListener('click', function () {
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

if (cancelNewImageBtn) {
    cancelNewImageBtn.addEventListener('click', function () {
        imageInput.value = '';
        newImagePreview.classList.add('hidden');
        previewImage.src = '';

        if (currentImageSection && !currentImageSection.classList.contains('hidden')) {
            imageUploadSection.classList.add('hidden');
            removeImageInput.value = '0';
        }
    });
}

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