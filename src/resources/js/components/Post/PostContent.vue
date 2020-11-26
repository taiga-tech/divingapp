<template>
<div class="p-2 border-bottom">
  <div class="d-flex px-1 justify-content-between" style="position:relative">
    <div class="d-flex">
      <div v-on:click="pushProfile">
        <img class="postProfileImage rounded-circle" :src="post.profile.image">
      </div>
      <h5>{{ post.profile.name }}</h5>
      <p>({{ post.user.userid }})</p>
    </div>
    <post-menu v-on:postDelete="deleted" :postId="post.id" :index="$parent.key" />
  </div>
  <div v-on:click="$router.push({ name: 'posts.show', params: { postId: post.id } })">
    <p>{{ post.text }}</p>
    <p>{{ post.place }}</p>
    <p>{{ post.created_at }}</p>
    <div>
      <img
        v-for="image in post.images"
        :key="image.id"
        :src="image.path"
        class="w-25"
      >
    </div>
  </div>
</div>
</template>

<style lang="scss" scoped>
a { text-decoration: none; }
</style>

<script>
import PostMenu from './PostMenu.vue'
export default {
  props: {
    post: null
  },
  methods: {
    pushProfile() {
      if (this.$route.name != 'profiles.show') {
        this.$router.push({ name: 'profiles.show', params: { profileId: this.post.profile.id } })
      }
    },
    deleted() {
      this.$emit('getPosts')
    },
  },
  components: {
    PostMenu,
  },
}
</script>
