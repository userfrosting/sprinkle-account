import { defineStore as t } from "pinia";
const r = t("auth", {
  persist: !0,
  state: () => ({
    user: null
  }),
  getters: {
    isAuthenticated: (e) => e.user !== null
  },
  actions: {
    setUser(e) {
      this.user = e;
    },
    unsetUser() {
      this.user = null;
    }
  }
});
export {
  r as u
};
