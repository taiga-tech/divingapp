<template>
<div class="top">
  <router-link class="link" to="/" exact>
    <div class="d-flex">
      <div class="icon"><i class="fas fa-home"></i></div>
      <div class="d-md-none d-xl-block col-xl-8">ホーム</div>
    </div>
  </router-link>

  <router-link class="link" v-bind:to="{name: 'posts.create'}">
    <div class="d-flex">
      <div class="icon"><i class="fas fa-plus"></i></div>
      <div class="d-md-none d-xl-block col-xl-8">新規作成</div>
    </div>
  </router-link>

  <router-link class="link" v-bind:to="{ name: 'search' }">
    <div class="d-flex">
      <div class="icon"><i class="fas fa-search"></i></div>
      <div class="d-md-none d-xl-block col-xl-8">検索</div>
    </div>
  </router-link>

  <div v-if="isLogin">
    <router-link v-if="profile" class="link" v-bind:to="'/profiles/' + profile.id">
      <div class="d-flex">
        <div class="icon"><i class="far fa-user"></i></div>
        <div class="d-md-none d-xl-block col-xl-8">プロフィール</div>
      </div>
    </router-link>
  </div>

  <div v-else>
    <router-link class="link" v-bind:to="{name: 'auth.login'}">
      <div class="d-flex">
        <div class="icon"><i class="fas fa-sign-in-alt"></i></div>
        <div class="d-md-none d-xl-block col-xl-8">ログイン</div>
      </div>
    </router-link>
    <router-link class="link" v-bind:to="{name: 'auth.register'}">
      <div class="d-flex">
        <div class="icon"><i class="fas fa-user-plus"></i></div>
        <div class="d-md-none d-xl-block col-xl-8">新規登録</div>
      </div>
    </router-link>
  </div>
</div>
</template>

<style lang="scss" scoped>
.router-link-active { color: #3490dc; }
a { text-decoration: none; }
</style>  

<script>
export default {
  props: {
    isLogin: Boolean,
    profile: Object,
  }
}
</script>
