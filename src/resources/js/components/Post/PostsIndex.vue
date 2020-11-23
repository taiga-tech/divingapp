<template>
<div>
  <div v-if="posts.length != 0">
    <post-content v-for="post in posts" :key="post.id" :post="post" />
  </div>
  <enpty message='まだ投稿がありません' />
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
    getPosts() {
      axios.get('/api/posts')
      .then((res) => {
        this.posts = res.data.reverse();
      });
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
