<template>
  <div class="border__right">
    <div class="border__bottom">
      <div class="grid grid__chess--list ml-[6.25vw]">
        <div class="flex items-center gap-1 p-5 xxl:p-4 xl:p-3">
          <span class="text-[#8A8996] text-base xxl:text-[14px] xl:text-[12px] leading-none">№</span>
          <div class="flex flex-col gap-[1px] xl:gap-[0.5px]">
            <svg class="cursor-pointer rotate-180 w-[9px] xxl:w-[8px] xl:w-[7px] h-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
            <svg class="cursor-pointer w-[9px] h-[7px] w-[9px] xxl:w-[8px] xl:w-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
          </div>
        </div>
        <div class="flex items-center gap-1 p-5 xxl:p-4 xl:p-3">
          <span class="text-[#8A8996] text-base xxl:text-[14px] xl:text-[12px] leading-none">Площадь</span>
          <div class="flex flex-col gap-[1px] xl:gap-[0.5px]">
            <svg class="cursor-pointer rotate-180 w-[9px] xxl:w-[8px] xl:w-[7px] h-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
            <svg class="cursor-pointer w-[9px] h-[7px] w-[9px] xxl:w-[8px] xl:w-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
          </div>
        </div>
        <div class="flex items-center gap-1 p-5 xxl:p-4 xl:p-3">
          <span class="text-[#8A8996] text-base xxl:text-[14px] xl:text-[12px] leading-none">Цена</span>
          <div class="flex flex-col gap-[1px] xl:gap-[0.5px]">
            <svg class="cursor-pointer rotate-180 w-[9px] xxl:w-[8px] xl:w-[7px] h-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
            <svg class="cursor-pointer w-[9px] h-[7px] w-[9px] xxl:w-[8px] xl:w-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
          </div>
        </div>
        <div class="flex items-center gap-1 p-5 xxl:p-4 xl:p-3">
          <span class="text-[#8A8996] text-base xxl:text-[14px] xl:text-[12px] leading-none">Планировка</span>
          <div class="flex flex-col gap-[1px] xl:gap-[0.5px]">
            <svg class="cursor-pointer rotate-180 w-[9px] xxl:w-[8px] xl:w-[7px] h-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
            <svg class="cursor-pointer w-[9px] h-[7px] w-[9px] xxl:w-[8px] xl:w-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
          </div>
        </div>
        <div class="flex items-center gap-1 p-5 xxl:p-4 xl:p-3">
          <span class="text-[#8A8996] text-base xxl:text-[14px] xl:text-[12px] leading-none">Этаж</span>
          <div class="flex flex-col gap-[1px] xl:gap-[0.5px]">
            <svg class="cursor-pointer rotate-180 w-[9px] xxl:w-[8px] xl:w-[7px] h-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
            <svg class="cursor-pointer w-[9px] h-[7px] w-[9px] xxl:w-[8px] xl:w-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-[#F6F3FA] ">
      <div class="ml-[6.25vw] h-[40vw] py-8 xxl:py-6 xl:py-5 pr-4 xxl:pr-3 xl:pr-2.5">
        <div class="h-full flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 pr-4 xxl:pr-3 xl:pr-2.5 custom__scroll--chess overflow-y-scroll text-[#1E1D2D] text-base xxl:text-[14px] xl:text-[12px]">
          <div v-for="item in flats" :class="{ 'border': item.active === 1 }" @click="targetFlat(item)" class="cursor-pointer grid grid__chess--list bg-white rounded-[5px] border-solid border-[#6435A5]">
            <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.number }}</span>
            <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.square }}</span>
            <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.price }}</span>
            <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.count }}</span>
            <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.floor }}</span>
            <span :class="{ 'text-[#FF6600]': item.status == 0,
                            'text-[#8A8996]': item.status == 2,
                            'text-[#E84680]': item.status == 3,
                            'text-[#00A478]': item.status == 4


            }" class="leading-none p-5 xxl:p-4 xl:p-3">
              {{ item.status == 0 ? "Акция" : item.status == 1 ? "Перепродажа" : item.status == 2 ? "Бронь" : item.status == 3 ? "Продажи закрыты" : "В продаже" }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>

export default {
  props: ['flats'],
  data() {
    return {

    }
  },
  methods: {
    targetFlat(item) {
      this.flats.forEach(flat => {
        if (item.id === flat.id) {
          flat.active = 1
          this.$emit('target-flat', flat)
        } else {
          flat.active = 0
        }
      })
    }
  },
  created() {
  }
}

</script>