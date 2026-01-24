import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',  // ← Aceita conexões de qualquer IP
        port: 5173,
        strictPort: true,  // ← Falha se a porta já estiver em uso
        hmr: {
            host: 'localhost',  // ← Usa localhost para hot reload
        },
        watch: {
            usePolling: true,  // ← Importante para Docker
        },
    },
});