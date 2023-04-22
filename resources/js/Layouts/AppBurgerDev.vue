<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <div class="absolute top-full -left-full transition-all duration-300 z-[80]">
    <div class="border__top-white bg-[#6435A5] py-6 h-[100vh] text-white text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[16px] flex flex-col gap-6 px-[6.25vw]">
      <div class="relative text-[#3B3A45] flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5">
        <button @click="openProfileMenu = !openProfileMenu" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
          <span class="text-white text-lg xxl:text-sm xl:text-xs lg:text-[16px] leading-none whitespace-nowrap">{{ user.first_name + ' ' + user.last_name }}</span>
          <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
        </button>
        <div v-if="openProfileMenu" class="border border-solid border-[#E5DFEE] lg:text-[15px] overflow-hidden z-20 absolute top-[90%] flex flex-col bg-white rounded-[5px]">
          <div class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
            <span class="leading-none whitespace-nowrap">{{ language.ob[42] }} PRO</span>
            <span class="leading-none whitespace-nowrap">{{ getDate(user.subscription_info.finished_at) }}</span>
          </div>
          <div class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
            <span class="leading-none whitespace-nowrap">{{ language.ob[32] }}</span>
            <label class="relative cursor-pointer inline-block w-[42px] xxl:w-[36px] xl:w-[30px] h-[24px] xxl:h-[20px] xl:h-[18px]">
              <input @change="$emit('target-with-client')" class="hidden" type="checkbox">
              <span class="slider round"></span>
            </label>
          </div>
          <Link href="/profile" class="hover__select border__bottom--not whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">{{ language.prof_zastr[0] }}</Link>
          <div @click="$emit('logout')" class="hover:bg-[#F6F3FA] border__bottom--not text-[#E84680] whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">{{ language.menu_zastr_1[2] }}</div>
        </div>
      </div>
      <Link href="/profile/houses" :class="{ 'opacity-60': $page.url !== '/profile/houses' }">{{ language.menu_zastr[0] }}</Link>
      <Link href="/profile/news" :class="{ 'opacity-60': $page.url !== '/profile/news' }">{{ language.menu_zastr[1] }}</Link>
    </div>
  </div>
</template>

<script>
export default {
  props: ['user', 'language'],
  data() {
    return {
      openProfileMenu: false,
    }
  },
  methods: {
    getDate(d) {

      let date = new Date();
      let finish = new Date(d);

      if (finish - date > 0) {
        var timeDiff = Math.abs(finish.getTime() - date.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        if (diffDays <= 1) {
          return diffDays + ' ' + this.language.default[2];
        } else if (diffDays > 1 && diffDays < 5) {
          return diffDays + ' ' + this.language.default[4];
        } else {
          return diffDays + ' ' + this.language.default[3];
        }
      } else {
        return '0 ' + this.language.default[3];
      }

    },
  }
}
</script>

<style scoped>

</style>
