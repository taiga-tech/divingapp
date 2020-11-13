<template>
<div class="Form" v-on:keydown.prevent.meta.enter="$refs.submit.click()">
  <h4 class="text-center pt-3">新規投稿</h4>

  <div class="card-body">
    <form v-on:submit.prevent="submit">

      <text-image />
      <place />

      <div class="">
        <button
          type="submit"
          ref="submit"
          :disabled="!post.text && !images"
          class="btn btn-primary w-100"
        >投稿</button>
      </div>

    </form>
  </div>
</div>
</template>

<script>
import TextImage from './TextImage';
import Place from './Place';
export default {
  data: function () {
    return {
      post: { text: '', latlng: null },
      images: null,
      previews: [],
    }
  },
  methods: {
    async submit() {
      const formData = new FormData();
      if (this.images) {
        for (var i = 0; i < this.images.length; i++) {
          formData.append(`files[${i}][image]`, this.images[i])
        }
      }
      if (this.post.latlng) {
        formData.append('lat', this.post.latlng.lat)
        formData.append('lng', this.post.latlng.lng)
      }
      if (this.place) {
        formData.append('place', this.post.place)
      }
      if (this.post.text) {
        formData.append('text', this.post.text)
      }
      await axios.post('/api/posts', formData)
      this.$router.push('/');
    },
  },
  mounted() {},
  components: {
    TextImage,
    Place,
  }
}
</script>
