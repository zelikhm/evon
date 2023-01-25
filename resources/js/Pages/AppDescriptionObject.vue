<template>
  <app-header :user="user" />
  <app-modal-album
    v-if="album"
    :image="house.images"
    @close-album="album = false"
  />
  <app-add-selections
    v-if="openAddSelection"
    @open-i-create-selections="openCreateSel"
    @close-add-selection="openAddSelection = false"
    :compilation="compilation"
    :house="house"
  />
  <app-immovables-create-selection
    v-if="openCreateSelection"
    @close-i-create-selection="closeCreateSel"
  />
  <app-all-news
    v-if="openAllNews"
    @close-all-news="openAllNews = false"
    :house="house" />
  <app-chess  />
  <main v-if="false">
    <div class="_container flex flex-col">
      <div class="decription__head h-20 xxl:h-16 xl:h-12 md:h-fit rounded-[12px] my-7 xxl:my-5 xl:my-4">
        <div class="flex md:flex-col items-center justify-between">

          <div class="flex flex-col p-4 xxl:p-3 xl:p-2">
            <div class="flex items-center md:justify-center gap-5 xxl:gap-4 xl:gap-3">
              <span class="font-semibold text-xl xxl:text-lg xl:text-sm lg:text-[19px]">{{ house.title }}</span>
              <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1 text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px]">
                <span class="flex items-center justify-center uppercase border border-solid border-[#30CB49] h-fit text-[#30CB49] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]" v-if="house.info.status !== null">{{ house.info.status }}</span>
                <span class="flex items-center justify-center text-white font-semibold bg-[#FA8D50] leading-none rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]" v-if="!house.fool_price">акция</span>
              </div>
            </div>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">{{ house.city }}, {{ house.area }}</span>
          </div>

          <div class="flex md:flex-col md:items-center h-20 xxl:h-16 xl:h-12 md:h-fit">
            <div class="border__right md:border-0 flex items-center md:flex-col gap-5 xxl:gap-4 xl:gap-3 p-4 xxl:p-3 xl:p-2">
              <div class="flex items-center gap-1.5 xxl:gap-1 xl:gap-0.5">
                <img src="../../assets/svg/reload_icon.svg" class="h-4 xx:h-3.5 xl:h-3 lg:h-4" alt="reload">
                <span class="text-sm xxl:text-xs xl:text-[10px] lg:text-[15px]">Сегодня</span>
              </div>
              <div @click="map = !map" class="flex items-center justify-center cursor-pointer bg-[#F6F3FA] gap-2 xxl:gap-1.5 xl:gap-1 h-10 xxl:h-8 xl:h-6 lg:h-8 px-4 xxl:px-3 xl:px-2.5 rounded-[3px]">
                <img src="../../assets/svg/map_pointer.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="mark">
                <span class="text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] lg:text-[15px] leading-none">{{ map ? "Скрыть карту" : "Показать на карте" }}</span>
              </div>
            </div>

            <div v-if="user.role === 0" class="border__right md:border-0 flex items-center gap-3 xxl:gap-2 xl:gap-1.5 p-4 xxl:p-3 xl:p-2">
              <button @click="openAddSelection = true" class="relative plus__hover flex items-center justify-center h-10 xxl:h-8 xl:h-6 lg:h-8 w-10 xxl:w-8 xl:w-6 lg:w-8 bg-[#F6F3FA] rounded-[3px]">
                <img src="../../assets/svg/plus_icon_grey.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="plus">
                <div class="seek absolute opacity-0 overflow-hidden pointer-events-none px-3 xxl:px-2.5 xl:px-2 bg-white border border-solid border-[#E5DFEE] rounded-[3px] z-10 text-base xxl:text-sm xl:text-xs top-[140%] -left-1/2 whitespace-nowrap transition-all">Добавить в подборку</div>
              </button>
              <button v-if="!flagFavorite" @click="addToFavorite" class="relative heart__hover flex items-center justify-center h-10 xxl:h-8 xl:h-6 lg:h-8 w-10 xxl:w-8 xl:w-6 lg:w-8 bg-[#F6F3FA] rounded-[3px]">
                <img src="../../assets/svg/heart_icon_grey.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Сердце">
                <div class="seek absolute opacity-0 overflow-hidden pointer-events-none px-3 xxl:px-2.5 xl:px-2 bg-white border border-solid border-[#E5DFEE] rounded-[3px] z-10 text-base xxl:text-sm xl:text-xs top-[140%] -left-1/2 whitespace-nowrap transition-all">Добавить в избранное</div>
              </button>
              <button v-if="flagFavorite" @click="removeToFavorite" class="relative heart__hover flex items-center justify-center h-10 xxl:h-8 xl:h-6 lg:h-8 w-10 xxl:w-8 xl:w-6 lg:w-8 bg-[#F6F3FA] rounded-[3px]">
                <img src="../../assets/svg/heart_icon_pink.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Сердце">
                <div class="seek absolute opacity-0 overflow-hidden pointer-events-none px-3 xxl:px-2.5 xl:px-2 bg-white border border-solid border-[#E5DFEE] rounded-[3px] z-10 text-base xxl:text-sm xl:text-xs top-[140%] -left-1/2 whitespace-nowrap transition-all">Удалить с избранных</div>
              </button>
            </div>

            <div class="flex items-center p-4 xxl:p-3 xl:p-2">
              <button class="login__btn--bg bg-[#E84680] px-4 xxl:px-4 xl:px-2.5 rounded-[3px] h-10 xxl:h-8 xl:h-6 font-semibold text-white text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px] leading-none">Смотреть прайс-лист</button>
            </div>
          </div>
        </div>
      </div>
      <app-map @open-add-selections="openAddSelection = true" v-if="map" :houses="house" :state="false" />
      <div class="grid__68-30 justify-between" v-if="!map">
        <div class="w-full flex flex-col">
          <swiper
            :navigation="true"
            :pagination="{
              clickable: true,
            }"
            :modules="modules"
            :loop="true"
            class="mySwiper w-full"
          >
            <swiper-slide class="h-full flex justify-center">
              <img @click="album = true" class="h-full w-full" :src="house.image" alt="">
            </swiper-slide>
            <swiper-slide class="h-full flex justify-center" v-for="item in mainPhotos">
              <img @click="album = true" class="h-full w-full" :src="item.name" alt="">
            </swiper-slide>
          </swiper>
          <div class="border border-solid border-[#E5DFEE] h-[100px] xxl:h-[80px] xl:h-[60px] sm:h-fit flex items-center sm:flex-col justify-evenly rounded-[12px] mt-7 xxl:mt-5 xl:mt-4 mb-16 xxl:mb-12 xl:mb-10">
            <div class="flex flex-col justify-center sm:p-2">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none">{{ house.info.type }}</span>
              <span class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]">Тип дома</span>
            </div>
            <div class="h-full w-[1px] sm:h-[1px] sm:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center sm:p-2">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none">{{ countFlats }}</span>
              <span class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]">Квартир</span>
            </div>
            <div class="h-full w-[1px] sm:h-[1px] sm:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center sm:p-2">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none">{{  Number.isInteger(minPriceForM) ? minPriceForM : "-"  }} €</span>
              <span class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]">Мин за м²</span>
            </div>
            <div class="h-full w-[1px] sm:h-[1px] sm:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center sm:p-2">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none">{{ Number.isInteger(minPriceFlat) ? minPriceFlat : "-" }} €</span>
              <span class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]">Мин. цена</span>
            </div>
            <div class="h-full w-[1px] sm:h-[1px] sm:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center sm:p-2">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-center leading-none">{{ Number.isInteger(minSquareFlat) ? minSquareFlat : "-" }} - {{ Number.isInteger(maxSquareFlat) ? maxSquareFlat : "-" }}</span>
              <span class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[13px]">Площади, м²</span>
            </div>
          </div>
          <div class="flex flex-col pb-14 xxl:pb-10 xl:pb-8">
            <span class="uppercase font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] pb-5 xxl:pb-4 xl:pb-3 leading-none">О ЖК</span>
            <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4" v-if="fullDescription">{{ house.description }}</p>
<!--            <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4" v-else>{{ house.description.slice(0, 300) + '...' }}</p>-->
            <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4" v-else>{{ house }}</p>
            <button class="flex gap-2 xxl:gap-1.5 xl:gap-1 items-center w-fit animation__arrow" @click="fullDescription = !fullDescription">
              <span class="text-[#6435A5] font-medium text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">{{ fullDescription ? 'Скрыть' : 'Подробнее' }}</span>
              <img src="../../assets/svg/arrow_right_purple.svg" class="transition-all duration-300 w-3.5 xxl:w-3 xl:wp-2.5" alt="Стрелочка в право">
            </button>
          </div>
          <div class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] pb-14 xxl:pb-10 xl:pb-8" v-if="arrayInfos.length > 0">
            <span class="font-medium">Инфраструктура</span>
            <div class="flex flex-wrap gap-3 xxl:gap-2.5 xl:gap-2m pt-4 xxl:pt-3 xl:pt-2.5">
              <span class="infrostruct__banner text-[#E84680] rounded-[12px] xl:rounded-[8px] leading-none px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2 xl:py-1.5"
                    v-for="item in arrayInfos"
              >{{ item.name }}</span>
            </div>
          </div>
          <div class="grid grid-cols-2 md:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4 pb-14 xxl:pb-10 xl:pb-8">
            <div class="border border-solid border-[#E5DFEE] p-7 xxl:p-5 xl:p-4 rounded-[12px]">
              <span class="font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px]">Дополнительные услуги</span>
              <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 pt-6 xxl:pt-5 xl:pt-4">
                <div class="flex justify-between items-center" v-for="dop in dops">
                  <span :class="{ disableColor: dop.active !== 1 }" class="text-base xxl:text-sm xl:text-xs lg:text-[15px]">{{ dop.name }}</span>
                  <div v-if="dop.active === 1" class="bg-[#30CB49] h-5 w-5 xxl:h-4 xxl:w-4 xl:h-3 xl:w-3 lg:w-4 lg:h-4 rounded-full flex items-center justify-center">
                    <img src="../../assets/svg/check_icon.svg" class="w-5 xxl:w-4 xl:w-3 lg:w-4" alt="">
                  </div>
                  <div v-else class="bg-[#E84680] h-5 w-5 xxl:h-4 xxl:w-4 xl:h-3 xl:w-3 lg:w-4 lg:h-4 rounded-full flex items-center justify-center">
                    <img src="../../assets/svg/exit_icon_white.svg" class="w-5 xxl:w-4 xl:w-3 lg:w-4" alt="">
                  </div>
                </div>
              </div>
            </div>
            <div class="border border-solid border-[#E5DFEE] p-7 xxl:p-5 xl:p-4 rounded-[12px]">
              <span class="font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px]">Расположение</span>
              <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 pt-6 xxl:pt-5 xl:pt-4">
                <div class="flex justify-between items-center" v-if="house.info.toSea !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs xl:text-xs lg:text-[15px]">от моря</span>
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]">{{ house.info.toSea }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toShop !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]">от торгового центра</span>
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]">{{ house.info.toShop }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toChildrenSchool !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]">от детского садика</span>
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]">{{ house.info.toChildrenSchool }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toPark !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]">от парка</span>
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]">{{ house.info.toPark }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toBus !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]">от остановки</span>
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]">{{ house.info.toBus }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toSchool !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]">от школы</span>
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px]">{{ house.info.toSchool }} м</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <app-decrition-object-sidebar class="w-full" @open-all-news="openAllNews = true" :house="house" />
      </div>
    </div>
    <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
    <div class="_container">
      <app-description-object-other-j-k :house="house" :slider="slider" />
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppDecritionObjectSidebar from "../Components/AppDecritionObjectSidebar.vue"
import AppDescriptionObjectOtherJK from "../Components/AppDescriptionObjectOtherJK.vue"
import AppModalAlbum from "@/Layouts/modal/AppModalAlbum.vue"
import AppAllNews from "@/Layouts/modal/AppAllNews.vue"
import AppAddSelections from "@/Layouts/modal/AppAddSelections.vue"
import AppImmovablesCreateSelection from "@/Layouts/modal/AppImmovablesCreateSelection.vue"
import AppChess from "@/Components/AppChess.vue"

import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Navigation, Pagination} from "swiper";
import AppMap from "@/Components/AppMap.vue";

export default {
  props: {
    house: [],
    dops: [],
    infos: [],
    slider: [],
    user: [],
    compilation: []
  },
  data() {
    return {
      fullDescription: false,
      arrayInfos: [],
      album: false,
      openAllNews: false,
      openAddSelection: false,
      openCreateSelection: false,
      map: false,
      flagFavorite: null,
      mainPhotos: []
    }
  },
  methods: {
    openCreateSel() {
      this.openCreateSelection = true
      this.openAddSelection = false
    },
    closeCreateSel() {
      this.openCreateSelection = false
      this.openAddSelection = true
    },
    addToFavorite() {
      this.flagFavorite = true
      axios.post('/api/favorite/add', {
        user_id: this.user.id,
        house_id: this.house.id,
        token: this.globalToken
      })
    },
    removeToFavorite() {
      this.flagFavorite = false
      axios.post('/api/favorite/deleted', {
        user_id: this.user.id,
        house_id: this.house.id,
        token: this.globalToken
      })
    }
  },
  mounted() {
    this.flagFavorite = this.house.favorite
    this.arrayInfos = []

    if (this.house.info.info !== null) {
      for (let key of this.house.info.info) {
        if (!+isNaN(key)) {
          this.arrayInfos.push(this.infos.find(item => item.id === +key))
        }
      }
    }

    if (this.house.info.dop !== null) {
      for (let key of this.house.info.dop) {
        if (!+isNaN(key)) {
          this.dops.forEach(item => {
            if (+key === item.id) {
              item.active = 1
            }
          })
        }
      }
    }

    this.mainPhotos.push(...this.house.images.filter(item => item.category === 0))
  },
  computed: {
    countFlats() {
      let count = 0;
      this.house.frames.forEach(item => {
        item.flats.forEach(flat => {
            count += 1
        })
      })

      return count
    },
    minPriceFlat() {
      let prices = []
      this.house.frames.forEach(item => {
        item.flats.forEach(flat => {
          prices.push(flat.price)
        })
      })

      return Math.min(...prices)
    },
    minSquareFlat() {
      let minSquare = []
      for (let key of this.house.frames) {
        for (let flat of key.flats) {
          minSquare.push(flat.square)
        }
      }

      return Math.min(...minSquare)
    },
    maxSquareFlat() {
      let maxSquare = []
      for (let key of this.house.frames) {
        for (let flat of key.flats) {
          maxSquare.push(flat.square)
        }
      }

      return Math.max(...maxSquare)
    },
    minPriceForM() {
      return Math.round(this.minPriceFlat / this.minSquareFlat)
    },
  },
  components: {
    AppMap,
    AppHeader,
    AppFooter,
    AppDecritionObjectSidebar,
    AppDescriptionObjectOtherJK,
    AppModalAlbum,
    Swiper,
    SwiperSlide,
    AppAllNews,
    AppAddSelections,
    AppImmovablesCreateSelection,
    AppChess,
  },
  setup() {
    return {
      modules: [Navigation, Pagination],
    };
  },
}
</script>

<style scoped>
.disableColor {
  color: #8A8996;
}

</style>
