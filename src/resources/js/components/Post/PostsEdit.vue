<template>
<div class="Form">
  <h4 class="text-center pt-3">投稿編集</h4>

  <div class="card-body">
    <form v-on:submit.prevent="submit">

      <text-image />
      <place v-if="post.text || images" />

      <div class="">
        <button
          type="submit"
          :disabled="
            !post.text &&
            !images"
          class="btn btn-primary w-100"
        >編集</button>
      </div>

    </form>
  </div>
</div>
</template>

<style>
.text {
  position: relative;
}
.postImage {
  position: absolute;
  bottom: 0;
  left: 0;
  padding-left: 5px;
  font-size: 20px;
}
</style>

<script>
import TextImage from './TextImage';
import Place from './Place';
export default {
  props: {
    postId: NaN
  },
  data: function () {
    return {
      post: { place: null },
      images: null,
      postImages: null,
      previews: [],
    }
  },
  methods: {
    getPost() {
      axios.get('/api/posts/' + this.postId)
      .then((res) => {
        this.post = res.data;
        this.postImages = res.data.images;
        for (var i = 0; i < this.postImages.length; i++) {
          this.previews.push(`/storage/images/${this.postImages[i].path}`);
        }
      });
    },
    async submit() {
      const formData = new FormData();
      if (this.images) {
        for (var i = 0; i < this.images.length; i++) {
          formData.append(`files[${i}][image]`, this.images[i])
        }
      }
      formData.append('text', this.post.text)
      formData.append('place', this.post.place)
      formData.append('lat', this.post.latlng.lat)
      formData.append('lng', this.post.latlng.lng)
      await axios.post(`/api/posts/${this.post.id}`, formData,  {
        headers: { 'X-HTTP-Method-Override': 'PUT' }
      });
      this.$router.push('/');
    }
  },
  mounted() {
    this.getPost();
  },
  components: {
    TextImage,
    Place,
  }
}
</script>
