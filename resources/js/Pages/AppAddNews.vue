<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header />
  <main>
    <div class="_container">
      <div class="px-[22.23vw] relative mx-auto max-w-[826px] box-content">
        <div class="my-14 xxl:my-10 xl:my-8">
          <h2 class="text-[22px] xxl:text-lg xl:text-[15px] font-semibold pb-7 xxl:pb-5 xl:pb-4">Добавить новости</h2>
          <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3">
            <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectJK}">
              <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">ЖК</span>
              <div class="relative">
                <div @click="openSelectJK = !openSelectJK" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 pb-3 xxl:pb-2.5 xl:pb-2">
                  <span>{{ selectJK }}</span>
                  <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectJK }" alt="">
                </div>
                <div v-if="openSelectJK" class="absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
              <span
                v-for="(JK, idx) in JKs" :key="idx"
                @click="changeSelectJK(JK)"
                class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
              >
                {{ JK.JK }}
              </span>
                </div>
              </div>
            </div>
            <div class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-3 xxl:gap-2.5 xl:gap-2 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
              <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name_dev">Заголовок новости</label>
              <input v-model="dataNews.title" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name_dev" placeholder="Введите заголовок">
            </div>
            <div>
              <QuillEditor
                toolbar="full"
                v-model:content="dataNews.description"
                content-type="html"
                theme="snow"
              />
            </div>
            <button @click="addNews" class="bg-[#E84680] rounded-[5px] w-full py-5 xxl:py-4 xl:py-3">
              <span class="text-white text-center font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">Добавить</span>
            </button>
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

import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  data() {
    return {
      selectJK: 'Нажмите для выбора ЖК',
      openSelectJK: false,
      JKs: [
        { JK: 'Euro Avsallar Residence 1', value: 1 },
        { JK: 'Euro Avsallar Residence 2', value: 2 },
        { JK: 'Euro Avsallar Residence 3', value: 3 },
        { JK: 'Euro Avsallar Residence 4', value: 4 },
        { JK: 'Euro Avsallar Residence 5', value: 5 },
      ],
      dataNews: {
        title: null,
        description: null
      }
    }
  },
  methods: {
    changeSelectJK(JK) {
      this.selectJK = JK.JK
      this.openSelectJK = false
    },
    addNews() {
      axios.post('/api/news/add', {
        house_id: null,
        title: this.dataNews.title,
        description: this.dataNews.description
      })
    },
  },
  components: {
    AppHeader,
    AppFooter,
    QuillEditor,
  }
}
</script>

<style scoped>

</style>
