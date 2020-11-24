<template>
<div v-if="post" class="">
  <div class="d-flex justify-content-between border-bottom p-2">
    <div class="d-flex">
      <img v-if="post.profile" class="postProfileImage rounded-circle" :src="post.profile.image">
      <h4 v-if="post.user">{{ post.user.userid }}</h4>
    </div>
    <post-menu :postId="postId" />
  </div>

  <div>
    <p>{{ post.text }}</p>
    <div v-on:click="open = !open">
      <p>{{ post.place }}</p>
    </div>
    <div>
      <img v-for="image in post.images" :key="image.id" class="w-50" :src="image.path">
    </div>
    <gmap class="p-2" v-if="post.place" v-show="open" :geocode="post" />

    <p class="">{{ post.created_at }}</p>
  </div>
</div>
</template>

<script>
import Gmap from '../Gmap/Gmap';
import PostMenu from './PostMenu.vue';
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
    },
  },
  mounted() {
    this.getPost();
  },
  components: {
    Gmap,
    PostMenu,
  }
}
</script>
