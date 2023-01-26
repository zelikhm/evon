<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
      <div class="flex justify-between items-center mb-5 xxl:mb-4 xl:mb-3">
        <h2 class="text-[22px] xxl:text-[18px] xl:text-[16px] font-semibold leading-none">Отправить подборку</h2>
        <button @click="$emit('closeSubmitSelection')" class="right-0 z-50">
          <img src="../../../assets/svg/close_grey.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
        </button>
      </div>
      <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Отправляйте ссылку на вашу подборку клиентам</span>
      <div class="relative mt-10 xxl:mt-8 xl:mt-6">
        <input :value="valueLink" ref="text" disabled class="w-full text-[#1E1D2D] text-[16px] focus:ring-[#6435A5] focus:border-[#6435A5] xxl:text-[14px] xl:text-[12px] pl-5 xxl:pl-4 xl:pl-3 py-3 xxl:py-2.5 xl:py-2 leading-none rounded-[5px] border border-solid border-[#E5DFEE] pr-12 xxl:pr-10 xl:pr-8" type="text">
        <img @click="copy" class="absolute cursor-pointer top-1/2 -translate-y-1/2 w-6 xxl:w-5 xl:w-4 right-5 xxl:right-4 xl:right-3" src="../../../assets/svg/copy_icon_purple.svg" alt="">
      </div>
    </div>
    <div @click="$emit('closeSubmitSelection')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  props: {
    link: String
  },
  emits: ['closeSubmitSelection'],
  data() {
    return {
      valueLink: 'http://102895812h9051h2081102j9'
    }
  },
  methods: {
    copy() {
      navigator.clipboard.writeText(this.valueLink)
    }
  },
  created() {
    this.valueLink = this.link
  }
}
</script>

<style scoped>

</style>
