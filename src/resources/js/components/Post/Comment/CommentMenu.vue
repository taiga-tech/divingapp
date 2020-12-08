<template>
<div class="menuTorigger">
  <i v-on:click="open = !open" class="fas fa-ellipsis-h"></i>
  <ul v-show="open" class="Menu border text-center dark:bg-gray-900 light:bg">
    <li v-on:click="removeComment(index)">削除</li>
    <li v-on:click="closeMenu" class="error">キャンセル</li>
  </ul>
</div>
</template>

<script>
export default {
  props: {
    commentId: NaN,
    index: NaN
  },
  data: function() {
    return {
      open: false,
    }
  },
  methods: {
    async removeComment(e) {
      if (confirm('本当に削除しますか？')) {
        await axios.delete('/api/comments/' + this.commentId)
        await this.$emit('removeComment', e)
      }
    },
    async closeMenu() {
      this.open = false
    },
  },
  watch: {
    open: function(val) {
      if(val) {
        setTimeout(this.closeMenu, 5000);
      }
    },
  }
}
</script>
