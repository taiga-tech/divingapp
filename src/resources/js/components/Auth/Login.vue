<template>
<div class="Form">
  <h4 class="text-center pt-3">ログイン</h4>
  <div class="card-body">
    <form v-on:submit.prevent="submit">

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span>メールアドレス<span> *</span></span>
          <span v-if="$v.user.email.$error" :class="{ 'error': $v.user.email.$error }">
            <span v-if="!$v.user.email.required">メールアドレスは必須項目です</span>
            <span v-if="!$v.user.email.email">有効なメールアドレスを入力してください</span>
          </span>
        </div>

        <div>
          <input
            type="email"
            name="email"
            v-model.trim="user.email"
            @blur="$v.user.email.$touch()"
            required
            autofocus
            autocomplete="email"
            class="w-100 px-2 dark:text-gray-400"
          >
          <div class="borderBottom" :class="{ 'errorBorderBottom': $v.user.email.$error || errors }"></div>
        </div>
      </div>

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span>パスワード<span> *</span></span>
          <span v-if="$v.user.password.$error" :class="{ 'error': $v.user.password.$error }">
            <span v-if="!$v.user.password.required">パスワードは必須項目です</span>
            <span v-if="!$v.user.password.alphaNum">半角英数字で入力してください</span>
            <span v-if="!$v.user.password.minLength">8文字以上で入力してください</span>
          </span>
        </div>

        <div>
          <input
            type="password"
            v-model.trim="user.password"
            @blur="$v.user.password.$touch()"
            autocomplete="current-password"
            class="w-100 px-2 dark:text-gray-400"
          >
          <div class="borderBottom" :class="{ 'errorBorderBottom': $v.user.password.$error || errors }"></div>
        </div>
      </div>

      <button type="submit" :disabled="$v.$invalid" class="btn btn-primary w-100">ログイン</button>

    </form>

    <div class="error mt-3" v-if="errors">
      <strong v-for="(err, index) in errors" :key="index">{{ err }}</strong>
    </div>

    <o-auth />
  </div>
</div>
</template>

<script>
import OAuth from './OAuth';
import { required, alphaNum, email, minLength } from "vuelidate/lib/validators";

export default {
  data: function () {
    return {
      show: false,
      user: {},
      errors: null
    }
  },
  methods: {
    async submit () {
      this.errors = null
      await this.$store.dispatch('auth/login', this.user)
      .catch((error) =>
        this.errors = error.response.data.errors.email
      )
      if (!this.errors) {
        await this.$router.push('/')
        await location.reload()
      }
    },
  },
  validations: {
    user: {
      email: {
        email,
        required,
      },
      password: {
        required,
        alphaNum,
        minLength: minLength(8)
      },
    }
  },
  components: {
    OAuth,
  },
}
</script>
