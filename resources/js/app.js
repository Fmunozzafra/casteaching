import VideosList from "./components/VideosList";
import Alpine from 'alpinejs';
import casteaching from '@acacha/casteaching'
import Vue from 'vue'
import VideoForm from "./components/VideoForm";
import Status from "./components/Status";
require('./bootstrap');

window.Alpine = Alpine;
Alpine.start();
window.casteaching = casteaching({baseUrl: 'https://casteaching.test/api'});

const vueApp = document.querySelector('#app')

if(vueApp){
    console.log('prova');
    window.Vue = Vue
    window.Vue.component('videos-list', VideosList )
    window.Vue.component('video-form', VideoForm )
    window.Vue.component('status', Status )
    console.log('xivato!');
    const app = new window.Vue({
        el: '#app',
    });
}
