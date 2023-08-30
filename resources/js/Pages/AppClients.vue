<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-modal-change-client :clientInfo="clientInfo" :user="user" @close-create-selection="closeCreateSelection"
    :openSideBar="openSideBar" :tool="tool" v-if="openChangeClient" :openChangeClient="openChangeClient"
    @notification="notification" @reload="reload" :language="language" />
  <app-header :user="user" :language="language" @selectLanguage="choseLanguage" />
  <app-modal-notification class="left-[2vw] transition-all duration-1000" :class="{ '-left__full': !openNotification }"
    @close-notification="openNotification = false" :text="text" :openNotification="openNotification" />
  <main>
    <div class="_container">
      <div class=" h-20 xxl:h-16 xl:h-12 lg:h-fit rounded-[12px] my-7 xxl:my-5 xl:my-4">
        <div class="flex lg:flex-col items-center justify-between">
          <div class="flex flex-col p-4 xxl:p-3 xl:p-2">
            <div class="flex items-center lg:justify-center gap-5 xxl:gap-4 xl:gap-3"><span
                class="font-semibold text-xl xxl:text-lg xl:text-sm lg:text-[19px]">Мои клиенты </span>
            </div>
            <span class="text-[#8A8996]  text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">Найдено {{ clients.length }}
              шт.</span>
          </div>
          <div class="flex lg:flex-col lg:items-center h-20 xxl:h-16 xl:h-12 lg:h-fit">
            <div class="flex items-center p-4 xxl:p-3 xl:p-2">
              <button @click="openSelection(null), tool = 1"
                class="login__btn--bg bg-[#E84680] px-4 xxl:px-4 xl:px-2.5 rounded-[3px] h-10 xxl:h-8 xl:h-6 font-semibold text-white text-base xxl:text-[13px] xl:text-[11px] lg:text-[15px] leading-none">
                Добавить клиента
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="purple-hints flex flex-col pb-7 xxl:pb-5 xl:pb-4">
        <p class="text-base xxl:text-sm xl:text-xs pb-4 xxl:pb-3 xl:pb-2 strong">- Ваши клиенты хотят приобрести недвижимость в Турции?</p>
        <p class="text-base xxl:text-sm xl:text-xs pb-4 xxl:pb-3 xl:pb-2 strong" >- Хотите продавать дистанционно?</p>
        <p class="text-base xxl:text-sm xl:text-xs pb-4 xxl:pb-3 xl:pb-2 strong">- Нужна квалифицированная помощь в работе с клиентом в Турции?</p>

        <p class=" text-base xxl:text-sm xl:text-xs pb-4 xxl:pb-3 xl:pb-2">Теперь это возможно, получать комиссионной вознаграждение, даже если вы не бывали в Турции и не планируете!</p>
        <p class=" text-base xxl:text-sm xl:text-xs pb-4 xxl:pb-3 xl:pb-2">Наш сервис предлагает вам партнерское сотрудничество. В котором вы можете передать своего клиента, за часть комиссионного вознаграждения, после проведения сделки с вашим клиентом.</p>
        <p class=" text-base xxl:text-sm xl:text-xs pb-4 xxl:pb-3 xl:pb-2">Вы можете быть уверены, что партнеры с нашей стороны, с 15 летнем стажем, проведут высококвалифицированную работу с вашим клиентом. Подберут объект под запрос клиента, встретят клиента в аэропорту, организуют прокат по всем выбранным объектам, услуги переводчика, юридическое сопровождение сделки, послепродажный сервис.</p>
        <p class=" text-base xxl:text-sm xl:text-xs pb-4 xxl:pb-3 xl:pb-2">Все условия сотрудничества фиксированы документально и гарантируют выплату вашего комиссионного вознаграждения</p>

      </div>
      <div class="columns-clients">
        <div class="clients-list">
          <div
            class="client w-1/3 md:w-1/4 lg:w-1/5 mb-8 bg-white shadow-md rounded-lg relative z-10 text-sm md:text-base"
            v-for="(cli, index) of clients" :key="cli">
            <div class="info p-4">
              <div class="flex justify-between items-center mb-4">
                <div class="text-sm font-bold custom-style">{{ cli?.name }}</div>
                <div class="flex gap-2">
                  <button @click="openSelection(cli), tool = 2" class="p-2">
                    <img src="../../assets/svg/pen_icon_grey.svg" class="w-6 h-6" alt="">
                  </button>
                  <button @click="cli.deleteConfirm = !cli.deleteConfirm" class="p-2">
                    <img src="../../assets/svg/bucket_icon_red.svg" class="w-6 h-6" alt="">
                  </button>
                </div>
              </div>
              <div class="text-base mb-2"></div>
              <div class="numb-phone flex items-center mb-2">
                <img src="../../../resources/assets/svg/chat_tel_purple.svg" alt="" srcset="">
                <div class="text-sm font-bold">{{ cli.phone }}</div>
              </div>
              <div class="numb-phone flex items-center mb-2">
                <img src="../../../resources/assets/svg/whatsapp.svg" alt="" srcset="">
                <div class="text-sm font-bold">{{ cli.soc }}</div>
              </div>

              <!-- <div class="text-xs font-bold mb-2">Запрос клиента: <span class="font-normal">Запрос</span></div> -->
              <div class="text-xs font-bold mb-2">Заинтересован в:
                <span class="font-normal">
                  {{ cli.client_text }}
                </span>
              </div>
              <div class="text-xs font-bold decided">{{ cli.isJk === 1 ? "Определился с объектом" : "Не определился с объектом" }}
              </div>
              <div class="client-status">
                <div class="text-xs font-bold mb-2">Статус клиента:
                  <!-- <span class="font-normal">
                    {{ cli.jk === "1" ? "Определился с объектом" : "Не определился с объектом" }}
                  </span> -->
                </div>
                <div class="dropdown">
                  <button class="dropdown-toggle text-lg " type="button" data-toggle="dropdown"
                    @click="cli.dropActive = !cli.dropActive">
                    {{ visStatusClient(cli.status_client !== null ? cli.status_client : clientsSelect) }}
                  </button>
                  <ul class="dropdown-menu" v-if="cli.dropActive">
                    <li v-for="status in clientsStatus" :key="status.id"
                      @click="changeStatus(cli.status_client !== null ? status.id : cli.status_client, cli.id, index)">
                      {{ status.name }}
                    </li>
                  </ul>
                </div>
              </div>
              <div class="text-xs font-bold mb-2">
                Комментарий:
                <span class="coment-user font-normal" :class="{hidden:cli.comment.length>=50 && !cli.showFullComment}" >
                  {{ cli.comment }}
                </span>
              </div>
              <button v-if="cli.comment.length>=88" @click="cli.showFullComment = !cli.showFullComment" class="more-min text-blue-500 underline">
                {{ cli.showFullComment ? 'Скрыть' : 'Показать полностью' }}
              </button>

              <div v-if="cli.manager_name">
                <div class="text-s font-bold mb-2">Менеджер:</div>
                <div class="text-xs font-bold mb-2">ФИО: {{ cli.manager_name }}</div>
                <div class="text-xs font-bold mb-2">Телефон: {{ cli.manager_phone }}</div>
              </div>
              <div v-else>
                <div class="text-s font-bold mb-2">Менеджер: не назначен</div>
              </div>
              <div class="text-s font-bold mb-2" v-if="cli.commission">Вознаграждение: {{ cli.commission/*  + '%' */ }}</div>
              <div v-if="cli.deleteConfirm"
                class="cursor-auto z-20 w-full text-sm lg:text-base absolute top-1/4 bg-white right-0 flex flex-col border border-solid border-purple-400 rounded-lg ">
                <span class="whitespace-nowrap text-center border__bottom p-2.5 xxl:p-2 xl:p-1.5 leading-none">Вы
                  уверены что хотите удалить?</span>
                <div class="cursor-pointer flex">
                  <div
                    class="hover__select w-full text-center border__right p-2.5 xxl:p-2 xl:p-1.5 leading-none text-[red]"
                    @click="deleteCompilation(cli)">
                    {{ language.default[0] }}
                  </div>
                  <div @click="cli.deleteConfirm = !cli.deleteConfirm"
                    class="hover__select w-full text-center p-2.5 xxl:p-2 xl:p-1.5 leading-none text-[green]">
                    {{ language.default[1] }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clients-menager">
          <h2 class="text-[22px] xxl:text-lg xl:text-base font-semibold">Связаться с менеджером</h2>
          <p>Evon в Турции</p>
          <ul class="clients-menager-refs">
            <li><em>WhatsApp</em> <a href="https://wa.me/+905442258559">905442258559</a></li>
            <li><em>Telegram</em> <a href="https://t.me/evon_turkey">@evon_turkey</a></li>
            <li><em>E-mail</em> <a href="mailto:evon.information@gmail.com">evon.information@gmail.com</a></li>
            <li><em>Phone</em>   <a href="tel:+905442258559">905442258559</a> </li>
          </ul>

          <ul class="clients-menager-refs low">
            <li>После добавления клиента, свяжитесь с менеджером EVON для подбора партнёра в
              сопровождении сделки</li>
          </ul>

          <button @click="cooperation_modal=!cooperation_modal" class="login__btn--bg bg-[#E84680] px-4 xxl:px-4 xl:px-2.5 rounded-[5px] h-10 xxl:h-8 xl:h-6 font-semibold text-white text-base xxl:text-[11px] xl:text-[9px] lg:text-[12px] leading-none">Соглашение о сотрудничестве</button>

        </div>
      </div>
      <div class="flex flex-col pt-7 pb-7 xxl:pb-5 xl:pb-4">
        <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4">

        </p>
      </div>


      <!--Модалка соглашения-->
      <div class="modal-cooperation-agreement" v-if="cooperation_modal" >
         <div class="bg-modal" @click="cooperation_modal=!cooperation_modal"></div>
         <div class="contant relative bg-white rounded-[12px]  xxl:p-9 xl:p-8 lg:p-5  lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">

           <div class="text-block">
             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">1. Настоящее соглашение регламентирует правила передачи и работы между Агентом/риелтором – пользователем платформы EVON (Далее «Агент») и компанией EVON (далее «Компания») при передаче Клиента – потенциального покупателя для сопровождения и проведения сделок на территории Турции.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">2. Настоящее соглашение действует с момента создания личного Кабинета Агента на сайте и до удаления аккаунта Агента по инициативе любой из сторон.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">3. По данному соглашению Агент передает за вознаграждение (фактом передачи является внесение на сайте Агентом контактных данных Клиента) для совместной работы с Клиентом, а Компания принимает, уточняет и передает данные Клиента своему партнеру – лицензированному Агентству Недвижимости на территории Турции (далее «Партнер»).</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">4. При передаче Клиента Агент вносит на сайт следующую информацию о клиенте: ФИО, телефон, контакты мессенджеров, Информацию по цели и времени покупки, форме оплате и другую исчерпывающую информацию.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">5. Переданными считаются Клиенты, с которыми установлен контакт, проведена первоначальная консультация, сделан первичный подбор недвижимости с использование подборок сайта EVON, установлены в ходе переговоров цели покупки, планируемая дата сделки или приезда в Турцию для выбора недвижимости, форма оплаты, подробное описание рассматриваемой недвижимости.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">6. Регламент выплаты и расчета вознаграждения:</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">6.1. Если Клиент не определился с объектом недвижимости и ему требуется: осуществить поиск объекта, подбор недвижимости, исчерпывающая информация о рынке недвижимости Турции, юридическое сопровождение сделки, услуги переводчика, полное сопровождение и консультация на всех этапах работы с продавцом, включая: встреча на территории Турции, показ объектов, составление всех необходимых документов для сделки и оплаты, консультирование по вопросам оплаты, международных переводов, рассрочке, а так же послепродажный сервис (консультации по миграционным вопросам, ремонту, покупки мебели и пр.), то Вознаграждение Агента составляет 40% от прибыли, за вычетом всех возможных расходов по сделке (в том числе, транспорт, проживание Клиента, налоги и пр.).</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">6.2. Если Клиент определился с объектом недвижимости и ему требуется: юридическое сопровождение сделки (составление всех необходимых документов для сделки и оплаты), встреча Клиента с сопровождение его до Продавца, помощь в переговорах с Продавцом, консультация по оплате и переводе средств, услуги переводчика, то Вознаграждение Агента составляет 75% от прибыли, за вычетом всех возможных расходов по сделке (в том числе, транспорт, проживание Клиента, налоги и пр.). Это условие распространяется на переданных клиентов, которые готовы оплатить 100% стоимости объекта, без применения рассрочек и других форм оплаты.  Если в ходе сделки Клиент решает сменить форму оплату (например, применить рассрочку) или сменить объект приобретения, то вознаграждение по такому Клиенту будет рассчитываться согласно п. 6.1</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">7. Агент не имеет права требовать от Компании и Партнера предоставления клиенту дополнительных скидок, бонусов или подарков при покупке недвижимости. Если Агентство недвижимости предоставляет клиенту такие льготы, их стоимость будет вычтена из общего комиссионного вознаграждения, если иное не согласовано между сторонами и будут являться расходами по сделке.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">8. Агент может претендовать на комиссионное вознаграждение только от сделок с Клиентами, контактные данные которых он передал.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">9. Основанием для выплаты вознаграждения являются:</p>
             <ul class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">
               <li class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">- Заключение договора купли-продажи недвижимости Клиентом с участием Партнера.</li>
               <li class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">- Клиент выполняет все обязательства по оплате согласно договору купли-продажи недвижимости.</li>
               <li class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">- Компания получила комиссионное вознаграждение от Продавца или Партнера.</li>
             </ul>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">10. Выплата комиссионного вознаграждения Агенту будет производиться в течение 15 рабочих дней после получения комиссионного вознаграждения от продавца или Партнера наличными или на счет Агента в РФ. Выплата на счет производится в рублях по текущему курсу на момент перевода. Возможные издержки/комиссии при переводе и конвертации оплачивает Агент. В случае если Комиссионное вознаграждение получено не в полном объеме (например, по условию продавца при рассрочке), то Компания передает Агенту вознаграждение частично, пропорционально полученной прибыли.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">11. Агент обязуется не передавать контакты Клиента любому другому Агентству/агенту на территории Турции с момента внесения данных этого Клиента на сайт Компании.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">12. Компания обязуется сохранять конфиденциальность по переданным контактам Клиентов и не передавать их третьим лицам, за исключением Партнера.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">13. Компания настоятельно рекомендует транслировать Клиенту о необходимости приоритетного сотрудничества с Компанией и Партнером для лучшего взаимодействия всех сторон соглашения и успешных проведения сделок.</p>

             <p class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">14. В случае, если Агент использует сервис добавления клиентов в рамках обозначенного Соглашением, то таким образом, он подтверждает, что:</p>
             <ul>
               <li class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">- Полностью ознакомился с настоящим Соглашением;</li>
               <li class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">- Полностью осознает весь смысл Соглашения, без оговорок и/или исключений;</li>
               <li class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">- Безоговорочно принял все условия Соглашения, без всяких оговорок и исключений, и обязуется их соблюдать;</li>
               <li class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">- Не имеет возражения против условий пользования Сайтом (или его отдельных положений);</li>
               <li class=" text-base xxl:text-sm xl:text-xs pb-5 xxl:pb-4 xl:pb-3">- Является совершеннолетним и дееспособным.</li>

             </ul>
           </div>

         </div>
      </div>


    </div>
  </main>
  <app-footer :language="language" />
</template>

<script>
import AppFooter from "@/Layouts/AppFooter.vue"
import AppHeader from "@/Layouts/AppHeader.vue"
import AppModalChangeClient from "@/Layouts/modal/AppModalChangeClient.vue"
import AppModalNotification from "@/Layouts/modal/AppModalNotification.vue"

import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  props: {
    user: [],
    client: []
  },
  data() {
    return {
      language: {},
      deleteConfirm: false,
      openChangeClient: false,
      openSideBar: false,
      selectLanguage: 0,
      tool: 0,
      clientInfo: null,
      clients: {},
      openNotification: false,
      text: '',

      cooperation_modal:false,

      clientsSelect: 1,
      clientsStatus: [
        {
          id: 0,
          name: "Новая заявка"
        },
        {
          id: 1,
          name: "В работе с партнером"
        },
        {
          id: 2,
          name: "Бронь"
        },
        {
          id: 3,
          name: "Оформление"
        },
        {
          id: 4,
          name: "Сделка завершена"
        }
      ],
      dropdownVisible: false,
    }
  },
  methods: {
    changeStatus(statusId, id, index) {

      this.clients[index].dropActive = false;

      axios.post('/api/client/editStatus', {
        id: id,
        token: this.user.token,
        status: statusId
      }).then(res => {
        this.clients[index].status_client = statusId;
        this.openNotification = true;
        this.text = 'Статус сделки был изменен';
      })
    },
    visStatusClient(status) {
      switch (status) {
        case 0: return "Новая заявка";
        case 1: return "В работе с партнером";
        case 2: return "Бронь";
        case 3: return "Оформление";
        case 4: return "Сделка завершена";
        default: return "-";
      }
    },
    visStatusOrder(status) {
      switch (status) {
        case 0: return "Заявка";
        case 1: return "Отклонено";
        case 2: return "Выполнено";
      }
    },
    reload(object) {
      this.clients = object;
    },
    changeSelectJK(JK) {
      this.selectJK = JK.title
      this.dataNews.house_id = JK.id
      this.openSelectJK = false
    },
    choseLanguage(language) {
      this.selectLanguage = language;
      if (this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }
    },
    closeCreateSelection(data) {
      this.openSideBar = false
      setTimeout(() => {
        this.openChangeClient = false
      }, 500)
    },
    openSelection(cli) {
      this.clientInfo = cli
      this.openChangeClient = true

      setTimeout(() => {
        this.openSideBar = true
      }, 10)
    },
    deleteCompilation(item, index) {
      axios.post('/api/client/delete ', {
        client_id: item.id,
        user_id: item.user_id,
        token: this.user.token
      }).then(res => {
        this.clients = res.data

        this.openNotification = true;
        this.text = 'Клиент был удален из базы';
      })
    },
    notification(text) {
      this.openNotification = true;
      this.text = text;
    },
  },
  created() {

    this.clients = this.client;

    if (this.user.lang === 0) {
      this.language = this.$ru;
    } else if (this.user.lang === 1) {
      this.language = this.$en;
    } else if (this.user.lang === 2) {
      this.language = this.$tur;
    }
  },
  components: {
    AppModalChangeClient,
    AppHeader,
    AppFooter,
    AppModalNotification
  },
}
</script>

<style scoped>
.validate {
  border: 1px solid red;
}

* {
  word-break: break-word;
}

.clients-menager-refs li em{
   font-style: normal;
   font-size: 0.829vw;
}
.clients-menager-refs li a{
  font-size: 0.829vw;
}
.max-h-100 {
  max-height: 100px;
}

.more-min{
  color: rgb(101 54 165);
  font-size: 14px;
  margin-bottom: 10px;
  text-decoration: none;
  font-weight: 700;
  transition: 0.5s;
}
.more-min:hover{
  color: #E84680;
}
.coment-user.hidden {
  max-height: 48px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  word-break: break-word;
  text-overflow: ellipsis;
}

.max-h-none {
  max-height: none;
}

.columns-clients {
  display: grid;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-top: 50px;
  grid-template-columns: 1fr auto;
  grid-column-gap: 25px;
}

h2 {
  text-align: center;
}

.numb-phone img {
  width: 30px;
  height: 30px;
  margin-right: 10px;
}

.columns-clients .clients-menager {
  background: rgb(246 243 250);
  border-radius: 10px;
  width: 360px;
  padding: 1.75rem;
  height: fit-content;
}

.columns-clients .clients-menager p {
  text-align: center;
  margin: 10px 0px;
}

.columns-clients .clients-menager ul {
  background-color: rgb(255 255 255);
  border-radius: 10px;
  padding: 0.75rem;
  margin-top: 20px;
}

.columns-clients .clients-menager ul li {

  margin: .366vw 0px;
}

.columns-clients .clients-menager ul li a {
  color: rgb(101 54 165);
  float: right;
}

.columns-clients .clients-menager ul li span {
  color: rgb(101 54 165);
  float: right;
}

/*clients-list*/
.clients-list {
  display: flex;
  gap: 25px;
  flex-direction: row;
  max-width: 1050px;
  flex-wrap: wrap;
}

.client-status {
  background-color: rgb(246 243 250);
  position: relative;
  padding: 8px 15px;
  left: -15px;
  margin: 5px 0px;
  width: calc(100% + 30px);
}

.dropdown-toggle {
  transition: 0.5s;
  background-color: #fff;
  border: 1px solid #ccc;
  padding: 5px 5px;
  cursor: pointer;
  text-align: left;
  width: 100%;
  font-size: 11px;
  font-size: 0.75rem;
  line-height: 1rem;
  font-weight: 500;
}

.dropdown-toggle:hover {
  border: 1px solid rgb(101 54 165);
}

.decided {
  color: rgb(101 54 165);
}

.dropdown-menu {
  position: absolute;
  background-color: #fff;
  border: 1px solid #ccc;
  list-style: none;
  margin: 0;
  width: calc(100% - 30px);
}

.dropdown-menu li {
  cursor: pointer;
  font-size: 0.75rem;
  line-height: 1rem;
  padding: 5px;
}

.dropdown-menu li:hover {
  background-color: #f1f1f1;
  color: rgb(101 54 165);
}

.check.active {
  background-color: #6435A5;
}

.check {

  width: 19px;
  height: 19px;
  display: inline-block;
  border: 1px solid #6435A5;
  margin-left: 10px;
  border-radius: 6px;
  position: relative;
  top: 5px;
  cursor: pointer;
}

.purple-hints{
  background: rgb(246 243 250);
  border-radius: 10px;
  padding: 1.75rem;
}

.clients-menager-refs.low{
  font-style: normal;
  font-size: 0.829vw;
  text-align: center;
  line-height: 140%;
}

.purple-hints p.strong{
   font-weight: 600;
}

.clients-menager button{
   width: 100%;
   margin: 0 auto;
   margin-top: 15px;
}

.client {
  width: calc(25.33% - 25px);
  margin-bottom: 25px;
  background-color: #fff;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  position: relative;
  z-index: 1;
  max-width: 25%;
  min-width: 188px;
}

.client .warning {
  position: absolute;
  left: 0px;
  top: 70px;
  z-index: 49;
}

.client .warning::after {
  content: "";
}

.custom-style {
  max-width: 114px;
  word-break: break-word;
}

.info {
  display: flex;
  flex-direction: column;
  padding: 15px;
}

.info span {
  color: black;
  word-break: break-word;
  font-size: 13px;
}

.name {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 8px;
}

.phone {
  font-size: 14px;
  margin-bottom: 8px;
}

.contact {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
}

.icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  background-color: #ccc;
  margin-right: 8px;
  border-radius: 50%;
}

.value {
  font-weight: bold;
  font-size: 14px;
}

.clients-list .header {
  display: flex;
}

.query,
.inertion,
.status,
.partner,
.partner-status,
.comment {
  margin-top: 8px;
  font-size: 12px;
  font-weight: bold;
  color: #999;
}

.comment {
  margin-bottom: 8px;
}

.modal-cooperation-agreement{
  position: fixed;
  width: 100%;
  height: 100%;
  z-index: 10;
  left: 0;
  top: 0;
}

.bg-modal{
  background-color: rgb(0,0,0,0.5);
  z-index: 10;
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
}
.modal-cooperation-agreement .contant {
  background: white;
  left: 0;
  top: calc(50% - 25vw);
  z-index: 10;
  width: 50%;
  margin: 0 auto;

  max-height: 50vw;
  padding: 1.2rem;
  scrollbar-width: none;
  -ms-overflow-style: none;
  position: relative;
  overflow: hidden;
}

.modal-cooperation-agreement .contant .text-block {
  overflow-y: scroll;
  max-height: calc(50vw - 2.4rem);
  padding-right: 0.4rem;
}

.modal-cooperation-agreement .contant .text-block::-webkit-scrollbar {
  width: 0.4rem;
}

.modal-cooperation-agreement .contant .text-block::-webkit-scrollbar-thumb {
  background-color: rgb(82, 39, 140) !important;
  border-radius: 6px;
  width: 12px; /* Добавьте эту строку */
  height: 20px; /* Добавьте эту строку */
}


@media (max-width: 768px) {
  .modal-cooperation-agreement .contant {
    top: 5%;
    width: 90%;
    max-height: 90%;
  }
  .columns-clients .clients-menager {
    margin: 0 auto;
    width: auto;
  }
.clients-menager-refs li em {
    font-size:  3vw;
}
.clients-menager-refs li  a {
    font-size:  3vw;
}
  .columns-clients {
    display: block;
  }
  .modal-cooperation-agreement .contant .text-block {
    overflow-y: scroll;
    max-height: calc(100vh - 7rem);
  }

  .clients-list {
    margin: 0 auto;
    justify-content: center;
  }
  .clients-menager-refs.low{
    font-style: normal;
    font-size: 3vw;
    text-align: center;
    line-height: 140%;
  }
}</style>
