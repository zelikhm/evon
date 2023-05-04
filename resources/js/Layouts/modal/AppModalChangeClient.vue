<template>
  <div v-if="openChangeClient" class="fixed flex justify-end z-[100] top-0 ring-0 w-full h-full">
    <div :class="{ 'translate__x__0': openSideBar }"
      class="transition-all ease-linear duration-500 flex flex-col relative z-50 w-[50%] lg:w-[64%] sm:w-full translate-x-full h-[100vh] bg-white px-28 xxl:px-24 xl:px-20 lg:px-10 sm:px-5 py-14 xxl:py-10 xl:py-8 lg:py-5">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-[22px] xxl:text-lg xl:text-base font-semibold">Редактировать клиента</h2>
        <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 rotate-45"></div>
          <div class="absolute h-[1px] w-4 -rotate-45"></div>
        </button>
      </div>
      <div
        class="flex flex-col h-[100vh] gap-5 xxl:gap-4 xl:gap-3 chat__container--flex overflow-y-auto custom__scroll--chess">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none">{{ language.rielt_3[1]
        }}</h3>
      </div>
      <div class="grid grid-cols-2 gap-8 xxl:gap-6 xl:gap-5" style="padding-bottom: 80px">
        <button @click="createCompilation"
          class="login__btn--bg text-white text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">
          {{ language.dob_ob_1[24] }}</button>
        <button @click="closeModal"
          class="bg-litepink text-[#E84680] text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">
          {{ language.izbr_1[4] }}</button>
      </div>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>

export default {
  props: ['openChangeClient', 'openSideBar', 'user', 'itemCompilation', 'language'],
  data() {
    return {
      compilation: {
        title: '',
        description: '',
        isVisible: false,
        JK: []
      },
      validation: {
        title: false,
        description: false
      },
      JK: [],
      JKlist: [],
      arrDelJK: []
    }
  },
  emits: ['close-create-selection', 'close-selection'],
  methods: {
    openInput(JK) {
      JK.openInput = true
    },
    closeInput(JK) {
      JK.openInput = false
    },
    deleteJK(item) {
      this.JKlist.forEach((i, idx) => {
        if (i.house.id === item.id) {
          this.JKlist.splice(idx, 1)
          this.arrDelJK.push(item.id)
        }
      })
      console.log(this.JKlist)
      console.log(this.itemCompilation.values)
    },
    createCompilation() {
      if (this.arrDelJK.length > 0) {
        this.arrDelJK.forEach(item => {
          axios.post('/api/compilation/deleteHouse', {
            token: this.user.token,
            compilation_id: this.itemCompilation.id,
            house_id: item
          })
        })
      }

      if (this.compilation.title) {
        axios.post('/api/compilation/edit', {
          user_id: this.user.id,
          id: this.itemCompilation.id,
          title: this.compilation.title,
          description: this.compilation.description,
          isVisible: this.compilation.isVisible,
          token: this.user.token
        }).then(response => {
          let data = response.data.sort((a, b) => Date.parse(b.created_at) - Date.parse(a.created_at))
          this.$emit('close-create-selection', data)
        })
      }

      this.compilation.title === '' ? this.validation.title = true : this.validation.title = false
      this.compilation.description === '' ? this.validation.description = true : this.validation.description = false

      this.arrDelJK = []

    }, 
    closeModal() {
      this.$emit('close-create-selection') 
    }
  },
  created() { 
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
