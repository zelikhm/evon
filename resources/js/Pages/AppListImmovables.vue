<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>


<template>
  <NewsModal v-if="isNews" @close="isNews = false" :new_object="new_object" :language="language" ></NewsModal>
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
                      :city_array="city"
                      :area_array="areas"
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
      <div class="immovables__grid relative my-14 xxl:my-10 xl:my-8  ">
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
          :selectLanguage="selectLanguage"
          :areas="areas"
        />
        <app-news-developer
            @open="(item) => openNewModal(item)"
            class="block lg:hidden"
            :news="news"
            :adminNews="adminNews"
            v-if="!isWithClient"
            :language="language"
            :user="user"
        />
      </div>
      <app-news-developer class="hidden lg:block mb-14 xxl:mb-10 xl:mb-8"
                          :news="news"
                          :adminNews="adminNews"
                          v-if="!isWithClient"
                          :language="language"
                          :user="user"
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
    free_count: 0,
    type: 0,
    user: [],
    areas: {},
  },
  provide() {
    return {
      'user': this.user,
    }
  },
  data() {
    return {
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
    getWidth(count){
        return Math.round((30 / count) * 100)
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
      this.selectLanguage = 0;
    } else if (this.user.lang === 1) {
      this.language = this.$en;
      this.selectLanguage = 1;
    } else if (this.user.lang === 2) {
      this.language = this.$tur;
      this.selectLanguage = 2;
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

.hints{
    display: grid;
    grid-template-columns: auto auto auto;
    width: -moz-fit-content;
    width: fit-content;
    margin: 0 auto;
    gap: 25px;
    padding: 20px 0px;
}
.hints p{
  line-height: 30px;
}
.hints .progress{
    border: 2px solid rgba(100, 53, 165, 0.12);
    border-radius: 16px;
    padding: 0px 90px;
    overflow: hidden;
    position: relative;
}
.hints .progress .line{
  background-color: rgba(100, 53, 165, 0.12);

  height: 100%;
  position: absolute;
  left: 0;
}
.hints .progress h4{
  text-align: center;
}
.hints button{
  border: 2px solid #E84680;
  transition: 0.2s;
  display: block;
}
.hints button:hover{
  background: #E84680;
  color: white;
}
@media (max-width:800px) {
  .hints{
    display: block;
    width: 100%;
  }
  .hints p  {
    line-height: 30px;
    text-align: center;
    margin-bottom: 10px;
}
.hints button{
  width: 100%;
  display: block;
  margin: 0 auto;
  padding: 10px;
  margin-top: 15px;
}
.hints .progress {
    padding: 0px 0;
}
  .hints .progress{
    width: 100%;
    margin: 0 auto;
  }
}

</style>
