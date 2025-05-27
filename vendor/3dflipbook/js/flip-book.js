/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


exports.__esModule = true;

var _libs = __webpack_require__(2);

__webpack_require__(1);

exports.default = _libs.$;

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _typeof2 = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

/******/(function (modules) {
  // webpackBootstrap
  /******/ // The module cache
  /******/var installedModules = {};
  /******/
  /******/ // The require function
  /******/function __webpack_require__(moduleId) {
    /******/
    /******/ // Check if module is in cache
    /******/if (installedModules[moduleId])
      /******/return installedModules[moduleId].exports;
    /******/
    /******/ // Create a new module (and put it into the cache)
    /******/var module = installedModules[moduleId] = {
      /******/i: moduleId,
      /******/l: false,
      /******/exports: {}
      /******/ };
    /******/
    /******/ // Execute the module function
    /******/modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
    /******/
    /******/ // Flag the module as loaded
    /******/module.l = true;
    /******/
    /******/ // Return the exports of the module
    /******/return module.exports;
    /******/
  }
  /******/
  /******/
  /******/ // expose the modules object (__webpack_modules__)
  /******/__webpack_require__.m = modules;
  /******/
  /******/ // expose the module cache
  /******/__webpack_require__.c = installedModules;
  /******/
  /******/ // identity function for calling harmony imports with the correct context
  /******/__webpack_require__.i = function (value) {
    return value;
  };
  /******/
  /******/ // define getter function for harmony exports
  /******/__webpack_require__.d = function (exports, name, getter) {
    /******/if (!__webpack_require__.o(exports, name)) {
      /******/Object.defineProperty(exports, name, {
        /******/configurable: false,
        /******/enumerable: true,
        /******/get: getter
        /******/ });
      /******/
    }
    /******/
  };
  /******/
  /******/ // getDefaultExport function for compatibility with non-harmony modules
  /******/__webpack_require__.n = function (module) {
    /******/var getter = module && module.__esModule ?
    /******/function getDefault() {
      return module['default'];
    } :
    /******/function getModuleExports() {
      return module;
    };
    /******/__webpack_require__.d(getter, 'a', getter);
    /******/return getter;
    /******/
  };
  /******/
  /******/ // Object.prototype.hasOwnProperty.call
  /******/__webpack_require__.o = function (object, property) {
    return Object.prototype.hasOwnProperty.call(object, property);
  };
  /******/
  /******/ // __webpack_public_path__
  /******/__webpack_require__.p = "";
  /******/
  /******/ // Load entry module and return exports
  /******/return __webpack_require__(__webpack_require__.s = 72);
  /******/
})(
/************************************************************************/
/******/[
/* 0 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;
  var _$ = true ? window.jQuery : require('jquery'),
      _html2canvas = true ? window.html2canvas : require('html2canvas'),
      _THREE = true ? window.THREE : require('three'),
      _React = true ? window.React : require('react'),
      _ReactDOM = true ? window.ReactDOM : require('react-dom'),
      _PDFJS = true ? window.PDFJS : require('pdfjs'),
      _tr = function _tr(s) {
    return (window.iberezansky || {}).tr && window.iberezansky.tr(s) || s;
  };

  exports.$ = _$;
  exports.html2canvas = _html2canvas;
  exports.THREE = _THREE;
  exports.React = _React;
  exports.ReactDOM = _ReactDOM;
  exports.PDFJS = _PDFJS;
  exports.tr = _tr;

  /***/
},
/* 1 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _$ = true ? window.jQuery : require('jquery'),
      _html2canvas = true ? window.html2canvas : require('html2canvas'),
      _THREE = true ? window.THREE : require('three'),
      _PDFJS = true ? window.PDFJS : require('pdfjs'),
      _tr = function _tr(s) {
    return (window.iberezansky || {}).tr && window.iberezansky.tr(s) || s;
  };

  if (window.FB3D_LOCALE) {
    window.iberezansky = _extends({}, window.iberezansky, {
      tr: function tr(s) {
        return (FB3D_LOCALE.dictionary || {})[s] || s;
      }
    });
  }

  exports.$ = _$;
  exports.html2canvas = _html2canvas;
  exports.THREE = _THREE;
  exports.PDFJS = _PDFJS;
  exports.tr = _tr;

  /***/
},
/* 2 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var BaseMathUtils = function () {
    function BaseMathUtils() {
      _classCallCheck(this, BaseMathUtils);
    }

    BaseMathUtils.sum1 = function sum1(ka, a, kb, b) {
      return [ka * a[0] + kb * b[0]];
    };

    BaseMathUtils.sum2 = function sum2(ka, a, kb, b) {
      return [ka * a[0] + kb * b[0], ka * a[1] + kb * b[1]];
    };

    BaseMathUtils.sum3 = function sum3(ka, a, kb, b) {
      return [ka * a[0] + kb * b[0], ka * a[1] + kb * b[1], ka * a[2] + kb * b[2]];
    };

    BaseMathUtils.sum4 = function sum4(ka, a, kb, b) {
      return [ka * a[0] + kb * b[0], ka * a[1] + kb * b[1], ka * a[2] + kb * b[2], ka * a[3] + kb * b[3]];
    };

    BaseMathUtils.rk4 = function rk4(dy, t, dt, y) {
      var sum = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : BaseMathUtils.sum[y.length - 1];

      var k1 = dy(t, y),
          k2 = dy(t + dt / 2, sum(1, y, dt / 2, k1)),
          k3 = dy(t + dt / 2, sum(1, y, dt / 2, k2)),
          k4 = dy(t + dt, sum(1, y, dt, k3));
      return sum(1, y, dt / 6, sum(1, sum(1, k1, 2, k2), 1, sum(2, k3, 1, k4)));
    };

    BaseMathUtils.extrapolateLinear = function extrapolateLinear(x, y, xi) {
      return y[0] + (y[1] - y[0]) / (x[1] - x[0]) * (xi - x[0]);
    };

    BaseMathUtils.interpolateLinear = function interpolateLinear(x, y, xi) {
      var yi = void 0;
      if (x[0] > x[1]) {
        x = x.reverse();
        y = y.reverse();
      }
      if (xi < x[0]) {
        yi = y[0];
      } else if (xi > x[1]) {
        yi = y[1];
      } else {
        yi = BaseMathUtils.extrapolateLinear(x, y, xi);
      }
      return yi;
    };

    BaseMathUtils.calcScale = function calcScale(srcW, srcH, dstW, dstH) {
      return Math.min(dstW / srcW, dstH / srcH);
    };

    BaseMathUtils.mulM = function mulM(a, b) {
      var r = [];
      for (var i = 0; i < a.length; ++i) {
        r.push([]);
        for (var j = 0; j < b[0].length; ++j) {
          r[i][j] = 0;
          for (var k = 0; k < b.length; ++k) {
            r[i][j] += a[i][k] * b[k][j];
          }
        }
      }
      return r;
    };

    BaseMathUtils.transM = function transM(m) {
      var r = [];
      for (var i = 0; i < m.length; ++i) {
        for (var j = 0; j < m[0].length; ++j) {
          if (!r[j]) {
            r[j] = [];
          }
          r[j][i] = m[i][j];
        }
      }
      return r;
    };

    BaseMathUtils.mat = function mat(data) {
      var s = 0;
      for (var _iterator = data, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var x = _ref;

        s += x;
      }
      return s / data.length;
    };

    BaseMathUtils.disp = function disp(data) {
      var M = BaseMathUtils.mat(data);
      var s = 0;
      for (var _iterator2 = data, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
        var _ref2;

        if (_isArray2) {
          if (_i2 >= _iterator2.length) break;
          _ref2 = _iterator2[_i2++];
        } else {
          _i2 = _iterator2.next();
          if (_i2.done) break;
          _ref2 = _i2.value;
        }

        var x = _ref2;

        s += (x - M) * (x - M);
      }
      return s / data.length;
    };

    BaseMathUtils.predict = function predict(data, num) {
      var r = [],
          l = data.length,
          D = BaseMathUtils.disp(data);
      if (D < l && l > 1) {
        var am = [],
            bm = [];
        for (var i = 0; i < l; ++i) {
          am.push([i, 1]);
          bm.push([data[i]]);
        }
        var ta = BaseMathUtils.transM(am),
            a = BaseMathUtils.mulM(ta, am),
            b = BaseMathUtils.mulM(ta, bm),
            d = a[0][0] * a[1][1] - a[1][0] * a[0][1],
            p = [-(a[0][1] * b[1][0] - b[0][0] * a[1][1]) / d, (a[0][0] * b[1][0] - a[1][0] * b[0][0]) / d];
        for (var _i3 = 0; _i3 < num; ++_i3) {
          var v = Math.round(p[0] * (_i3 + l) + p[1]);
          if (r.indexOf(v) === -1) {
            r.push(v);
          }
        }
      }
      return r;
    };

    BaseMathUtils.getUnique = function getUnique() {
      return Math.ceil(1e9 * Math.random());
    };

    BaseMathUtils.setSplinePoints = function setSplinePoints(spline, ps) {
      if (spline.points.length !== ps.x.length) {
        console.warn('setSplinePoints: bad points');
      }
      for (var i = 0; i < spline.points.length; ++i) {
        spline.points[i].set(ps.x[i], ps.y[i], ps.z ? ps.z[i] : 0);
      }
    };

    BaseMathUtils.mapl2L = function mapl2L(ls, len, n, f) {
      var dL = len / (n - 1);
      var L = 0;
      for (var i = 0, d = ls[0]; i < ls.length - 1 && L < len + 0.1 * dL; ++i, d += ls[i]) {
        if (Math.abs(L - d) < Math.abs(L - d - ls[i + 1])) {
          f(i, L);
          L += dL;
        }
      }
      if (L < len + 0.1 * dL) {
        console.warn('mapl2L: ls is not enought');
      }
    };

    BaseMathUtils.det2 = function det2(a, b, c, d) {
      return a * d - b * c;
    };

    BaseMathUtils.solve2Lin = function solve2Lin(a1, b1, a2, b2) {
      var res = void 0;
      var d = BaseMathUtils.det2(a1[0], a1[1], a2[0], a2[1]);
      if (Math.abs(d) > BaseMathUtils.eps) {
        var dx = BaseMathUtils.det2(b1, a1[1], b2, a2[1]),
            dy = BaseMathUtils.det2(a1[0], b1, a2[0], b2);
        res = {
          x: dx / d,
          y: dy / d
        };
      }
      return res;
    };

    BaseMathUtils.isInsidePoly = function isInsidePoly(ps, p) {
      var done = false,
          ct = void 0;
      for (var i = 0; i < ps.length; ++i) {
        if (BaseMathUtils.v2dist(p, ps[i]) < BaseMathUtils.eps) {
          ct = 1;
          done = true;
          break;
        }
      }
      while (!done) {
        done = true;
        ct = 0;
        var np = { x: p.x + Math.random() - 0.5, y: p.y + Math.random() - 0.5 },
            rn = { x: np.x - p.x, y: np.y - p.y },
            a1 = [rn.y, -rn.x],
            b1 = p.x * rn.y - p.y * rn.x;
        for (var _i4 = 0; _i4 < ps.length; ++_i4) {
          var p0 = ps[_i4],
              p1 = ps[(_i4 + 1) % ps.length],
              n = { x: p1.x - p0.x, y: p1.y - p0.y },
              a2 = [n.y, -n.x],
              b2 = p0.x * n.y - p0.y * n.x,
              ip = BaseMathUtils.solve2Lin(a1, b1, a2, b2);
          if (ip) {
            if (BaseMathUtils.v2dist(ip, p0) < BaseMathUtils.eps || BaseMathUtils.v2dist(ip, p1) < BaseMathUtils.eps) {
              done = false;
              break;
            } else if (ip.x > Math.min(p0.x, p1.x) - BaseMathUtils.eps && ip.x < Math.max(p0.x, p1.x) + BaseMathUtils.eps && ip.y > Math.min(p0.y, p1.y) - BaseMathUtils.eps && ip.y < Math.max(p0.y, p1.y) + BaseMathUtils.eps) {
              if (BaseMathUtils.v2dist(ip, p) < BaseMathUtils.eps) {
                ct = 1;
                break;
              } else {
                var tn = { x: ip.x - p.x, y: ip.y - p.y };
                ct += tn.x * rn.x + tn.y * rn.y > 0;
              }
            }
          }
        }
      }
      return ct % 2;
    };

    BaseMathUtils.isInsideConvPoly = function isInsideConvPoly(ps, p) {
      var sg = [0, 0];
      for (var i = 0; i < ps.length; ++i) {
        var p0 = ps[i],
            p1 = ps[(i + 1) % ps.length],
            a = { x: p0.x - p.x, y: p0.y - p.y },
            b = { x: p1.x - p.x, y: p1.y - p.y };
        ++sg[(a.x * b.y - a.y * b.x < 0) + 0];
      }
      return ~sg.indexOf(ps.length);
    };

    BaseMathUtils.v2len = function v2len(v2) {
      return Math.sqrt(v2.x * v2.x + v2.y * v2.y);
    };

    BaseMathUtils.v2dist = function v2dist(v21, v22) {
      return BaseMathUtils.v2len({
        x: v22.x - v21.x,
        y: v22.y - v21.y
      });
    };

    BaseMathUtils.computeSquare = function computeSquare(ps) {
      var a = [];
      var p = 0;
      for (var i = 0; i < ps.length; ++i) {
        a.push(BaseMathUtils.v2dist(ps[i], ps[(i + 1) % ps.length]));
        p += 0.5 * a[i];
      }
      return Math.sqrt(p * (p - a[0]) * (p - a[1]) * (p - a[2]));
    };

    BaseMathUtils.computeInterpCoefs = function computeInterpCoefs(tri, p) {
      var s = BaseMathUtils.computeSquare(tri),
          coefs = [],
          l = tri.length;
      for (var i = 0; i < l; ++i) {
        coefs[i] = BaseMathUtils.computeSquare([p, tri[(i + 1) % l], tri[(i + 2) % l]]) / s;
      }
      return coefs;
    };

    return BaseMathUtils;
  }();

  BaseMathUtils.sum = [BaseMathUtils.sum1, BaseMathUtils.sum2, BaseMathUtils.sum3, BaseMathUtils.sum4];
  BaseMathUtils.eps = 1e-4;
  exports.default = BaseMathUtils;

  /***/
},
/* 3 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _BaseMathUtils2 = __webpack_require__(2);

  var _BaseMathUtils3 = _interopRequireDefault(_BaseMathUtils2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var MathUtils = function (_BaseMathUtils) {
    _inherits(MathUtils, _BaseMathUtils);

    function MathUtils() {
      _classCallCheck(this, MathUtils);

      return _possibleConstructorReturn(this, _BaseMathUtils.apply(this, arguments));
    }

    MathUtils.splitSpline = function splitSpline(spline, N) {
      var o = { len: 0, ls: [0] },
          dl = 1 / N;
      for (var i = 0; i <= N; ++i) {
        var p = spline.getPoint(i * dl);
        if (i) {
          var d = MathUtils.v1.distanceTo(p);
          o.len += d;
          o.ls.push(d);
        }
        MathUtils.v1.copy(p);
      }
      return o;
    };

    MathUtils.getLinearIndeces = function getLinearIndeces(spline, n) {
      var del = 5000,
          dDel = 1 / del;
      var ls = [0];
      var l = 0;
      for (var i = 0; i <= del; ++i) {
        var p = spline.getPoint(i * dDel);
        if (i) {
          var d = MathUtils.v1.distanceTo(p);
          l += d;
          ls.push(d);
        }
        MathUtils.v1.copy(p);
      }
      ls.push(1e7);

      var res = [],
          dl = l / (n - 1);
      for (var _i = 0, L = 0, _d = ls[0]; _i < ls.length - 1; ++_i, _d += ls[_i]) {
        if (Math.abs(L - _d) < Math.abs(L - _d - ls[_i + 1])) {
          res.push(_i * dDel);
          L += dl;
        }
      }

      return res;
    };

    MathUtils.refinePoly = function refinePoly(poly, maxDl) {
      var res = [];
      for (var i = 0; i < poly.length; ++i) {
        var p0 = poly[i],
            p1 = poly[(i + 1) % poly.length],
            l = _BaseMathUtils3.default.v2dist(p0, p1),
            n = Math.ceil(l / maxDl),
            dl = l / n;
        res.push(p0);
        for (var j = 1; j < n; ++j) {
          res.push(new _libs.THREE.Vector2(p0.x + j * dl * (p1.x - p0.x) / l, p0.y + j * dl * (p1.y - p0.y) / l));
        }
      }
      return res;
    };

    return MathUtils;
  }(_BaseMathUtils3.default);

  MathUtils.v1 = new _libs.THREE.Vector3();
  exports.default = MathUtils;

  /***/
},
/* 4 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Utils = function () {
    function Utils() {
      _classCallCheck(this, Utils);
    }

    Utils.normalizeUrl = function normalizeUrl(url) {
      function split(s) {
        return s.replace(/\\/g, '/').split('/');
      }
      var base = split(window.location.href);
      url = split(url);
      if (base[2] === url[2]) {
        url[0] = base[0];
      }
      return url.join('/');
    };

    Utils.extends = function _extends(der, base) {
      for (var name in base) {
        if (!der.hasOwnProperty(name)) {
          der[name] = base[name];
        }
      }
    };

    Utils.defaultCmp = function defaultCmp(a, b) {
      return a - b;
    };

    Utils.lowerBound = function lowerBound(a, x, cmp) {
      cmp = cmp || Utils.defaultCmp;
      var l = 0,
          h = a.length - 1;
      while (h - l > 1) {
        var mid = Math.floor((l + h) / 2);
        if (cmp(x, a[mid]) < 0) {
          h = mid;
        } else {
          l = mid;
        }
      }
      return cmp(x, a[h]) >= 0 ? h : l;
    };

    return Utils;
  }();

  exports.default = Utils;

  /***/
},
/* 5 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _GraphUtils = __webpack_require__(7);

  var _GraphUtils2 = _interopRequireDefault(_GraphUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var ImageBase = function () {
    function ImageBase(context, width, height, color) {
      _classCallCheck(this, ImageBase);

      this.context = context;
      this.wnd = context.wnd;
      this.doc = context.doc;
      this.element = context.element || context.doc.body;
      this.c = context.renderCanvas || ImageBase.renderCanvas;
      this.ctx = context.renderCanvasCtx || ImageBase.renderCanvasCtx;
      this.resW = this.width = width;
      this.resH = this.height = height;
      this.color = color;
    }

    ImageBase.prototype.setResolution = function setResolution(res) {
      this.resW = res.width;
      this.resH = res.height;
    };

    ImageBase.prototype.dispose = function dispose() {};

    ImageBase.prototype.renderBlankPage = function renderBlankPage() {
      this.ctx.beginPath();
      this.ctx.fillStyle = _GraphUtils2.default.color2Rgba(this.color, 1);
      this.ctx.rect(0, 0, this.c.width, this.c.height);
      this.ctx.fill();
    };

    ImageBase.prototype.renderImage = function renderImage(image) {
      this.pushCtx();
      this.ctx.drawImage(image, 0, 0);
      this.popCtx();
    };

    ImageBase.prototype.normToConv = function normToConv(p) {
      return {
        x: p.x * this.c.width,
        y: (1 - p.y) * this.c.height
      };
    };

    ImageBase.prototype.renderHit = function renderHit(poly) {
      var ctx = this.ctx;
      ctx.fillStyle = 'rgba(255,255,0,0.4)';
      ctx.beginPath();
      var p = this.normToConv(poly[0]);
      ctx.moveTo(p.x, p.y);
      for (var i = 1; i < poly.length; ++i) {
        p = this.normToConv(poly[i]);
        ctx.lineTo(p.x, p.y);
      }
      ctx.closePath();
      ctx.fill();
    };

    ImageBase.prototype.pushCtx = function pushCtx() {
      if (this.resW != this.c.width) {
        this.c.width = this.resW;
      }
      if (this.resH != this.c.height) {
        this.c.height = this.resH;
      }
      this.ctx.save();
      this.ctx.scale(this.c.width / this.width, this.c.height / this.height);
      return this.ctx;
    };

    ImageBase.prototype.popCtx = function popCtx() {
      this.ctx.restore();
    };

    ImageBase.prototype.renderNotFoundPage = function renderNotFoundPage() {
      this.renderBlankPage();
    };

    ImageBase.prototype.finishRender = function finishRender() {
      if (this.onChange) {
        this.onChange(this.c);
      }
    };

    ImageBase.prototype.finishLoad = function finishLoad() {
      if (this.onLoad) {
        this.onLoad();
      } else {
        this.startRender();
      }
    };

    ImageBase.prototype.getSimulatedDoc = function getSimulatedDoc() {
      return undefined;
    };

    return ImageBase;
  }();

  ImageBase.renderCanvas = (0, _libs.$)('<canvas>')[0];
  ImageBase.renderCanvasCtx = ImageBase.renderCanvas.getContext('2d');
  exports.default = ImageBase;

  /***/
},
/* 6 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var EventConverter = function () {

    // virtuals
    // getObject(e, data);
    // getCallback(object);
    // test(object1, object1);

    function EventConverter(wnd, doc) {
      _classCallCheck(this, EventConverter);

      this.wnd = wnd;
      this.doc = doc;
      this.enabled = true;
    }

    EventConverter.prototype.setEnable = function setEnable(vl) {
      if (!vl) {
        if (this.mCapObject) {
          this.notify(this.mCapObject, _libs.$.Event('mouseup'), 'mouseup');
          this.mCapObject = undefined;
        }
        if (this.mHovObject) {
          this.notify(this.mHovObject, _libs.$.Event('mouseout'), 'mouseout');
          this.mHovObject = undefined;
        }
      }
      this.enabled = vl;
    };

    EventConverter.prototype.getCallback = function getCallback(object) {
      return undefined;
    };

    EventConverter.prototype.notify = function notify(object, e, type) {
      var callback = this.getCallback(object);
      if (callback) {
        var props = _extends({}, e, {
          type: type,
          view: this.wnd
        });
        var jE = _libs.$.Event(type, props);
        callback(jE, object);
      }
    };

    EventConverter.prototype.convert = function convert(e, data) {
      if (!this.enabled) return;

      if (this.filter) {
        e = this.filter(this.element, e);
      }

      var object = this.getObject(e, data),
          notify = ~e.type.indexOf('touch') ? this.convertTouch(e, data, object) : this.convertMouse(e, data, object);
      if (notify && object) {
        this.notify(object, e, e.type);
      }
    };

    EventConverter.prototype.convertTouch = function convertTouch(e, data, object) {
      var notify = true;
      switch (e.type) {
        case 'touchstart':
          {
            if (this.tCapObject) {
              this.notify(this.tCapObject, e, 'touchend');
            }
            this.tCapObject = object;
            break;
          }
        case 'touchend':
          {
            if (this.tCapObject && !this.test(this.tCapObject, object)) {
              this.notify(this.tCapObject, e, 'touchend');
              notify = false;
            } else if (object && this.test(this.tCapObject, object)) {
              this.notify(object, e, 'touchtap');
            }
            this.tCapObject = undefined;
            break;
          }
        case 'touchtap':
          {
            notify = false;
            break;
          }
      }
      return notify;
    };

    EventConverter.prototype.convertMouse = function convertMouse(e, data, object) {
      var notify = true;
      switch (e.type) {
        case 'mousedown':
          {
            if (this.mCapObject) {
              this.notify(this.mCapObject, e, 'mouseup');
            }
            this.mCapObject = object;
            break;
          }
        case 'mouseup':
          {
            if (this.mCapObject && !this.test(this.mCapObject, object)) {
              this.notify(this.mCapObject, e, 'mouseup');
              notify = false;
            }
            break;
          }
        case 'click':
          {
            notify = this.test(this.mCapObject, object);
            this.mCapObject = undefined;
            break;
          }
        case 'mouseenter':
        case 'mouseover':
        case 'mousemove':
          {
            if (!this.test(this.mHovObject, object) && this.mHovObject) {
              this.notify(this.mHovObject, e, 'mouseout');
              this.mHovObject = undefined;
            }
            if (!this.mHovObject && object) {
              this.notify(object, e, 'mouseover');
              this.mHovObject = object;
            }
            notify = e.type === 'mousemove';
            break;
          }
        case 'mouseleave':
        case 'mouseout':
          {
            if (this.mHovObject) {
              this.notify(this.mHovObject, e, 'mouseout');
              this.mHovObject = undefined;
            }
            notify = false;
            break;
          }
      }
      return notify;
    };

    return EventConverter;
  }();

  exports.default = EventConverter;

  /***/
},
/* 7 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var GraphUtils = function () {
    function GraphUtils() {
      _classCallCheck(this, GraphUtils);
    }

    GraphUtils.extrapolateLinear = function extrapolateLinear(x, y, xi) {
      return y[0] + (y[1] - y[0]) / (x[1] - x[0]) * (xi - x[0]);
    };

    GraphUtils.interpolate01 = function interpolate01(y1, y2, t) {
      return GraphUtils.extrapolateLinear([0, 1], [y1, y2], t);
    };

    GraphUtils.getColorBytes = function getColorBytes(color) {
      return [color >> 16 & 0xFF, color >> 8 & 0xFF, color & 0xFF];
    };

    GraphUtils.inverseColor = function inverseColor(color) {
      var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;

      var bs = GraphUtils.getColorBytes(color),
          ibs = [0xFF - bs[0], 0xFF - bs[1], 0xFF - bs[2]],
          nbs = [Math.round(GraphUtils.interpolate01(bs[0], ibs[0], t)), Math.round(GraphUtils.interpolate01(bs[1], ibs[1], t)), Math.round(GraphUtils.interpolate01(bs[2], ibs[2], t))];
      return GraphUtils.bytes2Color(nbs);
    };

    GraphUtils.color2Rgba = function color2Rgba(color, a) {
      return GraphUtils.bytes2Rgba(GraphUtils.getColorBytes(color), a);
    };

    GraphUtils.bytes2Rgba = function bytes2Rgba(bs, a) {
      return 'rgba(' + bs.join(',') + ',' + a + ')';
    };

    GraphUtils.bytes2Color = function bytes2Color(bs) {
      return bs[2] | bs[1] << 8 | bs[0] << 16;
    };

    return GraphUtils;
  }();

  exports.default = GraphUtils;

  /***/
},
/* 8 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _Cache = __webpack_require__(14);

  var _Cache2 = _interopRequireDefault(_Cache);

  var _BlankImage = __webpack_require__(43);

  var _BlankImage2 = _interopRequireDefault(_BlankImage);

  var _StaticImage = __webpack_require__(59);

  var _StaticImage2 = _interopRequireDefault(_StaticImage);

  var _PdfImage = __webpack_require__(57);

  var _PdfImage2 = _interopRequireDefault(_PdfImage);

  var _InteractiveImage = __webpack_require__(51);

  var _InteractiveImage2 = _interopRequireDefault(_InteractiveImage);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var ImageFactory = function () {
    function ImageFactory(context, cache) {
      _classCallCheck(this, ImageFactory);

      this.context = context;
      this.cache = cache || new _Cache2.default();
    }

    ImageFactory.prototype.build = function build(info) {
      var n = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
      var widthTexels = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 210;
      var heightTexels = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 297;
      var color = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 0xFFFFFF;
      var injector = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : undefined;

      var image = void 0;
      switch (info.type) {
        case 'html':
          {
            image = new _InteractiveImage2.default(this.context, widthTexels, heightTexels, color, info.src, this.cache, injector);
            break;
          }
        case 'image':
          {
            image = new _StaticImage2.default(this.context, widthTexels, heightTexels, color, info.src);
            break;
          }
        case 'pdf':
          {
            image = new _PdfImage2.default(this.context, widthTexels, heightTexels, color, info.src, n);
            break;
          }
        case 'blank':
        default:
          {
            image = new _BlankImage2.default(this.context, widthTexels, heightTexels, color);
            break;
          }
      }
      return image;
    };

    return ImageFactory;
  }();

  exports.default = ImageFactory;

  /***/
},
/* 9 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _book = __webpack_require__(11);

  var _BaseMathUtils = __webpack_require__(2);

  var _BaseMathUtils2 = _interopRequireDefault(_BaseMathUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var BookPropsBuilder = function () {
    function BookPropsBuilder(onReady) {
      _classCallCheck(this, BookPropsBuilder);

      this.onReady = onReady;
      this.defaults = (0, _book.props)();
    }

    BookPropsBuilder.prototype.dispose = function dispose() {};

    BookPropsBuilder.prototype.calcSize = function calcSize(width, height) {
      var scale = _BaseMathUtils2.default.calcScale(width, height, this.defaults.width, this.defaults.height);
      return {
        width: scale * width,
        height: scale * height
      };
    };

    BookPropsBuilder.prototype.calcTexels = function calcTexels(width, height) {
      var sheet = this.defaults.sheet,
          scale = _BaseMathUtils2.default.calcScale(width, height, sheet.widthTexels, sheet.heightTexels);
      return {
        widthTexels: scale * width,
        heightTexels: scale * height
      };
    };

    BookPropsBuilder.prototype.calcProps = function calcProps(width, height) {
      this.props = _extends({}, this.defaults, this.calcSize(width, height), {
        sheet: _extends({}, this.defaults.sheet, this.calcTexels(width, height)),
        cover: _extends({}, this.defaults.cover),
        page: _extends({}, this.defaults.page)
      });
    };

    BookPropsBuilder.prototype.calcSheets = function calcSheets(pages) {
      return this.sheets = Math.ceil(Math.max(0, pages - 4) / 2);
    };

    BookPropsBuilder.prototype.getSheets = function getSheets() {
      return this.sheets;
    };

    BookPropsBuilder.prototype.getProps = function getProps() {
      return this.props;
    };

    BookPropsBuilder.prototype.getPageCallback = function getPageCallback() {
      return this.binds.pageCallback;
    };

    BookPropsBuilder.prototype.ready = function ready() {
      if (this.onReady) {
        this.onReady(this.getProps(), this.getSheets(), this.getPageCallback());
      }
    };

    return BookPropsBuilder;
  }();

  exports.default = BookPropsBuilder;

  /***/
},
/* 10 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
    return typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
  };

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(1);

  var _sheetBlock = __webpack_require__(41);

  var _sheetBlock2 = _interopRequireDefault(_sheetBlock);

  var _MathUtils = __webpack_require__(3);

  var _MathUtils2 = _interopRequireDefault(_MathUtils);

  var _ThreeUtils = __webpack_require__(20);

  var _ThreeUtils2 = _interopRequireDefault(_ThreeUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  // import ThreeMarkup from './ThreeMarkup';

  var SheetBlock = function () {
    function SheetBlock(visual, p, first, last) {
      var angle = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 0;

      var _this = this;

      var state = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : 'closed';
      var height = arguments.length > 6 && arguments[6] !== undefined ? arguments[6] : 0;

      _classCallCheck(this, SheetBlock);

      this.visual = visual;
      this.p = _extends({}, p, {
        first: first,
        last: last
      });
      var props = this.getProps();

      var loadedPoints = this.loadPoints();
      Object.keys(loadedPoints).map(function (k) {
        _this[k] = loadedPoints[k][props.shape] || loadedPoints[k][0];
      });

      this.pSpline = new _libs.THREE.Spline([]);
      for (var i = 0; i < this.interpolationPoints.x[0].length; ++i) {
        this.pSpline.points.push(new _libs.THREE.Vector3());
      }

      this.iSpline = new _libs.THREE.Spline([]);
      for (var _i = 0; _i < _sheetBlock2.default.resX; ++_i) {
        this.iSpline.points.push(new _libs.THREE.Vector3());
      }

      this.aSplines = [];

      //this.three = new THREE.Object3D();

      this.geometry = _sheetBlock2.default.geometry.clone();

      this.p.sideFaces = [{
        first: 0,
        last: _sheetBlock2.default.faces[0]
      }, {
        first: _sheetBlock2.default.faces[0],
        last: _sheetBlock2.default.faces[1]
      }];

      this.sideTexture = new _libs.THREE.Texture();
      this.sideTexture.wrapT = _libs.THREE.RepeatWrapping;
      this.sideTexture.repeat.set(0, last - first);
      this.sideTexture.image = props.sideTexture;
      this.sideTexture.needsUpdate = true;

      this.materials = [new _libs.THREE.MeshPhongMaterial(), new _libs.THREE.MeshPhongMaterial(), new _libs.THREE.MeshPhongMaterial({ map: this.sideTexture }), new _libs.THREE.MeshPhongMaterial({ map: this.sideTexture }), new _libs.THREE.MeshPhongMaterial({ map: this.sideTexture }), new _libs.THREE.MeshPhongMaterial({ map: this.sideTexture })];

      this.p.setTexture(this.materials[0], 2 * first);
      this.p.setTexture(this.materials[1], 2 * last - 1);

      this.mesh = new _libs.THREE.Mesh(this.geometry, new _libs.THREE.MeshFaceMaterial(this.materials));
      this.mesh.castShadow = false;
      this.mesh.receiveShadow = false;
      // this.mesh.frustumCulled = true;

      //this.three.add(this.mesh);
      this.three = this.mesh;
      this.three.userData.self = this;

      this.markers = [];
      if (this.p.marker.use) {
        var l = this.geometry.vertices.length;
        var is = void 0;
        // is = [0, sheetBlock.resX-1, (sheetBlock.resZ-1)*sheetBlock.resX, sheetBlock.resZ*sheetBlock.resX-1];
        is = Array.apply(0, Array(l)).map(function (_, i) {
          return i;
        });

        for (var _iterator = is, _isArray = Array.isArray(_iterator), _i2 = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
          var _ref;

          if (_isArray) {
            if (_i2 >= _iterator.length) break;
            _ref = _iterator[_i2++];
          } else {
            _i2 = _iterator.next();
            if (_i2.done) break;
            _ref = _i2.value;
          }

          var _i3 = _ref;

          var marker = _ThreeUtils2.default.createMarker(this.geometry.vertices[_i3], _i3 < l / 2 ? 0xFF0000 : 0x00FF00, this.p.marker.size);
          this.markers.push({
            marker: marker,
            vertex: _i3
          });
          this.three.add(marker);
        }
      }

      this.corner = {
        use: true,
        height: 0,
        maxDistance: 0,
        points: [],
        OZ: new _libs.THREE.Vector3(0, 0, 1),
        axis: new _libs.THREE.Vector3()
      };
      this.set(0, 'closed', height, first, last); // calculate corner points

      this.set(angle, state, height, first, last); // init position

      // if(!SheetBlock.markup) {
      //   SheetBlock.markup=true;
      //   this.markup = new ThreeMarkup(this, 0, [{
      //     x: 0,
      //     y: 0,
      //   }, {
      //     x: 0.5,
      //     y: 1
      //   }, {
      //     x: 1,
      //     y: 0
      //   }].map((p)=>new THREE.Vector2(p.x, p.y)), {});
      // }
    }

    SheetBlock.prototype.dispose = function dispose() {
      for (var _iterator2 = this.materials, _isArray2 = Array.isArray(_iterator2), _i4 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
        var _ref2;

        if (_isArray2) {
          if (_i4 >= _iterator2.length) break;
          _ref2 = _iterator2[_i4++];
        } else {
          _i4 = _iterator2.next();
          if (_i4.done) break;
          _ref2 = _i4.value;
        }

        var m = _ref2;

        if (m.map) {
          m.map = null;
          m.needsUpdate = true;
        }
        m.dispose();
      }
      delete this.materials;
      this.geometry.dispose();
    };

    SheetBlock.prototype.getSize = function getSize() {
      return this.p.last - this.p.first;
    };

    SheetBlock.prototype.getProps = function getProps() {
      return _extends({}, this.p.page, {
        sheets: this.p.sheets
      });
    };

    SheetBlock.prototype.getTopCerners = function getTopCerners() {
      var off = this.angle > Math.PI / 2 ? this.geometry.vertices.length / 2 : 0;
      return [this.geometry.vertices[off], this.geometry.vertices[_sheetBlock2.default.resX - 1 + off], this.geometry.vertices[(_sheetBlock2.default.resZ - 1) * _sheetBlock2.default.resX + off], this.geometry.vertices[_sheetBlock2.default.resZ * _sheetBlock2.default.resX - 1 + off]];
    };

    SheetBlock.prototype.getTopSize = function getTopSize() {
      // const l=this.geometry.vertices.length, off = this.angle>Math.PI/2? l/2: 0,
      //   v0 = this.geometry.vertices[off], v1 = this.geometry.vertices[sheetBlock.resZ*sheetBlock.resX-1+off];
      // // is = [0, sheetBlock.resX-1, (sheetBlock.resZ-1)*sheetBlock.resX, sheetBlock.resZ*sheetBlock.resX-1];
      // return {
      //   width: Math.abs(v1.x-v0.x),
      //   height: Math.abs(v1.z-v0.z)
      // };
      var vs = this.getTopCerners();
      return {
        width: vs[0].distanceTo(vs[1]),
        height: vs[0].distanceTo(vs[2])
      };
    };

    SheetBlock.prototype.getTopWorldRotation = function getTopWorldRotation(q) {
      q.x = -Math.PI / 2;
      return q;
    };

    SheetBlock.prototype.getTopWorldPosition = function getTopWorldPosition(v) {
      var l = this.geometry.vertices.length,
          off = this.angle > Math.PI / 2 ? l / 2 : 0,
          vs = [this.geometry.vertices[off], this.geometry.vertices[_sheetBlock2.default.resX - 1 + off], this.geometry.vertices[(_sheetBlock2.default.resZ - 1) * _sheetBlock2.default.resX + off], this.geometry.vertices[_sheetBlock2.default.resZ * _sheetBlock2.default.resX - 1 + off]];
      v.set(0, 0, 0);
      for (var _iterator3 = vs, _isArray3 = Array.isArray(_iterator3), _i5 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
        var _ref3;

        if (_isArray3) {
          if (_i5 >= _iterator3.length) break;
          _ref3 = _iterator3[_i5++];
        } else {
          _i5 = _iterator3.next();
          if (_i5.done) break;
          _ref3 = _i5.value;
        }

        var vi = _ref3;

        v.x += 0.25 * vi.x;
        v.y += 0.25 * vi.y;
        v.z += 0.25 * vi.z;
      }
      this.three.localToWorld(v);
      return v;
    };

    SheetBlock.prototype.getInterpolationPoints = function getInterpolationPoints(inds, mod) {
      var ps = { x: [], y: [] },
          K = this.getProps().wave;
      for (var _iterator4 = inds, _isArray4 = Array.isArray(_iterator4), _i6 = 0, _iterator4 = _isArray4 ? _iterator4 : _iterator4[Symbol.iterator]();;) {
        var _ref4;

        if (_isArray4) {
          if (_i6 >= _iterator4.length) break;
          _ref4 = _iterator4[_i6++];
        } else {
          _i6 = _iterator4.next();
          if (_i6.done) break;
          _ref4 = _i6.value;
        }

        var i = _ref4;

        ps.x.push([].concat(this.interpolationPoints.x[i]));
        ps.y.push(~mod.indexOf(i) ? this.interpolationPoints.y[i].map(function (n) {
          return K * n;
        }) : [].concat(this.interpolationPoints.y[i]));
      }
      return ps;
    };

    SheetBlock.prototype.set = function set(angle) {
      var state = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.state;
      var height = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : this.corner.height;
      var first = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : this.p.first;
      var last = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : this.p.last;

      var PI = Math.PI;
      this.state = state;
      var closedAngle = void 0,
          binderTurn = void 0;
      if ((typeof angle === 'undefined' ? 'undefined' : _typeof(angle)) === 'object') {
        this.angle = angle.openedAngle;
        closedAngle = angle.closedAngle;
        binderTurn = angle.binderTurn > PI / 2 ? PI - angle.binderTurn : angle.binderTurn;
      } else {
        this.angle = angle;
      }
      this.corner.height = height;
      if (this.p.first !== first || this.p.last !== last) {
        this.sideTexture.repeat.set(0, last - first);
        this.sideTexture.needsUpdate = true;
        if (this.p.first !== first) {
          this.p.setTexture(this.materials[0], 2 * first);
        }
        if (this.p.last !== last) {
          this.p.setTexture(this.materials[1], 2 * last - 1);
        }
      }
      this.p.first = first;
      this.p.last = last;
      var points = void 0;
      var props = this.getProps();
      if (this.state === 'closed') {
        points = this.getInterpolationPoints(this.closedInterpolationIndeces, this.closedInterpolationIndeces);
      } else if (this.state === 'opened') {
        if (closedAngle !== undefined && Math.abs(closedAngle - PI / 2) > 1e-2) {
          points = this.getInterpolationPoints(this.flatInterpolationIndeces, []);
          var ps = this.getPointsAtAngle(this.getInterpolationPoints(this.closedInterpolationIndeces, this.closedInterpolationIndeces), closedAngle > PI / 2 ? PI - closedAngle : closedAngle);
          points.x = [ps.x].concat(points.x);
          points.y = [ps.y].concat(points.y);
          // console.log(ps);
        } else {
          points = this.getInterpolationPoints(this.openedInterpolationIndeces, this.closedInterpolationIndeces);
        }
      }
      var hl = void 0,
          hr = void 0,
          offset = 0.5 * props.sheets * props.depth;
      if (this.state === 'closed') {
        offset -= 7e-6 * this.p.scale;
      }
      if (this.angle <= PI / 2) {
        hl = (props.sheets - first) * props.depth;
        hr = (props.sheets - last) * props.depth;
      } else {
        hl = first * props.depth;
        hr = last * props.depth;
      }

      var inAngle = this.angle > PI / 2 ? PI - this.angle : this.angle,
          hAngle = this.state === 'closed' ? inAngle : binderTurn === undefined ? PI / 2 : binderTurn;

      var _getPointsAtAngleAndH = this.getPointsAtAngleAndHs(points, inAngle, hAngle, [hl / props.width, hr / props.width]),
          left = _getPointsAtAngleAndH[0],
          right = _getPointsAtAngleAndH[1];

      if (this.angle > PI / 2) {
        this.inverse(left);
        this.inverse(right);
        offset = -offset;
      }
      this.setPoints(left, right, offset);
    };

    SheetBlock.prototype.setPoints = function setPoints(left, right, offset) {
      var _this2 = this;

      var p = this.getProps();
      var i = 0;

      var ys = [right, left];
      for (var y = 0; y < _sheetBlock2.default.resY; ++y) {
        for (var z = 0; z < _sheetBlock2.default.resZ; ++z) {
          for (var x = 0; x < _sheetBlock2.default.resX; ++x) {
            this.geometry.vertices[i++].set(ys[y].x[x] * p.width + offset, ys[y].y[x] * p.width, z * p.height / (_sheetBlock2.default.resZ - 1) - 0.5 * p.height);
          }
        }
      }
      if (i !== this.geometry.vertices.length) {
        console.warn('setPoints: bad mapping!');
      }

      if (this.corner.use && !this.corner.points.length) {
        var plane = new _libs.THREE.Plane(),
            normal = plane.normal,
            planeOffset = (1 - this.getProps().flexibleCorner) * Math.min(p.width, p.height),
            proj = new _libs.THREE.Vector3();
        plane.setFromNormalAndCoplanarPoint(new _libs.THREE.Vector3(-1, 0, -1).normalize(), new _libs.THREE.Vector3(planeOffset + offset, 0, 0.5 * p.height));
        for (var _i7 = 0, l = this.geometry.vertices.length; _i7 < l; ++_i7) {
          plane.projectPoint(this.geometry.vertices[_i7], proj);
          proj.sub(this.geometry.vertices[_i7]);
          if (proj.x * normal.x + proj.y * normal.y + proj.z * normal.z > 0) {
            var d = proj.length() / planeOffset;
            this.corner.maxDistance = Math.max(this.corner.maxDistance, d);
            this.corner.points.push({ vertex: _i7, distance: d });
          }
        }
      }

      if (this.corner.use && Math.abs(this.corner.height) > 1e-3) {
        var d2Angle = function d2Angle(d) {
          return p.cornerDeviation * _this2.corner.height / (1 + Math.exp(-p.bending * (d - 0.5 * _this2.corner.maxDistance)));
        };
        this.corner.axis.set(-1, 0, 1).normalize();
        this.corner.axis.applyAxisAngle(this.corner.OZ, this.angle);
        for (var _iterator5 = this.corner.points, _isArray5 = Array.isArray(_iterator5), _i8 = 0, _iterator5 = _isArray5 ? _iterator5 : _iterator5[Symbol.iterator]();;) {
          var _ref5;

          if (_isArray5) {
            if (_i8 >= _iterator5.length) break;
            _ref5 = _iterator5[_i8++];
          } else {
            _i8 = _iterator5.next();
            if (_i8.done) break;
            _ref5 = _i8.value;
          }

          var point = _ref5;

          this.geometry.vertices[point.vertex].applyAxisAngle(this.corner.axis, d2Angle(point.distance));
        }
      }

      for (var _iterator6 = this.markers, _isArray6 = Array.isArray(_iterator6), _i9 = 0, _iterator6 = _isArray6 ? _iterator6 : _iterator6[Symbol.iterator]();;) {
        var _ref6;

        if (_isArray6) {
          if (_i9 >= _iterator6.length) break;
          _ref6 = _iterator6[_i9++];
        } else {
          _i9 = _iterator6.next();
          if (_i9.done) break;
          _ref6 = _i9.value;
        }

        var m = _ref6;

        m.marker.position.copy(this.geometry.vertices[m.vertex]);
      }

      this.geometry.computeVertexNormals();
      //this.geometry.computeFaceNormals();
      this.geometry.computeBoundingSphere();
      //this.geometry.computeBoundingBox();
      this.geometry.verticesNeedUpdate = true;

      if (this.markup) {
        this.markup.computeVertices();
      }
    };

    SheetBlock.prototype.inverse = function inverse(ps) {
      for (var i = 0; i < ps.x.length; ++i) {
        ps.x[i] = -ps.x[i];
      }
      return ps;
    };

    SheetBlock.prototype.getPointsAtHs = function getPointsAtHs(ps, angle, hs) {
      var _this3 = this;

      var N = 1000;
      _MathUtils2.default.setSplinePoints(this.pSpline, ps);
      var bl = _MathUtils2.default.splitSpline(this.pSpline, N),
          r = [];
      {
        var p1 = _extends({}, this.pSpline.getPoint((N - 1) / N)),
            p2 = _extends({}, this.pSpline.getPoint(1)),
            dp = { x: p2.x - p1.x, y: p2.y - p1.y },
            ln = Math.sqrt(dp.x * dp.x + dp.y * dp.y),
            sp = this.pSpline.points[this.pSpline.points.length - 1];
        sp.set(sp.x + 0.1 * dp.x / ln, sp.y + 0.1 * dp.y / ln, 0);
        bl = _MathUtils2.default.splitSpline(this.pSpline, N);
      }
      bl.ls.push(1e7);
      _MathUtils2.default.mapl2L(bl.ls, bl.len, _sheetBlock2.default.resX, function (i) {
        for (var j = 0; j < hs.length; ++j) {
          if (!i) {
            r[j] = { x: [-hs[j] * Math.sin(angle)], y: [hs[j] * Math.cos(angle)] };
          } else {
            var p0 = _extends({}, _this3.pSpline.getPoint((i - 1) / N)),
                _p = _this3.pSpline.getPoint(i / N),
                x = -(_p.y - p0.y),
                y = _p.x - p0.x,
                l = Math.sqrt(x * x + y * y);
            r[j].x.push(_p.x + x / l * hs[j]);
            r[j].y.push(_p.y + y / l * hs[j]);
          }
        }
      });

      var nps = [];

      var _loop = function _loop(j) {
        nps[j] = { x: [], y: [] };
        _MathUtils2.default.setSplinePoints(_this3.iSpline, r[j]);
        var l = _MathUtils2.default.splitSpline(_this3.iSpline, N);
        l.ls.push(1e7);
        _MathUtils2.default.mapl2L(l.ls, 1, _sheetBlock2.default.resX, function (i) {
          var p = _this3.iSpline.getPoint(i / N);
          nps[j].x.push(p.x);
          nps[j].y.push(p.y);
        });
      };

      for (var j = 0; j < hs.length; ++j) {
        _loop(j);
      }
      return nps;
    };

    SheetBlock.prototype.getPointsAtAngleAndHs = function getPointsAtAngleAndHs(points, angle, hAngle, hs) {
      var ps = this.getPointsAtAngle(points, angle);
      return this.getPointsAtHs(ps, hAngle, hs);
    };

    SheetBlock.prototype.getPointsAtAngle = function getPointsAtAngle(points, angle) {
      var ps = { x: [], y: [] },
          angles = [];
      angle /= Math.PI / 2;
      for (var j = 0; j < points.x.length; ++j) {
        angles.push(j / (points.x.length - 1));
      }
      for (var i = 0; i < points.x[0].length; ++i) {
        var xps = [],
            yps = [];
        for (var _j = 0; _j < points.x.length; ++_j) {
          xps.push(points.x[_j][i]);
          yps.push(points.y[_j][i]);
        }
        ps.x.push(this.interpolate(angles, xps, angle));
        ps.y.push(this.interpolate(angles, yps, angle));
      }
      return ps;
    };

    SheetBlock.prototype.interpolate = function interpolate(x, y, xi) {
      if (!this.aSplines[x.length]) {
        this.aSplines[x.length] = new _libs.THREE.Spline([]);
        var ps = this.aSplines[x.length].points;
        for (var i = 0; i < x.length; ++i) {
          ps.push(new _libs.THREE.Vector3());
        }
      }
      var spline = this.aSplines[x.length];
      for (var _i10 = 0; _i10 < x.length; ++_i10) {
        spline.points[_i10].set(x[_i10], y[_i10], 0);
      }
      return spline.getPoint(Math.min(1, Math.max(xi, 0))).y;
    };

    SheetBlock.prototype.loadPoints = function loadPoints() {
      var x = [],
          y = [];
      var _arr = [0, 0.2877, 0.6347, 0.8174, 1.0000];
      for (var _i11 = 0; _i11 < _arr.length; _i11++) {
        var r = _arr[_i11];
        x.push(r * Math.cos(0.9 * Math.PI / 4));
        y.push(r * Math.sin(0.9 * Math.PI / 4));
      }

      var openedInterpolationIndeces = [[2, 3, 4], [2, 3, 4, 5, 6]],
          closedInterpolationIndeces = [[0, 1, 2], [0, 1, 2]],
          flatInterpolationIndeces = [[5, 4], [7, 6]],
          interpolationPoints = [{
        x: [[0, 0.2877, 0.6347, 0.8174, 1.0000], [0.000, 0.286, 0.632, 0.815, 0.997], [0.000, 0.279, 0.623, 0.806, 0.988], [0.000, 0.126, 0.411, 0.593, 0.774], [0, 0, 0, 0, 0], x],
        y: [[0, 0, 0, 0, 0], [0.000, 0.030, 0.010, 0.002, 0.000], [0.000, 0.060, 0.017, 0.004, 0.000], [0.000, 0.259, 0.440, 0.446, 0.429], [0, 0.2877, 0.6347, 0.8174, 1.0000], y]
      }, {
        x: [[0, 0.2877, 0.6347, 0.8174, 1.0000], [0.000, 0.286, 0.632, 0.815, 0.997], [0.000, 0.279, 0.623, 0.806, 0.988], [0.000, 0.233, 0.563, 0.746, 0.927], [0.000, 0.144, 0.433, 0.613, 0.796], [0.000, 0.070, 0.288, 0.455, 0.626], [0, 0, 0, 0, 0], x],
        y: [[0, 0, 0, 0, 0], [0.000, 0.030, 0.010, 0.002, 0.000], [0.000, 0.060, 0.017, 0.004, 0.000], [0.000, 0.168, 0.269, 0.270, 0.255], [0.000, 0.245, 0.435, 0.458, 0.460], [0.000, 0.278, 0.544, 0.614, 0.673], [0, 0.2877, 0.6347, 0.8174, 1.0000], y]
      }];

      return {
        interpolationPoints: interpolationPoints,
        openedInterpolationIndeces: openedInterpolationIndeces,
        closedInterpolationIndeces: closedInterpolationIndeces,
        flatInterpolationIndeces: flatInterpolationIndeces
      };
    };

    return SheetBlock;
  }();

  exports.default = SheetBlock;

  /***/
},
/* 11 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  exports.__esModule = true;
  exports.props = props;
  function props() {
    // const props = {
    //   height,
    //   width,
    //   gravity,
    //   injector,
    //   cachedPages,
    //   renderInactivePages,
    //   renderWhileFlipping,
    //   pagesForPredicting,
    //   preloadPages,
    //   sheet: {
    //     startVelocity,
    //     cornerDeviation,
    //     flexibility,
    //     flexibleCorner,
    //     bending,
    //     wave,
    //     shape,
    //     widthTexels,
    //     heightTexels,
    //     color,
    //     sideTexture
    //   },
    //   cover: {
    //     ...sheet,
    //     padding,
    //     binderTexture,
    //     depth,
    //     mass
    //   },
    //   page: {
    //     ...sheet,
    //     depth,
    //     mass
    //   }
    // };

    return {
      height: 0.297,
      width: 0.21,
      gravity: 1,
      cachedPages: 50,
      renderInactivePages: true,
      renderInactivePagesOnMobile: false,
      renderWhileFlipping: false,
      pagesForPredicting: 5,
      preloadPages: 5,
      rtl: false,
      sheet: {
        startVelocity: 0.9,
        cornerDeviation: 0.25,
        flexibility: 10,
        flexibleCorner: 0.5,
        bending: 11,
        wave: 0.5,
        shape: 0,
        widthTexels: 5 * 210,
        heightTexels: 5 * 297,
        color: 0xFFFFFF
      },
      cover: {
        binderTexture: '',
        depth: 0.0003,
        padding: 0,
        mass: 0.003
      },
      page: {
        depth: 0.0001,
        mass: 0.001
      },
      cssLayerProps: {
        width: 1024
      }
    };
  };

  /***/
},
/* 12 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;
  exports.CSS3DSprite = exports.CSS3DObject = undefined;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  _libs.THREE.CSS3DObject = function (_THREE$Object3D) {
    _inherits(CSS3DObject, _THREE$Object3D);

    function CSS3DObject() {
      var element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : undefined;

      _classCallCheck(this, CSS3DObject);

      var _this = _possibleConstructorReturn(this, _THREE$Object3D.call(this));

      if (element) {
        _this.set(element);
      }
      return _this;
    }

    CSS3DObject.prototype.set = function set(element) {
      this.element = element;
      this.element.style.position = 'absolute';

      this.addEventListener('removed', function () {
        if (this.element.parentNode !== null) {
          this.element.parentNode.removeChild(this.element);
        }
      });
    };

    return CSS3DObject;
  }(_libs.THREE.Object3D);

  _libs.THREE.CSS3DSprite = function (_THREE$CSS3DObject) {
    _inherits(CSS3DSprite, _THREE$CSS3DObject);

    function CSS3DSprite(element) {
      _classCallCheck(this, CSS3DSprite);

      return _possibleConstructorReturn(this, _THREE$CSS3DObject.call(this, element));
    }

    return CSS3DSprite;
  }(_libs.THREE.CSS3DObject);

  _libs.THREE.CSS3DRenderer = function CSS3DRenderer() {
    _classCallCheck(this, CSS3DRenderer);

    var _width, _height;
    var _widthHalf, _heightHalf;

    var matrix = new _libs.THREE.Matrix4();

    var cache = {
      camera: { fov: 0, style: '' },
      objects: {}
    };

    var domElement = document.createElement('div');
    domElement.style.overflow = 'hidden';

    this.domElement = domElement;

    var cameraElement = document.createElement('div');

    cameraElement.style.WebkitTransformStyle = 'preserve-3d';
    cameraElement.style.MozTransformStyle = 'preserve-3d';
    cameraElement.style.transformStyle = 'preserve-3d';

    domElement.appendChild(cameraElement);

    var isIE = /Trident/i.test(navigator.userAgent);

    this.setClearColor = function () {};

    this.getSize = function () {

      return {
        width: _width,
        height: _height
      };
    };

    this.setSize = function (width, height) {

      _width = width;
      _height = height;
      _widthHalf = _width / 2;
      _heightHalf = _height / 2;

      domElement.style.width = width + 'px';
      domElement.style.height = height + 'px';

      cameraElement.style.width = width + 'px';
      cameraElement.style.height = height + 'px';
    };

    function epsilon(value) {

      return Math.abs(value) < 1e-10 ? 0 : value;
    }

    function getCameraCSSMatrix(matrix) {

      var elements = matrix.elements;

      return 'matrix3d(' + epsilon(elements[0]) + ',' + epsilon(-elements[1]) + ',' + epsilon(elements[2]) + ',' + epsilon(elements[3]) + ',' + epsilon(elements[4]) + ',' + epsilon(-elements[5]) + ',' + epsilon(elements[6]) + ',' + epsilon(elements[7]) + ',' + epsilon(elements[8]) + ',' + epsilon(-elements[9]) + ',' + epsilon(elements[10]) + ',' + epsilon(elements[11]) + ',' + epsilon(elements[12]) + ',' + epsilon(-elements[13]) + ',' + epsilon(elements[14]) + ',' + epsilon(elements[15]) + ')';
    }

    function getObjectCSSMatrix(matrix, cameraCSSMatrix) {

      var elements = matrix.elements;
      var matrix3d = 'matrix3d(' + epsilon(elements[0]) + ',' + epsilon(elements[1]) + ',' + epsilon(elements[2]) + ',' + epsilon(elements[3]) + ',' + epsilon(-elements[4]) + ',' + epsilon(-elements[5]) + ',' + epsilon(-elements[6]) + ',' + epsilon(-elements[7]) + ',' + epsilon(elements[8]) + ',' + epsilon(elements[9]) + ',' + epsilon(elements[10]) + ',' + epsilon(elements[11]) + ',' + epsilon(elements[12]) + ',' + epsilon(elements[13]) + ',' + epsilon(elements[14]) + ',' + epsilon(elements[15]) + ')';

      if (isIE) {

        return 'translate(-50%,-50%)' + 'translate(' + _widthHalf + 'px,' + _heightHalf + 'px)' + cameraCSSMatrix + matrix3d;
      }

      return 'translate(-50%,-50%)' + matrix3d;
    }

    function renderObject(object, camera, cameraCSSMatrix) {

      if (object instanceof _libs.THREE.CSS3DObject) {

        var style;

        if (object instanceof _libs.THREE.CSS3DSprite) {
          matrix.copy(camera.matrixWorldInverse);
          matrix.transpose();
          matrix.copyPosition(object.matrixWorld);
          matrix.scale(object.scale);

          matrix.elements[3] = 0;
          matrix.elements[7] = 0;
          matrix.elements[11] = 0;
          matrix.elements[15] = 1;

          style = getObjectCSSMatrix(matrix, cameraCSSMatrix);
        } else {

          style = getObjectCSSMatrix(object.matrixWorld, cameraCSSMatrix);
        }

        var element = object.element;
        var cachedStyle = cache.objects[object.id] && cache.objects[object.id].style;

        if (cachedStyle === undefined || cachedStyle !== style) {
          element.style.WebkitTransform = style;
          element.style.MozTransform = style;
          element.style.transform = style;

          cache.objects[object.id] = { style: style };
          if (isIE) {
            cache.objects[object.id].distanceToCameraSquared = getDistanceToSquared(camera, object);
          }
        }

        if (element.parentNode !== cameraElement) {
          cameraElement.appendChild(element);
        }
      }

      for (var i = 0, l = object.children.length; i < l; i++) {

        renderObject(object.children[i], camera, cameraCSSMatrix);
      }
    }

    var getDistanceToSquared = function () {

      var a = new _libs.THREE.Vector3();
      var b = new _libs.THREE.Vector3();

      return function (object1, object2) {

        a.setFromMatrixPosition(object1.matrixWorld);
        b.setFromMatrixPosition(object2.matrixWorld);

        return a.distanceToSquared(b);
      };
    }();

    function zOrder(scene) {

      var order = Object.keys(cache.objects).sort(function (a, b) {

        return cache.objects[a].distanceToCameraSquared - cache.objects[b].distanceToCameraSquared;
      });
      var zMax = order.length;

      scene.traverse(function (object) {

        var index = order.indexOf(object.id + '');

        if (index !== -1) {

          object.element.style.zIndex = zMax - index;
        }
      });
    }

    this.render = function (scene, camera) {

      var fov = camera.projectionMatrix.elements[5] * _heightHalf;

      if (cache.camera.fov !== fov) {

        domElement.style.WebkitPerspective = fov + 'px';
        domElement.style.MozPerspective = fov + 'px';
        domElement.style.perspective = fov + 'px';

        cache.camera.fov = fov;
      }

      scene.updateMatrixWorld();

      if (camera.parent === null) camera.updateMatrixWorld();

      var cameraCSSMatrix = 'translateZ(' + fov + 'px)' + getCameraCSSMatrix(camera.matrixWorldInverse);

      var style = cameraCSSMatrix + 'translate(' + _widthHalf + 'px,' + _heightHalf + 'px)';

      if (cache.camera.style !== style && !isIE) {

        cameraElement.style.WebkitTransform = style;
        cameraElement.style.MozTransform = style;
        cameraElement.style.transform = style;

        cache.camera.style = style;
      }

      renderObject(scene, camera, cameraCSSMatrix);

      if (isIE) {

        // IE10 and 11 does not support 'preserve-3d'.
        // Thus, z-order in 3D will not work.
        // We have to calc z-order manually and set CSS z-index for IE.
        // FYI: z-index can't handle object intersection
        zOrder(scene);
      }
    };
  };

  exports.default = _libs.THREE.CSS3DRenderer;

  var _CSS3DObject = _libs.THREE.CSS3DObject,
      _CSS3DSprite = _libs.THREE.CSS3DSprite;
  exports.CSS3DObject = _CSS3DObject;
  exports.CSS3DSprite = _CSS3DSprite;

  /***/
},
/* 13 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _CSS3DRenderer = __webpack_require__(12);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var CSSLayer = function (_CSS3DObject) {
    _inherits(CSSLayer, _CSS3DObject);

    CSSLayer.init = function init(doc) {
      var delay = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 150;

      CSSLayer.delay = delay;
      CSSLayer.style = (0, _libs.$)('<style type=text/css>\n      .css-layer {\n    \t\topacity: 1;\n    \t\ttransition: opacity ' + delay + 'ms ease-out;\n        visibility: visible;\n        overflow: hidden;\n    \t}\n    \t.css-layer.hidden {\n    \t\ttransition: opacity ' + delay + 'ms ease-in, visibility ' + delay + 'ms step-end;\n    \t\topacity: 0;\n        visibility: hidden;\n      }\n    </style>').appendTo(doc.head);
    };

    CSSLayer.dispose = function dispose() {
      CSSLayer.style.remove();
    };

    function CSSLayer(width, height, props) {
      _classCallCheck(this, CSSLayer);

      var _this = _possibleConstructorReturn(this, _CSS3DObject.call(this));

      _this.props = props;
      _this.jContainer = (0, _libs.$)('<div class="hidden css-layer"></div>');
      var widthPxs = props.width,
          heightPxs = height / width * widthPxs;
      _this.jContainer.width(widthPxs).height(heightPxs);
      _this.scale.x /= widthPxs / width;
      _this.scale.y /= widthPxs / width;

      _this.setData();
      _this.set(_this.jContainer[0]);
      return _this;
    }

    CSSLayer.prototype.callInternal = function callInternal(name) {
      if (this.object && this.object[name]) {
        try {
          this.object[name]();
        } catch (e) {
          console.error(e);
        }
      }
    };

    CSSLayer.prototype.dispose = function dispose() {
      this.clearInternals();
    };

    CSSLayer.prototype.clearInternals = function clearInternals() {
      this.callInternal('dispose');
      !this.css || this.css.remove();
      !this.html || this.html.remove();
    };

    CSSLayer.prototype.setData = function setData() {
      var css = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
      var html = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      var js = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';

      this.clearInternals();

      this.css = (0, _libs.$)('<style type="text/css">' + css + '</style>').appendTo(this.jContainer);
      this.html = (0, _libs.$)(html).appendTo(this.jContainer);
      var init = eval(js);
      if (init) {
        this.object = init(this.jContainer, this.props) || {};
      }
    };

    CSSLayer.prototype.pendedCall = function pendedCall(clb) {
      var _this2 = this;

      var timestamp = this.timestamp = Date.now();
      setTimeout(function () {
        if (timestamp === _this2.timestamp) {
          clb();
        }
      }, CSSLayer.delay);
    };

    CSSLayer.prototype.isHidden = function isHidden() {
      return this.jContainer.hasClass('hidden');
    };

    CSSLayer.prototype.hide = function hide() {
      var _this3 = this;

      var res = void 0;
      if (!this.isHidden()) {
        this.jContainer.addClass('hidden');
        this.callInternal('hide');
        res = new Promise(function (resolve) {
          _this3.pendedCall(function () {
            _this3.callInternal('hidden');
            resolve();
          });
        });
      } else {
        res = Promise.resolve();
      }
      return res;
    };

    CSSLayer.prototype.show = function show() {
      var _this4 = this;

      var res = void 0;
      if (this.isHidden()) {
        this.jContainer.removeClass('hidden');
        this.callInternal('show');
        res = new Promise(function (resolve) {
          _this4.pendedCall(function () {
            _this4.callInternal('shown');
            resolve();
          });
        });
      } else {
        res = Promise.resolve();
      }
      return res;
    };

    return CSSLayer;
  }(_CSS3DRenderer.CSS3DObject);

  exports.default = CSSLayer;

  /***/
},
/* 14 */
/***/function (module, exports) {

  "use strict";
  "use strict";

  exports.__esModule = true;

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Cache = function () {
    function Cache() {
      var maxSize = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : Infinity;
      var sizeof = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : Cache.countSizeof;

      _classCallCheck(this, Cache);

      this.os = new Map();
      this.sizeof = sizeof;
      this.maxSize = maxSize;
      this.size = 0;
    }

    Cache.prototype.forEach = function forEach(clb) {
      this.os.forEach(function (v, k) {
        return clb([k, v]);
      });
    };

    Cache.countSizeof = function countSizeof(value) {
      return 1;
    };

    Cache.prototype.remove = function remove(k) {
      var res = false;
      var v = this.os.get(k);
      if (!v.locked || !v.locked(k)) {
        this.size -= this.sizeof(v);
        if (v.dispose) {
          v.dispose();
        }
        this.os.delete(k);
        res = true;
      }
      return res;
    };

    Cache.prototype.freeSpace = function freeSpace() {
      var arr = [];
      for (var _iterator = this.os, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var p = _ref;

        arr.push({ timestamp: p[1].timestamp, key: p[0] });
      }
      arr.sort(function (a, b) {
        return a.timestamp - b.timestamp;
      });
      for (var i = 0; i < arr.length && this.size > 3 * this.maxSize / 4; ++i) {
        this.remove(arr[i].key);
      }
    };

    Cache.prototype.dispose = function dispose() {
      var arr = [];
      for (var _iterator2 = this.os, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
        var _ref2;

        if (_isArray2) {
          if (_i2 >= _iterator2.length) break;
          _ref2 = _iterator2[_i2++];
        } else {
          _i2 = _iterator2.next();
          if (_i2.done) break;
          _ref2 = _i2.value;
        }

        var p = _ref2;

        arr.push({ v: p[1], k: p[0] });
      }
      for (var _iterator3 = arr, _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
        var _ref3;

        if (_isArray3) {
          if (_i3 >= _iterator3.length) break;
          _ref3 = _iterator3[_i3++];
        } else {
          _i3 = _iterator3.next();
          if (_i3.done) break;
          _ref3 = _i3.value;
        }

        var o = _ref3;

        if (o.v.dispose) {
          o.v.dispose();
        }
        this.os.delete(o.k);
      }
    };

    Cache.recursionSizeof = function recursionSizeof(value) {
      var size = 0;
      if (value) {
        ++size;
        var len = value.length;
        if (len === undefined) {
          for (var p in value) {
            if (value.hasOwnProperty(p)) {
              size += Cache.recursionSizeof(value[p]);
            }
          }
        } else {
          size += len;
        }
      }
      return size;
    };

    Cache.prototype.getTimestamp = function getTimestamp() {
      return Date.now();
    };

    Cache.prototype.get = function get(key) {
      var value = this.os.get(key);
      if (value) {
        value.timestamp = this.getTimestamp();
      }
      return value;
    };

    Cache.prototype.put = function put(key, value) {
      value.timestamp = this.getTimestamp();
      this.os.set(key, value);
      this.size += this.sizeof(value);
      if (this.size > this.maxSize) {
        this.freeSpace();
      }
      return value;
    };

    return Cache;
  }();

  exports.default = Cache;

  /***/
},
/* 15 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var Controller = function (_THREE$EventDispatche) {
    _inherits(Controller, _THREE$EventDispatche);

    function Controller() {
      _classCallCheck(this, Controller);

      return _possibleConstructorReturn(this, _THREE$EventDispatche.apply(this, arguments));
    }

    Controller.prototype.handleDefault = function handleDefault(id, e, data) {
      //console.log(id+'-'+e.type+'-'+data);
    };

    Controller.prototype.dispatchAsync = function dispatchAsync(e) {
      var _this2 = this;

      Promise.resolve().then(function () {
        return _this2.dispatchEvent(e);
      });
    };

    Controller.prototype.dispose = function dispose() {};

    return Controller;
  }(_libs.THREE.EventDispatcher);

  exports.default = Controller;

  /***/
},
/* 16 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _EventConverter2 = __webpack_require__(6);

  var _EventConverter3 = _interopRequireDefault(_EventConverter2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var CustomEventConverter = function (_EventConverter) {
    _inherits(CustomEventConverter, _EventConverter);

    // custom
    // testIntersection(e, data);
    // custom.object
    // test(object);

    function CustomEventConverter(wnd, doc) {
      var customTest = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : function () {
        return false;
      };
      var eDoc = arguments[3];

      _classCallCheck(this, CustomEventConverter);

      var _this = _possibleConstructorReturn(this, _EventConverter.call(this, wnd, doc));

      _this.eDoc = eDoc;
      _this.customTest = customTest;
      _this.customs = [];
      return _this;
    }

    CustomEventConverter.prototype.test = function test(object1, object2) {
      return object1 && object2 ? this.customTest(object1, object2) : false;
    };

    CustomEventConverter.prototype.getCallback = function getCallback(object) {
      return object.target.callback;
    };

    CustomEventConverter.prototype.addCustom = function addCustom(custom) {
      this.customs.push(custom);
    };

    CustomEventConverter.prototype.getObject = function getObject(e, data) {
      var object = void 0;
      if (data.doc === this.eDoc) {
        for (var _iterator = this.customs, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
          var _ref;

          if (_isArray) {
            if (_i >= _iterator.length) break;
            _ref = _iterator[_i++];
          } else {
            _i = _iterator.next();
            if (_i.done) break;
            _ref = _i.value;
          }

          var custom = _ref;

          object = custom.testIntersection(e, data);
          if (object) {
            break;
          }
        }
      }
      return object;
    };

    return CustomEventConverter;
  }(_EventConverter3.default);

  exports.default = CustomEventConverter;

  /***/
},
/* 17 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _Utils = __webpack_require__(4);

  var _Utils2 = _interopRequireDefault(_Utils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Finder = function () {
    Finder.isDelimetr = function isDelimetr(s) {
      return s === Finder.DELIMITER;
    };

    Finder.prototype.merge = function merge() {
      var as = [],
          map = [],
          strs = this.strs;
      var p = 0;
      for (var i = 0; i < strs.length; ++i) {
        if (strs[i].length) {
          map.push({
            base: i,
            offset: p
          });
          as.push(strs[i]);
          p += strs[i].length;
          if (i < strs.length - 1 && !Finder.isDelimetr(strs[i].charAt(strs[i].length - 1)) && !Finder.isDelimetr(strs[i + 1].charAt(0))) {
            as.push(Finder.DELIMITER);
            ++p;
          }
        }
      }
      this.map = map;
      this.str = as.join('');
    };

    Finder.prototype.addHits = function addHits(p) {
      var info = this.map[_Utils2.default.lowerBound(this.map, { offset: p }, function (a, b) {
        return a.offset - b.offset;
      })];
      var chars = this.pattern.length,
          i = info.base;
      p -= info.offset;
      while (chars) {
        if (this.strs[i].length) {
          var delimeter = i < this.strs.length - 1 && !Finder.isDelimetr(this.strs[i].charAt(this.strs[i].length - 1)) && !Finder.isDelimetr(this.strs[i + 1].charAt(0)),
              length = Math.min(this.strs[i].length + (delimeter ? 1 : 0) - p, chars);
          if (p < this.strs[i].length) {
            this.hits.push({
              index: i,
              offset: p,
              length: Math.min(length, this.strs[i].length - p)
            });
          }
          chars -= length;
          ++i;
          p = 0;
        }
      }
    };

    Finder.prototype.addContext = function addContext(p) {
      var f = p,
          l = p + this.pattern.length - 1,
          dels = this.props.contextLength,
          prevDels = dels + 1;
      while (dels && prevDels - dels) {
        prevDels = dels;
        if (dels % 2) {
          for (var i = f - 2; i >= 0; --i) {
            if (Finder.isDelimetr(this.str[i]) || i === 0) {
              f = i === 0 ? 0 : i + 1;
              --dels;
              break;
            }
          }
        } else {
          for (var _i = l + 2; _i < this.str.length; ++_i) {
            if (Finder.isDelimetr(this.str[_i]) || _i === this.str.length - 1) {
              l = _i === this.str.length - 1 ? _i === this.str.length - 1 : _i - 1;
              --dels;
              break;
            }
          }
        }
      }
      this.contexts.push(this.str.substr(f, l - f + 1));
    };

    Finder.prototype.getHits = function getHits() {
      return this.hits;
    };

    Finder.prototype.getContexts = function getContexts() {
      return this.contexts;
    };

    function Finder(strs, pattern, props) {
      _classCallCheck(this, Finder);

      this.props = _extends({}, Finder.defaults, props);
      this.strs = strs;
      var data = this.merge(strs);
      this.hits = [];
      this.contexts = [];
      this.pattern = pattern.toLowerCase();
      this.lstr = this.str.toLowerCase();
      var p = 0;
      while (true) {
        p = this.lstr.indexOf(this.pattern, p);
        if (p === -1) {
          break;
        } else {
          this.addHits(p);
          this.addContext(p);
          p += this.pattern.length;
        }
      }
    }

    return Finder;
  }();

  Finder.DELIMITER = ' ';
  Finder.defaults = {
    contextLength: 7,
    hits: true,
    contexts: true
  };
  exports.default = Finder;

  /***/
},
/* 18 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _Utils = __webpack_require__(4);

  var _Utils2 = _interopRequireDefault(_Utils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  _libs.PDFJS.workerSrc = (window.PDFJS_LOCALE ? PDFJS_LOCALE : { "pdfJsWorker": "js/pdf.worker.js", "pdfJsCMapUrl": "cmaps/" }).pdfJsWorker;
  _libs.PDFJS.cMapUrl = (window.PDFJS_LOCALE ? PDFJS_LOCALE : { "pdfJsWorker": "js/pdf.worker.js", "pdfJsCMapUrl": "cmaps/" }).pdfJsCMapUrl;
  _libs.PDFJS.cMapPacked = true;

  var Pdf = function () {
    function Pdf(src, loadingProgress) {
      var _this = this;

      _classCallCheck(this, Pdf);

      this.src = _Utils2.default.normalizeUrl(src);
      this.handlerQueue = [];
      this.progresData = { loaded: -1, total: 1 };
      this.loadingProgress = loadingProgress;

      _libs.PDFJS.getDocument({
        url: this.src,
        rangeChunkSize: 512 * 1024
      }, null, null, function (data) {
        if (_this.loadingProgress) {
          var cur = Math.floor(100 * data.loaded / data.total),
              old = Math.floor(100 * _this.progresData.loaded / _this.progresData.total);
          if (cur !== old) {
            cur = isNaN(cur) ? 0 : cur;
            cur = cur > 100 ? 100 : cur;
            _this.loadingProgress(cur);
          }
        }
        _this.progresData = data;
      }).then(function (handler) {
        if (handler.numPages > 1) {
          Promise.all([handler.getPage(1), handler.getPage(2)]).then(function (pages) {
            _this.init(handler, pages);
          });
        } else {
          _this.init(handler);
        }
      });
    }

    Pdf.prototype.init = function init(handler, pages) {
      this.handler = handler;
      this.doubledPages = pages ? Math.abs(2 * Pdf.getPageSize(pages[0]).width - Pdf.getPageSize(pages[1]).width) / Pdf.getPageSize(pages[0]).width < 1e-4 : false;
      var done = Promise.resolve(handler);

      var _loop = function _loop() {
        if (_isArray) {
          if (_i >= _iterator.length) return 'break';
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) return 'break';
          _ref = _i.value;
        }

        var clb = _ref;

        done = done.then(function (handler) {
          clb(handler);
          return handler;
        });
      };

      for (var _iterator = this.handlerQueue.reverse(), _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        var _ret = _loop();

        if (_ret === 'break') break;
      }
    };

    Pdf.prototype.getPageType = function getPageType(n) {
      return !this.doubledPages || n === 0 || n === this.getPagesNum() - 1 ? 'full' : n & 1 ? 'left' : 'right';
    };

    Pdf.prototype.getPage = function getPage(n) {
      return this.handler.getPage(this.doubledPages ? Math.ceil(n / 2) + 1 : n + 1);
    };

    Pdf.prototype.dispose = function dispose() {
      this.handlerQueue.splice(0, this.handlerQueue.length);
      delete this.handler;
    };

    Pdf.prototype.setLoadingProgressClb = function setLoadingProgressClb(clb) {
      this.loadingProgress = clb;
    };

    Pdf.prototype.getPagesNum = function getPagesNum() {
      return this.handler ? this.doubledPages ? 2 * (this.handler.numPages - 1) : this.handler.numPages : undefined;
    };

    Pdf.getPageSize = function getPageSize(page) {
      return {
        width: page.view[2] - page.view[0],
        height: page.view[3] - page.view[1]
      };
    };

    //   if(pages>1) {
    //   handler.getPage(2).
    //   then((page)=> {
    //     const size1 = Pdf.getPageSize(page);
    //     this.props.doubledPages = 2*size0.width===size1.width;
    //     this.ready();
    //   }).
    //   catch(()=> this.ready());
    // }
    // else {

    Pdf.prototype.getHandler = function getHandler(clb) {
      if (this.handler) {
        clb(this.handler);
      } else {
        this.handlerQueue.push(clb);
      }
    };

    return Pdf;
  }();

  exports.default = Pdf;

  /***/
},
/* 19 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var ThreeEventConverterFs = function () {
    ThreeEventConverterFs.objectsTest = function objectsTest(object1, object2) {
      return object1 && object2 ? object1.object === object2.object : false;
    };

    ThreeEventConverterFs.objectsAndFacesTest = function objectsAndFacesTest(object1, object2) {
      return object1 && object2 ? object1.object === object2.object && object1.face.materialIndex === object2.face.materialIndex : false;
    };

    function ThreeEventConverterFs(visualWorld) {
      var test = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : ThreeEventConverterFs.objectsAndFacesTest;

      _classCallCheck(this, ThreeEventConverterFs);

      this.visual = visualWorld;
      this.coords = new _libs.THREE.Vector2();
      this.raycaster = this.visual.raycaster;
      this.camera = this.visual.camera;
      this.threes = [];
      this.test = test;
    }

    ThreeEventConverterFs.prototype.addThree = function addThree(three) {
      this.threes.push(three);
    };

    ThreeEventConverterFs.prototype.removeThree = function removeThree(three) {
      var i = this.threes.indexOf(three);
      if (~i) {
        this.threes.splice(i, 1);
      }
    };

    ThreeEventConverterFs.prototype.getObject = function getObject(e) {
      this.setCoordsFromEvent(e);
      this.raycaster.setFromCamera(this.coords, this.camera);
      var intersects = this.raycaster.intersectObjects(this.threes);
      return intersects[0];
    };

    return ThreeEventConverterFs;
  }();

  exports.default = ThreeEventConverterFs;

  /***/
},
/* 20 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _BaseMathUtils = __webpack_require__(2);

  var _BaseMathUtils2 = _interopRequireDefault(_BaseMathUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var ThreeUtils = function () {
    function ThreeUtils() {
      _classCallCheck(this, ThreeUtils);
    }

    ThreeUtils.vertices2UVs = function vertices2UVs(vertices, indeces, first, last, converClb) {
      var r = [];
      for (var i = first; i < last; ++i) {
        var vis = [indeces[i].a, indeces[i].b, indeces[i].c];
        for (var j = 0; j < vis.length; ++j) {
          if (!r[vis[j]]) {
            r[vis[j]] = converClb(vertices[vis[j]]);
          }
        }
      }
      return r;
    };

    ThreeUtils.computeFaceVertexUvs = function computeFaceVertexUvs(geometry, faces) {
      var uvs = [ThreeUtils.vertices2UVs(geometry.vertices, geometry.faces, 0, faces[0], function (p) {
        return new THREE.Vector2(p.x, 1 - p.z);
      }), ThreeUtils.vertices2UVs(geometry.vertices, geometry.faces, faces[0], faces[1], function (p) {
        return new THREE.Vector2(1 - p.x, 1 - p.z);
      }), ThreeUtils.vertices2UVs(geometry.vertices, geometry.faces, faces[1], faces[2], function (p) {
        return new THREE.Vector2(p.x, p.y);
      }), ThreeUtils.vertices2UVs(geometry.vertices, geometry.faces, faces[2], faces[3], function (p) {
        return new THREE.Vector2(1 - p.x, p.y);
      }), ThreeUtils.vertices2UVs(geometry.vertices, geometry.faces, faces[3], faces[4], function (p) {
        return new THREE.Vector2(p.z, p.y);
      }), ThreeUtils.vertices2UVs(geometry.vertices, geometry.faces, faces[4], geometry.faces.length, function (p) {
        return new THREE.Vector2(1 - p.z, p.y);
      })];

      var uvsi = 0;
      for (var i = 0; i < geometry.faces.length; ++i) {
        uvsi += faces[uvsi] === i;
        var f = geometry.faces[i];
        f.materialIndex = uvsi;
        geometry.faceVertexUvs[0][i] = [uvs[uvsi][f.a], uvs[uvsi][f.b], uvs[uvsi][f.c]];
      }
    };

    ThreeUtils.createMarker = function createMarker(p, c, size) {
      var marker = new THREE.Mesh(new THREE.SphereGeometry(size), new THREE.MeshPhongMaterial({ color: c }));
      marker.position.set(p.x, p.y, p.z);
      return marker;
    };

    ThreeUtils.findUvTris = function findUvTris(geometry, ps, first, last) {
      var res = [];
      for (var _iterator = ps, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var p = _ref;

        var found = false;
        for (var i = first; i < last && !found; ++i) {
          var tri = geometry.faceVertexUvs[0][i];
          if (_BaseMathUtils2.default.isInsideConvPoly(tri, p)) {
            res.push({
              coefs: _BaseMathUtils2.default.computeInterpCoefs(tri, p),
              i: i
            });
            found = true;
          }
        }
        if (!found) {
          console.error('Bad point');
          res.push(undefined);
        }
      }
      return res;
    };

    ThreeUtils.findInternalVertices = function findInternalVertices(geometry, ps, first, last) {
      var res = {};
      for (var i = first; i < last; ++i) {
        var tri = geometry.faceVertexUvs[0][i],
            f = geometry.faces[i],
            vs = [f.a, f.b, f.c];
        for (var j = 0; j < tri.length; ++j) {
          if (res[vs[j]] === undefined && _BaseMathUtils2.default.isInsidePoly(ps, tri[j])) {
            res[vs[j]] = {
              p: tri[j],
              i: vs[j],
              n: f.vertexNormals[j]
            };
          }
        }
      }
      return Object.values(res);
    };

    return ThreeUtils;
  }();

  exports.default = ThreeUtils;

  /***/
},
/* 21 */
/***/function (module, exports) {

  "use strict";
  "use strict";

  exports.__esModule = true;

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Target = function () {
    function Target() {
      _classCallCheck(this, Target);
    }

    Target.test = function test(object1, object2) {
      return object1.target === object2.target;
    };

    return Target;
  }();

  exports.default = Target;

  /***/
},
/* 22 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(1);

  var _Detector = __webpack_require__(45);

  var _Detector2 = _interopRequireDefault(_Detector);

  var _VisualWorld = __webpack_require__(66);

  var _VisualWorld2 = _interopRequireDefault(_VisualWorld);

  var _PdfLinksHandler = __webpack_require__(35);

  var _PdfLinksHandler2 = _interopRequireDefault(_PdfLinksHandler);

  var _Book = __webpack_require__(26);

  var _Book2 = _interopRequireDefault(_Book);

  var _BookView = __webpack_require__(29);

  var _BookView2 = _interopRequireDefault(_BookView);

  var _BookController = __webpack_require__(27);

  var _BookController2 = _interopRequireDefault(_BookController);

  var _PdfBookPropsBuilder = __webpack_require__(34);

  var _PdfBookPropsBuilder2 = _interopRequireDefault(_PdfBookPropsBuilder);

  var _ClbBookPropsBuilder = __webpack_require__(30);

  var _ClbBookPropsBuilder2 = _interopRequireDefault(_ClbBookPropsBuilder);

  var _LoadingController = __webpack_require__(53);

  var _LoadingController2 = _interopRequireDefault(_LoadingController);

  var _Search = __webpack_require__(58);

  var _Search2 = _interopRequireDefault(_Search);

  var _Bookmarks = __webpack_require__(44);

  var _Bookmarks2 = _interopRequireDefault(_Bookmarks);

  var _Thumbnails = __webpack_require__(63);

  var _Thumbnails2 = _interopRequireDefault(_Thumbnails);

  var _TocController = __webpack_require__(40);

  var _TocController2 = _interopRequireDefault(_TocController);

  var _BookPrinter = __webpack_require__(28);

  var _BookPrinter2 = _interopRequireDefault(_BookPrinter);

  var _AutoNavigator = __webpack_require__(24);

  var _AutoNavigator2 = _interopRequireDefault(_AutoNavigator);

  var _SoundsEnviroment = __webpack_require__(39);

  var _SoundsEnviroment2 = _interopRequireDefault(_SoundsEnviroment);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  _libs.$.fn.FlipBook = function (options) {
    var scene = {
      dispose: function dispose() {
        if (this.ready) {
          !scene.pdfLinksHandler || scene.pdfLinksHandler.dispose();
          delete scene.pdfLinksHandler;
          scene.sounds.dispose();
          delete scene.sounds;
          scene.tocCtrl.dispose();
          delete scene.tocCtrl;
          scene.thumbnails.dispose();
          delete scene.thumbnails;
          !scene.bookmarks || scene.bookmarks.dispose();
          delete scene.bookmarks;
          scene.ctrl.dispose();
          delete scene.ctrl;
          scene.bookPrinter.dispose();
          delete scene.bookPrinter;
          scene.book.dispose();
          delete scene.book;
          scene.propsBuilder.dispose();
          delete scene.propsBuilder;
          delete scene.bookBuilder;
          scene.visual.dispose();
          delete scene.visual;
          scene.view.dispose();
          delete scene.view;
          delete scene.dispose;
        } else {
          this.pendingDispose = true;
        }
      }
    };
    options = _extends({}, options);
    scene.view = new _BookView2.default(this.length ? this[0] : (0, _libs.$)('<div>').appendTo('body'), function () {
      if (!_Detector2.default.webgl) {
        _Detector2.default.addGetWebGLMessage({ parent: scene.view.getView() });
      } else {
        scene.loadingCtrl = new _LoadingController2.default(scene.view, true, function (progress) {
          return progress === 0 ? (0, _libs.tr)('Please wait... the Application is Loading') : (0, _libs.tr)('PDF is Loading:') + ' ' + progress + '%';
        });
        scene.visual = new _VisualWorld2.default(scene.view.getContainer().ownerDocument.defaultView, scene.view.getContainer().ownerDocument, scene.view.getView());
        scene.bookBuilder = function (props, sheets, pageCallback) {
          props.cssLayerProps = _extends({}, props.cssLayerProps, {
            scene: scene
          });
          if (options.propertiesCallback) {
            props = options.propertiesCallback(props);
          }
          scene.book = new _Book2.default(scene.visual, sheets, pageCallback, props);
          scene.bookPrinter = new _BookPrinter2.default(scene.visual, scene.book, (options.template || {}).printStyle);
          scene.loadingCtrl.dispose();
          delete scene.loadingCtrl;
          scene.ctrl = new _BookController2.default(scene.book, scene.view, options.controlsProps);
          scene.book.setInjector(function (w) {
            w.jQuery = w.$ = _libs.$;
            w.book = scene.book;
            w.bookCtrl = scene.ctrl;
            if (props.injector) {
              props.injector(w);
            }
          });
          scene.view.addHandler(scene.ctrl);
          scene.ctrl.setPrinter(scene.bookPrinter);
          var test = pageCallback(0);

          scene.search = new _Search2.default(scene.view.getSearchView(), scene.book.getPages());
          scene.search.onQuery = scene.book.setQuery.bind(scene.book);
          scene.book.addEventListener('searchResults', function (e) {
            scene.search.setResults(e.results, e.lastPage);
          });

          scene.thumbnails = new _Thumbnails2.default(scene.visual, scene.view.getThumbnailsView(), pageCallback, 2 * (sheets + 2), { kWtoH: props.width / props.height });
          scene.tocCtrl = new _TocController2.default(scene.view, scene.ctrl);
          scene.tocCtrl.setThumbnails(scene.thumbnails);
          scene.tocCtrl.setSearch(scene.search);
          scene.ctrl.setTocCtrl(scene.tocCtrl);
          scene.view.addHandler(scene.tocCtrl);

          if (test.type === 'pdf') {
            scene.pdfLinksHandler = new _PdfLinksHandler2.default(test.src, scene.ctrl, scene.visual.element);
            scene.book.addEventListener('pdfAnnotation', scene.pdfLinksHandler.handleEvent.bind(scene.pdfLinksHandler));
            test.src.getHandler(function (handler) {
              handler.getOutline().then(function (outline) {
                scene.bookmarks = new _Bookmarks2.default(scene.view.getBookmarksView(), outline);
                scene.tocCtrl.setBookmarks(scene.bookmarks, test.src);
              });
            });
            if (options.pdfLinks && options.pdfLinks.handler) {
              scene.pdfLinksHandler.setHandler(options.pdfLinks.handler);
            }
          }

          scene.sounds = new _SoundsEnviroment2.default(options.template);
          scene.ctrl.setSounds(scene.sounds);
          scene.sounds.subscribeFlips(scene.ctrl);

          scene.ready = true;
          new _AutoNavigator2.default(scene.visual, scene.ctrl, options.autoNavigation).dispose();
          if (options.ready) {
            options.ready(scene);
          }
          if (scene.pendingDispose) {
            scene.dispose();
          }
        };
        if (options.pdf) {
          scene.propsBuilder = new _PdfBookPropsBuilder2.default(options.pdf, scene.bookBuilder);
          scene.propsBuilder.pdf.setLoadingProgressClb(scene.loadingCtrl.setProgress.bind(scene.loadingCtrl));
        } else if (options.pageCallback) {
          scene.propsBuilder = new _ClbBookPropsBuilder2.default(scene.visual, options.pageCallback, options.pages, scene.bookBuilder);
        } else {
          scene.propsBuilder = new _ClbBookPropsBuilder2.default(scene.visual, _Book2.default.pageCallback, 6, scene.bookBuilder);
        }
      }
    }, options.template);
    return scene;
  };

  (0, _libs.$)(function () {
    var containers = (0, _libs.$)('.flip-book-container');
    for (var i = 0; i < containers.length; ++i) {
      var jContainer = (0, _libs.$)(containers[i]),
          src = jContainer.attr('src');
      if (!!src) {
        jContainer.FlipBook({ pdf: src });
      }
    }
  });

  window.jQuery = window.$ = _libs.$;

  /***/
},
/* 23 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  if (!Array.prototype.fill) {
    Array.prototype.fill = function (value) {

      // Шаги 1-2.
      if (this == null) {
        throw new TypeError('this is null or not defined');
      }

      var O = Object(this);

      // Шаги 3-5.
      var len = O.length >>> 0;

      // Шаги 6-7.
      var start = arguments[1];
      var relativeStart = start >> 0;

      // Шаг 8.
      var k = relativeStart < 0 ? Math.max(len + relativeStart, 0) : Math.min(relativeStart, len);

      // Шаги 9-10.
      var end = arguments[2];
      var relativeEnd = end === undefined ? len : end >> 0;

      // Шаг 11.
      var final = relativeEnd < 0 ? Math.max(len + relativeEnd, 0) : Math.min(relativeEnd, len);

      // Шаг 12.
      while (k < final) {
        O[k] = value;
        k++;
      }

      // Шаг 13.
      return O;
    };
  }

  if (!Array.prototype.find) {
    Object.defineProperty(Array.prototype, 'find', {
      value: function value(predicate) {
        'use strict';

        if (this == null) {
          throw new TypeError('Array.prototype.find called on null or undefined');
        }
        if (typeof predicate !== 'function') {
          throw new TypeError('predicate must be a function');
        }
        var list = Object(this);
        var length = list.length >>> 0;
        var thisArg = arguments[1];
        var value;

        for (var i = 0; i < length; i++) {
          value = list[i];
          if (predicate.call(thisArg, value, i, list)) {
            return value;
          }
        }
        return undefined;
      }
    });
  }

  if (!Array.prototype.findIndex) {
    Array.prototype.findIndex = function (predicate) {
      if (this == null) {
        throw new TypeError('Array.prototype.findIndex called on null or undefined');
      }
      if (typeof predicate !== 'function') {
        throw new TypeError('predicate must be a function');
      }
      var list = Object(this);
      var length = list.length >>> 0;
      var thisArg = arguments[1];
      var value;

      for (var i = 0; i < length; i++) {
        value = list[i];
        if (predicate.call(thisArg, value, i, list)) {
          return i;
        }
      }
      return -1;
    };
  }

  if (!Object.values) {
    Object.values = function values(O) {
      return Object.keys(O).map(function (name) {
        return O[name];
      }) || [];
    };
  }

  /***/
},
/* 24 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var AutoNavigator = function () {
    function AutoNavigator(context, bookCtrl) {
      var props = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

      _classCallCheck(this, AutoNavigator);

      props = _extends({}, props, {
        urlParam: props.urlParam || 'fb3d-page',
        navigates: props.navigates === undefined ? 1 : props.navigates
      });
      this.props = props;
      this.context = context;
      this.bookCtrl = bookCtrl;
      this.urlParam = props.urlParam;
      this.wnd = context.wnd;

      this.wnd.fb3d = _extends({}, this.wnd.fb3d);
      this.wnd.fb3d.navigator = _extends({}, this.wnd.fb3d.navigator);
      this.navigator = this.wnd.fb3d.navigator[this.urlParam] = _extends({}, this.wnd.fb3d.navigator[this.urlParam]);
      this.navigator.instances = (this.navigator.instances || 0) + 1;

      if (this.navigator.instances <= this.props.navigates) {
        this.bookCtrl.goToPage(this.getPageNumber());
      }
    }

    AutoNavigator.prototype.dispose = function dispose() {};

    AutoNavigator.prototype.getParameterByName = function getParameterByName(name, url) {
      if (!url) {
        url = window.location.href;
      }
      name = name.replace(/[\[\]]/g, '\\$&');
      var regex = new RegExp('[?&]' + name + '(=([^]*)|&|#|$)'),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
    };

    AutoNavigator.prototype.getPageNumber = function getPageNumber() {
      var number = this.getParameterByName(this.urlParam);
      number = parseInt(number);
      if (isNaN(number)) {
        number = 1;
      }
      return number - 1;
    };

    return AutoNavigator;
  }();

  exports.default = AutoNavigator;

  /***/
},
/* 25 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(1);

  var _MathUtils = __webpack_require__(3);

  var _MathUtils2 = _interopRequireDefault(_MathUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Binder = function () {
    function Binder(visual, p) {
      var _this = this;

      _classCallCheck(this, Binder);

      this.visual = visual;
      this.p = _extends({}, p, {
        backSize: 2 * p.cover.depth + p.sheets * p.page.depth
      });
      this.OZ = new _libs.THREE.Vector3(0, 0, 1);

      this.backG = new _libs.THREE.BoxGeometry(p.cover.depth, this.p.backSize, p.cover.height);

      this.materials = [new _libs.THREE.MeshPhongMaterial({ color: p.cover.color }), new _libs.THREE.MeshPhongMaterial({ color: p.cover.color }), new _libs.THREE.MeshPhongMaterial({ color: p.cover.color }), new _libs.THREE.MeshPhongMaterial({ color: p.cover.color }), new _libs.THREE.MeshPhongMaterial({ color: p.cover.color }), new _libs.THREE.MeshPhongMaterial({ color: p.cover.color })];

      var backM = new _libs.THREE.Mesh(this.backG, new _libs.THREE.MeshFaceMaterial(this.materials));

      if (p.cover.binderTexture !== '') {
        this.visual.textureLoader.load(p.cover.binderTexture, function (texture) {
          _this.materials[1].color.setHex(0xFFFFFF);
          _this.materials[1].map = texture;
          texture.minFilter = _libs.THREE.LinearFilter;
          texture.needsUpdate = true;
          _this.materials[1].needsUpdate = true;
        });
      }

      this.three = new _libs.THREE.Object3D();
      this.back = new _libs.THREE.Object3D();
      this.backRT = new _libs.THREE.Object3D();
      this.backRR = new _libs.THREE.Object3D();
      this.backLT = new _libs.THREE.Object3D();
      this.backLR = new _libs.THREE.Object3D();
      this.leftPivot = new _libs.THREE.Object3D();
      this.rightPivot = new _libs.THREE.Object3D();

      this.back.add(backM);
      this.back.add(this.leftPivot);
      this.back.add(this.rightPivot);
      this.backRT.add(this.back);
      this.backRR.add(this.backRT);
      this.backLT.add(this.backRR);
      this.backLR.add(this.backLT);
      this.three.add(this.backLR);
    }

    Binder.prototype.dispose = function dispose() {
      for (var _iterator = this.materials, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var m = _ref;

        if (m.map) {
          m.map = null;
          m.needsUpdate = true;
        }
        m.dispose();
      }
      delete this.materials;
      this.backG.dispose();
    };

    Binder.prototype.set = function set(angle) {
      var right = void 0,
          left = void 0;
      if (angle > Math.PI / 2) {
        right = Math.PI / 2;
        left = angle - Math.PI / 2;
      } else {
        right = angle;
        left = 0;
      }
      var p = this.p,
          tr1 = { x: -0.5 * p.cover.depth, y: 0.5 * p.backSize - p.cover.depth };
      this.backRT.position.set(tr1.x, tr1.y, 0);
      this.backRR.position.set(-tr1.x, -tr1.y, 0);
      this.backRR.quaternion.setFromAxisAngle(this.OZ, right);

      var tr2 = { x: p.backSize - 2 * p.cover.depth - 0.5 * p.cover.depth, y: 0.5 * p.backSize - p.cover.depth };
      this.backLT.position.set(tr2.x, tr2.y, 0);
      this.backLR.position.set(-tr2.x, -tr2.y, 0);
      this.backLR.quaternion.setFromAxisAngle(this.OZ, left);
    };

    Binder.prototype.setLeft = function setLeft(angle) {
      var PI = Math.PI;
      this.leftPivot.position.set(_MathUtils2.default.interpolateLinear([-PI, -PI / 2], [0, this.p.cover.depth], angle), 0.5 * this.p.backSize - 0.5 * this.p.cover.depth, 0);
      this.leftPivot.quaternion.setFromAxisAngle(this.OZ, angle);
    };

    Binder.prototype.setRight = function setRight(angle) {
      var PI = Math.PI;
      this.rightPivot.position.set(_MathUtils2.default.interpolateLinear([-PI / 2, 0], [this.p.cover.depth, 0], angle), -0.5 * this.p.backSize + 0.5 * this.p.cover.depth, 0);
      this.rightPivot.quaternion.setFromAxisAngle(this.OZ, angle);
    };

    Binder.prototype.joinLeftCover = function joinLeftCover(cover) {
      cover.three.position.set(0, -0.5 * this.p.cover.depth, 0);
      this.leftPivot.add(cover.three);
    };

    Binder.prototype.disconnectLeftCover = function disconnectLeftCover(cover) {
      this.leftPivot.remove(cover.three);
    };

    Binder.prototype.joinRightCover = function joinRightCover(cover) {
      cover.three.position.set(0, -0.5 * this.p.cover.depth, 0);
      this.rightPivot.add(cover.three);
    };

    Binder.prototype.disconnectRightCover = function disconnectRightCover(cover) {
      this.rightPivot.remove(cover.three);
    };

    return Binder;
  }();

  exports.default = Binder;

  /***/
},
/* 26 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(1);

  var _book = __webpack_require__(11);

  var _GraphUtils = __webpack_require__(7);

  var _GraphUtils2 = _interopRequireDefault(_GraphUtils);

  var _Binder = __webpack_require__(25);

  var _Binder2 = _interopRequireDefault(_Binder);

  var _Cover = __webpack_require__(31);

  var _Cover2 = _interopRequireDefault(_Cover);

  var _SheetBlock = __webpack_require__(10);

  var _SheetBlock2 = _interopRequireDefault(_SheetBlock);

  var _SheetPhysics = __webpack_require__(38);

  var _SheetPhysics2 = _interopRequireDefault(_SheetPhysics);

  var _PageManager = __webpack_require__(33);

  var _PageManager2 = _interopRequireDefault(_PageManager);

  var _CSSLayer = __webpack_require__(13);

  var _CSSLayer2 = _interopRequireDefault(_CSSLayer);

  var _CssLayersManager = __webpack_require__(32);

  var _CssLayersManager2 = _interopRequireDefault(_CssLayersManager);

  var _SearchEngine = __webpack_require__(36);

  var _SearchEngine2 = _interopRequireDefault(_SearchEngine);

  var _CustomEventConverter = __webpack_require__(16);

  var _CustomEventConverter2 = _interopRequireDefault(_CustomEventConverter);

  var _CircleTarget = __webpack_require__(68);

  var _CircleTarget2 = _interopRequireDefault(_CircleTarget);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var Book = function (_THREE$EventDispatche) {
    _inherits(Book, _THREE$EventDispatche);

    // pageCallback samples

    // (n)=> ({
    //   type: 'image',
    //   src: 'sample.png',
    //   interactive: false
    // });
    //
    // (n)=> ({
    //   type: 'html',
    //   src: 'sample.html',
    //   interactive: true
    // });
    //
    // const pdf = new Pdf('sample.pdf');
    // (n)=> ({
    //   type: 'pdf',
    //   src: pdf,
    //   interactive: false
    // });

    function Book(visual, sheets, pageCallback, props) {
      _classCallCheck(this, Book);

      var _this = _possibleConstructorReturn(this, _THREE$EventDispatche.call(this));

      sheets = Math.min(3, sheets);
      // visual.jContainer.append('\n      <style type="text/css">\n        .demo-msg {\n          position: absolute;\n          top: 10px;\n          right: 10px;\n          padding: 10px;\n          background-color: #ffe4e1;\n          border-radius: 3px;\n        }\n      </style>\n      <div class="demo-msg">\n        This is the demo version, only 10 pages are available. Use the <a href="http://3dflipbook.net/download-jq" target="_blank">full version</a>.\n      </div>\n    ');
      _this.visual = visual;
      _this.mouseController = true;
      _this.p = _extends({}, Book.prepareProps(props), {
        sheets: sheets,
        pageCallback: pageCallback,
        zoom: 1,
        singlePage: false,
        autoResolution: {
          enable: false,
          k: 1.5
        }
      });
      _this.pageManager = new _PageManager2.default(visual, _this, _this.p);
      _CSSLayer2.default.init(visual.doc);
      _this.layerManager = new _CssLayersManager2.default(_this);
      _this.searchEngine = new _SearchEngine2.default(pageCallback, 2 * (sheets + 2));
      _this.searchEngine.onPageHitsChanged = function (page, query) {
        _this.pageManager.refreshPageQuery(page, query);
        _this.dispatchEvent({
          type: 'searchResults',
          results: _this.searchEngine.results,
          lastPage: page,
          query: query
        });
      };

      _this.three = new _libs.THREE.Object3D();

      _this.binder = new _Binder2.default(visual, _this.p);
      _this.three.add(_this.binder.three);

      _this.leftCover = new _Cover2.default(visual, _extends({}, _this.p, { setTexture: _this.setLeftCoverTexture.bind(_this) }), Math.PI / 2, 'opened');
      _this.binder.joinLeftCover(_this.leftCover);
      _this.subscribeSheetBlock(_this.leftCover, 0);
      _this.rightCover = new _Cover2.default(visual, _extends({}, _this.p, { setTexture: _this.setRightCoverTexture.bind(_this) }), 0, 'closed');
      _this.binder.joinRightCover(_this.rightCover);
      _this.subscribeSheetBlock(_this.rightCover, 2 * (_this.p.sheets + 1));

      _this.threeSheetBlocks = new _libs.THREE.Object3D();
      _this.three.add(_this.threeSheetBlocks);
      _this.threeSheetBlocks.position.set(0.5 * _this.p.cover.depth - 0.5 * sheets * _this.p.page.depth, -0.5 * sheets * _this.p.page.depth, 0);

      _this.sheetBlocks = [];
      if (sheets > 0) {
        _this.addSheetBlock(0, new _SheetBlock2.default(visual, _extends({}, _this.p, { setTexture: _this.setPageTexture.bind(_this) }), 0, sheets, 0, 'closed'));
      }

      _this.angle = _this.p.rtl ? Math.PI : 0;
      _this.closedAngle = 0;
      _this.set(_this.angle, 0);
      _this.lastMousePos = {
        t: 0
      };

      _this.three.position.set(-0.5 * _this.p.cover.depth + 0.5 * sheets * _this.p.page.depth, 0, 0);
      _this.sheetPhysics = new _SheetPhysics2.default(_this.p.page.width / _this.p.scale, _this.p.gravity, _this.p.page.cornerDeviation);

      _this.binds = {
        update: _this.update.bind(_this),
        lastMousePos: function lastMousePos(e) {
          _this.lastMousePos = _extends({}, _this.lastMousePos, {
            pageX: e.pageX,
            pageY: e.pageY
          });
        }
      };
      _this.visual.addRenderCallback(_this.binds.update);
      (0, _libs.$)(_this.visual.element).on('mousemove', _this.binds.lastMousePos);

      _this.binds.onPickCallback = _this.onPickCallback.bind(_this);
      _this.visual.drag.onPickCallback = _this.binds.onPickCallback;
      _this.binds.onDragCallback = _this.onDragCallback.bind(_this);
      _this.visual.drag.onDragCallback = _this.binds.onDragCallback;
      _this.binds.onReleaseCallback = _this.onReleaseCallback.bind(_this);
      _this.visual.drag.onReleaseCallback = _this.binds.onReleaseCallback;

      _this.dragAngle = 0.05;
      _this.tmp = {
        boxs: [new _libs.THREE.Box3(), new _libs.THREE.Box3()]
      };

      _this.visual.addObject(_this.three);
      _this.visual.addEventListener('resize', _this.pageManager.refreshZoom.bind(_this.pageManager));

      setTimeout(function () {
        _this.notifyBeforeAnimation();
        _this.notifyAfterAnimation();
      }, 100);
      return _this;
    }

    Book.prototype.dispose = function dispose() {
      this.visual.removeObject(this.three);
      this.sheetPhysics.dispose();
      delete this.visual.drag.onPickCallback;
      delete this.visual.drag.onDragCallback;
      delete this.visual.drag.onReleaseCallback;
      (0, _libs.$)(this.visual.element).off('mousemove', this.binds.lastMousePos);
      this.visual.removeRenderCallback(this.binds.update);
      this.removeSheetBlocks(0, this.sheetBlocks.length);
      this.binder.disconnectLeftCover(this.leftCover);
      this.removeSheetBlock(this.leftCover);
      this.binder.disconnectRightCover(this.rightCover);
      this.removeSheetBlock(this.rightCover);
      this.binder.dispose();
      this.layerManager.dispose();
      _CSSLayer2.default.dispose();
      this.pageManager.dispose();
    };

    // publics {

    Book.prototype.setAutoResolution = function setAutoResolution(enable) {
      var k = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1.5;

      this.p.autoResolution = _extends({}, this.p.autoResolution, {
        enable: enable,
        k: k
      });
    };

    Book.prototype.setZoom = function setZoom(zoom, singlePage) {
      if (Math.abs(this.p.zoom - zoom) > 1e-3 || singlePage !== this.p.singlePage) {
        this.p.zoom = zoom;
        this.p.singlePage = singlePage;
        this.pageManager.refreshZoom();
      }
    };

    Book.prototype.getPageCallback = function getPageCallback() {
      return this.p.pageCallback;
    };

    Book.prototype.setQuery = function setQuery(query) {
      this.searchEngine.setQuery(query);
    };

    Book.prototype.isProcessing = function isProcessing() {
      return this.sheetPhysics.getSize() !== 0;
    };

    Book.prototype.getPages = function getPages() {
      return 4 + 2 * this.p.sheets;
    };

    Book.prototype.setFlipProgressClb = function setFlipProgressClb(clb) {
      this.p.flipProgressClb = clb;
    };

    Book.prototype.setInjector = function setInjector(injector) {
      this.p.injector = injector;
    };

    Book.prototype.isActivePage = function isActivePage(n) {
      var res = true;
      if (n > 1 && n < this.getPages() - 2) {
        for (var _iterator = this.sheetBlocks, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
          var _ref;

          if (_isArray) {
            if (_i >= _iterator.length) break;
            _ref = _iterator[_i++];
          } else {
            _i = _iterator.next();
            if (_i.done) break;
            _ref = _i.value;
          }

          var b = _ref;

          if (n - 2 > 2 * b.p.first && n - 2 < 2 * b.p.last - 1) {
            res = false;
            break;
          }
        }
      }
      return res;
    };

    Book.prototype.getBlockByPage = function getBlockByPage(n) {
      var block = void 0;
      if (n < 2) {
        block = this.leftCover;
      } else if (n < 2 * (this.p.sheets + 1)) {
        for (var _iterator2 = this.sheetBlocks, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
          var _ref2;

          if (_isArray2) {
            if (_i2 >= _iterator2.length) break;
            _ref2 = _iterator2[_i2++];
          } else {
            _i2 = _iterator2.next();
            if (_i2.done) break;
            _ref2 = _i2.value;
          }

          var b = _ref2;

          if (n - 2 >= 2 * b.p.first && n - 2 < 2 * b.p.last) {
            block = b;
            break;
          }
        }
      } else {
        block = this.rightCover;
      }
      return block;
    };

    Book.prototype.getBlockPages = function getBlockPages(block) {
      var range = void 0;
      switch (block) {
        case this.leftCover:
          {
            range = [0, 1];
            break;
          }
        case this.rightCover:
          {
            range = [2 * (this.p.sheets + 1), 2 * (this.p.sheets + 1) + 1];
            break;
          }
        default:
          {
            range = block ? [2 * (block.p.first + 1), 2 * (block.p.last + 1) - 1] : undefined;
          }
      }
      return range;
    };

    Book.prototype.getPage = function getPage() {
      var PI = Math.PI;
      var p = void 0;
      if (this.angle === PI / 2 || this.angle === 3 * PI / 2) {
        for (var _iterator3 = this.sheetBlocks, _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
          var _ref3;

          if (_isArray3) {
            if (_i3 >= _iterator3.length) break;
            _ref3 = _iterator3[_i3++];
          } else {
            _i3 = _iterator3.next();
            if (_i3.done) break;
            _ref3 = _i3.value;
          }

          var block = _ref3;

          if (block.angle <= PI / 2) {
            p = this.getBlockPages(block)[0] - 1;
            break;
          }
        }
        if (!p) {
          p = this.getPages() - 3;
        }
      } else if (this.angle < PI / 2) {
        p = 0;
      } else if (this.angle > 3 * PI / 2) {
        p = 1;
      } else if (this.angle < PI) {
        p = this.getPages() - 3;
      } else if (this.angle >= PI) {
        p = this.getPages() - 1;
      }
      return p;
    };

    Book.prototype.getTopPages = function getTopPages() {
      var p = this.getPage();
      return p === 0 || p === this.getPages() - 1 ? [p] : [p, p + 1];
    };

    Book.prototype.getPageState = function getPageState(n) {
      return this.pageManager.getPageState(n);
    };

    Book.prototype.enableLoadingAnimation = function enableLoadingAnimation(enable) {
      this.pageManager.enableLoadingAnimation(enable);
    };

    Book.prototype.getLeftFlipping = function getLeftFlipping() {
      var block = void 0;
      var left = this.sheetBlocks[0],
          PI = Math.PI;
      if (this.angle === PI) {
        block = this.rightCover;
      } else {
        if (left && left.state === 'closed' && left.angle > PI / 2) {
          block = left;
        } else if (this.angle === PI / 2 || this.angle === 3 * PI / 2) {
          block = this.leftCover;
        }
      }
      return block;
    };

    Book.prototype.getRightFlipping = function getRightFlipping() {
      var block = void 0;
      var right = this.sheetBlocks[this.sheetBlocks.length - 1],
          PI = Math.PI;
      if (this.angle === 0) {
        block = this.leftCover;
      } else {
        if (right && right.state === 'closed' && right.angle <= PI / 2) {
          block = right;
        } else if (this.angle === PI / 2 || this.angle === 3 * PI / 2) {
          block = this.rightCover;
        }
      }
      return block;
    };

    Book.prototype.getClosedBlockAngle = function getClosedBlockAngle(angle) {
      var closedAngle = void 0,
          PI = Math.PI;

      if (this.leftCover.physicId) {
        var test = void 0;
        try {
          test = Math.abs(this.sheetPhysics.getParametr(this.leftCover.physicId, 'angle') - angle);
        } catch (e) {
          test = 0;
        }
        closedAngle = angle > PI / 2 || test > PI / 6 ? PI / 2 : this.closedAngle;
      } else if (this.rightCover.physicId) {
        var _test = void 0;
        try {
          _test = Math.abs(this.sheetPhysics.getParametr(this.rightCover.physicId, 'angle') - angle);
        } catch (e) {
          _test = 0;
        }
        closedAngle = angle < PI / 2 || _test > PI / 6 ? PI / 2 + 1e-7 : this.closedAngle;
      } else {
        closedAngle = PI / 2 + (angle !== 0) * 1e-7;
      }

      return {
        openedAngle: angle,
        closedAngle: closedAngle,
        binderTurn: this.closedAngle
      };
    };

    Book.prototype.flipLeft = function flipLeft() {
      var _this2 = this;

      var size = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      var progressClb = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.p.flipProgressClb;

      var block = void 0,
          res = void 0;
      if (this.sheetPhysics.getSize() < 25) {
        (function () {
          var left = _this2.sheetBlocks[0],
              PI = Math.PI;
          if (_this2.angle === PI) {
            res = _this2.connectPhysics(block = _this2.rightCover, _this2.p.cover.mass, PI, -_this2.p.cover.startVelocity, _this2.p.cover.flexibility, 0, function (angle, height) {
              return _this2.set(3 * PI / 2 - angle / 2, height);
            }, function (angle, height) {
              _this2.set(3 * PI / 2 - angle / 2, 0);
              _this2.setSheetBlocks(angle ? PI : PI / 2 + 1e-7, 'closed');
            }, progressClb);
          } else {
            if (left && left.state === 'closed' && left.angle > PI / 2) {
              block = size < left.getSize() ? _this2.splitSheetBlock(0, left.getSize() - size)[1] : left;
              res = _this2.connectPhysics(block, _this2.p.page.mass * block.getSize(), PI, -_this2.p.page.startVelocity, _this2.p.page.flexibility, 0, function (angle, height) {
                return block.set(_this2.getClosedBlockAngle(angle), 'opened', height);
              }, Book.finishAnimationClb.bind({ book: _this2, block: block }), progressClb);
            } else if (_this2.angle === PI / 2 || _this2.angle === 3 * PI / 2) {
              res = _this2.connectPhysics(block = _this2.leftCover, _this2.p.cover.mass, PI, -_this2.p.cover.startVelocity, _this2.p.cover.flexibility, 0, function (angle, height) {
                _this2.set(2 * PI - angle / 2, height);
                if (angle > PI / 2) {
                  _this2.setSheetBlocks(angle ? PI / 2 : 0, 'closed');
                }
              }, function (angle, height) {
                return _this2.set(angle === 0 ? 0 : 2 * PI - angle / 2, 0);
              }, progressClb);
            }
          }
        })();
      }
      return res;
    };

    Book.prototype.flipRight = function flipRight() {
      var _this3 = this;

      var size = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      var progressClb = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.p.flipProgressClb;

      var block = void 0,
          res = void 0;
      if (this.sheetPhysics.getSize() < 25) {
        (function () {
          var right = _this3.sheetBlocks[_this3.sheetBlocks.length - 1],
              PI = Math.PI;
          if (_this3.angle === 0) {
            res = _this3.connectPhysics(block = _this3.leftCover, _this3.p.cover.mass, 0, _this3.p.cover.startVelocity, _this3.p.cover.flexibility, 0, function (angle, height) {
              return _this3.set(angle / 2, height);
            }, function (angle, height) {
              _this3.set(angle / 2, 0);
              _this3.setSheetBlocks(angle ? PI / 2 : 0, 'closed');
            }, progressClb);
          } else {
            if (right && right.state === 'closed' && right.angle <= PI / 2) {
              block = size < right.getSize() ? _this3.splitSheetBlock(_this3.sheetBlocks.length - 1, size)[0] : right;
              res = _this3.connectPhysics(block, _this3.p.page.mass * block.getSize(), 0, _this3.p.page.startVelocity, _this3.p.page.flexibility, 0, function (angle, height) {
                return block.set(_this3.getClosedBlockAngle(angle), 'opened', height);
              }, Book.finishAnimationClb.bind({ book: _this3, block: block }), progressClb);
            } else if (_this3.angle === PI / 2 || _this3.angle === 3 * PI / 2) {
              res = _this3.connectPhysics(block = _this3.rightCover, _this3.p.cover.mass, 0, _this3.p.cover.startVelocity, _this3.p.cover.flexibility, 0, function (angle, height) {
                _this3.set(PI / 2 + angle / 2, height);
                if (angle < PI / 2) {
                  _this3.setSheetBlocks(PI / 2 + 1e-7, 'closed');
                }
              }, function (angle, height) {
                return _this3.set(PI / 2 + angle / 2, 0);
              }, progressClb);
            }
          }
        })();
      }
      return res;
    };

    // }

    Book.prototype.clearHoverInfo = function clearHoverInfo() {
      this.pageManager.turnOnEvents();
      delete this.hoverInfo.block.force;
      delete this.hoverInfo.block.cornerForce;
      delete this.hoverInfo;
    };

    Book.prototype.xSegment = function xSegment() {
      var boxs = this.tmp.boxs,
          res = {};
      if (this.leftCover.physicId) {
        boxs[0].setFromObject(this.rightCover.three);
        res.min = -(res.max = boxs[0].max.x);
      } else if (this.rightCover.physicId) {
        boxs[0].setFromObject(this.leftCover.three);
        res.max = -(res.min = boxs[0].min.x);
      } else {
        boxs[0].setFromObject(this.leftCover.three);
        boxs[1].setFromObject(this.rightCover.three);
        boxs[0].union(boxs[1]);
        res.min = boxs[0].min.x;
        res.max = boxs[0].max.x;
      }
      return res;
    };

    Book.prototype.computeTarget = function computeTarget(point) {
      var x = point.x,
          y = point.y,
          seg = this.xSegment(),
          angle = void 0;

      angle = (seg.max - x) / (seg.max - seg.min) * Math.PI;
      // angle = Math.acos(x/Math.sqrt(x*x+y*y));
      return Math.max(this.dragAngle, Math.min(Math.PI - this.dragAngle, angle));
    };

    Book.prototype.onPickCallback = function onPickCallback(object) {
      var res = false;
      var block = object.object.userData.self,
          p = _extends({}, object.uv),
          i = object.face.materialIndex;
      if (i < 2) {
        p.x = i === 0 ? p.x : 1 - p.x;
        if (block.cornerTarget.testIntersection(null, p) && block.physicId) {
          if (this.hoverInfo) {
            this.clearHoverInfo();
          }
          block.force = _SheetPhysics2.default.dragForceClb;
          block.cornerForce = _SheetPhysics2.default.getDragCornerForceClb(this.computeTarget(object.point));
          this.dragInfo = {
            object: object,
            block: block
          };
          res = true;
          this.pageManager.turnOffEvents();
        }
      }
      return res;
    };

    Book.prototype.onDragCallback = function onDragCallback(point) {
      var block = this.dragInfo.block,
          p = block.getProps();
      block.force = _SheetPhysics2.default.dragForceClb;
      block.cornerForce = _SheetPhysics2.default.getDragCornerForceClb(this.computeTarget(point));
      return true;
    };

    Book.prototype.onReleaseCallback = function onReleaseCallback() {
      delete this.dragInfo.block.force;
      delete this.dragInfo.block.cornerForce;
      delete this.dragInfo;
      this.pageManager.turnOnEvents();
    };

    Book.prototype.getFlipping = function getFlipping(i) {
      return i ? this.getLeftFlipping() : this.getRightFlipping();
    };

    Book.prototype.flip = function flip(i) {
      var size = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;

      return i ? this.flipLeft(size) : this.flipRight(size);
    };

    Book.prototype.enableMouse = function enableMouse(enable) {
      this.mouseController = enable;
    };

    Book.prototype.cornerCallback = function cornerCallback(e, data) {
      var _this4 = this;

      if (this.mouseController) {
        (function () {
          var _data$data = data.data,
              i = _data$data.i,
              n = _data$data.n;

          if (e.type === 'mouseover') {
            if (_this4.hoverInfo && _this4.hoverInfo.pendings !== undefined) {
              ++_this4.hoverInfo.pendings;
            } else {
              if (_this4.hoverInfo) {
                console.warn('Wrong state: element is already hover');
                if (_this4.hoverInfo.n !== n) {
                  _this4.clearHoverInfo();
                }
              }
              if (!_this4.hoverInfo && !_this4.dragInfo) {
                (function () {
                  var res = Promise.resolve(undefined);
                  var hoverAngle = 0.02,
                      hover = _this4.getBlockByPage(n),
                      possible = _this4.getFlipping(i);
                  if (n > 1 && n < 2 * (_this4.p.sheets + 1) && hover.physicId && (hover.angle < hoverAngle || hover.angle > Math.PI - hoverAngle)) {
                    res = Promise.resolve(hover);
                  } else if (hover === possible) {
                    var sheetBlocks = [_this4.leftCover].concat(_this4.sheetBlocks, [_this4.rightCover]);
                    var j = sheetBlocks.indexOf(hover),
                        nextBlock = ~j ? sheetBlocks[j + 2 * i - 1] : undefined;
                    if (!nextBlock || !nextBlock.physicId || nextBlock.angle > hoverAngle && nextBlock.angle < Math.PI - hoverAngle) {
                      res = _this4.flip(i, 1).then(function (block) {
                        if (!block) {
                          delete _this4.hoverInfo;
                        } else {
                          _this4.sheetPhysics.setParametr(block.physicId, 'velocity', 0);
                        }
                        return block;
                      });
                      _this4.hoverInfo = {
                        pendings: 1
                      };
                    }
                  }
                  res.then(function (block) {
                    if (_this4.hoverInfo && _this4.hoverInfo.pendings < 1) {
                      block = undefined;
                      delete _this4.hoverInfo;
                    }
                    if (block) {
                      _this4.pageManager.turnOffEvents();
                      var p = block.getProps();
                      block.force = _this4.sheetPhysics.getTargetForceClb(p.mass * block.getSize(), i ? Math.PI - hoverAngle : hoverAngle);
                      block.cornerForce = function () {
                        return (i ? -1 : 1) * _SheetPhysics2.default.hoverCornerForceClb();
                      };
                      _this4.sheetPhysics.setParametr(block.physicId, 'angle', i ? Math.PI - 0.5 * hoverAngle : 0.5 * hoverAngle);
                      _this4.hoverInfo = {
                        n: n,
                        block: block
                      };
                      _this4.update(1 / 30);
                    }
                  });
                })();
              }
            }
          } else if (_this4.hoverInfo && e.type === 'mouseout') {
            if (_this4.hoverInfo.pendings !== undefined) {
              --_this4.hoverInfo.pendings;
            } else if (n === _this4.hoverInfo.n) {
              _this4.clearHoverInfo();
            }
          } else if (e.type === 'mousedown') {
            _this4.cornerClickData = {
              x: e.pageX,
              y: e.pageY
            };
          } else if (e.type === 'click') {
            if (Math.sqrt(Math.pow(_this4.cornerClickData.x - e.pageX, 2) + Math.pow(_this4.cornerClickData.y - e.pageY, 2)) < 5) {
              var hover = _this4.getBlockByPage(n);
              if (hover.physicId) {
                var id = hover.physicId,
                    props = hover.getProps();
                _this4.sheetPhysics.setParametr(id, 'velocity', (i ? -1 : 1) * props.startVelocity);
              }
            }
            delete _this4.cornerClickData;
          }
        })();
      }
    };

    Book.prototype.addSheetBlock = function addSheetBlock(p, block) {
      this.sheetBlocks.splice(p, 0, block);
      this.subscribeSheetBlock(block, 2);
      this.threeSheetBlocks.add(block.three);
    };

    Book.prototype.subscribeSheetBlock = function subscribeSheetBlock(block, offset) {
      var _this5 = this;

      var eventConverter = new _CustomEventConverter2.default(this.visual.wnd, this.visual.doc, _CircleTarget2.default.test),
          r = 0.15,
          target = new _CircleTarget2.default(1 - 0.5 * r, 0.5 * r, r);
      target.block = block;
      target.callback = this.cornerCallback.bind(this);
      eventConverter.addCustom(target);
      block.cornerTarget = target;
      block.three.userData.mouseCallback = function (e, data) {
        var i = data.face.materialIndex;
        if (i < 2) {
          var n = i === 0 ? offset + 2 * block.p.first : offset + 2 * block.p.last - 1;
          eventConverter.convert(e, { x: i === 0 ? data.uv.x : 1 - data.uv.x, y: data.uv.y, i: i, n: n });
          _this5.pageManager.transferEventToTexture(n, e, data);
        }
      };
      block.three.userData.touchCallback = function (e, data) {
        var i = data.face.materialIndex;
        if (i < 2) {
          var n = i === 0 ? offset + 2 * block.p.first : offset + 2 * block.p.last - 1;
          _this5.pageManager.transferEventToTexture(n, e, data);
        }
      };
      this.visual.drag.addThree(block.three);
      this.visual.mouseEvents.addThree(block.three);
      this.visual.touchEvents.addThree(block.three);
    };

    Book.prototype.removeSheetBlock = function removeSheetBlock(block) {
      this.visual.mouseEvents.removeThree(block.three);
      this.visual.touchEvents.removeThree(block.three);
      this.visual.drag.removeThree(block.three);
      this.threeSheetBlocks.remove(block.three);
      block.dispose();
    };

    Book.prototype.removeSheetBlocks = function removeSheetBlocks(first, size) {
      var blocks = this.sheetBlocks.splice(first, size);
      for (var _iterator4 = blocks, _isArray4 = Array.isArray(_iterator4), _i4 = 0, _iterator4 = _isArray4 ? _iterator4 : _iterator4[Symbol.iterator]();;) {
        var _ref4;

        if (_isArray4) {
          if (_i4 >= _iterator4.length) break;
          _ref4 = _iterator4[_i4++];
        } else {
          _i4 = _iterator4.next();
          if (_i4.done) break;
          _ref4 = _i4.value;
        }

        var block = _ref4;

        this.removeSheetBlock(block);
      }
    };

    Book.prototype.setTexture = function setTexture(material, n) {
      this.pageManager.setTexture(material, n);
    };

    Book.prototype.setPageTexture = function setPageTexture(material, n) {
      this.setTexture(material, n + 2);
    };

    Book.prototype.setLeftCoverTexture = function setLeftCoverTexture(material, n) {
      this.setTexture(material, n);
    };

    Book.prototype.setRightCoverTexture = function setRightCoverTexture(material, n) {
      this.setTexture(material, n + 2 * (this.p.sheets + 1));
    };

    Book.finishAnimationClb = function finishAnimationClb(angle) {
      this.block.set(this.book.getClosedBlockAngle(angle).closedAngle, 'closed', 0);
      var i = this.book.sheetBlocks.indexOf(this.block);
      if (~i) {
        if (angle === 0) {
          this.book.mergeSheetBlocks(i, this.book.sheetBlocks.length - i);
        } else {
          this.book.mergeSheetBlocks(0, i + 1);
        }
      }
    };

    Book.prototype.calcBlockForce = function calcBlockForce(block, object, angle, velocity, cornerHeight) {
      return block.force ? block.force(object, angle, velocity, cornerHeight) : 0;
    };

    Book.prototype.calcBlockCornerForce = function calcBlockCornerForce(block, object, angle, velocity, cornerHeight) {
      return block.cornerForce ? block.cornerForce(object, angle, velocity, cornerHeight) : 0;
    };

    Book.prototype.notifyBeforeAnimation = function notifyBeforeAnimation() {
      var res = void 0;
      if (this.animationNotification) {
        res = Promise.reject();
      } else {
        this.animationNotification = true;
        this.dispatchEvent({
          type: 'beforeAnimation'
        });
        res = this.layerManager.hide();
      }
      return res;
    };

    Book.prototype.notifyAfterAnimation = function notifyAfterAnimation() {
      if (this.animationNotification) {
        delete this.animationNotification;
        this.layerManager.show();
        this.dispatchEvent({
          type: 'afterAnimation'
        });
      }
    };

    Book.prototype.connectPhysics = function connectPhysics(block, mass, angle, velocity, flexibility, coverHeight, simulateClb, removeClb, progressClb) {
      var _this6 = this;

      var type = function type() {
        return _this6.hoverInfo ? 'hover' : _this6.dragInfo ? 'drag' : 'free';
      },
          res = this.sheetPhysics.getSize() ? Promise.resolve() : this.notifyBeforeAnimation();
      return res.then(function () {
        block.physicId = _this6.sheetPhysics.addObject(mass, angle, velocity, flexibility, coverHeight, function (angl, ch) {
          simulateClb(angl, ch);
          progressClb(block, Math.abs(angle - angl) / Math.PI, 'process', type());
        }, function (angl, ch) {
          removeClb(angl, ch);
          delete block.physicId;
          progressClb(block, Math.abs(angle - angl) / Math.PI, 'finish', type());
          Promise.resolve().then(function () {
            if (!_this6.sheetPhysics.getSize()) {
              _this6.notifyAfterAnimation();
            }
          });
        }, function (object, angle, velocity, cornerHeight) {
          return _this6.calcBlockForce(block, object, angle, velocity, cornerHeight);
        }, function (object, angle, velocity, cornerHeight) {
          return _this6.calcBlockCornerForce(block, object, angle, velocity, cornerHeight);
        });
        progressClb(block, 0, 'init', type());
        return block;
      }).catch(function () {
        return undefined;
      });
    };

    Book.prototype.update = function update(dt) {
      var _this7 = this;

      this.lastMousePos.t += dt;
      if (this.isProcessing() && this.lastMousePos.pageX !== undefined && this.lastMousePos.t - (this.lastMousePos.lastT || 0) > 0.25 && !this.hoverInfo && !this.dragInfo) {
        this.lastMousePos.lastT = this.lastMousePos.t;
        Promise.resolve().then(function () {
          (0, _libs.$)(_this7.visual.element).trigger(_libs.$.Event('mousemove', _this7.lastMousePos));
        });
      }
      this.sheetPhysics.simulate(dt);
    };

    Book.prototype.splitSheetBlock = function splitSheetBlock(i, leftSize) {
      var block = this.sheetBlocks[i];
      if (block && leftSize < block.getSize()) {
        var newBlock = new _SheetBlock2.default(this.visual, _extends({}, this.p, { setTexture: this.setPageTexture.bind(this) }), block.p.first, block.p.first + leftSize, block.angle, block.state);
        block.set(block.angle, block.state, block.corner.height, block.p.first + leftSize, block.p.last);
        this.addSheetBlock(i, newBlock);
        return [newBlock, block];
      }
    };

    Book.prototype.mergeSheetBlocks = function mergeSheetBlocks(first, size) {
      if (first < this.sheetBlocks.length) {
        size = Math.min(this.sheetBlocks.length - first, size);
        var firstBlock = this.sheetBlocks[first],
            lastBlock = this.sheetBlocks[first + size - 1];
        firstBlock.set(firstBlock.angle, firstBlock.state, firstBlock.corner.height, firstBlock.p.first, lastBlock.p.last);
        this.removeSheetBlocks(first + 1, size - 1);
      }
    };

    Book.prototype.setSheetBlocks = function setSheetBlocks(angle, state) {
      if (state === 'closed') {
        this.closedAngle = angle;
      }
      this.sheetBlocks.forEach(function (s) {
        if (!s.physicId) {
          s.set(angle, state);
        }
      });
    };

    Book.prototype.set = function set(angle) {
      var height = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

      this.angle = angle;
      var PI = Math.PI;
      if (angle < PI / 4) {
        this.binder.set(0);

        this.binder.setLeft(-PI / 2 + 2 * angle);
        this.leftCover.set(PI / 2, 'opened', height);

        this.setSheetBlocks(0, 'closed');

        this.binder.setRight(0);
        this.rightCover.set(0, 'closed', 0);
      } else if (angle < 2 * PI / 4) {
        var a = 2 * (angle - PI / 4);
        this.binder.set(a);

        this.binder.setLeft(-a);
        this.leftCover.set(PI / 2 + a, 'opened', height);

        this.setSheetBlocks(a, 'closed');

        this.binder.setRight(-a);
        this.rightCover.set(a, 'closed', 0);
      } else if (angle < 3 * PI / 4) {
        var _a = 2 * (angle - PI / 2);
        this.binder.set(PI / 2);

        this.binder.setLeft(-PI / 2);
        this.leftCover.set(PI, 'opened', 0);

        this.binder.setRight(-PI / 2);
        this.rightCover.set(_a, 'opened', height);
      } else if (angle < 4 * PI / 4) {
        var _a2 = 2 * (angle - 3 * PI / 4) + PI / 2;
        this.binder.set(_a2);

        this.binder.setLeft(-_a2);
        this.leftCover.set(_a2, 'closed', 0);

        this.setSheetBlocks(_a2, 'closed');

        this.binder.setRight(-PI / 2);
        this.rightCover.set(PI / 2, 'opened', height);
      } else if (angle < 5 * PI / 4) {
        this.binder.set(PI);

        this.binder.setLeft(-PI);
        this.leftCover.set(PI, 'closed', 0);

        this.setSheetBlocks(PI, 'closed');

        this.binder.setRight(-PI / 2 - 2 * (angle - PI));
        this.rightCover.set(PI / 2, 'opened', height);
      } else if (angle < 6 * PI / 4) {
        var _a3 = 2 * (angle - 5 * PI / 4);
        this.binder.set(PI - _a3);

        this.binder.setLeft(-PI + _a3);
        this.leftCover.set(PI - _a3, 'closed', 0);

        this.setSheetBlocks(PI - _a3, 'closed');

        this.binder.setRight(-PI + _a3);
        this.rightCover.set(PI / 2 - _a3, 'opened', height);
      } else if (angle < 7 * PI / 4) {
        var _a4 = 2 * (angle - 6 * PI / 4);
        this.binder.set(PI / 2);

        this.binder.setLeft(-PI / 2);
        this.leftCover.set(PI - _a4, 'opened', height);

        this.binder.setRight(-PI / 2);
        this.rightCover.set(0, 'opened', 0);
      } else if (angle < 8 * PI / 4) {
        var _a5 = 2 * (angle - 7 * PI / 4);
        this.binder.set(PI / 2 - _a5);

        this.binder.setLeft(-PI / 2);
        this.leftCover.set(PI / 2, 'opened', height);

        this.setSheetBlocks(PI / 2 - _a5, 'closed');

        this.binder.setRight(-PI / 2 + _a5);
        this.rightCover.set(PI / 2 - _a5, 'closed', 0);
      }
    };

    Book.createSideTexture = function createSideTexture(color) {
      var jC = (0, _libs.$)('<canvas width="8" height="8"></canvas>');
      var ctx = jC[0].getContext('2d');
      ctx.beginPath();
      ctx.fillStyle = _GraphUtils2.default.color2Rgba(color, 1);
      ctx.rect(0, 0, 8, 7);
      ctx.fill();
      ctx.beginPath();
      ctx.fillStyle = _GraphUtils2.default.color2Rgba(_GraphUtils2.default.inverseColor(color, 0.5), 1);
      ctx.rect(0, 7, 8, 1);
      ctx.fill();
      return jC[0];
    };

    Book.prepareProps = function prepareProps(props) {
      return Book.calcProps(Book.mergeProps((0, _book.props)(), props));
    };

    Book.mergeProps = function mergeProps(first, second) {
      second = second || {};
      return _extends({}, first, second, {
        sheet: _extends({}, first.sheet, second.sheet),
        cover: _extends({}, first.cover, second.cover),
        page: _extends({}, first.page, second.page),
        cssLayerProps: _extends({}, first.cssLayerProps, second.cssLayerProps)
      });
    };

    Book.calcProps = function calcProps(props) {
      var p = _extends({}, props, {
        sheet: _extends({}, props.sheet),
        cover: _extends({}, props.sheet, props.cover),
        page: _extends({}, props.sheet, props.page),
        cssLayerProps: _extends({}, props.cssLayerProps, {
          $: _libs.$
        })
      }),
          scale = 10,
          height = scale * p.height,
          width = scale * p.width,
          flipProgressClb = function flipProgressClb() {
        return undefined;
      },
          sheet = {
        sideTexture: p.sheet.sideTexture || Book.createSideTexture(p.sheet.color)
      },
          cover = _extends({}, sheet, p.cover, {
        depth: scale * p.cover.depth,
        width: width,
        height: height,
        padding: scale * p.cover.padding
      }),
          page = _extends({}, sheet, p.page, {
        depth: scale * p.page.depth,
        width: cover.width - cover.padding,
        height: cover.height - 2 * cover.padding
      }),
          marker = {
        use: false,
        color: 0XFF0000,
        size: scale * 0.001
      };
      if (cover.color !== sheet.color && !p.cover.sideTexture) {
        cover.sideTexture = Book.createSideTexture(cover.color);
      }
      if (page.color !== sheet.color && !p.page.sideTexture) {
        page.sideTexture = Book.createSideTexture(page.color);
      }
      return _extends({}, p, { scale: scale, height: height, width: width, flipProgressClb: flipProgressClb, cover: cover, page: page, marker: marker });
    };

    return Book;
  }(_libs.THREE.EventDispatcher);

  exports.default = Book;

  /***/
},
/* 27 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _typeof = typeof Symbol === "function" && _typeof2(Symbol.iterator) === "symbol" ? function (obj) {
    return typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
  };

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(1);

  var _Controller2 = __webpack_require__(15);

  var _Controller3 = _interopRequireDefault(_Controller2);

  var _bookController = __webpack_require__(42);

  var _EventsToActions = __webpack_require__(49);

  var _EventsToActions2 = _interopRequireDefault(_EventsToActions);

  var _stats = __webpack_require__(70);

  var _stats2 = _interopRequireDefault(_stats);

  var _Object3DWatcher = __webpack_require__(55);

  var _Object3DWatcher2 = _interopRequireDefault(_Object3DWatcher);

  var _FullScreen = __webpack_require__(50);

  var _FullScreen2 = _interopRequireDefault(_FullScreen);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var BookController = function (_Controller) {
    _inherits(BookController, _Controller);

    function BookController(book, view, props) {
      _classCallCheck(this, BookController);

      var _this = _possibleConstructorReturn(this, _Controller.call(this));

      _this.navigationControls = true;
      _this.book = book;
      _this.visual = book.visual;
      _this.p = BookController.prepareProps(props);
      _this.p.rtl = book.p.rtl;
      _this.devicePixelRatio = _this.visual.wnd.devicePixelRatio || 1;

      _this.orbit = book.visual.getOrbit();
      book.setFlipProgressClb(_this.updateViewIfState.bind(_this));
      _this.view = view;
      _this.bindActions();

      _this.state = {
        smartPan: !_this.actions['cmdSmartPan'].active,
        singlePage: _this.actions['cmdSinglePage'].active || _this.actions['cmdSinglePage'].activeForMobile && _this.devicePixelRatio > 1,
        stats: _this.actions['cmdStats'].active,
        lighting: _this.p.lighting.default,
        activeSide: 1
      };

      _this.boxs = [new _libs.THREE.Box3(), new _libs.THREE.Box3()];
      _this.bookWatcher = new _Object3DWatcher2.default(_this.visual, function () {
        if (_this.state.singlePage) {
          if (_this.state.activeSide) {
            _this.boxs[0].setFromObject(book.rightCover.three);
          } else {
            _this.boxs[0].setFromObject(book.leftCover.three);
          }
        } else {
          _this.boxs[0].setFromObject(book.leftCover.three);
          _this.boxs[1].setFromObject(book.rightCover.three);
          _this.boxs[0].union(_this.boxs[1]);
        }
        return _this.boxs[0];
      });
      _this.bookWatcher.scale = _this.p.scale.default;
      _this.book.setZoom(_this.bookWatcher.scale, _this.state.singlePage);

      _this.Stats = new _stats2.default();
      _this.Stats.domElement.style.position = 'absolute';
      _this.Stats.domElement.style.top = '0px';

      _this.visual.setExtraLighting(_this.state.lighting);
      _this.binds = {
        onScreenModeChanged: _this.onScreenModeChanged.bind(_this),
        stats: _this.Stats.update.bind(_this.Stats),
        onUpdateView: _this.updateView.bind(_this)
      };
      _FullScreen2.default.addEventListener(_this.view.getParentContainer().ownerDocument, _this.binds.onScreenModeChanged);

      _this.cmdSmartPan();

      if (_this.view.templateObject.appLoaded) {
        Promise.resolve().then(_this.view.templateObject.appLoaded);
      }

      _this.book.enableLoadingAnimation(_this.p.loadingAnimation.book);
      if (_this.p.loadingAnimation.skin) {
        _this.initLoadingAnimation();
      }

      _this.book.enableLoadingAnimation(_this.p.loadingAnimation.book);
      _this.book.setAutoResolution(_this.p.autoResolution.enabled, _this.p.autoResolution.coefficient);
      return _this;
    }

    BookController.prototype.dispose = function dispose() {
      _FullScreen2.default.removeEventListener(this.view.getParentContainer().ownerDocument, this.binds.onScreenModeChanged);
      delete this.book;
      delete this.view;
      delete this.visual;
    };

    BookController.prototype.initLoadingAnimation = function initLoadingAnimation() {
      var _this2 = this;

      var handler = function handler() {
        var pages = _this2.book.getTopPages();
        var visible = false;
        for (var _iterator = pages, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
          var _ref;

          if (_isArray) {
            if (_i >= _iterator.length) break;
            _ref = _iterator[_i++];
          } else {
            _i = _iterator.next();
            if (_i.done) break;
            _ref = _i.value;
          }

          var n = _ref;

          var state = _this2.book.getPageState(n);
          visible = state === undefined || state === 'loading';
          if (visible) {
            break;
          }
        }
        _this2.view.setState('widLoading', {
          visible: visible
        });
      };
      this.book.addEventListener('beforeAnimation', handler);
      this.book.addEventListener('afterAnimation', handler);
      this.book.addEventListener('loadPage', handler);
      this.book.addEventListener('loadedPage', handler);
    };

    BookController.prototype.enableNavigation = function enableNavigation(enable) {
      this.navigationControls = enable;
    };

    BookController.prototype.setTocCtrl = function setTocCtrl(tocCtrl) {
      this.tocCtrl = tocCtrl;
      this.tocCtrl.onChange = this.updateView.bind(this);
      this.updateView();
    };

    BookController.prototype.setPrinter = function setPrinter(printer) {
      this.printer = printer;
      this.updateView();
    };

    BookController.prototype.setSounds = function setSounds(sounds) {
      this.sounds = sounds;
      sounds.setEnabled(this.actions['cmdSounds'].active);
      this.updateView();
    };

    BookController.prototype.onScreenModeChanged = function onScreenModeChanged(e) {
      this.updateView();
    };

    BookController.prototype.canZoomIn = function canZoomIn() {
      return !this.state.smartPan || Math.abs(this.bookWatcher.scale - this.p.scale.max) > this.p.eps;
    };

    BookController.prototype.canZoomOut = function canZoomOut() {
      return !this.state.smartPan || Math.abs(this.bookWatcher.scale - this.p.scale.min) > this.p.eps;
    };

    BookController.prototype.canDefaultZoom = function canDefaultZoom() {
      return this.state.smartPan;
    };

    BookController.prototype.setBookZoom = function setBookZoom(scale) {
      var _this3 = this;

      setTimeout(function () {
        if (_this3.bookWatcher.scale === scale) {
          _this3.book.setZoom(scale, _this3.state.singlePage);
        }
      }, 1000);
    };

    BookController.prototype.cmdZoomIn = function cmdZoomIn() {
      if (this.state.smartPan) {
        this.bookWatcher.scale = Math.min(this.p.scale.max, this.bookWatcher.scale + this.p.scale.delta);
        this.setBookZoom(this.bookWatcher.scale);
      } else {
        this.orbit.zoomIn(6.6 * this.p.scale.delta / 0.32);
      }
      this.updateView();
    };

    BookController.prototype.cmdZoomOut = function cmdZoomOut() {
      if (this.state.smartPan) {
        this.bookWatcher.scale = Math.max(this.p.scale.min, this.bookWatcher.scale - this.p.scale.delta);
        this.setBookZoom(this.bookWatcher.scale);
      } else {
        this.orbit.zoomOut(6.6 * this.p.scale.delta / 0.32);
      }
      this.updateView();
    };

    BookController.prototype.cmdDefaultZoom = function cmdDefaultZoom() {
      if (this.state.smartPan) {
        this.bookWatcher.scale = this.p.scale.default;
        this.setBookZoom(this.bookWatcher.scale);
        this.updateView();
      }
    };

    BookController.prototype.cmdToc = function cmdToc() {
      if (this.tocCtrl) {
        this.tocCtrl.togle();
      }
    };

    BookController.prototype.cmdFastBackward = function cmdFastBackward() {
      this.startFlip(this.book.flipLeft(5));
    };

    BookController.prototype.cmdBackward = function cmdBackward() {
      var _this4 = this;

      if (this.state.singlePage) {
        this.state.activeSide = (this.getPage() + 1) % 2;
        if (this.state.activeSide) {
          this.state.activeSide = 0;
          this.updateView();
        } else {
          this.startFlip(this.book.flipLeft(1)).then(function (block) {
            if (block) {
              _this4.state.activeSide = 1;
            }
          });
        }
      } else {
        this.startFlip(this.book.flipLeft(1));
      }
    };

    BookController.prototype.cmdForward = function cmdForward() {
      var _this5 = this;

      if (this.state.singlePage) {
        this.state.activeSide = (this.getPage() + 1) % 2;
        if (!this.state.activeSide) {
          this.state.activeSide = 1;
          this.updateView();
        } else {
          this.startFlip(this.book.flipRight(1)).then(function (block) {
            if (block) {
              _this5.state.activeSide = 0;
            }
          });
        }
      } else {
        this.startFlip(this.book.flipRight(1));
      }
    };

    BookController.prototype.cmdFastForward = function cmdFastForward() {
      this.startFlip(this.book.flipRight(5));
    };

    BookController.prototype.cmdSave = function cmdSave() {
      window.open(this.p.downloadURL, '_blank');
    };

    BookController.prototype.cmdPrint = function cmdPrint() {
      this.printer.print();
    };

    BookController.prototype.cmdFullScreen = function cmdFullScreen() {
      if (!_FullScreen2.default.activated()) {
        _FullScreen2.default.request(this.view.getParentContainer());
      } else {
        _FullScreen2.default.cancel();
      }
    };

    BookController.prototype.cmdSmartPan = function cmdSmartPan() {
      this.state.smartPan = !this.state.smartPan;
      if (this.state.smartPan) {
        this.orbit.minAzimuthAngle = 0;
        this.orbit.maxAzimuthAngle = 0;
        this.orbit.minPolarAngle = 0;
        this.orbit.maxPolarAngle = Math.PI / 4;
        this.bookWatcher.enabled = true;
      } else {
        this.orbit.minAzimuthAngle = -Infinity;
        this.orbit.maxAzimuthAngle = Infinity;
        this.orbit.minPolarAngle = 0;
        this.orbit.maxPolarAngle = Math.PI;
        this.bookWatcher.enabled = false;
      }
      this.updateView();
    };

    BookController.prototype.cmdSinglePage = function cmdSinglePage() {
      this.state.singlePage = !this.state.singlePage;
      this.setBookZoom(this.bookWatcher.scale);
      this.updateView();
    };

    BookController.prototype.cmdSounds = function cmdSounds() {
      if (this.sounds) {
        this.sounds.togle();
      }
      this.updateView();
    };

    BookController.prototype.cmdStats = function cmdStats() {
      this.state.stats = !this.state.stats;
      if (this.state.stats) {
        (0, _libs.$)(this.view.getContainer()).append(this.Stats.domElement);
        this.visual.addRenderCallback(this.binds.stats);
      } else {
        (0, _libs.$)(this.view.getContainer()).find(this.Stats.domElement).remove();
        this.visual.removeRenderCallback(this.binds.stats);
      }
      this.updateView();
    };

    BookController.prototype.cmdLightingUp = function cmdLightingUp() {
      this.state.lighting = Math.min(this.state.lighting + this.p.lighting.delta, this.p.lighting.max);
      this.visual.setExtraLighting(this.state.lighting);
      this.updateView();
    };

    BookController.prototype.cmdLightingDown = function cmdLightingDown() {
      this.state.lighting = Math.max(this.state.lighting - this.p.lighting.delta, this.p.lighting.min);
      this.visual.setExtraLighting(this.state.lighting);
      this.updateView();
    };

    BookController.prototype.goToPage = function goToPage(page) {
      var _this6 = this;

      if (this.p.rtl) {
        page = this.book.getPages() - 1 - page;
      }
      var pageNum = Math.max(Math.min(page, this.book.getPages() - 1), 0);
      this.state.activeSide = (pageNum + 1) % 2;
      var target = Math.max(Math.min(page - 1 + page % 2, this.book.getPages() - 1), 0),
          current = this.book.getPage(),
          flips = [],
          covs = 0;;
      if (target != current) {
        if (current === 0) {
          flips.push(1);
          current += 1;
          ++covs;
        } else if (current === this.book.getPages() - 1) {
          flips.push(-1);
          current -= 2;
          ++covs;
        }
        var cv = 0;
        if (target === 0) {
          cv = -1;
          target += 1;
          ++covs;
        } else if (target === this.book.getPages() - 1) {
          cv = 1;
          target -= 2;
          ++covs;
        }
        if (target - current) {
          flips.push(Math.ceil((target - current) / 2));
        }
        if (cv) {
          flips.push(cv);
        }
      }

      var setClb = function setClb(fl, time, clb) {
        setTimeout(function () {
          if (fl < 0) {
            _this6.startFlip(_this6.book.flipLeft(-fl, clb));
          } else {
            _this6.startFlip(_this6.book.flipRight(fl, clb));
          }
        }, time);
      };

      if (covs === 2) {
        setClb(flips[0], 0, function (block, progress, state) {
          if (state == 'finish' && progress == 1) {
            setClb(flips[flips.length - 1], 0);
          }
        });
        setClb(flips[1], 500);
      } else {
        var time = 0;
        for (var _iterator2 = flips, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
          var _ref2;

          if (_isArray2) {
            if (_i2 >= _iterator2.length) break;
            _ref2 = _iterator2[_i2++];
          } else {
            _i2 = _iterator2.next();
            if (_i2.done) break;
            _ref2 = _i2.value;
          }

          var fl = _ref2;

          setClb(fl, time);
          time += 250;
        }
      }
    };

    BookController.prototype.startFlip = function startFlip(flipRes) {
      var _this7 = this;

      return flipRes ? flipRes.then(function (block) {
        if (block) {
          _this7.dispatchAsync({
            type: 'startFlip'
          });
        }
        return block;
      }) : Promise.resolve(undefined);
    };

    BookController.prototype.endFlip = function endFlip(block) {
      this.dispatchAsync({
        type: 'endFlip'
      });
      return block;
    };

    BookController.prototype.getPage = function getPage() {
      var page = this.book.getPage();
      return page ? Math.min(this.book.getPage() + this.state.activeSide, this.book.getPages() - 1) : 0;
    };

    BookController.prototype.getPageForGUI = function getPageForGUI() {
      var n = (this.state.singlePage ? this.getPage() : this.book.getPage()) + 1;
      if (this.p.rtl) {
        n = this.book.getPages() - n + 1;
      }
      return n;
    };

    BookController.prototype.inpPage = function inpPage(e, data) {
      this.goToPage(data - 1);
    };

    BookController.prototype.updateViewIfState = function updateViewIfState(block, progress, state, type) {
      if (state === 'init' || state === 'finish') {
        setTimeout(this.updateView.bind(this), 100);
      }
      if (state === 'finish') {
        this.endFlip(block);
      }
    };

    BookController.prototype.updateViewState = function updateViewState() {
      this.viewState = {
        'cmdZoomIn': {
          enable: this.canZoomIn(),
          visible: this.actions['cmdZoomIn'].enabled,
          active: false
        },
        'cmdZoomOut': {
          enable: this.canZoomOut(),
          visible: this.actions['cmdZoomOut'].enabled,
          active: false
        },
        'cmdDefaultZoom': {
          enable: this.canDefaultZoom(),
          visible: this.actions['cmdDefaultZoom'].enabled,
          active: this.canDefaultZoom() && Math.abs(this.bookWatcher.scale - this.p.scale.default) < this.p.eps
        },
        'cmdToc': {
          enable: !!this.tocCtrl,
          visible: this.actions['cmdToc'].enabled && this.tocCtrl,
          active: this.tocCtrl && this.tocCtrl.visible
        },
        'inpPages': {
          visible: true,
          value: this.book.getPages()
        },
        'inpPage': {
          visible: true,
          enable: !this.book.isProcessing() && this.navigationControls,
          value: this.getPageForGUI()
        },
        'cmdSave': {
          enable: true,
          visible: this.actions['cmdSave'].enabled && !!this.p.downloadURL,
          active: false
        },
        'cmdPrint': {
          enable: true,
          visible: this.actions['cmdPrint'].enabled && !!this.printer,
          active: false
        },
        'cmdFullScreen': {
          enable: _FullScreen2.default.available(),
          visible: this.actions['cmdFullScreen'].enabled,
          active: _FullScreen2.default.available() && _FullScreen2.default.activated()
        },
        'widSettings': {
          enable: true,
          visible: this.actions['widSettings'].enabled,
          active: false
        },
        'cmdSmartPan': {
          enable: true,
          visible: this.actions['cmdSmartPan'].enabled,
          active: this.state.smartPan
        },
        'cmdSinglePage': {
          enable: true,
          visible: this.actions['cmdSinglePage'].enabled,
          active: this.state.singlePage
        },
        'cmdSounds': {
          enable: true,
          visible: this.actions['cmdSounds'].enabled && !!this.sounds,
          active: !!this.sounds && this.sounds.enabled
        },
        'cmdStats': {
          enable: true,
          visible: this.actions['cmdStats'].enabled,
          active: this.state.stats
        },
        'cmdLightingUp': {
          enable: Math.abs(this.state.lighting - this.p.lighting.max) > this.p.eps,
          visible: this.actions['cmdLightingUp'].enabled,
          active: false
        },
        'cmdLightingDown': {
          enable: Math.abs(this.state.lighting - this.p.lighting.min) > this.p.eps,
          visible: this.actions['cmdLightingDown'].enabled,
          active: false
        }
      };

      var left = this.book.getLeftFlipping(),
          right = this.book.getRightFlipping();
      var flippersEnable = {
        cmdFastBackward: !!left && this.navigationControls,
        cmdBackward: !!left && this.navigationControls,
        cmdForward: !!right && this.navigationControls,
        cmdFastForward: !!right && this.navigationControls
      };
      for (var _iterator3 = Object.keys(flippersEnable), _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
        var _ref3;

        if (_isArray3) {
          if (_i3 >= _iterator3.length) break;
          _ref3 = _iterator3[_i3++];
        } else {
          _i3 = _iterator3.next();
          if (_i3.done) break;
          _ref3 = _i3.value;
        }

        var name = _ref3;

        this.viewState[name] = {
          enable: flippersEnable[name],
          visible: this.actions[name].enabled,
          active: false
        };
      };
    };

    BookController.prototype.updateView = function updateView() {
      if (this.view) {
        this.updateViewState();
        for (var _iterator4 = Object.keys(this.viewState), _isArray4 = Array.isArray(_iterator4), _i4 = 0, _iterator4 = _isArray4 ? _iterator4 : _iterator4[Symbol.iterator]();;) {
          var _ref4;

          if (_isArray4) {
            if (_i4 >= _iterator4.length) break;
            _ref4 = _iterator4[_i4++];
          } else {
            _i4 = _iterator4.next();
            if (_i4.done) break;
            _ref4 = _i4.value;
          }

          var name = _ref4;

          this.view.setState(name, this.viewState[name]);
        }
      }
    };

    BookController.prototype.getActions = function getActions() {
      var _this8 = this;

      var isSwipping = function isSwipping(name) {
        return _this8.actions.touchCmdSwipe.enabled && _this8.actions.touchCmdSwipe.code === _this8.actions[name].code && _this8.state.smartPan && _this8.bookWatcher.scale <= 1;
      },
          cmds = {};

      var _loop = function _loop(name) {
        if (name.indexOf('cmd') === 0) {
          cmds[name] = {
            activate: function activate() {
              if (_this8.viewState && _this8.viewState[name].enable) {
                _this8[name].apply(_this8, arguments);
              }
            }
          };
        }
      };

      for (var name in this) {
        _loop(name);
      }

      return _extends({}, cmds, {
        cmdPanLeft: {
          activate: function activate(e) {
            return _this8.orbit.actions.pan(e, {
              state: 'move',
              dx: -_this8.p.pan.speed,
              dy: 0
            });
          }
        },
        cmdPanRight: {
          activate: function activate(e) {
            return _this8.orbit.actions.pan(e, {
              state: 'move',
              dx: _this8.p.pan.speed,
              dy: 0
            });
          }
        },
        cmdPanUp: {
          activate: function activate(e) {
            return _this8.orbit.actions.pan(e, {
              state: 'move',
              dx: 0,
              dy: -_this8.p.pan.speed
            });
          }
        },
        cmdPanDown: {
          activate: function activate(e) {
            return _this8.orbit.actions.pan(e, {
              state: 'move',
              dx: 0,
              dy: _this8.p.pan.speed
            });
          }
        },
        mouseCmdRotate: {
          activate: this.orbit.actions.rotate
        },
        mouseCmdDragZoom: {
          activate: function activate(e, data) {
            if (data.dy > 0) {
              _this8.cmdZoomOut();
            } else if (data.dy < 0) {
              _this8.cmdZoomIn();
            }
          }
        },
        mouseCmdPan: {
          activate: this.orbit.actions.pan
        },
        mouseCmdWheelZoom: {
          activate: function activate(e) {
            e.preventDefault();
            if (e.deltaY < 0) {
              _this8.cmdZoomOut();
            } else if (e.deltaY > 0) {
              _this8.cmdZoomIn();
            }
          }
        },
        touchCmdRotate: {
          activate: function activate(e, data) {
            if (!isSwipping('touchCmdRotate')) {
              e.preventDefault();
              _this8.orbit.actions.rotate(e, data);
            }
          }
        },
        touchCmdZoom: {
          activate: function activate(e, data) {
            if (!isSwipping('touchCmdZoom')) {
              e.preventDefault();
              if (data.dy > 0) {
                _this8.cmdZoomOut();
              } else if (data.dy < 0) {
                _this8.cmdZoomIn();
              }
            }
          }
        },
        touchCmdPan: {
          activate: function activate(e, data) {
            if (!isSwipping('touchCmdPan')) {
              e.preventDefault();
              _this8.orbit.actions.pan(e, data);
            }
          }
        },
        touchCmdSwipe: {
          activate: function activate(e, data) {
            if (isSwipping('touchCmdSwipe')) {
              e.preventDefault();
              if (data.state === 'start') {
                var touch = (e.touches || e.originalEvent.touches)[_this8.actions.touchCmdSwipe.code - 1];
                _this8.swipeData = {
                  handled: false,
                  x0: touch.pageX,
                  y0: touch.pageY,
                  x: touch.pageX,
                  y: touch.pageY
                };
              } else if (data.state === 'move') {
                if (!_this8.swipeData.handled) {
                  _this8.swipeData = _extends({}, _this8.swipeData, {
                    x: _this8.swipeData.x + data.dx,
                    y: _this8.swipeData.y + data.dy
                  });
                  if (Math.abs(_this8.swipeData.x0 - _this8.swipeData.x) > 100) {
                    _this8.swipeData.x0 > _this8.swipeData.x ? _this8.cmdForward() : _this8.cmdBackward();
                    _this8.swipeData.handled = true;
                  }
                }
              } else {
                delete _this8.swipeData;
              }
            }
          }
        },
        widSettings: {
          activate: function activate() {
            return undefined;
          }
        }
      });
    };

    BookController.prototype.bindActions = function bindActions() {
      this.eToA = new _EventsToActions2.default((0, _libs.$)(this.visual.element));
      this.eToA.addAction(function (e) {
        return e.preventDefault();
      }, 'contextmenu', _EventsToActions2.default.mouseButtons.Right, 0);

      this.actions = this.getActions();
      for (var _iterator5 = Object.keys(this.actions), _isArray5 = Array.isArray(_iterator5), _i5 = 0, _iterator5 = _isArray5 ? _iterator5 : _iterator5[Symbol.iterator]();;) {
        var _ref5;

        if (_isArray5) {
          if (_i5 >= _iterator5.length) break;
          _ref5 = _iterator5[_i5++];
        } else {
          _i5 = _iterator5.next();
          if (_i5.done) break;
          _ref5 = _i5.value;
        }

        var name = _ref5;

        var action = _extends({}, this.actions[name], this.p.actions[name]);
        this.actions[name] = action;
        if (action.enabled) {
          var flags = action.flags || 0;
          if (action.type) {
            this.eToA.addAction(action.activate, action.type, action.code, flags);
          } else if (action.code !== undefined) {
            this.eToA.addAction(action.activate, 'keydown', action.code, flags);
          }
        }
      }
    };

    BookController.prepareProps = function prepareProps(props) {
      return BookController.calcProps(BookController.mergeProps((0, _bookController.props)(), props));
    };

    BookController.setActions = function setActions(props, actions) {
      for (var _iterator6 = Object.keys(actions || {}), _isArray6 = Array.isArray(_iterator6), _i6 = 0, _iterator6 = _isArray6 ? _iterator6 : _iterator6[Symbol.iterator]();;) {
        var _ref6;

        if (_isArray6) {
          if (_i6 >= _iterator6.length) break;
          _ref6 = _iterator6[_i6++];
        } else {
          _i6 = _iterator6.next();
          if (_i6.done) break;
          _ref6 = _i6.value;
        }

        var name = _ref6;

        props.actions[name] = _extends({}, props.actions[name], actions[name]);
      }
    };

    BookController.mergeProps = function mergeProps(first, second) {
      second = second || {};
      function merge(first, second) {
        second = second || {};
        var props = _extends({}, first, second);
        for (var _iterator7 = Object.keys(first), _isArray7 = Array.isArray(_iterator7), _i7 = 0, _iterator7 = _isArray7 ? _iterator7 : _iterator7[Symbol.iterator]();;) {
          var _ref7;

          if (_isArray7) {
            if (_i7 >= _iterator7.length) break;
            _ref7 = _iterator7[_i7++];
          } else {
            _i7 = _iterator7.next();
            if (_i7.done) break;
            _ref7 = _i7.value;
          }

          var name = _ref7;

          if (_typeof(first[name]) === 'object') {
            props[name] = merge(first[name], second[name]);
          }
        }
        return props;
      }
      var props = merge(first, second);
      BookController.setActions(props, first.actions);
      BookController.setActions(props, second.actions);
      return props;
    };

    BookController.calcProps = function calcProps(props) {
      props.scale.delta = (props.scale.max - props.scale.min) / props.scale.levels;
      props.lighting.delta = (props.lighting.max - props.lighting.min) / props.lighting.levels;
      return props;
    };

    return BookController;
  }(_Controller3.default);

  exports.default = BookController;

  /***/
},
/* 28 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(1);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var BookPrinter = function () {
    function BookPrinter(context, book, styleSheet) {
      _classCallCheck(this, BookPrinter);

      this.book = book;
      this.styleSheet = styleSheet;
      this.wnd = context.wnd;
      this.doc = context.doc;
      this.pageCallback = book.getPageCallback();
      var test = this.pageCallback(0);
      this.type = test.type;
      if (this.type === 'pdf') {
        this.pdfSrc = test.src.src;
      }
    }

    BookPrinter.prototype.cancel = function cancel() {
      this.canceled = true;
    };

    BookPrinter.prototype.dispose = function dispose() {
      if (this.frame) {
        this.frame.remove();
        delete this.frame;
      }
    };

    BookPrinter.prototype.print = function print() {
      var _this = this;

      delete this.canceled;
      if (this.type === 'pdf') {
        (function () {
          var printWnd = void 0,
              callManually = false;
          if (_this.useIFrame()) {
            callManually = !!_this.frame;
            if (!_this.frame) {
              _this.frame = (0, _libs.$)('<iframe src="' + _this.pdfSrc + '" style="display: none;"></iframe>').appendTo(_this.doc.body);
            }
            printWnd = _this.frame[0].contentWindow;
          } else {
            printWnd = _this.wnd.open(_this.pdfSrc);
          }
          if (callManually) {
            printWnd.print();
          } else {
            (0, _libs.$)(printWnd).on('load', function () {
              try {
                printWnd.print();
              } catch (e) {
                console.error(e);
              }
            });
          }
        })();
      } else {
        this.renderContent().then(function (content) {
          var printWnd = _this.wnd.open(),
              printDoc = printWnd.document,
              html = '\n            <!DOCTYPE html>\n            <html>\n              <head>\n                <meta charset="utf-8">\n                <title>3D FlipBook - Printing</title>\n                ' + content.head + '\n                <script type="text/javascript">\n                  function printDocument() {\n                    window.print();\n                    window.close();\n                  }\n                  function init() {\n                    setTimeout(printDocument, 100);\n                  }\n                </script>\n              </head>\n              <body onload="init()">\n                ' + content.body + '\n              </body>\n            </html>\n          ';
          printDoc.open();
          printDoc.write(html);
          printDoc.close();
        }).catch(function (e) {
          return console.warn('3D FlipBook - Printing was canceled');
        });
      }
    };

    BookPrinter.prototype.progress = function progress(v) {
      if (this.canceled) {
        throw 'Cancel Printing';
      }
      if (this.onProgress) {
        this.onProgress(Math.floor(v * 100));
      }
    };

    BookPrinter.prototype.renderContent = function renderContent() {
      var _this2 = this;

      var pages = this.book.getPages(),
          head = new Set(),
          body = [];
      var done = Promise.resolve();

      var _loop = function _loop(page) {
        var info = _this2.pageCallback(page);
        if (info.type === 'image') {
          done = done.then(function () {
            _this2.progress(page / pages);
            return _this2.renderImage(head, body, info.src);
          });
        } else if (info.type === 'html') {
          done = done.then(function () {
            _this2.progress(page / pages);
            return _this2.renderHtml(head, body, info.src);
          });
        }
      };

      for (var page = 0; page < pages; ++page) {
        _loop(page);
      }
      return done.then(function () {
        _this2.progress(1);
        return { head: _this2.renderHead(head), body: body.join('\n') };
      });
    };

    BookPrinter.wrap = function wrap(content) {
      return '<div class="fb3d-printer-page">' + content + '</div>';
    };

    BookPrinter.prototype.renderImage = function renderImage(head, body, src) {
      body.push(BookPrinter.wrap('<img src="' + src + '" />'));
    };

    BookPrinter.prototype.renderHtml = function renderHtml(head, body, src) {
      return new Promise(function (resolve, reject) {
        _libs.$.get(src, function (html) {
          var links = html.match(/<link.*?>/ig) || [];
          for (var _iterator = links, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
            var _ref;

            if (_isArray) {
              if (_i >= _iterator.length) break;
              _ref = _iterator[_i++];
            } else {
              _i = _iterator.next();
              if (_i.done) break;
              _ref = _i.value;
            }

            var link = _ref;

            if (link.match(/stylesheet/i)) {
              var href = link.match(/href\s*=\s*['"](.*)['"]/i);
              if (href) {
                head.add(href[1]);
              }
            }
          }
          var content = html.match(/<body.*?>([\S\s]*)<\/body>/i);
          if (content) {
            body.push(BookPrinter.wrap(content[1]));
          }
          resolve();
        }).fail(function (e) {
          console.error(e.responseText);
          reject();
        });
      });
    };

    BookPrinter.prototype.renderHead = function renderHead(head) {
      var content = [];
      head.forEach(function (k) {
        return content.push('<link rel="stylesheet" href="' + k + '">');
      });
      content.push(this.styleSheet ? '<link rel="stylesheet" href="' + this.styleSheet + '">' : BookPrinter.defaultStyleSheet());
      return content.join('\n');
    };

    BookPrinter.prototype.useIFrame = function useIFrame() {
      var isChromium = this.wnd.chrome,
          winNav = this.wnd.navigator,
          vendorName = winNav.vendor,
          isIEedge = winNav.userAgent.indexOf("Edge") > -1,
          isIOSChrome = winNav.userAgent.match("CriOS");
      var use = void 0;
      if (isIOSChrome) {
        use = true;
      } else if (isChromium && vendorName === 'Google Inc.' && !isIEedge) {
        use = true;
      } else {
        use = false;
      }
      return use;
    };

    BookPrinter.defaultStyleSheet = function defaultStyleSheet() {
      return '\n      <style type="text/css">\n        body {\n          margin: 0;\n          padding: 0;\n        }\n        .fb3d-printer-page {\n          page-break-after: always;\n        }\n      </style>\n    ';
    };

    return BookPrinter;
  }();

  exports.default = BookPrinter;

  /***/
},
/* 29 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(1);

  var _View2 = __webpack_require__(65);

  var _View3 = _interopRequireDefault(_View2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var BookView = function (_View) {
    _inherits(BookView, _View);

    function BookView(container, onLoad, template, handler) {
      _classCallCheck(this, BookView);

      return _possibleConstructorReturn(this, _View.call(this, container, onLoad, template, handler));
    }

    BookView.prototype.initView = function initView() {
      this.view = this.container.find('.view');
      this.bookmarksView = this.container.find('.widBookmarks');
      this.thumbnailsView = this.container.find('.widThumbnails');
      this.searchView = this.container.find('.widSearch');
    };

    BookView.prototype.getHandlers = function getHandlers(id) {
      var _this2 = this;

      var handlers = void 0;
      if (id === 'inpPage') {
        handlers = [{
          inpPage: function inpPage(e, data) {
            return _this2.callLater(_View.prototype.getHandlers.call(_this2, id), id, e, data, BookView.PAGE_HANDLER_DELAY);
          }
        }];
      } else {
        handlers = _View.prototype.getHandlers.call(this, id);
      }
      return handlers;
    };

    BookView.prototype.onItemStateChanged = function onItemStateChanged(id, state) {
      if (id === 'cmdFullScreen') {
        if (state.active) {
          this.parentContainer.addClass('fullscreen');
        } else {
          this.parentContainer.removeClass('fullscreen');
        }
      }
    };

    BookView.prototype.getView = function getView() {
      return this.view;
    };

    BookView.prototype.getBookmarksView = function getBookmarksView() {
      return this.bookmarksView;
    };

    BookView.prototype.getThumbnailsView = function getThumbnailsView() {
      return this.thumbnailsView;
    };

    BookView.prototype.getSearchView = function getSearchView() {
      return this.searchView;
    };

    BookView.prototype.getForms = function getForms() {
      return [];
    };

    BookView.prototype.getLinks = function getLinks() {
      return ['cmdZoomIn', 'cmdZoomOut', 'cmdDefaultZoom', 'cmdToc', 'cmdFastBackward', 'cmdBackward', 'cmdForward', 'cmdFastForward', 'cmdSave', 'cmdPrint', 'cmdFullScreen', 'cmdSmartPan', 'cmdSinglePage', 'cmdSounds', 'cmdStats', 'cmdLightingUp', 'cmdLightingDown', 'cmdCloseToc', 'cmdBookmarks', 'cmdSearch', 'cmdThumbnails'];
    };

    BookView.prototype.getWidgets = function getWidgets() {
      return ['widLoadingProgress', 'widFloatWnd', 'widTocMenu', 'widBookmarks', 'widThumbnails', 'widSearch', 'widSettings', 'widLoading'];
    };

    BookView.prototype.getInputs = function getInputs() {
      return ['inpPage', 'inpPages'];
    };

    BookView.prototype.getTexts = function getTexts() {
      return ['txtLoadingProgress'];
    };

    BookView.prototype.getTemplate = function getTemplate() {
      return {
        html: 'templates/default-book-view.html',
        styles: ['css/black-book-view.css'],
        links: [{
          rel: 'stylesheet',
          href: 'css/font-awesome.min.css'
        }],
        script: 'js/default-book-view.js'
      };
    };

    return BookView;
  }(_View3.default);

  BookView.PAGE_HANDLER_DELAY = 1000;
  exports.default = BookView;

  /***/
},
/* 30 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _BookPropsBuilder2 = __webpack_require__(9);

  var _BookPropsBuilder3 = _interopRequireDefault(_BookPropsBuilder2);

  var _ImageFactory = __webpack_require__(8);

  var _ImageFactory2 = _interopRequireDefault(_ImageFactory);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var ClbBookPropsBuilder = function (_BookPropsBuilder) {
    _inherits(ClbBookPropsBuilder, _BookPropsBuilder);

    function ClbBookPropsBuilder(context, pageCallback, pages, onReady) {
      _classCallCheck(this, ClbBookPropsBuilder);

      var _this = _possibleConstructorReturn(this, _BookPropsBuilder.call(this, onReady));

      _this.calcSheets(pages);
      _this.pageCallback = pageCallback;
      _this.binds = {
        pageCallback: pageCallback.bind(_this)
      };
      _this.imageFactory = new _ImageFactory2.default(context);

      if (pages > 0) {
        (function () {
          var test = _this.imageFactory.build(pageCallback(0), 0, _this.defaults.sheet.widthTexels, _this.defaults.sheet.heightTexels, _this.defaults.sheet.color);
          test.onLoad = function () {
            _this.calcProps(test.width, test.height);
            test.dispose();
            _this.ready();
          };
        })();
      } else {
        _this.props = _this.defaults;
        _this.ready();
      }
      return _this;
    }

    return ClbBookPropsBuilder;
  }(_BookPropsBuilder3.default);

  exports.default = ClbBookPropsBuilder;

  /***/
},
/* 31 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _SheetBlock2 = __webpack_require__(10);

  var _SheetBlock3 = _interopRequireDefault(_SheetBlock2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var Cover = function (_SheetBlock) {
    _inherits(Cover, _SheetBlock);

    function Cover(visual, p, angle, state) {
      _classCallCheck(this, Cover);

      return _possibleConstructorReturn(this, _SheetBlock.call(this, visual, p, 0, 1, angle, state));
    }

    Cover.prototype.getProps = function getProps() {
      return _extends({}, this.p.cover, {
        sheets: 1
      });
    };

    Cover.prototype.loadPoints = function loadPoints() {
      var openedInterpolationIndeces = [[2, 3, 4], [2, 3, 4, 5, 6]],
          closedInterpolationIndeces = [[0, 1, 2], [0, 1, 2]],
          interpolationPoints = [{
        x: [[0, 0.2877, 0.6347, 0.8174, 1.0000], [0, 0.2831, 0.6256, 0.8082, 0.9909], [0, 0.2603, 0.5936, 0.7763, 0.9589], [0, 0.1370, 0.3881, 0.5342, 0.6758], [0, 0, 0, 0, 0]],
        y: [[0, 0, 0, 0, 0], [0, 0.02, 0.005, -0.001, -0.0025], [0, 0.04, 0.01, -0.002, -0.005], [0, 0.2466, 0.4795, 0.5708, 0.6758], [0, 0.2877, 0.6347, 0.8174, 1.0000]]
      }, {
        x: [[0, 0.2877, 0.6347, 0.8174, 1.0000], [0, 0.2831, 0.6256, 0.8082, 0.9909], [0, 0.2603, 0.5936, 0.7763, 0.9589], [0.000, 0.233, 0.563, 0.746, 0.927], [0.000, 0.144, 0.433, 0.613, 0.796], [0.000, 0.070, 0.288, 0.455, 0.626], [0, 0, 0, 0, 0]],
        y: [[0, 0, 0, 0, 0], [0, 0.02, 0.005, -0.001, -0.0025], [0, 0.04, 0.01, -0.002, -0.005], [0.000, 0.168, 0.269, 0.270, 0.255], [0.000, 0.245, 0.435, 0.458, 0.460], [0.000, 0.278, 0.544, 0.614, 0.673], [0, 0.2877, 0.6347, 0.8174, 1.0000]]
      }];
      return {
        interpolationPoints: interpolationPoints,
        openedInterpolationIndeces: openedInterpolationIndeces,
        closedInterpolationIndeces: closedInterpolationIndeces
      };
    };

    return Cover;
  }(_SheetBlock3.default);

  exports.default = Cover;

  /***/
},
/* 32 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _SheetCssLayer = __webpack_require__(37);

  var _SheetCssLayer2 = _interopRequireDefault(_SheetCssLayer);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var CssLayersManager = function () {
    function CssLayersManager(book) {
      _classCallCheck(this, CssLayersManager);

      this.book = book;
      this.props = book.p.cssLayerProps;
      this.visual = book.visual;
      this.pageManager = book.pageManager;
      this.wrappers = {};
    }

    CssLayersManager.prototype.getActives = function getActives() {
      var page = this.book.getPage(),
          pages = this.book.getPages();
      return page === 0 || page === pages - 1 ? [page] : [page, page + 1];
    };

    CssLayersManager.prototype.dispose = function dispose() {
      for (var _iterator = Object.values(this.wrappers), _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var w = _ref;

        w.layers.forEach(function (l) {
          return l.dispose();
        });
      }
      delete this.wrappers;
    };

    CssLayersManager.prototype.show = function show() {
      var _this = this;

      this.hidden = false;

      var _loop = function _loop() {
        if (_isArray2) {
          if (_i2 >= _iterator2.length) return 'break';
          _ref2 = _iterator2[_i2++];
        } else {
          _i2 = _iterator2.next();
          if (_i2.done) return 'break';
          _ref2 = _i2.value;
        }

        var n = _ref2;

        var w = _this.wrappers[n];
        if (w) {
          if (w.state === 'ready' && w.layers.length) {
            (function () {
              var block = _this.book.getBlockByPage(n);
              w.layers.forEach(function (l) {
                if (l.isHidden()) {
                  l.update(block);
                  l.show();
                }
              });
            })();
          }
        } else {
          (function () {
            var w = _this.wrappers[n] = {
              state: 'loading',
              layers: []
            };
            Promise.resolve().then(function () {
              _this.pageManager.getLayers(n, function (layers) {
                if (layers.length && _this.wrappers) {
                  var block = _this.book.getBlockByPage(n);
                  for (var _iterator3 = layers, _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
                    var _ref3;

                    if (_isArray3) {
                      if (_i3 >= _iterator3.length) break;
                      _ref3 = _iterator3[_i3++];
                    } else {
                      _i3 = _iterator3.next();
                      if (_i3.done) break;
                      _ref3 = _i3.value;
                    }

                    var l = _ref3;

                    var sl = new _SheetCssLayer2.default(_this.visual, block, _this.props);
                    w.layers.push(sl);
                    sl.set(l.css, l.html, l.js);
                  }
                  setTimeout(function () {
                    if (!_this.hidden && ~_this.getActives().indexOf(n)) {
                      w.layers.forEach(function (l) {
                        return l.show();
                      });
                    }
                  }, 10);
                }
                w.state = 'ready';
              });
            });
          })();
        }
      };

      for (var _iterator2 = this.getActives(), _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
        var _ref2;

        var _ret = _loop();

        if (_ret === 'break') break;
      }
    };

    CssLayersManager.prototype.hide = function hide() {
      this.hidden = true;
      var wait = [];
      for (var _iterator4 = Object.values(this.wrappers), _isArray4 = Array.isArray(_iterator4), _i4 = 0, _iterator4 = _isArray4 ? _iterator4 : _iterator4[Symbol.iterator]();;) {
        var _ref4;

        if (_isArray4) {
          if (_i4 >= _iterator4.length) break;
          _ref4 = _iterator4[_i4++];
        } else {
          _i4 = _iterator4.next();
          if (_i4.done) break;
          _ref4 = _i4.value;
        }

        var _w = _ref4;

        _w.layers.forEach(function (l) {
          return wait.push(l.hide());
        });
      }
      return Promise.all(wait);
    };

    return CssLayersManager;
  }();

  exports.default = CssLayersManager;

  /***/
},
/* 33 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(1);

  var _Cache = __webpack_require__(14);

  var _Cache2 = _interopRequireDefault(_Cache);

  var _LoadingAnimation = __webpack_require__(52);

  var _LoadingAnimation2 = _interopRequireDefault(_LoadingAnimation);

  var _ImageFactory = __webpack_require__(8);

  var _ImageFactory2 = _interopRequireDefault(_ImageFactory);

  var _BaseMathUtils = __webpack_require__(2);

  var _BaseMathUtils2 = _interopRequireDefault(_BaseMathUtils);

  var _TextureAnimator = __webpack_require__(60);

  var _TextureAnimator2 = _interopRequireDefault(_TextureAnimator);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var PageManager = function () {
    function PageManager(visual, book, p) {
      _classCallCheck(this, PageManager);

      this.visual = visual;
      this.book = book;
      this.pageQuery = '';
      this.p = p;
      this.pageCache = new _Cache2.default(p.cachedPages);
      this.resourcesCache = new _Cache2.default();
      this.canvas = (0, _libs.$)('<canvas>')[0];
      this.imageFactory = new _ImageFactory2.default(_extends({}, visual, { dispatchEvent: book.dispatchEvent.bind(book), renderCanvas: this.canvas, renderCanvasCtx: this.canvas.getContext('2d') }), this.resourcesCache);

      this.loadings = [];
      this.renderQueue = [];
      this.pageRequests = [];
      this.predictedRequests = [];

      this.tmpMaterial = new _libs.THREE.MeshBasicMaterial();
      visual.addObject(new _libs.THREE.Mesh(new _libs.THREE.PlaneGeometry(0, 0), this.tmpMaterial));

      this.loadingAnimation = true;
      this.loading = {};
      this.loading[p.cover.color] = this.createLoadingTexture(p.cover);
      if (p.page.color !== p.cover.color) {
        this.loading[p.page.color] = this.createLoadingTexture(p.page);
      }

      this.turnOnEvents();

      visual.addRenderCallback(this.update.bind(this));

      setTimeout(this.updateRenderQueue.bind(this), 250);
    }

    PageManager.prototype.createLoadingTexture = function createLoadingTexture(p) {
      var spriteTiles = 6,
          scale = Math.sqrt(4.5 * 210 * 4.5 * 297 / (p.widthTexels * p.heightTexels)),
          animation = new _LoadingAnimation2.default(scale * p.widthTexels, scale * p.heightTexels, p.color),
          animator = new _TextureAnimator2.default(animation.createSprite(spriteTiles), spriteTiles, 1, spriteTiles, 0.2);
      animation.dispose();
      return animator;
    };

    PageManager.prototype.dispose = function dispose() {
      this.turnOffEvents();
      for (var _iterator = Object.keys(this.loading), _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var color = _ref;

        this.loading[color].dispose();
      }
      delete this.loading;
      this.resourcesCache.dispose();
      this.pageCache.dispose();
      this.canvas.height = this.canvas.width = 0;
      delete this.canvas;
    };

    PageManager.prototype.isCover = function isCover(n) {
      return n < 2 || n >= 2 * (this.p.sheets + 1);
    };

    PageManager.prototype.isMobile = function isMobile() {
      return (this.visual.wnd.devicePixelRatio || 1) > 1;
    };

    PageManager.prototype.getPageState = function getPageState(n) {
      var object = this.pageCache.get(n);
      return object ? object.state : undefined;
    };

    PageManager.prototype.enableLoadingAnimation = function enableLoadingAnimation(enable) {
      this.loadingAnimation = enable;
      for (var _iterator2 = this.loadings, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
        var _ref2;

        if (_isArray2) {
          if (_i2 >= _iterator2.length) break;
          _ref2 = _iterator2[_i2++];
        } else {
          _i2 = _iterator2.next();
          if (_i2.done) break;
          _ref2 = _i2.value;
        }

        var o = _ref2;

        this.setupMaterial(o);
      }
    };

    PageManager.prototype.update = function update(dt) {
      if (this.loadingAnimation) {
        var loading = {};
        for (var _iterator3 = this.loadings, _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
          var _ref3;

          if (_isArray3) {
            if (_i3 >= _iterator3.length) break;
            _ref3 = _iterator3[_i3++];
          } else {
            _i3 = _iterator3.next();
            if (_i3.done) break;
            _ref3 = _i3.value;
          }

          var o = _ref3;

          if (o.isActive()) {
            loading[o.color] = true;;
          }
        }
        for (var _iterator4 = Object.keys(loading), _isArray4 = Array.isArray(_iterator4), _i4 = 0, _iterator4 = _isArray4 ? _iterator4 : _iterator4[Symbol.iterator]();;) {
          var _ref4;

          if (_isArray4) {
            if (_i4 >= _iterator4.length) break;
            _ref4 = _iterator4[_i4++];
          } else {
            _i4 = _iterator4.next();
            if (_i4.done) break;
            _ref4 = _i4.value;
          }

          var color = _ref4;

          this.loading[color].update(dt);
        }
      }
    };

    PageManager.prototype.removeFromLoadings = function removeFromLoadings(o) {
      var i = this.loadings.indexOf(o);
      if (~i) {
        this.loadings.splice(i, 1);
      }
    };

    PageManager.prototype.removeFromRenderQueue = function removeFromRenderQueue(o) {
      var i = this.renderQueue.indexOf(o);
      if (~i) {
        this.renderQueue.splice(i, 1);
      }
    };

    PageManager.prototype.refreshPageQuery = function refreshPageQuery(n) {
      var query = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';

      this.pageQuery = query;
      var object = this.pageCache.get(n);
      if (object && object.wrapper && object.wrapper.setQuery) {
        if (!this.pageCache.remove(n)) {
          object.wrapper.setQuery(query);
          this.pushInRenderQueue(object);
        }
      }
    };

    PageManager.prototype.refreshZoom = function refreshZoom() {
      var _this = this;

      if (this.p.autoResolution.enable) {
        (function () {
          var es = [];
          _this.pageCache.forEach(function (e) {
            es.push(e);
          });
          es.forEach(function (e) {
            var object = e[1];
            if (object && object.wrapper) {
              if (!_this.pageCache.remove(e[0])) {
                _this.pushInRenderQueue(object);
              }
            }
          });
        })();
      }
    };

    PageManager.prototype.getLayers = function getLayers(n, clb) {
      var _this2 = this;

      if (this.p.cssLayersLoader) {
        this.p.cssLayersLoader(n, function () {
          for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
            args[_key] = arguments[_key];
          }

          var object = _this2.pageCache.get(n);
          if (object) {
            if (object.state !== 'active') {
              object.pendings.push({ clb: clb, args: args });
            } else {
              clb.apply(undefined, args);
            }
          }
        });
      } else {
        clb([]);
      }
    };

    PageManager.prototype.resolvePendings = function resolvePendings(pendings) {
      for (var _iterator5 = pendings, _isArray5 = Array.isArray(_iterator5), _i5 = 0, _iterator5 = _isArray5 ? _iterator5 : _iterator5[Symbol.iterator]();;) {
        var _ref5;

        if (_isArray5) {
          if (_i5 >= _iterator5.length) break;
          _ref5 = _iterator5[_i5++];
        } else {
          _i5 = _iterator5.next();
          if (_i5.done) break;
          _ref5 = _i5.value;
        }

        var p = _ref5;

        try {
          p.clb.apply(p, p.args);
        } catch (e) {
          console.error(e);
        }
      }
      pendings.splice(0, pendings.length);
    };

    PageManager.prototype.rtlPageN = function rtlPageN(n) {
      return this.p.rtl ? 2 * (this.p.sheets + 2) - 1 - n : n;
    };

    PageManager.prototype.load = function load(material, n) {
      var _this3 = this;

      var pi = this.p.pageCallback(this.rtlPageN(n)),
          p = this.isCover(n) ? this.p.cover : this.p.page;
      var o = {
        n: n,
        texture: new _libs.THREE.Texture(),
        wrapper: null,
        state: 'loading',
        locked: function locked(n) {
          return o.state === 'loading' || o.state === 'rendering' || _this3.book.isActivePage(n);
        },
        color: p.color,
        isActive: function isActive() {
          return _this3.book.isActivePage(n);
        },
        isTop: function isTop() {
          return ~_this3.book.getTopPages().indexOf(n);
        },
        dispose: function dispose() {
          _this3.removeFromLoadings(o);
          _this3.removeFromRenderQueue(o);
          if (o.wrapper && o.wrapper.dispose) {
            o.wrapper.dispose();
          }
          o.texture.dispose();
          delete o.texture;
          delete o.wrapper;
        },
        pendings: []
      };
      o.texture.minFilter = _libs.THREE.LinearFilter;
      this.loadings.push(o);
      this.setMaterial(o, material);

      Promise.resolve().then(function () {
        if (o.texture) {
          o.widthTexels = pi.widthTexels || p.widthTexels;
          o.heightTexels = pi.heightTexels || p.heightTexels;
          var res = _this3.calcResolution(o);
          o.wrapper = _this3.imageFactory.build(pi, pi.number === undefined ? n : pi.number, res.width, res.height, p.color, _this3.p.injector);
          if (o.wrapper.setQuery) {
            o.wrapper.setQuery(_this3.pageQuery);
          }
          o.simulate = pi.interactive ? (o.wrapper.simulate || function () {
            return undefined;
          }).bind(o.wrapper) : undefined;
          o.wrapper.onLoad = function () {
            _this3.pushInRenderQueue(o);
            _this3.book.dispatchEvent({
              type: 'loadedPage',
              page: n
            });
          };
          o.wrapper.onChange = function (image) {
            if (o.texture) {
              _this3.removeFromLoadings(o);
              if (o.material) {
                o.material.map = o.texture;
                o.material.color = new _libs.THREE.Color(0xFFFFFF);
                o.material.needsUpdate = true;
              }
              o.texture.image = image;
              o.texture.needsUpdate = true;
              o.texture.onUpdate = function () {
                if (o.state !== 'queuedForRender') {
                  o.state = 'active';
                  _this3.resolvePendings(o.pendings);
                }
                delete _this3.rendering;
                //this.updateRenderQueue();
              };
              _this3.tmpMaterial.map = o.texture;
              _this3.tmpMaterial.needsUpdate = true;
            }
          };
        }
      });
      this.book.dispatchEvent({
        type: 'loadPage',
        page: n
      });
      return this.pageCache.put(n, o);
    };

    PageManager.prototype.isSinglePage = function isSinglePage(o) {
      return this.p.singlePage || !o.n || o.n === this.book.getPages() - 1;
    };

    PageManager.prototype.calcResolution = function calcResolution(o) {
      var res = void 0;
      if (this.p.autoResolution.enable) {
        var k = Math.min((this.isSinglePage(o) ? 1 : 0.5) * this.visual.width() / o.widthTexels, this.visual.height() / o.heightTexels);
        res = {
          width: this.p.autoResolution.k * this.p.zoom * k * o.widthTexels,
          height: this.p.autoResolution.k * this.p.zoom * k * o.heightTexels
        };
      } else {
        res = {
          width: o.widthTexels,
          height: o.heightTexels
        };
      }
      return res;
    };

    PageManager.prototype.pushInRenderQueue = function pushInRenderQueue(o) {
      if (o.state !== 'queuedForRender') {
        o.state = 'queuedForRender';
        this.renderQueue.push(o);
        // this.updateRenderQueue();
      }
    };

    PageManager.prototype.updateRenderQueue = function updateRenderQueue() {
      if (this.canvas) {
        var p = this.p;
        if (!this.rendering && (p.renderWhileFlipping || !this.book.isProcessing())) {
          var active = void 0,
              top = void 0;
          for (var _iterator6 = this.renderQueue, _isArray6 = Array.isArray(_iterator6), _i6 = 0, _iterator6 = _isArray6 ? _iterator6 : _iterator6[Symbol.iterator]();;) {
            var _ref6;

            if (_isArray6) {
              if (_i6 >= _iterator6.length) break;
              _ref6 = _iterator6[_i6++];
            } else {
              _i6 = _iterator6.next();
              if (_i6.done) break;
              _ref6 = _i6.value;
            }

            var o = _ref6;

            if (!active && o.isActive()) {
              active = o;
            }
            if (o.isTop()) {
              top = o;
              break;
            }
          }
          this.rendering = top || active;
          if (this.isMobile() && p.renderInactivePagesOnMobile || !this.isMobile() && p.renderInactivePages) {
            this.rendering = this.rendering || this.renderQueue[0];
          }
          if (this.rendering) {
            if (this.rendering.wrapper.startRender) {
              this.removeFromRenderQueue(this.rendering);
              this.rendering.state = 'rendering';
              this.rendering.wrapper.setResolution(this.calcResolution(this.rendering));
              this.rendering.wrapper.startRender();
            } else {
              delete this.rendering;
            }
          }
        }
        setTimeout(this.updateRenderQueue.bind(this), 250);
      }
    };

    PageManager.prototype.turnOnEvents = function turnOnEvents() {
      this.transferEvents = true;
    };

    PageManager.prototype.turnOffEvents = function turnOffEvents() {
      var mouseup = _libs.$.Event('mouseup'),
          mouseout = _libs.$.Event('mouseout');
      this.pageCache.forEach(function (ent) {
        var object = ent[1];
        if (object.simulate) {
          object.simulate(mouseup, undefined, 0, 0);
          object.simulate(mouseout, undefined, 0, 0);
        }
      });
      this.transferEvents = false;
    };

    PageManager.prototype.transferEventToTexture = function transferEventToTexture(n, e, data) {
      var _this4 = this;

      if (this.transferEvents) {
        var toObject = this.getOrLoadTextureObject(undefined, n);
        if (toObject.wrapper) {
          (function () {
            var uv = data.uv,
                toDoc = toObject.wrapper.getSimulatedDoc();
            _this4.pageCache.forEach(function (ent) {
              var object = ent[1];
              if (object.simulate) {
                object.simulate(e, toDoc, uv.x, uv.y);
              }
            });
          })();
        }
      }
    };

    PageManager.prototype.loadPredictedPages = function loadPredictedPages() {
      this.predictedRequests = _BaseMathUtils2.default.predict(this.pageRequests, this.p.preloadPages);
      for (var _iterator7 = this.predictedRequests, _isArray7 = Array.isArray(_iterator7), _i7 = 0, _iterator7 = _isArray7 ? _iterator7 : _iterator7[Symbol.iterator]();;) {
        var _ref7;

        if (_isArray7) {
          if (_i7 >= _iterator7.length) break;
          _ref7 = _iterator7[_i7++];
        } else {
          _i7 = _iterator7.next();
          if (_i7.done) break;
          _ref7 = _i7.value;
        }

        var p = _ref7;

        if (p < this.book.getPages() && !this.pageCache.get(p)) {
          this.load(undefined, p);
        }
      }
    };

    PageManager.prototype.addPageRequest = function addPageRequest(n) {
      this.pageRequests.push(n);
      if (this.pageRequests.length > this.p.pagesForPredicting) {
        this.pageRequests.shift();
      }
      Promise.resolve().then(this.loadPredictedPages.bind(this));
    };

    PageManager.prototype.setMaterial = function setMaterial(o, material) {
      this.pageCache.forEach(function (e) {
        var ob = e[1];
        if (o !== ob && ob.material === material) {
          delete ob.material;
        }
      });
      if (material && material !== o.material) {
        o.material = material;
        this.setupMaterial(o);
      }
    };

    PageManager.prototype.setupMaterial = function setupMaterial(o) {
      o.material.map = o.texture.image ? o.texture : this.loadingAnimation ? this.loading[o.color].texture : null;
      if (!o.material.map) {
        o.material.color = new _libs.THREE.Color(o.color);
      }
      o.material.needsUpdate = true;
    };

    PageManager.prototype.getOrLoadTextureObject = function getOrLoadTextureObject(material, n) {
      var object = this.pageCache.get(n);
      if (!object) {
        object = this.load(material, n);
        this.addPageRequest(n);
      } else {
        this.setMaterial(object, material);
      }

      return object;
    };

    PageManager.prototype.setTexture = function setTexture(material, n) {
      if (~this.predictedRequests.indexOf(n)) {
        this.addPageRequest(n);
      }
      this.getOrLoadTextureObject(material, n);
    };

    return PageManager;
  }();

  exports.default = PageManager;

  /***/
},
/* 34 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _BookPropsBuilder2 = __webpack_require__(9);

  var _BookPropsBuilder3 = _interopRequireDefault(_BookPropsBuilder2);

  var _Pdf = __webpack_require__(18);

  var _Pdf2 = _interopRequireDefault(_Pdf);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var PdfBookPropsBuilder = function (_BookPropsBuilder) {
    _inherits(PdfBookPropsBuilder, _BookPropsBuilder);

    function PdfBookPropsBuilder(src, onReady) {
      _classCallCheck(this, PdfBookPropsBuilder);

      var _this = _possibleConstructorReturn(this, _BookPropsBuilder.call(this, onReady));

      _this.pdf = new _Pdf2.default(src);
      _this.pageDescription = {
        type: 'pdf',
        src: _this.pdf,
        interactive: true
      };
      _this.binds = {
        pageCallback: _this.pageCallback.bind(_this)
      };
      _this.pdf.getHandler(_this.init.bind(_this));
      return _this;
    }

    PdfBookPropsBuilder.prototype.dispose = function dispose() {
      this.pdf.dispose();
      _BookPropsBuilder.prototype.dispose.call(this);
    };

    PdfBookPropsBuilder.prototype.init = function init(handler) {
      var _this2 = this;

      var pages = this.pdf.getPagesNum();
      this.calcSheets(pages);
      if (pages > 0) {
        handler.getPage(1).then(function (page) {
          var size = _Pdf2.default.getPageSize(page);
          _this2.calcProps(size.width, size.height);
          _this2.ready();
        }).catch(function (e) {
          console.error(e);
        });
      } else {
        this.props = this.defaults;
        this.ready();
      }
    };

    PdfBookPropsBuilder.prototype.pageCallback = function pageCallback(n) {
      return this.pageDescription;
    };

    return PdfBookPropsBuilder;
  }(_BookPropsBuilder3.default);

  exports.default = PdfBookPropsBuilder;

  /***/
},
/* 35 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(1);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var PdfLinksHandler = function () {
    function PdfLinksHandler(pdf, ctrl, element) {
      _classCallCheck(this, PdfLinksHandler);

      this.pdf = pdf;
      this.ctrl = ctrl;
      this.element = (0, _libs.$)(element);
      this.cursors = [];
    }

    PdfLinksHandler.prototype.dispose = function dispose() {};

    PdfLinksHandler.prototype.setHandler = function setHandler(handler) {
      this.handler = handler;
    };

    PdfLinksHandler.prototype.defaultHandler = function defaultHandler(type, destination) {
      if (type === 'internal') {
        this.ctrl.goToPage(destination);
      } else if (type === 'external') {
        window.open(destination, '_blank');
      }
    };

    PdfLinksHandler.prototype.callHandlers = function callHandlers(type, destination) {
      if (!this.handler || !this.handler(type, destination)) {
        this.defaultHandler(type, destination);
      }
    };

    PdfLinksHandler.prototype.handleEvent = function handleEvent(data) {
      var _this = this;

      var e = data.event,
          anno = data.annotation;
      switch (e.type) {
        case 'mouseover':
          {
            this.cursors.push(this.element.css('cursor'));
            this.element.css('cursor', 'pointer');
            break;
          }
        case 'mouseout':
          {
            this.element.css('cursor', this.cursors.pop() || '');
            break;
          }
        case 'touchtap':
        case 'click':
          {
            if (anno.url) {
              this.callHandlers('external', anno.url);
            } else if (anno.dest) {
              var destPromise = void 0;
              if (typeof anno.dest === 'string') {
                destPromise = this.pdf.handler.getDestination(anno.dest);
              } else {
                destPromise = Promise.resolve(anno.dest);
              }
              destPromise.then(function (dest) {
                return typeof dest[0] === 'number' ? dest[0] : _this.pdf.handler.getPageIndex(dest[0]);
              }).then(function (number) {
                return _this.callHandlers('internal', number);
              }).catch(function () {
                return console.error('Bad link');
              });
            }
            break;
          }
      }
    };

    return PdfLinksHandler;
  }();

  exports.default = PdfLinksHandler;

  /***/
},
/* 36 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _Finder = __webpack_require__(17);

  var _Finder2 = _interopRequireDefault(_Finder);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var SearchEngine = function () {
    function SearchEngine(pageCallback, pages) {
      _classCallCheck(this, SearchEngine);

      this.pageCallback = pageCallback;
      this.pages = pages;
      this.results = [];
    }

    SearchEngine.prototype.setQuery = function setQuery(query) {
      this.query = query;
      this.update = true;
      this.process();
    };

    SearchEngine.prototype.process = function process() {
      var _this = this;

      if (this.update) {
        var results = this.results;
        this.results = [];
        if (this.onPageHitsChanged) {
          for (var _iterator = results, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
            var _ref;

            if (_isArray) {
              if (_i >= _iterator.length) break;
              _ref = _iterator[_i++];
            } else {
              _i = _iterator.next();
              if (_i.done) break;
              _ref = _i.value;
            }

            var res = _ref;

            this.onPageHitsChanged(undefined, '');
          }
        }
        this.update = false;
        this.page = 0;
        this.stamp = Date.now();
        if (this.query.length > 1) {
          this.process();
        }
      } else {
        if (this.page < this.pages) {
          (function () {
            var stamp = _this.stamp;
            _this.find(_this.pageCallback(_this.page)).then(function (contexts) {
              if (stamp === _this.stamp) {
                if (contexts.length) {
                  _this.results.push({
                    page: _this.page,
                    contexts: contexts
                  });
                }
                ++_this.page;
                if (_this.onPageHitsChanged) {
                  _this.onPageHitsChanged(_this.page, _this.query);
                }
                _this.process();
              }
            });
          })();
        }
      }
    };

    SearchEngine.prototype.find = function find(pi) {
      var _this2 = this;

      var next = void 0;
      if (pi.type === 'pdf') {
        next = new Promise(function (resolve) {
          pi.src.getHandler(function () {
            var n = pi.number === undefined ? _this2.page : pi.number;
            if (pi.src.getPageType(n) === 'right') {
              resolve([]);
            } else {
              pi.src.getPage(n).then(function (page) {
                page.getTextContent().then(function (textContent) {
                  resolve(new _Finder2.default(textContent.items.map(function (item) {
                    return item.str;
                  }), _this2.query, { hits: false }).getContexts());
                });
              }).catch(function () {
                return resolve([]);
              });
            }
          });
        });
      } else {
        next = Promise.resolve([]);
      }
      return next;
    };

    return SearchEngine;
  }();

  exports.default = SearchEngine;

  /***/
},
/* 37 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _CSSLayer = __webpack_require__(13);

  var _CSSLayer2 = _interopRequireDefault(_CSSLayer);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var SheetCssLayer = function () {
    function SheetCssLayer(visual, block, props) {
      _classCallCheck(this, SheetCssLayer);

      this.visual = visual;
      var size = block.getTopSize();
      this.layer = new _CSSLayer2.default(size.width, size.height, props);

      this.update(block);
      this.visual.addCssObject(this.layer);
    }

    SheetCssLayer.prototype.dispose = function dispose() {
      this.layer.dispose();
      this.visual.removeCssObject(this.layer);
    };

    SheetCssLayer.prototype.isHidden = function isHidden() {
      return this.layer.isHidden();
    };

    SheetCssLayer.prototype.hide = function hide() {
      return this.layer.hide();
    };

    SheetCssLayer.prototype.show = function show() {
      return this.layer.show();
    };

    SheetCssLayer.prototype.set = function set(css, html, js) {
      this.layer.setData(css, html, js);
    };

    SheetCssLayer.prototype.update = function update(block) {
      this.block = block;
      this.block.getTopWorldRotation(this.layer.rotation);
      this.block.getTopWorldPosition(this.layer.position);
    };

    return SheetCssLayer;
  }();

  exports.default = SheetCssLayer;

  /***/
},
/* 38 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _MathUtils = __webpack_require__(3);

  var _MathUtils2 = _interopRequireDefault(_MathUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var SheetPhysics = function () {
    SheetPhysics.targetForceClb = function targetForceClb(o, a, v, ch) {
      var l = a * this.r;
      return 100 * this.m * this.g * (2 / (1 + Math.exp(10 * (l - this.tl))) - 1) - this.m * 40 * v;
    };

    SheetPhysics.hoverCornerForceClb = function hoverCornerForceClb(o, v, l, ch) {
      return 5;
    };

    SheetPhysics.prototype.getTargetForceClb = function getTargetForceClb(mass, targetAngle) {
      return SheetPhysics.targetForceClb.bind({
        g: this.p.gravity,
        m: mass,
        tl: targetAngle * this.p.r,
        r: this.p.r
      });
    };

    SheetPhysics.dragForceClb = function dragForceClb(o, a, v, ch) {
      return o.flbt * o.m * (10 * o.g * ch - 50 * v / (1 + Math.exp(3.5 * Math.abs(ch))));
    };

    SheetPhysics.dragCornerForceClb = function dragCornerForceClb(o, a, v, ch) {
      return 15 * (2 / (1 + Math.exp(10 * (a - this.ta) * o.r)) - 1);
    };

    SheetPhysics.getDragCornerForceClb = function getDragCornerForceClb(targetAngle) {
      return SheetPhysics.dragCornerForceClb.bind({
        ta: targetAngle
      });
    };

    function SheetPhysics() {
      var r = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      var gravity = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
      var cornerDeviation = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0.15;
      var fps = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 240;

      _classCallCheck(this, SheetPhysics);

      this.p = {
        r: r,
        cornerDeviation: cornerDeviation,
        l: Math.PI * r,
        startDt: 1 / fps,
        gravity: gravity,
        margin: 0.002 * r,
        infM: 1e4,
        attempts: 16,
        maxIterations: 100
      };
      this.os = [];
    }

    SheetPhysics.prototype.dispose = function dispose() {
      this.os = [];
    };

    SheetPhysics.prototype.getSize = function getSize() {
      return this.os.length;
    };

    SheetPhysics.prototype.addObject = function addObject(mass, angle, velocity, flexibility, cornerHeight, simulateClb, removeClb) {
      var forceClb = arguments.length > 7 && arguments[7] !== undefined ? arguments[7] : function () {
        return 0;
      };
      var cornerForceClb = arguments.length > 8 && arguments[8] !== undefined ? arguments[8] : function () {
        return 0;
      };

      var no = {
        id: _MathUtils2.default.getUnique(),
        m: mass,
        v: velocity,
        l: angle * this.p.r,
        f: forceClb,
        cf: cornerForceClb,
        ch: cornerHeight,
        flbt: flexibility,
        simulateClb: simulateClb,
        removeClb: removeClb
      };
      var i = this.os.findIndex(function (o) {
        return no.l <= o.l;
      });
      i = ~i ? i : this.os.length;
      this.os.splice(i, 0, no);
      return no.id;
    };

    SheetPhysics.prototype.getParametrMap = function getParametrMap(name) {
      var map = {
        mass: 'm',
        velocity: 'v',
        flexibility: 'flbt',
        cornerHeight: 'ch',
        simulateClb: 'simulateClb',
        removeClb: 'removeClb',
        forceClb: 'f',
        cornerForceClb: 'cf'
      };
      return map[name];
    };

    SheetPhysics.prototype.setParametr = function setParametr(id, name, value) {
      var o = this.os.find(function (o) {
        return o.id === id;
      });
      if (name === 'angle') {
        o.l = value * this.p.r;
      } else {
        o[this.getParametrMap(name)] = value;
      }
    };

    SheetPhysics.prototype.getParametr = function getParametr(id, name) {
      var o = this.os.find(function (o) {
        return o.id === id;
      });
      var value = void 0;
      if (name === 'angle') {
        value = o.l / this.p.r;
      } else {
        value = o[this.getParametrMap(name)];
      }
      return value;
    };

    SheetPhysics.prototype.simulate = function simulate(T) {
      var t = 0,
          dt = this.p.startDt,
          attempt = 0,
          it = 0;

      while (t < T && it < this.p.maxIterations) {
        if (dt > T - t) {
          dt = T - t;
        }
        var nos = this.integrate(this.os, dt),
            ci = this.findCollisions(nos);
        if (ci.num > 1 && attempt < this.p.attempts) {
          dt /= 2;
          ++attempt;
        } else {
          if (ci.num === 1) {
            var scos = this.solveCollision(nos[ci.last - 1], nos[ci.last]);
            nos[ci.last - 1] = scos[0];
            nos[ci.last] = scos[1];
          } else if (ci.num > 1) {
            var gs = [];
            var last = -2;
            for (var _iterator = ci.all, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
              var _ref;

              if (_isArray) {
                if (_i >= _iterator.length) break;
                _ref = _iterator[_i++];
              } else {
                _i = _iterator.next();
                if (_i.done) break;
                _ref = _i.value;
              }

              var i = _ref;

              if (i - last > 1) {
                gs.push([]);
              }
              gs[gs.length - 1].push(i);
              last = i;
            }
            for (var _iterator2 = gs, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
              var _ref2;

              if (_isArray2) {
                if (_i2 >= _iterator2.length) break;
                _ref2 = _iterator2[_i2++];
              } else {
                _i2 = _iterator2.next();
                if (_i2.done) break;
                _ref2 = _i2.value;
              }

              var g = _ref2;

              var sg = void 0,
                  i0 = void 0;
              if (nos[g[0]].l > Math.PI / 2 * this.p.r) {
                sg = -1;
                i0 = g[g.length - 1];
              } else {
                sg = 1;
                i0 = g[0];
              }
              for (var _i3 = i0; _i3 < nos.length && _i3 > -1; _i3 += sg) {
                var o = nos[_i3 + sg];
                if (o && sg * (o.l - nos[_i3].l) <= this.p.margin) {
                  o.l = nos[_i3].l + sg * 2 * this.p.margin;
                  if (o.l > this.p.l || o.l < 0) {
                    o.l = o.l > this.p.l ? this.p.l : 0;
                    o.ch = 0;
                    o.v = 0;
                    console.error('Bad collision');
                  }
                } else {
                  break;
                }
              }
            }
          }
          this.os = nos;
          this.findAndSolveCornerCollisions();
          t += dt;
          dt = this.p.startDt;
          attempt = 0;
        }
        ++it;
      }

      this.removeStatics();
    };

    SheetPhysics.prototype.removeStatics = function removeStatics() {
      var nos = [],
          notify = [[], []];
      for (var _iterator3 = this.os, _isArray3 = Array.isArray(_iterator3), _i4 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
        var _ref3;

        if (_isArray3) {
          if (_i4 >= _iterator3.length) break;
          _ref3 = _iterator3[_i4++];
        } else {
          _i4 = _iterator3.next();
          if (_i4.done) break;
          _ref3 = _i4.value;
        }

        var o = _ref3;

        if (o.simulateClb) {
          o.simulateClb(o.l / this.p.r, o.ch);
        }
        if ((o.l === this.p.l || o.l === 0) && o.v === 0) {
          if (o.removeClb !== undefined) {
            notify[(o.l !== this.p.l) + 0].push(o);
          }
        } else {
          nos.push(o);
        }
      }
      this.os = nos;
      for (var _iterator4 = notify[0].reverse(), _isArray4 = Array.isArray(_iterator4), _i5 = 0, _iterator4 = _isArray4 ? _iterator4 : _iterator4[Symbol.iterator]();;) {
        var _ref4;

        if (_isArray4) {
          if (_i5 >= _iterator4.length) break;
          _ref4 = _iterator4[_i5++];
        } else {
          _i5 = _iterator4.next();
          if (_i5.done) break;
          _ref4 = _i5.value;
        }

        var _o = _ref4;

        _o.removeClb(Math.PI, _o.ch);
      }
      for (var _iterator5 = notify[1], _isArray5 = Array.isArray(_iterator5), _i6 = 0, _iterator5 = _isArray5 ? _iterator5 : _iterator5[Symbol.iterator]();;) {
        var _ref5;

        if (_isArray5) {
          if (_i6 >= _iterator5.length) break;
          _ref5 = _iterator5[_i6++];
        } else {
          _i6 = _iterator5.next();
          if (_i6.done) break;
          _ref5 = _i6.value;
        }

        var _o2 = _ref5;

        _o2.removeClb(0, _o2.ch);
      }
    };

    SheetPhysics.prototype.findAndSolveCornerCollisions = function findAndSolveCornerCollisions() {
      if (this.os.length) {
        var os = [_extends({}, this.os[0], {
          l: 0,
          m: this.p.infM,
          ch: 0
        })].concat(this.os, [_extends({}, this.os[0], {
          l: 1.05 * this.p.l,
          m: this.p.infM,
          ch: 0
        })]);

        for (var i = 1; i < os.length; ++i) {
          var a = os[i - 1],
              b = os[i],
              al = a.l + this.p.cornerDeviation * a.ch * this.p.r,
              bl = b.l + this.p.cornerDeviation * b.ch * this.p.r;
          if (1.05 * al > bl && a.ch > b.ch) {
            var dCh = a.ch - b.ch,
                dv = a.m / a.flbt + b.m / b.flbt,
                ka = a.m / a.flbt / dv,
                kb = b.m / b.flbt / dv;
            a.ch = a.ch - kb * dCh;
            b.ch = b.ch + ka * dCh;
          }
        }
      }
    };

    SheetPhysics.prototype.solveCollision = function solveCollision(a, b) {
      var mm = b.m + a.m,
          av = (-a.v * b.m + a.m * a.v + 2 * b.m * b.v) / mm,
          bv = (b.m * b.v - b.v * a.m + 2 * a.m * a.v) / mm;
      return [_extends({}, a, { v: av }), _extends({}, b, { v: bv })];
    };

    SheetPhysics.prototype.findCollisions = function findCollisions(os) {
      var ci = {
        num: 0,
        last: 0,
        all: []
      };
      for (var i = 1; i < os.length && ci.num < 2; ++i) {
        if (os[i - 1].l > os[i].l || this.isCollision(os[i - 1], os[i])) {
          if (os[i - 1].l > os[i].l) {
            ++ci.num;
          }
          ++ci.num;
          ci.last = i;
          if (ci.all.indexOf(i - 1) === -1) {
            ci.all.push(i - 1);
          }
          if (ci.all.indexOf(i) === -1) {
            ci.all.push(i);
          }
        }
      }
      return ci;
    };

    SheetPhysics.prototype.isCollision = function isCollision(a, b) {
      return Math.abs(a.l - b.l) < this.p.margin && a.v > b.v;
    };

    SheetPhysics.prototype.integrate = function integrate(os, dt) {
      var nos = [];
      for (var _iterator6 = os, _isArray6 = Array.isArray(_iterator6), _i7 = 0, _iterator6 = _isArray6 ? _iterator6 : _iterator6[Symbol.iterator]();;) {
        var _ref6;

        if (_isArray6) {
          if (_i7 >= _iterator6.length) break;
          _ref6 = _iterator6[_i7++];
        } else {
          _i7 = _iterator6.next();
          if (_i7.done) break;
          _ref6 = _i7.value;
        }

        var o = _ref6;

        var vl = _MathUtils2.default.rk4(this.dy.bind({
          g: this.p.gravity,
          r: this.p.r,
          m: o.m,
          f: o.f,
          cf: o.cf,
          ch: o.ch,
          flbt: o.flbt
        }), 0, dt, [o.v, o.l, o.ch]);
        var no = _extends({}, o, {
          v: vl[0],
          l: vl[1],
          ch: vl[2]
        });
        if (no.l <= 0 || no.l >= this.p.l) {
          no.l = no.l <= 0 ? 0 : this.p.l;
          no.v = 0;
          no.ch = 0;
        }
        nos.push(no);
      }
      return nos;
    };

    SheetPhysics.prototype.dy = function dy(t, y) {
      var v = y[0],
          l = y[1],
          ch = y[2],
          f = this.f(this, l / this.r, v, ch),
          cf = this.cf(this, l / this.r, v, ch);
      return [(-this.g * Math.cos(l / this.r) * this.m + f) / this.m, v + 0.01 * (Math.random() - 0.5), this.flbt * ((2 / (1 + Math.exp(-0.2 * cf)) - 1) * (1 - 2 / (1 + Math.exp(-5 * (Math.abs(ch) - 2)))) - ch)];
    };

    return SheetPhysics;
  }();

  exports.default = SheetPhysics;

  /***/
},
/* 39 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var SoundsEnviroment = function () {
    function SoundsEnviroment() {
      var template = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

      _classCallCheck(this, SoundsEnviroment);

      this.sounds = template.sounds || {};
      this.audio = {};
      if (this.sounds.startFlip) {
        this.audio.startFlip = new Audio(this.sounds.startFlip);
      }
      if (this.sounds.endFlip) {
        this.audio.endFlip = new Audio(this.sounds.endFlip);
      }
    }

    SoundsEnviroment.prototype.setEnabled = function setEnabled(enabled) {
      this.enabled = enabled;
    };

    SoundsEnviroment.prototype.togle = function togle() {
      this.enabled = !this.enabled;
    };

    SoundsEnviroment.prototype.dispose = function dispose() {
      delete this.audio.startFlip;
      delete this.audio.endFlip;
    };

    SoundsEnviroment.prototype.startFlip = function startFlip() {
      if (this.enabled && this.audio.startFlip) {
        this.audio.startFlip.play();
      }
    };

    SoundsEnviroment.prototype.endFlip = function endFlip() {
      if (this.enabled && this.audio.startFlip) {
        this.audio.startFlip.pause();
        this.audio.startFlip.currentTime = 0;
      }
      if (this.enabled && this.audio.endFlip) {
        this.audio.endFlip.play();
      }
    };

    SoundsEnviroment.prototype.subscribeFlips = function subscribeFlips(emitter) {
      emitter.addEventListener('startFlip', this.startFlip.bind(this));
      emitter.addEventListener('endFlip', this.endFlip.bind(this));
    };

    return SoundsEnviroment;
  }();

  exports.default = SoundsEnviroment;

  /***/
},
/* 40 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _WidgetController2 = __webpack_require__(67);

  var _WidgetController3 = _interopRequireDefault(_WidgetController2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var TocController = function (_WidgetController) {
    _inherits(TocController, _WidgetController);

    function TocController(view, bookCtrl) {
      _classCallCheck(this, TocController);

      var _this = _possibleConstructorReturn(this, _WidgetController.call(this, view));

      _this.bookCtrl = bookCtrl;
      _this.tab = 'none';
      return _this;
    }

    TocController.prototype.setThumbnails = function setThumbnails(thumbnails) {
      this.thumbnails = thumbnails;
      thumbnails.onNavigate = this.navigateThumbnails.bind(this);
      if (this.tab === 'none') {
        this.tab = 'thumbnails';
      }
      this.fireChange();
    };

    TocController.prototype.setSearch = function setSearch(search) {
      this.search = search;
      search.onNavigate = this.navigateSearch.bind(this);
      this.fireChange();
    };

    TocController.prototype.setBookmarks = function setBookmarks(bookmarks, pdf) {
      this.bookmarks = bookmarks;
      this.pdf = pdf;
      bookmarks.onNavigate = this.navigateBookmarks.bind(this);
      if (bookmarks.getSize()) {
        this.tab = 'bookmarks';
        this.isBookmarks = true;
      }
      this.fireChange();
    };

    TocController.prototype.cmdBookmarks = function cmdBookmarks() {
      this.tab = 'bookmarks';
      this.fireChange();
    };

    TocController.prototype.cmdThumbnails = function cmdThumbnails() {
      this.tab = 'thumbnails';
      this.fireChange();
    };

    TocController.prototype.cmdSearch = function cmdSearch() {
      this.tab = 'search';
      this.fireChange();
    };

    TocController.prototype.cmdCloseToc = function cmdCloseToc() {
      this.hide();
    };

    TocController.prototype.navigateThumbnails = function navigateThumbnails(number) {
      this.bookCtrl.goToPage(number);
    };

    TocController.prototype.navigateSearch = function navigateSearch(number) {
      this.bookCtrl.goToPage(number);
    };

    TocController.prototype.navigateBookmarks = function navigateBookmarks(item) {
      var _this2 = this;

      if (item.url) {
        window.open(item.url, '_blank');
      } else if (item.dest) {
        var destPromise = void 0;
        if (typeof item.dest === 'string') {
          destPromise = this.pdf.handler.getDestination(item.dest);
        } else {
          destPromise = Promise.resolve(item.dest);
        }
        destPromise.then(function (dest) {
          return _this2.pdf.handler.getPageIndex(dest[0]);
        }).then(function (number) {
          return _this2.bookCtrl.goToPage(number);
        }).catch(function () {
          return console.error('Bad bookmark');
        });
      }
    };

    TocController.prototype.updateView = function updateView() {
      var _this3 = this;

      if (this.view) {
        this.view.setState('widTocMenu', {
          enable: true,
          visible: true,
          active: false
        });
        this.view.setState('widThumbnails', {
          enable: true,
          visible: this.tab === 'thumbnails',
          active: false
        });
        this.view.setState('widSearch', {
          enable: true,
          visible: this.tab === 'search',
          active: false
        });
        this.view.setState('widBookmarks', {
          enable: true,
          visible: this.tab === 'bookmarks',
          active: false
        });
        this.view.setState('cmdBookmarks', {
          enable: true,
          visible: true,
          active: this.tab === 'bookmarks'
        });
        this.view.setState('cmdCloseToc', {
          enable: true,
          visible: true,
          active: false
        });
        this.view.setState('cmdThumbnails', {
          enable: true,
          visible: true,
          active: this.tab === 'thumbnails'
        });
        this.view.setState('cmdSearch', {
          enable: true,
          visible: true,
          active: this.tab === 'search'
        });
        Promise.resolve().then(function () {
          return _this3.thumbnails.setEnable(_this3.visible && _this3.tab === 'thumbnails');
        });
        _WidgetController.prototype.updateView.call(this);
      }
    };

    return TocController;
  }(_WidgetController3.default);

  exports.default = TocController;

  /***/
},
/* 41 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(1);

  var _ThreeUtils = __webpack_require__(20);

  var _ThreeUtils2 = _interopRequireDefault(_ThreeUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  var resX = 11,
      resY = 2,
      resZ = 15,
      scale = 1,
      faces = [];

  var frontGeometry = new _libs.THREE.PlaneGeometry(scale, scale, resX - 1, resY - 1);
  frontGeometry.translate(0.5 * scale, 0.5 * scale, scale);
  var backGeometry = new _libs.THREE.PlaneGeometry(scale, scale, resX - 1, resY - 1);
  backGeometry.rotateY(Math.PI);
  backGeometry.translate(0.5 * scale, 0.5 * scale, 0);
  var leftGeometry = new _libs.THREE.PlaneGeometry(scale, scale, resZ - 1, resY - 1);
  leftGeometry.rotateY(-Math.PI / 2);
  leftGeometry.translate(0, 0.5 * scale, 0.5 * scale);
  var rightGeometry = new _libs.THREE.PlaneGeometry(scale, scale, resZ - 1, resY - 1);
  rightGeometry.rotateY(Math.PI / 2);
  rightGeometry.translate(scale, 0.5 * scale, 0.5 * scale);
  var topGeometry = new _libs.THREE.PlaneGeometry(scale, scale, resX - 1, resZ - 1);
  topGeometry.rotateX(-Math.PI / 2);
  topGeometry.translate(0.5 * scale, scale, 0.5 * scale);
  var bottomGeometry = topGeometry.clone();
  bottomGeometry.translate(0, -scale, 0);
  for (var _iterator = bottomGeometry.faces, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
    var _ref;

    if (_isArray) {
      if (_i >= _iterator.length) break;
      _ref = _iterator[_i++];
    } else {
      _i = _iterator.next();
      if (_i.done) break;
      _ref = _i.value;
    }

    var f = _ref;
    var _ref3 = [f.b, f.a];
    f.a = _ref3[0];
    f.b = _ref3[1];
  }

  var geometry = new _libs.THREE.Geometry();
  geometry.vertices = [].concat(bottomGeometry.vertices, topGeometry.vertices);

  var addFaces = function addFaces(fs, map) {
    for (var _iterator2 = fs, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
      var _ref2;

      if (_isArray2) {
        if (_i2 >= _iterator2.length) break;
        _ref2 = _iterator2[_i2++];
      } else {
        _i2 = _iterator2.next();
        if (_i2.done) break;
        _ref2 = _i2.value;
      }

      var f = _ref2;

      geometry.faces.push(new _libs.THREE.Face3(map(f.a), map(f.b), map(f.c)));
    }
    faces.push(geometry.faces.length);
  };

  var mapVertices = function mapVertices(src, dst) {
    var map = [];
    var eq = function eq(a, b) {
      return Math.abs(a.x - b.x) + Math.abs(a.y - b.y) + Math.abs(a.z - b.z) < 1e-4;
    };
    for (var i = 0; i < src.length; ++i) {
      for (var j = 0; j < dst.length; ++j) {
        if (eq(src[i], dst[j])) {
          map[i] = j;
          break;
        }
      }
    }
    return map;
  };

  var frontMap = mapVertices(frontGeometry.vertices, geometry.vertices);
  var backMap = mapVertices(backGeometry.vertices, geometry.vertices);
  var leftMap = mapVertices(leftGeometry.vertices, geometry.vertices);
  var rightMap = mapVertices(rightGeometry.vertices, geometry.vertices);

  addFaces(topGeometry.faces, function (i) {
    return i + bottomGeometry.vertices.length;
  });
  addFaces(bottomGeometry.faces, function (i) {
    return i;
  });
  addFaces(frontGeometry.faces, function (i) {
    return frontMap[i];
  });
  addFaces(backGeometry.faces, function (i) {
    return backMap[i];
  });
  addFaces(leftGeometry.faces, function (i) {
    return leftMap[i];
  });
  addFaces(rightGeometry.faces, function (i) {
    return rightMap[i];
  });
  faces.pop();

  _ThreeUtils2.default.computeFaceVertexUvs(geometry, faces);

  geometry.computeVertexNormals();
  //geometry.computeFaceNormals();
  geometry.computeBoundingSphere();
  //geometry.computeBoundingBox();
  geometry.verticesNeedUpdate = true;

  exports.default = {
    resX: resX,
    resY: resY,
    resZ: resZ,
    faces: faces,
    geometry: geometry
  };

  /***/
},
/* 42 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  exports.__esModule = true;
  exports.props = props;
  var mouseButtons = {
    Left: 0,
    Middle: 1,
    Right: 2
  };

  function props() {
    return {
      eps: 1e-4,
      skin: {
        default: 'short-white-book-view'
      },
      scale: {
        default: 0.9,
        min: 0.9,
        max: 2.5,
        levels: 7
      },
      lighting: {
        default: 0.7,
        min: 0,
        max: 1,
        levels: 7
      },
      pan: {
        speed: 50
      },
      loadingAnimation: {
        skin: false,
        book: true
      },
      autoResolution: {
        enabled: true,
        coefficient: 1.5
      },
      actions: {
        cmdZoomIn: {
          enabled: true
        },
        cmdZoomOut: {
          enabled: true
        },
        cmdDefaultZoom: {
          enabled: true,
          type: 'dblclick',
          code: 0
        },
        cmdToc: {
          enabled: true
        },
        cmdFastBackward: {
          enabled: false
        },
        cmdBackward: {
          enabled: true
        },
        cmdForward: {
          enabled: true
        },
        cmdFastForward: {
          enabled: false
        },
        cmdSave: {
          enabled: true
        },
        cmdPrint: {
          enabled: true
        },
        cmdFullScreen: {
          enabled: true
        },
        widSettings: {
          enabled: true
        },
        cmdSmartPan: {
          enabled: true,
          active: true
        },
        cmdSinglePage: {
          enabled: true,
          active: false,
          activeForMobile: false
        },
        cmdSounds: {
          enabled: true,
          active: true
        },
        cmdStats: {
          enabled: true,
          active: false
        },
        cmdLightingUp: {
          enabled: true
        },
        cmdLightingDown: {
          enabled: true
        },
        cmdPanLeft: {
          enabled: false
        },
        cmdPanRight: {
          enabled: false
        },
        cmdPanUp: {
          enabled: false
        },
        cmdPanDown: {
          enabled: false
        },
        mouseCmdRotate: {
          enabled: true,
          type: 'mousedrag',
          code: mouseButtons.Right
        },
        mouseCmdDragZoom: {
          enabled: true,
          type: 'mousedrag',
          code: mouseButtons.Middle
        },
        mouseCmdPan: {
          enabled: true,
          type: 'mousedrag',
          code: mouseButtons.Left
        },
        mouseCmdWheelZoom: {
          enabled: true,
          type: 'mousewheel',
          code: 0
        },
        touchCmdRotate: {
          enabled: true,
          type: 'touchdrag',
          code: 3
        },
        touchCmdZoom: {
          enabled: true,
          type: 'touchdrag',
          code: 2
        },
        touchCmdPan: {
          enabled: true,
          type: 'touchdrag',
          code: 1
        },
        touchCmdSwipe: {
          enabled: true,
          type: 'touchdrag',
          code: 1
        }
      }
    };
  };

  /***/
},
/* 43 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _ImageBase2 = __webpack_require__(5);

  var _ImageBase3 = _interopRequireDefault(_ImageBase2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var BlankImage = function (_ImageBase) {
    _inherits(BlankImage, _ImageBase);

    function BlankImage(context, width, height, color) {
      _classCallCheck(this, BlankImage);

      var _this = _possibleConstructorReturn(this, _ImageBase.call(this, context, width, height, color));

      Promise.resolve().then(function () {
        _this.startRender = function () {
          _this.renderBlankPage();
          _this.finishRender();
        };
        _this.finishLoad();
      });
      return _this;
    }

    return BlankImage;
  }(_ImageBase3.default);

  exports.default = BlankImage;

  /***/
},
/* 44 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Bookmarks = function () {
    function Bookmarks(container, items) {
      var _this = this;

      var getTitle = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : function (i) {
        return i.title;
      };
      var getItems = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : function (i) {
        return i.items;
      };

      _classCallCheck(this, Bookmarks);

      this.container = container;
      this.map = [];
      this.getTitle = getTitle;
      this.getItems = getItems;
      this.nodes = this.mapNodes(items, this.map);

      this.binds = {
        togle: function togle(e) {
          e.preventDefault();
          var li = (0, _libs.$)(e.target);
          while (li[0] && li[0] !== container[0] && !li.hasClass('item')) {
            li = (0, _libs.$)(li[0].parentNode);
          }
          if (li.hasClass('item')) {
            var cmd = (0, _libs.$)(e.target);
            while (cmd[0] && cmd[0] !== li[0] && !cmd.hasClass('cmd')) {
              cmd = (0, _libs.$)(cmd[0].parentNode);
            }
            if (cmd.hasClass('cmd')) {
              var node = _this.map[li.attr('data-id')];
              if (cmd.hasClass('togle')) {
                node.minimized = !node.minimized;
                if (node.minimized) {
                  li.find('ul').remove();
                  li.find('.togle').addClass('minimized');
                } else {
                  li.find('.togle').removeClass('minimized');
                  li.append((_this.renderNode(node).match(/<ul.*<\/ul>/) || [''])[0]);
                }
              } else {
                if (_this.onNavigate) {
                  _this.onNavigate(node.item);
                }
              }
            }
          }
        }
      };

      container.on('click', this.binds.togle);
      this.update();
    }

    Bookmarks.prototype.getSize = function getSize() {
      return this.map.length;
    };

    Bookmarks.prototype.dispose = function dispose() {
      this.container.off('click', this.binds.togle);
      this.container.html('');
    };

    Bookmarks.prototype.update = function update() {
      this.container.html(this.renderNodes(this.nodes));
    };

    Bookmarks.prototype.forEach = function forEach(f) {
      var nodes = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.nodes;

      for (var _iterator = nodes || [], _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var node = _ref;

        f(node);
        this.forEach(f, node.children);
      }
    };

    Bookmarks.prototype.expand = function expand() {
      this.forEach(function (n) {
        return n.minimized = false;
      });
      this.update();
    };

    Bookmarks.prototype.minimize = function minimize() {
      this.forEach(function (n) {
        return n.minimized = true;
      });
      this.update();
    };

    Bookmarks.prototype.renderNode = function renderNode(node) {
      return ['<div class="area">', node.children ? '<a href="#" class="cmd togle' + (node.minimized ? ' minimized' : '') + '"><i class="fa fa-angle-right"></i></a> ' : '<i class="white-space"></i> ', '<a class="cmd" title="', node.title, '" href="#">', node.title, '</a></div>', node.minimized ? '' : this.renderNodes(node.children)].join('');
    };

    Bookmarks.prototype.renderNodes = function renderNodes(nodes) {
      var res = ['<div class="bookmarks">'];
      if (nodes && nodes.length) {
        res.push('<ul class="level-', nodes[0].level, '">');
        for (var _iterator2 = nodes, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
          var _ref2;

          if (_isArray2) {
            if (_i2 >= _iterator2.length) break;
            _ref2 = _iterator2[_i2++];
          } else {
            _i2 = _iterator2.next();
            if (_i2.done) break;
            _ref2 = _i2.value;
          }

          var node = _ref2;

          res.push(['<li class="item" data-id="', node.id, '">', this.renderNode(node), '</li>'].join(''));
        }
        res.push('</ul>');
      }
      res.push('</div>');
      return res.join('');
    };

    Bookmarks.prototype.mapNodes = function mapNodes(items) {
      var map = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
      var level = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;

      var nodes = null;
      if (items && items.length) {
        nodes = [];
        for (var _iterator3 = items, _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
          var _ref3;

          if (_isArray3) {
            if (_i3 >= _iterator3.length) break;
            _ref3 = _iterator3[_i3++];
          } else {
            _i3 = _iterator3.next();
            if (_i3.done) break;
            _ref3 = _i3.value;
          }

          var item = _ref3;

          var id = map.length;
          map.push(undefined);
          var node = {
            id: id,
            title: this.getTitle(item),
            level: level,
            item: item,
            minimized: true,
            children: this.mapNodes(this.getItems(item), map, level + 1)
          };
          nodes.push(node);
          map[id] = node;
        }
      }
      return nodes;
    };

    return Bookmarks;
  }();

  exports.default = Bookmarks;

  /***/
},
/* 45 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Detector = function () {
    function Detector() {
      _classCallCheck(this, Detector);
    }

    Detector.getWebGLErrorMessage = function getWebGLErrorMessage() {
      var element = document.createElement('div');
      element.id = 'webgl-error-message';
      element.style.fontFamily = 'monospace';
      element.style.fontSize = '13px';
      element.style.fontWeight = 'normal';
      element.style.textAlign = 'center';
      element.style.background = '#fff';
      element.style.color = '#000';
      element.style.padding = '1.5em';
      element.style.width = '400px';
      element.style.margin = '5em auto 0';

      if (!Detector.webgl) {
        element.innerHTML = window.WebGLRenderingContext ? ['Your graphics card does not seem to support <a href="http://khronos.org/webgl/wiki/Getting_a_WebGL_Implementation" style="color:#000">WebGL</a>.<br />', 'Find out how to get it <a href="http://get.webgl.org/" style="color:#000">here</a>.'].join('\n') : ['Your browser does not seem to support <a href="http://khronos.org/webgl/wiki/Getting_a_WebGL_Implementation" style="color:#000">WebGL</a>.<br/>', 'Find out how to get it <a href="http://get.webgl.org/" style="color:#000">here</a>.'].join('\n');
      }
      return element;
    };

    Detector.addGetWebGLMessage = function addGetWebGLMessage(parameters) {
      var parent = void 0,
          id = void 0,
          element = void 0;
      parameters = parameters || {};

      parent = parameters.parent || (0, _libs.$)(document.body);
      id = parameters.id || 'oldie';

      element = Detector.getWebGLErrorMessage();
      //element.id = id;

      parent.append(element);
    };

    return Detector;
  }();

  Detector.canvas = !!window.CanvasRenderingContext2D;

  Detector.webgl = function () {
    try {
      var canvas = document.createElement('canvas');
      return !!(window.WebGLRenderingContext && (canvas.getContext('webgl') || canvas.getContext('experimental-webgl')));
    } catch (e) {
      return false;
    }
  }();

  Detector.workers = !!window.Worker;
  Detector.fileapi = window.File && window.FileReader && window.FileList && window.Blob;
  exports.default = Detector;

  /***/
},
/* 46 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var DocMouseSimulator = function () {
    function DocMouseSimulator(jFrame, element) {
      var bElement = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : document.body;

      _classCallCheck(this, DocMouseSimulator);

      this.jFrame = jFrame;
      this.wnd = jFrame[0].contentWindow;
      this.doc = jFrame[0].contentDocument;
      this.element = element || doc.body;
      this.bElement = bElement;
      this.resendProperties = this.getDefaultResendProperties();
      this.undefinedProperties = this.getDefaultUndefinedProperties();
      this.cursors = [];
      this.onDocChangeClbs = [];
      var terms = [{
        find: ':hover',
        replace: '.' + DocMouseSimulator.HOVER
      }, {
        find: ':active',
        replace: '.' + DocMouseSimulator.ACTIVE
      }];
      var style = ['<style type="text/css">'];
      for (var i = 0; i < this.doc.styleSheets.length; ++i) {
        var ss = this.doc.styleSheets[i];
        for (var j = 0; j < ss.cssRules.length; ++j) {
          var r = ss.cssRules[j],
              cssText = void 0;
          for (var _iterator = terms, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
            var _ref;

            if (_isArray) {
              if (_i >= _iterator.length) break;
              _ref = _iterator[_i++];
            } else {
              _i = _iterator.next();
              if (_i.done) break;
              _ref = _i.value;
            }

            var term = _ref;

            if (~r.selectorText.indexOf(term.find)) {
              cssText = (cssText || r.cssText).replace(new RegExp(term.find, 'g'), term.replace);
            }
          }
          if (cssText) {
            style.push(cssText);
          }
        }
      }
      style.push('</style>');
      (0, _libs.$)(this.doc.head).append((0, _libs.$)(style.join('')));
    }

    DocMouseSimulator.prototype.convertCoords = function convertCoords(x, y) {
      var jElement = (0, _libs.$)(this.element);
      var offset = jElement.offset();
      return {
        x: offset.left + jElement.width() * x,
        y: offset.top + jElement.height() * (1 - y)
      };
    };

    DocMouseSimulator.prototype.triggerEvent = function triggerEvent(element, e, p, type, advancedProps) {
      var props = {};
      for (var _iterator2 = this.resendProperties, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
        var _ref2;

        if (_isArray2) {
          if (_i2 >= _iterator2.length) break;
          _ref2 = _iterator2[_i2++];
        } else {
          _i2 = _iterator2.next();
          if (_i2.done) break;
          _ref2 = _i2.value;
        }

        var _n = _ref2;

        props[_n] = e[_n];
      }
      for (var _iterator3 = this.undefinedProperties, _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
        var _ref3;

        if (_isArray3) {
          if (_i3 >= _iterator3.length) break;
          _ref3 = _iterator3[_i3++];
        } else {
          _i3 = _iterator3.next();
          if (_i3.done) break;
          _ref3 = _i3.value;
        }

        var _n2 = _ref3;

        props[_n2] = undefined;
      }
      for (var n in advancedProps) {
        if (advancedProps.hasOwnProperty(n)) {
          props[n] = advancedProps[n];
        }
      }
      props.view = this.wnd;
      props.pageX = p.x;
      props.pageY = p.y;
      var jE = _libs.$.Event(type, props);
      jE.timeStamp = e.timeStamp;
      (0, _libs.$)(element).trigger(jE);
    };

    DocMouseSimulator.prototype.addClass = function addClass(element, name) {
      (0, _libs.$)(element).addClass(name);
      var style = this.wnd.getComputedStyle(element);
      this.cursors.push((0, _libs.$)(this.bElement).css('cursor'));
      (0, _libs.$)(this.bElement).css('cursor', style.getPropertyValue('cursor'));
    };

    DocMouseSimulator.prototype.removeClass = function removeClass(element, name) {
      (0, _libs.$)(element).removeClass(name);
      (0, _libs.$)(this.bElement).css('cursor', this.cursors.pop());
    };

    DocMouseSimulator.prototype.enterElement = function enterElement(element) {
      this.addClass(element, DocMouseSimulator.HOVER);
    };

    DocMouseSimulator.prototype.leaveElement = function leaveElement(element) {
      this.removeClass(element, DocMouseSimulator.HOVER);
    };

    DocMouseSimulator.prototype.activateElement = function activateElement(element) {
      this.addClass(element, DocMouseSimulator.ACTIVE);
    };

    DocMouseSimulator.prototype.deactivateElement = function deactivateElement(element) {
      this.removeClass(element, DocMouseSimulator.ACTIVE);
    };

    DocMouseSimulator.prototype.addDocChangeClb = function addDocChangeClb(clb) {
      this.onDocChangeClbs.push(clb);
    };

    DocMouseSimulator.prototype.notify = function notify() {
      for (var _iterator4 = this.onDocChangeClbs, _isArray4 = Array.isArray(_iterator4), _i4 = 0, _iterator4 = _isArray4 ? _iterator4 : _iterator4[Symbol.iterator]();;) {
        var _ref4;

        if (_isArray4) {
          if (_i4 >= _iterator4.length) break;
          _ref4 = _iterator4[_i4++];
        } else {
          _i4 = _iterator4.next();
          if (_i4.done) break;
          _ref4 = _i4.value;
        }

        var clb = _ref4;

        clb(this.wnd, this.doc);
      }
    };

    DocMouseSimulator.prototype.elementFromPoint = function elementFromPoint(p) {
      var node = this.doc.body,
          next = true;
      while (next) {
        next = false;
        for (var i = 0; i < node.childNodes.length; ++i) {
          var child = node.childNodes[i];
          if (child instanceof this.wnd.Element) {
            var jC = (0, _libs.$)(child),
                offset = jC.offset(),
                height = jC.height(),
                width = jC.width();
            if (p.x > offset.left && p.x < offset.left + width && p.y > offset.top && p.y < offset.top + height) {
              node = child;
              next = true;
              break;
            }
          }
        }
      }
      return node;
    };

    DocMouseSimulator.prototype.getElement = function getElement(p) {
      var off0 = this.jFrame.offset();
      this.jFrame.offset({ left: 0.5 * window.innerWidth - p.x, top: 0.5 * window.innerHeight - p.y });
      var element = this.doc.elementFromPoint(p.x, p.y);
      if (!element) {
        // it isn't a joke it's IE
        element = this.doc.elementFromPoint(p.x, p.y);
      }
      this.jFrame.offset(off0);
      return element ? element : this.elementFromPoint(p);
    };

    DocMouseSimulator.prototype.simulate = function simulate(e, doc, x, y) {
      var p = this.convertCoords(x, y),
          element = doc === this.doc ? this.getElement(p) : undefined;
      var trigger = element !== undefined,
          notify = false;

      switch (e.type) {
        case 'mousedown':
          {
            if (this.capElement) {
              this.deactivateElement(this.capElement);
              notify = true;
            }
            this.capElement = element;
            if (this.capElement) {
              this.activateElement(this.capElement);
              notify = true;
            }
            break;
          }
        case 'mouseup':
          {
            if (this.capElement) {
              this.deactivateElement(this.capElement);
              notify = true;
            }
            this.timeStamp = e.timeStamp;
            break;
          }
        case 'click':
          {
            trigger = element && this.capElement === element && e.timeStamp === this.timeStamp;
            this.capElement = undefined;
            break;
          }
        case 'mouseenter':
        case 'mouseover':
        case 'mousemove':
          {
            var leaved = null;
            if (this.hovElement !== element && this.hovElement) {
              this.triggerEvent(this.hovElement, e, p, 'mouseout', { relatedTarget: element ? element : null });
              this.leaveElement(this.hovElement);
              leaved = this.hovElement;
              this.hovElement = undefined;
              notify = true;
            }
            if (!this.hovElement && element) {
              this.triggerEvent(element, e, p, 'mouseover', { relatedTarget: leaved });
              this.enterElement(element);
              this.hovElement = element;
              notify = true;
            }
            trigger = element && e.type === 'mousemove';
            break;
          }
        case 'mouseleave':
        case 'mouseout':
          {
            if (this.hovElement) {
              this.triggerEvent(this.hovElement, e, p, 'mouseout', { relatedTarget: e.relatedTarget });
              this.leaveElement(this.hovElement);
              this.hovElement = undefined;
              notify = true;
            }
            trigger = false;
            break;
          }
      }
      if (trigger) {
        this.triggerEvent(element, e, p, e.type);
      }
      if (notify) {
        this.notify();
      }
    };

    DocMouseSimulator.prototype.getDefaultUndefinedProperties = function getDefaultUndefinedProperties() {
      return ['clientX', 'clientY', 'offsetX', 'offsetY', 'screenX', 'screenY'];
    };

    DocMouseSimulator.prototype.getDefaultResendProperties = function getDefaultResendProperties() {
      return ['altKey', 'bubbles', 'button', 'buttons', 'cancelable', 'changedTouches', 'char', 'charCode', 'ctrlKey', 'data', 'detail', 'eventPhase', 'isDefaultPrevented', 'key', 'keyCode', 'metaKey', 'pointerId', 'pointerType', 'shiftKey', 'targetTouches', 'touches', 'which'];
    };

    return DocMouseSimulator;
  }();

  /*
  altKey,
  bubbles,
  button,
  buttons,
  cancelable,
  changedTouches,
  char,
  charCode,
  clientX,
  clientY,
  ctrlKey,
  currentTarget,
  data,
  delegateTarget,
  detail,
  eventPhase,
  handleObj,
  isDefaultPrevented,
  key,
  keyCode,
  metaKey,
  offsetX,
  offsetY,
  originalEvent,
  pageX,
  pageY,
  pointerId,
  pointerType,
  relatedTarget,
  screenX,
  screenY,
  shiftKey,
  target,
  targetTouches,
  timeStamp,
  toElement,
  touches,
  type,
  view,
  which
  */

  DocMouseSimulator.HOVER = 'SIMULATED-HOVER';
  DocMouseSimulator.ACTIVE = 'SIMULATED-ACTIVE';
  exports.default = DocMouseSimulator;

  /***/
},
/* 47 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Dom2Image = function Dom2Image(wnd, doc, cache) {
    _classCallCheck(this, Dom2Image);

    var self = this;
    this.window = wnd;
    this.document = doc;
    this.cache = cache;

    var util = newUtil();
    var inliner = newInliner();
    var fontFaces = newFontFaces();
    var images = newImages();

    this.toSvg = toSvg;
    this.toPng = toPng;
    this.toJpeg = toJpeg;
    this.toBlob = toBlob;
    this.toPixelData = toPixelData;
    this.impl = {
      fontFaces: fontFaces,
      images: images,
      util: util,
      inliner: inliner
    };

    /**
     * @param {Node} node - The DOM Node object to render
     * @param {Object} options - Rendering options
     * @param {Function} options.filter - Should return true if passed node should be included in the output
     *          (excluding node means excluding it's children as well). Not called on the root node.
     * @param {String} options.bgcolor - color for the background, any valid CSS color value.
     * @param {Number} options.width - width to be applied to node before rendering.
     * @param {Number} options.height - height to be applied to node before rendering.
     * @param {Object} options.style - an object whose properties to be copied to node's style before rendering.
     * @param {Number} options.quality - a Number between 0 and 1 indicating image quality (applicable to JPEG only),
                defaults to 1.0.
     * @return {Promise} - A promise that is fulfilled with a SVG image data URL
     * */

    function toSvg(node, options) {
      options = options || {};
      return Promise.resolve(node).then(function (node) {
        return cloneNode(node, options.filter, true);
      }).then(embedFonts).then(inlineImages).then(applyOptions).then(function (clone) {
        return makeSvgDataUri(clone, options.width || util.width(node), options.height || util.height(node));
      });

      function applyOptions(clone) {
        if (options.bgcolor) clone.style.backgroundColor = options.bgcolor;

        if (options.width) clone.style.width = options.width + 'px';
        if (options.height) clone.style.height = options.height + 'px';

        if (options.style) self.window.Object.keys(options.style).forEach(function (property) {
          clone.style[property] = options.style[property];
        });

        return clone;
      }
    }

    /**
     * @param {Node} node - The DOM Node object to render
     * @param {Object} options - Rendering options, @see {@link toSvg}
     * @return {Promise} - A promise that is fulfilled with a Uint8Array containing RGBA pixel data.
     * */
    function toPixelData(node, options) {
      return draw(node, options || {}).then(function (canvas) {
        return canvas.getContext('2d').getImageData(0, 0, util.width(node), util.height(node)).data;
      });
    }

    /**
     * @param {Node} node - The DOM Node object to render
     * @param {Object} options - Rendering options, @see {@link toSvg}
     * @return {Promise} - A promise that is fulfilled with a PNG image data URL
     * */
    function toPng(node, options) {
      return draw(node, options || {}).then(function (canvas) {
        return canvas.toDataURL();
      });
    }

    /**
     * @param {Node} node - The DOM Node object to render
     * @param {Object} options - Rendering options, @see {@link toSvg}
     * @return {Promise} - A promise that is fulfilled with a JPEG image data URL
     * */
    function toJpeg(node, options) {
      options = options || {};
      return draw(node, options).then(function (canvas) {
        return canvas.toDataURL('image/jpeg', options.quality || 1.0);
      });
    }

    /**
     * @param {Node} node - The DOM Node object to render
     * @param {Object} options - Rendering options, @see {@link toSvg}
     * @return {Promise} - A promise that is fulfilled with a PNG image blob
     * */
    function toBlob(node, options) {
      return draw(node, options || {}).then(util.canvasToBlob);
    }

    function draw(domNode, options) {
      return toSvg(domNode, options).then(util.makeImage).then(util.delay(100)).then(function (image) {
        var canvas = newCanvas(domNode);
        canvas.getContext('2d').drawImage(image, 0, 0);
        return canvas;
      });

      function newCanvas(domNode) {
        var canvas = self.document.createElement('canvas');
        canvas.width = options.width || util.width(domNode);
        canvas.height = options.height || util.height(domNode);

        if (options.bgcolor) {
          var ctx = canvas.getContext('2d');
          ctx.fillStyle = options.bgcolor;
          ctx.fillRect(0, 0, canvas.width, canvas.height);
        }

        return canvas;
      }
    }

    function cloneNode(node, filter, root) {
      if (!root && filter && !filter(node)) return Promise.resolve();

      return Promise.resolve(node).then(makeNodeCopy).then(function (clone) {
        return cloneChildren(node, clone, filter);
      }).then(function (clone) {
        return processClone(node, clone);
      });

      function makeNodeCopy(node) {
        if (util.isCanvas(node)) return util.makeImage(node.toDataURL());
        return node.cloneNode(false);
      }

      function cloneChildren(original, clone, filter) {
        var children = original.childNodes;
        if (children.length === 0) return Promise.resolve(clone);

        return cloneChildrenInOrder(clone, util.asArray(children), filter).then(function () {
          return clone;
        });

        function cloneChildrenInOrder(parent, children, filter) {
          var done = Promise.resolve();
          children.forEach(function (child) {
            done = done.then(function () {
              return cloneNode(child, filter);
            }).then(function (childClone) {
              if (childClone) parent.appendChild(childClone);
            });
          });
          return done;
        }
      }

      function processClone(original, clone) {
        if (!util.isElement(clone)) return clone;

        return Promise.resolve().then(cloneStyle).then(clonePseudoElements).then(copyUserInput).then(fixSvg).then(function () {
          return clone;
        });

        function cloneStyle() {
          copyStyle(self.window.getComputedStyle(original), clone.style);

          function copyStyle(source, target) {
            if (source.cssText) target.cssText = source.cssText;else copyProperties(source, target);

            function copyProperties(source, target) {
              util.asArray(source).forEach(function (name) {
                target.setProperty(name, source.getPropertyValue(name), source.getPropertyPriority(name));
              });
            }
          }
        }

        function clonePseudoElements() {
          [':before', ':after'].forEach(function (element) {
            clonePseudoElement(element);
          });

          function clonePseudoElement(element) {
            var style = self.window.getComputedStyle(original, element);
            var content = style.getPropertyValue('content');

            if (content === '' || content === 'none') return;

            var className = util.uid();
            clone.className = clone.className + ' ' + className;
            var styleElement = self.document.createElement('style');
            styleElement.appendChild(formatPseudoElementStyle(className, element, style));
            clone.appendChild(styleElement);

            function formatPseudoElementStyle(className, element, style) {
              var selector = '.' + className + ':' + element;
              var cssText = style.cssText ? formatCssText(style) : formatCssProperties(style);
              return self.document.createTextNode(selector + '{' + cssText + '}');

              function formatCssText(style) {
                var content = style.getPropertyValue('content');
                return style.cssText + ' content: ' + content + ';';
              }

              function formatCssProperties(style) {

                return util.asArray(style).map(formatProperty).join('; ') + ';';

                function formatProperty(name) {
                  return name + ': ' + style.getPropertyValue(name) + (style.getPropertyPriority(name) ? ' !important' : '');
                }
              }
            }
          }
        }

        function copyUserInput() {
          if (util.isTextArea(original)) clone.innerHTML = original.value;
          if (util.isInput(original)) clone.setAttribute("value", original.value);
        }

        function fixSvg() {
          if (!util.isSVG(clone)) return;
          clone.setAttribute('xmlns', 'http://www.w3.org/2000/svg');

          if (!util.isSVGRect(clone)) return;
          ['width', 'height'].forEach(function (attribute) {
            var value = clone.getAttribute(attribute);
            if (!value) return;

            clone.style.setProperty(attribute, value);
          });
        }
      }
    }

    function embedFonts(node) {
      return fontFaces.resolveAll().then(function (cssText) {
        var styleNode = self.document.createElement('style');
        node.appendChild(styleNode);
        styleNode.appendChild(self.document.createTextNode(cssText));
        return node;
      });
    }

    function inlineImages(node) {
      return images.inlineAll(node).then(function () {
        return node;
      });
    }

    function makeSvgDataUri(node, width, height) {
      return Promise.resolve(node).then(function (node) {
        node.setAttribute('xmlns', 'http://www.w3.org/1999/xhtml');
        return new self.window.XMLSerializer().serializeToString(node);
      }).then(util.escapeXhtml).then(function (xhtml) {
        return ['data:image/svg+xml;charset=utf-8,', '<svg xmlns="http://www.w3.org/2000/svg" width="', width, '" height="', height, '">', '<foreignObject x="0" y="0" width="100%" height="100%">', xhtml, '</foreignObject>', '</svg>'].join('');
      });
    }

    function newUtil() {
      return {
        escape: escape,
        parseExtension: parseExtension,
        mimeType: mimeType,
        dataAsUrl: dataAsUrl,
        isDataUrl: isDataUrl,
        canvasToBlob: canvasToBlob,
        resolveUrl: resolveUrl,
        getAndEncode: getAndEncode,
        uid: uid(),
        delay: delay,
        asArray: asArray,
        escapeXhtml: escapeXhtml,
        makeImage: makeImage,
        width: width,
        height: height,

        isElement: isElement,
        isCanvas: isCanvas,
        isTextArea: isTextArea,
        isInput: isInput,
        isSVG: isSVG,
        isSVGRect: isSVGRect,
        isImage: isImage
      };

      function mimes() {
        /*
         * Only WOFF and EOT mime types for fonts are 'real'
         * see http://www.iana.org/assignments/media-types/media-types.xhtml
         */
        var WOFF = 'application/font-woff';
        var JPEG = 'image/jpeg';

        return {
          'woff': WOFF,
          'woff2': WOFF,
          'ttf': 'application/font-truetype',
          'eot': 'application/vnd.ms-fontobject',
          'png': 'image/png',
          'jpg': JPEG,
          'jpeg': JPEG,
          'gif': 'image/gif',
          'tiff': 'image/tiff',
          'svg': 'image/svg+xml'
        };
      }

      function parseExtension(url) {
        var match = /\.([^\.\/]*?)$/g.exec(url);
        if (match) return match[1];else return '';
      }

      function mimeType(url) {
        var extension = parseExtension(url).toLowerCase();
        return mimes()[extension] || '';
      }

      function isDataUrl(url) {
        return url.search(/^(data:)/) !== -1;
      }

      function toBlob(canvas) {
        return new Promise(function (resolve) {
          var binaryString = self.window.atob(canvas.toDataURL().split(',')[1]);
          var length = binaryString.length;
          var binaryArray = new self.window.Uint8Array(length);

          for (var i = 0; i < length; i++) {
            binaryArray[i] = binaryString.charCodeAt(i);
          }resolve(new self.window.Blob([binaryArray], {
            type: 'image/png'
          }));
        });
      }

      function canvasToBlob(canvas) {
        if (canvas.toBlob) return new Promise(function (resolve) {
          canvas.toBlob(resolve);
        });

        return toBlob(canvas);
      }

      function resolveUrl(url, baseUrl) {
        var doc = self.document.implementation.createHTMLDocument();
        var base = doc.createElement('base');
        doc.head.appendChild(base);
        var a = doc.createElement('a');
        doc.body.appendChild(a);
        base.href = baseUrl;
        a.href = url;
        return a.href;
      }

      function uid() {
        var index = 0;

        return function () {
          return 'u' + fourRandomChars() + index++;

          function fourRandomChars() {
            /* see http://stackoverflow.com/a/6248722/2519373 */
            return ('0000' + (self.window.Math.random() * self.window.Math.pow(36, 4) << 0).toString(36)).slice(-4);
          }
        };
      }

      function makeImage(uri) {
        return new Promise(function (resolve, reject) {
          var image = new self.window.Image();
          image.onload = function () {
            resolve(image);
          };
          image.onerror = reject;
          image.src = uri;
        });
      }

      function getAndEncode(url) {
        var data = self.cache.get(url);
        if (data) {
          if (data.content) {
            return data.content;
          } else {
            return new Promise(function (resolve) {
              if (data.content) {
                resolve(data.content);
              } else {
                data.pendings.push(resolve);
              }
            });
          }
        } else {
          data = self.cache.put(url, { pendings: [] });

          var TIMEOUT = 30000;

          return new Promise(function (resolve) {
            var request = new self.window.XMLHttpRequest();

            request.onreadystatechange = done;
            request.ontimeout = timeout;
            request.responseType = 'blob';
            request.timeout = TIMEOUT;
            request.open('GET', url, true);
            request.send();

            function done() {
              if (request.readyState !== 4) return;

              if (request.status !== 200) {
                fail('cannot fetch resource: ' + url + ', status: ' + request.status);
                return;
              }

              var encoder = new self.window.FileReader();
              encoder.onloadend = function () {
                data.content = encoder.result.split(/,/)[1];
                for (var _iterator = data.pendings, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
                  var _ref;

                  if (_isArray) {
                    if (_i >= _iterator.length) break;
                    _ref = _iterator[_i++];
                  } else {
                    _i = _iterator.next();
                    if (_i.done) break;
                    _ref = _i.value;
                  }

                  var _resolve = _ref;

                  _resolve(data.content);
                }
                data.pendings = [];
                resolve(data.content);
              };
              encoder.readAsDataURL(request.response);
            }

            function timeout() {
              fail('timeout of ' + TIMEOUT + 'ms occured while fetching resource: ' + url);
            }

            function fail(message) {
              console.error(message);
              resolve('');
            }
          });
        }
      }

      function dataAsUrl(content, type) {
        return ['data:', type, ';base64,', content].join('');
      }

      function escape(string) {
        return string.replace(/([.*+?^${}()|\[\]\/\\])/g, '\\$1');
      }

      function delay(ms) {
        return function (arg) {
          return new Promise(function (resolve) {
            setTimeout(function () {
              resolve(arg);
            }, ms);
          });
        };
      }

      function asArray(arrayLike) {
        var array = [];
        var length = arrayLike.length;
        for (var i = 0; i < length; i++) {
          array.push(arrayLike[i]);
        }return array;
      }

      function escapeXhtml(string) {
        return string.replace(/(#|\n)/g, function (c) {
          return c === '#' ? '%23' : '%0A';
        });
      }

      function width(node) {
        var leftBorder = px(node, 'border-left-width');
        var rightBorder = px(node, 'border-right-width');
        return node.scrollWidth + leftBorder + rightBorder;
      }

      function height(node) {
        var topBorder = px(node, 'border-top-width');
        var bottomBorder = px(node, 'border-bottom-width');
        return node.scrollHeight + topBorder + bottomBorder;
      }

      function px(node, styleProperty) {
        var value = self.window.getComputedStyle(node).getPropertyValue(styleProperty);
        return parseFloat(value.replace('px', ''));
      }

      function isElement(node) {
        return node instanceof self.window.Element;
      }

      function isCanvas(node) {
        return node instanceof self.window.HTMLCanvasElement;
      }

      function isTextArea(node) {
        return node instanceof self.window.HTMLTextAreaElement;
      }

      function isInput(node) {
        return node instanceof self.window.HTMLInputElement;
      }

      function isSVG(node) {
        return node instanceof self.window.SVGElement;
      }

      function isSVGRect(node) {
        return node instanceof self.window.SVGRectElement;
      }

      function isImage(node) {
        return node instanceof self.window.HTMLImageElement;
      }
    }

    function newInliner() {
      var URL_REGEX = /url\(['"]?([^'"]+?)['"]?\)/g;

      return {
        inlineAll: inlineAll,
        shouldProcess: shouldProcess,
        impl: {
          readUrls: readUrls,
          inline: inline
        }
      };

      function shouldProcess(string) {
        return string.search(URL_REGEX) !== -1;
      }

      function readUrls(string) {
        var result = [];
        var match = void 0;
        while ((match = URL_REGEX.exec(string)) !== null) {
          result.push(match[1]);
        }
        return result.filter(function (url) {
          return !util.isDataUrl(url);
        });
      }

      function inline(string, url, baseUrl, get) {
        return Promise.resolve(url).then(function (url) {
          return baseUrl ? util.resolveUrl(url, baseUrl) : url;
        }).then(get || util.getAndEncode).then(function (data) {
          return util.dataAsUrl(data, util.mimeType(url));
        }).then(function (dataUrl) {
          return string.replace(urlAsRegex(url), ['$1', dataUrl, '$3'].join(''));
        });

        function urlAsRegex(url) {
          return new self.window.RegExp(['(url\\([\'"]?)(', util.escape(url), ')([\'"]?\\))'].join(''), 'g');
        }
      }

      function inlineAll(string, baseUrl, get) {
        if (nothingToInline()) return Promise.resolve(string);

        return Promise.resolve(string).then(readUrls).then(function (urls) {
          var done = Promise.resolve(string);
          urls.forEach(function (url) {
            done = done.then(function (string) {
              return inline(string, url, baseUrl, get);
            });
          });
          return done;
        });

        function nothingToInline() {
          return !shouldProcess(string);
        }
      }
    }

    function newFontFaces() {
      return {
        resolveAll: resolveAll,
        impl: {
          readAll: readAll
        }
      };

      function resolveAll() {
        return readAll(self.document).then(function (webFonts) {
          return Promise.all(webFonts.map(function (webFont) {
            return webFont.resolve();
          }));
        }).then(function (cssStrings) {
          return cssStrings.join('\n');
        });
      }

      function readAll() {
        return Promise.resolve(util.asArray(self.document.styleSheets)).then(getCssRules).then(selectWebFontRules).then(function (rules) {
          return rules.map(newWebFont);
        });

        function selectWebFontRules(cssRules) {
          return cssRules.filter(function (rule) {
            return rule.type === CSSRule.FONT_FACE_RULE;
          }).filter(function (rule) {
            return inliner.shouldProcess(rule.style.getPropertyValue('src'));
          });
        }

        function getCssRules(styleSheets) {
          var cssRules = [];
          styleSheets.forEach(function (sheet) {
            try {
              util.asArray(sheet.cssRules || []).forEach(cssRules.push.bind(cssRules));
            } catch (e) {
              console.log('Error while reading CSS rules from ' + sheet.href, e.toString());
            }
          });
          return cssRules;
        }

        function newWebFont(webFontRule) {
          return {
            resolve: function resolve() {
              var baseUrl = (webFontRule.parentStyleSheet || {}).href;
              return inliner.inlineAll(webFontRule.cssText, baseUrl);
            },
            src: function src() {
              return webFontRule.style.getPropertyValue('src');
            }
          };
        }
      }
    }

    function newImages() {
      return {
        inlineAll: inlineAll,
        impl: {
          newImage: newImage
        }
      };

      function newImage(element) {
        return {
          inline: inline
        };

        function inline(get) {
          if (util.isDataUrl(element.src)) return Promise.resolve();

          return Promise.resolve(element.src).then(get || util.getAndEncode).then(function (data) {
            return util.dataAsUrl(data, util.mimeType(element.src));
          }).then(function (dataUrl) {
            return new Promise(function (resolve, reject) {
              element.onload = resolve;
              element.onerror = reject;
              element.src = dataUrl;
            });
          });
        }
      }

      function inlineAll(node) {
        if (!util.isElement(node)) return Promise.resolve(node);

        return inlineBackground(node).then(function () {
          if (util.isImage(node)) return newImage(node).inline();else return Promise.all(util.asArray(node.childNodes).map(function (child) {
            return inlineAll(child);
          }));
        });

        function inlineBackground(node) {
          var background = node.style.getPropertyValue('background');

          if (!background) return Promise.resolve(node);

          return inliner.inlineAll(background).then(function (inlined) {
            node.style.setProperty('background', inlined, node.style.getPropertyPriority('background'));
          }).then(function () {
            return node;
          });
        }
      }
    }
  };

  exports.default = Dom2Image;

  /***/
},
/* 48 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Drag = function () {
    function Drag(wnd, doc, visualWorld) {
      _classCallCheck(this, Drag);

      this.wnd = wnd;
      this.doc = doc;
      this.visual = visualWorld;
      this.coords = new _libs.THREE.Vector2();
      this.intersection = new _libs.THREE.Vector3();
      this.raycaster = this.visual.raycaster;
      this.camera = this.visual.camera;
      this.plane = new _libs.THREE.Plane();
      this.threes = [];
      this.selected = null;
      this.enabled = true;
      this.controlsState = this.visual.getControlsState();

      this.element = this.visual.element;
      this.binds = {
        onMouseMove: this.onMouseMove.bind(this),
        onMouseDown: this.onMouseDown.bind(this),
        onMouseUp: this.onMouseUp.bind(this)
      };
      (0, _libs.$)(this.element).on('mousemove', this.binds.onMouseMove);
      (0, _libs.$)(this.element).on('mousedown', this.binds.onMouseDown);
      (0, _libs.$)(this.doc).on('mouseup', this.binds.onMouseUp);
    }

    Drag.prototype.addThree = function addThree(three) {
      this.threes.push(three);
    };

    Drag.prototype.removeThree = function removeThree(three) {
      var i = this.threes.indexOf(three);
      if (~i) {
        this.threes.splice(i, 1);
      }
    };

    Drag.prototype.onPickCallback = function onPickCallback() {
      return true;
    };

    Drag.prototype.onDragCallback = function onDragCallback() {
      return true;
    };

    Drag.prototype.onReleaseCallback = function onReleaseCallback() {};

    Drag.prototype.dispose = function dispose() {
      (0, _libs.$)(this.element).off('mousemove', this.binds.onMouseMove);
      (0, _libs.$)(this.element).off('mousedown', this.binds.onMouseDown);
      (0, _libs.$)(this.doc).off('mouseup', this.binds.onMouseUp);
    };

    Drag.prototype.setCoordsFromEvent = function setCoordsFromEvent(e) {
      var jElement = (0, _libs.$)(this.element);
      var offset = jElement.offset();
      this.coords.x = (e.pageX - offset.left) / jElement.width() * 2 - 1;
      this.coords.y = -((e.pageY - offset.top) / jElement.height()) * 2 + 1;
      return this.coords;
    };

    Drag.prototype.onMouseDown = function onMouseDown(e) {
      if (!this.enabled) return;

      if (this.selected) this.onMouseUp(e);

      this.setCoordsFromEvent(e);
      this.raycaster.setFromCamera(this.coords, this.camera);

      var intersects = this.raycaster.intersectObjects(this.threes);
      if (intersects.length > 0) {
        var selected = intersects[0].object;
        if (!this.onPickCallback(intersects[0])) return;
        var v = intersects[0].point.clone();
        this.distance = v.sub(this.raycaster.ray.origin).length();;
        this.controlsState = this.visual.getControlsState();
        this.visual.setControlsState(false);
        this.plane.setFromNormalAndCoplanarPoint(this.visual.camera.getWorldDirection(this.plane.normal), intersects[0].point);
        //this.plane.setFromNormalAndCoplanarPoint(this.plane.normal.set(0,0,1), new THREE.Vector3(0,0,0));
        this.selected = selected;
      }
    };

    Drag.prototype.onMouseMove = function onMouseMove(e) {
      if (!this.enabled) return;
      e.preventDefault();

      if (this.selected) {
        this.setCoordsFromEvent(e);
        this.raycaster.setFromCamera(this.coords, this.camera);
        if (this.raycaster.ray.intersectPlane(this.plane, this.intersection)) {
          if (!this.onDragCallback(this.intersection)) this.onMouseUp(e);
        } /**/
        //this.intersection.copy(this.raycaster.ray.direction).normalize().multiplyScalar(this.distance).add(this.raycaster.ray.origin);/**/
        //if(!this.onDragCallback(this.selected, this.intersection)) this.onMouseUp(e);
      }
    };

    Drag.prototype.onMouseUp = function onMouseUp(e) {
      if (this.selected) {
        this.onReleaseCallback();
        this.selected = null;
        this.visual.setControlsState(this.controlsState);
      }
      if (!this.enabled) return;
      e.preventDefault();
    };

    return Drag;
  }();

  exports.default = Drag;

  /***/
},
/* 49 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  __webpack_require__(71)(_libs.$);

  var EventsToActions = function () {
    EventsToActions.getEventFlags = function getEventFlags(e) {
      return e.ctrlKey << 0 | e.shiftKey << 1 | e.altKey << 2;
    };

    EventsToActions.getPosition = function getPosition(touches) {
      var x = void 0,
          y = void 0;
      if (touches.length === 2) {
        x = touches[1].pageX - touches[0].pageX;
        y = touches[1].pageY - touches[0].pageY;
        y = -Math.sqrt(x * x + y * y);
        x = 0;
      } else {
        x = touches[0].pageX;
        y = touches[0].pageY;
      }
      return {
        x: x,
        y: y
      };
    };

    function EventsToActions(element, actions) {
      _classCallCheck(this, EventsToActions);

      this.actions = actions || {};
      this.element = element;
      this.doc = element[0].ownerDocument;
      this.wnd = this.doc.defaultView;
      this.enabled = true;

      this.binds = {
        contextMenu: this.contextMenu.bind(this),

        mouseDown: this.mouseDown.bind(this),
        mouseMove: this.mouseMove.bind(this),
        mouseUp: this.mouseUp.bind(this),
        mouseWheel: this.mouseWheel.bind(this),

        mouseMoveDoc: this.mouseMoveDoc.bind(this),
        mouseUpDoc: this.mouseUpDoc.bind(this),

        click: this.click.bind(this),
        dblclick: this.dblclick.bind(this),

        touchStart: this.touchStart.bind(this),
        touchMove: this.touchMove.bind(this),
        touchEnd: this.touchEnd.bind(this),

        keyDown: this.keyDown.bind(this),
        keyPress: this.keyPress.bind(this),
        keyUp: this.keyUp.bind(this)
      };

      this.element.on('contextmenu', this.binds.contextMenu);

      this.element.on('mousedown', this.binds.mouseDown);
      this.element.on('mousemove', this.binds.mouseMove);
      this.element.on('mouseup', this.binds.mouseUp);
      this.element.on('mousewheel', this.binds.mouseWheel);

      (0, _libs.$)(this.doc).on('mousemove', this.binds.mouseMoveDoc);
      (0, _libs.$)(this.doc).on('mouseup', this.binds.mouseUpDoc);

      this.element.on('click', this.binds.click);
      this.element.on('dblclick', this.binds.dblclick);

      this.element.on('touchstart', this.binds.touchStart);
      this.element.on('touchmove', this.binds.touchMove);
      this.element.on('touchend', this.binds.touchEnd);

      (0, _libs.$)(this.wnd).on('keydown', this.binds.keyDown);
      (0, _libs.$)(this.wnd).on('keypress', this.binds.keyPress);
      (0, _libs.$)(this.wnd).on('keyup', this.binds.keyUp);
    }

    EventsToActions.prototype.addAction = function addAction(action, type, code, flags) {
      type = type.toLowerCase();
      if (!this.actions[type]) {
        this.actions[type] = {};
      }
      if (!this.actions[type][code]) {
        this.actions[type][code] = {};
      }
      if (!this.actions[type][code][flags]) {
        this.actions[type][code][flags] = [];
      }
      this.actions[type][code][flags].push(action);
    };

    EventsToActions.prototype.getActions = function getActions(type, code, flags) {
      return ((this.actions[type] || {})[code] || {})[flags] || [];
    };

    EventsToActions.prototype.fireActions = function fireActions(actions, e, data) {
      for (var _iterator = actions, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var action = _ref;

        action(e, data);
      }
    };

    EventsToActions.prototype.contextMenu = function contextMenu(e) {
      if (this.enabled) {
        var flags = EventsToActions.getEventFlags(e);
        this.fireActions(this.getActions('contextmenu', e.button, flags), e);
      }
    };

    EventsToActions.prototype.mouseDown = function mouseDown(e) {
      if (this.picked) {
        this.mouseUpDoc();
      }
      if (this.enabled) {
        var flags = EventsToActions.getEventFlags(e);
        this.fireActions(this.getActions('mousedown', e.button, flags), e);
        this.picked = {
          x: e.pageX,
          y: e.pageY,
          actions: this.getActions('mousedrag', e.button, flags)
        };
        this.fireActions(this.picked.actions, e, {
          state: 'start'
        });
      }
    };

    EventsToActions.prototype.mouseMove = function mouseMove(e) {
      if (this.enabled) {
        var flags = EventsToActions.getEventFlags(e);
        this.fireActions(this.getActions('mousemove', e.button, flags), e);
      }
    };

    EventsToActions.prototype.mouseMoveDoc = function mouseMoveDoc(e) {
      if (this.enabled && this.picked) {
        this.fireActions(this.picked.actions, e, {
          state: 'move',
          dx: e.pageX - this.picked.x,
          dy: e.pageY - this.picked.y
        });
        this.picked = {
          x: e.pageX,
          y: e.pageY,
          actions: this.picked.actions
        };
      }
    };

    EventsToActions.prototype.mouseUp = function mouseUp(e) {
      if (this.enabled) {
        var flags = EventsToActions.getEventFlags(e);
        this.fireActions(this.getActions('mouseup', e.button, flags), e);
      }
    };

    EventsToActions.prototype.mouseUpDoc = function mouseUpDoc(e) {
      if (this.picked) {
        this.fireActions(this.picked.actions, e, {
          state: 'end'
        });
        delete this.picked;
      }
    };

    EventsToActions.prototype.mouseWheel = function mouseWheel(e) {
      if (this.enabled) {
        var flags = EventsToActions.getEventFlags(e);
        this.fireActions(this.getActions('mousewheel', 0, flags), e);
      }
    };

    EventsToActions.prototype.clicks = function clicks(e, type) {
      if (this.enabled) {
        var flags = EventsToActions.getEventFlags(e);
        this.fireActions(this.getActions(type, e.button, flags), e);
      }
    };

    EventsToActions.prototype.click = function click(e) {
      this.clicks(e, 'click');
    };

    EventsToActions.prototype.dblclick = function dblclick(e) {
      this.clicks(e, 'dblclick');
    };

    EventsToActions.prototype.touchPick = function touchPick(e, flags, touches) {
      this.touchPicked = _extends({}, EventsToActions.getPosition(touches), {
        actions: this.getActions('touchdrag', touches.length, flags),
        code: touches.length,
        flags: flags
      });
      this.fireActions(this.touchPicked.actions, e, {
        state: 'start'
      });
    };

    EventsToActions.prototype.touchStart = function touchStart(e) {
      if (this.touchPicked) {
        this.touchEnd(e);
      }
      if (this.enabled) {
        var flags = EventsToActions.getEventFlags(e),
            touches = e.touches || e.originalEvent.touches;
        this.fireActions(this.getActions('touchstart', touches.length, flags), e);
        this.touchPick(e, flags, touches);
      }
    };

    EventsToActions.prototype.touchMove = function touchMove(e) {
      if (this.enabled) {
        var flags = EventsToActions.getEventFlags(e),
            touches = e.touches || e.originalEvent.touches;
        this.fireActions(this.getActions('touchmove', touches.length, flags), e);
        if (this.touchPicked) {
          if (this.touchPicked.code === touches.length && this.touchPicked.flags === flags) {
            var pos = EventsToActions.getPosition(touches);
            this.fireActions(this.touchPicked.actions, e, {
              state: 'move',
              dx: pos.x - this.touchPicked.x,
              dy: pos.y - this.touchPicked.y
            });
            this.touchPicked = _extends({}, this.touchPicked, pos);
          } else {
            this.touchEnd(e);
            this.touchPick(e, flags, touches);
          }
        }
      }
    };

    EventsToActions.prototype.touchEnd = function touchEnd(e) {
      if (this.touchPicked) {
        this.fireActions(this.touchPicked.actions, e, {
          state: 'end'
        });
        delete this.touchPicked;
      }
    };

    EventsToActions.prototype.key = function key(e, type) {
      if (this.enabled) {
        var flags = EventsToActions.getEventFlags(e);
        this.fireActions(this.getActions(type, e.keyCode, flags), e);
      }
    };

    EventsToActions.prototype.keyDown = function keyDown(e) {
      this.key(e, 'keydown');
    };

    EventsToActions.prototype.keyPress = function keyPress(e) {
      this.key(e, 'keypress');
    };

    EventsToActions.prototype.keyUp = function keyUp(e) {
      this.key(e, 'keyup');
    };

    EventsToActions.prototype.dispose = function dispose() {
      this.element.off('contextmenu', this.binds.contextMenu);

      this.element.off('mousedown', this.binds.mouseDown);
      this.element.off('mousemove', this.binds.mouseMove);
      this.element.off('mouseup', this.binds.mouseUp);
      this.element.off('mousewheel', this.binds.mouseWheel);

      (0, _libs.$)(this.doc).off('mousemove', this.binds.mouseMoveDoc);
      (0, _libs.$)(this.doc).off('mouseup', this.binds.mouseUpDoc);

      this.element.off('click', this.binds.click);
      this.element.off('dblclick', this.binds.dblclick);

      this.element.off('touchstart', this.binds.touchStart);
      this.element.off('touchmove', this.binds.touchMove);
      this.element.off('touchend', this.binds.touchEnd);

      (0, _libs.$)(this.wnd).off('keydown', this.binds.keyDown);
      (0, _libs.$)(this.wnd).off('keypress', this.binds.keyPress);
      (0, _libs.$)(this.wnd).off('keyup', this.binds.keyUp);
    };

    return EventsToActions;
  }();

  EventsToActions.modKeys = {
    Ctrl: 1,
    Shift: 2,
    Alt: 4
  };
  EventsToActions.mouseButtons = {
    Left: 0,
    Middle: 1,
    Right: 2
  };
  exports.default = EventsToActions;

  /***/
},
/* 50 */
/***/function (module, exports) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var FullScreen = function () {
    function FullScreen() {
      _classCallCheck(this, FullScreen);
    }

    FullScreen.available = function available() {
      return FullScreen._hasWebkitFullScreen || FullScreen._hasMozFullScreen || FullScreen._hasMsFullscreen;
    };

    FullScreen.activated = function activated() {
      if (FullScreen._hasWebkitFullScreen) {
        return document.webkitIsFullScreen;
      } else if (FullScreen._hasMozFullScreen) {
        return document.mozFullScreen;
      } else if (FullScreen._hasMsFullscreen) {
        return !!document.msFullscreenElement;
      } else {
        console.assert(false);
      }
    };

    FullScreen.addEventListener = function addEventListener(element, handler) {
      if (element.addEventListener) {
        element.addEventListener('webkitfullscreenchange', handler, false);
        element.addEventListener('mozfullscreenchange', handler, false);
        element.addEventListener('fullscreenchange', handler, false);
        element.addEventListener('MSFullscreenChange', handler, false);
      }
    };

    FullScreen.removeEventListener = function removeEventListener(element, handler) {
      if (element.removeEventListener) {
        element.removeEventListener('webkitfullscreenchange', handler, false);
        element.removeEventListener('mozfullscreenchange', handler, false);
        element.removeEventListener('fullscreenchange', handler, false);
        element.removeEventListener('MSFullscreenChange', handler, false);
      }
    };

    FullScreen.request = function request(element) {
      element = element || document.body;
      if (FullScreen._hasWebkitFullScreen) {
        element.webkitRequestFullScreen();
      } else if (FullScreen._hasMozFullScreen) {
        element.mozRequestFullScreen();
      } else if (FullScreen._hasMsFullscreen) {
        element.msRequestFullscreen();
      } else {
        console.assert(false);
      }
    };

    FullScreen.cancel = function cancel() {
      if (FullScreen._hasWebkitFullScreen) {
        document.webkitCancelFullScreen();
      } else if (FullScreen._hasMozFullScreen) {
        document.mozCancelFullScreen();
      } else if (FullScreen._hasMsFullscreen) {
        document.msExitFullscreen();
      } else {
        console.assert(false);
      }
    };

    return FullScreen;
  }();

  FullScreen._hasWebkitFullScreen = !!document.webkitCancelFullScreen;
  FullScreen._hasMozFullScreen = !!document.mozCancelFullScreen;
  FullScreen._hasMsFullscreen = !!document.documentElement.msRequestFullscreen;
  exports.default = FullScreen;

  /***/
},
/* 51 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _ImageBase2 = __webpack_require__(5);

  var _ImageBase3 = _interopRequireDefault(_ImageBase2);

  var _BaseMathUtils = __webpack_require__(2);

  var _BaseMathUtils2 = _interopRequireDefault(_BaseMathUtils);

  var _Dom2Image = __webpack_require__(47);

  var _Dom2Image2 = _interopRequireDefault(_Dom2Image);

  var _DocMouseSimulator = __webpack_require__(46);

  var _DocMouseSimulator2 = _interopRequireDefault(_DocMouseSimulator);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var InteractiveImage = function (_ImageBase) {
    _inherits(InteractiveImage, _ImageBase);

    function InteractiveImage(context, width, height, color, src, cache, injector) {
      _classCallCheck(this, InteractiveImage);

      var _this = _possibleConstructorReturn(this, _ImageBase.call(this, context, width, height, color));

      _this.iId = 'i' + _BaseMathUtils2.default.getUnique();
      var jFrame = (0, _libs.$)('<iframe id="' + _this.iId + '" src="' + src + '" style="position: fixed; left: -1000px;"></iframe>');
      (0, _libs.$)(_this.doc.body).append(jFrame);
      _this.frame = jFrame[0];

      _this.binds = {};

      if (injector) {
        injector(_this.frame.contentWindow);
      }

      if (_this.doc.implementation.hasFeature('www.http://w3.org/TR/SVG11/feature#Extensibility', '1.1')) {
        // svg foreignObject renderer
        _this.image = new Image();
        _this.binds.imageLoad = function () {
          _this.renderImage(_this.image);
          _this.finishRender();
        };
        (0, _libs.$)(_this.image).on('load', _this.binds.imageLoad);
        _this.svgRender = new _Dom2Image2.default(_this.frame.contentWindow, _this.frame.contentDocument, cache);
      } // otherwise - html2canvas

      _this.binds.frameLoad = function () {
        if (~_this.frame.contentDocument.title.indexOf('404')) {
          _this.startRender = function () {
            _this.renderNotFoundPage();
            _this.finishRender();
          };
          _this.finishLoad();
        } else {
          setTimeout(function () {
            if (_this.frame) {
              _this.width = (0, _libs.$)(_this.frame.contentDocument.body).width();
              _this.height = (0, _libs.$)(_this.frame.contentDocument.body).height();
              jFrame.css('width', _this.width + 'px').css('height', _this.height + 'px');
              jFrame.offset({ left: -_this.width - 100, top: 0 });
              if (_this.svgRender) {
                _this.simulator = new _DocMouseSimulator2.default(jFrame, _this.frame.contentDocument.body, _this.element);
                _this.simulator.addDocChangeClb(_this.finishLoad.bind(_this));
              }
              _this.startRender = function () {
                _this.render();
              };
              _this.finishLoad();
            }
          }, 500);
        }
      };
      (0, _libs.$)(_this.frame.contentWindow).on('load', _this.binds.frameLoad);
      return _this;
    }

    InteractiveImage.prototype.getSimulatedDoc = function getSimulatedDoc() {
      return this.frame.contentDocument;
    };

    InteractiveImage.prototype.render = function render() {
      var _this2 = this;

      if (this.svgRender) {
        this.svgRender.toSvg(this.simulator.element, { height: this.height + 'px', width: this.width + 'px' }).then(function (dataUrl) {
          _this2.image.src = dataUrl;
        }).catch(function (error) {
          console.error('Dom2Image: ', error);
          _this2.renderBlankPage();
          _this2.finishRender();
        });
      } else {
        (0, _libs.html2canvas)(this.frame.contentDocument.body, { timeout: 30000 }).then(function (canvas) {
          _this2.renderImage(canvas);
          _this2.finishRender();
        });
      }
    };

    InteractiveImage.prototype.dispose = function dispose() {
      (0, _libs.$)(this.image).off('load', this.binds.imageLoad);
      (0, _libs.$)(this.frame.contentWindow).off('load', this.binds.frameLoad);
      (0, _libs.$)(this.doc.body).find('#' + this.iId).remove();
      if (this.image) {
        this.image.src = '';
        delete this.image;
      }
      this.frame.src = '';
      delete this.frame;
      _ImageBase.prototype.dispose.call(this);
    };

    InteractiveImage.prototype.simulate = function simulate(e, doc, x, y) {
      if (this.simulator) {
        this.simulator.simulate(e, doc, x, y);
      }
    };

    return InteractiveImage;
  }(_ImageBase3.default);

  exports.default = InteractiveImage;

  /***/
},
/* 52 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _GraphUtils = __webpack_require__(7);

  var _GraphUtils2 = _interopRequireDefault(_GraphUtils);

  var _MathUtils = __webpack_require__(3);

  var _MathUtils2 = _interopRequireDefault(_MathUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var LoadingAnimation = function () {
    LoadingAnimation.prototype.dy = function dy(t, y) {
      var w = y[0],
          a = y[1];
      return [-this.g * Math.cos(a), w];
    };

    LoadingAnimation.prototype.integrate = function integrate(T) {
      var t = 0,
          dt = this.p.dt,
          os = this.os;
      while (t < T) {
        if (t + dt > T) {
          dt = T - t;
        }
        os = _MathUtils2.default.rk4(this.dy.bind({ g: this.p.g }), 0, dt, os);
        t += dt;
      }
      return os;
    };

    LoadingAnimation.prototype.calcTimeTo = function calcTimeTo(target) {
      var t = 0,
          dt = this.p.dt,
          os = this.os;
      while (Math.abs(os[1] - target) > 1e-4) {
        var nos = _MathUtils2.default.rk4(this.dy.bind({ g: this.p.g }), 0, dt, os);
        if (nos[0] < 0 && nos[1] < target || nos[0] > 0 && nos[1] > target) {
          dt /= 2;
        } else {
          os = nos;
          t += dt;
        }
      }
      return t;
    };

    LoadingAnimation.prototype.update = function update(T) {
      this.os = this.integrate(T);

      this.t += T;
      if (this.t >= this.p.updateInterval) {
        this.t = 0;
        var r = 0.06 * Math.min(this.c.width, this.c.height),
            a = this.os[1],
            x0 = 0.5 * this.c.width,
            y0 = 0.5 * this.c.height,
            ctx = this.ctx;

        ctx.clearRect(0, 0, this.c.width, this.c.height);
        ctx.beginPath();
        ctx.fillStyle = _GraphUtils2.default.color2Rgba(this.p.color, 1);
        ctx.rect(0, 0, this.c.width, this.c.height);
        ctx.fill();

        ctx.beginPath();
        ctx.shadowBlur = 50;
        ctx.fillStyle = _GraphUtils2.default.color2Rgba(_GraphUtils2.default.inverseColor(this.p.color, 0.9), Math.abs(this.os[0] / 6.36));
        ctx.shadowColor = _GraphUtils2.default.color2Rgba(_GraphUtils2.default.inverseColor(this.p.color, 1), 0.9);
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 0;
        ctx.font = 'bold ' + Math.round(0.25 * r) + 'px Arial';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText((0, _libs.tr)('Loading...'), x0, y0);

        var ps = 10,
            da = 2 * Math.PI / ps; //2.5*_r/r
        ctx.shadowColor = _GraphUtils2.default.color2Rgba(_GraphUtils2.default.inverseColor(this.p.color, 1), 0.7);
        for (var i = 0, _a = a, _r = 0.2 * r; i < ps; ++i, _r *= 0.9, _a += da) {
          ctx.beginPath();
          ctx.fillStyle = _GraphUtils2.default.color2Rgba(_GraphUtils2.default.inverseColor(this.p.color, (ps - i) / ps), 0.7 * (ps - i) / ps);
          var cx = x0 + r * Math.cos(_a),
              cy = y0 - r * Math.sin(_a),
              nx = x0 + r * Math.cos(_a + da),
              ny = y0 - r * Math.sin(_a + da);
          ctx.shadowOffsetX = 0.2 * (nx - cx);
          ctx.shadowOffsetY = 0.2 * (ny - cy);
          ctx.arc(cx, cy, _r, 0, Math.PI * 2, 1);
          ctx.fill();
        }
        if (this.onChange) {
          this.onChange(this.c, this.p.color);
        }
      }
    };

    LoadingAnimation.prototype.getImage = function getImage() {
      return this.c;
    };

    LoadingAnimation.prototype.dispose = function dispose() {
      this.c.width = 0;
      this.c.height = 0;
      delete this.ctx;
      delete this.c;
    };

    LoadingAnimation.prototype.createSprite = function createSprite(n) {
      var c = (0, _libs.$)('<canvas width="' + this.c.width * n + '" height="' + this.c.height + '"></canvas>')[0],
          ctx = c.getContext('2d'),
          t = this.calcTimeTo(this.os[1] + Math.sign(this.os[0]) * 2 * Math.PI),
          dt = t / (n + 1);
      var updateInterval = this.p.updateInterval;

      this.p.updateInterval = 0;
      for (var i = 0; i < n; ++i) {
        this.update(dt);
        ctx.drawImage(this.c, i * this.c.width, 0);
      }
      this.p.updateInterval = updateInterval;
      return c;
    };

    function LoadingAnimation(width, height, color) {
      _classCallCheck(this, LoadingAnimation);

      var jC = (0, _libs.$)('<canvas width="' + width + '" height="' + height + '"></canvas>');
      this.c = jC[0];
      this.p = {
        g: 9.8,
        dt: 1 / 60,
        color: color,
        updateInterval: 0.25
      };
      this.ctx = this.c.getContext('2d');
      this.os = [-2, Math.PI / 2];
      this.t = this.p.updateInterval;
    }

    return LoadingAnimation;
  }();

  exports.default = LoadingAnimation;

  /***/
},
/* 53 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var LoadingController = function () {
    function LoadingController(view) {
      var showProgress = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      var loadingMsg = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : undefined;

      _classCallCheck(this, LoadingController);

      this.view = view;
      this.progress = 0;
      this.showProgress = showProgress;
      this.getLoadingMsg = loadingMsg || LoadingController.defaultLoadingMsg;
      this.updateView();
    }

    LoadingController.defaultLoadingMsg = function defaultLoadingMsg(progress) {
      return ['Please wait... the Application is Loading: ', progress, '%'].join('');
    };

    LoadingController.prototype.dispose = function dispose() {
      this.showProgress = false;
      this.updateView();
      delete this.view;
    };

    LoadingController.prototype.setProgress = function setProgress(v) {
      this.progress = v;
      this.updateView();
    };

    LoadingController.prototype.updateView = function updateView() {
      if (this.view) {

        this.view.setState('widLoadingProgress', {
          enable: true,
          visible: this.showProgress,
          active: false
        });

        this.view.setState('txtLoadingProgress', {
          value: this.getLoadingMsg(this.progress),
          visible: true
        });

        for (var _iterator = this.view.getLinks(), _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
          var _ref;

          if (_isArray) {
            if (_i >= _iterator.length) break;
            _ref = _iterator[_i++];
          } else {
            _i = _iterator.next();
            if (_i.done) break;
            _ref = _i.value;
          }

          var name = _ref;

          this.view.setState(name, {
            enable: false,
            visible: true,
            active: false
          });
        }

        this.view.setState('inpPages', {
          visible: true,
          value: ''
        });

        this.view.setState('inpPage', {
          visible: true,
          enable: false,
          value: ''
        });
      }
    };

    return LoadingController;
  }();

  exports.default = LoadingController;

  /***/
},
/* 54 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _EventConverter2 = __webpack_require__(6);

  var _EventConverter3 = _interopRequireDefault(_EventConverter2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var MouseEventConverter = function (_EventConverter) {
    _inherits(MouseEventConverter, _EventConverter);

    function MouseEventConverter(wnd, doc, element) {
      _classCallCheck(this, MouseEventConverter);

      var _this = _possibleConstructorReturn(this, _EventConverter.call(this, wnd, doc));

      _this.element = element;
      _this.binds = {
        convert: _this.convert.bind(_this)
      };
      (0, _libs.$)(_this.element).on('mousemove mousedown mouseover mouseout click', _this.binds.convert);
      (0, _libs.$)(_this.doc).on('mouseup', _this.binds.convert);
      return _this;
    }

    MouseEventConverter.prototype.dispose = function dispose() {
      (0, _libs.$)(this.element).off('mousemove mousedown mouseover mouseout click', this.binds.convert);
      (0, _libs.$)(this.doc).off('mouseup', this.binds.convert);
    };

    return MouseEventConverter;
  }(_EventConverter3.default);

  exports.default = MouseEventConverter;

  /***/
},
/* 55 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(0);

  var _MathUtils = __webpack_require__(3);

  var _MathUtils2 = _interopRequireDefault(_MathUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Object3DWatcher = function () {
    function Object3DWatcher(visual, boundBoxClb) {
      var testScale = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : this.testScale;

      _classCallCheck(this, Object3DWatcher);

      this.visual = visual;
      this.boundBoxClb = boundBoxClb;
      this.testScale = testScale;
      this.camera = visual.camera;
      this.element = this.visual.element;
      this.elementSize = { w: 1, h: 1 };
      this.devicePixelRatio = this.visual.wnd.devicePixelRatio || 1;
      this.orbit = visual.getOrbit();
      this.scale = 1;

      this.eps = 1e-4;
      this.v = new _libs.THREE.Vector3();
      this.dv = new _libs.THREE.Vector2();

      this.enabled = false;

      visual.addRenderCallback(this.update.bind(this));

      this.os = {
        vx: 0,
        vy: 0,
        x: 0,
        y: 0
      };
      this.orbit.update();
      this.camera.updateMatrixWorld();
      var box = this.computeClientBoundBox(),
          k = 1.11;
      this.movePan({ x: -k * box.mid.x, y: -k * box.mid.y });
    }

    Object3DWatcher.prototype.movePan = function movePan(dv) {
      this.orbit.pan(dv.x * this.visual.width(), -dv.y * this.visual.height());
    };

    Object3DWatcher.prototype.vToCamera = function vToCamera(v) {
      v.project(this.camera);
      return {
        x: 0.5 * v.x,
        y: 0.5 * v.y
      };
    };

    Object3DWatcher.prototype.computeClientBoundBox = function computeClientBoundBox() {
      var box = this.boundBoxClb(),
          xs = [box.min.x, box.max.x],
          ys = [0, 0],
          zs = [box.min.z, box.max.z];

      var ps = [],
          res = { max: {}, min: {} };
      for (var _iterator = xs, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var x = _ref;

        for (var _iterator2 = ys, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
          var _ref2;

          if (_isArray2) {
            if (_i2 >= _iterator2.length) break;
            _ref2 = _iterator2[_i2++];
          } else {
            _i2 = _iterator2.next();
            if (_i2.done) break;
            _ref2 = _i2.value;
          }

          var y = _ref2;

          for (var _iterator3 = zs, _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
            var _ref3;

            if (_isArray3) {
              if (_i3 >= _iterator3.length) break;
              _ref3 = _iterator3[_i3++];
            } else {
              _i3 = _iterator3.next();
              if (_i3.done) break;
              _ref3 = _i3.value;
            }

            var z = _ref3;

            ps.push(this.vToCamera(this.v.set(x, y, z)));
          }
        }
      }

      ps.sort(function (p1, p2) {
        return p1.x - p2.x;
      });
      res.min.x = ps[0].x;
      res.max.x = ps[ps.length - 1].x;
      ps.sort(function (p1, p2) {
        return p1.y - p2.y;
      });
      res.min.y = ps[0].y;
      res.max.y = ps[ps.length - 1].y;

      res.width = res.max.x - res.min.x;
      res.height = res.max.y - res.min.y;

      res.mid = {
        x: 0.5 * (res.max.x + res.min.x),
        y: 0.5 * (res.max.y + res.min.y)
      };

      return res;
    };

    Object3DWatcher.prototype.setObject = function setObject(boundBoxClb) {
      this.boundBoxClb = boundBoxClb;
    };

    Object3DWatcher.prototype.testScale = function testScale() {
      return true;
    };

    Object3DWatcher.prototype.computeCorr = function computeCorr(K, min, max) {
      var corr = 0;
      if (K < 1) {
        if (min > -0.5) {
          corr = -0.5 - min;
        } else if (max < 0.5) {
          corr = 0.5 - max;
        }
      } else {
        if (min < -0.5) {
          corr = -0.5 - min;
        } else if (max > 0.5) {
          corr = 0.5 - max;
        }
      }
      return corr;
    };

    Object3DWatcher.prototype.getScale = function getScale() {
      var box = this.computeClientBoundBox(),
          Kx = this.elementSize.w / box.width,
          Ky = this.elementSize.h / box.height;
      return 1 / Math.min(Kx, Ky);
    };

    Object3DWatcher.prototype.centerView = function centerView(T) {
      var _this = this;

      var box = this.computeClientBoundBox(),
          Kx = this.elementSize.w / box.width,
          Ky = this.elementSize.h / box.height,
          K = Math.min(Kx, Ky);

      if (this.testScale() && Math.abs(1 / K - this.scale) > this.eps) {
        var scale = 1 / K + 0.2 * (this.scale - 1 / K);
        this.orbit.setScale(this.orbit.getScale() / (K * scale));
        this.orbit.update();
        this.camera.updateMatrixWorld();
        box = this.computeClientBoundBox();
        Kx = this.elementSize.w / box.width;
        Ky = this.elementSize.h / box.height;
        K = Math.min(Kx, Ky);
      }

      var dv = this.dv;
      if (K > 1 - this.eps) {
        dv.set(-box.mid.x, -box.mid.y);
      } else {
        dv.set(this.computeCorr(Kx, box.min.x, box.max.x), this.computeCorr(Ky, box.min.y, box.max.y));
      }

      if (Math.sqrt(this.os.vx * this.os.vx + this.os.vy * this.os.vy) > 0.003 || dv.length() > 0.003) {
        var dt = 1 / 60,
            t = 0,
            os = _extends({}, this.os, {
          x: 0,
          y: 0
        });
        os.tf = function (vx, vy, x, y) {
          return {
            x: 75 * (dv.x - x) / Math.pow(_this.devicePixelRatio, 1.0),
            y: 75 * (dv.y - y) / Math.pow(_this.devicePixelRatio, 1.0)
          };
        };
        while (t < T) {
          if (t + dt > T) {
            dt = T - t;
          }
          os = this.integrate(os, dt);
          t += dt;
        }
        this.movePan(os);
        this.os = os;
      }
    };

    Object3DWatcher.prototype.integrate = function integrate(os, dt) {
      var _MathUtils$rk = _MathUtils2.default.rk4(this.dy.bind(os), 0, dt, [os.vx, os.vy, os.x, os.y]),
          vx = _MathUtils$rk[0],
          vy = _MathUtils$rk[1],
          x = _MathUtils$rk[2],
          y = _MathUtils$rk[3];

      return _extends({}, os, {
        vx: vx, vy: vy, x: x, y: y
      });
    };

    Object3DWatcher.prototype.dy = function dy(t, Y) {
      var vx = Y[0],
          vy = Y[1],
          x = Y[2],
          y = Y[3],
          vd = 15,
          tf = this.tf(vx, vy, x, y);

      return [tf.x - vd * vx, tf.y - vd * vy, vx, vy];
    };

    Object3DWatcher.prototype.update = function update(dt) {
      if (this.enabled && this.boundBoxClb) {
        this.centerView(dt);
      }
    };

    return Object3DWatcher;
  }();

  exports.default = Object3DWatcher;

  /***/
},
/* 56 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var Orbit = function (_THREE$EventDispatche) {
    _inherits(Orbit, _THREE$EventDispatche);

    function Orbit(object, domElement) {
      _classCallCheck(this, Orbit);

      var _this = _possibleConstructorReturn(this, _THREE$EventDispatche.call(this));

      _this.object = object;
      _this.domElement = domElement || document.body;

      // Set to false to disable this control
      _this.enabled = true;

      // "target" sets the location of focus, where the object orbits around
      _this.target = new _libs.THREE.Vector3();

      // How far you can dolly in and out(PerspectiveCamera only)
      _this.minDistance = 0;
      _this.maxDistance = Infinity;

      // How far you can zoom in and out(OrthographicCamera only)
      _this.minZoom = 0;
      _this.maxZoom = Infinity;

      // How far you can orbit vertically, upper and lower limits.
      // Range is 0 to Math.PI radians.
      _this.minPolarAngle = 0; // radians
      _this.maxPolarAngle = Math.PI; // radians

      // How far you can orbit horizontally, upper and lower limits.
      // If set, must be a sub-interval of the interval [-Math.PI, Math.PI ].
      _this.minAzimuthAngle = -Infinity; // radians
      _this.maxAzimuthAngle = Infinity; // radians

      // Set to true to enable damping (inertia)
      // If damping is enabled, you must call controls.update() in your animation loop
      _this.enableDamping = false;
      _this.dampingFactor = 0.25;

      // This option actually enables dollying in and out; left as "zoom" for backwards compatibility.
      // Set to false to disable zooming
      _this.enableZoom = true;
      _this.zoomSpeed = 1.0;

      // Set to false to disable rotating
      _this.enableRotate = true;
      _this.rotateSpeed = 1.0;

      // Set to false to disable panning
      _this.enablePan = true;

      // Set to true to automatically rotate around the target
      // If auto-rotate is enabled, you must call controls.update() in your animation loop
      _this.autoRotate = false;
      _this.autoRotateSpeed = 2.0; // 30 seconds per round when fps is 60

      // for reset
      _this.target0 = _this.target.clone();
      _this.position0 = _this.object.position.clone();
      _this.zoom0 = _this.object.zoom;

      //
      // public methods
      //
      _this.getPolarAngle = function () {
        return spherical.phi;
      };

      _this.getAzimuthalAngle = function () {
        return spherical.theta;
      };

      _this.reset = function () {
        scope.target.copy(scope.target0);
        scope.object.position.copy(scope.position0);
        scope.object.zoom = scope.zoom0;

        scope.object.updateProjectionMatrix();
        scope.dispatchEvent(changeEvent);

        scope.update();
      };

      _this.zoomOut = function () {
        var speed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.zoomSpeed;

        var _speed = this.zoomSpeed;
        this.zoomSpeed = speed;
        dollyIn(getZoomScale());
        this.zoomSpeed = _speed;
      };

      _this.zoomIn = function () {
        var speed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.zoomSpeed;

        var _speed = this.zoomSpeed;
        this.zoomSpeed = speed;
        dollyOut(getZoomScale());
        this.zoomSpeed = _speed;
      };

      _this.getScale = function () {
        return scale;
      };

      _this.setScale = function (newScale) {
        scale = newScale;
      };

      // this method is exposed, but perhaps it would be better if we can make it private...
      _this.update = function () {
        var offset = new _libs.THREE.Vector3();
        // so camera.up is the orbit axis
        var quat = new _libs.THREE.Quaternion().setFromUnitVectors(object.up, new _libs.THREE.Vector3(0, 1, 0));
        var quatInverse = quat.clone().inverse();
        var lastPosition = new _libs.THREE.Vector3();
        var lastQuaternion = new _libs.THREE.Quaternion();

        return function update() {
          var position = scope.object.position;
          offset.copy(position).sub(scope.target);
          // rotate offset to "y-axis-is-up" space
          offset.applyQuaternion(quat);
          // angle from z-axis around y-axis
          spherical.setFromVector3(offset);
          if (scope.autoRotate) {
            rotateLeft(getAutoRotationAngle());
          }
          spherical.theta += sphericalDelta.theta;
          spherical.phi += sphericalDelta.phi;
          // restrict theta to be between desired limits
          spherical.theta = Math.max(scope.minAzimuthAngle, Math.min(scope.maxAzimuthAngle, spherical.theta));
          // restrict phi to be between desired limits
          spherical.phi = Math.max(scope.minPolarAngle, Math.min(scope.maxPolarAngle, spherical.phi));
          spherical.makeSafe();
          spherical.radius *= scale;
          // restrict radius to be between desired limits
          spherical.radius = Math.max(scope.minDistance, Math.min(scope.maxDistance, spherical.radius));
          // move target to panned location
          scope.target.add(panOffset);
          offset.setFromSpherical(spherical);
          // rotate offset back to "camera-up-vector-is-up" space
          offset.applyQuaternion(quatInverse);
          position.copy(scope.target).add(offset);
          scope.object.lookAt(scope.target);

          if (scope.enableDamping === true) {
            sphericalDelta.theta *= 1 - scope.dampingFactor;
            sphericalDelta.phi *= 1 - scope.dampingFactor;
          } else {
            sphericalDelta.set(0, 0, 0);
          }

          scale = 1;
          panOffset.set(0, 0, 0);

          // update condition is:
          // min(camera displacement, camera rotation in radians)^2 > EPS
          // using small-angle approximation cos(x/2) = 1-x^2 / 8

          if (zoomChanged || lastPosition.distanceToSquared(scope.object.position) > EPS || 8 * (1 - lastQuaternion.dot(scope.object.quaternion)) > EPS) {

            scope.dispatchEvent(changeEvent);

            lastPosition.copy(scope.object.position);
            lastQuaternion.copy(scope.object.quaternion);
            zoomChanged = false;

            return true;
          }
          return false;
        };
      }();

      _this.dispose = function () {};

      //
      // internals
      //
      var scope = _this;
      var changeEvent = { type: 'change' };
      var EPS = 1e-6;
      // current position in spherical coordinates
      var spherical = new _libs.THREE.Spherical();
      var sphericalDelta = new _libs.THREE.Spherical();

      var scale = 1;
      var panOffset = new _libs.THREE.Vector3();
      var zoomChanged = false;

      function getAutoRotationAngle() {
        return 2 * Math.PI / 60 / 60 * scope.autoRotateSpeed;
      }

      function getZoomScale() {
        return Math.pow(0.95, scope.zoomSpeed);
      }

      function rotateLeft(angle) {
        sphericalDelta.theta -= angle;
      }

      function rotateUp(angle) {
        sphericalDelta.phi -= angle;
      }

      var panLeft = function () {
        var v = new _libs.THREE.Vector3();
        return function panLeft(distance, objectMatrix) {
          v.setFromMatrixColumn(objectMatrix, 0); // get X column of objectMatrix
          v.multiplyScalar(-distance);
          panOffset.add(v);
        };
      }();

      var panUp = function () {
        var v = new _libs.THREE.Vector3();
        return function panUp(distance, objectMatrix) {
          v.setFromMatrixColumn(objectMatrix, 1); // get Y column of objectMatrix
          v.multiplyScalar(distance);
          panOffset.add(v);
        };
      }();

      // deltaX and deltaY are in pixels; right and down are positive
      scope.pan = function () {
        var offset = new _libs.THREE.Vector3();
        return function pan(deltaX, deltaY) {
          var element = scope.domElement;
          if (scope.object instanceof _libs.THREE.PerspectiveCamera) {
            // perspective
            var position = scope.object.position;
            offset.copy(position).sub(scope.target);
            var targetDistance = offset.length();
            // half of the fov is center to top of screen
            targetDistance *= Math.tan(scope.object.fov / 2 * Math.PI / 180.0);
            // we actually don't use screenWidth, since perspective camera is fixed to screen height
            panLeft(2 * deltaX * targetDistance / element.clientHeight, scope.object.matrix);
            panUp(2 * deltaY * targetDistance / element.clientHeight, scope.object.matrix);
          } else if (scope.object instanceof _libs.THREE.OrthographicCamera) {
            // orthographic
            panLeft(deltaX * (scope.object.right - scope.object.left) / scope.object.zoom / element.clientWidth, scope.object.matrix);
            panUp(deltaY * (scope.object.top - scope.object.bottom) / scope.object.zoom / element.clientHeight, scope.object.matrix);
          } else {
            // camera neither orthographic nor perspective
            console.warn('WARNING: OrbitControls.js encountered an unknown camera type-pan disabled.');
            scope.enablePan = false;
          }
        };
      }();

      function dollyIn(dollyScale) {
        if (scope.object instanceof _libs.THREE.PerspectiveCamera) {
          scale /= dollyScale;
        } else if (scope.object instanceof _libs.THREE.OrthographicCamera) {
          scope.object.zoom = Math.max(scope.minZoom, Math.min(scope.maxZoom, scope.object.zoom * dollyScale));
          scope.object.updateProjectionMatrix();
          zoomChanged = true;
        } else {
          console.warn('WARNING: OrbitControls.js encountered an unknown camera type-dolly/zoom disabled.');
          scope.enableZoom = false;
        }
      }

      function dollyOut(dollyScale) {
        if (scope.object instanceof _libs.THREE.PerspectiveCamera) {
          scale *= dollyScale;
        } else if (scope.object instanceof _libs.THREE.OrthographicCamera) {
          scope.object.zoom = Math.max(scope.minZoom, Math.min(scope.maxZoom, scope.object.zoom / dollyScale));
          scope.object.updateProjectionMatrix();
          zoomChanged = true;
        } else {
          console.warn('WARNING: OrbitControls.js encountered an unknown camera type-dolly/zoom disabled.');
          scope.enableZoom = false;
        }
      }

      /* Actions */

      function rotate(event, data) {
        if (scope.enabled && scope.enableRotate && data.state === 'move') {
          var element = scope.domElement;
          // rotating across whole screen goes 360 degrees around
          rotateLeft(2 * Math.PI * data.dx / element.clientWidth * scope.rotateSpeed);
          // rotating up and down along whole screen attempts to go 360, but limited to 180
          rotateUp(2 * Math.PI * data.dy / element.clientHeight * scope.rotateSpeed);
          scope.update();
        }
      }

      function pan(event, data) {
        if (scope.enabled && scope.enablePan && data.state === 'move') {
          scope.pan(data.dx, data.dy);
          scope.update();
        }
      }

      function offsetDolly(event, data) {
        if (scope.enabled && scope.enableZoom && data.state === 'move') {
          if (data.dy > 0) {
            dollyIn(getZoomScale());
          } else if (data.dy < 0) {
            dollyOut(getZoomScale());
          }
          scope.update();
        }
      }

      function wheelDolly(event) {
        if (scope.enabled && scope.enableZoom) {
          if (event.deltaY > 0) {
            dollyOut(getZoomScale());
          } else if (event.deltaY < 0) {
            dollyIn(getZoomScale());
          }
          scope.update();
        }
      }

      _this.actions = {
        rotate: rotate,
        pan: pan,
        offsetDolly: offsetDolly,
        wheelDolly: wheelDolly
      };

      // force an update at start
      _this.update();
      return _this;
    }

    return Orbit;
  }(_libs.THREE.EventDispatcher);

  exports.default = Orbit;

  /***/
},
/* 57 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _ImageBase2 = __webpack_require__(5);

  var _ImageBase3 = _interopRequireDefault(_ImageBase2);

  var _Pdf = __webpack_require__(18);

  var _Pdf2 = _interopRequireDefault(_Pdf);

  var _BaseMathUtils = __webpack_require__(2);

  var _BaseMathUtils2 = _interopRequireDefault(_BaseMathUtils);

  var _CustomEventConverter = __webpack_require__(16);

  var _CustomEventConverter2 = _interopRequireDefault(_CustomEventConverter);

  var _PolyTarget = __webpack_require__(69);

  var _PolyTarget2 = _interopRequireDefault(_PolyTarget);

  var _Finder = __webpack_require__(17);

  var _Finder2 = _interopRequireDefault(_Finder);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var PdfImage = function (_ImageBase) {
    _inherits(PdfImage, _ImageBase);

    function PdfImage(context, width, height, color, pdf, n) {
      _classCallCheck(this, PdfImage);

      var _this = _possibleConstructorReturn(this, _ImageBase.call(this, context, width, height, color));

      _this.query = '';
      _this.n = n;
      _this.pdf = pdf;
      _this.v = { x: 0, y: 0, z: 0, set: function set(x, y, z) {
          this.x = x;this.y = y;this.z = z;
          return this;
        }, transform: function transform(m) {
          var x = m.m[0][0] * this.x + m.m[1][0] * this.y + m.m[2][0] * this.z,
              y = m.m[0][1] * this.x + m.m[1][1] * this.y + m.m[2][1] * this.z,
              z = m.m[0][2] * this.x + m.m[0][2] * this.y + m.m[2][0] * this.z;
          this.x = x;
          this.y = y;
          this.z = z;
          return this;
        } };
      _this.m = { m: [[1, 0, 0], [0, 1, 0], [0, 0, 1]], set: function set(m00, m01, m02, m10, m11, m12, m20, m21, m22) {
          this.m = [[m00, m01, m02], [m10, m11, m12], [m20, m21, m22]];
          return this;
        } };

      _this.startRender = function () {
        _this.pdf.getHandler(_this.render.bind(_this));
      };
      Promise.resolve().then(function () {
        return _this.pdf.getHandler(_this.init.bind(_this));
      });
      return _this;
    }

    PdfImage.prototype.setQuery = function setQuery(query) {
      this.query = query.trim();
      if (this.textContent) {
        this.setHits(this.textContent);
        // this.finishLoad();
      }
    };

    PdfImage.prototype.rectSize = function rectSize(r) {
      return {
        width: r[2] - r[0],
        height: r[3] - r[1]
      };
    };

    PdfImage.prototype.createPoly = function createPoly(m, p, s) {
      var poly = [],
          v = this.v;
      v.set(p.x, p.y, 1).transform(m);
      poly.push({ x: v.x, y: v.y });
      v.set(p.x, p.y + s.height, 1).transform(m);
      poly.push({ x: v.x, y: v.y });
      v.set(p.x + s.width, p.y + s.height, 1).transform(m);
      poly.push({ x: v.x, y: v.y });
      v.set(p.x + s.width, p.y, 1).transform(m);
      poly.push({ x: v.x, y: v.y });
      return poly;
    };

    PdfImage.prototype.getSimulatedDoc = function getSimulatedDoc() {
      return this.page;
    };

    PdfImage.prototype.simulate = function simulate(e, doc, x, y) {
      if (this.eventConverter) {
        this.eventConverter.convert(e, { doc: doc, x: x, y: y });
      }
    };

    PdfImage.prototype.setAnnotations = function setAnnotations(annos) {
      var _this2 = this;

      var t = this.viewport.transform,
          targets = [];
      this.m.set(t[0], t[1], 0, t[2], t[3], 0, t[4], t[5], 1);

      for (var _iterator = annos, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var anno = _ref;

        if (anno.subtype === 'Link') {
          var rect = anno.rect,
              aPos = {
            x: rect[0],
            y: rect[1]
          },
              aSz = this.rectSize(rect);
          var _target = new _PolyTarget2.default(this.createPoly(this.m, aPos, aSz).map(function (p) {
            return { x: p.x / _this2.viewport.width, y: 1 - p.y / _this2.viewport.height };
          }));
          _target.anno = anno;
          _target.callback = this.annoClb.bind(this);
          targets.push(_target);
        }
      }
      if (targets.length) {
        this.eventConverter = new _CustomEventConverter2.default(this.wnd, this.doc, _PolyTarget2.default.test, this.page);
        for (var _iterator2 = targets, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
          var _ref2;

          if (_isArray2) {
            if (_i2 >= _iterator2.length) break;
            _ref2 = _iterator2[_i2++];
          } else {
            _i2 = _iterator2.next();
            if (_i2.done) break;
            _ref2 = _i2.value;
          }

          var target = _ref2;

          this.eventConverter.addCustom(target);
        }
      }
    };

    PdfImage.prototype.setHits = function setHits(textContent) {
      this.textContent = textContent;
      if (this.query !== '') {
        this.finder = new _Finder2.default(textContent.items.map(function (item) {
          return item.str;
        }), this.query, { contexts: false });
      }
    };

    PdfImage.prototype.renderHits = function renderHits() {
      var _this3 = this;

      if (this.finder) {
        var view = this.page.view,
            testSz = (0, _libs.$)('<div style="position: absolute; visibility: hidden;"></div>').appendTo('body'),
            textDiv = testSz[0],
            baseOffset = testSz.offset().left;
        for (var _iterator3 = this.finder.getHits(), _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
          var _ref3;

          if (_isArray3) {
            if (_i3 >= _iterator3.length) break;
            _ref3 = _iterator3[_i3++];
          } else {
            _i3 = _iterator3.next();
            if (_i3.done) break;
            _ref3 = _i3.value;
          }

          var hit = _ref3;

          var item = this.textContent.items[hit.index],
              t = PDFJS.Util.transform(this.viewport.transform, item.transform),
              style = this.textContent.styles[item.fontName],
              angle = Math.atan2(t[1], t[0]) + (style.vertical ? Math.PI / 2 : 0),
              fontHeight = Math.sqrt(t[2] * t[2] + t[3] * t[3]),
              fontAscent = style.ascent ? style.ascent * fontHeight : style.descent ? (1 + style.descent) * fontHeight : fontHeight;
          testSz.html(item.str.substr(0, hit.offset) + '<span>' + item.str.substr(hit.offset, hit.length) + '</span>' + item.str.substr(hit.offset + hit.length));

          textDiv.style.fontSize = fontHeight + 'px';
          textDiv.style.fontFamily = style.fontFamily;

          var testSpan = testSz.find('span'),
              iwidth = style.vertical ? item.height * this.viewport.scale : item.width * this.viewport.scale,
              width = testSz.width(),
              relativeOffset = (testSpan.offset().left - baseOffset) / width;
          this.m.set(1, 0, 0, 0, 1, 0, t[4] + fontAscent * Math.sin(angle), t[5] - fontAscent * Math.cos(angle), 1);
          var poly = this.createPoly(this.m, { x: relativeOffset * iwidth, y: 0 }, { width: iwidth * testSpan.width() / width, height: testSpan.height() });
          poly = poly.map(function (p) {
            return { x: p.x / _this3.viewport.width, y: 1 - p.y / _this3.viewport.height };
          });
          this.renderHit(poly);
        }
        testSz.remove();
      }
    };

    PdfImage.prototype.annoClb = function annoClb(e, data) {
      if (this.context.dispatchEvent) {
        this.context.dispatchEvent({
          type: 'pdfAnnotation',
          event: e,
          annotation: data.target.anno
        });
      }
    };

    PdfImage.prototype.calcViewport = function calcViewport() {
      var scale = _BaseMathUtils2.default.calcScale(this.size.width, this.size.height, this.resW, this.resH);
      if (!this.viewport || Math.abs(this.viewport.scale - scale) > 1e-4) {
        this.viewport = this.page.getViewport(scale);
        if (this.type !== 'full') {
          if (this.type === 'right') {
            this.viewport.offsetX += 0.5 * this.viewport.width;
            this.viewport.transform[4] -= 0.5 * this.viewport.width;
          }
          this.viewport.width /= 2;
        }
        this.resW = this.width = this.viewport.width;
        this.resH = this.height = this.viewport.height;
      }
    };

    PdfImage.prototype.init = function init() {
      var _this4 = this;

      this.type = this.pdf.getPageType(this.n);
      this.pdf.getPage(this.n).then(function (page) {
        _this4.page = page;
        _this4.size = _Pdf2.default.getPageSize(page);
        if (_this4.type !== 'full') {
          _this4.size.width /= 2;
        }
        page.getAnnotations().then(_this4.setAnnotations.bind(_this4));
        page.getTextContent().then(_this4.setHits.bind(_this4));
        _this4.calcViewport();
        _this4.finishLoad();
      }).catch(function (e) {
        console.error('Cannot load PDF page: ' + (_this4.n + 1));
        _this4.finishLoad();
      });
    };

    PdfImage.prototype.setResolution = function setResolution(res) {
      _ImageBase.prototype.setResolution.call(this, res);
      if (this.page) {
        this.calcViewport();
      }
    };

    PdfImage.prototype.render = function render(handler) {
      var _this5 = this;

      if (this.page) {
        this.page.render({
          canvasContext: this.pushCtx(),
          viewport: this.viewport
        }).then(function () {
          _this5.renderHits();
          _this5.popCtx();
          _this5.finishRender();
        });
      } else {
        this.renderBlankPage();
        this.finishRender();
      }
    };

    return PdfImage;
  }(_ImageBase3.default);

  exports.default = PdfImage;

  /***/
},
/* 58 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Search = function () {
    function Search(container, pages) {
      _classCallCheck(this, Search);

      this.container = container;
      this.pages = pages;
      this.prevResults = [];
      container.html('\n      <div class="search">\n        <div class="query">\n          <input class="inpQuery" type="text" maxlength="30" value="" />\n        </div>\n        <div class="results">\n        </div>\n        <div class="status">\n\n        </div>\n      </div>\n    ');
      this.query = container.find('.query input');
      this.results = container.find('.results');
      this.status = container.find('.status');

      this.binds = {
        navigate: this.navigate.bind(this),
        doQuery: this.doQuery.bind(this)
      };

      this.query.on('keydown', this.binds.doQuery);
      this.results.on('click', this.binds.navigate);
    }

    Search.prototype.dispose = function dispose() {
      this.results.off('click', this.binds.navigate);
      this.query.off('keydown', this.binds.doQuery);
    };

    Search.prototype.navigate = function navigate(e) {
      e.preventDefault();
      if (this.onNavigate !== undefined) {
        var target = (0, _libs.$)(e.target);
        if (!target.hasClass('result')) {
          var t = target.find('.result');
          if (t.length) {
            target = t;
          } else {
            while (target.length && !target.hasClass('result')) {
              target = (0, _libs.$)(target[0].parentNode);
            }
          }
        }
        var page = target.attr('data');
        if (page !== undefined) {
          this.onNavigate(parseInt(page));
        }
      }
    };

    Search.prototype.doQuery = function doQuery() {
      var _this = this;

      if (this.onQuery) {
        var queryStamp = this.queryStamp = Date.now();
        setTimeout(function () {
          if (queryStamp === _this.queryStamp) {
            _this.onQuery(_this.query[0].value.trim());
          }
        }, 1000);
      }
    };

    Search.prototype.setResults = function setResults(results, lastPage) {
      if (this.prevResults.length && results[0] !== this.prevResults[0]) {
        this.prevResults = [];
        this.results.html('');
      }
      var htmls = [];
      for (var i = this.prevResults.length; i < results.length; ++i) {
        var result = results[i];
        htmls.push('<div class="result" data="' + result.page + '">');
        htmls.push('<a href="#">');
        htmls.push('<div>' + result.contexts.join('</div><div>') + '</div>');
        htmls.push('</a>');
        htmls.push('</div>');
      }
      (0, _libs.$)(htmls.join('')).appendTo(this.results);
      this.prevResults = [].concat(results);
      if (lastPage === undefined) {
        this.status.html('');
      } else {
        this.status.html(lastPage + ' of ' + this.pages);
      }
    };

    return Search;
  }();

  exports.default = Search;

  /***/
},
/* 59 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _ImageBase2 = __webpack_require__(5);

  var _ImageBase3 = _interopRequireDefault(_ImageBase2);

  var _Utils = __webpack_require__(4);

  var _Utils2 = _interopRequireDefault(_Utils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var StaticImage = function (_ImageBase) {
    _inherits(StaticImage, _ImageBase);

    function StaticImage(context, width, height, color, src) {
      _classCallCheck(this, StaticImage);

      var _this = _possibleConstructorReturn(this, _ImageBase.call(this, context, width, height, color));

      _this.binds = {};
      _this.image = new Image();
      _this.image.crossOrigin = 'Anonymous';
      _this.binds.imageLoad = function () {
        _this.width = _this.image.width;
        _this.height = _this.image.height;
        _this.startRender = function () {
          _this.renderImage(_this.image);
          _this.finishRender();
        };
        _this.finishLoad();
      };
      _this.binds.imageError = function () {
        _this.startRender = function () {
          _this.renderNotFoundPage();
          _this.finishRender();
        };
        _this.finishLoad();
      };
      (0, _libs.$)(_this.image).on('load', _this.binds.imageLoad).on('error', _this.binds.imageError);
      _this.image.src = _Utils2.default.normalizeUrl(src);
      return _this;
    }

    StaticImage.prototype.dispose = function dispose() {
      (0, _libs.$)(this.image).off('load', this.binds.imageLoad).off('error', this.binds.imageError);
      this.image.src = '';
      delete this.image;
      _ImageBase.prototype.dispose.call(this);
    };

    return StaticImage;
  }(_ImageBase3.default);

  exports.default = StaticImage;

  /***/
},
/* 60 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var TextureAnimator = function () {
    function TextureAnimator(img, tilesHoriz, tilesVert, numTiles, tileDispDuration) {
      _classCallCheck(this, TextureAnimator);

      var texture = new _libs.THREE.Texture();
      texture.minFilter = _libs.THREE.LinearFilter;
      texture.image = img;
      texture.needsUpdate = true;

      // note: texture passed by reference, will be updated by the update function.
      this.texture = texture;
      this.tilesHorizontal = tilesHoriz;
      this.tilesVertical = tilesVert;
      // how many images does this spritesheet contain?
      //  usually equals tilesHoriz * tilesVert, but not necessarily,
      //  if there at blank tiles at the bottom of the spritesheet.
      this.numberOfTiles = numTiles;
      texture.repeat.set(1 / this.tilesHorizontal, 1 / this.tilesVertical);

      // how long should each image be displayed?
      this.tileDisplayDuration = tileDispDuration;

      // how long has the current image been displayed?
      this.currentDisplayTime = 0;

      // which image is currently being displayed?
      this.currentTile = 0;
    }

    TextureAnimator.prototype.update = function update(milliSec) {
      this.currentDisplayTime += milliSec;
      while (this.currentDisplayTime > this.tileDisplayDuration) {
        this.currentDisplayTime -= this.tileDisplayDuration;
        ++this.currentTile;
        if (this.currentTile == this.numberOfTiles) this.currentTile = 0;
        var currentColumn = this.currentTile % this.tilesHorizontal;
        this.texture.offset.x = currentColumn / this.tilesHorizontal;
        var currentRow = Math.floor(this.currentTile / this.tilesHorizontal);
        this.texture.offset.y = currentRow / this.tilesVertical;
      }
    };

    TextureAnimator.prototype.dispose = function dispose() {
      var img = this.texture.image;
      img.height = img.width = 0;
      this.texture.dispose();
    };

    return TextureAnimator;
  }();

  exports.default = TextureAnimator;

  /***/
},
/* 61 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _Utils = __webpack_require__(4);

  var _Utils2 = _interopRequireDefault(_Utils);

  var _MouseEventConverter2 = __webpack_require__(54);

  var _MouseEventConverter3 = _interopRequireDefault(_MouseEventConverter2);

  var _ThreeEventConverter = __webpack_require__(19);

  var _ThreeEventConverter2 = _interopRequireDefault(_ThreeEventConverter);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var ThreeMouseEventConverter = function (_MouseEventConverter) {
    _inherits(ThreeMouseEventConverter, _MouseEventConverter);

    function ThreeMouseEventConverter(wnd, doc, visualWorld, test) {
      _classCallCheck(this, ThreeMouseEventConverter);

      var _this = _possibleConstructorReturn(this, _MouseEventConverter.call(this, wnd, doc, visualWorld.element));

      _Utils2.default.extends(_this, new _ThreeEventConverter2.default(visualWorld, test));
      return _this;
    }

    ThreeMouseEventConverter.prototype.getCallback = function getCallback(object) {
      return object.object.userData.mouseCallback;
    };

    ThreeMouseEventConverter.prototype.setCoordsFromEvent = function setCoordsFromEvent(e) {
      var jElement = (0, _libs.$)(this.element);
      var offset = jElement.offset();
      this.coords.x = (e.pageX - offset.left) / jElement.width() * 2 - 1;
      this.coords.y = -((e.pageY - offset.top) / jElement.height()) * 2 + 1;
      return this.coords;
    };

    return ThreeMouseEventConverter;
  }(_MouseEventConverter3.default);

  exports.default = ThreeMouseEventConverter;

  /***/
},
/* 62 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _Utils = __webpack_require__(4);

  var _Utils2 = _interopRequireDefault(_Utils);

  var _TouchEventConverter2 = __webpack_require__(64);

  var _TouchEventConverter3 = _interopRequireDefault(_TouchEventConverter2);

  var _ThreeEventConverter = __webpack_require__(19);

  var _ThreeEventConverter2 = _interopRequireDefault(_ThreeEventConverter);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var ThreeTouchEventConverter = function (_TouchEventConverter) {
    _inherits(ThreeTouchEventConverter, _TouchEventConverter);

    function ThreeTouchEventConverter(wnd, doc, visualWorld, test) {
      _classCallCheck(this, ThreeTouchEventConverter);

      var _this = _possibleConstructorReturn(this, _TouchEventConverter.call(this, wnd, doc, visualWorld.element));

      _Utils2.default.extends(_this, new _ThreeEventConverter2.default(visualWorld, test));
      return _this;
    }

    ThreeTouchEventConverter.prototype.getCallback = function getCallback(object) {
      return object.object.userData.touchCallback;
    };

    ThreeTouchEventConverter.prototype.setCoordsFromEvent = function setCoordsFromEvent(e) {
      var jElement = (0, _libs.$)(this.element),
          offset = jElement.offset(),
          touches = e.touches || e.originalEvent.touches,
          touch = touches.length ? touches[0] : (this.lastTouches || [{ pageX: 0, pageY: 0 }])[0],
          pageX = touch.pageX,
          pageY = touch.pageY;
      this.lastTouches = touches.length ? touches : this.lastTouches;
      this.coords.x = (pageX - offset.left) / jElement.width() * 2 - 1;
      this.coords.y = -((pageY - offset.top) / jElement.height()) * 2 + 1;
      return this.coords;
    };

    return ThreeTouchEventConverter;
  }(_TouchEventConverter3.default);

  exports.default = ThreeTouchEventConverter;

  /***/
},
/* 63 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(0);

  var _ImageFactory = __webpack_require__(8);

  var _ImageFactory2 = _interopRequireDefault(_ImageFactory);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var Thumbnails = function () {
    function Thumbnails(context, container, thumbnailsClb, size) {
      var _this = this;

      var props = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : { kWtoH: 210 / 297 };

      _classCallCheck(this, Thumbnails);

      this.container = container;
      this.p = props;
      this.thumbnailsClb = thumbnailsClb;
      this.size = size;
      this.canvas = (0, _libs.$)('<canvas>')[0];
      this.imageFactory = new _ImageFactory2.default(_extends({}, context, {
        renderCanvas: this.canvas,
        renderCanvasCtx: this.canvas.getContext('2d')
      }));
      this.thumbnails = [];
      for (var i = 0; i < size; ++i) {
        var info = this.thumbnailsClb(i);
        this.thumbnails.push(_extends({}, info, {
          index: i,
          loaded: info.type === 'thumbnail-image',
          heading: null,
          thumbnail: null,
          title: info.title || i
        }));
      }

      this.binds = {
        update: this.update.bind(this),
        navigate: function navigate(e) {
          e.preventDefault();
          if (_this.onNavigate) {
            var node = e.target;
            while (node && !node.dataThumbnail) {
              node = node.parentNode;
            }
            _this.onNavigate(node.dataThumbnail.index);
          }
        }
      };
      this.container.on('scroll', this.binds.update);
    }

    Thumbnails.prototype.getSize = function getSize() {
      return this.size;
    };

    Thumbnails.prototype.setEnable = function setEnable(enable) {
      this.enable = enable;
      this.update();
    };

    Thumbnails.prototype.dispose = function dispose() {
      this.container.find('a').off('click', this.binds.navigate);
      this.container.off('scroll', this.binds.update);
      this.container.html('');
      this.canvas.height = this.canvas.width = 0;
      delete this.canvas;
    };

    Thumbnails.prototype.load = function load(thumbnail) {
      var _this2 = this;

      this.loading = true;
      var wrapper = this.imageFactory.build(thumbnail, thumbnail.number === undefined ? thumbnail.index : thumbnail.number, this.p.kWtoH * 300, 300);
      wrapper.onChange = function (canvas) {
        _this2.setImage(thumbnail, canvas.toDataURL('image/png'));
        thumbnail.loaded = true;
        wrapper.dispose();
        _this2.loading = false;
        Promise.resolve().then(function () {
          return _this2.update();
        });
      };
    };

    Thumbnails.prototype.getActive = function getActive() {
      var first = this.container.scrollTop(),
          last = first + this.container.height(),
          res = [];
      for (var _iterator = this.thumbnails, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var thumbnail = _ref;

        if (Math.max(thumbnail.first, first) < Math.min(thumbnail.last, last)) {
          res.push(thumbnail);
        }
      }
      return res;
    };

    Thumbnails.prototype.update = function update() {
      if (!this.loading && this.canvas && this.enable) {
        if (!this.built) {
          this.render();
        }
        var active = this.getActive();
        for (var _iterator2 = active, _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
          var _ref2;

          if (_isArray2) {
            if (_i2 >= _iterator2.length) break;
            _ref2 = _iterator2[_i2++];
          } else {
            _i2 = _iterator2.next();
            if (_i2.done) break;
            _ref2 = _i2.value;
          }

          var thumbnail = _ref2;

          if (!thumbnail.loaded) {
            this.load(thumbnail);
            break;
          }
        }
      }
    };

    Thumbnails.prototype.setImage = function setImage(thumbnail, img) {
      thumbnail.img = img;
      thumbnail.thumbnail.css('background-image', ['url(\'', img, '\')'].join(''));
      thumbnail.thumbnail.removeClass('loading');
    };

    Thumbnails.prototype.render = function render() {
      var elements = ['<div class="thumbnails">'];
      for (var i = 0; i < this.size; ++i) {
        elements.push(['<div class="item"><a href="#"><div class="thumbnail loading"></div></a><div class="heading"><a href="#" title="', i + 1, '">', i + 1, '</a></div></div>'].join(''));
      }
      elements.push('</div>');
      this.container.append(elements.join(''));
      var items = this.container.find('.item'),
          base = this.container.find('.thumbnails').offset().top;
      for (var _i3 = 0; _i3 < items.length; ++_i3) {
        var item = (0, _libs.$)(items[_i3]);
        this.thumbnails[_i3].heading = item.find('.heading');
        this.thumbnails[_i3].thumbnail = item.find('.thumbnail');
        this.thumbnails[_i3].first = item.offset().top - base;
        this.thumbnails[_i3].last = this.thumbnails[_i3].first + item.height();
        if (this.thumbnails[_i3].loaded) {
          this.setImage(this.thumbnails[_i3], this.thumbnails[_i3].src);
        }
        var as = item.find('a');
        for (var j = 0; j < as.length; ++j) {
          var a = as[j];
          a.dataThumbnail = this.thumbnails[_i3];
        }
      }
      this.container.find('a').on('click', this.binds.navigate);
      this.built = true;
    };

    return Thumbnails;
  }();

  exports.default = Thumbnails;

  /***/
},
/* 64 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _libs = __webpack_require__(0);

  var _EventConverter2 = __webpack_require__(6);

  var _EventConverter3 = _interopRequireDefault(_EventConverter2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var TouchConverter = function (_EventConverter) {
    _inherits(TouchConverter, _EventConverter);

    function TouchConverter(wnd, doc, element) {
      _classCallCheck(this, TouchConverter);

      var _this = _possibleConstructorReturn(this, _EventConverter.call(this, wnd, doc));

      _this.element = element;
      _this.binds = {
        convert: _this.convert.bind(_this)
      };
      (0, _libs.$)(_this.element).on('touchstart touchmove', _this.binds.convert);
      (0, _libs.$)(_this.doc).on('touchend', _this.binds.convert);
      return _this;
    }

    TouchConverter.prototype.dispose = function dispose() {
      (0, _libs.$)(this.element).off('touchstart touchmove', this.binds.convert);
      (0, _libs.$)(this.doc).off('touchend', this.binds.convert);
    };

    return TouchConverter;
  }(_EventConverter3.default);

  exports.default = TouchConverter;

  /***/
},
/* 65 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(0);

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  var View = function () {
    View.classProperty = function classProperty(ctrl, className, value) {
      if (value) {
        ctrl.addClass(className);
      } else {
        ctrl.removeClass(className);
      }
    };

    View.attributeProperty = function attributeProperty(ctrl, attributeName, value) {
      if (value) {
        ctrl.attr(attributeName, value);
      } else {
        ctrl.removeAttr(attributeName);
      }
    };

    View.callHandlers = function callHandlers(handlers, id, e, data) {
      for (var _iterator = handlers, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var handler = _ref;

        if (handler[id]) {
          handler[id](e, data);
        } else if (handler.handleDefault) {
          handler.handleDefault(id, e, data);
        }
      }
    };

    View.handleEvent = function handleEvent(id, getHandlers, e, data) {
      View.callHandlers(getHandlers(id), id, e, data);
    };

    View.handleLinkEvent = function handleLinkEvent(e) {
      e.preventDefault();
      if (!this.ctrl.hasClass('disabled')) {
        View.handleEvent(this.id, this.getHandlers, e);
      }
    };

    View.handleInputEvent = function handleInputEvent(e) {
      View.handleEvent(this.id, this.getHandlers, e, e.target.value);
    };

    View.handleFormEvent = function handleFormEvent(e) {
      e.preventDefault();
      View.handleEvent(this.id, this.getHandlers, e);
    };

    // virtual functions {


    View.prototype.getLinks = function getLinks() {
      return null;
    };

    View.prototype.getWidgets = function getWidgets() {
      return null;
    };

    View.prototype.getInputs = function getInputs() {
      return null;
    };

    View.prototype.getTexts = function getTexts() {
      return null;
    };

    View.prototype.getTemplate = function getTemplate() {
      return {};
    };

    View.prototype.getHandlers = function getHandlers(id) {
      return this.handlers;
    };
    // }

    View.prototype.callLater = function callLater(handlers, id, e, data, ms) {
      var _this = this;

      this.pendings[id] = {
        timestamp: new Date().getTime()
      };
      setTimeout(function () {
        var timestamp = new Date().getTime(),
            pending = _this.pendings[id];
        if (pending && timestamp - pending.timestamp >= ms) {
          View.callHandlers(handlers, id, e, data);
          delete _this.pendings[id];
        }
      }, ms);
    };

    // loadFiles(urls, ready, failure) {
    //   let done = Promise.resolve();
    //   for(let url of urls) {
    //     done = done.then(()=> {
    //       return new Promise((resolve, reject)=> {
    //         $.get(url, (res)=> {
    //           ready(res, url);
    //           resolve();
    //         }).fail((res)=> {
    //           if(failure && failure(res, url)) {
    //             resolve();
    //           }
    //           else {
    //             reject(res);
    //           }
    //         });
    //       });
    //     });
    //   }
    //   return done;
    // }

    View.prototype.loadFiles = function loadFiles(urls, files) {
      var tasks = [];

      var _loop = function _loop() {
        if (_isArray2) {
          if (_i2 >= _iterator2.length) return 'break';
          _ref2 = _iterator2[_i2++];
        } else {
          _i2 = _iterator2.next();
          if (_i2.done) return 'break';
          _ref2 = _i2.value;
        }

        var name = _ref2;

        files[name] = [];

        var _loop2 = function _loop2() {
          if (_isArray3) {
            if (_i3 >= _iterator3.length) return 'break';
            _ref3 = _iterator3[_i3++];
          } else {
            _i3 = _iterator3.next();
            if (_i3.done) return 'break';
            _ref3 = _i3.value;
          }

          var url = _ref3;

          tasks.push(new Promise(function (resolve, reject) {
            _libs.$.get(url, function (data) {
              files[name].push({ url: url, data: data });
              resolve();
            }).fail(function (res) {
              reject(res);
            });
          }));
        };

        for (var _iterator3 = urls[name], _isArray3 = Array.isArray(_iterator3), _i3 = 0, _iterator3 = _isArray3 ? _iterator3 : _iterator3[Symbol.iterator]();;) {
          var _ref3;

          var _ret2 = _loop2();

          if (_ret2 === 'break') break;
        }
      };

      for (var _iterator2 = Object.keys(urls), _isArray2 = Array.isArray(_iterator2), _i2 = 0, _iterator2 = _isArray2 ? _iterator2 : _iterator2[Symbol.iterator]();;) {
        var _ref2;

        var _ret = _loop();

        if (_ret === 'break') break;
      }
      return Promise.all(tasks);
    };

    View.prototype.urlResolver = function urlResolver(baseUrl, url) {
      url = url.replace(/\\/g, '/');
      if (url.charAt(0) !== '/') {
        baseUrl = baseUrl.replace(/\\/g, '/');
        var p = baseUrl.lastIndexOf('/');
        url = (~p ? baseUrl.substr(0, p + 1) : '') + url;

        var parts = url.split('/');
        url = [];
        for (var _iterator4 = parts, _isArray4 = Array.isArray(_iterator4), _i4 = 0, _iterator4 = _isArray4 ? _iterator4 : _iterator4[Symbol.iterator]();;) {
          var _ref4;

          if (_isArray4) {
            if (_i4 >= _iterator4.length) break;
            _ref4 = _iterator4[_i4++];
          } else {
            _i4 = _iterator4.next();
            if (_i4.done) break;
            _ref4 = _i4.value;
          }

          var part = _ref4;

          if (part === '.') {} else if (part === '..') {
            if (url.length && !(url.length === 1 && url[0] === '')) {
              url.pop();
            }
          } else {
            url.push(part);
          }
        }
        url = url.join('/');
      }

      return url;
    };

    View.prototype.objToAttrsStr = function objToAttrsStr(o) {
      var res = [];
      for (var _iterator5 = Object.keys(o), _isArray5 = Array.isArray(_iterator5), _i5 = 0, _iterator5 = _isArray5 ? _iterator5 : _iterator5[Symbol.iterator]();;) {
        var _ref5;

        if (_isArray5) {
          if (_i5 >= _iterator5.length) break;
          _ref5 = _iterator5[_i5++];
        } else {
          _i5 = _iterator5.next();
          if (_i5.done) break;
          _ref5 = _i5.value;
        }

        var _name = _ref5;

        res.push([_name, '="', o[_name], '"'].join(''));
      }
      return res.join(' ');
    };

    View.prototype.checkIframeSize = function checkIframeSize() {
      if (this.frame) {
        if (Math.abs(this.frame.width - this.parentContainer.width()) > 1 || Math.abs(this.frame.height - this.parentContainer.height()) > 1) {
          this.onResize();
        }
        setTimeout(this.checkIframeSize.bind(this), 250);
      }
    };

    View.prototype.onResize = function onResize() {
      this.frame.width = this.parentContainer.width();
      this.frame.height = this.parentContainer.height();
    };

    View.prototype.translate = function translate(html) {
      return html.replace(/<\$tr>(.*)<\/\$tr>/gi, function (s0, s1) {
        return (0, _libs.tr)(s1);
      });
    };

    View.prototype.fireLinksOnLoadEvent = function fireLinksOnLoadEvent() {
      var _this2 = this;

      if (this.templateObject && this.templateObject.linkLoaded) {
        var loaded = true;

        var _loop3 = function _loop3() {
          if (_isArray6) {
            if (_i6 >= _iterator6.length) return 'break';
            _ref6 = _iterator6[_i6++];
          } else {
            _i6 = _iterator6.next();
            if (_i6.done) return 'break';
            _ref6 = _i6.value;
          }

          var jLink = _ref6;

          var link = jLink[0];
          var img = new Image();
          img.onerror = function () {
            return _this2.templateObject.linkLoaded(link);
          };
          img.src = link.href;
        };

        for (var _iterator6 = this.jLinks, _isArray6 = Array.isArray(_iterator6), _i6 = 0, _iterator6 = _isArray6 ? _iterator6 : _iterator6[Symbol.iterator]();;) {
          var _ref6;

          var _ret3 = _loop3();

          if (_ret3 === 'break') break;
        }
      }
    };

    function View(parentContainer, onLoad) {
      var _this3 = this;

      var template = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

      _classCallCheck(this, View);

      this.pendings = {};
      this.binds = {
        onResize: this.onResize.bind(this)
      };
      this.parentContainer = (0, _libs.$)(parentContainer);
      this.isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
      this.parentContainer.html('<iframe style="border: 0;' + (this.isIOS ? '' : ' width: 100%; height: 100%') + '" scrolling="no"></iframe>');

      this.frame = this.parentContainer.find('iframe')[0];
      if (this.frame.contentWindow.stop) {
        this.frame.contentWindow.stop();
      }
      if (this.isIOS) {
        (0, _libs.$)(this.parentContainer[0].ownerDocument.defaultView).on('resize', this.binds.onResize);
        this.onResize();
        setTimeout(this.checkIframeSize.bind(this), 250);
      }

      this.container = (0, _libs.$)(this.frame.contentDocument.body);
      this.container.css('margin', '0');
      this.head = (0, _libs.$)(this.frame.contentDocument.head);
      this.onLoad = onLoad;
      this.handlers = [];

      var script = template.html ? template.script : this.getTemplate().script;
      var urls = {
        styles: template.styles || this.getTemplate().styles,
        html: [template.html || this.getTemplate().html],
        script: script ? [script] : []
      },
          files = {},
          links = template.links || this.getTemplate().links;

      this.loadFiles(urls, files).then(function () {
        var _loop4 = function _loop4() {
          if (_isArray7) {
            if (_i7 >= _iterator7.length) return 'break';
            _ref7 = _iterator7[_i7++];
          } else {
            _i7 = _iterator7.next();
            if (_i7.done) return 'break';
            _ref7 = _i7.value;
          }

          var style = _ref7;

          var textCss = style.data,
              url = style.url;
          textCss = textCss.replace(/url\(['"](.*?)["']\)/g, function (r, r1) {
            return ['url(', _this3.urlResolver(url, r1), ')'].join('');
          });
          (0, _libs.$)('<style type="text/css">' + textCss + '</style>').appendTo(_this3.head);
        };

        for (var _iterator7 = files.styles, _isArray7 = Array.isArray(_iterator7), _i7 = 0, _iterator7 = _isArray7 ? _iterator7 : _iterator7[Symbol.iterator]();;) {
          var _ref7;

          var _ret4 = _loop4();

          if (_ret4 === 'break') break;
        }

        _this3.container.html(_this3.translate(files.html[0].data));

        _this3.jLinks = [];
        for (var _iterator8 = links, _isArray8 = Array.isArray(_iterator8), _i8 = 0, _iterator8 = _isArray8 ? _iterator8 : _iterator8[Symbol.iterator]();;) {
          var _ref8;

          if (_isArray8) {
            if (_i8 >= _iterator8.length) break;
            _ref8 = _iterator8[_i8++];
          } else {
            _i8 = _iterator8.next();
            if (_i8.done) break;
            _ref8 = _i8.value;
          }

          var _link = _ref8;

          _this3.jLinks.push((0, _libs.$)(['<link ', _this3.objToAttrsStr(_link), '>'].join('')).appendTo(_this3.head));
        }

        if (files.script[0]) {
          var init = eval(files.script[0].data);
          _this3.templateObject = init(_this3.container);
        } else {
          _this3.templateObject = {};
        }

        _this3.linkControls = {};
        for (var _iterator9 = _this3.getLinks(), _isArray9 = Array.isArray(_iterator9), _i9 = 0, _iterator9 = _isArray9 ? _iterator9 : _iterator9[Symbol.iterator]();;) {
          var _ref9;

          if (_isArray9) {
            if (_i9 >= _iterator9.length) break;
            _ref9 = _iterator9[_i9++];
          } else {
            _i9 = _iterator9.next();
            if (_i9.done) break;
            _ref9 = _i9.value;
          }

          var id = _ref9;

          _this3.linkControls[id] = _this3.container.find('.' + id);
          _this3.binds[id] = View.handleLinkEvent.bind({ getHandlers: _this3.getHandlers.bind(_this3), id: id, ctrl: _this3.linkControls[id] });
          _this3.linkControls[id].on('click', _this3.binds[id]);
        }

        _this3.widgetControls = {};
        for (var _iterator10 = _this3.getWidgets(), _isArray10 = Array.isArray(_iterator10), _i10 = 0, _iterator10 = _isArray10 ? _iterator10 : _iterator10[Symbol.iterator]();;) {
          var _ref10;

          if (_isArray10) {
            if (_i10 >= _iterator10.length) break;
            _ref10 = _iterator10[_i10++];
          } else {
            _i10 = _iterator10.next();
            if (_i10.done) break;
            _ref10 = _i10.value;
          }

          var _id = _ref10;

          _this3.widgetControls[_id] = _this3.container.find('.' + _id);
        }

        _this3.inputControls = {};
        for (var _iterator11 = _this3.getInputs(), _isArray11 = Array.isArray(_iterator11), _i11 = 0, _iterator11 = _isArray11 ? _iterator11 : _iterator11[Symbol.iterator]();;) {
          var _ref11;

          if (_isArray11) {
            if (_i11 >= _iterator11.length) break;
            _ref11 = _iterator11[_i11++];
          } else {
            _i11 = _iterator11.next();
            if (_i11.done) break;
            _ref11 = _i11.value;
          }

          var _id2 = _ref11;

          _this3.inputControls[_id2] = _this3.container.find('.' + _id2);
          _this3.binds[_id2] = View.handleInputEvent.bind({ getHandlers: _this3.getHandlers.bind(_this3), id: _id2, ctrl: _this3.inputControls[_id2] });
          _this3.inputControls[_id2].on('keyup', _this3.binds[_id2]);
        }

        _this3.formControls = {};
        for (var _iterator12 = _this3.getForms(), _isArray12 = Array.isArray(_iterator12), _i12 = 0, _iterator12 = _isArray12 ? _iterator12 : _iterator12[Symbol.iterator]();;) {
          var _ref12;

          if (_isArray12) {
            if (_i12 >= _iterator12.length) break;
            _ref12 = _iterator12[_i12++];
          } else {
            _i12 = _iterator12.next();
            if (_i12.done) break;
            _ref12 = _i12.value;
          }

          var _id3 = _ref12;

          _this3.formControls[_id3] = _this3.container.find('.' + _id3);
          _this3.binds[_id3] = View.handleFormEvent.bind({ getHandlers: _this3.getHandlers.bind(_this3), id: _id3, ctrl: _this3.formControls[_id3] });
          _this3.formControls[_id3].on('submit', _this3.binds[_id3]);
        }

        _this3.textControls = {};
        for (var _iterator13 = _this3.getTexts(), _isArray13 = Array.isArray(_iterator13), _i13 = 0, _iterator13 = _isArray13 ? _iterator13 : _iterator13[Symbol.iterator]();;) {
          var _ref13;

          if (_isArray13) {
            if (_i13 >= _iterator13.length) break;
            _ref13 = _iterator13[_i13++];
          } else {
            _i13 = _iterator13.next();
            if (_i13.done) break;
            _ref13 = _i13.value;
          }

          var _id4 = _ref13;

          _this3.textControls[_id4] = _this3.container.find('.' + _id4);
        }

        _this3.stateSetters = [{
          map: _this3.linkControls,
          setter: _this3.setLinkControlState.bind(_this3)
        }, {
          map: _this3.widgetControls,
          setter: _this3.setWidgetControlState.bind(_this3)
        }, {
          map: _this3.inputControls,
          setter: _this3.setInputControlState.bind(_this3)
        }, {
          map: _this3.textControls,
          setter: _this3.setTextControlState.bind(_this3)
        }];

        _this3.initView();

        if (_this3.onLoad) {
          _this3.onLoad();
        }

        _this3.fireLinksOnLoadEvent();
      }).catch(function (res) {
        return console.error(res);
      });
    }

    View.prototype.dispose = function dispose() {
      delete this.textControls;
      for (var _iterator14 = this.getLinks(), _isArray14 = Array.isArray(_iterator14), _i14 = 0, _iterator14 = _isArray14 ? _iterator14 : _iterator14[Symbol.iterator]();;) {
        var _ref14;

        if (_isArray14) {
          if (_i14 >= _iterator14.length) break;
          _ref14 = _iterator14[_i14++];
        } else {
          _i14 = _iterator14.next();
          if (_i14.done) break;
          _ref14 = _i14.value;
        }

        var id = _ref14;

        this.linkControls[id].off('click', this.binds[id]);
      }
      delete this.linkControls;
      delete this.widgetControls;
      for (var _iterator15 = this.getInputs(), _isArray15 = Array.isArray(_iterator15), _i15 = 0, _iterator15 = _isArray15 ? _iterator15 : _iterator15[Symbol.iterator]();;) {
        var _ref15;

        if (_isArray15) {
          if (_i15 >= _iterator15.length) break;
          _ref15 = _iterator15[_i15++];
        } else {
          _i15 = _iterator15.next();
          if (_i15.done) break;
          _ref15 = _i15.value;
        }

        var _id5 = _ref15;

        this.inputControls[_id5].off('keyup', this.binds[_id5]);
      }
      delete this.inputControls;
      for (var _iterator16 = this.getForms(), _isArray16 = Array.isArray(_iterator16), _i16 = 0, _iterator16 = _isArray16 ? _iterator16 : _iterator16[Symbol.iterator]();;) {
        var _ref16;

        if (_isArray16) {
          if (_i16 >= _iterator16.length) break;
          _ref16 = _iterator16[_i16++];
        } else {
          _i16 = _iterator16.next();
          if (_i16.done) break;
          _ref16 = _i16.value;
        }

        var _id6 = _ref16;

        this.formControls[_id6].off('submit', this.binds[_id6]);
      }
      delete this.formControls;

      !this.templateObject.dispose || this.templateObject.dispose();
      delete this.templateObject;

      if (this.isIOS) {
        (0, _libs.$)(this.parentContainer[0].ownerDocument.defaultView).off('resize', this.binds.onResize);
      }
      this.parentContainer.html('');
      delete this.frame;
    };

    View.prototype.getContainer = function getContainer() {
      return this.container[0];
    };

    View.prototype.getParentContainer = function getParentContainer() {
      return this.parentContainer[0];
    };

    View.prototype.addHandler = function addHandler(handler) {
      this.handlers.push(handler);
    };

    View.prototype.initView = function initView() {};

    View.setControlState = function setControlState(ctrl, defaults, state, stateHandlers) {
      if (ctrl) {
        var st = _extends({}, defaults, state);
        for (var _name2 in st) {
          if (st.hasOwnProperty(_name2) && stateHandlers[_name2]) {
            stateHandlers[_name2](ctrl, st[_name2]);
          }
        }
      }
    };

    View.prototype.setLinkControlState = function setLinkControlState(id, state) {
      View.setControlState(this.linkControls[id], {
        visible: true,
        active: false,
        enable: true
      }, state, View.linkStateHandlers);
    };

    View.prototype.setWidgetControlState = function setWidgetControlState(id, state) {
      View.setControlState(this.widgetControls[id], {
        visible: true,
        active: false,
        enable: true
      }, state, View.widgetStateHandlers);
    };

    View.prototype.setInputControlState = function setInputControlState(id, state) {
      View.setControlState(this.inputControls[id], {
        visible: true,
        enable: true,
        value: ''
      }, state, View.inputStateHandlers);
    };

    View.prototype.setTextControlState = function setTextControlState(id, state) {
      View.setControlState(this.textControls[id], {
        visible: true,
        value: ''
      }, state, View.textStateHandlers);
    };

    View.prototype.onItemStateChanged = function onItemStateChanged() {};

    View.prototype.setState = function setState(id, state) {
      for (var _iterator17 = this.stateSetters, _isArray17 = Array.isArray(_iterator17), _i17 = 0, _iterator17 = _isArray17 ? _iterator17 : _iterator17[Symbol.iterator]();;) {
        var _ref17;

        if (_isArray17) {
          if (_i17 >= _iterator17.length) break;
          _ref17 = _iterator17[_i17++];
        } else {
          _i17 = _iterator17.next();
          if (_i17.done) break;
          _ref17 = _i17.value;
        }

        var item = _ref17;

        if (item.map[id]) {
          item.setter(id, state);
          this.onItemStateChanged(id, state);
          break;
        }
      }
    };

    return View;
  }();

  View.linkStateHandlers = {
    visible: function visible(ctrl, value) {
      return View.classProperty(ctrl, 'hidden', !value);
    },
    active: function active(ctrl, value) {
      return View.classProperty(ctrl, 'active', value);
    },
    enable: function enable(ctrl, value) {
      return View.classProperty(ctrl, 'disabled', !value);
    }
  };
  View.widgetStateHandlers = {
    visible: function visible(ctrl, value) {
      return View.classProperty(ctrl, 'hidden', !value);
    },
    active: function active(ctrl, value) {
      return View.classProperty(ctrl, 'active', value);
    },
    enable: function enable(ctrl, value) {
      return View.classProperty(ctrl, 'disabled', !value);
    }
  };
  View.inputStateHandlers = {
    visible: function visible(ctrl, value) {
      return View.classProperty(ctrl, 'hidden', !value);
    },
    value: function value(ctrl, _value) {
      return ctrl[0].value = _value;
    },
    enable: function enable(ctrl, value) {
      return View.attributeProperty(ctrl, 'disabled', !value);
    }
  };
  View.textStateHandlers = {
    visible: function visible(ctrl, value) {
      return View.classProperty(ctrl, 'hidden', !value);
    },
    value: function value(ctrl, _value2) {
      return ctrl.text(_value2);
    }
  };
  exports.default = View;

  /***/
},
/* 66 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }return target;
  };

  var _libs = __webpack_require__(0);

  var _Orbit = __webpack_require__(56);

  var _Orbit2 = _interopRequireDefault(_Orbit);

  var _ThreeMouseEventConverter = __webpack_require__(61);

  var _ThreeMouseEventConverter2 = _interopRequireDefault(_ThreeMouseEventConverter);

  var _ThreeTouchEventConverter = __webpack_require__(62);

  var _ThreeTouchEventConverter2 = _interopRequireDefault(_ThreeTouchEventConverter);

  var _Drag = __webpack_require__(48);

  var _Drag2 = _interopRequireDefault(_Drag);

  var _CSS3DRenderer = __webpack_require__(12);

  var _CSS3DRenderer2 = _interopRequireDefault(_CSS3DRenderer);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var VisualWorld = function (_THREE$EventDispatche) {
    _inherits(VisualWorld, _THREE$EventDispatche);

    function VisualWorld(wnd, doc, container) {
      var useHelpers = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;

      _classCallCheck(this, VisualWorld);

      var _this = _possibleConstructorReturn(this, _THREE$EventDispatche.call(this));

      _this.wnd = wnd;
      _this.doc = doc;
      _this.jContainer = container;
      _this.renderCallbacks = [];

      _this.clock = new _libs.THREE.Clock();

      _this.raycaster = new _libs.THREE.Raycaster();

      _this.scene = new _libs.THREE.Scene();
      _this.cssScene = new _libs.THREE.Scene();

      _this.camera = new _libs.THREE.PerspectiveCamera(30, _this.width() / _this.height(), 0.2, 2000);
      var scale = 1;

      _this.camera.position.x = 0;
      _this.camera.position.y = 5.5 * scale;
      _this.camera.position.z = 0;

      _this.renderer = new _libs.THREE.WebGLRenderer({ alpha: true, antialias: true });
      _this.renderer.setClearColor(0x000000, 0);
      _this.renderer.setPixelRatio(_this.wnd.devicePixelRatio);
      _this.renderer.setSize(_this.width(), _this.height());

      _this.jContainer.append(_this.renderer.domElement);

      _this.cssRenderer = new _CSS3DRenderer2.default();
      _this.cssRenderer.setSize(_this.width(), _this.height());
      (0, _libs.$)(_this.cssRenderer.domElement).css({
        position: 'absolute',
        top: 0,
        margin: 0,
        padding: 0
      });
      _this.jContainer.append(_this.cssRenderer.domElement);

      _this.element = _this.cssRenderer.domElement;

      _this.controls = new _Orbit2.default(_this.camera, _this.element);
      _this.controls.target.y = 0.5;

      var cssScene = (0, _libs.$)(_this.cssRenderer.domElement).find('div'),
          tmpVector = new _libs.THREE.Vector3();
      _this.controls.addEventListener('change', function () {
        _this.camera.getWorldDirection(tmpVector);
        cssScene.css('display', tmpVector.y - _this.camera.position.y > 0 ? 'none' : 'block');
      });

      _this.textureLoader = new _libs.THREE.TextureLoader();

      _this.scene.add(new _libs.THREE.AmbientLight(0xD0D0D0)); //0xC0C0C0

      _this.light = new _libs.THREE.DirectionalLight(0x404040, 1);
      _this.light.position.set(0, 6 * scale, 0);
      _this.light.castShadow = false;
      // const d = 20*scale;
      // this.light.shadow.camera.left = -d;
      // this.light.shadow.camera.right = d;
      // this.light.shadow.camera.top = d;
      // this.light.shadow.camera.bottom = -d;
      // this.light.shadow.camera.near = 1*scale;
      // this.light.shadow.camera.far = 25*scale;
      // this.light.shadow.mapSize.x = 1024;
      // this.light.shadow.mapSize.y = 1024;
      _this.scene.add(_this.light);

      if (useHelpers) {
        _this.scene.add(new _libs.THREE.AxisHelper(5));
      }

      _this.binds = {
        onWindowResize: _this.onWindowResize.bind(_this),
        animate: _this.animate.bind(_this)
      };

      (0, _libs.$)(_this.wnd).on('resize', _this.binds.onWindowResize);

      _this.mouseEvents = new _ThreeMouseEventConverter2.default(_this.wnd, _this.doc, _this);
      _this.touchEvents = new _ThreeTouchEventConverter2.default(_this.wnd, _this.doc, _this);
      var filterData = { type: 'mousemove' };
      _this.mouseEvents.filter = function (element, e) {
        var types = ['mouseenter', 'mouseover', 'mouseleave', 'mouseout'],
            contains = function contains(p, c) {
          return p === c || _libs.$.contains(p, c);
        };
        if (e.type === 'mousemove') {
          filterData.pageX = e.pageX;
          filterData.pageY = e.pageY;
        }
        return e.relatedTarget && ~types.indexOf(e.type) && contains(element, e.target) && contains(element, e.relatedTarget) ? _extends({}, e, filterData) : e;
      };
      _this.drag = new _Drag2.default(_this.wnd, _this.doc, _this);

      _this.animate();
      return _this;
    }

    VisualWorld.prototype.dispose = function dispose() {
      delete this.binds.animate;
      (0, _libs.$)(this.wnd).off('resize', this.binds.onWindowResize);
      this.mouseEvents.dispose();
      this.touchEvents.dispose();
      this.drag.dispose();
      this.controls.dispose();
    };

    VisualWorld.prototype.width = function width() {
      return this.jContainer.width();
    };

    VisualWorld.prototype.height = function height() {
      return this.jContainer.height();
    };

    VisualWorld.prototype.setExtraLighting = function setExtraLighting(v) {
      this.light.intensity = v;
    };

    VisualWorld.prototype.getOrbit = function getOrbit() {
      return this.controls;
    };

    VisualWorld.prototype.setControlsState = function setControlsState(state) {
      this.controls.enabled = state;
    };

    VisualWorld.prototype.getControlsState = function getControlsState() {
      return this.controls.enabled;
    };

    VisualWorld.prototype.onWindowResize = function onWindowResize() {
      var _this2 = this;

      var updateCamera = function updateCamera(camera) {
        camera.aspect = _this2.width() / _this2.height();
        camera.updateProjectionMatrix();
      },
          updateRenderer = function updateRenderer(renderer) {
        renderer.setSize(_this2.width(), _this2.height());
      };

      updateCamera(this.camera);
      updateRenderer(this.renderer);
      updateRenderer(this.cssRenderer);

      this.dispatchEvent({ type: 'resize' });
    };

    VisualWorld.prototype.addObject = function addObject(object) {
      this.scene.add(object);
    };

    VisualWorld.prototype.addCssObject = function addCssObject(object) {
      this.cssScene.add(object);
    };

    VisualWorld.prototype.removeCssObject = function removeCssObject(object) {
      this.cssScene.remove(object);
    };

    VisualWorld.prototype.removeObject = function removeObject(object) {
      this.scene.remove(object);
    };

    VisualWorld.prototype.animate = function animate() {
      if (this.binds.animate) {
        requestAnimationFrame(this.binds.animate);
      }
      this.render();
    };

    VisualWorld.prototype.addRenderCallback = function addRenderCallback(clb) {
      this.renderCallbacks.push(clb);
    };

    VisualWorld.prototype.removeRenderCallback = function removeRenderCallback(clb) {
      var i = this.renderCallbacks.indexOf(clb);
      if (~i) {
        this.renderCallbacks.splice(i, 1);
      }
    };

    VisualWorld.prototype.render = function render() {
      var deltaTime = this.clock.getDelta();
      this.controls.update(deltaTime);
      for (var _iterator = this.renderCallbacks, _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
        var _ref;

        if (_isArray) {
          if (_i >= _iterator.length) break;
          _ref = _iterator[_i++];
        } else {
          _i = _iterator.next();
          if (_i.done) break;
          _ref = _i.value;
        }

        var clb = _ref;

        clb(deltaTime);
      }
      this.cssRenderer.render(this.cssScene, this.camera);
      this.renderer.render(this.scene, this.camera);
    };

    VisualWorld.prototype.processGeometry = function processGeometry(bufGeometry, mesh) {
      mesh.geometry = bufGeometry;
      // Obtain a Geometry
      var geometry = new _libs.THREE.Geometry().fromBufferGeometry(bufGeometry);
      // Merge the vertices so the triangle soup is converted to indexed triangles
      geometry.mergeVertices();
      // Convert again to BufferGeometry, indexed
      var indexedBufferGeom = this.createIndexedBufferGeometryFromGeometry(geometry);
      // Create index arrays mapping the indexed vertices to bufGeometry vertices
      return this.mapIndices(bufGeometry, indexedBufferGeom);
    };

    VisualWorld.prototype.createIndexedBufferGeometryFromGeometry = function createIndexedBufferGeometryFromGeometry(geometry) {
      var numVertices = geometry.vertices.length;
      var numFaces = geometry.faces.length;

      var bufferGeom = new _libs.THREE.BufferGeometry();
      var vertices = new Float32Array(numVertices * 3);
      var indices = new (numFaces * 3 > 65535 ? Uint32Array : Uint16Array)(numFaces * 3);

      for (var i = 0; i < numVertices; i++) {
        var p = geometry.vertices[i];
        var i3 = i * 3;
        vertices[i3] = p.x;
        vertices[i3 + 1] = p.y;
        vertices[i3 + 2] = p.z;
      }

      for (var _i2 = 0; _i2 < numFaces; _i2++) {
        var f = geometry.faces[_i2];
        var _i3 = _i2 * 3;
        indices[_i3] = f.a;
        indices[_i3 + 1] = f.b;
        indices[_i3 + 2] = f.c;
      }

      bufferGeom.setIndex(new _libs.THREE.BufferAttribute(indices, 1));
      bufferGeom.addAttribute('position', new _libs.THREE.BufferAttribute(vertices, 3));

      return bufferGeom;
    };

    VisualWorld.prototype.isEqual = function isEqual(x1, y1, z1, x2, y2, z2) {
      var delta = 0.000001;
      return Math.abs(x2 - x1) < delta && Math.abs(y2 - y1) < delta && Math.abs(z2 - z1) < delta;
    };

    VisualWorld.prototype.mapIndices = function mapIndices(bufGeometry, indexedBufferGeom) {
      // Creates mappedVertices, mappedIndices and mappedAssociation in bufGeometry
      var vertices = bufGeometry.attributes.position.array;
      var idxVertices = indexedBufferGeom.attributes.position.array;
      var indices = indexedBufferGeom.index.array;

      var numIdxVertices = idxVertices.length / 3;
      var numVertices = vertices.length / 3;

      bufGeometry.mappedVertices = idxVertices;
      bufGeometry.mappedIndices = indices;
      bufGeometry.mappedAssociation = [];

      for (var i = 0; i < numIdxVertices; i++) {
        var association = [];
        bufGeometry.mappedAssociation.push(association);
        var i3 = i * 3;
        for (var j = 0; j < numVertices; j++) {
          var j3 = j * 3;
          if (this.isEqual(idxVertices[i3], idxVertices[i3 + 1], idxVertices[i3 + 2], vertices[j3], vertices[j3 + 1], vertices[j3 + 2])) {
            association.push(j3);
          }
        }
      }
      return { vertices: bufGeometry.mappedVertices, indices: bufGeometry.mappedIndices };
    };

    VisualWorld.prototype.oneNodePositionCallback = function oneNodePositionCallback(p, q) {
      this.position.set(p.x, p.y, p.z);
      this.quaternion.set(q.x, q.y, q.z, q.w);
    };

    VisualWorld.prototype.multyNodePositionCallback = function multyNodePositionCallback(node, p, n) {
      var geometry = this.geometry;
      var volumePositions = geometry.attributes.position.array;
      var volumeNormals = geometry.attributes.normal.array;
      var assocVertex = geometry.mappedAssociation[node];

      for (var k = 0; k < assocVertex.length; k++) {
        var indexVertex = assocVertex[k];
        volumePositions[indexVertex] = p.x;
        volumeNormals[indexVertex] = n.x;
        ++indexVertex;
        volumePositions[indexVertex] = p.y;
        volumeNormals[indexVertex] = n.y;
        ++indexVertex;
        volumePositions[indexVertex] = p.z;
        volumeNormals[indexVertex] = n.z;
      }
    };

    VisualWorld.prototype.multyNodePositionPostCallback = function multyNodePositionPostCallback() {
      var geometry = this.geometry;
      geometry.attributes.position.needsUpdate = true;
      geometry.attributes.normal.needsUpdate = true;
    };

    VisualWorld.prototype.pathPositionCallback = function pathPositionCallback(node, p) {
      var positions = this.geometry.attributes.position.array;
      var i = 3 * node;
      positions[i++] = p.x;
      positions[i++] = p.y;
      positions[i] = p.z;
    };

    VisualWorld.prototype.pathPositionPostCallback = function pathPositionPostCallback() {
      var geometry = this.geometry;
      geometry.computeVertexNormals();
      geometry.attributes.position.needsUpdate = true;
      geometry.attributes.normal.needsUpdate = true;
    };

    return VisualWorld;
  }(_libs.THREE.EventDispatcher);

  exports.default = VisualWorld;

  /***/
},
/* 67 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _Controller2 = __webpack_require__(15);

  var _Controller3 = _interopRequireDefault(_Controller2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var WidgetController = function (_Controller) {
    _inherits(WidgetController, _Controller);

    function WidgetController(view) {
      _classCallCheck(this, WidgetController);

      var _this = _possibleConstructorReturn(this, _Controller.call(this));

      _this.view = view;
      _this.visible = false;
      return _this;
    }

    WidgetController.prototype.togle = function togle() {
      this.visible = !this.visible;
      this.fireChange();
    };

    WidgetController.prototype.hide = function hide() {
      this.visible = false;
      this.fireChange();
    };

    WidgetController.prototype.fireChange = function fireChange() {
      if (this.onChange) {
        this.onChange();
      }
      this.updateView();
    };

    WidgetController.prototype.updateView = function updateView() {
      if (this.view) {
        this.view.setState('widFloatWnd', {
          enable: true,
          visible: this.visible,
          active: false
        });
      }
    };

    return WidgetController;
  }(_Controller3.default);

  exports.default = WidgetController;

  /***/
},
/* 68 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _Target2 = __webpack_require__(21);

  var _Target3 = _interopRequireDefault(_Target2);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var CircleTarget = function (_Target) {
    _inherits(CircleTarget, _Target);

    function CircleTarget(x, y, r) {
      _classCallCheck(this, CircleTarget);

      var _this = _possibleConstructorReturn(this, _Target.call(this));

      _this.p = {
        x: x,
        y: y,
        r: r
      };
      return _this;
    }

    CircleTarget.prototype.testIntersection = function testIntersection(e, data) {
      var res = void 0;
      var x = data.x,
          y = data.y,
          p = this.p;

      if ((x - p.x) * (x - p.x) + (y - p.y) * (y - p.y) <= p.r * p.r) {
        res = {
          target: this,
          data: data
        };
      }
      return res;
    };

    return CircleTarget;
  }(_Target3.default);

  exports.default = CircleTarget;

  /***/
},
/* 69 */
/***/function (module, exports, __webpack_require__) {

  "use strict";
  'use strict';

  exports.__esModule = true;

  var _Target2 = __webpack_require__(21);

  var _Target3 = _interopRequireDefault(_Target2);

  var _BaseMathUtils = __webpack_require__(2);

  var _BaseMathUtils2 = _interopRequireDefault(_BaseMathUtils);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _possibleConstructorReturn(self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }return call && ((typeof call === 'undefined' ? 'undefined' : _typeof2(call)) === "object" || typeof call === "function") ? call : self;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === 'undefined' ? 'undefined' : _typeof2(superClass)));
    }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  }

  var PolyTarget = function (_Target) {
    _inherits(PolyTarget, _Target);

    function PolyTarget(poly) {
      _classCallCheck(this, PolyTarget);

      var _this = _possibleConstructorReturn(this, _Target.call(this));

      _this.poly = poly;
      return _this;
    }

    PolyTarget.prototype.testIntersection = function testIntersection(e, p) {
      return _BaseMathUtils2.default.isInsidePoly(this.poly, p) ? {
        target: this,
        data: p
      } : undefined;
    };

    return PolyTarget;
  }(_Target3.default);

  exports.default = PolyTarget;

  /***/
},
/* 70 */
/***/function (module, exports, __webpack_require__) {

  // stats.js - http://github.com/mrdoob/stats.js
  (function (f, e) {
    true ? module.exports = e() : "function" === typeof define && define.amd ? define(e) : f.Stats = e();
  })(this, function () {
    var f = function f() {
      function e(a) {
        c.appendChild(a.dom);return a;
      }function u(a) {
        for (var d = 0; d < c.children.length; d++) {
          c.children[d].style.display = d === a ? "block" : "none";
        }l = a;
      }var l = 0,
          c = document.createElement("div");c.style.cssText = "position:fixed;top:0;left:0;cursor:pointer;opacity:0.9;z-index:10000";c.addEventListener("click", function (a) {
        a.preventDefault();
        u(++l % c.children.length);
      }, !1);var k = (performance || Date).now(),
          g = k,
          a = 0,
          r = e(new f.Panel("FPS", "#0ff", "#002")),
          h = e(new f.Panel("MS", "#0f0", "#020"));if (self.performance && self.performance.memory) var t = e(new f.Panel("MB", "#f08", "#201"));u(0);return { REVISION: 16, dom: c, addPanel: e, showPanel: u, begin: function begin() {
          k = (performance || Date).now();
        }, end: function end() {
          a++;var c = (performance || Date).now();h.update(c - k, 200);if (c > g + 1E3 && (r.update(1E3 * a / (c - g), 100), g = c, a = 0, t)) {
            var d = performance.memory;t.update(d.usedJSHeapSize / 1048576, d.jsHeapSizeLimit / 1048576);
          }return c;
        }, update: function update() {
          k = this.end();
        }, domElement: c, setMode: u };
    };f.Panel = function (e, f, l) {
      var c = Infinity,
          k = 0,
          g = Math.round,
          a = g(window.devicePixelRatio || 1),
          r = 80 * a,
          h = 48 * a,
          t = 3 * a,
          v = 2 * a,
          d = 3 * a,
          m = 15 * a,
          n = 74 * a,
          p = 30 * a,
          q = document.createElement("canvas");q.width = r;q.height = h;q.style.cssText = "width:80px;height:48px";var b = q.getContext("2d");b.font = "bold " + 9 * a + "px Helvetica,Arial,sans-serif";b.textBaseline = "top";b.fillStyle = l;b.fillRect(0, 0, r, h);b.fillStyle = f;b.fillText(e, t, v);
      b.fillRect(d, m, n, p);b.fillStyle = l;b.globalAlpha = .9;b.fillRect(d, m, n, p);return { dom: q, update: function update(h, w) {
          c = Math.min(c, h);k = Math.max(k, h);b.fillStyle = l;b.globalAlpha = 1;b.fillRect(0, 0, r, m);b.fillStyle = f;b.fillText(g(h) + " " + e + " (" + g(c) + "-" + g(k) + ")", t, v);b.drawImage(q, d + a, m, n - a, p, d, m, n - a, p);b.fillRect(d + n - a, m, a, p);b.fillStyle = l;b.globalAlpha = .9;b.fillRect(d + n - a, m, a, g((1 - h / w) * p));
        } };
    };return f;
  });

  /***/
},
/* 71 */
/***/function (module, exports, __webpack_require__) {

  /*** IMPORTS FROM imports-loader ***/
  var define = false;

  /*!
   * jQuery Mousewheel 3.1.13
   *
   * Copyright jQuery Foundation and other contributors
   * Released under the MIT license
   * http://jquery.org/license
   */

  (function (factory) {
    if (typeof define === 'function' && define.amd) {
      // AMD. Register as an anonymous module.
      define(['jquery'], factory);
    } else if (true) {
      // Node/CommonJS style for Browserify
      module.exports = factory;
    } else {
      // Browser globals
      factory(jQuery);
    }
  })(function ($) {

    var toFix = ['wheel', 'mousewheel', 'DOMMouseScroll', 'MozMousePixelScroll'],
        toBind = 'onwheel' in document || document.documentMode >= 9 ? ['wheel'] : ['mousewheel', 'DomMouseScroll', 'MozMousePixelScroll'],
        slice = Array.prototype.slice,
        nullLowestDeltaTimeout,
        lowestDelta;

    if ($.event.fixHooks) {
      for (var i = toFix.length; i;) {
        $.event.fixHooks[toFix[--i]] = $.event.mouseHooks;
      }
    }

    var special = $.event.special.mousewheel = {
      version: '3.1.12',

      setup: function setup() {
        if (this.addEventListener) {
          for (var i = toBind.length; i;) {
            this.addEventListener(toBind[--i], handler, false);
          }
        } else {
          this.onmousewheel = handler;
        }
        // Store the line height and page height for this particular element
        $.data(this, 'mousewheel-line-height', special.getLineHeight(this));
        $.data(this, 'mousewheel-page-height', special.getPageHeight(this));
      },

      teardown: function teardown() {
        if (this.removeEventListener) {
          for (var i = toBind.length; i;) {
            this.removeEventListener(toBind[--i], handler, false);
          }
        } else {
          this.onmousewheel = null;
        }
        // Clean up the data we added to the element
        $.removeData(this, 'mousewheel-line-height');
        $.removeData(this, 'mousewheel-page-height');
      },

      getLineHeight: function getLineHeight(elem) {
        var $elem = $(elem),
            $parent = $elem['offsetParent' in $.fn ? 'offsetParent' : 'parent']();
        if (!$parent.length) {
          $parent = $('body');
        }
        return parseInt($parent.css('fontSize'), 10) || parseInt($elem.css('fontSize'), 10) || 16;
      },

      getPageHeight: function getPageHeight(elem) {
        return $(elem).height();
      },

      settings: {
        adjustOldDeltas: true, // see shouldAdjustOldDeltas() below
        normalizeOffset: true // calls getBoundingClientRect for each event
      }
    };

    $.fn.extend({
      mousewheel: function mousewheel(fn) {
        return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
      },

      unmousewheel: function unmousewheel(fn) {
        return this.unbind('mousewheel', fn);
      }
    });

    function handler(event) {
      var orgEvent = event || window.event,
          args = slice.call(arguments, 1),
          delta = 0,
          deltaX = 0,
          deltaY = 0,
          absDelta = 0,
          offsetX = 0,
          offsetY = 0;
      event = $.event.fix(orgEvent);
      event.type = 'mousewheel';

      // Old school scrollwheel delta
      if ('detail' in orgEvent) {
        deltaY = orgEvent.detail * -1;
      }
      if ('wheelDelta' in orgEvent) {
        deltaY = orgEvent.wheelDelta;
      }
      if ('wheelDeltaY' in orgEvent) {
        deltaY = orgEvent.wheelDeltaY;
      }
      if ('wheelDeltaX' in orgEvent) {
        deltaX = orgEvent.wheelDeltaX * -1;
      }

      // Firefox < 17 horizontal scrolling related to DOMMouseScroll event
      if ('axis' in orgEvent && orgEvent.axis === orgEvent.HORIZONTAL_AXIS) {
        deltaX = deltaY * -1;
        deltaY = 0;
      }

      // Set delta to be deltaY or deltaX if deltaY is 0 for backwards compatabilitiy
      delta = deltaY === 0 ? deltaX : deltaY;

      // New school wheel delta (wheel event)
      if ('deltaY' in orgEvent) {
        deltaY = orgEvent.deltaY * -1;
        delta = deltaY;
      }
      if ('deltaX' in orgEvent) {
        deltaX = orgEvent.deltaX;
        if (deltaY === 0) {
          delta = deltaX * -1;
        }
      }

      // No change actually happened, no reason to go any further
      if (deltaY === 0 && deltaX === 0) {
        return;
      }

      // Need to convert lines and pages to pixels if we aren't already in pixels
      // There are three delta modes:
      //   * deltaMode 0 is by pixels, nothing to do
      //   * deltaMode 1 is by lines
      //   * deltaMode 2 is by pages
      if (orgEvent.deltaMode === 1) {
        var lineHeight = $.data(this, 'mousewheel-line-height');
        delta *= lineHeight;
        deltaY *= lineHeight;
        deltaX *= lineHeight;
      } else if (orgEvent.deltaMode === 2) {
        var pageHeight = $.data(this, 'mousewheel-page-height');
        delta *= pageHeight;
        deltaY *= pageHeight;
        deltaX *= pageHeight;
      }

      // Store lowest absolute delta to normalize the delta values
      absDelta = Math.max(Math.abs(deltaY), Math.abs(deltaX));

      if (!lowestDelta || absDelta < lowestDelta) {
        lowestDelta = absDelta;

        // Adjust older deltas if necessary
        if (shouldAdjustOldDeltas(orgEvent, absDelta)) {
          lowestDelta /= 40;
        }
      }

      // Adjust older deltas if necessary
      if (shouldAdjustOldDeltas(orgEvent, absDelta)) {
        // Divide all the things by 40!
        delta /= 40;
        deltaX /= 40;
        deltaY /= 40;
      }

      // Get a whole, normalized value for the deltas
      delta = Math[delta >= 1 ? 'floor' : 'ceil'](delta / lowestDelta);
      deltaX = Math[deltaX >= 1 ? 'floor' : 'ceil'](deltaX / lowestDelta);
      deltaY = Math[deltaY >= 1 ? 'floor' : 'ceil'](deltaY / lowestDelta);

      // Normalise offsetX and offsetY properties
      if (special.settings.normalizeOffset && this.getBoundingClientRect) {
        var boundingRect = this.getBoundingClientRect();
        offsetX = event.clientX - boundingRect.left;
        offsetY = event.clientY - boundingRect.top;
      }

      // Add information to the event object
      event.deltaX = deltaX;
      event.deltaY = deltaY;
      event.deltaFactor = lowestDelta;
      event.offsetX = offsetX;
      event.offsetY = offsetY;
      // Go ahead and set deltaMode to 0 since we converted to pixels
      // Although this is a little odd since we overwrite the deltaX/Y
      // properties with normalized deltas.
      event.deltaMode = 0;

      // Add event and delta to the front of the arguments
      args.unshift(event, delta, deltaX, deltaY);

      // Clearout lowestDelta after sometime to better
      // handle multiple device types that give different
      // a different lowestDelta
      // Ex: trackpad = 3 and mouse wheel = 120
      if (nullLowestDeltaTimeout) {
        clearTimeout(nullLowestDeltaTimeout);
      }
      nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200);

      return ($.event.dispatch || $.event.handle).apply(this, args);
    }

    function nullLowestDelta() {
      lowestDelta = null;
    }

    function shouldAdjustOldDeltas(orgEvent, absDelta) {
      // If this is an older event and the delta is divisable by 120,
      // then we are assuming that the browser is treating this as an
      // older mouse wheel event and that we should divide the deltas
      // by 40 to try and get a more usable deltaFactor.
      // Side note, this actually impacts the reported scroll distance
      // in older browsers and can cause scrolling to be slower than native.
      // Turn this off by setting $.event.special.mousewheel.settings.adjustOldDeltas to false.
      return special.settings.adjustOldDeltas && orgEvent.type === 'mousewheel' && absDelta % 120 === 0;
    }
  });

  /***/
},
/* 72 */
/***/function (module, exports, __webpack_require__) {

  __webpack_require__(23);
  module.exports = __webpack_require__(22);

  /***/
}
/******/]);

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


exports.__esModule = true;
var _$ =  true ? window.jQuery : require('jquery'),
    _html2canvas =  true ? window.html2canvas : require('html2canvas'),
    _THREE =  true ? window.THREE : require('three'),
    _PDFJS =  true ? window.PDFJS : require('pdfjs');

exports.$ = _$;
exports.html2canvas = _html2canvas;
exports.THREE = _THREE;
exports.PDFJS = _PDFJS;

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(0);


/***/ })
/******/ ]);
