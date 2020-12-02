<template>
  <div v-if="geocode" id="map">
    <GmapMap
      v-if="geocode"
      :center="geocode"
      :zoom="zoom"
      @center_changed="onCenterChanged"
      style="width: 100%; height: 100%;"
    >
      <GmapMarker
        :position="geocode"
        :clickable="true"
        :draggable="false"
        ></GmapMarker>

      <infoWindow
        v-show="center"
        :options="{
          maxWidth: 300,
          pixelOffset: { width: 0, height: -55 }
        }"
        :position="center"
        :opened="true"
      >
        <p style="color:#000">マーカーをクリックしてください</p>
      </infoWindow>

      <GmapMarker
        v-if="this.$route.name == 'posts.create' || this.$route.name ==  'posts.edit'"
        v-show="center"
        v-on:click="getGeocode"
        :position="center"
        :clickable="true"
        :icon="icon"
        :draggable="false"
      ></GmapMarker>
    </GmapMap>
  </div>
</template>

<script>
export default {
  props: {
    geocode: Object
  },
  data: function() {
    return {
      zoom: 15,
      center: null,
      icon: {
        url: '/map-marke.png',
        scaledSize: {
          width: 50,
          height: 50,
          f: 'px',
          b: 'px'
        }
      },
    }
  },
  methods: {
    getGeocode() {
      const latlng = `${this.center.lat},${this.center.lng}`
      this.$parent.geoCoding(latlng)
    },
    onCenterChanged(center) {
      if (this.$route.name == 'posts.create' || this.$route.name ==  'posts.edit') {
        this.center = {
          lat: center.lat(),
          lng: center.lng()
        }
      }
    },
  },
}
</script>
