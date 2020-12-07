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
      <img
        v-if="post.profile"
        v-on:click="$router.push({ name: 'profiles.show', params: { profileId: post.profile.id } })"
        :src="post.profile.image"
        class="postProfileImage rounded-circle"
      >
      <div class="d-flex justify-content-between w-100 ml-2">
        <div>
          <h4>{{ post.profile.name }}</h4>
          <p v-if="post.user" class="ml-1 opa">{{ post.user.userid }}</p>
        </div>
        <post-menu v-if="user.id == post.user.id" :postId="postId" />
      </div>
    </div>

    <div>
      <div class="textArea p-2">{{ post.text }}</div>

      <div v-if="post.images.length != 0" class="w-100 mb-2 d-flex flex-wrap" style="height:450px;">
        <div
          v-for="(image, index) in post.images"
          :key="index"
          :class="{
            'w-100': post.images.length == 1,
            'w-50 h-100': post.images.length == 2,
            'w-50 h-50': post.images.length == 3 || post.images.length == 4,
            'w-30 h-50': post.images.length == 5 || post.images.length == 6,
          }"
        >
          <a :href="image.path" target="_blank">
            <img
              :src="image.path"
              class="w-100 h-100 p-1"
              style="border-radius:10px"
            >
          </a>
        </div>
      </div>

      <div v-if="post.place">
        <span v-on:click="open = !open" class="opa">
          {{ post.place }} <i class="fas" :class="{ 'fa-chevron-up': !open, 'fa-chevron-down': open}"></i>
        </span>
      </div>

      <gmap class="p-2" v-if="post.place" v-show="open" :geocode="post" />
    </div>
    <post-info
      :post="post"
      :goods="post.goods"
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
      comments: [],
    }
  },
  methods: {
    async getPost() {
      const response = await axios.get('/api/posts/' + this.postId)
      this.post = await response.data[0]
      this.comments = await response.data[1]
    },
  },
  mounted() {
    this.getPost();
  },
  computed: {
    user () {
      return this.$store.getters['auth/user']
    },
  },
  components: {
    Gmap,
    PostMenu,
    PostInfo,
    CommentIndex,
  }
}
</script>
