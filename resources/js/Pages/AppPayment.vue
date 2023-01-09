<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header />
  <main>
    <div class="_container">
      <div class="flex flex-col items-center gap-10 xxl:gap-8 xl:gap-6 my-28 xxl:my-24 xl:my-20">
        <img class="w-[23.5vw] lg:w-[28vw] md:w-[34vw] sm:w-[48vw]" src="../../assets/payed_bg.png" alt="">
        <span class="text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] leading-none font-medium">Подписка закончилась</span>
        <Link href="#" class="login__btn--bg text-white text-[16px] xxl:text-[14px] xl:text-[12px] rounded-[3px] px-6 xxl:px-5 xl:px-4 py-3 xxl:py-2 xl:py-1.5 leading-none">Оплатить</Link>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"

export default {
  data() {
    return {

    }
  },
  components: {
    AppHeader,
    AppFooter,
  },
}
</script>

<style scoped>

</style>
