import { AlertInterface, LoginForm } from '../interfaces';

/**
 * Composable used to communicate with the `/auth/login` api. Calling "login"
 * with the user login data will validate the data with the server. If login is
 * successful, the user will be set on the frontend object. Otherwise, an error
 * will be defined.
 */
export declare function useLoginApi(): {
    loading: import('vue').Ref<boolean>;
    error: import('vue').Ref<AlertInterface | undefined>;
    login: (form: LoginForm) => void;
};
