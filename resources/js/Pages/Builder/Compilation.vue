
<template>
  <AppChessScheme v-if="scheme" :flat="selectFlat" @closeChess="scheme = false" :language="language"></AppChessScheme>
  <header class="relative">
    <div class="bg-[#6435A5] h-[60px] xxl:h-12 xl:h-10 lg:h-12">
      <div class="_container h-full text-[16px] xxl:text-[13px] xl:text-[11px]">
        <div class="flex items-center justify-between h-full">
          <Link href="/houses" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
          </Link>
          <change-language @selectLanguage="choseLanguage" :selectLang="selectLanguage" />
        </div>
      </div>
    </div>
    <img
      class=" h-[13.4vw] lg:h-[130px] w-full absolute top-[60px] xxl:top-12 xl:top-10 lg:top-12 left-0"
      src="../../../assets/bg_links.jpg" alt="">
    <div class="_container flex h-[13.4vw] lg:h-[130px]">
      <div class="self-end flex items-center gap-7 xxl:gap-6 xl:gap-5 mb-10 xxl:mb-8 xl:mb-6">
        <div>
          <img
            class="flex-shrink-0 bg-black w-24 xxl:w-20 xl:w-16 h-24 xxl:h-20 xl:h-16 rounded-full flex items-center justify-center"
            :src="compilation.user.image" alt="">
        </div>
        <div class="text-white flex flex-col gap-2 xxl:gap-1.5 xl:gap-1">
          <span class="text-[18px] xxl:text-[16px] xl:text-[14px] lg:text-[16px] leading-none"
                v-if="compilation.user !== null">{{ compilation.user.first_name + ' ' + compilation.user.last_name }}</span>
          <span class="text-[18px] xxl:text-[16px] xl:text-[14px] lg:text-[16px] leading-none" v-else>{{ language.ob[18]
          }}</span>
        </div>
      </div>
    </div>
  </header>
  <app-modal-album :image="house.images" v-if="album" @close-album="album = false" :language="language" />
  <main>
    <div class="_container flex flex-col">
      <div class="decription__head rounded-[12px] p-5 xxl:p-4 xl:p-3 my-7 xxl:my-5 xl:my-4">
        <div class="flex items-center justify-between sm:flex-col sm:items-start sm:gap-2">
          <div class="flex flex-col sm:gap-3">
            <div class="flex items-center sm:flex-col sm:items-start gap-5 xxl:gap-4 xl:gap-3">
              <!--  <span class="font-semibold text-xl xxl:text-lg xl:text-sm lg:text-[18px]">{{ compilation.isVisible === 1 ?
                 house.title : language.ob[20] + ` №${house.id + 10000}` }}</span> -->
              <div
                class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1 text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[12px]">
                <span
                  class="flex items-center justify-center uppercase border border-solid border-[#30CB49] h-fit text-[#30CB49] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-if="house.created && !Number.isInteger(+house.created[0])">{{ language.rielt_1[10] }}</span>
                <span
                  class="flex items-center justify-center uppercase border border-solid border-[#E84680] h-fit text-[#E84680] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-else-if="house.created">{{ house.created }}</span>
                <span
                  class="flex items-center justify-center text-white font-semibold bg-[#FA8D50] leading-none rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-if="house.promotion">{{ language.rielt_1[52] }}</span>
                <span
                  class="flex items-center justify-center text-white font-semibold bg-[#E84680] leading-none rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-if="Math.ceil(Math.abs(new Date().getTime() - new Date(house.created_at).getTime()) / (1000 * 3600 * 24)) <= 30">{{
                    language.rielt_1[51] }}</span>
                <span
                  class="flex items-center justify-center text-white font-semibold bg-[#E84646] leading-none rounded-[3px] px-3 xxl:px-2 xl:px-1.5 h-[25px] xxl:h-[20px] xl:h-[16px]"
                  v-if="house.visible >= 50">{{ language.rielt_1[53] }}</span>
              </div>
            </div>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[12px]"
                  v-if="compilation.isVisible === 1">{{ getCity(house.city) }}, {{ getArea(house.area) }}</span>
          </div>
          <div class="flex items-center gap-1.5 xxl:gap-1 xl:gap-0.5">
            <img src="../../../assets/svg/reload_icon.svg" class="h-4 xx:h-3.5 xl:h-3" alt="reload">
            <span class="text-sm xxl:text-xs xl:text-[10px] lg:text-[12px]">{{ getDate(house.updated_at) }}</span>
          </div>
        </div>
      </div>
      <div class="grid__68-30 justify-between">
        <div class="flex flex-col">
          <swiper :modules="modules" :navigation="true" :loop="true" class="mySwiper w-full">
            <swiper-slide v-if="house.images.length > 0" class="h-full flex justify-center" v-for="image in house.images">
              <img @click="album = true" class="h-full w-full object-cover cursor-pointer" :src="image.name" alt="">
            </swiper-slide>
            <swiper-slide v-else class="h-full flex justify-center">
              <img class="h-full w-full object-cover" src="../../../assets/no-img-house.jpg" alt="">
            </swiper-slide>

          </swiper>
          <div
            class="border border-solid border-[#E5DFEE] h-[100px] xxl:h-[80px] xl:h-[60px] flex md:flex-col md:h-fit items-center justify-evenly rounded-[12px] mt-7 xxl:mt-5 xl:mt-4 mb-16 xxl:mb-12 xl:mb-10">
            <div class="flex flex-col justify-center md:py-2">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] text-center leading-none">{{
                house.flats.length }}</span>
              <span class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[11px]">{{
                house.flats.length === 1 ? language.dob_kv_1[15] : house.flats.length === 2 || house.flats.length === 3 ||
                  house.flats.length === 4 ? language.dob_kv_1[16] : language.dob_kv_1[17] }}</span>
            </div>
            <div class="h-full md:h-[1px] w-[1px] md:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center md:py-2">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] text-center leading-none">{{
                minPriceForM.toLocaleString('ru') }} €</span>
              <span class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[11px]">{{
                language.rielt_1[56] }}
                м²</span>
            </div>
            <div class="h-full md:h-[1px] w-[1px] md:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center md:py-2">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] text-center leading-none">{{
                minPriceFlat.toLocaleString('ru') }} €</span>
              <span class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[11px]">{{
                language.rielt_1[57] }}</span>
            </div>
            <div class="h-full md:h-[1px] w-[1px] md:w-full bg-[#E5DFEE]"></div>
            <div class="flex flex-col justify-center md:py-2">
              <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] text-center leading-none">{{
                minSquareFlat }} - {{ maxSquareFlat }}</span>
              <span class="text-center text-[#8A8996] text-[13px] xxl:text-[11px] xl:text-[9px] lg:text-[11px]">{{
                language.rielt_1[22] }},
                м²</span>
            </div>
          </div>
          <div class="flex flex-col pb-14 xxl:pb-10 xl:pb-8">
            <span
              class="uppercase font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] pb-5 xxl:pb-4 xl:pb-3 leading-none">{{
                language.ob[6] }}</span>
            <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4" v-if="fullDescription"
               v-html="selectLanguage === 0 ? house.description : selectLanguage === 1 ? house.description_en : house.description_tr">
            </p>
            <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4" v-else
               v-html="selectLanguage === 0 ? house.description.slice(0, 300) : selectLanguage === 1 ? house.description_en : house.description_tr + '...'">
            </p>
            <button class="flex gap-2 xxl:gap-1.5 xl:gap-1 w-fit items-center animation__arrow"
                    @click="fullDescription = !fullDescription">
              <span class="text-[#6435A5] font-medium text-sm xxl:text-xs xl:text-[10px] lg:text-[12px]">{{
                fullDescription ? language.menu_zastr_1[11] : language.menu_zastr_1[14] }}</span>
              <img src="../../../assets/svg/arrow_right_purple.svg"
                   class="transition-all duration-300 w-3.5 xxl:w-3 xl:wp-2.5" alt="Стрелочка в право">
            </button>
          </div>
          <div class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] pb-14 xxl:pb-10 xl:pb-8"
               v-if="arrayInfos.length > 0">
            <span class="font-medium">{{ language.dob_ob_1[13] }}</span>
            <div class="flex flex-wrap gap-3 xxl:gap-2.5 xl:gap-2m pt-4 xxl:pt-3 xl:pt-2.5">
              <span
                class="infrostruct__banner text-[#E84680] rounded-[12px] xl:rounded-[8px] leading-none px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2 xl:py-1.5"
                v-for="item in arrayInfos">{{ selectLanguage === 0 ? item.name : selectLanguage === 1 ? item.name_en :
                  item.name_tr }}</span>
            </div>
          </div>
          <div class="grid grid-cols-2 md:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4 pb-16 xxl:pb-12 xl:pb-10">
            <div class="border border-solid border-[#E5DFEE] p-7 xxl:p-5 xl:p-4 rounded-[12px]">
              <span class="font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px]">{{ language.dob_ob_1[12]
              }}</span>
              <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 pt-6 xxl:pt-5 xl:pt-4">
                <div class="flex justify-between items-center" v-for="dop in dops">
                  <span :class="{ disableColor: dop.active !== 1 }" class="text-base xxl:text-sm xl:text-xs">{{
                    selectLanguage === 0 ? dop.name : selectLanguage === 1 ? dop.name_en : dop.name_tr }}</span>
                  <div v-if="dop.active === 1"
                       class="bg-[#30CB49] h-5 w-5 xxl:h-4 xxl:w-4 xl:h-3 xl:w-3 rounded-full flex items-center justify-center">
                    <img src="../../../assets/svg/check_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </div>
                  <div v-else
                       class="bg-[#E84680] h-5 w-5 xxl:h-4 xxl:w-4 xl:h-3 xl:w-3 rounded-full flex items-center justify-center">
                    <img src="../../../assets/svg/exit_icon_white.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </div>
                </div>
              </div>
            </div>
            <div class="border border-solid border-[#E5DFEE] p-7 xxl:p-5 xl:p-4 rounded-[12px]">
              <span class="font-medium text-[18px] xxl:text-[15px] xl:text-[13px ]lg:text-[15px]">{{ language.dob_ob_1[14]
              }}</span>
              <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 pt-6 xxl:pt-5 xl:pt-4">
                <div class="flex justify-between items-center" v-if="house.info.toSea !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">{{ language.dob_ob_1[15] }}</span>
                  <span class="text-base xxl:text-sm xl:text-xs">{{ house.info.toSea }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toShop !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">{{ language.dob_ob_1[16] }}</span>
                  <span class="text-base xxl:text-sm xl:text-xs">{{ house.info.toShop }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toChildrenSchool !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">{{ language.dob_ob_1[17] }}</span>
                  <span class="text-base xxl:text-sm xl:text-xs">{{ house.info.toChildrenSchool }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toPark !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">{{ language.dob_ob_1[18] }}</span>
                  <span class="text-base xxl:text-sm xl:text-xs">{{ house.info.toPark }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toBus !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">{{ language.dob_ob_1[19] }}</span>
                  <span class="text-base xxl:text-sm xl:text-xs">{{ house.info.toBus }} м</span>
                </div>
                <div class="flex justify-between items-center" v-if="house.info.toSchool !== null">
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">{{ language.dob_ob_1[20] }}</span>
                  <span class="text-base xxl:text-sm xl:text-xs">{{ house.info.toSchool }} м</span>
                </div>
              </div>
            </div>
          </div>
          <div class="pb-16 xxl:pb-12 xl:pb-10">
            <div
              class="font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none mb-7 xxl:mb-5 xl:mb-4">
              {{ language.ob[41] }} ({{ frames.length }})
            </div>
            <div class="grid grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 xxl:gap-4 xl:gap-3">
              <div :class="{ 'decription__head': item.active === 1 }" @click="targetFrame(item)"
                   class="cursor-pointer relative rounded-[10px]" v-for="item in frames">
                <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 p-7 xxl:p-5 xl:p-4">
                  <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
                    <span class="font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none">{{
                      item.name }}</span>
                  </div>
                  <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[12px] leading-none">{{
                    item.flats.length }} {{ language.dob_kv_1[17] }}. {{ language.rielt_1[19] }} {{
    (Math.round(item.minPrice / item.minSquare)).toLocaleString('ru') }} € {{ language.rielt_1[20] }} {{
    (Math.round(item.maxPrice / item.maxSquare)).toLocaleString('ru') }} € {{ language.ob[19] }} м2</span>
                </div>
                <div class="absolute top-0 right-0 p-2.5 xxl:p-2 xl:p-1.5">
                  <label class="payd__checkbox" :for="'pay' + item.id">
                    <input type="radio" value="1" :id="'pay' + item.id" :checked="item.active === 1"
                           name="payd"><span></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="pb-16 xxl:pb-12 xl:pb-10">
            <div
              class="font-medium text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none mb-7 xxl:mb-5 xl:mb-4">
              {{ flats_array.length }} {{ language.dob_kv_1[17] }}
            </div>
            <div class="grid grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-5 xxl:gap-4 xl:gap-3 mb-7 xxl:mb-5 xl:mb-4">
              <div
                class="border border-solid border-[#E5DFEE] rounded-[6px] px-4 xx:px-3 xl:px-2.5 py-2 xxl:py-1.5 xl:py-1">
                <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[12px] leading-none">{{
                  language.dob_kv_1[5] }}</span>
                <div class="flex gap-2">
                  <div class="flex items-center gap-1">
                    <label class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none"
                           for="cost_from">{{ language.rielt_1[19] }}</label>
                    <input v-model="priceFrom" @input="filter()"
                           class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] border__bottom leading-none p-0 w-full border-transparent focus:ring-0"
                           type="number" id="cost_from">
                  </div>
                  <div class="flex items-center gap-1">
                    <label class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none"
                           for="cost_before">{{ language.rielt_1[20] }}</label>
                    <input v-model="priceTo" @input="filter()"
                           class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] border__bottom leading-none p-0 w-full border-transparent focus:ring-0"
                           type="number" id="cost_before">
                  </div>
                </div>
              </div>
              <div
                class="border border-solid border-[#E5DFEE] rounded-[6px] px-4 xx:px-3 xl:px-2.5 py-2 xxl:py-1.5 xl:py-1">
                <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[12px] leading-none">{{
                  language.dob_kv_1[4] }} м²</span>
                <div class="flex gap-2">
                  <div class="flex items-center gap-1">
                    <label class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none" for="from">{{
                      language.rielt_1[19] }}</label>
                    <input v-model="squareFrom" @input="filter()"
                           class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] border__bottom leading-none p-0 w-full border-transparent focus:ring-0"
                           type="number" id="from">
                  </div>
                  <div class="flex items-center gap-1">
                    <label class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none" for="before">{{
                      language.rielt_1[20] }}</label>
                    <input v-model="squareTo" @input="filter()"
                           class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] border__bottom leading-none p-0 w-full border-transparent focus:ring-0"
                           type="number" id="before">
                  </div>
                </div>
              </div>
              <div :tabindex="tabindex" @blur="openSelectLayout = false"
                   class="flex flex-col w-full h-fit border border-solid border-[#E5DFEE] rounded-[6px]"
                   :class="{ 'border__bottom--0': openSelectLayout }">
                <span
                  class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[12px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">{{
                    language.dob_kv_1[6] }}</span>
                <div class="relative">
                  <div @click="openSelectLayout = !openSelectLayout"
                       class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 pb-3 xxl:pb-2.5 xl:pb-2">
                    <span>{{ selectLayout }}</span>
                    <img src="../../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
                         :class="{ 'rotate-180': openSelectLayout }" alt="">
                  </div>
                  <div v-if="openSelectLayout"
                       class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px]">
                    <span v-for="(layout, idx) in layouts" :key="idx" @click="changeSelectLayout(layout)"
                          class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none">
                      {{ layout.layout }}
                    </span>
                  </div>
                </div>
              </div>
              <div :tabindex="tabindex" @blur="openDate = false"
                   class="relative h-fit justify-self-end md:justify-self-center md:flex md:items-center md:h-full">
                <div @click="openDate = !openDate"
                     class="hover__title-block cursor-pointer flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
                  <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px] leading-none">
                    {{ selectDate }}
                  </span>
                  <img :class="{ 'rotate-180': openDate }" src="../../../assets/svg/arrow_down_black.svg"
                       alt="Стрелочка вниз">
                </div>
                <div v-if="openDate"
                     class="bg-white overflow-hidden right-0 top-[120%] md:top-[80%] sm:top-[120%] md:-right-[50px] rounded-[6px] text-base xxl:text-sm xl:text-xs lg:text-[14px] border border-solid border-[#E5DFEE] absolute flex flex-col z-10">
                  <span v-for="date in dates" @click="changeDate(date)"
                        class="hover__select cursor-pointer border__bottom--not leading-none whitespace-nowrap p-4 xxl:p-3 xl:p-2.5">
                    {{ date.date }}
                  </span>
                </div>
              </div>
            </div>

            <!--    Когда квартиры есть    -->
            <div class="sm:overflow-auto sm:custom__scroll-grey">
              <div class="flex flex-col sm:w-[360px]">
                <div class="border__top grid grid__apart-have items-center py-5 xxl:py-4 xl:py-3"
                     v-for="item in flats_array">
                  <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
                    <img v-if="item.imageUp" :src="item.imageUp" class="w-[100px] xxl:w-[80px] xl:w-[60px]" alt=""
                         v-on:click="openScheme(item)" style="cursor: pointer">
                    <img v-else src="../../../assets/no-img-houses.jpg" class="w-[100px] xxl:w-[80px] xl:w-[60px]" alt="">
                    <div class="flex flex-col gap-3 xxl:gap-2 xl:gap-1.5">
                      <div class="flex sm:flex-col items-center sm:items-start gap-2.5 xxl:gap-2 xl:gap-1.5">
                        <span class="text-[16px] xxl:text-[14px] xl:text-[12px] leading-none">{{ item.square }} м</span>
                        <span
                          class="text-white bg-[#E87746] text-[12px] xxl:text-[10px] xl:tex-[8px] whitespace-nowrap leading-none px-1.5 xl:px-1 py-1 xl:py-0.5 rounded-[3px]"
                          v-if="item.status == 0">{{ language.dob_kv_1[10] }}</span>
                        <span
                          class="text-white bg-[#E87746] text-[12px] xxl:text-[10px] xl:tex-[8px] whitespace-nowrap leading-none px-1.5 xl:px-1 py-1 xl:py-0.5 rounded-[3px]"
                          v-if="item.status == 1">{{ language.dob_kv_1[11] }}</span>
                        <span
                          class="text-white bg-[#E87746] text-[12px] xxl:text-[10px] xl:tex-[8px] whitespace-nowrap leading-none px-1.5 xl:px-1 py-1 xl:py-0.5 rounded-[3px]"
                          v-if="item.status == 2">{{ language.dob_kv_1[12] }}</span>
                        <span
                          class="text-white bg-[#E87746] text-[12px] xxl:text-[10px] xl:tex-[8px] whitespace-nowrap leading-none px-1.5 xl:px-1 py-1 xl:py-0.5 rounded-[3px]"
                          v-if="item.status == 3">{{ language.dob_kv_1[13] }}</span>
                        <span
                          class="text-white bg-[#E87746] text-[12px] xxl:text-[10px] xl:tex-[8px] whitespace-nowrap leading-none px-1.5 xl:px-1 py-1 xl:py-0.5 rounded-[3px]"
                          v-if="item.status == 4">{{ language.dob_kv_1[9] }}</span>
                      </div>
                      <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">{{ frame
                      }}</span>
                    </div>
                  </div>
                  <div>
                    <span class="text-[16px] xxl:text-[14px] xl:text-[12px] whitespace-nowrap leading-none">{{ item.number
                    }}</span>
                  </div>
                  <div>
                    <span class="text-[16px] xxl:text-[14px] xl:text-[12px] whitespace-nowrap leading-none">{{ item.count
                    }}</span>
                  </div>
                  <div>
                    <span class="text-[16px] xxl:text-[14px] xl:text-[12px] whitespace-nowrap leading-none">{{ item.floor
                    }} {{ language.dob_kv_1[7] }} </span>
                  </div>
                  <div class="text-right">
                    <span class="text-[16px] xxl:text-[14px] xl:text-[12px] whitespace-nowrap leading-none text-right">{{
                      item.price.toLocaleString('ru') }} €</span>
                  </div>
                </div>
              </div>
            </div>

            <!--    Когда квартир нет-->
            <div class="border__top py-12 xxl:py-10 xl:py-8" v-if="flats_array && flats_array.length === 0">
              <div class="flex justify-between md:flex-col items-center rounded-[10px] bg-[#F6F3FA] p-10 xxl:p-8 xl:p-6">
                <div class="flex flex-col">
                  <span class="text-[20px] xxl:text-[17px] xl:text-[14px] lg:text-[17px] font-medium">{{ language.ob[21]
                  }}</span>
                  <p class="w-[70%] md:w-full text-[#8A8996] text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[14px]">
                  </p>
                </div>
                <svg class="h-full" width="162" height="113" viewBox="0 0 162 113" fill="#6435A5"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <rect width="162" height="113" fill="url(#pattern0)" />
                  <defs>
                    <pattern fill="#6435A5" id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                      <use xlink:href="#image0_134_1230"
                           transform="translate(0 -0.0526316) scale(0.00306748 0.00438596)" />
                    </pattern>
                    <image id="image0_134_1230" width="326" height="240"
                           xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUYAAADwCAYAAAB8M80sAAAZ6ElEQVR4nO3dbWxc13kn8P9zOOaMFAFmYM/ltPVCbOA6dddbqWnWCl8WMddFkzgprKSO34FoESOx07RW4MSxU5E8HAoL2XFgGbtJ5NSFJcCx0sZNZDSregOno2zJoeQWXbnrjRLvS+WFnJAzNkADqaShOefZDxzKM3fuvL8P/79P5J1z731EXT6899xzngMQEREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREdEmJZ0OgHpbbHZ+0ol5GoCnim+lZ8b2djomokaZTgdAvS0r5usAtgPYIoL7o/tPTnQ6JqJGMTFSQwS4tmCD06s7FApR0zAxEhH5MDESEfkwMRIR+TAxEhH5MDESEfkwMRIR+TAxEhH5MDESEfkwMRIR+TAxEhH5MDESEfkwMRIR+TAxUl1GbCIybBeu828XdSPDdsHrRExEzcJ6jFS1qE1sMyZ8jwK3A/hdAKEyzc8B+IE4/fqyHX+lPRESNQcTI1VleHbxNhU9CCBWx+6H1GW+lLaTv2x2XEStwMRIFUVnkwdFcH8jx1DgzICTm5bs6NlmxUXUKkyMVJY3u/gYRB9o0uFeE6fXL9vxVJOOR9QS5fqIaJPz5pK7oYFJ8U0B/kzU/XBNL3s9BLd66ZOQes7J+wDdA2CXb7/tauQIgI+0MGyihvGOkQKN2ETkvAn/LwBX+T763qrLfHrFTq5UOkY0vrhHoN8AsKXgA8HHU1Njx5oXLVFzcbgOBfoXE7kdAUkxNT32h9UkRQBIT48eVnG3AFgr+EDxUHOiJGoNJkYKJNC7fZtWVl3m07UeJz01cRzAU77Nu2J2caTu4IhajImRitlECMBYwTaVP6/2TtHPuYHH/duyBjfUFxxR6/HlCxWJIXKVg/r6BXXCiyfr7BfMAsAF5PU1Guh764+QqLWYGKlI1uCGgLdy/jfMjRodsYnIWTt5scnHJWoY30rTO2wi5JnwfwJwbztOp8AZ4/RWThmkbsPESOvWk+JfA/hwm8/8ljH4/aV9Yy+1+bxEJTEx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" />
                  </defs>
                </svg>
              </div>
            </div>

          </div>
        </div>

        <div class="sticky top-[40px] h-fit">
          <div class="contact__selling h-fit bg-white rounded-[10px] p-4 xxl:p-3 xl:p-2.5 mb-7 xxl:mb-5 xl:mb-4" v-for="support in house.supports">
            <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 mb-5 xxl:mb-4 xl:mb-4">
              <img class="w-14 xxl:w-12 xl:w-10 h-14 xxl:h-12 xl:h-10 rounded-full object-cover"
                   v-if="support.avatar" :src="support.avatar" alt="">
              <div class="flex flex-col gap-2 xxl:gap-1.5 xl:gap-1">
                <span class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none font-medium">{{ support.name }}</span>
                <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[12px] leading-none">{{ support.status }}</span>
              </div>
            </div>
            <div
              class="flex items-center mb-5 xxl:mb-4 xl:mb-4 text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[12px] leading-none">
              <span class="text-[#8A8996] leading-none">{{ language.dob_ob_2[7] }}:&nbsp;</span>
              <span class="leading-none">{{ support.link }}</span>
            </div>
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex cursor-pointer bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
                <img src="../../../assets/svg/chat_tel_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                <span
                  class="leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[14px]">{{ support.phone }}</span>
              </div>
              <div class="flex cursor-pointer bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]"
                   v-if="validEmail(support.email)">
                <img src="../../../assets/svg/chat_mail_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                <span
                  class="leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[14px]">{{ support.email }}</span>
              </div>
              <!--Комментарий-->
              <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5  " v-if="compilation.description">
                <div
                  class="flex items-center mb-5 xxl:mb-4 xl:mb-4 text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px] leading-none">
                  <span class="text-[#8A8996] leading-none">{{ language.ob[52] }}:&nbsp;</span>
                  <!-- <span class="break leading-none">{{ compilation.user.link }}</span> -->
                </div>
                <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mb-5">
                  <div
                    class="flex  rounded-[5px] border border-solid border-[#E5DFEE]  p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
                    <span
                      class="break leading-normal	 leading-none text-center w-full   text-[14px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]"><!-- {{ language.rielt_3[3] }}:  -->{{
                        compilation.description }}</span>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <GMapMap v-if="house.visible === 1 && compilation.isVisible === 1" :center="center" :zoom="15"
                   map-type-id="roadmap" class="w-full h-[18vw] lg:h-[28vw] sm:h-[36vw] rounded-[10px] mb-10" :draggable="false"
                   @click="handleClick" ref="myMapRef" :click="true" :disableDefaultUI="false" :options="{
              zoomControl: false,
              mapTypeControl: false,
              scaleControl: false,
              streetViewControl: false,
              rotateControl: false,
              fullscreenControl: true,
            }

              ">
            <GMapMarker :key="index" v-for="(m, index) in markers" :icon="'/images/icon-marker-map.svg'"
                        :position="m.position" :clickable="true" :draggable="false">
            </GMapMarker>
          </GMapMap>
        </div>
      </div>
    </div>
    <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
  </main>
</template>

<script>
  import  AppFooter from '../../Layouts/AppFooter.vue';
  import AppModalAlbum from "../../Layouts/modal/AppModalAlbum.vue";
  import AppChessScheme from "../../Layouts/modal/AppChessScheme.vue";

  import { Swiper, SwiperSlide } from "swiper/vue";
  import "swiper/css";
  import "swiper/css/navigation";
  import "swiper/css/pagination";
  import { Navigation, Pagination } from "swiper";

  import { Link } from '@inertiajs/inertia-vue3'
  import ChangeLanguage from "../../Components/ChangeLanguage.vue";

  export default {
    props: {
      house: [],
      user: {},
      dops: [],
      infos: [],
      compilation: [],
      tabindex: {
        type: Number,
        required: false,
        default: 0,
      },
      city_array: [],
      area_array: [],
      client: false
    },
    data() {
      return {
        showFullInfo: this.compilation.user.description >= 50 ? true : false,
        selectFlat: [],
        scheme: false,
        center: null,
        album: false,
        markers: [],
        selectLayout: 'Не указано',
        openSelectLayout: false,
        layouts: [],
        selectDate: 'по дате',
        arrayInfos: [],
        openDate: false,
        dates: [],
        fullDescription: false,
        frames: [],
        flats: [],
        flats_array: [],
        priceFrom: '',
        priceTo: '',
        squareFrom: '',
        squareTo: '',
        frame: [],
        selectLanguage: 0,
        language: {},
        selectLang: 0
      }
    },
    methods: {
      getDate(date) {

        const data = new Date(date);

        const month = data.getMonth() + 1;

        return (data.getDate() < 10 ? '0' + data.getDate() : data.getDate()) + '-' + (month < 10 ? '0' + month : month) + '-' + data.getFullYear();

      },
      getCity(city) {
        let name = this.city_array.find(item => item.title === city);

        if (this.selectLanguage === 0) {
          return name.title;
        } else if (this.selectLanguage === 1) {
          return name.title_en;
        } else if (this.selectLanguage === 2) {
          return name.title_tr;
        }
      },
      getArea(area) {
        let name = this.area_array.find(item => item.title === area);

        if (this.selectLanguage === 0) {
          return name.title;
        } else if (this.selectLanguage === 1) {
          return name.title_en;
        } else if (this.selectLanguage === 2) {
          return name.title_tr;
        }
      },
      choseLanguage(n) {
        this.selectLanguage = n;

        if (this.selectLanguage === 0) {
          this.language = this.$ru;
        } else if (this.selectLanguage === 1) {
          this.language = this.$en;
        } else if (this.selectLanguage === 2) {
          this.language = this.$tur;
        }

        this.selectLayout = this.language.ob[22];
        this.selectDate = this.language.rielt_1[5];

        this.layouts = [
          { layout: this.language.ob[22], value: 0 },
          { layout: '1 + 1', value: 1 },
          { layout: '1 + 1(D)', value: 2 },
          { layout: '2 + 1', value: 3 },
          { layout: '2 + 1(D)', value: 4 },
          { layout: '3 + 1', value: 5 },
          { layout: '3 + 1(D)', value: 6 },
          { layout: '4 + 1', value: 7 },
          { layout: '4 + 1(D)', value: 8 },
          { layout: '5 + 1', value: 9 },
          { layout: '5 + 1(D)', value: 10 },
          { layout: 'Duplex', value: 11 },
          { layout: 'Studia', value: 11 },
        ];

        this.dates = [
          { date: this.language.rielt_1[5], id: 1 },
          { date: this.language.rielt_1[54], id: 2 },
          { date: this.language.rielt_1[55], id: 3 },
        ];
      },
      openScheme(item) {
        this.selectFlat = item;
        this.selectFlat.isOpen = 3
        this.scheme = true;
      },
      changeSelectLayout(layout) {
        this.selectLayout = layout.layout
        this.openSelectLayout = false
        this.filter();
      },
      changeDate(date) {
        this.selectDate = date.date
        this.openDate = false
        if (date.id === 1) {
          this.flats_array.sort((a, b) => b.date - a.date);
        } else if (date.id === 2) {
          this.flats_array.sort((a, b) => a.price - b.price);
        } else if (date.id === 3) {
          this.flats_array.sort((a, b) => b.price - a.price);
        }

      },
      targetFrame(i) {
        this.frames.forEach(item => {
          item.active = 0
          if (i.id === item.id) {
            i.active = 1
            this.flats = item
            this.flats_array = item.flats
            this.frame = item.name
          }
        })

      },
      filter() {

        let object = JSON.parse(JSON.stringify(this.flats.flats));
        let array = [];
        this.flats_array = [];

        object.forEach(item => {
          if (this.squareFrom !== '' && this.squareTo === '') {
            if (item.square > this.squareFrom) {
              array.push(item);
            }
          } else if (this.squareTo !== '' && this.squareFrom === '') {
            if (item.square <= this.squareTo) {
              array.push(item);
            }
          } else if (this.squareTo !== '' && this.squareFrom !== '') {
            if (item.square < this.squareTo && item.square > this.squareFrom) {
              array.push(item);
            }
          } else {
            array.push(item);
          }
        })

        let new_array = [];

        array.forEach(item => {
          if (this.priceFrom !== '' && this.priceTo === '') {
            if (item.price > this.priceFrom) {
              new_array.push(item);
            }
          } else if (this.priceTo !== '' && this.priceFrom === '') {
            if (item.price < this.priceTo) {
              new_array.push(item);
            }
          } else if (this.priceTo !== '' && this.priceFrom !== '') {
            if (item.price < this.priceTo && item.price > this.priceFrom) {
              new_array.push(item);
            }
          } else {
            new_array.push(item);
          }
        })

        let new_array1 = [];

        new_array.forEach(item => {
          if (this.selectLayout !== this.language.ob[22]) {
            if (item.count === this.selectLayout) {
              new_array1.push(item);
            }
          } else {
            new_array1.push(item);
          }
        })

        if (array.length === 0) {
          new_array1 = JSON.parse(JSON.stringify(this.flats.flats));
        }

        this.flats_array = new_array1;

      },
      validEmail: function (email) {
        var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      }
    },
    created() {
      console.log(this.client)
      if (this.user.length !== 0) {
        if (this.user.lang === 0) {
          this.language = this.$ru;
          this.selectLanguage = 0;
        } else if (this.user.lang === 1) {
          this.language = this.$en;
          this.selectLanguage = 1;
        } else if (this.user.lang === 2) {
          this.language = this.$tur;
          this.selectLanguage = 2;
        }
      } else {
        this.language = this.$ru;
      }

      this.selectLayout = this.language.ob[22];
      this.selectDate = this.language.rielt_1[5];

      this.layouts = [
        { layout: this.language.ob[22], value: 0 },
        { layout: '1 + 1', value: 1 },
        { layout: '1 + 1(D)', value: 2 },
        { layout: '2 + 1', value: 3 },
        { layout: '2 + 1(D)', value: 4 },
        { layout: '3 + 1', value: 5 },
        { layout: '3 + 1(D)', value: 6 },
        { layout: '4 + 1', value: 7 },
        { layout: '4 + 1(D)', value: 8 },
        { layout: '5 + 1', value: 9 },
        { layout: '5 + 1(D)', value: 10 },
        { layout: 'Duplex', value: 11 },
        { layout: 'Studia', value: 11 },
      ];

      this.dates = [
        { date: this.language.rielt_1[5], id: 1 },
        { date: this.language.rielt_1[54], id: 2 },
        { date: this.language.rielt_1[55], id: 3 },
      ];

      this.frames = this.house.frames

      this.center = { lat: +this.house.latitude, lng: +this.house.longitude }
      this.markers.push({ position: this.center })

      this.frames.forEach((item, idx) => {
        if (idx === 0) {
          this.flats = item
          this.frame = item.name
          this.flats_array = item.flats
          item.active = 1
        } else {
          item.active = 0
        }

        let allPricesForFrames = []
        let allSquareForFrames = []

        item.flats.forEach(flat => {
          flat.date = new Date(flat.created_at)
          allPricesForFrames.push(flat.price)
          allSquareForFrames.push(flat.square)
        })

        item.minPrice = Math.min(...allPricesForFrames)
        item.maxPrice = Math.max(...allPricesForFrames)
        item.minSquare = Math.min(...allSquareForFrames)
        item.maxSquare = Math.max(...allSquareForFrames)

      })

      this.house.flats.forEach(item => {
        if (item.status == 0) {
          this.house.promotion = true
          return
        }

        this.house.promotion = false
      })

      this.arrayInfos = []

      if (this.house.info.info !== null) {
        let info = this.house.info.info.replace(/[^\d]/g, ' '),
          arrayInfo = info.split(' ')
        for (let key of arrayInfo) {
          if (key !== '') {
            this.arrayInfos.push(this.infos.find(item => item.id === +key))
          }
        }
      }

      if (this.house.info.dop !== null) {
        let dop = this.house.info.dop.replace(/[^\d]/g, ' '),
          arrayDop = dop.split(' ')
        for (let key of arrayDop) {
          if (key !== '') {
            this.dops.forEach(item => {
              if (+key === item.id) {
                item.active = 1
              }
            })
          }
        }
      }
      // if (this.house.info.dop !== null) {
      //   for (let key of this.house.info.dop) {
      //     if (!+isNaN(key)) {
      //       this.dops.forEach(item => {
      //         if (+key === item.id) {
      //           item.active = 1
      //         }
      //       })
      //     }
      //   }
      // }
    },
    computed: {
      countFlats() {
        let count = 0;
        this.house.frames.forEach(item => {
          item.flats.forEach(flat => {
            count += 1
          })
        })

        return count
      },
      minPriceFlat() {
        let prices = []
        this.house.frames.forEach(item => {
          item.flats.forEach(flat => {
            prices.push(flat.price)
          })
        })

        return Math.min(...prices)
      },
      minSquareFlat() {
        let minSquare = []
        for (let key of this.house.frames) {
          for (let flat of key.flats) {
            minSquare.push(flat.square)
          }
        }

        return Math.min(...minSquare)
      },
      maxSquareFlat() {
        let maxSquare = []
        for (let key of this.house.frames) {
          for (let flat of key.flats) {
            maxSquare.push(flat.square)
          }
        }

        return Math.max(...maxSquare)
      },
      minPriceForM() {
        return Math.round(this.minPriceFlat / this.minSquareFlat)
      },
    },
    components: {
      AppFooter,
      AppModalAlbum,
      Swiper,
      SwiperSlide,
      AppChessScheme,
      Link,
      ChangeLanguage
    },
    setup() {
      return {
        modules: [Navigation, Pagination],
      };
    },
  }
</script>

<style scoped>
  .break {
    white-space: normal;
    word-break: break-all;
  }

  .hidden {
    max-height: 90px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    word-break: break-word;
    text-overflow: ellipsis;
  }

  .disableColor {
    color: #8A8996;
  }</style>

