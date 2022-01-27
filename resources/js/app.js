import Alpine from 'alpinejs';
import casteaching from '@acacha/casteaching';
import Vue from 'vue'
import VideosList from "./components/VideosList";
import VideoForm from "./components/VideoForm";
import Status from "./components/Status";

require('./bootstrap');

window.Alpine = Alpine;
window.api = casteaching({baseUrl: '/api'});
window.Vue = Vue

window.Vue.component('videos-list', VideosList)
window.Vue.component('video-form', VideoForm )
window.Vue.component('status', Status )

Alpine.start();

const app = new window.Vue({
    el: '#app',
});
