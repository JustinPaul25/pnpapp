require('./bootstrap');

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import 'leaflet-routing-machine/dist/leaflet-routing-machine.css';
import store from './store/vuex';
import VModal from 'vue-js-modal/dist/index.nocss.js'
import 'vue-js-modal/dist/styles.css'
import { global } from './mixins';
import Swal from 'sweetalert2';
import VuejsPaginate from 'vuejs-paginate';
import Column2D from 'fusioncharts/fusioncharts.charts';

import VueGeolocation from 'vue-browser-geolocation';
import { LMap, LTileLayer, LMarker, LCircleMarker, LControl, LPolyline} from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
// Include the vue-fusioncharts component
import VueFusionCharts from 'vue-fusioncharts';

//Include the FusionCharts library
import FusionCharts from 'fusioncharts';
import Charts from 'fusioncharts/fusioncharts.charts';
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion';


window.Vue = require('vue');
window.Swal = Swal;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('reports-list', require('./components/Reports.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('users-list', require('./components/Users.vue').default);
Vue.component('setting', require('./components/Settings.vue').default);
Vue.component('change-password', require('./components/ChangePassword.vue').default);
Vue.component('LRoutingMachine', require('./components/LRoutingMachine.vue').default);
Vue.component('paginate', VuejsPaginate);
Vue.component('loading', Loading);
Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component('l-circle-marker', LCircleMarker);
Vue.component('l-control', LControl);
Vue.component('l-polyline', LPolyline);

Vue.use(VModal, { dynamicDefault: { draggable: true } })
Vue.use(VueFusionCharts, FusionCharts, Charts, FusionTheme)
Vue.use(VueGeolocation)

Vue.mixin(global)

const app = new Vue({
    el: '#app',
    store,
});
