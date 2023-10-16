<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>
<template>
  <div v-if="loader_status" class="preloader">
    <div class="loader">

    </div>
    <h3>{{ language.form_dob_ob[5] }}</h3>
  </div>
  <app-modal-add-contact @close-add-contact="closeModalContact" @close-modal-add-contact="closeModalAddContact" :token="token"
    @close-edit-contact="closeModalBeforeEdit" v-if="modalAddContact" :contact="contact" :house="house"
    :language="language" />
  <app-modal-add-apartments @close-add-apartments="closeAddApartments" v-if="modalAddApatments" :house="house" :token="token"
    :activeFrame="activeFrame" :selectFlat="selectFlat" @call-notification="callNotification" :language="language"
    :statuses="statuses" />
  <app-modal-add-frame v-if="modalAddFrame" @close-add-frame="closeAddFrame" @close-modal-add-frame="closeModalAddFrame" :token="token"
    :house="house" :isEdit="isEdit" :frame="frame" :language="language" />
  <app-modal-notification class="left-[2vw] transition-all duration-1000" :class="{ '-left__full': !openNotification }"
    @close-notification="openNotification = false" :text="text" />
  <app-header :user="user" :admin="admin" :language="language" @selectLanguage="choseLanguage" />
  <main>
    <div class="_container">
      <div :class="{ 'grid__apartments': page === 1 }"
        class="grid__add-object my-14 xxl:my-10 xl:my-8 gap-7 xxl:gap-5 xl:gap-4">
        <div class="relative">
          <div class="sticky lg:relative top-10 lg:top-0 z-50 lg:w-full">
            <div class="bg-[#F6F3FA] h-fit p-7 xxl:p-5 xl:p-4 rounded-[6px]">
              <div class="flex flex-col gap-3 xxl:gap-2.5 xl:gap-2">
                <Link :href="url">
                <div :class="{ 'menu-add-obj': page === 0 }"
                  class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">
                  {{ language.form_dob_ob[0] }}</div>
                </Link>
                <div @click="openPage(4)" :class="{ 'menu-add-obj': page === 4 }"
                  class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">
                  {{ language.form_dob_ob[1] }}</div>
                <div @click="openPage(1)" :class="{ 'menu-add-obj': page === 1 }"
                  class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">
                  {{ language.form_dob_ob[2] }}</div>
                <div @click="openPage(2)" :class="{ 'menu-add-obj': page === 2 }"
                  class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">
                  {{ language.form_dob_ob[3] }}</div>
                <div @click="openPage(3)" :class="{ 'menu-add-obj': page === 3 }"
                  class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">
                  {{ language.form_dob_ob[4] }}</div>
              </div>
            </div>
            <div :class="{ 'hidden': page !== 1 }" class="flex justify-center mt-12 xxl:mt-10 xl:mt-8"
              v-if="readyHouse !== undefined && readyHouse.frames.length > 0">
              <button @click="addFlatModal"
                class="register__button--white text-[#6435A5] flex justify-center items-center gap-2 xl:gap-1.5 border border-solid rounded-[5px] border-[#6435A5] px-4 xxl:px-3 xl:px-2.5 py-2.5 xxl:py-2 xl:py-1.5">
                <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_519_1862)">
                    <path
                      d="M7.33398 7.33301V3.33301H8.66732V7.33301H12.6673V8.66634H8.66732V12.6663H7.33398V8.66634H3.33398V7.33301H7.33398Z"
                      fill="#6435A5" />
                  </g>
                  <defs>
                    <clipPath id="clip0_519_1862">
                      <rect width="16" height="16" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
                <span class="leading-none text-base xxl:text-sm xl:text-xs lg:text-[15px] font-medium">{{
                  language.dob_kv_1[14] }}</span>
              </button>
            </div>
          </div>
        </div>

        <!--  Информация о ЖК  -->
        <div v-if="page === 0">
          <app-info-j-k :dops="dops" :infos="infos" :city="city" :count="count" :house="house" :supports="supports" :token="token"
            @addAndContinue="addAndContinue" @call-notification="callNotification" :language="language"
            :selectLanguage="selectLanguage" />
        </div>

        <!--  Корпуса и квартиры  -->
        <div v-if="page === 1">
          <app-apartments @open-add-frame="openAddFrame" :house="readyHouse" @change-frame="changeFrame" :token="token"
            @edit-flat="editFlat" :language="language" :statuses="statuses" :titleTable="titleTable" />
        </div>

        <!--  Фото  -->
        <div v-if="page === 2">
          <app-add-photo :house="readyHouse" :language="language" :photos="photos" :token="token"
            @loader="loader_status = !loader_status" />
        </div>

        <div v-if="page === 3">
          <app-add-files :house="readyHouse" :language="language" :token="token" />
        </div>

        <div v-if="page === 4">
          <app-add-contacts :house="readyHouse" :supports="supports" @open-add-contact="openAddContact" :token="token"
            @open-edit-contact="openEditContact" :language="language" />
        </div>

      </div>
    </div>

  </main>
  <app-footer :language="language" />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppInfoJK from "../Components/AppInfoJK.vue"
import AppApartments from "../Components/AppApartments.vue"
import AppAddPhoto from "../Components/AppAddPhoto.vue"
import AppModalAddContact from "../Layouts/modal/AppModalAddContact.vue"
import AppModalAddApartments from "../Layouts/modal/AppModalAddApartments.vue"
import AppModalAddFrame from "../Layouts/modal/AppModalAddFrame.vue"
import AppModalNotification from "@/Layouts/modal/AppModalNotification.vue"
import AppAddFiles from "@/Components/AppAddFiles.vue";
import AppAddContacts from "@/Components/AppAddContacts.vue";

export default {
  props: {
    dops: [],
    infos: [],
    city: [],
    user: [],
    count: Number,
    frames: null,
    house: [],
    token: String,
    admin: []
  },
  provide() {
    return {
      user: this.user,
    }
  },
  data() {
    return {
      activeContact: null,
      openNotification: false,
      page: 0,
      isHiddenAddFlat: false,
      url: window.location,
      modalAddContact: false,
      modalAddApatments: false,
      modalAddFrame: false,
      supports: [],
      houseID: null,
      createHouse: null,
      isMainPage: null,
      isEdit: true,
      readyHouse: null,
      activeFrame: null,
      frame: null,
      selectFlat: null,
      contact: null,
      text: null,
      selectLanguage: 0,
      language: {},
      statuses: [],
      titleTable: [],
      photos: [],
      loader_status: false,
    }
  },
  methods: {
    loader(status) {
      this.loader_status = status;
    },
    choseLanguage(language) {
      this.selectLanguage = language;

      if (this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }

      this.statuses = [
        { status: this.language.dob_kv_1[10], id: 0 },
        { status: this.language.dob_kv_1[11], id: 1 },
        { status: this.language.dob_kv_1[12], id: 2 },
        { status: this.language.dob_kv_1[13], id: 3 },
        { status: this.language.dob_kv_1[9], id: 4 },
      ];

      this.titleTable = [
        { name: 'id', title: '№', active: 0, filter: true },
        { name: 'square', title: this.language.dob_kv_1[4], active: 0, filter: true },
        { name: 'price', title: this.language.dob_kv_1[5], active: 0, filter: true },
        { name: 'plan', title: this.language.dob_kv_1[6], active: 0, filter: false },
        { name: 'floor', title: this.language.dob_kv_1[7], active: 0, filter: true },
        { name: 'status', title: this.language.dob_kv_1[8], active: 0, filter: false }
      ];

    },
    addFlatModal() {
      this.selectFlat = null
      this.modalAddApatments = !this.modalAddApatments
    },
    callNotification(text) {
      this.text = text
      this.openNotification = true
      setTimeout(() => {
        this.openNotification = false
        this.text = null
      }, 2500)
    },
    editFlat(data) {
      this.modalAddApatments = true
      this.selectFlat = data
    },
    openAddContact() {
      this.contact = null
      this.modalAddContact = !this.modalAddContact
    },
    openEditContact(data) {
      this.modalAddContact = !this.modalAddContact
      this.contact = data
    },
    openPage(id) {
      if (!this.isMainPage) {
        this.page = id
      }
    },
    closeModalAddContact() {
      this.modalAddContact = false
    },
    closeModalContact(data) {
      this.modalAddContact = false
      this.supports = []
      this.supports = data
    },
    closeModalBeforeEdit(data) {
      this.modalAddContact = false
      this.supports = data
    },
    addAndContinue(house) {
      this.page = 4
      this.createHouse = house
    },
    closeModalAddFrame() {
      this.modalAddFrame = false
    },
    closeAddFrame(data) {
      this.modalAddFrame = false
      if (this.readyHouse.frames.length === 1) {
        this.activeFrame = this.readyHouse.frames[0].id
      }
      this.readyHouse = data
    },
    changeFrame(data) {
      this.activeFrame = data

      if (data.length > 0) {
        this.isHiddenAddFlat = false;
      } else {
        this.isHiddenAddFlat = true;
      }
    },
    openAddFrame(frame) {
      this.modalAddFrame = !this.modalAddFrame
      this.frame = frame
    },
    closeAddApartments(data) {
      this.modalAddApatments = false
      let activeFrameId = null
      this.readyHouse.frames.forEach(frame => {
        if (frame.active === 1) {
          activeFrameId = frame.id
        }
      })

      if (data) {
        data.frames.forEach(frame => {
          if (frame.active === 1) {
            frame.active = 0
          }

          if (frame.id === activeFrameId) {
            frame.active = 1
          }
        })
        this.readyHouse = data

      }
    }
  },
  created() {
    if (this.user.lang === 0) {
      this.language = this.$ru;
      this.selectLanguage = 0;
    } else if (this.user.lang === 1) {
      this.language = this.$en;
      this.selectLanguage = 1;
    } else if (this.user.lang === 2) {
      this.language = this.$tur;
      this.selectLanguage = 2;
    }

    this.statuses = [
      { status: this.language.dob_kv_1[10], id: 0 },
      { status: this.language.dob_kv_1[11], id: 1 },
      { status: this.language.dob_kv_1[12], id: 2 },
      { status: this.language.dob_kv_1[13], id: 3 },
      { status: this.language.dob_kv_1[9], id: 4 },
    ];

    this.titleTable = [
      { name: 'id', title: '№', active: 0, filter: true },
      { name: 'square', title: this.language.dob_kv_1[4], active: 0, filter: true },
      { name: 'price', title: this.language.dob_kv_1[5], active: 0, filter: true },
      { name: 'plan', title: this.language.dob_kv_1[6], active: 0, filter: false },
      { name: 'floor', title: this.language.dob_kv_1[7], active: 0, filter: true },
      { name: 'status', title: this.language.dob_kv_1[8], active: 0, filter: false }
    ];

    this.photos = [
      { name: this.language.alb[0], id: 0, count: 0 },
      { name: this.language.alb[1], id: 1, count: 0 },
      { name: this.language.alb[2], id: 2, count: 0 },
      { name: this.language.alb[3], id: 3, count: 0 },
    ];

    this.readyHouse = this.house
    let lastItemLink = window.location.href.split('/').at(-1)
    lastItemLink === 'addedHouse' ? this.isMainPage = true : this.isMainPage = false

    if (lastItemLink.split('#').at(-1) === 'create') {
      this.page = 4
      this.isEdit = false
    } else if (lastItemLink.split('#').at(-1) === 'edit') {
      this.page = 0
      this.isEdit = false
    }
    if (this.house) {
      this.supports = this.house.supports
    }
  },
  components: {
    AppAddContacts,
    AppAddFiles,
    AppHeader,
    AppFooter,
    AppInfoJK,
    AppApartments,
    AppAddPhoto,
    AppModalAddContact,
    AppModalAddApartments,
    AppModalAddFrame,
    AppModalNotification,
  }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<style scoped>

.preloader {
   position: fixed;
   width: 100%;
   height: 100%;
   background-color: rgb(255, 255, 255, 0.8);
   z-index: 20000;
 }

 .preloader h3{
  text-align: center;
    font-weight: 700;
    font-size: 1.5vw;
    max-width: 23vw;
    line-height: 2vw;
    margin: 0 auto;
    position: absolute;
    left: calc(50% - 11.5vw);
    top: calc(50% - -9vw);
 }

 .preloader h3.sm{
    font-size: 1.4vw;
 }

 .loader {
    width: 8vw;
    height: 8vw;
    border: 0.8vw solid rgba(100,53,165,.5);
    border-radius: 50%;
    display: inline-block;
    position: absolute;
    top: calc(50% - 4vw);
    left: calc(50% - 4vw);
    transform: translate(-50%,-50%);
    box-sizing: border-box;

    will-change: transform;
    animation: rotation 2s linear infinite;
    transform-origin: center center;
 }

 .loader::after {
    content: '';
    box-sizing: border-box;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 11.4vw;
    height: 11.4vw;
    border-radius: 50%;
    border: .8vw solid;
    border-color: #6435A5 transparent;
 }

 @keyframes rotation {
   0% {
     transform: rotate(0deg);
   }

   100% {
     transform: rotate(360deg);
   }
 }


 @media (max-width:1000px) {
   .loader {
    width: 34vw;
    height: 34vw;
    border: 2vw solid rgba(100,53,165,.5);
    top: calc(50% - 17vw);
    left: calc(50% - 17vw);
   }

   .loader::after {
    content: '';
    width: 41.4vw;
    height: 41.4vw;
    border: 2vw solid;
    border-color: #6435A5 transparent;
   }
   .preloader h3  {
      font-size: 5vw;
      max-width: 86vw;
      line-height: 6vw;
      left: calc(50% - 43vw);
      top: calc(50% - -29vw);
  }
  .preloader h3.sm{
    font-size: 5vw;
 }
 }
</style>
