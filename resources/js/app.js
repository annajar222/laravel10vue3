import './bootstrap';

import Alpine from 'alpinejs';

import { createApp } from 'vue/dist/vue.esm-bundler';

import router from './router';

import CustomerIndex from "./components/CustomerIndex.vue";

createApp({
    components: {
        CustomerIndex
    }
}).use(router).mount('#app');


window.Alpine = Alpine;

Alpine.start();


