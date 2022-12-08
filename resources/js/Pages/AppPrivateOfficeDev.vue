<template>
  <app-header />
  <main>
    <div class="_container">
      <div class="my-14 xxl:my-10 xl:my-8">
        <div class="flex justify-between items-center mb-7 xxl:mb-5 xl:mb-4">
          <span class="font-semibold ext-[22px] xxl:text-[18px] xl:text-[14px]">Наши объекты</span>
          <button class="text-base xxl:text-sm xl:text-xs text-white bg-[#E84680] leading-none rounded-[3px] px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2 xl:py-1.5">Добавить объект</button>
        </div>
        <div class="grid grid-cols-2 gap-7 xxl:gap-5 xl:gap-4">

          <div class="flex flex-col">
            <div class="relative h-[26vw]">
              <img src="../../assets/immovables_img_one.png" class="w-full h-full rounded-[8px]" alt="">
              <div class="absolute top-0 left-0 immovables__overlay w-full h-full rounded-[8px]"></div>
              <div class="absolute flex gap-2 top-0 left-0 p-5 xxl:p-4 xl:p-3">
                <span class="bg-[#30CB49] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none">опубликованно</span>
                <span class="bg-[#E84680] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none">не прошло модерацию</span>
              </div>
              <div class="absolute z-10 top-1/2 w-full flex flex-col gap-3 xxl:gap-2 xl:gap-1.5 items-center -translate-x-1/2 -translate-y-1/2 left-1/2">
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Редактировать</span>
                  <img src="../../assets/svg/pen_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Удалить</span>
                  <img src="../../assets/svg/bucket_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Скрыть</span>
                  <img src="../../assets/svg/hide_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Посмотреть на сайте</span>
                  <img src="../../assets/svg/planet_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Добавить новость</span>
                  <img src="../../assets/svg/plus_icon.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
              </div>
            </div>
            <div class="flex flex-col p-5 xxl:p-4 xl:p-3">
              <span class="font-semibold text-xl xxl:text-base xl:text-[13px]">Euro Avsallar Residence</span>
              <div class="relative">
                <span @click="openWatchTime = !openWatchTime" class="w-fit cursor-pointer flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
                  <img src="../../assets/svg/eye_icon_grey.svg" class="w-4 xxl:w-3.5 xl:w-3" alt="">
                  <span class="text-[#8A8996] leading-none text-lg xxl:text-[15px] xl:text-[13px]"><span class="text-[#6435A5]"> 220 </span> {{ selectTime }}</span>
                  <img src="../../assets/svg/arrow_down_black.svg" alt="">
                </span>
                <div v-if="openWatchTime" class="absolute top-[120%] text-lg xxl:text-[15px] xl:text-[13px] rounded-[3px] z-40 border bg-white border-solid border-[#E5DFEE] flex flex-col">
                  <span
                    v-for="(time, idx) in watchTime" :key="idx"
                    @click="changeSelectTime(time)"
                    class="hover__select cursor-pointer pl-5 xxl:pl-4 xl:pl-3 pr-20 xxl:pr-16 xl:pr-12 py-3 xxl:py-2.5 xl:py-2 leading-none"
                  >
                    {{ time.time }}
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="flex flex-col">
            <div class="relative h-[26vw]">
              <img src="../../assets/immovables_img_one.png" class="w-full h-full rounded-[8px]" alt="">
              <div class="absolute top-0 left-0 immovables__overlay w-full h-full rounded-[8px]"></div>
              <div class="absolute flex gap-2 top-0 left-0 p-5 xxl:p-4 xl:p-3">
                <span class="bg-[#30CB49] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none">опубликованно</span>
                <span class="bg-[#E84680] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none">не прошло модерацию</span>
              </div>
              <div class="absolute z-10 top-1/2 w-full flex flex-col gap-3 xxl:gap-2 xl:gap-1.5 items-center -translate-x-1/2 -translate-y-1/2 left-1/2">
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Редактировать</span>
                  <img src="../../assets/svg/pen_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Удалить</span>
                  <img src="../../assets/svg/bucket_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Скрыть</span>
                  <img src="../../assets/svg/hide_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Посмотреть на сайте</span>
                  <img src="../../assets/svg/planet_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Добавить новость</span>
                  <img src="../../assets/svg/plus_icon.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
              </div>
            </div>
            <div class="flex flex-col p-5 xxl:p-4 xl:p-3">
              <span class="font-semibold text-xl xxl:text-base xl:text-[13px]">Euro Avsallar Residence</span>
              <div class="relative">
                <span @click="openWatchTime = !openWatchTime" class="w-fit cursor-pointer flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
                  <img src="../../assets/svg/eye_icon_grey.svg" class="w-4 xxl:w-3.5 xl:w-3" alt="">
                  <span class="text-[#8A8996] leading-none text-lg xxl:text-[15px] xl:text-[13px]"><span class="text-[#6435A5]"> 220 </span> {{ selectTime }}</span>
                  <img src="../../assets/svg/arrow_down_black.svg" alt="">
                </span>
                <div v-if="openWatchTime" class="absolute top-[120%] text-lg xxl:text-[15px] xl:text-[13px] rounded-[3px] z-40 border bg-white border-solid border-[#E5DFEE] flex flex-col">
                  <span
                    v-for="(time, idx) in watchTime" :key="idx"
                    @click="changeSelectTime(time)"
                    class="hover__select cursor-pointer pl-5 xxl:pl-4 xl:pl-3 pr-20 xxl:pr-16 xl:pr-12 py-3 xxl:py-2.5 xl:py-2 leading-none"
                  >
                    {{ time.time }}
                  </span>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="w-full flex justify-center mt-24 xxl:mt-20 xl:mt-16 gap-3 xxl:gap-2.5 xl:gap-2 items-center text-[#8A8996] text-lg xxl:text-[15px] xl:text-[13px]">
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">
            <img src="../../assets/svg/arrow_right_grey.svg" class="rotate-180 w-5 xxl:w-4 xl:w-3" alt="">
          </div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">1</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">2</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">3</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">...</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">24</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">
            <img src="../../assets/svg/arrow_right_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"

export default {
  data() {
    return {
      selectTime: 'за день',
      openWatchTime: false,
      watchTime: [
        { time: 'за день', value: 1 },
        { time: 'за 5 дней', value: 2 },
        { time: 'за неделю', value: 3 },
        { time: 'за месяц', value: 4 },
        { time: 'за год', value: 5 },
      ]
    }
  },
  methods: {
    changeSelectTime(time) {
      this.selectTime = time.time
      this.openWatchTime = false
    }
  },
  components: {
    AppHeader,
    AppFooter,
  }
}
</script>

<style scoped>

</style>
