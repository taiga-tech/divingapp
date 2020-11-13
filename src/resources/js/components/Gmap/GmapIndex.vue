<template>
  <div id="map" v-if="geocode">
    <GmapMap
      v-if="geocode"
      :center="center"
      :zoom="zoom"
      @center_changed="onCenterChanged"
      style="width: 100%; height: 100%;"
    >
      <GmapMarker
        v-for="geo in geocode"
        :key="geo.index"
        :position="geo"
        :clickable="true"
        :draggable="false"
      ></GmapMarker>
    </GmapMap>
  </div>
</template>

<style lang="scss" scoped>
</style>

<script>
export default {
  props: {
    geocode: Array,
  },
  data: function() {
    return {
      zoom: 6,
      center: { lat: 36, lng: 138 }
    }
  },
  methods: {
  },
  mounted() {},
}
</script>
