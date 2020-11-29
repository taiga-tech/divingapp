<template>
<div>
  <div class="d-flex justify-content-between mb-3 w-100">
    <div v-on:click="fileOpen" class="preview rounded-circle d-flex align-items-center justify-content-center">
      <img v-if="$parent.preview" class="rounded-circle" :src="$parent.preview">
      <div v-else><i class="fas fa-camera"></i></div>
      <input v-on:change="fileChange" type="file" id="file" hidden>
    </div>

    <div class="formBlock" style="width: calc(100% - 63px)">
      <div class="label px-1">
        <span>ユーザネーム</span>
      </div>
      <div class="">
        <input
          type="text"
          name="name"
          class="px-2 w-100 dark:text-gray-400"
          required v-model="$parent.profile.name">
      </div>
    </div>
  </div>

  <div class="formBlock mb-3 w-100">
    <div class="label px-1">
      <span>ひとこと</span>
    </div>
    <div class="">
      <textarea
        name="comment"
        rows="5"
        v-model="$parent.profile.comment"
        class="px-2 w-100 dark:text-gray-400"
        ></textarea>
    </div>
  </div>
</div>
</template>

<script>
export default {
  methods: {
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
        this.$parent.preview = e.target.result
      }
      reader.readAsDataURL(event.target.files[0])
      this.$parent.profile.image = event.target.files[0]
    },
    reset () {
      this.$parent.preview = ''
      this.$parent.profile.image = null
      this.$el.querySelector('input[type="file"]').value = null
    },
  }
}
</script>
