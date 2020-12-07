<template>
<div class="border-bottom">
  <div class="py-2 d-flex" v-on:click="pushProfile">
    <div class="d-flex justify-content-center" style="width:80px">
      <img class="rounded-circle" :src="profile.image">
    </div>
    <div style="width: calc(100% - 80px)">
      <h4 style="width: calc(100% - 80px)">{{ profile.name }}</h4>
      <p class="opa">{{ profile.user.userid }}</p>
      <p>{{ profile.comment }}</p>
    </div>
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
    profile: Object,
  },
  methods: {
    pushProfile() {
      this.$router.push({ name: 'profiles.show', params: { profileId: this.profile.id }})
    },
  },
}
</script>
