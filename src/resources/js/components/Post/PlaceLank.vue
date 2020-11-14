<template>
<div class="lanking">
  <h4 class="p-2">最近投稿された地域</h4>
  <div class="lank p-2">
    <div v-for="lank in lanking" :key="lank.id" class="d-flex p-1">
      <p># {{ lank }}</p>
    </div>
  </div>
</div>
</template>

<style lang="scss" scoped>
.lanking {
  background-color: rgba(0,0,0,0.1);
  .lank {
    background-color: rgba(0,0,0,0.1);
    p {
      font-size: 17px;
    }
  }
}
</style>

<script>
export default {
  props: {
    lanking: Array,
  },
  data: function() {
    return {}
  },
  methods: {},
  mounted() {}
}
</script>
