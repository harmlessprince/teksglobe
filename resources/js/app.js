require('./bootstrap');

window.Vue = require('vue');

Vue.component('transfer-component', require('./components/TransferComponent.vue').default);

const app = new Vue({
  el: '#app',
});
