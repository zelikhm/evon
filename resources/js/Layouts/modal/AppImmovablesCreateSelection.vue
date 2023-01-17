<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col bg-white rounded-[12px] z-50 w-[43%] lg:w-[56%] md:w-[70%] sm:w-[94%] h-fit">
      <div class="relative border__bottom flex justify-between items-center p-8 xxl:p-6 xl:p-5">
        <h2 class="text-lg xxl:text-[15px] xl:text-[13px] font-semibold leading-none">Создание подборки</h2>
        <button @click="this.$emit('close-i-create-selection')" class="relative w-3 h-3 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div class="relative p-8 xxl:p-6 xl:p-5">
        <div class="text-lg xxl:text-[15px] xl:text-[13px] font-semibold pb-4 xxl:pb-3 xl:pb-2.5 leading-none">Данные</div>
        <div class="flex items-center gap-4 xxl:gap-3 xl:gap-2.5 mb-8 xxl:mb-6 xl:mb-5">
          <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name">Название</label>
            <input v-model="titleCompilation" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name" placeholder="Название">
          </div>
          <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="comment">Комментарий</label>
            <input class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="comment" placeholder="Комментарий">
          </div>
        </div>
        <div class="mb-8 xxl:mb-6 xl:mb-5">
          <input class="custom__checkbox" type="checkbox" id="chekbox">
          <label class="text-[#1E1D2D] font-medium text-lg xxl:text-[15px] xl:text-[13px] leading-none" for="chekbox">показывать ЖК и его месторасположение</label>
        </div>
        <div class="grid grid-cols-2 gap-8 xxl:gap-6 xl:gap-5">
          <button @click="this.$emit('open-i-create-selection')" class="login__btn--bg text-white text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">Создать</button>
          <button class="bg-litepink text-[#E84680] text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">Отправить</button>
        </div>
      </div>
    </div>
    <div @click="this.$emit('close-i-create-selection')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  props: ['house', 'title'],
  data() {
    return {
      buttonSelection: true,
      createSelection: false,
      titleCompilation: ''
    }
  },
  emits: ['close-add-selection', 'close-i-create-selection'],
  methods: {
    openCreate() {
      this.createSelection = true
      this.buttonSelection = false
    },
    closeCreate() {
      this.createSelection = false
      this.buttonSelection = true
    },
  },
  created() {
    this.titleCompilation = this.title
  }
}
</script>

<style scoped>

</style>

