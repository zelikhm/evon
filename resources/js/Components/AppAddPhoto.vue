<template>
  <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] mb-5 xxl:mb-4 xl:mb-3">Добавить фото</h2>
  <div class="grid grid-cols-4 gap-3 xxl:gap-2.5 xl:gap-2">
    <div class="corpus__banner cursor-pointer rounded-[5px] border border-solid border-[#6435A5] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
      <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-[110%]">3D Рендеры</span>
      <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">0 фото</span>
    </div>
    <div class="corpus__banner cursor-pointer rounded-[5px] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
      <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-[110%]">Инфраструктура</span>
      <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">11 фото</span>
    </div>
    <div class="corpus__banner cursor-pointer rounded-[5px] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
      <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-[110%]">Дизайн</span>
      <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">11 фото</span>
    </div>
    <div class="corpus__banner cursor-pointer rounded-[5px] flex flex-col px-5 xxl:px-4 xl:px-3 py-2 xl:py-1.5">
      <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-[110%]">Ход строительства</span>
      <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]">11 фото</span>
    </div>
  </div>
  <div class="my-10 xxl:my-8 xl:my-6">
    <app-upload />
  </div>
</template>

<script>

import AppUpload from "../Components/AppUpload.vue"

export default {
  data() {
    return {

    }
  },
  components: {
    AppUpload,
  }
}

</script>
