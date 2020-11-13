<template>
<div v-if="profile" class="">
  <div class="border-bottom">
    <div><img class="profileImage rounded-circle" :src="'/storage/images/' + profile.image" :alt="profile.name + 'のプロフィール画像'"></div>
    <p>{{ profile.name }}</p>
    <p>{{ profile.comment }}</p>
    <p>{{ profile.user.userid }}</p>
    <p>{{ profile.created_at }}</p>
    <p v-if="geocode.length != 0" v-on:click="open = !open">mapを開く</p>
    <router-link :to="{ name: 'profiles.edit', params: profileId }">プロフィール編集</router-link>
  </div>
  <gmap-index v-if="geocode.length != 0" v-show="open" :geocode="geocode" />
  <post-content v-for="post in posts" :key="post.id" :post="post" />
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
import PostContent from '../Post/PostContent';
export default {
  props: {
    profileId: NaN
  },
  data: function() {
    return {
      profile: null,
      posts: null,
      geocode: [],
      open: false,
    }
  },
  methods: {
    getProfile () {
      axios.get('/api/profiles/' + this.profileId)
      .then(( res ) => {
        this.profile = res.data[0];
        this.posts = res.data[1].reverse();
        for(var i = 0; i < this.posts.length; i++) {
          this.geocode.push({ lat: this.posts[i].lat, lng: this.posts[i].lng })
        }
      });
    },
  },
  mounted() {
    this.getProfile()
  },
  components: {
    GmapIndex,
    PostContent,
  }
}
</script>
