require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

window.Vue = require('vue');

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.component(
    'table-component',
    require('./components/TableComponent.vue').default
);

Vue.component(
    'export-component',
    require('./components/ExportComponent.vue').default
);

new Vue({ el: '#app' })
