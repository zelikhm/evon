<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>


<template>
  <div class="my-14 xl:my-10 xl:my-8">
    <h2 class="text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none font-semibold pb-7 xxl:pb-5 xl:pb-4">Другие ЖК в районе {{ house.area }}</h2>
    <div class="grid grid-cols-5 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 xxl:gap-4 xl:gap-3">

      <Link :href="'/house/' + item.slug" class="flex flex-col" v-for="item in slider">
        <div class="object__block relative h-[300px] exl:h-[15.6vw] xl:h-[19.5vw] lg:h-[25vw] md:h-[38vw] sm:h-[64vw]">
          <img v-if="item.images" :src="item.images[0].name" class="w-full h-full object-cover rounded-[8px]" alt="">
          <img v-else src="../../assets/no-img-house.jpg" class="w-full h-full object-cover rounded-[8px]" alt="">
          <div class="flex items-center gap-2 absolute bottom-0 left-0 p-5 xxl:p-4 xl:p-3 text-white text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px]">
            <span class="leading-none">{{ item.area }}</span>
            <span class="bg-white h-1 w-1 rounded-full"></span>
            <span class="leading-none">{{ item.flats.length }} Квартир</span>
          </div>
        </div>
        <div class="flex flex-col p-5 xxl:p-4 xl:p-3 gap-4 xxl:gap-3 xl:gap-2.5">
          <span class="text-[#1E1D2D] font-semibold text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none">{{ item.title }}</span>
          <span class="text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none">от {{ Number.isInteger(item.minPrice) ? item.minPrice : "-" }} ₽</span>
          <div class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px] flex items-center gap-2">
            <span class="leading-none">{{ isNaN(item.minSquare / item.minPrice) ?  "-" : Math.round(item.minSquare / item.minPrice) }} € за м²</span>
            <span class="bg-[#8A8996] h-1 w-1 rounded-full"></span>
            <span class="leading-none">{{ Number.isInteger(item.minSquare) ? item.minSquare : "-" }} м² - {{ Number.isInteger(item.maxSquare) ? item.maxSquare : "-" }} м²</span>
          </div>
        </div>
      </Link>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    house: [],
    slider: []
  },
  data() {
    return {

    }
  },
  created() {
    this.slider.forEach(house => {
      let arr = [],
          squareFlats = []

      house.flats.forEach(item => {
        arr.push(item.price)
        squareFlats.push(item.square)
      })

      house.minPrice = Math.min(...arr)
      house.minSquare = Math.min(...squareFlats)
      house.maxSquare = Math.max(...squareFlats)

    })
  }
}
</script>

<style scoped>

</style>
