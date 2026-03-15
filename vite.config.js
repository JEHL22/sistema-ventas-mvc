import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0', // Permite que Docker exponga el puerto hacia afuera
        port: 5173,
        hmr: {
            host: 'localhost', // Le dice a Windows dónde escuchar los cambios en vivo
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});