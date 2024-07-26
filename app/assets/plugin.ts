import type { App } from 'vue'
import { useAuthStore } from './stores/auth'
import { useAuthGuard } from './guards/authGuard'
import type { Router } from 'vue-router'

/* Install plugins */
export default {
    install: (app: App, options: { router: Router }) => {
        // Run auth check on load
        const auth = useAuthStore()
        auth.check()

        // Setup router guards
        const { router } = options
        useAuthGuard(router)
    }
}
