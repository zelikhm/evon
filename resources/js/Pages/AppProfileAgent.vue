<template>
  <app-header />
  <main class="relative">
    <div class="_container">
      <div class="my-14 xxl:my-12 xl:my-10">
        <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] leading-none">Редактировать профиль</h2>
        <div class="mt-10 xxl:mt-8 xl:mt-6">
          <div>
            <div class="relative w-20 xxl:w-16 xl:w-14 h-20 xxl:h-16 xl:h-14 rounded-full">
              <img v-if="avatar" class="absolute w-full h-full rounded-full" :src="myPhoto" alt="">
              <div class="avatar__contact w-full h-full rounded-full">
                <div class="absolute rounded-full w-full h-full top-0 left-0">
                  <label for="avatar" :class="{'-z-10': avatar}" class="relative cursor-pointer flex items-center justify-center w-full h-full rounded-full">
                    <img src="../../assets/svg/upload_photo.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
                  </label>
                  <input class="w-full h-full rounded-full opacity-0 absolute top-0 left-0 pointer-events-none" id="avatar" type="file" ref="file" @change="avatarContact">
                </div>
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
    }
  },
  methods: {
    avatarContact(e) {
      this.dataSupport.image_front = URL.createObjectURL(e.target.files[0])
      this.dataSupport.image_back = this.$refs.file.files[0]
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
  components: {
    AppHeader,
    AppFooter,
  }
}

</script>
