import { defineStore } from 'pinia'
import axios from 'axios'
import type { UserInterface, LoginForm, AlertInterface } from '../interfaces'
import { AlertStyle } from '../interfaces'

export const useAuthStore = defineStore('auth', {
    persist: {
        paths: ['user'] // Only persist user
    },
    state: () => {
        return {
            user: null as UserInterface | null,
            loading: false,
            error: null as AlertInterface | null
        }
    },
    getters: {
        isAuthenticated: (state): boolean => state.user !== null
    },
    actions: {
        setUser(user: UserInterface): void {
            this.user = user
        },
        unsetUser(): void {
            this.user = null
        },
        async login(form: LoginForm) {
            this.loading = true
            this.error = null
            axios
                .post('/account/login', form)
                .then((response) => {
                    this.setUser(response.data)
                })
                .catch((err) => {
                    // TODO : This should be an event
                    this.error = {
                        ...err.response.data,
                        ...{
                            description: 'An error as occurred',
                            style: AlertStyle.Danger,
                            closeBtn: true
                        }
                    }
                    console.log('ERROR', err.response.data, this.error)
                })
                .finally(() => {
                    this.loading = false
                })
        },
        async check() {
            this.loading = true
            this.error = null
            axios
                .get('/account/auth-check')
                .then((response) => {
                    this.setUser(response.data.user)
                })
                .catch((err) => {
                    this.unsetUser()
                    // TODO : This should be an event, console.warning, or toast
                    this.error = {
                        ...err.response.data,
                        ...{
                            description: 'An error as occurred',
                            style: AlertStyle.Danger,
                            closeBtn: true
                        }
                    }
                })
                .finally(() => {
                    this.loading = false
                })
        },
        async logout() {
            this.loading = true
            this.error = null
            this.unsetUser()
            axios
                .get('/account/logout')
                .catch((err) => {
                    // TODO : This should be an event, console.warning, or toast
                    this.error = {
                        ...err.response.data,
                        ...{
                            description: 'An error as occurred',
                            style: AlertStyle.Danger,
                            closeBtn: true
                        }
                    }
                })
                .finally(() => {
                    this.loading = false
                })
        }
    }
})
