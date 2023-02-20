<script setup>
  import Checkbox from '@/Components/Checkbox.vue';
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

  // defineProps({
  //   canResetPassword: Boolean,
  //   status: String,
  // });

  const form = useForm({
    email: '',
    password: '',
    remember: false,
  });

  const submit = () => {
    form.post(route('login'), {
      onFinish: () => form.reset('password'),
    });
  };
</script>

<template>
<!--  Вход в приложение как риэлтор -->
  <div v-if="oLoginRealtor" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">Вход в личный кабинет</h2>
        <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <div class="flex flex-col p-5 xxl:pb-4 xl:pb-3 mb-8 xxl:mb-6 xl:mb-5 border border-solid border-[#E5DFEE] rounded-[6px]" v-bind:class="{ 'Error': phone_error }">
        <label for="telephone" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]">Телефон</label>
        <input
          v-model="phone"
          class="text-[#1E1D2D] border-transparent focus:border-transparent focus:ring-0 text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0"
          type="tel"
          id="telephone"
          maxlength="18"
        >
      </div>
      <button class="login__btn--bg text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3 border border-solid border-[#E5DFEE] rounded-[6px]" v-on:click="checkPhone">Войти</button>
      <div class="flex items-center justify-center text-base xxl:text-sm xl:text-xs">
        <button @click="openLoginDeveloper" class="text-[#E84680]">Войти как застройщик</button>
      </div>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>

<!-- Вход с кодом с телефона -->
  <div v-if="oOpenRegister" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
      <div class="relative mb-4 xxl:mb-3 xl:mb-2.5">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">Вход в личный кабинет</h2>
        <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <p class="text-[#8A8996] mb-5 xxl:mb-4 xl:mb-3 text-center text-base xxl:text-[13px] xl:text-[11px]">На номер +{{ phone }} был отправлен код</p>
      <div class="modal__telephone-cod gap-5 xxl:gap-4 xl:gap-3 mb-7 xxl:mb-6 xl:mb-5">
        <input type="number" v-bind:class="{ 'Error': valueTelOne_error }" v-model="valueTelOne" @input="changeValueOne" ref="item1" class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-bind:class="{ 'Error': valueTelTwo_error }" v-model="valueTelTwo" @input="changeValueTwo" ref="item2" class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-bind:class="{ 'Error': valueTelThree_error }" v-model="valueTelThree" @input="changeValueThree" ref="item3" class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-bind:class="{ 'Error': valueTelFour_error }" v-model="valueTelFour" @input="changeValueFour" ref="item4" class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
      </div>
      <div class="flex flex-col items-center mb-10 xxl:mb-8 xl:mb-6 text-base xxl:text-[13px] xl:text-[11px]">
<!--        <span class="text-[#8A8996]">Отправить код еще раз через <span class="text-[#E84680]"> {{  }} </span></span>-->
        <button class="text-[#E84680]" v-on:click="oOpenRegister = false">Ввести другой номер</button>
      </div>
      <div class="mb-8 xxl:mb-6 xl:mb-5 flex justify-center">
        <input class="custom__checkbox" type="checkbox" id="privacy-policy" checked>
        <label class="text-base xxl:text-[13px] xl:text-[11px]" for="privacy-policy">Политика конфиденциальности</label>
      </div>
      <button class="login__btn--bg text-white w-full text-lg xxl:text-[15px] xl:text-xs p-5 xxl:p-4 xl:p-3 border border-solid border-[#E5DFEE] rounded-[6px]" v-on:click="sendLogin()">Войти</button>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>

<!-- Вход в приложение как застройщик -->
  <div v-if="oLoginDeveloper" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">Вход в личный кабинет</h2>
        <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button>
      </div>
      <form @submit.prevent="submit">
      <div class="flex flex-col p-5 xxl:pb-4 xl:pb-3 mb-8 xxl:mb-6 xl:mb-5 border border-solid border-[#E5DFEE] rounded-[6px]">
        <label for="email" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]" :class="{'error': form.errors.email}">Email \ Login {{ form.errors.email }}</label>
        <input
          class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0"
          id="email"
          v-model="form.email"
        >
      </div>
      <div class="flex flex-col p-5 xxl:pb-4 xl:pb-3 mb-8 xxl:mb-6 xl:mb-5 border border-solid border-[#E5DFEE] rounded-[6px]">
        <label for="password" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]" :class="{ 'error': form.errors.password }">Пароль {{ form.errors.password }}</label>
        <div class="relative">
          <input v-model="form.password" class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0" type="password" id="password">
        </div>
      </div>
      <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="login__btn--bg text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3 border border-solid border-[#E5DFEE] rounded-[6px]">Войти</button>
      </form>
      <div class="flex items-center justify-center text-base xxl:text-sm xl:text-xs">
        <button @click="openLoginRealtor" class="text-[#E84680]">Войти как риэлтор</button>
      </div>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
  props: {
    oLoginRealtor: {
      type: Boolean
    },
    oLoginDeveloper: {
      type: Boolean
    }
  },
  data() {
    return {
      valueTelOne: null,
      valueTelTwo: null,
      valueTelThree: null,
      valueTelFour: null,
      loginRealtor: false,
      loginDeveloper: false,
      oOpenRegister: false,
      developer: {
        email: '',
        password: ''
      },
      phone: '',
      phone_error: false,
      phone_error_message: '',
      code: '',
      code_error: false,

      valueTelOne_error: false,
      valueTelTwo_error: false,
      valueTelThree_error: false,
      valueTelFour_error: false,
    }
  },
  emits: [
    'close-modal',
    'open-modal-realtor',
    'open-modal-developer',
  ],
  methods: {
    checkPhone() {

      if(this.phone.length < 11) {
        this.phone_error = true;
        this.phone_error = 'Не верная длинна';
      } else if(this.phone[0] === '+' || this.phone[0] === '') {
        this.phone_error = true;
        this.phone_error_message = '+ необходимо убрать / пробелы тоже';
      } else {
        this.sendCode();
        this.phone_error = false;
        this.phone_error_message = '';
      }
    },
    sendCode() {
      axios.post('/api/user/sendCode', {
        phone: this.phone
      }).then(res => {
        if(res.data === false) {
          this.phone_error = true;
        } else {
          this.oOpenRegister = true;
        }
      })
    },
    sendLogin() {

      if(this.valueTelOne === null) {
        this.valueTelOne_error = true;
      } else {
        this.valueTelOne_error = false;
      }

      if(this.valueTelTwo === null) {
        this.valueTelTwo_error = true;
      } else {
        this.valueTelTwo_error = false;
      }

      if(this.valueTelThree === null) {
        this.valueTelThree_error = true;
      } else {
        this.valueTelThree_error = false;
      }

      if(this.valueTelFour === null) {
        this.valueTelFour_error = true;
      } else {
        this.valueTelFour_error = false;
      }

      if(this.valueTelOne_error !== true && this.valueTelTwo_error !== true && this.valueTelThree_error !== true && this.valueTelFour_error !== true) {

        this.code = this.valueTelOne + '' + this.valueTelTwo + '' + this.valueTelThree + '' + this.valueTelFour;

        const form = useForm({
          phone: this.phone,
          code: this.code,
        });

        form.post(route('loginPhone'), {});

      }


    },
    clickLoginDeveloper() {
      const form = useForm({
        email: this.developer.email,
        password: this.developer.password,
      });

      form.post(route('login'), {});
    },

    inputMask(e) {
      let numValue = this.valueInputMask.replace(/\D/g, ""),
          formattedValue = "",
          selStart = e.target.selectionStart

      if (e.target.value.length != selStart) {
        console.log(e)
        return
      }

      if (["7", "8", "9"].indexOf(numValue[0]) > -1) {
        if (numValue[0] == '9') {
          numValue = '7' + numValue
        }
        let firstSymbols = (numValue[0] == '8') ? '8' : '+7'
        formattedValue = firstSymbols + " "
        if (numValue.length > 1) {
          formattedValue += numValue.substring(1, 4)
        }
        if (numValue.length >= 5) {
          formattedValue += " " + numValue.substring(4, 7)
        }
        if (numValue.length >= 8) {
          formattedValue += " " + numValue.substring(7, 9)
        }
        if (numValue.length >= 10) {
          formattedValue += " " + numValue.substring(9, 11)
        }
      } else {
        formattedValue = "+" + numValue.substring(0, 16)
      }
      this.valueInputMask = formattedValue
    },
    keydown(e) {
      if (e.target.value.length == 3) {
        this.valueInputMask = ''
      }
    },
    openLoginRealtor() {
      this.$emit('open-modal-realtor')
    },
    openLoginDeveloper() {
      this.$emit('open-modal-developer')
    },
    closeModal() {
      this.$emit('close-modal')
    },
    changeValueOne() {
      if (this.valueTelOne.toString().length > 1) {
        this.valueTelOne = this.valueTelOne.toString().substring(0, 1)
      } else if (this.valueTelOne.toString().length === 1) {
        this.$refs.item2.focus()
      }
    },
    changeValueTwo() {
      if (this.valueTelTwo.toString().length > 1) {
        this.valueTelTwo = this.valueTelTwo.toString().substring(0, 1)
      } else if (this.valueTelTwo.toString().length === 1) {
        this.$refs.item3.focus()
      } else {
        this.$refs.item1.focus()
      }
    },
    changeValueThree() {
      if (this.valueTelThree.toString().length > 1) {
        this.valueTelThree = this.valueTelThree.toString().substring(0, 1)
      } else if (this.valueTelThree.toString().length === 1) {
        this.$refs.item4.focus()
      } else {
        this.$refs.item2.focus()
      }

    },
    changeValueFour() {
      if (this.valueTelFour.toString().length > 1) {
        this.valueTelFour = this.valueTelFour.toString().substring(0, 1)
      } else if (this.valueTelFour.toString().length === 0) {
        this.$refs.item3.focus()
      }
    },
  },
}
</script>

<style scoped>

  .error {
    color: red!important;
  }
  .Error {
    color: red!important;
    border-color: red!important;
  }

</style>
