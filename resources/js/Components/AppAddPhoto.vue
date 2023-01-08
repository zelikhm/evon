<template>
  <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] mb-5 xxl:mb-4 xl:mb-3">Добавить фото</h2>
  <div class="grid grid-cols-4 gap-3 xxl:gap-2.5 xl:gap-2">
    <div @click="targetBlockPhoto(item)" v-for="item in photos" :class="{ border: item.active === 1 }" class="corpus__banner cursor-pointer gap-3.5 xxl:gap-3 xl:gap-2.5 rounded-[5px] border-solid border-[#6435A5] flex flex-col justify-center px-5 xxl:px-4 xl:px-3 py-5 xxl:py-4 xl:py-3 ">
      <span class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] leading-none">{{ item.name }}</span>
      <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none">{{ item.count }} фото</span>
    </div>
  </div>
  <div class="my-10 xxl:my-8 xl:my-6">
    <app-upload />
  </div>
  <div class="my-10 xxl:my-8 xl:my-6 w-full gap-10 xxl:gap-8 xl:gap-6">
    <button @click="addObject(1)" class="w-full font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] text-white bg-[#E84680] rounded-[6px]">Закончить</button>
  </div>
</template>

<script>

import AppUpload from "../Components/AppUpload.vue"

export default {
  data() {
    return {
      photos: [
        { name: '3D Рендеры', count: 0 },
        { name: 'Инфраструктура', count: 11 },
        { name: 'Дизайн', count: 15 },
        { name: 'Ход строительства', count: 7 },
      ]
    }
  },
  methods: {
    targetBlockPhoto(photo) {
      this.photos.forEach(item => item.active = 0)
      photo.active = 1
    }
  },
  created() {
    this.photos.forEach((item, idx) => {
      if (idx === 0) item.active = 1
      else item.active = 0
    })
  },
  components: {
    AppUpload,
  }
}

</script>
