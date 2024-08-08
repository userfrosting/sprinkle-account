import axios from 'axios'
import { AlertStyle, type AlertInterface } from '@userfrosting/sprinkle-core/types'
import { useConfigStore } from '@userfrosting/sprinkle-core/stores'
import type { UserInterface } from '../interfaces'

// Interfaces
export interface RegisterForm {
    first_name: string
    last_name: string
    email: string
    user_name: string
    password: string
    passwordc: string
    locale: string
    captcha: string
    spiderbro: string
}

// Variables
const config = useConfigStore()
export const defaultForm: RegisterForm = {
    first_name: '',
    last_name: '',
    email: '',
    user_name: '',
    password: '',
    passwordc: '',
    // @ts-ignore
    locale: config.config.site.registration.user_defaults.locale,
    captcha: '',
    spiderbro: 'http://'
}
// @ts-ignore
export const availableLocales = config.config.locales.available
export const captchaUrl = '/account/captcha' // TODO : Add captcha path to config

// Actions
export async function doRegister(form: RegisterForm) {
    return axios
        .post<UserInterface>('/account/register', form)
        .then((response) => {
            return response.data
        })
        .catch((err) => {
            const error: AlertInterface = {
                ...{
                    description: 'An error as occurred',
                    style: AlertStyle.Danger,
                    closeBtn: true
                },
                ...err.response.data
            }

            throw error
        })
}
