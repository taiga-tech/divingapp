<template>
<div class="Form">
  <h4 class="text-center pt-3">新規投稿</h4>

  <div class="card-body">
    <form v-on:submit.prevent="submit">

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span class="">text</span>
        </div>
        <div class="text">
          <textarea id="text" class="w-100 px-2 dark:text-gray-400" rows="5" required v-model="post.text"></textarea>
          <div class="borderBottom"></div>
          <div class="postImage" v-on:click="fileOpen">
            <i class="fas fa-camera"></i>
            <input v-on:change="fileChange" type="file" id="file" hidden multiple>
          </div>
          <span class="invalid-feedback" role="alert">
            <!-- <strong>{{ message }}</strong> -->
          </span>
        </div>
      </div>

      <div class="formBlock mb-3 w-100">
        <div class="label px-1">
          <span class="">place</span>
        </div>
        <div class="">
          <select v-model="pref" v-on:change="prefSelect">
            <option disabled :value="null">都道府県を選択してください</option>
            <option v-for="pref in prefectures" :key="pref.index" :value="pref">{{ pref.name_ja }}</option>
          </select>
          <select v-if="prefChildren" v-model="post.place" v-on:change="mapOpen">
            <option :value="null">市区町村を選択してください</option>
            <option v-for="prefChild in prefChildren" :key="prefChild.id" :value="prefChild.name ">{{ prefChild.name }}</option>
          </select>
          <!-- <div class="borderBottom"></div> -->
          <div v-show="Gmap" class="map"></div>
        </div>
      </div>

      <div class="mb-3 w-100">
        <div v-if="previews">
          <img v-for="preview in previews" :key="preview.index" :src="preview" class="w-50">
        </div>
      </div>

      <div class="">
        <button type="submit" class="btn btn-primary w-100">投稿</button>
      </div>

    </form>
  </div>
</div>
</template>

<style>
.map {
  height: 200px;
}
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
  data: function () {
    return {
      cors: 'https://cors-anywhere.herokuapp.com/',
      Gmap: null,
      prefectures: null, // 都道府県API//'https://madefor.github.io/jisx0401/api/v1/jisx0401-ja.json'
      prefCode: null,
      prefChildren: null,
      post: { place: null },
      images: null,
      previews: [],
    }
  },
  methods: {
    async getPrefectures() {
      const response = await axios.get(`https://covid19-japan-web-api.now.sh/api/v1/prefectures`)
      this.prefectures = response.data
    },
    async prefSelect() {
      let id = ( '0' + this.pref.id ).slice( -2 )
      const response = await axios.get(`${this.cors}https://www.land.mlit.go.jp/webland/api/CitySearch?area=${id}`)
      this.prefChildren = response.data.data
    },
    async mapOpen () {
      this.Gmap = 'gmap'
      let gattai = this.pref.name_ja + this.post.place
      console.log(gattai)
    },
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
          this.previews.push(e.target.result);
        }
        reader.readAsDataURL(fileList[i])
      }
      this.previews = [];
      this.images = fileList;
    },
    reset() {
      this.previews = [];
      this.images = null;
      this.$el.querySelector('input[type="file"]').value = null;
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
      await axios.post('/api/posts', formData)
      this.$router.push('/');
    },
  },
  mounted() {
    this.getPrefectures()
  }
}
</script>
