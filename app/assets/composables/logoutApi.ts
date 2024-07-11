import { ref } from 'vue'
import axios from 'axios'
import { type AlertInterface, AlertStyle } from '../interfaces'
import { useAuthStore } from '../stores'

/**
 * Composable used to communicate with the `/auth/logout` api. Calling "logout"
 * will send the request to logout the user server side and delete the frontend
 * user object.
 */
export function useLogoutApi() {
    const loading = ref(false)
    const error = ref<AlertInterface | undefined>()

    const logout = () => {
        loading.value = true
        error.value = undefined
        
        // Unset user in store
        const auth = useAuthStore()
        auth.unsetUser()
        
        axios
            .get('/account/logout')
            .catch((err) => {
                error.value = {
                    ...err.response.data,
                    ...{ style: AlertStyle.Danger, closeBtn: true }
                }
            })
            .finally(() => {
                loading.value = false
            })
    }

    return { loading, error, logout }
}
