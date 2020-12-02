<template>
  <div>
    <div v-show="$route.name != 'search' && $route.name != 'search.index'" class="w-100 mb-5">
      <search />
    </div>
    <div>
      <div v-show="lanking.length != 0" class="my-5">
        <place-lank :lanking="lanking.slice(0, 5)" />
      </div>
      <div v-if="geocode.length != 0" class="" style="height:400px;">
        <gmap-index :geocode="geocode" />
      </div>
    </div>
  </div>
</template>

<script>
import Search from '../Search/Search';
import GmapIndex from '../Gmap/GmapIndex';
import PlaceLank from '../Post/PlaceLank';

export default {
  data: function() {
    return {
      posts: null,
      geocode: [],
      lanking: []
    }
  },
  methods: {
    getPosts() {
      axios.get('/api/posts')
      .then((res) => {
        this.posts = res.data.reverse();
        for(var i = 0; i < this.posts.length; i++) {
          if (this.posts[i].lat && this.posts[i].lng) {
            this.geocode.push({
              lat: this.posts[i].lat,
              lng: this.posts[i].lng
            })
          }
          if (this.posts[i].place) {
            this.lanking.push(this.posts[i].place)
          }
        }
      });
    },
  },
  mounted() {
    this.getPosts();
  },
  components: {
    Search,
    GmapIndex,
    PlaceLank,
  }
}
</script>
