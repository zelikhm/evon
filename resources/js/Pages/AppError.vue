<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header />
  <main>
    <div class="_container">
      <div class="flex flex-col items-center gap-7 xxl:gap-5 xl:gap-4 my-40 xxl:my-32 xl:my-28">
        <img class="w-[43vw] md:w-[54vw] sm:w-[70vw]" src="../../assets/404error.png" alt="Ошибка 404">
        <Link href="/" class="flex items-center gap-2 cursor-pointer">
          <img class="w-6 xxl:w-5 xl:w-4" src="../../assets/svg/return_icon.svg" alt="Вернуться назад">
          <span class="text-[#1E1D2D] text-[18px] xxl:text-[15px] xl:text-[13px] font-medium">На главную</span>
        </Link>
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
