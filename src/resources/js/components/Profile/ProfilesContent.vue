<template>
<div class="p-2 border-bottom">
  <div class="d-flex justify-content-between p-1">
    <div v-on:click="$router.push({ name: 'profiles.show', params: { profileId: profile.id }})">
      <div class="d-flex">
        <img class="rounded-circle" :src="profile.image">
        <p>{{ profile.name }}</p>
        <p>{{ profile.user.userid }}</p>
        <p>{{ profile.posts.length }}</p>
      </div>
    </div>
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
