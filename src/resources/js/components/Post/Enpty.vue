<template>
<div class="text-center mt-5">
  <h3>{{ message }}</h3>
  <div v-if="$route.name == 'posts.index' || $route.name == 'profiles.show'">
    <div v-if="! isLogin">
      <p class="opa mt-2">投稿するにはログイン必要です</p>
      <o-auth />
    </div>
    <div v-else>
      <p class="opa mt-2">投稿するとここに表示されます</p>
      <div
        v-on:click="$router.push({name: 'posts.create'})"
        class="btn btn-primary mt-4">投稿する
      </div>
    </div>
  </div>
  <div v-else>
    <p class="mt-2">キーワードを変更してください</p>
  </div>
</div>
</template>

<style scope>
.opa {
  opacity: 0.7;
}
</style>

<script>
import OAuth from '../Auth/OAuth.vue'
export default {
  components: { OAuth },
  props: {
    message: String,
  },
  components: {
    OAuth,
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
  }
}
</script>
