<template>
<div>
  <comment-form v-if="isLogin" :postId="postId" />
  <div v-if="comments.length != 0">
    <comment-content
      v-for="(comment, index) in comments"
      :key="index"
      :comment="comment"
    />
  </div>
</div>
</template>

<script>
import CommentContent from './CommentContent.vue'
import CommentForm from './CommentForm.vue'
export default {
  props: {
    postId: NaN,
    comments: Array,
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
  },
  components: {
    CommentForm,
    CommentContent,
  }
}
</script>
