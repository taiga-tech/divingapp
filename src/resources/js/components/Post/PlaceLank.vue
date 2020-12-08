<template>
<div class="lanking">
  <h5 class="p-2">最近投稿された地域</h5>
  <div class="lank p-2">
    <div v-for="(lank, index) in lanking" :key="index" class="d-flex p-1">
      <p v-on:click="pushPost(index)"># {{ lank.place }}</p>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: {
    lanking: Array,
  },
  methods: {
    async pushPost(i) {
      this.$router.push({
        name: 'posts.show',
        params: { postId: this.lanking[i].id }
      })
    }
  },
}
</script>
