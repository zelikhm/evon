<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <div class="absolute top-full -left-full transition-all duration-300 z-[80]">
    <div class="border__top-white bg-[#6435A5] py-6 h-[100vh] text-white text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[16px] flex flex-col gap-6 px-[6.25vw]">
      <div class="lg:hidden relative flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
        <button @click="openProfileMenu = !openProfileMenu" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
          <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none">Имя фамилия</span>
          <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
        </button>
        <div v-if="openProfileMenu" class="overflow-hidden lg:text-[13px] border border-solid border-[#E5DFEE] absolute z-50 top-[90%] right-0 flex flex-col bg-white rounded-[5px]">
          <div class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
            <span class="leading-none whitespace-nowrap cursor-default">ффф</span>
            <span class="leading-none whitespace-nowrap cursor-default">ыыы</span>
          </div>
          <Link href="/profile" class="hover__select border__bottom--not whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">111</Link>
          <div  @click="logout" class="hover:bg-[#F6F3FA] border__bottom--not text-[#E84680] whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">ййй</div>
        </div>
      </div>
      <Link href="/profile/houses" :class="{ 'opacity-60': $page.url !== '/profile/houses' }">Новостройки</Link>
      <Link href="/profile/news" :class="{ 'opacity-60': $page.url !== '/profile/news' }">Новости</Link>
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
