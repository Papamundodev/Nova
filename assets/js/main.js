var commonjsGlobal = typeof globalThis !== "undefined" ? globalThis : typeof window !== "undefined" ? window : typeof global !== "undefined" ? global : typeof self !== "undefined" ? self : {};
function getDefaultExportFromCjs(x) {
  return x && x.__esModule && Object.prototype.hasOwnProperty.call(x, "default") ? x["default"] : x;
}
var odometer = { exports: {} };
(function(module, exports) {
  (function() {
    var COUNT_FRAMERATE, COUNT_MS_PER_FRAME, DIGIT_FORMAT, DIGIT_HTML, DIGIT_SPEEDBOOST, DURATION, FORMAT_MARK_HTML, FORMAT_PARSER, FRAMERATE, FRAMES_PER_VALUE, MS_PER_FRAME, MutationObserver2, Odometer2, RIBBON_HTML, TRANSITION_END_EVENTS, TRANSITION_SUPPORT, VALUE_HTML, addClass, createFromHTML, fractionalPart, now, removeClass, requestAnimationFrame2, round, transitionCheckStyles, trigger, truncate, wrapJQuery, _jQueryWrapped, _old, _ref, _ref1, __slice = [].slice;
    VALUE_HTML = '<span class="odometer-value"></span>';
    RIBBON_HTML = '<span class="odometer-ribbon"><span class="odometer-ribbon-inner">' + VALUE_HTML + "</span></span>";
    DIGIT_HTML = '<span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner">' + RIBBON_HTML + "</span></span>";
    FORMAT_MARK_HTML = '<span class="odometer-formatting-mark"></span>';
    DIGIT_FORMAT = "(,ddd).dd";
    FORMAT_PARSER = /^\(?([^)]*)\)?(?:(.)(d+))?$/;
    FRAMERATE = 30;
    DURATION = 2e3;
    COUNT_FRAMERATE = 20;
    FRAMES_PER_VALUE = 2;
    DIGIT_SPEEDBOOST = 0.5;
    MS_PER_FRAME = 1e3 / FRAMERATE;
    COUNT_MS_PER_FRAME = 1e3 / COUNT_FRAMERATE;
    TRANSITION_END_EVENTS = "transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd";
    transitionCheckStyles = document.createElement("div").style;
    TRANSITION_SUPPORT = transitionCheckStyles.transition != null || transitionCheckStyles.webkitTransition != null || transitionCheckStyles.mozTransition != null || transitionCheckStyles.oTransition != null;
    requestAnimationFrame2 = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    MutationObserver2 = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
    createFromHTML = function(html) {
      var el;
      el = document.createElement("div");
      el.innerHTML = html;
      return el.children[0];
    };
    removeClass = function(el, name) {
      return el.className = el.className.replace(new RegExp("(^| )" + name.split(" ").join("|") + "( |$)", "gi"), " ");
    };
    addClass = function(el, name) {
      removeClass(el, name);
      return el.className += " " + name;
    };
    trigger = function(el, name) {
      var evt;
      if (document.createEvent != null) {
        evt = document.createEvent("HTMLEvents");
        evt.initEvent(name, true, true);
        return el.dispatchEvent(evt);
      }
    };
    now = function() {
      var _ref2, _ref12;
      return (_ref2 = (_ref12 = window.performance) != null ? typeof _ref12.now === "function" ? _ref12.now() : void 0 : void 0) != null ? _ref2 : +/* @__PURE__ */ new Date();
    };
    round = function(val, precision) {
      if (precision == null) {
        precision = 0;
      }
      if (!precision) {
        return Math.round(val);
      }
      val *= Math.pow(10, precision);
      val += 0.5;
      val = Math.floor(val);
      return val /= Math.pow(10, precision);
    };
    truncate = function(val) {
      if (val < 0) {
        return Math.ceil(val);
      } else {
        return Math.floor(val);
      }
    };
    fractionalPart = function(val) {
      return val - round(val);
    };
    _jQueryWrapped = false;
    (wrapJQuery = function() {
      var property, _i, _len, _ref2, _results;
      if (_jQueryWrapped) {
        return;
      }
      if (window.jQuery != null) {
        _jQueryWrapped = true;
        _ref2 = ["html", "text"];
        _results = [];
        for (_i = 0, _len = _ref2.length; _i < _len; _i++) {
          property = _ref2[_i];
          _results.push(function(property2) {
            var old;
            old = window.jQuery.fn[property2];
            return window.jQuery.fn[property2] = function(val) {
              var _ref12;
              if (val == null || ((_ref12 = this[0]) != null ? _ref12.odometer : void 0) == null) {
                return old.apply(this, arguments);
              }
              return this[0].odometer.update(val);
            };
          }(property));
        }
        return _results;
      }
    })();
    setTimeout(wrapJQuery, 0);
    Odometer2 = function() {
      function Odometer3(options) {
        var k, property, v, _base, _i, _len, _ref2, _ref12, _ref22, _this = this;
        this.options = options;
        this.el = this.options.el;
        if (this.el.odometer != null) {
          return this.el.odometer;
        }
        this.el.odometer = this;
        _ref2 = Odometer3.options;
        for (k in _ref2) {
          v = _ref2[k];
          if (this.options[k] == null) {
            this.options[k] = v;
          }
        }
        if ((_base = this.options).duration == null) {
          _base.duration = DURATION;
        }
        this.MAX_VALUES = this.options.duration / MS_PER_FRAME / FRAMES_PER_VALUE | 0;
        this.resetFormat();
        this.value = this.cleanValue((_ref12 = this.options.value) != null ? _ref12 : "");
        this.renderInside();
        this.render();
        try {
          _ref22 = ["innerHTML", "innerText", "textContent"];
          for (_i = 0, _len = _ref22.length; _i < _len; _i++) {
            property = _ref22[_i];
            if (this.el[property] != null) {
              (function(property2) {
                return Object.defineProperty(_this.el, property2, {
                  get: function() {
                    var _ref3;
                    if (property2 === "innerHTML") {
                      return _this.inside.outerHTML;
                    } else {
                      return (_ref3 = _this.inside.innerText) != null ? _ref3 : _this.inside.textContent;
                    }
                  },
                  set: function(val) {
                    return _this.update(val);
                  }
                });
              })(property);
            }
          }
        } catch (_error) {
          this.watchForMutations();
        }
      }
      Odometer3.prototype.renderInside = function() {
        this.inside = document.createElement("div");
        this.inside.className = "odometer-inside";
        this.el.innerHTML = "";
        return this.el.appendChild(this.inside);
      };
      Odometer3.prototype.watchForMutations = function() {
        var _this = this;
        if (MutationObserver2 == null) {
          return;
        }
        try {
          if (this.observer == null) {
            this.observer = new MutationObserver2(function(mutations) {
              var newVal;
              newVal = _this.el.innerText;
              _this.renderInside();
              _this.render(_this.value);
              return _this.update(newVal);
            });
          }
          this.watchMutations = true;
          return this.startWatchingMutations();
        } catch (_error) {
        }
      };
      Odometer3.prototype.startWatchingMutations = function() {
        if (this.watchMutations) {
          return this.observer.observe(this.el, {
            childList: true
          });
        }
      };
      Odometer3.prototype.stopWatchingMutations = function() {
        var _ref2;
        return (_ref2 = this.observer) != null ? _ref2.disconnect() : void 0;
      };
      Odometer3.prototype.cleanValue = function(val) {
        var _ref2;
        if (typeof val === "string") {
          val = val.replace((_ref2 = this.format.radix) != null ? _ref2 : ".", "<radix>");
          val = val.replace(/[.,]/g, "");
          val = val.replace("<radix>", ".");
          val = parseFloat(val, 10) || 0;
        }
        return round(val, this.format.precision);
      };
      Odometer3.prototype.bindTransitionEnd = function() {
        var event, renderEnqueued, _i, _len, _ref2, _results, _this = this;
        if (this.transitionEndBound) {
          return;
        }
        this.transitionEndBound = true;
        renderEnqueued = false;
        _ref2 = TRANSITION_END_EVENTS.split(" ");
        _results = [];
        for (_i = 0, _len = _ref2.length; _i < _len; _i++) {
          event = _ref2[_i];
          _results.push(this.el.addEventListener(event, function() {
            if (renderEnqueued) {
              return true;
            }
            renderEnqueued = true;
            setTimeout(function() {
              _this.render();
              renderEnqueued = false;
              return trigger(_this.el, "odometerdone");
            }, 0);
            return true;
          }, false));
        }
        return _results;
      };
      Odometer3.prototype.resetFormat = function() {
        var format, fractional, parsed, precision, radix, repeating, _ref2, _ref12;
        format = (_ref2 = this.options.format) != null ? _ref2 : DIGIT_FORMAT;
        format || (format = "d");
        parsed = FORMAT_PARSER.exec(format);
        if (!parsed) {
          throw new Error("Odometer: Unparsable digit format");
        }
        _ref12 = parsed.slice(1, 4), repeating = _ref12[0], radix = _ref12[1], fractional = _ref12[2];
        precision = (fractional != null ? fractional.length : void 0) || 0;
        return this.format = {
          repeating,
          radix,
          precision
        };
      };
      Odometer3.prototype.render = function(value) {
        var classes, cls, match, newClasses, theme, _i, _len;
        if (value == null) {
          value = this.value;
        }
        this.stopWatchingMutations();
        this.resetFormat();
        this.inside.innerHTML = "";
        theme = this.options.theme;
        classes = this.el.className.split(" ");
        newClasses = [];
        for (_i = 0, _len = classes.length; _i < _len; _i++) {
          cls = classes[_i];
          if (!cls.length) {
            continue;
          }
          if (match = /^odometer-theme-(.+)$/.exec(cls)) {
            theme = match[1];
            continue;
          }
          if (/^odometer(-|$)/.test(cls)) {
            continue;
          }
          newClasses.push(cls);
        }
        newClasses.push("odometer");
        if (!TRANSITION_SUPPORT) {
          newClasses.push("odometer-no-transitions");
        }
        if (theme) {
          newClasses.push("odometer-theme-" + theme);
        } else {
          newClasses.push("odometer-auto-theme");
        }
        this.el.className = newClasses.join(" ");
        this.ribbons = {};
        this.formatDigits(value);
        return this.startWatchingMutations();
      };
      Odometer3.prototype.formatDigits = function(value) {
        var digit, valueDigit, valueString, wholePart, _i, _j, _len, _len1, _ref2, _ref12;
        this.digits = [];
        if (this.options.formatFunction) {
          valueString = this.options.formatFunction(value);
          _ref2 = valueString.split("").reverse();
          for (_i = 0, _len = _ref2.length; _i < _len; _i++) {
            valueDigit = _ref2[_i];
            if (valueDigit.match(/0-9/)) {
              digit = this.renderDigit();
              digit.querySelector(".odometer-value").innerHTML = valueDigit;
              this.digits.push(digit);
              this.insertDigit(digit);
            } else {
              this.addSpacer(valueDigit);
            }
          }
        } else {
          wholePart = !this.format.precision || !fractionalPart(value) || false;
          _ref12 = value.toString().split("").reverse();
          for (_j = 0, _len1 = _ref12.length; _j < _len1; _j++) {
            digit = _ref12[_j];
            if (digit === ".") {
              wholePart = true;
            }
            this.addDigit(digit, wholePart);
          }
        }
      };
      Odometer3.prototype.update = function(newValue) {
        var diff, _this = this;
        newValue = this.cleanValue(newValue);
        if (!(diff = newValue - this.value)) {
          return;
        }
        removeClass(this.el, "odometer-animating-up odometer-animating-down odometer-animating");
        if (diff > 0) {
          addClass(this.el, "odometer-animating-up");
        } else {
          addClass(this.el, "odometer-animating-down");
        }
        this.stopWatchingMutations();
        this.animate(newValue);
        this.startWatchingMutations();
        setTimeout(function() {
          _this.el.offsetHeight;
          return addClass(_this.el, "odometer-animating");
        }, 0);
        return this.value = newValue;
      };
      Odometer3.prototype.renderDigit = function() {
        return createFromHTML(DIGIT_HTML);
      };
      Odometer3.prototype.insertDigit = function(digit, before) {
        if (before != null) {
          return this.inside.insertBefore(digit, before);
        } else if (!this.inside.children.length) {
          return this.inside.appendChild(digit);
        } else {
          return this.inside.insertBefore(digit, this.inside.children[0]);
        }
      };
      Odometer3.prototype.addSpacer = function(chr, before, extraClasses) {
        var spacer;
        spacer = createFromHTML(FORMAT_MARK_HTML);
        spacer.innerHTML = chr;
        if (extraClasses) {
          addClass(spacer, extraClasses);
        }
        return this.insertDigit(spacer, before);
      };
      Odometer3.prototype.addDigit = function(value, repeating) {
        var chr, digit, resetted, _ref2;
        if (repeating == null) {
          repeating = true;
        }
        if (value === "-") {
          return this.addSpacer(value, null, "odometer-negation-mark");
        }
        if (value === ".") {
          return this.addSpacer((_ref2 = this.format.radix) != null ? _ref2 : ".", null, "odometer-radix-mark");
        }
        if (repeating) {
          resetted = false;
          while (true) {
            if (!this.format.repeating.length) {
              if (resetted) {
                throw new Error("Bad odometer format without digits");
              }
              this.resetFormat();
              resetted = true;
            }
            chr = this.format.repeating[this.format.repeating.length - 1];
            this.format.repeating = this.format.repeating.substring(0, this.format.repeating.length - 1);
            if (chr === "d") {
              break;
            }
            this.addSpacer(chr);
          }
        }
        digit = this.renderDigit();
        digit.querySelector(".odometer-value").innerHTML = value;
        this.digits.push(digit);
        return this.insertDigit(digit);
      };
      Odometer3.prototype.animate = function(newValue) {
        if (!TRANSITION_SUPPORT || this.options.animation === "count") {
          return this.animateCount(newValue);
        } else {
          return this.animateSlide(newValue);
        }
      };
      Odometer3.prototype.animateCount = function(newValue) {
        var cur, diff, last, start, tick, _this = this;
        if (!(diff = +newValue - this.value)) {
          return;
        }
        start = last = now();
        cur = this.value;
        return (tick = function() {
          var delta, dist, fraction;
          if (now() - start > _this.options.duration) {
            _this.value = newValue;
            _this.render();
            trigger(_this.el, "odometerdone");
            return;
          }
          delta = now() - last;
          if (delta > COUNT_MS_PER_FRAME) {
            last = now();
            fraction = delta / _this.options.duration;
            dist = diff * fraction;
            cur += dist;
            _this.render(Math.round(cur));
          }
          if (requestAnimationFrame2 != null) {
            return requestAnimationFrame2(tick);
          } else {
            return setTimeout(tick, COUNT_MS_PER_FRAME);
          }
        })();
      };
      Odometer3.prototype.getDigitCount = function() {
        var i, max, value, values, _i, _len;
        values = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
        for (i = _i = 0, _len = values.length; _i < _len; i = ++_i) {
          value = values[i];
          values[i] = Math.abs(value);
        }
        max = Math.max.apply(Math, values);
        return Math.ceil(Math.log(max + 1) / Math.log(10));
      };
      Odometer3.prototype.getFractionalDigitCount = function() {
        var i, parser, parts, value, values, _i, _len;
        values = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
        parser = /^\-?\d*\.(\d*?)0*$/;
        for (i = _i = 0, _len = values.length; _i < _len; i = ++_i) {
          value = values[i];
          values[i] = value.toString();
          parts = parser.exec(values[i]);
          if (parts == null) {
            values[i] = 0;
          } else {
            values[i] = parts[1].length;
          }
        }
        return Math.max.apply(Math, values);
      };
      Odometer3.prototype.resetDigits = function() {
        this.digits = [];
        this.ribbons = [];
        this.inside.innerHTML = "";
        return this.resetFormat();
      };
      Odometer3.prototype.animateSlide = function(newValue) {
        var boosted, cur, diff, digitCount, digits, dist, end, fractionalCount, frame, frames, i, incr, j, mark, numEl, oldValue, start, _base, _i, _k, _l, _len, _len1, _len2, _m, _ref2, _results;
        oldValue = this.value;
        fractionalCount = this.getFractionalDigitCount(oldValue, newValue);
        if (fractionalCount) {
          newValue = newValue * Math.pow(10, fractionalCount);
          oldValue = oldValue * Math.pow(10, fractionalCount);
        }
        if (!(diff = newValue - oldValue)) {
          return;
        }
        this.bindTransitionEnd();
        digitCount = this.getDigitCount(oldValue, newValue);
        digits = [];
        boosted = 0;
        for (i = _i = 0; 0 <= digitCount ? _i < digitCount : _i > digitCount; i = 0 <= digitCount ? ++_i : --_i) {
          start = truncate(oldValue / Math.pow(10, digitCount - i - 1));
          end = truncate(newValue / Math.pow(10, digitCount - i - 1));
          dist = end - start;
          if (Math.abs(dist) > this.MAX_VALUES) {
            frames = [];
            incr = dist / (this.MAX_VALUES + this.MAX_VALUES * boosted * DIGIT_SPEEDBOOST);
            cur = start;
            while (dist > 0 && cur < end || dist < 0 && cur > end) {
              frames.push(Math.round(cur));
              cur += incr;
            }
            if (frames[frames.length - 1] !== end) {
              frames.push(end);
            }
            boosted++;
          } else {
            frames = (function() {
              _results = [];
              for (var _j = start; start <= end ? _j <= end : _j >= end; start <= end ? _j++ : _j--) {
                _results.push(_j);
              }
              return _results;
            }).apply(this);
          }
          for (i = _k = 0, _len = frames.length; _k < _len; i = ++_k) {
            frame = frames[i];
            frames[i] = Math.abs(frame % 10);
          }
          digits.push(frames);
        }
        this.resetDigits();
        _ref2 = digits.reverse();
        for (i = _l = 0, _len1 = _ref2.length; _l < _len1; i = ++_l) {
          frames = _ref2[i];
          if (!this.digits[i]) {
            this.addDigit(" ", i >= fractionalCount);
          }
          if ((_base = this.ribbons)[i] == null) {
            _base[i] = this.digits[i].querySelector(".odometer-ribbon-inner");
          }
          this.ribbons[i].innerHTML = "";
          if (diff < 0) {
            frames = frames.reverse();
          }
          for (j = _m = 0, _len2 = frames.length; _m < _len2; j = ++_m) {
            frame = frames[j];
            numEl = document.createElement("div");
            numEl.className = "odometer-value";
            numEl.innerHTML = frame;
            this.ribbons[i].appendChild(numEl);
            if (j === frames.length - 1) {
              addClass(numEl, "odometer-last-value");
            }
            if (j === 0) {
              addClass(numEl, "odometer-first-value");
            }
          }
        }
        if (start < 0) {
          this.addDigit("-");
        }
        mark = this.inside.querySelector(".odometer-radix-mark");
        if (mark != null) {
          mark.parent.removeChild(mark);
        }
        if (fractionalCount) {
          return this.addSpacer(this.format.radix, this.digits[fractionalCount - 1], "odometer-radix-mark");
        }
      };
      return Odometer3;
    }();
    Odometer2.options = (_ref = window.odometerOptions) != null ? _ref : {};
    setTimeout(function() {
      var k, v, _base, _ref12, _results;
      if (window.odometerOptions) {
        _ref12 = window.odometerOptions;
        _results = [];
        for (k in _ref12) {
          v = _ref12[k];
          _results.push((_base = Odometer2.options)[k] != null ? (_base = Odometer2.options)[k] : _base[k] = v);
        }
        return _results;
      }
    }, 0);
    Odometer2.init = function() {
      var el, elements, _i, _len, _ref12, _results;
      if (document.querySelectorAll == null) {
        return;
      }
      elements = document.querySelectorAll(Odometer2.options.selector || ".odometer");
      _results = [];
      for (_i = 0, _len = elements.length; _i < _len; _i++) {
        el = elements[_i];
        _results.push(el.odometer = new Odometer2({
          el,
          value: (_ref12 = el.innerText) != null ? _ref12 : el.textContent
        }));
      }
      return _results;
    };
    if (((_ref1 = document.documentElement) != null ? _ref1.doScroll : void 0) != null && document.createEventObject != null) {
      _old = document.onreadystatechange;
      document.onreadystatechange = function() {
        if (document.readyState === "complete" && Odometer2.options.auto !== false) {
          Odometer2.init();
        }
        return _old != null ? _old.apply(this, arguments) : void 0;
      };
    } else {
      document.addEventListener("DOMContentLoaded", function() {
        if (Odometer2.options.auto !== false) {
          return Odometer2.init();
        }
      }, false);
    }
    if (exports !== null) {
      module.exports = Odometer2;
    } else {
      window.Odometer = Odometer2;
    }
  }).call(commonjsGlobal);
})(odometer, odometer.exports);
var odometerExports = odometer.exports;
const Odometer = /* @__PURE__ */ getDefaultExportFromCjs(odometerExports);
Odometer.options.auto = false;
function initBorderAnimations() {
  var _a, _b;
  const borderAnimations = document.querySelectorAll(
    ".border-animation[data-pourcentage]"
  );
  if (borderAnimations.length === 0) {
    return;
  }
  const prefersReduce = (_b = (_a = window.matchMedia) == null ? void 0 : _a.call(window, "(prefers-reduced-motion: reduce)")) == null ? void 0 : _b.matches;
  const initBorderOdometer = (borderEl, target) => {
    const odEl = borderEl.querySelector(
      ".border-odometer.odometer[data-odometer-value]"
    );
    if (!odEl)
      return null;
    if (odEl.dataset.odometerInit === "1")
      return null;
    odEl.dataset.odometerInit = "1";
    const rawTarget = odEl.dataset.odometerValue ?? String(target ?? "0");
    const targetNumber = Math.min(100, Math.max(0, parseFloat(rawTarget)));
    if (!Number.isFinite(targetNumber))
      return null;
    odEl.textContent = "0";
    const od = new Odometer({
      el: odEl,
      value: 0,
      duration: 2e3,
      theme: "default",
      format: "d"
    });
    return () => od.update(targetNumber);
  };
  const apply = (el) => {
    const pourcentage = parseFloat(el.dataset.pourcentage);
    if (isNaN(pourcentage)) {
      return;
    }
    const degree = pourcentage / 100 * 360;
    el.style.setProperty("--pourcentage", pourcentage + "%");
    el.style.setProperty("--degree", degree + "deg");
    if (prefersReduce) {
      el.classList.add("is-animated");
      const odTrigger2 = initBorderOdometer(el, pourcentage);
      if (odTrigger2)
        odTrigger2();
      return;
    }
    const odTrigger = initBorderOdometer(el, pourcentage);
    requestAnimationFrame(() => {
      el.classList.add("is-animated");
      if (odTrigger)
        odTrigger();
    });
  };
  if ("IntersectionObserver" in window && !prefersReduce) {
    const borderObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting)
            return;
          apply(entry.target);
          observer.unobserve(entry.target);
        });
      },
      { rootMargin: "0px 0px -10% 0px", threshold: 0.15 }
    );
    borderAnimations.forEach((el) => borderObserver.observe(el));
  } else {
    borderAnimations.forEach((el) => apply(el));
  }
}
document.addEventListener("DOMContentLoaded", () => {
  initBorderAnimations();
});
function initMatrixCanvas() {
  const canvas = document.getElementById("matrix-canvas");
  if (!canvas)
    return;
  const ctx = canvas.getContext("2d");
  const styles = getComputedStyle(canvas);
  const colors = [
    styles.getPropertyValue("--primary-color").trim(),
    styles.getPropertyValue("--secondary-color").trim(),
    styles.getPropertyValue("--purple-color").trim(),
    styles.getPropertyValue("--green-color").trim()
  ].filter(Boolean);
  function resizeCanvas() {
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;
  }
  resizeCanvas();
  window.addEventListener("resize", resizeCanvas);
  const mouse = { x: null, y: null, radius: 150 };
  window.addEventListener("mousemove", (e) => {
    const rect = canvas.getBoundingClientRect();
    mouse.x = e.clientX - rect.left;
    mouse.y = e.clientY - rect.top;
  });
  canvas.addEventListener("mouseleave", () => {
    mouse.x = null;
    mouse.y = null;
  });
  class Particle {
    constructor() {
      this.reset();
      this.x = Math.random() * canvas.width;
      this.y = Math.random() * canvas.height;
    }
    // Re-initialize a particle (at creation and when it leaves the canvas)
    reset() {
      this.size = Math.random() * 3 + 1;
      this.density = Math.random() * 30 + 1;
      this.color = colors[Math.floor(Math.random() * colors.length)];
      this.vx = (Math.random() - 0.5) * 0.5;
      this.vy = (Math.random() - 0.5) * 0.5;
    }
    update() {
      this.x += this.vx;
      this.y += this.vy;
      if (mouse.x !== null && mouse.y !== null) {
        const dx = mouse.x - this.x;
        const dy = mouse.y - this.y;
        const distance = Math.sqrt(dx * dx + dy * dy);
        if (distance < mouse.radius && distance > 0) {
          const force = (mouse.radius - distance) / mouse.radius;
          this.x += dx / distance * force * this.density * 0.5;
          this.y += dy / distance * force * this.density * 0.5;
        }
      }
      if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) {
        this.reset();
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
      }
    }
    draw() {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fillStyle = this.color;
      ctx.shadowBlur = 10;
      ctx.shadowColor = this.color;
      ctx.fill();
    }
  }
  const particles = Array.from({ length: 300 }, () => new Particle());
  canvas.addEventListener("click", () => {
    particles.forEach((p) => {
      p.x += (Math.random() - 0.5) * 300;
      p.y += (Math.random() - 0.5) * 300;
    });
  });
  function animate() {
    ctx.shadowBlur = 0;
    ctx.globalCompositeOperation = "destination-out";
    ctx.fillStyle = "rgba(0, 0, 0, 0.2)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.globalCompositeOperation = "source-over";
    particles.forEach((p) => {
      p.update();
      p.draw();
    });
    requestAnimationFrame(animate);
  }
  animate();
}
document.addEventListener("DOMContentLoaded", initMatrixCanvas);
document.addEventListener("DOMContentLoaded", () => {
  const burger = document.querySelector("#theme-navbar-toggler");
  const popover = document.getElementById("navmenu-header-mobile");
  burger.addEventListener("click", () => {
    burger.classList.toggle("open");
  });
  popover.addEventListener("toggle", (event) => {
    if (event.newState === "closed") {
      burger.classList.remove("open");
    }
  });
  popover.addEventListener("click", (e) => {
    if (e.target.closest("a")) {
      popover.hidePopover();
    }
  });
  document.addEventListener("mouseover", function(a) {
    const o = a.target.closest(".button-background-animation");
    if (o) {
      const c = o.querySelector(".hover-bg");
      if (c) {
        const v = o.getBoundingClientRect(), h = a.clientX - v.left, s = a.clientY - v.top;
        c.style.setProperty("--creative-hover-top", `${s}px`), c.style.setProperty("--creative-hover-left", `${h}px`);
      }
    }
    const sliderFeaturedPosts = document.querySelector("[data-slider-featured-posts]");
    if (sliderFeaturedPosts) {
      new SliderPrevNextDesktopFeaturedPosts(sliderFeaturedPosts);
    }
    const sliderRelatedPosts = document.querySelector("[data-slider-related-posts]");
    if (sliderRelatedPosts && Number(sliderRelatedPosts.dataset.count) >= 3) {
      new SliderPrevNextDesktopRelatedPosts(sliderRelatedPosts);
    }
    document.querySelectorAll("[data-slider-gallery]").forEach((el) => {
      new SliderPrevNextGallery(el);
    });
    const sliderRelatedProjects = document.querySelector("[data-slider-related-projects]");
    if (sliderRelatedProjects && Number(sliderRelatedProjects.dataset.count) >= 3) {
      new SliderPrevNextDesktopRelatedProjects(sliderRelatedProjects);
    }
  });
  const cursorFollowItem = document.querySelector(".animation-moving-item");
  const sectionLight = document.querySelectorAll(".section-light");
  if (sectionLight && cursorFollowItem && sectionLight.length > 0) {
    sectionLight.forEach((section) => {
      section.addEventListener("mouseenter", () => {
        if (document.body.classList.contains("dark-theme")) {
          cursorFollowItem.classList.add("animation-moving-item--cursor-follow");
        }
      });
      section.addEventListener("mousemove", (e) => {
        if (document.body.classList.contains("dark-theme")) {
          document.documentElement.style.setProperty("--mouse-x", `${e.clientX}px`);
          document.documentElement.style.setProperty("--mouse-y", `${e.clientY}px`);
        }
      });
      section.addEventListener("mouseleave", () => {
        cursorFollowItem.classList.remove("animation-moving-item--cursor-follow");
      });
    });
    const themeObserver = new MutationObserver(() => {
      if (!document.body.classList.contains("dark-theme")) {
        cursorFollowItem.classList.remove("animation-moving-item--cursor-follow");
      }
    });
    themeObserver.observe(document.body, { attributes: true, attributeFilter: ["class"] });
  }
  const gradientContainer = document.querySelector(".gradient-container");
  const interactiveItem = document.querySelector(".gradient-container .interactive");
  if (gradientContainer && interactiveItem) {
    gradientContainer.addEventListener("mouseenter", () => {
      interactiveItem.classList.add("interactive--cursor-follow");
    });
    gradientContainer.addEventListener("mousemove", (e) => {
      document.documentElement.style.setProperty("--mouse-x", `${e.clientX}px`);
      document.documentElement.style.setProperty("--mouse-y", `${e.clientY}px`);
    });
    gradientContainer.addEventListener("mouseleave", () => {
      interactiveItem.classList.remove("interactive--cursor-follow");
    });
  }
  const scrollers2 = document.querySelectorAll(".scroller");
  if (scrollers2.length > 0) {
    addInfiniteScroll2();
  }
  function addInfiniteScroll2() {
    scrollers2.forEach((scroller) => {
      scroller.setAttribute("data-infinite-scroll", "true");
      const scrollerInner = scroller.querySelector(".scroller-inner");
      const scrollerContent = Array.from(scrollerInner.children);
      scroller.dataset.originalCount = String(scrollerContent.length);
      const baseItems = 5;
      const baseSeconds = 30;
      const count = scrollerContent.length;
      const durationSeconds = count / baseItems * baseSeconds;
      const minSeconds = 12;
      const maxSeconds = 120;
      const finalSeconds = Math.min(maxSeconds, Math.max(minSeconds, durationSeconds));
      scroller.style.setProperty("--scroll-duration", `${finalSeconds}s`);
      setScrollDistance2(scroller);
      scrollerContent.forEach((child) => {
        let duplicatedChild = child.cloneNode(true);
        duplicatedChild.setAttribute("aria-hidden", "true");
        scrollerInner.appendChild(duplicatedChild);
      });
      scrollerContent.forEach((child) => {
        let duplicatedChild = child.cloneNode(true);
        duplicatedChild.setAttribute("aria-hidden", "true");
        scrollerInner.appendChild(duplicatedChild);
      });
    });
  }
  function setScrollDistance2(scroller) {
    const scrollerInner = scroller.querySelector(".scroller-inner");
    const originalCount = Number(scroller.dataset.originalCount || 0);
    if (originalCount === 0) {
      return;
    }
    const children = Array.from(scrollerInner.children).slice(0, originalCount);
    const originalWidth = children.reduce((total, child) => {
      return total + child.getBoundingClientRect().width;
    }, 0);
    if (originalWidth > 0) {
      scroller.style.setProperty("--scroll-distance", `${originalWidth}px`);
    }
  }
  window.addEventListener("load", () => {
    scrollers2.forEach((scroller) => {
      setScrollDistance2(scroller);
    });
  });
  let scrollTop = document.querySelector(".scroll-top");
  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add("active") : scrollTop.classList.remove("active");
    }
  }
  scrollTop.addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
  window.addEventListener("load", toggleScrollTop);
  document.addEventListener("scroll", toggleScrollTop);
});
function scrollDetailsIntoView(details) {
  requestAnimationFrame(() => {
    details.scrollIntoView({ behavior: "smooth", block: "start" });
  });
}
function bindMobileScrollForDetails(selector) {
  const detailsEls = document.querySelectorAll(selector);
  if (!detailsEls.length)
    return;
  detailsEls.forEach((details) => {
    details.addEventListener("toggle", () => {
      if (!details.open)
        return;
      scrollDetailsIntoView(details);
    });
  });
}
document.addEventListener("DOMContentLoaded", () => {
  bindMobileScrollForDetails('details.dropdown-details[id^="faq-details-"]');
});
class SliderPrevNextGallery {
  constructor(el) {
    this.nextButton = el.querySelector("[data-slider-next-gallery]");
    this.prevButton = el.querySelector("[data-slider-prev-gallery]");
    this.wrapper = el.querySelector("[data-slider-wrapper-gallery]");
    if (!this.nextButton || !this.prevButton || !this.wrapper)
      return;
    this.nextButton.addEventListener("click", () => this.move(1));
    this.prevButton.addEventListener("click", () => this.move(-1));
    this.updateUi();
    this.wrapper.addEventListener("scroll", () => {
      this.updateUi();
    });
  }
  get itemToScroll() {
    return parseInt(window.getComputedStyle(this.wrapper).getPropertyValue("--items"), 10);
  }
  updateUi() {
    const scrollLeft = this.wrapper.scrollLeft;
    const scrollWidth = this.wrapper.scrollWidth;
    const offsetWidth = this.wrapper.offsetWidth;
    if (scrollLeft <= 1) {
      this.prevButton.setAttribute("hidden", "hidden");
    } else {
      this.prevButton.removeAttribute("hidden");
    }
    if (scrollLeft + offsetWidth >= scrollWidth - 1) {
      this.nextButton.setAttribute("hidden", "hidden");
    } else {
      this.nextButton.removeAttribute("hidden");
    }
  }
  move(n) {
    const itemToScroll = this.itemToScroll;
    const currentScrollLeft = this.wrapper.scrollLeft;
    const offsetWidth = this.wrapper.offsetWidth;
    const scrollWidth = this.wrapper.scrollWidth;
    const children = Array.from(this.wrapper.children || []);
    let currentIndex = 0;
    const isAtEnd = currentScrollLeft + offsetWidth >= scrollWidth - 1;
    if (isAtEnd) {
      const lastAlignedGroupStart = Math.floor((children.length - 1) / itemToScroll) * itemToScroll;
      const lastPossibleGroupStart = Math.max(0, children.length - itemToScroll);
      currentIndex = Math.min(lastAlignedGroupStart, lastPossibleGroupStart);
    } else {
      let firstVisibleIndex = 0;
      for (let i = 0; i < children.length; i++) {
        if (children[i].offsetLeft >= currentScrollLeft) {
          firstVisibleIndex = i;
          break;
        }
      }
      currentIndex = Math.floor(firstVisibleIndex / itemToScroll) * itemToScroll;
    }
    let targetIndex = currentIndex + n * itemToScroll;
    let scrollPosition;
    if (targetIndex < 0) {
      scrollPosition = 0;
    } else if (targetIndex >= this.wrapper.children.length) {
      const lastIndex = this.wrapper.children.length - itemToScroll;
      scrollPosition = this.wrapper.children[lastIndex].offsetLeft;
    } else {
      scrollPosition = this.wrapper.children[targetIndex].offsetLeft;
    }
    this.wrapper.scrollTo({
      left: scrollPosition,
      behavior: "smooth"
    });
  }
}
class SliderPrevNextDesktopFeaturedPosts {
  constructor(el) {
    this.nextButton = el.querySelector("[data-slider-next-featured-posts]");
    this.prevButton = el.querySelector("[data-slider-prev-featured-posts]");
    this.wrapper = el.querySelector("[data-slider-wrapper-featured-posts]");
    this.nextButton.addEventListener("click", () => this.move(1));
    this.prevButton.addEventListener("click", () => this.move(-1));
    this.updateUi();
    this.wrapper.addEventListener("scroll", () => {
      this.updateUi();
    });
  }
  get itemToScroll() {
    return parseInt(window.getComputedStyle(this.wrapper).getPropertyValue("--items"), 10);
  }
  updateUi() {
    const scrollLeft = this.wrapper.scrollLeft;
    const scrollWidth = this.wrapper.scrollWidth;
    const offsetWidth = this.wrapper.offsetWidth;
    if (scrollLeft <= 1) {
      this.prevButton.setAttribute("hidden", "hidden");
    } else {
      this.prevButton.removeAttribute("hidden");
    }
    if (scrollLeft + offsetWidth >= scrollWidth - 1) {
      this.nextButton.setAttribute("hidden", "hidden");
    } else {
      this.nextButton.removeAttribute("hidden");
    }
  }
  move(n) {
    const itemToScroll = this.itemToScroll;
    const currentScrollLeft = this.wrapper.scrollLeft;
    const offsetWidth = this.wrapper.offsetWidth;
    const scrollWidth = this.wrapper.scrollWidth;
    const children = Array.from(this.wrapper.children || []);
    let currentIndex = 0;
    const isAtEnd = currentScrollLeft + offsetWidth >= scrollWidth - 1;
    if (isAtEnd) {
      const lastAlignedGroupStart = Math.floor((children.length - 1) / itemToScroll) * itemToScroll;
      const lastPossibleGroupStart = Math.max(0, children.length - itemToScroll);
      currentIndex = Math.min(lastAlignedGroupStart, lastPossibleGroupStart);
    } else {
      let firstVisibleIndex = 0;
      for (let i = 0; i < children.length; i++) {
        if (children[i].offsetLeft >= currentScrollLeft) {
          firstVisibleIndex = i;
          break;
        }
      }
      currentIndex = Math.floor(firstVisibleIndex / itemToScroll) * itemToScroll;
    }
    let targetIndex = currentIndex + n * itemToScroll;
    let scrollPosition;
    if (targetIndex < 0) {
      scrollPosition = 0;
    } else if (targetIndex >= this.wrapper.children.length) {
      const lastIndex = this.wrapper.children.length - itemToScroll;
      scrollPosition = this.wrapper.children[lastIndex].offsetLeft;
    } else {
      scrollPosition = this.wrapper.children[targetIndex].offsetLeft;
    }
    this.wrapper.scrollTo({
      left: scrollPosition,
      behavior: "smooth"
    });
  }
}
class SliderPrevNextDesktopRelatedProjects {
  constructor(el) {
    this.nextButton = el.querySelector("[data-slider-next-related-projects]");
    this.prevButton = el.querySelector("[data-slider-prev-related-projects]");
    this.wrapper = el.querySelector("[data-slider-wrapper-related-projects]");
    this.nextButton.addEventListener("click", () => this.move(1));
    this.prevButton.addEventListener("click", () => this.move(-1));
    this.updateUi();
    this.wrapper.addEventListener("scroll", () => {
      this.updateUi();
    });
  }
  get itemToScroll() {
    return parseInt(window.getComputedStyle(this.wrapper).getPropertyValue("--items"), 10);
  }
  updateUi() {
    const scrollLeft = this.wrapper.scrollLeft;
    const scrollWidth = this.wrapper.scrollWidth;
    const offsetWidth = this.wrapper.offsetWidth;
    if (scrollLeft <= 1) {
      this.prevButton.setAttribute("hidden", "hidden");
    } else {
      this.prevButton.removeAttribute("hidden");
    }
    if (scrollLeft + offsetWidth >= scrollWidth - 1) {
      this.nextButton.setAttribute("hidden", "hidden");
    } else {
      this.nextButton.removeAttribute("hidden");
    }
  }
  move(n) {
    const itemToScroll = this.itemToScroll;
    const currentScrollLeft = this.wrapper.scrollLeft;
    const offsetWidth = this.wrapper.offsetWidth;
    const scrollWidth = this.wrapper.scrollWidth;
    const children = Array.from(this.wrapper.children || []);
    let currentIndex = 0;
    const isAtEnd = currentScrollLeft + offsetWidth >= scrollWidth - 1;
    if (isAtEnd) {
      const lastAlignedGroupStart = Math.floor((children.length - 1) / itemToScroll) * itemToScroll;
      const lastPossibleGroupStart = Math.max(0, children.length - itemToScroll);
      currentIndex = Math.min(lastAlignedGroupStart, lastPossibleGroupStart);
    } else {
      let firstVisibleIndex = 0;
      for (let i = 0; i < children.length; i++) {
        if (children[i].offsetLeft >= currentScrollLeft) {
          firstVisibleIndex = i;
          break;
        }
      }
      currentIndex = Math.floor(firstVisibleIndex / itemToScroll) * itemToScroll;
    }
    let targetIndex = currentIndex + n * itemToScroll;
    let scrollPosition;
    if (targetIndex < 0) {
      scrollPosition = 0;
    } else if (targetIndex >= this.wrapper.children.length) {
      const lastIndex = this.wrapper.children.length - itemToScroll;
      scrollPosition = this.wrapper.children[lastIndex].offsetLeft;
    } else {
      scrollPosition = this.wrapper.children[targetIndex].offsetLeft;
    }
    this.wrapper.scrollTo({
      left: scrollPosition,
      behavior: "smooth"
    });
  }
}
class SliderPrevNextDesktopRelatedPosts {
  constructor(el) {
    this.nextButton = el.querySelector("[data-slider-next-related-posts]");
    this.prevButton = el.querySelector("[data-slider-prev-related-posts]");
    this.wrapper = el.querySelector("[data-slider-wrapper-related-posts]");
    this.nextButton.addEventListener("click", () => this.move(1));
    this.prevButton.addEventListener("click", () => this.move(-1));
    this.updateUi();
    this.wrapper.addEventListener("scroll", () => {
      this.updateUi();
    });
  }
  get itemToScroll() {
    return parseInt(window.getComputedStyle(this.wrapper).getPropertyValue("--items"), 10);
  }
  updateUi() {
    const scrollLeft = this.wrapper.scrollLeft;
    const scrollWidth = this.wrapper.scrollWidth;
    const offsetWidth = this.wrapper.offsetWidth;
    if (scrollLeft <= 1) {
      this.prevButton.setAttribute("hidden", "hidden");
    } else {
      this.prevButton.removeAttribute("hidden");
    }
    if (scrollLeft + offsetWidth >= scrollWidth - 1) {
      this.nextButton.setAttribute("hidden", "hidden");
    } else {
      this.nextButton.removeAttribute("hidden");
    }
  }
  move(n) {
    const itemToScroll = this.itemToScroll;
    const currentScrollLeft = this.wrapper.scrollLeft;
    const offsetWidth = this.wrapper.offsetWidth;
    const scrollWidth = this.wrapper.scrollWidth;
    const children = Array.from(this.wrapper.children || []);
    let currentIndex = 0;
    const isAtEnd = currentScrollLeft + offsetWidth >= scrollWidth - 1;
    if (isAtEnd) {
      const lastAlignedGroupStart = Math.floor((children.length - 1) / itemToScroll) * itemToScroll;
      const lastPossibleGroupStart = Math.max(0, children.length - itemToScroll);
      currentIndex = Math.min(lastAlignedGroupStart, lastPossibleGroupStart);
    } else {
      let firstVisibleIndex = 0;
      for (let i = 0; i < children.length; i++) {
        if (children[i].offsetLeft >= currentScrollLeft) {
          firstVisibleIndex = i;
          break;
        }
      }
      currentIndex = Math.floor(firstVisibleIndex / itemToScroll) * itemToScroll;
    }
    let targetIndex = currentIndex + n * itemToScroll;
    let scrollPosition;
    if (targetIndex < 0) {
      scrollPosition = 0;
    } else if (targetIndex >= this.wrapper.children.length) {
      const lastIndex = this.wrapper.children.length - itemToScroll;
      scrollPosition = this.wrapper.children[lastIndex].offsetLeft;
    } else {
      scrollPosition = this.wrapper.children[targetIndex].offsetLeft;
    }
    this.wrapper.scrollTo({
      left: scrollPosition,
      behavior: "smooth"
    });
  }
}
const scrollers = document.querySelectorAll(".scroller-logos");
if (scrollers.length > 0) {
  addInfiniteScroll();
}
function addInfiniteScroll() {
  scrollers.forEach((scroller) => {
    scroller.setAttribute("data-infinite-scroll", "true");
    const scrollerInner = scroller.querySelector(".scroller-inner");
    const scrollerContent = Array.from(scrollerInner.children);
    scroller.dataset.originalCount = String(scrollerContent.length);
    const baseItems = 5;
    const baseSeconds = 30;
    const count = scrollerContent.length;
    const durationSeconds = count / baseItems * baseSeconds;
    const minSeconds = 12;
    const maxSeconds = 120;
    const finalSeconds = Math.min(maxSeconds, Math.max(minSeconds, durationSeconds));
    scroller.style.setProperty("--scroll-duration", `${finalSeconds}s`);
    setScrollDistance(scroller);
    scrollerContent.forEach((child) => {
      let duplicatedChild = child.cloneNode(true);
      duplicatedChild.setAttribute("aria-hidden", "true");
      scrollerInner.appendChild(duplicatedChild);
    });
    scrollerContent.forEach((child) => {
      let duplicatedChild = child.cloneNode(true);
      duplicatedChild.setAttribute("aria-hidden", "true");
      scrollerInner.appendChild(duplicatedChild);
    });
  });
}
function setScrollDistance(scroller) {
  const scrollerInner = scroller.querySelector(".scroller-inner");
  const originalCount = Number(scroller.dataset.originalCount || 0);
  if (originalCount === 0) {
    return;
  }
  const children = Array.from(scrollerInner.children).slice(0, originalCount);
  const originalWidth = children.reduce((total, child) => {
    return total + child.getBoundingClientRect().width;
  }, 0);
  if (originalWidth > 0) {
    scroller.style.setProperty("--scroll-distance", `${originalWidth}px`);
  }
}
window.addEventListener("load", () => {
  scrollers.forEach((scroller) => {
    setScrollDistance(scroller);
  });
});
//# sourceMappingURL=main.js.map
