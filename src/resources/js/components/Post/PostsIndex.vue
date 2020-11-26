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
      v-for="post in posts"
      :key="post.id"
      :post="post"
      v-on:getPosts="getPosts"
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
