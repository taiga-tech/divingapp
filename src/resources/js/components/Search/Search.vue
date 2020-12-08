<template>
<div>
  <div class="tab text-center d-flex w-100 mb-2 justify-content-around">
    <div class="w-100" v-on:click="select('post', 'text')">
      投稿<div v-show="selected.query == 'text'" class="borderBottom"></div>
    </div>
    <div class="w-100" v-on:click="select('post', 'place')">
      場所<div v-show="selected.query == 'place'" class="borderBottom"></div>
    </div>
    <div class="w-100" v-on:click="select('profile', 'name')">
      プロフィール<div v-show="selected.query == 'name'" class="borderBottom"></div>
    </div>
  </div>
  <form class="search" v-on:submit.prevent="search">
    <input type="search" v-model.trim="keyword[selected.query]" class="w-100 pl-2 pr-5 dark:text-gray-400" placeholder="キーワード検索">
    <span class="searchIcon rounded-circle">
      <i v-on:click.prevent="search" class="fas fa-search"></i>
    </span>
  </form>
</div>
</template>

<script>
export default {
  data: function () {
    return {
      show: false,
      selected: {
        params: 'post',
        query: 'text',
      },
      keyword: {},
    }
  },
  methods: {
    select(p, q) {
      this.keyword = {}
      this.selected.params = p
      this.selected.query = q
    },
    async search() {
      this.reset()
      if (Object.keys(this.keyword).length != 0){
        this.$router.push({
          name: 'search.index',
          params: { params: this.selected.params },
          query: this.keyword
        })
      }
      if (this.$route.query) {
        const params = this.$route.params.params
        this.$wait.start('loading')
        const response = await axios.get(
          `/api/search/${params}`, { params: this.$route.query }
        )
        if (params == 'post') {
          this.$parent.posts = response.data.reverse()
        } else if (params == 'profile') {
          this.$parent.profiles = response.data
        }
        this.$wait.end('loading')
      }
    },
    reset() {
      this.$parent.posts = []
      this.$parent.users = []
      this.$parent.profiles = []
    },
  },
  mounted() {
    this.search()
  },
}
</script>
