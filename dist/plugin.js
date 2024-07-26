import { useAuthStore as u } from "./stores.js";
import { useAuthGuard as r } from "./guards.js";
const c = {
  install: (a, t) => {
    u().check();
    const { router: o } = t;
    r(o);
  }
};
export {
  c as default
};
