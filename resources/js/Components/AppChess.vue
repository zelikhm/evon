<template>
  <main class="">
    <div class="_container">
      <div class="flex justify-between items-center my-4 xxl:my-3 xl:my-2.5">
        <div class="block lg:hidden grid grid-cols-5 gap-3 xxl:gap-2.5 xl:gap-2">
          <div class="corpus__banner border border-solid border-[#6435A5] w-[9.5vw] gap-3.5 xxl:gap-3 xl:gap-2.5 cursor-pointer rounded-[5px] flex flex-col justify-center p-5 xxl:p-3.5 x:p-2.5">
            <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">Корпус 1</span>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">0 квартир</span>
          </div>
          <div class="corpus__banner w-[9.5vw] gap-3.5 xxl:gap-3 xl:gap-2.5 cursor-pointer rounded-[5px] flex flex-col justify-center p-5 xxl:p-3.5 x:p-2.5">
            <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">Корпус 1</span>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">0 квартир</span>
          </div>
          <div class="corpus__banner w-[9.5vw] gap-3.5 xxl:gap-3 xl:gap-2.5 cursor-pointer rounded-[5px] flex flex-col justify-center p-5 xxl:p-3.5 x:p-2.5">
            <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">Корпус 1</span>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">0 квартир</span>
          </div>
          <div class="corpus__banner w-[9.5vw] gap-3.5 xxl:gap-3 xl:gap-2.5 cursor-pointer rounded-[5px] flex flex-col justify-center p-5 xxl:p-3.5 x:p-2.5">
            <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">Корпус 1</span>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">0 квартир</span>
          </div>
          <div class="corpus__banner w-[9.5vw] gap-3.5 xxl:gap-3 xl:gap-2.5 cursor-pointer rounded-[5px] flex flex-col justify-center p-5 xxl:p-3.5 x:p-2.5">
            <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">Корпус 1</span>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">0 квартир</span>
          </div>
        </div>

<!--        Когда корпуса не влазят плюс мобайл версия-->
        <div class="hidden lg:block relative my-5 xxl:my-4 xl:my-3">
          <div @click="openCorpusList = !openCorpusList" class="flex flex-col cursor-pointer gap-2.5 xxl:gap-2 xl:gap-1.5">
            <div class="flex items-center gap-7 xxl:gap-5 xl:gap-4">
              <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">Корпус 1</span>
              <div class="bg-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] px-2 xl:px-1.5 py-1.5 xl:py-1 rounded-[3px] leading-none text-white">СДАН</div>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2" alt="">
            </div>
            <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none whitespace-nowrap">11 квартир</span>
          </div>
          <div v-if="openCorpusList" class="overflow-y-auto custom__scroll-grey max-h-[180px] absolute z-40 top-[120%] bg-white left-0 border border-solid border-[#E5DFEE] rounded-[10px]">
            <div class="hover__select flex flex-col cursor-pointer gap-2.5 xxl:gap-2 xl:gap-1.5 px-7 xxl:px-5 xl:px-4 py-5 xxl:py-4 xl:py-3">
              <div class="flex items-center gap-7 xxl:gap-5 xl:gap-4">
                <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">Корпус 1</span>
                <div class="bg-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] px-2 xl:px-1.5 py-1.5 xl:py-1 rounded-[3px] leading-none text-white">СДАН</div>
              </div>
              <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none whitespace-nowrap">11 квартир</span>
            </div>
            <div class="hover__select flex flex-col cursor-pointer gap-2.5 xxl:gap-2 xl:gap-1.5 px-7 xxl:px-5 xl:px-4 py-5 xxl:py-4 xl:py-3">
              <div class="flex items-center gap-7 xxl:gap-5 xl:gap-4">
                <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">Корпус 1</span>
                <div class="bg-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] px-2 xl:px-1.5 py-1.5 xl:py-1 rounded-[3px] leading-none text-white whitespace-nowrap">СДАН</div>
              </div>
              <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">11 квартир</span>
            </div>
            <div class="hover__select flex flex-col cursor-pointer gap-2.5 xxl:gap-2 xl:gap-1.5 px-7 xxl:px-5 xl:px-4 py-5 xxl:py-4 xl:py-3">
              <div class="flex items-center gap-7 xxl:gap-5 xl:gap-4">
                <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none whitespace-nowrap">Корпус 1</span>
                <div class="bg-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] px-2 xl:px-1.5 py-1.5 xl:py-1 rounded-[3px] leading-none text-white">СДАН</div>
              </div>
              <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none whitespace-nowrap">11 квартир</span>
            </div>
          </div>
        </div>

        <div class="flex items-center gap-7 xxl:gap-5 xl:gap-4 x:gap-2">
          <div class="flex items-center gap-2 xl:gap-1.5">
            <img src="../../assets/svg/calender_purple.svg" class="w-4 xxl:w-3" alt="">
            <span class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">05.12.2022</span>
          </div>
          <div class="chess__buttons h-9 xxl:h-8 xl:h-7 flex items-center p-1 xl:p-0.5 rounded-[3px] text-[14px] xxl:text-[12px] xl:text-[10px]">
            <div @click="changeChess" :class="{'chess__button--active': activeChess}" class="h-full cursor-pointer flex items-center gap-1 px-2 xl:px-1.5 rounded-[3px]">
              <svg class="w-4.5 xxl:w-4 xl:w-3.5 lg:w-4" width="18px" height="18px" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_134_907)">
                  <path d="M10.5 7.5V10.5H7.5V7.5H10.5ZM12 7.5H15.75V10.5H12V7.5ZM10.5 15.75H7.5V12H10.5V15.75ZM12 15.75V12H15.75V15C15.75 15.1989 15.671 15.3897 15.5303 15.5303C15.3897 15.671 15.1989 15.75 15 15.75H12ZM10.5 2.25V6H7.5V2.25H10.5ZM12 2.25H15C15.1989 2.25 15.3897 2.32902 15.5303 2.46967C15.671 2.61032 15.75 2.80109 15.75 3V6H12V2.25ZM6 7.5V10.5H2.25V7.5H6ZM6 15.75H3C2.80109 15.75 2.61032 15.671 2.46967 15.5303C2.32902 15.3897 2.25 15.1989 2.25 15V12H6V15.75ZM6 2.25V6H2.25V3C2.25 2.80109 2.32902 2.61032 2.46967 2.46967C2.61032 2.32902 2.80109 2.25 3 2.25H6Z" fill="#6435A5" fill-opacity="0.5"/>
                </g>
                <defs>
                  <clipPath id="clip0_134_907">
                    <rect width="18" height="18" fill="white"/>
                  </clipPath>
                </defs>
              </svg>
              <span class="whitespace-nowrap">Прайс-листы</span>
            </div>
            <div @click="changeList" :class="{'chess__button--active': activeList}" class="h-full cursor-pointer flex items-center gap-1 px-2 xl:px-1.5 rounded-[3px]">
              <svg class="w-4.5 xxl:w-4 xl:w-3.5 lg:w-4" width="18px" height="18px" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_134_911)">
                  <path d="M6 3H15.75V4.5H6V3ZM3.375 4.875C3.07663 4.875 2.79048 4.75647 2.5795 4.5455C2.36853 4.33452 2.25 4.04837 2.25 3.75C2.25 3.45163 2.36853 3.16548 2.5795 2.9545C2.79048 2.74353 3.07663 2.625 3.375 2.625C3.67337 2.625 3.95952 2.74353 4.1705 2.9545C4.38147 3.16548 4.5 3.45163 4.5 3.75C4.5 4.04837 4.38147 4.33452 4.1705 4.5455C3.95952 4.75647 3.67337 4.875 3.375 4.875ZM3.375 10.125C3.07663 10.125 2.79048 10.0065 2.5795 9.7955C2.36853 9.58452 2.25 9.29837 2.25 9C2.25 8.70163 2.36853 8.41548 2.5795 8.2045C2.79048 7.99353 3.07663 7.875 3.375 7.875C3.67337 7.875 3.95952 7.99353 4.1705 8.2045C4.38147 8.41548 4.5 8.70163 4.5 9C4.5 9.29837 4.38147 9.58452 4.1705 9.7955C3.95952 10.0065 3.67337 10.125 3.375 10.125ZM3.375 15.3C3.07663 15.3 2.79048 15.1815 2.5795 14.9705C2.36853 14.7595 2.25 14.4734 2.25 14.175C2.25 13.8766 2.36853 13.5905 2.5795 13.3795C2.79048 13.1685 3.07663 13.05 3.375 13.05C3.67337 13.05 3.95952 13.1685 4.1705 13.3795C4.38147 13.5905 4.5 13.8766 4.5 14.175C4.5 14.4734 4.38147 14.7595 4.1705 14.9705C3.95952 15.1815 3.67337 15.3 3.375 15.3ZM6 8.25H15.75V9.75H6V8.25ZM6 13.5H15.75V15H6V13.5Z" fill="#6435A5" fill-opacity="0.5"/>
                </g>
                <defs>
                  <clipPath id="clip0_134_911">
                    <rect width="18" height="18" fill="white"/>
                  </clipPath>
                </defs>
              </svg>
              <span class="whitespace-nowrap">Список</span>
            </div>
          </div>
          <button class="bg-[#E84680] h-9 xxl:h-8 xl:h-7 rounded-[3px] px-6 xxl:px-5 xl:px-4 whitespace-nowrap text-base xxl:text-sm xl:text-xs leading-none font-semibold text-white">Информация о ЖК</button>
        </div>
      </div>
    </div>
    <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
    <div class="grid grid__chess">
      <div class="">
        <div class="flex border__right-bottom">
          <div class="relative z-30 ml-[6.25vw]">
            <div @click="openCost = !openCost" class="cursor-pointer border__right flex items-center gap-10 xxl:gap-8 xl:gap-6 py-3 xxl:py-2.5 xl:py-2 pr-4 xxl:pr-3 xl:pr-2.5">
              <span class="text-base xxl:text-sm xl:text-xs leading-none">Цена</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2" alt="">
            </div>
            <div v-if="openCost" class="max-h-[150px] bg-white overflow-y-auto custom__scroll-grey flex flex-col absolute w-full rounded-[5px] top-[120%] left-0 flex border border-solid border-[#E5DFEE]">
              <span
                @click="openCost = false"
                v-for="cost in costs"
                class="hover__select cursor-pointer text-base xxl:text-sm xl:text-xs leading-none px-2 py-2 xxl:py-1.5 xl:py-1 whitespace-nowrap"
              >
                {{ cost.cost }}
              </span>
            </div>
          </div>
          <div class="relative z-30">
            <div @click="openSquare = !openSquare" class="cursor-pointer border__right flex items-center gap-10 xxl:gap-8 xl:gap-6 py-3 xxl:py-2.5 xl:py-2 px-4 xxl:px-3 xl:px-2.5">
              <span class="text-base xxl:text-sm xl:text-xs leading-none">Площадь</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2" alt="">
            </div>
            <div v-if="openSquare" class="max-h-[150px] bg-white overflow-y-auto custom__scroll-grey flex flex-col absolute w-full rounded-[5px] top-[120%] left-0 flex border border-solid border-[#E5DFEE]">
              <span
                @click="openSquare = false"
                v-for="square in squares"
                class="hover__select cursor-pointer text-base xxl:text-sm xl:text-xs leading-none px-2 py-2 xxl:py-1.5 xl:py-1 whitespace-nowrap"
              >
                {{ square.square }}
              </span>
            </div>
          </div>
          <div class="relative z-30">
            <div @click="openLayout = !openLayout" class="cursor-pointer border__right flex items-center gap-10 xxl:gap-8 xl:gap-6 py-3 xxl:py-2.5 xl:py-2 px-4 xxl:px-3 xl:px-2.5">
              <span class="text-base xxl:text-sm xl:text-xs leading-none">Планировка</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2" alt="">
            </div>
            <div v-if="openLayout" class="max-h-[150px] bg-white overflow-y-auto custom__scroll-grey flex flex-col absolute w-full rounded-[5px] top-[120%] left-0 flex border border-solid border-[#E5DFEE]">
              <span
                @click="openLayout = false"
                v-for="layout in layouts"
                class="hover__select cursor-pointer text-base xxl:text-sm xl:text-xs leading-none px-2 py-2 xxl:py-1.5 xl:py-1 whitespace-nowrap"
              >
                {{ layout.layout }}
              </span>
            </div>
          </div>
        </div>
        <app-chess-grid v-if="activeChess"/>
        <app-chess-list v-if="activeList"/>
      </div>
      <div>
        <div class="border__bottom">
          <div class="mr-[6.25vw] lg:mx-auto lg:px-[6.25vw] lg:py-6 flex justify-between lg:justify-start lg:gap-5 p-14 xxl:p-10 xl:p-8">
            <div class="flex flex-col">
              <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs leading-none">№204</span>
              <span class="text-[22px] xxl:text-[18px] xl:text-[15px] font-semibold leading-none pb-4 xxl:pb-3 xl:pb-2.5">7 000 000 €</span>
              <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none pb-5 xxl:pb-4 xl:pb-3">7 000 000 € за м²</span>
              <div class="gray-backg flex items-center gap-1 w-fit px-2 xl:px-1.5 py-1.5 xl:py-1">
                <img class="w-4 xxl:w-3.5 xl:w-3" src="../../assets/svg/ruller_icon.svg" alt="">
                <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">200 м²</span>
              </div>
            </div>
            <img src="../../assets/drawing_small.png" class="w-40 xxl:w-36 xl:w-32" alt="">
          </div>
        </div>
        <div class="flex items-center justify-center justify-between lg:justify-start lg:my-6 mr-[6.25vw] mr-[6.25vw] lg:mx-auto lg:px-[6.25vw]">
          <img @click="openCheme = true" src="../../assets/drawing_big.png" class="cursor-pointer w-[480px] xxl:w-[380px] xl:w-[300px]" alt="">
        </div>
      </div>
    </div>
  </main>
</template>

<script>

import AppChessGrid from "./AppChessGrid.vue"
import AppChessList from "./AppChessList.vue"
import AppChessScheme from "../Layouts/modal/AppChessScheme.vue"
import {computed} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

export default {
  props: ['user'],
  data() {
    return {
      user: computed(() => usePage().props.value.auth.user),
      activeChess: true,
      activeList: false,
      openCost: false,
      costs: [
        {cost: '1 000', id: 0},
        {cost: '2 000', id: 1},
        {cost: '3 000', id: 2},
        {cost: '4 000', id: 3},
        {cost: '5 000', id: 4},
        {cost: '10 000', id: 5},
      ],
      openSquare: false,
      squares: [
        {square: '30', id: 0},
        {square: '40', id: 1},
        {square: '45', id: 2},
        {square: '50', id: 3},
        {square: '60', id: 4},
      ],
      openLayout: false,
      layouts: [
        { layout: '1 + 1', id: 0},
        { layout: '2 + 1', id: 1},
        { layout: '3 + 1', id: 2},
        { layout: '4 + 1', id: 3},
        { layout: '5 + 1', id: 4},
        { layout: '5 + 2', id: 5},
      ],
      openCheme: false,
      openCorpusList: false,
    }
  },
  methods: {
    changeChess() {
      this.activeChess = true
      this.activeList = false
    },
    changeList() {
      this.activeChess = false
      this.activeList = true
    },
    selectsHidden() {

    }
  },
  mounted() {
    document.addEventListener('click', this.selectsHidden.bind(this), true)
  },
  beforeDestroy() {
    document.removeEventListener('click', this.selectsHidden)
  },
  components: {
    AppChessGrid,
    AppChessList,
    AppChessScheme,
  }
}
</script>

<style scoped>

</style>
