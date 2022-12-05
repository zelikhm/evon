<template>
  <app-header />
  <main>
    <div class="_container">
      <div class="immovables__grid my-14 xxl:my-10 xl:my-8">
        <app-filter />
        <app-list-new-building />
        <div></div>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppFilter from "../Components/AppFilter.vue"
import AppListNewBuilding from "../Components/AppListNewBuilding.vue";

export default {
  components: {
    AppHeader,
    AppFooter,
    AppFilter,
    AppListNewBuilding,
  }
}
</script>

<style scoped>

</style>
