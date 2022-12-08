<template>

<!--  Меню до входа-->
  <header class="relative z-50 bg-[#6435A5] leading-[100%]">
    <div class="_container h-[60px] xxl:h-12 xl:h-10">
      <div class="flex items-center justify-between h-full ">
        <div class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
          <img src="../../assets/svg/header_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Логотип">
          <span class="uppercase text-white text-lg xxl:text-sm xl:text-xs font-semibold">Evon.com</span>
        </div>
        <div class="flex items-center gap-7 xxl:gap-5 text-[16px] xxl:text-[13px] xl:text-[11px]">
          <div class="header__lang--select text-white uppercase relative flex items-center h-[60px] xxl:h-12 xl:h-10">
            <div class="flex h-full items-center cursor-pointer px-7 xxl:px-5 xl:px-4 gap-2.5 xl:gap-1.5" @click="langOptionVisible = !langOptionVisible">
              <span>{{ langSelected }}</span>
              <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелочка вниз">
            </div>
            <div v-if="langOptionVisible" class="absolute top-full w-full left-0 flex flex-col bg-[#6435A5]">
              <span
                @click="selectOption(language)"
                v-for="(language, idx) in languages" :key="idx"
                class="header__lang--change cursor-pointer h-[60px] xxl:h-12 flex items-center justify-center"
              >
                  {{ language.lang }}
                </span>
            </div>
          </div>
          <div class="flex gap-3 xxl:gap-2 font-medium">
            <div class="relative text-[#3B3A45]">
              <button @click="loginOpen = !loginOpen" class="login__btn--bg text-white px-5 xxl:px-4 xl:px-3 py-2.5 xxl:py-2 xl:py-1 rounded-[3px]">Вход</button>
              <div v-if="loginOpen" class="login__dropdown absolute top-[120%] flex flex-col items-start bg-white rounded-[6px]">
                <button @click="loginDeveloper" class="whitespace-nowrap leading-none px-3.5 py-2.5">Я застройщик</button>
                <button @click="loginRealtor" class="whitespace-nowrap leading-none px-3.5 py-2.5">Я риэлтор</button>
              </div>
            </div>
            <button class="register__button--bg text-white px-5 xxl:px-4 xl:px-3 py-2.5 xxl:py-2 xl:py-1 rounded-[3px]">Регистрация</button>
          </div>
        </div>
      </div>
    </div>
  </header>

<!-- Меню Общее-->
  <header v-if="1 !== 1" class="relative z-50 bg-[#6435A5] leading-[100%]">
    <div class="_container h-[60px] xxl:h-12 xl:h-10">
      <div class="flex items-center justify-between h-full ">
        <div class="flex gap-20 xxl:gap-16 xl:gap-12 items-center">
          <div class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <img src="../../assets/svg/header_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Логотип">
            <span class="uppercase text-white text-lg xxl:text-sm xl:text-xs font-semibold">Evon.com</span>
          </div>
          <div class="text-white text-[16px] xxl:text-[13px] xl:text-[11px] flex gap-20 xxl:gap-16 xl:gap-12">
            <a href="#" class="">Новостройки</a>
            <a href="#" class="opacity-60">Виллы</a>
            <a href="#" class="opacity-60">Подборки</a>
            <a href="#" class="opacity-60">Избранное</a>
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
            <div class="header__lang--select text-white uppercase relative flex items-center h-[60px] xxl:h-12 xl:h-10">
              <div class="flex h-full items-center cursor-pointer px-7 xxl:px-5 xl:px-4 gap-2.5 xl:gap-1.5" @click="langOptionVisible = !langOptionVisible">
                <span>{{ langSelected }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </div>
              <div v-if="langOptionVisible" class="absolute top-full w-full left-0 flex flex-col bg-[#6435A5]">
                <span
                  @click="selectOption(language)"
                  v-for="(language, idx) in languages" :key="idx"
                  class="header__lang--change cursor-pointer h-[60px] xxl:h-12 flex items-center justify-center"
                >
                  {{ language.lang }}
                </span>
              </div>
            </div>
            <div class="flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
              <img src="../../assets/header_user_photo.png" class="h-9 xxl:h-7 xl:h-6" alt="Фотография пользователя">
              <button class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none">Ольга Рыбкина</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Меню Застройщик-->
  <header v-if="1 != 1"  class="relative z-50 bg-[#6435A5] leading-[100%]">
    <div class="_container h-[60px] xxl:h-12 xl:h-10">
      <div class="flex items-center justify-between h-full ">
        <div class="flex gap-20 xxl:gap-16 xl:gap-12 items-center">
          <div class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <img src="../../assets/svg/header_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Логотип">
            <span class="uppercase text-white text-lg xxl:text-sm xl:text-xs font-semibold">Evon.com</span>
          </div>
          <div class="text-white text-[16px] xxl:text-[13px] xl:text-[11px] flex gap-20 xxl:gap-16 xl:gap-12">
            <a href="#" class="">Объекты</a>
            <a href="#" class="">Новости</a>
          </div>
        </div>
        <div class="flex items-center gap-7 xxl:gap-5 text-[16px] xxl:text-[13px] xl:text-[11px]">
          <div class="flex">
            <div class="cursor-pointer flex items-center justify-center h-[60px] xxl:h-12 xl:h-10 px-8 xxl:px-6 xl:px-5">
              <div class="relative">
                <img src="../../assets/svg/chat_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Чат">
                <div class="absolute flex items-center justify-center -top-[30%] -right-[50%] rounded-full bg-[#E84680] h-3.5 xxl:h-3 xl:h-2.5 w-3.5 xxl:w-3 xl:w-2.5">
                  <span class="text-white text-[12px] xxl:text-[10px] xl:text-[8px]">3</span>
                </div>
              </div>
            </div>
            <div class="header__lang--select text-white uppercase relative flex items-center h-[60px] xxl:h-12 xl:h-10">
              <div class="flex h-full items-center cursor-pointer px-7 xxl:px-5 xl:px-4 gap-2.5 xl:gap-1.5" @click="langOptionVisible = !langOptionVisible">
                <span>{{ langSelected }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </div>
              <div v-if="langOptionVisible" class="absolute top-full w-full left-0 flex flex-col bg-[#6435A5]">
                <span
                  @click="selectOption(language)"
                  v-for="(language, idx) in languages" :key="idx"
                  class="header__lang--change cursor-pointer h-[60px] xxl:h-12 flex items-center justify-center"
                >
                  {{ language.lang }}
                </span>
              </div>
            </div>
            <div class="flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
              <img src="../../assets/header_user_photo.png" class="h-9 xxl:h-7 xl:h-6" alt="Фотография пользователя">
              <button class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none">Ольга Рыбкина</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  data() {
    return {
      languages: [
        {lang: 'ru', value: 1},
        {lang: 'en', value: 2},
        {lang: 'tr', value: 3},
      ],
      langOptionVisible: false,
      langSelected: 'ru',
      loginOpen: false,
    }
  },
  emits: ['login-realtor', 'login-developer'],
  methods: {
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
    }
  }
}
</script>

<style>

</style>
