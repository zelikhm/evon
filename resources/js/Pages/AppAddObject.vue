<template>
  <app-header />
  <main>
    <div class="_container">
      <div class="grid__add-object my-14 xxl:my-10 xl:my-8 gap-7 xxl:gap-5 xl:gap-4">
        <div class="relative">
          <div class="fixed z-50 w-[20vw] h-fit bg-[#F6F3FA] p-7 xxl:p-5 xl:p-4 rounded-[6px]">
            <div class="flex flex-col gap-3 xxl:gap-2.5 xl:gap-2">
              <div class="hover__menu-add-obj cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] p-5 xxl:p-4 xl:p-3">Информация о ЖК</div>
              <div class="hover__menu-add-obj cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] p-5 xxl:p-4 xl:p-3">Корпуса и квартиры</div>
              <div class="hover__menu-add-obj cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] p-5 xxl:p-4 xl:p-3">Фото</div>
            </div>
          </div>
        </div>

<!--       Информация о ЖК-->
        <div>
          <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px]">Добавить объект</h2>
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] ">Найдено 1512 новостроек</span>
          <div class="flex-col flex gap-5 xxl:gap-4 xl:gap-3 pt-5 xxl:pt-4 xl:pt-3">

            <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name_object">Название объекта</label>
              <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name_object" placeholder="Euro Avsallar Residence">
            </div>

            <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3" for="description_object">Описание объекта</label>
              <textarea class="custom__scroll text-[#1E1D2D] resize-none text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="description_object" placeholder="Описание объекта"></textarea>
            </div>

            <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectCity}">
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Город</span>
              <div class="relative">
                <div @click="openSelectCity = !openSelectCity" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
                  <span>{{ selectCity }}</span>
                  <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectCity }" alt="">
                </div>
                <div v-if="openSelectCity" class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
                  <div class="relative w-full p-5 xxl:p-4 xl:p-3">
                    <input class="py-3 xxl:py-2.5 xl:py-2 pl-12 xxl:pl-10 xl:pl-8 w-full text-lg xxl:text-[15px] xl:text-[13px] rounded-[6px] leading-none border border-solid border-[#E5DFEE]" type="text">
                    <img class="absolute top-1/2 -translate-y-1/2 left-[4%] w-4.5 xxl:w-4 xl:w-3.5" src="../../assets/svg/search_icon_grey.svg" alt="">
                  </div>
                  <span
                    v-for="(city, idx) in cities" :key="idx"
                    @click="changeSelectCity(city)"
                    class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                  >
                    {{ city.city }}
                  </span>
                </div>
              </div>
            </div>

            <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectRegion}">
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Город</span>
              <div class="relative">
                <div @click="openSelectRegion = !openSelectRegion" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
                  <span>{{ selectRegion }}</span>
                  <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectRegion }" alt="">
                </div>
                <div v-if="openSelectRegion" class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
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

            <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="coord_object">Введи координаты объекта</label>
              <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="coord_object" placeholder="49.5122 39.2143">
            </div>
            <iframe class="w-full h-[300px] rounded-[6px] my-10 xxl:my-8 xl:my-6" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d939346.3926624231!2d26.987657373274562!3d53.35298654639129!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sru!2sby!4v1670507874830!5m2!1sru!2sby"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="my-10 xxl:my-8 xl:my-6">
              <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium mb-5 xxl:mb-4 xl:mb-3">Характеристики</h3>
              <div class="grid grid-cols-2 gap-7 xxl:gap-5 xl:gap-4">

                <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectDeadline}">
                  <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Срок сдачи</span>
                  <div class="relative">
                    <div @click="openSelectDeadline = !openSelectDeadline" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
                      <span>{{ selectDeadline }}</span>
                      <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectDeadline }" alt="">
                    </div>
                    <div v-if="openSelectDeadline" class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
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

                <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectType}">
                  <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Срок сдачи</span>
                  <div class="relative">
                    <div @click="openSelectType = !openSelectType" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
                      <span>{{ selectType }}</span>
                      <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectType }" alt="">
                    </div>
                    <div v-if="openSelectType" class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
                  <span
                    v-for="(type, idx) in types" :key="idx"
                    @click="changeSelectType(type)"
                    class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                  >
                    {{ type.type }}
                  </span>
                    </div>
                  </div>
                </div>

                <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openInstallment}">
                  <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Срок сдачи</span>
                  <div class="relative">
                    <div @click="openInstallment = !openSelectDeadliopenInstallmentne" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
                      <span>{{ selectInstallment }}</span>
                      <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openInstallment }" alt="">
                    </div>
                    <div v-if="openInstallment" class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
                  <span
                    v-for="(installment, idx) in installments" :key="idx"
                    @click="changeSelectInstallment(installment)"
                    class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                  >
                    {{ installment.installment }}
                  </span>
                    </div>
                  </div>
                </div>

                <div class="multi__select h-fit border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
                  <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Тип</span>
                  <Multiselect
                    v-model="valueSelectType"
                    :options="optionsSelectType"
                    mode="tags"
                    placeholder="Выбрать тип"
                    :close-on-select="true"
                  />
                </div>

              </div>
              <div class="my-10 xxl:my-8 xl:my-6">
                <div class="flex justify-between items-center">
                  <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium mb-5 xxl:mb-4 xl:mb-3 leading-none">Контакты отдела продаж</h3>
                  <button class="flex items-center border border-solid border-[#6435A5] rounded-[5px] py-3 xxl:py-2.5 xl:py-2 px-4 xxl:px-3 xl:px-2.5">
                    <img src="../../assets/svg/plus_icon_purple.svg" alt="Плюсик">
                    <span class="text-[#6435A5] font-medium text-base xxl:text-sm xl:text-xs leading-none">Добавить</span>
                  </button>
                </div>
              </div>
            </div>
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

import Multiselect from '@vueform/multiselect'

export default {
  data() {
    return {
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
      selectType: 'Эконом',
      openSelectType: false,
      types: [
        { type: 'Эконом', value: 1 },
        { type: 'Средний', value: 2 },
        { type: 'Элит', value: 3 },
      ],
      selectInstallment: 'Да',
      openInstallment: false,
      installments: [
        { installment: 'Да', value: 1 },
        { installment: 'Нет', value: 2 },
      ],
      valueSelectType: null,
      optionsSelectType: [
        'Кинотеатр',
        'Лобби бар',
        'Спа',
        'Спортивная площадка',
      ],
    }
  },
  methods: {
    changeSelectCity(city) {
      this.selectCity = city.city
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
    changeSelectType(type) {
      this.selectType = type.type
      this.openSelectType = false
    },
    changeSelectInstallment(installment) {
      this.selectInstallment = installment.installment
      this.openInstallment = false
    }
  },
  components: {
    AppHeader,
    AppFooter,
    Multiselect,
  }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<style scoped>

</style>
