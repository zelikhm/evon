<template>
  <app-modal-notification v-if="openNotification" @close-notification="openNotification = false"/>
  <app-create-selections @close-create-selection="closeCreateSelection" :openSideBar="openSideBar" :openSelection="openCreateSelection"/>
  <app-header/>
  <main>
    <div class="_container">
      <div class="flex justify-between items-center mt-14 xxl:mt-10 xl:mt-8">
        <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5">
          <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] leading-none">Мои подборки</h2>
          <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Найдено 1512 новостроек</span>
        </div>
        <button @click="openSelection" class="bg-[#E84680] text-white text-base text-sm text-xs px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2 xl:py-1.5 rounded-[3px] leading-none">Создать подборку</button>
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-1 gap-x-10 gap-y-4 mt-8 xxl:mt-7 xl:mt-6 mb-28 xxl:mb-24 xl:mb-20">
        <div class="contact__selling grid__selection-block rounded-[10px]">
          <img class="p-2.5 xxl:p-2 xl:p-1.5 w-full h-[8.5vw] lg:h-[17vw] sm:h-auto rounded-[3px]" src="../../assets/immovables_img_one.png" alt="">
          <div class="flex items-center">
            <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5 w-full py-2.5 xxl:py-2 xl:py-1.5 pl-2.5 xxl:pl-2 xl:pl-1.5 pr-20 xxl:pr-16 xl:pr-12">
              <span class="text-lg xxl:text-[15px] xl:text-[13px] text-[#1E1D2D] font-medium leading-none">Тестовая</span>
              <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">1 ЖК</span>
              <div class="flex w-full border border-solid border-[#6435A5] rounded-[5px] p-3 xxl:p-2.5 xl:p-2">
                <input class="p-0 text-base text-sm text-xs w-full leading-none focus:ring-0" placeholder="Эконом" type="text">
                <button class="text-[#6435A5] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Сохранить</button>
              </div>
            </div>
            <div class="border__left flex flex-col h-full justify-evenly">
              <button class="px-5 xxl:px-4 xl:px-3 h-full">
                <img src="../../assets/svg/pen_icon_grey.svg" class="w-6 xxl:w-5.5 xl:w-5" alt="">
              </button>
              <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
              <button class="px-5 xxl:px-4 xl:px-3 h-full">
                <img src="../../assets/svg/screp_icon_grey.svg" class="w-6 xxl:w-5.5 xl:w-5" alt="">
              </button>
              <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
              <button class="px-5 xxl:px-4 xl:px-3 h-full">
                <img src="../../assets/svg/bucket_icon_red.svg" class="w-6 xxl:w-5.5 xl:w-5" alt="">
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer/>
</template>
<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppModalNotification from "@/Layouts/modal/AppModalNotification.vue"
import AppCreateSelections from "@/Layouts/modal/AppCreateSelections.vue"

export default {
  data() {
    return {
      openNotification: false,
      openCreateSelection: false,
      openSideBar: false
    }
  },
  methods: {
    openSelection() {
      this.openCreateSelection = true
      setTimeout(() => {
        this.openSideBar = true
      }, 10)
    },
    closeCreateSelection() {
      this.openSideBar = false
      setTimeout(() => {
        this.openCreateSelection = false
      }, 500)
    }
  },
  components: {AppHeader, AppFooter, AppModalNotification, AppCreateSelections}
}
</script>

<style scoped>

</style>
