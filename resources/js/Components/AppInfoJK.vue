<script setup>
import {Link} from '@inertiajs/inertia-vue3'

</script>

<template>
  <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] lg:text-[20px]">{{ isEdit ? "Добавить объект" : "Редактирование объекта" }}</h2>
  <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">Найдено {{ count }} новостроек</span>
  <div class="flex-col flex gap-5 xxl:gap-4 xl:gap-3 pt-5 xxl:pt-4 xl:pt-3">

    <div :class="{ validation: validation.title }"
         class="flex flex-col border gap-2 xxl:gap-1.5 border-solid border-[#E5DFEE] rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
      <label :class="{ validationText: validation.title }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="name_object">Название</label>
      <input v-model="object.title"
             @input="checkValidation(2)"
             class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[14px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
             type="text" id="name_object" >
    </div>

    <div :class="{ validation: validation.description }" class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]">
      <label :class="{ validationText: validation.description }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5"
             for="description_object">Описание объекта</label>
      <textarea v-model="object.description"
                @input="checkValidation(3)"
                class="custom__scroll text-[#1E1D2D] resize-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3 leading-none border-transparent focus:border-transparent focus:ring-0"
                type="text" id="description_object"></textarea>
    </div>

    <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]"
         :class="{ 'border__bottom--0': openSelectCity}">
      <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Город</span>
      <div class="relative">
        <div @click="openSelectCity = !openSelectCity"
             class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
          <span>{{ selectCity }}</span>
          <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
               :class="{ 'rotate-180': openSelectCity }" alt="">
        </div>
        <div v-if="openSelectCity"
             class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px]">
          <div class="relative w-full p-5 xxl:p-4 xl:p-3">
            <input v-model="searchValue"
                   class="py-3 xxl:py-2.5 xl:py-2 pl-12 xxl:pl-10 xl:pl-8 w-full text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] rounded-[6px] leading-none border border-solid border-[#E5DFEE]"
                   type="text">
            <img class="absolute top-1/2 -translate-y-1/2 left-[4%] w-4.5 xxl:w-4 xl:w-3.5"
                 src="../../assets/svg/search_icon_grey.svg" alt="">
          </div>
          <span
              v-for="(city, idx) in filteredCity" :key="idx"
              @click="changeSelectCity(city, idx)"
              class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
          >{{ city.title }}
          </span>
        </div>
      </div>
    </div>

    <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]"
         :class="{ 'border__bottom--0': openSelectRegion}">
      <span
          class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">Район</span>
      <div class="relative">
        <div @click="openSelectRegion = !openSelectRegion"
             class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
          <span>{{ selectRegion }}</span>
          <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
               :class="{ 'rotate-180': openSelectRegion }" alt="">
        </div>
        <div v-if="openSelectRegion"
             class="max-h-[150px] overflow-y-auto absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
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

    <div :class="{ validation: validation.coordinates }" class="flex flex-col border border-solid border-[#E5DFEE] gap-2.5 xxl:gap-2 xl:gap-1.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
      <label :class="{ validationText: validation.coordinates }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="coord_object">Введите координаты объекта</label>
      <input v-model="object.coordinates"
             @input="checkValidation(4)"
             @blur="setMarker"
             class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
             type="text" id="coord_object">
    </div>

    <GMapMap :center="center" :zoom="6" map-type-id="terrain" class="w-full h-[300px] rounded-[6px] my-10 xxl:my-8 xl:my-6" :draggable="true" @click="handleClick"  ref="myMapRef" :click="true">
      <GMapMarker :key="index" v-for="(m, index) in markers" :position="m.position" :clickable="true" :draggable="true"
                  @click="openMarker(m.id)" >
      </GMapMarker>
    </GMapMap>


    <div class="my-5 xxl:my-4 xl:my-3">
      <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium mb-5 xxl:mb-4 xl:mb-3">
        Характеристики</h3>
      <div class="grid grid-cols-2 sm:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4">

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
             :class="{ 'border__bottom--0': openSelectDeadline}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Срок сдачи</span>
          <div class="relative">
            <div @click="openSelectDeadline = !openSelectDeadline"
                 class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
              <span>{{ selectDeadline }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
                   :class="{ 'rotate-180': openSelectDeadline }" alt="">
            </div>
            <div v-if="openSelectDeadline"
                 class="max-h-[150px] overflow-x-auto custom__scroll-grey absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px]">
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

        <div :class="{ validation: validation.floors }" class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label :class="{ validationText: validation.floors }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_floors">Количество этажей</label>
          <input v-model="object.floors"
                 @input="checkValidation(5)"
                 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                 type="number" id="for_floors">
        </div>

        <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] px-5 xxl:px-4 xl:px-3 pt-4 pb-4 xxl:pt-3 xl:pt-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_agency_text">Эксклюзив для агентства</label>
          <input v-model="object.text_agency"
                 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                 type="text" id="for_agency_text">
        </div>


        <div class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="count_flat">Количество стояков</label>
          <input v-model="object.count_flat"
                 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                 type="number" id="count_flat">
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
             :class="{ 'border__bottom--0': openSelectType}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Тип</span>
          <div class="relative">
            <div @click="openSelectType = !openSelectType"
                 class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
              <span>{{ selectType }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
                   :class="{ 'rotate-180': openSelectType }" alt="">
            </div>
            <div v-if="openSelectType"
                 class="max-h-[150px] absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px]">
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

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
             :class="{ 'border__bottom--0': openInstallment}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Рассрочка</span>
          <div class="relative">
            <div @click="openInstallment = !openInstallment"
                 class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 pb-4 xxl:pb-3 xl:pb-2.5">
              <span>{{ selectInstallment }}</span>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
                   :class="{ 'rotate-180': openInstallment }" alt="">
            </div>
            <div v-if="openInstallment"
               class="max-h-[150px] absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px]">
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

        <div :class="{ 'border__bottom--0': borderServices }"
             class="multi__select flex flex-col gap-2 xxl:gap-1.5 h-fit border border-solid border-[#E5DFEE] rounded-[6px]">
          <div class="px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5 text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">
            Дополнительные услуги
          </div>
          <Multiselect
              @click="borderServices = !borderServices"
              class="px-5 xx:px-4 xl:px-3 pb-4 xx:pb-3 xl:pb-2.5 white__arrow"
              v-model="valueSelectServices"
              :options="optionsSelectServices"
              mode="tags"
              placeholder="Выбрать услуги"
              :close-on-select="true"
              track-by="id"
          />
        </div>

        <div :class="{'border__bottom--0': borderInfrastructure}"
             class="multi__select flex flex-col gap-2 xxl:gap-1.5 h-fit border border-solid border-[#E5DFEE] rounded-[6px]">
          <div class="px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5 text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">
            Инфраструктура
          </div>
          <Multiselect
              @click="borderServices = !borderServices"
              class="px-5 xx:px-4 xl:px-3 pb-4 xx:pb-3 xl:pb-2.5 white__arrow"
              v-model="valueSelectInfrastructure"
              :options="optionsSelectInfrastructure"
              mode="tags"
              placeholder="Выбрать услуги"
              :close-on-select="true"
              track-by="id"
          />
        </div>

      </div>
      <div class="my-10 xxl:my-8 xl:my-6">
        <div class="flex justify-between items-center">
          <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium leading-none">Контакты отдела продаж</h3>
          <button
            @click="this.$emit('open-add-contact')"
            class="flex items-center register__button--white text-[#6435A5] border border-solid border-[#6435A5] rounded-[5px] py-3 xxl:py-2.5 xl:py-2 px-4 xxl:px-3 xl:px-2.5">
            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_519_1862)">
                <path d="M7.33398 7.33301V3.33301H8.66732V7.33301H12.6673V8.66634H8.66732V12.6663H7.33398V8.66634H3.33398V7.33301H7.33398Z" fill="#6435A5"/>
              </g>
              <defs>
                <clipPath id="clip0_519_1862">
                  <rect width="16" height="16" fill="white"/>
                </clipPath>
              </defs>
            </svg>
            <span class="font-medium text-base xxl:text-sm xl:text-xs lg:text-[14px] leading-none">Добавить</span>
          </button>
        </div>
        <div v-for="item in supportsReady"
             class="contact__selling my-5 xxl:my-4 xl:my-3 text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] flex justify-between items-center rounded-[5px] p-1.5 xl:p-1">
          <div class="flex items-center gap-14 xxl:gap-10 xl:gap-8">
            <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
              <img :src="item.avatar" v-if="house !== undefined" class="h-12 xxl:h-10 xl:h-8 w-12 xxl:w-10 xl:w-8 rounded-full" alt="">
              <img :src="item.image_front" v-else class="h-12 xxl:h-10 xl:h-8 w-12 xxl:w-10 xl:w-8 rounded-full" alt="">
              <span class="text-[#1E1D2D]">{{ item.name }}</span>
            </div>
            <span class="text-[#8A8996]">{{ item.phone }}</span>
            <span class="text-[#8A8996]">{{ item.email }}</span>
          </div>
          <div class="flex gap-7 xxl:gap-5 xl:gap-4">
            <img src="../../assets/svg/pen_icon_grey.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 lg:w-6" alt="">
            <img @click="deleteSupport(item)" src="../../assets/svg/bucket_icon_red.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 lg:w-6" alt="">
          </div>
        </div>
      </div>
      <div class="my-10 xxl:my-8 xl:my-6">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">
          Расположение
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4">
          <div
              class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_sea">от моря (м)</label>
            <input v-model="object.toSea"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_sea">
          </div>
          <div
              class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_school">от школы (м)</label>
            <input v-model="object.toSchool"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_school">
          </div>
          <div
              class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_shoping">от торгового центра (м)</label>
            <input v-model="object.toShop"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_shoping">
          </div>
          <div
              class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_park">от парка (м)</label>
            <input v-model="object.toPark"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_park">
          </div>
          <div
              class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_child">от детского садика (м)</label>
            <input v-model="object.toChildrenSchool"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_child">
          </div>
          <div
              class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_stop">от остановки (м)</label>
            <input v-model="object.toBus"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_stop">
          </div>
        </div>
      </div>

      <div class="my-10 xxl:my-8 xl:my-6">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">
          Вознаграждение
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4">
          <div :class="{ validation: validation.percent }" class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label :class="{ validationText: validation.percent }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="commission">Комиссия (%)</label>
            <input v-model="object.percent"
                   @input="checkValidation(6)"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="commission">
          </div>
          <div
              class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="comment">Комментарий</label>
            <input v-model="object.comment"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="text" id="comment">
          </div>
        </div>
      </div>
      <div class="my-10 xxl:my-8 xl:my-6">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">
          Приложите файлы для наполнения</h3>
        <div class="relative my-3 xxl:my-2.5 xl:my-2">
          <input multiple @change="changeInputFile" type="file" ref="documents" id="input_file" class="opacity-0 absolute invisible">
          <label
            class="register__button--white w-fit text-[#6435A5] flex items-center cursor-pointer gap-2 xl:gap-1.5 border border-solid border-[#6435A5] rounded-[6px] px-4 xxl:px-3 xl:px-2.5 py-3 xxl:py-2.5 xl:py-2"
            for="input_file"
          >
            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_519_1862)">
                <path d="M7.33398 7.33301V3.33301H8.66732V7.33301H12.6673V8.66634H8.66732V12.6663H7.33398V8.66634H3.33398V7.33301H7.33398Z" fill="#6435A5"/>
              </g>
              <defs>
                <clipPath id="clip0_519_1862">
                  <rect width="16" height="16" fill="white"/>
                </clipPath>
              </defs>
            </svg>
            <span class="font-medium text-base xxl:text-sm xl:text-xs lg:text-[15px] leading-none">Загрузить файл</span>
          </label>
        </div>
        <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
          <div v-for="input in files" class="flex justify-between items-center">
            <div class="flex items-center gap-4 xxl:gap-3 xl:gap-2.5">
              <img src="../../assets/svg/file-icon_docx.svg" alt="">
              <span class="text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium">{{ input.title }}</span>
            </div>
            <button>
              <img @click="deleteFile(input)" class="w-6 xxl:w-5 xl:w-4 lg:w-6" src="../../assets/svg/bucket_icon_red.svg" alt="">
            </button>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 sm:grid-cols-1 gap-10 xxl:gap-8 xl:gap-6 lg:gap-5 my-10 xxl:my-8 xl:my-6 w-full" v-if="isEdit">
        <button @click="addAndContinue"
              class="login__btn--bg w-full text-center mr-4 font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-white bg-[#E84680] rounded-[6px]">
          Добавить
        </button>
        <button
          @click="addAndContinue(1)"
          class="login__btn--bg w-full font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-white bg-[#E84680] rounded-[6px]"
        >
          Добавить и продолжить
        </button>
      </div>
      <div class="grid gap-10 xxl:gap-8 xl:gap-6 my-10 xxl:my-8 xl:my-6 w-full" v-else>
        <button
          @click="addAndContinue()"
          class="login__btn--bg w-full font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-white bg-[#E84680] rounded-[6px]"
        >
          Сохранить
        </button>
      </div>
    </div>
  </div>
</template>

<script>

import Multiselect from '@vueform/multiselect'
import VueMultiselect from 'vue-multiselect'

export default {
  props: ['dops', 'infos', 'city', 'supports', 'count', 'house'],
  inject: ['user'],
  emits: ['open-add-contact'],
  data() {
    return {
      openedMarkerID: null,
      center: {lat: 38.789057678005726, lng: 35.39768557787735},
      markers: [],
      borderServices: false,
      borderInfrastructure: false,
      selectCity: 'Сочи',
      openSelectCity: false,
      searchValue: '',
      extension: null,
      object: {
        title: "",
        description: "",
        city: "",
        area: "",
        coordinates: "",
        percent: "",
        comment: "",
        statusHouse: "",
        floors: "",
        type: "",
        dop: [],
        info: [],
        toSea: "",
        toSchool: "",
        toShop: "",
        toPark: "",
        toBus: "",
        toChildrenSchool: "",
        installment: 0,
        count_flat: "",
        text_agency: "",
        token: this.globalToken
      },
      cities: [
        {city: 'Сочи', value: 1},
        {city: 'Москва', value: 2},
        {city: 'Краснодар', value: 3},
      ],

      selectFloors: '12',
      openFloors: false,
      floors: [
        {floor: '1', value: 1},
        {floor: '2', value: 1},
        {floor: '5', value: 1},
        {floor: '9', value: 1},
        {floor: '12', value: 1},
        {floor: '17', value: 1},
      ],

      selectRegion: null,
      openSelectRegion: false,

      selectDeadline: 'Сдан',
      openSelectDeadline: false,
      deadlines: [
        {deadline: 'Сдан', value: 1},
      ],

      selectType: 'Новостройка',
      openSelectType: false,
      types: [
        {type: 'Новостройка', value: 1},
        {type: 'Виллы', value: 2},
      ],

      selectInstallment: 'Да',
      openInstallment: false,
      installments: [
        {id: 0, installment: 'Да'},
        {id: 1, installment: 'Нет'},
      ],
      info: {
        array: []
      },
      valueSelectInfrastructure: [],
      valueSelectServices: [],
      optionsSelectInfrastructure: [],
      optionsSelectServices: [],
      inputFile: [],
      supportsReady: [],
      images: [],
      files: [],
      validation: {
        title: false,
        description: false,
        coordinates: false,
        latitude: false,
        percent: false,
        floors: false,
        image: false
      },
      isEdit: false
    }
  },
  methods: {
    setMarker() {
      let coordinates = this.object.coordinates.split(' ')
      this.markers = []

      let position = {
        lat: +coordinates[0],
        lng: +coordinates[1]
      }

      this.markers.push({
        position
      })
      this.center = position
    },
    deleteSupport(item) {
      axios.post('/api/house/deleteSupport', {
        id: item.id,
        token: this.globalToken
      })

      this.supportsReady.forEach((support, idx) => {
        if (item.id === support.id) {
          this.supportsReady.splice(idx, 1)
        }
      })
    },
    handleClick(event) {
      this.markers = []
      this.markers.push({
        position: {
          lat: event.latLng.lat(),
          lng: event.latLng.lng()
        }
      })
      this.object.coordinates = event.latLng.lat() + ' ' + event.latLng.lng()
      console.log(this.object)
    },
    openMarker(id) {
      this.openedMarkerID = id
    },
    addAndContinue(flag) {

      this.checkValidation(1)

      if (!this.validation.description && !this.validation.title && !this.validation.coordinates && !this.validation.percent && !this.validation.floors && !this.validation.image) {
        this.object.info = []
        this.object.dop = []

        this.valueSelectServices.forEach(value => {
          this.object.dop.push(this.dops.find(item => item.name === value).id)
        })

        this.valueSelectInfrastructure.forEach(value => {
          this.object.info.push(this.infos.find(item => item.name === value).id)
        })

        this.object.city = this.selectCity
        this.object.area = this.selectRegion

        let formData = new FormData();

        let coord = this.object.coordinates.split(' ')

        formData.append('user_id', this.user.id);
        formData.append('title', this.object.title);
        formData.append('description', this.object.description);
        formData.append('city', this.selectCity);
        formData.append('area', this.selectRegion);
        formData.append('latitude', +coord[0]);
        formData.append('longitude', +coord[1]);
        formData.append('percent', this.object.percent);
        formData.append('comment', this.object.comment);
        formData.append('created', this.selectDeadline);
        formData.append('type', this.selectType);
        formData.append('dop', this.object.dop);
        formData.append('info', this.object.info);
        formData.append('floors', this.object.floors);
        formData.append('toSea', this.object.toSea);
        formData.append('toSchool', this.object.toSchool);
        formData.append('toShop', this.object.toShop);
        formData.append('toPark', this.object.toPark);
        formData.append('toBus', this.object.toBus);
        formData.append('count_flat', this.object.count_flat);
        formData.append('exclusive', this.object.text_agency);
        formData.append('toChildrenSchool',this.object.toChildrenSchool);
        formData.append('fool_price', this.object.installment === 0 ? 1 : 0);
        formData.append('image', 'hello');
        formData.append('token', this.globalToken);

        axios({
          method: 'post',
          url: '/api/house/create',
          headers: {"Content-type": "multipart/form-data"},
          data: formData,
        }).then(res => this.addedSupports(res, flag))
      }
    },
    addedSupports(res, flag) {
      let idNewJk = res.data.id,
          house = res.data
      console.log(res)

      axios.post('/api/house/addedFiles', {

      })

      axios.post('/api/house/clearSupport', {
        house_id: idNewJk
      }).then(res => {
        this.supportsReady.forEach(item => {
          let arr = new FormData();
          arr.append('avatar', item.avatar)
          arr.append('name', item.name)
          arr.append('phone', item.phone)
          arr.append('email', item.email)
          arr.append('status', item.status)
          arr.append('link', item.link)
          arr.append('house_id', idNewJk)
          arr.append('token', this.globalToken)

          this.saveSupport(arr, flag, house);
        })
      }).catch(e => {
        if (flag === 1) {
          window.location.href = '/profile/edit/' + house.slug + '#create'
        } else {
          window.location.href = '/profile/houses'
        }
      })

    },
    saveSupport(data, flag, house) {
      axios({
        method: 'post',
        url: '/api/house/addedSupport',
        headers: {"Content-type": "multipart/form-data"},
        data: data,
      }).then(res => {
        if (flag === 1) {
          window.location.href = '/profile/edit/' + house.slug + '#create'
        } else {
          window.location.href = '/profile/houses'
        }
      })
    },
    checkValidation(num, title) {
      if (num === 1) {
        this.object.title === '' ? this.validation.title = true : this.validation.title = false
        this.object.description === '' ? this.validation.description = true : this.validation.description = false
        this.object.coordinates === '' ? this.validation.coordinates = true : this.validation.coordinates = false
        this.object.percent === '' ? this.validation.percent = true : this.validation.percent = false
        this.object.floors === '' ? this.validation.floors = true : this.validation.floors = false
      } else {
        if (this.validation.title && num === 2) this.validation.title = false
        if (this.validation.description && num === 3) this.validation.description = false
        if (this.validation.coordinates && num === 4) {this.validation.coordinates = false}
        if (this.validation.floors && num === 5) this.validation.floors = false
        if (this.validation.percent && num === 6) this.validation.percent = false
      }
    },
    changeSelectCity(city, idx) {
      this.selectCity = this.object.city = city.title
      this.openSelectCity = false

      this.selectRegion = this.city[idx].regions[0].title
      this.regions = this.city[idx].regions
    },
    changeSelectRegion(region) {
      this.selectRegion = this.object.area = region.title
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
      this.object.installment = installment.id
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
    changeImage(e) {
      let file = e.target.files[0].name
      this.images[0] = file
      this.extension = file.split('.').at(-1)
      console.log(this.extension)
    },
    deleteFile(input, idx) {
      this.files.forEach((item) => {
        if (item.title === input.title) {
          this.files.splice(idx, 1)
        }
      })
    },
    deleteImage() {
      this.images = []
    },
  },
  components: {
    Multiselect, VueMultiselect
  },
  mounted() {
    let link = +window.location.href.split('/').at(-1)
    if (Number.isInteger( link )) {
      this.isEdit = true
    }

    if (this.house) this.isEdit = false
    else this.isEdit = true

    let date = new Date(),
        fullYear = date.getFullYear(),
        fullPlus5 = fullYear + 5

    for (fullYear; fullYear <= fullPlus5; fullYear++) {
      for (let month = 1; month <= 4; month += 1) {
        this.deadlines.push({ deadline:`${fullYear}/${month}` })
      }
    }

    if (this.city[0] !== null) {
      this.selectCity = this.city[0].title
      this.selectRegion = this.city[0].regions[0].title
      this.regions = this.city[0].regions
    }

    for (let key of this.dops) {
      this.optionsSelectServices.push(key.name)
    }

    for (let key of this.infos) {
      this.optionsSelectInfrastructure.push(key.name)
    }

    this.supportsReady = this.supports

    if (this.house !== undefined) {
      this.object.title = this.house.title
      this.object.description = this.house.description
      this.selectCity = this.house.city
      this.selectRegion = this.house.area
      this.object.coordinates = this.house.latitude + ' ' + this.house.longitude
      this.selectType = this.house.info.type
      this.selectDeadline = this.house.created
      this.object.floors = this.house.info.floors
      this.object.toSea = this.house.info.toSea
      this.object.toPark = this.house.info.toPark
      this.object.toShop = this.house.info.toShop
      this.object.toSchool = this.house.info.toSchool
      this.object.toChildrenSchool = this.house.info.toChildrenSchool
      this.object.toBus = this.house.info.toBus
      this.object.comment = this.house.comment
      this.object.percent = this.house.percent
      this.object.text_agency = this.house.info.exclusive
      this.object.count_flat = this.house.info.count_flat

      this.setMarker()

      if (this.house.info.info !== null) {
        for (let key of this.house.info.info) {
          if (!+isNaN(key)) {
            this.object.info.push(this.infos.find(item => item.id === +key))
            this.valueSelectInfrastructure.push(this.infos.find(item => item.id === +key).name)
          }
        }
      }

      if (this.house.info.dop !== null) {
        for (let key of this.house.info.dop) {
          if (!+isNaN(key)) {
            this.object.dop.push(this.dops.find(item => item.id === +key))
            this.valueSelectServices.push(this.dops.find(item => item.id === +key).name)
          }
        }
      }

      this.supportsReady = this.house.supports
    }

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
  }
}

</script>

<style scoped>
.validation {
  border: 1px solid red;
}

.validationText {
  color: red;
}
</style>
