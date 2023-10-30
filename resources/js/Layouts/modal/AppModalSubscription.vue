<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div :class="{short:true}"
         class=" modal-content relative   flex flex-col   bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[32%] lg:w-[50%] md:w-[64%] sm:w-[90%] h-fit">
      <div class="relative title flex justify-between items-center">
        <h3 v-if="subscription == 1">{{ language.subscription[71] }}</h3>
        <h3 v-else>{{ language.subscription[18] }}</h3>
        <button @click="$emit('close-modal-verification')" class="hover__close transition-all relative w-4 h-4 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div>
        <div class="form" v-if="subscription == 1">
          <p >
            {{ language.subscription[72] }}
          </p>

          <button
            @click="sendTrial"
            class="hover__button--purple transition-all bg-[#6435A5] text-[15px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] py-4 xxl:py-3 xl:py-2.5  leading-none text-white m-5 xxl:m-4 xl:m-3 rounded-[5px]">
            {{ language.subscription[73] }}
          </button>
        </div>
        <div class="form" v-else>
          <p>
            {{ language.subscription[19] }}
          </p>

          <button
            @click="$emit('close-modal-verification')"
            class="hover__button--purple transition-all bg-[#6435A5] text-[15px] xxl:text-[13px] xl:text-[11px] lg:text-[14px] py-4 xxl:py-3 xl:py-2.5  leading-none text-white m-5 xxl:m-4 xl:m-3 rounded-[5px]">
            {{ language.subscription[20] }}
          </button>
        </div>
      </div>
    </div>
    <div @click="$emit('close-modal-verification')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
  import { useForm } from '@inertiajs/inertia-vue3'

  export default {
    props: [
      'subscription',
      'language'
    ],
    mounted() {
      console.log(this.subscription);
    },
    methods: {
      sendTrial() {
        const form = useForm();

        form.post('/trial');
      }
    },
    name: "AppModalSubscription"
  }
</script>

<style scoped>

  .modal-content {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 50vw;
  }

  .title {
    font-size: 1.2vw;
    display: flex;
    font-weight: 600;
    align-items: center;

  }

  p {
    font-size: .83vw;
    line-height: 125%;
  }

  ul li {
    font-size: .83vw;
    line-height: 125%;
  }

  .red {
    font-weight: 600;
    color: rgb(232 70 128);
    padding: 7px 0px;
    line-height: 125%;
  }

  .form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 15px;
  }

  .form input[type="text"] {
    height: 100%;
  }

  .form textarea {
    resize: none;
  }

  .input-file {
    position: relative;
    display: inline-block;
  }

  .input-file span {
    position: relative;
    display: inline-block;
    cursor: pointer;
    outline: none;
    display: block;
    text-decoration: none;
    font-size: .83vw;
    vertical-align: middle;
    border: 2px solid rgb(232 70 128);
    color: rgb(232 70 128);
    text-align: center;
    border-radius: 4px;
    background-color: transparent;
    line-height: .83vw;
    padding: 8px 20px;
    box-sizing: border-box;
    margin: 0;
    margin-top: 10px;
    transition: background-color 0.2s;
  }

  .input-file input[type=file] {
    position: absolute;
    z-index: -1;
    opacity: 0;
    display: block;
    width: 0;
    height: 0;
  }

  label {
    font-size: .83vw;
  }

  .row {
    display: flex;
    gap: 15px;
  }

  /* Hover/active */
  .input-file:hover span {
    background-color: rgb(232 70 128);;
    border: 2px solid transparent;
    color: white;
  }

  .input-file:active span {
    background-color: rgb(232 70 128);;
    border: 2px solid transparent;
    color: white;
  }

  /* Disabled */
  .input-file input[type=file]:disabled + span {
    background-color: #eee;
  }

  .form button {
    width: 100%;
    margin: 0;
    font-size: .83vw;
  }

  .text-success {
    text-align: center;
    font-size: 1.3vw;
    font-weight: 600;
    line-height: 140%;
  }

  .text-success span {
    color: rgb(232 70 128);;
  }

  .success-block {
    background: rgb(232 70 128);
    padding: 3vw;
    width: 4vw;
    display: block;
    height: 4vw;
    display: flex;
    margin: 0 auto;
    font-size: 3vw;
    border-radius: 50%;
    color: white;
    align-items: center;
    justify-content: space-around;
  }

  .short {
    width: 35vw;
  }

  .success {
    display: flex;
    gap: 20px;
    flex-direction: column;
  }

  .short .title button {
    margin-left: auto;
  }

  @media (max-width: 768px) {
    .modal-content {
      width: calc(100vw - 20px);
      padding: 6vw;
    }

    .title {
      font-size: 18px;
    }

    p {
      font-size: 13px;
      line-height: 125%;
    }

    ul li {
      font-size: 13px;
      line-height: 125%;
    }

    .form {
      margin-top: 4vw;
    }

    .form .row {
      flex-direction: column;
    }

    label, input, textarea {
      font-size: 13px;
    }

    .input-file span {
      font-size: 13px;
      padding: 3.4vw 20px;
    }

    .form button {
      font-size: 13px;
    }

    .short {
      width: calc(100vw - 20px);
    }

    .success-block {
      padding: 6vw;
      width: 17vw;
      height: 17vw;
      font-size: 9vw;
    }

    .text-success {
      font-size: 4vw;
    }
  }


</style>
