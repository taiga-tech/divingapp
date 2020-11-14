<template>
<div class="">
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
    <input class="w-100 pl-2 pr-5" type="search" placeholder="キーワード検索" v-model="keyword[selected.query]">
    <span class="searchIcon rounded-circle">
      <i v-on:click.prevent="search" class="fas fa-search"></i>
    </span>
  </form>
</div>
</template>

<style lang="scss">
.tab {
  line-height: 30px;
  div {
    font-weight: 600;
    // &:hover {
    //   // opacity: .6;
    // }
  }
}
.search {
  position: relative;
  input {
    background: rgba(0, 0, 0, 0.1);
    height: 40px;
    outline: none;
    color: white;
    font-size: 16px;
  }
  .searchIcon {
    position: absolute;
    right: 0;
    top: 0;
    line-height: 40px;
    padding: 0 10px;
    font-size: 20px;
    &:hover {
      cursor: pointer;
      background-color: rgba(255,255,255,0.1);
    }
  }
}
</style>

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
          params: {params: this.selected.params},
          query: this.keyword
        })
      }
      if (this.$route.query) {
        const params = this.$route.params.params
        const response = await axios.get(`/api/search/${params}`, { params: this.$route.query })
        if (params == 'post') {
          this.$parent.posts = response.data.reverse()
        } else if (params == 'profile') {
          this.$parent.profiles = response.data
        }
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
