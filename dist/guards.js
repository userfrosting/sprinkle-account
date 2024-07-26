import { watchEffect as i } from "vue";
import { useAuthStore as l } from "./stores.js";
function p(e) {
  const r = l(), c = () => e.currentRoute.value.meta.auth ?? null, o = () => e.currentRoute.value.meta.guest ?? null, s = () => {
    const t = c();
    if (t !== null && !r.isAuthenticated) {
      const u = t.redirect ?? "/login";
      n(u);
    }
  }, a = () => {
    const t = o();
    if (t !== null && r.isAuthenticated) {
      const u = t.redirect ?? "/";
      n(u);
    }
  }, n = (t) => {
    e.push(t);
  };
  i(() => {
    s(), a();
  });
}
export {
  p as useAuthGuard
};
