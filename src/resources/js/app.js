import './bootstrap';
import router from './router';
import store from './store';
import App from './App.vue';
import VueTouch from 'vue-touch';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueTouch)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('top-bar', require('./components/Layouts/TopBar.vue').default);
Vue.component('left-bar', require('./components/Layouts/LeftBar.vue').default);
Vue.component('right-bar', require('./components/Layouts/RightBar.vue').default);
Vue.component('bottom-bar', require('./components/Layouts/BottomBar.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const createApp = async () => {
    await store.dispatch('auth/currentUser');
    await store.dispatch('app/appName');
    await store.dispatch('profile/currentProfile', store.getters['auth/user'].id);

    new Vue({
        el: '#app',
        router,
        store,
        components: { App },
        template: '<App />'
    });
}

createApp();
