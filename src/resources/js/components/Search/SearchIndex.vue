<template>
<div class="">
  <search class="border-bottom p-3" />
  <v-wait>
    <v-loading
      slot="waiting"
      type="barsCylon"
      color="#335b66"
      :size="{ width: '50px', height: '50px'}"
      class="mt-5"
    />
    <div v-if="posts">
      <post-content
        v-for="(post, index) in posts"
        :key="index"
        :post="post"
        :index="index"
        v-on:removePost="removePost"
      />
    </div>
    <div v-if="profiles">
      <profile-content v-for="profile in profiles" :key="profile.id" :profile="profile" />
    </div>
    <enpty v-if="posts.length == 0 && profiles.length == 0" message="検索結果がありません" />
  </v-wait>
</div>
</template>

<script>
import Search from './Search';
import PostContent from '../Post/PostContent';
import ProfileContent from '../Profile/ProfilesContent';
import Enpty from '../Post/Enpty.vue';
export default {
  data: function () {
    return {
      selected: 'text',
      posts: [],
      profiles: [],
    }
  },
  methods: {
    removePost(e) {
      this.posts.splice(e, 1)
    }
  },
  components: {
    Search,
    PostContent,
    ProfileContent,
    Enpty,
  },
}
</script>
