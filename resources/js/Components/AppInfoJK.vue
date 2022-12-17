<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px]">Добавить объект</h2>
  <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Найдено 1512 новостроек</span>
  <div class="flex-col flex gap-5 xxl:gap-4 xl:gap-3 pt-5 xxl:pt-4 xl:pt-3" >

    <div class="flex flex-col border gap-2 xxl:gap-1.5 border-solid border-[#E5DFEE] rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
      <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name_object">Название объекта</label>
      <input v-model="object.title" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name_object" placeholder="Euro Avsallar Residence">
    </div>

    <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]">
      <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5" for="description_object">Описание объекта</label>
      <textarea v-model="object.description" class="custom__scroll text-[#1E1D2D] resize-none text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="description_object" placeholder="Описание объекта"></textarea>
    </div>

    <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectCity}">
      <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Город</span>
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

    <div class="flex flex-col border border-solid border-[#E5DFEE] gap-2.5 xxl:gap-2 xl:gap-1.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
      <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="coord_object">Введи координаты объекта</label>
      <input v-model="object.latitude" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="coord_object" placeholder="49.5122 39.2143">
    </div>
    <iframe class="w-full h-[300px] rounded-[6px] my-10 xxl:my-8 xl:my-6"
            src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d939346.3926624231!2d26.987657373274562!3d53.35298654639129!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sru!2sby!4v1670507874830!5m2!1sru!2sby"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
    </iframe>
    <div id="map"></div>
    <div class="my-5 xxl:my-4 xl:my-3">
      <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium mb-5 xxl:mb-4 xl:mb-3">Характеристики</h3>
      <div class="grid grid-cols-2 gap-7 xxl:gap-5 xl:gap-4">

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectDeadline}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Срок сдачи</span>
          <div class="relative">
            <div @click="openSelectDeadline = !openSelectDeadline" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
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

        <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_floors">Количество этажей</label>
          <input v-model="object.floors" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_floors" placeholder="9">
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectType}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Тип</span>
          <div class="relative">
            <div @click="openSelectType = !openSelectType" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
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
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Рассрочка</span>
          <div class="relative">
            <div @click="openInstallment = !openInstallment" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 pb-4 xxl:pb-3 xl:pb-2.5">
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

        <div :class="{ 'border__bottom--0': borderServices }" class="multi__select flex flex-col gap-2 xxl:gap-1.5 h-fit border border-solid border-[#E5DFEE] rounded-[6px]">
          <div class="px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5 text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Дополнительные услуги</div>
          <Multiselect
            @click="borderServices = !borderServices"
            class="px-5 xx:px-4 xl:px-3 pb-4 xx:pb-3 xl:pb-2.5 white__arrow"
            v-model="valueSelectServices"
            :options="optionsSelectServices"
            mode="tags"
            placeholder="Выбрать услуги"
            :close-on-select="true"
          />
        </div>

        <div :class="{'border__bottom--0': borderInfrastructure}" class="multi__select flex flex-col gap-2 xxl:gap-1.5 h-fit border border-solid border-[#E5DFEE] rounded-[6px]">
          <div class="px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5 text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Инфраструктура</div>
          <Multiselect
            @click="borderInfrastructure = !borderInfrastructure"
            class="px-5 xx:px-4 xl:px-3 pb-4 xx:pb-3 xl:pb-2.5 white__arrow"
            v-model="valueSelectInfrastructure"
            :options="optionsSelectInfrastructure"
            mode="tags"
            placeholder="Инфраструктура"
            :close-on-select="true"
          />
        </div>

      </div>
      <div class="my-10 xxl:my-8 xl:my-6">
        <div class="flex justify-between items-center">
          <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none">Контакты отдела продаж</h3>
          <button @click="this.$emit('open-add-contact')" class="flex items-center border border-solid border-[#6435A5] rounded-[5px] py-3 xxl:py-2.5 xl:py-2 px-4 xxl:px-3 xl:px-2.5">
            <img src="../../assets/svg/plus_icon_purple.svg" alt="Плюсик">
            <span class="text-[#6435A5] font-medium text-base xxl:text-sm xl:text-xs leading-none">Добавить</span>
          </button>
        </div>
        <div class="contact__selling my-5 xxl:my-4 xl:my-3 text-lg xxl:text-[15px] xl:text-[13px] flex justify-between items-center rounded-[5px] p-1.5 xl:p-1">
          <div class="flex items-center gap-14 xxl:gap-10 xl:gap-8">
            <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
              <img src="../../assets/developer_avatar.png" class="h-12 xxl:h-10 xl:h-8" alt="">
              <span class="text-[#1E1D2D]">Елена</span>
            </div>
            <span class="text-[#8A8996]">+7 930 245 15 20</span>
            <span class="text-[#8A8996]">elena@mail.ru</span>
          </div>
          <div class="flex gap-7 xxl:gap-5 xl:gap-4">
            <img src="../../assets/svg/pen_icon_grey.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4" alt="">
            <img src="../../assets/svg/bucket_icon_red.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4" alt="">
          </div>
        </div>
        <div class="contact__selling my-5 xxl:my-4 xl:my-3 text-lg xxl:text-[15px] xl:text-[13px] flex justify-between items-center rounded-[5px] p-1.5 xl:p-1">
          <div class="flex items-center gap-14 xxl:gap-10 xl:gap-8">
            <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
              <img src="../../assets/developer_avatar.png" class="h-12 xxl:h-10 xl:h-8" alt="">
              <span class="text-[#1E1D2D]">Елена</span>
            </div>
            <span class="text-[#8A8996]">+7 930 245 15 20</span>
            <span class="text-[#8A8996]">elena@mail.ru</span>
          </div>
          <div class="flex gap-7 xxl:gap-5 xl:gap-4">
            <img src="../../assets/svg/pen_icon_grey.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4" alt="">
            <img src="../../assets/svg/bucket_icon_red.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4" alt="">
          </div>
        </div>
      </div>
      <div class="my-10 xxl:my-8 xl:my-6">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">Расположение</h3>
        <div class="grid grid-cols-2 gap-7 xxl:gap-5 xl:gap-4">
          <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_sea">от моря</label>
            <input v-model="object.toSea" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_sea" placeholder="500 м">
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_school">от школы</label>
            <input v-model="object.toSchool" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_school" placeholder="500 м">
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_shoping">от торгового центра</label>
            <input v-model="object.toShop" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_shoping" placeholder="500 м">
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_park">от парка</label>
            <input v-model="object.toPark" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_park" placeholder="500 м">
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_child">от детского садика</label>
            <input v-model="object.toChildrenSchool" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_child" placeholder="500 м">
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_stop">от остановки</label>
            <input v-model="object.to" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_stop" placeholder="500 м">
          </div>
        </div>
      </div>
      <div class="my-10 xxl:my-8 xl:my-6">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">Вознаграждение</h3>
        <div class="grid grid-cols-2 gap-7 xxl:gap-5 xl:gap-4">
          <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="commission">Комиссия</label>
            <input v-model="object.percent" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="commission" placeholder="5 %">
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="comment">Комментарий</label>
            <input v-model="object.comment" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="comment" placeholder="///">
          </div>
        </div>
      </div>
      <div class="my-10 xxl:my-8 xl:my-6">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">Приложите файлы для наполнения</h3>
        <div class="relative my-3 xxl:my-2.5 xl:my-2">
          <input @change="changeInputFile" type="file" id="input_file" class="opacity-0 absolute invisible" multiple>
          <label class="w-fit flex items-center cursor-pointer gap-2 xl:gap-1.5 border border-solid border-[#6435A5] rounded-[6px] px-4 xxl:px-3 xl:px-2.5 py-3 xxl:py-2.5 xl:py-2" for="input_file" >
            <img class="w-4.5 xxl:w-4 xl:w-3.5" src="../../assets/svg/plus_icon_purple.svg" alt="Выбрать файл">
            <span class="text-[#6435A5] font-medium text-base xxl:text-sm xl:text-xs leading-none">Загрузить файл</span>
          </label>
        </div>
        <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
          <div v-for="input in files" class="relative flex items-center gap-4 xxl:gap-3 xl:gap-2.5">
            <img src="../../assets/svg/file-icon_docx.svg" alt="">
            <span class="text-lg xxl:text-[15px] xl:text-[13px] font-medium">{{ input.title }}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 my-10 xxl:my-8 xl:my-6 w-full gap-10 xxl:gap-8 xl:gap-6">
        <Link href="" @click="addObject" class="w-full text-center mr-4 font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] text-white bg-[#E84680] rounded-[6px]">Добавить</Link>
        <button @click="addObject(1)" class="w-full font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] text-white bg-[#E84680] rounded-[6px]">Добавить и продолжить</button>
      </div>
    </div>
  </div>
</template>

<script>

import Multiselect from '@vueform/multiselect'

export default {
  props: ['dops', 'infos'],
  data() {
    return {
      borderServices: false,
      borderInfrastructure: false,
      selectCity: 'Сочи',
      openSelectCity: false,
      object: {
        user_id: Math.ceil(Math.random() * 999),
        title: null,
        description: null,
        city: null,
        area: null,
        longitude: null,
        latitude: null,
        percent: null,
        comment: null,
        statusHouse: null,
        floors: null,
        type: null,
        dop: null,
        info: null,
        toSea: null,
        toSchool: null,
        toShop: null,
        toPark: null,
        toChildrenSchool: null,
        token: this.globalToken
      },
      cities: [
        { city: 'Сочи', value: 1 },
        { city: 'Москва', value: 2 },
        { city: 'Краснодар', value: 3 },
      ],

      selectFloors: '12',
      openFloors: false,
      floors: [
        { floor: '1', value: 1},
        { floor: '2', value: 1},
        { floor: '5', value: 1},
        { floor: '9', value: 1},
        { floor: '12', value: 1},
        { floor: '17', value: 1},
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

      valueSelectInfrastructure: null,
      valueSelectServices: null,
      optionsSelectInfrastructure: [],
      optionsSelectServices: [],
      inputFile: [],
      files: []
    }
  },
  methods: {
    addObject(id) {
      this.object.dop = this.valueSelectServices
      this.object.info = this.valueSelectInfrastructure
      this.object.city = this.selectCity
      this.object.area = this.selectRegion
      this.object.statusHouse = this.de

      axios.post('/api/house/create', {
        user_id: Math.ceil(Math.random() * 999),
        title: this.object.title,
        description: this.object.description,
        city: this.selectCity,
        area: this.selectRegion,
        longitude: this.object.longitude,
        latitude: this.object.longitude,
        percent: this.object.percent,
        comment: this.object.comment,
        statusHouse: this.selectDeadline,
        floors: this.object.floors,
        type: this.object.type,
        dop: this.valueSelectServices,
        info: this.valueSelectInfrastructure,
        toSea: this.object.toSea,
        toSchool: this.object.toSchool,
        toShop: this.object.toShop,
        toPark: this.object.toPark,
        toChildrenSchool: this.object.toChildrenSchool,
        token: this.globalToken
      })
          .then(response => console.log(response.data))
          .catch(e => console.error(e))
    },
    changeSelectCity(city) {
      this.selectCity = this.object.city = city.city
      this.openSelectCity = false
    },
    changeSelectRegion(region) {
      this.selectRegion = region.region
      this.openSelectRegion = false
    },
    changeSelectDeadline(deadline) {
      this.selectDeadline = this.object.statusHouse = deadline.deadline
      this.openSelectDeadline = false
    },
    changeSelectFloors(floor) {
      this.selectFloors = this.object.floors = floor.floor
      this.openFloors = false
    },
    changeSelectType(type) {
      this.selectType = this.object.type = type.type
      this.openSelectType = false
    },
    changeSelectInstallment(installment) {
      this.selectInstallment = installment.installment
      this.openInstallment = false
    },
    changeInputFile(e) {
      this.inputFile = Array.from(e.target.files)
      this.inputFile.forEach(i => {
        let obj = {
          title: i.name,
          extension: i.name.split(".")[1]
        }
        this.files.push(obj)
      })
    },
  },
  components: {
    Multiselect,
  },
  mounted() {
    for (let key of this.dops) {
      this.optionsSelectServices.push(key.name)
    }

    for (let key of this.infos) {
      this.optionsSelectInfrastructure.push(key.name)
    }

  },
  created() {
    console.log(this.dops)
    console.log(this.infos)
  }
}

</script>
