<template>
  <div class="md:w-[100vw]">
    <div class="border__right md:overflow-auto md:custom__scroll--chess">
      <div class="border__bottom md:w-[700px]">
        <div class="grid grid__chess--list ml-5 exl:ml-[6.25vw]">
          <div
            v-for="item in titleTable"
            class="flex items-center gap-1 p-5 xxl:p-4 xl:p-3"
          >
            <span class="text-[#8A8996] text-base xxl:text-[14px] xl:text-[12px] lg:text-[15px] leading-none">
              {{ item.title }}
            </span>
            <div @click="changeFilter(item)" class="flex flex-col gap-[1px] xl:gap-[0.5px]" v-if="item.filter">
              <svg  class="cursor-pointer rotate-180 w-[9px] xxl:w-[8px] xl:w-[7px] h-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path :class="{ 'fill-[#6435A5]': item.active === 1 }" d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
              </svg>
              <svg class="cursor-pointer w-[9px] h-[7px] w-[9px] xxl:w-[8px] xl:w-[7px]" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path :class="{ 'fill-[#6435A5]': item.active === 2 }" d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
              </svg>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-[#F6F3FA] md:w-[700px]">
        <div class="ml-5 exl:ml-[6.25vw] h-[40vw] py-8 xxl:py-6 xl:py-5 pr-4 xxl:pr-3 xl:pr-2.5 lg:mx-auto box-content lg:px-[6.25vw]">
          <div class="h-full flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 pr-4 xxl:pr-3 xl:pr-2.5 custom__scroll--chess  overflow-y-scroll lg:text-[#1E1D2D] text-base xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
            <div v-for="item in flats" :class="{ 'border': item.active === 1 }"  @click="targetFlat(item)" class="cursor-pointer grid grid__chess--list bg-white rounded-[5px] border-solid border-[#6435A5]">
              <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.number }}</span>
              <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.square }}</span>
              <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.price }}</span>
              <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.count }}</span>
              <span class="leading-none p-5 xxl:p-4 xl:p-3">{{ item.floor }}</span>
              <span :class="{ 'text-[#FF6600]': item.status == 0,
                              'text-[#8A8996]': item.status == 2,
                              'text-[#E84680]': item.status == 3,
                              'text-[#00A478]': item.status == 4


              }" class="leading-none p-5 xxl:p-4 xl:p-3">
                {{ item.status == 0 ? language.dob_kv_1[10] : item.status == 1 ? language.dob_kv_1[11] : item.status == 2 ? language.dob_kv_1[12] : item.status == 3 ? language.dob_kv_1[13] : language.dob_kv_1[9] }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>

export default {
  props: ['flats', 'language'],
  data() {
    return {
      titleTable: [
        { name: 'id', title: '№', active: 0, filter: true },
        { name: 'square', title: 'Площадь', active: 0, filter: true },
        { name: 'price', title: 'Цена', active: 0, filter: true },
        { name: 'plan', title: 'Планировка', active: 0, filter: false },
        { name: 'floor', title: 'Этаж', active: 0, filter: true },
      ],
    }
  },
  watch: {
    language(newItem) {
        this.titleTable[1].title = newItem.dob_kv_1[4];
        this.titleTable[2].title = newItem.dob_kv_1[5];
        this.titleTable[3].title = newItem.dob_kv_1[6];
        this.titleTable[4].title = newItem.dob_kv_1[7];
    }
  },
  methods: {
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
        this.flats = this.flats.sort((a, b) => a[name] - b[name])
      } else if (item.name === name && item.active === 2) {
        this.house.flats = this.flats.sort((a, b) => b[name] - a[name])
      }
    },
    targetFlat(item) {
      this.flats.forEach(flat => {
        if (item.id === flat.id) {
          flat.active = 1
          this.$emit('target-flat', flat)
        } else {
          flat.active = 0
        }
      })
    }
  },
  created() {
    this.titleTable[1].title = this.language.dob_kv_1[4];
    this.titleTable[2].title = this.language.dob_kv_1[5];
    this.titleTable[3].title = this.language.dob_kv_1[6];
    this.titleTable[4].title = this.language.dob_kv_1[7];
  }
}

</script>
