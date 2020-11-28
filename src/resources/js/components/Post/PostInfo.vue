<template>
<div v-if="post" class="mt-2 d-flex justify-content-between">
  <div style="user-select: none;">
    <i v-on:click="good" class="far fa-thumbs-up mx-2"> {{ goods.length }}</i>
    <i class="far fa-comment-alt"> {{ comments.length }}</i>
  </div>
  <p>{{ post.created_at }}</p>
</div>
</template>

<script>
export default {
  props: {
    post: Object,
    goods: Array,
    comments: Array,
  },
  methods: {
    async good() {
      if (this.isLogin) {
        this.goods.push(1)
      } else {
        this.$router.push({ name: 'auth.login' })
      }
    },
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
  },
}
</script>
