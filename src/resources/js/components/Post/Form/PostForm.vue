<template>
<div class="Form">
  <h4 class="text-center pt-3">{{ info.title }}</h4>
  <div class="card-body">
    <form v-on:submit.prevent="submit">
      <text-image />
      <place />
      <div class="">
        <button
          type="submit"
          :disabled="!post.text && !images"
          class="btn btn-primary w-100"
        >{{ info.button }}</button>
      </div>
    </form>
  </div>
</div>
</template>

<script>
import TextImage from './TextImage';
import Place from './Place';
export default {
  props: {
    info: Object,
    postId: NaN,
  },
  data: function () {
    return {
      post: { text: '', latlng: null },
      images: null,
      previews: [],
      postImages: null,
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
      if (this.post.place) {
        formData.append('place', this.post.place)
      }
      if (this.post.text) {
        formData.append('text', this.post.text)
      }
      if (this.$route.name == 'posts.create') {
        await axios.post('/api/posts', formData)
      } else if (this.$route.name == 'posts.edit') {
        await axios.post(`/api/posts/${this.post.id}`, formData,  {
          headers: { 'X-HTTP-Method-Override': 'PUT' }
        });
      }
      this.$router.push('/');
    },
    getPost() {
    if (this.$route.name == 'posts.edit') {
        axios.get('/api/posts/' + this.postId)
        .then((res) => {
          this.post = res.data;
          this.postImages = res.data.images;
          for (var i = 0; i < this.postImages.length; i++) {
            this.previews.push(`/storage/images/${this.postImages[i].path}`);
          }
        });
      }
    },
  },
  mounted() {
    if (this.$route.name == 'posts.edit') {
      this.getPost();
    }
  },
  components: {
    TextImage,
    Place,
  }
}
</script>
