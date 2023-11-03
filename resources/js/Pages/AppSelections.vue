<template>
  <app-modal-notification class="left-[2vw] transition-all duration-1000" :class="{ '-left__full': !openNotification }"
    @close-notification="openNotification = false" />
  <app-create-selections :user="user" @close-create-selection="closeCreateSelection" @close-selection="closeSelection"
    :openSideBar="openSideBar" v-if="openCreateSelection" :openSelection="openCreateSelection"
    :itemCompilation="itemCompilation" :language="language" />
  <app-submit-selection v-if="submitSelection" @closeSubmitSelection="submitSelection = false" :link="link"
    :language="language" :user="user" />
  <app-header :user="user" :language="language" @selectLanguage="choseLanguage" />
  <main>
    <div class="_container">
      <div class="flex wraper-block justify-between items-center mt-14 xxl:mt-10 xl:mt-8">
        <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5">
          <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] lg:text-[20px] leading-none">{{
            language.rielt_2[0] }} <span>{{ language.subscription[78] }}</span></h2>
          <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px] leading-none">{{
            language.izbr_1[2] }} {{ compilation.length }} шт.</span>
        </div>
<!--        <button-->
<!--          v-on:click="openSelection"-->
<!--          class="login__btn&#45;&#45;bg text-white text-base xxl:text-sm xl:text-xs lg:text-[15px] px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2 xl:py-1.5 rounded-[3px] leading-none">-->
<!--          {{ language.subscription[77] }}-->
<!--        </button>-->
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-1 gap-x-10 gap-y-4 mt-8 xxl:mt-7 xl:mt-6 mb-28 xxl:mb-24 xl:mb-20">
        <div class="contact__selling grid__selection-block rounded-[10px]" v-for="(item, idx) in compilationReady">
          <img
            class="p-2.5 xxl:p-2 xl:p-1.5 w-full h-[140px] exl:h-[8.5vw] lg:h-[17vw] sm:h-[36vw] rounded-[4px] object-cover"
            v-if="item.image" :src="item.image" alt="">
          <img
            class="p-2.5 xxl:p-2 xl:p-1.5 w-full h-[140px] exl:h-[8.5vw] lg:h-[17vw] sm:h-[36vw] rounded-[4px] object-cover"
            v-else src="../../assets/no-img-houses.jpg" alt="">
          <div class="flex items-center sm:items-start sm:flex-col">
            <div
              class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5 w-full py-2.5 xxl:py-2 xl:py-1.5 pl-2.5 xxl:pl-2 xl:pl-1.5 pr-20 xxl:pr-16 xl:pr-12 md:pr-2.5">
              <div class="row-preview">
                <span @click="openSelectionWithProps(item)"
                  class="cursor-pointer text-lg xxl:text-[15px] xl:text-[13px] lg:text-[17px] text-[#1E1D2D] font-medium leading-none">{{
                    item.title }}

                </span>
                <a class="Preview" target="_blank" :href="previewLink(item)">
                  <button>{{ language.subscription[83] }}</button>
                </a>
              </div>
              <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px] leading-none">{{
                item.values.length }} {{ language.ob[35] }}</span>
              <div :class="{ 'border-[#6435A5]': item.isEdit, 'border-[#E5DFEE]': !item.isEdit }"
                class="hover__title-block transition-all flex w-full border border-solid rounded-[5px] p-3 xxl:p-2.5 xl:p-2">
                <input :disabled="!item.isEdit"
                  class="p-0 text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] w-full leading-none focus:ring-0"
                  v-model="item.description" type="text">
                <button @click="editComment(item)" :class="{ 'text-[#6435A5]': item.isEdit }"
                  class="text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[14px] leading-none">{{ item.isEdit ?
                    language.dob_ob_1[24] : language.menu_zastr_1[9] }}</button>
              </div>

            </div>
            <div
              class="tools relative border__left sm:border-0 flex flex-col sm:flex-row h-full sm:h-fit sm:w-full justify-evenly sm:py-1">
              <button  @click="openSelectionWithProps(item)"
                class="relative px-5 xxl:px-4 xl:px-3 h-full sm:h-fit sm:flex-shrink-0">
                <img src="../../assets/svg/pen_icon_grey.svg"
                  class="w-6 xxl:w-5.5 xl:w-5 lg:w-6 h-6 xxl:h-5.5 xl:h-5 lg:h-6" alt="">
                  <span>{{ language.subscription[84] }}</span>
              </button>
              <div class="w-full sm:w-[1px] h-[1px] sm:h-full bg-[#E5DFEE] flex-shrink-0"></div>
              <button @click="onModalWithLink(item)" class="relative px-5 xxl:px-4 xl:px-3 h-full sm:h-fit sm:flex-shrink-0">
                <img src="../../assets/svg/arrow_tray_top.svg"
                  class="w-6 xxl:w-5.5 xl:w-5 lg:w-6 h-6 xxl:h-5.5 xl:h-5 lg:h-6" alt="">
                  <span>{{ language.subscription[85] }}</span>
              </button>
              <div class="w-full sm:w-[1px] h-[1px] sm:h-full bg-[#E5DFEE]"></div>
              <button @click="item.deleteConfirm = true" class="relative px-5 xxl:px-4 xl:px-3 h-full sm:h-fit sm:flex-shrink-0">
                <img src="../../assets/svg/bucket_icon_red.svg"
                  class="w-6 xxl:w-5.5 xl:w-5 lg:w-6 h-6 xxl:h-5.5 xl:h-5 lg:h-6" alt="">

              </button>
              <div v-if="item.deleteConfirm"
                class="cursor-auto z-20 text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] absolute top-[110%] bg-white right-0 flex flex-col border border-solid border-[#CEC3DD] rounded-[5px]">
                <span class="whitespace-nowrap text-center border__bottom p-2.5 xxl:p-2 xl:p-1.5 leading-none">Вы уверены
                  что хотите удалить?</span>
                <div class="cursor-pointer flex">
                  <div
                    class="hover__select w-full text-center border__right p-2.5 xxl:p-2 xl:p-1.5 leading-none text-[red]"
                    @click="deleteCompilation(item)">
                    {{ language.default[0] }}</div>
                  <div @click="item.deleteConfirm = false"
                    class="hover__select w-full text-center p-2.5 xxl:p-2 xl:p-1.5 leading-none text-[green]">
                    {{ language.default[1] }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer :language="language" />
</template>
<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppModalNotification from "@/Layouts/modal/AppModalNotification.vue"
import AppCreateSelections from "@/Layouts/modal/AppCreateSelections.vue"
import AppSubmitSelection from "@/Layouts/modal/AppSubmitSelection.vue"
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
  props: ['compilation', 'houses', 'house', 'user'],
  data() {
    return {
      openNotification: false,
      openCreateSelection: false,
      openSideBar: false,
      deleteConfirm: false,
      submitSelection: false,
      link: null,
      isOpenCreateSelections: false,
      itemCompilation: null,
      compilationReady: [],
      language: {},
      selectLanguage: 0,
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
    openSelection() {
      this.openCreateSelection = true
      setTimeout(() => {
        this.openSideBar = true
      }, 10)
    },
    openSelectionWithProps(item) {
      this.itemCompilation = item
      this.openSelection()
    },
    closeCreateSelection(data) {
      this.compilationReady = data
      this.openSideBar = false

      setTimeout(() => {
        this.openCreateSelection = false
      }, 500)
    },
    closeSelection() {
      this.openSideBar = false
      setTimeout(() => {
        this.openCreateSelection = false
      }, 500)
    },
    deleteCompilation(item) {
      this.deleteConfirm = false
      axios.post('/api/compilation/delete', {
        id: item.id,
        token: this.user.token
      })

      this.compilationReady.forEach((i, idx) => {
        if (i.id === item.id) {
          this.compilationReady.splice(idx, 1)
        }
      })
    },
    onModalWithLink(item) {
      this.submitSelection = true
      if (this.user.subscription) {
        this.link = `${document.location.protocol}//${document.location.host}/compilation/${10000 + item.id}`
      } else {
        this.link = `${document.location.protocol}//${document.location.host}/compilation/****`
      }

    },
    editComment(item) {
      item.isEdit = !item.isEdit

      if (!item.isEdit) {
        this.editCompilation(item)
      }
    },
    editCompilation(item) {
      axios.post('/api/compilation/edit', {
        id: item.id,
        title: item.title,
        description: item.description,
        isVisible: item.isVisible,
        token: this.user.token
      }).then(response => console.log(response))
    },


    previewLink(item) {
      return `${window.location.protocol}//${window.location.host}/compilation/${10000 + item.id}`;
    },
  },
  created() {
    if (this.user.lang === 0) {
      this.language = this.$ru;
    } else if (this.user.lang === 1) {
      this.language = this.$en;
    } else if (this.user.lang === 2) {
      this.language = this.$tur;
    }

    this.compilationReady = this.compilation

    this.compilationReady.forEach(item => {
      item.isEdit = false
      item.deleteConfirm = false

      item.createdAtParse = Date.parse(item.created_at)
    })

    this.compilationReady = this.compilationReady.sort((a, b) => b.createdAtParse - a.createdAtParse)
  },
  components: {
    AppHeader,
    AppFooter,
    AppModalNotification,
    AppCreateSelections,
    AppSubmitSelection,
  }
}
</script>

<style scoped>
h2 {
  display: flex;
    align-items: center;
    gap: 35px;
}
h2 span{
  font-weight: 400;
  font-size: 13px;
  display:block;
  background: rgb(246 243 250);
    padding: 7px 8px;
    border-radius: 6px;
    display: block;
    font-size: 12px;
    color: rgb(100 53 165 );
    font-weight: 500;
}
.row-preview{
  display: flex;
  justify-content: space-between;
  align-items: center;

}

.row-preview .Preview{
  font-size: 12px;
    color: rgb(140 92 207 / 1);
    border: 3px solid rgb(140 92 207 / 50%);
    border-radius: 10px;
    padding: 4px 14px;
    cursor: pointer;
    transition: 0.2s;
    text-decoration: none;
}

.row-preview .Preview:hover{
  color: white;
  border: 3px solid transparent;
  background: rgb(140 92 207 / 50%);
}

.tools button:hover span{
  opacity: 1;
  visibility: visible;
  transition: opacity 0.2s, visibility 0.2s;
}
.tools button span{
  position: absolute;
    right: calc(50% - 71px );
    top: -40px;
    width: 142px;
    padding: 7px 7px;
    background: rgb(246 243 250);
    color: rgb(100 53 165);
    border-radius: 5px;
    left: auto;
    font-size: 13px;
    line-height: 12px;
    text-align: center;
    opacity: 0;
    visibility: hidden;
}

.creat{

}



@media (max-width: 992px) {

  .wraper-block{
    display: flex;
    flex-direction: column;
    gap: 18px;
    align-items: center;
  }
  .wraper-block  span{
    text-align: center;
  }
  h2 span{
    text-align: center;
  }

  .tools button span {
    display: none;
  }
  h2 {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
}

</style>
