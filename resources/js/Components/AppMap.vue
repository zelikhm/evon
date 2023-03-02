<script setup>
  import {Link} from "@inertiajs/inertia-vue3"
</script>

<template>
  <div class="relative w-full h-[90vh] my-5 xxl:my-4 xl:my-3">
    <GMapMap :center="city !== null ? city : center" :disableDefaultUI="false" :zoom="city !== null ? 10 : 6"
             map-type-id="roadmap" class="w-full h-[90vh]"
             :options="{
                      zoomControl: false,
                      mapTypeControl: false,
                      scaleControl: false,
                      streetViewControl: false,
                      rotateControl: false,
                      fullscreenControl: true,
                }
">
      <!--     <GMapCluster>-->
      <GMapMarker :key="index" v-for="(m, index) in houses_array" :icon="'/images/icon-marker-map.svg'"
                  :position="m.position" @click="openMarker(m)">
        <GMapInfoWindow :closeclick="true"
                        @closeclick="openMarker(null)"
                        :opened="openedMarkerID === m.id"
                        v-if="state === undefined"
        >
          <div
            class="relative w-[345px] xxl:w-[280px] xl:w-[240px] decription__head top-0 right-0 bg-white rounded-[10px]" v-if="house !== undefined">
            <div class="p-6 xxl:p-5 xl:p-4 border__bottom">
              <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 mb-7 xxl:mb-5 xl:mb-4">
                <img v-if="house.isImage !== false" :src="house.image"
                     class="w-14 xxl:w-12 xl:w-8 h-14 xxl:h-12 xl:h-8 rounded-full" alt="">
                <img v-else src="../../assets/no-img-houses.jpg"
                     class="w-14 xxl:w-12 xl:w-8 h-14 xxl:h-12 xl:h-8 rounded-full" alt="">
                <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <a target="_blank" :href="'/house/' + house.slug"
                        class="text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] font-medium leading-none">{{
                    house.title }}
                  </a>
                  <span class="text-[#8A8996] text-[16px] xxl:text-[14px] xl:text-[12px] leading-none">{{ getCity(house.city) }}, {{ getArea(house.area) }}</span>
                </div>
              </div>
              <div class="flex gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span
                  class="text-white text-[14px] xxl:text-[12px] xl:text-[10px] leading-none bg-[#30CB49] px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 rounded-[3px]"
                  v-if="house.created && !Number.isInteger(+house.created[0])">{{ house.created }}</span>
                <span
                  class="text-white text-[14px] xxl:text-[12px] xl:text-[10px] leading-none bg-[#E84680] px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 rounded-[3px]"
                  v-else-if="house.created">{{ house.created }}</span>
                <!--               <span class="border border-solid border-[#E5DFEE] text-[#8A8996] text-[14px] xxl:text-[12px]  xl:text-[10px] leading-none px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 rounded-[3px]">Договор займа</span>-->
              </div>
            </div>
            <div class="p-6 xxl:p-5 xl:p-4">
              <div
                class="flex justify-between items-center mb-5 xxl:mb-4 xl:mb-3 text-[18px] xxl:text-[15px] xl:text-[13px]">
                <span class="text-[#1E1D2D] font-medium leading-none">от {{ house.minPrice !== undefined ? house.minPrice.toLocaleString('ru') : 0  }} €</span>
                <span class="text-[#8A8996] leading-none">{{ house.flats.length }} {{ house.flats.length === 1 ? language.dob_kv_1[15] : house.flats.length === 2 || house.flats.length === 3 || house.flats.length === 4 ? language.dob_kv_1[16] : language.dob_kv_1[17] }}</span>
              </div>
              <div class="gray-backg flex items-center gap-1 w-fit px-2 xl:px-1.5 py-1.5 xl:py-1 mb-7 xxl:mb-5 xl:mb-4">
                <img src="../../assets/svg/ruller_icon.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                <span class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">{{ house.minSquare }} м² - {{ house.maxSquare }} м²</span>
              </div>
              <div class="grid grid-cols-2 gap-5 xxl:gap-4 xl:gap-3 w-full">
                <button @click="$emit('open-add-selections', house)"
                        class="register__button--white w-full flex items-center justify-center gap-3 xxl:gap-2.5 xl:gap-2  border border-solid border-[#6435A5] rounded-[4px] py-2 xxl:py-1.5 xl:py-1">
                  <span
                    class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none whitespace-nowrap">{{ language.rielt_1[14] }}</span>
                  <svg width="16" height="16" class="w-4.5 xxl:w-4 xl:w-3.5" viewBox="0 0 16 16" fill="none"
                       xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_519_1862)">
                      <path
                        d="M7.33398 7.33301V3.33301H8.66732V7.33301H12.6673V8.66634H8.66732V12.6663H7.33398V8.66634H3.33398V7.33301H7.33398Z"
                        fill="#6435A5"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_519_1862">
                        <rect width="16" height="16" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
                </button>
                <button v-if="house.favorite" @click="removeFavorite"
                        class="register__button--white w-full flex items-center justify-center gap-3 xxl:gap-2.5 xl:gap-2 border border-solid border-[#6435A5] rounded-[4px] py-2 xxl:py-1.5 xl:py-1">
                  <span
                    class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none whitespace-nowrap">{{ language.rielt_1[16] }}</span>
                  <img src="../../assets/svg/heart_icon_pink.svg" class="w-4 xxl:w-3.5 xl:w-3" alt="">
                </button>
                <button v-else @click="addFavorite"
                        class="register__button--white w-full flex items-center justify-center gap-3 xxl:gap-2.5 xl:gap-2 border border-solid border-[#6435A5] rounded-[4px] py-2 xxl:py-1.5 xl:py-1">
                  <span
                    class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none whitespace-nowrap">{{ language.rielt_1[16] }}</span>
                  <svg width="16" height="16" class="w-4 xxl:w-3.5 xl:w-3" viewBox="0 0 16 16" fill="none"
                       xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_158_957)">
                      <path
                        d="M9.00075 3.39673C10.7625 1.81498 13.485 1.86748 15.1823 3.56773C16.8788 5.26873 16.9373 7.97774 15.3593 9.74474L8.99925 16.1137L2.64075 9.74474C1.06275 7.97774 1.122 5.26424 2.81775 3.56773C4.5165 1.86974 7.23375 1.81273 9.00075 3.39673V3.39673ZM14.1203 4.62749C12.9953 3.50099 11.1803 3.45524 10.0028 4.51274L9.0015 5.41124L7.9995 4.51349C6.81825 3.45449 5.007 3.50098 3.879 4.62898C2.7615 5.74648 2.70525 7.53524 3.735 8.71724L9 13.9905L14.265 8.71798C15.2955 7.53523 15.2393 5.74874 14.1203 4.62749V4.62749Z"
                        fill="#6435A5"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_158_957">
                        <rect width="18" height="18" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </GMapInfoWindow>
      </GMapMarker>
      <!--     </GMapCluster>-->
    </GMapMap>
  </div>
</template>

<script>
  export default {
    props: ['houses_array', 'houses', 'state', 'user', 'city', 'allHouse', 'language', 'selectLanguage', 'cityes', 'areas'],
    data() {
      return {
        openedMarkerID: null,
        center: {lat: 38.789057678005726, lng: 35.39768557787735},
        markers: [],
        house: {
          title: null,
          city: null,
          area: null,
          status: null,
          isImage: false,
          image: null,
          flats: []
        },
      }
    },
    watch: {
      city(item) {
        if(this.city !== null) {
          console.log(this.city);
          this.center = {
            lat: (this.city.lat),
            lng: (this.city.lng)
          }
        }
      }
    },
    methods: {
      getCity(city) {
        let name = this.cityes.find(item => item.title === city);

        if(name !== undefined) {
          if(this.selectLanguage === 0) {
            return name.title;
          } else if(this.selectLanguage === 1) {
            return name.title_en !== undefined ? name.title_en : '';
          } else if(this.selectLanguage === 2) {
            return name.title_tr !== undefined ? name.title_tr : '';
          }
        }
      },
      getArea(area) {
        let name = this.areas.find(item => item.title === area);

        if(name !== undefined) {
          if(this.selectLanguage === 0) {
            return name.title;
          } else if(this.selectLanguage === 1) {
            return name.title_en !== undefined ? name.title_en : '';
          } else if(this.selectLanguage === 2) {
            return name.title_tr !== undefined ? name.title_tr : '';
          }
        }
      },
      addFavorite() {
        axios.post('/api/favorite/add', {
          user_id: this.user.id,
          house_id: this.house.id,
          token: this.user.token,
        })
        this.house.favorite = true
      },
      removeFavorite() {
        axios.post('/api/favorite/deleted', {
          user_id: this.user.id,
          house_id: this.house.id,
          token: this.token,
        })
        this.house.favorite = false
      },
      openMarker(marker) {

        if (marker === null) {
          this.openedMarkerID = null
          return
        }

        this.openedMarkerID = marker.id
        this.house = this.allHouse.find(item => +item.latitude === marker.position.lat && +item.longitude === marker.position.lng)

        if (this.house) {
          let minPrice = [],
            square = []
          if (this.house.image !== null) {
            this.house.isImage = true
          } else {
            this.house.isImage = false
          }

          this.house.flats.forEach(item => {
            minPrice.push(item.price)
            square.push(item.square)

            this.house.minPrice = Math.min(...minPrice)
            this.house.minSquare = Math.min(...square)
            this.house.maxSquare = Math.max(...square)
          })
        }
      },

    },
    created() {
      // this.houses = this.houses_array;
      if(this.city !== null) {
        this.center = {
          lat: parseFloat(this.city.lat),
          lng: parseFloat(this.city.lng)
        }
      }

    },
  }
</script>

<style scoped>

</style>
