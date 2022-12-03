<template>
<!--  Вход в приложение -->
  <div v-if="1 != 1" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 z-50 w-[30%] h-fit">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">Вход в приложение Avon</h2>
        <button @click="closeLoginRealtor" class="w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <div class="flex flex-col p-5 xxl:pb-4 xl:pb-3 mb-8 xxl:mb-6 xl:mb-5 border border-solid border-[#E5DFEE] rounded-[6px]">
        <label for="telephone" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]">Телефон</label>
        <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0" type="tel" id="telephone" placeholder="+7 930 245 15 20">
      </div>
      <button class="text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3 bg-[#E84680] border border-solid border-[#E5DFEE] rounded-[6px]">Войти</button>
      <div class="flex items-center justify-center text-base xxl:text-sm xl:text-xs">
        <button class="text-[#E84680]">Войти как застройщик</button>
      </div>
    </div>
    <div @click="closeLoginRealtor" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>

<!-- Вход с кодом с телефона -->
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 z-50 w-[30%] h-fit">
      <h2 class="text-center text-[22px] pb-3 xxl:pb-2 xl:pb-1.5 xxl:text-lg xl:text-base font-semibold">Вход или регистрация</h2>
      <p class="text-[#8A8996] text-center text-base xxl:text-[13px] xl:text-[11px]">На номер +7 930 245 15 20 был отправлен код</p>
      <div class="modal__telephone-cod gap-5 xxl:gap-4 xl:gap-3 mb-10 xxl:mb-8 xl:mb-6">
        <input type="number" class="text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" class="text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" class="text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" class="text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
      </div>

      <button class="text-white w-full text-lg xxl:text-[15px] xl:text-xs p-5 xxl:p-4 xl:p-3 bg-[#E84680] border border-solid border-[#E5DFEE] rounded-[6px]">Войти</button>
    </div>
    <div @click="closeLoginRealtor" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  methods: {
    closeLoginRealtor() {
      this.$emit('close-realtor')
    }
  }
}
</script>

<style scoped>

</style>
