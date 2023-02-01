<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <div class="grid__list-new-build">
    <div
      class="filter__left lg:absolute lg:z-40 lg:top-0 transition-all duration-500 w-full bg-[#F6F3FA] rounded-[6px] h-fit"
      :class="{'animation__filter': openFilter}"
    >
      <div class="flex justify-between items-center p-7 xxl:p-5 xl:p-4">
        <span class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[16px] leading-none">Фильтры</span>
        <div class="flex items-center gap-4">
          <button class="text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none cursor-pointer">Сбросить</button>
          <button @click="openFilter = false" class="hidden lg:block text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none cursor-pointer">Закрыть</button>
        </div>
      </div>
      <div class="h-[1px] w-full bg-[#E5DFEE]"></div>
      <div class="custom__scroll h-[90vh] relative overflow-y-auto p-7 xxl:p-5 xl:p-4">
        <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">

          <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectType}">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Тип</span>
            <div class="relative" :tabindex="tabindex" @blur="openSelectType = false">
              <div @click="openSelectType = !openSelectType" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                <span>{{ selectType }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectType }" alt="">
              </div>
              <div v-if="openSelectType" class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
                <span
                    v-for="(type, idx) in types" :key="idx"
                    @click="changeSelectTypes(type)"
                    class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                >
                  {{ type.type }}
                </span>
              </div>
            </div>
          </div>
          <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectCity}">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Город</span>
            <div class="relative">
              <div @click="openSelectCity = !openSelectCity" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
                <span>{{ selectCity }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectCity }" alt="">
              </div>
              <div v-if="openSelectCity" class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
                <div class="relative w-full p-5 xxl:p-4 xl:p-3">
                  <input v-model="searchValue" class="py-3 xxl:py-2.5 xl:py-2 pl-10 xxl:pl-8 xl:pl-6 focus:ring-[#6435A5] focus:border-[#6435A5] w-full text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] rounded-[6px] leading-none border border-solid border-[#E5DFEE]" type="text">
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
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Район</span>
            <div class="relative" :tabindex="tabindex" @blur="openSelectRegion = false">
              <div @click="openSelectRegion = !openSelectRegion" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                <span>{{ selectRegion }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectRegion }" alt="">
              </div>
              <div v-if="openSelectRegion" class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
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
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">Цена</span>
            <div class="flex gap-2">
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="cost_from">от</label>
                <input v-model="filters.priceMin" class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_from">
              </div>
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="cost_before">до</label>
                <input v-model="filters.priceMax" class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="cost_before">
              </div>
            </div>
          </div>

          <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectDeadline}">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Срок сдачи</span>
            <div class="relative" :tabindex="tabindex" @blur="openSelectDeadline = false">
              <div @click="openSelectDeadline = !openSelectDeadline" class="flex items-center justify-between cursor-pointer text-[#1E1D2D]  text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                <span>{{ selectDeadline }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectDeadline }" alt="">
              </div>
              <div v-if="openSelectDeadline" class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
                <span
                  v-for="(deadline, idx) in deadlines" :key="idx"
                  @click="changeSelectTypes(deadline)"
                  class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                >
                  {{ deadline.deadline }}
                </span>
              </div>
            </div>
          </div>

          <div class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">Площадь</span>
            <div class="flex gap-2">
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="from">от</label>
                <input v-model="filters.squareMin" class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="from">
              </div>
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="before">до</label>
                <input v-model="filters.squareMax" class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0" type="number" id="before">
              </div>
            </div>
          </div>

          <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectDev}">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Застройщик</span>
            <div class="relative" :tabindex="tabindex" @blur="openSelectDev = false">
              <div @click="openSelectDev = !openSelectDev" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                <span class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">{{ selectDev }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectDev }" alt="">
              </div>
              <div v-if="openSelectDev" class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
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
            <div class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] mb-5 xxl:mb-4 xl:mb-3 leading-none">Расположение</div>
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_sea">от моря (м)</label>
                <input v-model="filters.toSea" class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_sea">
              </div>
              <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_school">от школы (м)</label>
                <input v-model="filters.toSchool" class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_school">
              </div>
              <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_shoping">от торгового центра (м)</label>
                <input v-model="filters.toShop" class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_shoping">
              </div>
              <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_park">от парка (м)</label>
                <input v-model="filters.toPark" class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_park">
              </div>
              <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_child">от детского садика (м)</label>
                <input v-model="filters.toChildrenSchool" class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_child">
              </div>
              <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_stop">от остановки (м)</label>
                <input v-model="filters.toBus" class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_stop">
              </div>
            </div>
          </div>
          <div class="mb-10 xxl:mb-8 xl:mb-6">
            <div class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] mb-5 xxl:mb-4 xl:mb-3 leading-none">Инфраструктура</div>
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex items-center text-[#1E1D2D]" v-for="item in infos">
                <input class="custom__checkbox" name="infrastructure" type="checkbox" :id="'infrastructure' + item.id">
                <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" :for="'infrastructure' + item.id">{{ item.name }}</label>
              </div>
              <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectInstallment}">
                <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Рассрочка</span>
                <div class="relative" :tabindex="tabindex" @blur="openSelectInstallment = false">
                  <div @click="openSelectInstallment = !openSelectInstallment" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                    <span class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">{{ selectInstallment }}</span>
                    <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectInstallment }" alt="">
                  </div>
                  <div v-if="openSelectInstallment" class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
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
            <div class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] mb-5 xxl:mb-4 xl:mb-3 leading-none">Дополнительные услуги</div>
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex items-center text-[#1E1D2D]" v-for="item in dops">
                <input class="custom__checkbox" name="services" type="checkbox" :id="'services' + item.id">
                <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" :for="'services' + item.id">{{ item.name }}</label>
              </div>
            </div>
          </div>
          <div class="mb-5 xxl:mb-4 xl:mb-3">
            <div class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] mb-5 xxl:mb-4 xl:mb-3 leading-none">Фильтры</div>
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex items-center text-[#1E1D2D]">
                <input class="custom__checkbox" name="filters" type="checkbox" id="filters_1">
                <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" for="filters_1">Новинки</label>
              </div>
              <div class="flex items-center text-[#1E1D2D]">
                <input class="custom__checkbox" name="filters" type="checkbox" id="filters_2">
                <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" for="filters_2">Акции</label>
              </div>
              <div class="flex items-center text-[#1E1D2D]">
                <input class="custom__checkbox" name="filters" type="checkbox" id="filters_3">
                <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" for="filters_3">Популярные</label>
              </div>
            </div>
          </div>
          <button @click="startFilter" class="login__btn--bg text-white text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none bg-[#E84680] rounded-[5px] font-semibold py-5 xxl:py-4 xl:py-3">Фильтрация</button>
        </div>
      </div>
    </div>
    <div class="w-full px-7 xxl:px-5 xl:px-4 lg:px-0">
      <div class="relative z-20">
        <div class="hidden lg:flex bg-[#F6F3FA] rounded-[10px] justify-between items-center p-5 xxl:p-4 xl:p-3 mb-2">
          <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 rounded-[5px] text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none font-semibold">
            <div @click="openFilter = true" class="relative flex flex-col justify-evenly py-0.5 items-center cursor-pointer h-6 w-6 rounded-[5px] bg-[#6435A5]">
              <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
              <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
              <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            </div>
            <span>Фильтры</span>
          </div>
          <button class="text-[#6435A5] text-[16px] xxl:text-[14px] xl:text-[12px] md:text-[14px] lg:text-[15px] cursor-pointer leading-none">Сбросить</button>
        </div>
        <div class="flex justify-between md:flex-col md:gap-3 items-center">
          <div class="flex flex-col items-start lg:gap-2">
            <h2 class="text-[22px] font-semibold xxl:text-[18px] xl:text-[15px] lg:text-[20px] whitespace-nowrap text-center">Объекты</h2>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] md:text-[12px] whitespace-nowrap text-center">Найдено {{ readyHouses.length }} новостроек</span>
          </div>
          <div class="flex items-center md:flex-col gap-8 xxl:gap-6 xl:gap-5 md:gap-3">
            <div v-if="!map" class="relative">
              <div @click="openDate = !openDate" class="cursor-pointer flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
                <span class="text-base xxl:text-sm xl:text-xs md:text-[14px] leading-none whitespace-nowrap">
                  По {{ selectDate }}
                </span>
                <img src="../../assets/svg/arrow_down_black.svg" alt="Стрелочка вниз">
              </div>
              <div v-if="openDate" class="bg-white -left-[10%] top-[120%] rounded-[6px] text-base xxl:text-sm xl:text-xs lg:text-[15px] border border-solid border-[#E5DFEE] absolute flex flex-col z-10">
                <span
                  v-for="date in dates"
                  @click="changeDate(date)"
                  class="cursor-pointer border__bottom--not leading-none whitespace-nowrap p-4 xxl:p-3 xl:p-2.5">
                  {{ date.date }}
                </span>
              </div>
            </div>
            <div class="flex items-center gap-8 xxl:gap-6 xl:gap-5">
              <button @click="map = !map" class="button__map flex items-center gap-3 xxl:gap-2 xl:gap-1.5 p-3 xxl:p-2.5 xl:p-2 rounded-[6px]">
                <img src="../../assets/svg/map_pointer.svg" class="h-6 xxl:h-5 xl:h-4 md:h-5" alt="Метка">
                <span class="text-[#6435A5] font-medium text-base xxl:text-sm xl:text-xs md:text-[15px] whitespace-nowrap ">{{ map ? "Скрыть карту" : "Искать на карте" }}</span>
              </button>
              <div class="flex gap-3 xxl:gap-2 xl:gap-1.5" v-if="!map">
                <button @click="toggle = false" :class="{'grid--active': !toggle}" class="button__choices--grid h-9 xxl:h-7 xl:h-6 md:h-7 w-9 xxl:w-7 xl:w-6 md:w-7 gap-1 xxl:gap-0.5 rounded-[6px] p-[8px] xxl:p-[6px] xl:p-[5px]">
                  <div class="w-full rounded-[1px] h-full"></div>
                  <div class="w-full rounded-[1px] h-full"></div>
                  <div class="w-full rounded-[1px] h-full"></div>
                  <div class="w-full rounded-[1px] h-full"></div>
                </button>
                <button @click="toggle = true" :class="{'col--active': toggle}" class="button__choices--col h-9 xxl:h-7 xl:h-6 md:h-7 w-9 xxl:w-7 xl:w-6 md:w-7 gap-1.5 xl:gap-1 rounded-[6px] p-[8px] xxl:p-[6px]">
                  <div class="w-full rounded-[1px] h-full"></div>
                  <div class="w-full rounded-[1px] h-full"></div>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--  Новостройки в виде таблицы -->
      <div v-if="!toggle && !map" class="grid grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 xxl:gap-4 xl:gap-3 mt-5 xxl:mt-4 xl:mt-3">
        <div class="flex flex-col" v-for="(item, idx) in readyHouses" :key="item.id">
          <div class="object__block relative z-10 h-[300px] exl:h-fit exl:h-[16vw] lg:h-[24vw] md:h-[36vw] sm:h-[56vw] rounded-[6px]">
          <img v-if="item.images.length > 0" :src="item.image" class="object-cover absolute -z-10 w-full h-full rounded-[6px]" alt="">
          <img v-else src="../../assets/no-img-houses.jpg" class="object-cover absolute -z-10 w-full h-full rounded-[6px]" alt="">
          <div class="seek immovables__overlay opacity-0 transition-all h-full w-full absolute -z-10 rounded-[6px]"></div>
            <div class="flex flex-col h-full justify-between p-5 xxl-4 xl:p-3">
              <div class="hide transition-all">
                <span class="uppercase bg-[#30CB49] text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1 mr-2" v-if="item.created && !Number.isInteger(+item.created[0])">{{ item.created }}</span>
                <span class="uppercase bg-[#E84680] text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1" v-else-if="item.created">{{ item.created }}</span>
              </div>
              <div class="seek flex opacity-0 transition-all flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
                <button @click="$emit('open-add-selections', item)" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none">В подборку</span>
                  <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
                </button>
                <button v-if="item.favorite" @click="removeFavorite(item)" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none">Убрать</span>
                  <img src="../../assets/svg/heart_icon_fill.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                </button>
                <button v-else @click="addFavorite(item)" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none">В избранное</span>
                  <img src="../../assets/svg/heart_icon.svg" class="cursor-pointer w-5 xxl:w-4 xl:w-3" alt="">
                </button>
              </div>
              <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none">{{ item.area }}</span>
                <div class="h-1 w-1 rounded-full bg-white"></div>
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none">{{ item.flats.length }} {{ item.flats.length === 1 ? "Квартира" : item.flats.length === 2 || item.flats.length === 3 || item.flats.length === 4 ? "Квартиры" : "Квартир" }}</span>
              </div>
            </div>
          </div>
          <div class="flex flex-col text-[#1E1D2D] p-5 xxl-4 xl:p-3 leading-none">
            <Link :href="'/house/' + item.slug" class="hover__title-block transition-all font-semibold text-xl xxl:text-base xl:text-sm md:text-[17px] ">{{ item.title }}</Link>
            <span class="text-lg xxl:text-[15px] xl:text-[13px] md:text-[17px]">от {{ Number.isInteger(item.minPrice) ? item.minPrice : "-" }} €</span>
          </div>
        </div>

      </div>

      <!--  Новостройки в виде списка -->
      <div v-if="toggle && !map" class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mt-5 xxl:mt-4 xl:mt-3">
        <div class="grid__75-25 border border-solid border-[#E5DFEE] rounded-[6px]" v-for="item in readyHouses">
          <div class="border__right md:border-r-0 md:border-b-[1px] border-solid border-[#E5DFEE]">
            <div class="grid__35-65 p-2.5 xxl:p-2 xl:p-1.5 h-full">
              <div class="relative object__block h-full">
                <div class="seek opacity-0 transition-all immovables__overlay h-full w-full absolute z-10 rounded-[6px]"></div>
                <img v-if="item.images.length > 0" :src="item.image" class="object-cover w-full h-[180px] exl:h-fit exl:h-[9.3vw] x:h-[10vw] lg:h-[14vw] md:h-[32vw] sm:h-[42vw]" alt="">
                <img v-else src="../../assets/no-img-houses.jpg" class="object-cover w-full h-[180px] exl:h-fit exl:h-[9.3vw] x:h-[10vw] lg:h-[14vw] md:h-[32vw] sm:h-[42vw]" alt="">
                <div class="seek opacity-0 transition-all absolute top-1/2 -translate-y-1/2 left-0 z-10 flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
                  <button @click="$emit('open-add-selections', item)" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                    <span class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none whitespace-nowrap">В подборку</span>
                    <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
                  </button>
                  <button v-if="item.favorite" @click="removeFavorite(item)" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                    <span class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none whitespace-nowrap">Убрать</span>
                    <img src="../../assets/svg/heart_icon_fill.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <button v-else @click="addFavorite(item)" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                    <span class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none whitespace-nowrap">В избранное</span>
                    <img src="../../assets/svg/heart_icon.svg" class="cursor-pointer w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
              </div>
              <div class="flex flex-col justify-between px-4 xxl:px-3 xl:px-2.5 md:px-1.5 py-2 xxl:py-1.5 xl:py-1 md:py-3 md:gap-3.5">
                <div class="flex justify-between sm:flex-col gap-2">
                  <div class="flex flex-col gap-3 xxl:gap-2 xl:gap-1.5">
                    <Link :href="'/house/' + item.slug" class="hover__title-block transition-all leading-none font-semibold text-lg xxl:text-[15px] xl:text-[13px] md:text-[17px]">{{ item.title }}</Link>
                    <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs md:text-[14px]">{{ item.area }}</span>
                  </div>
                  <div class="flex flex-wrap gap-x-1">
                    <span class="bg-[#E84680] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] md:text-[11px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1" v-if="Math.ceil(Math.abs(new Date().getTime() - new Date(item.created_at).getTime()) / (1000 * 3600 * 24) ) <= 30">новинки</span>
                    <span class="bg-[#FA8D50] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1" v-if="item.promotion">акция</span>
                    <span class="bg-[#E84646] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1" v-if="item.visible >= 50">популярное</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-col justify-between px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2">
            <div class="flex justify-between items-center">
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] md:text-[13px]">{{ item.flats.length }} {{ item.flats.length === 1 ? "Квартира" : item.flats.length === 2 || item.flats.length === 3 || item.flats.length === 4 ? "Квартиры" : "Квартир" }}</span>
              <span class="uppercase border border-solid border-[#30CB49] h-fit text-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] md:text-[12px] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1" v-if="item.created && !Number.isInteger(+item.created[0])">{{ item.created }}</span>
              <span class="uppercase border border-solid border-[#E84680] h-fit text-[#E84680] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1" v-else-if="item.created">{{ item.created }}</span>
            </div>
            <div class="flex flex-col">
              <span class="font-medium whitespace-nowrap text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] md:text-[17px]">от {{ Number.isInteger(item.minPrice) ? item.minPrice : "-" }} €</span>
              <span class="text-[#8A8996] whitespace-nowrap text-[14px] xxl:text-[12px] xl:text-[10px] md:text-[13px]">{{ isNaN(item.minPrice / item.minSquare) ? "-" : Math.round(item.minPrice / item.minSquare) }} € за м²</span>
            </div>
            <div class="gray-backg flex items-center justify-center w-fit px-3 xxl:px-2.5 xl:px-2 gap-2 xxl:gap-1.5 xl:gap-1">
              <img src="../../assets/svg/ruller_icon.svg" class="h-4 xxl:h-3 xl:h-2.5" alt="Линейка">
              <span class="text-[14px] xxl:text-[12px] xl:text-[10px] md:text-[13px] whitespace-nowrap">{{ Number.isInteger(item.minSquare) ? item.minSquare : "-" }} м² - {{ Number.isInteger(item.maxSquare) ? item.maxSquare : "-" }} м²</span>
            </div>
          </div>
        </div>
      </div>
      <app-map @open-add-selections="openAddSelections" v-if="map" :houses="houses" :user="user"  />
    </div>
  </div>
</template>

<script>
import AppMap from "@/Components/AppMap.vue"

import Multiselect from '@vueform/multiselect'

export default {
  props: {
    houses: [],
    count: Number,
    user: {},
    city: [],
    infos: [],
    builders: [],
    dops: [],
    tabindex: {
      type: Number,
      required: false,
      default: 0,
    },
  },
  emits: ['open-filter', 'open-add-selections' ,'close-filter'],
  data() {
    return {
      filters: {
        type: null,
        city: null,
        area: null,
          priceMin: null,
        priceMax: null,
        deadline: null,
        squareMin: null,
        squareMax: null,
        builder: null,
        toSea: null,
        toSchool: null,
        toShop: null,
        toPark: null,
        toBus: null,
        toChildrenSchool: null,
        infos: [],
        dops: [],
        installment: true,
        newJK: false,
        promotions: false,
        popular: false
      },
      map: false,
      openFilter: false,
      borderType: false,
      valueSelectType: null,
      types: [
        { type: 'Новостройка', id: 0 },
        { type: 'Виллы', id: 1 }
      ],
      selectCity: null,
      openSelectCity: false,
      selectRegion: 'Центральный',
      openSelectRegion: false,
      regions: [],
      selectDeadline: 'Сдан',
      selectType: 'Новостройка',
      openSelectDeadline: false,
      openSelectType: false,
      deadlines: [
        { deadline: 'Сдан', id: 0 },
      ],
      selectDev: null,
      openSelectDev: false,
      selectInstallment: 'Да',
      openSelectInstallment: false,
      optionsInstallment: [
        { installment: 'Да', id: 0 },
        { installment: 'Нет', id: 1 },
      ],
      searchValue: null,
      toggle: false,
      selectDate: 'дате',
      openDate: false,
      dates: [
        { date: 'дате', id: 1 },
        { date: 'увеличению цены', id: 2 },
        { date: 'уменьшению цены', id: 3 },
      ],
      selectDateId: 1,
      readyHouses: [],
    }
  },
  methods: {
    addFavorite(item) {
      console.log(this.user.id)
      axios.post('/api/favorite/add', {
        user_id: this.user.id,
        house_id: item.id,
        token: this.globalToken
      })
      item.favorite = true
    },
    removeFavorite(item) {
      axios.post('/api/favorite/deleted', {
        user_id: this.user.id,
        house_id: item.id,
        token: this.globalToken
      })
      item.favorite = false
    },
    startFilter() {
      if (this.filters.toSea) {
        this.readyHouses = this.readyHouses.find(item => item.info.toSea >= this.filters.toSea)
        console.log(this.readyHouses)
      }
    },
    changeDate(date) {
      this.selectDate = date.date
      this.selectDateId = date.id
      this.openDate = false

      if (this.selectDateId === 1) {
        this.readyHouses = this.readyHouses.sort((a, b) => b.time - a.time)
      } else if (this.selectDateId === 2) {
        this.readyHouses = this.readyHouses.sort((a, b) => a.minPrice - b.minPrice)
      } else if (this.selectDateId === 3) {
        this.readyHouses = this.readyHouses.sort((a, b) => b.minPrice - a.minPrice)
      }
    },
    changeSelectCity(city, idx) {
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
    },
    openAddSelections(data) {
      this.$emit('open-add-selections', data)
    },
    selectsHidden() {
      this.openSelectInstallment = false
      this.openSelectDev = false
      this.openSelectDeadline = false
      this.openSelectRegion = false
      this.openDate = false
      this.openSelectType = false
    },
    changeSelectTypes(type) {
      this.selectType = type.type
      this.openSelectType = false
    }
  },
  created() {
    let href = window.location.href
    if (href.split('#').at(-1) === 'search') {

      axios.post('/api/house/search', { title: localStorage.getItem('searchData') })
          .then(response => {
            this.readyHouses = response.data
          })
          .catch(e => console.log(e))
    } else {
      this.readyHouses = this.houses
    }


    let date = new Date(),
        fullYear = date.getFullYear(),
        fullPlus5 = fullYear + 5

    for (fullYear; fullYear <= fullPlus5; fullYear++) {
      for (let month = 1; month <= 4; month += 1) {
        this.deadlines.push({ deadline:`${fullYear}/${month}` })
      }
    }

    if (this.city[0] !== null) {
      this.selectDev = this.builders[0].first_name
      this.selectCity = 'Выберите город...'
      this.selectRegion = 'Выберите район...'
      // this.selectRegion = this.city[0].regions[0].title
      // this.regions = this.city[0].regions

    }

    let dops = this.dops

    let minPriceForFilter = [],
        maxPriceForFilter = [],
        minSquareForFilter = [],
        maxSquareForFilter = []

    this.readyHouses.forEach(house => {
      house.time = Date.parse(house.created_at)
      this.readyHouses = this.readyHouses.sort((a, b) => b.time - a.time)


      let arr = [],
          squareFlats = []

      house.flats.forEach(item => {
        arr.push(item.price)
        squareFlats.push(item.square)
      })

      house.minPrice = Math.min(...arr)
      house.maxPrice = Math.max(...arr)
      house.minSquare = Math.min(...squareFlats)
      house.maxSquare = Math.max(...squareFlats)

      // if (Number.isInteger(house.minPrice)) minPriceForFilter.push(house.minPrice)
      // if (Number.isInteger(house.maxPrice)) maxPriceForFilter.push(house.maxPrice)
      // if (Number.isInteger(house.minSquare)) minSquareForFilter.push(house.minSquare)
      // if (Number.isInteger(house.maxSquare)) maxSquareForFilter.push(house.maxSquare)


      house.flats.forEach(item => {
        if (item.status == 0) {
          house.promotion = true
          return
        }
        house.promotion = false
      })
    })


    this.filters.priceMin = Math.min(...minPriceForFilter)
    this.filters.priceMax = Math.max(...maxPriceForFilter)

    this.readyHouses = this.readyHouses.slice(0, this.count)

  },
  computed: {
    readyHouses() {

      let filtersType = [],
          filtersCity = [],
          filtersArea = [],
          filtersPriceMin = [],
          filterPriceMax = []

      filtersType = this.readyHouses.filter(item => item.type === this.selectType)

      // return this.filters
      return this.readyHouses.splice(0, 21)

    },
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
  mounted() {
  },
  beforeDestroy() {
    // document.removeEventListener('click', this.selectsHidden)
  },
  components: {
    AppMap,
    Multiselect,
  }
}
</script>

<style scoped>

</style>

<style src="@vueform/multiselect/themes/default.css"></style>
