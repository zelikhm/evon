<script setup>

import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
  email: '',
  phone: '',
  first_name: '',
  last_name: '',
  language_id: 0,
  type: 'Агентство недвижимости (владелец/директор)',
  remember: false,
  type_id: 0,
});

const submit = () => {
  form.language_id = document.getElementById("language").value;

  form.post(route('register'), {
    onSuccess: () => {
      form.success = true;
      form.reset('first_name');
      form.reset('last_name');
      form.reset('email');
      form.reset('phone');
    }

  });
};

</script>

<template>
  <input id="language" hidden type="number" :value="selectLanguage">
  <!-- Вход в приложение как застройщик -->
  <div v-if="oLoginRegister" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div
      class=" modal reg relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
      <div class="relative mb-9 xxl:mb-6 xl:mb-5">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">{{ language.reg[0] }}</h2>
        <p v-if="form.success" class="mt-10 text-center" style="color: #FFFFFF;">
          {{ language.reg[10] }}
        </p>
        <!-- <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button> -->
      </div>
      <form v-if="!form.success" @submit.prevent="submit">

        <div class="flex flex-col  xxl:pb-2 xl:pb-2 mb-6 xxl:mb-4 xl:mb-3   rounded-[6px]">
          <!-- <label for="name" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]" :class="{'error': form.errors.first_name}">{{ language.reg[1] }} {{ form.errors.first_name }}</label> -->
          <input v-model="form.first_name"
            class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0"
            type="text" id="name" :placeholder="language.reg[1]">
        </div>
        <div class="flex flex-col   xxl:pb-2 xl:pb-2 mb-6 xxl:mb-4 xl:mb-3  rounded-[6px]">
          <!-- <label for="surname" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]" :class="{'error': form.errors.last_name}">{{ language.reg[2] }} {{ form.errors.last_name }}</label> -->
          <div class="relative">
            <input v-model="form.last_name"
              class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0"
              type="text" id="surname" :placeholder="language.reg[2]">
          </div>
        </div>
        <div class="flex flex-col   xxl:pb-2 xl:pb-2 mb-6 xxl:mb-4 xl:mb-3  rounded-[6px]">
          <!-- <label for="tel" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]" :class="{'error': form.errors.phone}">{{ language.reg[3] }} {{ form.errors.phone }}</label> -->
          <input v-model="form.phone"
            class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0"
            type="tel" id="tel" :placeholder="language.reg[3]">
        </div>
        <div class="flex flex-col   xxl:pb-2 xl:pb-2 mb-6 xxl:mb-4 xl:mb-3  rounded-[6px]">
          <!-- <label for="email" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]" :class="{'error': form.errors.email}">{{ language.reg[4] }} {{ form.errors.email }}</label> -->
          <input v-model="form.email"
            class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0"
            type="email" id="email" :placeholder="language.reg[4]">
        </div>
        <h3 class="text-center text-[18px] xxl:text-base xl:text-base font-semibold">{{ language.reg[5] }}</h3>
        <div class="relative my-4">
          <div @click="openSelectPlaceWork = !openSelectPlaceWork"
            class="select-title flex items-center justify-between cursor-pointer text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] px-5 xxl:px-4 xl:px-3 mb-4 xxl:mb-3 xl:mb-2.5 py-3"
            style="border: 2px solid #E5DFEE;">
            <span class="text-white">{{ selectType }}</span>
            <img src="../../../assets/svg/arrow_down_black.svg" class="w-3 xxl:w-2.5 xl:w-2 transition-all"
              :class="{ 'rotate-180': openSelectPlaceWork }" alt="">
          </div>
          <div v-if="openSelectPlaceWork"
            class="select xxl:max-h-[120px] xl:max-h-[110px] lg:max-h-[80px] overflow-y-auto custom__scroll absolute w-full z-40 bg-[#F6F3FA] flex flex-col top-full left-0 w-full border border-solid border-[#E5DFEE] rounded-b-[6px] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[15px]">
            <span v-for="(type, idx) in types" :key="idx" @click="changeSelectTypes(type), form.type = selectType, form.type_id = type.id"
              class="hover__select cursor-pointer px-5 xxl:px-4 xl:px-3 py-3 xxl:py-2.5 xl:py-2 leading-none">
              {{ type.type }}
            </span>
          </div>
        </div>

        <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
          class="mt-2 login__btn--bg text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3 border border-solid border-[#E5DFEE] rounded-[6px]">
          {{ language.main[22] }}
        </button>
      </form>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import { onRenderTriggered } from "@vue/runtime-core";

export default {
  props: {
    oLoginRegister: {
      type: Boolean
    },
    selectLanguage: 0,
    language: {},
    message: ''
  },
  watch: {
    language(newItem) {
      this.types = [
        { id: 0, type: newItem.reg[6] },
        { id: 1, type: newItem.reg[7] },
        { id: 2, type: newItem.reg[8] },
        { id: 3, type: newItem.reg[9] },
      ];
      this.selectType = newItem.reg[6];
      // this.setup();
    }
  },
  data() {
    return {
      success: {
        color: 'green'
      },
      failed: {
        color: 'red'
      },
      selectType: this.language.reg[6],
      openSelectPlaceWork: false,
      types: [
        { id: 0, type: this.language.reg[6] },
        { id: 1, type: this.language.reg[7] },
        { id: 2, type: this.language.reg[8] },
        { id: 3, type: this.language.reg[9] },
      ],
      user: {
        first_name: '',
        last_name: '',
        phone: '',
        email: '',
      }
    }
  },
  emits: [
    'close-modal',
    'open-modal-realtor',
    'open-modal-developer',
  ],
  mounted() {
    console.log(this.message);
  },
  setup() {
    this.form.language = this.selectLanguage;

    onMounted(() => {
      console.log('Компонент примонтирован!')
    })
  },
  methods: {
    // sendReg() {
    //   const form = useForm({
    //     first_name: this.user.first_name,
    //     last_name: this.user.last_name,
    //     email: this.user.email,
    //     phone: this.user.phone,
    //     type: this.selectType,
    //     language_id: this.selectLanguage
    //   });
    //
    //   form.post(route('mail'), {
    //
    //   });
    // },
    closeModal() {
      this.$emit('close-modal')
    },
    changeSelectTypes(type) {
      this.selectType = type.type
      this.openSelectPlaceWork = false
    }
  }
}
</script>

<style scoped>
.error {
  color: red;
}
</style>
