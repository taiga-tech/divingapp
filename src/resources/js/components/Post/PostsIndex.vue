<template>
<v-wait>
  <v-loading
    slot="waiting"
    type="barsCylon"
    color="#335b66"
    :size="{ width: '50px', height: '50px'}"
    class="mt-5"
  />
  <div v-if="posts.length != 0">
    <post-content
      v-for="(post, index) in posts"
      :key="index"
      :post="post"
      :index="index"
      v-on:removePost="removePost"
    />
  </div>
  <enpty v-else message='まだ投稿がありません' />
</v-wait>
</template>

<script>
import PostContent from './PostContent';
import Enpty from './Enpty';
export default {
  data: function () {
    return {
      posts: []
    }
  },
  methods: {
    async getPosts() {
      this.$wait.start('loading')
      const posts = await axios.get('/api/posts')
      this.posts = posts.data.reverse()
      this.$wait.end('loading')
    },
    removePost(e) {
      this.posts.splice(e, 1)
    }
  },
  mounted() {
    this.getPosts();
  },
  components: {
    PostContent,
    Enpty,
  },
}
</script>
