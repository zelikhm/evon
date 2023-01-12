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
        <app-news-developer />
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppFilter from "../Components/AppFilter.vue"
import AppNewsDeveloper from "../Components/AppNewsDeveloper.vue"
import AppModalNotification from "../Layouts/modal/AppModalNotification.vue"

export default {
  props: {

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
    AppNewsDeveloper,
    AppModalNotification,
  },
}
</script>

<style scoped>

</style>
