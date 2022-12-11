<template>
  <app-header />
  <main>
    <div class="_container">
      <div :class="{'grid__apartments': apartments}" class="grid__add-object my-14 xxl:my-10 xl:my-8 gap-7 xxl:gap-5 xl:gap-4">
        <div class="relative">
          <div class="fixed z-50 w-[20vw] h-fit bg-[#F6F3FA] p-7 xxl:p-5 xl:p-4 rounded-[6px]">
            <div class="flex flex-col gap-3 xxl:gap-2.5 xl:gap-2">
              <div @click="openInfoJK" :class="{ 'menu-add-obj': infoJK }" class="hover__menu-add-obj cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] p-5 xxl:p-4 xl:p-3">Информация о ЖК</div>
              <div @click="openApartments" :class="{ 'menu-add-obj': apartments }" class="hover__menu-add-obj cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] p-5 xxl:p-4 xl:p-3">Корпуса и квартиры</div>
              <div @click="openPhoto" :class="{ 'menu-add-obj': photo }" class="hover__menu-add-obj cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] p-5 xxl:p-4 xl:p-3">Фото</div>
            </div>
          </div>
        </div>

<!--  Информация о ЖК  -->
        <div v-if="infoJK">
          <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px]">Добавить объект</h2>
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Найдено 1512 новостроек</span>
          <div class="flex-col flex gap-5 xxl:gap-4 xl:gap-3 pt-5 xxl:pt-4 xl:pt-3" >

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
              <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="coord_object" placeholder="49.5122 39.2143">
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
                    <div @click="openInstallment = !openInstallment" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3">
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
                  <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none">Контакты отдела продаж</h3>
                  <button class="flex items-center border border-solid border-[#6435A5] rounded-[5px] py-3 xxl:py-2.5 xl:py-2 px-4 xxl:px-3 xl:px-2.5">
                    <img src="../../assets/svg/plus_icon_purple.svg" alt="Плюсик">
                    <span class="text-[#6435A5] font-medium text-base xxl:text-sm xl:text-xs leading-none">Добавить</span>
                  </button>
                </div>
                <div class="contact__selling my-5 xxl:my-4 xl:my-3 text-lg xxl:text-[15px] xl:text-[13px] flex justify-between items-center rounded-[6px] p-1.5 xl:p-1">
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
                <div class="contact__selling my-5 xxl:my-4 xl:my-3 text-lg xxl:text-[15px] xl:text-[13px] flex justify-between items-center rounded-[6px] p-1.5 xl:p-1">
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
                  <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_sea">от моря</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_sea" placeholder="500 м">
                  </div>
                  <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_school">от школы</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_school" placeholder="500 м">
                  </div>
                  <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_shoping">от торгового центра</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_shoping" placeholder="500 м">
                  </div>
                  <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_park">от парка</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_park" placeholder="500 м">
                  </div>
                  <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_child">от детского садика</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_child" placeholder="500 м">
                  </div>
                  <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="for_stop">от остановки</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="for_stop" placeholder="500 м">
                  </div>
                </div>
              </div>
              <div class="my-10 xxl:my-8 xl:my-6">
                <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">Вознаграждение</h3>
                <div class="grid grid-cols-2 gap-7 xxl:gap-5 xl:gap-4">
                  <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="commission">Комиссия</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="commission" placeholder="5 %">
                  </div>
                  <div class="flex flex-col border border-solid border-[#E5DFEE] rounded-[6px] p-5 xxl:p-4 xl:p-3">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="commission">Комментарий</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="commission" placeholder="///">
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
                <div>
                  Выбрано файлов: {{ inputFile }}
                </div>
              </div>
              <div class="my-10 xxl:my-8 xl:my-6 w-full">
                <button class="w-full font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] text-white bg-[#E84680] rounded-[6px]">Добавить</button>
              </div>
            </div>
          </div>
        </div>

<!--  Корпуса и квартиры  -->
        <div v-if="apartments">
          <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] mb-5 xxl:mb-4 xl:mb-3">Добавить корпус и квартиры</h2>
          <div class="flex flex-col">
            <div class="grid grid-cols-6 gap-3 xxl:gap-2.5 xl:gap-2">
              <div class="corpus__banner cursor-pointer rounded-[5px] border border-solid border-[#6435A5] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
                <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px]">Корпус 1</span>
                <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">11 квартир</span>
              </div>
              <div class="corpus__banner cursor-pointer rounded-[5px] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
                <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px]">Корпус 1</span>
                <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">11 квартир</span>
              </div>
              <div class="corpus__banner cursor-pointer rounded-[5px] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
                <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px]">Корпус 1</span>
                <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">11 квартир</span>
              </div>
              <div class="flex items-center justify-center">
                <img src="../../assets/svg/plus_icon_purple.svg" class="cursor-pointer w-8 xxl:w-6 xl:w-5" alt="">
              </div>
            </div>
            <div class="grid gap-4 xxl:gap-3.5 xl:gap-3 my-16 xxl:my-12 xl:my-10 text-[#1E1D2D] text-base xxl:text-sm xl:text-xs">
              <div class="text-[#8A8996] grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
                <div class="leading-none bg-white">№</div>
                <div class="leading-none">Площадь</div>
                <div class="leading-none">Цена</div>
                <div class="leading-none">Планировка</div>
                <div class="leading-none">Этаж</div>
                <div class="leading-none">Статус</div>
              </div>
              <div class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
                <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
                  <div class="leading-none bg-white">1002</div>
                  <div class="leading-none">33.08</div>
                  <div class="leading-none">64 175 200</div>
                  <div class="leading-none">1+1</div>
                  <div class="leading-none">1</div>
                  <div class="leading-none">Бронь</div>
                </div>
                <div class="flex items-center">
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <div class="w-[1px] h-[56px] xxl:h-[48px] xl:h-[40px] bg-[#E5DFEE]"></div>
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
              </div>
              <div class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
                <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
                  <div class="leading-none bg-white">1002</div>
                  <div class="leading-none">33.08</div>
                  <div class="leading-none">64 175 200</div>
                  <div class="leading-none">1+1</div>
                  <div class="leading-none">1</div>
                  <div class="leading-none">Бронь</div>
                </div>
                <div class="flex items-center">
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <div class="w-[1px] h-[56px] xxl:h-[48px] xl:h-[40px] bg-[#E5DFEE]"></div>
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
              </div>
              <div class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
                <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
                  <div class="leading-none bg-white">1002</div>
                  <div class="leading-none">33.08</div>
                  <div class="leading-none">64 175 200</div>
                  <div class="leading-none">1+1</div>
                  <div class="leading-none">1</div>
                  <div class="leading-none">Бронь</div>
                </div>
                <div class="flex items-center">
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <div class="w-[1px] h-[56px] xxl:h-[48px] xl:h-[40px] bg-[#E5DFEE]"></div>
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
              </div>
              <div class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
                <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
                  <div class="leading-none bg-white">1002</div>
                  <div class="leading-none">33.08</div>
                  <div class="leading-none">64 175 200</div>
                  <div class="leading-none">1+1</div>
                  <div class="leading-none">1</div>
                  <div class="leading-none">Бронь</div>
                </div>
                <div class="flex items-center">
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <div class="w-[1px] h-[56px] xxl:h-[48px] xl:h-[40px] bg-[#E5DFEE]"></div>
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
              </div>
              <div class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
                <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
                  <div class="leading-none bg-white">1002</div>
                  <div class="leading-none">33.08</div>
                  <div class="leading-none">64 175 200</div>
                  <div class="leading-none">1+1</div>
                  <div class="leading-none">1</div>
                  <div class="leading-none">Бронь</div>
                </div>
                <div class="flex items-center">
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <div class="w-[1px] h-[56px] xxl:h-[48px] xl:h-[40px] bg-[#E5DFEE]"></div>
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
              </div>
              <div class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
                <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
                  <div class="leading-none bg-white">1002</div>
                  <div class="leading-none">33.08</div>
                  <div class="leading-none">64 175 200</div>
                  <div class="leading-none">1+1</div>
                  <div class="leading-none">1</div>
                  <div class="leading-none">Бронь</div>
                </div>
                <div class="flex items-center">
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <div class="w-[1px] h-[56px] xxl:h-[48px] xl:h-[40px] bg-[#E5DFEE]"></div>
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
              </div>
              <div class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
                <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
                  <div class="leading-none bg-white">1002</div>
                  <div class="leading-none">33.08</div>
                  <div class="leading-none">64 175 200</div>
                  <div class="leading-none">1+1</div>
                  <div class="leading-none">1</div>
                  <div class="leading-none">Бронь</div>
                </div>
                <div class="flex items-center">
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <div class="w-[1px] h-[56px] xxl:h-[48px] xl:h-[40px] bg-[#E5DFEE]"></div>
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
              </div>
              <div class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
                <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
                  <div class="leading-none bg-white">1002</div>
                  <div class="leading-none">33.08</div>
                  <div class="leading-none">64 175 200</div>
                  <div class="leading-none">1+1</div>
                  <div class="leading-none">1</div>
                  <div class="leading-none">Бронь</div>
                </div>
                <div class="flex items-center">
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                  <div class="w-[1px] h-[56px] xxl:h-[48px] xl:h-[40px] bg-[#E5DFEE]"></div>
                  <button class="px-5 xxl:px-4 xl:px-3">
                    <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full flex justify-center mt-5 xxl:mt-4 xl:mt-3 gap-3 xxl:gap-2.5 xl:gap-2 items-center text-[#8A8996] text-lg xxl:text-[15px] xl:text-[13px]">
            <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">
              <img src="../../assets/svg/arrow_right_grey.svg" class="rotate-180 w-5 xxl:w-4 xl:w-3" alt="">
            </div>
            <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">1</div>
            <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">2</div>
            <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">3</div>
            <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">...</div>
            <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">24</div>
            <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">
              <img src="../../assets/svg/arrow_right_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
            </div>
          </div>
        </div>

<!--  Фото  -->
        <div v-if="photo">
          <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] mb-5 xxl:mb-4 xl:mb-3">Добавить фото</h2>
          <div class="grid grid-cols-4 gap-3 xxl:gap-2.5 xl:gap-2">
            <div class="corpus__banner cursor-pointer rounded-[5px] border border-solid border-[#6435A5] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
              <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-[110%]">3D Рендеры</span>
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">0 фото</span>
            </div>
            <div class="corpus__banner cursor-pointer rounded-[5px] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
              <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-[110%]">Инфраструктура</span>
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">11 фото</span>
            </div>
            <div class="corpus__banner cursor-pointer rounded-[5px] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
              <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-[110%]">Дизайн</span>
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">11 фото</span>
            </div>
            <div class="corpus__banner cursor-pointer rounded-[5px] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
              <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-[110%]">Ход строительства</span>
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">11 фото</span>
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
      infoJK: true,
      apartments: false,
      photo: false,
      inputFile: 0,
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
    },
    changeInputFile(e) {
      this.inputFile = e.target.files.length
      console.log(e.target.files)
    },
    openInfoJK() {
      this.infoJK = true
      this.apartments = false
      this.photo = false
    },
    openApartments() {
      this.apartments = true
      this.infoJK = false
      this.photo = false
    },
    openPhoto() {
      this.photo = true
      this.infoJK = false
      this.apartments = false
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
