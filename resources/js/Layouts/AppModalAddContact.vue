<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[30%] h-fit">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6 flex justify-between items-center">
        <h2 class=" text-[22px] xxl:text-lg xl:text-base font-semibold">Добавить контакт</h2>
        <button @click="this.$emit('close-add-contact')" class="relative w-4 h-4 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
    </div>
    <div @click="this.$emit('close-add-contact')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>
