<template>
<div class="Form">
  <h4 class="text-center pt-3">新規登録</h4>
  <div class="card-body">
    <form v-on:submit.prevent="submit">

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span>ユーザーID (半角英数)<span> *</span></span>
          <span v-if="$v.user.userid.$error" :class="{ 'error': $v.user.userid.$error }">
            <span v-if="!$v.user.userid.required">ユーザーIDは必須項目です</span>
            <span v-if="!$v.user.userid.alphaNum">半角英数で入力してください</span>
          </span>
        </div>

        <div>
          <input
            type="text"
            name="userid"
            v-model="user.userid"
            @blur="$v.user.userid.$touch()"
            v-on:input="insertName"
            required
            autofocus
            autocomplete="userid"
            class="w-100 px-2 dark:text-gray-400"
          >
          <div class="borderBottom" :class="{ 'errorBorderBottom': $v.user.userid.$error }"></div>
        </div>
      </div>

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
            v-model="user.email"
            @blur="$v.user.email.$touch()"
            required
            utocomplete="email"
            class="w-100 px-2 dark:text-gray-400"
          >
          <div class="borderBottom" :class="{ 'errorBorderBottom': $v.user.email.$error }"></div>
        </div>
      </div>

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span>パスワード (8文字以上 半角英数)<span> *</span></span>
          <span v-if="$v.user.password.$error" :class="{ 'error': $v.user.password.$error }">
            <span v-if="!$v.user.password.required">パスワードは必須項目です</span>
            <span v-if="!$v.user.password.alphaNum">半角英数字で入力してください</span>
            <span v-if="!$v.user.password.minLength">8文字以上で入力してください</span>
          </span>
        </div>

        <div>
          <input
            type="password"
            v-model="user.password"
            @blur="$v.user.password.$touch()"
            autocomplete="new-password"
            class="w-100 px-2 dark:text-gray-400"
          >
          <div class="borderBottom" :class="{ 'errorBorderBottom': $v.user.password.$error }"></div>
        </div>
      </div>

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span>確認用パスワード<span> *</span></span>
          <span
            v-if="$v.user.password_confirmation.$error"
            :class="{ 'error': $v.user.password_confirmation.$error }"
          >
            <span v-if="!$v.user.password_confirmation.sameAs">パスワードが一致しません</span>
          </span>
        </div>

        <div>
          <input
            type="password"
            v-model="user.password_confirmation"
            @blur="$v.user.password_confirmation.$touch()"
            autocomplete="new-password"
            class="w-100 px-2 dark:text-gray-400"
          >
          <div
            class="borderBottom"
            :class="{ 'errorBorderBottom': $v.user.password_confirmation.$error }"
          ></div>
        </div>
      </div>

      <button type="submit" :disabled="$v.$invalid" class="btn btn-primary w-100">登録</button>

    </form>
    <o-auth />
  </div>
</div>
</template>

<script>
import OAuth from './OAuth';
import { required, alphaNum, email, minLength, sameAs } from "vuelidate/lib/validators";

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
    },
  },
  validations: {
    user: {
      userid: {
        required,
        alphaNum,
      },
      email: {
        email,
        required,
      },
      password: {
        required,
        alphaNum,
        minLength: minLength(8)
      },
      password_confirmation: {
        required,
        sameAsPassword: sameAs('password')
      }
    }
  },
  components: {
    OAuth,
  },
}
</script>
