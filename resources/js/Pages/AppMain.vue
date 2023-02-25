<template>
  <app-modal-auth
    :oLoginRealtor="openLoginRealtor"
    :oLoginDeveloper="openLoginDeveloper"
    @close-modal="closeModal"
    @open-modal-realtor="openModalRealtor"
    @open-modal-developer="openModalDeveloper"
    :language="language"
    :selectLanguage="selectLanguage"
  />
  <app-header
    @login-developer="openLoginDeveloper = !openLoginDeveloper"
    @login-realtor="openLoginRealtor = !openLoginRealtor"
    @open-register="openRegister = !openRegister"
    @selectLanguage="choseLanguage"
    :user="user"
    :language="language"
  />

  <app-modal-register
      :oLoginRegister="openRegister"
      @close-modal="closeModalRegister"
      :language="language"
      :selectLanguage="selectLanguage"
  />
  <main>
    <div class="_container">
      <div class="main__title-block mt-[30px] xxl:mt-6 mb-[100px] xxl:mb-20 rounded-[6px]">
        <div class="_container--inter">
          <div class="main__title-block--grid lg:flex lg:flex-col items-center gap-1 pt-10 xxl:pt-7 lg:pt-5 pb-0.5 lg:mx-3">
            <div class="flex flex-col gap-7 xxl:gap-5 xl:gap-3 lg:w-[60%] sm:w-full">
              <h2 class="text-[22px] lg:text-center xxl:text-[18px] xl:text-[15px] lg:text-[19px] font-semibold leading-[125%]" v-html="language.main[0]"></h2>
              <p class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996] lg:text-[12px] lg:text-center" v-html="language.main[1]"></p>
            </div>
            <div class="lg:hidden">
              <img src="../../assets/main/main_macbook_img.png" class="w-full" alt="Макбук">
            </div>
            <div class="flex flex-col gap-8 xxl:gap-6 xl:gap-4 mb-2 lg:w-[60%] sm:w-full">
              <img src="../../assets/main/main_chess_img.png" class="lg:hidden border border-solid border-[#E5DFEE] w-[58%] rounded-[4px]" alt="Картинка">
              <div class="flex gap-4 xxl:gap-3 w-full">
                <div class="lg:hidden h-[30px] w-[2px] xl:w-[1px] rounded-[3px] bg-[#784FB0]"></div>
                <p class="lg:text-center w-full text-sm xxl:text-xs xl:text-[10px] lg:text-[12px] text-[#8A8996]" v-html="language.main[2]"></p>
              </div>
              <button @click="openRegister = true" class="lg:self-center register__button--white w-fit border border-solid border-[#6435A5] leading-none rounded-[3px] text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] text-[#6435A5] px-5 xxl:px-4 xl:px-3 py-2.5 xxl:py-2 xl:py-1.5">{{ language.main[3] }}</button>
            </div>
          </div>
        </div>
      </div>
      <div class="_container--inter">
        <h3 class="text-lg xxl:text-base xl:text-sm lg:text-[17px] font-semibold pb-8 xl:pb-5">{{ language.main[4] }}</h3>
        <div class="grid grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 xl:gap-3 mb-[100px] xxl:mb-10">
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[5] }}</span>
            <img src="../../assets/svg/main_for_rieltor_one.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 1">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[6] }}</span>
            <img src="../../assets/svg/main_for_rieltor_two.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 2">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[7] }}</span>
            <img src="../../assets/svg/main_for_rieltor_three.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 3">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[8] }}</span>
            <img src="../../assets/svg/main_for_rieltor_four.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 4">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[9] }}</span>
            <img src="../../assets/svg/main_for_rieltor_five.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 5">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[10] }}</span>
            <img src="../../assets/svg/main_for_rieltor_six.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 6">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[11] }}</span>
            <img src="../../assets/svg/main_for_rieltor_seven.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 7">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[12] }}</span>
            <img src="../../assets/svg/main_for_rieltor_eight.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 8">
          </div>
        </div>
      </div>
    </div>
    <div class="main__title-block">
      <div class="_container">
        <div class="_container--inter">
          <div class="py-[100px] xl:py-20">
            <h3 class="text-lg xxl:text-base xl:text-sm lg:text-[17px] font-semibold pb-8 xl:pb-5">{{ language.main[13] }}</h3>
            <div class="grid grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5">
              <div class="flex flex-col gap-3 justify-between items-start sm:items-center bg-white h-[200px] exl:h-fit exl:min-h-[10vw] rounded-xl p-7 xxl:p-5 xl:p-4">
                <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[14] }}</span>
                <img src="../../assets/svg/main_for_developer_one.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для засторйщика 1">
              </div>
              <div class="flex flex-col gap-3 justify-between items-start sm:items-center bg-white h-[200px] exl:h-fit exl:min-h-[10vw] rounded-xl p-7 xxl:p-5 xl:p-4">
                <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[15] }}</span>
                <img src="../../assets/svg/main_for_developer_two.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для засторйщика 2">
              </div>
              <div class="flex flex-col gap-3 justify-between items-start sm:items-center bg-white h-[200px] exl:h-fit exl:min-h-[10vw] rounded-xl p-7 xxl:p-5 xl:p-4">
                <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">{{ language.main[16] }}</span>
                <img src="../../assets/svg/main_for_developer_three.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для засторйщика 3">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main__block--bg">
      <div class="_container">
        <div class="_container--inter">
          <div class="flex items-center justify-center ">
            <button @click="openRegister = true" class="hover__button--purple transition-all text-white bg-[#6435A5] text-base xxl:text-sm xl:text-xs lg:text-[14px] leading-none rounded-[3px] px-6 xxl:px-5 xl:px-4 py-3 xxl:py-2 xl:py-1.5 my-7 xxl:my-5 xl:my-4">
              {{ language.main[17] }}</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer :language="language" />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppModalAuth from "../Layouts/modal/AppModalAuth.vue"
import {computed} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";
import AppModalRegister from "@/Layouts/modal/AppModalRegister.vue";

export default {
  props:['error'],
  provide() {
    return {
      error: this.error,
    }
  },
  data() {
    return {
      user: computed(() => usePage().props.value.auth.user),
      openLoginRealtor: false,
      openLoginDeveloper: false,
      openRegister: false,
      language: {},
      selectLanguage: 0,
    }
  },
  created() {
    if(this.user !== null) {
      if(this.user.lang === 0) {
        this.language = this.$ru;
      } else if (this.user.lang === 1) {
        this.language = this.$en;
      } else if (this.user.lang === 2) {
        this.language = this.$tur;
      }
    } else {
      if(this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }
    }
  },
  methods: {
    choseLanguage(language) {
      this.selectLanguage = language;

      if(this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }

    },
    closeModal() {
      this.openLoginRealtor = false
      this.openLoginDeveloper = false
      this.openRegister = false
    },
    openModalRealtor() {
      this.openLoginRealtor = true
      this.openLoginDeveloper = false
    },
    openModalDeveloper() {
      this.openLoginRealtor = false
      this.openLoginDeveloper = true
    },
    closeModalRegister() {
      this.openRegister = false
    }
  },
  components: {
    AppModalRegister,
    AppHeader,
    AppFooter,
    AppModalAuth,
  }
}
</script>

<style scoped>

</style>
