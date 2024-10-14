import { defineStore as o } from "pinia";
import { a as t, b as s } from "./types-Ht7brb6q.js";
const a = o("auth", {
  persist: !0,
  state: () => ({
    user: null
  }),
  getters: {
    isAuthenticated: (r) => r.user !== null
  },
  actions: {
    setUser(r) {
      this.user = r;
    },
    unsetUser() {
      this.user = null;
    },
    async login(r) {
      return t.post("/account/login", r).then((e) => (this.setUser(e.data), this.user)).catch((e) => {
        throw {
          description: "An error as occurred",
          style: s.Danger,
          closeBtn: !0,
          ...e.response.data
        };
      });
    },
    async check() {
      return t.get("/account/auth-check").then((r) => (this.setUser(r.data.user), this.user)).catch((r) => {
        throw this.unsetUser(), {
          description: "An error as occurred",
          style: s.Danger,
          closeBtn: !0,
          ...r.response.data
        };
      });
    },
    async logout() {
      return this.unsetUser(), t.get("/account/logout").catch((r) => {
        throw {
          description: "An error as occurred",
          style: s.Danger,
          closeBtn: !0,
          ...r.response.data
        };
      });
    }
  }
});
export {
  a as useAuthStore
};
