import { a as Ne, b as re } from "./types-tJXMLagF.js";
import { defineStore as nt } from "pinia";
function _e(e, t) {
  return function() {
    return e.apply(t, arguments);
  };
}
const { toString: ot } = Object.prototype, { getPrototypeOf: le } = Object, W = /* @__PURE__ */ ((e) => (t) => {
  const n = ot.call(t);
  return e[n] || (e[n] = n.slice(8, -1).toLowerCase());
})(/* @__PURE__ */ Object.create(null)), x = (e) => (e = e.toLowerCase(), (t) => W(t) === e), K = (e) => (t) => typeof t === e, { isArray: F } = Array, k = K("undefined");
function st(e) {
  return e !== null && !k(e) && e.constructor !== null && !k(e.constructor) && S(e.constructor.isBuffer) && e.constructor.isBuffer(e);
}
const Pe = x("ArrayBuffer");
function it(e) {
  let t;
  return typeof ArrayBuffer < "u" && ArrayBuffer.isView ? t = ArrayBuffer.isView(e) : t = e && e.buffer && Pe(e.buffer), t;
}
const at = K("string"), S = K("function"), Le = K("number"), V = (e) => e !== null && typeof e == "object", ct = (e) => e === !0 || e === !1, M = (e) => {
  if (W(e) !== "object")
    return !1;
  const t = le(e);
  return (t === null || t === Object.prototype || Object.getPrototypeOf(t) === null) && !(Symbol.toStringTag in e) && !(Symbol.iterator in e);
}, ut = x("Date"), lt = x("File"), ft = x("Blob"), dt = x("FileList"), pt = (e) => V(e) && S(e.pipe), ht = (e) => {
  let t;
  return e && (typeof FormData == "function" && e instanceof FormData || S(e.append) && ((t = W(e)) === "formdata" || // detect form-data instance
  t === "object" && S(e.toString) && e.toString() === "[object FormData]"));
}, mt = x("URLSearchParams"), [gt, bt, yt, wt] = ["ReadableStream", "Request", "Response", "Headers"].map(x), Et = (e) => e.trim ? e.trim() : e.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "");
function D(e, t, { allOwnKeys: n = !1 } = {}) {
  if (e === null || typeof e > "u")
    return;
  let r, o;
  if (typeof e != "object" && (e = [e]), F(e))
    for (r = 0, o = e.length; r < o; r++)
      t.call(null, e[r], r, e);
  else {
    const s = n ? Object.getOwnPropertyNames(e) : Object.keys(e), i = s.length;
    let c;
    for (r = 0; r < i; r++)
      c = s[r], t.call(null, e[c], c, e);
  }
}
function Fe(e, t) {
  t = t.toLowerCase();
  const n = Object.keys(e);
  let r = n.length, o;
  for (; r-- > 0; )
    if (o = n[r], t === o.toLowerCase())
      return o;
  return null;
}
const N = typeof globalThis < "u" ? globalThis : typeof self < "u" ? self : typeof window < "u" ? window : global, Ue = (e) => !k(e) && e !== N;
function ne() {
  const { caseless: e } = Ue(this) && this || {}, t = {}, n = (r, o) => {
    const s = e && Fe(t, o) || o;
    M(t[s]) && M(r) ? t[s] = ne(t[s], r) : M(r) ? t[s] = ne({}, r) : F(r) ? t[s] = r.slice() : t[s] = r;
  };
  for (let r = 0, o = arguments.length; r < o; r++)
    arguments[r] && D(arguments[r], n);
  return t;
}
const Rt = (e, t, n, { allOwnKeys: r } = {}) => (D(t, (o, s) => {
  n && S(o) ? e[s] = _e(o, n) : e[s] = o;
}, { allOwnKeys: r }), e), Ot = (e) => (e.charCodeAt(0) === 65279 && (e = e.slice(1)), e), St = (e, t, n, r) => {
  e.prototype = Object.create(t.prototype, r), e.prototype.constructor = e, Object.defineProperty(e, "super", {
    value: t.prototype
  }), n && Object.assign(e.prototype, n);
}, Tt = (e, t, n, r) => {
  let o, s, i;
  const c = {};
  if (t = t || {}, e == null) return t;
  do {
    for (o = Object.getOwnPropertyNames(e), s = o.length; s-- > 0; )
      i = o[s], (!r || r(i, e, t)) && !c[i] && (t[i] = e[i], c[i] = !0);
    e = n !== !1 && le(e);
  } while (e && (!n || n(e, t)) && e !== Object.prototype);
  return t;
}, At = (e, t, n) => {
  e = String(e), (n === void 0 || n > e.length) && (n = e.length), n -= t.length;
  const r = e.indexOf(t, n);
  return r !== -1 && r === n;
}, xt = (e) => {
  if (!e) return null;
  if (F(e)) return e;
  let t = e.length;
  if (!Le(t)) return null;
  const n = new Array(t);
  for (; t-- > 0; )
    n[t] = e[t];
  return n;
}, vt = /* @__PURE__ */ ((e) => (t) => e && t instanceof e)(typeof Uint8Array < "u" && le(Uint8Array)), Ct = (e, t) => {
  const n = (e && e[Symbol.iterator]).call(e);
  let r;
  for (; (r = n.next()) && !r.done; ) {
    const o = r.value;
    t.call(e, o[0], o[1]);
  }
}, jt = (e, t) => {
  let n;
  const r = [];
  for (; (n = e.exec(t)) !== null; )
    r.push(n);
  return r;
}, Nt = x("HTMLFormElement"), _t = (e) => e.toLowerCase().replace(
  /[-_\s]([a-z\d])(\w*)/g,
  function(t, n, r) {
    return n.toUpperCase() + r;
  }
), ge = (({ hasOwnProperty: e }) => (t, n) => e.call(t, n))(Object.prototype), Pt = x("RegExp"), Be = (e, t) => {
  const n = Object.getOwnPropertyDescriptors(e), r = {};
  D(n, (o, s) => {
    let i;
    (i = t(o, s, e)) !== !1 && (r[s] = i || o);
  }), Object.defineProperties(e, r);
}, Lt = (e) => {
  Be(e, (t, n) => {
    if (S(e) && ["arguments", "caller", "callee"].indexOf(n) !== -1)
      return !1;
    const r = e[n];
    if (S(r)) {
      if (t.enumerable = !1, "writable" in t) {
        t.writable = !1;
        return;
      }
      t.set || (t.set = () => {
        throw Error("Can not rewrite read-only method '" + n + "'");
      });
    }
  });
}, Ft = (e, t) => {
  const n = {}, r = (o) => {
    o.forEach((s) => {
      n[s] = !0;
    });
  };
  return F(e) ? r(e) : r(String(e).split(t)), n;
}, Ut = () => {
}, Bt = (e, t) => e != null && Number.isFinite(e = +e) ? e : t, Q = "abcdefghijklmnopqrstuvwxyz", be = "0123456789", ke = {
  DIGIT: be,
  ALPHA: Q,
  ALPHA_DIGIT: Q + Q.toUpperCase() + be
}, kt = (e = 16, t = ke.ALPHA_DIGIT) => {
  let n = "";
  const { length: r } = t;
  for (; e--; )
    n += t[Math.random() * r | 0];
  return n;
};
function Dt(e) {
  return !!(e && S(e.append) && e[Symbol.toStringTag] === "FormData" && e[Symbol.iterator]);
}
const qt = (e) => {
  const t = new Array(10), n = (r, o) => {
    if (V(r)) {
      if (t.indexOf(r) >= 0)
        return;
      if (!("toJSON" in r)) {
        t[o] = r;
        const s = F(r) ? [] : {};
        return D(r, (i, c) => {
          const l = n(i, o + 1);
          !k(l) && (s[c] = l);
        }), t[o] = void 0, s;
      }
    }
    return r;
  };
  return n(e, 0);
}, It = x("AsyncFunction"), Mt = (e) => e && (V(e) || S(e)) && S(e.then) && S(e.catch), De = ((e, t) => e ? setImmediate : t ? ((n, r) => (N.addEventListener("message", ({ source: o, data: s }) => {
  o === N && s === n && r.length && r.shift()();
}, !1), (o) => {
  r.push(o), N.postMessage(n, "*");
}))(`axios@${Math.random()}`, []) : (n) => setTimeout(n))(
  typeof setImmediate == "function",
  S(N.postMessage)
), zt = typeof queueMicrotask < "u" ? queueMicrotask.bind(N) : typeof process < "u" && process.nextTick || De, a = {
  isArray: F,
  isArrayBuffer: Pe,
  isBuffer: st,
  isFormData: ht,
  isArrayBufferView: it,
  isString: at,
  isNumber: Le,
  isBoolean: ct,
  isObject: V,
  isPlainObject: M,
  isReadableStream: gt,
  isRequest: bt,
  isResponse: yt,
  isHeaders: wt,
  isUndefined: k,
  isDate: ut,
  isFile: lt,
  isBlob: ft,
  isRegExp: Pt,
  isFunction: S,
  isStream: pt,
  isURLSearchParams: mt,
  isTypedArray: vt,
  isFileList: dt,
  forEach: D,
  merge: ne,
  extend: Rt,
  trim: Et,
  stripBOM: Ot,
  inherits: St,
  toFlatObject: Tt,
  kindOf: W,
  kindOfTest: x,
  endsWith: At,
  toArray: xt,
  forEachEntry: Ct,
  matchAll: jt,
  isHTMLForm: Nt,
  hasOwnProperty: ge,
  hasOwnProp: ge,
  // an alias to avoid ESLint no-prototype-builtins detection
  reduceDescriptors: Be,
  freezeMethods: Lt,
  toObjectSet: Ft,
  toCamelCase: _t,
  noop: Ut,
  toFiniteNumber: Bt,
  findKey: Fe,
  global: N,
  isContextDefined: Ue,
  ALPHABET: ke,
  generateString: kt,
  isSpecCompliantForm: Dt,
  toJSONObject: qt,
  isAsyncFn: It,
  isThenable: Mt,
  setImmediate: De,
  asap: zt
};
function g(e, t, n, r, o) {
  Error.call(this), Error.captureStackTrace ? Error.captureStackTrace(this, this.constructor) : this.stack = new Error().stack, this.message = e, this.name = "AxiosError", t && (this.code = t), n && (this.config = n), r && (this.request = r), o && (this.response = o);
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
const qe = g.prototype, Ie = {};
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
  Ie[e] = { value: e };
});
Object.defineProperties(g, Ie);
Object.defineProperty(qe, "isAxiosError", { value: !0 });
g.from = (e, t, n, r, o, s) => {
  const i = Object.create(qe);
  return a.toFlatObject(e, i, function(c) {
    return c !== Error.prototype;
  }, (c) => c !== "isAxiosError"), g.call(i, e.message, t, n, r, o), i.cause = e, i.name = e.name, s && Object.assign(i, s), i;
};
const Ht = null;
function oe(e) {
  return a.isPlainObject(e) || a.isArray(e);
}
function Me(e) {
  return a.endsWith(e, "[]") ? e.slice(0, -2) : e;
}
function ye(e, t, n) {
  return e ? e.concat(t).map(function(r, o) {
    return r = Me(r), !n && o ? "[" + r + "]" : r;
  }).join(n ? "." : "") : t;
}
function Jt(e) {
  return a.isArray(e) && !e.some(oe);
}
const Wt = a.toFlatObject(a, {}, null, function(e) {
  return /^is[A-Z]/.test(e);
});
function $(e, t, n) {
  if (!a.isObject(e))
    throw new TypeError("target must be an object");
  t = t || new FormData(), n = a.toFlatObject(n, {
    metaTokens: !0,
    dots: !1,
    indexes: !1
  }, !1, function(m, h) {
    return !a.isUndefined(h[m]);
  });
  const r = n.metaTokens, o = n.visitor || u, s = n.dots, i = n.indexes, c = (n.Blob || typeof Blob < "u" && Blob) && a.isSpecCompliantForm(t);
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
        h = r ? h : h.slice(0, -2), m = JSON.stringify(m);
      else if (a.isArray(m) && Jt(m) || (a.isFileList(m) || a.endsWith(h, "[]")) && (E = a.toArray(m)))
        return h = Me(h), E.forEach(function(T, R) {
          !(a.isUndefined(T) || T === null) && t.append(
            // eslint-disable-next-line no-nested-ternary
            i === !0 ? ye([h], R, s) : i === null ? h : h + "[]",
            l(T)
          );
        }), !1;
    }
    return oe(m) ? !0 : (t.append(ye(d, h, s), l(m)), !1);
  }
  const f = [], p = Object.assign(Wt, {
    defaultVisitor: u,
    convertValue: l,
    isVisitable: oe
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
function we(e) {
  const t = {
    "!": "%21",
    "'": "%27",
    "(": "%28",
    ")": "%29",
    "~": "%7E",
    "%20": "+",
    "%00": "\0"
  };
  return encodeURIComponent(e).replace(/[!'()~]|%20|%00/g, function(n) {
    return t[n];
  });
}
function fe(e, t) {
  this._pairs = [], e && $(e, this, t);
}
const ze = fe.prototype;
ze.append = function(e, t) {
  this._pairs.push([e, t]);
};
ze.toString = function(e) {
  const t = e ? function(n) {
    return e.call(this, n, we);
  } : we;
  return this._pairs.map(function(n) {
    return t(n[0]) + "=" + t(n[1]);
  }, "").join("&");
};
function Kt(e) {
  return encodeURIComponent(e).replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]");
}
function He(e, t, n) {
  if (!t)
    return e;
  const r = n && n.encode || Kt, o = n && n.serialize;
  let s;
  if (o ? s = o(t, n) : s = a.isURLSearchParams(t) ? t.toString() : new fe(t, n).toString(r), s) {
    const i = e.indexOf("#");
    i !== -1 && (e = e.slice(0, i)), e += (e.indexOf("?") === -1 ? "?" : "&") + s;
  }
  return e;
}
class Ee {
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
  use(t, n, r) {
    return this.handlers.push({
      fulfilled: t,
      rejected: n,
      synchronous: r ? r.synchronous : !1,
      runWhen: r ? r.runWhen : null
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
    a.forEach(this.handlers, function(n) {
      n !== null && t(n);
    });
  }
}
const Je = {
  silentJSONParsing: !0,
  forcedJSONParsing: !0,
  clarifyTimeoutError: !1
}, Vt = typeof URLSearchParams < "u" ? URLSearchParams : fe, $t = typeof FormData < "u" ? FormData : null, Gt = typeof Blob < "u" ? Blob : null, Xt = {
  isBrowser: !0,
  classes: {
    URLSearchParams: Vt,
    FormData: $t,
    Blob: Gt
  },
  protocols: ["http", "https", "file", "blob", "url", "data"]
}, de = typeof window < "u" && typeof document < "u", Qt = ((e) => de && ["ReactNative", "NativeScript", "NS"].indexOf(e) < 0)(typeof navigator < "u" && navigator.product), Zt = typeof WorkerGlobalScope < "u" && // eslint-disable-next-line no-undef
self instanceof WorkerGlobalScope && typeof self.importScripts == "function", Yt = de && window.location.href || "http://localhost", er = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  hasBrowserEnv: de,
  hasStandardBrowserEnv: Qt,
  hasStandardBrowserWebWorkerEnv: Zt,
  origin: Yt
}, Symbol.toStringTag, { value: "Module" })), A = {
  ...er,
  ...Xt
};
function tr(e, t) {
  return $(e, new A.classes.URLSearchParams(), Object.assign({
    visitor: function(n, r, o, s) {
      return A.isNode && a.isBuffer(n) ? (this.append(r, n.toString("base64")), !1) : s.defaultVisitor.apply(this, arguments);
    }
  }, t));
}
function rr(e) {
  return a.matchAll(/\w+|\[(\w*)]/g, e).map((t) => t[0] === "[]" ? "" : t[1] || t[0]);
}
function nr(e) {
  const t = {}, n = Object.keys(e);
  let r;
  const o = n.length;
  let s;
  for (r = 0; r < o; r++)
    s = n[r], t[s] = e[s];
  return t;
}
function We(e) {
  function t(n, r, o, s) {
    let i = n[s++];
    if (i === "__proto__") return !0;
    const c = Number.isFinite(+i), l = s >= n.length;
    return i = !i && a.isArray(o) ? o.length : i, l ? (a.hasOwnProp(o, i) ? o[i] = [o[i], r] : o[i] = r, !c) : ((!o[i] || !a.isObject(o[i])) && (o[i] = []), t(n, r, o[i], s) && a.isArray(o[i]) && (o[i] = nr(o[i])), !c);
  }
  if (a.isFormData(e) && a.isFunction(e.entries)) {
    const n = {};
    return a.forEachEntry(e, (r, o) => {
      t(rr(r), o, n, 0);
    }), n;
  }
  return null;
}
function or(e, t, n) {
  if (a.isString(e))
    try {
      return (t || JSON.parse)(e), a.trim(e);
    } catch (r) {
      if (r.name !== "SyntaxError")
        throw r;
    }
  return (0, JSON.stringify)(e);
}
const q = {
  transitional: Je,
  adapter: ["xhr", "http", "fetch"],
  transformRequest: [function(e, t) {
    const n = t.getContentType() || "", r = n.indexOf("application/json") > -1, o = a.isObject(e);
    if (o && a.isHTMLForm(e) && (e = new FormData(e)), a.isFormData(e))
      return r ? JSON.stringify(We(e)) : e;
    if (a.isArrayBuffer(e) || a.isBuffer(e) || a.isStream(e) || a.isFile(e) || a.isBlob(e) || a.isReadableStream(e))
      return e;
    if (a.isArrayBufferView(e))
      return e.buffer;
    if (a.isURLSearchParams(e))
      return t.setContentType("application/x-www-form-urlencoded;charset=utf-8", !1), e.toString();
    let s;
    if (o) {
      if (n.indexOf("application/x-www-form-urlencoded") > -1)
        return tr(e, this.formSerializer).toString();
      if ((s = a.isFileList(e)) || n.indexOf("multipart/form-data") > -1) {
        const i = this.env && this.env.FormData;
        return $(
          s ? { "files[]": e } : e,
          i && new i(),
          this.formSerializer
        );
      }
    }
    return o || r ? (t.setContentType("application/json", !1), or(e)) : e;
  }],
  transformResponse: [function(e) {
    const t = this.transitional || q.transitional, n = t && t.forcedJSONParsing, r = this.responseType === "json";
    if (a.isResponse(e) || a.isReadableStream(e))
      return e;
    if (e && a.isString(e) && (n && !this.responseType || r)) {
      const o = !(t && t.silentJSONParsing) && r;
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
const sr = a.toObjectSet([
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
]), ir = (e) => {
  const t = {};
  let n, r, o;
  return e && e.split(`
`).forEach(function(s) {
    o = s.indexOf(":"), n = s.substring(0, o).trim().toLowerCase(), r = s.substring(o + 1).trim(), !(!n || t[n] && sr[n]) && (n === "set-cookie" ? t[n] ? t[n].push(r) : t[n] = [r] : t[n] = t[n] ? t[n] + ", " + r : r);
  }), t;
}, Re = Symbol("internals");
function B(e) {
  return e && String(e).trim().toLowerCase();
}
function z(e) {
  return e === !1 || e == null ? e : a.isArray(e) ? e.map(z) : String(e);
}
function ar(e) {
  const t = /* @__PURE__ */ Object.create(null), n = /([^\s,;=]+)\s*(?:=\s*([^,;]+))?/g;
  let r;
  for (; r = n.exec(e); )
    t[r[1]] = r[2];
  return t;
}
const cr = (e) => /^[-_a-zA-Z0-9^`|~,!#$%&'*+.]+$/.test(e.trim());
function Z(e, t, n, r, o) {
  if (a.isFunction(r))
    return r.call(this, t, n);
  if (o && (t = n), !!a.isString(t)) {
    if (a.isString(r))
      return t.indexOf(r) !== -1;
    if (a.isRegExp(r))
      return r.test(t);
  }
}
function ur(e) {
  return e.trim().toLowerCase().replace(/([a-z\d])(\w*)/g, (t, n, r) => n.toUpperCase() + r);
}
function lr(e, t) {
  const n = a.toCamelCase(" " + t);
  ["get", "set", "has"].forEach((r) => {
    Object.defineProperty(e, r + n, {
      value: function(o, s, i) {
        return this[r].call(this, t, o, s, i);
      },
      configurable: !0
    });
  });
}
class O {
  constructor(t) {
    t && this.set(t);
  }
  set(t, n, r) {
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
      i(t, n);
    else if (a.isString(t) && (t = t.trim()) && !cr(t))
      i(ir(t), n);
    else if (a.isHeaders(t))
      for (const [c, l] of t.entries())
        s(l, c, r);
    else
      t != null && s(n, t, r);
    return this;
  }
  get(t, n) {
    if (t = B(t), t) {
      const r = a.findKey(this, t);
      if (r) {
        const o = this[r];
        if (!n)
          return o;
        if (n === !0)
          return ar(o);
        if (a.isFunction(n))
          return n.call(this, o, r);
        if (a.isRegExp(n))
          return n.exec(o);
        throw new TypeError("parser must be boolean|regexp|function");
      }
    }
  }
  has(t, n) {
    if (t = B(t), t) {
      const r = a.findKey(this, t);
      return !!(r && this[r] !== void 0 && (!n || Z(this, this[r], r, n)));
    }
    return !1;
  }
  delete(t, n) {
    const r = this;
    let o = !1;
    function s(i) {
      if (i = B(i), i) {
        const c = a.findKey(r, i);
        c && (!n || Z(r, r[c], c, n)) && (delete r[c], o = !0);
      }
    }
    return a.isArray(t) ? t.forEach(s) : s(t), o;
  }
  clear(t) {
    const n = Object.keys(this);
    let r = n.length, o = !1;
    for (; r--; ) {
      const s = n[r];
      (!t || Z(this, this[s], s, t, !0)) && (delete this[s], o = !0);
    }
    return o;
  }
  normalize(t) {
    const n = this, r = {};
    return a.forEach(this, (o, s) => {
      const i = a.findKey(r, s);
      if (i) {
        n[i] = z(o), delete n[s];
        return;
      }
      const c = t ? ur(s) : String(s).trim();
      c !== s && delete n[s], n[c] = z(o), r[c] = !0;
    }), this;
  }
  concat(...t) {
    return this.constructor.concat(this, ...t);
  }
  toJSON(t) {
    const n = /* @__PURE__ */ Object.create(null);
    return a.forEach(this, (r, o) => {
      r != null && r !== !1 && (n[o] = t && a.isArray(r) ? r.join(", ") : r);
    }), n;
  }
  [Symbol.iterator]() {
    return Object.entries(this.toJSON())[Symbol.iterator]();
  }
  toString() {
    return Object.entries(this.toJSON()).map(([t, n]) => t + ": " + n).join(`
`);
  }
  get [Symbol.toStringTag]() {
    return "AxiosHeaders";
  }
  static from(t) {
    return t instanceof this ? t : new this(t);
  }
  static concat(t, ...n) {
    const r = new this(t);
    return n.forEach((o) => r.set(o)), r;
  }
  static accessor(t) {
    const n = (this[Re] = this[Re] = {
      accessors: {}
    }).accessors, r = this.prototype;
    function o(s) {
      const i = B(s);
      n[i] || (lr(r, s), n[i] = !0);
    }
    return a.isArray(t) ? t.forEach(o) : o(t), this;
  }
}
O.accessor(["Content-Type", "Content-Length", "Accept", "Accept-Encoding", "User-Agent", "Authorization"]);
a.reduceDescriptors(O.prototype, ({ value: e }, t) => {
  let n = t[0].toUpperCase() + t.slice(1);
  return {
    get: () => e,
    set(r) {
      this[n] = r;
    }
  };
});
a.freezeMethods(O);
function Y(e, t) {
  const n = this || q, r = t || n, o = O.from(r.headers);
  let s = r.data;
  return a.forEach(e, function(i) {
    s = i.call(n, s, o.normalize(), t ? t.status : void 0);
  }), o.normalize(), s;
}
function Ke(e) {
  return !!(e && e.__CANCEL__);
}
function U(e, t, n) {
  g.call(this, e ?? "canceled", g.ERR_CANCELED, t, n), this.name = "CanceledError";
}
a.inherits(U, g, {
  __CANCEL__: !0
});
function Ve(e, t, n) {
  const r = n.config.validateStatus;
  !n.status || !r || r(n.status) ? e(n) : t(new g(
    "Request failed with status code " + n.status,
    [g.ERR_BAD_REQUEST, g.ERR_BAD_RESPONSE][Math.floor(n.status / 100) - 4],
    n.config,
    n.request,
    n
  ));
}
function fr(e) {
  const t = /^([-+\w]{1,25})(:?\/\/|:)/.exec(e);
  return t && t[1] || "";
}
function dr(e, t) {
  e = e || 10;
  const n = new Array(e), r = new Array(e);
  let o = 0, s = 0, i;
  return t = t !== void 0 ? t : 1e3, function(c) {
    const l = Date.now(), u = r[s];
    i || (i = l), n[o] = c, r[o] = l;
    let f = s, p = 0;
    for (; f !== o; )
      p += n[f++], f = f % e;
    if (o = (o + 1) % e, o === s && (s = (s + 1) % e), l - i < t)
      return;
    const y = u && l - u;
    return y ? Math.round(p * 1e3 / y) : void 0;
  };
}
function pr(e, t) {
  let n = 0, r = 1e3 / t, o, s;
  const i = (c, l = Date.now()) => {
    n = l, o = null, s && (clearTimeout(s), s = null), e.apply(null, c);
  };
  return [(...c) => {
    const l = Date.now(), u = l - n;
    u >= r ? i(c, l) : (o = c, s || (s = setTimeout(() => {
      s = null, i(o);
    }, r - u)));
  }, () => o && i(o)];
}
const H = (e, t, n = 3) => {
  let r = 0;
  const o = dr(50, 250);
  return pr((s) => {
    const i = s.loaded, c = s.lengthComputable ? s.total : void 0, l = i - r, u = o(l), f = i <= c;
    r = i;
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
  }, n);
}, Oe = (e, t) => {
  const n = e != null;
  return [(r) => t[0]({
    lengthComputable: n,
    total: e,
    loaded: r
  }), t[1]];
}, Se = (e) => (...t) => a.asap(() => e(...t)), hr = A.hasStandardBrowserEnv ? (
  // Standard browser envs have full support of the APIs needed to test
  // whether the request URL is of the same origin as current location.
  function() {
    const e = /(msie|trident)/i.test(navigator.userAgent), t = document.createElement("a");
    let n;
    function r(o) {
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
    return n = r(window.location.href), function(o) {
      const s = a.isString(o) ? r(o) : o;
      return s.protocol === n.protocol && s.host === n.host;
    };
  }()
) : (
  // Non standard browser envs (web workers, react-native) lack needed support.
  /* @__PURE__ */ function() {
    return function() {
      return !0;
    };
  }()
), mr = A.hasStandardBrowserEnv ? (
  // Standard browser envs support document.cookie
  {
    write(e, t, n, r, o, s) {
      const i = [e + "=" + encodeURIComponent(t)];
      a.isNumber(n) && i.push("expires=" + new Date(n).toGMTString()), a.isString(r) && i.push("path=" + r), a.isString(o) && i.push("domain=" + o), s === !0 && i.push("secure"), document.cookie = i.join("; ");
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
function gr(e) {
  return /^([a-z][a-z\d+\-.]*:)?\/\//i.test(e);
}
function br(e, t) {
  return t ? e.replace(/\/?\/$/, "") + "/" + t.replace(/^\/+/, "") : e;
}
function $e(e, t) {
  return e && !gr(t) ? br(e, t) : t;
}
const Te = (e) => e instanceof O ? { ...e } : e;
function P(e, t) {
  t = t || {};
  const n = {};
  function r(u, f, p) {
    return a.isPlainObject(u) && a.isPlainObject(f) ? a.merge.call({ caseless: p }, u, f) : a.isPlainObject(f) ? a.merge({}, f) : a.isArray(f) ? f.slice() : f;
  }
  function o(u, f, p) {
    if (a.isUndefined(f)) {
      if (!a.isUndefined(u))
        return r(void 0, u, p);
    } else return r(u, f, p);
  }
  function s(u, f) {
    if (!a.isUndefined(f))
      return r(void 0, f);
  }
  function i(u, f) {
    if (a.isUndefined(f)) {
      if (!a.isUndefined(u))
        return r(void 0, u);
    } else return r(void 0, f);
  }
  function c(u, f, p) {
    if (p in t)
      return r(u, f);
    if (p in e)
      return r(void 0, u);
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
    headers: (u, f) => o(Te(u), Te(f), !0)
  };
  return a.forEach(Object.keys(Object.assign({}, e, t)), function(u) {
    const f = l[u] || o, p = f(e[u], t[u], u);
    a.isUndefined(p) && f !== c || (n[u] = p);
  }), n;
}
const Ge = (e) => {
  const t = P({}, e);
  let { data: n, withXSRFToken: r, xsrfHeaderName: o, xsrfCookieName: s, headers: i, auth: c } = t;
  t.headers = i = O.from(i), t.url = He($e(t.baseURL, t.url), e.params, e.paramsSerializer), c && i.set(
    "Authorization",
    "Basic " + btoa((c.username || "") + ":" + (c.password ? unescape(encodeURIComponent(c.password)) : ""))
  );
  let l;
  if (a.isFormData(n)) {
    if (A.hasStandardBrowserEnv || A.hasStandardBrowserWebWorkerEnv)
      i.setContentType(void 0);
    else if ((l = i.getContentType()) !== !1) {
      const [u, ...f] = l ? l.split(";").map((p) => p.trim()).filter(Boolean) : [];
      i.setContentType([u || "multipart/form-data", ...f].join("; "));
    }
  }
  if (A.hasStandardBrowserEnv && (r && a.isFunction(r) && (r = r(t)), r || r !== !1 && hr(t.url))) {
    const u = o && s && mr.read(s);
    u && i.set(o, u);
  }
  return t;
}, yr = typeof XMLHttpRequest < "u", wr = yr && function(e) {
  return new Promise(function(t, n) {
    const r = Ge(e);
    let o = r.data;
    const s = O.from(r.headers).normalize();
    let { responseType: i, onUploadProgress: c, onDownloadProgress: l } = r, u, f, p, y, m;
    function h() {
      y && y(), m && m(), r.cancelToken && r.cancelToken.unsubscribe(u), r.signal && r.signal.removeEventListener("abort", u);
    }
    let d = new XMLHttpRequest();
    d.open(r.method.toUpperCase(), r.url, !0), d.timeout = r.timeout;
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
      Ve(function(j) {
        t(j), h();
      }, function(j) {
        n(j), h();
      }, b), d = null;
    }
    "onloadend" in d ? d.onloadend = E : d.onreadystatechange = function() {
      !d || d.readyState !== 4 || d.status === 0 && !(d.responseURL && d.responseURL.indexOf("file:") === 0) || setTimeout(E);
    }, d.onabort = function() {
      d && (n(new g("Request aborted", g.ECONNABORTED, e, d)), d = null);
    }, d.onerror = function() {
      n(new g("Network Error", g.ERR_NETWORK, e, d)), d = null;
    }, d.ontimeout = function() {
      let R = r.timeout ? "timeout of " + r.timeout + "ms exceeded" : "timeout exceeded";
      const b = r.transitional || Je;
      r.timeoutErrorMessage && (R = r.timeoutErrorMessage), n(new g(
        R,
        b.clarifyTimeoutError ? g.ETIMEDOUT : g.ECONNABORTED,
        e,
        d
      )), d = null;
    }, o === void 0 && s.setContentType(null), "setRequestHeader" in d && a.forEach(s.toJSON(), function(R, b) {
      d.setRequestHeader(b, R);
    }), a.isUndefined(r.withCredentials) || (d.withCredentials = !!r.withCredentials), i && i !== "json" && (d.responseType = r.responseType), l && ([p, m] = H(l, !0), d.addEventListener("progress", p)), c && d.upload && ([f, y] = H(c), d.upload.addEventListener("progress", f), d.upload.addEventListener("loadend", y)), (r.cancelToken || r.signal) && (u = (R) => {
      d && (n(!R || R.type ? new U(null, e, d) : R), d.abort(), d = null);
    }, r.cancelToken && r.cancelToken.subscribe(u), r.signal && (r.signal.aborted ? u() : r.signal.addEventListener("abort", u)));
    const T = fr(r.url);
    if (T && A.protocols.indexOf(T) === -1) {
      n(new g("Unsupported protocol " + T + ":", g.ERR_BAD_REQUEST, e));
      return;
    }
    d.send(o || null);
  });
}, Er = (e, t) => {
  let n = new AbortController(), r;
  const o = function(l) {
    if (!r) {
      r = !0, i();
      const u = l instanceof Error ? l : this.reason;
      n.abort(u instanceof g ? u : new U(u instanceof Error ? u.message : u));
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
  const { signal: c } = n;
  return c.unsubscribe = i, [c, () => {
    s && clearTimeout(s), s = null;
  }];
}, Rr = function* (e, t) {
  let n = e.byteLength;
  if (n < t) {
    yield e;
    return;
  }
  let r = 0, o;
  for (; r < n; )
    o = r + t, yield e.slice(r, o), r = o;
}, Or = async function* (e, t, n) {
  for await (const r of e)
    yield* Rr(ArrayBuffer.isView(r) ? r : await n(String(r)), t);
}, Ae = (e, t, n, r, o) => {
  const s = Or(e, t, o);
  let i = 0, c, l = (u) => {
    c || (c = !0, r && r(u));
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
        if (n) {
          let m = i += y;
          n(m);
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
}, G = typeof fetch == "function" && typeof Request == "function" && typeof Response == "function", Xe = G && typeof ReadableStream == "function", se = G && (typeof TextEncoder == "function" ? /* @__PURE__ */ ((e) => (t) => e.encode(t))(new TextEncoder()) : async (e) => new Uint8Array(await new Response(e).arrayBuffer())), Qe = (e, ...t) => {
  try {
    return !!e(...t);
  } catch {
    return !1;
  }
}, Sr = Xe && Qe(() => {
  let e = !1;
  const t = new Request(A.origin, {
    body: new ReadableStream(),
    method: "POST",
    get duplex() {
      return e = !0, "half";
    }
  }).headers.has("Content-Type");
  return e && !t;
}), xe = 64 * 1024, ie = Xe && Qe(() => a.isReadableStream(new Response("").body)), J = {
  stream: ie && ((e) => e.body)
};
G && ((e) => {
  ["text", "arrayBuffer", "blob", "formData", "stream"].forEach((t) => {
    !J[t] && (J[t] = a.isFunction(e[t]) ? (n) => n[t]() : (n, r) => {
      throw new g(`Response type '${t}' is not supported`, g.ERR_NOT_SUPPORT, r);
    });
  });
})(new Response());
const Tr = async (e) => {
  if (e == null)
    return 0;
  if (a.isBlob(e))
    return e.size;
  if (a.isSpecCompliantForm(e))
    return (await new Request(e).arrayBuffer()).byteLength;
  if (a.isArrayBufferView(e) || a.isArrayBuffer(e))
    return e.byteLength;
  if (a.isURLSearchParams(e) && (e = e + ""), a.isString(e))
    return (await se(e)).byteLength;
}, Ar = async (e, t) => a.toFiniteNumber(e.getContentLength()) ?? Tr(t), xr = G && (async (e) => {
  let {
    url: t,
    method: n,
    data: r,
    signal: o,
    cancelToken: s,
    timeout: i,
    onDownloadProgress: c,
    onUploadProgress: l,
    responseType: u,
    headers: f,
    withCredentials: p = "same-origin",
    fetchOptions: y
  } = Ge(e);
  u = u ? (u + "").toLowerCase() : "text";
  let [m, h] = o || s || i ? Er([o, s], i) : [], d, E;
  const T = () => {
    !d && setTimeout(() => {
      m && m.unsubscribe();
    }), d = !0;
  };
  let R;
  try {
    if (l && Sr && n !== "get" && n !== "head" && (R = await Ar(f, r)) !== 0) {
      let v = new Request(t, {
        method: "POST",
        body: r,
        duplex: "half"
      }), L;
      if (a.isFormData(r) && (L = v.headers.get("content-type")) && f.setContentType(L), v.body) {
        const [X, I] = Oe(
          R,
          H(Se(l))
        );
        r = Ae(v.body, xe, X, I, se);
      }
    }
    a.isString(p) || (p = p ? "include" : "omit"), E = new Request(t, {
      ...y,
      signal: m,
      method: n.toUpperCase(),
      headers: f.normalize().toJSON(),
      body: r,
      duplex: "half",
      credentials: p
    });
    let b = await fetch(E);
    const j = ie && (u === "stream" || u === "response");
    if (ie && (c || j)) {
      const v = {};
      ["status", "statusText", "headers"].forEach((me) => {
        v[me] = b[me];
      });
      const L = a.toFiniteNumber(b.headers.get("content-length")), [X, I] = c && Oe(
        L,
        H(Se(c), !0)
      ) || [];
      b = new Response(
        Ae(b.body, xe, X, () => {
          I && I(), j && T();
        }, se),
        v
      );
    }
    u = u || "text";
    let rt = await J[a.findKey(J, u) || "text"](b, e);
    return !j && T(), h && h(), await new Promise((v, L) => {
      Ve(v, L, {
        data: rt,
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
}), ae = {
  http: Ht,
  xhr: wr,
  fetch: xr
};
a.forEach(ae, (e, t) => {
  if (e) {
    try {
      Object.defineProperty(e, "name", { value: t });
    } catch {
    }
    Object.defineProperty(e, "adapterName", { value: t });
  }
});
const ve = (e) => `- ${e}`, vr = (e) => a.isFunction(e) || e === null || e === !1, Ze = {
  getAdapter: (e) => {
    e = a.isArray(e) ? e : [e];
    const { length: t } = e;
    let n, r;
    const o = {};
    for (let s = 0; s < t; s++) {
      n = e[s];
      let i;
      if (r = n, !vr(n) && (r = ae[(i = String(n)).toLowerCase()], r === void 0))
        throw new g(`Unknown adapter '${i}'`);
      if (r)
        break;
      o[i || "#" + s] = r;
    }
    if (!r) {
      const s = Object.entries(o).map(
        ([c, l]) => `adapter ${c} ` + (l === !1 ? "is not supported by the environment" : "is not available in the build")
      );
      let i = t ? s.length > 1 ? `since :
` + s.map(ve).join(`
`) : " " + ve(s[0]) : "as no adapter specified";
      throw new g(
        "There is no suitable adapter to dispatch the request " + i,
        "ERR_NOT_SUPPORT"
      );
    }
    return r;
  },
  adapters: ae
};
function ee(e) {
  if (e.cancelToken && e.cancelToken.throwIfRequested(), e.signal && e.signal.aborted)
    throw new U(null, e);
}
function Ce(e) {
  return ee(e), e.headers = O.from(e.headers), e.data = Y.call(
    e,
    e.transformRequest
  ), ["post", "put", "patch"].indexOf(e.method) !== -1 && e.headers.setContentType("application/x-www-form-urlencoded", !1), Ze.getAdapter(e.adapter || q.adapter)(e).then(function(t) {
    return ee(e), t.data = Y.call(
      e,
      e.transformResponse,
      t
    ), t.headers = O.from(t.headers), t;
  }, function(t) {
    return Ke(t) || (ee(e), t && t.response && (t.response.data = Y.call(
      e,
      e.transformResponse,
      t.response
    ), t.response.headers = O.from(t.response.headers))), Promise.reject(t);
  });
}
const Ye = "1.7.3", pe = {};
["object", "boolean", "number", "function", "string", "symbol"].forEach((e, t) => {
  pe[e] = function(n) {
    return typeof n === e || "a" + (t < 1 ? "n " : " ") + e;
  };
});
const je = {};
pe.transitional = function(e, t, n) {
  function r(o, s) {
    return "[Axios v" + Ye + "] Transitional option '" + o + "'" + s + (n ? ". " + n : "");
  }
  return (o, s, i) => {
    if (e === !1)
      throw new g(
        r(s, " has been removed" + (t ? " in " + t : "")),
        g.ERR_DEPRECATED
      );
    return t && !je[s] && (je[s] = !0, console.warn(
      r(
        s,
        " has been deprecated since v" + t + " and will be removed in the near future"
      )
    )), e ? e(o, s, i) : !0;
  };
};
function Cr(e, t, n) {
  if (typeof e != "object")
    throw new g("options must be an object", g.ERR_BAD_OPTION_VALUE);
  const r = Object.keys(e);
  let o = r.length;
  for (; o-- > 0; ) {
    const s = r[o], i = t[s];
    if (i) {
      const c = e[s], l = c === void 0 || i(c, s, e);
      if (l !== !0)
        throw new g("option " + s + " must be " + l, g.ERR_BAD_OPTION_VALUE);
      continue;
    }
    if (n !== !0)
      throw new g("Unknown option " + s, g.ERR_BAD_OPTION);
  }
}
const ce = {
  assertOptions: Cr,
  validators: pe
}, C = ce.validators;
class _ {
  constructor(t) {
    this.defaults = t, this.interceptors = {
      request: new Ee(),
      response: new Ee()
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
  async request(t, n) {
    try {
      return await this._request(t, n);
    } catch (r) {
      if (r instanceof Error) {
        let o;
        Error.captureStackTrace ? Error.captureStackTrace(o = {}) : o = new Error();
        const s = o.stack ? o.stack.replace(/^.+\n/, "") : "";
        try {
          r.stack ? s && !String(r.stack).endsWith(s.replace(/^.+\n.+\n/, "")) && (r.stack += `
` + s) : r.stack = s;
        } catch {
        }
      }
      throw r;
    }
  }
  _request(t, n) {
    typeof t == "string" ? (n = n || {}, n.url = t) : n = t || {}, n = P(this.defaults, n);
    const { transitional: r, paramsSerializer: o, headers: s } = n;
    r !== void 0 && ce.assertOptions(r, {
      silentJSONParsing: C.transitional(C.boolean),
      forcedJSONParsing: C.transitional(C.boolean),
      clarifyTimeoutError: C.transitional(C.boolean)
    }, !1), o != null && (a.isFunction(o) ? n.paramsSerializer = {
      serialize: o
    } : ce.assertOptions(o, {
      encode: C.function,
      serialize: C.function
    }, !0)), n.method = (n.method || this.defaults.method || "get").toLowerCase();
    let i = s && a.merge(
      s.common,
      s[n.method]
    );
    s && a.forEach(
      ["delete", "get", "head", "post", "put", "patch", "common"],
      (h) => {
        delete s[h];
      }
    ), n.headers = O.concat(i, s);
    const c = [];
    let l = !0;
    this.interceptors.request.forEach(function(h) {
      typeof h.runWhen == "function" && h.runWhen(n) === !1 || (l = l && h.synchronous, c.unshift(h.fulfilled, h.rejected));
    });
    const u = [];
    this.interceptors.response.forEach(function(h) {
      u.push(h.fulfilled, h.rejected);
    });
    let f, p = 0, y;
    if (!l) {
      const h = [Ce.bind(this), void 0];
      for (h.unshift.apply(h, c), h.push.apply(h, u), y = h.length, f = Promise.resolve(n); p < y; )
        f = f.then(h[p++], h[p++]);
      return f;
    }
    y = c.length;
    let m = n;
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
      f = Ce.call(this, m);
    } catch (h) {
      return Promise.reject(h);
    }
    for (p = 0, y = u.length; p < y; )
      f = f.then(u[p++], u[p++]);
    return f;
  }
  getUri(t) {
    t = P(this.defaults, t);
    const n = $e(t.baseURL, t.url);
    return He(n, t.params, t.paramsSerializer);
  }
}
a.forEach(["delete", "get", "head", "options"], function(e) {
  _.prototype[e] = function(t, n) {
    return this.request(P(n || {}, {
      method: e,
      url: t,
      data: (n || {}).data
    }));
  };
});
a.forEach(["post", "put", "patch"], function(e) {
  function t(n) {
    return function(r, o, s) {
      return this.request(P(s || {}, {
        method: e,
        headers: n ? {
          "Content-Type": "multipart/form-data"
        } : {},
        url: r,
        data: o
      }));
    };
  }
  _.prototype[e] = t(), _.prototype[e + "Form"] = t(!0);
});
class he {
  constructor(t) {
    if (typeof t != "function")
      throw new TypeError("executor must be a function.");
    let n;
    this.promise = new Promise(function(o) {
      n = o;
    });
    const r = this;
    this.promise.then((o) => {
      if (!r._listeners) return;
      let s = r._listeners.length;
      for (; s-- > 0; )
        r._listeners[s](o);
      r._listeners = null;
    }), this.promise.then = (o) => {
      let s;
      const i = new Promise((c) => {
        r.subscribe(c), s = c;
      }).then(o);
      return i.cancel = function() {
        r.unsubscribe(s);
      }, i;
    }, t(function(o, s, i) {
      r.reason || (r.reason = new U(o, s, i), n(r.reason));
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
    const n = this._listeners.indexOf(t);
    n !== -1 && this._listeners.splice(n, 1);
  }
  /**
   * Returns an object that contains a new `CancelToken` and a function that, when called,
   * cancels the `CancelToken`.
   */
  static source() {
    let t;
    return {
      token: new he(function(n) {
        t = n;
      }),
      cancel: t
    };
  }
}
function jr(e) {
  return function(t) {
    return e.apply(null, t);
  };
}
function Nr(e) {
  return a.isObject(e) && e.isAxiosError === !0;
}
const ue = {
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
Object.entries(ue).forEach(([e, t]) => {
  ue[t] = e;
});
function et(e) {
  const t = new _(e), n = _e(_.prototype.request, t);
  return a.extend(n, _.prototype, t, { allOwnKeys: !0 }), a.extend(n, t, null, { allOwnKeys: !0 }), n.create = function(r) {
    return et(P(e, r));
  }, n;
}
const w = et(q);
w.Axios = _;
w.CanceledError = U;
w.CancelToken = he;
w.isCancel = Ke;
w.VERSION = Ye;
w.toFormData = $;
w.AxiosError = g;
w.Cancel = w.CanceledError;
w.all = function(e) {
  return Promise.all(e);
};
w.spread = jr;
w.isAxiosError = Nr;
w.mergeConfig = P;
w.AxiosHeaders = O;
w.formToJSON = (e) => We(a.isHTMLForm(e) ? new FormData(e) : e);
w.getAdapter = Ze.getAdapter;
w.HttpStatusCode = ue;
w.default = w;
const _r = (e) => {
  const t = typeof e;
  return e !== null && (t === "object" || t === "function");
}, te = /* @__PURE__ */ new Set([
  "__proto__",
  "prototype",
  "constructor"
]), Pr = new Set("0123456789");
function Lr(e) {
  const t = [];
  let n = "", r = "start", o = !1;
  for (const s of e)
    switch (s) {
      case "\\": {
        if (r === "index")
          throw new Error("Invalid character in an index");
        if (r === "indexEnd")
          throw new Error("Invalid character after an index");
        o && (n += s), r = "property", o = !o;
        break;
      }
      case ".": {
        if (r === "index")
          throw new Error("Invalid character in an index");
        if (r === "indexEnd") {
          r = "property";
          break;
        }
        if (o) {
          o = !1, n += s;
          break;
        }
        if (te.has(n))
          return [];
        t.push(n), n = "", r = "property";
        break;
      }
      case "[": {
        if (r === "index")
          throw new Error("Invalid character in an index");
        if (r === "indexEnd") {
          r = "index";
          break;
        }
        if (o) {
          o = !1, n += s;
          break;
        }
        if (r === "property") {
          if (te.has(n))
            return [];
          t.push(n), n = "";
        }
        r = "index";
        break;
      }
      case "]": {
        if (r === "index") {
          t.push(Number.parseInt(n, 10)), n = "", r = "indexEnd";
          break;
        }
        if (r === "indexEnd")
          throw new Error("Invalid character after an index");
      }
      default: {
        if (r === "index" && !Pr.has(s))
          throw new Error("Invalid character in an index");
        if (r === "indexEnd")
          throw new Error("Invalid character after an index");
        r === "start" && (r = "property"), o && (o = !1, n += "\\"), n += s;
      }
    }
  switch (o && (n += "\\"), r) {
    case "property": {
      if (te.has(n))
        return [];
      t.push(n);
      break;
    }
    case "index":
      throw new Error("Index was not closed");
    case "start": {
      t.push("");
      break;
    }
  }
  return t;
}
function Fr(e, t) {
  if (typeof t != "number" && Array.isArray(e)) {
    const n = Number.parseInt(t, 10);
    return Number.isInteger(n) && e[n] === e[t];
  }
  return !1;
}
function Ur(e, t, n) {
  if (!_r(e) || typeof t != "string")
    return n === void 0 ? e : n;
  const r = Lr(t);
  if (r.length === 0)
    return n;
  for (let o = 0; o < r.length; o++) {
    const s = r[o];
    if (Fr(e, s) ? e = o === r.length - 1 ? void 0 : null : e = e[s], e == null) {
      if (o !== r.length - 1)
        return n;
      break;
    }
  }
  return e === void 0 ? n : e;
}
const tt = nt("config", {
  persist: !0,
  state: () => ({
    config: {}
  }),
  getters: {
    get: (e) => (t, n) => Ur(e.config, t, n)
  },
  actions: {
    async load() {
      w.get("/api/config").then((e) => {
        this.config = e.data;
      });
    }
  }
});
function Br() {
  return {
    first_name: "",
    last_name: "",
    email: "",
    user_name: "",
    password: "",
    passwordc: "",
    locale: tt().get("site.registration.user_defaults.locale", "en_US"),
    captcha: "",
    spiderbro: "http://"
  };
}
function kr() {
  return tt().get("locales.available");
}
function Dr() {
  return "/account/captcha";
}
async function qr(e) {
  return Ne.post("/account/register", e).then((t) => t.data).catch((t) => {
    throw {
      description: "An error as occurred",
      style: re.Danger,
      closeBtn: !0,
      ...t.response.data
    };
  });
}
const zr = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  doRegister: qr,
  getAvailableLocales: kr,
  getCaptchaUrl: Dr,
  getDefaultForm: Br
}, Symbol.toStringTag, { value: "Module" }));
async function Hr(e) {
  return Ne.post("/account/forgot-password", e).then((t) => ({
    description: t.data.message,
    style: re.Success,
    closeBtn: !0
  })).catch((t) => {
    throw {
      description: "An error as occurred",
      style: re.Danger,
      closeBtn: !0,
      ...t.response.data
    };
  });
}
export {
  zr as Register,
  Hr as forgotPassword
};
