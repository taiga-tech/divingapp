<template>
<div v-if="post" class="">
  <img v-if="post.profile" class="postProfileImage rounded-circle" :src="'/storage/images/' + post.profile.image" alt="">
  <span v-on:click="$router.push({ name: 'posts.edit', params: postId })">edit</span>
  <h4 v-if="post.user">{{ post.user.userid }}</h4>
  <p>{{ post.text }}</p>
  <div v-on:click="open = !open">
    <p>{{ post.place }}</p>
  </div>
  <div >
    <img v-for="image in post.images" :key="image.id" class="w-50" :src="'/storage/images/' + image.path">
  </div>
  <gmap class="p-2" v-if="post.place" v-show="open" :geocode="post" />
</div>
</template>

<script>
import Gmap from '../Gmap/Gmap';
export default {
  props: {
    postId: NaN
  },
  data: function () {
    return {
      post: {},
      open: false
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
  },
  components: {
    Gmap,
  }
}
</script>
