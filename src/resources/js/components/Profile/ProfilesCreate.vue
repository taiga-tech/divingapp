<template>
<div class="Form">
  <h4 class="text-center pt-3">プロフィール登録</h4>
  <div class="card-body">
    <form v-on:submit.prevent="submit" enctype="multipart/form-data">
      <profile-form />
      <button type="submit" :disabled="!profile.name" class="btn btn-primary w-100">登録</button>
    </form>
  </div>
</div>
</template>

<script>
import ProfileForm from './ProfileForm.vue';
export default {
  components: { ProfileForm },
  data: function () {
    return {
      profile: {
        name: this.$store.getters['auth/user'].userid.replace('@',""),
        comment: ' ',
      },
      preview: null,
    }
  },
  methods: {
    async submit () {
      const formData = new FormData();
      formData.append('image', this.profile.image);
      formData.append('name', this.profile.name);
      if (this.profile.comment) {
        formData.append('comment', this.profile.comment);
      }
      await this.$store.dispatch('profile/create', formData);
      this.$router.push('/');
    },
  },
  computed: {
    user () {
      return this.$store.getters['auth/user']
    },
  },
  components: {
    ProfileForm,
  },
}
</script>
