<template>
<div class="Form">
  <h4 class="text-center pt-3">{{ info.title }}</h4>
  <div class="card-body">
    <form v-on:submit.prevent="submit">

      <text-image :v="$v" />
        <span v-if="!$v.images.maxLength" class="text-right error">
          画像は最大{{ $v.images.$params.maxLength.max }}枚までです
        </span>
      <place />

      <button type="submit" :disabled="$v.$invalid" class="btn btn-primary w-100">
        {{ info.button }}
      </button>

    </form>
  </div>
</div>
</template>

<script>
import { required, alphaNum, email, maxLength } from "vuelidate/lib/validators";
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
      postImages: [],
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
        formData.append(
          'place', this.post.place
          .replace(/〒\d{3}-?\d{4}/,'')
          .replace(/Unnamed Road,/, '')
          .replace(/\d{3}-?\d{4}/,'')
        )
      }
      if (this.post.text) {
        formData.append('text', this.post.text)
      }
      if (this.$route.name == 'posts.create') {
        await axios.post('/api/posts', formData)
      } else if (this.$route.name == 'posts.edit') {
        await axios.post(`/api/posts/${this.post.id}`, formData, {
          headers: { 'X-HTTP-Method-Override': 'PUT' }
        });
      }
      this.$router.push('/');
    },
    async getPost() {
      if (this.$route.name == 'posts.edit') {
        axios.get('/api/posts/' + this.postId)
        .then((res) => {
          this.post = res.data[0]
          this.postImages = res.data[0].images
        });
      }
    },
  },
  mounted() {
    if (this.$route.name == 'posts.edit') {
      this.getPost();
    }
  },
  validations: {
    post: {
      text: {
        required,
      },
    },
    images: {
      maxLength: maxLength(6)
    }
  },
  components: {
    TextImage,
    Place,
  }
}
</script>
