<template>
<div class="p-2 border-bottom">
  <div class="d-flex justify-content-between p-1">
    <router-link :to="{ name: 'profiles.show', params: { profileId: this.profile.id }}">
      <div class="d-flex">
        <img class="rounded-circle" :src="profile.image">
        <p>{{ profile.name }}</p>
        <p>{{ profile.user.userid }}</p>
        <p>{{ profile.posts.length }}</p>
      </div>
    </router-link>
    <div v-on:click="follow">フォロー</div>
  </div>
</div>
</template>

<style lang="scss" scoped>
img {
  width: 60px;
  height: 60px;
}
a { text-decoration: none; }
</style>

<script>
export default {
  props: {
    profileId: NaN,
    profile: {},
  },
  methods: {
    follow() {
      console.log('フォロー')
    }
  },
}
</script>
