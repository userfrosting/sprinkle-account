import { AlertInterface } from '../interfaces';

/**
 * Composable used to communicate with the `/auth/check` api. Calling "check"
 * will fetch the user info from the server and set the frontend object.
 */
export declare function useCheckApi(): {
    loading: import('vue').Ref<boolean>;
    error: import('vue').Ref<AlertInterface | undefined>;
    check: () => void;
};
