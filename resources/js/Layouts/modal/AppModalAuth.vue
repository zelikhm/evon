<script setup>
  import Checkbox from '@/Components/Checkbox.vue';
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import {Head, Link, useForm} from '@inertiajs/inertia-vue3';

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
    <div
      class="modal relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">{{ language.po_v_r[0] }}</h2>
       <!--  <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button> -->
      </div>
      <div
        class="flex flex-col   xxl:pb-4 xl:pb-3 mb-8 xxl:mb-6 xl:mb-5  "
        v-bind:class="{ 'Error': email_error }">
        <!-- <label for="telephone" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]" v-if="not_email !== true">Email</label>
        <label for="telephone" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996] Error" v-else>{{ language.reg[11] }}</label> -->
        <input
          placeholder="Email"
          v-model="email"
          class="text-[#1E1D2D] border-transparent focus:border-transparent focus:ring-0 text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0"
          type="email"
          id="telephone"
          maxlength="100"
        >
      </div>
      <p style="color: green; font-size: 14px; text-align: center" v-if="email_success && code_error !== true">
        {{ language.reg[12] }}
      </p>
      <p style="color: red; font-size: 14px; text-align: center" v-if="email_success && code_error">
        {{ language.reg[13] }}
      </p>
      <div class="modal__telephone-cod gap-5 xxl:gap-4 xl:gap-3 mb-7 xxl:mb-6 xl:mb-5" v-if="email_success">

        <input type="number" v-bind:class="{ 'Error': One_error }" v-model="One"
               @input="changeValueOne"
               ref="item1"
               class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-bind:class="{ 'Error': Two_error }" v-model="Two"
               @input="changeValueTwo"
               ref="item2"
               class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-bind:class="{ 'Error': Three_error }" v-model="Three"
               @input="changeValueThree"
               ref="item3"
               class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-bind:class="{ 'Error': Four_error }" v-model="Four"
               @input="changeValueFour"
               ref="item4"
               class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-bind:class="{ 'Error': Five_error }" v-model="Five"
               @input="changeValueFive"
               ref="item5"
               class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
        <input type="number" v-bind:class="{ 'Error': Six_error }" v-model="Six"
               @input="changeValueSix"
               ref="item6"
               class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">
      </div>

      <button
        v-if="preloader !== true && email_success === false"
        class="login__btn--bg text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3 border border-solid border-[#E5DFEE] rounded-[6px]"
        v-on:click="checkEmail">{{ language.po_v_r[8] }}
      </button>
      <button
        v-else-if="preloader === true && email_success === false"
        class="login__btn--bg text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3 border border-solid border-[#E5DFEE] rounded-[6px]"
        ><div class="loader"></div>
      </button>
      <button
        v-if="preloader !== true && email_success === true"
        class="login__btn--bg text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3 border border-solid border-[#E5DFEE] rounded-[6px]"
        v-on:click="sendLogin">{{ language.po_v_r[8] }}
      </button>

      <div class="flex items-center justify-center text-base xxl:text-sm xl:text-xs">
        <button @click="openLoginDeveloper" class="text-[#E84680] login-ref">{{ language.po_v_r[3] }}</button>
      </div>
    </div>
    <div @click="closeModal" class="modal-bg absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>

  <!--&lt;!&ndash; Вход с кодом с телефона &ndash;&gt;-->
  <!--  <div v-if="oOpenRegister" class="fixed z-[100] w-full h-full flex items-center justify-center">-->
  <!--    <div class="relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">-->
  <!--      <div class="relative mb-4 xxl:mb-3 xl:mb-2.5">-->
  <!--        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">{{ language.po_v_r[0] }}</h2>-->
  <!--        <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">-->
  <!--          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>-->
  <!--          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>-->
  <!--        </button>-->
  <!--      </div>-->
  <!--      <p class="text-[#8A8996] mb-5 xxl:mb-4 xl:mb-3 text-center text-base xxl:text-[13px] xl:text-[11px]">На номер +{{ phone }} был отправлен код</p>-->
  <!--      <div class="modal__telephone-cod gap-5 xxl:gap-4 xl:gap-3 mb-7 xxl:mb-6 xl:mb-5">-->
  <!--        <input type="number" v-bind:class="{ 'Error': valueTelOne_error }" v-model="valueTelOne" @input="changeValueOne" ref="item1" class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">-->
  <!--        <input type="number" v-bind:class="{ 'Error': valueTelTwo_error }" v-model="valueTelTwo" @input="changeValueTwo" ref="item2" class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">-->
  <!--        <input type="number" v-bind:class="{ 'Error': valueTelThree_error }" v-model="valueTelThree" @input="changeValueThree" ref="item3" class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">-->
  <!--        <input type="number" v-bind:class="{ 'Error': valueTelFour_error }" v-model="valueTelFour" @input="changeValueFour" ref="item4" class="border-transparent focus:border-[#6435A5] focus:ring-0 text-center text-[36px] xxl:text-[30px] xl:text-[24px] p-2.5 xxl:p-2 xl:p-1.5">-->
  <!--      </div>-->
  <!--      <div class="flex flex-col items-center mb-10 xxl:mb-8 xl:mb-6 text-base xxl:text-[13px] xl:text-[11px]">-->
  <!--&lt;!&ndash;        <span class="text-[#8A8996]">Отправить код еще раз через <span class="text-[#E84680]"> {{  }} </span></span>&ndash;&gt;-->
  <!--        <button class="text-[#E84680]" v-on:click="oOpenRegister = false">Ввести другой номер</button>-->
  <!--      </div>-->
  <!--      <div class="mb-8 xxl:mb-6 xl:mb-5 flex justify-center">-->
  <!--        <input class="custom__checkbox" type="checkbox" id="privacy-policy" checked>-->
  <!--        <label class="text-base xxl:text-[13px] xl:text-[11px]" for="privacy-policy">{{ language.po_v_r[7] }}</label>-->
  <!--      </div>-->
  <!--      <button class="login__btn&#45;&#45;bg text-white w-full text-lg xxl:text-[15px] xl:text-xs p-5 xxl:p-4 xl:p-3 border border-solid border-[#E5DFEE] rounded-[6px]" v-on:click="sendLogin()">Войти</button>-->
  <!--    </div>-->
  <!--    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>-->
  <!--  </div>-->

  <!-- Вход в приложение как застройщик -->
  <div v-if="oLoginDeveloper" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div
      class="modal relative   rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
      <div class="relative mb-10 xxl:mb-8 xl:mb-6">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">{{ language.po_v_r[0] }}</h2>
        <!-- <button @click="closeModal" class="hover__close transition-all w-4 h-4 absolute top-[20%] right-0 z-50">
          <div class="absolute h-[1px] w-4 bg-[#8A8996] rotate-45"></div>
          <div class="absolute h-[1px] w-4 bg-[#8A8996] -rotate-45"></div>
        </button> -->
      </div>
      <form @submit.prevent="submit" >
        <div
          class="flex flex-col  xxl:pb-4 xl:pb-3 mb-[30px] xxl:mb-6 xl:mb-5  rounded-[6px]">
          <!--
            mb-8 p-5 border border-solid border-[#E5DFEE]
            <label for="email" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]"
                 :class="{'error': form.errors.email}">Email \ Login {{ form.errors.email }}</label> -->
          <input
            class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0"
            id="email"
            v-model="form.email" placeholder="Email/Login"
          >
        </div>
        <div
          class="flex flex-col xxl:pb-4 xl:pb-3 mb-[30px]  xxl:mb-6 xl:mb-5 rounded-[6px]">
          <!-- mb-8  p-5 border border-solid border-[#E5DFEE]
            <label for="password" class="text-sm xxl:text-xs xl:text-[10px] text-[#8A8996]"
                 :class="{ 'error': form.errors.password }">{{ language.po_v_r[9] }} {{ form.errors.password }}</label> -->
          <div class="relative">
            <input v-model="form.password" placeholder="Пароль"
                   class="border-transparent focus:border-transparent focus:ring-0 text-[#1E1D2D] w-full text-lg xxl:text-[15px] xl:text-xs bg-none outline-none p-0"
                   type="password" id="password ">
          </div>
        </div>
        <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                class="login__btn--bg text-white w-full text-lg xxl:text-[15px] xl:text-xs mb-5 xxl:mb-4 xl:mb-3 p-5 xxl:p-4 xl:p-3   rounded-[6px]">
          {{ language.po_v_r[8] }}
        </button>
      </form>
      <div class="flex items-center justify-center text-base xxl:text-sm xl:text-xs">
        <button @click="openLoginRealtor" class="text-[#E84680] login-ref">{{ language.po_v_r[10] }}</button>
      </div>
    </div>
    <div @click="closeModal" class="modal-bg absolute bg-black opacity-50 h-full w-full z-40"></div>
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
      },
      selectLanguage: 0,
      language: {}
    },
    data() {
      return {
        One: null,
        Two: null,
        Three: null,
        Four: null,
        Five: null,
        Six: null,
        loginRealtor: false,
        loginDeveloper: false,
        oOpenRegister: false,
        developer: {
          email: '',
          password: ''
        },
        email_success: false,
        not_email: false,
        email: '',
        email_error: false,
        One_error: false,
        Two_error: false,
        Three_error: false,
        Four_error: false,
        Five_error: false,
        Six_error: false,
        preloader: false,
        code_error: false,
        code_send: '',
      }
    },
    emits: [
      'close-modal',
      'open-modal-realtor',
      'open-modal-developer',
    ],
    methods: {
      checkEmail() {

        this.preloader = true;

       if(this.validEmail(this.email)) {
         this.email_error = false;

         this.sendCode();
       } else {
         this.email_error = true;
         this.preloader = false;
       }

      },
      validEmail: function (email) {
        var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      },
      sendCode() {
        axios.post('/api/user/sendCode', {
          email: this.email
        }).then(res => {
          if(res.data.status === false) {
            this.not_email = true;
            this.preloader = false;
          } else {
            this.not_email = false;
            this.email_success = true;
            this.preloader = false;
            this.code_send = res.data.code
          }
        })
      },
      sendLogin() {

        if (this.One === null) {
          this.One_error = true;
        } else {
          this.One_error = false;
        }

        if (this.Two === null) {
          this.Two_error = true;
        } else {
          this.Two_error = false;
        }

        if (this.Three === null) {
          this.Three_error = true;
        } else {
          this.Three_error = false;
        }

        if (this.Four === null) {
          this.Four_error = true;
        } else {
          this.Four_error = false;
        }

        if (this.Five === null) {
          this.Five_error = true;
        } else {
          this.Five_error = false;
        }

        if (this.Six === null) {
          this.Six_error = true;
        } else {
          this.Six_error = false;
        }

        if (this.One_error !== true && this.Two_error !== true && this.Three_error !== true && this.Four_error !== true && this.Five_error !== true && this.Six_error !== true) {

          this.code = this.One + '' + this.Two + '' + this.Three + '' + this.Four + '' + this.Five + '' + this.Six;

          if(this.code == this.code_send) {
            this.code_error = false;

            const form = useForm({
              email: this.email,
              code: this.code,
            });

            form.post(route('loginPhone'), {});

          } else {
            this.code_error = true;
          }
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
        if (this.One.toString().length > 1) {
          this.One = this.One.toString().substring(0, 1)
        } else if (this.One.toString().length === 1) {
          this.$refs.item2.focus()
        }
      },
      changeValueTwo() {
        if (this.Two.toString().length > 1) {
          this.Two = this.Two.toString().substring(0, 1)
        } else if (this.Two.toString().length === 1) {
          this.$refs.item3.focus()
        } else {
          this.$refs.item1.focus()
        }
      },
      changeValueThree() {
        if (this.Three.toString().length > 1) {
          this.Three = this.Three.toString().substring(0, 1)
        } else if (this.Three.toString().length === 1) {
          this.$refs.item4.focus()
        } else {
          this.$refs.item2.focus()
        }

      },
      changeValueFour() {
        if (this.Four.toString().length > 1) {
          this.Four = this.Four.toString().substring(0, 1)
        } else if (this.Four.toString().length === 1) {
          this.$refs.item5.focus()
        } else {
          this.$refs.item3.focus()
        }
      },
      changeValueFive() {
        if (this.Five.toString().length > 1) {
          this.Five = this.Five.toString().substring(0, 1)
        } else if (this.Five.toString().length === 1) {
          this.$refs.item6.focus()
        } else {
          this.$refs.item4.focus()
        }
      },
      changeValueSix() {
        if (this.Six.toString().length > 1) {
          this.Six = this.Six.toString().substring(0, 1)
        } else if (this.Six.toString().length === 0) {
          this.$refs.item5.focus()
        }
      },
    },
  }
</script>

<style scoped>

  .error {
    color: red !important;
  }

  .Error {
    color: red !important;
    border-color: red !important;
  }

  .loader_block {

  }

  .loader {
    border: 3px solid black; /* Light grey */
    border-top: 3px solid; /* Blue */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
    margin-left: auto;
    margin-right: auto;
  }

  .minLoader {
    border: 3px solid #f3f3f3; /* Light grey */
    border-top: 3px solid; /* Blue */
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 2s linear infinite;
    padding-left: 5%;
    padding-right: 5%;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }

  .loader_text {
    text-align: center;
  }

</style>
