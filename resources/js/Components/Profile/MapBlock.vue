<script>
export default {
  name: "MapBlock",
  data(){
    return{
      center: {lat: 38.789057678005726, lng: 35.39768557787735},
      markers: [],
    }
  }
}
</script>

<template>
  <GMapMap :center="center" :zoom="6" map-type-id="roadmap"
           class="w-full h-[300px] rounded-[6px] mb-10 xxl:mb-8 xl:mb-6" :draggable="true" @click="handleClick"
           ref="myMapRef" :click="true"
           :disableDefaultUI="false"
           :options="{
                      zoomControl: false,
                      mapTypeControl: false,
                      scaleControl: false,
                      streetViewControl: false,
                      rotateControl: false,
                      fullscreenControl: true,
                } "
  >
    <GMapMarker :key="index" v-for="(m, index) in markers" :icon="'/images/icon-marker-map.svg'"
                :position="m.position" :clickable="true" :draggable="true"
                @click="openMarker(m.id)">
    </GMapMarker>
  </GMapMap>
</template>

<style scoped>

</style>
