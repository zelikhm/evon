<template>
  <div class="fixed z-[100] w-full h-full flex items-center lg:items-start">
    <div class="relative z-50 left-[10vw] w-[60%] lg:w-full lg:left-0 lg:px-5 lg:mt-10">
      <div class="flex gap-7 xxl:gap-5 xl:gap-4">
        <div class="w-[100%]">
          <swiper
            :modules="modules"
            :navigation="true"
            :pagination="{
              clickable: true,
            }"
            :loop="true"
            class="mySwiper2 mb-4 xxl:mb-3 xl:mb-2"
          >
            <swiper-slide v-for="item in showImage">
              <img class="w-full h-full object-cover" :src="item.name" />
            </swiper-slide>
          </swiper>
        </div>
      </div>
      <div class="absolute top-0 lg:top-full left-[102%] lg:left-1/2 lg:-translate-x-1/2 lg:mt-5 w-[36%] lg:w-fit flex flex-col h-fit gap-4 xxl:gap-3 xl:gap-2">
        <button v-for="item in categories" @click="changeCategory(item)">
          <div class="bg-white flex justify-between gap-5 xxl:gap-4 xl:gap-3 items-center p-7 xxl:p-5 xl:p-4 lg:p-3 rounded-[10px] news__line" v-if="item.count > 0">
            <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none whitespace-nowrap">{{ item.title }}</span>
            <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px] whitespace-nowrap">{{ item.count }} фото</span>
          </div>
        </button>
      </div>
    </div>
    <div @click="$emit('close-album')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue'

import 'swiper/css'

import "swiper/css/free-mode"
import "swiper/css/navigation"
import "swiper/css/thumbs"

import { ref } from 'vue'

import { FreeMode, Navigation, Pagination} from "swiper";

export default {
  props: ['image'],
  components: {
    Swiper,
    SwiperSlide,
  },
  emits: ['close-album'],
  data() {
    return {
      categories: [
        { id: 0, title: '3D Рендеры', count: 0 },
        { id: 1, title: 'Инфраструктура', count: 0 },
        { id: 2, title: 'Дизайн', count: 0 },
        { id: 3, title: 'Ход строительства', count: 0 },
      ],
      showImage: [],
      category: 0,
      mainImage: null
    }
  },
  methods: {
    targetWithPhoto(item) {
      this.mainImage = item.name
    },
    changeCategory(item) {
      this.category = item.id
      this.showImage = []
      this.showImage.push(...this.image.filter(item => item.category === this.category))
      console.log(this.showImage)
      this.mainImage = this.showImage[0].name
    }
  },
  setup() {
    const thumbsSwiper = ref(null);
    const setThumbsSwiper = (swiper) => {
      thumbsSwiper.value = swiper;
    };
    return {
      modules: [FreeMode, Navigation, Pagination ],
    };
  },
  created() {
    this.showImage.push(...this.image.filter(item => item.category === this.category))
    this.mainImage = this.showImage[0].name

    this.categories.forEach((item, idx) => {
      item.count = this.image.filter(i => i.category === idx).length
    })
  }
}
</script>

<style scoped>

</style>
