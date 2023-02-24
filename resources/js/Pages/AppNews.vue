<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header :user="user" :language="language" @selectLanguage="choseLanguage" />
  <main>
    <div class="_container">
      <div class="flex items-center justify-between mt-14 xxl:mt-10 xl:mt-8">
        <h2 class="text-[22px] xxl:text-lg xl:text-[15px] lg:text-[20px] font-semibold">{{ language.menu_zastr[1] }}</h2>
        <Link href="/profile/news/create" class="register__button--white flex justify-center items-center gap-2 xl:gap-1.5 border border-solid rounded-[5px] border-[#6435A5] px-4 xxl:px-3 xl:px-2.5 py-2.5 xxl:py-2 xl:py-1.5">
          <svg width="16" height="16" class="w-4 xxl:w-3.5 xl:w-3 lg:w-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_519_1862)">
              <path d="M7.33398 7.33301V3.33301H8.66732V7.33301H12.6673V8.66634H8.66732V12.6663H7.33398V8.66634H3.33398V7.33301H7.33398Z" fill="#6435A5"/>
            </g>
            <defs>
              <clipPath id="clip0_519_1862">
                <rect width="16" height="16" fill="white"/>
              </clipPath>
            </defs>
          </svg>
          <span class="leading-none text-base xxl:text-sm xl:text-xs lg:text-[14px] font-medium">{{ language.lk_zastr_news[3] }}</span>
        </Link>
      </div>
      <div class="flex flex-col overflow-x-auto custom__scroll--chess p-2 gap-5 xxl:gap-4 xl:gap-3 my-7 xxl:my-5 xl:my-4">
        <div class="grid__news text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[15px]">
          <span class="p-5 xxl:p-4 xl:p-3 whitespace-nowrap">{{ language.lk_zastr_news[0] }}</span>
          <span class="p-5 xxl:p-4 xl:p-3 whitespace-nowrap">{{ language.lk_zastr_news[1] }}</span>
          <span class="p-5 xxl:p-4 xl:p-3 whitespace-nowrap">{{ language.lk_zastr_news[2] }}</span>
        </div>
        <div class="news__line flex justify-between items-center rounded-[12px]" v-for="item in readyNews">
          <div class="grid__news text-base xxl:text-sm xl:text-xs lg:text-[15px]">
            <span class="p-5 xxl:p-4 xl:p-3 whitespace-nowrap overflow-hidden">{{ item.house.title }}</span>
            <span class="p-5 xxl:p-4 xl:p-3 whitespace-nowrap overflow-hidden">{{ item.title }}</span>
            <span class="p-5 xxl:p-4 xl:p-3 whitespace-nowrap">{{ new Date(Date.parse(item.created_at)).toISOString().replace(/^([^T]+)T(.+)$/,'$1').replace(/^(\d+)-(\d+)-(\d+)$/,'$3.$2.$1')}}</span>
          </div>
          <div class="flex flex-shrink-0 gap-4 xxl:gap-3 xl:gap-2.5 p-5 xxl:p-4 xl:p-3">
            <button @click="changeVisible(item)">
              <img v-if="item.visible" src="../../assets/svg/eye_icon_grey.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
              <img v-if="!item.visible" src="../../assets/svg/eye_close.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
            </button>
            <Link :href="'/profile/news/edit/' + item.id">
              <img src="../../assets/svg/pen_icon_grey.svg" class="w-6 xxl:w-5 xl:w-4 lg:w-5" alt="">
            </Link>
            <button @click="delNews(item)">
              <img src="../../assets/svg/bucket_icon_red.svg" class="w-6 xxl:w-5 xl:w-4 lg:w-5" alt="">
            </button>
          </div>
        </div>
        <div class="news__line flex justify-between items-center rounded-[10px]" v-if="news.length === 0">
          <h1 class="text-center">{{ language.menu_zastr[1] + ' ' + language.default[1] }}</h1>
        </div>
      </div>
      <div class="w-full flex justify-center gap-7 xxl:gap-5 xl:gap-4 my-14 xxl:my-10 xl:my-8 text-[22px] xxl:text-lg xl:text-[15px] lg:text-[20px]">
<!--        <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">-->
<!--          <img src="../../assets/svg/arrow_right_grey.svg" class="rotate-180 w-8 xxl:w-6 xl:w-5" alt="">-->
<!--        </div>-->
<!--        <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">1</div>-->
<!--        <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">2</div>-->
<!--        <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">3</div>-->
<!--        <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">...</div>-->
<!--        <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">24</div>-->
<!--        <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">-->
<!--          <img src="../../assets/svg/arrow_right_grey.svg" class="w-8 xxl:w-6 xl:w-5" alt="">-->
<!--        </div>-->
      </div>
    </div>
  </main>
  <app-footer :language="language" />
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
      readyNews: [],
      language: {},
      selectLanguage: 0,
    }
  },
  methods: {
    delNews(news) {
      this.readyNews.forEach((item, idx) => {
        if (item.id === news.id) {
          this.readyNews.splice(idx, 1)
        }
      })
      axios.post('/api/news/delete', {
        new_id: news.id,
        token: this.user.token
      })
    },
    changeVisible(item) {
      item.visible = !item.visible
      axios.post('/api/news/visible', {
        new_id: item.id,
        visible: item.visible,
        token: this.user.token
      })
    },
    choseLanguage(language) {
      this.selectLanguage = language;

      if(this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }

    },
  },
  components: {
    AppHeader,
    AppFooter,
  },
  created() {
    if(this.user.lang === 0) {
      this.language = this.$ru;
    } else if (this.user.lang === 1) {
      this.language = this.$en;
    } else if (this.user.lang === 2) {
      this.language = this.$tur;
    }

    this.readyNews = this.news.sort((a, b) => Date.parse(b.created_at) - Date.parse(a.created_at))
    // console.log(this.user)
  }
}
</script>

<style scoped>

</style>
