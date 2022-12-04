<template>
  <app-header
    @login-developer="openLoginDeveloper = !openLoginDeveloper"
    @login-realtor="openLoginRealtor = !openLoginRealtor"
  />
  <main>
    <div class="_container">
      <div class="immovables__grid">
        <div class="bg-[] p-7 ">

        </div>

        <div></div>

        <div></div>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"

export default {
  components: {
    AppHeader,
    AppFooter,
  }
}
</script>

<style scoped>

</style>
