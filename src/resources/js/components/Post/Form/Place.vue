<template>
<div class=" my-4 w-100">
  <div class="d-flex justify-content-between px-1">
    <div class="">どこの海？</div>
    <div v-on:click="open">マップを開く</div>
  </div>
  <div class="d-flex">
    <v-select
      @input="prefSelect"
      :loading="prefectures.length <= 0"
      :options="prefectures"
      label="name_ja"
      v-model="place.prefCode"
      class="w-100"
      placeholder="都道府県を選択"
    ><template #spinner="{ loading }"><div v-if="loading" class="vs__spinner"/></template>
    </v-select>

    <v-select
      v-if="place.prefCode"
      @input="municipalSelect"
      :loading="prefChildren.length <= 0"
      :options="prefChildren"
      :reduce="prefChildren => prefChildren"
      label="name"
      v-model="place.municipal"
      class="w-100"
      placeholder="もっと絞り込む"
    ><template #spinner="{ loading }"><div v-if="loading" class="vs__spinner"/></template>
    </v-select>
  </div>

  <div class="search mt-2">
    <form class="" v-on:submit.prevent="geoCoding($parent.post.place)">
      <input
        v-model="$parent.post.place"
        type="search"
        class="w-100 pl-2 pr-5"
        placeholder="住所で検索する"
      >
      <span class="searchIcon rounded-circle">
        <i v-on:click.prevent="geoCoding($parent.post.place)" class="fas fa-search"></i>
      </span>
    </form>
  </div>
  <gmap class="p-2" v-show="Gmap" :geocode="geocode"/>
</div>
</template>

<style lang="scss">
.vs {
  &__spinner { border-left-color: rgba(88, 151, 251, 0.71); }
  &__dropdown-menu {
    @media (prefers-color-scheme:dark) {
      --bg-opacity: 1;
      background-color: #1a202c;
      background-color: rgba(26,32,44,var(--bg-opacity))
    }
  }
}
.v-select, .v-select * {
  @media (prefers-color-scheme:dark){
    --text-opacity: 1;
    color: #cbd5e0;
    color: rgba(203,213,224,var(--text-opacity))
  }
}

</style>

<script>
import Gmap from '../../Gmap/Gmap';

export default {
  data: function () {
    return {
      cors: 'https://cors-anywhere.herokuapp.com/',
      prefectures: [],
      prefChildren: [],
      place: {},
      Gmap: false,
      fullPlace: null,
      geocode: { lat: 36, lng: 138 }
    }
  },
  methods: {
    async getPrefectures() {
      const response = await axios.get(`https://covid19-japan-web-api.now.sh/api/v1/prefectures`)
      this.prefectures = response.data
    },
    async prefSelect() {
      this.prefChildren = []
      this.place.municipal = null
      const id = ( '0' + this.place.prefCode.id ).slice( -2 )
      const response = await axios.get(
        `${ this.cors }https://www.land.mlit.go.jp/webland/api/CitySearch`,
        { params:{ area: id } }
      )
      this.prefChildren = response.data.data
      this.fullPlace = this.place.prefCode.name_ja
      this.geoCoding(this.place.prefCode.name_ja)
      this.mapOpen()
    },
    async municipalSelect() {
      this.fullPlace = this.place.prefCode.name_ja + this.place.municipal.name
      this.geoCoding(this.fullPlace)
    },
    async geoCoding(address) {
      const response = await axios.get(
        `${ this.cors }https://maps.googleapis.com/maps/api/geocode/json`,
        { params:
          {
            address: address,
            key: process.env.MIX_GOOGLE_MAP_API
          }
        }
      )
      this.geocode = response.data.results[0].geometry.location
      this.fullPlace = response.data.results[0].formatted_address
      console.log(response.data.results[0].address_components)
      this.mapOpen()
    },
    async mapOpen() {
      this.Gmap = true
      this.$parent.post.place = this.fullPlace
      this.$parent.post.latlng = this.geocode
    },
    async open() {
      this.Gmap = true
    }
  },
  mounted() {
    this.getPrefectures()
  },
  components: {
    Gmap,
  },
}
</script>
