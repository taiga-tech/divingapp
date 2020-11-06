<template>
<div v-if="profile" class="">
  <div>
    <div><img class="profileImage rounded-circle" :src="'/storage/images/' + profile.image" :alt="profile.name + 'のプロフィール画像'"></div>
    <p>{{ profile.name }}</p>
    <p>{{ profile.comment }}</p>
    <p>{{ profile.user.userid }}</p>
    <p>{{ profile.created_at }}</p>
    <router-link :to="{ name: 'profiles.edit', params: { profileId: profile.id } }">プロフィール編集</router-link>
  </div>
  <hr>
  <div v-for="post in posts" :key="post.id" class="border-bottom">
    <router-link :to="{ name: 'posts.show', params: { postId: post.id } }">
      <div>
        <img class="postProfileImage rounded-circle" :src="'/storage/images/' + profile.image" alt="">
        <p>{{ post.id }}</p>
        <p>{{ post.text }}</p>
        <p>{{ post.spot }}</p>
        <p>{{ post.created_at }}</p>
      </div>
    </router-link>
  </div>
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
export default {
  props: {
    profileId: String
  },
  data: function() {
    return {
      profile: null,
      posts: null,
    }
  },
  methods: {
    getProfile () {
      axios.get('/api/profiles/' + this.profileId)
      .then((res) => {
        this.profile = res.data;
        this.posts = res.data.posts.reverse();
      });
    }
  },
  mounted() {
    this.getProfile();
  }
}
</script>
