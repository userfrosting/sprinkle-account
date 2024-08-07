import { UserInterface, LoginForm } from '../interfaces';
export declare const useAuthStore: import('pinia').StoreDefinition<"auth", {
    user: UserInterface | null;
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
    } & import('pinia').PiniaCustomStateProperties<{
        user: UserInterface | null;
    }>) => boolean;
}, {
    setUser(user: UserInterface): void;
    unsetUser(): void;
    login(form: LoginForm): Promise<{
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
    } | null>;
    check(): Promise<{
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
    } | null>;
    logout(): Promise<import('axios').AxiosResponse<any, any>>;
}>;
