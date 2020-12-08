<template>
<post-form :info="info" :postId="postId"/>
</template>

<script>
import PostForm from './Form/PostForm';

export default {
  props: {
    postId: NaN
  },
  data: function () {
    return {
      info: {
        title: '投稿編集',
        button: '編集'
      },
    }
  },
  components: {
    PostForm,
  }
}
</script>
