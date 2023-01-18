<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col gap-5 xxl:gap-4 xl:gap-3 bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[34%] lg:w-[50%] md:w-[64%] sm:w-[90%] h-fit">
      <div class="relative flex justify-between items-center">
        <h2 class="text-[22px] xxl:text-lg xl:text-base font-semibold leading-none">Добавить квартиру</h2>
        <button @click="this.$emit('close-add-apartments')" class="relative w-4 h-4 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div class="grid grid-cols-2 gap-4 xxl:gap-3 xl:gap-2.5">

        <div class="flex flex-col border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="number">№</label>
          <input v-model="flat.id" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="number">
        </div>

        <div class="flex flex-col border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="coord_object">Площадь (м²)</label>
          <input v-model="flat.square" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="coord_object">
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openSelectLayout}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Планировка</span>
          <div class="relative">
            <div @click="openSelectLayout = !openSelectLayout" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 pb-3 xxl:pb-2.5 xl:pb-2">
              <span>{{ selectLayout }}</span>
              <img src="../../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openSelectLayout }" alt="">
            </div>
            <div v-if="openSelectLayout" class="h-[120px] overflow-y-auto custom__scroll absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
              <span
                v-for="(layout, idx) in layouts" :key="idx"
                @click="changeSelectLayout(layout)"
                class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
              >
                {{ layout.layout }}
              </span>
            </div>
          </div>
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openFloors}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Этаж</span>
          <div class="relative">
            <div @click="openFloors = !openFloors" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 pb-3 xxl:pb-2.5 xl:pb-2">
              <span>{{ selectFloors }}</span>
              <img src="../../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openFloors }" alt="">
            </div>
            <div v-if="openFloors" class="h-[120px] overflow-y-auto custom__scroll absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
              <span
                v-for="(floor, idx) in house.info.floors" :key="idx"
                @click="changeSelectFloors(floor)"
                class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
              >
                {{ floor }}
              </span>
            </div>
          </div>
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openStatus}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">Статус</span>
          <div class="relative">
            <div @click="openStatus = !openStatus" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 pb-3 xxl:pb-2.5 xl:pb-2">
              <span>{{ selectStatus}}</span>
              <img src="../../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openStatus }" alt="">
            </div>
            <div v-if="openStatus" class="h-[120px] overflow-y-auto custom__scroll absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
              <span
                v-for="(status, idx) in statuses" :key="idx"
                @click="changeSelectStatus(status)"
                class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
              >
                {{ status.status }}
              </span>
            </div>
          </div>
        </div>

        <div class="flex flex-col h-fit border border-solid border-[#E5DFEE] rounded-[6px]" :class="{ 'border__bottom--0': openStairs}">
          <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] px-5 xxl:px-4 xl:px-3 pt-4 xxl:pt-3 xl:pt-2.5">От лестничного пролета</span>
          <div class="relative">
            <div @click="openStairs = !openStairs" class="flex items-center justify-between cursor-pointer text-[#1E1D2D] border-[] text-lg xxl:text-[15px] xl:text-[13px] px-5 xxl:px-4 xl:px-3 pb-3 xxl:pb-2.5 xl:pb-2">
              <span>{{ selectStairs }}</span>
              <img src="../../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all" :class="{ 'rotate-180': openStairs }" alt="">
            </div>
            <div v-if="openStairs" class="h-[120px] overflow-y-auto custom__scroll absolute w-full z-40 bg-white flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px]">
              <span
                v-for="(stairs, idx) in stairses" :key="idx"
                @click="changeSelectStairs(stairs)"
                class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none"
              >
                {{ stairs.stairs }}
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-col border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
        <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="cost">Цена (€)</label>
        <input v-model="flat.price" class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0" type="number" id="cost">
      </div>

      <div class="grid grid-cols-2 gap-5 xxl:gap-4 xl:gap-3">
        <div>
          <div class="relative w-full h-[10vw] lg:h-[14vw] md:h-[18vw] sm:h-[24vw] rounded-[5px]">
            <img v-if="imageLoadOne" class="absolute w-full h-full rounded-[5px]" :src="imageOne" alt="">
            <button v-if="imageLoadOne" @click="deleteImageOne" class="absolute rounded-[5px] m-2 bg-[#E84680] z-10 top-0 right-0 h-5 xxl:h-4.5 xl:h-4 w-5 xxl:w-4.5 xl:w-4">
              <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-white h-[1px] w-[60%] rounded-[10px]"></span>
              <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-white h-[1px] w-[60%] rounded-[10px]"></span>
            </button>
            <div class="border border-solid border-[#E5DFEE] bg__uploud-photo w-full h-full rounded-[5px]">
              <div class="absolute rounded-[5px] w-full h-full top-0 left-0">
                <label for="image_1" :class="{'-z-10': imageLoadOne}" class="relative cursor-pointer flex items-center justify-center w-full h-full rounded-[5px]">
                  <img src="../../../assets/svg/upload_photo.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
                </label>
                <input @change="addImageOne" class="w-full h-full rounded-[5px] opacity-0 absolute top-0 left-0 pointer-events-none" id="image_1" type="file" ref="image_up">
              </div>
            </div>
          </div>
        </div>
        <div>
          <div class="relative w-full h-[10vw] lg:h-[14vw] md:h-[18vw] sm:h-[24vw] rounded-[5px]">
            <img v-if="imageLoadTwo" class="absolute w-full h-full rounded-[5px]" :src="imageTwo" alt="">
            <button v-if="imageLoadTwo" @click="deleteImageTwo" class="absolute rounded-[5px] m-2 bg-[#E84680] z-10 top-0 right-0  h-5 xxl:h-4.5 xl:h-4 w-5 xxl:w-4.5 xl:w-4">
              <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45 bg-white h-[1px] w-[60%] rounded-[10px]"></span>
              <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45 bg-white h-[1px] w-[60%] rounded-[10px]"></span>
            </button>
            <div class="border border-solid border-[#E5DFEE] bg__uploud-photo transition-all w-full h-full rounded-[5px]">
              <div class="absolute rounded-[5px] w-full h-full top-0 left-0">
                <label for="image_2" :class="{'-z-10': imageLoadTwo}" class="relative cursor-pointer flex items-center justify-center w-full h-full rounded-[5px]">
                  <img src="../../../assets/svg/upload_photo.svg" class="w-6 xxl:w-5 xl:w-4" alt="">
                </label>
                <input @change="addImageTwo" class="w-full h-full rounded-[5px] opacity-0 absolute top-0 left-0 pointer-events-none" id="image_2" type="file" ref="image_down">
              </div>
            </div>
          </div>
        </div>
      </div>
      <button @click="addFlat" class="login__btn--bg bg-[#E84680] rounded-[5px] w-full py-5 xxl:py-4 xl:py-3">
        <span class="text-white font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">Добавить</span>
      </button>
    </div>
    <div @click="this.$emit('close-add-apartments')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  props: ['house', 'activeFrame'],
  data() {
    return {
      flat: {
        id: '',
        square: '',
        count: '',
        floor: '',
        status: '',
        stairs: '',
        price: '',
      },
      selectLayout: '1 + 1',
      openSelectLayout: false,
      layouts: [
        { layout: '1 + 1', value: 1 },
        { layout: '1 + 2', value: 2 },
        { layout: '1 + 3', value: 3 },
        { layout: '1 + 4', value: 4 },
        { layout: '1 + 5', value: 5 },
      ],
      selectFloors: '1',
      openFloors: false,
      floors: [
        { floor: '1', value: 1},
        { floor: '2', value: 2},
        { floor: '3', value: 3},
        { floor: '4', value: 4},
        { floor: '5', value: 5},
      ],
      selectStatus: 'Свободно',
      openStatus: false,
      statuses: [
        { status: 'Свободно', value: 1},
        { status: 'Продажи закрыты', value: 2},
        { status: 'Акция', value: 3},
        { status: 'Перепродажа', value: 4},
      ],
      selectStairs: '1',
      openStairs: false,
      stairses: [
        {stairs: '1', value: 1},
        {stairs: '2', value: 2},
        {stairs: '3', value: 3},
        {stairs: '4', value: 4},
      ],
      imageLoadOne: false,
      imageOne: '',
      imageLoadTwo: false,
      imageTwo: '',
    }
  },
  methods: {
    addImageOne(e) {
      this.imageOne = URL.createObjectURL(e.target.files[0])
      if (e.target.files.length == 1) {
        this.imageLoadOne = true
      }
    },
    addImageTwo(e) {
      this.imageTwo = URL.createObjectURL(e.target.files[0])
      if (e.target.files.length == 1) {
        this.imageLoadTwo = true
      }
    },
    deleteImageOne() {
      this.imageOne = ''
      this.imageLoadOne = false
    },
    deleteImageTwo() {
      this.imageTwo = ''
      this.imageLoadTwo = false
    },
    addFlat() {
      let formData = new FormData()

      console.log(this.$refs)

      this.flat.count = this.selectLayout
      this.flat.floor = +this.selectFloors
      this.flat.stairs = +this.selectStairs
      this.flat.status = this.selectStatus

      formData.append('frame_id', this.activeFrame)
      formData.append('number', this.flat.id)
      formData.append('square', this.flat.square)
      formData.append('count', this.flat.count)
      formData.append('floor', this.flat.floor)
      formData.append('status', this.flat.status)
      formData.append('stairs', this.flat.stairs)
      formData.append('price', this.flat.price)
      formData.append('image_up', this.$refs.image_up.files[0])
      formData.append('image_down', this.$refs.image_down.files[0])
      formData.append('token', this.globalToken)

      axios({
        method: 'post',
        url: '/api/house/createFlat',
        headers: { "Content-type": "multipart/form-data" },
        data: formData,
      }).then(response => {
        console.log(response.data)
        this.$emit('close-add-apartments', response.data.frames)
      })
        .catch(e => console.error(e))

    },
    changeSelectLayout(layout) {
      this.selectLayout = layout.layout
      this.openSelectLayout = false
    },
    changeSelectFloors(floor) {
      this.selectFloors = floor
      this.openFloors = false
    },
    changeSelectStatus(status) {
      this.selectStatus = status.status
      this.openStatus = false
    },
    changeSelectStairs(stairs) {
      this.selectStairs = stairs.stairs
      this.openStairs = false
    }
  },
}
</script>

<style scoped>

</style>
