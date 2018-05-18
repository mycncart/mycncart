/**
* jQuery wizard
* jquery wizard is a lightweight jquery plugin for creating step-by-step wizards.
* Compiled: Fri Sep 02 2016 11:59:56 GMT+0800 (CST)
* @version v0.3.1
* @link https://github.com/amazingSurge/jquery-wizard
* @copyright LGPL-3.0
*/
(function(global, factory) {
  if (typeof define === "function" && define.amd) {
    define(['exports', 'jQuery'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jQuery'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery);
    global.jqueryWizard = mod.exports;
  }
})(this,

  function(exports, _jQuery) {
    'use strict';

    Object.defineProperty(exports, "__esModule", {
      value: true
    });

    var _jQuery2 = _interopRequireDefault(_jQuery);

    function _interopRequireDefault(obj) {
      return obj && obj.__esModule ? obj : {
        default: obj
      };
    }

    function _toConsumableArray(arr) {
      if (Array.isArray(arr)) {

        for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) {
          arr2[i] = arr[i];
        }

        return arr2;
      } else {

        return Array.from(arr);
      }
    }

    var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ?

      function(obj) {
        return typeof obj;
      }
      :

      function(obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol ? "symbol" : typeof obj;
      };

    function _classCallCheck(instance, Constructor) {
      if (!(instance instanceof Constructor)) {
        throw new TypeError("Cannot call a class as a function");
      }
    }

    var _createClass = function() {
      function defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
          var descriptor = props[i];
          descriptor.enumerable = descriptor.enumerable || false;
          descriptor.configurable = true;

          if ("value" in descriptor)
            descriptor.writable = true;
          Object.defineProperty(target, descriptor.key, descriptor);
        }
      }

      return function(Constructor, protoProps, staticProps) {
        if (protoProps)
          defineProperties(Constructor.prototype, protoProps);

        if (staticProps)
          defineProperties(Constructor, staticProps);

        return Constructor;
      };
    }();

    var defaults = {
      step: '.wizard-steps > li',

      getPane: function getPane(index, step) {
        return this.$element.find('.wizard-content').children().eq(index);
      },


      buttonsAppendTo: 'this',
      templates: {
        buttons: function buttons() {
          var options = this.options;

          return '<div class="wizard-buttons"><a class="wizard-back" href="#' + this.id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a><a class="wizard-next" href="#' + this.id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a><a class="wizard-finish" href="#' + this.id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a></div>';
        }
      },

      classes: {
        step: {
          done: 'done',
          error: 'error',
          active: 'current',
          disabled: 'disabled',
          activing: 'activing',
          loading: 'loading'
        },

        pane: {
          active: 'active',
          activing: 'activing'
        },

        button: {
          hide: 'hide',
          disabled: 'disabled'
        }
      },

      autoFocus: true,
      keyboard: true,

      enableWhenVisited: false,

      buttonLabels: {
        next: 'Next',
        back: 'Back',
        finish: 'Finish'
      },

      loading: {
        show: function show(step) {},
        hide: function hide(step) {},
        fail: function fail(step) {}
      },

      cacheContent: false,

      validator: function validator(step) {
        return true;
      },


      onInit: null,
      onNext: null,
      onBack: null,
      onReset: null,

      onBeforeShow: null,
      onAfterShow: null,
      onBeforeHide: null,
      onAfterHide: null,
      onBeforeLoad: null,
      onAfterLoad: null,

      onBeforeChange: null,
      onAfterChange: null,

      onStateChange: null,

      onFinish: null
    };

    var Support = function() {
      var events = {
          transition: {
            end: {
              WebkitTransition: 'webkitTransitionEnd',
              MozTransition: 'transitionend',
              OTransition: 'oTransitionEnd',
              transition: 'transitionend'
            }
          }
        },
        prefixes = ['webkit', 'Moz', 'O', 'ms'],
        style = (0, _jQuery2.default)('<support>').get(0).style,
        tests = {
          csstransitions: function csstransitions() {
            return Boolean(test('transition'));
          }
        };

      function test(property, prefixed) {
        var result = false;
        var upper = property.charAt(0).toUpperCase() + property.slice(1);

        if (style[property] !== undefined) {
          result = property;
        }

        if (!result) {
          _jQuery2.default.each(prefixes,

            function(i, prefix) {
              if (style[prefix + upper] !== undefined) {
                result = '-' + prefix.toLowerCase() + '-' + upper;

                return false;
              }
            }
          );
        }

        if (prefixed) {

          return result;
        }

        if (result) {

          return true;
        }

        return false;
      }

      function prefixed(property) {
        return test(property, true);
      }

      var support = {};

      if (tests.csstransitions()) {
        /* jshint -W053 */
        support.transition = new String(prefixed('transition'));
        support.transition.end = events.transition.end[support.transition];
      }

      return support;
    }();

    var emulateTransitionEnd = function emulateTransitionEnd($el, duration) {
      var called = false;

      $el.one(Support.transition.end,

        function() {
          called = true;
        }
      );
      var callback = function callback() {
        if (!called) {
          $el.trigger(Support.transition.end);
        }
      };
      setTimeout(callback, duration);
    };

    var Step = function() {
      function Step(element, wizard, index) {
        _classCallCheck(this, Step);

        this.TRANSITION_DURATION = 200;

        this.initialize(element, wizard, index);
      }

      _createClass(Step, [{
        key: 'initialize',
        value: function initialize(element, wizard, index) {
          this.$element = $(element);
          this.wizard = wizard;

          this.events = {};
          this.loader = null;
          this.loaded = false;

          this.validator = this.wizard.options.validator;

          this.states = {
            done: false,
            error: false,
            active: false,
            disabled: false,
            activing: false
          };

          this.index = index;
          this.$element.data('wizard-index', index);

          this.$pane = this.getPaneFromTarget();

          if (!this.$pane) {
            this.$pane = this.wizard.options.getPane.call(this.wizard, index, element);
          }

          this.setValidatorFromData();
          this.setLoaderFromData();
        }
      }, {
        key: 'getPaneFromTarget',
        value: function getPaneFromTarget() {
          var selector = this.$element.data('target');

          if (!selector) {
            selector = this.$element.attr('href');
            selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '');
          }

          if (selector) {

            return $(selector);
          } else {

            return null;
          }
        }
      }, {
        key: 'setup',
        value: function setup() {
          var current = this.wizard.currentIndex();

          if (this.index === current) {
            this.enter('active');

            if (this.loader) {
              this.load();
            }
          } else if (this.index > current) {
            this.enter('disabled');
          }

          this.$element.attr('aria-expanded', this.is('active'));
          this.$pane.attr('aria-expanded', this.is('active'));

          var classes = this.wizard.options.classes;

          if (this.is('active')) {
            this.$pane.addClass(classes.pane.active);
          } else {
            this.$pane.removeClass(classes.pane.active);
          }
        }
      }, {
        key: 'show',
        value: function show(callback) {
          if (this.is('activing') || this.is('active')) {

            return;
          }

          this.trigger('beforeShow');
          this.enter('activing');

          var classes = this.wizard.options.classes;

          this.$element.attr('aria-expanded', true);

          this.$pane.addClass(classes.pane.activing).addClass(classes.pane.active).attr('aria-expanded', true);

          var complete = function complete() {
            this.$pane.removeClass(classes.pane.activing);

            this.leave('activing');
            this.enter('active');
            this.trigger('afterShow');

            if ($.isFunction(callback)) {
              callback.call(this);
            }
          };

          if (!Support.transition) {

            return complete.call(this);
          }

          this.$pane.one(Support.transition.end, $.proxy(complete, this));

          emulateTransitionEnd(this.$pane, this.TRANSITION_DURATION);
        }
      }, {
        key: 'hide',
        value: function hide(callback) {
          if (this.is('activing') || !this.is('active')) {

            return;
          }

          this.trigger('beforeHide');
          this.enter('activing');

          var classes = this.wizard.options.classes;

          this.$element.attr('aria-expanded', false);

          this.$pane.addClass(classes.pane.activing).removeClass(classes.pane.active).attr('aria-expanded', false);

          var complete = function complete() {
            this.$pane.removeClass(classes.pane.activing);

            this.leave('activing');
            this.leave('active');
            this.trigger('afterHide');

            if ($.isFunction(callback)) {
              callback.call(this);
            }
          };

          if (!Support.transition) {

            return complete.call(this);
          }

          this.$pane.one(Support.transition.end, $.proxy(complete, this));

          emulateTransitionEnd(this.$pane, this.TRANSITION_DURATION);
        }
      }, {
        key: 'empty',
        value: function empty() {
          this.$pane.empty();
        }
      }, {
        key: 'load',
        value: function load(callback) {
          var self = this;
          var loader = this.loader;

          if ($.isFunction(loader)) {
            loader = loader.call(this.wizard, this);
          }

          if (this.wizard.options.cacheContent && this.loaded) {

            if ($.isFunction(callback)) {
              callback.call(this);
            }

            return true;
          }

          this.trigger('beforeLoad');
          this.enter('loading');

          function setContent(content) {
            self.$pane.html(content);

            self.leave('loading');
            self.loaded = true;
            self.trigger('afterLoad');

            if ($.isFunction(callback)) {
              callback.call(self);
            }
          }

          if (typeof loader === 'string') {
            setContent(loader);
          } else if ((typeof loader === 'undefined' ? 'undefined' : _typeof(loader)) === 'object' && loader.hasOwnProperty('url')) {
            self.wizard.options.loading.show.call(self.wizard, self);

            $.ajax(loader.url, loader.settings || {}).done(

              function(data) {
                setContent(data);

                self.wizard.options.loading.hide.call(self.wizard, self);
              }
            ).fail(

              function() {
                self.wizard.options.loading.fail.call(self.wizard, self);
              }
            );
          } else {
            setContent('');
          }
        }
      }, {
        key: 'trigger',
        value: function trigger(event) {
          var _wizard;

          for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
            args[_key - 1] = arguments[_key];
          }

          if ($.isArray(this.events[event])) {

            for (var i in this.events[event]) {

              if ({}.hasOwnProperty.call(this.events[event], i)) {
                var _events$event;

                (_events$event = this.events[event])[i].apply(_events$event, args);
              }
            }
          }

          (_wizard = this.wizard).trigger.apply(_wizard, _toConsumableArray([event, this].concat(args)));
        }
      }, {
        key: 'enter',
        value: function enter(state) {
          this.states[state] = true;

          var classes = this.wizard.options.classes;
          this.$element.addClass(classes.step[state]);

          this.trigger('stateChange', true, state);
        }
      }, {
        key: 'leave',
        value: function leave(state) {
          if (this.states[state]) {
            this.states[state] = false;

            var classes = this.wizard.options.classes;
            this.$element.removeClass(classes.step[state]);

            this.trigger('stateChange', false, state);
          }
        }
      }, {
        key: 'setValidatorFromData',
        value: function setValidatorFromData() {
          var validator = this.$pane.data('validator');

          if (validator && $.isFunction(window[validator])) {
            this.validator = window[validator];
          }
        }
      }, {
        key: 'setLoaderFromData',
        value: function setLoaderFromData() {
          var loader = this.$pane.data('loader');

          if (loader) {

            if ($.isFunction(window[loader])) {
              this.loader = window[loader];
            }
          } else {
            var url = this.$pane.data('loader-url');

            if (url) {
              this.loader = {
                url: url,
                settings: this.$pane.data('settings') || {}
              };
            }
          }
        }
      }, {
        key: 'active',
        value: function active() {
          return this.wizard.goTo(this.index);
        }
      }, {
        key: 'on',
        value: function on(event, handler) {
          if ($.isFunction(handler)) {

            if ($.isArray(this.events[event])) {
              this.events[event].push(handler);
            } else {
              this.events[event] = [handler];
            }
          }

          return this;
        }
      }, {
        key: 'off',
        value: function off(event, handler) {
          if ($.isFunction(handler) && $.isArray(this.events[event])) {
            $.each(this.events[event],

              function(i, f) {
                if (f === handler) {
                  delete this.events[event][i];

                  return false;
                }
              }
            );
          }

          return this;
        }
      }, {
        key: 'is',
        value: function is(state) {
          return this.states[state] && this.states[state] === true;
        }
      }, {
        key: 'reset',
        value: function reset() {
          for (var state in this.states) {

            if ({}.hasOwnProperty.call(this.states, state)) {
              this.leave(state);
            }
          }
          this.setup();

          return this;
        }
      }, {
        key: 'setLoader',
        value: function setLoader(loader) {
          this.loader = loader;

          if (this.is('active')) {
            this.load();
          }

          return this;
        }
      }, {
        key: 'setValidator',
        value: function setValidator(validator) {
          if ($.isFunction(validator)) {
            this.validator = validator;
          }

          return this;
        }
      }, {
        key: 'validate',
        value: function validate() {
          return this.validator.call(this.$pane.get(0), this);
        }
      }]);

      return Step;
    }();

    var counter = 0;
    var NAME = 'wizard';

    var wizard = function() {
      function wizard(element, options) {
        _classCallCheck(this, wizard);

        this.$element = (0, _jQuery2.default)(element);

        this.options = _jQuery2.default.extend(true, {}, defaults, options);

        this.$steps = this.$element.find(this.options.step);

        this.id = this.$element.attr('id');

        if (!this.id) {
          this.id = 'wizard-' + ++counter;
          this.$element.attr('id', this.id);
        }

        this.initialize();
      }

      _createClass(wizard, [{
        key: 'initialize',
        value: function initialize() {
          this.steps = [];
          var self = this;

          this.$steps.each(

            function(index) {
              self.steps.push(new Step(this, self, index));
            }
          );

          this._current = 0;
          this.transitioning = null;

          _jQuery2.default.each(this.steps,

            function(i, step) {
              step.setup();
            }
          );

          this.setup();

          this.$element.on('click', this.options.step,

            function(e) {
              var index = (0, _jQuery2.default)(this).data('wizard-index');

              if (!self.get(index).is('disabled')) {
                self.goTo(index);
              }

              e.preventDefault();
              e.stopPropagation();
            }
          );

          if (this.options.keyboard) {
            (0, _jQuery2.default)(document).on('keyup', _jQuery2.default.proxy(this.keydown, this));
          }

          this.trigger('init');
        }
      }, {
        key: 'setup',
        value: function setup() {
          this.$buttons = (0, _jQuery2.default)(this.options.templates.buttons.call(this));

          this.updateButtons();

          var buttonsAppendTo = this.options.buttonsAppendTo;
          var $to = void 0;

          if (buttonsAppendTo === 'this') {
            $to = this.$element;
          } else if (_jQuery2.default.isFunction(buttonsAppendTo)) {
            $to = buttonsAppendTo.call(this);
          } else {
            $to = this.$element.find(buttonsAppendTo);
          }
          this.$buttons = this.$buttons.appendTo($to);
        }
      }, {
        key: 'updateButtons',
        value: function updateButtons() {
          var classes = this.options.classes.button;
          var $back = this.$buttons.find('[data-wizard="back"]');
          var $next = this.$buttons.find('[data-wizard="next"]');
          var $finish = this.$buttons.find('[data-wizard="finish"]');

          if (this._current === 0) {
            $back.addClass(classes.disabled);
          } else {
            $back.removeClass(classes.disabled);
          }

          if (this._current === this.lastIndex()) {
            $next.addClass(classes.hide);
            $finish.removeClass(classes.hide);
          } else {
            $next.removeClass(classes.hide);
            $finish.addClass(classes.hide);
          }
        }
      }, {
        key: 'updateSteps',
        value: function updateSteps() {
          var self = this;

          _jQuery2.default.each(this.steps,

            function(i, step) {
              if (i > self._current) {
                step.leave('error');
                step.leave('active');
                step.leave('done');

                if (!self.options.enableWhenVisited) {
                  step.enter('disabled');
                }
              }
            }
          );
        }
      }, {
        key: 'keydown',
        value: function keydown(e) {
          if (/input|textarea/i.test(e.target.tagName)) {

            return;
          }

          switch (e.which) {
            case 37:
              this.back();
              break;
            case 39:
              this.next();
              break;
            default:

              return;
          }

          e.preventDefault();
        }
      }, {
        key: 'trigger',
        value: function trigger(eventType) {
          for (var _len2 = arguments.length, args = Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
            args[_key2 - 1] = arguments[_key2];
          }

          var data = [this].concat(args);

          this.$element.trigger('wizard::' + eventType, data);

          // callback
          eventType = eventType.replace(/\b\w+\b/g,

            function(word) {
              return word.substring(0, 1).toUpperCase() + word.substring(1);
            }
          );

          var onFunction = 'on' + eventType;

          if (typeof this.options[onFunction] === 'function') {
            var _options;

            (_options = this.options)[onFunction].apply(_options, args);
          }
        }
      }, {
        key: 'get',
        value: function get(index) {
          if (typeof index === 'string' && index.substring(0, 1) === '#') {
            var id = index.substring(1);

            for (var i in this.steps) {

              if (this.steps[i].$pane.attr('id') === id) {

                return this.steps[i];
              }
            }
          }

          if (index < this.length() && this.steps[index]) {

            return this.steps[index];
          }

          return null;
        }
      }, {
        key: 'goTo',
        value: function goTo(index, callback) {
          if (index === this._current || this.transitioning === true) {

            return false;
          }

          var current = this.current();
          var to = this.get(index);

          if (index > this._current) {

            if (!current.validate()) {
              current.leave('done');
              current.enter('error');

              return -1;
            } else {
              current.leave('error');

              if (index > this._current) {
                current.enter('done');
              }
            }
          }

          var self = this;
          var process = function process() {
            self.trigger('beforeChange', current, to);
            self.transitioning = true;

            current.hide();
            to.show(

              function() {
                self._current = index;
                self.transitioning = false;
                this.leave('disabled');

                self.updateButtons();
                self.updateSteps();

                if (self.options.autoFocus) {
                  var $input = this.$pane.find(':input');

                  if ($input.length > 0) {
                    $input.eq(0).focus();
                  } else {
                    this.$pane.focus();
                  }
                }

                if (_jQuery2.default.isFunction(callback)) {
                  callback.call(self);
                }

                self.trigger('afterChange', current, to);
              }
            );
          };

          if (to.loader) {
            to.load(

              function() {
                process();
              }
            );
          } else {
            process();
          }

          return true;
        }
      }, {
        key: 'length',
        value: function length() {
          return this.steps.length;
        }
      }, {
        key: 'current',
        value: function current() {
          return this.get(this._current);
        }
      }, {
        key: 'currentIndex',
        value: function currentIndex() {
          return this._current;
        }
      }, {
        key: 'lastIndex',
        value: function lastIndex() {
          return this.length() - 1;
        }
      }, {
        key: 'next',
        value: function next() {
          var _this = this;

          if (this._current < this.lastIndex()) {
            (function() {
              var from = _this._current,
                to = _this._current + 1;

              _this.goTo(to,

                function() {
                  this.trigger('next', this.get(from), this.get(to));
                }
              );
            })();
          }

          return false;
        }
      }, {
        key: 'back',
        value: function back() {
          var _this2 = this;

          if (this._current > 0) {
            (function() {
              var from = _this2._current,
                to = _this2._current - 1;

              _this2.goTo(to,

                function() {
                  this.trigger('back', this.get(from), this.get(to));
                }
              );
            })();
          }

          return false;
        }
      }, {
        key: 'first',
        value: function first() {
          return this.goTo(0);
        }
      }, {
        key: 'finish',
        value: function finish() {
          if (this._current === this.lastIndex()) {
            var current = this.current();

            if (current.validate()) {
              this.trigger('finish');
              current.leave('error');
              current.enter('done');
            } else {
              current.enter('error');
            }
          }
        }
      }, {
        key: 'reset',
        value: function reset() {
          this._current = 0;

          _jQuery2.default.each(this.steps,

            function(i, step) {
              step.reset();
            }
          );

          this.trigger('reset');
        }
      }], [{
        key: '_jQueryInterface',
        value: function _jQueryInterface(options) {
          var _this3 = this;

          for (var _len3 = arguments.length, args = Array(_len3 > 1 ? _len3 - 1 : 0), _key3 = 1; _key3 < _len3; _key3++) {
            args[_key3 - 1] = arguments[_key3];
          }

          if (typeof options === 'string') {
            var _ret3 = function() {
              var method = options;

              if (/^\_/.test(method)) {

                return {
                  v: false
                };
              } else if (/^(get)$/.test(method)) {
                var api = _this3.first().data('wizard');

                if (api && typeof api[method] === 'function') {

                  return {
                    v: api[method].apply(api, args)
                  };
                }
              } else {

                return {
                  v: _this3.each(

                    function() {
                      var api = _jQuery2.default.data(this, 'wizard');

                      if (api && typeof api[method] === 'function') {
                        api[method].apply(api, args);
                      }
                    }
                  )
                };
              }
            }();

            if ((typeof _ret3 === 'undefined' ? 'undefined' : _typeof(_ret3)) === "object")

              return _ret3.v;
          }

          return this.each(

            function() {
              if (!_jQuery2.default.data(this, 'wizard')) {
                _jQuery2.default.data(this, 'wizard', new wizard(this, options));
              }
            }
          );
        }
      }]);

      return wizard;
    }();

    (0, _jQuery2.default)(document).on('click', '[data-wizard]',

      function(e) {
        var href = void 0;
        var $this = (0, _jQuery2.default)(this);
        var $target = (0, _jQuery2.default)($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, ''));

        var wizard = $target.data('wizard');

        if (!wizard) {

          return;
        }

        var method = $this.data('wizard');

        if (/^(back|next|first|finish|reset)$/.test(method)) {
          wizard[method]();
        }

        e.preventDefault();
      }
    );

    _jQuery2.default.fn[NAME] = wizard._jQueryInterface;
    _jQuery2.default.fn[NAME].constructor = wizard;
    _jQuery2.default.fn[NAME].noConflict = function() {
      'use strict';

      _jQuery2.default.fn[NAME] = window.JQUERY_NO_CONFLICT;

      return wizard._jQueryInterface;
    }
    ;

    exports.default = wizard;
  }
);