import { UserInterface } from '../interfaces';
interface RegisterForm {
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
declare function getDefaultForm(): RegisterForm;
declare function getAvailableLocales(): string[];
declare function getCaptchaUrl(): string;
declare function doRegister(form: RegisterForm): Promise<UserInterface>;
export type { RegisterForm };
export { getDefaultForm, getAvailableLocales, getCaptchaUrl, doRegister };
