<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col gap-5 xxl:gap-4 xl:gap-3 bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[40%] lg:w-[56%] md:w-[70%] sm:w-[90%] h-fit">
      <div class="relative flex justify-between items-center">
        <button @click="closeChess" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <div class="py-10 xxl:py-8 xl:py-6">
        <img :src="flat.isOpen === 0 ? flat.imageUp : flat.imageDown" alt="">
      </div>
      <div class="absolute top-0 lg:top-full left-full lg:left-0 ml-10 xxl:ml-8 xl:ml-6 lg:mt-4">
        <div class="flex flex-col text-white">
          <div class="flex gap-4 xxl:gap-3 xl:gap-2.5 items-center pb-3 xxl:pb-2.5 xl:pb-2">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px] leading-none">№{{ flat.number }}</span>
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[15px] leading-none w-max">{{ flat.status == 0 ? "Акция" : flat.status == 1 ? "Перепродажа" : flat.status == 2 ? "Бронь" : flat.status == 3 ? "Продажи закрыты" : "В продаже" }}</span>
          </div>
          <span class="text-[22px] xxl:text-[18px] xl:text-[15px] lg:text-[20px] font-semibold leading-none pb-4 xxl:pb-3 xl:pb-2.5">{{ flat.price }} €</span>
          <span class="text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14x] leading-none pb-5 xxl:pb-4 xl:pb-3">{{ Math.round(flat.price / flat.square) }} € за м²</span>
          <div class="chess__bg--ruller flex items-center gap-1 w-fit px-2 xl:px-1.5 py-1.5 xl:py-1">
            <svg class="w-4.5 xxl:w-4 xl:w-3.5" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_150_2046)">
                <path d="M4.75728 10.9658L2.63629 13.0875L5.28754 15.7388L15.3638 5.66254L12.7125 3.01128L11.121 4.60204L12.1823 5.66254L11.121 6.72303L10.0605 5.66254L8.46979 7.25403L10.0605 8.84403L9.00003 9.90603L7.40928 8.31528L5.81778 9.90603L6.87903 10.9665L5.81778 12.0278L4.75728 10.9665V10.9658ZM13.2428 1.41979L16.9553 5.13228C17.0959 5.27293 17.1749 5.46366 17.1749 5.66254C17.1749 5.86141 17.0959 6.05214 16.9553 6.19278L5.81778 17.3303C5.67714 17.4709 5.48641 17.5499 5.28754 17.5499C5.08866 17.5499 4.89793 17.4709 4.75728 17.3303L1.04479 13.6178C0.904182 13.4771 0.825195 13.2864 0.825195 13.0875C0.825195 12.8887 0.904182 12.6979 1.04479 12.5573L12.1823 1.41979C12.3229 1.27918 12.5137 1.2002 12.7125 1.2002C12.9114 1.2002 13.1021 1.27918 13.2428 1.41979Z" fill="white"/>
              </g>
              <defs>
                <clipPath id="clip0_150_2046">
                  <rect width="18" height="18" fill="white"/>
                </clipPath>
              </defs>
            </svg>
            <span class="text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px] leading-none">{{ flat.square }} м²</span>
          </div>
        </div>
      </div>
    </div>
    <div @click="closeChess" class="absolute bg-black opacity-60 h-full w-full z-40"></div>
  </div>
</template>

<script>

export default {
  props: {
    flat: []
  },
  data() {
    return {

    }
  },
  emits: ['close-chess'],
  methods: {
    closeChess() {
      this.$emit('close-chess')
    }
  }
}
</script>

<style scoped>

</style>
