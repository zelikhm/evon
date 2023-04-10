<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] mb-5 xxl:mb-4 xl:mb-3">{{ language.dob_kv_1[0] }}</h2>
  <div class="flex flex-col">
    <div class="grid grid-cols-6 lg:grid-cols-4 sm:grid-cols-3 gap-3 xxl:gap-2.5 xl:gap-2">
      <div @click="targetFrame(frame, idx)" v-for="(frame, idx) in house.frames" :class="{ 'border-white': frame.active !== 1 }" class="corpus__banner flex justify-between cursor-pointer rounded-[5px] border border-solid border-[#6435A5] px-5 xxl:px-4 xl:px-3 py-5 xxl:py-4 xl:py-3">
        <div class="flex flex-col justify-center gap-3.5 xxl:gap-3 xl:gap-2.5">
          <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none whitespace-nowrap">{{ frame.name }}</span>
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none whitespace-nowrap" v-if="frame.flats">{{ frame.flats.length }} {{ frame.flats.length === 1 ? language.dob_kv_1[15] : frame.flats.length === 2 || frame.flats.length === 3 || frame.flats.length === 4 ? language.dob_kv_1[16] : language.dob_kv_1[17] }}</span>
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[14px] leading-none whitespace-nowrap" v-else>0 {{language.dob_kv_1[17]}}</span>
        </div>
        <div class="relative flex flex-col items-center justify-between gap-3.5 xxl:gap-3 xl:gap-2.5">
          <button @click="$emit('open-add-frame', frame)">
            <img class="w-5 xxl:w-4 xl:w-3" src="../../assets/svg/pen_icon_grey.svg" alt="">
          </button>
          <button @click="deleteConfirmOn(frame)" class="relative">
            <img class="w-5 xxl:w-4 xl:w-3" src="../../assets/svg/bucket_icon_red.svg" alt="">
          </button>
          <div v-if="frame.deleteConfirm" class="cursor-auto z-20 text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] absolute top-[120%] bg-white left-[] flex flex-col border border-solid border-[#CEC3DD] rounded-[5px]">
            <span class="whitespace-nowrap text-center border__bottom p-2.5 xxl:p-2 xl:p-1.5 leading-none">Вы уверены что хотите удалить?</span>
            <div class="cursor-pointer flex">
              <div class="hover__select w-full text-center border__right p-2.5 xxl:p-2 xl:p-1.5 leading-none text-[red]" @click="deleteFrame(frame)">Да</div>
              <div @click="frame.deleteConfirm = false" class="hover__select w-full text-center p-2.5 xxl:p-2 xl:p-1.5 leading-none text-[green]">Нет</div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center">
        <img @click="$emit('open-add-frame', isEdit ? 0 : 1)" src="../../assets/svg/plus_icon_purple.svg" class="cursor-pointer ml-3 xxl:ml-2.5 xl:ml-2 w-8 xxl:w-6 xl:w-5" alt="">
      </div>
    </div>
    <div class="grid lg:w-[87.5vw] pb-2 custom__scroll--chess gap-4 xxl:gap-3.5 xl:gap-3 my-16 xxl:my-12 xl:my-10 text-[#1E1D2D] text-base xxl:text-sm xl:text-xs lg:text-[15px]">
      <div class="text-[#8A8996] grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
        <div
          class="leading-none bg-white flex items-center gap-2 xl:gap-1.5"
          v-for="item in titleTable"
        >
          <span class="leading-none">{{ item.title }}</span>
          <div v-if="item.filter" @click="changeFilter(item)" class="flex flex-col gap-[1px] xl:gap-[0.5px]">
            <svg class="cursor-pointer rotate-180 w-[9px] h-[7px] w-[9px] xxl:w-[8px] xl:w-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path :class="{ 'fill-[#6435A5]': item.active === 1 }" d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
            <svg class="cursor-pointer w-[9px] xxl:w-[8px] xl:w-[7px] h-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path :class="{ 'fill-[#6435A5]': item.active === 2 }" d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
          </div>
        </div>
      </div>
      <div v-for="item in house.frames[frameId].flats" v-if="house.frames.length > 0" class="flex items-center h-[56px] xxl:h-[48px] xl:h-[40px] rounded-[5px] border border-solid border-[#E5DFEE] justify-between">
        <div class="grid__apartments-line items-center px-5 xxl:px-4 xl:px-3">
          <div class="leading-none bg-white">{{ item.number }}</div>
          <div class="leading-none">{{ item.square }}</div>
          <div class="leading-none">{{ item.price }}</div>
          <div class="leading-none">{{ item.count }}</div>
          <div class="leading-none">{{ item.floor }}</div>
          <div class="relative" :tabindex="tabindex" @blur="item.statusActive = false">
            <div @click="item.statusActive = !item.statusActive" class="flex items-center cursor-pointer gap-5 xxl:gap-4 xl:gap-3">
              <span class="whitespace-nowrap">{{ item.status == 0 ? language.dob_kv_1[10] : item.status == 1 ? language.dob_kv_1[11] : item.status == 2 ? language.dob_kv_1[12] : item.status == 3 ? language.dob_kv_1[13] : language.dob_kv_1[9] }}
              </span>
              <svg class="w-2.5 xl:w-2" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.00005 3.879L8.71255 0.166504L9.77305 1.227L5.00005 6L0.227051 1.227L1.28755 0.166504L5.00005 3.879Z" fill="#8A8996"/>
              </svg>
            </div>
            <div v-if="item.statusActive" class="absolute flex flex-col z-20 top-[130%] left-0 bg-white border border-solid border-[#E5DFEE] rounded-[5px]">
              <span @click="changeSelectStatus(status, item)" v-for="status in statuses" class="border__bottom--not cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 whitespace-nowrap">
                {{ status.status }}
              </span>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-end flex-shrink-0">
          <button class="border__right h-[56px] xxl:h-[48px] xl:h-[40px] w-[60px] xxl:w-[48px] xl:w-[36px] flex items-center justify-center">
            <img @click="editFlat(item)" src="../../assets/svg/pen_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
          </button>
          <button @click="deleteFlat(item)" class="w-[60px] xxl:w-[48px] xl:w-[36px] flex items-center justify-center">
            <img src="../../assets/svg/bucket_icon_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">
          </button>
        </div>
      </div>
    </div>
  </div>
<!--  <div class= "w-full flex justify-center mt-5 xxl:mt-4 xl:mt-3 gap-3 xxl:gap-2.5 xl:gap-2 items-center text-[#8A8996] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px]">-->
<!--    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5  rounded-[3px] flex items-center justify-center cursor-pointer">-->
<!--      <img src="../../assets/svg/arrow_right_grey.svg" class="rotate-180 w-5 xxl:w-4 xl:w-3" alt="">-->
<!--    </div>-->
<!--    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">1</div>-->
<!--    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">2</div>-->
<!--    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">3</div>-->
<!--    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">...</div>-->
<!--    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">24</div>-->
<!--    <div class="hover__select h-7 xxl:h-6 xl:h-5 w-7 xxl:w-6 xl:w-5 rounded-[3px] flex items-center justify-center cursor-pointer">-->
<!--      <img src="../../assets/svg/arrow_right_grey.svg" class="w-5 xxl:w-4 xl:w-3" alt="">-->
<!--    </div>-->
<!--  </div>-->
</template>

<script>

export default {
  props: ['house', 'language', 'statuses', 'titleTable', 'token'],
  emits: ['open-add-frame'],
  inject:['user'],
  data() {
    return {
      deleteConfirm: false,
      selectStatus: 0,
      id: null,
      openStatus: false,
      flats: null,
      frameId: 0,
      isEdit: false,
      tabindex: {
        type: Number,
        required: false,
        default: 0,
      },
    }
  },
  methods: {
    editFlat(item) {
      this.$emit('edit-flat', item)
    },
    changeSelectStatus(status, item) {
      item.status = status.id
      item.statusActive = !item.statusActive

      axios.post('/api/house/editStatusFlat', {
        house_id: this.house.id,
        flat_id: item.id,
        status: item.status,
        token: this.token
      }).then(response => console.log(response.data))
    },
    targetFrame(frame, idx) {
      this.house.frames.forEach(item => item.active = 0)
      frame.active = 1
      this.$emit('change-frame', frame.id)
      this.frameId = idx
      this.titleTable.forEach(item => item.active = 0)
    },
    changeFilter(item) {
      item.active += 1

      if (item.active > 2) {
        item.active = 0
      }

      this.filter(item, 'id')
      this.filter(item, 'square')
      this.filter(item, 'price')
      this.filter(item, 'floor')
    },
    filter(item, name) {
      if (item.name === name && item.active === 1) {
        this.house.frames[this.frameId].flats = this.house.frames[this.frameId].flats.sort((a, b) => a[name] - b[name])
      } else if (item.name === name && item.active === 2) {
        this.house.frames[this.frameId].flats = this.house.frames[this.frameId].flats.sort((a, b) => b[name] - a[name])
      }
    },
    deleteConfirmOn(frame) {
      this.house.frames.forEach(item => {
        item.deleteConfirm = false
      })
      frame.deleteConfirm = true
    },
    deleteFrame(frame) {
      this.house.frames.forEach((item, idx) => {
        if (frame.id === item.id) {
          this.house.frames.splice(idx, 1)
        }
      })

      axios.post('/api/house/deleteFrame', {
        frame_id: frame.id,
        token: this.token
      }).then(response => console.log(response.data))
    },
    deleteFlat(item) {
      axios.post('/api/house/deletedFlat', {
        flat_id: item.id,
        token: this.token
      }).then(response => console.log(response))

      this.house.frames.forEach((i, index) => {
        i.flats.forEach((flat, idx) => {
          if (flat.id === item.id) {
            this.house.frames[index].flats.splice(idx, 1)
          }
        })
      })
    }
  },
  created() {
    let link = +window.location.href.split('/').at(-1)

    if (Number.isInteger(link)) {
      this.isEdit = true
    }


    if (this.house.frames.length > 0) {
      let startFrame = this.house.frames[0].id

      this.house.frames.forEach((item, idx) => {
        if (idx === 0) {
          // this.frameId = item.id
          item.active = 1
        }
        else {
          item.active = 0
        }
      })
      this.$emit('change-frame', startFrame)

      this.house.frames.forEach(item => {
        if (item.flats) {
          item.statusActive = 0
        }
        item.deleteConfirm = false
      })
    }

  },
  updated() {
    if (this.house.frames.length === 1) {
      this.house.frames[0].active = 1
    }

    this.house.frames.forEach((item, idx) => {
      if (item.active === 1) {
        this.frameId = idx
      }
    })
  },
  watch: {
  }
}

</script>
