import Vue from 'vue';
import Vuex from 'vuex';
import auth from './auth';
import profile from './profile';
import app from './app';

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    auth,
    app,
    profile
  }
});

export default store;
