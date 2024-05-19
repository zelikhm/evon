<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <footer class="footer">
    <div class="_container text-lg xxl:text-[15px] xl:text-xs lg:text-[15px]">
      <div class="footer__border-b flex justify-between sm:flex-col sm:gap-5 pt-14 xxl:pt-10 xl:pt-8 pb-10 xxl:pb-8 xl:pb-6">
        <Link href="/" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
          <img src="../../assets/svg/fotter_logo_icon.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Логотип">
        </Link>
        <div class="flex gap-12 xxl:gap-10 xl:gap-8 text-[#3B3A45]">
          <a href="mailto:evon.information@gmail.com">evon.information@gmail.com</a>
        </div>
      </div>
      <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 text-[#3B3A45] opacity-50 pb-14 xxl:pb-10 xl:pb-8 pt-10 xxl:pt-8 xl:pt-6">
        <div class="flex justify-between sm:flex-col sm:gap-2.5 sm:items-center">
          <div class="sm:flex sm:flex-col sm:gap-2.5 sm:items-center">
            <a target="_blank" href="/privacy" class="underline mr-5">{{ language?.po_v_r[7] }}</a>
            <a target="_blank" href="/agree" class="underline">Kullanıcı Sözleşmesi</a>
          </div>
          <span>{{ new Date().getFullYear() }}. {{ language?.footer[3] }}</span>
        </div>
        <div class="grid grid-cols-3 lg:flex lg:flex-col items-center lg:gap-2">
          <div>{{ language?.footer[2] }}</div>
          <div class="flex justify-center lg:flex-col gap-12 xxl:gap-10 xl:gap-8 lg:gap-2 text-sm xxl:text-xs xl:text-[10px] lg:text-[12px]">
            <span class="whitespace-nowrap">ООО "ЕВОН"</span>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>

export default {
  props:['language'],
  data() {
    return {
      isMain: false
    }
  },
  created() {
    console.log()
  }
}

</script>

<style>

</style>
