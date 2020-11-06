<template>
<div class="d-flex justify-content-center dark:bg-gray-900 dark:text-gray-400">
  <div id="sideMenu" class="d-none d-md-block col-xl-2 py-3 border-right">
    <left-bar />
  </div>
  <div class="col-md-7 col-xl-4 p-0">
    <top-bar ref='topBar' />
    <div id="unActive" class="main overflow-auto">
      <router-view />
    </div>
    <v-touch v-on:swiperight="sideMenu">
      <bottom-bar />
    </v-touch>
  </div>
  <div class="d-none d-md-block col-xl-3 pt-3 border-left">
    <right-bar />
  </div>
</div>
</template>

<style>
@media (min-width: 755px) {
  #sideMenu {
    width: 80px;
  }
  .main {
    height: calc(100vh - 53px);
  }
}
@media (max-width: 754px) {
  .main {
    height: calc(100vh - 103px);
  }
}
</style>

<script>
export default {
  methods: {
    sideMenu: function event() {
      this.$refs.topBar.Active()
    }
  }
}
</script>
