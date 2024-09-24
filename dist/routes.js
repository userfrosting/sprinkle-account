const e = [
  {
    path: "/account/sign-in",
    name: "account.login",
    meta: {
      guest: {
        redirect: { name: "home" }
      }
    },
    component: () => import("./LoginView-DgGcaGh5.js")
  },
  {
    path: "/account/register",
    name: "account.register",
    meta: {
      guest: {
        redirect: { name: "home" }
      }
    },
    component: () => import("./RegisterView-D9MTwaNP.js")
  },
  {
    path: "/account/forgot-password",
    name: "account.forgot-password",
    meta: {
      guest: {
        redirect: { name: "home" }
      }
    },
    component: () => import("./ForgotPasswordView-Ct0WfO54.js")
  },
  {
    path: "/account/resend-verification",
    name: "account.resend-verification",
    meta: {
      guest: {
        redirect: { name: "home" }
      }
    },
    component: () => import("./ResendVerificationView-BBUXSJO0.js")
  }
];
export {
  e as default
};
