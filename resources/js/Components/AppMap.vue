<template>
 <div class="relative w-full h-[90vh] my-5 xxl:my-4 xl:my-3">

   <GMapMap :center="center" :zoom="6" map-type-id="terrain" class="w-full h-full">
     <GMapMarker :key="index" v-for="(m, index) in markers" :position="m.position" @click="openMarker(m)">
       <GMapInfoWindow :closeclick="true"
                       @closeclick="openMarker(null)"
                       :opened="openedMarkerID === m.id">
         <div class="relative decription__head top-0 right-0 bg-white rounded-[10px]">
           <div class="p-8 xxl:p-6 xl:p-5 border__bottom">
             <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 mb-7 xxl:mb-5 xl:mb-4">
               <img src="../../assets/chat_avatar.png" class="w-14 xxl:w-12 xl:w-8" alt="">
               <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5">
                 <span class="text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] font-medium leading-none">{{ house.title }}</span>
                 <span class="text-[#8A8996] text-[16px] xxl:text-[14px] xl:text-[12px] leading-none">{{ house.city }}, {{ house.area }}</span>
               </div>
             </div>
             <div class="flex gap-2.5 xxl:gap-2 xl:gap-1.5">
               <span class="text-white text-[14px] xxl:text-[12px] xl:text-[10px] leading-none bg-[#30CB49] px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 rounded-[3px]">{{ house.status }}</span>
<!--               <span class="border border-solid border-[#E5DFEE] text-[#8A8996] text-[14px] xxl:text-[12px]  xl:text-[10px] leading-none px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 rounded-[3px]">Договор займа</span>-->
             </div>
           </div>
           <div class="p-8 xxl:p-6 xl:p-5">
             <div class="flex justify-between items-center mb-5 xxl:mb-4 xl:mb-3 text-[18px] xxl:text-[15px] xl:text-[13px]">
               <span class="text-[#1E1D2D] font-medium leading-none">от {{ house.minPrice }} €</span>
               <span class="text-[#8A8996] leading-none">{{ house.flats.length }} Квартир</span>
             </div>
             <div class="gray-backg flex items-center gap-1 w-fit px-2 xl:px-1.5 py-1.5 xl:py-1 mb-7 xxl:mb-5 xl:mb-4">
               <img src="../../assets/svg/ruller_icon.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
               <span class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">{{ house.minSquare }} м² - {{ house.maxSquare }} м²</span>
             </div>
             <div class="flex gap-5 xxl:gap-4 xl:gap-3 w-full">
               <button class="w-full flex items-center justify-between border border-solid border-[#6435A5] rounded-[4px] p-3 xxl:p-2 xl:p-1.5">
                 <span class="text-[#6435A5] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">В подборку</span>
                 <img src="../../assets/svg/plus_icon_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
               </button>
               <button class="w-full flex items-center justify-between border border-solid border-[#6435A5] rounded-[4px] p-3 xxl:p-2 xl:p-1.5">
                 <span class="text-[#6435A5] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">В избранное</span>
                 <img src="../../assets/svg/plus_icon_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
               </button>
             </div>
           </div>
         </div>
       </GMapInfoWindow>
     </GMapMarker>
   </GMapMap>
  </div>
</template>

<script>
export default {
  props: ['houses'],
  data() {
    return {
      openedMarkerID: null,
      center: {lat: 38.789057678005726, lng: 35.39768557787735},
      markers: [],
      house: {
        title: null,
        city: null,
        area: null,
        status: null,
        flats: []
      }
    }
  },
  methods: {
    //latitude  ,   longitude
    openMarker(marker) {
      if (marker === null) {
        this.openedMarkerID = null
        return
      }

      this.openedMarkerID = marker.id
      this.house = this.houses.find(item => +item.latitude === marker.position.lat && +item.longitude === marker.position.lng)

      if (this.house) {
        let minPrice = [],
            square = []

        this.house.flats.forEach(item => {
          minPrice.push(item.price)
          square.push(item.square)

          this.house.minPrice = Math.min(...minPrice)
          this.house.minSquare = Math.min(...square)
          this.house.maxSquare = Math.max(...square)
        })
      }
    }
  },
  created() {
    let id = 0;
    this.houses.forEach(item => {
      ++id
      this.markers.push({
        id,
        position: {
          lat: +item.latitude,
          lng: +item.longitude
        }
      })
    })
  },
}
</script>

<style scoped>

</style>
