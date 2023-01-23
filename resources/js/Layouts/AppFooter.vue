<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <footer class="footer">
    <div class="_container text-lg xxl:text-[15px] xl:text-xs lg:text-[15px]">
      <div class="footer__border-b flex justify-between pt-14 xxl:pt-10 xl:pt-8 pb-10 xxl:pb-8 xl:pb-6">
        <Link href="/" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
          <img src="../../assets/svg/fotter_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Логотип">
          <span class="sm:hidden uppercase text-[#6435A5] font-semibold">Evon.com</span>
        </Link>
        <div class="flex gap-12 xxl:gap-10 xl:gap-8 text-[#3B3A45]">
          <span>7 930 245 15 20</span>
          <span>evon.information@gmail.com</span>
        </div>
      </div>
      <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 text-[#3B3A45] opacity-50 pb-14 xxl:pb-10 xl:pb-8 pt-10 xxl:pt-8 xl:pt-6">
        <div class="flex justify-between">
          <Link href="/privacy" class="underline">Политика</Link>
          <span>2022. Tüm Hakları Saklıdır</span>
        </div>
        <div class="grid grid-cols-3 lg:flex lg:flex-col items-center lg:gap-2">
          <div>Не является публичной офертой</div>
          <div class="flex justify-center lg:flex-col gap-12 xxl:gap-10 xl:gap-8 lg:gap-2 text-sm xxl:text-xs xl:text-[10px] lg:text-[12px]">
            <span class="whitespace-nowrap">VERGİ NO 3830916930</span>
            <span class="whitespace-nowrap">ОГРН 215125125125125</span>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>

export default {
  data() {
    return {

    }
  }
}

</script>

<style>

</style>
