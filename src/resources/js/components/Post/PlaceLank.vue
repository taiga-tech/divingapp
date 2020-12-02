<template>
<div class="lanking">
  <h4 class="p-2">最近投稿された地域</h4>
  <div class="lank p-2">
    <div v-for="(lank, index) in lanking" :key="index" class="d-flex p-1">
      <p v-on:click="pushSearch(index)"># {{ lank }}</p>
    </div>
  </div>
</div>
</template>

<style lang="scss" scoped>
.lanking {
  p {
    &:hover {
      opacity:0.6;
      cursor: pointer;
    }
  }
}
</style>

<script>
export default {
  props: {
    lanking: Array,
  },
  methods: {
    async pushSearch(i) {
      this.$router.push({
        name: 'search.index',
        params: { params: 'post' },
        query: { place: this.lanking[i] }
      })
    }
  },
}
</script>
