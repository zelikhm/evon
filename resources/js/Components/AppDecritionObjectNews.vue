<template>
  <div class="bg-[#F6F3FA] p-7 xxl:p-5 xl:p-5 h-fit rounded-[10px]">
    <div class="text-sm xxl:text-xs xl:text-[10px] pb-14 xxl:pb-10 xl:pb-8">
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
    <div class="pb-14 xxl:pb-10 xl:pb-8">
      <span class="font-medium text-lg xxl:text-[15px] xl:text-[13px]">Застройщик</span>
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
    <div class="pb-14 xxl:pb-10 xl:pb-8">
      <span class="font-medium text-lg xxl:text-[15px] xl:text-[13px]">Эксклюзив для агентства:</span>
      <p class="text-base text-[#8A8996]  xxl:text-sm xl:text-xs">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aliquid architecto aut eveniet excepturi explicabo ipsum maiores necessitatibus tempora voluptatum?</p>
    </div>
    <div class="pb-14 xxl:pb-10 xl:pb-8" v-if="house.percent !== null">
      <span class="font-medium text-lg xxl:text-[15px] xl:text-[13px]">Комиссия</span>
      <div class="flex items-start gap-4 xxl:gap-3 xl:gap-2.5">
        <span class="font-medium text-[32px] xxl:text-[26px] xl:text-[22px]">{{ house.percent }}%</span>
        <span class="text-base text-[#8A8996]  xxl:text-sm xl:text-xs">По предварительной записи</span>
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
