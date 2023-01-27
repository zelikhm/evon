<template>
  <app-modal-auth
    :oLoginRealtor="openLoginRealtor"
    :oLoginDeveloper="openLoginDeveloper"
    @close-modal="closeModal"
    @open-modal-realtor="openModalRealtor"
    @open-modal-developer="openModalDeveloper"
  />
  <app-header
    @login-developer="openLoginDeveloper = !openLoginDeveloper"
    @login-realtor="openLoginRealtor = !openLoginRealtor"
    @open-register="openRegister = !openRegister"
    :user="user"
  />

  <app-modal-register
      :oLoginRegister="openRegister"
      @close-modal="closeModalRegister"
  />
  <main>
    <div class="_container">
      <div class="main__title-block mt-[30px] xxl:mt-6 mb-[100px] xxl:mb-20 rounded-[6px]">
        <div class="_container--inter">
          <div class="main__title-block--grid lg:flex lg:flex-col items-center gap-1 pt-10 xxl:pt-7 lg:pt-5 pb-0.5 lg:mx-3">
            <div class="flex flex-col gap-7 xxl:gap-5 xl:gap-3 lg:w-[60%] sm:w-full">
              <h2 class="text-[22px] lg:text-center xxl:text-[18px] xl:text-[15px] lg:text-[19px] font-semibold leading-[125%]">Evon - универсальная площадка для агентств недвижимости, частных риэлторов и строительных компаний.</h2>
              <p class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996] lg:text-[12px] lg:text-center">Мы предлагаем удобный инструмент для эффективной и быстрой коммуникации с Застройщиками/отделами продаж на территории Турецкой республики.</p>
            </div>
            <div class="lg:hidden">
              <img src="../../assets/main/main_macbook_img.png" class="w-full" alt="Макбук">
            </div>
            <div class="flex flex-col gap-8 xxl:gap-6 xl:gap-4 mb-2 lg:w-[60%] sm:w-full">
              <img src="../../assets/main/main_chess_img.png" class="lg:hidden border border-solid border-[#E5DFEE] w-[58%] rounded-[4px]" alt="Картинка">
              <div class="flex gap-4 xxl:gap-3 w-full">
                <div class="lg:hidden h-[30px] w-[2px] xl:w-[1px] rounded-[3px] bg-[#784FB0]"></div>
                <p class="lg:text-center w-full text-sm xxl:text-xs xl:text-[10px] lg:text-[12px] text-[#8A8996]">Получи доступ к максимально полной и актуальной информации по объектам недвижимости</p>
              </div>
              <button @click="openRegister = true" class="lg:self-center register__button--white w-fit border border-solid border-[#6435A5] leading-none rounded-[3px] text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] text-[#6435A5] px-5 xxl:px-4 xl:px-3 py-2.5 xxl:py-2 xl:py-1.5">Регистрация</button>
            </div>
          </div>
        </div>
      </div>
      <div class="_container--inter">
        <h3 class="text-lg xxl:text-base xl:text-sm lg:text-[17px] font-semibold pb-8 xl:pb-5">Для риэлтора</h3>
        <div class="grid grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5 xl:gap-3 mb-[100px] xxl:mb-10">
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">Полная база новостроек побережья с контактами застройщиков и отделов продаж</span>
            <img src="../../assets/svg/main_for_rieltor_one.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 1">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">Актуальный прайс-лист по объекту</span>
            <img src="../../assets/svg/main_for_rieltor_two.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 2">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">Подробное описание объектов</span>
            <img src="../../assets/svg/main_for_rieltor_three.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 3">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">Расположение объектов на карте</span>
            <img src="../../assets/svg/main_for_rieltor_four.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 4">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">Фильтры для поиска объекта под запрос вашего клиента</span>
            <img src="../../assets/svg/main_for_rieltor_five.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 5">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">Формирование подборки под вашего клиента и отправка от вашего имени/агентства</span>
            <img src="../../assets/svg/main_for_rieltor_six.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 6">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">Актуальные новости по каждому объекту</span>
            <img src="../../assets/svg/main_for_rieltor_seven.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 7">
          </div>
          <div class="flex flex-col gap-3 justify-between items-start sm:items-center h-[190px] exl:h-fit exl:min-h-[9.9vw] border border-solid rounded-xl border-[#E5DFEE] p-7 xxl:p-5 xl:p-4">
            <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">На нашей платформе реализован чат с застройщиком/ОП</span>
            <img src="../../assets/svg/main_for_rieltor_eight.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для риэлтора 8">
          </div>
        </div>
      </div>
    </div>
    <div class="main__title-block">
      <div class="_container">
        <div class="_container--inter">
          <div class="py-[100px] xl:py-20">
            <h3 class="text-lg xxl:text-base xl:text-sm lg:text-[17px] font-semibold pb-8 xl:pb-5">Для застройщика</h3>
            <div class="grid grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5">
              <div class="flex flex-col gap-3 justify-between items-start sm:items-center bg-white h-[200px] exl:h-fit exl:min-h-[10vw] rounded-xl p-7 xxl:p-5 xl:p-4">
                <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">Платформа Evon позволит вам увеличить продажи за счет охвата огромной партнерской сети</span>
                <img src="../../assets/svg/main_for_developer_one.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для засторйщика 1">
              </div>
              <div class="flex flex-col gap-3 justify-between items-start sm:items-center bg-white h-[200px] exl:h-fit exl:min-h-[10vw] rounded-xl p-7 xxl:p-5 xl:p-4">
                <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">При добавлении вашего объекта на платформу о нем узнает большинство агентств и частных риелторов</span>
                <img src="../../assets/svg/main_for_developer_two.svg" class="h-8 xxl:h-6 xl:h-5 lg:h-6" alt="Для засторйщика 2">
              </div>
              <div class="flex flex-col gap-3 justify-between items-start sm:items-center bg-white h-[200px] exl:h-fit exl:min-h-[10vw]rounded-xl p-7 xxl:p-5 xl:p-4">
                <span class="text-base xxl:text-sm xl:text-xs lg:text-[14px] sm:text-center">Делитесь новостями со всеми партнерами в режиме реального времени. На платформе реализован чат с партнером /риелтором</span>
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
            <button @click="openRegister = true" class="text-white bg-[#6435A5] text-base xxl:text-sm xl:text-xs lg:text-[14px] leading-none rounded-[3px] px-6 xxl:px-5 xl:px-4 py-3 xxl:py-2 xl:py-1.5 my-7 xxl:my-5 xl:my-4">Зарегистрироваться</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer />
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
    }
  },
  methods: {
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
