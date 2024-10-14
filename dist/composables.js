import { a as le, b as k } from "./types-Ht7brb6q.js";
import { defineStore as rt } from "pinia";
function _e(e, t) {
  return function() {
    return e.apply(t, arguments);
  };
}
const { toString: nt } = Object.prototype, { getPrototypeOf: fe } = Object, K = /* @__PURE__ */ ((e) => (t) => {
  const r = nt.call(t);
  return e[r] || (e[r] = r.slice(8, -1).toLowerCase());
})(/* @__PURE__ */ Object.create(null)), A = (e) => (e = e.toLowerCase(), (t) => K(t) === e), V = (e) => (t) => typeof t === e, { isArray: B } = Array, D = V("undefined");
function ot(e) {
  return e !== null && !D(e) && e.constructor !== null && !D(e.constructor) && T(e.constructor.isBuffer) && e.constructor.isBuffer(e);
}
const Pe = A("ArrayBuffer");
function st(e) {
  let t;
  return typeof ArrayBuffer < "u" && ArrayBuffer.isView ? t = ArrayBuffer.isView(e) : t = e && e.buffer && Pe(e.buffer), t;
}
const it = V("string"), T = V("function"), Be = V("number"), $ = (e) => e !== null && typeof e == "object", at = (e) => e === !0 || e === !1, z = (e) => {
  if (K(e) !== "object")
    return !1;
  const t = fe(e);
  return (t === null || t === Object.prototype || Object.getPrototypeOf(t) === null) && !(Symbol.toStringTag in e) && !(Symbol.iterator in e);
}, ct = A("Date"), ut = A("File"), lt = A("Blob"), ft = A("FileList"), dt = (e) => $(e) && T(e.pipe), ht = (e) => {
  let t;
  return e && (typeof FormData == "function" && e instanceof FormData || T(e.append) && ((t = K(e)) === "formdata" || // detect form-data instance
  t === "object" && T(e.toString) && e.toString() === "[object FormData]"));
}, pt = A("URLSearchParams"), [mt, bt, gt, yt] = ["ReadableStream", "Request", "Response", "Headers"].map(A), wt = (e) => e.trim ? e.trim() : e.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "");
function q(e, t, { allOwnKeys: r = !1 } = {}) {
  if (e === null || typeof e > "u")
    return;
  let n, o;
  if (typeof e != "object" && (e = [e]), B(e))
    for (n = 0, o = e.length; n < o; n++)
      t.call(null, e[n], n, e);
  else {
    const s = r ? Object.getOwnPropertyNames(e) : Object.keys(e), i = s.length;
    let c;
    for (n = 0; n < i; n++)
      c = s[n], t.call(null, e[c], c, e);
  }
}
function Fe(e, t) {
  t = t.toLowerCase();
  const r = Object.keys(e);
  let n = r.length, o;
  for (; n-- > 0; )
    if (o = r[n], t === o.toLowerCase())
      return o;
  return null;
}
const C = typeof globalThis < "u" ? globalThis : typeof self < "u" ? self : typeof window < "u" ? window : global, Le = (e) => !D(e) && e !== C;
function ne() {
  const { caseless: e } = Le(this) && this || {}, t = {}, r = (n, o) => {
    const s = e && Fe(t, o) || o;
    z(t[s]) && z(n) ? t[s] = ne(t[s], n) : z(n) ? t[s] = ne({}, n) : B(n) ? t[s] = n.slice() : t[s] = n;
  };
  for (let n = 0, o = arguments.length; n < o; n++)
    arguments[n] && q(arguments[n], r);
  return t;
}
const Et = (e, t, r, { allOwnKeys: n } = {}) => (q(t, (o, s) => {
  r && T(o) ? e[s] = _e(o, r) : e[s] = o;
}, { allOwnKeys: n }), e), Ot = (e) => (e.charCodeAt(0) === 65279 && (e = e.slice(1)), e), St = (e, t, r, n) => {
  e.prototype = Object.create(t.prototype, n), e.prototype.constructor = e, Object.defineProperty(e, "super", {
    value: t.prototype
  }), r && Object.assign(e.prototype, r);
}, Rt = (e, t, r, n) => {
  let o, s, i;
  const c = {};
  if (t = t || {}, e == null) return t;
  do {
    for (o = Object.getOwnPropertyNames(e), s = o.length; s-- > 0; )
      i = o[s], (!n || n(i, e, t)) && !c[i] && (t[i] = e[i], c[i] = !0);
    e = r !== !1 && fe(e);
  } while (e && (!r || r(e, t)) && e !== Object.prototype);
  return t;
}, Tt = (e, t, r) => {
  e = String(e), (r === void 0 || r > e.length) && (r = e.length), r -= t.length;
  const n = e.indexOf(t, r);
  return n !== -1 && n === r;
}, At = (e) => {
  if (!e) return null;
  if (B(e)) return e;
  let t = e.length;
  if (!Be(t)) return null;
  const r = new Array(t);
  for (; t-- > 0; )
    r[t] = e[t];
  return r;
}, xt = /* @__PURE__ */ ((e) => (t) => e && t instanceof e)(typeof Uint8Array < "u" && fe(Uint8Array)), vt = (e, t) => {
  const r = (e && e[Symbol.iterator]).call(e);
  let n;
  for (; (n = r.next()) && !n.done; ) {
    const o = n.value;
    t.call(e, o[0], o[1]);
  }
}, jt = (e, t) => {
  let r;
  const n = [];
  for (; (r = e.exec(t)) !== null; )
    n.push(r);
  return n;
}, Ct = A("HTMLFormElement"), Nt = (e) => e.toLowerCase().replace(
  /[-_\s]([a-z\d])(\w*)/g,
  function(t, r, n) {
    return r.toUpperCase() + n;
  }
), ge = (({ hasOwnProperty: e }) => (t, r) => e.call(t, r))(Object.prototype), _t = A("RegExp"), Ue = (e, t) => {
  const r = Object.getOwnPropertyDescriptors(e), n = {};
  q(r, (o, s) => {
    let i;
    (i = t(o, s, e)) !== !1 && (n[s] = i || o);
  }), Object.defineProperties(e, n);
}, Pt = (e) => {
  Ue(e, (t, r) => {
    if (T(e) && ["arguments", "caller", "callee"].indexOf(r) !== -1)
      return !1;
    const n = e[r];
    if (T(n)) {
      if (t.enumerable = !1, "writable" in t) {
        t.writable = !1;
        return;
      }
      t.set || (t.set = () => {
        throw Error("Can not rewrite read-only method '" + r + "'");
      });
    }
  });
}, Bt = (e, t) => {
  const r = {}, n = (o) => {
    o.forEach((s) => {
      r[s] = !0;
    });
  };
  return B(e) ? n(e) : n(String(e).split(t)), r;
}, Ft = () => {
}, Lt = (e, t) => e != null && Number.isFinite(e = +e) ? e : t, Z = "abcdefghijklmnopqrstuvwxyz", ye = "0123456789", ke = {
  DIGIT: ye,
  ALPHA: Z,
  ALPHA_DIGIT: Z + Z.toUpperCase() + ye
}, Ut = (e = 16, t = ke.ALPHA_DIGIT) => {
  let r = "";
  const { length: n } = t;
  for (; e--; )
    r += t[Math.random() * n | 0];
  return r;
};
function kt(e) {
  return !!(e && T(e.append) && e[Symbol.toStringTag] === "FormData" && e[Symbol.iterator]);
}
const Dt = (e) => {
  const t = new Array(10), r = (n, o) => {
    if ($(n)) {
      if (t.indexOf(n) >= 0)
        return;
      if (!("toJSON" in n)) {
        t[o] = n;
        const s = B(n) ? [] : {};
        return q(n, (i, c) => {
          const d = r(i, o + 1);
          !D(d) && (s[c] = d);
        }), t[o] = void 0, s;
      }
    }
    return n;
  };
  return r(e, 0);
}, qt = A("AsyncFunction"), It = (e) => e && ($(e) || T(e)) && T(e.then) && T(e.catch), De = ((e, t) => e ? setImmediate : t ? ((r, n) => (C.addEventListener("message", ({ source: o, data: s }) => {
  o === C && s === r && n.length && n.shift()();
}, !1), (o) => {
  n.push(o), C.postMessage(r, "*");
}))(`axios@${Math.random()}`, []) : (r) => setTimeout(r))(
  typeof setImmediate == "function",
  T(C.postMessage)
), Mt = typeof queueMicrotask < "u" ? queueMicrotask.bind(C) : typeof process < "u" && process.nextTick || De, a = {
  isArray: B,
  isArrayBuffer: Pe,
  isBuffer: ot,
  isFormData: ht,
  isArrayBufferView: st,
  isString: it,
  isNumber: Be,
  isBoolean: at,
  isObject: $,
  isPlainObject: z,
  isReadableStream: mt,
  isRequest: bt,
  isResponse: gt,
  isHeaders: yt,
  isUndefined: D,
  isDate: ct,
  isFile: ut,
  isBlob: lt,
  isRegExp: _t,
  isFunction: T,
  isStream: dt,
  isURLSearchParams: pt,
  isTypedArray: xt,
  isFileList: ft,
  forEach: q,
  merge: ne,
  extend: Et,
  trim: wt,
  stripBOM: Ot,
  inherits: St,
  toFlatObject: Rt,
  kindOf: K,
  kindOfTest: A,
  endsWith: Tt,
  toArray: At,
  forEachEntry: vt,
  matchAll: jt,
  isHTMLForm: Ct,
  hasOwnProperty: ge,
  hasOwnProp: ge,
  // an alias to avoid ESLint no-prototype-builtins detection
  reduceDescriptors: Ue,
  freezeMethods: Pt,
  toObjectSet: Bt,
  toCamelCase: Nt,
  noop: Ft,
  toFiniteNumber: Lt,
  findKey: Fe,
  global: C,
  isContextDefined: Le,
  ALPHABET: ke,
  generateString: Ut,
  isSpecCompliantForm: kt,
  toJSONObject: Dt,
  isAsyncFn: qt,
  isThenable: It,
  setImmediate: De,
  asap: Mt
};
function m(e, t, r, n, o) {
  Error.call(this), Error.captureStackTrace ? Error.captureStackTrace(this, this.constructor) : this.stack = new Error().stack, this.message = e, this.name = "AxiosError", t && (this.code = t), r && (this.config = r), n && (this.request = n), o && (this.response = o, this.status = o.status ? o.status : null);
}
a.inherits(m, Error, {
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
      status: this.status
    };
  }
});
const qe = m.prototype, Ie = {};
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
Object.defineProperties(m, Ie);
Object.defineProperty(qe, "isAxiosError", { value: !0 });
m.from = (e, t, r, n, o, s) => {
  const i = Object.create(qe);
  return a.toFlatObject(e, i, function(c) {
    return c !== Error.prototype;
  }, (c) => c !== "isAxiosError"), m.call(i, e.message, t, r, n, o), i.cause = e, i.name = e.name, s && Object.assign(i, s), i;
};
const zt = null;
function oe(e) {
  return a.isPlainObject(e) || a.isArray(e);
}
function Me(e) {
  return a.endsWith(e, "[]") ? e.slice(0, -2) : e;
}
function we(e, t, r) {
  return e ? e.concat(t).map(function(n, o) {
    return n = Me(n), !r && o ? "[" + n + "]" : n;
  }).join(r ? "." : "") : t;
}
function Ht(e) {
  return a.isArray(e) && !e.some(oe);
}
const Jt = a.toFlatObject(a, {}, null, function(e) {
  return /^is[A-Z]/.test(e);
});
function G(e, t, r) {
  if (!a.isObject(e))
    throw new TypeError("target must be an object");
  t = t || new FormData(), r = a.toFlatObject(r, {
    metaTokens: !0,
    dots: !1,
    indexes: !1
  }, !1, function(b, h) {
    return !a.isUndefined(h[b]);
  });
  const n = r.metaTokens, o = r.visitor || u, s = r.dots, i = r.indexes, c = (r.Blob || typeof Blob < "u" && Blob) && a.isSpecCompliantForm(t);
  if (!a.isFunction(o))
    throw new TypeError("visitor must be a function");
  function d(b) {
    if (b === null) return "";
    if (a.isDate(b))
      return b.toISOString();
    if (!c && a.isBlob(b))
      throw new m("Blob is not supported. Use a Buffer instead.");
    return a.isArrayBuffer(b) || a.isTypedArray(b) ? c && typeof Blob == "function" ? new Blob([b]) : Buffer.from(b) : b;
  }
  function u(b, h, f) {
    let O = b;
    if (b && !f && typeof b == "object") {
      if (a.endsWith(h, "{}"))
        h = n ? h : h.slice(0, -2), b = JSON.stringify(b);
      else if (a.isArray(b) && Ht(b) || (a.isFileList(b) || a.endsWith(h, "[]")) && (O = a.toArray(b)))
        return h = Me(h), O.forEach(function(E, y) {
          !(a.isUndefined(E) || E === null) && t.append(
            // eslint-disable-next-line no-nested-ternary
            i === !0 ? we([h], y, s) : i === null ? h : h + "[]",
            d(E)
          );
        }), !1;
    }
    return oe(b) ? !0 : (t.append(we(f, h, s), d(b)), !1);
  }
  const l = [], p = Object.assign(Jt, {
    defaultVisitor: u,
    convertValue: d,
    isVisitable: oe
  });
  function g(b, h) {
    if (!a.isUndefined(b)) {
      if (l.indexOf(b) !== -1)
        throw Error("Circular reference detected in " + h.join("."));
      l.push(b), a.forEach(b, function(f, O) {
        (!(a.isUndefined(f) || f === null) && o.call(
          t,
          f,
          a.isString(O) ? O.trim() : O,
          h,
          p
        )) === !0 && g(f, h ? h.concat(O) : [O]);
      }), l.pop();
    }
  }
  if (!a.isObject(e))
    throw new TypeError("data must be an object");
  return g(e), t;
}
function Ee(e) {
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
function de(e, t) {
  this._pairs = [], e && G(e, this, t);
}
const ze = de.prototype;
ze.append = function(e, t) {
  this._pairs.push([e, t]);
};
ze.toString = function(e) {
  const t = e ? function(r) {
    return e.call(this, r, Ee);
  } : Ee;
  return this._pairs.map(function(r) {
    return t(r[0]) + "=" + t(r[1]);
  }, "").join("&");
};
function Wt(e) {
  return encodeURIComponent(e).replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]");
}
function He(e, t, r) {
  if (!t)
    return e;
  const n = r && r.encode || Wt, o = r && r.serialize;
  let s;
  if (o ? s = o(t, r) : s = a.isURLSearchParams(t) ? t.toString() : new de(t, r).toString(n), s) {
    const i = e.indexOf("#");
    i !== -1 && (e = e.slice(0, i)), e += (e.indexOf("?") === -1 ? "?" : "&") + s;
  }
  return e;
}
class Oe {
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
const Je = {
  silentJSONParsing: !0,
  forcedJSONParsing: !0,
  clarifyTimeoutError: !1
}, Kt = typeof URLSearchParams < "u" ? URLSearchParams : de, Vt = typeof FormData < "u" ? FormData : null, $t = typeof Blob < "u" ? Blob : null, Gt = {
  isBrowser: !0,
  classes: {
    URLSearchParams: Kt,
    FormData: Vt,
    Blob: $t
  },
  protocols: ["http", "https", "file", "blob", "url", "data"]
}, he = typeof window < "u" && typeof document < "u", se = typeof navigator == "object" && navigator || void 0, Xt = he && (!se || ["ReactNative", "NativeScript", "NS"].indexOf(se.product) < 0), Qt = typeof WorkerGlobalScope < "u" && // eslint-disable-next-line no-undef
self instanceof WorkerGlobalScope && typeof self.importScripts == "function", Zt = he && window.location.href || "http://localhost", Yt = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  hasBrowserEnv: he,
  hasStandardBrowserEnv: Xt,
  hasStandardBrowserWebWorkerEnv: Qt,
  navigator: se,
  origin: Zt
}, Symbol.toStringTag, { value: "Module" })), S = {
  ...Yt,
  ...Gt
};
function er(e, t) {
  return G(e, new S.classes.URLSearchParams(), Object.assign({
    visitor: function(r, n, o, s) {
      return S.isNode && a.isBuffer(r) ? (this.append(n, r.toString("base64")), !1) : s.defaultVisitor.apply(this, arguments);
    }
  }, t));
}
function tr(e) {
  return a.matchAll(/\w+|\[(\w*)]/g, e).map((t) => t[0] === "[]" ? "" : t[1] || t[0]);
}
function rr(e) {
  const t = {}, r = Object.keys(e);
  let n;
  const o = r.length;
  let s;
  for (n = 0; n < o; n++)
    s = r[n], t[s] = e[s];
  return t;
}
function We(e) {
  function t(r, n, o, s) {
    let i = r[s++];
    if (i === "__proto__") return !0;
    const c = Number.isFinite(+i), d = s >= r.length;
    return i = !i && a.isArray(o) ? o.length : i, d ? (a.hasOwnProp(o, i) ? o[i] = [o[i], n] : o[i] = n, !c) : ((!o[i] || !a.isObject(o[i])) && (o[i] = []), t(r, n, o[i], s) && a.isArray(o[i]) && (o[i] = rr(o[i])), !c);
  }
  if (a.isFormData(e) && a.isFunction(e.entries)) {
    const r = {};
    return a.forEachEntry(e, (n, o) => {
      t(tr(n), o, r, 0);
    }), r;
  }
  return null;
}
function nr(e, t, r) {
  if (a.isString(e))
    try {
      return (t || JSON.parse)(e), a.trim(e);
    } catch (n) {
      if (n.name !== "SyntaxError")
        throw n;
    }
  return (0, JSON.stringify)(e);
}
const I = {
  transitional: Je,
  adapter: ["xhr", "http", "fetch"],
  transformRequest: [function(e, t) {
    const r = t.getContentType() || "", n = r.indexOf("application/json") > -1, o = a.isObject(e);
    if (o && a.isHTMLForm(e) && (e = new FormData(e)), a.isFormData(e))
      return n ? JSON.stringify(We(e)) : e;
    if (a.isArrayBuffer(e) || a.isBuffer(e) || a.isStream(e) || a.isFile(e) || a.isBlob(e) || a.isReadableStream(e))
      return e;
    if (a.isArrayBufferView(e))
      return e.buffer;
    if (a.isURLSearchParams(e))
      return t.setContentType("application/x-www-form-urlencoded;charset=utf-8", !1), e.toString();
    let s;
    if (o) {
      if (r.indexOf("application/x-www-form-urlencoded") > -1)
        return er(e, this.formSerializer).toString();
      if ((s = a.isFileList(e)) || r.indexOf("multipart/form-data") > -1) {
        const i = this.env && this.env.FormData;
        return G(
          s ? { "files[]": e } : e,
          i && new i(),
          this.formSerializer
        );
      }
    }
    return o || n ? (t.setContentType("application/json", !1), nr(e)) : e;
  }],
  transformResponse: [function(e) {
    const t = this.transitional || I.transitional, r = t && t.forcedJSONParsing, n = this.responseType === "json";
    if (a.isResponse(e) || a.isReadableStream(e))
      return e;
    if (e && a.isString(e) && (r && !this.responseType || n)) {
      const o = !(t && t.silentJSONParsing) && n;
      try {
        return JSON.parse(e);
      } catch (s) {
        if (o)
          throw s.name === "SyntaxError" ? m.from(s, m.ERR_BAD_RESPONSE, this, null, this.response) : s;
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
    FormData: S.classes.FormData,
    Blob: S.classes.Blob
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
  I.headers[e] = {};
});
const or = a.toObjectSet([
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
]), sr = (e) => {
  const t = {};
  let r, n, o;
  return e && e.split(`
`).forEach(function(s) {
    o = s.indexOf(":"), r = s.substring(0, o).trim().toLowerCase(), n = s.substring(o + 1).trim(), !(!r || t[r] && or[r]) && (r === "set-cookie" ? t[r] ? t[r].push(n) : t[r] = [n] : t[r] = t[r] ? t[r] + ", " + n : n);
  }), t;
}, Se = Symbol("internals");
function U(e) {
  return e && String(e).trim().toLowerCase();
}
function H(e) {
  return e === !1 || e == null ? e : a.isArray(e) ? e.map(H) : String(e);
}
function ir(e) {
  const t = /* @__PURE__ */ Object.create(null), r = /([^\s,;=]+)\s*(?:=\s*([^,;]+))?/g;
  let n;
  for (; n = r.exec(e); )
    t[n[1]] = n[2];
  return t;
}
const ar = (e) => /^[-_a-zA-Z0-9^`|~,!#$%&'*+.]+$/.test(e.trim());
function Y(e, t, r, n, o) {
  if (a.isFunction(n))
    return n.call(this, t, r);
  if (o && (t = r), !!a.isString(t)) {
    if (a.isString(n))
      return t.indexOf(n) !== -1;
    if (a.isRegExp(n))
      return n.test(t);
  }
}
function cr(e) {
  return e.trim().toLowerCase().replace(/([a-z\d])(\w*)/g, (t, r, n) => r.toUpperCase() + n);
}
function ur(e, t) {
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
class R {
  constructor(t) {
    t && this.set(t);
  }
  set(t, r, n) {
    const o = this;
    function s(c, d, u) {
      const l = U(d);
      if (!l)
        throw new Error("header name must be a non-empty string");
      const p = a.findKey(o, l);
      (!p || o[p] === void 0 || u === !0 || u === void 0 && o[p] !== !1) && (o[p || d] = H(c));
    }
    const i = (c, d) => a.forEach(c, (u, l) => s(u, l, d));
    if (a.isPlainObject(t) || t instanceof this.constructor)
      i(t, r);
    else if (a.isString(t) && (t = t.trim()) && !ar(t))
      i(sr(t), r);
    else if (a.isHeaders(t))
      for (const [c, d] of t.entries())
        s(d, c, n);
    else
      t != null && s(r, t, n);
    return this;
  }
  get(t, r) {
    if (t = U(t), t) {
      const n = a.findKey(this, t);
      if (n) {
        const o = this[n];
        if (!r)
          return o;
        if (r === !0)
          return ir(o);
        if (a.isFunction(r))
          return r.call(this, o, n);
        if (a.isRegExp(r))
          return r.exec(o);
        throw new TypeError("parser must be boolean|regexp|function");
      }
    }
  }
  has(t, r) {
    if (t = U(t), t) {
      const n = a.findKey(this, t);
      return !!(n && this[n] !== void 0 && (!r || Y(this, this[n], n, r)));
    }
    return !1;
  }
  delete(t, r) {
    const n = this;
    let o = !1;
    function s(i) {
      if (i = U(i), i) {
        const c = a.findKey(n, i);
        c && (!r || Y(n, n[c], c, r)) && (delete n[c], o = !0);
      }
    }
    return a.isArray(t) ? t.forEach(s) : s(t), o;
  }
  clear(t) {
    const r = Object.keys(this);
    let n = r.length, o = !1;
    for (; n--; ) {
      const s = r[n];
      (!t || Y(this, this[s], s, t, !0)) && (delete this[s], o = !0);
    }
    return o;
  }
  normalize(t) {
    const r = this, n = {};
    return a.forEach(this, (o, s) => {
      const i = a.findKey(n, s);
      if (i) {
        r[i] = H(o), delete r[s];
        return;
      }
      const c = t ? cr(s) : String(s).trim();
      c !== s && delete r[s], r[c] = H(o), n[c] = !0;
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
    const r = (this[Se] = this[Se] = {
      accessors: {}
    }).accessors, n = this.prototype;
    function o(s) {
      const i = U(s);
      r[i] || (ur(n, s), r[i] = !0);
    }
    return a.isArray(t) ? t.forEach(o) : o(t), this;
  }
}
R.accessor(["Content-Type", "Content-Length", "Accept", "Accept-Encoding", "User-Agent", "Authorization"]);
a.reduceDescriptors(R.prototype, ({ value: e }, t) => {
  let r = t[0].toUpperCase() + t.slice(1);
  return {
    get: () => e,
    set(n) {
      this[r] = n;
    }
  };
});
a.freezeMethods(R);
function ee(e, t) {
  const r = this || I, n = t || r, o = R.from(n.headers);
  let s = n.data;
  return a.forEach(e, function(i) {
    s = i.call(r, s, o.normalize(), t ? t.status : void 0);
  }), o.normalize(), s;
}
function Ke(e) {
  return !!(e && e.__CANCEL__);
}
function F(e, t, r) {
  m.call(this, e ?? "canceled", m.ERR_CANCELED, t, r), this.name = "CanceledError";
}
a.inherits(F, m, {
  __CANCEL__: !0
});
function Ve(e, t, r) {
  const n = r.config.validateStatus;
  !r.status || !n || n(r.status) ? e(r) : t(new m(
    "Request failed with status code " + r.status,
    [m.ERR_BAD_REQUEST, m.ERR_BAD_RESPONSE][Math.floor(r.status / 100) - 4],
    r.config,
    r.request,
    r
  ));
}
function lr(e) {
  const t = /^([-+\w]{1,25})(:?\/\/|:)/.exec(e);
  return t && t[1] || "";
}
function fr(e, t) {
  e = e || 10;
  const r = new Array(e), n = new Array(e);
  let o = 0, s = 0, i;
  return t = t !== void 0 ? t : 1e3, function(c) {
    const d = Date.now(), u = n[s];
    i || (i = d), r[o] = c, n[o] = d;
    let l = s, p = 0;
    for (; l !== o; )
      p += r[l++], l = l % e;
    if (o = (o + 1) % e, o === s && (s = (s + 1) % e), d - i < t)
      return;
    const g = u && d - u;
    return g ? Math.round(p * 1e3 / g) : void 0;
  };
}
function dr(e, t) {
  let r = 0, n = 1e3 / t, o, s;
  const i = (c, d = Date.now()) => {
    r = d, o = null, s && (clearTimeout(s), s = null), e.apply(null, c);
  };
  return [(...c) => {
    const d = Date.now(), u = d - r;
    u >= n ? i(c, d) : (o = c, s || (s = setTimeout(() => {
      s = null, i(o);
    }, n - u)));
  }, () => o && i(o)];
}
const J = (e, t, r = 3) => {
  let n = 0;
  const o = fr(50, 250);
  return dr((s) => {
    const i = s.loaded, c = s.lengthComputable ? s.total : void 0, d = i - n, u = o(d), l = i <= c;
    n = i;
    const p = {
      loaded: i,
      total: c,
      progress: c ? i / c : void 0,
      bytes: d,
      rate: u || void 0,
      estimated: u && c && l ? (c - i) / u : void 0,
      event: s,
      lengthComputable: c != null,
      [t ? "download" : "upload"]: !0
    };
    e(p);
  }, r);
}, Re = (e, t) => {
  const r = e != null;
  return [(n) => t[0]({
    lengthComputable: r,
    total: e,
    loaded: n
  }), t[1]];
}, Te = (e) => (...t) => a.asap(() => e(...t)), hr = S.hasStandardBrowserEnv ? (
  // Standard browser envs have full support of the APIs needed to test
  // whether the request URL is of the same origin as current location.
  function() {
    const e = S.navigator && /(msie|trident)/i.test(S.navigator.userAgent), t = document.createElement("a");
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
), pr = S.hasStandardBrowserEnv ? (
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
function mr(e) {
  return /^([a-z][a-z\d+\-.]*:)?\/\//i.test(e);
}
function br(e, t) {
  return t ? e.replace(/\/?\/$/, "") + "/" + t.replace(/^\/+/, "") : e;
}
function $e(e, t) {
  return e && !mr(t) ? br(e, t) : t;
}
const Ae = (e) => e instanceof R ? { ...e } : e;
function _(e, t) {
  t = t || {};
  const r = {};
  function n(u, l, p) {
    return a.isPlainObject(u) && a.isPlainObject(l) ? a.merge.call({ caseless: p }, u, l) : a.isPlainObject(l) ? a.merge({}, l) : a.isArray(l) ? l.slice() : l;
  }
  function o(u, l, p) {
    if (a.isUndefined(l)) {
      if (!a.isUndefined(u))
        return n(void 0, u, p);
    } else return n(u, l, p);
  }
  function s(u, l) {
    if (!a.isUndefined(l))
      return n(void 0, l);
  }
  function i(u, l) {
    if (a.isUndefined(l)) {
      if (!a.isUndefined(u))
        return n(void 0, u);
    } else return n(void 0, l);
  }
  function c(u, l, p) {
    if (p in t)
      return n(u, l);
    if (p in e)
      return n(void 0, u);
  }
  const d = {
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
    headers: (u, l) => o(Ae(u), Ae(l), !0)
  };
  return a.forEach(Object.keys(Object.assign({}, e, t)), function(u) {
    const l = d[u] || o, p = l(e[u], t[u], u);
    a.isUndefined(p) && l !== c || (r[u] = p);
  }), r;
}
const Ge = (e) => {
  const t = _({}, e);
  let { data: r, withXSRFToken: n, xsrfHeaderName: o, xsrfCookieName: s, headers: i, auth: c } = t;
  t.headers = i = R.from(i), t.url = He($e(t.baseURL, t.url), e.params, e.paramsSerializer), c && i.set(
    "Authorization",
    "Basic " + btoa((c.username || "") + ":" + (c.password ? unescape(encodeURIComponent(c.password)) : ""))
  );
  let d;
  if (a.isFormData(r)) {
    if (S.hasStandardBrowserEnv || S.hasStandardBrowserWebWorkerEnv)
      i.setContentType(void 0);
    else if ((d = i.getContentType()) !== !1) {
      const [u, ...l] = d ? d.split(";").map((p) => p.trim()).filter(Boolean) : [];
      i.setContentType([u || "multipart/form-data", ...l].join("; "));
    }
  }
  if (S.hasStandardBrowserEnv && (n && a.isFunction(n) && (n = n(t)), n || n !== !1 && hr(t.url))) {
    const u = o && s && pr.read(s);
    u && i.set(o, u);
  }
  return t;
}, gr = typeof XMLHttpRequest < "u", yr = gr && function(e) {
  return new Promise(function(t, r) {
    const n = Ge(e);
    let o = n.data;
    const s = R.from(n.headers).normalize();
    let { responseType: i, onUploadProgress: c, onDownloadProgress: d } = n, u, l, p, g, b;
    function h() {
      g && g(), b && b(), n.cancelToken && n.cancelToken.unsubscribe(u), n.signal && n.signal.removeEventListener("abort", u);
    }
    let f = new XMLHttpRequest();
    f.open(n.method.toUpperCase(), n.url, !0), f.timeout = n.timeout;
    function O() {
      if (!f)
        return;
      const y = R.from(
        "getAllResponseHeaders" in f && f.getAllResponseHeaders()
      ), x = {
        data: !i || i === "text" || i === "json" ? f.responseText : f.response,
        status: f.status,
        statusText: f.statusText,
        headers: y,
        config: e,
        request: f
      };
      Ve(function(L) {
        t(L), h();
      }, function(L) {
        r(L), h();
      }, x), f = null;
    }
    "onloadend" in f ? f.onloadend = O : f.onreadystatechange = function() {
      !f || f.readyState !== 4 || f.status === 0 && !(f.responseURL && f.responseURL.indexOf("file:") === 0) || setTimeout(O);
    }, f.onabort = function() {
      f && (r(new m("Request aborted", m.ECONNABORTED, e, f)), f = null);
    }, f.onerror = function() {
      r(new m("Network Error", m.ERR_NETWORK, e, f)), f = null;
    }, f.ontimeout = function() {
      let y = n.timeout ? "timeout of " + n.timeout + "ms exceeded" : "timeout exceeded";
      const x = n.transitional || Je;
      n.timeoutErrorMessage && (y = n.timeoutErrorMessage), r(new m(
        y,
        x.clarifyTimeoutError ? m.ETIMEDOUT : m.ECONNABORTED,
        e,
        f
      )), f = null;
    }, o === void 0 && s.setContentType(null), "setRequestHeader" in f && a.forEach(s.toJSON(), function(y, x) {
      f.setRequestHeader(x, y);
    }), a.isUndefined(n.withCredentials) || (f.withCredentials = !!n.withCredentials), i && i !== "json" && (f.responseType = n.responseType), d && ([p, b] = J(d, !0), f.addEventListener("progress", p)), c && f.upload && ([l, g] = J(c), f.upload.addEventListener("progress", l), f.upload.addEventListener("loadend", g)), (n.cancelToken || n.signal) && (u = (y) => {
      f && (r(!y || y.type ? new F(null, e, f) : y), f.abort(), f = null);
    }, n.cancelToken && n.cancelToken.subscribe(u), n.signal && (n.signal.aborted ? u() : n.signal.addEventListener("abort", u)));
    const E = lr(n.url);
    if (E && S.protocols.indexOf(E) === -1) {
      r(new m("Unsupported protocol " + E + ":", m.ERR_BAD_REQUEST, e));
      return;
    }
    f.send(o || null);
  });
}, wr = (e, t) => {
  const { length: r } = e = e ? e.filter(Boolean) : [];
  if (t || r) {
    let n = new AbortController(), o;
    const s = function(u) {
      if (!o) {
        o = !0, c();
        const l = u instanceof Error ? u : this.reason;
        n.abort(l instanceof m ? l : new F(l instanceof Error ? l.message : l));
      }
    };
    let i = t && setTimeout(() => {
      i = null, s(new m(`timeout ${t} of ms exceeded`, m.ETIMEDOUT));
    }, t);
    const c = () => {
      e && (i && clearTimeout(i), i = null, e.forEach((u) => {
        u.unsubscribe ? u.unsubscribe(s) : u.removeEventListener("abort", s);
      }), e = null);
    };
    e.forEach((u) => u.addEventListener("abort", s));
    const { signal: d } = n;
    return d.unsubscribe = () => a.asap(c), d;
  }
}, Er = function* (e, t) {
  let r = e.byteLength;
  if (r < t) {
    yield e;
    return;
  }
  let n = 0, o;
  for (; n < r; )
    o = n + t, yield e.slice(n, o), n = o;
}, Or = async function* (e, t) {
  for await (const r of Sr(e))
    yield* Er(r, t);
}, Sr = async function* (e) {
  if (e[Symbol.asyncIterator]) {
    yield* e;
    return;
  }
  const t = e.getReader();
  try {
    for (; ; ) {
      const { done: r, value: n } = await t.read();
      if (r)
        break;
      yield n;
    }
  } finally {
    await t.cancel();
  }
}, xe = (e, t, r, n) => {
  const o = Or(e, t);
  let s = 0, i, c = (d) => {
    i || (i = !0, n && n(d));
  };
  return new ReadableStream({
    async pull(d) {
      try {
        const { done: u, value: l } = await o.next();
        if (u) {
          c(), d.close();
          return;
        }
        let p = l.byteLength;
        if (r) {
          let g = s += p;
          r(g);
        }
        d.enqueue(new Uint8Array(l));
      } catch (u) {
        throw c(u), u;
      }
    },
    cancel(d) {
      return c(d), o.return();
    }
  }, {
    highWaterMark: 2
  });
}, X = typeof fetch == "function" && typeof Request == "function" && typeof Response == "function", Xe = X && typeof ReadableStream == "function", Rr = X && (typeof TextEncoder == "function" ? /* @__PURE__ */ ((e) => (t) => e.encode(t))(new TextEncoder()) : async (e) => new Uint8Array(await new Response(e).arrayBuffer())), Qe = (e, ...t) => {
  try {
    return !!e(...t);
  } catch {
    return !1;
  }
}, Tr = Xe && Qe(() => {
  let e = !1;
  const t = new Request(S.origin, {
    body: new ReadableStream(),
    method: "POST",
    get duplex() {
      return e = !0, "half";
    }
  }).headers.has("Content-Type");
  return e && !t;
}), ve = 64 * 1024, ie = Xe && Qe(() => a.isReadableStream(new Response("").body)), W = {
  stream: ie && ((e) => e.body)
};
X && ((e) => {
  ["text", "arrayBuffer", "blob", "formData", "stream"].forEach((t) => {
    !W[t] && (W[t] = a.isFunction(e[t]) ? (r) => r[t]() : (r, n) => {
      throw new m(`Response type '${t}' is not supported`, m.ERR_NOT_SUPPORT, n);
    });
  });
})(new Response());
const Ar = async (e) => {
  if (e == null)
    return 0;
  if (a.isBlob(e))
    return e.size;
  if (a.isSpecCompliantForm(e))
    return (await new Request(S.origin, {
      method: "POST",
      body: e
    }).arrayBuffer()).byteLength;
  if (a.isArrayBufferView(e) || a.isArrayBuffer(e))
    return e.byteLength;
  if (a.isURLSearchParams(e) && (e = e + ""), a.isString(e))
    return (await Rr(e)).byteLength;
}, xr = async (e, t) => a.toFiniteNumber(e.getContentLength()) ?? Ar(t), vr = X && (async (e) => {
  let {
    url: t,
    method: r,
    data: n,
    signal: o,
    cancelToken: s,
    timeout: i,
    onDownloadProgress: c,
    onUploadProgress: d,
    responseType: u,
    headers: l,
    withCredentials: p = "same-origin",
    fetchOptions: g
  } = Ge(e);
  u = u ? (u + "").toLowerCase() : "text";
  let b = wr([o, s && s.toAbortSignal()], i), h;
  const f = b && b.unsubscribe && (() => {
    b.unsubscribe();
  });
  let O;
  try {
    if (d && Tr && r !== "get" && r !== "head" && (O = await xr(l, n)) !== 0) {
      let v = new Request(t, {
        method: "POST",
        body: n,
        duplex: "half"
      }), P;
      if (a.isFormData(n) && (P = v.headers.get("content-type")) && l.setContentType(P), v.body) {
        const [Q, M] = Re(
          O,
          J(Te(d))
        );
        n = xe(v.body, ve, Q, M);
      }
    }
    a.isString(p) || (p = p ? "include" : "omit");
    const E = "credentials" in Request.prototype;
    h = new Request(t, {
      ...g,
      signal: b,
      method: r.toUpperCase(),
      headers: l.normalize().toJSON(),
      body: n,
      duplex: "half",
      credentials: E ? p : void 0
    });
    let y = await fetch(h);
    const x = ie && (u === "stream" || u === "response");
    if (ie && (c || x && f)) {
      const v = {};
      ["status", "statusText", "headers"].forEach((be) => {
        v[be] = y[be];
      });
      const P = a.toFiniteNumber(y.headers.get("content-length")), [Q, M] = c && Re(
        P,
        J(Te(c), !0)
      ) || [];
      y = new Response(
        xe(y.body, ve, Q, () => {
          M && M(), f && f();
        }),
        v
      );
    }
    u = u || "text";
    let L = await W[a.findKey(W, u) || "text"](y, e);
    return !x && f && f(), await new Promise((v, P) => {
      Ve(v, P, {
        data: L,
        headers: R.from(y.headers),
        status: y.status,
        statusText: y.statusText,
        config: e,
        request: h
      });
    });
  } catch (E) {
    throw f && f(), E && E.name === "TypeError" && /fetch/i.test(E.message) ? Object.assign(
      new m("Network Error", m.ERR_NETWORK, e, h),
      {
        cause: E.cause || E
      }
    ) : m.from(E, E && E.code, e, h);
  }
}), ae = {
  http: zt,
  xhr: yr,
  fetch: vr
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
const je = (e) => `- ${e}`, jr = (e) => a.isFunction(e) || e === null || e === !1, Ze = {
  getAdapter: (e) => {
    e = a.isArray(e) ? e : [e];
    const { length: t } = e;
    let r, n;
    const o = {};
    for (let s = 0; s < t; s++) {
      r = e[s];
      let i;
      if (n = r, !jr(r) && (n = ae[(i = String(r)).toLowerCase()], n === void 0))
        throw new m(`Unknown adapter '${i}'`);
      if (n)
        break;
      o[i || "#" + s] = n;
    }
    if (!n) {
      const s = Object.entries(o).map(
        ([c, d]) => `adapter ${c} ` + (d === !1 ? "is not supported by the environment" : "is not available in the build")
      );
      let i = t ? s.length > 1 ? `since :
` + s.map(je).join(`
`) : " " + je(s[0]) : "as no adapter specified";
      throw new m(
        "There is no suitable adapter to dispatch the request " + i,
        "ERR_NOT_SUPPORT"
      );
    }
    return n;
  },
  adapters: ae
};
function te(e) {
  if (e.cancelToken && e.cancelToken.throwIfRequested(), e.signal && e.signal.aborted)
    throw new F(null, e);
}
function Ce(e) {
  return te(e), e.headers = R.from(e.headers), e.data = ee.call(
    e,
    e.transformRequest
  ), ["post", "put", "patch"].indexOf(e.method) !== -1 && e.headers.setContentType("application/x-www-form-urlencoded", !1), Ze.getAdapter(e.adapter || I.adapter)(e).then(function(t) {
    return te(e), t.data = ee.call(
      e,
      e.transformResponse,
      t
    ), t.headers = R.from(t.headers), t;
  }, function(t) {
    return Ke(t) || (te(e), t && t.response && (t.response.data = ee.call(
      e,
      e.transformResponse,
      t.response
    ), t.response.headers = R.from(t.response.headers))), Promise.reject(t);
  });
}
const Ye = "1.7.7", pe = {};
["object", "boolean", "number", "function", "string", "symbol"].forEach((e, t) => {
  pe[e] = function(r) {
    return typeof r === e || "a" + (t < 1 ? "n " : " ") + e;
  };
});
const Ne = {};
pe.transitional = function(e, t, r) {
  function n(o, s) {
    return "[Axios v" + Ye + "] Transitional option '" + o + "'" + s + (r ? ". " + r : "");
  }
  return (o, s, i) => {
    if (e === !1)
      throw new m(
        n(s, " has been removed" + (t ? " in " + t : "")),
        m.ERR_DEPRECATED
      );
    return t && !Ne[s] && (Ne[s] = !0, console.warn(
      n(
        s,
        " has been deprecated since v" + t + " and will be removed in the near future"
      )
    )), e ? e(o, s, i) : !0;
  };
};
function Cr(e, t, r) {
  if (typeof e != "object")
    throw new m("options must be an object", m.ERR_BAD_OPTION_VALUE);
  const n = Object.keys(e);
  let o = n.length;
  for (; o-- > 0; ) {
    const s = n[o], i = t[s];
    if (i) {
      const c = e[s], d = c === void 0 || i(c, s, e);
      if (d !== !0)
        throw new m("option " + s + " must be " + d, m.ERR_BAD_OPTION_VALUE);
      continue;
    }
    if (r !== !0)
      throw new m("Unknown option " + s, m.ERR_BAD_OPTION);
  }
}
const ce = {
  assertOptions: Cr,
  validators: pe
}, j = ce.validators;
class N {
  constructor(t) {
    this.defaults = t, this.interceptors = {
      request: new Oe(),
      response: new Oe()
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
    n !== void 0 && ce.assertOptions(n, {
      silentJSONParsing: j.transitional(j.boolean),
      forcedJSONParsing: j.transitional(j.boolean),
      clarifyTimeoutError: j.transitional(j.boolean)
    }, !1), o != null && (a.isFunction(o) ? r.paramsSerializer = {
      serialize: o
    } : ce.assertOptions(o, {
      encode: j.function,
      serialize: j.function
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
    ), r.headers = R.concat(i, s);
    const c = [];
    let d = !0;
    this.interceptors.request.forEach(function(h) {
      typeof h.runWhen == "function" && h.runWhen(r) === !1 || (d = d && h.synchronous, c.unshift(h.fulfilled, h.rejected));
    });
    const u = [];
    this.interceptors.response.forEach(function(h) {
      u.push(h.fulfilled, h.rejected);
    });
    let l, p = 0, g;
    if (!d) {
      const h = [Ce.bind(this), void 0];
      for (h.unshift.apply(h, c), h.push.apply(h, u), g = h.length, l = Promise.resolve(r); p < g; )
        l = l.then(h[p++], h[p++]);
      return l;
    }
    g = c.length;
    let b = r;
    for (p = 0; p < g; ) {
      const h = c[p++], f = c[p++];
      try {
        b = h(b);
      } catch (O) {
        f.call(this, O);
        break;
      }
    }
    try {
      l = Ce.call(this, b);
    } catch (h) {
      return Promise.reject(h);
    }
    for (p = 0, g = u.length; p < g; )
      l = l.then(u[p++], u[p++]);
    return l;
  }
  getUri(t) {
    t = _(this.defaults, t);
    const r = $e(t.baseURL, t.url);
    return He(r, t.params, t.paramsSerializer);
  }
}
a.forEach(["delete", "get", "head", "options"], function(e) {
  N.prototype[e] = function(t, r) {
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
  N.prototype[e] = t(), N.prototype[e + "Form"] = t(!0);
});
class me {
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
      n.reason || (n.reason = new F(o, s, i), r(n.reason));
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
  toAbortSignal() {
    const t = new AbortController(), r = (n) => {
      t.abort(n);
    };
    return this.subscribe(r), t.signal.unsubscribe = () => this.unsubscribe(r), t.signal;
  }
  /**
   * Returns an object that contains a new `CancelToken` and a function that, when called,
   * cancels the `CancelToken`.
   */
  static source() {
    let t;
    return {
      token: new me(function(r) {
        t = r;
      }),
      cancel: t
    };
  }
}
function Nr(e) {
  return function(t) {
    return e.apply(null, t);
  };
}
function _r(e) {
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
  const t = new N(e), r = _e(N.prototype.request, t);
  return a.extend(r, N.prototype, t, { allOwnKeys: !0 }), a.extend(r, t, null, { allOwnKeys: !0 }), r.create = function(n) {
    return et(_(e, n));
  }, r;
}
const w = et(I);
w.Axios = N;
w.CanceledError = F;
w.CancelToken = me;
w.isCancel = Ke;
w.VERSION = Ye;
w.toFormData = G;
w.AxiosError = m;
w.Cancel = w.CanceledError;
w.all = function(e) {
  return Promise.all(e);
};
w.spread = Nr;
w.isAxiosError = _r;
w.mergeConfig = _;
w.AxiosHeaders = R;
w.formToJSON = (e) => We(a.isHTMLForm(e) ? new FormData(e) : e);
w.getAdapter = Ze.getAdapter;
w.HttpStatusCode = ue;
w.default = w;
const Pr = (e) => {
  const t = typeof e;
  return e !== null && (t === "object" || t === "function");
}, re = /* @__PURE__ */ new Set([
  "__proto__",
  "prototype",
  "constructor"
]), Br = new Set("0123456789");
function Fr(e) {
  const t = [];
  let r = "", n = "start", o = !1;
  for (const s of e)
    switch (s) {
      case "\\": {
        if (n === "index")
          throw new Error("Invalid character in an index");
        if (n === "indexEnd")
          throw new Error("Invalid character after an index");
        o && (r += s), n = "property", o = !o;
        break;
      }
      case ".": {
        if (n === "index")
          throw new Error("Invalid character in an index");
        if (n === "indexEnd") {
          n = "property";
          break;
        }
        if (o) {
          o = !1, r += s;
          break;
        }
        if (re.has(r))
          return [];
        t.push(r), r = "", n = "property";
        break;
      }
      case "[": {
        if (n === "index")
          throw new Error("Invalid character in an index");
        if (n === "indexEnd") {
          n = "index";
          break;
        }
        if (o) {
          o = !1, r += s;
          break;
        }
        if (n === "property") {
          if (re.has(r))
            return [];
          t.push(r), r = "";
        }
        n = "index";
        break;
      }
      case "]": {
        if (n === "index") {
          t.push(Number.parseInt(r, 10)), r = "", n = "indexEnd";
          break;
        }
        if (n === "indexEnd")
          throw new Error("Invalid character after an index");
      }
      default: {
        if (n === "index" && !Br.has(s))
          throw new Error("Invalid character in an index");
        if (n === "indexEnd")
          throw new Error("Invalid character after an index");
        n === "start" && (n = "property"), o && (o = !1, r += "\\"), r += s;
      }
    }
  switch (o && (r += "\\"), n) {
    case "property": {
      if (re.has(r))
        return [];
      t.push(r);
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
function Lr(e, t) {
  if (typeof t != "number" && Array.isArray(e)) {
    const r = Number.parseInt(t, 10);
    return Number.isInteger(r) && e[r] === e[t];
  }
  return !1;
}
function Ur(e, t, r) {
  if (!Pr(e) || typeof t != "string")
    return r === void 0 ? e : r;
  const n = Fr(t);
  if (n.length === 0)
    return r;
  for (let o = 0; o < n.length; o++) {
    const s = n[o];
    if (Lr(e, s) ? e = o === n.length - 1 ? void 0 : null : e = e[s], e == null) {
      if (o !== n.length - 1)
        return r;
      break;
    }
  }
  return e === void 0 ? r : e;
}
const tt = rt("config", {
  persist: !0,
  state: () => ({
    config: {}
  }),
  getters: {
    get: (e) => (t, r) => Ur(e.config, t, r)
  },
  actions: {
    async load() {
      w.get("/api/config").then((e) => {
        this.config = e.data;
      });
    }
  }
});
function kr() {
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
function Dr() {
  return tt().get("locales.available");
}
function qr() {
  return "/account/captcha";
}
async function Ir(e) {
  return le.post("/account/register", e).then((t) => t.data).catch((t) => {
    throw {
      description: "An error as occurred",
      style: k.Danger,
      closeBtn: !0,
      ...t.response.data
    };
  });
}
const Hr = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  doRegister: Ir,
  getAvailableLocales: Dr,
  getCaptchaUrl: qr,
  getDefaultForm: kr
}, Symbol.toStringTag, { value: "Module" }));
async function Jr(e) {
  return le.post("/account/forgot-password", { email: e }).then((t) => ({
    description: t.data.message,
    style: k.Success,
    closeBtn: !0
  })).catch((t) => {
    throw {
      description: "An error as occurred",
      style: k.Danger,
      closeBtn: !0,
      ...t.response.data
    };
  });
}
async function Wr(e) {
  return le.post("/account/resend-verification", { email: e }).then((t) => ({
    description: t.data.message,
    style: k.Success,
    closeBtn: !0
  })).catch((t) => {
    throw {
      description: "An error as occurred",
      style: k.Danger,
      closeBtn: !0,
      ...t.response.data
    };
  });
}
export {
  Hr as Register,
  Jr as forgotPassword,
  Wr as resendVerification
};
