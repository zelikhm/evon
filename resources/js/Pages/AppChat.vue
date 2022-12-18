<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header />
  <main class="bg-[#F6F3FA]">
    <div class="_container">
      <div class="grid__chat h-[85vh] my-14 xxl:my-10 xl:my-8">
        <div class="chat__userlist overflow-y-auto border border-solid border-[#E5DFEE] bg-white">
          <div class="p-4 xxl:p-3 xl:p-2.5">
            <div class="relative">
              <input class="bg-[#F7F7F9] focus:ring-[#6435A5] w-full pl-8 xxl:pl-7 xl:pl-6 py-2.5 xl:py-2 text-sm xxl:text-xs xl:text-[10px] rounded-[6px]" placeholder="Поиск..." type="text">
              <img src="../../assets/svg/search_icon_grey.svg" class="absolute top-1/2 left-0 translate-x-1/2 -translate-y-1/2 w-4.5 xxl:w-4 xl:w-3.5" alt="">
            </div>
          </div>
          <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
          <div class="flex items-center cursor-pointer gap-4 xxl:gap-3 xl:gap-2.5 pt-4 xxl:pt-3 xl:pt-2.5 px-4 xxl:px-3 xl:px-2.5">
            <img class="w-12 xxl:w-10 xl:w-8 rounded-full self-start" src="../../assets/chat_avatar.png" alt="">
            <div class="flex flex-col gap-1 xl:gap-0.5 w-full pb-4 xxl:pb-3 xl:pb-2.5 border__bottom--opacity">
              <div class="flex justify-between items-center">
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <span class="text-base xxl:text-sm xl:text-xs leading-none whitespace-nowrap">Олег Рыбкин</span>
                  <span class="bg-[#E84680] text-white text-[10px] xxl:text-[9px] xl:text-[8px] font-medium leading-none rounded-[3px] px-1.5 py-1 xl:px-1 py-0.5">модератор</span>
                </div>
                <div class="flex gap-1">
                  <img src="../../assets/svg/chat_check_message.svg" class="w-5 xxl:w-4 xl:w-3.5" alt="">
                  <span class="text-sm xxl:text-xs xl:text-[10px] whitespace-nowrap">25 ноября, 20:05</span>
                </div>
              </div>
              <div class="flex justify-between items-center text-sm xxl:text-xs xl:text-[10px]">
                <span class="text-[#8A8996] leading-none">Привет!</span>
                <span class="bg-[#6435A5] text-white rounded-[100px] leading-none px-1.5 xl:px-1 py-0.5">12</span>
              </div>
            </div>
          </div>
          <div class="flex items-center cursor-pointer gap-4 xxl:gap-3 xl:gap-2.5 pt-4 xxl:pt-3 xl:pt-2.5 px-4 xxl:px-3 xl:px-2.5"      >
            <img class="w-12 xxl:w-10 xl:w-8 rounded-full self-start" src="../../assets/chat_avatar.png" alt="">
            <div class="flex flex-col gap-1 xl:gap-0.5 w-full pb-4 xxl:pb-3 xl:pb-2.5 border__bottom--opacity">
              <div class="flex justify-between items-center">
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <span class="text-base xxl:text-sm xl:text-xs leading-none whitespace-nowrap">Олег Рыбкин</span>
                  <span class="bg-[#6435A5] text-white text-[10px] xxl:text-[9px] xl:text-[8px] font-medium leading-none rounded-[3px] px-1.5 py-1 xl:px-1 py-0.5">застройщик</span>
                </div>
                <div class="flex gap-1">
                  <img src="../../assets/svg/chat_check_message.svg" class="w-5 xxl:w-4 xl:w-3.5" alt="">
                  <span class="text-sm xxl:text-xs xl:text-[10px] whitespace-nowrap">25 ноября, 20:05</span>
                </div>
              </div>
              <div class="flex justify-between items-center text-sm xxl:text-xs xl:text-[10px]">
                <span class="text-[#8A8996] leading-none">Привет!</span>
                <span class="bg-[#6435A5] text-white rounded-[100px] leading-none px-1.5 xl:px-1 py-0.5">12</span>
              </div>
            </div>
          </div>
          <div class="flex items-center cursor-pointer gap-4 xxl:gap-3 xl:gap-2.5 pt-4 xxl:pt-3 xl:pt-2.5 px-4 xxl:px-3 xl:px-2.5">
            <img class="w-12 xxl:w-10 xl:w-8 rounded-full self-start" src="../../assets/chat_avatar.png" alt="">
            <div class="flex flex-col gap-1 xl:gap-0.5 w-full pb-4 xxl:pb-3 xl:pb-2.5 border__bottom--opacity">
              <div class="flex justify-between items-center">
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <span class="text-base xxl:text-sm xl:text-xs leading-none whitespace-nowrap">Олег Рыбкин</span>
                  <span class="bg-[#E87746] text-white text-[10px] xxl:text-[9px] xl:text-[8px] font-medium leading-none rounded-[3px] px-1.5 py-1 xl:px-1 py-0.5">риэлтор</span>
                </div>
                <div class="flex gap-1">
                  <img src="../../assets/svg/chat_check_grey.svg" class="w-5 xxl:w-4 xl:w-3.5" alt="">
                  <span class="text-sm xxl:text-xs xl:text-[10px] whitespace-nowrap">25 ноября, 20:05</span>
                </div>
              </div>
              <div class="flex justify-between items-center text-sm xxl:text-xs xl:text-[10px]">
                <span class="text-[#8A8996] leading-none">Привет!</span>
                <span class="bg-[#6435A5] text-white rounded-[100px] leading-none px-1.5 xl:px-1 py-0.5">12</span>
              </div>
            </div>
          </div>
        </div>
        <div class="relative chat__container overflow-y-auto flex flex-col border border-solid border-[#E5DFEE] bg-[#EDE6F6]">
          <div :class="{'chat_border__bottom--0': chatProfile}" class="absolute transition-all transition-[0.3s] rounded-[10px] p-4 xxl:p-3 xl:p-2.5 w-[380px] xxl:w-[320px] xl:w-[260px] bg-white m-8 xxl:m-6 xl:m-5 z-10 top-0 right-0">
            <div @click="chatProfile = !chatProfile" class="flex justify-between items-center cursor-pointer">
              <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
                <img class="w-12 xxl:w-10 xl:w-8 rounded-full"  src="../../assets/chat_avatar.png" alt="">
                <div class="flex flex-col gap-2 xxl:gap-1.5 xl:gap-1">
                  <span class="text-lg xxl:text-[15px] xl:text-[13px] leading-none">Антон Рыбкин</span>
                  <span class="text-sm xxl:text-[12px] xl:text-[10px] text-[#8A8996] leading-[1]">Отдел продаж</span>
                </div>
              </div>
              <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xl:w-2.5 mr-4" alt="">
            </div>
            <transition name="chat-profile">
              <div v-if="chatProfile" class="">
                <div class="chat-profile__border flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 bg-white absolute w-full top-full left-0 p-4 xxl:p-3 xl:p-2.5">
                  <div class="flex cursor-pointer items-center text-[#6536A5] bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
                    <img src="../../assets/svg/chat_tel_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                    <span class="text-center w-full text-base xxl:text-sm xl:text-xs leading-none">+7 930 245 15 20</span>
                  </div>
                  <div class="flex cursor-pointer items-center text-[#6536A5] bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
                    <img src="../../assets/svg/chat_mail_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
                    <span class="text-center w-full text-base xxl:text-sm xl:text-xs leading-none">elena@mail.ru</span>
                  </div>
                </div>
              </div>
            </transition>
          </div>
          <div class="h-full overflow-hidden chat__container--flex bg-blue">
            <div class="relative overflow__custom overflow-y-auto flex gap-5 xxl:gap-4 xl:gap-3 h-full p-7 xxl:p-5 xl:p-4 flex-col-reverse">

              <div class="flex flex-col-reverse gap-1">
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="flex items-baseline bg-white rounded-[100px] gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Четко</span>
                    <span class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[9px] leading-none">12:30</span>
                  </div>
                </div>
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="opacity-0 w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="flex items-baseline bg-white rounded-[100px] gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Все в силе?</span>
                    <span class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[9px] leading-none">12:30</span>
                  </div>
                </div>
              </div>

              <div class="my-3 xxl:my-2.5 xl:my-2 w-full flex justify-center">
                <span class="text-[#6435A5] bg__chat--date py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5 text-base xxl:text-sm xl:text-xs leading-none">Ноябрь 22</span>
              </div>

              <div class="flex flex-col-reverse gap-1">
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="relative flex items-baseline bg-[#6435A5] rounded-[100px] text-white gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Все в силе?</span>
                    <span class="text-white text-[12px] xxl:text-[10px] opacity-60 xl:text-[9px] leading-none">12:30</span>
                    <img src="../../assets/svg/chat_check_message_white.svg" class="w-5 xxl:w-4 xl:w-3.5 self-end" alt="">
                    <img src="../../assets/svg/cloud_corner.svg" class="absolute bottom-0 -left-[6.5px]" alt="">
                  </div>
                </div>
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="opacity-0 w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="relative flex items-baseline bg-[#6435A5] rounded-[100px] text-white gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Привiт! Как дела?</span>
                    <span class="text-white text-[12px] xxl:text-[10px] opacity-60 xl:text-[9px] leading-none">12:30</span>
                    <img src="../../assets/svg/chat_check_message_white.svg" class="w-5 xxl:w-4 xl:w-3.5 self-end" alt="">
                  </div>
                </div>
              </div>

              <div class="my-3 xxl:my-2.5 xl:my-2 w-full flex justify-center">
                <span class="text-[#6435A5] bg__chat--date py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5 text-base xxl:text-sm xl:text-xs leading-none">Ноябрь 21</span>
              </div>

              <div class="flex flex-col-reverse gap-1">
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="flex items-baseline bg-white rounded-[100px] gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Четко</span>
                    <span class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[9px] leading-none">12:30</span>
                  </div>
                </div>
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="opacity-0 w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="flex items-baseline bg-white rounded-[100px] gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Все в силе?</span>
                    <span class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[9px] leading-none">12:30</span>
                  </div>
                </div>
              </div>

              <div class="my-3 xxl:my-2.5 xl:my-2 w-full flex justify-center">
                <span class="text-[#6435A5] bg__chat--date py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5 text-base xxl:text-sm xl:text-xs leading-none">Ноябрь 22</span>
              </div>

              <div class="flex flex-col-reverse gap-1">
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="relative flex items-baseline bg-[#6435A5] rounded-[100px] text-white gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Все в силе?</span>
                    <span class="text-white text-[12px] xxl:text-[10px] opacity-60 xl:text-[9px] leading-none">12:30</span>
                    <img src="../../assets/svg/chat_check_message_white.svg" class="w-5 xxl:w-4 xl:w-3.5 self-end" alt="">
                    <img src="../../assets/svg/cloud_corner.svg" class="absolute bottom-0 -left-[6.5px]" alt="">
                  </div>
                </div>
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="opacity-0 w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="relative flex items-baseline bg-[#6435A5] rounded-[100px] text-white gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Привiт! Как дела?</span>
                    <span class="text-white text-[12px] xxl:text-[10px] opacity-60 xl:text-[9px] leading-none">12:30</span>
                    <img src="../../assets/svg/chat_check_message_white.svg" class="w-5 xxl:w-4 xl:w-3.5 self-end" alt="">
                  </div>
                </div>
              </div>

              <div class="my-3 xxl:my-2.5 xl:my-2 w-full flex justify-center">
                <span class="text-[#6435A5] bg__chat--date py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5 text-base xxl:text-sm xl:text-xs leading-none">Ноябрь 21</span>
              </div>

              <div class="flex flex-col-reverse gap-1">
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="flex items-baseline bg-white rounded-[100px] gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Четко</span>
                    <span class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[9px] leading-none">12:30</span>
                  </div>
                </div>
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="opacity-0 w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="flex items-baseline bg-white rounded-[100px] gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Все в силе?</span>
                    <span class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[9px] leading-none">12:30</span>
                  </div>
                </div>
              </div>

              <div class="my-3 xxl:my-2.5 xl:my-2 w-full flex justify-center">
                <span class="text-[#6435A5] bg__chat--date py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5 text-base xxl:text-sm xl:text-xs leading-none">Ноябрь 22</span>
              </div>

              <div class="flex flex-col-reverse gap-1">
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="relative flex items-baseline bg-[#6435A5] rounded-[100px] text-white gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Все в силе?</span>
                    <span class="text-white text-[12px] xxl:text-[10px] opacity-60 xl:text-[9px] leading-none">12:30</span>
                    <img src="../../assets/svg/chat_check_message_white.svg" class="w-5 xxl:w-4 xl:w-3.5 self-end" alt="">
                    <img src="../../assets/svg/cloud_corner.svg" class="absolute bottom-0 -left-[6.5px]" alt="">
                  </div>
                </div>
                <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                  <img src="../../assets/chat_avatar.png" class="opacity-0 w-8 xxl:w-7 xl:w-6" alt="">
                  <div class="relative flex items-baseline bg-[#6435A5] rounded-[100px] text-white gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                    <span class="text-base xxl:text-sm xl:text-xs leading-none">Привiт! Как дела?</span>
                    <span class="text-white text-[12px] xxl:text-[10px] opacity-60 xl:text-[9px] leading-none">12:30</span>
                    <img src="../../assets/svg/chat_check_message_white.svg" class="w-5 xxl:w-4 xl:w-3.5 self-end" alt="">
                  </div>
                </div>
              </div>

              <div class="my-3 xxl:my-2.5 xl:my-2 w-full flex justify-center">
                <span class="text-[#6435A5] bg__chat--date py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5 text-base xxl:text-sm xl:text-xs leading-none">Ноябрь 21</span>
              </div>

            </div>
          </div>
          <div class=" bg-white h-[72px] xxl:h-[60px] xxl:h-[50px] flex items-center px-7 xxl:px-5 xl:px-4 py-5 xxl:py-4 xl:py-3">
            <input placeholder="Написать сообщение..." type="text" class="focus:ring-0 w-full text-lg xxl:text-[15px] xl:text-[13px] leading-none">
            <button>
              <img src="../../assets/svg/chat_arrow_message.svg" class="w-9 xxl:w-7 xl:w-6" alt="">
            </button>
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

export default {
  data() {
    return {
      chatProfile: false,
    }
  },
  methods: {

  },
  components: {
    AppHeader,
    AppFooter,
  }
}
</script>

<style scoped>

.chat-profile-enter-from {
  opacity: 0;
  transition: all 0.3s;
}

.chat-profile-enter-to {
  opacity: 1;
  transition: all 0.3s;
}

.chat-profile-leave-from {
  opacity: 1;
  transition: all 0.3s;
}

.chat-profile-leave-to {
  opacity: 0;
  transition: all 0.3s;
}
</style>
