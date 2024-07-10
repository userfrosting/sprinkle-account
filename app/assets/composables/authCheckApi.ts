import { ref } from 'vue'
import axios from 'axios'
import { type AlertInterface, AlertStyle } from '../interfaces'
import { useAuthStore } from '../stores'
const authStore = useAuthStore()

/**
 * Composable used to communicate with the `/auth/check` api. Calling "check"
 * will fetch the user info from the server and set the frontend object.
 */
export function useCheckApi(auth: typeof authStore) {
    const loading = ref(false)
    const error = ref<AlertInterface | undefined>()

    const check = () => {
        loading.value = true
        error.value = undefined
        axios
            .get('/account/auth-check')
            .then((response) => {
                auth.setUser(response.data.user)
            })
            .catch((err) => {
                auth.unsetUser()
                error.value = {
                    ...err.response.data,
                    ...{ style: AlertStyle.Danger, closeBtn: true }
                }
            })
            .finally(() => {
                loading.value = false
            })
    }

    return { loading, error, check }
}
