<template>
  <div v-if="openSelection" class="fixed flex justify-end z-[100] top-0 ring-0 w-full h-full">
    <div :class="{'translate-x-0': openSideBar}" class="transition-all ease-linear duration-500 flex flex-col relative z-50 w-[50%] translate-x-full h-full bg-white px-28 xxl:px-24 xl:px-20 py-14 xxl:py-10 xl:py-8">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-[22px] xxl:text-lg xl:text-base font-semibold">Вход в приложение Avon</h2>
        <button @click="closeCreateSelection" class="w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 chat__container--flex">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none">Данные</h3>
        <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name">Название</label>
          <input class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name" placeholder="Введите название">
        </div>
        <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="comment">Комментарий</label>
          <input class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="comment" placeholder="Оставьте комментарий">
        </div>
        <div class="mb-8 xxl:mb-6 xl:mb-5">
          <input class="custom__checkbox" type="checkbox" id="chekbox">
          <label class="text-base xxl:text-[13px] xl:text-[11px]" for="chekbox">показывать ЖК и его месторасположение</label>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-8 xxl:gap-6 xl:gap-5">
      <button class="bg-[#E84680] text-white text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">Создать</button>
      <button class="bg-litepink text-[#E84680] text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">Отправить</button>
    </div>
    </div>
    <div @click="closeCreateSelection"  class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>

export default {
  props: {
    openSelection: Boolean,
    openSideBar: Boolean,
  },
  data() {
    return {

    }
  },
  emits: ['close-create-selection'],
  methods: {
    closeCreateSelection() {
      this.$emit('close-create-selection')
    }
  }
}
</script>

<style scoped>

</style>
