<template>
  <div class="bg-[#F6F3FA] border__right">
    <div class="ml-5 exl:ml-[6.25vw] lg:w-[93vw] h-[40vw] py-10 xxl:py-8 xl:py-6 pr-10 xxl:pr-8 xl:pr-6">
      <div class="h-full custom__scroll--chess overflow-scroll">
        <div class="grid grid__chess--inner gap-2.5 xl:gap-2 text-[#6435A5] text-xs xxl:text-xs xl:text-[8px] lg:text-[10px]">
          <div class="flex gap-2.5 xl:gap-2 items-center">
            <div class="bg-[#E5DFEE] flex-shrink-0 font-semibold relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 lg:w-10 lg:h-10 rounded-[5px] border border-solid border-[#E5DFEE]"></div>
            <div v-for="item in house.info.count_flat" class="bg-[#E5DFEE] flex-shrink-0 lg:w-10 lg:h-10 font-semibold relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 lg:w-10 lg:h-10 rounded-[5px] border border-solid border-[#E5DFEE]">{{ item }}</div>
          </div>
          <div class="flex gap-2.5 xl:gap-2" v-for="floor in house.info.floors">
            <div class="bg-[#E5DFEE] flex-shrink-0 font-semibold relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 lg:w-10 lg:h-10 rounded-[5px] border border-solid border-[#E5DFEE]">{{ Math.abs((floor - 1) - (house.info.floors - 1)) }}</div>
            <div v-for="count in house.info.count_flat" class="lg:w-10 lg:h-10 bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
              <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count) === null" class="bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
                <span class="relative z-10"></span>
              </div>
              <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count) !== null">
                <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).status == 2" @click="clickFlat(checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).id)" :class="{'bg_custom_color': checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active === 1}" class="lg:w-10 lg:h-10 flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
                  <span class="relative z-10" :class="{'text-white': checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active === 1}">{{ checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).square }}</span>
                  <img class="absolute w-full h-full top-0 left-0" v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active !== 1" src="../../assets/svg/chess_fence.svg" alt="">
                </div>
              </div>
              <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count) !== null">
                <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).status == 4" @click="clickFlat(checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).id)" :class="{'text-white': checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active === 1, 'bg_custom_color': checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active === 1}"
                     class="lg:w-10 lg:h-10 bg-white flex-shrink-0 relative flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
                  {{  checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).count === 'Duplex' ? 'D' : checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).count === 'Studia' ? 'S' : checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).count  }}
                </div>
              </div>
              <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count) !== null">
                <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).status == 3" @click="clickFlat(checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).id)" :class="{'bg_custom_color': checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active === 1}" class="relative lg:w-10 lg:h-10 flex-shrink-0 flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E5DFEE] cursor-pointer">
                  <img src="../../assets/svg/lock.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
                </div>
              </div>
              <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count) !== null">
                <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).status == 0" @click="clickFlat(checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).id)" :class="{'text-white': checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active === 1, 'bg_custom_color': checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active === 1}" class="relative lg:w-10 lg:h-10 flex-shrink-0 flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#E84680] cursor-pointer">
                  {{ checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).count === 'Duplex' ? 'D' : checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).count === 'Studia' ? 'S' : checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).count }}
                </div>
              </div>
              <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count) !== null">
                <div v-if="checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).status == 1" @click="clickFlat(checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).id)" :class="{'text-white': checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active === 1, 'bg_custom_color': checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).active === 1}" class="relative lg:w-10 lg:h-10 flex-shrink-0 flex items-center justify-center w-12 xxl:w-10 xl:w-8 h-12 xxl:h-10 xl:h-8 rounded-[5px] border border-solid border-[#6435A5] cursor-pointer">
                  {{ checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).count === 'Duplex' ? 'D' : checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).count === 'Studia' ? 'S' : checkFlat(Math.abs((floor - 1) - (house.info.floors - 1)), count).count }}
                </div>
              </div>
            </div>
          </div>
          <span class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[8px] lg:text-[11px] leading-none ml-1">{{ language.ob[38] }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['flats', 'house', 'language'],
  data() {
    return {
    }
  },
  methods: {
    log(item) {

    },
    checkFlat(floor, count) {
      let object = {};
      let flat = []

      flat = this.flats.filter(item => item.floor === floor && item.number_from_stairs === count)


      if(flat.length > 0) {
        object = {
          id: flat[0].id,
          status: flat[0].status,
          count: flat[0].count,
          active: flat[0].active
        }
      }

      return flat.length > 0 ? object : null;
    },
    clickFlat(id) {
      let flat = this.flats.find(item => item.id === id)

      this.flats.forEach(item => {
        if(item.id === id) {
          item.active = 1
        } else {
          item.active = 0
        }
      })

      console.log(this.flats);

      this.$emit('targetFlat', flat)
    }
  },
  created() {

  }
}
</script>

<style>
  .bg_custom_color {
    background-color: #6435A5;
  }
</style>
