require('./bootstrap');

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import store from './store/vuex';
import VModal from 'vue-js-modal/dist/index.nocss.js'
import 'vue-js-modal/dist/styles.css'
import { global } from './mixins';
import Swal from 'sweetalert2'

window.Vue = require('vue');
window.Swal = Swal;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('reports-list', require('./components/Reports.vue').default);
Vue.component('users-list', require('./components/Users.vue').default);
Vue.component('loading', Loading);

Vue.use(VModal, { dynamicDefault: { draggable: true } })

Vue.mixin(global)

const app = new Vue({
    el: '#app',
    store,
});
