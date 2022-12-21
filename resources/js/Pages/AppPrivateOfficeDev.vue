<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header />
  <main>
    <div class="_container">
      <div class="my-14 xxl:my-10 xl:my-8">
        <div class="flex justify-between items-center mb-7 xxl:mb-5 xl:mb-4">
          <span class="font-semibold ext-[22px] xxl:text-[18px] xl:text-[14px]">Наши объекты</span>
          <Link href="/profile/addedHouse" class="text-base xxl:text-sm xl:text-xs text-white bg-[#E84680] leading-none rounded-[3px] px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2 xl:py-1.5">Добавить объект</Link>
        </div>
        <div class="grid grid-cols-2 gap-7 xxl:gap-5 xl:gap-4">
          <div class="flex flex-col" v-for="house in houses">
            <div class="object__block relative h-[26vw]">
              <img :src="'/storage/' + house.image" class="w-full h-full rounded-[8px]" alt="">
              <div class="seek hidden absolute top-0 left-0 immovables__overlay w-full h-full rounded-[8px]"></div>
              <div class="hide absolute flex gap-2 top-0 left-0 p-5 xxl:p-4 xl:p-3">
                <span class="bg-[#E84680] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none" v-if="house.active === 0">на модерации</span>
                <span class="bg-[#E84680] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none" v-if="house.active === 1">не прошло модерацию</span>
                <span class="bg-[#30CB49] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none" v-if="house.active === 2">опубликованно</span>
              </div>
              <div class="seek opacity-0 transition-all absolute z-10 top-1/2 w-full flex flex-col gap-3 xxl:gap-2 xl:gap-1.5 items-center -translate-x-1/2 -translate-y-1/2 left-1/2">
                <Link :href="'/profile/edit/' + house.id" class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Редактировать</span>
                  <img src="../../assets/svg/pen_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </Link>
                <button class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span @click="deleteHouse(house)" class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Удалить</span>
                  <img src="../../assets/svg/bucket_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button @click="changeVisible(house)" class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">{{ house.visible === 1 ? 'Скрыть' : 'Показать' }}</span>
                  <img v-if="house.visible !== 0" src="../../assets/svg/eye_icon_grey.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                  <img v-else src="../../assets/svg/hide_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <Link :href="'/house/' + house.slug" class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Посмотреть на сайте</span>
                  <img src="../../assets/svg/planet_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </Link>
                <Link :href="'/profile/news/create#' + house.id" class="flex items-center justify-between w-[30%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Добавить новость</span>
                  <img src="../../assets/svg/plus_icon.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </Link>
              </div>
            </div>
            <div class="flex flex-col p-5 xxl:p-4 xl:p-3">
              <span class="font-semibold text-xl xxl:text-base xl:text-[13px]">{{ house.slug }}</span>
              <div class="relative">
                <span @click="house.openWatchTime = !house.openWatchTime" class="w-fit cursor-pointer flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
                  <img src="../../assets/svg/eye_icon_grey.svg" class="w-4 xxl:w-3.5 xl:w-3" alt="">
                  <span class="text-[#8A8996] leading-none text-lg xxl:text-[15px] xl:text-[13px]"><span class="text-[#6435A5]"> {{ house.views === null ? house.view[0] : house.views }} </span> {{ house.selectTime === null ? house.watchTime[0].time : house.selectTime }}</span>
                  <img src="../../assets/svg/arrow_down_black.svg" alt="">
                </span>
                <div v-if="house.openWatchTime" class="absolute top-[120%] text-lg xxl:text-[15px] xl:text-[13px] rounded-[3px] z-40 border bg-white border-solid border-[#E5DFEE] flex flex-col">
                  <span
                    v-for="(time, idx) in house.watchTime" :key="idx"
                    @click="changeSelectTime(time, house)"
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
          <div
            @click="tab.active = !tab.active"
            v-for="tab in tabsPagination"
            :class="{'select__pagination': tab.active}"
            class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer"
          >
            {{ tab.number }}
          </div>
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
  props: {
    houses: [],
    user: []
  },
  data() {
    return {
      objects: [
        {
          name: '',
          active: false
        },
        { name: '', active: false },
      ],
      selectTime: 'за день',
      tabsPagination: [
        { number: '1', active: false },
        { number: '2', active: false },
        { number: '3', active: false },
        { number: '...', active: false },
        { number: '24', active: false },
      ],
    }
  },
  methods: {
    changeSelectTime(time, object) {
      object.selectTime = time.time
      object.openWatchTime = !object.openWatchTime
      object.views = object.view[time.id]
    },
    deleteHouse(item) {
      axios.post('/api/house/delete', { house_id: item.id, token: this.globalToken })
    },
    changeVisible(item) {
      item.visible = !item.visible
      axios.post('/api/house/setVisible', { house_id: item.id, visible: item.visible, token: this.globalToken })
    }
  },
  created() {
    this.houses.forEach(item => {
      item.openWatchTime = false
      item.views = null
      item.selectTime = null

      item.watchTime = []
      item.watchTime.push(
        { id: 0, time: 'за день' },
        { id: 1, time: 'за 5 дней' },
        { id: 2, time: 'за неделю' },
        { id: 3, time: 'за месяц' },
        { id: 4, time: 'за год' },
      )
    })
  },
  components: {
    AppHeader,
    AppFooter,
  },
  mounted() {
    console.log(this.houses)
    console.log(this.user)
  }
}
</script>

<style scoped>

</style>
