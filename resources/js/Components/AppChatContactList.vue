<template>
  <div class="chat__userlist lg:absolute lg:-left-full transition-all duration-500 lg:z-40 h-[85vh] lg:w-[50vw] md:w-[87.5vw] overflow-y-auto border border-solid border-[#E5DFEE] bg-white">
    <div class="p-4 xxl:p-3 xl:p-2.5">
      <div class="relative">
        <input class="bg-[#F7F7F9] focus:ring-[#6435A5] w-full pl-8 xxl:pl-7 xl:pl-6 py-2.5 xl:py-2 text-sm xxl:text-xs xl:text-[10px] rounded-[6px]" placeholder="Поиск..." type="text">
        <img src="../../assets/svg/search_icon_grey.svg" class="absolute top-1/2 left-0 translate-x-1/2 -translate-y-1/2 w-4.5 xxl:w-4 xl:w-3.5" alt="">
      </div>
    </div>
    <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
    <div class="flex items-center cursor-pointer gap-4 xxl:gap-3 xl:gap-2.5 pt-4 xxl:pt-3 xl:pt-2.5 px-4 xxl:px-3 xl:px-2.5">
      <img class="w-12 xxl:w-10 xl:w-8 rounded-full self-start" src="../../assets/chat_avatar.png" alt="">
      <div class="flex flex-col gap-1 xl:gap-0.5 w-full pb-4 xxl:pb-3 xl:pb-2.5 border__bottom--opacity">
        <div class="flex justify-between items-center">
          <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
            <span class="text-base xxl:text-sm xl:text-xs leading-none whitespace-nowrap">Олег Рыбкин</span>
            <span class="bg-[#E84680] text-white text-[10px] xxl:text-[9px] xl:text-[8px] font-medium leading-none rounded-[3px] px-1.5 py-1 xl:px-1 py-0.5">модератор</span>
          </div>
          <div class="flex gap-1">
            <img src="../../assets/svg/chat_check_message.svg" class="w-5 xxl:w-4 xl:w-3.5" alt="">
            <span class="text-sm xxl:text-xs xl:text-[10px] whitespace-nowrap">25 ноября, 20:05</span>
          </div>
        </div>
        <div class="flex justify-between items-center text-sm xxl:text-xs xl:text-[10px]">
          <span class="text-[#8A8996] leading-none">Привет!</span>
          <span class="bg-[#6435A5] text-white rounded-[100px] leading-none px-1.5 xl:px-1 py-0.5">12</span>
        </div>
      </div>
    </div>
    <div class="flex items-center cursor-pointer gap-4 xxl:gap-3 xl:gap-2.5 pt-4 xxl:pt-3 xl:pt-2.5 px-4 xxl:px-3 xl:px-2.5"      >
      <img class="w-12 xxl:w-10 xl:w-8 rounded-full self-start" src="../../assets/chat_avatar.png" alt="">
      <div class="flex flex-col gap-1 xl:gap-0.5 w-full pb-4 xxl:pb-3 xl:pb-2.5 border__bottom--opacity">
        <div class="flex justify-between items-center">
          <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
            <span class="text-base xxl:text-sm xl:text-xs leading-none whitespace-nowrap">Олег Рыбкин</span>
            <span class="bg-[#6435A5] text-white text-[10px] xxl:text-[9px] xl:text-[8px] font-medium leading-none rounded-[3px] px-1.5 py-1 xl:px-1 py-0.5">застройщик</span>
          </div>
          <div class="flex gap-1">
            <img src="../../assets/svg/chat_check_message.svg" class="w-5 xxl:w-4 xl:w-3.5" alt="">
            <span class="text-sm xxl:text-xs xl:text-[10px] whitespace-nowrap">25 ноября, 20:05</span>
          </div>
        </div>
        <div class="flex justify-between items-center text-sm xxl:text-xs xl:text-[10px]">
          <span class="text-[#8A8996] leading-none">Привет!</span>
          <span class="bg-[#6435A5] text-white rounded-[100px] leading-none px-1.5 xl:px-1 py-0.5">12</span>
        </div>
      </div>
    </div>
    <div class="flex items-center cursor-pointer gap-4 xxl:gap-3 xl:gap-2.5 pt-4 xxl:pt-3 xl:pt-2.5 px-4 xxl:px-3 xl:px-2.5">
      <img class="w-12 xxl:w-10 xl:w-8 rounded-full self-start" src="../../assets/chat_avatar.png" alt="">
      <div class="flex flex-col gap-1 xl:gap-0.5 w-full pb-4 xxl:pb-3 xl:pb-2.5 border__bottom--opacity">
        <div class="flex justify-between items-center">
          <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
            <span class="text-base xxl:text-sm xl:text-xs leading-none whitespace-nowrap">Олег Рыбкин</span>
            <span class="bg-[#E87746] text-white text-[10px] xxl:text-[9px] xl:text-[8px] font-medium leading-none rounded-[3px] px-1.5 py-1 xl:px-1 py-0.5">риэлтор</span>
          </div>
          <div class="flex gap-1">
            <img src="../../assets/svg/chat_check_grey.svg" class="w-5 xxl:w-4 xl:w-3.5" alt="">
            <span class="text-sm xxl:text-xs xl:text-[10px] whitespace-nowrap">25 ноября, 20:05</span>
          </div>
        </div>
        <div class="flex justify-between items-center text-sm xxl:text-xs xl:text-[10px]">
          <span class="text-[#8A8996] leading-none">Привет!</span>
          <span class="bg-[#6435A5] text-white rounded-[100px] leading-none px-1.5 xl:px-1 py-0.5">12</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      chatProfile: false,
    }
  }
}
</script>

<style scoped>

</style>
