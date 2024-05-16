import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig(() => {
	return {
		plugins: [ vue() ],
		build: {
			emptyOutDir: false,
			copyPublicDir: false,
			outDir: 'public',
			assetsDir: 'dist',
			manifest: true,
			rollupOptions: {
				input: `./src/main.js`,
			},
		}
		resolve: {
			alias: {
				'@': fileURLToPath(new URL(`./src`, import.meta.url))
			}
		}
	};
});
