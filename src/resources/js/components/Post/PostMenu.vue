<template>
<div>
  <span v-on:click="$router.push({ name: 'posts.edit', params: postId })">edit</span>
  <button v-on:click="postDelete">delete</button>
</div>
</template>

<style lang="sass" scoped>

</style>

<script>
export default {
  props: {
    postId: NaN,
  },
  methods: {
    async postDelete() {
      await axios.delete('/api/posts/' + this.postId)
      this.$router.push('/')
    },
  },
}
</script>
