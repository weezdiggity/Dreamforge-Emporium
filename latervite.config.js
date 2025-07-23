import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '127.0.0.1', // Force IPv4 localhost
        port: 5174,
        strictPort: true,
        cors: true
    },
    plugins: [
        laravel([
           
            'resources/css/outgame/outgame.css',
            'resources/js/outgame/outgame.js',
        ]),
    ],
});

