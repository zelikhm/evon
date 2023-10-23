

<template>
  <!--  Вход в приложение как риэлтор -->
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div
      class=" modal text relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
       <div  class="relative mb-9 xxl:mb-6 xl:mb-5">
        <h2 class="text-center text-[22px] xxl:text-lg xl:text-base font-semibold">
          Спасибо за регистрацию на платформе EVON, вы можете зайти в свой профиль, нажав войти «Как риелтор» и ввести логин (электронная почта), вам придет пароль на электронную почту
        </h2>
      </div>
    </div>
    <div @click="closeModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
  export default {
    props: {

    },
    data() {
      return {

      }
    },
    methods: {
      closeModal() {
        this.$emit('closeModal')
      },
    },
  }
</script>

<style scoped>
.modal.text h2 {
  font-family: 'ALS Gorizont';
  font-style: normal;
  font-weight: 400;
  font-size: 1.2833333333333335vw;
  line-height: 1.6354166666666665vw;
  display: flex;
  align-items: center;
  color: #FFFFFF;
  margin-bottom: 0;
}
.modal.text div{
  margin-bottom: 0;
}
.modal.text{
  padding: 2vw;
}
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

  @media   (max-width:1000px){
    .modal.text h2 {
      font-family: 'ALS Gorizont';
      font-style: normal;
      font-weight: 400;
      font-size: 4.2833333333333335vw;
      line-height: 5.6354166666666665vw;
      display: flex;
      align-items: center;
      color: #FFFFFF;
      margin-bottom: 0;
    }
    .modal.text div{
      margin-bottom: 0;
    }
    .modal.text{
      padding: 4vw;
      width: 90%;
    }
  }

</style>
