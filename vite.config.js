import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/sass/frontend/app.scss',
            'resources/sass/backend/app.scss',
            'resources/js/frontend/app.js',
            'resources/js/frontend/plugins.js',
            'resources/js/backend/app.js',
            'resources/js/plugins.js',
            'resources/vendor/fontawesome/app.scss'
        ]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~@coreuicss': path.resolve(__dirname, 'resources/vendor/coreui/dist/css/coreui.css'), // Cloned from coreui
            '~@coreuijs': path.resolve(__dirname, 'resources/vendor/coreui/dist/js/coreui.bundle.min.js'), // Cloned from coreui
            '~@coreui/icons/css/free.min.css': path.resolve(__dirname, 'node_modules/@coreui/icons/css/free.min.css'), // CoreUI Icons
            'sweetalert2': path.resolve(__dirname, 'node_modules/sweetalert2'),
            vue: 'vue/dist/vue.esm-bundler.js',
        }
    },
})
