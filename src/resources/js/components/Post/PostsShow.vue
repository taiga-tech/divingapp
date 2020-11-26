<template>
<v-wait>
  <v-loading
    slot="waiting"
    type="barsCylon"
    color="#335b66"
    :size="{ width: '50px', height: '50px'}"
    class="mt-5"
  />

  <div v-if="post" class="px-2">
    <div class="d-flex p-2">
      <img v-if="post.profile" class="postProfileImage rounded-circle" :src="post.profile.image">
      <div class="d-flex justify-content-between w-100 ml-2">
        <div class="d-flex">
          <h4>{{ post.profile.name }}</h4>
          <h4 v-if="post.user" class="ml-1 opa">{{ post.user.userid }}</h4>
        </div>
        <post-menu :postId="postId" />
      </div>
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
    </div>
    <div class="d-flex justify-content-between border-bottom border-top p-2">
      <div>
        <i class="far fa-thumbs-up mr-1"> 良いね数</i>
        <i class="far fa-comment-alt"> コメント</i>
      </div>
      <p class="">{{ post.created_at }}</p>
    </div>
  </div>
</v-wait>
</template>

<style lang="scss" scoped>
</style>

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
    async getPost() {
      await axios.get('/api/posts/' + this.postId)
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
