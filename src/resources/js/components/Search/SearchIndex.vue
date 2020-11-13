<template>
<div class="">
  <search class="border-bottom p-3" />
  <div v-if="posts">
    <post-content  v-for="post in posts" :key="post.id" :post="post" />
  </div>
  <div v-if="profiles">
    <profile-content v-for="profile in profiles" :key="profile.id" :profile="profile" />
  </div>
  <h4 v-if="posts.length == 0 && profiles.length == 0" class="opacity-2 text-center">
    検索結果がありません
  </h4>
</div>
</template>

<script>
import Search from './Search';
import PostContent from '../Post/PostContent';
import ProfileContent from '../Profile/ProfilesContent';
export default {
  data: function () {
    return {
      selected: 'text',
      posts: [],
      profiles: [],
    }
  },
  components: {
    Search,
    PostContent,
    ProfileContent,
  },
}
</script>
