require('./bootstrap');

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import store from './store/vuex';
import VModal from 'vue-js-modal/dist/index.nocss.js'
import 'vue-js-modal/dist/styles.css'
import { global } from './mixins';
import Swal from 'sweetalert2';
import VuejsPaginate from 'vuejs-paginate'
import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';
import Column2D from 'fusioncharts/fusioncharts.charts';
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion';
import VueGeolocation from 'vue-browser-geolocation';
import { LMap, LTileLayer, LMarker, LCircleMarker, LControl} from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';


window.Vue = require('vue');
window.Swal = Swal;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('reports-list', require('./components/Reports.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('users-list', require('./components/Users.vue').default);
Vue.component('paginate', VuejsPaginate);
Vue.component('loading', Loading);
Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component('l-circle-marker', LCircleMarker);
Vue.component('l-control', LControl);

Vue.use(VModal, { dynamicDefault: { draggable: true } })
Vue.use(VueFusionCharts, FusionCharts, Column2D, FusionTheme);
Vue.use(VueGeolocation)

Vue.mixin(global)

const app = new Vue({
    el: '#app',
    store,
});
