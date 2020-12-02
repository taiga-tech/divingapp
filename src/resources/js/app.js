import './bootstrap';
import router from './router';
import store from './store';
import App from './App.vue';
import VueTouch from 'vue-touch';
import VueAxios from 'vue-axios';
import VueSocialauth from 'vue-social-auth';
import vSelect from "vue-select";
import contenteditable from 'vue-contenteditable'
import * as VueGoogleMaps from 'vue2-google-maps'
import { VueLoading } from 'vue-loading-template';
import VueWait from 'vue-wait';
import Vuelidate from 'vuelidate';


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
window.Vue = require('vue')
Vue.use(VueTouch)
Vue.use(Vuelidate)
Vue.component("v-select", vSelect)
Vue.component('v-loading', VueLoading)
Vue.use(VueWait)
Vue.use(contenteditable)
Vue.use(VueAxios, axios)
Vue.use(VueSocialauth, {
    providers: {
        google: {
            clientId: `${ process.env.MIX_GOOGLE_CLIENT_ID }`,
            redirectUri: `${ process.env.MIX_APP_URL }/api/auth/google/callback`,
        },
        twitter: {
            clientId: `${ process.env.MIX_TWITTER_CLIENT_ID }`,
            redirectUri: `${ process.env.MIX_APP_URL }/auth/twitter/callback`,
        },
        facebook: {
            clientId: `${ process.env.MIX_FACEBOOK_CLIENT_ID }`,
            redirectUri: `${ process.env.MIX_APP_URL }/api/auth/facebook/callback`,
        },
    }
})
Vue.use(VueGoogleMaps, {
    load: {
        key: process.env.MIX_GOOGLE_MAP_API,
        libraries: 'places'
    }
})
Vue.component('infoWindow', VueGoogleMaps.InfoWindow);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default)
Vue.component('top-bar', require('./components/Layouts/TopBar.vue').default)
Vue.component('left-bar', require('./components/Layouts//LeftBar/LeftBar.vue').default)
Vue.component('right-bar', require('./components/Layouts/RightBar.vue').default)
Vue.component('bottom-bar', require('./components/Layouts/BottomBar.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const createApp = async () => {
    await store.dispatch('auth/currentUser')
    await store.dispatch('profile/currentProfile', store.getters['auth/user'].id)

    new Vue({
        el: '#app',
        router,
        store,
        components: { App },
        template: '<App />',
        wait: new VueWait({
            useVuex: true
        }),
    });
}

createApp();
