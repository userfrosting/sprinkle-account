import { a as et, b as tt } from "./types-D8dYVvPt.js";
import { defineStore as nt } from "pinia";
function Ce(e, t) {
  return function() {
    return e.apply(t, arguments);
  };
}
const { toString: rt } = Object.prototype, { getPrototypeOf: ce } = Object, W = /* @__PURE__ */ ((e) => (t) => {
  const r = rt.call(t);
  return e[r] || (e[r] = r.slice(8, -1).toLowerCase());
})(/* @__PURE__ */ Object.create(null)), x = (e) => (e = e.toLowerCase(), (t) => W(t) === e), K = (e) => (t) => typeof t === e, { isArray: F } = Array, D = K("undefined");
function ot(e) {
  return e !== null && !D(e) && e.constructor !== null && !D(e.constructor) && S(e.constructor.isBuffer) && e.constructor.isBuffer(e);
}
const ve = x("ArrayBuffer");
function st(e) {
  let t;
  return typeof ArrayBuffer < "u" && ArrayBuffer.isView ? t = ArrayBuffer.isView(e) : t = e && e.buffer && ve(e.buffer), t;
}
const it = K("string"), S = K("function"), Ne = K("number"), V = (e) => e !== null && typeof e == "object", at = (e) => e === !0 || e === !1, I = (e) => {
  if (W(e) !== "object")
    return !1;
  const t = ce(e);
  return (t === null || t === Object.prototype || Object.getPrototypeOf(t) === null) && !(Symbol.toStringTag in e) && !(Symbol.iterator in e);
}, ct = x("Date"), ut = x("File"), lt = x("Blob"), ft = x("FileList"), dt = (e) => V(e) && S(e.pipe), pt = (e) => {
  let t;
  return e && (typeof FormData == "function" && e instanceof FormData || S(e.append) && ((t = W(e)) === "formdata" || // detect form-data instance
  t === "object" && S(e.toString) && e.toString() === "[object FormData]"));
}, ht = x("URLSearchParams"), [mt, gt, bt, yt] = ["ReadableStream", "Request", "Response", "Headers"].map(x), wt = (e) => e.trim ? e.trim() : e.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "");
function k(e, t, { allOwnKeys: r = !1 } = {}) {
  if (e === null || typeof e > "u")
    return;
  let n, o;
  if (typeof e != "object" && (e = [e]), F(e))
    for (n = 0, o = e.length; n < o; n++)
      t.call(null, e[n], n, e);
  else {
    const s = r ? Object.getOwnPropertyNames(e) : Object.keys(e), i = s.length;
    let c;
    for (n = 0; n < i; n++)
      c = s[n], t.call(null, e[c], c, e);
  }
}
function Pe(e, t) {
  t = t.toLowerCase();
  const r = Object.keys(e);
  let n = r.length, o;
  for (; n-- > 0; )
    if (o = r[n], t === o.toLowerCase())
      return o;
  return null;
}
const N = typeof globalThis < "u" ? globalThis : typeof self < "u" ? self : typeof window < "u" ? window : global, _e = (e) => !D(e) && e !== N;
function te() {
  const { caseless: e } = _e(this) && this || {}, t = {}, r = (n, o) => {
    const s = e && Pe(t, o) || o;
    I(t[s]) && I(n) ? t[s] = te(t[s], n) : I(n) ? t[s] = te({}, n) : F(n) ? t[s] = n.slice() : t[s] = n;
  };
  for (let n = 0, o = arguments.length; n < o; n++)
    arguments[n] && k(arguments[n], r);
  return t;
}
const Et = (e, t, r, { allOwnKeys: n } = {}) => (k(t, (o, s) => {
  r && S(o) ? e[s] = Ce(o, r) : e[s] = o;
}, { allOwnKeys: n }), e), Rt = (e) => (e.charCodeAt(0) === 65279 && (e = e.slice(1)), e), Ot = (e, t, r, n) => {
  e.prototype = Object.create(t.prototype, n), e.prototype.constructor = e, Object.defineProperty(e, "super", {
    value: t.prototype
  }), r && Object.assign(e.prototype, r);
}, St = (e, t, r, n) => {
  let o, s, i;
  const c = {};
  if (t = t || {}, e == null) return t;
  do {
    for (o = Object.getOwnPropertyNames(e), s = o.length; s-- > 0; )
      i = o[s], (!n || n(i, e, t)) && !c[i] && (t[i] = e[i], c[i] = !0);
    e = r !== !1 && ce(e);
  } while (e && (!r || r(e, t)) && e !== Object.prototype);
  return t;
}, Tt = (e, t, r) => {
  e = String(e), (r === void 0 || r > e.length) && (r = e.length), r -= t.length;
  const n = e.indexOf(t, r);
  return n !== -1 && n === r;
}, At = (e) => {
  if (!e) return null;
  if (F(e)) return e;
  let t = e.length;
  if (!Ne(t)) return null;
  const r = new Array(t);
  for (; t-- > 0; )
    r[t] = e[t];
  return r;
}, xt = /* @__PURE__ */ ((e) => (t) => e && t instanceof e)(typeof Uint8Array < "u" && ce(Uint8Array)), jt = (e, t) => {
  const r = (e && e[Symbol.iterator]).call(e);
  let n;
  for (; (n = r.next()) && !n.done; ) {
    const o = n.value;
    t.call(e, o[0], o[1]);
  }
}, Ct = (e, t) => {
  let r;
  const n = [];
  for (; (r = e.exec(t)) !== null; )
    n.push(r);
  return n;
}, vt = x("HTMLFormElement"), Nt = (e) => e.toLowerCase().replace(
  /[-_\s]([a-z\d])(\w*)/g,
  function(t, r, n) {
    return r.toUpperCase() + n;
  }
), he = (({ hasOwnProperty: e }) => (t, r) => e.call(t, r))(Object.prototype), Pt = x("RegExp"), Le = (e, t) => {
  const r = Object.getOwnPropertyDescriptors(e), n = {};
  k(r, (o, s) => {
    let i;
    (i = t(o, s, e)) !== !1 && (n[s] = i || o);
  }), Object.defineProperties(e, n);
}, _t = (e) => {
  Le(e, (t, r) => {
    if (S(e) && ["arguments", "caller", "callee"].indexOf(r) !== -1)
      return !1;
    const n = e[r];
    if (S(n)) {
      if (t.enumerable = !1, "writable" in t) {
        t.writable = !1;
        return;
      }
      t.set || (t.set = () => {
        throw Error("Can not rewrite read-only method '" + r + "'");
      });
    }
  });
}, Lt = (e, t) => {
  const r = {}, n = (o) => {
    o.forEach((s) => {
      r[s] = !0;
    });
  };
  return F(e) ? n(e) : n(String(e).split(t)), r;
}, Ft = () => {
}, Ut = (e, t) => e != null && Number.isFinite(e = +e) ? e : t, Q = "abcdefghijklmnopqrstuvwxyz", me = "0123456789", Fe = {
  DIGIT: me,
  ALPHA: Q,
  ALPHA_DIGIT: Q + Q.toUpperCase() + me
}, Bt = (e = 16, t = Fe.ALPHA_DIGIT) => {
  let r = "";
  const { length: n } = t;
  for (; e--; )
    r += t[Math.random() * n | 0];
  return r;
};
function Dt(e) {
  return !!(e && S(e.append) && e[Symbol.toStringTag] === "FormData" && e[Symbol.iterator]);
}
const kt = (e) => {
  const t = new Array(10), r = (n, o) => {
    if (V(n)) {
      if (t.indexOf(n) >= 0)
        return;
      if (!("toJSON" in n)) {
        t[o] = n;
        const s = F(n) ? [] : {};
        return k(n, (i, c) => {
          const l = r(i, o + 1);
          !D(l) && (s[c] = l);
        }), t[o] = void 0, s;
      }
    }
    return n;
  };
  return r(e, 0);
}, qt = x("AsyncFunction"), Mt = (e) => e && (V(e) || S(e)) && S(e.then) && S(e.catch), Ue = ((e, t) => e ? setImmediate : t ? ((r, n) => (N.addEventListener("message", ({ source: o, data: s }) => {
  o === N && s === r && n.length && n.shift()();
}, !1), (o) => {
  n.push(o), N.postMessage(r, "*");
}))(`axios@${Math.random()}`, []) : (r) => setTimeout(r))(
  typeof setImmediate == "function",
  S(N.postMessage)
), It = typeof queueMicrotask < "u" ? queueMicrotask.bind(N) : typeof process < "u" && process.nextTick || Ue, a = {
  isArray: F,
  isArrayBuffer: ve,
  isBuffer: ot,
  isFormData: pt,
  isArrayBufferView: st,
  isString: it,
  isNumber: Ne,
  isBoolean: at,
  isObject: V,
  isPlainObject: I,
  isReadableStream: mt,
  isRequest: gt,
  isResponse: bt,
  isHeaders: yt,
  isUndefined: D,
  isDate: ct,
  isFile: ut,
  isBlob: lt,
  isRegExp: Pt,
  isFunction: S,
  isStream: dt,
  isURLSearchParams: ht,
  isTypedArray: xt,
  isFileList: ft,
  forEach: k,
  merge: te,
  extend: Et,
  trim: wt,
  stripBOM: Rt,
  inherits: Ot,
  toFlatObject: St,
  kindOf: W,
  kindOfTest: x,
  endsWith: Tt,
  toArray: At,
  forEachEntry: jt,
  matchAll: Ct,
  isHTMLForm: vt,
  hasOwnProperty: he,
  hasOwnProp: he,
  // an alias to avoid ESLint no-prototype-builtins detection
  reduceDescriptors: Le,
  freezeMethods: _t,
  toObjectSet: Lt,
  toCamelCase: Nt,
  noop: Ft,
  toFiniteNumber: Ut,
  findKey: Pe,
  global: N,
  isContextDefined: _e,
  ALPHABET: Fe,
  generateString: Bt,
  isSpecCompliantForm: Dt,
  toJSONObject: kt,
  isAsyncFn: qt,
  isThenable: Mt,
  setImmediate: Ue,
  asap: It
};
function g(e, t, r, n, o) {
  Error.call(this), Error.captureStackTrace ? Error.captureStackTrace(this, this.constructor) : this.stack = new Error().stack, this.message = e, this.name = "AxiosError", t && (this.code = t), r && (this.config = r), n && (this.request = n), o && (this.response = o);
}
a.inherits(g, Error, {
  toJSON: function() {
    return {
      // Standard
      message: this.message,
      name: this.name,
      // Microsoft
      description: this.description,
      number: this.number,
      // Mozilla
      fileName: this.fileName,
      lineNumber: this.lineNumber,
      columnNumber: this.columnNumber,
      stack: this.stack,
      // Axios
      config: a.toJSONObject(this.config),
      code: this.code,
      status: this.response && this.response.status ? this.response.status : null
    };
  }
});
const Be = g.prototype, De = {};
[
  "ERR_BAD_OPTION_VALUE",
  "ERR_BAD_OPTION",
  "ECONNABORTED",
  "ETIMEDOUT",
  "ERR_NETWORK",
  "ERR_FR_TOO_MANY_REDIRECTS",
  "ERR_DEPRECATED",
  "ERR_BAD_RESPONSE",
  "ERR_BAD_REQUEST",
  "ERR_CANCELED",
  "ERR_NOT_SUPPORT",
  "ERR_INVALID_URL"
  // eslint-disable-next-line func-names
].forEach((e) => {
  De[e] = { value: e };
});
Object.defineProperties(g, De);
Object.defineProperty(Be, "isAxiosError", { value: !0 });
g.from = (e, t, r, n, o, s) => {
  const i = Object.create(Be);
  return a.toFlatObject(e, i, function(c) {
    return c !== Error.prototype;
  }, (c) => c !== "isAxiosError"), g.call(i, e.message, t, r, n, o), i.cause = e, i.name = e.name, s && Object.assign(i, s), i;
};
const zt = null;
function ne(e) {
  return a.isPlainObject(e) || a.isArray(e);
}
function ke(e) {
  return a.endsWith(e, "[]") ? e.slice(0, -2) : e;
}
function ge(e, t, r) {
  return e ? e.concat(t).map(function(n, o) {
    return n = ke(n), !r && o ? "[" + n + "]" : n;
  }).join(r ? "." : "") : t;
}
function Ht(e) {
  return a.isArray(e) && !e.some(ne);
}
const Jt = a.toFlatObject(a, {}, null, function(e) {
  return /^is[A-Z]/.test(e);
});
function $(e, t, r) {
  if (!a.isObject(e))
    throw new TypeError("target must be an object");
  t = t || new FormData(), r = a.toFlatObject(r, {
    metaTokens: !0,
    dots: !1,
    indexes: !1
  }, !1, function(m, h) {
    return !a.isUndefined(h[m]);
  });
  const n = r.metaTokens, o = r.visitor || u, s = r.dots, i = r.indexes, c = (r.Blob || typeof Blob < "u" && Blob) && a.isSpecCompliantForm(t);
  if (!a.isFunction(o))
    throw new TypeError("visitor must be a function");
  function l(m) {
    if (m === null) return "";
    if (a.isDate(m))
      return m.toISOString();
    if (!c && a.isBlob(m))
      throw new g("Blob is not supported. Use a Buffer instead.");
    return a.isArrayBuffer(m) || a.isTypedArray(m) ? c && typeof Blob == "function" ? new Blob([m]) : Buffer.from(m) : m;
  }
  function u(m, h, d) {
    let E = m;
    if (m && !d && typeof m == "object") {
      if (a.endsWith(h, "{}"))
        h = n ? h : h.slice(0, -2), m = JSON.stringify(m);
      else if (a.isArray(m) && Ht(m) || (a.isFileList(m) || a.endsWith(h, "[]")) && (E = a.toArray(m)))
        return h = ke(h), E.forEach(function(T, R) {
          !(a.isUndefined(T) || T === null) && t.append(
            // eslint-disable-next-line no-nested-ternary
            i === !0 ? ge([h], R, s) : i === null ? h : h + "[]",
            l(T)
          );
        }), !1;
    }
    return ne(m) ? !0 : (t.append(ge(d, h, s), l(m)), !1);
  }
  const f = [], p = Object.assign(Jt, {
    defaultVisitor: u,
    convertValue: l,
    isVisitable: ne
  });
  function y(m, h) {
    if (!a.isUndefined(m)) {
      if (f.indexOf(m) !== -1)
        throw Error("Circular reference detected in " + h.join("."));
      f.push(m), a.forEach(m, function(d, E) {
        (!(a.isUndefined(d) || d === null) && o.call(
          t,
          d,
          a.isString(E) ? E.trim() : E,
          h,
          p
        )) === !0 && y(d, h ? h.concat(E) : [E]);
      }), f.pop();
    }
  }
  if (!a.isObject(e))
    throw new TypeError("data must be an object");
  return y(e), t;
}
function be(e) {
  const t = {
    "!": "%21",
    "'": "%27",
    "(": "%28",
    ")": "%29",
    "~": "%7E",
    "%20": "+",
    "%00": "\0"
  };
  return encodeURIComponent(e).replace(/[!'()~]|%20|%00/g, function(r) {
    return t[r];
  });
}
function ue(e, t) {
  this._pairs = [], e && $(e, this, t);
}
const qe = ue.prototype;
qe.append = function(e, t) {
  this._pairs.push([e, t]);
};
qe.toString = function(e) {
  const t = e ? function(r) {
    return e.call(this, r, be);
  } : be;
  return this._pairs.map(function(r) {
    return t(r[0]) + "=" + t(r[1]);
  }, "").join("&");
};
function Wt(e) {
  return encodeURIComponent(e).replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]");
}
function Me(e, t, r) {
  if (!t)
    return e;
  const n = r && r.encode || Wt, o = r && r.serialize;
  let s;
  if (o ? s = o(t, r) : s = a.isURLSearchParams(t) ? t.toString() : new ue(t, r).toString(n), s) {
    const i = e.indexOf("#");
    i !== -1 && (e = e.slice(0, i)), e += (e.indexOf("?") === -1 ? "?" : "&") + s;
  }
  return e;
}
class ye {
  constructor() {
    this.handlers = [];
  }
  /**
   * Add a new interceptor to the stack
   *
   * @param {Function} fulfilled The function to handle `then` for a `Promise`
   * @param {Function} rejected The function to handle `reject` for a `Promise`
   *
   * @return {Number} An ID used to remove interceptor later
   */
  use(t, r, n) {
    return this.handlers.push({
      fulfilled: t,
      rejected: r,
      synchronous: n ? n.synchronous : !1,
      runWhen: n ? n.runWhen : null
    }), this.handlers.length - 1;
  }
  /**
   * Remove an interceptor from the stack
   *
   * @param {Number} id The ID that was returned by `use`
   *
   * @returns {Boolean} `true` if the interceptor was removed, `false` otherwise
   */
  eject(t) {
    this.handlers[t] && (this.handlers[t] = null);
  }
  /**
   * Clear all interceptors from the stack
   *
   * @returns {void}
   */
  clear() {
    this.handlers && (this.handlers = []);
  }
  /**
   * Iterate over all the registered interceptors
   *
   * This method is particularly useful for skipping over any
   * interceptors that may have become `null` calling `eject`.
   *
   * @param {Function} fn The function to call for each interceptor
   *
   * @returns {void}
   */
  forEach(t) {
    a.forEach(this.handlers, function(r) {
      r !== null && t(r);
    });
  }
}
const Ie = {
  silentJSONParsing: !0,
  forcedJSONParsing: !0,
  clarifyTimeoutError: !1
}, Kt = typeof URLSearchParams < "u" ? URLSearchParams : ue, Vt = typeof FormData < "u" ? FormData : null, $t = typeof Blob < "u" ? Blob : null, Gt = {
  isBrowser: !0,
  classes: {
    URLSearchParams: Kt,
    FormData: Vt,
    Blob: $t
  },
  protocols: ["http", "https", "file", "blob", "url", "data"]
}, le = typeof window < "u" && typeof document < "u", Xt = ((e) => le && ["ReactNative", "NativeScript", "NS"].indexOf(e) < 0)(typeof navigator < "u" && navigator.product), Qt = typeof WorkerGlobalScope < "u" && // eslint-disable-next-line no-undef
self instanceof WorkerGlobalScope && typeof self.importScripts == "function", Zt = le && window.location.href || "http://localhost", Yt = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  hasBrowserEnv: le,
  hasStandardBrowserEnv: Xt,
  hasStandardBrowserWebWorkerEnv: Qt,
  origin: Zt
}, Symbol.toStringTag, { value: "Module" })), A = {
  ...Yt,
  ...Gt
};
function en(e, t) {
  return $(e, new A.classes.URLSearchParams(), Object.assign({
    visitor: function(r, n, o, s) {
      return A.isNode && a.isBuffer(r) ? (this.append(n, r.toString("base64")), !1) : s.defaultVisitor.apply(this, arguments);
    }
  }, t));
}
function tn(e) {
  return a.matchAll(/\w+|\[(\w*)]/g, e).map((t) => t[0] === "[]" ? "" : t[1] || t[0]);
}
function nn(e) {
  const t = {}, r = Object.keys(e);
  let n;
  const o = r.length;
  let s;
  for (n = 0; n < o; n++)
    s = r[n], t[s] = e[s];
  return t;
}
function ze(e) {
  function t(r, n, o, s) {
    let i = r[s++];
    if (i === "__proto__") return !0;
    const c = Number.isFinite(+i), l = s >= r.length;
    return i = !i && a.isArray(o) ? o.length : i, l ? (a.hasOwnProp(o, i) ? o[i] = [o[i], n] : o[i] = n, !c) : ((!o[i] || !a.isObject(o[i])) && (o[i] = []), t(r, n, o[i], s) && a.isArray(o[i]) && (o[i] = nn(o[i])), !c);
  }
  if (a.isFormData(e) && a.isFunction(e.entries)) {
    const r = {};
    return a.forEachEntry(e, (n, o) => {
      t(tn(n), o, r, 0);
    }), r;
  }
  return null;
}
function rn(e, t, r) {
  if (a.isString(e))
    try {
      return (t || JSON.parse)(e), a.trim(e);
    } catch (n) {
      if (n.name !== "SyntaxError")
        throw n;
    }
  return (0, JSON.stringify)(e);
}
const q = {
  transitional: Ie,
  adapter: ["xhr", "http", "fetch"],
  transformRequest: [function(e, t) {
    const r = t.getContentType() || "", n = r.indexOf("application/json") > -1, o = a.isObject(e);
    if (o && a.isHTMLForm(e) && (e = new FormData(e)), a.isFormData(e))
      return n ? JSON.stringify(ze(e)) : e;
    if (a.isArrayBuffer(e) || a.isBuffer(e) || a.isStream(e) || a.isFile(e) || a.isBlob(e) || a.isReadableStream(e))
      return e;
    if (a.isArrayBufferView(e))
      return e.buffer;
    if (a.isURLSearchParams(e))
      return t.setContentType("application/x-www-form-urlencoded;charset=utf-8", !1), e.toString();
    let s;
    if (o) {
      if (r.indexOf("application/x-www-form-urlencoded") > -1)
        return en(e, this.formSerializer).toString();
      if ((s = a.isFileList(e)) || r.indexOf("multipart/form-data") > -1) {
        const i = this.env && this.env.FormData;
        return $(
          s ? { "files[]": e } : e,
          i && new i(),
          this.formSerializer
        );
      }
    }
    return o || n ? (t.setContentType("application/json", !1), rn(e)) : e;
  }],
  transformResponse: [function(e) {
    const t = this.transitional || q.transitional, r = t && t.forcedJSONParsing, n = this.responseType === "json";
    if (a.isResponse(e) || a.isReadableStream(e))
      return e;
    if (e && a.isString(e) && (r && !this.responseType || n)) {
      const o = !(t && t.silentJSONParsing) && n;
      try {
        return JSON.parse(e);
      } catch (s) {
        if (o)
          throw s.name === "SyntaxError" ? g.from(s, g.ERR_BAD_RESPONSE, this, null, this.response) : s;
      }
    }
    return e;
  }],
  /**
   * A timeout in milliseconds to abort a request. If set to 0 (default) a
   * timeout is not created.
   */
  timeout: 0,
  xsrfCookieName: "XSRF-TOKEN",
  xsrfHeaderName: "X-XSRF-TOKEN",
  maxContentLength: -1,
  maxBodyLength: -1,
  env: {
    FormData: A.classes.FormData,
    Blob: A.classes.Blob
  },
  validateStatus: function(e) {
    return e >= 200 && e < 300;
  },
  headers: {
    common: {
      Accept: "application/json, text/plain, */*",
      "Content-Type": void 0
    }
  }
};
a.forEach(["delete", "get", "head", "post", "put", "patch"], (e) => {
  q.headers[e] = {};
});
const on = a.toObjectSet([
  "age",
  "authorization",
  "content-length",
  "content-type",
  "etag",
  "expires",
  "from",
  "host",
  "if-modified-since",
  "if-unmodified-since",
  "last-modified",
  "location",
  "max-forwards",
  "proxy-authorization",
  "referer",
  "retry-after",
  "user-agent"
]), sn = (e) => {
  const t = {};
  let r, n, o;
  return e && e.split(`
`).forEach(function(s) {
    o = s.indexOf(":"), r = s.substring(0, o).trim().toLowerCase(), n = s.substring(o + 1).trim(), !(!r || t[r] && on[r]) && (r === "set-cookie" ? t[r] ? t[r].push(n) : t[r] = [n] : t[r] = t[r] ? t[r] + ", " + n : n);
  }), t;
}, we = Symbol("internals");
function B(e) {
  return e && String(e).trim().toLowerCase();
}
function z(e) {
  return e === !1 || e == null ? e : a.isArray(e) ? e.map(z) : String(e);
}
function an(e) {
  const t = /* @__PURE__ */ Object.create(null), r = /([^\s,;=]+)\s*(?:=\s*([^,;]+))?/g;
  let n;
  for (; n = r.exec(e); )
    t[n[1]] = n[2];
  return t;
}
const cn = (e) => /^[-_a-zA-Z0-9^`|~,!#$%&'*+.]+$/.test(e.trim());
function Z(e, t, r, n, o) {
  if (a.isFunction(n))
    return n.call(this, t, r);
  if (o && (t = r), !!a.isString(t)) {
    if (a.isString(n))
      return t.indexOf(n) !== -1;
    if (a.isRegExp(n))
      return n.test(t);
  }
}
function un(e) {
  return e.trim().toLowerCase().replace(/([a-z\d])(\w*)/g, (t, r, n) => r.toUpperCase() + n);
}
function ln(e, t) {
  const r = a.toCamelCase(" " + t);
  ["get", "set", "has"].forEach((n) => {
    Object.defineProperty(e, n + r, {
      value: function(o, s, i) {
        return this[n].call(this, t, o, s, i);
      },
      configurable: !0
    });
  });
}
class O {
  constructor(t) {
    t && this.set(t);
  }
  set(t, r, n) {
    const o = this;
    function s(c, l, u) {
      const f = B(l);
      if (!f)
        throw new Error("header name must be a non-empty string");
      const p = a.findKey(o, f);
      (!p || o[p] === void 0 || u === !0 || u === void 0 && o[p] !== !1) && (o[p || l] = z(c));
    }
    const i = (c, l) => a.forEach(c, (u, f) => s(u, f, l));
    if (a.isPlainObject(t) || t instanceof this.constructor)
      i(t, r);
    else if (a.isString(t) && (t = t.trim()) && !cn(t))
      i(sn(t), r);
    else if (a.isHeaders(t))
      for (const [c, l] of t.entries())
        s(l, c, n);
    else
      t != null && s(r, t, n);
    return this;
  }
  get(t, r) {
    if (t = B(t), t) {
      const n = a.findKey(this, t);
      if (n) {
        const o = this[n];
        if (!r)
          return o;
        if (r === !0)
          return an(o);
        if (a.isFunction(r))
          return r.call(this, o, n);
        if (a.isRegExp(r))
          return r.exec(o);
        throw new TypeError("parser must be boolean|regexp|function");
      }
    }
  }
  has(t, r) {
    if (t = B(t), t) {
      const n = a.findKey(this, t);
      return !!(n && this[n] !== void 0 && (!r || Z(this, this[n], n, r)));
    }
    return !1;
  }
  delete(t, r) {
    const n = this;
    let o = !1;
    function s(i) {
      if (i = B(i), i) {
        const c = a.findKey(n, i);
        c && (!r || Z(n, n[c], c, r)) && (delete n[c], o = !0);
      }
    }
    return a.isArray(t) ? t.forEach(s) : s(t), o;
  }
  clear(t) {
    const r = Object.keys(this);
    let n = r.length, o = !1;
    for (; n--; ) {
      const s = r[n];
      (!t || Z(this, this[s], s, t, !0)) && (delete this[s], o = !0);
    }
    return o;
  }
  normalize(t) {
    const r = this, n = {};
    return a.forEach(this, (o, s) => {
      const i = a.findKey(n, s);
      if (i) {
        r[i] = z(o), delete r[s];
        return;
      }
      const c = t ? un(s) : String(s).trim();
      c !== s && delete r[s], r[c] = z(o), n[c] = !0;
    }), this;
  }
  concat(...t) {
    return this.constructor.concat(this, ...t);
  }
  toJSON(t) {
    const r = /* @__PURE__ */ Object.create(null);
    return a.forEach(this, (n, o) => {
      n != null && n !== !1 && (r[o] = t && a.isArray(n) ? n.join(", ") : n);
    }), r;
  }
  [Symbol.iterator]() {
    return Object.entries(this.toJSON())[Symbol.iterator]();
  }
  toString() {
    return Object.entries(this.toJSON()).map(([t, r]) => t + ": " + r).join(`
`);
  }
  get [Symbol.toStringTag]() {
    return "AxiosHeaders";
  }
  static from(t) {
    return t instanceof this ? t : new this(t);
  }
  static concat(t, ...r) {
    const n = new this(t);
    return r.forEach((o) => n.set(o)), n;
  }
  static accessor(t) {
    const r = (this[we] = this[we] = {
      accessors: {}
    }).accessors, n = this.prototype;
    function o(s) {
      const i = B(s);
      r[i] || (ln(n, s), r[i] = !0);
    }
    return a.isArray(t) ? t.forEach(o) : o(t), this;
  }
}
O.accessor(["Content-Type", "Content-Length", "Accept", "Accept-Encoding", "User-Agent", "Authorization"]);
a.reduceDescriptors(O.prototype, ({ value: e }, t) => {
  let r = t[0].toUpperCase() + t.slice(1);
  return {
    get: () => e,
    set(n) {
      this[r] = n;
    }
  };
});
a.freezeMethods(O);
function Y(e, t) {
  const r = this || q, n = t || r, o = O.from(n.headers);
  let s = n.data;
  return a.forEach(e, function(i) {
    s = i.call(r, s, o.normalize(), t ? t.status : void 0);
  }), o.normalize(), s;
}
function He(e) {
  return !!(e && e.__CANCEL__);
}
function U(e, t, r) {
  g.call(this, e ?? "canceled", g.ERR_CANCELED, t, r), this.name = "CanceledError";
}
a.inherits(U, g, {
  __CANCEL__: !0
});
function Je(e, t, r) {
  const n = r.config.validateStatus;
  !r.status || !n || n(r.status) ? e(r) : t(new g(
    "Request failed with status code " + r.status,
    [g.ERR_BAD_REQUEST, g.ERR_BAD_RESPONSE][Math.floor(r.status / 100) - 4],
    r.config,
    r.request,
    r
  ));
}
function fn(e) {
  const t = /^([-+\w]{1,25})(:?\/\/|:)/.exec(e);
  return t && t[1] || "";
}
function dn(e, t) {
  e = e || 10;
  const r = new Array(e), n = new Array(e);
  let o = 0, s = 0, i;
  return t = t !== void 0 ? t : 1e3, function(c) {
    const l = Date.now(), u = n[s];
    i || (i = l), r[o] = c, n[o] = l;
    let f = s, p = 0;
    for (; f !== o; )
      p += r[f++], f = f % e;
    if (o = (o + 1) % e, o === s && (s = (s + 1) % e), l - i < t)
      return;
    const y = u && l - u;
    return y ? Math.round(p * 1e3 / y) : void 0;
  };
}
function pn(e, t) {
  let r = 0, n = 1e3 / t, o, s;
  const i = (c, l = Date.now()) => {
    r = l, o = null, s && (clearTimeout(s), s = null), e.apply(null, c);
  };
  return [(...c) => {
    const l = Date.now(), u = l - r;
    u >= n ? i(c, l) : (o = c, s || (s = setTimeout(() => {
      s = null, i(o);
    }, n - u)));
  }, () => o && i(o)];
}
const H = (e, t, r = 3) => {
  let n = 0;
  const o = dn(50, 250);
  return pn((s) => {
    const i = s.loaded, c = s.lengthComputable ? s.total : void 0, l = i - n, u = o(l), f = i <= c;
    n = i;
    const p = {
      loaded: i,
      total: c,
      progress: c ? i / c : void 0,
      bytes: l,
      rate: u || void 0,
      estimated: u && c && f ? (c - i) / u : void 0,
      event: s,
      lengthComputable: c != null,
      [t ? "download" : "upload"]: !0
    };
    e(p);
  }, r);
}, Ee = (e, t) => {
  const r = e != null;
  return [(n) => t[0]({
    lengthComputable: r,
    total: e,
    loaded: n
  }), t[1]];
}, Re = (e) => (...t) => a.asap(() => e(...t)), hn = A.hasStandardBrowserEnv ? (
  // Standard browser envs have full support of the APIs needed to test
  // whether the request URL is of the same origin as current location.
  function() {
    const e = /(msie|trident)/i.test(navigator.userAgent), t = document.createElement("a");
    let r;
    function n(o) {
      let s = o;
      return e && (t.setAttribute("href", s), s = t.href), t.setAttribute("href", s), {
        href: t.href,
        protocol: t.protocol ? t.protocol.replace(/:$/, "") : "",
        host: t.host,
        search: t.search ? t.search.replace(/^\?/, "") : "",
        hash: t.hash ? t.hash.replace(/^#/, "") : "",
        hostname: t.hostname,
        port: t.port,
        pathname: t.pathname.charAt(0) === "/" ? t.pathname : "/" + t.pathname
      };
    }
    return r = n(window.location.href), function(o) {
      const s = a.isString(o) ? n(o) : o;
      return s.protocol === r.protocol && s.host === r.host;
    };
  }()
) : (
  // Non standard browser envs (web workers, react-native) lack needed support.
  /* @__PURE__ */ function() {
    return function() {
      return !0;
    };
  }()
), mn = A.hasStandardBrowserEnv ? (
  // Standard browser envs support document.cookie
  {
    write(e, t, r, n, o, s) {
      const i = [e + "=" + encodeURIComponent(t)];
      a.isNumber(r) && i.push("expires=" + new Date(r).toGMTString()), a.isString(n) && i.push("path=" + n), a.isString(o) && i.push("domain=" + o), s === !0 && i.push("secure"), document.cookie = i.join("; ");
    },
    read(e) {
      const t = document.cookie.match(new RegExp("(^|;\\s*)(" + e + ")=([^;]*)"));
      return t ? decodeURIComponent(t[3]) : null;
    },
    remove(e) {
      this.write(e, "", Date.now() - 864e5);
    }
  }
) : (
  // Non-standard browser env (web workers, react-native) lack needed support.
  {
    write() {
    },
    read() {
      return null;
    },
    remove() {
    }
  }
);
function gn(e) {
  return /^([a-z][a-z\d+\-.]*:)?\/\//i.test(e);
}
function bn(e, t) {
  return t ? e.replace(/\/?\/$/, "") + "/" + t.replace(/^\/+/, "") : e;
}
function We(e, t) {
  return e && !gn(t) ? bn(e, t) : t;
}
const Oe = (e) => e instanceof O ? { ...e } : e;
function _(e, t) {
  t = t || {};
  const r = {};
  function n(u, f, p) {
    return a.isPlainObject(u) && a.isPlainObject(f) ? a.merge.call({ caseless: p }, u, f) : a.isPlainObject(f) ? a.merge({}, f) : a.isArray(f) ? f.slice() : f;
  }
  function o(u, f, p) {
    if (a.isUndefined(f)) {
      if (!a.isUndefined(u))
        return n(void 0, u, p);
    } else return n(u, f, p);
  }
  function s(u, f) {
    if (!a.isUndefined(f))
      return n(void 0, f);
  }
  function i(u, f) {
    if (a.isUndefined(f)) {
      if (!a.isUndefined(u))
        return n(void 0, u);
    } else return n(void 0, f);
  }
  function c(u, f, p) {
    if (p in t)
      return n(u, f);
    if (p in e)
      return n(void 0, u);
  }
  const l = {
    url: s,
    method: s,
    data: s,
    baseURL: i,
    transformRequest: i,
    transformResponse: i,
    paramsSerializer: i,
    timeout: i,
    timeoutMessage: i,
    withCredentials: i,
    withXSRFToken: i,
    adapter: i,
    responseType: i,
    xsrfCookieName: i,
    xsrfHeaderName: i,
    onUploadProgress: i,
    onDownloadProgress: i,
    decompress: i,
    maxContentLength: i,
    maxBodyLength: i,
    beforeRedirect: i,
    transport: i,
    httpAgent: i,
    httpsAgent: i,
    cancelToken: i,
    socketPath: i,
    responseEncoding: i,
    validateStatus: c,
    headers: (u, f) => o(Oe(u), Oe(f), !0)
  };
  return a.forEach(Object.keys(Object.assign({}, e, t)), function(u) {
    const f = l[u] || o, p = f(e[u], t[u], u);
    a.isUndefined(p) && f !== c || (r[u] = p);
  }), r;
}
const Ke = (e) => {
  const t = _({}, e);
  let { data: r, withXSRFToken: n, xsrfHeaderName: o, xsrfCookieName: s, headers: i, auth: c } = t;
  t.headers = i = O.from(i), t.url = Me(We(t.baseURL, t.url), e.params, e.paramsSerializer), c && i.set(
    "Authorization",
    "Basic " + btoa((c.username || "") + ":" + (c.password ? unescape(encodeURIComponent(c.password)) : ""))
  );
  let l;
  if (a.isFormData(r)) {
    if (A.hasStandardBrowserEnv || A.hasStandardBrowserWebWorkerEnv)
      i.setContentType(void 0);
    else if ((l = i.getContentType()) !== !1) {
      const [u, ...f] = l ? l.split(";").map((p) => p.trim()).filter(Boolean) : [];
      i.setContentType([u || "multipart/form-data", ...f].join("; "));
    }
  }
  if (A.hasStandardBrowserEnv && (n && a.isFunction(n) && (n = n(t)), n || n !== !1 && hn(t.url))) {
    const u = o && s && mn.read(s);
    u && i.set(o, u);
  }
  return t;
}, yn = typeof XMLHttpRequest < "u", wn = yn && function(e) {
  return new Promise(function(t, r) {
    const n = Ke(e);
    let o = n.data;
    const s = O.from(n.headers).normalize();
    let { responseType: i, onUploadProgress: c, onDownloadProgress: l } = n, u, f, p, y, m;
    function h() {
      y && y(), m && m(), n.cancelToken && n.cancelToken.unsubscribe(u), n.signal && n.signal.removeEventListener("abort", u);
    }
    let d = new XMLHttpRequest();
    d.open(n.method.toUpperCase(), n.url, !0), d.timeout = n.timeout;
    function E() {
      if (!d)
        return;
      const R = O.from(
        "getAllResponseHeaders" in d && d.getAllResponseHeaders()
      ), b = {
        data: !i || i === "text" || i === "json" ? d.responseText : d.response,
        status: d.status,
        statusText: d.statusText,
        headers: R,
        config: e,
        request: d
      };
      Je(function(v) {
        t(v), h();
      }, function(v) {
        r(v), h();
      }, b), d = null;
    }
    "onloadend" in d ? d.onloadend = E : d.onreadystatechange = function() {
      !d || d.readyState !== 4 || d.status === 0 && !(d.responseURL && d.responseURL.indexOf("file:") === 0) || setTimeout(E);
    }, d.onabort = function() {
      d && (r(new g("Request aborted", g.ECONNABORTED, e, d)), d = null);
    }, d.onerror = function() {
      r(new g("Network Error", g.ERR_NETWORK, e, d)), d = null;
    }, d.ontimeout = function() {
      let R = n.timeout ? "timeout of " + n.timeout + "ms exceeded" : "timeout exceeded";
      const b = n.transitional || Ie;
      n.timeoutErrorMessage && (R = n.timeoutErrorMessage), r(new g(
        R,
        b.clarifyTimeoutError ? g.ETIMEDOUT : g.ECONNABORTED,
        e,
        d
      )), d = null;
    }, o === void 0 && s.setContentType(null), "setRequestHeader" in d && a.forEach(s.toJSON(), function(R, b) {
      d.setRequestHeader(b, R);
    }), a.isUndefined(n.withCredentials) || (d.withCredentials = !!n.withCredentials), i && i !== "json" && (d.responseType = n.responseType), l && ([p, m] = H(l, !0), d.addEventListener("progress", p)), c && d.upload && ([f, y] = H(c), d.upload.addEventListener("progress", f), d.upload.addEventListener("loadend", y)), (n.cancelToken || n.signal) && (u = (R) => {
      d && (r(!R || R.type ? new U(null, e, d) : R), d.abort(), d = null);
    }, n.cancelToken && n.cancelToken.subscribe(u), n.signal && (n.signal.aborted ? u() : n.signal.addEventListener("abort", u)));
    const T = fn(n.url);
    if (T && A.protocols.indexOf(T) === -1) {
      r(new g("Unsupported protocol " + T + ":", g.ERR_BAD_REQUEST, e));
      return;
    }
    d.send(o || null);
  });
}, En = (e, t) => {
  let r = new AbortController(), n;
  const o = function(l) {
    if (!n) {
      n = !0, i();
      const u = l instanceof Error ? l : this.reason;
      r.abort(u instanceof g ? u : new U(u instanceof Error ? u.message : u));
    }
  };
  let s = t && setTimeout(() => {
    o(new g(`timeout ${t} of ms exceeded`, g.ETIMEDOUT));
  }, t);
  const i = () => {
    e && (s && clearTimeout(s), s = null, e.forEach((l) => {
      l && (l.removeEventListener ? l.removeEventListener("abort", o) : l.unsubscribe(o));
    }), e = null);
  };
  e.forEach((l) => l && l.addEventListener && l.addEventListener("abort", o));
  const { signal: c } = r;
  return c.unsubscribe = i, [c, () => {
    s && clearTimeout(s), s = null;
  }];
}, Rn = function* (e, t) {
  let r = e.byteLength;
  if (r < t) {
    yield e;
    return;
  }
  let n = 0, o;
  for (; n < r; )
    o = n + t, yield e.slice(n, o), n = o;
}, On = async function* (e, t, r) {
  for await (const n of e)
    yield* Rn(ArrayBuffer.isView(n) ? n : await r(String(n)), t);
}, Se = (e, t, r, n, o) => {
  const s = On(e, t, o);
  let i = 0, c, l = (u) => {
    c || (c = !0, n && n(u));
  };
  return new ReadableStream({
    async pull(u) {
      try {
        const { done: f, value: p } = await s.next();
        if (f) {
          l(), u.close();
          return;
        }
        let y = p.byteLength;
        if (r) {
          let m = i += y;
          r(m);
        }
        u.enqueue(new Uint8Array(p));
      } catch (f) {
        throw l(f), f;
      }
    },
    cancel(u) {
      return l(u), s.return();
    }
  }, {
    highWaterMark: 2
  });
}, G = typeof fetch == "function" && typeof Request == "function" && typeof Response == "function", Ve = G && typeof ReadableStream == "function", re = G && (typeof TextEncoder == "function" ? /* @__PURE__ */ ((e) => (t) => e.encode(t))(new TextEncoder()) : async (e) => new Uint8Array(await new Response(e).arrayBuffer())), $e = (e, ...t) => {
  try {
    return !!e(...t);
  } catch {
    return !1;
  }
}, Sn = Ve && $e(() => {
  let e = !1;
  const t = new Request(A.origin, {
    body: new ReadableStream(),
    method: "POST",
    get duplex() {
      return e = !0, "half";
    }
  }).headers.has("Content-Type");
  return e && !t;
}), Te = 64 * 1024, oe = Ve && $e(() => a.isReadableStream(new Response("").body)), J = {
  stream: oe && ((e) => e.body)
};
G && ((e) => {
  ["text", "arrayBuffer", "blob", "formData", "stream"].forEach((t) => {
    !J[t] && (J[t] = a.isFunction(e[t]) ? (r) => r[t]() : (r, n) => {
      throw new g(`Response type '${t}' is not supported`, g.ERR_NOT_SUPPORT, n);
    });
  });
})(new Response());
const Tn = async (e) => {
  if (e == null)
    return 0;
  if (a.isBlob(e))
    return e.size;
  if (a.isSpecCompliantForm(e))
    return (await new Request(e).arrayBuffer()).byteLength;
  if (a.isArrayBufferView(e) || a.isArrayBuffer(e))
    return e.byteLength;
  if (a.isURLSearchParams(e) && (e = e + ""), a.isString(e))
    return (await re(e)).byteLength;
}, An = async (e, t) => a.toFiniteNumber(e.getContentLength()) ?? Tn(t), xn = G && (async (e) => {
  let {
    url: t,
    method: r,
    data: n,
    signal: o,
    cancelToken: s,
    timeout: i,
    onDownloadProgress: c,
    onUploadProgress: l,
    responseType: u,
    headers: f,
    withCredentials: p = "same-origin",
    fetchOptions: y
  } = Ke(e);
  u = u ? (u + "").toLowerCase() : "text";
  let [m, h] = o || s || i ? En([o, s], i) : [], d, E;
  const T = () => {
    !d && setTimeout(() => {
      m && m.unsubscribe();
    }), d = !0;
  };
  let R;
  try {
    if (l && Sn && r !== "get" && r !== "head" && (R = await An(f, n)) !== 0) {
      let j = new Request(t, {
        method: "POST",
        body: n,
        duplex: "half"
      }), L;
      if (a.isFormData(n) && (L = j.headers.get("content-type")) && f.setContentType(L), j.body) {
        const [X, M] = Ee(
          R,
          H(Re(l))
        );
        n = Se(j.body, Te, X, M, re);
      }
    }
    a.isString(p) || (p = p ? "include" : "omit"), E = new Request(t, {
      ...y,
      signal: m,
      method: r.toUpperCase(),
      headers: f.normalize().toJSON(),
      body: n,
      duplex: "half",
      credentials: p
    });
    let b = await fetch(E);
    const v = oe && (u === "stream" || u === "response");
    if (oe && (c || v)) {
      const j = {};
      ["status", "statusText", "headers"].forEach((pe) => {
        j[pe] = b[pe];
      });
      const L = a.toFiniteNumber(b.headers.get("content-length")), [X, M] = c && Ee(
        L,
        H(Re(c), !0)
      ) || [];
      b = new Response(
        Se(b.body, Te, X, () => {
          M && M(), v && T();
        }, re),
        j
      );
    }
    u = u || "text";
    let Ye = await J[a.findKey(J, u) || "text"](b, e);
    return !v && T(), h && h(), await new Promise((j, L) => {
      Je(j, L, {
        data: Ye,
        headers: O.from(b.headers),
        status: b.status,
        statusText: b.statusText,
        config: e,
        request: E
      });
    });
  } catch (b) {
    throw T(), b && b.name === "TypeError" && /fetch/i.test(b.message) ? Object.assign(
      new g("Network Error", g.ERR_NETWORK, e, E),
      {
        cause: b.cause || b
      }
    ) : g.from(b, b && b.code, e, E);
  }
}), se = {
  http: zt,
  xhr: wn,
  fetch: xn
};
a.forEach(se, (e, t) => {
  if (e) {
    try {
      Object.defineProperty(e, "name", { value: t });
    } catch {
    }
    Object.defineProperty(e, "adapterName", { value: t });
  }
});
const Ae = (e) => `- ${e}`, jn = (e) => a.isFunction(e) || e === null || e === !1, Ge = {
  getAdapter: (e) => {
    e = a.isArray(e) ? e : [e];
    const { length: t } = e;
    let r, n;
    const o = {};
    for (let s = 0; s < t; s++) {
      r = e[s];
      let i;
      if (n = r, !jn(r) && (n = se[(i = String(r)).toLowerCase()], n === void 0))
        throw new g(`Unknown adapter '${i}'`);
      if (n)
        break;
      o[i || "#" + s] = n;
    }
    if (!n) {
      const s = Object.entries(o).map(
        ([c, l]) => `adapter ${c} ` + (l === !1 ? "is not supported by the environment" : "is not available in the build")
      );
      let i = t ? s.length > 1 ? `since :
` + s.map(Ae).join(`
`) : " " + Ae(s[0]) : "as no adapter specified";
      throw new g(
        "There is no suitable adapter to dispatch the request " + i,
        "ERR_NOT_SUPPORT"
      );
    }
    return n;
  },
  adapters: se
};
function ee(e) {
  if (e.cancelToken && e.cancelToken.throwIfRequested(), e.signal && e.signal.aborted)
    throw new U(null, e);
}
function xe(e) {
  return ee(e), e.headers = O.from(e.headers), e.data = Y.call(
    e,
    e.transformRequest
  ), ["post", "put", "patch"].indexOf(e.method) !== -1 && e.headers.setContentType("application/x-www-form-urlencoded", !1), Ge.getAdapter(e.adapter || q.adapter)(e).then(function(t) {
    return ee(e), t.data = Y.call(
      e,
      e.transformResponse,
      t
    ), t.headers = O.from(t.headers), t;
  }, function(t) {
    return He(t) || (ee(e), t && t.response && (t.response.data = Y.call(
      e,
      e.transformResponse,
      t.response
    ), t.response.headers = O.from(t.response.headers))), Promise.reject(t);
  });
}
const Xe = "1.7.3", fe = {};
["object", "boolean", "number", "function", "string", "symbol"].forEach((e, t) => {
  fe[e] = function(r) {
    return typeof r === e || "a" + (t < 1 ? "n " : " ") + e;
  };
});
const je = {};
fe.transitional = function(e, t, r) {
  function n(o, s) {
    return "[Axios v" + Xe + "] Transitional option '" + o + "'" + s + (r ? ". " + r : "");
  }
  return (o, s, i) => {
    if (e === !1)
      throw new g(
        n(s, " has been removed" + (t ? " in " + t : "")),
        g.ERR_DEPRECATED
      );
    return t && !je[s] && (je[s] = !0, console.warn(
      n(
        s,
        " has been deprecated since v" + t + " and will be removed in the near future"
      )
    )), e ? e(o, s, i) : !0;
  };
};
function Cn(e, t, r) {
  if (typeof e != "object")
    throw new g("options must be an object", g.ERR_BAD_OPTION_VALUE);
  const n = Object.keys(e);
  let o = n.length;
  for (; o-- > 0; ) {
    const s = n[o], i = t[s];
    if (i) {
      const c = e[s], l = c === void 0 || i(c, s, e);
      if (l !== !0)
        throw new g("option " + s + " must be " + l, g.ERR_BAD_OPTION_VALUE);
      continue;
    }
    if (r !== !0)
      throw new g("Unknown option " + s, g.ERR_BAD_OPTION);
  }
}
const ie = {
  assertOptions: Cn,
  validators: fe
}, C = ie.validators;
class P {
  constructor(t) {
    this.defaults = t, this.interceptors = {
      request: new ye(),
      response: new ye()
    };
  }
  /**
   * Dispatch a request
   *
   * @param {String|Object} configOrUrl The config specific for this request (merged with this.defaults)
   * @param {?Object} config
   *
   * @returns {Promise} The Promise to be fulfilled
   */
  async request(t, r) {
    try {
      return await this._request(t, r);
    } catch (n) {
      if (n instanceof Error) {
        let o;
        Error.captureStackTrace ? Error.captureStackTrace(o = {}) : o = new Error();
        const s = o.stack ? o.stack.replace(/^.+\n/, "") : "";
        try {
          n.stack ? s && !String(n.stack).endsWith(s.replace(/^.+\n.+\n/, "")) && (n.stack += `
` + s) : n.stack = s;
        } catch {
        }
      }
      throw n;
    }
  }
  _request(t, r) {
    typeof t == "string" ? (r = r || {}, r.url = t) : r = t || {}, r = _(this.defaults, r);
    const { transitional: n, paramsSerializer: o, headers: s } = r;
    n !== void 0 && ie.assertOptions(n, {
      silentJSONParsing: C.transitional(C.boolean),
      forcedJSONParsing: C.transitional(C.boolean),
      clarifyTimeoutError: C.transitional(C.boolean)
    }, !1), o != null && (a.isFunction(o) ? r.paramsSerializer = {
      serialize: o
    } : ie.assertOptions(o, {
      encode: C.function,
      serialize: C.function
    }, !0)), r.method = (r.method || this.defaults.method || "get").toLowerCase();
    let i = s && a.merge(
      s.common,
      s[r.method]
    );
    s && a.forEach(
      ["delete", "get", "head", "post", "put", "patch", "common"],
      (h) => {
        delete s[h];
      }
    ), r.headers = O.concat(i, s);
    const c = [];
    let l = !0;
    this.interceptors.request.forEach(function(h) {
      typeof h.runWhen == "function" && h.runWhen(r) === !1 || (l = l && h.synchronous, c.unshift(h.fulfilled, h.rejected));
    });
    const u = [];
    this.interceptors.response.forEach(function(h) {
      u.push(h.fulfilled, h.rejected);
    });
    let f, p = 0, y;
    if (!l) {
      const h = [xe.bind(this), void 0];
      for (h.unshift.apply(h, c), h.push.apply(h, u), y = h.length, f = Promise.resolve(r); p < y; )
        f = f.then(h[p++], h[p++]);
      return f;
    }
    y = c.length;
    let m = r;
    for (p = 0; p < y; ) {
      const h = c[p++], d = c[p++];
      try {
        m = h(m);
      } catch (E) {
        d.call(this, E);
        break;
      }
    }
    try {
      f = xe.call(this, m);
    } catch (h) {
      return Promise.reject(h);
    }
    for (p = 0, y = u.length; p < y; )
      f = f.then(u[p++], u[p++]);
    return f;
  }
  getUri(t) {
    t = _(this.defaults, t);
    const r = We(t.baseURL, t.url);
    return Me(r, t.params, t.paramsSerializer);
  }
}
a.forEach(["delete", "get", "head", "options"], function(e) {
  P.prototype[e] = function(t, r) {
    return this.request(_(r || {}, {
      method: e,
      url: t,
      data: (r || {}).data
    }));
  };
});
a.forEach(["post", "put", "patch"], function(e) {
  function t(r) {
    return function(n, o, s) {
      return this.request(_(s || {}, {
        method: e,
        headers: r ? {
          "Content-Type": "multipart/form-data"
        } : {},
        url: n,
        data: o
      }));
    };
  }
  P.prototype[e] = t(), P.prototype[e + "Form"] = t(!0);
});
class de {
  constructor(t) {
    if (typeof t != "function")
      throw new TypeError("executor must be a function.");
    let r;
    this.promise = new Promise(function(o) {
      r = o;
    });
    const n = this;
    this.promise.then((o) => {
      if (!n._listeners) return;
      let s = n._listeners.length;
      for (; s-- > 0; )
        n._listeners[s](o);
      n._listeners = null;
    }), this.promise.then = (o) => {
      let s;
      const i = new Promise((c) => {
        n.subscribe(c), s = c;
      }).then(o);
      return i.cancel = function() {
        n.unsubscribe(s);
      }, i;
    }, t(function(o, s, i) {
      n.reason || (n.reason = new U(o, s, i), r(n.reason));
    });
  }
  /**
   * Throws a `CanceledError` if cancellation has been requested.
   */
  throwIfRequested() {
    if (this.reason)
      throw this.reason;
  }
  /**
   * Subscribe to the cancel signal
   */
  subscribe(t) {
    if (this.reason) {
      t(this.reason);
      return;
    }
    this._listeners ? this._listeners.push(t) : this._listeners = [t];
  }
  /**
   * Unsubscribe from the cancel signal
   */
  unsubscribe(t) {
    if (!this._listeners)
      return;
    const r = this._listeners.indexOf(t);
    r !== -1 && this._listeners.splice(r, 1);
  }
  /**
   * Returns an object that contains a new `CancelToken` and a function that, when called,
   * cancels the `CancelToken`.
   */
  static source() {
    let t;
    return {
      token: new de(function(r) {
        t = r;
      }),
      cancel: t
    };
  }
}
function vn(e) {
  return function(t) {
    return e.apply(null, t);
  };
}
function Nn(e) {
  return a.isObject(e) && e.isAxiosError === !0;
}
const ae = {
  Continue: 100,
  SwitchingProtocols: 101,
  Processing: 102,
  EarlyHints: 103,
  Ok: 200,
  Created: 201,
  Accepted: 202,
  NonAuthoritativeInformation: 203,
  NoContent: 204,
  ResetContent: 205,
  PartialContent: 206,
  MultiStatus: 207,
  AlreadyReported: 208,
  ImUsed: 226,
  MultipleChoices: 300,
  MovedPermanently: 301,
  Found: 302,
  SeeOther: 303,
  NotModified: 304,
  UseProxy: 305,
  Unused: 306,
  TemporaryRedirect: 307,
  PermanentRedirect: 308,
  BadRequest: 400,
  Unauthorized: 401,
  PaymentRequired: 402,
  Forbidden: 403,
  NotFound: 404,
  MethodNotAllowed: 405,
  NotAcceptable: 406,
  ProxyAuthenticationRequired: 407,
  RequestTimeout: 408,
  Conflict: 409,
  Gone: 410,
  LengthRequired: 411,
  PreconditionFailed: 412,
  PayloadTooLarge: 413,
  UriTooLong: 414,
  UnsupportedMediaType: 415,
  RangeNotSatisfiable: 416,
  ExpectationFailed: 417,
  ImATeapot: 418,
  MisdirectedRequest: 421,
  UnprocessableEntity: 422,
  Locked: 423,
  FailedDependency: 424,
  TooEarly: 425,
  UpgradeRequired: 426,
  PreconditionRequired: 428,
  TooManyRequests: 429,
  RequestHeaderFieldsTooLarge: 431,
  UnavailableForLegalReasons: 451,
  InternalServerError: 500,
  NotImplemented: 501,
  BadGateway: 502,
  ServiceUnavailable: 503,
  GatewayTimeout: 504,
  HttpVersionNotSupported: 505,
  VariantAlsoNegotiates: 506,
  InsufficientStorage: 507,
  LoopDetected: 508,
  NotExtended: 510,
  NetworkAuthenticationRequired: 511
};
Object.entries(ae).forEach(([e, t]) => {
  ae[t] = e;
});
function Qe(e) {
  const t = new P(e), r = Ce(P.prototype.request, t);
  return a.extend(r, P.prototype, t, { allOwnKeys: !0 }), a.extend(r, t, null, { allOwnKeys: !0 }), r.create = function(n) {
    return Qe(_(e, n));
  }, r;
}
const w = Qe(q);
w.Axios = P;
w.CanceledError = U;
w.CancelToken = de;
w.isCancel = He;
w.VERSION = Xe;
w.toFormData = $;
w.AxiosError = g;
w.Cancel = w.CanceledError;
w.all = function(e) {
  return Promise.all(e);
};
w.spread = vn;
w.isAxiosError = Nn;
w.mergeConfig = _;
w.AxiosHeaders = O;
w.formToJSON = (e) => ze(a.isHTMLForm(e) ? new FormData(e) : e);
w.getAdapter = Ge.getAdapter;
w.HttpStatusCode = ae;
w.default = w;
const Pn = nt("config", {
  persist: !0,
  state: () => ({
    config: {}
  }),
  actions: {
    async load() {
      w.get("/api/config").then((e) => {
        this.config = e.data;
      });
    }
  }
}), Ze = Pn(), _n = {
  first_name: "",
  last_name: "",
  email: "",
  user_name: "",
  password: "",
  passwordc: "",
  // @ts-ignore
  locale: Ze.config.site.registration.user_defaults.locale,
  captcha: "",
  spiderbro: "http://"
}, Ln = Ze.config.locales.available, Fn = "/account/captcha";
async function Un(e) {
  return et.post("/account/register", e).then((t) => t.data).catch((t) => {
    throw {
      description: "An error as occurred",
      style: tt.Danger,
      closeBtn: !0,
      ...t.response.data
    };
  });
}
const kn = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  availableLocales: Ln,
  captchaUrl: Fn,
  defaultForm: _n,
  doRegister: Un
}, Symbol.toStringTag, { value: "Module" }));
export {
  kn as RegisterModule
};
