<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-modal-notification
    v-if="openNotification"
    @close-notification="openNotification = false"
  />
  <app-header />
  <main>
    <div class="_container">
      <div class="px-[22.23vw] relative mx-auto max-w-[826px] box-content">
        <div class="my-14 xxl:my-10 xl:my-8">
          <h2 class="text-[22px] xxl:text-lg xl:text-[15px] font-semibold pb-7 xxl:pb-5 xl:pb-4">{{ itemEdit === undefined ? 'Добавить новости' : 'Редактировать новость' }}</h2>
          <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">
            <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectJK, 'validate': !validate.JK}">
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">ЖК</span>
              <div class="relative">
                <div @click="openSelectJK = !openSelectJK" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 pb-3 xxl:pb-2.5 xl:pb-2">
                  <span>{{ selectJK.title }}</span>
                  <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectJK }" alt="">
                </div>
                <div v-if="openSelectJK" class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
              <span
                v-for="(JK, idx) in houses" :key="idx"
                @click="changeSelectJK(JK)"
                class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
              >
                {{ JK.title }}
              </span>
                </div>
              </div>
            </div>
            <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-3 xxl:gap-2.5 xl:gap-2 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name_dev">Заголовок новости</label>
              <input v-model="dataNews.title" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name_dev">
            </div>
            <div>
              <QuillEditor
                toolbar="full"
                v-model:content="dataNews.description"
                content-type="html"
                theme="snow"
              />
            </div>
            <Link href="#" @click="addNews" class="bg-[#E84680] rounded-[5px] w-full py-5 xxl:py-4 xl:py-3">
              <div class="text-white text-center font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">{{ itemEdit === undefined ? 'Добавить' : 'Редактировать' }}</div>
            </Link>
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
    new: []
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
      }
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
        console.log({
          house_id: this.dataNews.house_id,
          title: this.dataNews.title,
          description: this.dataNews.description,
          token: this.globalToken
        })
        axios.post('/api/news/add', {
          house_id: this.dataNews.house_id,
          title: this.dataNews.title,
          description: this.dataNews.description,
          token: this.globalToken
        })
      } else {
        axios.post('/api/news/edit', {
          house_id: this.idNews,
          new_id: this.dataNews.house_id,
          title: this.dataNews.title,
          description: this.dataNews.description,
          token: this.globalToken
        })
      }
    },
  },
  created() {
    let link = window.location.href.split('#')
    let link2 = window.location.href.split('/')
    if (link[1] !== undefined) {
      console.log(this.houses)
      this.dataNews.house_id = this.houses.find(item => item.id === +link[1])
      this.selectJK = this.houses.find(item => item.id === +link[1])
    }
    if (Number.isInteger(+link2.at(-1))) {
      this.dataNews.house_id = this.houses.find(item => item.id === +link2.at(-1)).id
      this.selectJK = this.houses.find(item => item.id === +link2.at(-1)).title
    }
    console.log(this.houses)

    this.itemEdit = this.new
    if (this.itemEdit !== undefined) {
      this.selectJK = this.itemEdit.house.title
      this.dataNews.title = this.itemEdit.title
      this.dataNews.description = this.itemEdit.description
      this.idNews = this.itemEdit.id
    }
  },
  components: {
    AppHeader,
    AppFooter,
    QuillEditor,
    AppModalNotification,
  }
}
</script>

<style scoped>

.validate {
  border: 1px solid red;
}

</style>
