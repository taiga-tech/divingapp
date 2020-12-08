<template>
<div class="menuTorigger">
  <i v-on:click="open = !open" class="border rounded-circle p-1 fas fa-ellipsis-h"></i>
  <ul v-show="open" class="Menu border text-center dark:bg-gray-900 light:bg">
    <li v-on:click="$router.push({ name: 'profiles.edit', params: profileId })">プロフィール編集</li>
    <li v-on:click="logout">ログアウト</li>
    <li v-on:click="closeMenu" class="error">キャンセル</li>
  </ul>
</div>
</template>

<script>
export default {
  data: function() {
    return {
      open: false
    }
  },
  methods: {
    async logout() {
      await this.$store.dispatch('auth/logout');
      await this.$store.dispatch('profile/logoutProfile');
      this.$router.push('/login');
    },
    async closeMenu() {
      this.open = false
    }
  },
    watch: {
    open: function(val) {
      if(val) {
        setTimeout(this.closeMenu, 5000);
      }
    },
  }
}
</script>
