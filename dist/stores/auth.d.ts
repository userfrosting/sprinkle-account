import { UserInterface, LoginForm, AlertInterface, AlertStyle } from '../interfaces';

export declare const useAuthStore: import('pinia').StoreDefinition<"auth", {
    user: UserInterface | null;
    loading: boolean;
    error: AlertInterface | null;
}, {
    isAuthenticated: (state: {
        user: {
            id: number;
            user_name: string;
            first_name: string;
            last_name: string;
            full_name: string;
            email: string;
            avatar: string;
            flag_enabled: boolean;
            flag_verified: boolean;
            group_id: number | null;
            locale: string;
            created_at: Date | string;
            updated_at: Date | string;
            deleted_at: Date | string | null;
        } | null;
        loading: boolean;
        error: {
            title?: string;
            description?: string;
            style?: AlertStyle | keyof typeof AlertStyle;
            closeBtn?: boolean;
            hideIcon?: boolean;
        } | null;
    } & import('pinia').PiniaCustomStateProperties<{
        user: UserInterface | null;
        loading: boolean;
        error: AlertInterface | null;
    }>) => boolean;
}, {
    setUser(user: UserInterface): void;
    unsetUser(): void;
    login(form: LoginForm): Promise<void>;
    check(): Promise<void>;
    logout(): Promise<void>;
}>;
