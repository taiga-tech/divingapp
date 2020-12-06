<template>
<div>
  <div v-if="profile" class="p-2 border-bottom">
    <div class="d-flex">
      <img
        class="profileImage rounded-circle mr-2"
        :src="profile.image"
        :alt="profile.name + 'のプロフィール画像'"
      >
      <div class="d-flex justify-content-between w-100">
        <div class="d-flex align-items-center">
          <div>
            <h2>{{ profile.name }}</h2>
            <p class="opa">{{ user.userid }}</p>
          </div>
        </div>
        <profile-menu v-if="user.id == profileId" />
      </div>
    </div>

    <div v-if="profile.comment" class="textArea mt-2">{{ profile.comment }}</div>

    <p v-if="geocode.length != 0" class="text-right">
      <span v-on:click="open = !open">
        <i class="fas" :class="{ 'fa-chevron-up': !open, 'fa-chevron-down': open }"></i> MAPS
      </span>
    </p>
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
      <post-content
        v-on:removePost="removePost"
        v-for="(post, index) in posts"
        :key="index"
        :post="post"
        :index="index"
      />
    </div>
    <enpty v-else message="まだ投稿がありません" />
  </v-wait>
</div>
</template>

<script>
import GmapIndex from '../Gmap/GmapIndex.vue';
import Enpty from '../Post/Enpty.vue';
import PostContent from '../Post/PostContent';
import PostMenu from '../Post/PostMenu.vue';
import ProfileMenu from './ProfileMenu';
import moment from 'moment';

export default {
  props: {
    profileId: NaN
  },
  data: function() {
    return {
      profile: null,
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
        this.profile = res.data[0]
        this.posts = res.data[1].reverse();
        for(var i = 0; i < this.posts.length; i++) {
          if (this.posts[i].lat && this.posts[i].lng) {
            this.geocode.push({ lat: this.posts[i].lat, lng: this.posts[i].lng })
          }
        }
      });
      this.$wait.end('loading')
    },
    async removePost(e) {
      this.posts.splice(e, 1)
    }
  },
  filters: {
    moment: function (data) {
      moment.locale('ja')
      return moment(data).fromNow()
    }
  },
  mounted() {
    this.getPosts()
  },
  computed: {
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
