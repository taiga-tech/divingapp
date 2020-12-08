<template>
<div>
  <div class="Form border-bottom d-flex" style="position: relative;">
    <div class="formBlock d-flex align-items-center justify-content-center" style="width:40px;height:40px">
      <img :src="profile.image" class="rounded-circle" style="width:30px;height:30px">
    </div>
    <contenteditable
      tag="div"
      v-model.trim="comment.content"
      class="formBlock placecholder w-100 p-2 dark:text-gray-400"
      style="outline:none;"
      placeholder="コメント"
    />
    <div v-on:click="submit" class="commentSubmit">
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
      comment: { content: null },
    }
  },
  methods: {
    async submit() {
      this.comment = { content: this.comment.content, post_id: this.postId }
      if (this.comment.content) {
        const response = await axios.post('/api/comments', this.comment)
        await this.$parent.comments.push(response.data)
        this.comment.content = null
      } else {
        this.comment.content = null
      }
    },
  },
  computed: {
    profile () {
      return this.$store.getters['profile/profile'][0]
    }
  }
}
</script>
