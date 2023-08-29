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

        <div class="hint-clients bg-litepink text-[#E84680] text-lg xxl:text-[15px] xl:text-[13px] leading-none py-5 xxl:py-4 xl:py-3 rounded-[6px]">
          <p class="text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1">
            Внимание! Для эффективного сотрудничества вам необходимо провести работу с вашим клиентом по нескольким этапам:
          </p>
          <p class="text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1">
            - Выявить лицо принимающее решение
          </p>
          <p class="text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1">
            - Подробное описание рассматриваемой недвижимости
          </p>
          <p class="text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1">
            - Установить цель покупки
          </p>
          <p class="text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1">
            - Сделать подбор недвижимости с использованием подборок с сайта EVON
          </p>
          <p class="text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1">
            - Планируемая дата сделки или приезда в Турцию
          </p>
          <p class="text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1">
            - Форма оплаты
          </p>
          <p class="text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1">
            - Рекомендация работать в Турции только с нашим партнером
          </p>
        </div>
        <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] font-medium leading-none">{{ language.rielt_3[1]
          }}</h3>
        <div class="status"
             :class="{ validation: validation.checkbox1Active == false && validation.checkbox2Active == false }">
          <label class="text-base xxl:text-[13px] xl:text-[11px] leading-none" for="checkbox1">Статус:</label>
          <div class="row-status flex flex-row w-full gap-5 rounded-[6px] px-5 xxl:px-4 py-4 xl:py-2.5">
            <div class="mb-4 xxl:mb-3 xl:mb-3">
              <input class="custom__checkbox" type="checkbox" id="checkbox1" v-model="compilation.checkbox1Active"
                     @click="toggleCheckbox(1)">
              <label class="text-base xxl:text-[13px] xl:text-[11px] leading-none" for="checkbox1">Определился с объектом</label>
            </div>
            <div class="mb-4 xxl:mb-3 xl:mb-3">
              <input class="custom__checkbox" type="checkbox" id="checkbox2" v-model="compilation.checkbox2Active"
                     @click="toggleCheckbox(2)">
              <label class="text-base xxl:text-[13px] xl:text-[11px] leading-none" for="checkbox2">Не определился с
                объектом</label>
            </div>
          </div>
        </div>
        <div :class="{ validation: validation.interested == false }"
             class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <div v-if="compilation.checkbox1Active">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">
              Определился с объектом
            </label>
            <p class="text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0">
              Ваше вознаграждение составляет 75% от общей комиссии, за вычетом расходов по сделке. Требуется юридическое сопровождение сделки (составление всех необходимых документов для сделки и оплаты), встреча Клиента с сопровождение его до Продавца, помощь в переговорах с Продавцом, консультация по оплате и переводе средств, услуги переводчика
            </p>
          </div>
          <div v-else-if="compilation.checkbox2Active">
            <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">
              Не определился с объектом
            </label>
            <p class="text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0">
              Ваше вознаграждение составляет 40% от общей комиссии, за вычетом расходов по сделке. Требуется осуществить поиск объекта, подбор недвижимости, исчерпывающая информация о рынке недвижимости Турции, юридическое сопровождение сделки, услуги переводчика, полное сопровождение и консультация на всех этапах работы с продавцом, включая: встреча на территории Турции, показ объектов, составление всех необходимых документов для сделки и оплаты, консультирование по вопросам оплаты, международных переводов, рассрочке, а так же послепродажный сервис (консультации по миграционным вопросам, ремонту, покупки мебели и пр.)
            </p>
          </div>
        </div>
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
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">Рассматриваемые объекты с платформы EVON</label>
          <input v-model="compilation.interested"
            class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
            type="text">
        </div>

        <!--Новые поля-->
        <div :class="{ validation: validation.purchasePurpose == false }"
             class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact"> Цель покупки</label>
          <input v-model="compilation.purchasePurpose"
                 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                 type="text">
        </div>
        <div :class="{ validation: validation.plannedDate == false }"
             class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact"> Планируемая дата сделки или приезда в Турцию</label>
          <input v-model="compilation.plannedDate"
                 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"
                 type="date">
        </div>
        <div :class="{ validation: validation.paymentMethod == false }"
             class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact"> Форма оплаты</label>
          <div class="relative">
            <div @click="toggleDropdown" class="dropdown-toggle text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1">
              {{ getPaymentMethodName }}
            </div>

            <ul v-if="select" class="dropdown-menu">
              <li class="text-[#1E1D2D]   text-base xxl:text-sm xl:text-xs pb-3 xxl:pb-2 xl:pb-1" v-for="(method, index) in paymentMethods"
                  :key="index"
                  @click="selectPaymentMethod(index)">
                {{ method }}
              </li>
            </ul>
          </div>
<!--          <input v-model="compilation.paymentMethod"-->
<!--                 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0"-->
<!--                 type="text">-->
        </div>
        <!--!Новые поля-->


        <div :class="{ validation: validation.comment == false }"
          class="flex flex-col w-full border border-solid border-[#E5DFEE] gap-0.5 rounded-[6px] px-5 xxl:px-4 xl:px-3 py-4 xxl:py-3 xl:py-2.5">
          <label class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px]" for="post_contact">Комментарий о клиенте и рассматриваемой недвижимости</label>
          <textarea v-model="compilation.comment"
            class="text-[#1E1D2D] resize-none text-lg xxl:text-[15px] xl:text-[13px] p-0 leading-none border-transparent focus:border-transparent focus:ring-0 min-h-[50px]"
            type="text"></textarea>
        </div>


<!--        <div class="flex flex-row w-full gap-5 rounded-[6px] px-5 xxl:px-4 py-4 xl:py-2.5">-->
<!--          <div class="mb-4 xxl:mb-3 xl:mb-3">-->
<!--            <input class="custom__checkbox" type="checkbox" id="checkbox1" v-model="compilation.checkbox1Active"-->
<!--              @click="toggleCheckbox(1)">-->
<!--            <label class="text-base xxl:text-[13px] xl:text-[11px] leading-none" for="checkbox1">Определился с объектом</label>-->
<!--          </div>-->
<!--          <div class="mb-4 xxl:mb-3 xl:mb-3">-->
<!--            <input class="custom__checkbox" type="checkbox" id="checkbox2" v-model="compilation.checkbox2Active"-->
<!--              @click="toggleCheckbox(2)">-->
<!--            <label class="text-base xxl:text-[13px] xl:text-[11px] leading-none" for="checkbox2">Не определился с-->
<!--              объектом</label>-->
<!--          </div>-->
<!--        </div>-->
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
      select: false,
      paymentMethods: [
        'Выберите форму оплаты',
        'Наличные',
        'Безналичные',
        'Рассрочка',
      ],
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

        purchasePurpose:null,
        plannedDate:null,
        paymentMethod:null,
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


        purchasePurpose:null,
        plannedDate:null,
        paymentMethod:null,
      },
      JK: [],
      JKlist: [],
      arrDelJK: [],
    }
  },
  computed: {
    getPaymentMethodName() {
      return this.paymentMethods[this.compilation.paymentMethod ?? 0];
    },
  },
  emits: ['close-create-selection', 'close-selection'],
  methods: {
    toggleDropdown() {
      this.select = !this.select;
    },
    selectPaymentMethod(index) {
      this.select = !this.select;
      this.compilation.paymentMethod = index;
    },
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
        isJk: this.compilation.checkbox1Active ? 1 : 2,
        comment: this.compilation.comment,

        target_buy:this.compilation.purchasePurpose,
        date_travel :this.compilation.plannedDate,
        buy_form_id :this.compilation.paymentMethod,
      }).then(res => {

        this.$emit("reload", res.data);

        if(this.tool === 1) {
          this.$emit("notification", 'Клиент был создан')
        } else {
          this.$emit("notification", 'Клиент был изменен')
        }

        this.$emit("close-create-selection");
      });
    }
  },
  created() {
    if (this.tool === 2) {
      const { id, name, phone, soc: WatTelg, client_text: interested, comment, isJk } = this.clientInfo;
      this.compilation = {
        ...this.compilation,
        id,
        name,
        phone,
        WatTelg,
        interested,
        comment,
        checkbox1Active: isJk === 1 ? true : false,
        checkbox2Active: isJk === 2 ? true : false,
      };
    }
  },
}
</script>

<style scoped>
.validation {
  border: 1px solid red;
}

textarea{
  height: 120px !important;
}
.status {
  border: 0px solid !important;
  display: flex;
  align-items: center;
}
.status label{
  white-space: nowrap
}
.status div{
  align-items: center;
  margin-bottom: 0;
  max-width: 25vw;
}


.validation label {
  color: red;
}
.row-status label{
  white-space: break-spaces;
}
.hint-clients{
  background: rgba(232, 70, 128, 0.15);
  color: black;
  padding: 1.25rem;
  margin-top: 1rem;
}
.modal-cooperation-agreement .contant{
  position: relative;
}
.dropdown-menu {
  position: absolute;
  background-color: #fff;
  border: 1px solid #ccc;
  list-style: none;
  margin: 0;
  width: 100%;
}
.dropdown-menu li {
  cursor: pointer;
  line-height: 1rem;
  padding: 10px;
}
.dropdown-menu li:hover{
  background-color: whitesmoke;
}
.dropdown-toggle  {
  transition: 0.5s;
  background-color: #fff;
  border: 1px solid #ccc;
  padding: 10px;
  cursor: pointer;
  text-align: left;
  width: 100%;
  margin-top: 10px;
  line-height: 1rem;
  font-weight: 500;
}
input[type="date"]::-webkit-inner-spin-button,
input[type="date"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="date"] {
  -webkit-appearance: textfield;
  -moz-appearance: textfield;
  appearance: textfield;
}
@media (max-width: 768px) {
  .status div{
    max-width: none;
  }

}

</style>
