<template>
<div class="d-md-none dark:bg-gray-800 light:bg100" style="height: 50px">
  <div class="d-flex h-100">
    <router-link class="flex-fill d-flex align-items-center justify-content-center" :to="{ name: 'posts.index' }">
      <div><i class="fas fa-home"></i></div>
    </router-link>
    <router-link v-if="isLogin" class="flex-fill d-flex align-items-center justify-content-center" :to="{ name: 'posts.create' }">
      <div><i class="far fa-plus-square"></i></div>
    </router-link>
    <router-link class="flex-fill d-flex align-items-center justify-content-center" :to="{ name: 'search' }">
      <div><i class="fas fa-search"></i></div>
    </router-link>
  </div>
</div>
</template>

<script>
export default {
    computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
  },
}
</script>
