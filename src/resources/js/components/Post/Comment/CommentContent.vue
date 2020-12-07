<template>
<div class="d-flex justify-content-between border-bottom p-2">
  <div class="d-flex">
    <div class="mr-2" v-on:click="$router.push({ name: 'profiles.show', params: { profileId: comment.profile.id } } )">
      <img :src="comment.profile.image" class="rounded-circle border text-center" style="width: 40px; height: 40px">
    </div>
    <div>
      <div class="d-flex">
        <p>{{ comment.profile.name }}</p>
        <p class="ml-1 opa">{{ comment.user.userid }}</p>
        <p class="ml-1 opa">・{{ comment.created_at | moment }}</p>
      </div>
      <div class="textArea mt-1">{{ comment.content }}</div>
    </div>
  </div>
  <comment-menu
    v-if="comment.user.id == user.id"
    :commentId="comment.id"
    :index="index"
    v-on:removeComment="removeComment"
  />
</div>
</template>

<script>
import moment from 'moment';
import CommentMenu from './CommentMenu';

export default {
  props: {
    comment: Object,
    index: NaN,
  },
  filters: {
    moment: function (data) {
      moment.locale('ja')
      return moment(data).fromNow()
    }
  },
  methods: {
    async removeComment(e) {
      this.$emit('removeComment', e)
    }
  },
  computed: {
    user() {
      return this.$store.getters['auth/user']
    },
  },
  components: {
    CommentMenu,
  }
}
</script>
