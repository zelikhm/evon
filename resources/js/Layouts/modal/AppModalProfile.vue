<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative flex flex-col gap-7 xxl:gap-6 xl:gap-5 bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[32%] lg:w-[50%] md:w-[64%] sm:w-[90%] h-fit">
      <div class="relative flex justify-between items-center">
        <h2 class=" text-[22px] xxl:text-lg xl:text-base font-semibold leading-none">{{ language.prof_zastr[8] }}</h2>
        <button @click="$emit('close-pay-profile')" class="hover__close transition-all relative w-4 h-4 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div v-for="item in tarifs" class="flex justify-between items-center border border-solid border-[#E5DFEE] rounded-[5px] p-5 xxl:p-4 xl:p-3">
        <label class="payd__checkbox" v-on:click="setDate(item)">
          <input type="radio" value="1" id="pay_1" name="payd" >
          <span class="text-[18px] xxl:text-[15px] xl:text-[13px]" for="pay_1">{{ item.title }}</span>
        </label>
        <span class="text-[18px] xxl:text-[15px] xl:text-[13px]">{{ item.price / 100 }} TL</span>
      </div>
      <button class="login__btn--bg  rounded-[5px] w-full py-5 xxl:py-4 xl:py-3" v-on:click="payment()" v-if="preloader === false">
        <span class="text-white font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">{{ language.prof_zastr[7] }}</span>
      </button>
      <button class="login__btn--bg  rounded-[5px] w-full py-5 xxl:py-4 xl:py-3" v-else-if="preloader === true">
        <div class="loader"></div>
      </button>
    </div>
    <div @click="$emit('close-pay-profile')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
  import { useForm } from '@inertiajs/inertia-vue3'
export default {
  props: ['tarifs', 'language', 'user'],
  data() {
    return {
      amount: 0,
      type: 0,
      preloader: false,
    }
  },
  methods: {

    payment() {
      this.preloader = true;

      if(this.amount !== 0) {

        axios.post(route('pair'), {
            email: this.user.email,
            price: this.amount,
            type: this.type,
        }).then(res => {
          if(res.status === 200) {
            window.location.href = res.data;
            this.preloader = false;
          } else {
            console.log(res);
            this.preloader = false;
          }

        }).catch(e => {
          console.log(e);
        })

        console.log(1);

      }

    },
    setDate(item) {

      this.type = item.id;
      this.amount = item.price;

    }

  }
}
</script>

<style scoped>

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
