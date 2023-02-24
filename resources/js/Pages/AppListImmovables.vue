<template>
  <NewsModal v-if="isNews" @close="isNews = false" :new_object="new_object"></NewsModal>
  <app-modal-notification
    class="left-[2vw] transition-all duration-1000"
    :class="{'-left__full': !openNotification}"
    @close-notification="openNotification = false"
  />
  <app-add-selections @open-i-create-selections="openCreateSel"
                      v-if="openAddSelection"
                      @close-add-selection="openAddSelection = false"
                      :house="house"
                      :compilation="readyCompilation"
                      :user="user"
                      :language="language"
  />
  <app-immovables-create-selection
      :user="user"
      v-if="openCreateSelection"
      @close-add-selection="openAddSelection = false"
      @close-i-create-selection="closeCreateSel"
      @update-compilation="updateCompilation"
      :title="titleNewCompilation"
      :house="house"
      :language="language"
  />
  <app-header :user="user"
              @update-block-client="updateBlockClient"
              :language="language"
              @selectLanguage="choseLanguage"
  />
  <main>
    <div class="_container">
      <div class="immovables__grid relative my-14 xxl:my-10 xl:my-8">
        <app-list-new-building
          @open-add-selections="openSelection"
          :houses="houses"
          :count="count"
          :dops="dops"
          :infos="infos"
          :user="user"
          :city="city"
          :builders="builders"
          :count_houses="count_houses"
          :type="type"
          :language="language"
          :dates="dates"
        />
        <app-news-developer
            @open="(item) => openNewModal(item)"
            class="block lg:hidden"
            :news="news"
            :adminNews="adminNews"
            v-if="!isWithClient"
            :language="language"
        />
      </div>
      <app-news-developer class="hidden lg:block mb-14 xxl:mb-10 xl:mb-8"
                          :news="news"
                          :adminNews="adminNews"
                          v-if="!isWithClient"
                          :language="language"
      />
    </div>
  </main>
  <app-footer :language="language" />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import NewsModal from "../Components/NewsComponent/NewsModal.vue";
import AppListNewBuilding from "../Components/AppListNewBuilding.vue"
import AppNewsDeveloper from "../Components/AppNewsDeveloper.vue"
import AppModalNotification from "../Layouts/modal/AppModalNotification.vue"
import AppAddSelections from "@/Layouts/modal/AppAddSelections.vue"
import AppImmovablesCreateSelection from "@/Layouts/modal/AppImmovablesCreateSelection.vue"
import { router } from '@inertiajs/vue3'
import {usePage} from "@inertiajs/inertia-vue3";
import {computed} from "vue";

export default {
  emits: {

  },
  props: {
    houses: [],
    dops: [],
    infos: [],
    city: [],
    builders: [],
    compilation: [],
    adminNews: [],
    news: [],
    count_houses: 0,
    type: 0,
    user: [],
  },
  provide() {
    return {
      'user': this.user,
    }
  },
  data() {
    return {
      user: computed(() => usePage().props.value.auth.user),
      openNotification: false,
      openAddSelection: false,
      openCreateSelection: false,
      house: null,
      titleNewCompilation: '',
      isWithClient: false,
      readyCompilation: null,
      isNews: false,
      new_object: [],
      language: {},
      selectLanguage: 0,
      dates: [],
    }
  },
  methods: {
    choseLanguage(language) {
      this.selectLanguage = language;

      if(this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }

      this.dates = [
        {date: this.language.rielt_1[5], id: 1},
        {date: this.language.rielt_1[54], id: 2},
        {date: this.language.rielt_1[55], id: 3},
      ];
    },
    openNewModal(item) {
      this.isNews = true;
      this.new_object = item;
    },

    updateCompilation(data) {
      this.readyCompilation.push(data)
    },
    openCreateSel(title) {
      this.openCreateSelection = true
      this.openAddSelection = false
      this.titleNewCompilation = title
    },
    closeCreateSel() {
      this.openCreateSelection = false
      this.openAddSelection = true
    },
    openSelection(house) {
      this.openAddSelection = true
      this.house = house
    },
    updateBlockClient(data) {
      this.isWithClient = data
    },
  },
  components: {
    AppHeader,
    AppFooter,
    AppListNewBuilding,
    AppNewsDeveloper,
    AppModalNotification,
    AppAddSelections,
    AppImmovablesCreateSelection,
    NewsModal
  },
  created() {
    if(this.user.lang === 0) {
      this.language = this.$ru;
    } else if (this.user.lang === 1) {
      this.language = this.$en;
    } else if (this.user.lang === 2) {
      this.language = this.$tur;
    }

    this.dates = [
      {date: this.language.rielt_1[5], id: 1},
      {date: this.language.rielt_1[54], id: 2},
      {date: this.language.rielt_1[55], id: 3},
    ];

    this.readyCompilation = this.compilation
    this.isWithClient = localStorage.getItem('withClient') === 'true' ? true : false
  },
}
</script>

<style scoped>

</style>
