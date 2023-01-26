<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
<!--  Меню до входа-->
  <header v-if="user === null" class="relative z-50 bg-[#6435A5] leading-[100%]">
    <div class="_container h-[60px] xxl:h-12 xl:h-10">
      <div class="flex items-center justify-between h-full ">
        <Link href="/" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
          <img src="../../assets/svg/header_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Логотип">
          <span class="sm:hidden uppercase text-white text-lg xxl:text-sm xl:text-xs font-semibold">Evon</span>
        </Link>
        <div class="flex items-center gap-7 xxl:gap-5 lg:gap-2 text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[14px]">
          <div class="header__lang--select uppercase relative flex items-center h-[60px] xxl:h-12 xl:h-10">
            <div class="flex h-full text-white items-center cursor-pointer px-7 xxl:px-5 xl:px-4 gap-2.5 xl:gap-1.5" @click="langOptionVisible = !langOptionVisible">
              <span>{{ langSelected }}</span>
              <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелочка вниз">
            </div>
            <div v-if="langOptionVisible" class="border border-solid border-[#E5DFEE] absolute top-[90%] w-full left-0 flex flex-col bg-white rounded-[5px]">
              <span
                @click="selectOption(language)"
                v-for="(language, idx) in languages" :key="idx"
                class="hover__select border__bottom--not cursor-pointer leading-none p-4 xxl:p-3 xl:p-2.5"
              >
                  {{ language.lang }}
                </span>
            </div>
          </div>
          <div class="flex gap-3 xxl:gap-2 font-medium">
            <div class="relative text-[#3B3A45]">
              <button @click="loginOpen = !loginOpen" class="login__btn--bg text-white px-5 xxl:px-4 xl:px-3 py-2.5 xxl:py-2 xl:py-1 rounded-[3px]">Вход</button>
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
  <header v-if="user !== null && user.role === 0" class="relative z-50 bg-[#6435A5] leading-[100%]">
    <div class="_container h-[60px] xxl:h-12 xl:h-10">
      <div class="flex items-center justify-between h-full ">
        <div class="flex gap-20 xxl:gap-16 xl:gap-12 items-center">
          <Link href="/" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <img src="../../assets/svg/header_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Логотип">
            <span class="uppercase text-white text-lg xxl:text-sm xl:text-xs font-semibold">Evon</span>
          </Link>
          <div class="text-white text-[16px] xxl:text-[13px] xl:text-[11px] flex gap-20 xxl:gap-16 xl:gap-12">
            <Link href="/houses" :class="{ 'opacity-60': $page.url !== '/houses' }">Новостройки</Link>
<!--            <a href="#" class="opacity-60">Виллы</a>-->
            <Link href="/profile/compilation" :class="{ 'opacity-60': $page.url !== '/profile/compilation' }">Подборки</Link>
            <Link href="/profile/favorites" :class="{ 'opacity-60': $page.url !== '/profile/favorites' }">Избранное</Link>
          </div>
        </div>
        <div class="flex items-center gap-7 xxl:gap-5 text-[16px] xxl:text-[13px] xl:text-[11px]">
          <button>
            <img src="../../assets/svg/search_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Поиск">
          </button>
          <div class="flex">
            <div class="header__chat cursor-pointer flex items-center justify-center h-[60px] xxl:h-12 xl:h-10 px-8 xxl:px-6 xl:px-5">
              <div class="relative">
                <img src="../../assets/svg/chat_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Чат">
                <div class="absolute flex items-center justify-center -top-[30%] -right-[50%] rounded-full bg-[#E84680] h-3.5 xxl:h-3 xl:h-2.5 w-3.5 xxl:w-3 xl:w-2.5">
                  <span class="text-white text-[12px] xxl:text-[10px] xl:text-[8px]">3</span>
                </div>
              </div>
            </div>
            <div class="header__lang--select uppercase relative flex items-center h-[60px] xxl:h-12 xl:h-10">
              <div class="flex h-full text-white items-center cursor-pointer px-7 xxl:px-5 xl:px-4 gap-2.5 xl:gap-1.5" @click="langOptionVisible = !langOptionVisible">
                <span>{{ langSelected }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелочка вниз">
              </div>
              <div v-if="langOptionVisible" class="border border-solid border-[#E5DFEE] absolute top-[90%] w-full left-0 flex flex-col bg-white rounded-[5px]">
              <span
                @click="selectOption(language)"
                v-for="(language, idx) in languages" :key="idx"
                class="hover__select border__bottom--not cursor-pointer leading-none p-4 xxl:p-3 xl:p-2.5"
              >
                  {{ language.lang }}
                </span>
              </div>
            </div>
            <div class="flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
              <img :src="'/storage/user/' + user.image" class="h-9 xxl:h-7 xl:h-6 w-9 xxl:w-7 xl:w-6 rounded-full" alt="avatar">
              <button @click="openProfileMenu = !openProfileMenu" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none">{{ user.first_name + ' ' + user.last_name }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </button>
              <div v-if="openProfileMenu" class="border border-solid border-[#E5DFEE] absolute top-[90%] flex flex-col bg-white rounded-[5px]">
                <div class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap">Подписка PRO</span>
                  <span class="leading-none whitespace-nowrap">6 дней</span>
                </div>
                <div v-if="user.role === 0" class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap">Я с клиентом</span>
                  <label class="relative cursor-pointer inline-block w-[42px] xxl:w-[36px] xl:w-[30px] h-[24px] xxl:h-[20px] xl:h-[18px]">
                    <input class="hidden" type="checkbox">
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
  <header v-if="user !== null && user.role === 1 || user !== null && user.role === 2 || user !== null && user.role === 3" class="relative z-50 bg-[#6435A5] leading-[100%]">
    <div class="_container h-[60px] xxl:h-12 xl:h-10">
      <div class="flex items-center justify-between h-full ">
        <div class="flex gap-20 xxl:gap-16 xl:gap-12 lg:gap-2 items-center">
          <div @click="openBurgerSmall" class="hidden lg:flex relative flex-col justify-evenly py-0.5 items-center cursor-pointer h-6 w-6 rounded-[5px] bg-[#6435A5]">
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
          </div>
          <Link href="/" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <img src="../../assets/svg/header_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Логотип">
            <span class="sm:hidden uppercase text-white text-lg xxl:text-sm xl:text-xs font-semibold">Evon</span>
          </Link>
          <div :class="{'left__0': openBurgerSm }" class="transition-all duration-300 lg:-left-full lg:absolute lg:flex-col lg:h-[100vh] lg:top-10 border__top-white lg:px-[6.25vw] lg:py-2 lg:bg-[#6435A5] text-white text-[16px] xxl:text-[13px] xl:text-[11px] flex gap-20 xxl:gap-16 xl:gap-12 lg:gap-2">
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
            <div class="header__lang--select uppercase relative flex items-center h-[60px] xxl:h-12 xl:h-10">
              <div class="flex h-full text-white items-center cursor-pointer px-7 xxl:px-5 xl:px-4 gap-2.5 xl:gap-1.5" @click="langOptionVisible = !langOptionVisible">
                <span>{{ langSelected }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелочка вниз">
              </div>
              <div v-if="langOptionVisible" class="border border-solid border-[#E5DFEE] absolute top-[90%] w-full left-0 flex flex-col bg-white rounded-[5px]">
                <span
                  @click="selectOption(language)"
                  v-for="(language, idx) in languages" :key="idx"
                  class="hover__select border__bottom--not cursor-pointer leading-none p-4 xxl:p-3 xl:p-2.5"
                >
                  {{ language.lang }}
                </span>
              </div>
            </div>
            <div class="relative flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
              <button @click="openProfileMenu = !openProfileMenu" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none">{{ user.first_name }} {{ user.last_name }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </button>
              <div v-if="openProfileMenu" class="border border-solid border-[#E5DFEE] absolute top-[90%] right-0 flex flex-col bg-white rounded-[5px]">
                <div class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap">Подписка PRO</span>
                  <span class="leading-none whitespace-nowrap">6 дней</span>
                </div>
                <div v-if="user.role === 0" class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap">Я с клиентом</span>
                  <label class="relative cursor-pointer inline-block w-[42px] xxl:w-[36px] xl:w-[30px] h-[24px] xxl:h-[20px] xl:h-[18px]">
                    <input class="hidden" type="checkbox">
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
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'

export default {
  props: {
    heightMain: Number,
    user: []
  },
  data() {
    return {
      languages: [
        { id: 0, lang: 'ru' },
        { id: 1, lang: 'en' },
        { id: 2, lang: 'tr' },
      ],
      langOptionVisible: false,
      langSelected: 'ru',
      loginOpen: false,
      openProfileMenu: false,
      openBurgerSm: false
    }
  },
  emits: ['login-realtor', 'login-developer', 'open-register'],
  methods: {
    openBurgerSmall() {
      this.openBurgerSm = !this.openBurgerSm
    },
    logout() {
      const form = useForm({});
      form.post('/logout');
    },
    selectOption(language) {
      this.langSelected =  language.lang
      this.langOptionVisible = false
    },
    loginRealtor() {
      this.$emit('login-realtor')
      this.loginOpen = false
    },
    loginDeveloper() {
      this.$emit('login-developer')
      this.loginOpen = false
    },
    selectsHidden() {
      this.langOptionVisible = false
      this.loginOpen = false
      this.openProfileMenu = false
    }
  },
  created() {
    console.log(this.user)
  },
  mounted() {
    document.addEventListener('click', this.selectsHidden.bind(this), true)
  },
  beforeDestroy() {
    document.removeEventListener('click', this.selectsHidden)
  }
}
</script>

<style>

</style>
