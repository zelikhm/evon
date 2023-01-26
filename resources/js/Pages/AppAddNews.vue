<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-modal-notification
    class="left-[2vw] transition-all duration-1000"
    :class="{'-left-full': openNotification}"
    @close-notification="openNotification = false"
  />
  <app-header :user="user" />
  <main>
    <div class="_container">
      <div class="px-[20vw] lg:px-[10vw] md:px-[6vw] sm:px-0 relative mx-auto max-w-[826px] box-content">
        <div class="my-14 xxl:my-10 xl:my-8">
          <h2 class="text-[22px] xxl:text-lg xl:text-[15px] lg:text-[18px] font-semibold pb-7 xxl:pb-5 xl:pb-4">{{ itemEdit === undefined ? 'Добавить новости' : 'Редактировать новость' }}</h2>
          <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">
            <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectJK, 'validate': !validate.JK}">
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[12px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">ЖК</span>
              <div class="relative">
                <div @click="openSelectJK = !openSelectJK" class="flex items-center justify-between cursor-pointer text-[#1E1D2D]  text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 pb-3 xxl:pb-2.5 xl:pb-2">
                  <span>{{ selectJK }}</span>
                  <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectJK }" alt="">
                </div>
                <div v-if="openSelectJK" class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px]">
                  <span
                    v-for="(JK, idx) in selectHouse" :key="idx"
                    @click="changeSelectJK(JK)"
                    class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
                  >
                    {{ JK.title }}
                  </span>
                </div>
              </div>
            </div>
            <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-3 xxl:gap-2.5 xl:gap-2 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]" for="name_dev">Заголовок новости</label>
              <input v-model="dataNews.title" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name_dev">
            </div>
            <div>
              <QuillEditor
                toolbar="full"
                v-model:content="dataNews.description"
                content-type="html"
                theme="snow"
              />
            </div>
            <div @click="addNews" class="cursor-pointer login__btn--bg rounded-[5px] w-full py-5 xxl:py-4 xl:py-3">
              <div class="text-white text-center font-semibold text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none">{{ itemEdit === undefined ? 'Добавить' : 'Редактировать' }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppFooter from "@/Layouts/AppFooter.vue"
import AppHeader from "@/Layouts/AppHeader.vue"
import AppModalNotification from "@/Layouts/modal/AppModalNotification.vue"

import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  props: {
    houses: [],
    new: [],
    user: []
  },
  data() {
    return {
      openNotification: false,
      selectJK: 'Нажмите для выбора ЖК',
      openSelectJK: false,
      href: '#',
      itemEdit: null,
      idNews: null,
      dataNews: {
        house_id: null,
        title: null,
        description: null
      },
      validate: {
        JK: true,
        title: true,
        description: true
      },
      isCreate: null,
      selectHouse: []
    }
  },
  methods: {
    changeSelectJK(JK) {
      this.selectJK = JK.title
      this.dataNews.house_id = JK.id
      console.log(JK)
      this.openSelectJK = false
    },
    addNews() {
      if (this.itemEdit === undefined) {
        axios.post('/api/news/add', {
          house_id: this.dataNews.house_id,
          title: this.dataNews.title,
          description: this.dataNews.description,
          token: this.globalToken
        }).then(response => window.location.href = '/profile/news/')
      } else {
        console.log(this.new.id)
        axios.post('/api/news/edit', {
          house_id: this.dataNews.house_id,
          new_id: this.idNews,
          title: this.dataNews.title,
          description: this.dataNews.description,
          token: this.globalToken
        }).then(response => window.location.href = '/profile/news/')
      }
    },
  },
  created() {
    let link = window.location.href.split('#')
    let link2 = window.location.href.split('/')
    if (link[1] !== undefined) {
      this.dataNews.house_id = this.houses.find(item => item.id === +link[1]).id
      this.selectJK = this.houses.find(item => item.id === +link[1]).title
    }
    if (Number.isInteger(+link2.at(-1))) {
      this.dataNews.house_id = this.houses.find(item => item.id === this.new.house_id).id
      this.selectJK = this.houses.find(item => item.id === this.new.house_id).title
      console.log(this.selectJK)
    } else {
      this.isCreate = true
    }
    this.itemEdit = this.new

    if (this.itemEdit !== undefined) {
      this.selectJK = this.itemEdit.house.title
      this.dataNews.title = this.itemEdit.title
      this.dataNews.description = this.itemEdit.description
      this.idNews = this.itemEdit.id
      console.log(this.itemEdit)
    }

    this.houses.forEach(item => {
      if (item.active === 2) {
        this.selectHouse.push(item)
      }
    })

  },
  components: {
    AppHeader,
    AppFooter,
    QuillEditor,
    AppModalNotification,
  },
}
</script>

<style scoped>

.validate {
  border: 1px solid red;
}

</style>
