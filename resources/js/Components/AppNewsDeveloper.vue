<template>
  <div class="h-fit">
    <div class="relative z-20 border__top-6 bg-[#F6F3FA] flex items-center justify-between p-7 xxl:p-5 xl:p-4">
      <span class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] whitespace-nowrap leading-none">Новости застройщика </span>
      <img src="../../assets/svg/reload_icon.svg" class="cursor-pointer w-5 xxl:w-4 xl:w-3" alt="">
    </div>
    <div class="relative z-10 h-[1px] w-full bg-[#E5DFEE]"></div>
    <div class="overflow-hidden">
      <div class="relative custom__scroll border__bottom-6 overflow-y-auto bg-[#F6F3FA] transition-all duration-500 max-h-[90vh] p-6 xxl:p-4 xl:p-3 leading-none">
        <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">

          <div v-for="item in news">
            <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
              <div class="flex gap-3 xxl:gap-2 xl:gap-1.5">
                <div class="flex flex-col gap-1 xxl:gap-0.5">
                  <span class="font-semibold text-[13px] xxl:text-[11px] xl:text-[10px]">{{ item.house.title }}</span>
                  <span class="text-[11px] xxl:text-[9px] xl:text-[8px]">{{ new Date(Date.parse(item.created_at)).toISOString().replace(/^([^T]+)T(.+)$/,'$1').replace(/^(\d+)-(\d+)-(\d+)$/,'$3.$2.$1') }}</span>
                </div>
              </div>
              <p class="text-sm xxl:text-xs xl:text-[10px]">{{ item.title }}</p>
            </div>
            <div class="h-[1px] mt-3 w-full bg-[#E5DFEE]"></div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['adminNews', 'news'],
  data() {
    return {

    }
  }
}
</script>

<style scoped>

</style>
