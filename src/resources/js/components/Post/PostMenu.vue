<template>
<div class="menuTorigger">
  <i v-on:click="open = !open" class="fas fa-ellipsis-h"></i>
  <ul v-show="open" class="Menu border text-center dark:bg-gray-900">
    <li v-on:click="$router.push({ name: 'posts.edit', params: { postId: postId} })" >編集</li>
    <li v-on:click="postDelete">削除</li>
  </ul>
</div>
</template>

<style lang="scss">
.menuTorigger {
  position: relative;
  .Menu {
    position: absolute;
    top: 1;
    right: 0;
    z-index: 3;
    width: 150px;
    border-radius: 5px;
    li {
      cursor: pointer;
      padding: 5px 0;
      &:hover {
        opacity: 0.7;
      }
    }
  }
}
</style>

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
          this.$emit('postDelete')
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
