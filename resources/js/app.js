
require("./bootstrap");

window.Vue = require("vue");
import VeeValidate from 'vee-validate';
import VueCookie from 'vue-cookie';
import DatePicker from 'vue2-datepicker'
import ko from './ko.js'

const config = {
  locale: 'ko',
  dictionary: {
    ko
  }
}

window.Vue.use(VeeValidate, config);
window.Vue.use(VueCookie);
window.Vue.use(DatePicker);

//IE 대응
if (typeof Object.assign != 'function') {
  // Must be writable: true, enumerable: false, configurable: true
  Object.defineProperty(Object, "assign", {
    value: function assign(target, varArgs) { // .length of function is 2
      'use strict';
      if (target == null) { // TypeError if undefined or null
        throw new TypeError('Cannot convert undefined or null to object');
      }

      var to = Object(target);

      for (var index = 1; index < arguments.length; index++) {
        var nextSource = arguments[index];

        if (nextSource != null) { // Skip over if undefined or null
          for (var nextKey in nextSource) {
            // Avoid bugs when hasOwnProperty is shadowed
            if (Object.prototype.hasOwnProperty.call(nextSource, nextKey)) {
              to[nextKey] = nextSource[nextKey];
            }
          }
        }
      }
      return to;
    },
    writable: true,
    configurable: true
  });
}