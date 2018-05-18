import $ from 'jQuery';

const Support = ((() => {
  'use strict';
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
    style = $('<support>').get(0).style,
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
      $.each(prefixes, (i, prefix) => {
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
    support.transition = new String(prefixed('transition'));
    support.transition.end = events.transition.end[support.transition];
  }

  return support;
}))();

export default Support;