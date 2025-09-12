// Простая инициализация CKEditor
document.addEventListener('DOMContentLoaded', function() {
    // Проверяем, есть ли элемент редактора на странице
    const editorElements = document.querySelectorAll('[data-ckeditor]');

    if (editorElements.length > 0 && typeof ClassicEditor !== 'undefined') {
        editorElements.forEach(element => {
            ClassicEditor
                .create(element, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                            'blockQuote', 'insertTable', 'mediaEmbed', '|',
                            'undo', 'redo'
                        ]
                    }
                })
                .then(editor => {
                    console.log('Editor was initialized');
                })
                .catch(error => {
                    console.error('Editor initialization error:', error);
                });
        });
    }
});
