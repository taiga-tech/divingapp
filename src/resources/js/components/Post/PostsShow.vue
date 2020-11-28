<template>
<v-wait>
  <v-loading
    slot="waiting"
    type="barsCylon"
    color="#335b66"
    :size="{ width: '50px', height: '50px'}"
    class="mt-5"
  />

  <div v-if="post" class="px-2 border-bottom">
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
      <div class="textArea p-2">{{ post.text }}</div>
      <div v-on:click="open = !open">
        <p>{{ post.place }}</p>
      </div>
      <div>
        <img v-for="image in post.images" :key="image.id" class="w-50" :src="image.path">
      </div>
      <gmap class="p-2" v-if="post.place" v-show="open" :geocode="post" />
    </div>
    <post-info
      :post="post"
      :goods="goods"
      :comments="comments"
      class="border-top p-2"
    />
  </div>
  <div v-if="post">
    <comment-index :postId="post.id" :comments="comments" />
  </div>
</v-wait>
</template>

<script>
import Gmap from '../Gmap/Gmap';
import CommentIndex from './Comment/CommentIndex';
import PostMenu from './PostMenu';
import PostInfo from './PostInfo';
export default {
  props: {
    postId: NaN
  },
  data: function () {
    return {
      post: null,
      open: false,
      goods: [],
      comments: [],
    }
  },
  methods: {
    async getPost() {
      const response = await axios.get('/api/posts/' + this.postId)
      this.post = response.data
      // this.goods = response.data.goods
      // this.comments = response.data.comments
    },
  },
  mounted() {
    this.getPost();
  },
  components: {
    Gmap,
    PostMenu,
    PostInfo,
    CommentIndex,
  }
}
</script>
