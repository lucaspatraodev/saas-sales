import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue(),
    ],
    server: {
        hmr: {
            host: process.env.VITE_HMRHOST || 'localhost',
            clientPort: process.env.VITE_HMRPORT || 5173,
        },
        host: '0.0.0.0',
        port: 5173,
        watch: {
            usePolling: true,
        },
    },
});
