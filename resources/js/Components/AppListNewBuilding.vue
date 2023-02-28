<script setup>
  import Preloader from '@/Components/Preloader/Preloader.vue'
</script>

<template>
  <app-modal-notification
    class="left-[2vw] transition-all duration-1000"
    :class="{'-left__full': !openNotification}"
    @close-notification="openNotification = false"
    :text="text"
  />

  <div class="grid__list-new-build">
    <div
      class="sticky top-[2vw] filter__left lg:absolute lg:z-40 lg:top-0 transition-all duration-500 w-full bg-[#F6F3FA] rounded-[6px] h-fit"
      :class="{'animation__filter': openFilter}"
    >
      <div class="flex justify-between items-center p-7 xxl:p-5 xl:p-4">
        <span
          class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[16px] leading-none">{{ language.rielt_1[4] }}</span>
        <div class="flex items-center gap-4">
          <button class="text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none cursor-pointer"
                  v-on:click="reloadFilter">
            {{ language.rielt_1[8] }}
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
      <div class="custom__scroll h-[84vh] relative overflow-y-auto p-7 xxl:p-5 xl:p-4" v-if="preloader === false">
        <div class="mb-5 xxl:mb-4 xl:mb-3">
          <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
            <div class="flex items-center text-[#1E1D2D]">
              <input class="custom__checkbox" name="filters" type="checkbox" id="filters_1"
                     v-model="filters.badge.news">
              <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" for="filters_1">{{ language.rielt_1[51] }}</label>
            </div>
            <div class="flex items-center text-[#1E1D2D]">
              <input class="custom__checkbox" name="filters" type="checkbox" id="filters_2"
                     v-model="filters.badge.sales">
              <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" for="filters_2">{{ language.rielt_1[52] }}</label>
            </div>
            <div class="flex items-center text-[#1E1D2D]">
              <input class="custom__checkbox" name="filters" type="checkbox" id="filters_3"
                     v-model="filters.badge.popular">
              <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" for="filters_3">{{ language.rielt_1[53] }}</label>
            </div>
          </div>
        </div>

        <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">
          <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]"
               :class="{ 'border__bottom--0': openSelectCity}">
            <span
              class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">{{ language.rielt_1[15] }}</span>
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
                  <input @click.stop="noDelete" v-model="searchValue"
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
                         v-on:click="changeSelectCity(item)">{{ selectLanguage === 0 ? item.title : selectLanguage === 1 ? item.title_en !== undefined ? item.title_en : '' : item.title_tr !== undefined ? item.title_tr : '' }}
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]"
               :class="{ 'border__bottom--0': openSelectRegion}">
            <span
              class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">{{ language.rielt_1[17] }}</span>
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
                         v-on:click="changeSelectRegion(item)">{{ selectLanguage === 0 ? item.title : selectLanguage === 1 ? item.title_en !== undefined ? item.title_en : '' : item.title_tr !== undefined ? item.title_tr : '' }}
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]" v-if="filters.areas.length > 0"
               :class="{ 'border__bottom--0': openSelectRegionOpen}">
            <span
              class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">{{ language.ob[17] }} </span>
            <div class="relative" :tabindex="tabindex" @blur="openSelectRegionOpen = false">
              <div @click="openSelectRegionOpen = !openSelectRegionOpen"
                   class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
                <span>{{ selectRegion }}</span>
                <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
                     :class="{ 'rotate-180': openSelectRegionOpen }" alt="">
              </div>
              <div v-if="openSelectRegionOpen"
                   class="max-h-[150px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
                <div class="flex items-center text-[#1E1D2D] ml-5 mt-2" v-for="(item, index) in filters.areas" :key="idx">
                  <input class="custom__checkbox" name="infrastructure" type="checkbox"
                         v-bind:checked="checkRegion(item.id)">
                  <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]"
                         v-on:click="changeSelectRegion(item)">{{ selectLanguage === 0 ? item.title : selectLanguage === 1 ? item.title_en : item.title_tr }}
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div :class="{'border__purple': isBorder === 1 }"
               class="ones__select border border-solid border-[#E5DFEE] rounded-[6px] p-5 xx:p-4 xl:p-3">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">{{ language.rielt_1[18] }}</span>
            <div class="flex gap-2">
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="cost_from">{{ language.rielt_1[19] }}</label>
                <input @click="changeBorder(1)" v-model="filters.price.min"
                       class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0"
                       type="number" id="cost_from">
              </div>
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="cost_before">{{ language.rielt_1[20] }}</label>
                <input @click="changeBorder(1)" v-model="filters.price.max"
                       class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0"
                       type="number" id="cost_before">
              </div>
            </div>
          </div>

          <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
               :class="{ 'border__bottom--0': openSelectDeadline}">
            <span
              class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">{{ language.rielt_1[21] }}</span>
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
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">{{ language.rielt_1[22] }}</span>
            <div class="flex gap-2">
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="from">{{ language.rielt_1[19] }}</label>
                <input @click="changeBorder(2)" v-model="filters.square.min"
                       class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0"
                       type="number" id="from">
              </div>
              <div class="flex items-center gap-1">
                <label class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]" for="before">{{ language.rielt_1[20] }}</label>
                <input @click="changeBorder(2)" v-model="filters.square.max"
                       class="text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] border__bottom p-0 w-full bg-[#F6F3FA] border-transparent focus:ring-0"
                       type="number" id="before">
              </div>
            </div>
          </div>

          <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
               :class="{ 'border__bottom--0': openSelectDev}">
            <span
              class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">{{ language.rielt_1[23] }}</span>
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
              <span>{{ language.rielt_1[24] }}</span>
              <img :class="{'rotate-180': openLocation}" class=" transition-all w-3 xxl:w-2.5 xl:w-2"
                   src="../../assets/svg/arrow_down_black.svg" alt="">
            </div>
            <div v-if="openLocation" class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div :class="{'border__purple': isBorder === 3 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_sea">{{ language.rielt_1[26] }}
                  (м)</label>
                <input @click="changeBorder(3)" v-model="filters.location.toSea"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_sea">
              </div>
              <div :class="{'border__purple': isBorder === 4 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_school">{{ language.rielt_1[30] }} (м)</label>
                <input @click="changeBorder(4)" v-model="filters.location.toSchool"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_school">
              </div>
              <div :class="{'border__purple': isBorder === 5 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_shoping">{{ language.rielt_1[28] }} (м)</label>
                <input @click="changeBorder(5)" v-model="filters.location.toShop"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_shoping">
              </div>
              <div :class="{'border__purple': isBorder === 6 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_park">{{ language.rielt_1[33] }}
                  (м)</label>
                <input @click="changeBorder(6)" v-model="filters.location.toPark"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_park">
              </div>
              <div :class="{'border__purple': isBorder === 7 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_child">{{ language.rielt_1[29] }} (м)</label>
                <input @click="changeBorder(7)" v-model="filters.location.toChildrenSchool"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_child">
              </div>
              <div :class="{'border__purple': isBorder === 8 }"
                   class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_stop">{{ language.rielt_1[34] }} (м)</label>
                <input @click="changeBorder(8)" v-model="filters.location.toBus"
                       class="bg-[#F6F3FA] text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                       type="number" id="for_stop">
              </div>
            </div>
          </div>
          <div class="relative overflow-hidden mb-10 xxl:mb-8 xl:mb-6">
            <div @click="openInfrastruktura = !openInfrastruktura"
                 class="relative z-10 cursor-pointer text-[#1E1D2D] flex justify-between items-center text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] mb-5 xxl:mb-4 xl:mb-3 leading-none">
              <span class="hover__title-block">{{ language.rielt_1[35] }}</span>
              <img :class="{'rotate-180': openInfrastruktura}" class=" transition-all w-3 xxl:w-2.5 xl:w-2"
                   src="../../assets/svg/arrow_down_black.svg" alt="">
            </div>
            <div v-if="openInfrastruktura"
                 class="transition-all duration-500 h-fit flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex items-center text-[#1E1D2D]" v-for="(item, index) in infos_array">
                <input class="custom__checkbox" name="infrastructure" type="checkbox" :id="'infrastructure' + item.id" v-model="item.active">
                <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" :for="'infrastructure' + item.id">{{  selectLanguage === 0 ? item.name : selectLanguage === 1 ? item.name_en : item.name_tr }}</label>
              </div>
            </div>
          </div>
          <div class="mb-10 xxl:mb-8 xl:mb-6">
            <div @click="openDopServices = !openDopServices"
                 class="cursor-pointer flex justify-between items-center text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] mb-5 xxl:mb-4 xl:mb-3 leading-none">
              <span class="hover__title-block">{{ language.rielt_1[45] }}</span>
              <img :class="{'rotate-180': openDopServices}" class=" transition-all w-3 xxl:w-2.5 xl:w-2"
                   src="../../assets/svg/arrow_down_black.svg" alt="">
            </div>
            <div v-if="openDopServices" class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex items-center text-[#1E1D2D]" v-for="(item, index) in dops_array">
                <input class="custom__checkbox" name="services" type="checkbox" :id="'services' + item.id" v-model="item.active">
                <label class="text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px]" :for="'services' + item.id">{{ selectLanguage === 0 ? item.name : selectLanguage === 1 ? item.name_en : item.name_tr }}</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full px-7 xxl:px-5 xl:px-4 lg:px-0">
      <div class="relative z-20">
        <div class="hidden lg:flex bg-[#F6F3FA] rounded-[10px] justify-between items-center p-5 xxl:p-4 xl:p-3 mb-2">
          <div
            class="flex items-center gap-5 xxl:gap-4 xl:gap-3 rounded-[5px] text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none font-semibold">
            <div @click="openFilter = true"
                 class="relative flex flex-col justify-evenly py-0.5 items-center cursor-pointer h-6 w-6 rounded-[5px] bg-[#6435A5]">
              <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
              <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
              <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            </div>
            <span>{{ language.rielt_1[4] }}</span>
          </div>
          <button
            class="text-[#6435A5] text-[16px] xxl:text-[14px] xl:text-[12px] md:text-[14px] lg:text-[15px] cursor-pointer leading-none">
            {{ language.rielt_1[8] }}
          </button>
        </div>
        <div class="flex justify-between md:flex-col md:gap-3 items-center">
          <div class="flex flex-col items-start lg:gap-2">
            <h2
              class="text-[22px] font-semibold xxl:text-[18px] xl:text-[15px] lg:text-[20px] whitespace-nowrap text-center">
              {{ language.ob[23] }} {{ isSearch !== '' ? '-' + isSearch : '' }}</h2>
            <span class="flex text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] md:text-[12px] whitespace-nowrap text-center" v-if="!preloader"> {{ count_house }} {{ language.rielt_1[9] }}</span>
            <span class="flex text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] md:text-[12px] whitespace-nowrap text-center" v-else>  <div class="minLoader"></div>  {{ language.rielt_1[9] }}</span>
          </div>
          <div class="flex items-center md:flex-col gap-8 xxl:gap-6 xl:gap-5 md:gap-3">
            <div v-if="!map" :tabindex="tabindex" @blur="openDate = false" class="relative">
              <div @click="openDate = !openDate" class=" cursor-pointer flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
                <span
                  class="hover__title-block text-base xxl:text-sm xl:text-xs md:text-[14px] leading-none whitespace-nowrap">
                  {{ selectDate }}
                </span>
                <img :class="{'rotate-180': openDate }" class="transition-all"
                     src="../../assets/svg/arrow_down_black.svg" alt="Стрелочка вниз">
              </div>
              <div v-if="openDate"
                   class="bg-white overflow-hidden -left-[10%] top-[160%] xxl:top-[140%] rounded-[6px] text-base xxl:text-sm xl:text-xs lg:text-[15px] border border-solid border-[#E5DFEE] absolute flex flex-col z-10">
                <span
                  v-for="date in dates"
                  @click.stop="changeDate(date)"
                  class="hover__select cursor-pointer border__bottom--not leading-none whitespace-nowrap p-4 xxl:p-3 xl:p-2.5">
                  {{ date.date }}
                </span>
              </div>
            </div>
            <div class="flex items-center gap-8 xxl:gap-6 xl:gap-5">
              <button @click="map = !map"
                      class="button__map text-[#6435A5] flex items-center gap-3 xxl:gap-2 xl:gap-1.5 px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 rounded-[6px]">
                <svg class="w-6 xxl:w-5 xl:w-4 h-6 xxl:h-5 xl:h-4 md:h-5" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_134_1964)">
                    <path
                      d="M18.364 17.364L12 23.728L5.636 17.364C4.37734 16.1054 3.52019 14.5017 3.17293 12.7559C2.82567 11.0101 3.00391 9.20047 3.6851 7.55595C4.36629 5.91142 5.51984 4.50582 6.99988 3.51689C8.47992 2.52796 10.22 2.00012 12 2.00012C13.78 2.00012 15.5201 2.52796 17.0001 3.51689C18.4802 4.50582 19.6337 5.91142 20.3149 7.55595C20.9961 9.20047 21.1743 11.0101 20.8271 12.7559C20.4798 14.5017 19.6227 16.1054 18.364 17.364ZM12 15C13.0609 15 14.0783 14.5786 14.8284 13.8285C15.5786 13.0783 16 12.0609 16 11C16 9.93918 15.5786 8.92176 14.8284 8.17162C14.0783 7.42147 13.0609 7.00004 12 7.00004C10.9391 7.00004 9.92172 7.42147 9.17158 8.17162C8.42143 8.92176 8 9.93918 8 11C8 12.0609 8.42143 13.0783 9.17158 13.8285C9.92172 14.5786 10.9391 15 12 15ZM12 13C11.4696 13 10.9609 12.7893 10.5858 12.4143C10.2107 12.0392 10 11.5305 10 11C10 10.4696 10.2107 9.9609 10.5858 9.58583C10.9609 9.21076 11.4696 9.00004 12 9.00004C12.5304 9.00004 13.0391 9.21076 13.4142 9.58583C13.7893 9.9609 14 10.4696 14 11C14 11.5305 13.7893 12.0392 13.4142 12.4143C13.0391 12.7893 12.5304 13 12 13Z"
                      fill="#6435A5"/>
                  </g>
                  <defs>
                    <clipPath id="clip0_134_1964">
                      <rect width="24" height="24" fill="white"/>
                    </clipPath>
                  </defs>
                </svg>
                <span class="font-medium text-base xxl:text-sm xl:text-xs md:text-[15px] whitespace-nowrap ">{{ map ? language.menu_zastr_1[11] : language.rielt_1[6] }}</span>
              </button>
              <div class="flex gap-3 xxl:gap-2 xl:gap-1.5" v-if="!map">
                <button @click="toggle = false" :class="{'grid--active': !toggle}"
                        class="button__choices--grid h-9 xxl:h-7 xl:h-6 md:h-7 w-9 xxl:w-7 xl:w-6 md:w-7 gap-1 xxl:gap-0.5 rounded-[6px] p-[8px] xxl:p-[6px] xl:p-[5px]">
                  <div class="w-full rounded-[1px] h-full"></div>
                  <div class="w-full rounded-[1px] h-full"></div>
                  <div class="w-full rounded-[1px] h-full"></div>
                  <div class="w-full rounded-[1px] h-full"></div>
                </button>
                <button @click="toggle = true" :class="{'col--active': toggle}"
                        class="button__choices--col h-9 xxl:h-7 xl:h-6 md:h-7 w-9 xxl:w-7 xl:w-6 md:w-7 gap-1.5 xl:gap-1 rounded-[6px] p-[8px] xxl:p-[6px]">
                  <div class="w-full rounded-[1px] h-full"></div>
                  <div class="w-full rounded-[1px] h-full"></div>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div>
        <!--  Новостройки в виде таблицы -->
        <div v-if="!toggle && !map"
             class="grid grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 xxl:gap-4 xl:gap-3 mt-5 xxl:mt-4 xl:mt-3">
          <div class="flex flex-col" v-for="(item, idx) in filteredObjects" :key="item.id">
            <div
              class="object__block relative z-10 h-[300px] exl:h-fit exl:h-[16vw] lg:h-[24vw] md:h-[36vw] sm:h-[56vw] rounded-[6px]">
              <img v-if="item.images.length > 0" :src="item.image"
                   class="object-cover absolute -z-10 w-full h-full rounded-[6px]" alt="">
              <img v-else src="../../assets/no-img-houses.jpg"
                   class="object-cover absolute -z-10 w-full h-full rounded-[6px]" alt="">
              <div
                class="seek immovables__overlay opacity-0 transition-all h-full w-full absolute -z-10 rounded-[6px]"></div>
              <div class="flex flex-col h-full justify-between p-5 xxl-4 xl:p-3">
                <div class="hide transition-all">
                <span
                  class="uppercase bg-[#30CB49] text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1 mr-2 cursor-default"
                  v-if="item.created && !Number.isInteger(+item.created[0])">{{ language.rielt_1[10] }}</span>
                  <span
                    class="uppercase bg-[#E84680] text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1 cursor-default"
                    v-else-if="item.created">{{ item.created }}</span>
                </div>
                <div class="seek flex opacity-0 transition-all flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
                  <button @click="$emit('open-add-selections', item)"
                          class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                  <span
                    class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none whitespace-nowrap">{{ language.rielt_1[14] }}</span>
                    <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
                  </button>
                  <button v-if="item.favorite" @click="removeFavorite(item)"
                          class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                  <span
                    class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none whitespace-nowrap">{{ language.rielt_1[8] }}</span>
                    <img src="../../assets/svg/heart_icon_fill.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <button v-else @click="addFavorite(item)"
                          class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                  <span
                    class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none whitespace-nowrap">{{ language.rielt_1[16] }}</span>
                    <img src="../../assets/svg/heart_icon.svg" class="cursor-pointer w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
                <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
                <span
                  class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none">{{ getArea(item.area) }}</span>
                  <div class="h-1 w-1 rounded-full bg-white"></div>
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none">{{ item.flats.length }} {{ item.flats.length === 1 ? language.dob_kv_1[15] : item.flats.length === 2 || item.flats.length === 3 || item.flats.length === 4 ? language.dob_kv_1[16] : language.dob_kv_1[17] }}</span>
                </div>
              </div>
            </div>
            <div class="flex flex-col text-[#1E1D2D] p-5 xxl-4 xl:p-3 leading-none">
              <a target="_blank" :href="'/house/' + item.slug"
                 class="hover__title-block transition-all font-semibold text-xl xxl:text-base xl:text-sm md:text-[17px]">
                {{ item.title }}
              </a>
              <span class="text-lg xxl:text-[15px] xl:text-[13px] md:text-[17px]">от {{ Number.isInteger(item.minPrice) ? item.minPrice.toLocaleString('ru') : "-" }} € до {{ Number.isInteger(item.maxPrice) ? item.maxPrice.toLocaleString('ru') : "-" }}</span>
            </div>
          </div>

        </div>

        <!--  Новостройки в виде списка -->
        <div v-if="toggle && !map" class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mt-5 xxl:mt-4 xl:mt-3">
          <div class="grid__75-25 border border-solid border-[#E5DFEE] rounded-[6px]" v-for="item in filteredObjects"
               :key="item.id">
            <div class="border__right md:border-r-0 md:border-b-[1px] border-solid border-[#E5DFEE]">
              <div class="grid__35-65 p-2.5 xxl:p-2 xl:p-1.5 h-full">
                <div class="relative object__block h-full">
                  <div
                    class="seek opacity-0 transition-all immovables__overlay h-full w-full absolute z-10 rounded-[6px]"></div>
                  <img v-if="item.images.length > 0" :src="item.image"
                       class="object-cover w-full h-[180px] exl:h-fit exl:h-[9.3vw] x:h-[10vw] lg:h-[14vw] md:h-[32vw] sm:h-[42vw]"
                       alt="">
                  <img v-else src="../../assets/no-img-houses.jpg"
                       class="object-cover w-full h-[180px] exl:h-fit exl:h-[9.3vw] x:h-[10vw] lg:h-[14vw] md:h-[32vw] sm:h-[42vw]"
                       alt="">
                  <div
                    class="seek opacity-0 transition-all absolute top-1/2 -translate-y-1/2 left-0 z-10 flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
                    <button @click="$emit('open-add-selections', item)"
                            class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                    <span
                      class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none whitespace-nowrap">{{ language.rielt_1[14] }}</span>
                      <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
                    </button>
                    <button v-if="item.favorite" @click="removeFavorite(item)"
                            class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                    <span
                      class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none whitespace-nowrap">{{ language.rielt_1[8] }}</span>
                      <img src="../../assets/svg/heart_icon_fill.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                    </button>
                    <button v-else @click="addFavorite(item)"
                            class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                    <span
                      class="text-white text-sm xxl:text-xs xl:text-[10px] md:text-[12px] leading-none whitespace-nowrap">{{ language.rielt_1[16] }}</span>
                      <img src="../../assets/svg/heart_icon.svg" class="cursor-pointer w-5 xxl:w-4 xl:w-3" alt="">
                    </button>
                  </div>
                </div>
                <div class="flex flex-col justify-between px-7 xxl:px-6 xl:px-5 md:px-1.5 pt-7 xxl:pt-6 xl:pt-5 pb-5 xxl:pb-4 xl:pb-3 md:py-3 md:gap-3.5">
                  <div class="flex justify-between sm:flex-col gap-2">
                    <div class="w-full flex flex-col gap-3 xxl:gap-2 xl:gap-1.5">
                      <a target="_blank" :href="'/house/' + item.slug"
                         class="hover__title-block transition-all leading-none font-semibold text-lg xxl:text-[15px] xl:text-[13px] md:text-[17px]">
                        {{ item.title }}
                      </a>
                      <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs md:text-[14px]">{{ getArea(item.area) }}</span>
                    </div>
                    <div class="justify-self-end justify-end sm:justify-start flex h-fit flex-wrap gap-1">
                      <span
                        class="bg-[#E84680] self-start h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] md:text-[11px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1"
                        v-if="Math.ceil(Math.abs(new Date().getTime() - new Date(item.created_at).getTime()) / (1000 * 3600 * 24) ) <= 30">{{ language.rielt_1[51] }}</span>
                      <span
                        class="bg-[#FA8D50] self-start h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1"
                        v-if="item.promotion">{{ language.rielt_1[52] }}</span>
                      <span
                        class="bg-[#E84646] self-start h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1"
                        v-if="item.visible >= 50">{{ language.rielt_1[53] }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-col justify-between gap-1.5 px-7 xxl:px-6 xl:px-5 pt-7 xxl:pt-6 xl:pt-5 pb-5 xxl:pb-4 xl:pb-3">
              <div class="flex justify-between items-center gap-1">
                <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] md:text-[13px] whitespace-nowrap">{{ item.flats.length }} {{ item.flats.length === 1 ? language.dob_kv_1[15] : item.flats.length === 2 || item.flats.length === 3 || item.flats.length === 4 ? language.dob_kv_1[16] : language.dob_kv_1[17] }}</span>
                <span
                  class="uppercase border border-solid border-[#30CB49] h-fit text-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] md:text-[12px] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1"
                  v-if="item.created && !Number.isInteger(+item.created[0])">{{ language.rielt_1[10] }}</span>
                <span
                  class="uppercase border border-solid border-[#E84680] h-fit text-[#E84680] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1"
                  v-else-if="item.created">{{ item.created }}</span>
              </div>
              <div class="flex flex-col gap-2.5 xxl:gap-1.5 xl:gap-1">
              <span class="font-medium whitespace-nowrap text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] md:text-[17px] leading-none leading-none">{{ language.rielt_1[19] }} {{ Number.isInteger(item.minPrice) ? item.minPrice.toLocaleString('ru') : "-" }} €</span>
                <span class="text-[#8A8996] whitespace-nowrap text-[14px] xxl:text-[12px] xl:text-[10px] md:text-[13px]">{{ isNaN(item.minPrice / item.minSquare) ? "-" : Math.round(item.minPrice / item.minSquare) }} € м²</span>
              </div>
              <div class="gray-backg flex items-center justify-center w-fit px-3 xxl:px-2.5 xl:px-2 gap-2 xxl:gap-1.5 xl:gap-1">
                <img src="../../assets/svg/ruller_icon.svg" class="h-4 xxl:h-3 xl:h-2.5" alt="Линейка">
                <span class="text-[14px] xxl:text-[12px] xl:text-[10px] md:text-[13px] whitespace-nowrap">{{ Number.isInteger(item.minSquare) ? item.minSquare : "-" }} м² - {{ Number.isInteger(item.maxSquare) ? item.maxSquare : "-" }} м²</span>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full flex justify-center mb-14 xxl:mb-10 xl:mb-8" @click="nextShow()"
             v-if="count_house > count && !map"
        >
          <button
            class="more__button mt-10 transition-all text-[#E84680] border border-solid border-[#E84680] text-base xxl:text-sm xl:text-xs lg:text-[15px] px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2.5 xl:py-1.5 rounded-[3px]">
            {{ language.rielt_1[27] }}
          </button>
        </div>
      </div>

      <app-map @open-add-selections="openAddSelections" v-if="map" :houses_array="markers"
               :allHouse="readyHouses"
               :houses="filteredObjects"
               :city="city_map"
               :language="language"
               :cityes="city"
               :areas="areas"
               :selectLanguage="selectLanguage"
               :user="user"/>
    </div>
  </div>


</template>

<script>
  import AppMap from "@/Components/AppMap.vue"

  import NewsModal from "../Components/NewsComponent/NewsModal.vue";
  import Multiselect from '@vueform/multiselect'
  import AppModalNotification from "../Layouts/modal/AppModalNotification.vue"
  import {router} from "@inertiajs/vue3";

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
      areas: {},
      count_houses: 0,
      type: 0,
      language: {},
      selectLanguage: 0,
      dates: [],
    },
    emits: ['open-filter', 'open-add-selections', 'close-filter'],
    watch: {
      dates(newItem, oldItem) {
        this.selectDate = newItem[0].date;
      },
      language(item) {

        this.deadline = this.language.ob[24];
        this.selectDeadline = this.language.ob[24];

        this.deadlines = [
          {deadline: this.language.ob[24], id: 0},
          {deadline: this.language.rielt_1[10], id: 1},
        ]

        this.selectCity = this.language.ob[15]
        this.selectRegion = this.language.ob[16]

        let date = new Date(),
          fullYear = date.getFullYear(),
          fullPlus5 = fullYear + 5

        for (fullYear; fullYear <= fullPlus5; fullYear++) {
          for (let month = 1; month <= 4; month += 1) {
            this.deadlines.push({deadline: `${fullYear}/${month}`})
          }
        }
      }
    },
    data() {
      return {
        markers: [],
        preloader: true,
        housesFilters: [],
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
        map: false,
        openFilter: false,
        borderType: false,
        valueSelectType: null,
        isSearch: '',
        types: [
          {type: 'Новостройка', id: 0},
          {type: 'Виллы', id: 1}
        ],
        openSelectCity: false,
        openSelectRegion: false,
        regions: [],
        selectDeadline: this.language.ob[24],
        selectType: 'Новостройка',
        openSelectDeadline: false,
        openSelectType: false,
        deadlines: [
          {deadline: this.language.ob[24], id: 0},
          {deadline: this.language.rielt_1[10], id: 1},
        ],
        selectDev: null,
        openSelectDev: false,
        selectInstallment: 'Да',
        openSelectInstallment: false,
        optionsInstallment: [
          {installment: 'Да', id: 0},
          {installment: 'Нет', id: 1},
        ],
        searchValue: null,
        toggle: false,
        selectDate: 'дате',
        openDate: false,
        selectDateId: 1,
        readyHouses: [],
        isBorder: 0,
        openInfrastruktura: false,
        openDopServices: false,
        openFilt: false,
        houses_array: [],
        count: 30,
        text: '',
        openNotification: false,
        openLocation: false,
        isNewModal: false,
        count_house: 0,
        city_map: null,
        map_array: [],
        infos_array: [],
        dops_array: [],
        select_city_id: '',
        openSelectRegionOpen: false,
      }
    },
    methods: {
      noDelete() {
      //  noDelete
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
      reloadFilter() {
        //badge's
        this.filters.badge.popular = false;
        this.filters.badge.sales = false;
        this.filters.badge.news = false;
        //builder
        this.selectDev = '';
        this.filters.builder = '';
        //deadlines
        this.selectDeadline = this.language.ob[24];
        this.filters.deadline = 'СДАН';
        //price
        this.filters.price.max = '';
        this.filters.price.min = '';
        //square
        this.filters.square.min = '';
        this.filters.square.max = '';
        //city
        this.filters.cities = [];
        //area
        this.filters.areas = [];
        //dop
        this.infos.forEach(item => {
          item.active = false;
        })
        //info
        this.dops.forEach(item => {
          item.active = false;
        })
        //location
        this.filters.location = {
          toSea: '',
          toSchool: '',
          toShop: '',
          toPark: '',
          toChildrenSchool: '',
          toBus: '',
        }
      },
      include(where, what) {

        let status = true;

        what.forEach(item => {
          if (!where.includes(item)) {
            status = false;
          }
        })

        return status;
      },
      openHouse(href) {
        router.get(href, {preserveScroll: true})
      },
      changeBorder(id) {
        this.isBorder = id
      },
      addFavorite(item) {
        axios.post('/api/favorite/add', {
          user_id: this.user.id,
          house_id: item.id,
          token: this.user.token
        }).then(res => {
          this.openNotification = true
          this.text = 'Обьект добавлен в избранное'
          setTimeout(() => {
            this.openNotification = false
          }, 2000)
        })
        item.favorite = true
      },
      removeFavorite(item) {
        axios.post('/api/favorite/deleted', {
          user_id: this.user.id,
          house_id: item.id,
          token: this.user.token
        }).then(res => {
          this.openNotification = true
          this.text = 'Обьект удален из избранного'
          setTimeout(() => {
            this.openNotification = false
          }, 2000)
        })
        item.favorite = false
      },
      setBadge(id) {
        if (id === 1) {
          this.filters.badge.news = !this.filters.badge.news;
        } else if (id === 2) {
          this.filters.badge.sales = !this.filters.badge.sales;
        } else if (id === 3) {
          this.filters.badge.popular = !this.filters.badge.popular;
        }
      },
      setInfo(id, index) {
        if (this.filters.info.hasOwnProperty(index)) {
          delete this.filters.info[index];
        } else {
          this.filters.info[index] = id;
        }
      },
      setDop(id, index) {
        if (this.filters.dop.hasOwnProperty(index)) {
          delete this.filters.dop[index];
        } else {
          this.filters.dop[index] = id;
        }
      },
      changeDate(date) {
        this.selectDate = date.date
        this.selectDateId = date.id
        this.openDate = false

        if (this.selectDateId === 1) {
          this.houses_array = this.readyHouses.sort((a, b) => b.time - a.time)
        } else if (this.selectDateId === 2) {
          this.houses_array = this.readyHouses.sort((a, b) => a.minPrice - b.minPrice)
        } else if (this.selectDateId === 3) {
          this.houses_array = this.readyHouses.sort((a, b) => b.minPrice - a.minPrice)
        }
      },
      checkCity(id) {

        let arr = this.filters.cities.find(item => id === item.id);

        return arr !== undefined ? true : false;

      },
      checkRegion(id) {

        let arr = this.filters.areas.find(item => id === item.id);

        return arr !== undefined ? true : false;

      },
      changeSelectCity(city) {

        let arr = this.filters.cities.findIndex(item => city.id === item.id);

        if (arr !== -1) {
          this.filters.cities.splice(arr, 1);

          if (this.filters.cities.length > 0) {
            this.regions = this.filters.cities[this.filters.cities.length - 1].regions;
            this.select_city_id = this.filters.cities[this.filters.cities.length - 1].id;
            if (parseFloat(this.filters.cities[this.filters.cities.length - 1].latitude) !== null) {
              this.city_map = {
                lat: parseFloat(this.filters.cities[this.filters.cities.length - 1].latitude),
                lng: parseFloat(this.filters.cities[this.filters.cities.length - 1].longitude)
              };
            } else {
              this.city_map = null;
            }
          } else {
            this.regions = {};
            this.city_map = null;
          }
        } else {
          this.filters.cities.push({'id': city.id, 'title': city.title, 'regions': city.regions});
          this.regions = city.regions;
          this.select_city_id = city.id;
          if (parseFloat(city.latitude) !== null) {
            this.city_map = {lat: parseFloat(city.latitude), lng: parseFloat(city.longitude)};
          } else {
            this.city_map = null;
          }

        }

      },
      changeSelectRegion(region) {

        let arr = this.filters.areas.findIndex(item => region.id === item.id);

        if (arr !== -1) {

          this.filters.areas.splice(arr, 1);

        } else {

          this.filters.areas.push(region);

        }

        if(this.filters.areas.length === 0) {

          this.openSelectRegionOpen = false;

        }

      },
      changeSelectDeadline(deadline) {
        this.selectDeadline = deadline.deadline
        this.filters.deadline = deadline.deadline
        this.openSelectDeadline = false

      },
      changeSelectDev(dev) {
        this.selectDev = dev.first_name
        this.filters.builder = dev.first_name
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
      },
      updateHouses() {
        this.readyHouses.forEach(house => {

          house.time = Date.parse(house.created_at)
          this.readyHouses = this.readyHouses.sort((a, b) => b.time - a.time)

          let arr = [],
            squareFlats = []

          house.flats.forEach(item => {
            arr.push(item.price)
            squareFlats.push(item.square)
            if (item.status == 0) {
              house.promotion = true
            }
          })

          house.minPrice = Number.isInteger(Math.min(...arr)) ? Math.min(...arr) : 0
          house.maxPrice = Number.isInteger(Math.max(...arr)) ? Math.max(...arr) : 0
          house.minSquare = Math.min(...squareFlats)
          house.maxSquare = Math.max(...squareFlats)
        })

        // this.splitHouses();
      },
      // splitHouses() {
      //   this.houses_array = JSON.parse(JSON.stringify(this.readyHouses.sort((a, b) => b.created_at - a.created_at))).splice(0, this.count);
      // },
      nextShow() {
        this.count += 30;

        // this.houses_array = JSON.parse(JSON.stringify(this.readyHouses.sort((a, b) => b.created_at - a.created_at))).splice(0, this.count);
      },
      updatedMap() {
        let id = 0;

        this.markers = [];

        if (this.map_array.length > 0) {
          this.map_array.forEach(item => {
            ++id
            this.markers.push({
              id,
              position: {
                lat: +item.latitude,
                lng: +item.longitude
              }
            })
          })
        } else {
          this.markers.push({
            position: {
              lat: +this.houses.latitude,
              lng: +this.houses.longitude
            }
          })
        }
      },
    },
    created() {
      this.selectDate = this.dates[0].date;
      this.count_house = this.count_houses;
      let href = window.location.href
      if (href.split('#').at(-1) === 'search') {

        this.isSearch = `${localStorage.getItem('searchData')}`

        axios.post('/api/house/search', {
          title: localStorage.getItem('searchData'),
          token: this.user.token,
        })
          .then(response => {
            this.readyHouses = response.data;
            this.count_house = this.readyHouses.length;
            this.updateHouses()
            this.preloader = false;
          })
          .catch(e => console.log(e))
      } else {
        this.readyHouses = this.houses
        this.map_array = this.houses;

        if (this.type === 0) {
          axios.get('/api/house/getHousesJk').then(res => {
            this.readyHouses = res.data;
            this.count_house = this.readyHouses.length;
            this.map_array = this.readyHouses;
            this.updateHouses();
            this.updatedMap();
            this.preloader = false;
          })
        } else {
          axios.get('/api/house/getHousesVillages').then(res => {
            this.readyHouses = res.data;
            this.count_house = this.readyHouses.length;
            this.map_array = this.readyHouses;
            this.updateHouses();
            this.updatedMap();
            this.preloader = false;
          })
        }
      }

      this.infos.forEach(item => {
        item.active = false;

        this.infos_array.push(item);
      })

      this.dops.forEach(item => {
        item.active = false;

        this.dops_array.push(item);
      })

      let date = new Date(),
        fullYear = date.getFullYear(),
        fullPlus5 = fullYear + 5

      for (fullYear; fullYear <= fullPlus5; fullYear++) {
        for (let month = 1; month <= 4; month += 1) {
          this.deadlines.push({deadline: `${fullYear}/${month}`})
        }
      }

      // this.builders.unshift({'id': -1, 'first_name': 'Не важно'});

      if (this.city[0] !== null) {
        this.selectDev = this.builders[0].first_name
        this.selectCity = this.language.ob[15]
        this.selectRegion = this.language.ob[16]
        // this.selectRegion = this.city[0].regions[0].title
        // this.regions = this.city[0].regions

      }

      this.updateHouses()
    },
    mounted() {
      // NO DELETE
      document.addEventListener('click', (e) => {
        this.openSelectCity = false
      })
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
      filteredObjects() {
        let array = this.readyHouses;
        let object = [];

        if (this.filters.badge.sales) {
          array.forEach(item => {
            item.flats.every(value => {
              if (value.status == 0) {
                object.push(item);
                return false;
              }

              return true;
            })
          })
        } else {
          object = array;
        }

        let object1 = [];

        if (this.filters.badge.news) {
          object.forEach(item => {
            let date = new Date();
            let house_create = new Date(item.created_at);

            if (date - house_create < 2592e+9) {
              object1.push(item);
            }

          })
        } else {
          object1 = object;
        }

        let object2 = [];

        if (this.filters.badge.popular) {
          object1.forEach(item => {
            if (item.popular === true) {
              object2.push(item);
            }
          })
        } else {
          object2 = object1;
        }

        let object3 = [];

        object2.forEach(item => {
          if (this.filters.price.min !== '' && this.filters.price.max !== '') {
            if (item.minPrice > this.filters.price.min && item.minPrice < this.filters.price.max) {
              object3.push(item);
            }
          } else if (this.filters.price.min !== '' && this.filters.price.max === '') {
            if (item.minPrice > this.filters.price.min) {
              object3.push(item);
            }
          } else if (this.filters.price.max !== '' && this.filters.price.min === '') {
            if (item.minPrice < this.filters.price.max) {
              object3.push(item);
            }
          } else {
            object3 = object2;
          }
        })

        let object4 = [];

        if (this.filters.deadline && this.filters.deadline !== 'Не важно') {
          if(this.filters.deadline !== this.language.ob[24] && this.filters.deadline !== 'Не важно') {

            if(this.filters.deadline === 'Başarılı' || this.filters.deadline === 'Finished-Done') {
              this.filters.deadline = 'Сдан';
            }

            console.log(this.filters.deadline);

            object3.forEach(item => {
              if (item.created === this.filters.deadline) {
                object4.push(item);
              }
            })
          } else {
            object4 = object3;
          }

        } else {
          object4 = object3;
        }

        let object5 = [];

        object4.forEach(item => {
          if (this.filters.square.min !== '' && this.filters.square.max !== '') {
            if (item.minSquare > this.filters.square.min && item.maxSquare < this.filters.square.max) {
              object5.push(item);
            }
          } else if (this.filters.square.min !== '' && this.filters.square.max === '') {
            if (item.minSquare > this.filters.square.min) {
              object5.push(item);
            }
          } else if (this.filters.square.max !== '' && this.filters.square.min === '') {
            if (item.maxSquare < this.filters.square.max) {
              object5.push(item);
            }
          } else {
            object5 = object4;
          }
        })

        let object6 = [];

        if (this.filters.builder !== '' && this.filters.builder !== 'Не важно' && this.filters.builder !== null) {
          object5.forEach(item => {
            if (item.user !== null) {
              if (item.user.first_name !== null) {
                if (item.user.first_name.toLowerCase() === this.filters.builder.toLowerCase()) {
                  object6.push(item);
                }
              }
            } else {
              object6.push(item);
            }

          })
        } else {
          object6 = object5;
        }

        let object7 = [];

        object7 = object6.filter(location => {
          let status = true;

          if (this.filters.location.toSea !== '') {
            location.info.toSea !== null ? status = location.info.toSea < this.filters.location.toSea : status = true;
          }

          if (this.filters.location.toBus !== '') {
            if (status !== false) {
              location.info.toBus !== null ? status = location.info.toBus < this.filters.location.toBus : status = true;
            }
          }

          if (this.filters.location.toChildrenSchool !== '') {
            if (status !== false) {
              location.info.toChildrenSchool !== null ? status = location.info.toChildrenSchool < this.filters.location.toChildrenSchool : status = true;
            }
          }

          if (this.filters.location.toPark !== '') {
            if (status !== false) {
              location.info.toPark !== null ? status = location.info.toPark < this.filters.location.toPark : status = true;
            }
          }

          if (this.filters.location.toShop !== '') {
            if (status !== false) {
              location.info.toShop !== null ? status = location.info.toShop < this.filters.location.toShop : status = true;
            }
          }

          if (this.filters.location.toSchool !== '') {
            if (status !== false) {
              location.info.toSchool !== null ? status = location.info.toSchool < this.filters.location.toSchool : status = true;
            }
          }

          return status

        })

        let object8 = [];

        if (this.infos_array.find((item) => item.active === true) !== undefined) {
          object7.forEach(item => {
            if (item.info_array !== null) {
              let array = [];

              item.info_array.forEach(v => {

                array.push(v.id);

              })

              let array_info = [];

              Object.values(this.infos_array).forEach(item => {
                if(item.active === true) {
                  array_info.push(item.id);
                }
              })

              const diff = this.include(array, array_info);

              if (diff === true) {
                object8.push(item);
              }
            }
          })
        } else {
          object8 = object7;
        }

        let object9 = [];

        if (this.dops_array.find((item) => item.active === true) !== undefined) {
          object8.forEach(item => {
            if (item.dop_array !== null) {
              let array = [];

              item.dop_array.forEach(v => {
                array.push(v.id);
              })

              let array_dops = [];

              Object.values(this.dops_array).forEach(item => {
                if(item.active === true) {
                  array_dops.push(item.id);
                }
              })

              const diff = this.include(array, array_dops);

              if (diff === true) {
                object9.push(item);
              }

            }
          })
        } else {
          object9 = object8;
        }

        let object10 = [];

        if (Object.keys(this.filters.cities).length > 0) {
          object9.forEach(item => {
            if (item.city !== null) {

              let status = this.filters.cities.find(val => val.title === item.city);

              if (status !== undefined) {

                if (Object.keys(this.filters.areas).length > 0) {
                  let push = this.filters.areas.find(val => val.title === item.area);

                  if (push !== undefined) {
                    object10.push(item);
                  }

                } else {

                  object10.push(item);
                }
              }
            }
          })
        } else {
          object10 = object9;
        }

        this.houses_array = object10;
        this.map_array = object10;
        this.count_house = this.houses_array.length;
        this.updatedMap();
        return this.houses_array.splice(0, this.count);
        return this.houses_array.splice(0, this.count);
      }
    },
    components: {
      AppMap,
      Multiselect,
      AppModalNotification,
      NewsModal
    }
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

  .minLoader {
    border: 5px solid #f3f3f3; /* Light grey */
    border-top: 5px solid; /* Blue */
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 2s linear infinite;
    padding-left: 5%;
    padding-right: 5%;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }

  .loader_text {
    text-align: center;
  }
</style>

<style src="@vueform/multiselect/themes/default.css"></style>
