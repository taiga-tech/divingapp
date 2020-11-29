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

<script>
export default {
  props: {
    lanking: Array,
  },
}
</script>
