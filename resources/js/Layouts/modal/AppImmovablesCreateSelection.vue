<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col bg-white rounded-[12px] z-50 w-[43%] lg:w-[56%] md:w-[70%] sm:w-[94%] h-fit">
      <div class="relative border__bottom flex justify-between items-center p-8 xxl:p-6 xl:p-5">
        <h2 class="text-lg xxl:text-[15px] xl:text-[13px] font-semibold leading-none">{{ language.rielt_3[0] }}</h2>
        <svg @click="$emit('close-i-create-selection')"  class="hover__close transition-all cursor-pointer w-6 xxl:w-5 xl:w-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_266_4120)">
            <path d="M11.9997 10.586L16.9497 5.63599L18.3637 7.04999L13.4137 12L18.3637 16.95L16.9497 18.364L11.9997 13.414L7.04974 18.364L5.63574 16.95L10.5857 12L5.63574 7.04999L7.04974 5.63599L11.9997 10.586Z" fill="#8A8996"/>
          </g>
          <defs>
            <clipPath id="clip0_266_4120">
              <rect width="24" height="24" fill="white"/>
            </clipPath>
          </defs>
        </svg>
      </div>
      <div class="relative p-8 xxl:p-6 xl:p-5">
        <div class="text-lg xxl:text-[15px] xl:text-[13px] font-semibold pb-4 xxl:pb-3 xl:pb-2.5 leading-none">{{ language.rielt_3[1] }}</div>
        <div class="flex items-center gap-4 xxl:gap-3 xl:gap-2.5 mb-8 xxl:mb-6 xl:mb-5">
          <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name">{{ language.rielt_3[2] }}</label>
            <input v-model="titleCompilation" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name" placeholder="Название">
          </div>
          <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="comment">{{ language.rielt_3[3] }}</label>
            <input v-model="commentCompilation" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="comment">
          </div>
        </div>
        <div class="mb-8 xxl:mb-6 xl:mb-5">
          <input v-model="isShow" class="custom__checkbox" type="checkbox" id="chekbox">
          <label class="text-[#1E1D2D] font-medium text-lg xxl:text-[15px] xl:text-[13px] leading-none" for="chekbox">{{ language.rielt_3[4] }}</label>
        </div>

        <div class="text-[#1E1D2D] font-medium text-[18px] xxl:text-[15px] xl:text-[13px] mb-4 xxl:mb-3 xl:mb-2.5">ЖК</div>
        <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 mb-8 xxl:mb-6 xl:mb-5 overflow-y-auto max-h-56 xxl:max-h-48 xl:max-h-40 custom__scroll-grey">
          <div
            class="contact__selling p-2.5 xxl:p-2 xl:p-1.5 rounded-[10px]"
          >
            <div class="flex justify-between items-center mb-3 xxl:mb-2.5 xl:mb-2">
              <div class="flex gap-5 xxl:gap-4 xl:gap-3 items-center">
                <img v-if="house !== undefined && house.image !== null" :src="imageServiceUrl + house.image.name" class="w-[70px] xxl:w-[60px] xl:w-[50px] h-[70px] xl:h-[60px] xl:h-[50px] rounded-[3px]" alt="">
                <img v-else src="../../../assets/no-img-houses.jpg" class="w-[70px] xxl:w-[60px] xl:w-[50px] h-[70px] xl:h-[60px] xl:h-[50px] rounded-[3px]" alt="">
                <div class="flex flex-col gap-3 xxl:gap-2.5 xl:gap-2">
                  <span class="text-[#1E1D2D] font-medium text-[18px] xxl:text-[15px] xl:text-[13px] leading-none">{{ house.title }}</span>
                  <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">{{ house.city }}, {{ house.area }}</span>
                </div>
              </div>
              <div class="flex items-center">
                <img v-if="!openInput" @click="openInput = true" src="../../../assets/svg/chat_icon_grey.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 mx-5 xxl:mx-4 xl:mx-3" alt="">
                <img src="../../../assets/svg/bucket_icon_red.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 mx-5 xxl:mx-4 xl:mx-3" alt="">
              </div>
            </div>
            <div v-if="openInput" class="relative">
              <input v-model="commentJK" class="w-full text-[#1E1D2D] text-[16px] focus:ring-[#6435A5] focus:border-[#6435A5] xxl:text-[14px] xl:text-[12px] pl-5 xxl:pl-4 xl:pl-3 py-3 xxl:py-2.5 xl:py-2 leading-none rounded-[5px] border border-solid border-[#E5DFEE] pr-12 xxl:pr-10 xl:pr-8" type="text">
              <img @click="openInput = false" class="absolute cursor-pointer top-1/2 -translate-y-1/2 w-6 xxl:w-5 xl:w-4 right-5 xxl:right-4 xl:right-3" src="../../../assets/svg/close_grey.svg" alt="">
            </div>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-8 xxl:gap-6 xl:gap-5">
          <button @click="createSelection" class="login__btn--bg text-white text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">{{ language.rielt_3[6] }}</button>
          <button @click="$emit('close-i-create-selection')" class="bg-litepink text-[#E84680] text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">
            {{ language.izbr_1[4] }}</button>
        </div>
      </div>
    </div>
    <div @click="$emit('close-i-create-selection')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  props: ['house', 'title', 'user', 'language'],
  data() {
    return {
      titleCompilation: '',
      openInput: false,
      commentJK: '',
      commentCompilation: '',
      isShow: false,
      imageServiceUrl: '',
    }
  },
  emits: ['close-add-selection', 'close-i-create-selection', 'update-compilation'],
  methods: {
    createSelection() {

      axios.post('/api/compilation/create', {
        user_id: this.user.id,
        title: this.titleCompilation,
        description: this.commentCompilation,
        isVisible: this.isShow,
        token: this.user.token
      }).then(response => this.addHouse(response.data))
    },
    addHouse(id) {
      axios.post('/api/compilation/addHouse', {
        compilation_id: id,
        description: this.commentJK,
        house_id: this.house.id,
        token: this.user.token
      }).then(response => {
        this.$emit('updateCompilation', response.data)
        this.$emit('close-i-create-selection')
      })

    }
  },
  created() {
    this.imageServiceUrl = this.$service;
    this.titleCompilation = this.title
  }
}
</script>

<style scoped>

</style>

