<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-modal-notification
    class="left-[2vw] transition-all duration-1000"
    :class="{'-left__full': !openNotification}"
    @close-notification="openNotification = false"
  />
  <header class="relative h-[13.4vw]">
    <img v-if="compilation.company === null" class="w-full absolute top-0 left-0 h-full" src="../../assets/bg_links.jpg" alt="">
    <img v-else class="object-cover w-full absolute top-0 left-0 h-full" :src="compilation.company.banner" alt="">
    <div class="_container flex h-full">
      <div class="self-end flex items-center gap-7 xxl:gap-6 xl:gap-5 mb-10 xxl:mb-8 xl:mb-6">
        <div v-if="compilation.company === null" class="flex-shrink-0 bg-black w-20 xxl:w-16 xl:w-12 h-20 xxl:h-16 xl:h-12 rounded-full flex items-center justify-center">
        <img   class="w-10 xxl:w-8 xl:w-6" src="../../assets/svg/city_icon_white.svg" alt="">
        </div>
        <img class="flex-shrink-0 bg-black w-20 xxl:w-16 xl:w-12 h-20 xxl:h-16 xl:h-12 rounded-full flex items-center justify-center object-cover" v-else :src="compilation.company.image" alt="">
        <div class="text-white flex flex-col gap-2 xxl:gap-1.5 xl:gap-1">
          <span class="text-[15px] xxl:text-[13px] xl:text-[11px] leading-none" v-if="compilation.company !== null">{{ compilation.company.title }}</span>
          <span class="text-[15px] xxl:text-[13px] xl:text-[11px] leading-none">Агенство недвижимости</span>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="_container">
      <div class="my-10 xxl:my-8 xl:my-6">
        <div>
        </div>
        <div class="grid__75-25 gap-7 xxl:gap-5 xl:gap-4">
          <div class="flex flex-col gap-y-14 xxl:gap-y-10 xl:gap-y-8">
            <div v-for="i in houses">
              <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] mb-5 xxl:mb-4 xl:mb-3">{{ i[0].city }}</h2>
              <div class="grid grid-cols-3 gap-x-7 xxl:gap-x-5 xl:gap-x-4 gap-y-14 xxl:gap-y-10 xl:gap-y-8">
                <div class="flex flex-col" v-for="item in i">
                  <Link :href="href + '/' + item.slug">
                    <div class="relative rounded-[5px]">
                      <img class="h-[15vw] w-full object-cover" :src="item.image" v-if="item.image" alt="">
                      <img class="h-[15vw] w-full object-cover" v-else src="../../assets/no-img-houses-zastroy.jpg" alt="">
                      <div class="absolute flex flex-col justify-between top-0 left-0 w-full h-full text-[14px] xxl:text-[12px] xl:text-[10px]">
                        <span class="bg-[#30CB49] uppercase self-end text-white leading-none px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 m-4 xxl:m-3 xl:m-2.5 rounded-[3px]" v-if="item.created && !Number.isInteger(+item.created[0])">{{ item.created }}</span>
                        <span class="bg-[#E84680] uppercase self-end text-white leading-none px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 m-4 xxl:m-3 xl:m-2.5 rounded-[3px]" v-else-if="item.created">{{ item.created }}</span>
                        <div class="flex items-center text-white gap-2 xxl:gap-1.5 xl:gap-1 p-5 xxl:p-4 xl:p-3">
                          <span class="leading-none">{{ item.area }}</span>
                          <div class="bg-white h-1 w-1 rounded-full "></div>
                          <span class="leading-none">{{ item.flats.length }} Квартир</span>
                        </div>
                      </div>
                    </div>
                    <div class="text-[#1E1D2D] flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 p-5 xxl:p-4 xl:p-3">
                      <span class="font-bold text-[20px] xxl:text-[16px] xl:text-[13px] leading-none">{{ compilation.isVisible === 1 ? item.title : `Лот №${item.id + 10000}` }}</span>
                      <span class="text-[18px] xxl:text-[15px] xl:text-[13px] leading-none">от {{ item.minPrice }} €, от {{ Math.round(item.minSquare / item.minPrice) }} € за м2</span>
                    </div>
                  </Link>
                </div>
              </div>
            </div>
          </div>
          <div class="sticky w-full contact__selling h-fit bg-white rounded-[10px] p-4 xxl:p-3 xl:p-2.5">
            <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 mb-5 xxl:mb-4 xl:mb-4">
              <img :src="compilation.user.image" class="object-cover w-14 xxl:w-12 xl:w-10 rounded-full h-14 xxl:h-12 xl:h-10" alt="">
              <div class="flex flex-col gap-2 xxl:gap-1.5 xl:gap-1">
                <span class="text-[18px] xxl:text-[15px] xl:text-[13px] leading-none font-medium">{{ compilation.user.first_name + ' ' + compilation.user.last_name }}</span>
                <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">{{ compilation.user.status }}</span>
              </div>
            </div>
            <div class="flex items-center mb-5 xxl:mb-4 xl:mb-4 text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">
              <span class="text-[#8A8996] leading-none">Языки:&nbsp;</span>
              <span class="leading-none">{{ compilation.user.link }}</span>
            </div>
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mb-5">
              <div class="flex cursor-pointer bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
                <img src="../../assets/svg/chat_tel_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                <span class="leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px]">{{ compilation.user.phone }}</span>
              </div>
              <div class="flex cursor-pointer bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
                <img src="../../assets/svg/chat_mail_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                <span class="leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px]">{{ compilation.user.email }}</span>
              </div>
            </div>
            <span class="w-full text-[15px] xxl:text-[13px] xl:text-[11px]">Комментарий подборки: {{ compilation.description }}</span>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppFooter from "@/Layouts/AppFooter.vue"
import AppModalNotification from "@/Layouts/modal/AppModalNotification.vue"


export default {
  props: {
    houses: [],
    compilation: [],
    user: {}
  },
  data() {
    return {
      openNotification: false,
      href: null
    }
  },
  methods: {

  },
  created() {
    console.log(this.compilation)
    this.href = window.location.href

    for (let key in this.houses) {
      this.houses[key].forEach(item => {
        let minSquare = [],
            minPrice = []
        item.flats.forEach(flat => {
          minSquare.push(flat.square)
          minPrice.push(flat.price)
        })
        item.minSquare = Math.min(...minSquare)
        item.minPrice = Math.min(...minPrice)
      })
    }
  },
  components: {
    AppFooter,
    AppModalNotification,
  }
}
</script>

<style scoped>

.validate {
  border: 1px solid red;
}

</style>
