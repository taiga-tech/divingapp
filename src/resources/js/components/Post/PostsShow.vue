<template>
<div>
  <div v-if="post">
    <div class="d-flex justify-content-between p-2">
      <div class="d-flex">
        <img v-if="post.profile" class="postProfileImage rounded-circle" :src="post.profile.image">
        <h4 v-if="post.user">{{ post.user.userid }}</h4>
      </div>
      <post-menu :postId="postId" />
    </div>

    <div>
      <div class="p-2">{{ post.text }}</div>
      <div v-on:click="open = !open">
        <p>{{ post.place }}</p>
      </div>
      <div>
        <img v-for="image in post.images" :key="image.id" class="w-50" :src="image.path">
      </div>
      <gmap class="p-2" v-if="post.place" v-show="open" :geocode="post" />

      <p class="mt-2 pl-1">{{ post.created_at }}</p>
    </div>
    <div class="border-bottom">
      <i class="far fa-thumbs-up"> 良いね数</i>
    </div>
  </div>
  <div v-else class="mt-5">
    <v-loading
      type="barsCylon"
      color="#335b66"
      :size="{ width: '50px', height: '50px'}"
    />
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
      post: null,
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
