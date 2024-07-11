import { ref } from 'vue'
import axios from 'axios'
import { type AlertInterface, AlertStyle } from '../interfaces'
import { useAuthStore } from '../stores'

/**
 * Composable used to communicate with the `/auth/check` api. Calling "check"
 * will fetch the user info from the server and set the frontend object.
 */
export function useCheckApi() {
    const loading = ref(false)
    const error = ref<AlertInterface | undefined>()

    const check = () => {
        loading.value = true
        error.value = undefined
        axios
            .get('/account/auth-check')
            .then((response) => {
                const auth = useAuthStore()
                auth.setUser(response.data.user)
            })
            .catch((err) => {
                const auth = useAuthStore()
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
