import { hasInjectionContext as rt, inject as ct, getCurrentInstance as ut, ref as Z, watch as at, reactive as it, markRaw as S, effectScope as ft, isRef as w, isReactive as W, toRef as A, toRaw as lt, nextTick as z, computed as G, getCurrentScope as ht, onScopeDispose as pt, toRefs as B } from "vue";
var dt = !1;
function $(t, c, r) {
  return Array.isArray(t) ? (t.length = Math.max(t.length, c), t.splice(c, 1, r), r) : (t[c] = r, r);
}
function R(t, c) {
  if (Array.isArray(t)) {
    t.splice(c, 1);
    return;
  }
  delete t[c];
}
/*!
 * pinia v2.1.7
 * (c) 2023 Eduardo San Martin Morote
 * @license MIT
 */
let j;
const I = (t) => j = t, _t = process.env.NODE_ENV !== "production" ? Symbol("pinia") : (
  /* istanbul ignore next */
  Symbol()
);
function g(t) {
  return t && typeof t == "object" && Object.prototype.toString.call(t) === "[object Object]" && typeof t.toJSON != "function";
}
var x;
(function(t) {
  t.direct = "direct", t.patchObject = "patch object", t.patchFunction = "patch function";
})(x || (x = {}));
const H = typeof window < "u", L = (process.env.NODE_ENV !== "production" || !1) && process.env.NODE_ENV !== "test" && H;
function K(t, c) {
  for (const r in c) {
    const s = c[r];
    if (!(r in t))
      continue;
    const u = t[r];
    g(u) && g(s) && !w(s) && !W(s) ? t[r] = K(u, s) : t[r] = s;
  }
  return t;
}
const tt = () => {
};
function Q(t, c, r, s = tt) {
  t.push(c);
  const u = () => {
    const f = t.indexOf(c);
    f > -1 && (t.splice(f, 1), s());
  };
  return !r && ht() && pt(u), u;
}
function P(t, ...c) {
  t.slice().forEach((r) => {
    r(...c);
  });
}
const Et = (t) => t();
function U(t, c) {
  t instanceof Map && c instanceof Map && c.forEach((r, s) => t.set(s, r)), t instanceof Set && c instanceof Set && c.forEach(t.add, t);
  for (const r in c) {
    if (!c.hasOwnProperty(r))
      continue;
    const s = c[r], u = t[r];
    g(u) && g(s) && t.hasOwnProperty(r) && !w(s) && !W(s) ? t[r] = U(u, s) : t[r] = s;
  }
  return t;
}
const vt = process.env.NODE_ENV !== "production" ? Symbol("pinia:skipHydration") : (
  /* istanbul ignore next */
  Symbol()
);
function Nt(t) {
  return !g(t) || !t.hasOwnProperty(vt);
}
const { assign: y } = Object;
function X(t) {
  return !!(w(t) && t.effect);
}
function Y(t, c, r, s) {
  const { state: u, actions: f, getters: d } = c, i = r.state.value[t];
  let b;
  function _() {
    !i && (process.env.NODE_ENV === "production" || !s) && (r.state.value[t] = u ? u() : {});
    const E = process.env.NODE_ENV !== "production" && s ? (
      // use ref() to unwrap refs inside state TODO: check if this is still necessary
      B(Z(u ? u() : {}).value)
    ) : B(r.state.value[t]);
    return y(E, f, Object.keys(d || {}).reduce((l, h) => (process.env.NODE_ENV !== "production" && h in E && console.warn(`[🍍]: A getter cannot have the same name as another state property. Rename one of them. Found with "${h}" in store "${t}".`), l[h] = S(G(() => {
      I(r);
      const v = r._s.get(t);
      return d[h].call(v, v);
    })), l), {}));
  }
  return b = F(t, _, c, r, s, !0), b;
}
function F(t, c, r = {}, s, u, f) {
  let d;
  const i = y({ actions: {} }, r);
  if (process.env.NODE_ENV !== "production" && !s._e.active)
    throw new Error("Pinia destroyed");
  const b = {
    deep: !0
    // flush: 'post',
  };
  process.env.NODE_ENV !== "production" && !dt && (b.onTrigger = (o) => {
    _ ? v = o : _ == !1 && !n._hotUpdating && (Array.isArray(v) ? v.push(o) : console.error("🍍 debuggerEvents should be an array. This is most likely an internal Pinia bug."));
  });
  let _, E, l = [], h = [], v;
  const O = s.state.value[t];
  !f && !O && (process.env.NODE_ENV === "production" || !u) && (s.state.value[t] = {});
  const k = Z({});
  let J;
  function M(o) {
    let e;
    _ = E = !1, process.env.NODE_ENV !== "production" && (v = []), typeof o == "function" ? (o(s.state.value[t]), e = {
      type: x.patchFunction,
      storeId: t,
      events: v
    }) : (U(s.state.value[t], o), e = {
      type: x.patchObject,
      payload: o,
      storeId: t,
      events: v
    });
    const a = J = Symbol();
    z().then(() => {
      J === a && (_ = !0);
    }), E = !0, P(l, e, s.state.value[t]);
  }
  const et = f ? function() {
    const { state: e } = r, a = e ? e() : {};
    this.$patch((p) => {
      y(p, a);
    });
  } : (
    /* istanbul ignore next */
    process.env.NODE_ENV !== "production" ? () => {
      throw new Error(`🍍: Store "${t}" is built using the setup syntax and does not implement $reset().`);
    } : tt
  );
  function st() {
    d.stop(), l = [], h = [], s._s.delete(t);
  }
  function T(o, e) {
    return function() {
      I(s);
      const a = Array.from(arguments), p = [], V = [];
      function ot(N) {
        p.push(N);
      }
      function nt(N) {
        V.push(N);
      }
      P(h, {
        args: a,
        name: o,
        store: n,
        after: ot,
        onError: nt
      });
      let D;
      try {
        D = e.apply(this && this.$id === t ? this : n, a);
      } catch (N) {
        throw P(V, N), N;
      }
      return D instanceof Promise ? D.then((N) => (P(p, N), N)).catch((N) => (P(V, N), Promise.reject(N))) : (P(p, D), D);
    };
  }
  const C = /* @__PURE__ */ S({
    actions: {},
    getters: {},
    state: [],
    hotState: k
  }), q = {
    _p: s,
    // _s: scope,
    $id: t,
    $onAction: Q.bind(null, h),
    $patch: M,
    $reset: et,
    $subscribe(o, e = {}) {
      const a = Q(l, o, e.detached, () => p()), p = d.run(() => at(() => s.state.value[t], (V) => {
        (e.flush === "sync" ? E : _) && o({
          storeId: t,
          type: x.direct,
          events: v
        }, V);
      }, y({}, b, e)));
      return a;
    },
    $dispose: st
  }, n = it(process.env.NODE_ENV !== "production" || L ? y(
    {
      _hmrPayload: C,
      _customProperties: S(/* @__PURE__ */ new Set())
      // devtools custom properties
    },
    q
    // must be added later
    // setupStore
  ) : q);
  s._s.set(t, n);
  const m = (s._a && s._a.runWithContext || Et)(() => s._e.run(() => (d = ft()).run(c)));
  for (const o in m) {
    const e = m[o];
    if (w(e) && !X(e) || W(e))
      process.env.NODE_ENV !== "production" && u ? $(k.value, o, A(m, o)) : f || (O && Nt(e) && (w(e) ? e.value = O[o] : U(e, O[o])), s.state.value[t][o] = e), process.env.NODE_ENV !== "production" && C.state.push(o);
    else if (typeof e == "function") {
      const a = process.env.NODE_ENV !== "production" && u ? e : T(o, e);
      m[o] = a, process.env.NODE_ENV !== "production" && (C.actions[o] = e), i.actions[o] = e;
    } else process.env.NODE_ENV !== "production" && X(e) && (C.getters[o] = f ? (
      // @ts-expect-error
      r.getters[o]
    ) : e, H && (m._getters || // @ts-expect-error: same
    (m._getters = S([]))).push(o));
  }
  if (y(n, m), y(lt(n), m), Object.defineProperty(n, "$state", {
    get: () => process.env.NODE_ENV !== "production" && u ? k.value : s.state.value[t],
    set: (o) => {
      if (process.env.NODE_ENV !== "production" && u)
        throw new Error("cannot set hotState");
      M((e) => {
        y(e, o);
      });
    }
  }), process.env.NODE_ENV !== "production" && (n._hotUpdate = S((o) => {
    n._hotUpdating = !0, o._hmrPayload.state.forEach((e) => {
      if (e in n.$state) {
        const a = o.$state[e], p = n.$state[e];
        typeof a == "object" && g(a) && g(p) ? K(a, p) : o.$state[e] = p;
      }
      $(n, e, A(o.$state, e));
    }), Object.keys(n.$state).forEach((e) => {
      e in o.$state || R(n, e);
    }), _ = !1, E = !1, s.state.value[t] = A(o._hmrPayload, "hotState"), E = !0, z().then(() => {
      _ = !0;
    });
    for (const e in o._hmrPayload.actions) {
      const a = o[e];
      $(n, e, T(e, a));
    }
    for (const e in o._hmrPayload.getters) {
      const a = o._hmrPayload.getters[e], p = f ? (
        // special handling of options api
        G(() => (I(s), a.call(n, n)))
      ) : a;
      $(n, e, p);
    }
    Object.keys(n._hmrPayload.getters).forEach((e) => {
      e in o._hmrPayload.getters || R(n, e);
    }), Object.keys(n._hmrPayload.actions).forEach((e) => {
      e in o._hmrPayload.actions || R(n, e);
    }), n._hmrPayload = o._hmrPayload, n._getters = o._getters, n._hotUpdating = !1;
  })), L) {
    const o = {
      writable: !0,
      configurable: !0,
      // avoid warning on devtools trying to display this property
      enumerable: !1
    };
    ["_p", "_hmrPayload", "_getters", "_customProperties"].forEach((e) => {
      Object.defineProperty(n, e, y({ value: n[e] }, o));
    });
  }
  return s._p.forEach((o) => {
    if (L) {
      const e = d.run(() => o({
        store: n,
        app: s._a,
        pinia: s,
        options: i
      }));
      Object.keys(e || {}).forEach((a) => n._customProperties.add(a)), y(n, e);
    } else
      y(n, d.run(() => o({
        store: n,
        app: s._a,
        pinia: s,
        options: i
      })));
  }), process.env.NODE_ENV !== "production" && n.$state && typeof n.$state == "object" && typeof n.$state.constructor == "function" && !n.$state.constructor.toString().includes("[native code]") && console.warn(`[🍍]: The "state" must be a plain object. It cannot be
	state: () => new MyClass()
Found in store "${n.$id}".`), O && f && r.hydrate && r.hydrate(n.$state, O), _ = !0, E = !0, n;
}
function yt(t, c, r) {
  let s, u;
  const f = typeof c == "function";
  s = t, u = f ? r : c;
  function d(i, b) {
    const _ = rt();
    if (i = // in test mode, ignore the argument provided as we can always retrieve a
    // pinia instance with getActivePinia()
    (process.env.NODE_ENV === "test" && j && j._testing ? null : i) || (_ ? ct(_t, null) : null), i && I(i), process.env.NODE_ENV !== "production" && !j)
      throw new Error(`[🍍]: "getActivePinia()" was called but there was no active Pinia. Are you trying to use a store before calling "app.use(pinia)"?
See https://pinia.vuejs.org/core-concepts/outside-component-usage.html for help.
This will fail in production.`);
    i = j, i._s.has(s) || (f ? F(s, c, u, i) : Y(s, u, i), process.env.NODE_ENV !== "production" && (d._pinia = i));
    const E = i._s.get(s);
    if (process.env.NODE_ENV !== "production" && b) {
      const l = "__hot:" + s, h = f ? F(l, c, u, i, !0) : Y(l, y({}, u), i, !0);
      b._hotUpdate(h), delete i.state.value[l], i._s.delete(l);
    }
    if (process.env.NODE_ENV !== "production" && H) {
      const l = ut();
      if (l && l.proxy && // avoid adding stores that are just built for hot module replacement
      !b) {
        const h = l.proxy, v = "_pStores" in h ? h._pStores : h._pStores = {};
        v[s] = E;
      }
    }
    return E;
  }
  return d.$id = s, d;
}
const gt = yt("auth", {
  persist: !0,
  state: () => ({
    user: null
  }),
  getters: {
    isAuthenticated: (t) => t.user !== null
  },
  actions: {
    setUser(t) {
      this.user = t;
    },
    unsetUser() {
      this.user = null;
    }
  }
});
export {
  gt as u
};
