<template>
  <div class="bg-[#F6F3FA] rounded-[6px] h-fit">
    <div class="flex justify-between items-center p-7 xxl:p-5 xl:p-4">
      <span class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] leading-none">Фильтры</span>
      <div class="flex items-center gap-4">
        <button class="text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] lg:text-[12px] leading-none cursor-pointer">Сбросить</button>
        <button @click="$emit('close-filter')" class="hidden lg:block text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] lg:text-[12px] leading-none cursor-pointer">Закрыть</button>
      </div>
    </div>
    <div class="h-[1px] w-full bg-[#E5DFEE]"></div>
    <div class="custom__scroll h-[90vh] relative overflow-y-auto p-7 xxl:p-5 xl:p-4">
      <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">
        <div :class="{'border__bottom--0': borderType}" class="multi__select multi__select--filter flex flex-col gap-2 xxl:gap-1.5 h-fit border border-solid border-[#E5DFEE] rounded-[6px]">
          <div class="px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5 text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Тип</div>
          <Multiselect
            @click="borderType = !borderType"
            class="px-5 xx:px-4 xl:px-3 pb-4 xx:pb-3 xl:pb-2.5"
            :options="optionsSelectType"
            mode="tags"
            placeholder="Выберите тип"
            :close-on-select="true"
          />
        </div>

        <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectCity}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Город</span>
          <div class="relative">
            <div @click="openSelectCity = !openSelectCity" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
              <span>{{ selectCity }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectCity }" alt="">
            </div>
            <div v-if="openSelectCity" class="absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
              <div class="relative w-full p-5 xxl:p-4 xl:p-3">
                <input v-model="searchValue" class="py-3 xxl:py-2.5 xl:py-2 pl-10 xxl:pl-8 xl:pl-6 w-full text-lg xxl:text-[15px] xl:text-[13px] rounded-[6px] leading-none border border-solid border-[#E5DFEE]" type="text">
                <img class="absolute top-1/2 -translate-y-1/2 translate-x-1/2 w-4.5 xxl:w-4 xl:w-3.5" src="../../assets/svg/search_icon_grey.svg" alt="">
              </div>
              <span
                v-for="(city, idx) in filteredCity" :key="idx"
                @click="changeSelectCity(city, idx)"
                class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
              >{{ city.title }}</span>
            </div>
          </div>
        </div>

        <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectRegion}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Район</span>
          <div class="relative">
            <div @click="openSelectRegion = !openSelectRegion" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
              <span>{{ selectRegion }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectRegion }" alt="">
            </div>
            <div v-if="openSelectRegion" class="absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
              <span
                v-for="(region, idx) in regions" :key="idx"
                @click="changeSelectRegion(region)"
                class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
              >
                {{ region.title }}
              </span>
            </div>
          </div>
        </div>

        <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Цена</span>
          <div class="flex gap-2">
            <div class="flex items-center gap-1">
              <label class="text-[17px] xxl:text-[14px] xl:text-[12px]" for="cost_from">от</label>
              <input class="text-[17px] xxl:text-[14px] xl:text-[12px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_from">
            </div>
            <div class="flex items-center gap-1">
              <label class="text-[17px] xxl:text-[14px] xl:text-[12px]" for="cost_before">до</label>
              <input class="text-[17px] xxl:text-[14px] xl:text-[12px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_before">
            </div>
          </div>
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectDeadline}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Срок сдачи</span>
          <div class="relative">
            <div @click="openSelectDeadline = !openSelectDeadline" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-[17px] xxl:text-[14px] xl:text-[12px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
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
              <label class="text-[17px] xxl:text-[14px] xl:text-[12px]" for="from">от</label>
              <input class="text-[17px] xxl:text-[14px] xl:text-[12px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="from">
            </div>
            <div class="flex items-center gap-1">
              <label class="text-[17px] xxl:text-[14px] xl:text-[12px]" for="before">до</label>
              <input class="text-[17px] xxl:text-[14px] xl:text-[12px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="before">
            </div>
          </div>
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectDev}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Застройщик</span>
          <div class="relative">
            <div @click="openSelectDev = !openSelectDev" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
              <span class="text-[17px] xxl:text-[14px] xl:text-[12px]">{{ selectDev }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectDev }" alt="">
            </div>
            <div v-if="openSelectDev" class="absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
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
          <div class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] mb-5 xxl:mb-4 xl:mb-3 leading-none">Расположение</div>
          <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
            <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_sea">от моря (м)</label>
              <input class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_sea">
            </div>
            <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_school">от школы (м)</label>
              <input class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_school">
            </div>
            <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_shoping">от торгового центра (м)</label>
              <input class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_shoping">
            </div>
            <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_park">от парка (м)</label>
              <input class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_park">
            </div>
            <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_child">от детского садика (м)</label>
              <input class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_child">
            </div>
            <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_stop">от остановки (м)</label>
              <input class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_stop">
            </div>
          </div>
        </div>
        <div class="mb-10 xxl:mb-8 xl:mb-6">
          <div class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] mb-5 xxl:mb-4 xl:mb-3 leading-none">Инфраструктура</div>
          <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
            <div class="flex items-center text-[#1E1D2D]" v-for="item in infos">
              <input class="custom__checkbox" name="infrastructure" type="checkbox" :id="'infrastructure' + item.id">
              <label class="text-base xxl:text-[13px] xl:text-[11px]" :for="'infrastructure' + item.id">{{ item.name }}</label>
            </div>
            <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectInstallment}">
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Рассрочка</span>
              <div class="relative">
                <div @click="openSelectInstallment = !openSelectInstallment" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                  <span class="text-[17px] xxl:text-[14px] xl:text-[12px]">{{ selectInstallment }}</span>
                  <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectInstallment }" alt="">
                </div>
                <div v-if="openSelectInstallment" class="absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
                  <span
                    v-for="(installment, idx) in optionsInstallment" :key="idx"
                    @click="changeSelectInstallment(installment)"
                    class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                  >
                    {{installment.installment }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-10 xxl:mb-8 xl:mb-6">
          <div class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] mb-5 xxl:mb-4 xl:mb-3 leading-none">Дополнительные услуги</div>
          <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
            <div class="flex items-center text-[#1E1D2D]" v-for="item in dops">
              <input class="custom__checkbox" name="services" type="checkbox" :id="'services' + item.id">
              <label class="text-base xxl:text-[13px] xl:text-[11px]" :for="'services' + item.id">{{ item.name }}</label>
            </div>
          </div>
        </div>
        <div class="mb-5 xxl:mb-4 xl:mb-3">
          <div class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] mb-5 xxl:mb-4 xl:mb-3 leading-none">Фильтры</div>
          <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
            <div class="flex items-center text-[#1E1D2D]">
              <input class="custom__checkbox" name="filters" type="checkbox" id="filters_1">
              <label class="text-base xxl:text-[13px] xl:text-[11px]" for="filters_1">Новинки</label>
            </div>
            <div class="flex items-center text-[#1E1D2D]">
              <input class="custom__checkbox" name="filters" type="checkbox" id="filters_2">
              <label class="text-base xxl:text-[13px] xl:text-[11px]" for="filters_2">Акции</label>
            </div>
            <div class="flex items-center text-[#1E1D2D]">
              <input class="custom__checkbox" name="filters" type="checkbox" id="filters_3">
              <label class="text-base xxl:text-[13px] xl:text-[11px]" for="filters_3">Популярные</label>
            </div>
          </div>
        </div>
        <button class="text-white text-[18px] xxl:text-[15px] xl:text-[13px] leading-none bg-[#E84680] rounded-[5px] font-semibold py-5 xxl:py-4 xl:py-3">Фильтрация</button>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from '@vueform/multiselect'

export default {
  emits: ['close-filter'],
  props: ['city', 'infos', 'dops', 'builders'],
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
      selectCity: null,
      openSelectCity: false,
      selectRegion: 'Центральный',
      openSelectRegion: false,
      regions: [],
      selectDeadline: 'Сдан',
      openSelectDeadline: false,
      deadlines: [
        { deadline: 'Сдан', id: 0 },
        { deadline: 'Не сдан', id: 1 },
        { deadline: 'В разработке', id: 2 },
      ],
      selectDev: null,
      openSelectDev: false,
      selectInstallment: 'Да',
      openSelectInstallment: false,
      optionsInstallment: [
        { installment: 'Да', id: 0 },
        { installment: 'Нет', id: 1 },
      ],
      searchValue: null
    }
  },
  methods: {
    changeSelectCity(city) {
      this.selectCity = city.title
      this.openSelectCity = false

      this.selectRegion = this.city[idx].regions[0].title
      this.regions = this.city[idx].regions
    },
    changeSelectRegion(region) {
      this.selectRegion = region.title
      this.openSelectRegion = false
    },
    changeSelectDeadline(deadline) {
      this.selectDeadline = deadline.deadline
      this.openSelectDeadline = false
    },
    changeSelectDev(dev) {
      this.selectDev = dev.first_name
      this.openSelectDev = false
    },
    changeSelectInstallment(installment) {
      this.selectInstallment = installment.installment
      this.openSelectInstallment = false
    }
  },
  created() {
    if (this.city[0] !== null) {
      this.selectDev = this.builders[0].first_name
      this.selectCity = this.city[0].title
      this.selectRegion = this.city[0].regions[0].title
      this.regions = this.city[0].regions
    }

    console.log(this.dops)
    console.log(this.infos)
    console.log(this.city)
    console.log(this.builders)
  },
  computed: {
    filteredCity() {
      if (this.searchValue !== null) {
        return this.city.filter(item =>
            item.title.toLowerCase().includes(
                this.searchValue.toLowerCase()
            )
        )
      } else {
        return this.city
      }
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
