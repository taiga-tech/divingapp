<template>
<div class="p-2 border-bottom">
  <div class="d-flex px-1 justify-content-between">
    <div class="d-flex">
      <div v-on:click="pushProfile" class="mr-2">
        <img class="postProfileImage rounded-circle" :src="post.profile.image">
      </div>
      <div>
        <div class="d-flex">
          <h5>{{ post.profile.name }}</h5>
          <p>({{ post.user.userid }})</p>
        </div>
        <div v-on:click="pushPost">
          <div class="textArea">{{ post.text }}</div>
          <p>{{ post.place }}</p>
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
    </div>
    <post-menu
      v-if="user.id == post.user.id"
      v-on:postDelete="deleted"
      :postId="post.id"
      :index="index"
    />
  </div>
  <post-info
    :post="post"
    :goods="goods"
    :comments="comments"
  />
</div>
</template>

<style lang="scss" scoped>
a { text-decoration: none; }
</style>

<script>
import PostMenu from './PostMenu';
import PostInfo from './PostInfo';
export default {
  props: {
    post: null,
    index: NaN,
  },
  data: function() {
    return {
      goods: [],
      comments: [],
    }
  },
  methods: {
    pushProfile() {
      if (this.$route.name != 'profiles.show') {
        this.$router.push(
          { name: 'profiles.show', params: { profileId: this.post.profile.id } }
        )
      }
    },
    pushPost() {
      this.$router.push({ name: 'posts.show', params: { postId: this.post.id } })
    },
    deleted(e) {
      this.$emit('removePost', e)
    },
  },
  computed: {
    user () {
      return this.$store.getters['auth/user']
    },
  },
  components: {
    PostMenu,
    PostInfo,
  },
}
</script>
