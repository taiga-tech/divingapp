<template>

<div v-if="post" class="">
  <img v-if="post.profile" class="postProfileImage rounded-circle" :src="'/storage/images/' + post.profile.image" alt="">
  <h4 v-if="post.user">{{ post.user.userid }}</h4>
  <p>{{ post.text }}</p>
  <p>{{ post.place }}</p>
  <div >
    <img v-for="image in post.images" :key="image.id" class="w-50" :src="'/storage/images/' + image.path">
  </div>
  <router-link v-bind:to="{ name: 'posts.edit', params: { postId: post.id } }">
    edit
  </router-link>
</div>

</template>

<script>
export default {
  props: {
    postId: NaN
  },
  data: function () {
    return {
      post: {}
    }
  },
  methods: {
    getPost() {
      axios.get('/api/posts/' + this.postId)
      .then((res) => {
        this.post = res.data;
      });
    }
  },
  mounted() {
    this.getPost();
  }
}

</script>
