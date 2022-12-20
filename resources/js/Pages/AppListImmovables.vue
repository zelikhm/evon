<template>
  <app-modal-notification
    v-if="openNotification"
    @close-notification="openNotification = false"
  />
  <app-header />
  <main>
    <div class="_container">
      <div class="immovables__grid my-14 xxl:my-10 xl:my-8">
        <app-filter />
        <app-list-new-building />
        <app-news-developer />
      </div>
      <div class="w-full flex justify-center mb-14 xxl:mb-10 xl:mb-8">
        <button class="text-[#E84680] border border-solid border-[#E84680] text-base xxl:text-sm xl:text-xs px-6 xxl:px-5 xl:px-4 py-2.5 xxl:py-2.5 xl:py-1.5 rounded-[3px]">Показать еще</button>
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
import AppModalNotification from "../Layouts/AppModalNotification.vue"

export default {
  props: {
    houses: []
  },
  data() {
    return {
      openNotification: false,
    }
  },
  components: {
    AppHeader,
    AppFooter,
    AppFilter,
    AppListNewBuilding,
    AppNewsDeveloper,
    AppModalNotification,
  },
  created() {
    console.log(this.houses)
  }
}
</script>

<style scoped>

</style>
