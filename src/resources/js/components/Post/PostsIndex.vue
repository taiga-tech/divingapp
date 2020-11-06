<template>

<div class="">
  <div class="p-2 border-bottom" v-for="post in posts" :key="post.id">
      <div class="d-flex px-1 justify-content-between">
          <div class="d-flex">
            <router-link :to="{ name: 'profiles.show', params: { profileId: post.profile.id}}">
              <img class="postProfileImage rounded-circle" :src="'/storage/images/' + post.profile.image" alt="">
            </router-link>
            <h5>{{ post.profile.name }}</h5>
            <p>({{ post.user.userid }})</p>
          </div>
        <div><i class="fas fa-ellipsis-v"></i></div>
      </div>
    <router-link :to="{ name: 'posts.show', params: { postId: post.id } }">
      <p>{{ post.text }}</p>
      <p>{{ post.spot }}</p>
      <p>{{ post.created_at }}</p>
      <div>
        <img v-for="image in post.images" :key="image.id" :src="'/storage/images/' + image.path" class="w-25">
      </div>
    </router-link>
  </div>
</div>

</template>

<script>
export default {
  data: function () {
    return {
      posts: []
    }
  },
  methods: {
    getPosts() {
      axios.get('/api/posts')
      .then((res) => {
        this.posts = res.data.reverse();
      });
    }
  },
  mounted() {
    this.getPosts();
  }
}
</script>
