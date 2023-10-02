import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
      https: false,
      hmr : {
        host: 'http://159.253.23.123:7777/evon.test',
      },
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    optimizeDeps: {
        include: [
            "@fawmi/vue-google-maps",
            "fast-deep-equal",
        ],
    },
});
