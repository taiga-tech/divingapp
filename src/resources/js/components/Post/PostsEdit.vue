<template>
<div class="Form">
  <h4 class="text-center pt-3">新規投稿</h4>

  <div class="card-body">
    <form v-on:submit.prevent="submit">

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span class="">place</span>
        </div>
        <div class="">
          <input type="text" id="place" class="w-100 px-2 dark:text-gray-400" v-model="post.place">
        </div>
      </div>

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span class="">text</span>
        </div>
        <div class="text">
          <textarea id="text" class="w-100 px-2 dark:text-gray-400" rows="5" required v-model="post.text"></textarea>
          <div class="postImage" v-on:click="fileOpen">
            <i class="fas fa-camera"></i>
            <input v-on:change="fileChange" type="file" id="file" hidden multiple>
          </div>
          <span class="invalid-feedback" role="alert">
            <!-- <strong>{{ message }}</strong> -->
          </span>
        </div>
      </div>

      <div class="mb-3 w-100" v-if="previews">
        <img v-for="preview in previews" :key="preview.index" :src="preview" class="w-50">
        <!-- <div v-for="image in postImages" :key="image.id" v-on:click="removeImg(image.id)">×[{{ image.id }}]</div> -->
      </div>

      <div class="">
        <button type="submit" class="btn btn-primary w-100">投稿</button>
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
export default {
  props: {
    postId: NaN
  },
  data: function () {
    return {
      post: {
        place: '',
      },
      images: null,
      postImages: null,
      previews: [],
    }
  },
  methods: {
    fileOpen () {
      let file = document.getElementById('file');
      file.click();
    },
    getPost() {
      axios.get('/api/posts/' + this.postId)
      .then((res) => {
        this.post = res.data;
        this.postImages = res.data.images;
        for (var i = 0; i < res.data.images.length; i++) {
          this.previews.push(`/storage/images/${res.data.images[i].path}`);
        }
      });
    },
    fileChange (event) {
      const fileList = event.target.files
      if (fileList.length == 0) {
        this.reset();
        return false;
      }
      for (var i = 0; i < fileList.length; i++) {
        if (! fileList[i].type.match('image.*')) {
          this.reset();
          return false;
        }
        const reader = new FileReader()
        reader.onload = e => {
          this.previews.push(e.target.result);
        }
        reader.readAsDataURL(fileList[i])
      }
      this.images = fileList;
    },
    reset() {
      this.previews = [];
      this.images = null;
      this.$el.querySelector('input[type="file"]').value = null;
    },
    async removeImg(e) {
      await axios.delete(`/api/imagedestroy/${e}`)
    },
    async submit() {
      const formData = new FormData();
      if (this.images) {
        for (var i = 0; i < this.images.length; i++) {
          formData.append(`files[${i}][image]`, this.images[i])
        }
      }
      formData.append('text', this.post.text);
      formData.append('place', this.post.place);
      await axios.post(`/api/posts/${this.post.id}`, formData,  {
        headers: { 'X-HTTP-Method-Override': 'PUT' }
      });
      this.$router.push('/');
    }
  },
  mounted() {
    this.getPost();
    this.images;
  }
}
</script>
