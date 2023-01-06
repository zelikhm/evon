<template>
  <app-modal-notification
    v-if="openNotification"
    @close-notification="openNotification = false"
  />
  <app-header />
  <main>
    <div class="_container">
      <div class="immovables__grid my-14 xxl:my-10 xl:my-8">
        <app-filter />
        <div class="relative px-7 xxl:px-5 xl:px-4 w-full h-[98vh]">
          <div class="absolute decription__head top-0 right-6 xxl:right-5 xl:right-4 bg-white rounded-[10px] m-5 xxl:m-4 xl:m-3">
            <div class="p-8 xxl:p-6 xl:p-5 border__bottom">
              <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 mb-7 xxl:mb-5 xl:mb-4">
                <img src="../../assets/chat_avatar.png" class="w-14 xxl:w-12 xl:w-8" alt="">
                <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <span class="text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] font-medium leading-none">Euro Avsallar Residence</span>
                  <span class="text-[#8A8996] text-[16px] xxl:text-[14px] xl:text-[12px] leading-none">Туапсе, А147</span>
                </div>
              </div>
              <div class="flex gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-[14px] xxl:text-[12px] xl:text-[10px] leading-none bg-[#30CB49] px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 rounded-[3px]">СДАН</span>
                <span class="border border-solid border-[#E5DFEE] text-[#8A8996] text-[14px] xxl:text-[12px]  xl:text-[10px] leading-none px-2 xxl:px-1.5 xl:px-1 py-1.5 xl:py-1 rounded-[3px]">Договор займа</span>
              </div>
            </div>
            <div class="p-8 xxl:p-6 xl:p-5">
              <div class="flex justify-between items-center mb-5 xxl:mb-4 xl:mb-3 text-[18px] xxl:text-[15px] xl:text-[13px]">
                <span class="text-[#1E1D2D] font-medium leading-none">от 1 490 000 €</span>
                <span class="text-[#8A8996] leading-none">49 Квартир</span>
              </div>
              <div class="gray-backg flex items-center gap-1 w-fit px-2 xl:px-1.5 py-1.5 xl:py-1 mb-7 xxl:mb-5 xl:mb-4">
                <img src="../../assets/svg/ruller_icon.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                <span class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">14.9 м² - 23.4 м²</span>
              </div>
              <div class="flex gap-5 xxl:gap-4 xl:gap-3 w-full">
                <button class="w-full flex items-center justify-between border border-solid border-[#6435A5] rounded-[4px] p-3 xxl:p-2 xl:p-1.5">
                  <span class="text-[#6435A5] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">В подборку</span>
                  <img src="../../assets/svg/plus_icon_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                </button>
                <button class="w-full flex items-center justify-between border border-solid border-[#6435A5] rounded-[4px] p-3 xxl:p-2 xl:p-1.5">
                  <span class="text-[#6435A5] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">В избранное</span>
                  <img src="../../assets/svg/plus_icon_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                </button>
              </div>
            </div>
          </div>
          <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d78173.57828522827!2d20.837833449492916!3d52.24475823593983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecae3479edae3%3A0xc04a9df8e721016f!2z0JHQtdC80L7QstC-LCDQktCw0YDRiNCw0LLQsA!5e0!3m2!1sru!2spl!4v1672332575544!5m2!1sru!2spl" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <app-news-developer />
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppFilter from "../Components/AppFilter.vue"
import AppNewsDeveloper from "../Components/AppNewsDeveloper.vue"
import AppModalNotification from "../Layouts/modal/AppModalNotification.vue"

export default {
  props: {

  },
  data() {
    return {
      openNotification: false,
    }
  },
  components: {
    AppHeader,
    AppFooter,
    AppFilter,
    AppNewsDeveloper,
    AppModalNotification,
  },
}
</script>

<style scoped>

</style>
