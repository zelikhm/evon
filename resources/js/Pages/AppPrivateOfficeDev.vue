<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header :user="user" />
  <main>
    <div class="_container">
      <div class="my-14 xxl:my-10 xl:my-8">
        <div class="flex justify-between items-center mb-7 xxl:mb-5 xl:mb-4">
          <span class="font-semibold ext-[22px] xxl:text-[18px] xl:text-[14px]">Наши объекты</span>
          <Link href="/profile/addedHouse" class="text-base xxl:text-sm xl:text-xs text-white bg-[#E84680] leading-none rounded-[3px] px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2 xl:py-1.5">Добавить объект</Link>
        </div>
        <div v-if="houses.data.length === 0" class="grid grid-cols-2 lg:grid-cols-1 mt-10 xxl:mt-8 xl:mt-6">
          <div class="flex justify-between sm:flex-col sm:items-center p-7 xxl:p-5 xl:p-4 bg-[#F6F3FA] rounded-[10px]">
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] leading-none font-medium">У вас еще не добавлено ни одного объекта</span>
              <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs leading-none">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
            </div>
            <svg class="h-full" width="162" height="113" viewBox="0 0 162 113" fill="#6435A5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <rect width="162" height="113" fill="url(#pattern0)"/>
              <defs>
                <pattern fill="#6435A5" id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                  <use xlink:href="#image0_134_1230" transform="translate(0 -0.0526316) scale(0.00306748 0.00438596)"/>
                </pattern>
                <image id="image0_134_1230" width="326" height="240" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUYAAADwCAYAAAB8M80sAAAZ6ElEQVR4nO3dbWxc13kn8P9zOOaMFAFmYM/ltPVCbOA6dddbqWnWCl8WMddFkzgprKSO34FoESOx07RW4MSxU5E8HAoL2XFgGbtJ5NSFJcCx0sZNZDSregOno2zJoeQWXbnrjRLvS+WFnJAzNkADqaShOefZDxzKM3fuvL8P/79P5J1z731EXT6899xzngMQEREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREdEmJZ0OgHpbbHZ+0ol5GoCnim+lZ8b2djomokaZTgdAvS0r5usAtgPYIoL7o/tPTnQ6JqJGMTFSQwS4tmCD06s7FApR0zAxEhH5MDESEfkwMRIR+TAxEhH5MDESEfkwMRIR+TAxEhH5MDESEfkwMRIR+TAxEhH5MDESEfkwMRIR+TAxUl1GbCIybBeu828XdSPDdsHrRExEzcJ6jFS1qE1sMyZ8jwK3A/hdAKEyzc8B+IE4/fqyHX+lPRESNQcTI1VleHbxNhU9CCBWx+6H1GW+lLaTv2x2XEStwMRIFUVnkwdFcH8jx1DgzICTm5bs6NlmxUXUKkyMVJY3u/gYRB9o0uFeE6fXL9vxVJOOR9QS5fqIaJPz5pK7oYFJ8U0B/kzU/XBNL3s9BLd66ZOQes7J+wDdA2CXb7/tauQIgI+0MGyihvGOkQKN2ETkvAn/LwBX+T763qrLfHrFTq5UOkY0vrhHoN8AsKXgA8HHU1Njx5oXLVFzcbgOBfoXE7kdAUkxNT32h9UkRQBIT48eVnG3AFgr+EDxUHOiJGoNJkYKJNC7fZtWVl3m07UeJz01cRzAU77Nu2J2caTu4IhajImRitlECMBYwTaVP6/2TtHPuYHH/duyBjfUFxxR6/HlCxWJIXKVg/r6BXXCiyfr7BfMAsAF5PU1Guh764+QqLWYGKlI1uCGgLdy/jfMjRodsYnIWTt5scnHJWoY30rTO2wi5JnwfwJwbztOp8AZ4/RWThmkbsPESOvWk+JfA/hwm8/8ljH4/aV9Yy+1+bxEJTEx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"/>
              </defs>
            </svg>
          </div>
        </div>
        <div v-else class="grid grid-cols-2 md:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4 md:gap-10">
          <div class="flex flex-col" v-for="house in houses.data">
            <div class="object__block relative h-[500px] exl:h-fit exl:h-[26vw] md:h-[52vw]">
              <img v-if="house.images.length > 0" :src="house.images[0].name" class="w-full h-full rounded-[8px]" alt="">
              <img v-else src="../../assets/no-img-houses-zastroy.jpg" class="w-full h-full rounded-[8px]" alt="">
              <div class="seek opacity-0 absolute top-0 left-0 immovables__overlay w-full h-full rounded-[8px]"></div>
              <div class="hide absolute flex gap-2 top-0 left-0 p-5 xxl:p-4 xl:p-3">
                <span class="bg-[#E84680] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none" v-if="house.active === 0">на модерации</span>
                <span class="bg-[#E84680] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none" v-if="house.active === 1">не прошло модерацию</span>
                <span class="bg-[#30CB49] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-white text-sm xxl:text-xs xl:text-[10px] leading-none" v-if="house.active === 2">опубликованно</span>
              </div>
              <div class="seek opacity-0 transition-all absolute z-10 top-1/2 w-full flex flex-col gap-3 xxl:gap-2 xl:gap-1.5 sm:gap-1 items-center -translate-x-1/2 -translate-y-1/2 left-1/2">
                <Link :href="'/profile/edit/' + house.slug + '#edit'" class="immovables__button--card flex items-center justify-between w-[30%] lg:w-[50%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5 sm:py-1">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">Редактировать</span>
                  <img src="../../assets/svg/pen_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </Link>
                <button @click="deleteHouse(house)" class="immovables__button--card flex items-center justify-between w-[30%] lg:w-[50%]  border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5 sm:py-1">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">Удалить</span>
                  <img src="../../assets/svg/bucket_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button @click="changeVisible(house)" class="immovables__button--card flex items-center justify-between w-[30%] lg:w-[50%]  border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5 sm:py-1">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">{{ house.visible ? 'Скрыть' : 'Показать' }}</span>
                  <img v-if="!house.visible" src="../../assets/svg/hide_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                  <img v-else src="../../assets/svg/eye_icon_grey.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <Link :href="'/house/' + house.slug" class="immovables__button--card flex items-center justify-between w-[30%] lg:w-[50%]  border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5 sm:py-1">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">Посмотреть на сайте</span>
                  <img src="../../assets/svg/planet_icon_white.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </Link>
                <Link :href="'/profile/news/create#' + house.id" class="immovables__button--card flex items-center justify-between w-[30%] lg:w-[50%] border border-solid border-[#EFEEF580] rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-3 xxl:py-2 xl:py-1.5 sm:py-1">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none whitespace-nowrap">Добавить новость</span>
                  <img src="../../assets/svg/plus_icon.svg" class="w-4.5 xxl:w-3.5 xl:w-3" alt="">
                </Link>
              </div>
            </div>
            <div class="flex flex-col p-5 xxl:p-4 xl:p-3">
              <Link :href="'/profile/edit/' + house.slug + '#edit'" class="font-semibold text-xl xxl:text-base xl:text-[13px]">{{ house.title }}</Link>
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
<!--        <p>-->
<!--          {{ page + ' ' + pages}}-->
<!--        </p>-->
<!--        <div class="w-full flex justify-center mt-24 xxl:mt-20 xl:mt-16 gap-3 xxl:gap-2.5 xl:gap-2 items-center text-[#8A8996] text-lg xxl:text-[15px] xl:text-[13px]">-->
<!--          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">-->
<!--            <img src="../../assets/svg/arrow_right_grey.svg" class="rotate-180 w-5 xxl:w-4 xl:w-3" alt="">-->
<!--          </div>-->

<!--          <div class="flex gap-2" v-if="page + 2 <= pages">-->
<!--            <Link-->
<!--              v-for="index in pages"-->
<!--              :key="index"-->
<!--              @click="tab.active = !tab.active"-->
<!--              :class="{'select__pagination': 1}"-->
<!--              class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer"-->
<!--              :href="'?page=' + index"-->
<!--            >-->
<!--              {{ index }}-->
<!--            </Link>-->
<!--          </div>-->
<!--          <div v-else-if="page + 2 > pages">-->
<!--             <div v-if="page - 2 >= 1 && page - 2 <= 3">-->
<!--               <Link-->
<!--                 v-for="number in pages"-->
<!--                 @click="tab.active = !tab.active"-->
<!--                 :class="{'select__pagination': 1}"-->
<!--                 class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer"-->
<!--                 :href="'?page=' + number"-->
<!--               >-->
<!--                 {{ number }}-->
<!--               </Link>-->
<!--             </div>-->
<!--            <div v-else-if="page - 2 > 3">-->

<!--            </div>-->
<!--          </div>-->


<!--          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">-->
<!--            <img src="../../assets/svg/arrow_right_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">-->
<!--          </div>-->
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
      pages: 0,
      page: 0,
      nextPage: 0,
    }
  },
  methods: {
    changeSelectTime(time, object) {
      object.selectTime = time.time
      object.openWatchTime = !object.openWatchTime
      object.views = object.view[time.id]
    },
    deleteHouse(house) {
      this.houses.data.forEach((item, idx) => {
        if (item.id === house.id) {
          this.houses.data.splice(idx, 1)
        }
      })
      axios.post('/api/house/delete', { house_id: house.id, token: this.globalToken }).then(res => console.log(res)).catch(err => console.error(err))
    },
    changeVisible(item) {
      item.visible = !item.visible
      axios.post('/api/house/setVisible', { house_id: item.id, visible: item.visible, token: this.globalToken }).then(res => { console.log(res.data) })
    }
  },
  created() {
    this.houses.data.forEach(item => {
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
    this.page = new URL(location.href).searchParams.get('page');
    this.page = +this.page;
    this.pages = this.houses.last_page;
    console.log(this.houses)
    console.log(this.user)
  }
}
</script>

<style scoped>

</style>
