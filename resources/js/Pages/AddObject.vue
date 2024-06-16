<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import Title from "@/Components/UI/ui-title.vue";
import DescriptionObject from "@/Components/Profile/DescriptionObject.vue";
import SalesContacts from "@/Components/Profile/ContactsSales.vue";
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
    <div class="container">
      <div class="list-panel">
        <div :class="{ 'active': page === 0 }" @click="page=0"  class="link-block">  {{ language.form_dob_ob[0] }}</div>
        <div :class="{ 'active': page === 1 }" @click="page=1"  class="link-block">  {{ language.form_dob_ob[1] }}</div>
        <div :class="{ 'active': page === 2 }"  @click="page=2"  class="link-block">    {{ language.form_dob_ob[2] }}</div>
        <div :class="{ 'active': page === 3 }" @click="page=3"  class=" link-block"> {{ language.form_dob_ob[3] }}</div>
        <div :class="{ 'active': page === 4 }" @click="page=4"  class=" link-block "> {{ language.form_dob_ob[4] }}</div>
      </div>
      <div class="center-content">
        <!--Информация о ЖК-->
        <section v-if="page === 0">
          <div class="section-head">
            <UiTitle :title="isEdit ? language.menu_zastr[2] : language.dob_ob_1[1]" :type="2" />
          </div>
          <UiInputBox :title="language.dob_ob_1[1] "  />
          <UiButton :title="language.subscription[100]" :name="language.subscription[99]" :type="1"/>
          <object-description :object="object" :title="language.dob_ob_1[2] " :type="'RU'"/>
          <object-description :object="object" :title="language.dob_ob_1[2] " :type="'EN'"/>
          <object-description :object="object" :title="language.dob_ob_1[2] " :type="'TR'"/>
          <ui-select :title="language.dob_ob_1[3] " />
          <ui-select :title="language.dob_ob_1[4] " />
          <UiInputBox :title="language.dob_ob_1[5] "  />
          <MapBlock />
          <section class="wrapper-options">
            <UiTitle :title="'Характеристики'" :type="3" />
            <div class="grid-options">
              <ui-select :title="language.dob_ob_1[3] " />
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <ui-select :title="language.dob_ob_1[3] " />
              <ui-select :title="language.dob_ob_1[3] " />
              <ui-select :title="language.dob_ob_1[3] " />
              <ui-select :title="language.dob_ob_1[3] " />
            </div>
          </section>
          <section class="wrapper-options">
            <UiTitle :title="'Расположение'" :type="3" />
            <div class="grid-options">
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <UiInputBox :title="language.dob_ob_1[1] "  />
            </div>
          </section>
          <section class="wrapper-options">
            <UiTitle :title="'Вознаграждение'" :type="3" />
            <div class="grid-options">
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <UiInputBox :title="language.dob_ob_1[1] "  />
              <UiButton :name="language.ob[33]" :type="2"/>
              <UiButton  :name="language.dob_ob_1[24]" :type="2"/>
            </div>
          </section>
        </section>
        <!--Контакты отдела продаж-->
        <section v-if="page === 1">
          <div class="section-head">
            <UiTitle :title="language.form_dob_ob[1]" :type="2" />
            <div v-on:click="openAddContact()">
              <UiButton  :name="language.dob_ob_2[1] " :type="3" >
                <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_519_1862)">
                    <path d="M7.33398 7.33301V3.33301H8.66732V7.33301H12.6673V8.66634H8.66732V12.6663H7.33398V8.66634H3.33398V7.33301H7.33398Z" fill="#6435A5"/>
                  </g>
                  <defs>
                    <clipPath id="clip0_519_1862">
                      <rect width="16" height="16" fill="white"/>
                    </clipPath>
                  </defs>
                </svg>
              </UiButton>
            </div>
          </div>
          <contacts-sales :supports="supports"  @open-edit-contact="openEditContact" @open-add-contact="openAddContact"/>
        </section>
        <!--Корпуса и квартиры-->
        <section v-if="page === 2">
          <div class="section-head">
            <UiTitle :title="language.dob_kv_1[0]" :type="2" />
            <div v-on:click="openAddFrame()">
              <UiButton   :type="0" >
                <img   src="../../assets/svg/plus_icon_purple.svg" class="cursor-pointer ml-3 xxl:ml-2.5 xl:ml-2 w-8 xxl:w-6 xl:w-5" alt="">
              </UiButton>
            </div>
          </div>
          <app-apartments
            @open-add-frame="openAddFrame"
            :house="readyHouse"
            @change-frame="changeFrame"
            :token="token"
            @edit-flat="editFlat"
            :language="language"
            :statuses="statuses"
            :titleTable="titleTable" />
        </section>
        <!--Фото-->
        <section v-if="page === 3">
          <div class="section-head">
            <UiTitle :title="language.dob_kv_1[24]" :type="2" />
          </div>
          <app-add-photo
            :house="readyHouse"
            :language="language"
            :photos="photos"
            :token="token"
            @loader="loader_status = !loader_status" />
        </section>
        <!--Файлы-->
        <section v-if="page === 4">
          <div class="section-head">
            <UiTitle :title="language.dob_kv_1[25]" :type="2" />
          </div>
          <app-add-files
            :house="readyHouse"
            :language="language"
            :token="token" />
        </section>
      </div>
    </div>
  </main>
  <app-footer :language="language" />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import UiTitle from '@/Components/UI/ui-title.vue'
import UiInputBox from '@/Components/UI/ui-input-box.vue'
import UiButton from '@/Components/UI/ui-button.vue'
import UiSelect from '@/Components/UI/ui-select.vue'
import ObjectDescription from '@/Components/Profile/DescriptionObject.vue'
import MapBlock from '@/Components/Profile/MapBlock.vue'
import ContactsSales from '@/Components/Profile/ContactsSales.vue'

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
      object: {
            title: "",
            description: "",
            description_en: "",
            description_tr: "",
            city: "",
            area: "",
            coordinates: "",
            percent: "",
            comment: "",
            statusHouse: "",
            floors: "",
            type: "",
            dop: [],
            info: [],
            toSea: null,
            toSchool: null,
            toShop: null,
            toPark: null,
            toBus: null,
            toChildrenSchool: null,
            installment: 0,
            count_flat: "",
            text_agency: "",
            token: this.user.token
        }
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
    UiTitle,
    UiInputBox,
    UiButton,
    UiSelect,
    AppAddContacts,
    AppAddFiles,
    ObjectDescription,
    AppHeader,
    AppFooter,
    AppInfoJK,
    AppApartments,
    AppAddPhoto,
    AppModalAddContact,
    AppModalAddApartments,
    AppModalAddFrame,
    AppModalNotification,
    MapBlock,
    ContactsSales
  }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<style scoped>
.container{
  display: grid;
  grid-template-columns: 20vw 1fr 20vw;
  margin: 0 auto;
  box-sizing: content-box;
  max-width: 1680px;
  padding-top: 50px;
  gap: 30px;
  margin-bottom: 50px;
}
.list-panel{
    padding:25px;
    background: rgb(246 243 250 );
    border-radius: 6px;
    height: fit-content;
    display: flex;
    flex-direction: column;
    gap: 10px;
    position: sticky;
    top: 0px;
}
.list-panel .link-block{
    padding: 16px;
    border-radius: 6px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.5s;
}
.list-panel .link-block:hover{
  background: rgba(100, 53, 165, 0.1);
}
.list-panel .link-block.active{
    background: #6435A5;
    color: #fff;
}
.center-content section{
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.grid-options{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.wrapper-options{
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.section-head{
  display: flex;
  justify-content: space-between;
  align-items: center;
  min-height: 60px;
}
</style>
