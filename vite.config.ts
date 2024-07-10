/// <reference types="vitest" />
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import dts from 'vite-plugin-dts'

// https://vitejs.dev/config/
// https://stackoverflow.com/a/74397545/445757
export default defineConfig({
    plugins: [vue(), dts()],
    publicDir: false,
    build: {
        outDir: './dist',
        lib: {
            name: '@userfrosting/sprinkle-account',
            entry: {
                interfaces: 'app/assets/interfaces/index.ts', 
            }
        },
        rollupOptions: {
            external: ['vue', 'vue-router'],
            output: {
                exports: 'named',
                globals: {
                    vue: 'Vue',
                    'vue-router': 'vueRouter'
                }
            }
        }
    },
    test: {
        coverage: {
            reportsDirectory: './_meta/_coverage'
        },
        environment: 'happy-dom'
    }
})
