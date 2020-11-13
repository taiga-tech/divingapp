<template>
<div class="p-2 border-bottom">
  <div class="d-flex px-1 justify-content-between">
    <router-link :to="{ name: 'profiles.show', params: { profileId: post.profile.id }}">
      <div class="d-flex">
          <img class="postProfileImage rounded-circle" :src="'/storage/images/' + post.profile.image" alt="">
        <h5>{{ post.profile.name }}</h5>
        <p>({{ post.user.userid }})</p>
      </div>
    </router-link>
    <div v-on:click="postMenu"><i class="fas fa-ellipsis-v"></i></div>
  </div>
  <router-link :to="{ name: 'posts.show', params: { postId: post.id }}">
    <p>{{ post.text }}</p>
    <p>{{ post.spot }}</p>
    <p>{{ post.place }}</p>
    <p>{{ post.created_at }}</p>
    <div>
      <img
        v-for="image in post.images"
        :key="image.id"
        :src="'/storage/images/' + image.path"
        class="w-25"
      >
    </div>
  </router-link>
</div>
</template>

<style lang="scss" scoped>
a { text-decoration: none; }
</style>

<script>
export default {
  props: {
    post: {}
  },
  methods: {
    postMenu() {
      console.log('menu')
    },
  },
}
</script>
