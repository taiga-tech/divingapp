<template>
<div class="Form">
  <h4 class="text-center pt-3">プロフィール編集</h4>
  <div class="card-body">
    <form v-on:submit.prevent="submit" enctype="multipart/form-data">

      <profile-form :v="$v" />

      <button type="submit" :disabled="$v.$invalid" class="btn btn-primary w-100">編集</button>

    </form>
  </div>
</div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import ProfileForm from './ProfileForm';

export default {
  props: {
    profileId: NaN
  },
  data: function () {
    return {
      profile: {
        comment: '',
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
  validations: {
    profile: {
      name: {
        required,
      }
    }
  },
  computed: {
    user () {
      return this.$store.getters['auth/user']
    },
  }
}
</script>
