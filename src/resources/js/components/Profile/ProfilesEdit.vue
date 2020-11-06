  <template>
<div class="Form">
  <h4 class="text-center pt-3">プロフィール編集</h4>

  <div class="card-body">
    <form v-on:submit.prevent="submit" enctype="multipart/form-data">

      <div class="d-flex justify-content-between mb-3 w-100">
        <div v-on:click="fileOpen" class="preview rounded-circle d-flex align-items-center justify-content-center">
          <img v-if="preview" class="rounded-circle" :src="preview">
          <div v-else>
            <i class="fas fa-camera"></i>
          </div>
          <input v-on:change="fileChange" type="file" id="file"  hidden>
        </div>

        <div class="formBlock" style="width: calc(100% - 63px)">
          <div class="label px-1">
            <span>ユーザネーム</span>
          </div>
          <div class="">
            <input type="text" name="name" class="w-100 dark:text-gray-400" required v-model="profile.name">
              <span class="invalid-feedback" role="alert">
                <!-- <strong>{{ message }}</strong> -->
              </span>
          </div>
        </div>
      </div>

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span>ひとこと</span>
        </div>
        <div class="">
          <textarea name="comment" class="w-100 dark:text-gray-400" rows="5" v-model="profile.comment"></textarea>
        </div>
      </div>

      <div class="">
        <button type="submit" class="btn btn-primary w-100">登録</button>
      </div>

    </form>
  </div>
</div>
</template>

<style>
.preview {
  background-color: #ffffff0a;
  font-size: 20px;
  width: 58px;
  height: 58px;
}
.preview:hover {
  background-color: #ffffff28;
}
.preview img {
  width: 58px;
  height: 58px;
}
</style>

<script>
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
        this.profile = res.data;
        this.preview = `/storage/images/${res.data.image}`
      });
    },
    fileOpen () {
      let file = document.getElementById('file');
      file.click();
    },
    fileChange (event) {
      if (event.target.files.length === 0) {
        this.reset()
        return false
      }
      if (! event.target.files[0].type.match('image.*')) {
        this.reset()
        return false
      }
      const reader = new FileReader()
      reader.onload = e => {
        this.preview = e.target.result
      }
      reader.readAsDataURL(event.target.files[0])
      this.profile.image = event.target.files[0]
    },
    reset () {
      this.preview = ''
      this.profile.image = null
      this.$el.querySelector('input[type="file"]').value = null
    },
    async submit () {
      const formData = new FormData();
      formData.append('image', this.profile.image);
      formData.append('name', this.profile.name);
      formData.append('comment', this.profile.comment);
      await this.$store.dispatch('profile/update', {profileId: this.profile.id, data: formData});
      this.$router.push(`/profiles/${this.profile.id}`);
    },
  },
  mounted () {
    this.getProfile();
  },
  computed: {
    user () {
      return this.$store.getters['auth/user']
    },
  }
}
</script>
