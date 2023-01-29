<template>
  <app-modal-add-contact @close-add-contact="closeModalContact"
                         @close-edit-contact="closeModalBeforeEdit"
                         v-if="modalAddContact"
                         :contact="contact"
                         :house="house"
  />
  <app-modal-add-apartments @close-add-apartments="closeAddApartments"
                            v-if="modalAddApatments"
                            :house="house"
                            :activeFrame="activeFrame"
                            :selectFlat="selectFlat"
  />
  <app-modal-add-frame v-if="modalAddFrame" @close-add-frame="closeAddFrame" :house="house" :isEdit="isEdit" :frame="frame" />
  <app-modal-notification
    class="left-[2vw] transition-all duration-1000"
    :class="{'-left__full': !openNotification}"
    @close-notification="openNotification = false"
  />
  <app-header :user="user" />
  <main>
    <div class="_container">
      <div :class="{'grid__apartments': page === 1}" class="grid__add-object my-14 xxl:my-10 xl:my-8 gap-7 xxl:gap-5 xl:gap-4">
        <div class="relative">
          <div class="sticky lg:relative top-10 lg:top-0 z-50 w-[20vw] lg:w-full">
            <div class="bg-[#F6F3FA] h-fit p-7 xxl:p-5 xl:p-4 rounded-[6px]">
              <div class="flex flex-col gap-3 xxl:gap-2.5 xl:gap-2">
                <div @click="openPage(0)" :class="{ 'menu-add-obj': page === 0}" class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">Информация о ЖК</div>
                <div @click="openPage(4)" :class="{ 'menu-add-obj': page === 4}" class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">Контакты отдела продаж</div>
                <div @click="openPage(1)" :class="{ 'menu-add-obj': page === 1}" class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">Корпуса и квартиры</div>
                <div @click="openPage(2)" :class="{ 'menu-add-obj': page === 2}" class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">Фото</div>
                <div @click="openPage(3)" :class="{ 'menu-add-obj': page === 3}" class="hover__menu-add-obj transition-all cursor-pointer rounded-[6px] leading-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] p-5 xxl:p-4 xl:p-3">Файлы</div>
              </div>
            </div>
            <div :class="{'hidden': page !== 1}" class="flex justify-center mt-12 xxl:mt-10 xl:mt-8">
              <button @click="modalAddApatments = !modalAddApatments" class="register__button--white text-[#6435A5] flex justify-center items-center gap-2 xl:gap-1.5 border border-solid rounded-[5px] border-[#6435A5] px-4 xxl:px-3 xl:px-2.5 py-2.5 xxl:py-2 xl:py-1.5">
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
                <span class="leading-none text-base xxl:text-sm xl:text-xs lg:text-[15px] font-medium">Добавить квартиру</span>
              </button>
            </div>
          </div>
        </div>

<!--  Информация о ЖК  -->
        <div v-if="page === 0">
          <app-info-j-k :dops="dops"
                        :infos="infos"
                        :city="city"
                        :count="count"
                        :house="house"
                        :supports="supports"
                        @addAndContinue="addAndContinue"
          />
        </div>

<!--  Корпуса и квартиры  -->
        <div v-if="page === 1">
          <app-apartments @open-add-frame="openAddFrame"
                          :house="readyHouse"
                          @change-frame="changeFrame"
                          @edit-flat="editFlat"
          />
        </div>

<!--  Фото  -->
        <div v-if="page === 2">
          <app-add-photo :house="readyHouse"
          />
        </div>

        <div v-if="page === 3">
          <app-add-files
              :house="readyHouse"
          />
        </div>

        <div v-if="page === 4">
          <app-add-contacts
              :house="readyHouse"
              :supports="supports"
              @open-add-contact="openAddContact"
              @open-edit-contact="openEditContact"
          />
        </div>

      </div>
    </div>

  </main>
  <app-footer />
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
    house: []
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
      contact: null
    }
  },
  methods: {
    editFlat(data) {
      this.modalAddApatments = true
      this.selectFlat = data
      console.log(this.selectFlat)
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
    closeAddFrame(data) {
      this.modalAddFrame = false
      if (this.readyHouse.frames.length === 1) {
        this.activeFrame = this.readyHouse.frames[0].id
      }
      this.readyHouse = data
    },
    changeFrame(data) {
      this.activeFrame = data
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

</style>
