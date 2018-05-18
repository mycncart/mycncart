/*! jQuery wizard - v0.3.1 - 2015-05-07
 * https://github.com/amazingSurge/jquery-wizard
 * Copyright (c) 2015 amazingSurge; Licensed GPL */
import $ from 'jQuery';
import defaults from './defaults';
import Step from './step';

let counter = 0;
const NAME = 'wizard';

class wizard {
  constructor(element, options) {
    this.$element = $(element);

    this.options = $.extend(true, {}, defaults, options);

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

    $.each(this.steps, (i, step) => {
      step.setup();
    });

    this.setup();

    this.$element.on('click', this.options.step, function (e) {
      const index = $(this).data('wizard-index');

      if (!self.get(index).is('disabled')) {
        self.goTo(index);
      }

      e.preventDefault();
      e.stopPropagation();
    });

    if (this.options.keyboard) {
      $(document).on('keyup', $.proxy(this.keydown, this));
    }

    this.trigger('init');
  }

  setup() {
    this.$buttons = $(this.options.templates.buttons.call(this));

    this.updateButtons();

    const buttonsAppendTo = this.options.buttonsAppendTo;
    let $to;
    if (buttonsAppendTo === 'this') {
      $to = this.$element;
    } else if ($.isFunction(buttonsAppendTo)) {
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

    $.each(this.steps, (i, step) => {

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

        if ($.isFunction(callback)) {
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

    $.each(this.steps, (i, step) => {
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
          const api = $.data(this, 'wizard');
          if (api && typeof api[method] === 'function') {
            api[method](...args);
          }
        });
      }
    }
    return this.each(function () {
      if (!$.data(this, 'wizard')) {
        $.data(this, 'wizard', new wizard(this, options));
      }
    });
  }
}

$(document).on('click', '[data-wizard]', function (e) {
  'use strict';
  let href;
  const $this = $(this);
  const $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, ''));

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

$.fn[NAME] = wizard._jQueryInterface;
$.fn[NAME].constructor = wizard;
$.fn[NAME].noConflict = () => {
  'use strict';
  $.fn[NAME] = window.JQUERY_NO_CONFLICT;
  return wizard._jQueryInterface;
};

export default wizard;