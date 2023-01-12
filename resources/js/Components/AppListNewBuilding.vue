<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <div class="w-full px-7 xxl:px-5 xl:px-4 lg:px-0">
    <div class="relative z-20">
      <div class="hidden lg:flex bg-[#F6F3FA] rounded-[10px] justify-between items-center p-5 xxl:p-4 xl:p-3 mb-2">
        <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 rounded-[5px] text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] leading-none font-semibold">
          <div @click="$emit('open-filter')" class="relative flex flex-col justify-evenly py-0.5 items-center cursor-pointer h-6 w-6 rounded-[5px] bg-[#6435A5]">
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
          </div>
          <span>Фильтры</span>
        </div>
        <button class="text-[#6435A5] text-[16px] xxl:text-[14px] xl:text-[12px] cursor-pointer leading-none">Сбросить</button>
      </div>
      <div class="flex justify-between md:flex-col md:gap-3 items-center">
        <div class="flex flex-col items-start">
          <h2 class="text-[22px] font-semibold xxl:text-[18px] xl:text-[15px] whitespace-nowrap text-center">Новостройки в Сочи</h2>
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] whitespace-nowrap text-center">Найдено {{ houses.length }} новостроек</span>
        </div>
        <div class="flex items-center md:flex-col gap-8 xxl:gap-6 xl:gap-5 md:gap-3">
          <div v-if="openNeeded !== 3" class="relative">
            <div @click="openDate = !openDate" class="cursor-pointer flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
              <span class="text-base xxl:text-sm xl:text-xs leading-none whitespace-nowrap">
                По {{ selectDate }}
              </span>
              <img src="../../assets/svg/arrow_down_black.svg" alt="Стрелочка вниз">
            </div>
            <div v-if="openDate" class="bg-white -left-[10%] top-[120%] rounded-[6px] text-base xxl:text-sm xl:text-xs border border-solid border-[#E5DFEE] absolute flex flex-col z-10">
              <span
                v-for="date in dates"
                @click="changeDate(date)"
                class="cursor-pointer border__bottom--not leading-none whitespace-nowrap p-4 xxl:p-3 xl:p-2.5">
                {{ date.date }}
              </span>
            </div>
          </div>
          <div class="flex items-center gap-8 xxl:gap-6 xl:gap-5">
            <button v-if="openNeeded !== 3" @click="openNeeded = 3" class="button__map flex items-center gap-3 xxl:gap-2 xl:gap-1.5 p-3 xxl:p-2.5 xl:p-2 rounded-[6px]">
              <img src="../../assets/svg/map_pointer.svg" class="h-6 xxl:h-5 xl:h-4" alt="Метка">
              <span class="text-[#6435A5] font-medium text-base xxl:text-sm xl:text-xs whitespace-nowrap">Искать на карте</span>
            </button>
            <div class="flex gap-3 xxl:gap-2 xl:gap-1.5">
              <button @click="toggle = false" :class="{'grid--active': !toggle}" class="button__choices--grid h-9 xxl:h-7 xl:h-6 w-9 xxl:w-7 xl:w-6 gap-1 xxl:gap-0.5 rounded-[6px] p-[8px] xxl:p-[6px] xl:p-[5px]">
                <div class="w-full rounded-[1px] h-full"></div>
                <div class="w-full rounded-[1px] h-full"></div>
                <div class="w-full rounded-[1px] h-full"></div>
                <div class="w-full rounded-[1px] h-full"></div>
              </button>
              <button @click="toggle = true" :class="{'col--active': toggle}" class="button__choices--col h-9 xxl:h-7 xl:h-6 w-9 xxl:w-7 xl:w-6 gap-1.5 xl:gap-1 rounded-[6px] p-[8px] xxl:p-[6px]">
                <div class="w-full rounded-[1px] h-full"></div>
                <div class="w-full rounded-[1px] h-full"></div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--  Новостройки в виде таблицы -->
    <div v-if="!toggle" class="grid grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 xxl:gap-4 xl:gap-3 mt-5 xxl:mt-4 xl:mt-3">
      <div class="flex flex-col" v-for="item in readyHouses">
          <div class="object__block relative z-10 h-[16vw] lg:h-[24vw] md:h-[36vw] sm:h-[56vw] rounded-[6px]">
          <img :src="'/storage/' + item.image" class="absolute -z-10 w-full h-full rounded-[6px]" alt="">
          <div class="seek immovables__overlay opacity-0 transition-all h-full w-full absolute -z-10 rounded-[6px]"></div>
          <div class="flex flex-col h-full justify-between p-5 xxl-4 xl:p-3">
            <div class="hide transition-all">
              <span class="uppercase bg-[#30CB49] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1 mr-2">{{ item.info.status }}</span>
              <span class="uppercase bg-[#E84680] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">2/2024</span>
            </div>
            <div class="seek flex opacity-0 transition-all flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
              <button @click="this.$emit('open-add-selections')" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
              </button>
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
              </button>
            </div>
            <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">{{ item.area }}</span>
              <div class="h-1 w-1 rounded-full bg-white"></div>
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">{{ item.flats.length }} Квартир</span>
            </div>
          </div>
        </div>
        <div class="flex flex-col text-[#1E1D2D] p-5 xxl-4 xl:p-3 leading-none">
          <Link :href="'/house/' + item.slug" class="font-semibold text-xl xxl:text-base xl:text-sm">{{ item.title }}</Link>
          <span class="text-lg xxl:text-[15px] xl:text-[13px]">от {{ Number.isInteger(item.minPrice) ? item.minPrice : "-" }} €</span>
        </div>
      </div>

    </div>

    <!--  Новостройки в виде списка -->
<!--    <div v-if="toggle" class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mt-5 xxl:mt-4 xl:mt-3">-->
<!--      <div class="grid__75-25 border border-solid border-[#E5DFEE] rounded-[6px]" v-for="item in readyHouses">-->
<!--        <div class="border__right">-->
<!--          <div class="grid__35-65 p-2.5 xxl:p-2 xl:p-1.5">-->
<!--            <div class="relative object__block">-->
<!--              <div class="seek opacity-0 transition-all immovables__overlay h-full w-full absolute z-10 rounded-[6px]"></div>-->
<!--              <img :src="'/storage/' + item.image" class="w-full h-[9.3vw]" alt="">-->
<!--              <div class="seek opacity-0 transition-all absolute top-1/2 -translate-y-1/2 left-0 z-10 flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">-->
<!--                <button @click="this.$emit('open-add-selections')" class="immovables__button&#45;&#45;card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">-->
<!--                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>-->
<!--                  <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">-->
<!--                </button>-->
<!--                <button class="immovables__button&#45;&#45;card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">-->
<!--                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>-->
<!--                  <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">-->
<!--                </button>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="flex flex-col justify-between px-4 xxl:px-3 xl:px-2.5 py-2 xxl:py-1.5 xl:py-1">-->
<!--              <div class="flex justify-between">-->
<!--                <div class="flex flex-col gap-3 xxl:gap-2 xl:gap-1.5">-->
<!--                  <Link :href="'/house/' + item.slug" class="leading-none font-semibold text-lg xxl:text-[15px] xl:text-[13px]">{{ item.title }}</Link>-->
<!--                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">{{ item.area }}</span>-->
<!--                </div>-->
<!--                <div class="flex flex-wrap gap-x-1">-->
<!--                  <span class="bg-[#E84680] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1">{{ item.status }}</span>-->
<!--&lt;!&ndash;                  <span class="bg-[#FA8D50] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1">акция</span>&ndash;&gt;-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="flex flex-wrap gap-1 text-[15px] xxl:text-[13px] xl:text-[11px]">-->
<!--                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">Договор займа</span>-->
<!--                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">Рассрочка</span>-->
<!--                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">ВНЖ</span>-->
<!--                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">Гражданство</span>-->
<!--                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">Договор купли-продажи</span>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="grid__75-25 border border-solid border-[#E5DFEE] rounded-[6px]">-->
<!--          <div class="border__right">-->
<!--            <div class="grid__35-65 p-2.5 xxl:p-2 xl:p-1.5">-->
<!--              <div class="relative object__block">-->
<!--                <div class="seek opacity-0 transition-all immovables__overlay h-full w-full absolute z-10 rounded-[6px]"></div>-->
<!--                <img src="../../assets/immovables_img_two.png" class="w-full h-[9.3vw]" alt="">-->
<!--                <div class="seek opacity-0 transition-all absolute top-1/2 -translate-y-1/2 left-0 z-10 flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">-->
<!--                  <button @click="this.$emit('open-add-selections')" class="immovables__button&#45;&#45;card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">-->
<!--                    <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>-->
<!--                    <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">-->
<!--                  </button>-->
<!--                  <button class="immovables__button&#45;&#45;card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">-->
<!--                    <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>-->
<!--                    <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">-->
<!--                  </button>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="w-full flex justify-center mb-14 xxl:mb-10 xl:mb-8" @click="count += 3">-->
<!--        <button class="more__button transition-all text-[#E84680] border border-solid border-[#E84680] text-base xxl:text-sm xl:text-xs px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2.5 xl:py-1.5 rounded-[3px]">Показать еще</button>-->
<!--      </div>-->
<!--    </div>-->

<!--      <div v-if="openNeeded === 3" class="relative w-full h-[90vh] my-5 xxl:my-4 xl:my-3">-->
<!--      <div class="absolute decription__head top-0 right-0 bg-white rounded-[10px] m-5 xxl:m-4 xl:m-3">-->
<!--        <div class="p-8 xxl:p-6 xl:p-5 border__bottom">-->
<!--          <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 mb-7 xxl:mb-5 xl:mb-4">-->
<!--            <img src="../../assets/chat_avatar.png" class="w-14 xxl:w-12 xl:w-8" alt="">-->
<!--            <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5">-->
<!--              <span class="text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] font-medium leading-none">Euro Avsallar Residence</span>-->
<!--              <span class="text-[#8A8996] text-[16px] xxl:text-[14px] xl:text-[12px] leading-none">Туапсе, А147</span>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="flex gap-2.5 xxl:gap-2 xl:gap-1.5">-->
<!--            <span class="text-white text-[14px] xxl:text-[12px] xl:text-[10px] leading-none bg-[#30CB49] px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 rounded-[3px]">СДАН</span>-->
<!--            <span class="border border-solid border-[#E5DFEE] text-[#8A8996] text-[14px] xxl:text-[12px]  xl:text-[10px] leading-none px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 rounded-[3px]">Договор займа</span>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="p-8 xxl:p-6 xl:p-5">-->
<!--          <div class="flex justify-between items-center mb-5 xxl:mb-4 xl:mb-3 text-[18px] xxl:text-[15px] xl:text-[13px]">-->
<!--            <span class="text-[#1E1D2D] font-medium leading-none">от 1 490 000 €</span>-->
<!--            <span class="text-[#8A8996] leading-none">49 Квартир</span>-->
<!--          </div>-->
<!--          <div class="gray-backg flex items-center gap-1 w-fit px-2 xl:px-1.5 py-1.5 xl:py-1 mb-7 xxl:mb-5 xl:mb-4">-->
<!--            <img src="../../assets/svg/ruller_icon.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">-->
<!--            <span class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">14.9 м² - 23.4 м²</span>-->
<!--          </div>-->
<!--          <div class="flex gap-5 xxl:gap-4 xl:gap-3 w-full">-->
<!--            <button class="w-full flex items-center justify-between border border-solid border-[#6435A5] rounded-[4px] p-3 xxl:p-2 xl:p-1.5">-->
<!--              <span class="text-[#6435A5] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">В подборку</span>-->
<!--              <img src="../../assets/svg/plus_icon_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">-->
<!--            </button>-->
<!--            <button class="w-full flex items-center justify-between border border-solid border-[#6435A5] rounded-[4px] p-3 xxl:p-2 xl:p-1.5">-->
<!--              <span class="text-[#6435A5] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">В избранное</span>-->
<!--              <img src="../../assets/svg/plus_icon_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">-->
<!--            </button>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--      <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d78173.57828522827!2d20.837833449492916!3d52.24475823593983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecae3479edae3%3A0xc04a9df8e721016f!2z0JHQtdC80L7QstC-LCDQktCw0YDRiNCw0LLQsA!5e0!3m2!1sru!2spl!4v1672332575544!5m2!1sru!2spl" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
<!--    </div>-->
<!--    </div>-->

    <div v-if="toggle" class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mt-5 xxl:mt-4 xl:mt-3">

      <div class="grid__75-25 border border-solid border-[#E5DFEE] rounded-[6px]" v-for="item in readyHouses">
        <div class="border__right">
          <div class="grid__35-65 p-2.5 xxl:p-2 xl:p-1.5">
            <div class="relative object__block">
              <div class="seek opacity-0 transition-all immovables__overlay h-full w-full absolute z-10 rounded-[6px]"></div>
              <img :src="'/storage/' + item.image" class="w-full h-[9.3vw]" alt="">
              <div class="seek opacity-0 transition-all absolute top-1/2 -translate-y-1/2 left-0 z-10 flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
                <button @click="this.$emit('open-add-selections')" class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                  <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
                </button>
                <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                  <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
                </button>
              </div>
            </div>
            <div class="flex flex-col justify-between px-4 xxl:px-3 xl:px-2.5 py-2 xxl:py-1.5 xl:py-1">
              <div class="flex justify-between">
                <div class="flex flex-col gap-3 xxl:gap-2 xl:gap-1.5">
                  <span class="leading-none font-semibold text-lg xxl:text-[15px] xl:text-[13px]">{{ item.title }}</span>
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">{{ item.area }}</span>
                </div>
                <div class="flex flex-wrap gap-x-1">
                  <span class="bg-[#E84680] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1">{{ item.status }}</span>
<!--                  <span class="bg-[#FA8D50] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-1">акция</span>-->
                </div>
              </div>
              <div class="flex flex-wrap gap-1 text-[15px] xxl:text-[13px] xl:text-[11px]">
                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">Договор займа</span>
                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">Рассрочка</span>
                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">ВНЖ</span>
                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">Гражданство</span>
                <span class="text-[#8A8996] leading-none border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5">Договор купли-продажи</span>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col justify-between px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2">
          <div class="flex justify-between items-center">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">{{ item.flats.length }} Квартир</span>
            <span class="uppercase border border-solid border-[#30CB49] h-fit text-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">{{ item.info.status }}</span>
<!--            <span class="uppercase border border-solid border-[#E84680] h-fit text-[#E84680] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">-->
          </div>
          <div class="flex flex-col">
            <span class="font-medium whitespace-nowrap text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px]">от {{ Number.isInteger(item.minPrice) ? item.minPrice : "-" }} €</span>
            <span class="text-[#8A8996] whitespace-nowrap text-[14px] xxl:text-[12px] xl:text-[10px]">{{ isNaN(item.minSquare / item.minPrice) ? "-" : Math.round(item.minSquare / item.minPrice) }} € за м²</span>
          </div>
          <div class="gray-backg flex items-center justify-center w-fit px-3 xxl:px-2.5 xl:px-2 gap-2 xxl:gap-1.5 xl:gap-1">
            <img src="../../assets/svg/ruller_icon.svg" class="h-4 xxl:h-3 xl:h-2.5" alt="Линейка">
            <span class="text-[14px] xxl:text-[12px] xl:text-[10px] whitespace-nowrap">{{ Number.isInteger(item.minSquare) ? item.minSquare : "-" }} м² - {{ Number.isInteger(item.maxSquare) ? item.maxSquare : "-" }} м²</span>
          </div>
        </div>
      </div>


    </div>
  </div>
</template>

<script>
export default {
  props: {
    houses: [],
    count: Number,
    user: [],
  },
  emits: ['open-filter', 'open-add-selections'],
  data() {
    return {
      toggle: false,
      selectDate: 'дате',
      openDate: false,
      openNeeded: 1,
      dates: [
        { date: 'дате', id: 1 },
        { date: 'увеличению цены', id: 2 },
        { date: 'уменьшению цены', id: 3 },
      ],
      selectDateId: 1,
      readyHouses: null,
    }
  },
  methods: {
    changeDate(date) {
      this.selectDate = date.date
      this.selectDateId = date.id
      this.openDate = false

      if (this.selectDateId === 2) {
        this.readyHouses = this.houses.sort((a, b) => a.minPrice - b.minPrice)
      } else if (this.selectDateId === 3) {
        this.readyHouses = this.houses.sort((a, b) => b.minPrice - a.minPrice)
      }
    }
  },
  created() {
    this.readyHouses = this.houses

    this.readyHouses.forEach(house => {
      let arr = [],
          squareFlats = []

      house.flats.forEach(item => {
        arr.push(item.price)
        squareFlats.push(item.square)
      })

      house.minPrice = Math.min(...arr)
      house.minSquare = Math.min(...squareFlats)
      house.maxSquare = Math.max(...squareFlats)

    })
    this.readyHouses = this.readyHouses.slice(0, this.count)

  },
  computed: {
    readyHouses() {
      return this.readyHouses = this.houses.slice(0, this.count)
    },
  }
}
</script>

<style scoped>

</style>
