<template>
<div>
  <div class="border-bottom">
    <div>
      <img
        class="profileImage rounded-circle"
        :src="profile.image"
        :alt="profile.name + 'のプロフィール画像'"
      >
    </div>
    <p>{{ profile.name }}</p>
    <p>{{ profile.comment }}</p>
    <p>{{ profile.user.userid }}</p>
    <p>{{ profile.created_at }}</p>
    <p v-if="geocode.length != 0" v-on:click="open = !open">mapを開く</p>
    <router-link :to="{ name: 'profiles.edit', params: profileId }">プロフィール編集</router-link>
  </div>
  <v-wait>
    <v-loading
      slot="waiting"
      type="barsCylon"
      color="#335b66"
      :size="{ width: '50px', height: '50px'}"
      class="mt-5"
    />
    <div>
      <gmap-index v-if="geocode.length != 0" v-show="open" :geocode="geocode" />
      <post-content v-for="post in posts" :key="post.id" :post="post" />
    </div>
    <enpty v-if="posts.length == 0" message="まだ投稿がありません" />
  </v-wait>
</div>
</template>

<style>
.profileImage {
  width: 100px;
  height: 100px;
}
.postProfileImage {
  width: 50px;
  height: 50px;
}
</style>

<script>
import GmapIndex from '../Gmap/GmapIndex.vue';
import Enpty from '../Post/Enpty.vue';
import PostContent from '../Post/PostContent';
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
    async getProfilePosts () {
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
    this.getProfilePosts()
  },
  computed: {
    profile () {
      return this.$store.getters['profile/profile'][0]
    }
  },
  components: {
    GmapIndex,
    PostContent,
    Enpty,
  }
}
</script>
