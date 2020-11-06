<template>
  <div>
    <div class="w-100">
      <input type="text">
      <button v-on:click="search">検索</button>
    </div>
    <div class="mt-5" style="height:500px; background-color:gray;"></div>
  </div>
</template>

<script>
export default {
  methods: {
    search() {
      this.$router.push('/search')
    },
  }
}
</script>
