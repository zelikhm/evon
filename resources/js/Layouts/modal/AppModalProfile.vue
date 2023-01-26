<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col gap-7 xxl:gap-6 xl:gap-5 bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[32%] lg:w-[50%] md:w-[64%] sm:w-[90%] h-fit">
      <div class="relative flex justify-between items-center">
        <h2 class=" text-[22px] xxl:text-lg xl:text-base font-semibold leading-none">Оплата подписки</h2>
        <button @click="$emit('close-pay-profile')" class="relative w-4 h-4 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div class="flex justify-between items-center border border-solid border-[#E5DFEE] rounded-[5px] p-5 xxl:p-4 xl:p-3">
        <label class="payd__checkbox">
          <input type="radio" value="1" id="pay_1" name="payd">
          <span class="text-[18px] xxl:text-[15px] xl:text-[13px]" for="pay_1">на 1 месяц</span>
        </label>
        <span class="text-[18px] xxl:text-[15px] xl:text-[13px]">100 ₤</span>
      </div>
      <div class="flex justify-between items-center border border-solid border-[#E5DFEE] rounded-[5px] p-5 xxl:p-4 xl:p-3">
        <label class="payd__checkbox">
          <input type="radio" value="6" id="pay_2" name="payd">
          <span class="text-[18px] xxl:text-[15px] xl:text-[13px]" for="pay_2">на 6 месяцев</span>
        </label>
        <span class="text-[18px] xxl:text-[15px] xl:text-[13px]">500 ₤</span>
      </div>
      <div class="flex justify-between items-center border border-solid border-[#E5DFEE] rounded-[5px] p-5 xxl:p-4 xl:p-3">
        <label class="payd__checkbox">
          <input type="radio" value="12" id="pay_3" name="payd">
          <span class="text-[18px] xxl:text-[15px] xl:text-[13px]" for="pay_3">на год</span>
        </label>
        <span class="text-[18px] xxl:text-[15px] xl:text-[13px]">1000 ₤</span>
      </div>
      <button class="login__btn--bg  rounded-[5px] w-full py-5 xxl:py-4 xl:py-3">
        <span class="text-white font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">Оплатить</span>
      </button>
    </div>
    <div @click="$emit('close-pay-profile')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>
