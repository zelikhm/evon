<template>
  <div class="custom__scroll h-[98vh] overflow-y-auto bg-[#F6F3FA] rounded-[6px] border">
    <div class="flex justify-between items-center p-7 xxl:p-5 xl:p-4">
      <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none">Фильтры</span>
      <button class="text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] leading-none">Сбросить</button>
    </div>
    <div class="h-[1px] w-full bg-[#E5DFEE]"></div>
    <div class="p-7 xxl:p-5 xl:p-4">
      <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">
        <div :class="{'border__bottom--0': borderType}" class="multi__select multi__select--filter flex flex-col gap-2 xxl:gap-1.5 h-fit border border-solid border-[#E5DFEE] rounded-[6px]">
          <div class="px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5 text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Инфраструктура</div>
          <Multiselect
            @click="borderType = !borderType"
            class="px-5 xx:px-4 xl:px-3 pb-4 xx:pb-3 xl:pb-2.5"
            :options="optionsSelectType"
            mode="tags"
            placeholder="Инфраструктура"
            :close-on-select="true"
          />
        </div>

        <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectCity}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Город</span>
          <div class="relative">
            <div @click="openSelectCity = !openSelectCity" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
              <span>{{ selectCity }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectCity }" alt="">
            </div>
            <div v-if="openSelectCity" class="absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
              <div class="relative w-full p-5 xxl:p-4 xl:p-3">
                <input class="py-3 xxl:py-2.5 xl:py-2 pl-10 xxl:pl-8 xl:pl-6 w-full text-lg xxl:text-[15px] xl:text-[13px] rounded-[6px] leading-none border border-solid border-[#E5DFEE]" type="text">
                <img class="absolute top-1/2 -translate-y-1/2 translate-x-1/2 w-4.5 xxl:w-4 xl:w-3.5" src="../../assets/svg/search_icon_grey.svg" alt="">
              </div>
              <span
                v-for="(city, idx) in cities" :key="idx"
                @click="changeSelectCity(city)"
                class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
              >{{ city.city }}</span>
            </div>
          </div>
        </div>

        <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectRegion}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Район</span>
          <div class="relative">
            <div @click="openSelectRegion = !openSelectRegion" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
              <span>{{ selectRegion }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectRegion }" alt="">
            </div>
            <div v-if="openSelectRegion" class="absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
                  <span
                    v-for="(region, idx) in regions" :key="idx"
                    @click="changeSelectRegion(region)"
                    class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                  >
                    {{ region.region }}
                  </span>
            </div>
          </div>
        </div>

        <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Цена</span>
          <div class="flex gap-2">
            <div class="flex items-center gap-1">
              <label class="text-lg xxl:text-base xl:text-sm" for="cost_from">от</label>
              <input class="text-lg xxl:text-base xl:text-sm border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_from">
            </div>
            <div class="flex items-center gap-1">
              <label class="text-lg xxl:text-base xl:text-sm" for="cost_before">до</label>
              <input class="text-lg xxl:text-base xl:text-sm border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_before">
            </div>
          </div>
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectDeadline}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Срок сдачи</span>
          <div class="relative">
            <div @click="openSelectDeadline = !openSelectDeadline" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
              <span>{{ selectDeadline }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectDeadline }" alt="">
            </div>
            <div v-if="openSelectDeadline" class="absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
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

        <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Площадь</span>
          <div class="flex gap-2">
            <div class="flex items-center gap-1">
              <label class="text-lg xxl:text-base xl:text-sm" for="cost_from">от</label>
              <input class="text-lg xxl:text-base xl:text-sm border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_from">
            </div>
            <div class="flex items-center gap-1">
              <label class="text-lg xxl:text-base xl:text-sm" for="cost_before">до</label>
              <input class="text-lg xxl:text-base xl:text-sm border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_before">
            </div>
          </div>
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectDev}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Срок сдачи</span>
          <div class="relative">
            <div @click="openSelectDev = !openSelectDev" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
              <span>{{ selectDev }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectDev }" alt="">
            </div>
            <div v-if="openSelectDev" class="absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
                  <span
                    v-for="(dev, idx) in optionsSelectDev" :key="idx"
                    @click="changeSelectDev(dev)"
                    class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                  >
                    {{ dev.dev }}
                  </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from '@vueform/multiselect'

export default {
  data () {
    return {
      borderType: false,
      valueSelectType: null,
      optionsSelectType: [
        'Эконом 1',
        'Эконом 2',
        'Элит 1',
        'Элит 2',
      ],
      selectCity: 'Сочи',
      openSelectCity: false,
      cities: [
        { city: 'Сочи', value: 1 },
        { city: 'Москва', value: 2 },
        { city: 'Краснодар', value: 3 },
      ],
      selectRegion: 'Центральный',
      openSelectRegion: false,
      regions: [
        { region: 'Центральный', value: 1 },
        { region: 'Южный', value: 2 },
        { region: 'Северный', value: 3 },
        { region: 'Западный', value: 4 },
        { region: 'Восточный', value: 5 },
      ],
      selectDeadline: 'Сдан',
      openSelectDeadline: false,
      deadlines: [
        { deadline: 'Сдан', value: 1 },
        { deadline: 'Не сдан', value: 2 },
        { deadline: 'В разработке', value: 3 },
      ],
      selectDev: 'Группа Аквилон',
      openSelectDev: false,
      optionsSelectDev: [
        { dev: 'Группа Аквилон', id: 1},
        { dev: 'Группа Акв', id: 2},
        { dev: 'Группа Аквил', id: 3},
      ]
    }
  },
  methods: {
    changeSelectCity(city) {
      this.selectCity = this.object.city = city.city
      this.openSelectCity = false
    },
    changeSelectRegion(region) {
      this.selectRegion = region.region
      this.openSelectRegion = false
    },
    changeSelectDeadline(deadline) {
      this.selectDeadline = deadline.deadline
      this.openSelectDeadline = false
    },
    changeSelectDev(dev){
      this.selectDev = dev.dev
      this.openSelectDev = false
    },
  },
  components: {
    Multiselect
  }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<style scoped>

</style>
