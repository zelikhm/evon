<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ChangeLanguage from "@/Components/ChangeLanguage.vue";
</script>

<template>
  <app-modal-notification class="left-[2vw] transition-all duration-1000" :class="{ '-left__full': !openNotification }"
    @close-notification="openNotification = false" />
  <header class="relative">
    <div class="bg-[#6435A5] h-[60px] xxl:h-12 xl:h-10 lg:h-12">
      <div class="_container h-full text-[16px] xxl:text-[13px] xl:text-[11px]">
        <div class="flex items-center justify-between h-full">
          <Link href="/houses" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
          </Link>
          <change-language @selectLanguage="choseLanguage" :selectLang="selectLanguage" />
        </div>
      </div>
    </div>

    <img
      v-if="compilation.company === null || compilation.company.banner === null || compilation.company.banner === 'undefined'"
      class="h-[13.4vw] lg:h-[130px] w-full object-cover absolute top-[60px] xxl:top-12 xl:top-10 lg:top-12 left-0"
      src="../../assets/bg_links.jpg" alt="">
    <img v-else
      class="h-[13.4vw] lg:h-[130px] object-cover w-full absolute top-[60px] xxl:top-12 xl:top-10 lg:top-12 left-0"
      :src="compilation.company.banner" alt="">
    <div class="_container flex h-[13.4vw] lg:h-[130px] ">
      <div class="self-end flex items-center gap-7 xxl:gap-6 xl:gap-5 mb-10 xxl:mb-8 xl:mb-6">
        <div
          v-if="compilation.company === null || compilation.company.image === null || compilation.company.image === 'undefined'"
          class="flex-shrink-0 bg-black w-24 xxl:w-20 xl:w-16 h-24 xxl:h-20 xl:h-16 rounded-full flex items-center justify-center">
          <img class="w-10 xxl:w-8 xl:w-6" src="../../assets/svg/city_icon_white.svg" alt="">
        </div>
        <div v-else>
          <img
            class="flex-shrink-0 bg-black w-24 xxl:w-20 xl:w-16 h-24 xxl:h-20 xl:h-16 rounded-full flex items-center justify-center object-cover"
            :src="compilation.company.image" alt="">
        </div>
        <div class="text-white flex flex-col gap-2 xxl:gap-1.5 xl:gap-1">
          <span class="text-[18px] xxl:text-[16px] xl:text-[14px] lg:text-[16px] leading-none"
            v-if="compilation.company !== null">{{ compilation.company.title }}</span>
          <span class="text-[18px] xxl:text-[16px] xl:text-[14px] lg:text-[16px] leading-none" v-else>{{ language.ob[18]
          }}</span>
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
              <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] lg:text-[20px] mb-5 xxl:mb-4 xl:mb-3">{{
                getCity(i[0].city) }}</h2>
              <div
                class="grid grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-x-7 xxl:gap-x-5 xl:gap-x-4 gap-y-14 xxl:gap-y-10 xl:gap-y-8">
                <div class="flex flex-col" v-for="item in i">
                  <Link :href="href + '/' + item.slug">
                  <div class="relative rounded-[5px]">
                    <img v-if="item.image" class="h-[295px] exl:h-[15vw] md:h-[28vw] sm:h-[43vw] w-full object-cover" :src="imageServiceUrl + item.image.name" alt="">
                    <img class="exl:h-[15vw] md:h-[28vw] sm:h-[43vw w-full object-cover" v-else
                      src="../../assets/no-img-houses-zastroy.jpg" alt="">
                    <div
                      class="absolute flex flex-col justify-between top-0 left-0 w-full h-full text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px]">
                      <span
                        class="bg-[#30CB49] uppercase self-end text-white leading-none px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 m-4 xxl:m-3 xl:m-2.5 rounded-[3px]"
                        v-if="item.created && !Number.isInteger(+item.created[0])">{{ item.created }}</span>
                      <span
                        class="bg-[#E84680] uppercase self-end text-white leading-none px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 m-4 xxl:m-3 xl:m-2.5 rounded-[3px]"
                        v-else-if="item.created">{{ item.created }}</span>
                      <div class="flex items-center text-white gap-2 xxl:gap-1.5 xl:gap-1 p-5 xxl:p-4 xl:p-3">
                        <span class="leading-none">{{ item.area }}</span>
                        <div class="bg-white h-1 w-1 rounded-full "></div>
                        <span class="leading-none">{{ item.flats.length }} {{ language.dob_kv_1[17] }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="text-[#1E1D2D] flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 p-5 xxl:p-4 xl:p-3">
                    <span class="font-bold text-[20px] xxl:text-[16px] xl:text-[13px] lg:text-[18px] leading-none">{{
                      compilation.isVisible === 1 ? item.title : language.ob[20] + `№${item.id + 10000}` }}</span>
                    <span class="text-[18px] xxl:text-[15px] xl:text-[13px] leading-none">{{ language.rielt_1[19] }} {{
                      getMinPrice(item) }} €</span>
                  </div>
                  </Link>
                </div>
              </div>
            </div>
          </div>
          <div class="sticky top-[40px] w-full contact__selling h-fit bg-white rounded-[10px] p-4 xxl:p-3 xl:p-2.5">
            <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 mb-5 xxl:mb-4 xl:mb-4">
              <img v-if="compilation.user.image" :src="compilation.user.image"
                class="object-cover w-14 xxl:w-12 xl:w-10 rounded-full h-14 xxl:h-12 xl:h-10" alt="">
              <img v-else src="../../assets/no-img-houses.jpg"
                class="object-cover w-14 xxl:w-12 xl:w-10 rounded-full h-14 xxl:h-12 xl:h-10" alt="">
              <div class="flex flex-col gap-2 xxl:gap-1.5 xl:gap-1">
                <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none font-medium">{{
                  compilation.user.first_name + ' ' + compilation.user.last_name }}</span>
                <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px] leading-none">{{
                  compilation.user.status }}</span>
              </div>
            </div>
            <div
              class="flex items-center mb-5 xxl:mb-4 xl:mb-4 text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px] leading-none">
              <span class="text-[#8A8996] leading-none">{{ language.dob_ob_2[7] }}:&nbsp;</span>
              <span class="leading-none">{{ compilation.user.link }}</span>
            </div>
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mb-5">
              <div class="flex cursor-pointer bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px] ">
                <img src="../../assets/svg/chat_tel_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5 lg:w-[4.5]" alt=""
                  v-if="compilation.user.phone">
                <span
                  class="break leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">{{
                    compilation.user.phone }}</span>
              </div>

              <div class="flex cursor-pointer bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px] "
                v-if="compilation.user.email">
                <img src="../../assets/svg/chat_mail_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5 lg:w-[4.5]" alt="">
                <span
                  class="break leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">{{
                    compilation.user.email }}</span>
              </div>
            </div>

            <!--Информация о себе-->
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mb-5" v-if="compilation.user.description">
              <div
                class="flex items-center mb-5 xxl:mb-4 xl:mb-4 text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px] leading-none">
                <span class="text-[#8A8996] leading-none">{{ language.ob[51] }}:&nbsp;</span>
                <!-- <span class="break leading-none">{{ compilation.user.link }}</span> -->
              </div>
              <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5  ">
                <div class="     rounded-[5px] border border-solid border-[#E5DFEE]  p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
                  <span :class="{ hidden: compilation.user.description.length >= 50 && !showFullInfo }"
                    class="break leading-normal	 leading-none text-center w-full   text-[14px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]"><!-- {{ language.rielt_3[3] }}:  -->{{
                      compilation.user.description }}</span>
                  <button v-if="compilation.user.description.length >= 50" @click="showFullInfo = !showFullInfo"
                    class="block more-min mx-auto text-blue-500 underline text-[14px]">
                    {{ showFullInfo ? 'Скрыть' : 'Показать полностью' }}
                  </button>
                </div>

              </div>

            </div>
            <!--Комментарий-->
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5  " v-if="compilation.description">
              <div
                class="flex items-center mb-5 xxl:mb-4 xl:mb-4 text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px] leading-none">
                <span class="text-[#8A8996] leading-none">{{ language.ob[52] }}:&nbsp;</span>
                <!-- <span class="break leading-none">{{ compilation.user.link }}</span> -->
              </div>
              <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mb-5">
                <div class="flex  rounded-[5px] border border-solid border-[#E5DFEE]  p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
                  <span
                    class="break leading-normal	 leading-none text-center w-full   text-[14px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]"><!-- {{ language.rielt_3[3] }}:  -->{{
                      compilation.description }}</span>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import AppFooter from "@/Layouts/AppFooter.vue"
import AppModalNotification from "@/Layouts/modal/AppModalNotification.vue"


export default {
  props: {
    houses: [],
    compilation: [],
    user: {},
    city: {},
  },
  data() {
    return {
      showFullInfo: this.compilation.user.description >= 50 ? true : false,
      openNotification: false,
      href: null,
      count: 0,
      selectLanguage: 0,
      language: {},
      selectLang: 0,
      imageServiceUrl: ''
    }
  },
  methods: {
    getCity(city) {
      let name = this.city.find(item => item.title === city);

      if (this.selectLanguage === 0) {
        return name.title;
      } else if (this.selectLanguage === 1) {
        return name.title_en;
      } else if (this.selectLanguage === 2) {
        return name.title_tr;
      }
    },
    getMinPrice(house) {
      let object = [];

      house.flats.forEach(item => {
        object.push(item.price);
      })

      object.sort((a, b) => a - b);

      return object.length > 0 ? object[0].toFixed(0) : 0;

    },
    getMaxPrice(house) {
      let object = [];

      house.flats.forEach(item => {
        object.push((item.price / item.square));
      })

      object.sort((a, b) => b - a);

      return object.length > 0 ? object[0].toFixed(2) : 0;
    },
    choseLanguage(n) {
      this.selectLanguage = n;

      if (this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }
    },
  },
  created() {
    this.imageServiceUrl = this.$service
    this.href = window.location.href

    if (this.user.length !== 0) {
      if (this.user.lang === 0) {
        this.language = this.$ru;
        this.selectLanguage = 0;
      } else if (this.user.lang === 1) {
        this.language = this.$en;
        this.selectLanguage = 1;
      } else if (this.user.lang === 2) {
        this.language = this.$tur;
        this.selectLanguage = 2;
      }
    } else {
      this.language = this.$ru;
    }

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

.break {
  white-space: normal;
  word-break: break-all;
}

.hidden {
  max-height: 90px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  word-break: break-word;
  text-overflow: ellipsis;
}
</style>
