<template>
  <div>
    <div v-show="$route.name != 'search' && $route.name != 'search.index'" class="w-100 mb-5">
      <search />
    </div>
    <div class="" style="height:400px;">
      <!-- <gmap-index :geocode="geocode" /> -->
    </div>
  </div>
</template>

<script>
import GmapIndex from '../Gmap/GmapIndex.vue';
import Search from '../Search/Search';
export default {
  data: function() {
    return {
      posts: null,
      geocode: []
    }
  },
  methods: {
    getPosts() {
      axios.get('/api/posts')
      .then((res) => {
        this.posts = res.data.reverse();
        for(var i = 0; i < this.posts.length; i++) {
          this.geocode.push({ lat: this.posts[i].lat, lng: this.posts[i].lng })
        }
      });
    }
  },
  mounted() {
    this.getPosts();
  },
  components: {
    Search,
    GmapIndex,
  }
}
</script>
