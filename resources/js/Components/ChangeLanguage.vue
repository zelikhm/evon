<template>
  <div :tabindex="tabindex" @blur="langOptionVisible = false"
    class="z-50 header__lang--select uppercase relative flex items-center h-[60px] xxl:h-12 xl:h-10 lg:h-12">
    <div class="lang lang_fixed">
      <div id="ytWidget" style="display: none;"></div>
      <div class="lang__link lang__link_select" data-lang-active="ru">
      </div>
    </div>
    <div ref="lang"
      class="flex h-full text-white items-center cursor-pointer px-7 xxl:px-5 xl:px-4 lg:px-3 gap-2.5 xl:gap-1.5"
      @click="langOptionVisible = !langOptionVisible">
      <span>{{ langSelected }}</span>
      <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px] lg:w-2" alt="Стрелочка вниз"
        :class="{ 'rotate-180': langOptionVisible }">
    </div>
    <div v-if="langOptionVisible"
      class="border border-solid overflow-hidden border-[#E5DFEE] absolute top-[90%] w-full left-0 flex flex-col bg-white rounded-[5px]">
      <span @click="selectOption('ru')"
        class="hover__select border__bottom--not cursor-pointer leading-none p-4 xxl:p-3 xl:p-2.5">
        RU
      </span>
      <span @click="selectOption('en')"
        class="hover__select border__bottom--not cursor-pointer leading-none p-4 xxl:p-3 xl:p-2.5">
        EN
      </span>
      <span @click="selectOption('tr')"
        class="hover__select border__bottom--not cursor-pointer leading-none p-4 xxl:p-3 xl:p-2.5">
        TR
      </span>
    </div>
  </div>
</template>

<script>
export default {
  name: "ChangeLanguage",
  props: {
    selectLang: 0,
    tabindex: {
      type: Number,
      required: false,
      default: 0,
    },
  },
  data() {
    return {
      langOptionVisible: false,
      langSelected: 'ru'
    }
  },
  methods: {
    selectOption(language) {
      this.langSelected = language

      if (language === 'ru') {
        this.$emit('selectLanguage', 0)
      } else if (language === 'en') {
        this.$emit('selectLanguage', 1)
      } else if (language === 'tr') {
        this.$emit('selectLanguage', 2)
      }

    },
  },
  created() {
    if (this.selectLang === 0) {
      this.langSelected = 'ru'
    } else if (this.selectLang === 1) {
      this.langSelected = 'en'
    } else if (this.selectLang === 2) {
      this.langSelected = 'tr'
    }

    // this.langSelected = localStorage.getItem('language') || 'ru'
  },
}
</script>

<style scoped></style>
