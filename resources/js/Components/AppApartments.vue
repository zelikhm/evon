<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] mb-5 xxl:mb-4 xl:mb-3">Добавить корпус и квартиры</h2>
  <div class="flex flex-col">
    <div class="grid grid-cols-6 lg:grid-cols-4 sm:grid-cols-3 gap-3 xxl:gap-2.5 xl:gap-2">
      <div @click="targetFrame(frame)" v-for="frame in house.frames" :class="{ border: frame.active === 1 }" class="corpus__banner flex justify-between cursor-pointer rounded-[5px] border-solid border-[#6435A5] px-5 xxl:px-4 xl:px-3 py-5 xxl:py-4 xl:py-3">
        <div class="flex flex-col justify-center gap-3.5 xxl:gap-3 xl:gap-2.5">
          <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">{{ frame.name }}</span>
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap"></span>
        </div>
        <div class="flex flex-col items-center justify-between gap-3.5 xxl:gap-3 xl:gap-2.5">
          <button>
            <img class="w-5 xxl:w-4 xl:w-3" src="../../assets/svg/pen_icon_grey.svg" alt="">
          </button>
          <button>
            <img class="w-5 xxl:w-4 xl:w-3" src="../../assets/svg/bucket_icon_red.svg" alt="">
          </button>
        </div>
      </div>
      <div class="flex items-center">
        <img @click="this.$emit('open-add-frame')" src="../../assets/svg/plus_icon_purple.svg" class="cursor-pointer ml-3 xxl:ml-2.5 xl:ml-2 w-8 xxl:w-6 xl:w-5" alt="">
      </div>
    </div>
    <div class="grid lg:w-[87.5vw] pb-2 custom__scroll--chess gap-4 xxl:gap-3.5 xl:gap-3 my-16 xxl:my-12 xl:my-10 text-[#1E1D2D] text-base xxl:text-sm xl:text-xs">
      <div class="text-[#8A8996] grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
        <div
          class="leading-none bg-white flex items-center gap-2 xl:gap-1.5"
          v-for="item in titleTable"
        >
          <span class="leading-none">{{ item.title }}</span>
          <div @click="changeFilter(item)" class="flex flex-col gap-[1px] xl:gap-[0.5px]">
            <svg class="cursor-pointer rotate-180 w-[9px] xxl:w-[8px] xl:w-[7px] h-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path :class="{ 'fill-[#6435A5]': item.activeArrow === 2 }" d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
            <svg class="cursor-pointer w-[9px] h-[7px] w-[9px] xxl:w-[8px] xl:w-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path :class="{ 'fill-[#6435A5]': item.activeArrow === 1 }" d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
          </div>
        </div>
      </div>
      <div class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
        <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
          <div class="leading-none bg-white">1002</div>
          <div class="leading-none">33.08</div>
          <div class="leading-none">64 175 200</div>
          <div class="leading-none">1+1</div>
          <div class="leading-none">1</div>
          <div class="relative">
            <div @click="openStatus = !openStatus" class="flex items-center cursor-pointer gap-5 xxl:gap-4 xl:gap-3">
              <span class="whitespace-nowrap">{{ selectStatus }}
              </span>
              <svg class="w-2.5 xl:w-2" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.00005 3.879L8.71255 0.166504L9.77305 1.227L5.00005 6L0.227051 1.227L1.28755 0.166504L5.00005 3.879Z" fill="#8A8996"/>
              </svg>
            </div>
            <div v-if="openStatus" class="absolute flex flex-col top-[130%] left-0 bg-white border border-solid border-[#E5DFEE] rounded-[5px]">
              <span @click="changeSelectStatus(status)" v-for="status in statuses" class="border__bottom--not cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 whitespace-nowrap">
                {{ status.status }}
              </span>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-end flex-shrink-0">
          <button class="border__right h-[56px] xxl:h-[48px] xl:h-[40px] w-[60px] xxl:w-[48px] xl:w-[36px] flex items-center justify-center">
            <img src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
          </button>
          <button class="w-[60px] xxl:w-[48px] xl:w-[36px] flex items-center justify-center">
            <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="w-full flex justify-center mt-5 xxl:mt-4 xl:mt-3 gap-3 xxl:gap-2.5 xl:gap-2 items-center text-[#8A8996] text-lg xxl:text-[15px] xl:text-[13px]">
    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">
      <img src="../../assets/svg/arrow_right_grey.svg" class="rotate-180 w-5 xxl:w-4 xl:w-3" alt="">
    </div>
    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">1</div>
    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">2</div>
    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">3</div>
    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">...</div>
    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">24</div>
    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">
      <img src="../../assets/svg/arrow_right_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
    </div>
  </div>
  <div class="my-10 xxl:my-8 xl:my-6 w-full gap-10 xxl:gap-8 xl:gap-6">
    <button @click="addObject(1)" class="login__btn--bg w-full font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] text-white bg-[#E84680] rounded-[6px]">Продолжить</button>
  </div>
</template>

<script>

export default {
  props: ['house'],
  emits: ['open-add-frame'],
  data() {
    return {
      titleTable: [
        { title: '№', activeArrow: 0 },
        { title: 'Площадь', activeArrow: 0 },
        { title: 'Цена', activeArrow: 0 },
        { title: 'Планировка', activeArrow: 0 },
        { title: 'Этаж', activeArrow: 0 },
        { title: 'Статус', activeArrow: 0 },
      ],
      selectStatus: 'Свободно',
      id: null,
      openStatus: false,
      statuses: [
        { status: 'Свободно', value: 1},
        { status: 'Продажи закрыты', value: 2},
        { status: 'Акция', value: 3},
        { status: 'Перепродажа', value: 4},
      ],
    }
  },
  methods: {
    changeSelectStatus(status) {
      this.selectStatus = status.status
      this.openStatus = false
    },
    targetFrame(frame) {
      this.house.frames.forEach(item => item.active = 0)
      frame.active = 1
      this.$emit('change-frame', frame.id)
    },
    changeFilter(item) {
      item.activeArrow += 1
      if (item.activeArrow > 2) {
        item.activeArrow = 0
      }
    },
  },
  created() {
    this.house.frames.forEach((item, idx) => {
      if (idx === 0) item.active = 1
      else item.active = 0
    })
  }
}

</script>
