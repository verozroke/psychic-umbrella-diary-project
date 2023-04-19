import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'node:path'

// https://vitejs.dev/config/
export default defineConfig({
  server: {
    port: 3030,
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
      '@pages': path.resolve(__dirname, './src/pages'),
      '@routes': path.resolve(__dirname, './src/routes'),
      '@components': path.resolve(__dirname, './src/components'),
      '@stores': path.resolve(__dirname, './src/stores'),
      '@img': path.resolve(__dirname, './src/img'),
      '@helpers': path.resolve(__dirname, './src/helpers'),
      '@styles': path.resolve(__dirname, './src/styles'),
    }
  },
  plugins: [vue()],
})
