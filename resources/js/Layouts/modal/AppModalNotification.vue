<template>
  <div class="fixed bottom-[70px] xxl:text-[] left-[2vw] z-[100]">
    <div class="relative notification__shadow w-full flex flex-col gap-7 xxl:gap-6 xl:gap-5 bg-white rounded-[12px] p-4.5 xxl:p-4 xl:p-3.5 z-50 h-fit">
      <div class="relative w-full flex justify-between items-center gap-4.5 xxl:gap-4 xl:gap-3.5">
        <div class="notification__icon-bg flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px]">
          <img src="../../../assets/svg/notification__icon.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
        </div>
        <div class="flex gap-9 xxl:gap-7 xl:gap-6 items-center">
          <h2 class="text-lg xxl:text-[15px] xl:text-[13px] font-semibold leading-none whitespace-nowrap">3 дня до окончания платной подписки</h2>
          <button @click="this.$emit('close-notification')" class="relative w-4 h-4 z-50">
            <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
            <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
          </button>
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
