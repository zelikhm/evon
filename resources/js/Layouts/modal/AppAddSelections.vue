<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col bg-white rounded-[12px] z-50 w-[43%] h-fit">
      <div class="relative border__bottom flex justify-between items-center p-8 xxl:p-6 xl:p-5">
        <h2 class="text-lg xxl:text-[15px] xl:text-[13px] font-semibold leading-none">Добавить в подборку</h2>
        <button @click="this.$emit('close-add-selection')" class="relative w-3 h-3 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div class="relative border__bottom flex items-center gap-4 xxl:gap-3 xl:gap-2.5 px-8 xxl:px-6 xl:px-5 py-5 xxl:py-4 xl:py-3">
        <img src="../../../assets/chat_avatar.png" class="w-12 xxl:w-10 xl:w-8" alt="">
        <div class="flex flex-col">
          <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
            <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none">Euro Avsallar Residence</span>
            <span class="border border-solid border-[#30CB49] text-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] px-2 xl:px-1.5 py-1.5 xl:py-1 rounded-[3px] leading-none">СДАН</span>
          </div>
          <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Бакинская ул., 14, Адлер, Краснодарский край, Россия, 354383</span>
        </div>
      </div>
      <div class="p-8 xxl:p-6 xl:p-5">
        <div class="main__title-block border border-solid border-[#E5DFEE] rounded-[5px] pl-5 xxl:pl-4 xl:pl-3 py-5 xxl:py-4 xl:py-3 pr-1 text-[16px] xxl:text-[14px] xl:text-[12px]">
          <div class="flex flex-col h-[40vh] overflow-y-auto custom__scroll--chess pr-4 xxl:pr-3 xl:pr-2 gap-2.5 xxl:gap-2 xl:gap-1.5">
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex">
                  <input id="name_1" type="checkbox" class="custom__checkbox">
                  <label for="name_1"></label>
                </div>
                <span class="leading-none">Дмитрию</span>
              </div>
              <span class="leading-none">11 ЖК</span>
            </div>
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex">
                  <input id="name_1" type="checkbox" class="custom__checkbox">
                  <label for="name_1"></label>
                </div>
                <span class="leading-none">Дмитрию</span>
              </div>
              <span class="leading-none">11 ЖК</span>
            </div>
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex">
                  <input id="name_2" type="checkbox" class="custom__checkbox">
                  <label for="name_2"></label>
                </div>
                <span class="leading-none">Дмитрию</span>
              </div>
              <span class="leading-none">11 ЖК</span>
            </div>
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex">
                  <input id="name_3" type="checkbox" class="custom__checkbox">
                  <label for="name_3"></label>
                </div>
                <span class="leading-none">Дмитрию</span>
              </div>
              <span class="leading-none">11 ЖК</span>
            </div>
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex">
                  <input id="name_4" type="checkbox" class="custom__checkbox">
                  <label for="name_4"></label>
                </div>
                <span class="leading-none">Дмитрию</span>
              </div>
              <span class="leading-none">11 ЖК</span>
            </div>
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex">
                  <input id="name_5" type="checkbox" class="custom__checkbox">
                  <label for="name_5"></label>
                </div>
                <span class="leading-none">Дмитрию</span>
              </div>
              <span class="leading-none">11 ЖК</span>
            </div>
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex">
                  <input id="name_6" type="checkbox" class="custom__checkbox">
                  <label for="name_6"></label>
                </div>
                <span class="leading-none">Дмитрию</span>
              </div>
              <span class="leading-none">11 ЖК</span>
            </div>
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex">
                  <input id="name_7" type="checkbox" class="custom__checkbox">
                  <label for="name_8"></label>
                </div>
                <span class="leading-none">Дмитрию</span>
              </div>
              <span class="leading-none">11 ЖК</span>
            </div>
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex">
                  <input id="name_8" type="checkbox" class="custom__checkbox">
                  <label for="name_8"></label>
                </div>
                <span class="leading-none">Дмитрию</span>
              </div>
              <span class="leading-none">11 ЖК</span>
            </div>
          </div>
        </div>
      </div>
      <div class="relative">
        <div v-if="buttonSelection" class="px-8 xxl:px-6 xl:px-5 pb-8 xxl:pb-6 xl:pb-5 flex gap-4 xxl:gap-3 xl:gap-2.5 w-full text-lg xxl:text-[15px] xl:text-[13px]">
          <button @click="openCreate" class="w-full bg-litepink text-[#E84680] leading-none font-medium rounded-[5px] p-5 xxl:p-4 xl:p-3">Создать подборку</button>
          <button class="w-full bg-[#E84680] text-white leading-none font-semibold rounded-[5px] p-5 xxl:p-4 xl:p-3">Готово</button>
        </div>
        <div v-if="createSelection" class="px-8 xxl:px-6 xl:px-5 pb-8 xxl:pb-6 xl:pb-5 flex gap-4 xxl:gap-3 xl:gap-2.5 w-full text-lg xxl:text-[15px] xl:text-[13px] ">
          <div class="relative w-[64%]">
            <input class="w-full h-full placeholder-[#8A8996] pr-12 xxl:pr-10 xl:pr-8 text-[16px] xxl:text-[14px] xl:text-[12px] focus:ring-[#6435A5] border border-solid border-[#E84680] rounded-[5px]" placeholder="Введите название новой подборки" type="text">
            <button @click="closeCreate" class="absolute w-3 h-3 top-1/2 right-0 -translate-x-full -translate-y-1/2">
              <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#E84680] rotate-45"></span>
              <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#E84680] -rotate-45"></span>
            </button>
          </div>
          <button class="w-[36%] bg-[#E84680] text-white leading-none font-semibold rounded-[5px] p-5 xxl:p-4 xl:p-3 whitespace-nowrap">Создать подборку</button>
        </div>
      </div>
    </div>
    <div @click="this.$emit('close-add-selection')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      buttonSelection: true,
      createSelection: false,
    }
  },
  emits: ['close-add-selection'],
  methods: {
    openCreate() {
      this.createSelection = true
      this.buttonSelection = false
    },
    closeCreate() {
      this.createSelection = false
      this.buttonSelection = true
    },
  }
}
</script>

<style scoped>

</style>

