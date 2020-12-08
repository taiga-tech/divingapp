<template>
<div class="menuTorigger">
  <i @click.stop v-on:click="open = !open" class="fas fa-ellipsis-h"></i>
  <ul v-show="open" class="Menu border text-center dark:bg-gray-900 light:bg">
    <li @click.stop v-on:click="$router.push({ name: 'posts.edit', params: { postId: postId} })">編集</li>
    <li @click.stop v-on:click="removePost(index)">削除</li>
    <li @click.stop v-on:click="closeMenu" class="error">キャンセル</li>
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
    async removePost(e) {
      if (confirm('本当に削除しますか？')) {
        await axios.delete('/api/posts/' + this.postId)
        if (this.$route.name == 'posts.show') {
          this.$router.push('/')
        } else {
          this.$emit('removePost', e)
        }
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
