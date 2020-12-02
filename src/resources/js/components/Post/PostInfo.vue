<template>
<div v-if="post" class="mt-2 d-flex">
  <div class="infoLeft" style="user-select: none;">
    <i v-on:click="good" class="far fa-thumbs-up mx-2"> {{ goods.length }}</i>
    <i class="far fa-comment-alt"> {{ comments.length }}</i>
  </div>

  <p
    v-on="$route.name != 'posts.show' ? { click: $parent.pushPost } : {}"
    class="infoRight text-right opa"
  >
    {{ post.updated_at | moment }}
  </p>
</div>
</template>

<style lang="scss" scoped>
.infoLeft {
  width: 78px;
}
.infoRight {
  width: calc(100% - 78px);
}
</style>

<script>
import moment from 'moment';

export default {
  props: {
    post: Object,
    goods: Array,
    comments: Array,
  },
  methods: {
    async good() {
      if (this.isLogin) {
        this.goods.push(1)
      } else {
        this.$router.push({ name: 'auth.login' })
      }
    },
  },
  filters: {
    moment: function (data) {
      moment.locale('ja')
      return moment(data).fromNow()
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
  },
}
</script>
