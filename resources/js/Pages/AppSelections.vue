<template>
  <app-modal-notification v-if="openNotification" @close-notification="openNotification = false"/>
  <app-create-selections :user="user"
                         @close-create-selection="closeCreateSelection"
                         @close-selection="closeSelection"
                         :openSideBar="openSideBar"
                         :openSelection="openCreateSelection"/>
  <app-submit-selection v-if="submitSelection" @closeSubmitSelection="submitSelection = false" />
  <app-header :user="user" />
  <main>
    <div class="_container">
      <div class="flex justify-between items-center mt-14 xxl:mt-10 xl:mt-8">
        <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5">
          <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] leading-none">Мои подборки</h2>
          <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Найдено {{ compilation.length }} подборки</span>
        </div>
        <button @click="openSelection" class="login__btn--bg text-white text-base xxl:text-sm xl:text-xs px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2 xl:py-1.5 rounded-[3px] leading-none">Создать подборку</button>
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-1 gap-x-10 gap-y-4 mt-8 xxl:mt-7 xl:mt-6 mb-28 xxl:mb-24 xl:mb-20">
        <div class="contact__selling grid__selection-block rounded-[10px]" v-for="(item, idx) in compilation">
          <img class="p-2.5 xxl:p-2 xl:p-1.5 w-full h-[8.5vw] lg:h-[17vw] sm:h-full rounded-[3px]" src="../../assets/immovables_img_one.png" alt="">
          <div class="flex items-center">
            <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5 w-full py-2.5 xxl:py-2 xl:py-1.5 pl-2.5 xxl:pl-2 xl:pl-1.5 pr-20 xxl:pr-16 xl:pr-12 md:pr-2.5">
              <span class="text-lg xxl:text-[15px] xl:text-[13px] text-[#1E1D2D] font-medium leading-none">{{ item.id }}</span>
              <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">1 ЖК</span>
              <div class="flex w-full border border-solid border-[#6435A5] rounded-[5px] p-3 xxl:p-2.5 xl:p-2">
                <input class="p-0 text-[16px] xxl:text-[14px] xl:text-[12px] w-full leading-none focus:ring-0" v-model="item.description" type="text">
                <button class="text-[#6435A5] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Сохранить</button>
              </div>
            </div>
            <div class="border__left flex flex-col h-full justify-evenly">
              <button class="px-5 xxl:px-4 xl:px-3 h-full">
                <img src="../../assets/svg/pen_icon_grey.svg" class="w-6 xxl:w-5.5 xl:w-5" alt="">
              </button>
              <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
              <button @click="submitSelection = true" class="px-5 xxl:px-4 xl:px-3 h-full">
                <img src="../../assets/svg/screp_icon_grey.svg" class="w-6 xxl:w-5.5 xl:w-5" alt="">
              </button>
              <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
              <button @click="deleteCompilation(item)" class="px-5 xxl:px-4 xl:px-3 h-full">
                <img src="../../assets/svg/bucket_icon_red.svg" class="w-6 xxl:w-5.5 xl:w-5" alt="">
              </button>
<!--              <div v-if="deleteConfirm" class="cursor-auto z-20 text-[16px] xxl:text-[14px] xl:text-[12px] absolute top-[100%] bg-white left-[40%] flex flex-col border border-solid border-[#CEC3DD] rounded-[5px]">-->
<!--                <span class="whitespace-nowrap text-center border__bottom p-2.5 xxl:p-2 xl:p-1.5 leading-none">Вы уверены что хотите удалить?</span>-->
<!--                <div class="cursor-pointer flex">-->
<!--                  <div class="hover__select w-full text-center border__right p-2.5 xxl:p-2 xl:p-1.5 leading-none text-[red]" @click="deleteCompilation(item)">Да</div>-->
<!--                  <div @click="deleteConfirm = false" class="hover__select w-full text-center p-2.5 xxl:p-2 xl:p-1.5 leading-none text-[green]">Нет</div>-->
<!--                </div>-->
<!--              </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer/>
</template>
<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppModalNotification from "@/Layouts/modal/AppModalNotification.vue"
import AppCreateSelections from "@/Layouts/modal/AppCreateSelections.vue"
import AppSubmitSelection from "@/Layouts/modal/ AppSubmitSelection.vue"
import {computed} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

export default {
  props: ['compilation', 'houses'],
  data() {
    return {
      user: computed(() => usePage().props.value.auth.user),
      openNotification: false,
      openCreateSelection: false,
      openSideBar: false,
      deleteConfirm: false,
      submitSelection: false
    }
  },
  methods: {
    openSelection() {
      this.openCreateSelection = true
      setTimeout(() => {
        this.openSideBar = true
      }, 10)
    },
    closeCreateSelection(obj, id) {
      this.openSideBar = false
      obj.id = id
      this.compilation.push(obj)
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
        token: this.globalToken
      })

      this.compilation.forEach((i, idx) => {
        if (i.id === item.id) {
          this.compilation.splice(idx, 1)
        }
      })
    }
  },
  created() {
    console.log(this.houses)
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

</style>
