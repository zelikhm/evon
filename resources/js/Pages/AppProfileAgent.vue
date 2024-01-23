<template>
  <app-modal-profile v-if="openPayProfile" @close-pay-profile="openPayProfile = false" :selectLanguage="selectLanguage" :tarifs="tarifs" :language="language" :user="user" />
  <app-modal-rus-profile v-if="openPayRusProfile" @close-pay-profile="openPayRusProfile = false" :tarifs="tarifs_rus" :selectLanguage="selectLanguage" :language="language" :user="user" />
  <app-header :user="userHeader" :language="language" @selectLanguage="choseLanguage" />
  <app-modal-notification
    class="left-[2vw] transition-all duration-1000"
    :class="{'-left__full': !openNotification}"
    @close-notification="openNotification = !openNotification"
    :text="text"
  />
  <app-modal-verification v-if="openModalVer || verification !== null" @close-modal-verification="openModalVer = false, verification = null" :language="language" :verification="verification"></app-modal-verification>
  <AppModalSubscription v-if="subscription !== null" @close-modal-verification="subscription = null" :language="language" :subscription="subscription"></AppModalSubscription>

  <main class="relative">
    <div class="_container">
      <div class="my-14 xxl:my-12 xl:my-10">
        <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] lg:text-[20px] leading-none">{{ language.prof_rielt[0] }}</h2>
        <div class="mt-10 xxl:mt-8 xl:mt-6">
          <div class="grid__prof-agent gap-7 xxl:gap-5 xl:gap-4 lg:gap-6">
            <div class="flex flex-col lg:flex-row gap-12 xxl:gap-10 xl:gap-8 lg:gap-4">
              <div class="relative flex-shrink-0 w-[250px] h-[250px] exl:w-[13.28vw] exl:h-[13.28vw] lg:w-[128px] sm:w-[100px] lg:h-[128px] sm:h-[100px]  rounded-full">
                <img class="absolute object-cover w-full h-full rounded-full" :src="myPhoto" alt="">
                <div class="avatar__contact w-full h-full rounded-full">
                  <div class="absolute rounded-full w-full h-full top-0 left-0">
                    <label for="avatar" :class="{'-z-10': avatar}" class="relative cursor-pointer flex items-center justify-center w-full h-full rounded-full">
                      <img src="../../assets/svg/upload_photo.svg" class="w-12 xxl:w-10 xl:w-8" alt="">
                    </label>
                    <input class="w-full h-full rounded-full opacity-0 absolute top-0 left-0 pointer-events-none" id="avatar" type="file" ref="user_avatar" @change="saveEdit">
                    <label class="h-12 xxl:h-10 xl:h-8 w-12 xxl:w-10 xl:w-8 cursor-pointer bg-[#6435A5] flex justify-center items-center rounded-full absolute bottom-0 left-1/2 translate-y-1/2 -translate-x-1/2" for="avatar">
                      <svg class="w-6 xxl:w-5 xl:w-4" viewBox="0 0 28 26" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.25 15.75V19.5H28V22H24.25V25.75H21.75V22H18V19.5H21.75V15.75H24.25ZM24.26 0.75C24.945 0.75 25.5 1.30625 25.5 1.99125V13.25H23V3.25H3V20.7488L15.5 8.25L19.25 12V15.5363L15.5 11.7863L6.53375 20.75H15.5V23.25H1.74C1.41102 23.2497 1.09562 23.1187 0.863112 22.886C0.630603 22.6533 0.5 22.3377 0.5 22.0088V1.99125C0.502288 1.66297 0.633625 1.34877 0.865641 1.11652C1.09766 0.884272 1.41173 0.752618 1.74 0.75H24.26ZM8 5.75C8.66304 5.75 9.29893 6.01339 9.76777 6.48223C10.2366 6.95107 10.5 7.58696 10.5 8.25C10.5 8.91304 10.2366 9.54893 9.76777 10.0178C9.29893 10.4866 8.66304 10.75 8 10.75C7.33696 10.75 6.70107 10.4866 6.23223 10.0178C5.76339 9.54893 5.5 8.91304 5.5 8.25C5.5 7.58696 5.76339 6.95107 6.23223 6.48223C6.70107 6.01339 7.33696 5.75 8 5.75Z" fill="#fff"/>
                      </svg>
                    </label>
                  </div>
                </div>
              </div>
              <div class="bg-[#F6F3FA] w-full flex flex-col rounded-[10px]">

               <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5 p-5 xxl:p-4 xl:p-3">
                 <span class="text-[15px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] leading-none">{{ language.prof_rielt[10] }}</span>
                 <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px] leading-none" v-if="user.subscription">
                   {{ language.prof_rielt[11] }}: <span class="text-[#E84680]">{{ new Date(Date.parse(user.subscription_info.finished_at)).toISOString().replace(/^([^T]+)T(.+)$/,'$1').replace(/^(\d+)-(\d+)-(\d+)$/,'$3.$2.$1') }}</span>
                 </span>
               </div>

                <div class="w-full h-[1px] bg-[#E5DFEE]"></div>

                <!--Текст про подписки-->
                <div class="text-hint red" v-if="!user.subscription">{{ language.subscription[0] }}</div>
                <div class="text-hint"  v-if="!user.subscription">{{ language.subscription[1] }}</div>
                <button @click="openPayProfile = true" class="hover__button--purple transition-all bg-[#6435A5] text-[15px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] py-4 xxl:py-3 xl:py-2.5  leading-none text-white m-5 xxl:m-4 xl:m-3 rounded-[5px]">{{ language.prof_rielt[15] + ' TR' }}</button>
                <button @click="openPayRusProfile = true" class="hover__button--purple transition-all bg-[#6435A5] text-[15px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] py-4 xxl:py-3 xl:py-2.5  leading-none text-white m-5 xxl:m-4 xl:m-3 rounded-[5px]">{{ language.prof_rielt[15] + ' RUB' }}</button>
              </div>
            </div>
            <div>
              <h3 class="title text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-[#1E1D2D]">
                {{ language.prof_rielt[3] }}

<!--                <span>{{ language.subscription[1] }}</span>-->
              </h3>
              <p class="text-centr text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]">{{ language.subscription[2] }}</p>
              <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 mt-7 xxl:mt-5 xl:mt-4">
                <div class="grid grid-cols-2 sm:grid-cols-1 gap-5 xxl:gap-4 xl:gap-3">
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="name">{{language.prof_rielt[4]}}</label>
                    <input v-model="profile.name" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name" placeholder="Введите имя...">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="surname">{{language.prof_rielt[5]}}</label>
                    <input v-model="profile.surname" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="surname" placeholder="Введите фамилию...">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="tel">{{language.prof_rielt[6]}}</label>
                    <input v-model="profile.tel" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="tel" id="tel" placeholder="+7 930 245 15 20">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="email">{{language.prof_rielt[7]}}</label>
                    <input readonly v-model="profile.email" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="email" placeholder="elena@mail.ru">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="job">{{language.prof_rielt[8]}}</label>
                    <input v-model="profile.position" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="job">
                  </div>
                  <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="social">{{language.prof_rielt[14]}}</label>
                    <input v-model="profile.link" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="social">
                  </div>
                </div>
                <div class="relative flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                  <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px] lg:text-[13px]" for="talk">{{language.prof_rielt[12]}}</label>
                  <textarea v-model="profile.description" maxlength="250" @input="lengthTextarea = profile.description.length" class="custom__scroll-grey text-[#1E1D2D] resize-none h-[90px] xxl:h-[80px] xl:h-[70px] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none focus:ring-0" type="text" id="talk" :placeholder="language.prof_rielt[12]"></textarea>
                </div>
                <button @click="saveEdit" class="hover__button--purple transition-all bg-[#6435A5] text-[15px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] py-4 xxl:py-3 xl:py-2.5 leading-none text-white rounded-[5px]">{{language.dob_ob_1[24]}}</button>
              </div>
            </div>
            <div class="flex flex-col">

              <div  class="row-status flex w-full flex-col border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                <div class="info">
<!--                  <label  class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="company">{{ language.subscription[2] }}</label>-->
                  <h3 v-if="user.verification === null" class="red text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-[#1E1D2D]">{{ language.subscription[4] }}</h3>
                  <h3 v-else-if="user.verification.isVerification === 0" class="red text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-[#1E1D2D]">{{ language.subscription[4] }}</h3>
                  <h3 v-else-if="user.verification.isVerification === 1" class="orange text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-[#1E1D2D]">{{ language.subscription[5] }}</h3>
                  <h3 v-else-if="user.verification.isVerification === 2" class="green text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-[#1E1D2D]">{{ language.subscription[35] }}</h3>
                </div>
                <div v-if="user.verification === null">
                  <button @click="openModalVer = true"
                          class="hover__button--purple max-w-[170px] ml-[0px] transition-all bg-[#6435A5] text-[15px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] py-4 xxl:py-3 xl:py-2.5  leading-none text-white m-5 xxl:m-4 xl:m-3 rounded-[5px]">
                    {{ language.subscription[5] }}
                  </button>
                </div>
                <div v-else-if="user.verification.isVerification !== 2">
                  <button @click="openModalVer = true"
                          class="hover__button--purple max-w-[170px] ml-[0px] transition-all bg-[#6435A5] text-[15px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] py-4 xxl:py-3 xl:py-2.5  leading-none text-white m-5 xxl:m-4 xl:m-3 rounded-[5px]">
                    {{ language.subscription[5] }}
                  </button>
                </div>
              </div>

              <h3 class="text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[16px] text-[#1E1D2D]">{{language.prof_rielt[1]}}</h3>
              <div class="p-7 xxl:p-5 xl:p-4 x:p-3 mt-7 xxl:mt-5 xl:mt-4 rounded-[10px] white__bg">
                <div class="flex gap-7 xxl:gap-5 xl:gap-4 x:gap-2.5">
                  <div class="flex w-full flex-col border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
                    <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="company">{{language.prof_rielt[2]}}</label>
                    <input v-model="titleCompany" disabled class="w-full text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="company">
                  </div>
                  <div class="relative shrink-0 h-[78px] xxl:h-[61px] xl:h-[55px] w-[78px] xxl:w-[61px] xl:w-[55px] rounded-full">
                    <img class="absolute object-cover w-full h-full rounded-full" v-if="user.company && user.company.image" :src="user.company.image" alt="">
                    <button v-if="agency" @click="deletePhoto" class="absolute rounded-full bg-[#E84680] z-10 top-0 left-0 h-5 xxl:h-4.5 xl:h-4 w-5 xxl:w-4.5 xl:w-4">
                      <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-white h-[1px] w-[60%]"></span>
                      <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-white h-[1px] w-[60%]"></span>
                    </button>
<!--                    <div class="avatar__contact w-full h-full rounded-full">-->
<!--                      <div class="absolute rounded-full w-full h-full top-0 left-0">-->
<!--                        <label :class="{'-z-10': agency}" class="relative cursor-pointer flex items-center justify-center w-full h-full rounded-full">-->
<!--                          <img src="../../assets/svg/upload_photo.svg" class="w-6 xxl:w-5 xl:w-4" alt="">-->
<!--                        </label>-->
<!--                      </div>-->
<!--                    </div>-->
                  </div>
                </div>
              </div>
              <div class="relative my-7 xxl:my-5 xl:my-4">
                <img :src="user.company.banner" v-if="user.company && user.company.banner" class="w-full h-[6.56vw] rounded-[10px]">
<!--                      <img :src="'/storage/user/' + user.image">-->
<!--                      <span class="text-[#6435A5] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-semibold leading-none">1920 x 260 px</span>-->
<!--                    <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px] leading-none">Загрузить обложку</span>-->
<!--                <input class="pointer-events-none overflow-hidden absolute top-0 left-0 opacity-0" id="cover" type="file" ref="banner" @change="changeBanner">-->
              </div>

              <!--Видео-->
<!--              <div v-if="selectLanguage===0" class="video-tutorial">-->
<!--                <h3>Подробнее о функциях платформы</h3>-->
<!--                <div  @click="modal_video=!modal_video" class="video-bg"></div>-->
<!--                <iframe-->
<!--                  id="video"-->
<!--                  src="https://www.youtube.com/embed/xddj1nZjltU?si=g_W5H6NKzlMtyTu0&autoplay=1&mute=1&controls=0&showinfo=0"-->
<!--                  title="YouTube video player"-->
<!--                  frameborder="0"-->
<!--                  allowfullscreen-->
<!--                ></iframe>-->
<!--              </div>-->

<!--              <div v-show="modal_video" class="modal-video">-->
<!--                <div @click="modal_video=!modal_video" class="modal-bg"></div>-->
<!--                <div class="modal-video-content">-->

<!--                  <iframe  id="modal-video"  src="https://www.youtube.com/embed/xddj1nZjltU?si=g_W5H6NKzlMtyTu0&autoplay=1&mute=1&controls=1&showinfo=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->

<!--                </div>-->
<!--              </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer :language="language" />
</template>

<script>
import AppHeader from "@/Layouts/AppHeader.vue"
import AppFooter from "@/Layouts/AppFooter.vue"
import {computed} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";
import AppModalNotification from "@/Layouts/modal/AppModalNotification.vue"
import AppModalProfile from "@/Layouts/modal/AppModalProfile.vue";
import AppModalRusProfile from "@/Layouts/modal/AppModalRusProfile.vue";
import AppModalVerification from "@/Layouts/modal/AppModalVerification.vue";
import AppModalSubscription from "@/Layouts/modal/AppModalSubscription.vue";

export default {
  props:['user', 'tarifs', 'tarifs_rus', 'verification', 'subscription'],
  data() {
    return {
      myPhoto: null,
      avatar: false,
      openNotification: false,
      agencyPhoto: '',
      agency: false,
      lengthTextarea: 0,
      userHeader: null,
      profile: {
        name: '',
        surname: '',
        tel: '',
        email: '',
        position: '',
        link: '',
        description: ''
      },
      titleCompany: '',
      banner: null,
      user_avatar: null,
      text: null,
      openPayProfile: false,
      openPayRusProfile: false,
      selectLanguage: 0,
      language: {},

      modal_video:false,

      openModalVer:false,
      status:0,

    }
  },
  methods: {

    choseLanguage(language) {
      this.selectLanguage = language;

      if (this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }
    },
    deletePhoto() {
      this.agencyPhoto = ''
      this.agency = false
    },
    saveEdit() {

      let formData = new FormData()

      formData.append('user_id', this.user.id)
      formData.append('first_name', this.profile.name)
      formData.append('last_name', this.profile.surname)
      formData.append('status', this.profile.position)
      formData.append('link', this.profile.link)
      formData.append('description', this.profile.description)
      formData.append('image', this.$refs.user_avatar.files[0])
      formData.append('email', this.profile.email)
      formData.append('phone', this.profile.tel)
      formData.append('token', this.user.token)


      axios({
        method: 'post',
        url: '/api/user/edit',
        headers: {"Content-type": "multipart/form-data"},
        data: formData,
      }).then(response => {
        this.openNotification = true
        this.userHeader = response.data
        this.myPhoto = response.data.image
        this.text = 'Изменения успешно сохранены!'
        setTimeout(() => {
          this.openNotification = false
        }, 2000)
      })

      let formDataAgency = new FormData()
      formDataAgency.append('user_id', this.user.id)
      formDataAgency.append('title', this.titleCompany)
      formDataAgency.append('banner', this.banner)
      formDataAgency.append('image', this.user_avatar)
      formDataAgency.append('token', this.user.token)

    }
  },
  created() {
    if(this.user.lang === 0) {
      this.language = this.$ru;
    } else if (this.user.lang === 1) {
      this.language = this.$en;
    } else if (this.user.lang === 2) {
      this.language = this.$tur;
    }

    this.profile.name = this.user.first_name === 'null' ? '' : this.user.first_name
    this.profile.surname = this.user.last_name === 'null' ? '' : this.user.last_name
    this.profile.tel = this.user.phone === 'null' ? '' : this.user.phone

    this.userHeader = this.user

    this.profile.position = this.user.status === 'null' ? '' : this.user.status
    if (this.user.company) {
      this.titleCompany = this.user.company.title
    }
    if(this.user.link === null) {
      this.profile.link = ''
    } else {
      this.profile.link = this.user.link === 'null' ? '' : this.user.link
    }

    if(this.user.description === null) {
      this.profile.description = ''
    } else {
      this.profile.description = this.user.description === 'null' ? '' : this.user.description
    }

    this.profile.email = this.user.email
    if (this.user.image !== null) {
      this.myPhoto = this.user.image
      this.avatar = true
    }

  },
  components: {
    AppModalProfile,
    AppHeader,
    AppFooter,
    AppModalNotification,
    AppModalRusProfile,
    AppModalVerification,
    AppModalSubscription
  }
}

</script>


<style scoped>

.video-tutorial{
  position: relative;
}
.video-tutorial h3{
  text-align: center;
  font-weight: 600;
}

h3.title{
  display: flex;
    align-items: center;
    gap: 14px;

}

h3 span{
  background: rgb(246 , 243 , 250 , 0.7 );
  padding: 5px 8px;
  border-radius: 6px;
  display: block;
  font-size: 12px;
  color: rgb(100 , 53 , 165 , 0.7 );
  font-weight: 500;
}
.video-bg{
  position: absolute;
  left: 0;
  top: 28px;
  width: 100%;
  height: calc(100% - 20px);
  z-index: 10;
  cursor: pointer;
}


.modal-video{
  position: fixed;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
}

.modal-bg{
  position: fixed;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  background: rgb(0,0,0,0.5);
  z-index: 10;
}

.modal-video .modal-video-content {
  width: 50vw;
  height: 28.1vw;
  margin: 0 auto;
  background: white;
  position: absolute;
  left: calc(50% - 25vw);
  top: calc(50% - 14.05vw);
  z-index: 11;
}
#modal-video{
  width: 100%;
  height: 100%;
}
#video{
  width: 28vw;
  height: 15.7vw;
  margin-top: 15px;
  max-width: 100%;
  max-height: 100%;
}

.text-hint{
  text-align: center;
    max-width: 90%;
    width: 100%;
    font-size: 12px;
    line-height: 15px;
    background: white;
    padding: 6px;
    font-weight: 500;
    border-radius: 6px;
    margin: 10px auto;
    color: rgb(100 53 165 );
}

.text-hint.red{
  color:rgb(232 70 128 )
}

.row-status{
  margin-bottom: 25px;
  display: flex;
  flex-direction: row;
  align-items: flex-end;
  justify-content: space-between;
}
.row-status h3{
  font-size: 0.83vw;
  font-weight: 500;
}
.row-status button{
  margin: 0;
  margin-top: 10px;
  padding: 10px 18px;
  width: fit-content;
}
.row-status .info{
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.row-status h3{
  display: inline-block;
  width: fit-content;
  padding: 3px 10px;
  margin: 3px 0px;
  color:white;
  border-radius: 3px;
}
.row-status h3.red{
  background: rgb(232 70 128 );
}
.row-status h3.orange{
  background: rgb(246 243 250);
  color: rgb(100 53 165 );
}
.row-status h3.green{
  background: rgb(48 203 73)
}
@media (max-width: 768px) {
  .modal-video .modal-video-content  {
    width: 90vw;
    height: 50.1vw;
    margin: 0 auto;
    background: white;
    position: absolute;
    left: calc(50% - 45vw);
    top: calc(50% - 14.05vw);
    z-index: 11;
  }
  .text-centr{
    text-align: center;
  }
  h3.title{
    display: flex;
    align-items: center;
    gap: 14px;
    flex-direction: column;
  }
  h3 span{
    text-align: center;
    line-height: 16px;
  }
  .video-bg{
    position: absolute;
    left: 0;
    top: 31px;
    width: 100%;
    height: calc(100% - 30px);
    z-index: 10;
    cursor: pointer;
  }
  #video {
    width: 87vw;
    height: 49vw;
    margin-top: 15px;
    max-width: 100%;
    max-height: 100%;
  }
  .text-hint{
    font-size: 12px;
    line-height: 15px;
}
  #app > main > div > div > div > div > div:nth-child(3) > div.modal-video{
    display: none  !important;
  }
  .row-status h3  {
    font-size: 3vw;
  }
}

</style>
