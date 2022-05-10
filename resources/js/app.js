require('./bootstrap');
import 'admin-lte/dist/js/adminlte.min.js';

// require('./router')

import * as Vue from "vue"
import * as VueRouter from "vue-router";

import routes from "@/router"
import store from "@/store"

import AppTemplate from "@/Vue/Template/App"

const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(), /* createWebHistory */
    routes,
})

Vue.createApp(AppTemplate)
    .use(router)
    .use(store)
    .mount('#app');

