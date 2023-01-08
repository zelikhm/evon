<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col gap-7 xxl:gap-6 xl:gap-5 bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[30%] lg:w-[50%] md:w-[64%] sm:w-[90%] h-fit">
      <div class="relative flex justify-between items-center">
        <h2 class=" text-[22px] xxl:text-lg xl:text-base font-semibold leading-none">Добавить корпус</h2>
        <button @click="this.$emit('close-add-frame')" class="relative w-4 h-4 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div class="flex flex-col border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="frame">Название</label>
        <input v-model="frameName" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="frame">
      </div>
      <button class="login__btn--bg rounded-[5px] w-full py-5 xxl:py-4 xl:py-3" @click="addFrame">
        <span class="text-white font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">Добавить</span>
      </button>
    </div>
    <div @click="this.$emit('close-add-frame')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  props: ['house'],
  data() {
    return {
      frameName: null
    }
  },
  methods: {
    addFrame() {
      axios.post('/api/house/createFrame', { house_id: this.house.id, name: this.frameName, token: this.globalToken })
           .then(response => {
             this.house.frames = response.data
             this.$emit('close-add-frame', this.house)
           })
           .catch(e => console.error(e))

    }
  }
}
</script>

<style scoped>

</style>
