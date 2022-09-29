/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 import "./bootstrap";
 import { createApp } from "vue";
 import axios from 'axios'
 import VueAxios from 'vue-axios'
 import router from "./router/User";
 import User from "./body/User.vue";
 import LaravelVuePagination from "laravel-vue-pagination";
 
 
 const app = createApp(User);
 app.use(VueAxios, axios);
 app.use(router);
 app.component('Pagination', LaravelVuePagination);
 app.mount("#user");
