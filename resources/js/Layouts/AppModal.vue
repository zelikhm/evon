<template>
<!--  Вход в приложение как риэлтор -->
  <div v-if="oLoginRealtor" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 z-50 w-[30%] h-fit">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">Вход в приложение Avon</h2>
        <button @click="closeModal" class="w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <div class="flex flex-col p-5 xxl:pb-4 xl:pb-3 mb-8 xxl:mb-6 xl:mb-5 border border-solid border-[#E5DFEE] rounded-[6px]">
        <label for="telephone" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]">Телефон</label>
        <input class="text-[#1E1D2D] border-transparent focus:border-transparent focus:ring-0 text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0" type="tel" id="telephone" placeholder="+7 930 245 15 20">
      </div>
      <button class="text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3 bg-[#E84680] border border-solid border-[#E5DFEE] rounded-[6px]">Войти</button>
      <div class="flex items-center justify-center text-base xxl:text-sm xl:text-xs">
        <button @click="openLoginDeveloper" class="text-[#E84680]">Войти как застройщик</button>
      </div>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>

<!-- Вход с кодом с телефона -->
  <div v-if="1 != 1" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 z-50 w-[30%] h-fit">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">Вход в приложение Avon</h2>
        <button @click="closeModal" class="w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <p class="text-[#8A8996] mb-10 xxl:mb-8 xl:mb-6 text-center text-base xxl:text-[13px] xl:text-[11px]">На номер +7 930 245 15 20 был отправлен код</p>
      <div class="modal__telephone-cod gap-5 xxl:gap-4 xl:gap-3 mb-8 xxl:mb-6 xl:mb-5">
        <input type="number" v-model="valueTelOne" @input="changeValueOne" class="border-transparent focus:border-transparent focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-model="valueTelTwo" @input="changeValueTwo" class="border-transparent focus:border-transparent focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-model="valueTelThree" @input="changeValueThree" class="border-transparent focus:border-transparent focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-model="valueTelFour" @input="changeValueFour" class="border-transparent focus:border-transparent focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
      </div>
      <div class="flex flex-col items-center mb-10 xxl:mb-8 xl:mb-6 text-base xxl:text-[13px] xl:text-[11px]">
        <span class="text-[#8A8996]">Отправить код еще раз через <span class="text-[#E84680]"> 1:56 </span></span>
        <button class="text-[#E84680]">Ввести другой номер</button>
      </div>
      <div class="mb-8 xxl:mb-6 xl:mb-5 flex justify-center">
        <input class="custom__checkbox" type="checkbox" id="privacy-policy">
        <label class="text-base xxl:text-[13px] xl:text-[11px]" for="privacy-policy">Политика конфиденциальности</label>
      </div>
      <button class="text-white w-full text-lg xxl:text-[15px] xl:text-xs p-5 xxl:p-4 xl:p-3 bg-[#E84680] border border-solid border-[#E5DFEE] rounded-[6px]">Войти</button>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>

<!-- Вход в приложение как застройщик -->
  <div v-if="oLoginDeveloper" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 z-50 w-[30%] h-fit">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">Вход в приложение Avon</h2>
        <button @click="closeModal" class="w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <div class="flex flex-col p-5 xxl:pb-4 xl:pb-3 mb-8 xxl:mb-6 xl:mb-5 border border-solid border-[#E5DFEE] rounded-[6px]">
        <label for="email" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]">email</label>
        <input class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0" type="text" id="email" placeholder="test@mail.com">
      </div>
      <div class="flex flex-col p-5 xxl:pb-4 xl:pb-3 mb-8 xxl:mb-6 xl:mb-5 border border-solid border-[#E5DFEE] rounded-[6px]">
        <label for="password" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]">Пароль</label>
        <div class="relative">
          <input class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0" type="password" id="password" placeholder="password">
          <svg class="absolute -translate-y-1/2 top-1/2 right-0 h-6 xxl:h-5 xl:h-4 w-6 xxl:w-5 xl:w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_398_11305)">
              <path d="M11.9997 3C17.3917 3 21.8777 6.88 22.8187 12C21.8787 17.12 17.3917 21 11.9997 21C6.60766 21 2.12166 17.12 1.18066 12C2.12066 6.88 6.60766 3 11.9997 3ZM11.9997 19C14.0391 18.9996 16.0181 18.3068 17.6125 17.0352C19.207 15.7635 20.3226 13.9883 20.7767 12C20.3209 10.0133 19.2046 8.24 17.6103 6.97003C16.016 5.70005 14.038 5.00853 11.9997 5.00853C9.96136 5.00853 7.98335 5.70005 6.38904 6.97003C4.79473 8.24 3.67843 10.0133 3.22266 12C3.67676 13.9883 4.79234 15.7635 6.38681 17.0352C7.98128 18.3068 9.9602 18.9996 11.9997 19ZM11.9997 16.5C10.8062 16.5 9.6616 16.0259 8.81768 15.182C7.97377 14.3381 7.49966 13.1935 7.49966 12C7.49966 10.8065 7.97377 9.66193 8.81768 8.81802C9.6616 7.97411 10.8062 7.5 11.9997 7.5C13.1931 7.5 14.3377 7.97411 15.1816 8.81802C16.0256 9.66193 16.4997 10.8065 16.4997 12C16.4997 13.1935 16.0256 14.3381 15.1816 15.182C14.3377 16.0259 13.1931 16.5 11.9997 16.5ZM11.9997 14.5C12.6627 14.5 13.2986 14.2366 13.7674 13.7678C14.2363 13.2989 14.4997 12.663 14.4997 12C14.4997 11.337 14.2363 10.7011 13.7674 10.2322C13.2986 9.76339 12.6627 9.5 11.9997 9.5C11.3366 9.5 10.7007 9.76339 10.2319 10.2322C9.76306 10.7011 9.49966 11.337 9.49966 12C9.49966 12.663 9.76306 13.2989 10.2319 13.7678C10.7007 14.2366 11.3366 14.5 11.9997 14.5Z" fill="#1E1D2D"/>
            </g>
            <defs>
              <clipPath id="clip0_398_11305">
                <rect class="h-6 w-6" fill="white"/>
              </clipPath>
            </defs>
          </svg>
        </div>
      </div>
      <button class="text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3 bg-[#E84680] border border-solid border-[#E5DFEE] rounded-[6px]">Войти</button>
      <div class="flex items-center justify-center text-base xxl:text-sm xl:text-xs">
        <button @click="openLoginRealtor" class="text-[#E84680]">Войти как риэлтор</button>
      </div>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  props: {
    oLoginRealtor: {
      type: Boolean
    },
    oLoginDeveloper: {
      type: Boolean
    }
  },
  data() {
    return {
      valueTelOne: null,
      valueTelTwo: null,
      valueTelThree: null,
      valueTelFour: null,
      loginRealtor: false,
      loginDeveloper: false,
    }
  },
  emits: [
    'close-modal',
    'open-modal-realtor',
    'open-modal-developer',
  ],
  methods: {
    openLoginRealtor() {
      this.$emit('open-modal-realtor')
    },
    openLoginDeveloper() {
      this.$emit('open-modal-developer')
    },
    closeModal() {
      this.$emit('close-modal')
    },
    changeValueOne() {
      if(this.valueTelOne.toString().length > 1) {
        this.valueTelOne = this.valueTelOne.toString().substring(0, 1)
      }
    },
    changeValueTwo() {
      if(this.valueTelTwo.toString().length > 1) {
        this.valueTelTwo = this.valueTelTwo.toString().substring(0, 1)
      }
    },
    changeValueThree() {
      if(this.valueTelThree.toString().length > 1) {
        this.valueTelThree = this.valueTelThree.toString().substring(0, 1)
      }
    },
    changeValueFour() {
      if(this.valueTelFour.toString().length > 1) {
        this.valueTelFour = this.valueTelFour.toString().substring(0, 1)
      }
    },
  },
}
</script>

<style scoped>

</style>
