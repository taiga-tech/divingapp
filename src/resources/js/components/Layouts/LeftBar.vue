<template>
<div class="d-flex flex-column h-100 justify-content-between">
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
      <router-link v-if="profile[0]" class="link" v-bind:to="'/profiles/' + profile[0].id">
        <div class="d-flex">
          <div class="icon"><i class="far fa-user"></i></div>
          <div class="d-md-none d-xl-block col-xl-8">プロフィール</div>
        </div>
      </router-link>
      <router-link v-else class="link" v-bind:to="{name: 'profiles.create'}">
        <div class="d-flex">
          <div class="icon"><i class="far fa-id-card"></i></div>
          <div class="d-md-none d-xl-block col-xl-8">プロフィール作成</div>
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

  <div class="bottom">
    <div v-if="isLogin">
      <router-link v-if="profile[0]" class="link" v-bind:to="'/profiles/' + profile[0].id">
        <div class="d-flex">
          <div class="iocn">
            <img
              v-if="profile[0].image"
              class="rounded-circle"
              v-bind:src="'/storage/images/' + profile[0].image"
              >
          </div>
          <div class="d-md-none d-xl-block mx-4">
            {{ profile[0].name }} {{ user.userid }}
          </div>
        </div>
      </router-link>
      <router-link v-else class="link" v-bind:to="{ name: 'profiles.create' }">
        <div class="d-flex">
          <div class="icon"><i class="far fa-id-card"></i></div>
          <div class="d-md-none d-xl-block col-xl-8">プロフィール作成</div>
        </div>
      </router-link>
    </div>

    <div v-if="isLogin">
      <a href="#" v-on:click="logout" class="d-flex link">
        <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
        <div class="d-md-none d-xl-block col-xl-8" >ログアウト</div>
      </a>
    </div>

  </div>
</div>
</template>

<style lang="scss" scoped>
.router-link-active { color: #3490dc; }
a { text-decoration: none; }
</style>

<script>
export default {
  data: function () {
    return {}
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout');
      await this.$store.dispatch('profile/logoutProfile');
      this.$router.push('/login');
    },
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    user () {
      return this.$store.getters['auth/user']
    },
    profile () {
      return this.$store.getters['profile/profile']
    }
  }
}
</script>
