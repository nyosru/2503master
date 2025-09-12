import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    // Оптимизация для Quill
    build: {
        rollupOptions: {
            external: [
                /^@ckeditor\/ckeditor5-.*/,
                /^@ckeditor\/ckeditor5-.*\/.*\.css$/
            ]
        }
    },
    optimizeDeps: {
        include: ['@ckeditor/ckeditor5-build-classic']
    }
});
