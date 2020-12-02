<template>
<div class="mb-4 w-100">

  <span v-if="postImages.length != 0">
    <span v-for="(image, index) in postImages" :key="index" style="position:relative">
      <img
        :src="image.path"
        style="width:32%"
      >
      <i
        v-on:click="removePostImage(index, image.id)"
        class="far fa-times-circle"
        style="position:absolute;right:0"
      ></i>
    </span>
  </span>

  <span v-if="previews.lenght != 0">
    <span v-for="(preview, index) in previews" :key="index" style="position:relative">
      <img
        :src="preview"
        style="width:32%"
      >
      <i
        class="far fa-times-circle"
        v-on:click="removeImage(index)"
        style="position:absolute;right:0"
      ></i>
    </span>
  </span>

</div>
</template>

<script>
export default {
  props: {
    images: Array,
    previews: Array,
    postImages: Array,
  },
  methods: {
    async removeImage(e) {
      this.previews.splice(e, 1)
      this.images.splice(e, 1)
    },
    async removePostImage(index, id) {
      if (this.$route.name == 'posts.edit') {
        this.postImages.splice(index, 1)
        await axios.delete(`/api/imagedestroy/${id}`)
      }
    },
  }
}
</script>
