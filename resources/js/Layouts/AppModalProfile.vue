<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col gap-7 xxl:gap-6 xl:gap-5 bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[30%] h-fit">
      <div class="relative flex justify-between items-center">
        <h2 class=" text-[22px] xxl:text-lg xl:text-base font-semibold leading-none">Оплата подписки</h2>

      <button class="bg-[#E84680] rounded-[5px] w-full py-5 xxl:py-4 xl:py-3">
        <span class="text-white font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">Оплатить</span>
      </button>
    </div>
    <div @click="this.$emit('close-add-frame')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>
