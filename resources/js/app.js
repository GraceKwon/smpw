
require("./bootstrap");

window.Vue = require("vue");
import VeeValidate from 'vee-validate';
import ko from './ko.js'
import VLabel from './components/VLabel.vue';

const config = {
  locale: 'ko',
  dictionary: {
    ko
  }
}

window.Vue.use(VeeValidate, config);
Vue.component('v-label', VLabel);