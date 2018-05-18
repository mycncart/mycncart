/**
* jQuery wizard
* jquery wizard is a lightweight jquery plugin for creating step-by-step wizards.
* Compiled: Fri Sep 02 2016 11:59:56 GMT+0800 (CST)
* @version v0.3.1
* @link https://github.com/amazingSurge/jquery-wizard
* @copyright LGPL-3.0
*/
import $$1 from 'jQuery';

var defaults = {
  step: '.wizard-steps > li',

  getPane(index, step) {
    return this.$element.find('.wizard-content').children().eq(index);
  },

  buttonsAppendTo: 'this',
  templates: {
    buttons() {
      const options = this.options;
      return `<div class="wizard-buttons"><a class="wizard-back" href="#${this.id}" data-wizard="back" role="button">${options.buttonLabels.back}</a><a class="wizard-next" href="#${this.id}" data-wizard="next" role="button">${options.buttonLabels.next}</a><a class="wizard-finish" href="#${this.id}" data-wizard="finish" role="button">${options.buttonLabels.finish}</a></div>`;
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
    show(step) { },
    hide(step) { },
    fail(step) { }
  },

  cacheContent: false,

  validator(step) {
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

const Support = ((() => {
  const events = {
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
    style = $$1('<support>').get(0).style,
    tests = {
      csstransitions() {
        return Boolean(test('transition'));
      }
    };

  function test(property, prefixed) {
    let result = false;
    const upper = property.charAt(0).toUpperCase() + property.slice(1);

    if (style[property] !== undefined) {
      result = property;
    }
    if (!result) {
      $$1.each(prefixes, (i, prefix) => {
        if (style[prefix + upper] !== undefined) {
          result = `-${prefix.toLowerCase()}-${upper}`;
          return false;
        }
      });
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
  const support = {};
  if (tests.csstransitions()) {
    /* jshint -W053 */
    support.transition = new String(prefixed('transition'))
    support.transition.end = events.transition.end[support.transition];
  }

  return support;
}))();

var emulateTransitionEnd = ($el, duration) => {
  let called = false;

  $el.one(Support.transition.end, () => {
    called = true;
  });
  const callback = () => {
    if (!called) {
      $el.trigger(Support.transition.end);
    }
  };
  setTimeout(callback, duration);
};

class Step {
  constructor(element, wizard, index) {
    this.TRANSITION_DURATION = 200;

    this.initialize(element, wizard, index);
  }

  initialize(element, wizard, index) {

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

  getPaneFromTarget() {
    let selector = this.$element.data('target');

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

  setup() {
    const current = this.wizard.currentIndex();
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

    const classes = this.wizard.options.classes;
    if (this.is('active')) {
      this.$pane.addClass(classes.pane.active);
    } else {
      this.$pane.removeClass(classes.pane.active);
    }
  }

  show(callback) {
    if (this.is('activing') || this.is('active')) {
      return;
    }

    this.trigger('beforeShow');
    this.enter('activing');

    const classes = this.wizard.options.classes;

    this.$element
      .attr('aria-expanded', true);

    this.$pane
      .addClass(classes.pane.activing)
      .addClass(classes.pane.active)
      .attr('aria-expanded', true);

    const complete = function () {
      this.$pane
        .removeClass(classes.pane.activing)

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

  hide(callback) {
    if (this.is('activing') || !this.is('active')) {
      return;
    }

    this.trigger('beforeHide');
    this.enter('activing');

    const classes = this.wizard.options.classes;

    this.$element
      .attr('aria-expanded', false);

    this.$pane
      .addClass(classes.pane.activing)
      .removeClass(classes.pane.active)
      .attr('aria-expanded', false);

    const complete = function () {
      this.$pane
        .removeClass(classes.pane.activing);

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

  empty() {
    this.$pane.empty();
  }

  load(callback) {
    const self = this;
    let loader = this.loader;

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
    } else if (typeof loader === 'object' && loader.hasOwnProperty('url')) {
      self.wizard.options.loading.show.call(self.wizard, self);

      $.ajax(loader.url, loader.settings || {}).done(data => {
        setContent(data);

        self.wizard.options.loading.hide.call(self.wizard, self);
      }).fail(() => {
        self.wizard.options.loading.fail.call(self.wizard, self);
      });
    } else {
      setContent('');
    }
  }

  trigger(event, ...args) {

    if ($.isArray(this.events[event])) {
      for (const i in this.events[event]) {
        if ({}.hasOwnProperty.call(this.events[event], i)) {
          this.events[event][i](...args);
        }
      }
    }

    this.wizard.trigger(...[event, this].concat(args));
  }

  enter(state) {
    this.states[state] = true;

    const classes = this.wizard.options.classes;
    this.$element.addClass(classes.step[state]);

    this.trigger('stateChange', true, state);
  }

  leave(state) {
    if (this.states[state]) {
      this.states[state] = false;

      const classes = this.wizard.options.classes;
      this.$element.removeClass(classes.step[state]);

      this.trigger('stateChange', false, state);
    }
  }

  setValidatorFromData() {
    const validator = this.$pane.data('validator');
    if (validator && $.isFunction(window[validator])) {
      this.validator = window[validator];
    }
  }

  setLoaderFromData() {
    const loader = this.$pane.data('loader');

    if (loader) {
      if ($.isFunction(window[loader])) {
        this.loader = window[loader];
      }
    } else {
      const url = this.$pane.data('loader-url');
      if (url) {
        this.loader = {
          url,
          settings: this.$pane.data('settings') || {}
        }
      }
    }
  }

  /*
   * Public methods below
   */
  active() {
    return this.wizard.goTo(this.index);
  }

  on(event, handler) {
    if ($.isFunction(handler)) {
      if ($.isArray(this.events[event])) {
        this.events[event].push(handler);
      } else {
        this.events[event] = [handler];
      }
    }

    return this;
  }

  off(event, handler) {
    if ($.isFunction(handler) && $.isArray(this.events[event])) {
      $.each(this.events[event], function (i, f) {
        if (f === handler) {
          delete this.events[event][i];
          return false;
        }
      });
    }

    return this;
  }

  is(state) {
    return this.states[state] && this.states[state] === true;
  }

  reset() {
    for (const state in this.states) {
      if ({}.hasOwnProperty.call(this.states, state)) {
        this.leave(state);
      }
    }
    this.setup();

    return this;
  }

  setLoader(loader) {
    this.loader = loader;

    if (this.is('active')) {
      this.load();
    }

    return this;
  }

  setValidator(validator) {
    if ($.isFunction(validator)) {
      this.validator = validator;
    }

    return this;
  }

  validate() {
    return this.validator.call(this.$pane.get(0), this);
  }
}

let counter = 0;
const NAME = 'wizard';

class wizard {
  constructor(element, options) {
    this.$element = $$1(element);

    this.options = $$1.extend(true, {}, defaults, options);

    this.$steps = this.$element.find(this.options.step);

    this.id = this.$element.attr('id');
    if (!this.id) {
      this.id = `wizard-${++counter}`;
      this.$element.attr('id', this.id);
    }

    this.initialize();
  }

  initialize() {
    this.steps = [];
    const self = this;

    this.$steps.each(function (index) {
      self.steps.push(new Step(this, self, index));
    });

    this._current = 0;
    this.transitioning = null;

    $$1.each(this.steps, (i, step) => {
      step.setup();
    });

    this.setup();

    this.$element.on('click', this.options.step, function (e) {
      const index = $$1(this).data('wizard-index');

      if (!self.get(index).is('disabled')) {
        self.goTo(index);
      }

      e.preventDefault();
      e.stopPropagation();
    });

    if (this.options.keyboard) {
      $$1(document).on('keyup', $$1.proxy(this.keydown, this));
    }

    this.trigger('init');
  }

  setup() {
    this.$buttons = $$1(this.options.templates.buttons.call(this));

    this.updateButtons();

    const buttonsAppendTo = this.options.buttonsAppendTo;
    let $to;
    if (buttonsAppendTo === 'this') {
      $to = this.$element;
    } else if ($$1.isFunction(buttonsAppendTo)) {
      $to = buttonsAppendTo.call(this);
    } else {
      $to = this.$element.find(buttonsAppendTo);
    }
    this.$buttons = this.$buttons.appendTo($to);
  }

  updateButtons() {
    const classes = this.options.classes.button;
    const $back = this.$buttons.find('[data-wizard="back"]');
    const $next = this.$buttons.find('[data-wizard="next"]');
    const $finish = this.$buttons.find('[data-wizard="finish"]');

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

  updateSteps() {
    const self = this;

    $$1.each(this.steps, (i, step) => {

      if (i > self._current) {
        step.leave('error');
        step.leave('active');
        step.leave('done');

        if (!self.options.enableWhenVisited) {
          step.enter('disabled');
        }
      }
    });
  }

  keydown(e) {
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

  trigger(eventType, ...args) {
    const data = [this].concat(args);

    this.$element.trigger(`wizard::${eventType}`, data);

    // callback
    eventType = eventType.replace(/\b\w+\b/g, word => word.substring(0, 1).toUpperCase() + word.substring(1));

    const onFunction = `on${eventType}`;
    if (typeof this.options[onFunction] === 'function') {
      this.options[onFunction](...args);
    }
  }

  get(index) {
    if (typeof index === 'string' && index.substring(0, 1) === '#') {
      const id = index.substring(1);
      for (const i in this.steps) {
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

  goTo(index, callback) {
    if (index === this._current || this.transitioning === true) {
      return false;
    }

    const current = this.current();
    const to = this.get(index);

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

    const self = this;
    const process = () => {
      self.trigger('beforeChange', current, to);
      self.transitioning = true;

      current.hide();
      to.show(function () {
        self._current = index;
        self.transitioning = false;
        this.leave('disabled');

        self.updateButtons();
        self.updateSteps();

        if (self.options.autoFocus) {
          const $input = this.$pane.find(':input');
          if ($input.length > 0) {
            $input.eq(0).focus();
          } else {
            this.$pane.focus();
          }
        }

        if ($$1.isFunction(callback)) {
          callback.call(self);
        }

        self.trigger('afterChange', current, to);
      });
    };

    if (to.loader) {
      to.load(() => {
        process();
      });
    } else {
      process();
    }

    return true;
  }

  length() {
    return this.steps.length;
  }

  current() {
    return this.get(this._current);
  }

  currentIndex() {
    return this._current;
  }

  lastIndex() {
    return this.length() - 1;
  }

  next() {
    if (this._current < this.lastIndex()) {
      const from = this._current,
        to = this._current + 1;

      this.goTo(to, function () {
        this.trigger('next', this.get(from), this.get(to));
      });
    }

    return false;
  }

  back() {
    if (this._current > 0) {
      const from = this._current,
        to = this._current - 1;

      this.goTo(to, function () {
        this.trigger('back', this.get(from), this.get(to));
      });
    }

    return false;
  }

  first() {
    return this.goTo(0);
  }

  finish() {
    if (this._current === this.lastIndex()) {
      const current = this.current();
      if (current.validate()) {
        this.trigger('finish');
        current.leave('error');
        current.enter('done');
      } else {
        current.enter('error');
      }
    }
  }

  reset() {
    this._current = 0;

    $$1.each(this.steps, (i, step) => {
      step.reset();
    });

    this.trigger('reset');
  }

  static _jQueryInterface(options, ...args) {
    if (typeof options === 'string') {
      const method = options;
      if (/^\_/.test(method)) {
        return false;
      } else if ((/^(get)$/.test(method))) {
        const api = this.first().data('wizard');
        if (api && typeof api[method] === 'function') {
          return api[method](...args);
        }
      } else {
        return this.each(function () {
          const api = $$1.data(this, 'wizard');
          if (api && typeof api[method] === 'function') {
            api[method](...args);
          }
        });
      }
    }
    return this.each(function () {
      if (!$$1.data(this, 'wizard')) {
        $$1.data(this, 'wizard', new wizard(this, options));
      }
    });
  }
}

$$1(document).on('click', '[data-wizard]', function (e) {
  let href;
  const $this = $$1(this);
  const $target = $$1($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, ''));

  const wizard = $target.data('wizard');

  if (!wizard) {
    return;
  }

  const method = $this.data('wizard');

  if (/^(back|next|first|finish|reset)$/.test(method)) {
    wizard[method]();
  }

  e.preventDefault();
});

$$1.fn[NAME] = wizard._jQueryInterface;
$$1.fn[NAME].constructor = wizard;
$$1.fn[NAME].noConflict = () => {
  'use strict';
  $$1.fn[NAME] = window.JQUERY_NO_CONFLICT;
  return wizard._jQueryInterface;
};

export default wizard;