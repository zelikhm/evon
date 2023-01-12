<template>
  <app-modal-notification v-if="openNotification" @close-notification="openNotification = false" />
  <app-add-selections v-if="openAddSelection" @close-add-selection="openAddSelection = false"/>
  <app-create-selection v-if="openCreateSelection" @close-create-selection="openCreateSelection = false" />
  <app-header :user="user" />
  <main>
    <div class="_container">
      <div class="immovables__grid relative my-14 xxl:my-10 xl:my-8">
        <app-filter
          class="filter__left lg:absolute lg:z-40 lg:top-0 transition-all duration-500 w-full"
          :class="{'animation__filter': openFilter}"
          @close-filter="openFilter = false"
        />
        <app-list-new-building
          @open-filter="openFilter = true"
          @open-add-selections="openAddSelection = true"
        />
        <app-news-developer />
      </div>
      <div class="w-full flex justify-center mb-14 xxl:mb-10 xl:mb-8">
        <button class="more__button transition-all text-[#E84680] border border-solid border-[#E84680] text-base xxl:text-sm xl:text-xs px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2.5 xl:py-1.5 rounded-[3px]">Показать еще</button>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppFilter from "../Components/AppFilter.vue"
import AppListNewBuilding from "../Components/AppListNewBuilding.vue"
import AppNewsDeveloper from "../Components/AppNewsDeveloper.vue"
import AppModalNotification from "../Layouts/modal/AppModalNotification.vue"
import AppAddSelections from "@/Layouts/modal/AppAddSelections.vue"
import AppCreateSelection from "@/Layouts/modal/AppImmovablesCreateSelection.vue"
import {usePage} from "@inertiajs/inertia-vue3";

export default {
  props: {
    houses: [],
  },
  data() {
    return {
      openNotification: false,
      openAddSelection: false,
      openCreateSelection: false,
      openFilter: false,
    }
  },
  components: {
    AppHeader,
    AppFooter,
    AppFilter,
    AppListNewBuilding,
    AppNewsDeveloper,
    AppModalNotification,
    AppAddSelections,
    AppCreateSelection,
  },
  created() {
    console.log(this.houses)
  },
}
</script>

<style scoped>

</style>
