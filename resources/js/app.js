require('./libs/bootstrap');
import 'admin-lte/dist/js/adminlte.min.js';

import {createApp} from "vue"
import * as VueRouter from "vue-router";

import routes from "./router"
import store from "./store"

import AppTemplate from "./Vue/Template/App"
import BackendErrors from './Vue/components/BackendErrors'

const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(), /* createWebHistory */
    routes,
})

const  app = createApp(AppTemplate)

app.use(router)
app.use(store)
app.component('BackendErrors', BackendErrors)

app.mount('#app');


