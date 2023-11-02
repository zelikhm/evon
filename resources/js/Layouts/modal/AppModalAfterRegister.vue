<template>
    <div class="fixed z-[100] w-full h-full flex items-center justify-center" v-on:click.self="closeModal">
      <div
        class="modal relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
        <div class="relative mb-10 xxl:mb-8 xl:mb-6">
          <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">{{ language.subscription[82] }}</h2>
        </div>
      </div>
      <div @click="closeModal" class="modal-bg absolute bg-black opacity-50 h-full w-full z-40"></div>
    </div>
</template>

<script>
  export default {
    props: [
      'language',
      'message',
    ],
    name: "AppModalAfterRegister",
    methods: {
      closeModal() {
        this.$emit('close-modal')
      },
    }
  }
</script>

<style scoped>

</style>
