<template>
  <div class="w-full px-7 xxl:px-5 xl:px-4">
    <div>
      <div class="flex justify-between items-center">
        <div class="flex flex-col">
          <h2 class="text-[22px] font-semibold xxl:text-[18px] xl:text-[15px]">Новостройки в Сочи</h2>
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">Найдено 1512 новостроек</span>
        </div>
        <div class="flex items-center gap-8 xxl:gap-6 xl:gap-5">
          <button class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <span class="text-base xxl:text-sm xl:text-xs">По дате</span>
            <img src="../../assets/svg/arrow_down_black.svg" alt="Стрелочка вниз">
          </button>
          <button class="button__map flex items-center gap-3 xxl:gap-2 xl:gap-1.5 p-3 xxl:p-2.5 xl:p-2 rounded-[6px]">
            <img src="../../assets/svg/map_pointer.svg" class="h-6 xxl:h-5 xl:h-4" alt="Метка">
            <span class="text-[#6435A5] font-medium text-base xxl:text-sm xl:text-xs">Искать на карте</span>
          </button>
          <div class="flex gap-3 xxl:gap-2 xl:gap-1.5">
            <button class="button__choices--grid h-9 xxl:h-7 xl:h-6 w-9 xxl:w-7 xl:w-6 gap-1 xxl:gap-0.5 rounded-[6px] p-[8px] xxl:p-[6px] xl:p-[5px]">
              <div class="w-full rounded-[1px] h-full"></div>
              <div class="w-full rounded-[1px] h-full"></div>
              <div class="w-full rounded-[1px] h-full"></div>
              <div class="w-full rounded-[1px] h-full"></div>
            </button>
            <button class="button__choices--col h-9 xxl:h-7 xl:h-6 w-9 xxl:w-7 xl:w-6 gap-2 xxl:gap-1.5 xl:gap-1 rounded-[6px] p-[8px] xxl:p-[6px]">
              <div class="w-full rounded-[1px] h-full"></div>
              <div class="w-full rounded-[1px] h-full"></div>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!--  Новостройки в виде таблицы -->
    <div v-if="1 != 1" class="grid grid-cols-3 gap-5 xxl:gap-4 xl:gap-3 mt-5 xxl:mt-4 xl:mt-3">
      <div class="flex flex-col">
        <div class="relative z-10 h-[16vw] rounded-[6px]">
          <img src="../../assets/immovables_img_one.png" class="absolute -z-10 w-full h-full rounded-[6px]" alt="">
          <div class="immovables__overlay h-full w-full absolute -z-10 rounded-[6px]"></div>
          <div class="flex flex-col h-full justify-between p-5 xxl-4 xl:p-3">
            <div class="">
              <span class="uppercase bg-[#30CB49] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">СДАН</span>
              <span class="uppercase bg-[#E84680] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">2/2024</span>
            </div>
            <div class="flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
              </button>
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
              </button>
            </div>
            <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Дагомыс</span>
              <div class="h-1 w-1 rounded-full bg-white"></div>
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">49 Квартир</span>
            </div>
          </div>
        </div>
        <div class="flex flex-col text-[#1E1D2D] p-5 xxl-4 xl:p-3 leading-none">
          <span class="font-semibold text-xl xxl:text-base xl:text-sm">Euro Avsallar Residence</span>
          <span class="text-lg xxl:text-[15px] xl:text-[13px]">от 1 490 000 €</span>
        </div>
      </div>
      <div class="flex flex-col">
        <div class="relative z-10 h-[16vw] rounded-[6px]">
          <img src="../../assets/immovables_img_two.png" class="absolute -z-10 w-full h-full rounded-[6px]" alt="">
          <div class="immovables__overlay h-full w-full absolute -z-10 rounded-[6px]"></div>
          <div class="flex flex-col h-full justify-between p-5 xxl-4 xl:p-3">
            <div class="">
              <span class="uppercase bg-[#30CB49] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">СДАН</span>
              <span class="uppercase bg-[#E84680] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">2/2024</span>
            </div>
            <div class="flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
              </button>
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
              </button>
            </div>
            <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Дагомыс</span>
              <div class="h-1 w-1 rounded-full bg-white"></div>
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">49 Квартир</span>
            </div>
          </div>
        </div>
        <div class="flex flex-col text-[#1E1D2D] p-5 xxl-4 xl:p-3 leading-none">
          <span class="font-semibold text-xl xxl:text-base xl:text-sm">Euro Avsallar Residence</span>
          <span class="text-lg xxl:text-[15px] xl:text-[13px]">от 1 490 000 €</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="relative z-10 h-[16vw] rounded-[6px]">
          <img src="../../assets/immovables_img_three.png" class="absolute -z-10 w-full h-full rounded-[6px]" alt="">
          <div class="immovables__overlay h-full w-full absolute -z-10 rounded-[6px]"></div>
          <div class="flex flex-col h-full justify-between p-5 xxl-4 xl:p-3">
            <div class="">
              <span class="uppercase bg-[#30CB49] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">СДАН</span>
              <span class="uppercase bg-[#E84680] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">2/2024</span>
            </div>
            <div class="flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
              </button>
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
              </button>
            </div>
            <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Дагомыс</span>
              <div class="h-1 w-1 rounded-full bg-white"></div>
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">49 Квартир</span>
            </div>
          </div>
        </div>
        <div class="flex flex-col text-[#1E1D2D] p-5 xxl-4 xl:p-3 leading-none">
          <span class="font-semibold text-xl xxl:text-base xl:text-sm">Euro Avsallar Residence</span>
          <span class="text-lg xxl:text-[15px] xl:text-[13px]">от 1 490 000 €</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="relative z-10 h-[16vw] rounded-[6px]">
          <img src="../../assets/immovables_img_three.png" class="absolute -z-10 w-full h-full rounded-[6px]" alt="">
          <div class="immovables__overlay h-full w-full absolute -z-10 rounded-[6px]"></div>
          <div class="flex flex-col h-full justify-between p-5 xxl-4 xl:p-3">
            <div class="">
              <span class="uppercase bg-[#30CB49] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">СДАН</span>
              <span class="uppercase bg-[#E84680] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">2/2024</span>
            </div>
            <div class="flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
              </button>
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
              </button>
            </div>
            <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Дагомыс</span>
              <div class="h-1 w-1 rounded-full bg-white"></div>
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">49 Квартир</span>
            </div>
          </div>
        </div>
        <div class="flex flex-col text-[#1E1D2D] p-5 xxl-4 xl:p-3 leading-none">
          <span class="font-semibold text-xl xxl:text-base xl:text-sm">Euro Avsallar Residence</span>
          <span class="text-lg xxl:text-[15px] xl:text-[13px]">от 1 490 000 €</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="relative z-10 h-[16vw] rounded-[6px]">
          <img src="../../assets/immovables_img_one.png" class="absolute -z-10 w-full h-full rounded-[6px]" alt="">
          <div class="immovables__overlay h-full w-full absolute -z-10 rounded-[6px]"></div>
          <div class="flex flex-col h-full justify-between p-5 xxl-4 xl:p-3">
            <div class="">
              <span class="uppercase bg-[#30CB49] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">СДАН</span>
              <span class="uppercase bg-[#E84680] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">2/2024</span>
            </div>
            <div class="flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
              </button>
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
              </button>
            </div>
            <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Дагомыс</span>
              <div class="h-1 w-1 rounded-full bg-white"></div>
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">49 Квартир</span>
            </div>
          </div>
        </div>
        <div class="flex flex-col text-[#1E1D2D] p-5 xxl-4 xl:p-3 leading-none">
          <span class="font-semibold text-xl xxl:text-base xl:text-sm">Euro Avsallar Residence</span>
          <span class="text-lg xxl:text-[15px] xl:text-[13px]">от 1 490 000 €</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="relative z-10 h-[16vw] rounded-[6px]">
          <img src="../../assets/immovables_img_two.png" class="absolute -z-10 w-full h-full rounded-[6px]" alt="">
          <div class="immovables__overlay h-full w-full absolute -z-10 rounded-[6px]"></div>
          <div class="flex flex-col h-full justify-between p-5 xxl-4 xl:p-3">
            <div class="">
              <span class="uppercase bg-[#30CB49] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">СДАН</span>
              <span class="uppercase bg-[#E84680] text-white text-sm xxl:text-xs xl:text-[10px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">2/2024</span>
            </div>
            <div class="flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
              </button>
              <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[60%]">
                <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
              </button>
            </div>
            <div class="flex items-center gap-2 xxl:gap-1.5 xl:gap-1">
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">Дагомыс</span>
              <div class="h-1 w-1 rounded-full bg-white"></div>
              <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">49 Квартир</span>
            </div>
          </div>
        </div>
        <div class="flex flex-col text-[#1E1D2D] p-5 xxl-4 xl:p-3 leading-none">
          <span class="font-semibold text-xl xxl:text-base xl:text-sm">Euro Avsallar Residence</span>
          <span class="text-lg xxl:text-[15px] xl:text-[13px]">от 1 490 000 €</span>
        </div>
      </div>

    </div>

    <!--  Новостройки в виде списка -->
    <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 mt-5 xxl:mt-4 xl:mt-3">

      <div class="grid__75-25 border border-solid border-[#E5DFEE] rounded-[6px]">
        <div class="border__right">
          <div class="grid__35-65 p-2.5 xxl:p-2 xl:p-1.5">
            <div class="relative">
              <div class="immovables__overlay h-full w-full absolute z-10 rounded-[6px]"></div>
              <img src="../../assets/immovables_img_two.png" class="w-full h-[9.3vw]" alt="">
              <div class="absolute top-1/2 -translate-y-1/2 left-0 z-10 flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
                <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                  <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
                </button>
                <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                  <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
                </button>
              </div>
            </div>
            <div class="flex flex-col justify-between px-5 xxl:px-4 xl:px-3 py-2 xxl:py-1.5 xl:py-1">
              <div class="flex justify-between">
                <div class="flex flex-col gap-3 xxl:gap-2 xl:gap-1.5">
                  <span class="leading-none font-semibold text-lg xxl:text-[15px] xl:text-[13px]">Euro Avsallar Residence</span>
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">Дагомыс</span>
                </div>
                <div class="flex flex-wrap gap-x-1">
                  <span class="bg-[#E84680] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">новинки</span>
                  <span class="bg-[#FA8D50] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">акция</span>
                </div>
              </div>
              <div class="flex flex-wrap gap-1">
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Договор займа</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Рассрочка</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">ВНЖ</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Гражданство</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Договор купли-продажи</span>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col justify-between px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2">
          <div class="flex justify-between items-center">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">49 Квартир</span>
            <span class="uppercase border border-solid border-[#30CB49] h-fit text-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">сдан</span>
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1 xl:gap-0">
            <span class="font-medium text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px]">от 1 490 000 €</span>
            <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px]">85 000 € за м²</span>
            <div class="gray-backg flex items-center justify-center w-fit px-3 xxl:px-2.5 xl:px-2 gap-2 xxl:gap-1.5 xl:gap-1">
              <img src="../../assets/svg/ruller_icon.svg" class="h-4 xxl:h-3 xl:h-2.5" alt="Линейка">
              <span class="text-[14px] xxl:text-[12px] xl:text-[10px]">14.9 м² - 23.4 м²</span>
            </div>
          </div>
        </div>
      </div>

      <div class="grid__75-25 border border-solid border-[#E5DFEE] rounded-[6px]">
        <div class="border__right">
          <div class="grid__35-65 p-2.5 xxl:p-2 xl:p-1.5">
            <div class="relative">
              <div class="immovables__overlay h-full w-full absolute z-10 rounded-[6px]"></div>
              <img src="../../assets/immovables_img_two.png" class="w-full h-[9.3vw]" alt="">
              <div class="absolute top-1/2 -translate-y-1/2 left-0 z-10 flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
                <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                  <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
                </button>
                <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                  <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
                </button>
              </div>
            </div>
            <div class="flex flex-col justify-between px-5 xxl:px-4 xl:px-3 py-2 xxl:py-1.5 xl:py-1">
              <div class="flex justify-between">
                <div class="flex flex-col gap-3 xxl:gap-2 xl:gap-1.5">
                  <span class="leading-none font-semibold text-lg xxl:text-[15px] xl:text-[13px]">Euro Avsallar Residence</span>
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">Дагомыс</span>
                </div>
                <div class="flex flex-wrap gap-x-1">
                  <span class="bg-[#E84680] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">новинки</span>
                  <span class="bg-[#FA8D50] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">акция</span>
                </div>
              </div>
              <div class="flex flex-wrap gap-1">
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Договор займа</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Рассрочка</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">ВНЖ</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Гражданство</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Договор купли-продажи</span>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col justify-between px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2">
          <div class="flex justify-between items-center">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">49 Квартир</span>
            <span class="uppercase border border-solid border-[#30CB49] h-fit text-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">сдан</span>
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1 xl:gap-0">
            <span class="font-medium text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px]">от 1 490 000 €</span>
            <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px]">85 000 € за м²</span>
            <div class="gray-backg flex items-center justify-center w-fit px-3 xxl:px-2.5 xl:px-2 gap-2 xxl:gap-1.5 xl:gap-1">
              <img src="../../assets/svg/ruller_icon.svg" class="h-4 xxl:h-3 xl:h-2.5" alt="Линейка">
              <span class="text-[14px] xxl:text-[12px] xl:text-[10px]">14.9 м² - 23.4 м²</span>
            </div>
          </div>
        </div>
      </div>

      <div class="grid__75-25 border border-solid border-[#E5DFEE] rounded-[6px]">
        <div class="border__right">
          <div class="grid__35-65 p-2.5 xxl:p-2 xl:p-1.5">
            <div class="relative">
              <div class="immovables__overlay h-full w-full absolute z-10 rounded-[6px]"></div>
              <img src="../../assets/immovables_img_two.png" class="w-full h-[9.3vw]" alt="">
              <div class="absolute top-1/2 -translate-y-1/2 left-0 z-10 flex flex-col items-center gap-3 xxl:gap-2 xl:gap-1.5 w-full">
                <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В подборку</span>
                  <img src="../../assets/svg/plus_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Плюс">
                </button>
                <button class="immovables__button--card flex items-center justify-between p-3 xxl:p-2 xl:p-1.5 rounded-[4px] w-[70%]">
                  <span class="text-white text-sm xxl:text-xs xl:text-[10px] leading-none">В избранное</span>
                  <img src="../../assets/svg/heart_icon.svg" class="w-5 xxl:w-4 xl:w-3" alt="Сердце">
                </button>
              </div>
            </div>
            <div class="flex flex-col justify-between px-5 xxl:px-4 xl:px-3 py-2 xxl:py-1.5 xl:py-1">
              <div class="flex justify-between">
                <div class="flex flex-col gap-3 xxl:gap-2 xl:gap-1.5">
                  <span class="leading-none font-semibold text-lg xxl:text-[15px] xl:text-[13px]">Euro Avsallar Residence</span>
                  <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">Дагомыс</span>
                </div>
                <div class="flex flex-wrap gap-x-1">
                  <span class="bg-[#E84680] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">новинки</span>
                  <span class="bg-[#FA8D50] h-fit text-white text-[13px] xxl:text-[11px] xl:text-[9px] leading-none font-semibold rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">акция</span>
                </div>
              </div>
              <div class="flex flex-wrap gap-1">
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Договор займа</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Рассрочка</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">ВНЖ</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Гражданство</span>
                <span class="text-[#8A8996] border border-solid border-[#E5DFEE] rounded-[3px] px-2 xxl:px-1.5 xl:px-1 py-1.5 xxl:py-1 xl:py-0.5 text-base xxl:text-sm xl:text-xs">Договор купли-продажи</span>
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col justify-between px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2">
          <div class="flex justify-between items-center">
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">49 Квартир</span>
            <span class="uppercase border border-solid border-[#30CB49] h-fit text-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none font-medium rounded-[3px] px-3 xxl:px-2 xl:px-1.5 py-2 xxl:py-1.5 xl:py-1">сдан</span>
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1 xl:gap-0">
            <span class="font-medium text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px]">от 1 490 000 €</span>
            <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px]">85 000 € за м²</span>
            <div class="gray-backg flex items-center justify-center w-fit px-3 xxl:px-2.5 xl:px-2 gap-2 xxl:gap-1.5 xl:gap-1">
              <img src="../../assets/svg/ruller_icon.svg" class="h-4 xxl:h-3 xl:h-2.5" alt="Линейка">
              <span class="text-[14px] xxl:text-[12px] xl:text-[10px]">14.9 м² - 23.4 м²</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>
