<template>
  <div class="bg-[#F6F3FA] p-7 xxl:p-5 xl:p-5 h-fit mb-10 xxl:mb-8 xl:mb-6 rounded-[10px]">
    <div class="text-sm xxl:text-xs xl:text-[10px] pb-10 xxl:pb-8 xl:pb-6">
      <span class="font-medium text-lg xxl:text-[15px] xl:text-[13px] pt-6 xxl:pt-5 xl:pt-4">Новости</span>
      <div>
        <span class="text-[#8A8996]">15 июля</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt </p>
        <button class="text-[#6435A5]">Читать далее</button>
      </div>
      <div class="bg-[#E5DFEE] h-[1px] w-full my-5 xxl:my-4 xl:my-3"></div>
      <div>
        <span class="text-[#8A8996]">15 июля</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt </p>
        <button class="text-[#6435A5]">Читать далее</button>
      </div>
      <div class="bg-[#E5DFEE] h-[1px] w-full my-5 xxl:my-4 xl:my-3"></div>
      <div>
        <span class="text-[#8A8996]">15 июля</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt </p>
        <button class="text-[#6435A5]">Читать далее</button>
      </div>
      <div class="bg-[#E5DFEE] h-[1px] w-full my-5 xxl:my-4 xl:my-3"></div>
      <div class="flex justify-center w-full">
        <button class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
          <span class="text-[#6435A5] text-sm xxl:text-xs xl:text-[10px]">Смотреть все новости (23)</span>
          <img src="../../assets/svg/arrow_right_purple.svg" class="h-4 xxl:h-3 xl:h-2.5" alt="Стелочка">
        </button>
      </div>
    </div>
    <div class="pb-10 xxl:pb-8 xl:pb-6">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] pb-5 xxl:pb-4 xl:pb-3 leading-none">Застройщик</div>
      <div class="bg-white flex flex-col gap-5 xxl:gap-4 xl:gap-3 rounded-[10px] p-4 xxl:p-3 xl:p-2.5">
        <div class="flex items-center gap-4 xxl:gap-3 xl:gap-2.5">
          <img src="../../assets/developer_avatar.png" class="h-14 xxl:h-12 xl:h-10" alt="Аватарка">
          <div class="flex flex-col gap-1.5 xxl:gap-1 xl:gap-0.5">
            <span class="font-medium text-lg xxl:text-[15px] xl:text-[13px] leading-none">Euro Avsallar Residence</span>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none">Застройщик</span>
          </div>
        </div>
        <button class="w-full bg-[#F6F3FA] text-[#6536A5] text-base xxl:text-sm xl:text-xs rounded-[6px] py-4 xxl:py-3 xl:py-2.5">Написать в чат</button>
      </div>
    </div>
    <div class="pb-10 xxl:pb-8 xl:pb-6">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] pb-5 xxl:pb-4 xl:pb-3 leading-none">Эксклюзив для агентства:</div>
      <p class="text-base text-[#8A8996]  xxl:text-sm xl:text-xs">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aliquid architecto aut eveniet excepturi explicabo ipsum maiores necessitatibus tempora voluptatum?</p>
    </div>
    <div class="pb-14 xxl:pb-10 xl:pb-8">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] pb-5 xxl:pb-4 xl:pb-3 leading-none">Комиссия</div>
      <div class="flex items-start gap-4 xxl:gap-3 xl:gap-2.5">
        <span class="font-medium text-[32px] xxl:text-[26px] xl:text-[22px]">{{ house.percent }}%</span>
        <span class="text-base text-[#8A8996]  xxl:text-sm xl:text-xs">{{ house.comment }}</span>
      </div>
    </div>
    <div class="pb-14 xxl:pb-10 xl:pb-8">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] pb-5 xxl:pb-4 xl:pb-3 leading-none">Контакты</div>
      <div class="bg-white p-4 xxl:p-3 xl:p-2.5 rounded-[10px] mb-3" v-for="item in house.supports">
        <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 pb-5 xxl:pb-4 xl:pb-3">
          <img class="w-14 xxl:w-12 xl:w-10 rounded-full" src="../../assets/chat_avatar.png" alt="">
          <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5">
            <span class="text-[18px] xxl:text-[15px] xl:text-[13px] leading-none">Елена</span>
            <span class="text-[14px] xxl:text-[12px] xl:text-[10px] text-[#8A8996] leading-none">Отдел продаж</span>
          </div>
        </div>
        <div class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none pb-4 xxl:pb-3 xl:pb-2.5"><span class="text-[#8A8996]">Язык:</span> Русский, Турецкий, Английский</div>
        <div class="flex cursor-pointer mb-4 xxl:mb-3 xl:mb-2.5 bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
          <img src="../../assets/svg/chat_tel_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
          <span class="leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px]">+7 930 245 15 20</span>
        </div>
        <div class="flex cursor-pointer mb-4 xxl:mb-3 xl:mb-2.5 bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
          <img src="../../assets/svg/chat_mail_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
          <span class="leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px]">elena@mail.ru</span>
        </div>
      </div>
    </div>
    <div class="">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] pb-5 xxl:pb-4 xl:pb-3 leading-none">Документы</div>
      <div class="flex flex-col gap-6 xxl:gap-5 xl:gap-4">
        <div class="flex items-center gap-3 xxl:gap-2.5 xl:gap-2">
          <img src="../../assets/svg/file-icon_docx.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
          <span class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Выписка ЕГРН СК №1 от февраля 2020 г.</span>
        </div>
        <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
        <div class="flex items-center gap-3 xxl:gap-2.5 xl:gap-2">
          <img src="../../assets/svg/file-icon_docx.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
          <span class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Выписка ЕГРН СК №1 от февраля 2020 г.</span>
        </div>
        <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
        <div class="flex items-center gap-3 xxl:gap-2.5 xl:gap-2">
          <img src="../../assets/svg/file-icon_docx.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
          <span class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Выписка ЕГРН СК №1 от февраля 2020 г.</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    house: []
  },
  data() {
    return {

    }
  }
}
</script>

<style scoped>

</style>
