<template>
<div style="background-color:rgba(0,0,0,0.1);">
  <div class="border-bottom d-flex" style="position: relative;">
    <contenteditable
      tag="div"
      v-model="text"
      class="commentField w-100 p-2 dark:text-gray-400"
    />
    <div v-on:click="submit" type="submit" class="commentSubmit">
      <i class="fas fa-paper-plane"></i>
    </div>
  </div>
</div>
</template>

<style lang="scss" scoped>
.commentField {
  outline:none;
}
.commentSubmit {
  position: absolute;
  bottom:0;
  right: 0;
  line-height: 40px;
  width: 40px;
  text-align: center;
}
</style>

<script>
export default {
  props: {
    postId: NaN,
  },
  data: function() {
    return {
      text: null,
    }
  },
  methods: {
    async submit() {
      if (this.text) {
        this.$parent.comments.push(this.text)
        this.text = null
      }
      // サーバー後に実装
      // if (this.comment.text) {
        // const response = await axios('comment_store_url', this.text)
        // this.$parent.comments.push(response.data)
      // }
    },
  },
}
</script>
