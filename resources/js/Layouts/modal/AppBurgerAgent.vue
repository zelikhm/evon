<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <div class="absolute top-full left-0 z-[80]">
    <div class="border__top-white bg-[#6435A5] py-3 h-[100vh] text-white text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] flex flex-col gap-3 px-[6.25vw]">
      <div class="relative text-[#3B3A45] flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5">
        <img src="../../../assets/chat_avatar.png" class="h-9 xxl:h-7 xl:h-6 lg:h-9 w-9 xxl:w-7 xl:w-6 lg:w-9 object-cover rounded-full" alt="avatar">
        <button @click="openProfileMenu = !openProfileMenu" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
          <span class="text-white text-lg xxl:text-sm xl:text-xs lg:text-[14px] leading-none whitespace-nowrap">Имя фамилия</span>
          <img src="../../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
        </button>
        <div v-if="openProfileMenu" class="border border-solid border-[#E5DFEE] absolute top-[90%] flex flex-col bg-white rounded-[5px]">
          <div class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
            <span class="leading-none whitespace-nowrap">Подписка PRO</span>
            <span class="leading-none whitespace-nowrap">6 дней</span>
          </div>
          <div class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
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
      <Link href="/houses" :class="{ 'opacity-60': $page.url !== '/houses' }" class="whitespace-nowrap leading-none">Новостройки</Link>
      <!--            <a href="#" class="opacity-60 whitespace-nowrap">Виллы</a>-->
      <Link href="/profile/compilation" :class="{ 'opacity-60': $page.url !== '/profile/compilation' }" class="whitespace-nowrap leading-none">Подборки</Link>
      <Link href="/profile/favorites" :class="{ 'opacity-60': $page.url !== '/profile/favorites' }" class="whitespace-nowrap leading-none">Избранное</Link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      openProfileMenu: false,
    }
  },
  methods: {

  }
}
</script>

<style scoped>

</style>
