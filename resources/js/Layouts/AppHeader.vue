<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ChangeLanguage from "@/Components/ChangeLanguage.vue";
</script>

<template>
  <div v-if="overlaySelect" @click="closeOverlaySelect" class="absolute h-full w-full z-40"></div>
<!--  Меню до входа-->
  <header v-if="user === null" class="relative bg-[#6435A5] leading-[100%]">
    <div class="_container h-[60px] xxl:h-12 xl:h-10">
      <div class="flex items-center justify-between h-full ">
        <Link href="/" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
          <img src="../../assets/svg/header_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Логотип">
          <span class="sm:hidden uppercase text-white text-lg xxl:text-sm xl:text-xs font-semibold">Evon</span>
        </Link>
        <div class="flex items-center gap-7 xxl:gap-5 lg:gap-2 text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[14px]">
          <change-language />
          <div class="flex gap-3 xxl:gap-2 font-medium">
            <div class="relative text-[#3B3A45] z-50">
              <button @click="loginOpens" class="login login__btn--bg text-white px-5 xxl:px-4 xl:px-3 py-2.5 xxl:py-2 xl:py-1 rounded-[3px]">Вход</button>
              <div v-if="loginOpen" class="login__dropdown absolute overflow-hidden top-[120%] flex flex-col items-start bg-white rounded-[6px]">
                <button @click="loginDeveloper" class="hover__select whitespace-nowrap leading-none px-3.5 py-2.5 w-full">Я застройщик</button>
                <button @click="loginRealtor" class="hover__select whitespace-nowrap leading-none text-left px-3.5 py-2.5 w-full">Я риэлтор</button>
              </div>
            </div>
            <button @click="$emit('open-register')" class="register__button--bg text-white px-5 xxl:px-4 xl:px-3 py-2.5 xxl:py-2 xl:py-1 rounded-[3px]">Регистрация</button>
          </div>
        </div>
      </div>
    </div>
  </header>

<!-- Меню агента -->
  <header v-if="user !== null && user.role === 0" class="relative bg-[#6435A5] leading-[100%]">

    <app-burger-agent :tabindex="tabindex" @blur="openBurgerAgent = false" :class="{'left__0': openBurgerAgent }" />

    <div class="_container h-[60px] xxl:h-12 xl:h-10 lg:h-12">
      <div class="flex items-center justify-between h-full ">
        <div class="flex gap-20 xxl:gap-16 xl:gap-12 lg:gap-2 items-center">
          <div @click="openBurgerAgent = !openBurgerAgent" class="hidden lg:flex relative flex-col justify-evenly py-0.5 items-center cursor-pointer h-8 w-8 rounded-[5px] bg-[#6435A5]">
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
          </div>
          <Link href="/" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <img src="../../assets/svg/header_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Логотип">
            <span class="lg:hidden uppercase text-white text-lg xxl:text-sm xl:text-xs lg:text-sm font-semibold">Evon</span>
          </Link>
          <div class="lg:hidden text-white text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[15px] flex gap-20 xxl:gap-16 xl:gap-12 x:gap-10">
            <Link href="/houses" :class="{ 'opacity-60': $page.url !== '/houses' }" class="whitespace-nowrap">Новостройки</Link>
            <a href="#" class="opacity-60 whitespace-nowrap">Виллы</a>
            <Link href="/profile/compilation" :class="{ 'opacity-60': $page.url !== '/profile/compilation' }" class="whitespace-nowrap">Подборки</Link>
            <Link href="/profile/favorites" :class="{ 'opacity-60': $page.url !== '/profile/favorites' }" class="whitespace-nowrap">Избранное</Link>
          </div>
        </div>
        <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[15px]">
          <div class="relative hover__search">
            <input @keydown.enter="startSearch" v-model="search" class="text-white focus:ring-white pr-14 xxl:pr-10 xl:pr-8 lg:pr-6 pl-4 xxl:pl-3 xl:pl-2.5 lg:pl-1.5 text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none bg-[#6435A5] h-12 xxl:h-10 xl:h-8 w-[380px] exl:w-[18vw] lg:w-[160px] sm:w-[100px] rounded-[5px]" type="text" >
            <img @click="startSearch" src="../../assets/svg/search_icon.svg" class="cursor-pointer absolute top-1/2 -translate-y-1/2 right-3 exl:right-[1vw] h-6 xxl:h-5 xl:h-4" alt="Поиск">
          </div>
          <div class="flex">
            <div class="header__chat cursor-pointer flex items-center justify-center h-[60px] lg:h-12 xxl:h-12 xl:h-10 px-8 xxl:px-6 xl:px-5 lg:px-4">
              <div class="relative">
                <img src="../../assets/svg/chat_icon.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Чат">
                <div class="absolute flex items-center justify-center -top-[30%] -right-[50%] rounded-full bg-[#E84680] h-3.5 xxl:h-3 xl:h-2.5 lg:h-3.5 w-3.5 xxl:w-3 xl:w-2.5 lg:w-3.5">
                  <span class="text-white text-[12px] xxl:text-[10px] xl:text-[8px] lg:text-[11px]">3</span>
                </div>
              </div>
            </div>
            <change-language />
            <div class="lg:hidden flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
              <button @click="openProfile" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none whitespace-nowrap">{{ user.first_name + ' ' + user.last_name }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </button>
              <div v-if="openProfileMenu" class="overflow-hidden border border-solid border-[#E5DFEE] absolute z-50 top-[90%] flex flex-col bg-white rounded-[5px]">
                <div class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap">Подписка PRO</span>
                  <span class="leading-none whitespace-nowrap">6 дней</span>
                </div>
                <div v-if="user.role === 0" class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap">Я с клиентом</span>
                  <label class="relative cursor-pointer inline-block w-[42px] xxl:w-[36px] xl:w-[30px] h-[24px] xxl:h-[20px] xl:h-[18px]">
                    <input v-model="withClient" @change="targetWithClient" class="hidden" type="checkbox">
                    <span class="slider round"></span>
                  </label>
                </div>
                <Link href="/profile" class="hover__select border__bottom--not whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">Профиль</Link>
                <div @click="logout" class="hover:bg-[#F6F3FA] border__bottom--not text-[#E84680] whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">Выйти</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Меню Застройщик-->
<!--  v-if="user.role === 1" -->
  <header v-if="user !== null && user.role === 1 || user !== null && user.role === 2 || user !== null && user.role === 3" class="relative bg-[#6435A5] leading-[100%]">
    <div class="_container h-[60px] xxl:h-12 xl:h-10">
      <div class="flex items-center justify-between h-full ">
        <div class="flex gap-20 xxl:gap-16 xl:gap-12 lg:gap-2 items-center">
          <div class="hidden lg:flex relative flex-col justify-evenly py-0.5 items-center cursor-pointer h-6 w-6 rounded-[5px] bg-[#6435A5]">
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
          </div>
          <Link href="/" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <img src="../../assets/svg/header_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Логотип">
            <span class="sm:hidden uppercase text-white text-lg xxl:text-sm xl:text-xs font-semibold">Evon</span>
          </Link>
          <div class="text-white text-[16px] xxl:text-[13px] xl:text-[11px] flex gap-20 xxl:gap-16 xl:gap-12 x:gap-10">
            <Link href="/profile/houses" :class="{ 'opacity-60': $page.url !== '/profile/houses' }">Объекты</Link>
            <Link href="/profile/news" :class="{ 'opacity-60': $page.url !== '/profile/news' }">Новости</Link>
          </div>
        </div>
        <div class="flex items-center gap-7 xxl:gap-5 text-[16px] xxl:text-[13px] xl:text-[11px]">
          <div class="flex">
            <Link href="" class="cursor-pointer flex items-center justify-center h-[60px] xxl:h-12 xl:h-10 px-8 xxl:px-6 xl:px-5">
              <div class="relative">
                <img src="../../assets/svg/chat_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Чат">
                <div class="absolute flex items-center justify-center -top-[30%] -right-[50%] rounded-full bg-[#E84680] h-3.5 xxl:h-3 xl:h-2.5 w-3.5 xxl:w-3 xl:w-2.5">
                  <span class="text-white text-[12px] xxl:text-[10px] xl:text-[8px]">3</span>
                </div>
              </div>
            </Link>
            <change-language />
            <div class="relative flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
              <button @click="openProfile" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none">{{ user.first_name === 'null' ? '-' : user.first_name }} {{ user.last_name === 'null' ? '-' : user.last_name }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </button>
              <div v-if="openProfileMenu" class="overflow-hidden lg:text-[13px] border border-solid border-[#E5DFEE] absolute z-50 top-[90%] right-0 flex flex-col bg-white rounded-[5px]">
                <div class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap">Подписка PRO</span>
                  <span class="leading-none whitespace-nowrap">6 дней</span>
                </div>
                <Link href="/profile" class="hover__select border__bottom--not whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">Профиль</Link>
                <div @click="logout" class="hover:bg-[#F6F3FA] border__bottom--not text-[#E84680] whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">Выйти</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import AppBurgerAgent from "@/Layouts/AppBurgerAgent.vue"
import { useForm } from '@inertiajs/inertia-vue3'

export default {
  props: {
    heightMain: Number,
    user: [],
    tabindex: {
      type: Number,
      required: false,
      default: 0,
    },
  },
  data() {
    return {
      loginOpen: false,
      openProfileMenu: false,
      openBurgerAgent: false,
      overlaySelect: false,
      withClient: false,
      search: null,
    }
  },
  emits: ['login-realtor', 'login-developer', 'open-register'],
  methods: {
    startSearch() {
      localStorage.setItem('searchData', this.search)
      window.location.href = '/houses#search'
      if (window.location.href.split('#').at(-1) === 'search') {
        location.reload()
      }
    },
    openProfile() {
      this.openProfileMenu = !this.openProfileMenu
      this.overlaySelect = !this.overlaySelect
    },
    loginOpens() {
      this.loginOpen = !this.loginOpen
      this.overlaySelect = !this.overlaySelect
    },
    closeOverlaySelect() {
      this.overlaySelect = false

      this.loginOpen = false
      this.openProfileMenu = false
    },
    logout() {
      const form = useForm({});
      form.post('/logout');
    },
    selectOption(language) {
      this.langSelected =  language
      localStorage.setItem('language', language)
      this.overlaySelect = false
    },
    loginRealtor() {
      this.$emit('login-realtor')
      this.loginOpen = false
      this.overlaySelect = false
    },
    loginDeveloper() {
      this.$emit('login-developer')
      this.loginOpen = false
      this.overlaySelect = false
    },
    targetWithClient() {
      localStorage.setItem('withClient', this.withClient)
      this.$emit('update-block-client', this.withClient)
    }
  },
  created() {
    this.withClient = localStorage.getItem('withClient') === 'true' ? true : false
  },
  components: {
    AppBurgerAgent
  }
}
</script>

<style>

</style>
