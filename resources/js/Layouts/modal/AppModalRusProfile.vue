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
      <div v-for="item in tarifs" class="block flex justify-between items-center border border-solid border-[#E5DFEE] rounded-[5px] p-5 xxl:p-4 xl:p-3">
        <label class="payd__checkbox" v-on:click="setDate(item)">
          <input type="radio" value="1" id="pay_1" name="payd" >
          <span class="text-[18px] xxl:text-[15px] xl:text-[13px]" for="pay_1">{{ item.title }}</span>
        </label>
        <span class="text-[18px] xxl:text-[15px] xl:text-[13px]">{{ item.price }} RUB</span>
      </div>
      <button class="login__btn--bg  rounded-[5px] w-full py-5 xxl:py-4 xl:py-3" v-on:click="payment()" v-if="preloader === false">
        <span class="text-white font-semibold text-lg xxl:text-[15px] xl:text-[13px] leading-none">{{ language.prof_zastr[7] }}</span>
      </button>
      <button class="login__btn--bg  rounded-[5px] w-full py-5 xxl:py-4 xl:py-3" v-else-if="preloader === true">
        <div class="loader"></div>
      </button>
      <p>
        Тариф для Агентств недвижимости: 
        <br>
        — До 15 кабинетов – 15 000 руб. в месяц<br>
        — До 30 кабинетов – 26 000 руб в месяц<br>
        <br>
        *При оплате за 3 или 6 месяцев – скидка 5% и 10% соответственно.
         <br>
        *При выборе тарифа "Для агентств недвижимости" оплата производится единым платежом за всех сотрудников на счет компании EVON.
        Для согласования и расчета суммы платежа необходимо прислать на почту evon.information@gmail.com информацию по выбранному тарифу и количеству агентов, указав список в формате: Имя, Фамилия, телефон, E-mail.
        Также можете написать нам:<br>
        - WhatsApp: +90 544 225 85 59
      </p>
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

      cloudPaymentTrial: function (price, email) {
        let language = "ru-RU";
        let dateNow = new Date();
        let newDate = new Date();
        let date = newDate.setDate(dateNow.getDate() + 3);
        let data = {};

        const generateRandomString = (length) => {
          let result = '';
          const characters =
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
          const charactersLength = characters.length;
          for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
          }
          return result;
        };

        data.CloudPayments = {
          Amounts: price,
          Email: email,
          Type: this.type,
          user_id: this.user.id,
          random: generateRandomString(20),
        };



        var widget = new cp.CloudPayments({
          language: language
        })
        widget.pay('auth', // или 'charge'
          { //options
            publicId: 'pk_bfb7636e452f95334466cd885af0f',
            description: 'Оформление подписки на evon-tr.com',
            amount: price,
            currency: 'RUB',
            accountId: email,
            invoiceId: 1,
            skin: "mini",
            autoClose: 3,
            data: data,
          }, {
            onSuccess: function (options) {
              console.log('success');
            },
            onFail: function (reason, options) {
              const form = useForm({
                options: options
              })

              form.post('/cloud/failed');
            },
            onComplete: function (paymentResult, options) {
              if (paymentResult.success === true) {
                  const form = useForm({
                    options: options
                  })

                  form.post('/cloud/payment');
              }
            }
          }
        )
      },
      payment() {
        this.preloader = true;

        if(this.amount !== 0) {

          this.cloudPaymentTrial(this.amount, this.user.email);

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




  .title {
  font-size: 1.14vw;
}

.block {
  padding: 1.04vw;
}

p {
  font-size: 0.933vw;
  line-height: 160%;
}

.payd__checkbox span {
  font-size: 1.03vw;
}

.payd__checkbox+span {
  font-size: 1.03vw;
}

button {
  padding: 0.677vw 0;
}

button span {
  font-size: 0.87vw;
  line-height: 140%;
  display: block;
}



@media (max-width:700px) {
  .title {
    font-size: 4.37vw;
  }

  .payd__checkbox span {
    font-size: 3.7vw;
  }

  .payd__checkbox+span {
    font-size: 3.7vw;
  }

  button {
    padding: 3.7vw 0;
  }

  button span {
    font-size: 4vw;
    line-height: 100%;
  }

  p {
    font-size: 3.4vw;
    line-height: 150%;
    word-break: break-all;
  }
}




</style>
