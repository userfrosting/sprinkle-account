<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2013-2024 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

/**
 * Standard Farsi/Persian message token translations for the 'account' sprinkle.
 *
 * @author aminakbari
 */
return [
    'ACCOUNT' => [
        '@TRANSLATION'        => 'حساب',
        'ACCESS_DENIED'       => 'به نظر می آید که شما اجازه انجام این کار را ندارید',
        'DISABLED'            => 'این حساب کاربری غیر فعال شده است. برای اطلاعات بیشتر، لطفا با ما تماس برقرار کنید.',
        'EMAIL_UPDATED'       => 'آدرس پست الکترونیکی حساب، به روز رسانی شد',
        'INVALID'             => 'این اکانت موجود نیست. ممکن است که حذف شده باشد. برای اطلاعات بیشتر، لطفا با ما تماس برقرار کنید.',
        'MASTER_NOT_EXISTS'   => 'تا زمانی که حساب اصلی ساخته نشده است نمیتوانید حساب کاربری جدیدی بسازید.',
        'MY'                  => 'حساب من',
        'SESSION_COMPROMISED' => [
            '@TRANSLATION' => 'ممکن است سژن شما مورد حمله واقع شده باشد. بهتر است با همه دستگاه های خود از وب سایت خارج شوید و دوباره وارد شوید. همچنین توجه بفرمایید که اطلاعات حسابتان، مورد حمله واقع نشده باشد. ',
            'TITLE'        => 'ممکن است که اکانت شما مورد حمله واقع شده باشد',
            'TEXT'         => 'ممکن است شخصی برای ورود به این صفحه از اطلاعات ورود شما استفاده کرده باشد. برای امنیت شما ، تمام سژن ها از سیستم خارج شدند. لطفاً <a href="{{url}}">وارد شوید</a> و حساب کاربری خود را برای فعالیت مشکوک بررسی نمایید. همچنین بهتر است رمز عبور خود را تغییر دهید.',
        ],
        'SESSION_EXPIRED' => 'سژن شما به پایان رسیده است. لطفا دوباره وارد شوید.',
        'SETTINGS'        => [
            '@TRANSLATION' => 'تنظیمات حساب',
            'DESCRIPTION'  => 'اطلاعات حسابتان یعنی پست الکترونیکی،نام و گذرواژه خود را به روز رسانی کنید',
            'UPDATED'      => 'تنظیمات حساب به روز رسانی شد',
        ],
        'TOOLS'        => 'ابزار حساب',
        'UNVERIFIED'   => 'شما هنوز آدرس پست الکترونیکی خود را فعال نکرده اید. برای فعال سازی لطفا ایمیل خود را چک کنید.',
        'VERIFICATION' => [
            'NEW_LINK_SENT'   => 'لینک فعال سازی برای ایمیل {{email}} ارسال شد. لطفا ایمیل خود را چک کنید.',
            'RESEND'          => 'ارسال دوباره ایمیل فعال سازی',
            'COMPLETE'        => 'شما پست الکترونیکی خود را با موفقیت فعال سازی کردید. حالا می توانید وارد شوید.',
            'EMAIL'           => 'لطفا آدرس پست الکترونیکی که با آن ثبت نام کردید وارد کنید تا ایمیل فعال سازی دوباره برایتان ارسال شود.',
            'PAGE'            => 'ارسال دوباره ایمیل فعال سازی برای حساب جدید شما',
            'SEND'            => 'ارسال ایمیل فعال سازی برای حساب کاربری',
            'TOKEN_NOT_FOUND' => 'این حساب کاربری یا قبلا فعال شده است و یا کد فعال سازی موجود نیست.',
        ],
    ],
    'EMAIL' => [
        'INVALID'               => 'حساب کاربری با <strong>{{email}}</strong> ثبت نشده است.',
        'IN_USE'                => 'ایمیل <strong>{{email}}</strong> قبلا استفاده شده است',
        'VERIFICATION_REQUIRED' => 'آدرس پست الکترونیکی را بصورت صحیح وارد کنید',
    ],
    'EMAIL_OR_USERNAME'   => 'نام کاربری یا آدرس پست الکترونیکی',
    'FIRST_NAME'          => 'نام',
    'HEADER_MESSAGE_ROOT' => 'شما بعنوان کاربر اصلی وارد شده اید',
    'LAST_NAME'           => 'نام خانوادگی',
    'LOCALE'              => [
        'ACCOUNT' => 'زبان انتخابی برای حساب شما',
        'INVALID' => '<strong>{{locale}}</strong> زبان صحیحی نیست',
    ],
    'LOGIN' => [
        '@TRANSLATION'     => 'ورود',
        'ALREADY_COMPLETE' => 'شما قبلا وارد شده اید.',
        'SOCIAL'           => 'یا با روش های زیر وارد شوید',
        'REQUIRED'         => 'برای دیدن این صفحه لازم است که وارد شوید',
    ],
    'LOGOUT'         => 'خروج',
    'NAME'           => 'نام',
    'NAME_AND_EMAIL' => 'نام و پست الکترونیکی',
    'PAGE'           => [
        'LOGIN' => [
            'DESCRIPTION' => 'به حساب کاربری خود در {{site_name}} وارد شوید و یا حساب کاربری جدیدی بسازید',
            'SUBTITLE'    => 'ثبت نام کنید و یا با حساب کاربری خود وارد شوید',
            'TITLE'       => 'بیایید شروع کنیم!',
        ],
    ],
    'PASSWORD' => [
        '@TRANSLATION'        => 'گذرواژه',
        'BETWEEN'             => 'بین {{min}}-{{max}} حرف',
        'CONFIRM'             => 'رمز عبور را وارد کنید',
        'CONFIRM_CURRENT'     => 'لطفا رمز عبور فعلی را تایید کنید',
        'CONFIRM_NEW'         => 'رمز عبور جدید را وارد کنید',
        'CONFIRM_NEW_EXPLAIN' => 'رمز عبور جدید را تکرار کنید',
        'CONFIRM_NEW_HELP'    => 'فقط زمانی لازم است که می خواهید گذرواژه جدیدی انتخاب کنید',
        'CREATE'              => [
            '@TRANSLATION' => 'ایجاد رمز عبور',
            'PAGE'         => 'برای حساب جدید خود رمزعبور انتخاب کنید.',
            'SET'          => 'گذرواژه خود را تنظیم کرده و وارد سیستم شوید',
        ],
        'CURRENT'         => 'گذرواژه فعلی',
        'CURRENT_EXPLAIN' => 'شما باید گذرواژه فعلی خود را وارد کنید تا بتوانید اطلاعات را به روز رسانی کنید',
        'FORGOTTEN'       => 'فراموشی گذرواژه',
        'FORGET'          => [
            '@TRANSLATION'     => 'گذرواژه خود را فراموش کرده ام',
            'COULD_NOT_UPDATE' => 'گذرواژه به روز رسانی نشد',
            'EMAIL'            => 'لطفا آدرس پست الکترونیکی که در زمان ثبت نام استفاده کردید، وارد کنید. لینک بازیابی گذرواژه برای شما ایمیل خواهد شد.',
            'EMAIL_SEND'       => 'لینک بازیابی گذرواژه ایمیل شود',
            'INVALID'          => 'درخواست بازیابی کذرواژه پیدا نشد و یا منقضی شده است. لطفا درخواست را <a href="{{url}}">دوباره ارسال کنید<a>',
            'PAGE'             => 'دریافت لینک بازیابی گذرواژه',
            'REQUEST_CANNED'   => 'درخواست فراموشی گذرواژه، حذف شد.',
            'REQUEST_SENT'     => 'ایمیل بازیابی گذرواژه به <strong>{{email}}</strong> ارسال شد.',
        ],
        'HASH_FAILED'       => 'هشینگ گذرواژه با مشکل روبرو شد. لطفا با مسولین وب سایت تماس برقرار کنید',
        'INVALID'           => 'گذرواژه فعلی درست وارد نشده است',
        'NEW'               => 'گذرواژه جدید',
        'NOTHING_TO_UPDATE' => 'شما نمیتوانید همان گذرواژه را دوباره وارد کنید',
        'RESET'             => [
            '@TRANSLATION' => 'تغییر گذرواژه',
            'CHOOSE'       => 'لطفا گذرواژه جدید را انتخاب کنید',
            'PAGE'         => 'برای حساب خود، گذرواژه جدیدی انتخاب کنید.',
            'SEND'         => 'گذرواژه جدید را انتخاب کرده و وارد شوید',
        ],
        'UPDATED' => 'گذرواژه به روز رسانی شد',
    ],
    'PROFILE' => [
        'SETTINGS' => 'تنظیمات شخصی حساب',
        'UPDATED'  => 'تنظیمات شخصی حساب به روز رسانی شد',
    ],
    'RATE_LIMIT_EXCEEDED' => 'شما محدودیت تعداد انجام این کار را پشت سر گذاشتید. لطفا {{delay}} ثانیه دیگر صبر کرده و دوباره تلاش کنید.',
    'REGISTER'            => 'ثبت نام',
    'REGISTER_ME'         => 'ثبت نام کن',
    'REGISTRATION'        => [
        'BROKEN'         => 'متاسفانه پروسه ثبت نام با مشکلی روبرو شد. برای دریافت کمک لطفا با ما تماس بگیرید.',
        'COMPLETE_TYPE1' => 'شما با موفقیت ثبت نام کردید. حالا میتوانید وارد شوید.',
        'COMPLETE_TYPE2' => 'شما با موفقیت ثبت نام کردید. لینک فعال سازی حساب به آدرس پست الکترونیکیتان <strong>{{email}}</strong> ارسال شد. بدون فعال سازی نمیتوانید وارد شوید.',
        'DISABLED'       => 'با عرض تاسف، امکان ثبت در وب سایت، غیر فعال شده است.',
        'LOGOUT'         => 'شما همزمان این که وارد شده اید نمیتوانید حساب کاربری جدیدی بسازید. لطفا ابتدا خارج شوید.',
        'WELCOME'        => 'سریع و ساده ثبت نام کنید',
    ],
    'REMEMBER_ME'             => 'من را به خاطر بسپار!',
    'REMEMBER_ME_ON_COMPUTER' => 'من را در این دستگاه به خاطر بسپار (برای دستگاه های عمومی پیشنهاد نمی شود)',
    'SIGN_IN_HERE'            => 'حساب دارید؟ <a href="{{url}}">اینجا وارد شوید</a>.',
    'SIGNIN'                  => 'ورود',
    'SIGNIN_OR_REGISTER'      => 'ثبت نام کنید و یا وارد شوید',
    'SIGNUP'                  => 'ثبت نام',
    'TOS'                     => 'شرایط و مقررات',
    'TOS_AGREEMENT'           => 'با ثبت نام در {{site_title}} موافقت خود با <a {{link_attributes | raw}}>شرایط و مقررات</a> را نشان میدهید.',
    'TOS_FOR'                 => 'شرایط و مقررات {{title}}',
    'USERNAME'                => [
        '@TRANSLATION'  => 'نام کاربری',
        'CHOOSE'        => 'یک نام کاربری منحصر به فرد انتخاب کنید',
        'INVALID'       => 'نام کاربری معتبر نیست',
        'IN_USE'        => 'نام کاربری <strong>{{user_name}}</strong> قبلا استفاده شده است',
        'NOT_AVAILABLE' => 'نام کاربری <strong>{{user_name}}</strong> موجود نیست. لطفا نام کاربری دیگری انتخاب کنید',
    ],
    'USER_ID_INVALID'       => 'آی دی کاربری مد نظر شما موجود نیست',
    'USER_OR_EMAIL_INVALID' => 'نام کاربری و یا آدرس پست الکترونیکی معتبر نیست',
    'USER_OR_PASS_INVALID'  => 'کاربری یافت نشد و یا گذرواژه صحیح نیست',
    'WELCOME'               => 'خوش آمدید {{first_name}}',
];
