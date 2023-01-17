<template>
  <div v-if="openSelection" class="fixed flex justify-end z-[100] top-0 ring-0 w-full h-full">
    <div :class="{'translate__x__0': openSideBar}" class="transition-all ease-linear duration-500 flex flex-col relative z-50 w-[50%] translate-x-full h-full bg-white px-28 xxl:px-24 xl:px-20 py-14 xxl:py-10 xl:py-8">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-[22px] xxl:text-lg xl:text-base font-semibold">Создание подборки</h2>
        <button @click="$emit('close-create-selection')" class="w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 chat__container--flex">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none">Данные</h3>
        <div :class="{ 'validation': validation.title }" class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label :class="{ 'validation-text': validation.title }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name">Название</label>
          <input @input="validationCheck(0)" v-model="compilation.title" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name">
        </div>
        <div :class="{ 'validation': validation.description }" class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label :class="{ 'validation-text': validation.description }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="comment">Комментарий</label>
          <input @input="validationCheck(1)" v-model="compilation.description" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="comment">
        </div>
        <div class="mb-8 xxl:mb-6 xl:mb-5">
          <input v-model="compilation.isVisible" class="custom__checkbox" type="checkbox" id="chekbox">
          <label class="text-base xxl:text-[13px] xl:text-[11px]" for="chekbox">показывать ЖК и его месторасположение</label>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-8 xxl:gap-6 xl:gap-5">
      <button @click="createCompilation" class="login__btn--bg text-white text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">Создать</button>
      <button @click="$emit('close-create-selection')" class="bg-litepink text-[#E84680] text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">Отменить</button>
    </div>
    </div>
    <div @click="$emit('close-create-selection')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>

export default {
  props: {
    openSelection: Boolean,
    openSideBar: Boolean,
    user: {}
  },
  data() {
    return {
      compilation: {
        title: '',
        description: '',
        isVisible: false
      },
      validation: {
        title: false,
        description: false
      }
    }
  },
  emits: ['close-create-selection'],
  methods: {
    createCompilation() {
      if (this.compilation.title && this.compilation.description) {
        let obj = {
          user_id: this.user.id,
          title: this.compilation.title,
          description: this.compilation.description,
          isVisible: this.compilation.isVisible,
          token: this.globalToken
        }

        axios.post('/api/compilation/create', {
          user_id: this.user.id,
          title: this.compilation.title,
          description: this.compilation.description,
          isVisible: this.compilation.isVisible,
          token: this.globalToken
        }).then(response => this.$emit('close-create-selection', obj, response.data))
      }

      this.compilation.title === '' ? this.validation.title = true : this.validation.title = false
      this.compilation.description === '' ? this.validation.description = true : this.validation.description = false

      this.compilation.title = ''
      this.compilation.description = ''
      this.compilation.isVisible = false
    },
    validationCheck(id) {
      if (id === 0) this.compilation.title.length > 0 ? this.validation.title = false : this.validation.title = true
      else if (id === 1) this.compilation.description.length > 0 ? this.validation.description = false : this.validation.description = true
    }
  },
}
</script>

<style scoped>

.validation {
  border: 1px solid red;
}

.validation-text {
  color: red;
}

</style>
