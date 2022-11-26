import { defineConfig } from 'vite'
import tailwindcss from 'tailwindcss'
import autoprefixer from 'autoprefixer'
import laravel from 'vite-plugin-laravel'
import reactRefresh from '@vitejs/plugin-react-refresh';

export default defineConfig({
	plugins: [
		laravel({
			postcss: [
				tailwindcss(),
				autoprefixer(),
			],
        }),
	],
})
