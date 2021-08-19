/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import Vue from 'vue';
import router from './router/index.js';
import App from './layouts/App.vue';
import store from './store/index.js';
import VueAxios from 'vue-axios';
import axios from 'axios';
import ReadMore from 'vue-read-more';

window.Vue = Vue;
Vue.config.productionTip = false;
Vue.use(VueAxios, axios);
Vue.use(ReadMore);

const app = new Vue({
    store,
    router,
    el: '#app',
    render: h => h(App)
});
