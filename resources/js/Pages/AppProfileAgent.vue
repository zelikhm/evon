<template>
  <app-header />
  <main class="relative">
    <div class="_container">
      <div class="my-14 xxl:my-12 xl:my-10">
        <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] leading-none">Редактировать профиль</h2>
        <div class="mt-10 xxl:mt-8 xl:mt-6">
          <div class="grid__prof-agent gap-7 xxl:gap-5 xl:gap-4">
            <div class="flex flex-col gap-12 xxl:gap-10 xl:gap-8">
              <div class="relative w-[13.28vw] h-[13.28vw] rounded-full">
                <img v-if="avatar" class="absolute w-full h-full rounded-full" :src="myPhoto" alt="">
                <div class="avatar__contact w-full h-full rounded-full">
                  <div class="absolute rounded-full w-full h-full top-0 left-0">
                    <label for="avatar" :class="{'-z-10': avatar}" class="relative cursor-pointer flex items-center justify-center w-full h-full rounded-full">
                      <img src="../../assets/svg/upload_photo.svg" class="w-12 xxl:w-10 xl:w-8" alt="">
                    </label>
                    <input class="w-full h-full rounded-full opacity-0 absolute top-0 left-0 pointer-events-none" id="avatar" type="file" ref="file" @change="avatarContact">
                    <label class="h-12 xxl:h-10 xl:h-8 w-12 xxl:w-10 xl:w-8 cursor-pointer bg-[#6435A5] flex justify-center items-center rounded-full absolute bottom-0 left-1/2 translate-y-1/2 -translate-x-1/2" for="avatar">
                      <svg class="w-6 xxl:w-5 xl:w-4" viewBox="0 0 28 26" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.25 15.75V19.5H28V22H24.25V25.75H21.75V22H18V19.5H21.75V15.75H24.25ZM24.26 0.75C24.945 0.75 25.5 1.30625 25.5 1.99125V13.25H23V3.25H3V20.7488L15.5 8.25L19.25 12V15.5363L15.5 11.7863L6.53375 20.75H15.5V23.25H1.74C1.41102 23.2497 1.09562 23.1187 0.863112 22.886C0.630603 22.6533 0.5 22.3377 0.5 22.0088V1.99125C0.502288 1.66297 0.633625 1.34877 0.865641 1.11652C1.09766 0.884272 1.41173 0.752618 1.74 0.75H24.26ZM8 5.75C8.66304 5.75 9.29893 6.01339 9.76777 6.48223C10.2366 6.95107 10.5 7.58696 10.5 8.25C10.5 8.91304 10.2366 9.54893 9.76777 10.0178C9.29893 10.4866 8.66304 10.75 8 10.75C7.33696 10.75 6.70107 10.4866 6.23223 10.0178C5.76339 9.54893 5.5 8.91304 5.5 8.25C5.5 7.58696 5.76339 6.95107 6.23223 6.48223C6.70107 6.01339 7.33696 5.75 8 5.75Z" fill="#fff"/>
                      </svg>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bg-[#F6F3FA] flex flex-col rounded-[10px]">
               <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5 p-5 xxl:p-4 xl:p-3">
                 <span class="text-[15px] xxl:text-[13px] xl:text-[11px] leading-none">Управление подпиской</span>
                 <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">
                   Активна до:
                   <span class="text-[#E84680]"> 20.11.2022</span>
                 </span>
               </div>
                <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
                <button class="bg-[#6435A5] text-[15px] xxl:text-[13px] py-4 xxl:py-3 xl:py-2.5 xl:text-[11px] leading-none text-white m-5 xxl:m-4 xl:m-3 rounded-[5px]">Оплатить</button>
              </div>
            </div>
            <div>
              <h3 class="text-[18px] xxl:text-[15px] xl:text-[13px] text-[#1E1D2D]">Личные данные</h3>
              <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 mt-7 xxl:mt-5 xl:mt-4">
                <div class="grid grid-cols-2 gap-5 xxl:gap-4 xl:gap-3">
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name">Имя</label>
                    <input class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name" placeholder="Введите имя...">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="surname">Фамилия</label>
                    <input class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="surname" placeholder="Введите фамилию...">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="tel">Телефон</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="tel" id="tel" placeholder="+7 930 245 15 20">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="email">Почта</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="email" placeholder="elena@mail.ru">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="job">Должность</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="job" placeholder="Менеджер">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="social">Ссылка на соц сеть</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="social" placeholder="Test@gmail.com">
                  </div>
                </div>
                <div class="relative flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                  <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="talk">Расскажите о себе</label>
                  <textarea maxlength="250" @input="this.lengthTextarea = this.valueTextarea.length"  v-model="valueTextarea" class="custom__scroll-grey text-[#1E1D2D] resize-none h-[90px] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none focus:ring-0" type="text" id="talk" placeholder="Расскажите о себе"></textarea>
                  <div class="absolute bottom-0 right-0 text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none p-5 xxl:p-4 xl:p-3">{{ lengthTextarea }}/250</div>
                </div>
              </div>
            </div>
            <div class="flex flex-col">
              <h3 class="text-[18px] xxl:text-[15px] xl:text-[13px] text-[#1E1D2D]">Данные Агенства недвижимости</h3>
              <div class="p-7 xxl:p-5 xl:p-4 mt-7 xxl:mt-5 xl:mt-4">
                <div class="flex gap-7 xxl:gap-5 xl:gap-4">
                  <div class="flex w-full flex-col border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="company">Компания</label>
                    <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="company" placeholder="First">
                  </div>
                  <div class="relative shrink-0 h-[78px] xxl:h-[61px] xl:h-[55px] w-[78px] xxl:w-[61px] xl:w-[55px] rounded-full">
                    <img v-if="agency" class="absolute w-full h-full rounded-full" :src="agencyPhoto" alt="">
                    <button v-if="agency" @click="deletePhoto" class="absolute rounded-full bg-[#E84680] z-10 top-0 left-0 h-5 xxl:h-4.5 xl:h-4 w-5 xxl:w-4.5 xl:w-4">
                      <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-white h-[1px] w-[60%]"></span>
                      <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-white h-[1px] w-[60%]"></span>
                    </button>
                    <div class="avatar__contact w-full h-full rounded-full">
                      <div class="absolute rounded-full w-full h-full top-0 left-0">
                        <label for="agency" :class="{'-z-10': agency}" class="relative cursor-pointer flex items-center justify-center w-full h-full rounded-full">
                          <img src="../../assets/svg/upload_photo.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
                        </label>
                        <input class="w-full h-full rounded-full opacity-0 absolute top-0 left-0 pointer-events-none" id="agency" type="file" ref="file" @change="changeAgency">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="relative my-7 xxl:my-5 xl:my-4">
                <label class="bg-[#F6F3FA] w-full h-[6.56vw] rounded-[10px] flex justify-center items-center" for="cover">
                  <div class="flex flex-col items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                    <div class="flex items-center gap-4 xxl:gap-3 xl:gap-2.5">
                      <img src="../../assets/svg/upload_photo.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
                      <span class="text-[#6435A5] text-lg xxl:text-[15px] xl:text-[13px] font-semibold leading-none">1920 x 260 px</span>
                    </div>
                    <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none">Загрузить обложку</span>
                  </div>
                </label>
                <input class="pointer-events-none overflow-hidden absolute top-0 left-0 opacity-0" id="cover" type="file">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from "@/Layouts/AppHeader.vue"
import AppFooter from "@/Layouts/AppFooter.vue"

export default {
  data() {
    return {
      myPhoto: '',
      avatar: false,
      agencyPhoto: '',
      agency: false,
      valueTextarea: null,
      lengthTextarea: 0,
    }
  },
  methods: {
    avatarContact(e) {
      this.myPhoto = URL.createObjectURL(e.target.files[0])
      if (e.target.files.length == 1) {
        this.avatar = true
      }
    },
    changeAgency(e) {
      this.agencyPhoto = URL.createObjectURL(e.target.files[0])
      console.log(e.target.files[0])
      if (e.target.files.length == 1) {
        this.agency = true
      }
    },
    deletePhoto() {
      this.agencyPhoto = ''
      this.agency = false
    },
  },
  components: {
    AppHeader,
    AppFooter,
  }
}

</script>
