<template>
<div class="menuTorigger">
  <i v-on:click="open = !open" class="fas fa-ellipsis-h"></i>
  <ul v-show="open" class="Menu border text-center dark:bg-gray-900">
    <li v-on:click="$router.push({ name: 'posts.edit', params: { postId: postId} })">編集</li>
    <li v-on:click="postDelete(index)">削除</li>
  </ul>
</div>
</template>

<script>
export default {
  props: {
    postId: NaN,
    index: NaN
  },
  data: function() {
    return {
      open: false,
      show: false,
      interactive: false,
    }
  },
  methods: {
    async postDelete(e) {
      if (confirm('本当に削除しますか？')) {
        await axios.delete('/api/posts/' + this.postId)
        if (this.$route.name == 'posts.show') {
          this.$router.push('/')
        } else {
          this.$emit('postDelete', e)
        }
      }
    },
    closeMenu() {
      this.open = false
    },
  },
  watch: {
    open: function(val) {
      if(val == true) {
        setTimeout(this.closeMenu, 5000);
      }
    },
  }
}
</script>
