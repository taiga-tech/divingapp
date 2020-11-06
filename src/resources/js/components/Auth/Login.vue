<template>

<div class="Form">
  <h4 class="text-center pt-3">ログイン</h4>

  <div class="card-body">
    <form v-on:submit.prevent="submit">

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span class="">メールアドレス</span>
        </div>
        <div class="">
          <input id="email" type="email" class="@error('email') is-invalid @enderror w-100 px-2 dark:text-gray-400" name="email" value="" required autocomplete="email" autofocus v-model="user.email">
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
          <input id="password" type="password" class="@error('password') is-invalid @enderror w-100 px-2 dark:text-gray-400 " name="password" required autocomplete="current-password" v-model="user.password">
          <span class="invalid-feedback" role="alert">
            <!-- <strong>{{ message }}</strong> -->
          </span>
        </div>
      </div>

      <!-- <div class="">
        <div class=" offset-md-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
          </div>
        </div>
      </div> -->

      <div class="">
        <button type="submit" class="btn btn-primary w-100">ログイン</button>
        <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
          {{ __('Forgot Your Password?') }}
        </a> -->
      </div>
    </form>
  </div>
</div>

</template>

<script>
export default {
  data: function () {
    return {
      user: {}
    }
  },
  methods: {
    async submit () {
      await this.$store.dispatch('auth/login', this.user)
      this.$router.push('/')
      location.reload();
    },
  }
}
</script>
