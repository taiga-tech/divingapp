<template>
<div style="background-color:rgba(0,0,0,0.1);">
  <div class="border-bottom d-flex" style="position: relative;">
    <div class="d-flex align-items-center justify-content-center" style="width:40px;height:40px">
      <img :src="profile.image" class="rounded-circle" style="width:30px;height:30px">
    </div>
    <contenteditable
      tag="div"
      v-model.trim="text"
      class="placecholder w-100 p-2 dark:text-gray-400"
      style="outline:none;"
      placeholder="コメント"
    />
    <div v-on:click="submit" type="submit" class="commentSubmit">
      <i class="fas fa-paper-plane"></i>
    </div>
  </div>
</div>
</template>

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
  computed: {
    profile () {
      return this.$store.getters['profile/profile'][0]
    }
  }
}
</script>
