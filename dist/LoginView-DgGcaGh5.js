import { defineComponent as s, resolveComponent as i, openBlock as p, createBlock as u, unref as n } from "vue";
import { useRouter as a } from "vue-router";
const d = /* @__PURE__ */ s({
  __name: "LoginView",
  setup(m) {
    const e = a();
    return (f, o) => {
      const r = i("UFPageLogin");
      return p(), u(r, {
        onGotoRegistration: o[0] || (o[0] = (t) => n(e).push({ name: "account.register" })),
        onGotoForgotPassword: o[1] || (o[1] = (t) => n(e).push({ name: "account.forgot-password" })),
        onGotoResendVerification: o[2] || (o[2] = (t) => n(e).push({ name: "account.resend-verification" }))
      });
    };
  }
});
export {
  d as default
};
