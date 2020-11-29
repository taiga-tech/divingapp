<template>
  <div id="map">
    <GmapMap
      v-if="geocode.length != 0"
      :center="center"
      :zoom="zoom"
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
}
</script>
