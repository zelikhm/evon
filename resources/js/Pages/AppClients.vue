<script setup>
  import {Link} from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-modal-change-client :clientInfo="clientInfo" :user="user" @close-create-selection="closeCreateSelection"
                           :openSideBar="openSideBar" :tool="tool" v-if="openChangeClient"
                           :openChangeClient="openChangeClient" @reload="reload"
                           :language="language"/>
  <app-header :user="user" :language="language" @selectLanguage="choseLanguage"/>
  <main>
    <div class="_container">
      <div class=" h-20 xxl:h-16 xl:h-12 lg:h-fit rounded-[12px] my-7 xxl:my-5 xl:my-4">
        <div class="flex lg:flex-col items-center justify-between">
          <div class="flex flex-col p-4 xxl:p-3 xl:p-2">
            <div class="flex items-center lg:justify-center gap-5 xxl:gap-4 xl:gap-3"><span
              class="font-semibold text-xl xxl:text-lg xl:text-sm lg:text-[19px]">Мои клиенты </span>
            </div>
            <span class="text-[#8A8996]  text-sm xxl:text-xs xl:text-[10px] lg:text-[14px]">Найдено {{ clients.length }} шт.</span>
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
      <div class="flex flex-col pb-7 xxl:pb-5 xl:pb-4">
        <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4">
                    <span style="color: rgb(0, 0, 0);">Добавьте своих клиентов для помощи в сопровождении сделки или
                        свяжитесь с нашим менеджером по вопросам проведения дистанционных сделок </span>
        </p>
      </div>
      <div class="columns-clients">
        <div class="clients-list">
          <div
            class="client w-1/3 md:w-1/4 lg:w-1/5 mb-8 bg-white shadow-md rounded-lg relative z-10 text-sm md:text-base"
            v-for="(cli) of clients" :key="cli">
            <div class="info p-4">
              <div class="flex justify-between items-center mb-4">
                <div class="text-lg font-bold">{{ cli.name }}</div>
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
              <div class="flex items-center mb-2">
                <div class="w-6 h-6 bg-gray-400 rounded-full mr-2 flex items-center justify-center">
                  <i class="fa fa-whatsapp"></i>
                </div>
                <div class="font-bold">{{ cli.phone }}</div>
              </div>
              <div class="flex items-center mb-2">
                <div class="w-6 h-6 bg-gray-400 rounded-full mr-2 flex items-center justify-center">
                  <i class="fa fa-telegram"></i>
                </div>
                <div class="font-bold">{{ cli.soc }}</div>
              </div>
              <!-- <div class="text-xs font-bold mb-2">Запрос клиента: <span class="font-normal">Запрос</span></div> -->
              <div class="text-xs font-bold mb-2">Заинтересован в: <span class="font-normal">{{
                                cli.client_text }}</span></div>
              <div class="text-xs font-bold mb-2">Статус клиента: <span class="font-normal">{{
                                cli.jk === "1" ? "Определился с жк" : "Не определился с жк" }}</span></div>
              <div class="text-xs font-bold mb-2">Партнер: <span class="font-normal">{{
                                user.first_name }}</span></div>
              <div class="text-xs font-bold mb-5">Статус партнера: <span class="font-normal">-</span></div>
              <div v-if="cli.manager_name">
                <div class="text-s font-bold mb-2">Менеджер:</div>
                <div class="text-xs font-bold mb-2">ФИО: {{ cli.manager_name }}</div>
                <div class="text-xs font-bold mb-2">Телефон: {{ cli.manager_phone }}</div>
              </div>
              <div v-else>
                <div class="text-s font-bold mb-2">Менеджер: не назначен</div>
              </div>
              <!--  <div class="text-xs font-bold mb-2">Комментарий: <span class="font-normal">Комментарий</span> </div> -->
              <div v-if="cli.deleteConfirm"
                   class="cursor-auto z-20 w-full text-sm lg:text-base absolute top-1/4 bg-white right-0 flex flex-col border border-solid border-purple-400 rounded-lg ">
                                <span
                                  class="whitespace-nowrap text-center border__bottom p-2.5 xxl:p-2 xl:p-1.5 leading-none">Вы
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
          <ul>
            <li>WatsApp <a href="#">Ссылка</a></li>
            <li>Телеграмм <a href="#">Ссылка</a></li>
            <li>Почта <a href="#">Ссылка</a></li>
            <li>Телефон <span>905367764107</span></li>
          </ul>
        </div>
      </div>
      <div class="flex flex-col pt-7 pb-7 xxl:pb-5 xl:pb-4">
        <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs pb-6 xxl:pb-5 xl:pb-4">
                    <span style="color: rgb(0, 0, 0);">После добавления клиента, менеджер Evon свяжется с вами для подбора
                        партнера в сопровождении сделки </span>
        </p>
      </div>
    </div>
  </main>
  <app-footer :language="language"/>
</template>

<script>
  import AppFooter from "@/Layouts/AppFooter.vue"
  import AppHeader from "@/Layouts/AppHeader.vue"
  import AppModalChangeClient from "@/Layouts/modal/AppModalChangeClient.vue"

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
      }
    },
    methods: {
      reload(object){
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
          /* axios.get('/api/client/get ', {
              user_id: this.user.id,
          }).then((data) => { console.log(data)}) */
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

        })
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
    },
  }
</script>

<style scoped>
  .validate {
    border: 1px solid red;
  }


  .columns-clients {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 50px;
  }

  h2 {
    text-align: center;
  }

  .columns-clients .clients-menager {
    background: rgb(246 243 250);
    border-radius: 10px;
    padding: 1.75rem;
    height: 310px;
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
    font-size: 14px;
    margin: 7px 0px;
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
    justify-content: center;
    flex-direction: row;
    flex-wrap: wrap;
  }

  .client {
    width: calc(33.33% - 25px);
    margin-bottom: 25px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    position: relative;
    z-index: 1;
    max-width: 240px;
    min-width: 230px;
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

  .info {
    display: flex;
    flex-direction: column;
    padding: 15px;
  }

  .info span {
    color: black;
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

  @media (max-width: 768px) {
    .columns-clients .clients-menager {
      margin: 0 auto;
    }
  }
</style>
