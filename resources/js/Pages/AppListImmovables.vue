<template>
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
  />
  <app-immovables-create-selection
      :user="user"
      v-if="openCreateSelection"
      @close-add-selection="openAddSelection = false"
      @close-i-create-selection="closeCreateSel"
      @update-compilation="updateCompilation"
      :title="titleNewCompilation"
      :house="house"
  />
  <app-header :user="user"
              @update-block-client="updateBlockClient"
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
        />
        <app-news-developer
            class="block lg:hidden"
            :news="news"
            :adminNews="adminNews"
            v-if="!isWithClient"
        />
      </div>
      <app-news-developer class="hidden lg:block mb-14 xxl:mb-10 xl:mb-8"
                          :news="news"
                          :adminNews="adminNews"
                          v-if="!isWithClient"
      />
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppListNewBuilding from "../Components/AppListNewBuilding.vue"
import AppNewsDeveloper from "../Components/AppNewsDeveloper.vue"
import AppModalNotification from "../Layouts/modal/AppModalNotification.vue"
import AppAddSelections from "@/Layouts/modal/AppAddSelections.vue"
import AppImmovablesCreateSelection from "@/Layouts/modal/AppImmovablesCreateSelection.vue"
import { router } from '@inertiajs/vue3'
import {usePage} from "@inertiajs/inertia-vue3";
import {computed} from "vue";

export default {
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
      readyCompilation: null
    }
  },
  methods: {
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
      console.log(house)
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
  },
  created() {
    this.readyCompilation = this.compilation
    this.isWithClient = localStorage.getItem('withClient') === 'true' ? true : false
  },
}
</script>

<style scoped>

</style>
