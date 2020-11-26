<template>
<div class="">
  <div class="p-2 border-bottom">
    <div class="d-flex justify-content-between">
      <div class="d-flex">
        <img
          class="profileImage rounded-circle mr-3"
          :src="profile.image"
          :alt="profile.name + 'のプロフィール画像'"
        >
        <div>
          <div class="d-flex">
            <h4>{{ profile.name }}</h4>
            <h4 class="opa ml-1">{{ user.userid }}</h4>
          </div>
          <p>{{ profile.comment }}</p>
        </div>
      </div>
      <div>
        <profile-menu />
      </div>
    </div>
    <p>{{ profile.created_at }}</p>
    <p v-if="geocode.length != 0" v-on:click="open = !open">mapを開く</p>
  </div>
  <v-wait>
    <v-loading
      slot="waiting"
      type="barsCylon"
      color="#335b66"
      :size="{ width: '50px', height: '50px'}"
      class="mt-5"
    />
    <div v-if="posts.length != 0">
      <gmap-index v-if="geocode.length != 0" v-show="open" :geocode="geocode" />
      <post-content v-on:getPosts="getPosts" v-for="post in posts" :key="post.id" :post="post" />
    </div>
    <enpty v-else message="まだ投稿がありません" />
  </v-wait>
</div>
</template>

<style>
.profileImage {
  width: 80px;
  height: 80px;
}
.postProfileImage {
  width: 40px;
  height: 40px;
}
</style>

<script>
import GmapIndex from '../Gmap/GmapIndex.vue';
import Enpty from '../Post/Enpty.vue';
import PostContent from '../Post/PostContent';
import PostMenu from '../Post/PostMenu.vue';
import ProfileMenu from './ProfileMenu';
export default {
  props: {
    profileId: NaN
  },
  data: function() {
    return {
      posts: [],
      geocode: [],
      open: false,
    }
  },
  methods: {
    async getPosts () {
      this.$wait.start('loading')
      await axios.get('/api/profiles/' + this.profileId)
      .then(( res ) => {
        this.posts = res.data[1].reverse();
        for(var i = 0; i < this.posts.length; i++) {
          if (this.posts[i].lat && this.posts[i].lng) {
            this.geocode.push({ lat: this.posts[i].lat, lng: this.posts[i].lng })
          }
        }
      });
      this.$wait.end('loading')
    },
  },
  mounted() {
    this.getPosts()
  },
  computed: {
    profile () {
      return this.$store.getters['profile/profile'][0]
    },
    user () {
      return this.$store.getters['auth/user']
    },
  },
  components: {
    GmapIndex,
    PostContent,
    Enpty,
    PostMenu,
    ProfileMenu,
  }
}
</script>
