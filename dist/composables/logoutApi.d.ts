import { AlertInterface } from '../interfaces';

/**
 * Composable used to communicate with the `/auth/logout` api. Calling "logout"
 * will send the request to logout the user server side and delete the frontend
 * user object.
 */
export declare function useLogoutApi(): {
    loading: import('vue').Ref<boolean>;
    error: import('vue').Ref<AlertInterface | undefined>;
    logout: () => void;
};
