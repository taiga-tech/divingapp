<template>
<div class="mt-5">
  SNSでログインする
  <transition>
    <div class="sosialLogin mt-3">
      <button v-on:click="AuthProvider('facebook')" class="btn btn-outline-primary mr-1">
        <i class="fab fa-facebook-f"> Facebook</i>
      </button>
      <button v-on:click="AuthProvider('google')" class="btn btn-outline-danger">
        <i class="fab  fa-google"> Google</i>
      </button>
    </div>
  </transition>
</div>
</template>

<script>
export default {
  methods: {
    async AuthProvider (provider) {
      var self = this
      const response = await this.$auth.authenticate(provider)
      .catch(err => {
        console.log({ err:err })
      })
      self.SocialLogin(provider, response)
    },
    async SocialLogin (provider, response) {
      await this.$store.dispatch('auth/oauthLogin', { provider, response })
      this.$router.push(`/profiles/create`)
      location.reload()
    },
  }
}
</script>
