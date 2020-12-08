<template>
<post-form :info="info" />
</template>

<script>
import PostForm from './Form/PostForm';

export default {
  data: function () {
    return {
      info: {
        title: '新規投稿',
        button: '投稿'
      }
    }
  },
  components: {
    PostForm,
  }
}
</script>
