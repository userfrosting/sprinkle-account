import { defineComponent as n, resolveComponent as r, openBlock as s, createBlock as p, unref as i } from "vue";
import { useRouter as m } from "vue-router";
const f = /* @__PURE__ */ n({
  __name: "RegisterView",
  setup(u) {
    const o = m();
    return (c, e) => {
      const t = r("UFPageRegister");
      return s(), p(t, {
        onGotoLogin: e[0] || (e[0] = (a) => i(o).push({ name: "account.login" }))
      });
    };
  }
});
export {
  f as default
};
