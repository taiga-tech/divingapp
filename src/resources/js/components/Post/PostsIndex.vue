<template>
<div>
  <div v-if="posts.length != 0">
    <post-content v-for="post in posts" :key="post.id" :post="post" />
  </div>
  <enpty v-else message='まだ投稿がありません' />
</div>
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
      const posts = await axios.get('/api/posts')
      this.posts = posts.data.reverse();
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
