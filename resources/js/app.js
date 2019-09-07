
require("./bootstrap");

window.Vue = require("vue");
import VeeValidate from 'vee-validate';
import VueCookie from 'vue-cookie';
import ko from './ko.js'

const config = {
  locale: 'ko',
  dictionary: {
    ko
  }
}

window.Vue.use(VeeValidate, config);
window.Vue.use(VueCookie);