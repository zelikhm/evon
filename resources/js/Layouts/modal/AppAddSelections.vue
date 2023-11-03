<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col bg-white rounded-[12px] z-50 w-[43%] lg:w-[56%] md:w-[70%] sm:w-[94%] h-fit">
      <div class="relative border__bottom flex justify-between items-center p-8 xxl:p-6 xl:p-5">
        <h2 class="text-lg xxl:text-[15px] xl:text-[13px] font-semibold leading-none">{{ language.rielt_3[0] }}</h2>
        <button @click="$emit('close-add-selection')" class="hover__close transition-all relative w-3 h-3 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div
        class="relative border__bottom flex items-center gap-4 xxl:gap-3 xl:gap-2.5 px-8 xxl:px-6 xl:px-5 py-5 xxl:py-4 xl:py-3">
        <!--        <img src="../../../assets/chat_avatar.png" class="w-12 xxl:w-10 xl:w-8" alt="">-->
        <div class="flex flex-col">
          <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
            <span class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none m">{{ house.title }}</span>
            <span
              class="border uppercase border-solid border-[#30CB49] text-[#30CB49] text-[14px] xxl:text-[12px] xl:text-[10px] px-2 xl:px-1.5 py-1.5 xl:py-1 rounded-[3px] leading-none"
              v-if="house.created && !Number.isInteger(+house.created[0])">{{ getLabel(house.created) }}</span>
            <span
              class="border uppercase border-solid border-[#E84680] text-[#E84680] text-[14px] xxl:text-[12px] xl:text-[10px] px-2 xl:px-1.5 py-1.5 xl:py-1 rounded-[3px] leading-none"
              v-else-if="house.created">{{ house.created }}</span>
          </div>
          <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none mt-2">{{ getCity(house.city) }}, {{ getArea(house.area) }}</span>
        </div>
      </div>
      <div class="p-8 xxl:p-6 xl:p-5">
        <span v-if="idCompilation === true" style="color: red;">{{ language.subscription[89] }}</span>
        <span v-if="success" style="color: green;">{{ language.subscription[86] }} {{ house.title }} {{ language.subscription[87] }} {{ activeNameCompilation }}!</span>
        <span v-if="failed" style="color: red;">{{ language.subscription[86] }} {{ house.title }} {{ language.subscription[88] }} {{ activeNameCompilation }}!</span>
        <div
          class="mt-2 main__title-block border border-solid border-[#E5DFEE] rounded-[5px] pl-5 xxl:pl-4 xl:pl-3 py-5 xxl:py-4 xl:py-3 pr-1 text-[16px] xxl:text-[14px] xl:text-[12px]">
          <div
            class="flex flex-col h-[40vh] overflow-y-auto custom__scroll--chess pr-4 xxl:pr-3 xl:pr-2 gap-2.5 xxl:gap-2 xl:gap-1.5">
            <div class="flex items-center bg-white justify-between w-full p-5 xxl:p-4 xl:p-3.5 rounded-[5px]"
                 v-for="(item, index) in readyCompilation">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <div class="flex" @click="selectCompilation(item, index)">
                  <input :id="'name' + item.id" type="radio" name="selections" class="custom__checkbox">
                  <label :for="'name' + item.id"></label>
                </div>
                <span class="leading-none">{{ item.title }}</span>
              </div>
              <span class="leading-none">{{ item.houses.length }} {{ language.ob[35] }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="relative">
        <div v-if="buttonSelection"
             class="px-8 xxl:px-6 xl:px-5 pb-8 xxl:pb-6 xl:pb-5 flex gap-4 xxl:gap-3 xl:gap-2.5 w-full text-lg xxl:text-[15px] xl:text-[13px]">
          <button @click="openCreate"
                  class="w-full bg-litepink text-[#E84680] leading-none font-medium rounded-[5px] p-5 xxl:p-4 xl:p-3">
            {{ language.rielt_3[6] }}
          </button>
          <button @click="addSelection"
                  class="login__btn--bg w-full text-white leading-none font-semibold rounded-[5px] p-5 xxl:p-4 xl:p-3">
            {{ language.ob[34] }}
          </button>
        </div>
        <div v-if="createSelection"
             class="px-8 xxl:px-6 xl:px-5 pb-8 xxl:pb-6 xl:pb-5 flex sm:flex-col gap-4 xxl:gap-3 xl:gap-2.5 w-full text-lg xxl:text-[15px] xl:text-[13px] ">
          <div class="relative w-[64%] sm:w-full">
            <input v-model="titleNewCompilation"
                   class="w-full h-full placeholder-[#8A8996] pr-12 xxl:pr-10 xl:pr-8 text-[16px] xxl:text-[14px] xl:text-[12px] focus:ring-[#6435A5] border border-solid border-[#E84680] rounded-[5px]"
                   :placeholder="language.rielt_3[8]" type="text">
            <button @click="closeCreate" class="absolute w-3 h-3 top-1/2 right-0 -translate-x-full -translate-y-1/2">
              <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#E84680] rotate-45"></span>
              <span class="absolute h-[1px] top-1/2 left-0 w-3 bg-[#E84680] -rotate-45"></span>
            </button>
          </div>
          <button @click="$emit('open-i-create-selections', titleNewCompilation)"
                  class="login__btn--bg w-[36%] sm:w-full text-white leading-none font-semibold rounded-[5px] p-5 xxl:p-4 xl:p-3 whitespace-nowrap">
            {{ language.rielt_3[6] }}
          </button>
        </div>
      </div>
    </div>
    <div @click="$emit('close-add-selection')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
  export default {
    props: ['compilation', 'house', 'language', 'city_array', 'area_array'],
    inject: ['user'],
    data() {
      return {
        buttonSelection: true,
        createSelection: false,
        titleNewCompilation: '',
        idCompilation: null,
        success: false,
        activeNameCompilation: null,
        readyCompilation: null,
        index: 0,
        failed: false,
      }
    },
    emits: ['close-add-selection', 'open-create-sel'],
    methods: {
      getLabel(title) {
        if(title == 'Сдан') {
          return this.language.rielt_1[10]
        }
      },
      getCity(city) {
        let name = this.city_array.find(item => item.title === city);

        if (this.selectLanguage === 0) {
          return name.title;
        } else if (this.selectLanguage === 1) {
          return name.title_en;
        } else if (this.selectLanguage === 2) {
          return name.title_tr;
        }
      },
      getArea(area) {
        let name = this.area_array.find(item => item.title === area);

        if (this.selectLanguage === 0) {
          return name.title;
        } else if (this.selectLanguage === 1) {
          return name.title_en;
        } else if (this.selectLanguage === 2) {
          return name.title_tr;
        }
      },
      openCreate() {
        this.createSelection = true
        this.buttonSelection = false
      },
      closeCreate() {
        this.createSelection = false
        this.buttonSelection = true
      },
      selectCompilation(item, index) {
        this.idCompilation = item.id
        this.activeNameCompilation = item.title
        this.success = false
        this.index = index
      },
      addSelection() {
        if (this.idCompilation === null) {
          this.idCompilation = true
        } else {
          axios.post('/api/compilation/addHouse', {
            compilation_id: this.idCompilation,
            house_id: this.house.id,
            description: '',
            token: this.user.token
          }).then(response => {
            if (response.status === 200) {
              this.success = true
              this.failed = false
              this.readyCompilation[this.index].houses = response.data.houses;
            } else if (response.status === 201) {
              this.failed = true
              this.success = false
            }

          })
        }
      }
    },
    created() {
      this.readyCompilation = this.compilation

      this.readyCompilation = this.readyCompilation.sort((a, b) => Date.parse(b.created_at) - Date.parse(a.created_at))
    }
  }
</script>

<style scoped>

</style>

