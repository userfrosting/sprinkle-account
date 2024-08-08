import { UserInterface } from '../interfaces';
export interface RegisterForm {
    first_name: string;
    last_name: string;
    email: string;
    user_name: string;
    password: string;
    passwordc: string;
    locale: string;
    captcha: string;
    spiderbro: string;
}
export declare const defaultForm: RegisterForm;
export declare const availableLocales: any;
export declare const captchaUrl = "/account/captcha";
export declare function doRegister(form: RegisterForm): Promise<UserInterface>;
