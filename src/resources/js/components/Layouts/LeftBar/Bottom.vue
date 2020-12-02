<template>
<div class="bottom">
  <div v-if="profile" class="d-flex justify-content-between link-p">
    <div v-on:click="pushProfile" class="d-flex">
      <div class="iocn d-flex flex-wrap align-content-center">
        <div><img v-if="profile.image" :src="profile.image" class="rounded-circle mr-md-2"></div>
      </div>
      <span class="d-md-none d-xl-block mx-4">
        <span>{{ profile.name }}</span><br>
        <span class="opa">{{ user.userid }}</span>
      </span>
    </div>

    <div v-on:click="open = !open" style="line-height: 50px;" class="d-md-none d-xl-block mr-3">
      <i class="fas" :class="{ 'fa-chevron-up': !open, 'fa-chevron-down': open }"></i>
    </div>
  </div>

  <div v-show="open">
    <div v-on:click="logout" class="d-flex">
      <div class="d-flex link">
        <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
        <div class="d-md-none d-xl-block col-xl-9">ログアウト</div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: {
    profile: Object,
    user: Object,
  },
  data: function() {
    return {
      open: false,
    }
  },
  methods: {
    async pushProfile() {
      if (this.$route.name != 'profiles.show') {
        this.$router.push(
          { name: 'profiles.show', params: { profileId: this.profile.id } }
        )
      }
    },
    async logout () {
      await this.$store.dispatch('auth/logout');
      await this.$store.dispatch('profile/logoutProfile');
      this.$router.push('/login');
    },
  },
}
</script>
