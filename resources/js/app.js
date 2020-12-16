require('./bootstrap');

window.Vue = require('vue');

Vue.component('transfer-component', require('./components/TransferComponent.vue').default);
Vue.component('withdraw-component', require('./components/WithdrawComponent.vue').default);

const app = new Vue({
  el: '#app',
});
