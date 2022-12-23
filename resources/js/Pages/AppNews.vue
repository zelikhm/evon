<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header :user="user" />
  <main>
    <div class="_container">
      <div class="flex items-center justify-between mt-14 xxl:mt-10 xl:mt-8">
        <h2 class="text-[22px] xxl:text-lg xl:text-[15px] font-semibold">Новости</h2>
        <Link href="/profile/news/create" class="flex justify-center items-center gap-2 xl:gap-1.5 border border-solid rounded-[5px] border-[#6435A5] px-4 xxl:px-3 xl:px-2.5 py-2.5 xxl:py-2 xl:py-1.5">
          <img src="../../assets/svg/plus_icon_purple.svg" class="w-4 xxl:w-3.5 xl:w-3" alt="">
          <span class="text-[#6435A5] leading-none text-base xxl:text-sm xl:text-xs font-medium">Добавить новость</span>
        </Link>
      </div>
      <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 my-7 xxl:my-5 xl:my-4">
        <div class="grid__news text-[#8A8996] text-base xxl:text-sm xl:text-xs">
          <span class="p-5 xxl:p-4 xl:p-3">ЖК</span>
          <span class="p-5 xxl:p-4 xl:p-3">Заголовок</span>
          <span class="p-5 xxl:p-4 xl:p-3">Дата публикации</span>
        </div>
        <div class="news__line flex justify-between items-center rounded-[12px]" v-for="item in news">
          <div class="grid__news text-base xxl:text-sm xl:text-xs">
            <span class="p-5 xxl:p-4 xl:p-3">{{ item.house.title }}</span>
            <span class="p-5 xxl:p-4 xl:p-3">{{ item.title }}</span>
            <span class="p-5 xxl:p-4 xl:p-3">{{ new Date(Date.parse(item.created_at)).toISOString().replace(/^([^T]+)T(.+)$/,'$1').replace(/^(\d+)-(\d+)-(\d+)$/,'$3.$2.$1')}}</span>
          </div>
          <div class="flex gap-4 xxl:gap-3 xl:gap-2.5 p-5 xxl:p-4 xl:p-3">
            <button @click="changeVisible(item)">
              <img v-if="item.visible" src="../../assets/svg/eye_icon_grey.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
              <img v-if="!item.visible" src="../../assets/svg/eye_close.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
            </button>
            <Link :href="'/profile/news/edit/' + item.id">
              <img src="../../assets/svg/pen_icon_grey.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
            </Link>
            <button @click="delNews(item)">
              <img src="../../assets/svg/bucket_icon_red.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
            </button>
          </div>
        </div>
        <div class="news__line flex justify-between items-center rounded-[12px]" v-if="news.length === 0">
          <h1 class="text-center">Новостей нет</h1>
      </div>
        <div class="w-full flex justify-center gap-7 xxl:gap-5 xl:gap-4 my-14 xxl:my-10 xl:my-8 text-[22px] xxl:text-lg xl:text-[15px]">
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">
            <img src="../../assets/svg/arrow_right_grey.svg" class="rotate-180 w-8 xxl:w-6 xl:w-5" alt="">
          </div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">1</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">2</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">3</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">...</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">24</div>
          <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">
            <img src="../../assets/svg/arrow_right_grey.svg" class="w-8 xxl:w-6 xl:w-5" alt="">
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

export default {
  props: {
    news: [],
    user: []
  },
  data() {
    return {
    }
  },
  methods: {
    delNews(news) {
      this.news.forEach((item, idx) => {
        if (item.id === news.id) {
          this.news.splice(idx, 1)
        }
      })
      axios.post('/api/news/delete', { new_id: news.id, token: this.globalToken })
    },
    changeVisible(item) {
      item.visible = !item.visible
      axios.post('/api/news/visible', { new_id: item.id, visible: item.visible, token: this.globalToken })
    }
  },
  components: {
    AppHeader,
    AppFooter,
  },
  created() {
    console.log(this.user)
    console.log(this.news)
  }
}
</script>

<style scoped>

</style>
