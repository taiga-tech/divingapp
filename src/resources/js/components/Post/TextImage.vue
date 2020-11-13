<template>
<div class="formBlock mb-3 w-100 text">
  <div class="pb-3" style="min-height: 300px">
    <contenteditable
      tag="div"
      v-model="$parent.post.text"
      class="textbox w-100 p-2 dark:text-gray-400"
      placeholder="いまどうしてる？"
    />

    <div v-if="$parent.previews" class="mb-4 w-100">
      <img v-for="preview in $parent.previews" :key="preview.index" :src="preview" class="w-25">
      <!-- edit-only -->
      <div v-if="$route.name == 'posts.edit'">
        <div
          v-for="image in $parent.postImages"
          :key="image.id"
          v-on:click="removeImg(image.id)"
        >×[{{ image.id }}]
        </div>
      </div>
    </div>

    <div class="postImage" v-on:click="fileOpen">
      <i class="fas fa-camera"></i>
      <input v-on:change="fileChange" type="file" id="file" hidden multiple>
    </div>

    <!-- <span class="invalid-feedback" role="alert">
      <strong>{{ message }}</strong>
    </span> -->
  </div>

  <div class="borderBottom"></div>
</div>
</template>

<style lang="scss" scoped>
.textbox {
  position: relative;
  outline: none;
  font-size: 20px;
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
  data: function() {
    return {
    }
  },
  methods: {
    fileOpen () {
      let file = document.getElementById('file');
      file.click();
    },
    fileChange (event) {
      const fileList = event.target.files
      if (fileList.length === 0) {
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
          this.$parent.previews.push(e.target.result);
        }
        reader.readAsDataURL(fileList[i])
      }

      if (this.$route.name == 'posts.create') {
        this.$parent.previews = [];
      }
      this.$parent.images = fileList;
    },
    reset() {
      this.$parent.previews = [];
      this.$parent.images = null;
      this.$el.querySelector('input[type="file"]').value = null;
    },
    async removeImg(e) {
      await axios.delete(`/api/imagedestroy/${e}`)
    },
  },
}
</script>
