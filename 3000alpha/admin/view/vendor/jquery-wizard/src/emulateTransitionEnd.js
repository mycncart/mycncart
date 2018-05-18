import Support from './support';

export default ($el, duration) => {
    'use strict';
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