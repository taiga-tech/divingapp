<template>
<div class="d-md-none dark:bg-gray-800" style="height: 50px">
  <div class="d-flex h-100">
    <router-link v-on:click="home" class="flex-fill d-flex align-items-center justify-content-center" v-bind:to="{name: 'posts.index'}">
      <div class=""><i class="fas fa-home"></i></div>
    </router-link>
    <router-link class="flex-fill d-flex align-items-center justify-content-center" v-bind:to="{ name: 'search' }">
      <div class=""><i class="fas fa-search"></i></div>
    </router-link>
  </div>
</div>
</template>

<script>
export default {
  methods: {
    home: function event() {
    },
  }
}
</script>
