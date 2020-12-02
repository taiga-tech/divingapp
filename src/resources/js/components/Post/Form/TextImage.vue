<template>
<div class="formBlock mb-3 w-100 textbox">

  <div class="pb-3" style="min-height: 300px">
    <contenteditable
      tag="div"
      v-model.trim="$parent.post.text"
      class="textbox w-100 p-2 dark:text-gray-400"
    />

    <image-previews
      :previews="$parent.previews"
      :postImages="$parent.postImages"
      :images="$parent.images"
    />

    <div class="postImage" v-on:click="fileOpen">
      <i class="fas fa-camera"></i>
      <input
        id="file"
        type="file"
        v-on:change="fileChange"
        hidden
        multiple
        accept="image/*"
      >
    </div>
  </div>

  <div class="borderBottom"></div>

</div>
</template>

<script>
import ImagePreviews from './ImagePreviews'

export default {
  props: {
    v: Object,
  },
  methods: {
    async fileOpen () {
      const file = document.getElementById('file')
      file.click()
    },
    async fileChange (event) {
      const fileList = event.target.files
      if ((fileList.length + this.$parent.postImages.length) > this.v.images.$params.maxLength.max) {
        this.reset()
        alert(`画像は最大${ this.v.images.$params.maxLength.max }枚までです`)
        return false
      }
      for (var i = 0; i < fileList.length; i++) {
        if (! fileList[i].type.match('image.*')) {
          this.reset()
          return false
        }
        const reader = new FileReader()
        reader.onload = e => {
          this.$parent.previews.push(e.target.result)
        }
        reader.readAsDataURL(fileList[i])
      }
      if (fileList.length != 0) {
        this.$parent.previews = []
        this.$parent.images = Array.from(fileList)
      }
    },
    async reset() {
      this.$parent.previews = []
      this.$parent.images = null
      this.$el.querySelector('input[type="file"]').value = null
    },
  },
  components: {
    ImagePreviews,
  }
}
</script>
