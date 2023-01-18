<template>
  <app-modal-notification v-if="openNotification" @close-notification="openNotification = false" />
  <app-add-selections @open-i-create-selections="openCreateSel"
                      v-if="openAddSelection"
                      @close-add-selection="openAddSelection = false"
                      :house="house"
                      :compilation="compilation"
  />
  <app-immovables-create-selection
      :user="user"
      v-if="openCreateSelection"
      @close-add-selection="openAddSelection = false"
      @close-i-create-selection="closeCreateSel"
      :title="titleNewCompilation"
      :house="house"
  />
  <app-header :user="user" />
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
        />
        <app-news-developer />
      </div>
      <div class="w-full flex justify-center mb-14 xxl:mb-10 xl:mb-8" @click="count += 3">
        <button class="more__button transition-all text-[#E84680] border border-solid border-[#E84680] text-base xxl:text-sm xl:text-xs px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2.5 xl:py-1.5 rounded-[3px]">Показать еще</button>
      </div>
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
import {usePage} from "@inertiajs/inertia-vue3";
import {computed} from "vue";

export default {
  props: {
    houses: [],
    dops: [],
    infos: [],
    city: [],
    builders: [],
    compilation: []
  },
  data() {
    return {
      user: computed(() => usePage().props.value.auth.user),
      openNotification: false,
      openAddSelection: false,
      openCreateSelection: false,
      count: 6,
      house: null,
      titleNewCompilation: ''
    }
  },
  methods: {
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
    }
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
  },
}
</script>

<style scoped>

</style>
