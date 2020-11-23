<template>
<div class="Form">
  <h4 class="text-center pt-3">新規登録</h4>

  <div class="card-body">
    <form v-on:submit.prevent="submit">

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span class="">ユーザーID</span>
        </div>
        <div>
          <input
            id="userid"
            type="text"
            class="w-100 px-2 @error('userid') is-invalid @enderror dark:text-gray-400"
            required
            autocomplete="userid"
            autofocus
            v-on:input="insertName"
            v-model="user.userid">
          <span class="invalid-feedback" role="alert">
            <!-- <strong>{{ message }}</strong> -->
          </span>
        </div>
      </div>

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span>メールアドレス</span>
        </div>
        <div class="">
          <input
            id="email"
            type="email"
            class="w-100 px-2 @error('email') is-invalid @enderror dark:text-gray-400"
            required autocomplete="email"
            v-model="user.email">
          <span class="invalid-feedback" role="alert">
            <!-- <strong>{{ message }}</strong> -->
          </span>
        </div>
      </div>

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span>パスワード</span>
        </div>
        <div class="">
          <input
            id="password"
            type="password"
            class="w-100 px-2 @error('password') is-invalid @enderror dark:text-gray-400"
            required
            autocomplete="new-password"
            v-model="user.password">
          <span class="invalid-feedback" role="alert">
            <!-- <strong>{{ message }}</strong> -->
          </span>
        </div>
      </div>

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span>確認用パスワード</span>
        </div>
        <div class="">
          <input
            id="password-confirm"
            type="password"
            class="w-100 px-2 dark:text-gray-400"
            required
            autocomplete="new-password"
            v-model="user.password_confirmation">
        </div>
      </div>

      <div class="">
        <button
          type="submit"
          :disabled="
            !user.userid ||
            !user.email ||
            !user.password ||
            !user.password_confirmation"
          class="btn btn-primary w-100"
        >登録</button>
      </div>
    </form>
    <o-auth />
  </div>
</div>
</template>

<script>
import OAuth from './OAuth';
export default {
  data: function () {
    return {
      user: {},
      profile: {},
    }
  },
  methods: {
    insertName() {
      this.profile.name = this.user.userid
      this.profile.image = '/default.png'
    },
    async submit () {
      await this.$store.dispatch('auth/register', this.user);
      await this.$store.dispatch('profile/create', this.profile);
      this.$router.push('/');
    }
  },
  components: {
    OAuth,
  },
}
</script>
