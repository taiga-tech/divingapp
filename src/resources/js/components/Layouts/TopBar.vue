<template>
<div class="topBar px-2 w-100 border-bottom text-center text-xl-left">
  <img
    v-if="profile"
    v-on:click="sideMenu"
    :src="'/storage/images/' + profile.image"
    class="Active d-inline-block d-md-none rounded-circle float-left p-1"
    >
  <span
    v-else
    v-on:click="sideMenu"
    class="Active d-inline-block d-md-none rounded-circle float-left"
    >
    <i class="fas fa-bars"></i>
  </span>
  <span class="title ml-n5 m-md-0">{{ appName }}</span>
</div>
</template>

<style>
.fixed {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 250px;
  z-index: 2;
  box-shadow: 8px 0px 8px -1px rgba(0, 0, 0, 0.25);
}
#grayOut {
  background: rgba(0, 0, 0, 0.3);
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: 1;
}
</style>

<script>
export default {
  data: function () {
    return {}
  },
  methods: {
    Active () {
      let sideMenu = document.getElementById('sideMenu');
      let unActive = document.getElementById('unActive');
      sideMenu.classList.add('fixed', 'dark:bg-gray-800', 'light:bg');
      sideMenu.classList.remove('d-none', 'border-right');
      unActive.insertAdjacentHTML('beforeend', '<div id="grayOut"></div>')
    },
    sideMenu: function event() {
      this.Active();
    },
    unActive () {
      sideMenu.classList.remove('fixed', 'dark:bg-gray-800', 'light:bg');
      sideMenu.classList.add('d-none', 'border-right');
      let grayOut = document.getElementById('grayOut');
      grayOut.remove();
    },
  },
  mounted () {
    let aTag = document.getElementsByClassName('link');
    for(var i = 0; i < aTag.length; i++) {
      aTag[i].addEventListener("click", event => { this.unActive() });
      unActive.addEventListener("click", event => { this.unActive() });
    }
  },
  computed: {
    isLogin() {
      return this.$store.getters['auth/check'];
    },
    user() {
      return this.$store.getters['auth/user'];
    },
    appName() {
      return process.env.MIX_APP_NAME
    },
    profile() {
      return this.$store.getters['profile/profile']
    }
  },
}
</script>
