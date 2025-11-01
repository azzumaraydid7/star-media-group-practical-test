<script>
var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['link', 'image'],
            [{ 'indent': '-1' }, { 'indent': '+1' }],
            ['clean']
        ]
    }
});

quill.on('text-change', function () {
    document.getElementById('text').value = quill.root.innerHTML;
});

document.getElementById('articleForm').addEventListener('submit', function (e) {
    document.getElementById('text').value = quill.root.innerHTML;
});

const imageUploadArea = document.getElementById('imageUploadArea');
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');
const uploadPrompt = document.getElementById('uploadPrompt');
const removeImageBtn = document.getElementById('removeImage');

imageUploadArea.addEventListener('click', () => {
    imageInput.click();
});

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

imageInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
        handleImageFile(e.target.files[0]);
    }
});

function handleImageFile(file) {
    if (!file.type.startsWith('image/')) {
        alert('Please select an image file.');
        return;
    }

    if (file.size > 10 * 1024 * 1024) {
        alert('File size must be less than 10MB.');
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        previewImg.src = e.target.result;
        uploadPrompt.classList.add('hidden');
        imagePreview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

removeImageBtn.addEventListener('click', () => {
    imageInput.value = '';
    previewImg.src = '';
    uploadPrompt.classList.remove('hidden');
    imagePreview.classList.add('hidden');
});
</script>