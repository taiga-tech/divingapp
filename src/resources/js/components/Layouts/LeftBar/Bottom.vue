<template>
<div class="bottom">
  <div>
    <router-link v-if="profile" class="link" v-bind:to="'/profiles/' + profile.id">
      <div class="d-flex">
        <div class="iocn">
          <img
            v-if="profile.image"
            class="rounded-circle"
            :src="profile.image"
          >
        </div>
        <div class="d-md-none d-xl-block mx-4">
          {{ profile.name }} {{ user.userid }}
        </div>
      </div>
    </router-link>
  </div>

  <div>
    <a href="#" v-on:click="logout" class="d-flex link">
      <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
      <div class="d-md-none d-xl-block col-xl-8" >ログアウト</div>
    </a>
  </div>
</div>
</template>


<script>
export default {
  props: {
    profile: Object,
    user: Object,
  },
    methods: {
    async logout () {
      await this.$store.dispatch('auth/logout');
      await this.$store.dispatch('profile/logoutProfile');
      this.$router.push('/login');
    },
  },
}
</script>

