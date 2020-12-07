<template>
<div v-if="post" class="mt-2 d-flex">
  <div class="infoLeft" style="user-select: none;">

    <i
      v-if="!good"
      v-on:click="addGood"
      class="far fa-thumbs-up mx-2"
    > {{ goodCount }}
    </i>

    <i
      v-if="good"
      v-on:click="unGood(good)"
      class="fas fa-thumbs-up mx-2"
    > {{ goodCount }}
    </i>

    <i class="far fa-comment-alt"> {{ comments.length }}</i>
  </div>

  <p
    v-on="$route.name != 'posts.show' ? { click: $parent.pushPost } : {}"
    class="infoRight text-right opa"
  >
    {{ post.created_at | moment }}
  </p>
</div>
</template>

<style lang="scss" scoped>
.infoLeft {
  width: 100px;
}
.infoRight {
  width: calc(100% - 100px);
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
  data: function() {
    return {
      good: null,
      goodCount: 0,
    }
  },
  methods: {
    async readGood() {
      for (let i = 0; i < this.goods.length; i++) {
        const good = this.goods[i]
        this.goodCount++
        if (this.user.id == good.user_id) {
          this.good = good
        } else {
          this.good = null
        }
      }
    },
    async addGood() {
      if (!this.isLogin){
        this.returnLogin()
        return false
      }

      if (!this.good) {
        this.good = {
          boolean: true,
          post_id: this.post.id,
          user_id: this.user.id,
        }
        if (this.goodCount >= 0) {
          this.goodCount += 1
          const response = await axios.post('/api/goods', this.good)
          this.good = await response.data
        }
      }
    },
    async unGood(e) {
      if (!this.isLogin){
        this.returnLogin()
        return false
      }

      if (this.good) {
        this.good = null
        if (this.goodCount > 0) {
          this.goodCount -= 1
          await axios.delete('/api/goods/' + e.id)
        }
      }
    },

    async returnLogin() {
      if (confirm('ログインが必要です\nログインしますか？')) {
        await this.$router.push({ name: 'auth.login' })
      }
    }
  },
  mounted() {
    this.readGood()
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
    user () {
      return this.$store.getters['auth/user']
    },
  },
}
</script>
