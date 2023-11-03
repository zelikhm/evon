<script setup>
  import {Link} from '@inertiajs/inertia-vue3'

</script>

<template>
  <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] lg:text-[20px]">{{ isEdit ? language.menu_zastr[2]
    : language.dob_ob_1[1] }}</h2>
  <div class="flex-col flex gap-5 xxl:gap-4 xl:gap-3 pt-5 xxl:pt-4 xl:pt-3">

    <div :class="{ validation: validation.title, 'border__purple': isBorder === 1 }"
         class="flex flex-col border gap-2 xxl:gap-1.5 border-solid border-[#E5DFEE] rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
      <label :class="{ validationText: validation.title }"
             class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="name_object">{{
        language.dob_ob_1[1] }}</label>
      <input v-model="object.title"
             @input="checkValidation(2)"
             @click="changeBorder(1)"
             class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[14px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
             type="text" id="name_object">
    </div>

    <div class="select-file-content">
      <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="company">{{ language.subscription[100] }}</label>
      <label class="input-file">
        <input type="file" name="file" ref="image"  @change="addImage">
        <span>{{ language.subscription[99] }}</span>
      </label>
      <div class="select-file" v-if="selectedFileName">
        <img src="../../../public/images/file-icon.png">
        <p>{{ selectedFileName }}</p>
        <span @click="removeFile">✖</span>
      </div>
    </div>

    <label
      :class="{ validationText: validation.description }"
      class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5"
      for="description_object">{{ language.dob_ob_1[2] }} (RU)
    </label>

    <QuillEditor
      id="description_object"
      :class="{ 'border---': isBorder === 2  }"
      style="height: 280px!important;"
      class="custom__scroll text-[#1E1D2D] h-full resize-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3 leading-none border-transparent focus:border-transparent focus:ring-0"
      toolbar="full"
      v-model:content="object.description"
      content-type="html"
      theme="snow"
    />

    <label
      :class="{ validationText: validation.description }"
      class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5"
      for="description_object1">{{ language.dob_ob_1[2] }} (EN)
    </label>

    <QuillEditor
      id="description_object1"
      :class="{ 'border---': isBorder === 2  }"
      style="height: 280px!important;"
      class="custom__scroll text-[#1E1D2D] h-full resize-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3 leading-none border-transparent focus:border-transparent focus:ring-0"
      toolbar="full"
      v-model:content="object.description_en"
      content-type="html"
      theme="snow"
    />

    <label
      :class="{ validationText: validation.description }"
      class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5"
      for="description_object2">{{ language.dob_ob_1[2] }} (TR)
    </label>

    <QuillEditor
      id="description_object2"
      :class="{ 'border---': isBorder === 2  }"
      style="height: 280px!important;"
      class="custom__scroll text-[#1E1D2D] h-full resize-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3 leading-none border-transparent focus:border-transparent focus:ring-0"
      toolbar="full"
      v-model:content="object.description_tr"
      content-type="html"
      theme="snow"
    />

    <!--    <div :class="{ validation: validation.description, 'border__purple': isBorder === 2 }" class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] h-[350px] xxl:h-[115px] xl:h-[95px]">-->
    <!--      <label-->
    <!--        :class="{ validationText: validation.description }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5"-->
    <!--        for="description_object">Описание объекта-->
    <!--      </label>-->


    <!--&lt;!&ndash;      <textarea v-model="object.description"&ndash;&gt;-->
    <!--                &lt;!&ndash;                type="text" id="description_object">&ndash;&gt;-->
    <!--&lt;!&ndash;      </textarea>&ndash;&gt;-->
    <!--    </div>-->

    <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]"
         :class="{ 'border__bottom--0': openSelectCity}">
      <span
        class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">{{ language.dob_ob_1[3] }}</span>
      <div class="relative">
        <div @click="openSelectCity = !openSelectCity"
             class="flex items-center justify-between cursor-pointer text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
          <span v-if="selectCity !== undefined">{{ selectLanguage === 0 ? selectCity.title : selectLanguage === 1 ? selectCity.title_en : selectCity.title_tr }}</span>
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
          >{{ selectLanguage === 0 ? city.title : selectLanguage === 1 ? city.title_en : city.title_tr }}
          </span>
        </div>
      </div>
    </div>
    <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px]"
         :class="{ 'border__bottom--0': openSelectRegion}">
      <span
        class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-5 xxl:pt-4 xl:pt-3">{{ language.dob_ob_1[4] }}</span>
      <div class="relative">
        <div @click="openSelectRegion = !openSelectRegion"
             class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5">
          <span v-if="selectRegion !== null && selectRegion !== undefined">{{ selectLanguage === 0 ? selectRegion.title : selectLanguage === 1 ? selectRegion.title_en : selectRegion.title_tr }}</span>
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
            {{ selectLanguage === 0 ? region.title : selectLanguage === 1 ? region.title_en : region.title_tr }}
          </span>
        </div>
      </div>
    </div>

    <div :class="{ validation: validation.coordinates, 'border__purple': isBorder === 15 }"
         class="flex flex-col border border-solid border-[#E5DFEE] gap-2.5 xxl:gap-2 xl:gap-1.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
      <label :class="{ validationText: validation.coordinates }"
             class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="coord_object">{{
        language.dob_ob_1[5] }}</label>
      <input v-model="object.coordinates"
             @input="checkValidation(4)"
             @blur="setMarker"
             @click="changeBorder(15)"
             class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
             type="text" id="coord_object">
    </div>

    <p class="text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] mt-2 text-center">{{ language.dob_ob_1[28] }}</p>
    <GMapMap :center="center" :zoom="6" map-type-id="roadmap"
             class="w-full h-[300px] rounded-[6px] mb-10 xxl:mb-8 xl:mb-6" :draggable="true" @click="handleClick"
             ref="myMapRef" :click="true"
             :disableDefaultUI="false"
             :options="{
                      zoomControl: false,
                      mapTypeControl: false,
                      scaleControl: false,
                      streetViewControl: false,
                      rotateControl: false,
                      fullscreenControl: true,
                }
    ">
      <GMapMarker :key="index" v-for="(m, index) in markers" :icon="'/images/icon-marker-map.svg'"
                  :position="m.position" :clickable="true" :draggable="true"
                  @click="openMarker(m.id)">
      </GMapMarker>
    </GMapMap>


    <div class="my-5 xxl:my-4 xl:my-3">
      <h3
        class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium mb-5 xxl:mb-4 xl:mb-3">
        Характеристики</h3>
      <div class="grid grid-cols-2 sm:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4">

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
             :class="{ 'border__bottom--0': openSelectDeadline}">
          <span
            class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">{{ language.dob_ob_1[6] }}</span>
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

        <div :class="{ validation: validation.floors, 'border__purple': isBorder === 11 }"
             class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label :class="{ validationText: validation.floors }"
                 class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_floors">{{
            language.dob_ob_1[7] }}</label>
          <input v-model="object.floors"
                 @input="checkValidation(5)"
                 @click="changeBorder(11)"
                 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                 type="number" id="for_floors">
        </div>

        <div :class="{'border__purple': isBorder === 12}"
             class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] px-5 xxl:px-4 xl:px-3 pt-4 pb-4 xxl:pt-3 xl:pt-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_agency_text">{{ language.dob_ob_1[8]
            }}</label>
          <input v-model="object.text_agency"
                 @click="changeBorder(12)"
                 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                 type="text" id="for_agency_text">
        </div>


        <div :class="{validation: validation.count , 'border__purple': isBorder === 13}"
             class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">
          <label :class="{ validationText: validation.count }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]"
                 for="count_flat">{{ language.ob[25] }}</label>
          <input v-model="object.count_flat"
                 @input="checkValidation(6)"
                 @click="changeBorder(13)"
                 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                 type="number" id="count_flat">
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
             :class="{ 'border__bottom--0': openSelectType}">
          <span
            class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">{{ language.dob_ob_1[10] }}</span>
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
          <span
            class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">{{ language.dob_ob_1[11] }}</span>
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

        <div
          :class="{ 'border__bottom--0': borderServices }"
          class="multi__select flex flex-col gap-2 xxl:gap-1.5 h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
        >
          <div
            class="px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5 text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">
            {{ language.dob_ob_1[12] }}
          </div>
          <Multiselect
            @click="borderServices = !borderServices"
            class="px-5 xx:px-4 xl:px-3 pb-4 xx:pb-3 xl:pb-2.5 white__arrow"
            v-model="valueSelectServices"
            :options="optionsSelectServices"
            mode="tags"
            :placeholder="language.ob[31]"
            :close-on-select="false"
            track-by="id"
          />
        </div>

        <div :class="{'border__bottom--0': borderInfrastructure}"
             class="multi__select flex flex-col gap-2 xxl:gap-1.5 h-fit border border-solid border-[#E5DFEE] rounded-[6px]">
          <div
            class="px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5 text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">
            {{ language.dob_ob_1[13] }}
          </div>
          <Multiselect
            @click="borderInfrastructure = !borderInfrastructure"
            class="px-5 xx:px-4 xl:px-3 pb-4 xx:pb-3 xl:pb-2.5 white__arrow"
            v-model="valueSelectInfrastructure"
            :options="optionsSelectInfrastructure"
            mode="tags"
            :placeholder="language.ob[31]"
            :close-on-select="false"
            track-by="id"
          />
        </div>

      </div>
      <div class="my-10 xxl:my-8 xl:my-6">
        <h3
          class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">
          {{ language.dob_ob_1[14] }}
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4">
          <div :class="{'border__purple': isBorder === 3 }"
               class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_sea">{{
              language.dob_ob_1[15] }}</label>
            <input v-model="object.toSea"
                   @click="changeBorder(3)"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_sea">
          </div>
          <div :class="{'border__purple': isBorder === 4 }"
               class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_school">{{
              language.dob_ob_1[16] }}</label>
            <input v-model="object.toSchool"
                   @click="changeBorder(4)"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_school">
          </div>
          <div :class="{'border__purple': isBorder === 5 }"
               class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_shoping">{{
              language.dob_ob_1[17] }}</label>
            <input v-model="object.toShop"
                   @click="changeBorder(5)"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_shoping">
          </div>
          <div :class="{'border__purple': isBorder === 6 }"
               class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_park">{{
              language.dob_ob_1[18] }}</label>
            <input v-model="object.toPark"
                   @click="changeBorder(6)"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_park">
          </div>
          <div :class="{'border__purple': isBorder === 7 }"
               class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_child">{{
              language.dob_ob_1[19] }}</label>
            <input v-model="object.toChildrenSchool"
                   @click="changeBorder(7)"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_child">
          </div>
          <div :class="{'border__purple': isBorder === 8 }"
               class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="for_stop">{{
              language.dob_ob_1[20] }}</label>
            <input v-model="object.toBus"
                   @click="changeBorder(8)"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="for_stop">
          </div>
        </div>
      </div>

      <div class="my-10 xxl:my-8 xl:my-6">
        <h3
          class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">
          {{ language.dob_ob_1[21] }}
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4">
          <div :class="{ 'border__purple': isBorder === 9 }"
               class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="commission">{{
              language.dob_ob_1[22] }}</label>
            <input v-model="object.percent"
                   @click="changeBorder(9)"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="number" id="commission">
          </div>
          <div :class="{'border__purple': isBorder === 10 }"
               class="flex flex-col gap-2 xxl:gap-1.5 border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]" for="comment">{{
              language.dob_ob_1[23] }}</label>
            <input v-model="object.comment"
                   @click="changeBorder(10)"
                   class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                   type="text" id="comment">
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 sm:grid-cols-1 gap-10 xxl:gap-8 xl:gap-6 lg:gap-5 my-10 xxl:my-8 xl:my-6 w-full"
           v-if="isEdit">
        <button @click="addAndContinue"
                class="login__btn--bg w-full text-center mr-4 font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-white bg-[#E84680] rounded-[6px]">
          {{ language.dob_ob_2[1] }}
        </button>
        <button
          @click="addAndContinue(1)"
          class="login__btn--bg w-full font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-white bg-[#E84680] rounded-[6px]"
        >
          {{ language.ob[33] }}
        </button>
      </div>
      <div class="grid gap-10 xxl:gap-8 xl:gap-6 my-10 xxl:my-8 xl:my-6 w-full" v-else>
        <button
          @click="addAndContinue()"
          class="login__btn--bg w-full font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-white bg-[#E84680] rounded-[6px]"
        >
          {{ language.dob_ob_1[24] }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>

  // import Multiselect from 'vue-multiselect'
  import {QuillEditor} from '@vueup/vue-quill'
  import '@vueup/vue-quill/dist/vue-quill.snow.css'

  import Multiselect from '@vueform/multiselect'

  export default {
    components: {
      Multiselect, QuillEditor
    },
    props: ['dops', 'infos', 'city', 'supports', 'count', 'house', 'language', 'selectLanguage', 'token'],
    inject: ['user'],
    emits: ['open-add-contact'],
    data() {
      return {
        mainImage: [],
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
          description_en: "",
          description_tr: "",
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
          toSea: null,
          toSchool: null,
          toShop: null,
          toPark: null,
          toBus: null,
          toChildrenSchool: null,
          installment: 0,
          count_flat: "",
          text_agency: "",
          token: this.user.token
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
          count: false,
          floors: false,
          image: false
        },
        isEdit: false,
        isBorder: 0,

        selectedFileName: null,
      }
    },
    methods: {
      addImage(e) {
        this.mainImage = e.target.files[0];
        const fileInput = this.$refs.image;
        if (fileInput.files.length > 0) {
          this.selectedFileName = fileInput.files[0].name;
        } else {
          this.selectedFileName = null;
        }
      },
      removeFile() {
        this.selectedFileName = null;
        const fileInput = this.$refs.image;
        fileInput.value = '';
      },
      changeBorder(id) {
        this.isBorder = id
      },
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
      editSupport(item) {
        this.$emit('open-add-contact', item)
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
      },
      openMarker(id) {
        this.openedMarkerID = id
      },
      addAndContinue(flag) {

        this.checkValidation(1)

        if (!this.validation.description && !this.validation.title && !this.validation.coordinates && !this.validation.count && !this.validation.floors && !this.validation.image) {
          if (this.isEdit) {
            this.object.info = []
            this.object.dop = []

            this.valueSelectServices.forEach(value => {
              if(this.selectLanguage === 0) {
                this.object.dop.push(this.dops.find(item => item.name === value).id)
              } else if (this.selectLanguage === 1) {
                this.object.dop.push(this.dops.find(item => item.name_en === value).id)
              } else if (this.selectLanguage === 2) {
                this.object.dop.push(this.dops.find(item => item.name_tr === value).id)
              }
            })

            this.valueSelectInfrastructure.forEach(value => {
              if(this.selectLanguage === 0) {
                this.object.info.push(this.infos.find(item => item.name === value).id)
              } else if (this.selectLanguage === 1) {
                this.object.info.push(this.infos.find(item => item.name_en === value).id)
              } else if (this.selectLanguage === 2) {
                this.object.info.push(this.infos.find(item => item.name_tr === value).id)
              }
            })

            this.object.city = this.selectCity
            this.object.area = this.selectRegion

            let formData = new FormData();

            let coord = this.object.coordinates.split(' ')

            formData.append('user_id', this.user.id);
            formData.append('title', this.object.title);
            formData.append('description', this.object.description);
            formData.append('description_en', this.object.description_en);
            formData.append('description_tr', this.object.description_tr);
            formData.append('city', this.selectCity.title);
            formData.append('area', this.selectRegion !== 'Не указано' ? this.selectRegion.title : null);
            formData.append('latitude', +coord[0]);
            formData.append('longitude', +coord[1]);
            formData.append('percent', this.object.percent);
            formData.append('comment', this.object.comment);
            formData.append('created', this.selectDeadline);
            formData.append('type', this.selectType === this.language.rielt_1[0] ? 'Новостройка' : 'Вилла');
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
            formData.append('toChildrenSchool', this.object.toChildrenSchool);
            formData.append('mainImage', this.mainImage);
            formData.append('fool_price', this.object.installment === 0 ? 1 : 0);
            formData.append('token', this.token);

            axios({
              method: 'post',
              url: '/api/house/create',
              headers: {"Content-type": "multipart/form-data"},
              data: formData,
            }).then(res => {
              if (flag === 1) {
                window.location.href = '/profile/edit/' + res.data.slug + '#create'
              } else {
                window.location.href = '/profile/houses'
              }
            })
          } else {

            this.object.info = []
            this.object.dop = []

            this.valueSelectServices.forEach(value => {
              if(this.selectLanguage === 0) {
                this.object.dop.push(this.dops.find(item => item.name === value).id)
              } else if (this.selectLanguage === 1) {
                this.object.dop.push(this.dops.find(item => item.name_en === value).id)
              } else if (this.selectLanguage === 2) {
                this.object.dop.push(this.dops.find(item => item.name_tr === value).id)
              }
            })

            this.valueSelectInfrastructure.forEach(value => {
              if(this.selectLanguage === 0) {
                this.object.info.push(this.infos.find(item => item.name === value).id)
              } else if (this.selectLanguage === 1) {
                this.object.info.push(this.infos.find(item => item.name_en === value).id)
              } else if (this.selectLanguage === 2) {
                this.object.info.push(this.infos.find(item => item.name_tr === value).id)
              }
            })

            this.object.city = this.selectCity
            this.object.area = this.selectRegion

            let formData = new FormData();

            let coord = this.object.coordinates.split(' ')

            formData.append('house_id', this.house.id);
            formData.append('title', this.object.title);
            formData.append('description', this.object.description);
            formData.append('description_en', this.object.description_en);
            formData.append('description_tr', this.object.description_tr);
            formData.append('city', this.selectCity.title);
            formData.append('area', this.selectRegion !== 'Не указано' ? this.selectRegion.title : null);
            formData.append('latitude', +coord[0]);
            formData.append('longitude', +coord[1]);
            formData.append('percent', this.object.percent);
            formData.append('comment', this.object.comment);
            formData.append('created', this.selectDeadline === this.language.rielt_1[10] ? 'Сдан' : this.selectDeadline);
            formData.append('type', this.selectType === this.language.rielt_1[0] ? 'Новостройка' : 'Вилла');
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
            formData.append('toChildrenSchool', this.object.toChildrenSchool);
            formData.append('mainImage', this.mainImage);
            formData.append('fool_price', this.object.installment === 0 ? 1 : 0);
            formData.append('token', this.token);

            axios({
              method: 'post',
              url: '/api/house/editHouse',
              headers: {"Content-type": "multipart/form-data"},
              data: formData,
            }).then(res => this.$emit('call-notification', 'Изменения успешно сохранены!'))
          }
        }
      },
      addedSupports(res, flag) {
        let idNewJk = res.data.id,
          house = res.data

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
            arr.append('token', this.user.token)

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
          token: this.user.token
        }).then(res => {
        })
      },
      checkValidation(num, title) {
        if (num === 1) {
          this.object.title === '' ? this.validation.title = true : this.validation.title = false
          this.object.description === '' ? this.validation.description = true : this.validation.description = false
          this.object.coordinates === '' ? this.validation.coordinates = true : this.validation.coordinates = false
          this.object.count_flat === '' ? this.validation.count = true : this.validation.count = false
          this.object.floors === '' ? this.validation.floors = true : this.validation.floors = false
        } else {
          if (this.validation.title && num === 2) this.validation.title = false
          if (this.validation.description && num === 3) this.validation.description = false
          if (this.validation.coordinates && num === 4) this.validation.coordinates = false
          if (this.validation.floors && num === 5) this.validation.floors = false
          if (this.validation.count && num === 6) this.validation.count = false
        }
      },
      changeSelectCity(city, idx) {
        this.selectCity = city
        this.object.city = city.title
        this.openSelectCity = false

        this.regions = this.city[idx].regions

        // if(this.regions.length === 0 ){
        //   this.regions.push({'id': -1, 'title': 'Не указано'});
        // }

        let status = this.regions.find(item => item.title === 'Не указано');

        if (status === undefined) {
          this.regions.unshift({'id': -1, 'title': 'Не указано'})
          this.selectRegion = 'Не указано'
        }

      },
      changeSelectRegion(region) {
        if (region.id === -1) {
          this.selectRegion = region
          this.object.area = null
        } else {
          this.selectRegion = region
          this.object.area = region.title
        }

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
      changeImage(e) {
        let file = e.target.files[0].name
        this.images[0] = file
        this.extension = file.split('.').at(-1)
      },
      deleteImage() {
        this.images = []
      },
      generationDop() {

        this.optionsSelectInfrastructure = [];
        this.optionsSelectServices = [];

        for (let key of this.dops) {
          if (this.selectLanguage === 0) {
            this.optionsSelectServices.push(key.name)
          } else if (this.selectLanguage === 1) {
            this.optionsSelectServices.push(key.name_en)
          } else if (this.selectLanguage === 2) {
            this.optionsSelectServices.push(key.name_tr)
          }
        }

        for (let key of this.infos) {
          if (this.selectLanguage === 0) {
            this.optionsSelectInfrastructure.push(key.name)
          } else if (this.selectLanguage === 1) {
            this.optionsSelectInfrastructure.push(key.name_en)
          } else if (this.selectLanguage === 2) {
            this.optionsSelectInfrastructure.push(key.name_tr)
          }
        }



        if (this.house !== undefined) {

          if (this.house.info.info !== null) {
            let info = this.house.info.info.replace(/[^\d]/g, ' '),
              arrayInfo = info.split(' ')
            this.valueSelectInfrastructure = [];
            for (let key of arrayInfo) {
              if (key !== '') {
                this.object.info.push(this.infos.find(item => item.id === +key))
                if (this.selectLanguage === 0) {
                  this.valueSelectInfrastructure.push(this.infos.find(item => item.id === +key).name)
                } else if (this.selectLanguage === 1) {
                  this.valueSelectInfrastructure.push(this.infos.find(item => item.id === +key).name_en)
                } else if (this.selectLanguage === 2) {
                  this.valueSelectInfrastructure.push(this.infos.find(item => item.id === +key).name_tr)
                }

              }
            }
          }

          if (this.house.info.dop !== null) {
            let dop = this.house.info.dop.replace(/[^\d]/g, ' '),
              arrayDop = dop.split(' ')
            this.valueSelectServices = [];
            for (let key of arrayDop) {
              if (key !== '') {
                this.object.dop.push(this.dops.find(item => item.id === +key))
                if (this.selectLanguage === 0) {
                  this.valueSelectServices.push(this.dops.find(item => item.id === +key).name)
                } else if (this.selectLanguage === 1) {
                  this.valueSelectServices.push(this.dops.find(item => item.id === +key).name_en)
                } else if (this.selectLanguage === 2) {
                  this.valueSelectServices.push(this.dops.find(item => item.id === +key).name_tr)
                }
              }
            }
          }
        }
      },
    },
    mounted() {
      let link = +window.location.href.split('/').at(-1)
      if (Number.isInteger(link)) {
        this.isEdit = true
      }

      if (this.house) this.isEdit = false
      else this.isEdit = true

      let date = new Date(),
        fullYear = date.getFullYear(),
        fullPlus5 = fullYear + 5

      for (fullYear; fullYear <= fullPlus5; fullYear++) {
        for (let month = 1; month <= 4; month += 1) {
          this.deadlines.push({deadline: `${fullYear}/${month}`})
        }
      }

      if (this.city[0] !== null) {
        this.selectCity = this.city[0].title
        this.regions = this.city[0].regions

        if (this.regions.length !== 0) {
          this.regions.unshift({'id': -1, 'title': 'Не указано'})
        } else {
          this.regions.push({'id': -1, 'title': 'Не указано'})
        }

        this.selectRegion = this.city[0].regions[0].title
      }

      this.supportsReady = this.supports

      if (this.house !== undefined) {

        let city = this.city.find(item => item.title === this.house.city);
        let area = city.regions.find(item => item.title === this.house.area);

        this.regions = city.regions;
        if (this.regions.length !== 0) {
          this.regions.unshift({'id': -1, 'title': 'Не указано'})
        } else {
          this.regions.push({'id': -1, 'title': 'Не указано'})
        }

        this.object.title = this.house.title
        this.object.description = this.house.description
        this.object.description_en = this.house.description_en
        this.object.description_tr = this.house.description_tr
        this.selectCity = city
        this.selectRegion = area
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
        this.object.comment = this.house.comment === 'null' ? '' : this.house.comment
        this.object.percent = this.house.percent
        this.object.text_agency = this.house.info.exclusive === 'null' ? '' : this.house.info.exclusive
        this.object.count_flat = this.house.info.count_flat

        this.setMarker()

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
    },

    created() {
      this.generationDop();
      this.selectType = this.language.rielt_1[0];

      this.selectInstallment = this.language.default[0];

      this.selectDeadline = this.language.rielt_1[10];
      this.deadlines = [
        {deadline: this.language.rielt_1[10], value: 1},
      ]

      this.installments = [
        {id: 0, installment: this.language.default[0]},
        {id: 1, installment: this.language.default[1]},
      ];

      this.types = [
        {type: this.language.rielt_1[0], value: 1},
        {type: this.language.rielt_1[1], value: 2},
      ]
    },
    watch: {
      house(oldSupports, newSupports) {

      },
      language(newItem) {
        this.generationDop();
        this.selectInstallment = this.language.default[0];

        this.installments = [
          {id: 0, installment: this.language.default[0]},
          {id: 1, installment: this.language.default[1]},
        ];

        this.selectDeadline = this.language.rielt_1[10];
        this.deadlines = [
          {deadline: this.language.rielt_1[10], value: 1},
        ]

        this.selectType = this.language.rielt_1[0];

        this.types = [
          {type: this.language.rielt_1[0], value: 1},
          {type: this.language.rielt_1[1], value: 2},
        ]
      }
    }
  }

</script>

<style scoped>
  .validation {
    border: 1px solid red;
  }


  .select-file-content{
    display: flex;
    flex-direction: column;
    gap: 0px;
    max-width: 250px;
  }
  .select-file{
    margin-top: 15px;
    display: flex;
    gap: 15px;
    align-items: center;
  }
  .select-file img{
    width: 25px;
  }
  .select-file p{
    font-size: 12px;
  }
  .select-file span{
    cursor: pointer;
    display: block;
    margin-left: auto;
  }
  .validationText {
    color: red;
  }
  .input-file {
    position: relative;
    display: inline-block;
  }

  .input-file span {
    position: relative;
    display: inline-block;
    cursor: pointer;
    outline: none;
    display: block;
    text-decoration: none;
    font-size: .83vw;
    vertical-align: middle;
    border: 2px solid rgb(232 70 128);
    color: rgb(232 70 128);
    text-align: center;
    border-radius: 4px;
    background-color: transparent;
    line-height: .83vw;
    padding: 8px 20px;
    box-sizing: border-box;
    margin: 0;
    margin-top: 10px;
    transition: background-color 0.2s;
  }

  .input-file input[type=file] {
    position: absolute;
    z-index: -1;
    opacity: 0;
    display: block;
    width: 0;
    height: 0;
  }

  label {
    font-size: .83vw;
  }

  .row {
    display: flex;
    gap: 15px;
  }

  /* Hover/active */
  .input-file:hover span {
    background-color: rgb(232 70 128);;
    border: 2px solid transparent;
    color: white;
  }

  .input-file:active span {
    background-color: rgb(232 70 128);;
    border: 2px solid transparent;
    color: white;
  }

  /* Disabled */
  .input-file input[type=file]:disabled + span {
    background-color: #eee;
  }
</style>
<style src="@vueform/multiselect/themes/default.css"></style>
