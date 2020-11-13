<template>
<div>
  <post-content v-for="post in posts" :key="post.id" :post="post" />
</div>
</template>

<script>
import PostContent from './PostContent';
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
  },
}
</script>
