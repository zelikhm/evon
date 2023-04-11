<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col gap-5 xxl:gap-4 xl:gap-3 bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[32%] lg:w-[50%] md:w-[64%] sm:w-[90%] h-fit">
      <div class="relative flex justify-between items-center">
        <h2 class=" text-[22px] xxl:text-lg xl:text-base font-semibold">{{ contact ? language.menu_zastr_1[9] : language.dob_ob_2[1] }} {{ language.ob[4] }}</h2>
        <button @click="$emit('close-modal-add-contact')" class="hover__close transition-all relative w-4 h-4 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
        <div>
          <div class="relative w-20 xxl:w-16 xl:w-14 h-20 xxl:h-16 xl:h-14 rounded-full">
            <img v-if="myPhoto && myPhoto !== '/storage/support/'" class="absolute object-cover w-full h-full rounded-full" :src="myPhoto" alt="">
            <button v-if="myPhoto && myPhoto !== '/storage/support/'" @click="deletePhoto" class="absolute rounded-full bg-[#E84680] z-10 top-0 left-0 h-5 xxl:h-4.5 xl:h-4 w-5 xxl:w-4.5 xl:w-4">
              <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-white h-[1px] w-[60%]"></span>
              <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-white h-[1px] w-[60%]"></span>
            </button>
            <div v-if="!myPhoto || myPhoto === '/storage/support/'" class="avatar__contact w-full h-full rounded-full">
              <div class="absolute rounded-full w-full h-full top-0 left-0">
                <label for="avatar" :class="{'-z-10': myPhoto}" class="relative cursor-pointer flex items-center justify-center w-full h-full rounded-full">
                  <img src="../../../assets/svg/upload_photo.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
                </label>
                <input class="w-full h-full rounded-full opacity-0 absolute top-0 left-0 pointer-events-none" id="avatar" type="file" ref="file" @change="avatarContact">
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name_contact">{{ language.dob_ob_2[3] }}</label>
          <input v-model="dataSupport.name" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name_contact">
        </div>
      </div>
      <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">{{ language.dob_ob_2[4] }}</label>
        <input v-model="dataSupport.status" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="post_contact">
      </div>
      <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="tel_contact">{{ language.dob_ob_2[5] }}</label>
        <input v-model="dataSupport.phone" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="tel_contact">
      </div>
      <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="email_contact">{{ language.dob_ob_2[6] }}</label>
        <input v-model="dataSupport.email" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="email_contact">
      </div>
      <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="soc_contact">{{ language.dob_ob_2[7] }}</label>
        <input v-model="dataSupport.link" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="soc_contact">
      </div>
      <span class="text-[red] text-center text-lg xxl:text-[15px] xl:text-[13px] leading-none" v-if="error">Не вся информация о контакте заполнена!</span>
      <button class="login__btn--bg rounded-[5px] w-full py-5 xxl:py-4 xl:py-3" @click="addSupport" v-if="!contact">
        <span class="text-white font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">Добавить</span>
      </button>
      <button class="login__btn--bg rounded-[5px] w-full py-5 xxl:py-4 xl:py-3" @click="editSupport" v-else>
        <span class="text-white font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">{{ language.menu_zastr_1[9] }}</span>
      </button>
    </div>
    <div @click="$emit('close-modal-add-contact')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
  import { computed } from 'vue'
  import { usePage } from '@inertiajs/vue3'

export default {
  props: ['contact', 'isEdit', 'house', 'language', 'token'],
  inject:['user'],
  data() {
    return {
      myPhoto: '',
      avatar: false,
      dataSupport: {
        avatar: "",
        image_front: "",
        name: "",
        status: "",
        phone: "",
        email: "",
        link: "",
        token: this.globalToken
      },
      error: false,
    }
  },
  methods: {
    addSupport() {
      let formData = new FormData()
      formData.append('house_id', this.house.id)
      formData.append('avatar', this.dataSupport.avatar)
      formData.append('name', this.dataSupport.name)
      formData.append('phone', this.dataSupport.phone)
      formData.append('email', this.dataSupport.email)
      formData.append('status', this.dataSupport.status)
      formData.append('link', this.dataSupport.link)
      formData.append('token', this.token)

      axios({
        method: 'post',
        url: '/api/house/addedSupport',
        headers: {"Content-type": "multipart/form-data"},
        data: formData,
      }).then(res => {
        this.$emit('close-add-contact', res.data)
      }).catch(e => {
        this.error = true
      })
    },
    editSupport() {
      let formData = new FormData()

      if (this.avatar) {
        formData.append('avatar', this.dataSupport.avatar)
      } else {
        console.log('not')
        formData.append('avatar', 'not')
      }

      formData.append('house_id', this.house.id)
      formData.append('id', this.contact.id)
      formData.append('name', this.dataSupport.name)
      formData.append('phone', this.dataSupport.phone)
      formData.append('email', this.dataSupport.email)
      formData.append('status', this.dataSupport.status)
      formData.append('link', this.dataSupport.link)
      formData.append('token', this.token)

      axios({
        method: 'post',
        url: '/api/house/editSupport',
        headers: {"Content-type": "multipart/form-data"},
        data: formData,
      }).then(res => {
        this.$emit('close-edit-contact', res.data)
      }).catch(e => {
        this.error = true
      })
    },
    avatarContact(e) {
      this.dataSupport.image_front = URL.createObjectURL(e.target.files[0])
      this.dataSupport.avatar = this.$refs.file.files[0]
      this.myPhoto = this.dataSupport.image_front
      if (e.target.files.length == 1) {
        this.avatar = true
      }
    },
    deletePhoto() {
      this.myPhoto = ''
      this.avatar = false
    }
  },
  created() {
    if (this.contact) {
      this.dataSupport.name = this.contact.name
      this.dataSupport.status = this.contact.status
      this.dataSupport.phone = this.contact.phone
      this.dataSupport.email = this.contact.phone
      this.myPhoto = this.contact.avatar
      this.dataSupport.link = this.contact.link
    }
  }
}
</script>

<style scoped>

</style>
