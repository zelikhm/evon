<template>
  <div class="bg-[#F6F3FA] border__right">
    <div class="ml-[6.25vw] lg:w-[93vw] h-[40vw] py-10 xxl:py-8 xl:py-6 pr-10 xxl:pr-8 xl:pr-6">
      <div class="h-full custom__scroll--chess overflow-scroll">
        <div class="grid grid__chess--inner gap-2.5 xl:gap-2 text-[#6435A5] text-base xxl:text-sm xl:text-[10px]">
          <div class="flex gap-2.5 xl:gap-2 items-center">
            <div class="bg-[#E5DFEE] flex-shrink-0 font-semibold relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE]"></div>
            <div v-for="item in house.info.count_flat" class="bg-[#E5DFEE] flex-shrink-0 font-semibold relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE]">{{ item }}</div>
            <span class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[8px] leading-none">Нумерация квартир от лестничного пролета</span>
          </div>
          <div class="flex gap-2.5 xl:gap-2" v-for="floor in house.info.floors">
            <div class="bg-[#E5DFEE] flex-shrink-0 font-semibold relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE]">{{ floor - 1}}</div>
            <div v-for="count in house.info.count_flat" class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
              <div v-if="checkFlat(floor - 1, count) === null" class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
                <span class="relative z-10"></span>
              </div>
              <div v-if="checkFlat(floor - 1, count) !== null">
                <div v-if="checkFlat(floor - 1, count).status == 2" @click="clickFlat(checkFlat(floor - 1, count).id)" :class="{'bg-[#6435A5]': checkFlat(floor - 1, count).active}" class="flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
                  <span class="relative z-10" :class="{'text-white': checkFlat(floor - 1, count).active === 1}">{{ checkFlat(floor - 1, count).square }}</span>
                  <img class="absolute w-full h-full top-0 left-0" v-if="checkFlat(floor - 1, count).active !== 1" src="../../assets/svg/chess_fence.svg" alt="">
                </div>
              </div>
              <div v-if="checkFlat(floor - 1, count) !== null">
                <div v-if="checkFlat(floor - 1, count).status == 4" @click="clickFlat(checkFlat(floor - 1, count).id)" :class="{'text-white': checkFlat(floor - 1, count).active === 1, 'bg-[#6435A5]': checkFlat(floor - 1, count).active === 1}"
                     class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
                  {{ checkFlat(floor - 1, count).square }}
                </div>
              </div>
              <div v-if="checkFlat(floor - 1, count) !== null">
                <div v-if="checkFlat(floor - 1, count).status == 3" @click="clickFlat(checkFlat(floor - 1, count).id)" :class="{'bg-[#6435A5]': checkFlat(floor - 1, count).active === 1}" class="relative flex-shrink-0 flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
                  <img src="../../assets/svg/lock.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
                </div>
              </div>

            </div>

          </div>


<!--          <div class="flex gap-2.5 xl:gap-2">-->
<!--            <div class="bg-[#E5DFEE] flex-shrink-0 font-semibold relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">2</div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">34.2</div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">-->
<!--              <span class="relative z-10">34.2</span>-->
<!--              <img class="absolute w-full h-full top-0 left-0" src="../../assets/svg/chess_fence.svg" alt="">-->
<!--            </div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--          </div>-->
<!--          <div class="flex gap-2.5 xl:gap-2">-->
<!--            <div class="bg-[#E5DFEE] flex-shrink-0 font-semibold relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">1</div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--          </div>-->
<!--          <div class="flex gap-2.5 xl:gap-2">-->
<!--            <div class="bg-[#E5DFEE] flex-shrink-0 font-semibold relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">0</div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer"></div>-->
<!--            <div class="relative flex-shrink-0 flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">-->
<!--              <img src="../../assets/svg/lock.svg" class="w-6 xxl:w-5 xl:w-4" alt="">-->
<!--            </div>-->
<!--            <div class="relative flex-shrink-0 flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">-->
<!--              <img src="../../assets/svg/lock.svg" class="w-6 xxl:w-5 xl:w-4" alt="">-->
<!--            </div>-->
<!--          </div>-->
          <span class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[8px] leading-none ml-1">Этажи</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['flats', 'house'],
  data() {
    return {
    }
  },
  methods: {
    log(item) {
      // console.log(item)
    },
    checkFlat(floor, count) {
      let object = {};
      let flat = []

      flat = this.flats.filter(item => item.floor === floor && item.number_from_stairs === count)


      if(flat.length > 0) {
        object = {
          id: flat[0].id,
          status: flat[0].status,
          square: flat[0].square,
          active: flat[0].active
        }
      }

      return flat.length > 0 ? object : null;
    },
    clickFlat(id) {
      let flat = this.flats.find(item => item.id === id)

      this.flats.forEach(item => {
        item.active = 0
      })

      flat.active = 1
      this.$emit('targetFlat', flat)
    }
  },
  created() {
    console.log(this.flats)

    this.flats.forEach(item => {
      item.active = 0
    })

    // console.log(this.flats.find(i => i.floor === 1 && i.number_from_stairs === 3))
  }
}
</script>
