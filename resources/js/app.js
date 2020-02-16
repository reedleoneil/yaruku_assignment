require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

window.Vue = require('vue');

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.component(
    'table-component',
    require('./components/BookTableComponent.vue').default
);

Vue.component(
    'add-component',
    require('./components/BookAddComponent.vue').default
);

Vue.component(
    'export-component',
    require('./components/BookExportComponent.vue').default
);

new Vue({ el: '#app' })
