<template>
  <app-modal-profile v-if="openPayProfile" @close-pay-profile="openPayProfile = false"/>
  <app-header />
  <main>
    <div class="_container">
      <div class="px-[22vw] lg:px-[10vw] md:px-[6vw] sm:px-0 relative mx-auto max-w-[826px] box-content">
        <div class="my-14 xxl:my-10 xl:my-8">
          <h2 class="text-[22px] xxl:text-lg xl:text-[15px] font-semibold pb-7 xxl:pb-5 xl:pb-4">Профиль</h2>
          <div class="relative grid grid-cols-2 sm:grid-cols-1 gap-7 xxl:gap-5 xl:gap-4">
            <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name_dev">Название застройщика</label>
              <input :value="user.first_name" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name_dev" placeholder="Название">
            </div>
            <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="tel_dev">Телефон</label>
              <div class="flex items-center">
                <input :value="user.phone" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="tel" id="tel_dev" placeholder="+7 930 245 15 20">
                <button class="text__purple text-[#6435A5] text-base xxl:text-sm xl:text-xs leading-none">Изменить</button>
              </div>
            </div>
            <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="password_dev">Пароль</label>
              <div class="flex items-center">
                <input class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="password" id="password_dev" placeholder="Введите пароль">
                <button class="text__purple text-[#6435A5] text-base xxl:text-sm xl:text-xs leading-none">Изменить</button>
              </div>
            </div>
            <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="email_dev">Почта</label>
              <input :value="user.email" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="email_dev" placeholder="Test@gmail.com">
            </div>
          </div>
          <div class="w-full rounded-[10px] bg-[#F6F3FA] mt-7 xxl:mt-5 xl:mt-4">
            <div class="flex sm:flex-col justify-between items-center p-5 xxl:p-4 xl:p-3">
              <div class="flex flex-col ml-2 xl:ml-1.5 sm:mb-3">
                <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] leading-none mb-3">Управление подпиской</span>
                <span class="text-[#8A8996] text-base xxl:text-sm xl:text-xs leading-none">Активна до: <span class="text-[#E84680]"> 20.11.2022</span></span>
              </div>
              <button @click="openPayProfile = !openPayProfile"  class="bg-[#6435A5] h-fit rounded-[6px] px-12 xxl:px-10 xl:px-8 py-3.5 xxl:py-2.5 xl:py-2">
                <span class="text-white text-base xxl:text-sm xl:text-xs leading-none">Оплатить</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppFooter from "@/Layouts/AppFooter.vue"
import AppHeader from "@/Layouts/AppHeader.vue"
import AppModalProfile from "@/Layouts/modal/AppModalProfile.vue"

export default {
  props: ['user'],
  data() {
    return {
      openPayProfile: false
    }
  },
  components: {
    AppHeader,
    AppFooter,
    AppModalProfile,
  },
  created() {
    console.log(this.user)
  }
}
</script>

<style scoped>

</style>
