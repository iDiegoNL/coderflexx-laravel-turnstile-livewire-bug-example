import { defineConfig, loadEnv } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default ({ mode }) => {
    process.env = Object.assign(process.env, loadEnv(mode, process.cwd(), ''));

    return defineConfig({
        server: {
            hmr: {
                host: process.env.APP_DOMAIN,
            },
        },
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js'
                ],
                refresh: [
                    ...refreshPaths,
                    'app/Http/Livewire/**',
                    'app/Forms/Components/**',
                ],
            }),
        ],
    })
}
