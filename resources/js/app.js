require('./bootstrap');
window.Vue = require('vue');
import router from './router';
import store from './store';
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import locale from 'view-design/dist/locale/en-US';
Vue.use(ViewUI, { locale });
import commonajax from './comonajax';
Vue.mixin(commonajax);
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('mainapp', require('./mainapp').default);

const app = new Vue({
    el: '#app',
    router,
    store,
});
