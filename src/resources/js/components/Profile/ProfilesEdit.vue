<template>
<div class="Form">
  <h4 class="text-center pt-3">プロフィール編集</h4>
  <div class="card-body">
    <form v-on:submit.prevent="submit" enctype="multipart/form-data">
      <profile-form />
      <div class="">
        <button type="submit" :disabled="!profile.name" class="btn btn-primary w-100">編集</button>
      </div>
    </form>
  </div>
</div>
</template>

<script>
import ProfileForm from './ProfileForm.vue';
export default {
  props: {
    profileId: NaN
  },
  data: function () {
    return {
      profile: {
        comment: ' ',
      },
      preview: null,
    }
  },
  methods: {
    getProfile () {
      axios.get('/api/profiles/' + this.profileId)
      .then((res) => {
        this.profile = res.data[0];
        this.preview = this.profile.image
      });
    },
    async submit () {
      const formData = new FormData();
      formData.append('image', this.profile.image);
      formData.append('name', this.profile.name);
      if (this.profile.comment) {
        formData.append('comment', this.profile.comment);
      }
      await this.$store.dispatch('profile/update', {profileId: this.profile.id, data: formData});
      this.$router.push(`/profiles/${this.profile.id}`);
    },
  },
  mounted () {
    this.getProfile();
  },
  components: {
    ProfileForm,
  },
  computed: {
    user () {
      return this.$store.getters['auth/user']
    },
  }
}
</script>
