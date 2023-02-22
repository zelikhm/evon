<template>
  <div
    class="sticky top-[2vw] filter__left lg:absolute lg:z-40 lg:top-0 transition-all duration-500 w-full bg-[#F6F3FA] rounded-[6px] h-fit"
    :class="{'animation__filter': openFilter}"
  >
    <div class="flex justify-between items-center p-7 xxl:p-5 xl:p-4">
        <span
          class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[16px] leading-none">Фильтры</span>
      <div class="flex items-center gap-4">
        <button class="text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none cursor-pointer"
                v-on:click="reloadFilter">
          Сбросить
        </button>
        <button @click="openFilter = false"
                class="hidden lg:block text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none cursor-pointer">
          Закрыть
        </button>
      </div>
    </div>
    <div class="h-[1px] w-full bg-[#E5DFEE]"></div>
    <div v-if="preloader === true">
      <div class="loader"></div>
    </div>
    <div v-else>
      <div class="custom__scroll h-[84vh] relative overflow-y-auto p-7 xxl:p-5 xl:p-4">
        <div class="mb-5 xxl:mb-4 xl:mb-3">
          <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
            <div class="flex items-center text-[#1E1D2D]">
              <input class="custom__checkbox" name="filters" type="checkbox" id="filters_1">
              <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" for="filters_1"
                     v-on:click="setBadge(1)">Новинки</label>
            </div>
            <div class="flex items-center text-[#1E1D2D]">
              <input class="custom__checkbox" name="filters" type="checkbox" id="filters_2">
              <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" for="filters_2"
                     v-on:click="setBadge(2)">Акции</label>
            </div>
            <div class="flex items-center text-[#1E1D2D]">
              <input class="custom__checkbox" name="filters" type="checkbox" id="filters_3"
                     v-bind:checked="filters.badge.popular">
              <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" for="filters_3"
                     v-on:click="setBadge(3)">Популярные</label>
            </div>
          </div>
        </div>
        <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">
          <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]"
               :class="{ 'border__bottom--0': openSelectCity}">
            <span
              class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Город</span>
            <div class="relative">
              <div ref="city" @click.stop="openSelectCity = !openSelectCity"
                   class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
                <span>{{ selectCity }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
                     :class="{ 'rotate-180': openSelectCity }" alt="">
              </div>
              <div v-if="openSelectCity"
                   class="max-h-[215px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
                <div class="relative w-full p-5 xxl:p-4 xl:p-3">
                  <input @click.stop="sea" v-model="searchValue"
                         class="py-3 xxl:py-2.5 xl:py-2 pl-10 xxl:pl-8 xl:pl-6 focus:ring-[#6435A5] focus:border-[#6435A5] w-full text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] rounded-[6px] leading-none border border-solid border-[#E5DFEE]"
                         type="text">
                  <img class="absolute top-1/2 -translate-y-1/2 translate-x-1/2 w-4.5 xxl:w-4 xl:w-3.5"
                       src="../../assets/svg/search_icon_grey.svg" alt="">
                </div>
                <div class="flex items-center text-[#1E1D2D] ml-5 mt-2" v-for="(item, index) in filteredCity"
                     :key="idx">
                  <input class="custom__checkbox" name="infrastructure" type="checkbox"
                         v-bind:checked="checkCity(item.id)">
                  <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]"
                         v-on:click="changeSelectCity(item)">{{ item.title }}
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]"
               :class="{ 'border__bottom--0': openSelectRegion}">
            <span
              class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Район</span>
            <div class="relative" :tabindex="tabindex" @blur="openSelectRegion = false">
              <div @click="openSelectRegion = !openSelectRegion"
                   class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                <span>{{ selectRegion }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
                     :class="{ 'rotate-180': openSelectRegion }" alt="">
              </div>
              <div v-if="openSelectRegion"
                   class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
                <div class="flex items-center text-[#1E1D2D] ml-5 mt-2" v-for="(item, index) in regions" :key="idx">
                  <input class="custom__checkbox" name="infrastructure" type="checkbox"
                         v-bind:checked="checkRegion(item.id)">
                  <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]"
                         v-on:click="changeSelectRegion(item)">{{ item.title }}
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div :class="{'border__purple': isBorder === 1 }"
               class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">Цена</span>
            <div class="flex gap-2">
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="cost_from">от</label>
                <input @click="changeBorder(1)" @input="setFilter()" v-model="filters.price.min"
                       class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0"
                       type="number" id="cost_from">
              </div>
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="cost_before">до</label>
                <input @click="changeBorder(1)" @input="setFilter()" v-model="filters.price.max"
                       class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0"
                       type="number" id="cost_before">
              </div>
            </div>
          </div>

          <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
               :class="{ 'border__bottom--0': openSelectDeadline}">
            <span
              class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Срок сдачи</span>
            <div class="relative" :tabindex="tabindex" @blur="openSelectDeadline = false">
              <div @click="openSelectDeadline = !openSelectDeadline"
                   class="flex items-center justify-between cursor-pointer text-[#1E1D2D]  text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                <span>{{ selectDeadline }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
                     :class="{ 'rotate-180': openSelectDeadline }" alt="">
              </div>
              <div v-if="openSelectDeadline"
                   class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
                <span
                  v-for="(deadline, idx) in deadlines" :key="idx"
                  @click="changeSelectDeadline(deadline)"
                  class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                >
                  {{ deadline.deadline }}
                </span>
              </div>
            </div>
          </div>

          <div :class="{'border__purple': isBorder === 2 }"
               class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">Площадь</span>
            <div class="flex gap-2">
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="from">от</label>
                <input @click="changeBorder(2)" @input="setFilter()" v-model="filters.square.min"
                       class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0"
                       type="number" id="from">
              </div>
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="before">до</label>
                <input @click="changeBorder(2)" @input="setFilter()" v-model="filters.square.max"
                       class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0"
                       type="number" id="before">
              </div>
            </div>
          </div>

          <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
               :class="{ 'border__bottom--0': openSelectDev}">
            <span
              class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Застройщик</span>
            <div class="relative" :tabindex="tabindex" @blur="openSelectDev = false">
              <div @click="openSelectDev = !openSelectDev"
                   class="flex items-center justify-between cursor-pointer text-[#1E1D2D] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                <span class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">{{ selectDev }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
                     :class="{ 'rotate-180': openSelectDev }" alt="">
              </div>
              <div v-if="openSelectDev"
                   class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
                <span
                  v-for="(item, idx) in builders" :key="idx"
                  @click="changeSelectDev(item)"
                  class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                >
                  {{ item.first_name }}
                </span>
              </div>
            </div>
          </div>
          <div class="my-10 xxl:my-8 xl:my-6">
            <div @click="openLocation = !openLocation"
                 class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] mb-5 xxl:mb-4 xl:mb-3 leading-none">
              <span>Расположение</span>
              <img :class="{'rotate-180': openLocation}" class=" transition-all w-3 xxl:w-2.5 xl:w-2"
                   src="../../assets/svg/arrow_down_black.svg" alt="">
            </div>
            <div v-if="openLocation" class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div :class="{'border__purple': isBorder === 3 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_sea">от моря
                  (м)</label>
                <input @click="changeBorder(3)" @input="setFilter()" v-model="filters.location.toSea"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_sea">
              </div>
              <div :class="{'border__purple': isBorder === 4 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_school">от
                  школы (м)</label>
                <input @click="changeBorder(4)" @input="setFilter()" v-model="filters.location.toSchool"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_school">
              </div>
              <div :class="{'border__purple': isBorder === 5 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_shoping">от
                  торгового центра (м)</label>
                <input @click="changeBorder(5)" @input="setFilter()" v-model="filters.location.toShop"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_shoping">
              </div>
              <div :class="{'border__purple': isBorder === 6 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_park">от парка
                  (м)</label>
                <input @click="changeBorder(6)" @input="setFilter()" v-model="filters.location.toPark"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_park">
              </div>
              <div :class="{'border__purple': isBorder === 7 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_child">от
                  детского садика (м)</label>
                <input @click="changeBorder(7)" @input="setFilter()" v-model="filters.location.toChildrenSchool"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_child">
              </div>
              <div :class="{'border__purple': isBorder === 8 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_stop">от
                  остановки (м)</label>
                <input @click="changeBorder(8)" @input="setFilter()" v-model="filters.location.toBus"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_stop">
              </div>
            </div>
          </div>
          <div class="relative overflow-hidden mb-10 xxl:mb-8 xl:mb-6">
            <div @click="openInfrastruktura = !openInfrastruktura"
                 class="relative z-10 cursor-pointer text-[#1E1D2D] flex justify-between items-center text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] mb-5 xxl:mb-4 xl:mb-3 leading-none">
              <span class="hover__title-block">Инфраструктура</span>
              <img :class="{'rotate-180': openInfrastruktura}" class=" transition-all w-3 xxl:w-2.5 xl:w-2"
                   src="../../assets/svg/arrow_down_black.svg" alt="">
            </div>
            <div v-if="openInfrastruktura"
                 class="transition-all duration-500 h-fit flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex items-center text-[#1E1D2D]" v-for="(item, index) in infos">
                <input class="custom__checkbox" name="infrastructure" type="checkbox" :id="'infrastructure' + item.id">
                <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" :for="'infrastructure' + item.id"
                       v-on:click="setInfo(item.id, index)">{{ item.name }}</label>
              </div>
            </div>
          </div>
          <div class="mb-10 xxl:mb-8 xl:mb-6">
            <div @click="openDopServices = !openDopServices"
                 class="cursor-pointer flex justify-between items-center text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] mb-5 xxl:mb-4 xl:mb-3 leading-none">
              <span class="hover__title-block">Дополнительные услуги</span>
              <img :class="{'rotate-180': openDopServices}" class=" transition-all w-3 xxl:w-2.5 xl:w-2"
                   src="../../assets/svg/arrow_down_black.svg" alt="">
            </div>
            <div v-if="openDopServices" class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex items-center text-[#1E1D2D]" v-for="(item, index) in dops">
                <input class="custom__checkbox" name="services" type="checkbox" :id="'services' + item.id">
                <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" :for="'services' + item.id"
                       v-on:click="setDop(item.id, index)">{{ item.name }}</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  export default {
    props: ['dops', 'infos', 'builders', 'deadlines', 'regions', 'filteredCity', 'preloader'],
    data() {
      return {
        filters: {
          badge: {
            news: false,
            sales: false,
            popular: false,
          },
          price: {
            min: '',
            max: '',
          },
          square: {
            min: '',
            max: '',
          },
          deadline: 'Не важно',
          builder: '',
          location: {
            toSea: '',
            toSchool: '',
            toShop: '',
            toPark: '',
            toChildrenSchool: '',
            toBus: '',
          },
          cities: [],
          areas: [],
          info: {},
          dop: {},
        },
        openFilter: false,
        openSelectCity: false,
        openSelectRegion: false,
        selectDeadline: 'Не важно',
        openSelectDeadline: false,
        selectDev: null,
        openSelectDev: false,
        deadlines: [
          {deadline: 'Не важно', id: 0},
          {deadline: 'Сдан', id: 1},
        ],
        openInfrastruktura: false,
        openDopServices: false,
      }
    },
    name: "AppFilter",
    methods: {
      reloadFilter() {
        this.$forceUpdate();
      },
      setBadge(id) {
        if (id === 1) {
          this.filters.badge.news = !this.filters.badge.news;
        } else if (id === 2) {
          this.filters.badge.sales = !this.filters.badge.sales;
        } else if (id === 3) {
          this.filters.badge.popular = !this.filters.badge.popular;
        }

        // this.setFilter();
      },
    },
  }
</script>

<style scoped>
  .loader_block {

  }

  .loader {
    border: 5px solid #f3f3f3; /* Light grey */
    border-top: 5px solid; /* Blue */
    border-radius: 50%;
    width: 80px;
    height: 80px;
    animation: spin 2s linear infinite;
    margin: 37%;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .loader_text {
    text-align: center;
  }
</style>
