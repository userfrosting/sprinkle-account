import { ref } from 'vue'
import axios from 'axios'
import { type AlertInterface, AlertStyle } from '../interfaces'
import { useAuthStore } from '../stores'
const authStore = useAuthStore()

/**
 * Composable used to communicate with the `/auth/logout` api. Calling "logout"
 * will send the request to logout the user server side and delete the frontend
 * user object.
 */
export function useLogoutApi(auth: typeof authStore) {
    const loading = ref(false)
    const error = ref<AlertInterface | undefined>()

    const logout = () => {
        loading.value = true
        error.value = undefined
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
