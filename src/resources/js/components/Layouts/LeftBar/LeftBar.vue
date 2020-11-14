<template>
<div class="d-flex flex-column h-100 justify-content-between">
  <top :profile="profile[0]" :isLogin="isLogin" />
  <bottom v-if="isLogin" :profile="profile[0]" :user="user" />
</div>
</template>

<style lang="scss" scoped>
.router-link-active { color: #3490dc; }
a { text-decoration: none; }
</style>

<script>
import Top from './Top';
import Bottom from './Bottom.vue';
export default {
  data: function () {
    return {}
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    user () {
      return this.$store.getters['auth/user']
    },
    profile () {
      return this.$store.getters['profile/profile']
    }
  },
  components: {
    Top,
    Bottom,
  },
}
</script>
