<template>
  <div v-if="openChangeClient" class="fixed flex justify-end z-[100] top-0 ring-0 w-full h-full">
    <div :class="{ 'translate__x__0': openSideBar }"
      class="transition-all ease-linear duration-500 flex flex-col relative z-50 w-[50%] lg:w-[64%] sm:w-full translate-x-full h-[100vh] bg-white px-28 xxl:px-24 xl:px-20 lg:px-10 sm:px-5 py-14 xxl:py-10 xl:py-8 lg:py-5">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-[22px] xxl:text-lg xl:text-base font-semibold">
          {{ tool == 1 ? 'Добавление' : 'Редактировать' }} клиента
        </h2>
        <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 rotate-45"></div>
          <div class="absolute h-[1px] w-4 -rotate-45"></div>
        </button>
      </div>
      <div
        class="flex flex-col h-[100vh] gap-5 xxl:gap-4 xl:gap-3 chat__container--flex overflow-y-auto custom__scroll--chess">
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none">{{ language.rielt_3[1]
        }}</h3>
        <div :class="{ validation: validation.name == false }"
          class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">Ф.И.О</label>
          <input v-model="compilation.name"
            class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
            type="text" id="post_contact">
        </div>
        <div :class="{ validation: validation.phone == false }"
          class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">Телефон</label>
          <input v-model="compilation.phone"
            class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
            type="tel" @input="validatePhoneInput()">
        </div>
        <div :class="{ validation: validation.WatTelg == false }"
          class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">WatsApp / Телеграмм</label>
          <input v-model="compilation.WatTelg"
            class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
            type="tel">
        </div>
        <!-- <div
          class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">Запрос клиента</label>
          <textarea v-model="compilation.customerRequest"
            class="text-[#1E1D2D] resize-none text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0 min-h-[50px]"
            type="text"></textarea>
        </div> -->
        <div :class="{ validation: validation.interested == false }"
          class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">Заинтересован в</label>
          <input v-model="compilation.interested"
            class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
            type="text">
        </div>
        <div :class="{ validation: validation.comment == false }"
          class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">Комментарий</label>
          <textarea v-model="compilation.comment"
            class="text-[#1E1D2D] resize-none text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0 min-h-[50px]"
            type="text"></textarea>
        </div>
        <div class="status"
          :class="{ validation: validation.checkbox1Active == false && validation.checkbox2Active == false }">
          <label class="text-base xxl:text-[13px] xl:text-[11px] leading-none" for="checkbox1">Статус клиента </label>
        </div>
        <div class="flex flex-row w-full gap-5 rounded-[6px] px-5 xxl:px-4 py-4 xl:py-2.5">
          <div class="mb-4 xxl:mb-3 xl:mb-3">
            <input class="custom__checkbox" type="checkbox" id="checkbox1" v-model="compilation.checkbox1Active"
              @click="toggleCheckbox(1)">
            <label class="text-base xxl:text-[13px] xl:text-[11px] leading-none" for="checkbox1">Определился с жк</label>
          </div>
          <div class="mb-4 xxl:mb-3 xl:mb-3">
            <input class="custom__checkbox" type="checkbox" id="checkbox2" v-model="compilation.checkbox2Active"
              @click="toggleCheckbox(2)">
            <label class="text-base xxl:text-[13px] xl:text-[11px] leading-none" for="checkbox2">Не определился с
              жк</label>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-8 xxl:gap-6 xl:gap-5" style="margin-top:20px">
        <button @click="validateCompilation"
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
  props: ['openChangeClient', 'openSideBar', 'user', 'itemCompilation', 'language', "tool", "clientInfo"],
  data() {
    return {
      compilation: {
        id: null,
        name: "",
        phone: null,
        WatTelg: null,
        customerRequest: "",
        interested: "",
        comment: "",
        checkbox1Active: false,
        checkbox2Active: false,
      },
      validation: {
        name: null,
        phone: null,
        WatTelg: null,
        customerRequest: null,
        interested: null,
        comment: null,
        checkbox1Active: null,
        checkbox2Active: null,
      },
      JK: [],
      JKlist: [],
      arrDelJK: [],
    }
  },
  emits: ['close-create-selection', 'close-selection'],
  methods: {
    toggleCheckbox(checkboxNumber) {
      this.compilation.checkbox1Active = checkboxNumber === 1;
      this.compilation.checkbox2Active = checkboxNumber === 2;
    },
    validatePhoneInput() {
      this.compilation.phone = this.compilation.phone.match(/[\d+]/g)?.join('') || '';
      this.compilation.WatTelg = this.compilation.WatTelg.match(/[\d+]/g)?.join('') || '';
    },
    closeModal() {
      this.$emit('close-create-selection')

      Object.assign(this.compilation, {
        name: "",
        phone: null,
        WatTelg: null,
        customerRequest: "",
        interested: "",
        comment: "",
        checkbox1Active: false,
        checkbox2Active: false,
      });
    },
    validateCompilation() {
      const keys = Object.keys(this.compilation);
      this.validation = {};
      for (const key of keys) {
        this.validation[key] = Boolean(this.compilation[key]);
      }
      const { name, phone, WatTelg, interested, comment, checkbox1Active, checkbox2Active } = this.validation;
      if (name && phone && WatTelg && interested && comment && (checkbox1Active || checkbox2Active)) {
        this.sendData();
      }
    },
    sendData() {
      axios.post(this.tool === 1 ? '/api/client/send' : '/api/client/edit', {
        client_id: this.tool === 2 ? this.compilation.id : undefined,
        user_id: this.user.id,
        name: this.compilation.name,
        phone: this.compilation.phone,
        soc: this.compilation.WatTelg,
        client_text: this.compilation.interested,
        jk: this.compilation.checkbox1Active ? 1 : 2,
        status_client: 0,
        status_order: 0,
        comment: this.compilation.comment,
      }).then(res => {

        this.$emit("reload", res.data);  
        this.$emit("close-create-selection");
      });
    }
  },
  created() {
    if (this.tool === 2) {
      const { id, name, phone, soc: WatTelg, client_text: interested, comment, jk } = this.clientInfo;
      this.compilation = {
        ...this.compilation,
        id,
        name,
        phone,
        WatTelg,
        interested,
        comment,
        checkbox1Active: jk === "1" ? true : false,
        checkbox2Active: jk === "2" ? true : false,
      };
    }
  },
}
</script>

<style scoped>
.validation {
  border: 1px solid red;
}

.status {
  border: 0px solid !important;
}

.validation label {
  color: red;
}
</style>
