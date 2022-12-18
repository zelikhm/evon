<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header />
  <main class="bg-[#F6F3FA]">
    <div class="_container">
      <div class="grid__chat my-14 xxl:my-10 xl:my-8">
        <div class="chat__userlist border border-solid border-[#E5DFEE] bg-white">
          <div class="p-4 xxl:p-3 xl:p-2.5">
            <div class="relative">
              <input class="bg-[#F7F7F9] w-full text-sm xxl:text-xs xl:text-[10px] rounded-[6px]" type="text">
            </div>
          </div>
        </div>
        <div class="chat__container border border-solid border-[#E5DFEE] bg-[#E5DFEE]">

        </div>
      </div>
    </div>
  </main>
  <app-footer />
</template>

<script>
import AppFooter from "@/Layouts/AppFooter.vue"
import AppHeader from "@/Layouts/AppHeader.vue"

export default {
  data() {
    return {

    }
  },
  methods: {

  },
  components: {
    AppHeader,
    AppFooter,
  }
}
</script>

<style scoped>

</style>
