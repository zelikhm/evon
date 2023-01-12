<template>
  <div class="fixed z-[100] w-full h-full flex items-center">
    <div class="relative z-50 left-[10vw] w-[60%]">
      <div class="flex gap-7 xxl:gap-5 xl:gap-4">
        <div class="w-[100%]">
          <swiper
            :modules="[Thumbs]"
            :thumbs="{ swiper: thumbsSwiper }"
            :loop="true"
            class="mySwiper2 mb-4 xxl:mb-3 xl:mb-2"
          >
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-1.jpg" />
            </swiper-slide>
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-2.jpg" />
            </swiper-slide>
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-3.jpg" />
            </swiper-slide>
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-4.jpg" />
            </swiper-slide>
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-5.jpg" />
            </swiper-slide>
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-6.jpg" />
            </swiper-slide>
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-7.jpg" />
            </swiper-slide>
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-8.jpg" />
            </swiper-slide>
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-9.jpg" />
            </swiper-slide>
            <swiper-slide>
              <img class="w-full" src="https://swiperjs.com/demos/images/nature-10.jpg" />
            </swiper-slide>
          </swiper>
          <div class="inner__slider">
            <swiper
              :loop="true"
              :modules="modules"
              @swiper="setThumbsSwiper"
              :navigation="true"
              :spaceBetween="10"
              :slidesPerView="4"
              class="mySwiper h-[10vh]"
            >
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-1.jpg" />
              </swiper-slide>
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-2.jpg" />
              </swiper-slide>
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-3.jpg" />
              </swiper-slide>
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-4.jpg" />
              </swiper-slide>
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-5.jpg" />
              </swiper-slide>
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-6.jpg" />
              </swiper-slide>
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-7.jpg" />
              </swiper-slide>
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-8.jpg" />
              </swiper-slide>
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-9.jpg" />
              </swiper-slide>
              <swiper-slide class="w-full h-[10vh]">
                <img class="w-full" src="https://swiperjs.com/demos/images/nature-10.jpg" />
              </swiper-slide>
            </swiper>
          </div>
        </div>
      </div>
      <div class="absolute top-0 left-[102%] w-[36%] flex flex-col h-fit gap-4 xxl:gap-3 xl:gap-2">
        <button class="bg-white flex justify-between items-center p-7 xxl:p-5 xl:p-4 rounded-[10px] news__line">
          <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none">3D Рендеры</span>
          <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px]">17 фото</span>
        </button>
        <button class="bg-white flex justify-between items-center p-7 xxl:p-5 xl:p-4 rounded-[10px] news__line">
          <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none">Инфраструктура</span>
          <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px]">17 фото</span>
        </button>
        <button class="bg-white flex justify-between items-center p-7 xxl:p-5 xl:p-4 rounded-[10px] news__line">
          <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none">Дизайн</span>
          <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px]">17 фото</span>
        </button>
        <button class="bg-white flex justify-between items-center p-7 xxl:p-5 xl:p-4 rounded-[10px] news__line">
          <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none">Ход строительства</span>
          <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px]">17 фото</span>
        </button>
      </div>
    </div>
    <div @click="this.$emit('close-album')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue'

import 'swiper/css'

import "swiper/css/free-mode"
import "swiper/css/navigation"
import "swiper/css/thumbs"

import { ref } from 'vue'

import {FreeMode,Navigation,Thumbs} from 'swiper'


export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  emits: ['close-album'],
  setup() {
    const thumbsSwiper = ref(null);
    const setThumbsSwiper = (swiper) => {
      thumbsSwiper.value = swiper;
    };
    return {
      Thumbs,
      thumbsSwiper,
      setThumbsSwiper,
      modules: [FreeMode,Navigation,Thumbs],
    };
  }
}
</script>

<style scoped>

</style>
