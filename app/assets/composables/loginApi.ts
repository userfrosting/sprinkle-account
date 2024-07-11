import { ref } from 'vue'
import axios from 'axios'
import { type AlertInterface, AlertStyle } from '../interfaces'
import { useAuthStore } from '../stores'
import type { LoginForm } from '../interfaces'

/**
 * Composable used to communicate with the `/auth/login` api. Calling "login"
 * with the user login data will validate the data with the server. If login is
 * successful, the user will be set on the frontend object. Otherwise, an error
 * will be defined.
 */
export function useLoginApi() {
    const loading = ref(false)
    const error = ref<AlertInterface | undefined>()

    // TODO : Error if user is not null
    const login = (form: LoginForm) => {
        loading.value = true
        error.value = undefined

        const auth = useAuthStore()

        axios
            .post('/account/login', form)
            .then((response) => {
                auth.setUser(response.data)
            })
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

    return { loading, error, login }
}
