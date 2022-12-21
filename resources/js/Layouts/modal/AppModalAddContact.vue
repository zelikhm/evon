<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col gap-5 xxl:gap-4 xl:gap-3 bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[30%] h-fit">
      <div class="relative flex justify-between items-center">
        <h2 class=" text-[22px] xxl:text-lg xl:text-base font-semibold">Добавить контакт</h2>
        <button @click="this.$emit('close-add-contact')" class="relative w-4 h-4 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
        <div>
          <div class="relative w-20 xxl:w-16 xl:w-14 h-20 xxl:h-16 xl:h-14 rounded-full">
            <img v-if="avatar" class="absolute w-full h-full rounded-full" :src="myPhoto" alt="">
            <button v-if="avatar" @click="deletePhoto" class="absolute rounded-full bg-[#E84680] z-10 top-0 left-0 h-5 xxl:h-4.5 xl:h-4 w-5 xxl:w-4.5 xl:w-4">
              <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-white h-[1px] w-[60%]"></span>
              <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-white h-[1px] w-[60%]"></span>
            </button>
            <div class="avatar__contact w-full h-full rounded-full">
              <div class="absolute rounded-full w-full h-full top-0 left-0">
                <label for="avatar" :class="{'-z-10': avatar}" class="relative cursor-pointer flex items-center justify-center w-full h-full rounded-full">
                  <img src="../../../assets/svg/upload_photo.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
                </label>
                <input class="w-full h-full rounded-full opacity-0 absolute top-0 left-0 pointer-events-none" id="avatar" type="file" @change="avatarContact">
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name_contact">Имя</label>
          <input class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name_contact" placeholder="Елена">
        </div>
      </div>
      <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">Должность</label>
        <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="post_contact" placeholder="Отдел продаж">
      </div>
      <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="tel_contact">Телефон</label>
        <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="tel_contact" placeholder="+7 930 245 15 20">
      </div>
      <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="email_contact">Почта</label>
        <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="email_contact" placeholder="elena@mail.ru">
      </div>
      <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="soc_contact">Ссылка на соц сеть</label>
        <input class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="soc_contact" placeholder="Http://172468712687">
      </div>
      <button class="bg-[#E84680] rounded-[5px] w-full py-5 xxl:py-4 xl:py-3">
        <span class="text-white font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">Добавить</span>
      </button>
    </div>
    <div @click="this.$emit('close-add-contact')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      myPhoto: '',
      avatar: false
    }
  },
  methods: {
    avatarContact(e) {
      let url = URL.createObjectURL(e.target.files[0])
      this.myPhoto = url
      if (e.target.files.length == 1) {
        this.avatar = true
      }
    },
    deletePhoto() {
      this.myPhoto = ''
      this.avatar = false
    }
  }
}
</script>

<style scoped>

</style>
