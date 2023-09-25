<template>
  <div v-if="openSelection" class="fixed flex justify-end z-[100] top-0 ring-0 w-full h-full">
    <div :class="{'translate__x__0': openSideBar}" class="transition-all ease-linear duration-500 flex flex-col relative z-50 w-[50%] lg:w-[64%] sm:w-full translate-x-full h-[100vh] bg-white px-28 xxl:px-24 xl:px-20 lg:px-10 sm:px-5 py-14 xxl:py-10 xl:py-8 lg:py-5">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-[22px] xxl:text-lg xl:text-base font-semibold">{{ language.menu_zastr_1[9] + ' ' + language.rielt_1[2] }}</h2>
        <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 rotate-45"></div>
          <div class="absolute h-[1px] w-4 -rotate-45"></div>
        </button>
      </div>
      <div class="flex flex-col h-[100vh] gap-5 xxl:gap-4 xl:gap-3 chat__container--flex overflow-y-auto custom__scroll--chess">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none">{{ language.rielt_3[1] }}</h3>
        <div :class="{ 'validation': validation.title }" class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label :class="{ 'validation-text': validation.title }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="name">{{ language.rielt_3[2] }}</label>
          <input @input="validationCheck(0)" v-model="compilation.title" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="name">
        </div>
        <div :class="{ 'validation': validation.description }" class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label :class="{ 'validation-text': validation.description }" class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="comment">{{ language.rielt_3[3] }}</label>
          <input @input="validationCheck(1)" v-model="compilation.description" class="text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="text" id="comment">
        </div>
        <div class="wrapper relative mb-8 xxl:mb-6 xl:mb-5">
          <input v-model="compilation.isVisible" class="custom__checkbox" type="checkbox" id="chekbox">
   
          <label class="text-base xxl:text-[13px] xl:text-[11px] leading-none" for="chekbox">{{ language.rielt_3[4] }}</label>
           <!--Всплывашка-->
          <div class="hitn-icon">
            <img src="../../../../public/images/new/question.png" alt="" srcset="">
          </div>
          <div class="hitn-text">
             Вы можете скрыть эту информацию в презентации для клиента
          </div> 
        </div>
        <div class="text-[#1E1D2D] font-medium text-[18px] xxl:text-[15px] xl:text-[13px] mb-4 xxl:mb-3 xl:mb-2.5">ЖК ({{ JKlist.length }})</div>
        <div class="flex flex-col gap-5 xxl:gap-4 xl:gap-3 mb-8 xxl:mb-6 xl:mb-5 overflow-y-auto custom__scroll-grey">
          <div
            class="contact__selling p-2.5 xxl:p-2 xl:p-1.5 rounded-[10px]"
            v-for="JK in JKlist"
          >
            <div class="flex justify-between items-center mb-3 xxl:mb-2.5 xl:mb-2">
              <div class="flex gap-5 xxl:gap-4 xl:gap-3 items-center">
                <img v-if="JK.house.image" :src="JK.house.image" class="object-cover w-[70px] xxl:w-[60px] xl:w-[50px] h-[70px] xl:h-[60px] xl:h-[50px] rounded-[3px]" alt="">
                <img v-else src="../../../assets/no-img-houses.jpg" class="w-[70px] xxl:w-[60px] xl:w-[50px] h-[70px] xl:h-[60px] xl:h-[50px] rounded-[3px]" alt="">
                <div class="flex flex-col gap-3 xxl:gap-2.5 xl:gap-2">
                  <span class="text-[#1E1D2D] font-medium text-[18px] xxl:text-[15px] xl:text-[13px] leading-none">{{ JK.house.title }}</span>
                  <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">{{ JK.house.city }}, {{ JK.house.area }}</span>
                  <!-- <img class="cursor-pointer w-6 xxl:w-5 xl:w-4 mx-5 xxl:mx-4 xl:mx-3" src="../../../assets/svg/chat_icon_grey.svg" alt="" srcset=""> -->
                  <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">{{ JK.description }} </span>
                </div>
              </div>
              <div class="flex items-center" @click="deleteJK(JK.house)">
<!--                <img v-if="!JK.openInput" @click="openInput(JK)" src="../../../assets/svg/chat_icon_grey.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 mx-5 xxl:mx-4 xl:mx-3" alt="">-->
                <img src="../../../assets/svg/bucket_icon_red.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 mx-5 xxl:mx-4 xl:mx-3" alt="">
              </div>
            </div>
           <div v-if="JK.openInput" class="relative"> 
             <input class="w-full text-[#1E1D2D] focus:ring-[#6435A5] focus:border-[#6435A5] text-[16px] xxl:text-[14px] xl:text-[12px] pl-5 xxl:pl-4 xl:pl-3 py-3 xxl:py-2.5 xl:py-2 leading-none rounded-[5px] border border-solid border-[#E5DFEE] pr-12 xxl:pr-10 xl:pr-8" type="text"> 
             <img @click="closeInput(JK)" class="absolute cursor-pointer top-1/2 -translate-y-1/2 w-6 xxl:w-5 xl:w-4 right-5 xxl:right-4 xl:right-3" src="../../../assets/svg/close_grey.svg" alt=""> 
           </div> 
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-8 xxl:gap-6 xl:gap-5" style="padding-bottom: 80px">
        <button @click="createCompilation" class="login__btn--bg text-white text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">
          {{ language.dob_ob_1[24] }}</button>
        <button @click="closeModal" class="bg-litepink text-[#E84680] text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">
          {{ language.izbr_1[4] }}</button>
      </div>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>

export default {
  props: ['openSelection', 'openSideBar', 'user', 'itemCompilation', 'language'],
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
    validationCheck(id) {
      if (id === 0) this.compilation.title.length > 0 ? this.validation.title = false : this.validation.title = true
      else if (id === 1) this.compilation.description.length > 0 ? this.validation.description = false : this.validation.description = true
    },
    fillInput() {
      if (this.itemCompilation) {
        this.compilation.title = this.itemCompilation.title
        this.compilation.description = this.itemCompilation.description
        this.compilation.isVisible = this.itemCompilation.isVisible === 1 ? true : false
      }
    },
    closeModal() {
      this.$emit('close-selection')
      this.arrDelJK = []
      this.JKlist = this.itemCompilation.values.slice(0)
    }
  },
  created() {
    this.fillInput()

    this.JKlist = this.itemCompilation.values.slice(0)
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


.wrapper{
  width: -moz-fit-content;
  width: fit-content;
  display: block;
}
.hitn-icon{
  position: absolute;
  right: -20px;
  left: auto;
  top: 2px;
  height: 15px;
  width: 15px;
}

.hitn-icon img {
  width: 15px;
}

.hitn-icon:hover + .hitn-text {
  opacity: 1;
  visibility: visible;
  transition: opacity 0.2s, visibility 0.2s;
}

.hitn-text {
  position: absolute;
  word-break: unset;
  width: 150px;
  top: -8px;
  left: auto;
  right: -180px;
  padding: 5px;
  background: rgb(246 243 250);
  color: rgb(100 53 165);
  border-radius: 5px;
  font-size: 10px;
  line-height: 12px;
  text-align: center;
  opacity: 0;
  visibility: hidden;
}

@media (max-width: 992px) { 

  .hitn-text {
    position: absolute;
    word-break: unset;
    width: 181px;
    top: 24px;
    right: -42px;
    padding: 8px;
    background: rgb(246 243 250);
    color: rgb(100 53 165);
    border-radius: 5px;
    left: auto;
    font-size: 12px;
    line-height: 14px;
    text-align: center;
    opacity: 0;
    visibility: hidden;
}
}
</style>
