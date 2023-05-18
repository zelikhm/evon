<script setup>

import '../../../public/styles/styles.css'
import '../../../public/styles/fonts.css'
import '../../../public/styles/adapt.css'
import '../../../public/styles/lowSection.css'
import '../../../public/styles/ForBuilders.css'
import '../../../public/styles/blockInfo.css'
import '../../../public/styles/watchvideo.css'
import '../../../public/styles/welcom.css'
import '../../../public/styles/help.css'
import '../../../public/styles/ForRealtors.css'

</script>

<template>
  <app-modal-auth :oLoginRealtor="openLoginRealtor" :oLoginDeveloper="openLoginDeveloper" @close-modal="closeModal"
    @open-modal-realtor="openModalRealtor" @open-modal-developer="openModalDeveloper" :language="language"
    :selectLanguage="selectLanguage" />
  <app-header @login-developer="openLoginDeveloper = !openLoginDeveloper"
    @login-realtor="openLoginRealtor = !openLoginRealtor" @open-register="openRegister = !openRegister"
    @selectLanguage="choseLanguage" :user="user" :language="language" />

  <app-modal-register :oLoginRegister="openRegister" @close-modal="closeModalRegister" :language="language"
    :selectLanguage="selectLanguage" />

  <!--header-->
  <header>
    <div class="container">
      <div class="lines-animations">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
      <nav>
        <ul>
          <li>
            <a href="#"><img class="logo" src="images/img/header/logo.png" alt="" srcset=""></a>
          </li>
          <li class="ref-soc">
            <a href="#"><img src="images/img/header/s1.png" alt="" srcset=""></a>
            <a href="#"><img src="images/img/header/s2.png" alt="" srcset=""></a>
            <a href="#"><img src="images/img/header/s3.png" alt="" srcset=""></a>
            <a href="#"><img src="images/img/header/s4.png" alt="" srcset=""></a>
          </li>
          <li class="lang">
            <span class="select">RU </span>
            <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 0.5L4.5 3.5L8 0.5" stroke="black" />
            </svg>
          </li>
          <li class="btns">
            <div class="logIn">
              <button class="login">Войти</button>
              <div class="select-login">
                <button>Как риэлтор</button>
                <button>Как застройщик</button>
              </div>
            </div>
            <button class="registr">Зарегистрироваться</button>
          </li>
          <li class="user" >
            <img src="images/img/header/User.png" alt="" srcset="">
          </li>
        </ul>
      </nav>
    </div>

    <div class="modal">
      <div class="modal-bg"></div>
      <div class="modal-contant">
        <h2>Вход в личный кабинет</h2>
        <input type="text" placeholder="Email/Login">
        <input type="text" placeholder="Пароль">
        <button>Войти</button>
        <a href="#" class="login-ref">Войти как риэлтор</a>
        <a href="#" class="close">Закрыть</a>
      </div>
    </div>

    <div class="modal lodinn-btns">
      <div class="modal-bg"></div>
      <div class="modal-contant">
        <button>Войти</button>
        <button>Зарегистрироваться</button>

        <button class="enter">Как риэлтор</button>
        <button class="enter">Как застройщик</button>
        <button class="enter back">Назад</button>

      </div>
    </div>
  </header>
  <!--!header-->

  <!--welcom-->
  <section id="welcom">
    <div class="container">
      <div class="welcom-cont">
        <div class="left">
          <h4 class="title"><img src="images/img/welcom/Mask.png" alt="" srcset=""> <span>Турция</span></h4>
          <h1 id="text">{{ welcomText.text }}</h1>
          <p>
            Мы предлагаем профессиональный инструмент продаж для агентов по недвижимости и строительных
            компаний.
            Самая большая и актуальная база новостроек, с удобным поиском объектов, изучением новых
            объектов,
            коммуникацией с застройщиками и отправкой клиентам в один клик
          </p>
          <button>Попробовать бесплатно</button>
          <div class="save-prog">
            <p>
              <span>Скачайте наше приложение</span>
              <img src="images/img/welcom/apl.png" alt="" srcset="">
              <img src="images/img/welcom/andr.png" alt="" srcset="">
            </p>
          </div>

          <div class="ref-soc">
            <a href="#"><img src="images/img/header/s1.png" alt="" srcset=""></a>
            <a href="#"><img src="images/img/header/s2.png" alt="" srcset=""></a>
            <a href="#"><img src="images/img/header/s3.png" alt="" srcset=""></a>
            <a href="#"><img src="images/img/header/s4.png" alt="" srcset=""></a>
          </div>

          <h4 class="scroll">
            <span>Скролл вниз</span>
            <img src="images/img/welcom/Vector.png" alt="" srcset="">
            <img src="images/img/welcom/Vector.png" alt="" srcset="">
            <img src="images/img/welcom/Vector.png" alt="" srcset="">
          </h4>
        </div>
        <div class="right">
          <div class="contant">
            <div class="btn" v-for="n in 80" :key="n" @mouseenter="hideBtn" @mouseleave="showBtn">
              <img src="images/img/welcom/plus.png" alt="" srcset="">
            </div>
          </div>
        </div>
      </div>

      <div class="lines-animations">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
    </div>
  </section>
  <!--!welcom-->


  <!--watchvideo-->
  <section id="watchvideo">
    <div class="container">
      <div class="title-text">
        <h2>Смотреть видео о компании — Смотреть видео о компании — Смотреть видео о компании — Смотреть видео о
          компании — Смотреть видео о компании —</h2>

      </div>
      <iframe class="video" src="https://www.youtube.com/embed/lTNZFH-CZWc" title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen></iframe>
    </div>

    <img class="low-t" src="images/img/watchvideo/t.png" alt="" srcset="">
    <img class="low-h1" src="images/img/watchvideo/h1.png" alt="" srcset="">
    <img class="low-h2" src="images/img/watchvideo/h2.png" alt="" srcset="">
  </section>
  <!--!watchvideo-->

  <!--blockInfo-->
  <section id="blockInfo">
    <div class="container">
      <div class="carusel-obertka">
        <div class="carusel">
          <template v-for="n in 40">
            <img src="images/img/carusel/1.png" alt="" srcset="">
            <img src="images/img/carusel/2.png" alt="" srcset="">
            <img src="images/img/carusel/3.png" alt="" srcset="">
            <img src="images/img/carusel/4.png" alt="" srcset="">
          </template>
        </div>
      </div>

      <div class="contant">
        <div class="left">
          <div class="block">
            <h4>{{ count_house }}</h4>
            <p>Объектов на платформе</p>
          </div>
          <div class="block">
            <h4>{{ count_people }}</h4>
            <p>Агентов пользуются нашим сервисом</p>
          </div>
          <div class="block">
            <h4>{{ count_flats }}</h4>
            <p>Актуальных квартир</p>
          </div>
        </div>
        <div class="right">
          <p>
            Каждый день мы продолжаем добавлять новые объекты на платформу и обновляем уже имеющиеся прайс
            листы. Функционал сайта дорабатывается каждый день для вашей продуктивной работы
          </p>
        </div>
      </div>
    </div>
  </section>
  <!--!blockInfo-->

  <!--ForRealtors-->
  <section id="ForRealtors">
    <div class="title">
      <div class="container">
        <h2>Для риелторов</h2>
        <h3>У вас есть запрос от клиента?</h3>
      </div>
    </div>
    <div class="container">


      <div class="cont">
        <div class="left">
          <div class="slide" v-for="(slide, index) in slides"
            :class="['slide', `slide${step}`, { active: step === (index + 1) }]" :key="index">
            <div class="slide-text">
              <h4>{{ slide.title }}</h4>
              <span>{{ index + 1 }}</span>
            </div>
            <div class="slide-info">
              <h5>{{ slide.infoTitle }}</h5>
              <em>до <span>{{ slide.infoCount??slide.infoBtn }}</span></em>
            </div>
          </div>
        </div>
        <div class="right">
          <img class="slide" v-for="(slide, index) in slides"
            :class="['slide', `slide${index + 1}`, { active: step === (index + 1) }]"
            :src="'images/img/forRealtors/s' + (index + 1) + '.png'" :alt="'Slide ' + (index + 1)" :key="index" />
          <div class="tools">
            <img class="tool" src="images/img/forRealtors/tool.png" alt="" srcset="" />
            <p>Потяните влево <br /> на следующий этап</p>
          </div>
        </div>
      </div>


      <div class="row-houses">
        <img src="images/img/forRealtors/h1.png" alt="" srcset="">
        <img src="images/img/forRealtors/h2.png" alt="" srcset="">
      </div>


    </div>

  </section>
  <!--!ForRealtors-->

  <!--ForBuilders-->
  <section id="ForBuilders">
    <div class="container">
      <h2>Для застройщиков</h2>
      <div class="cont">
        <div class="left">
          <ul>
            <li v-bind:class="{ active: forBuilders.activeIndex === 0 }" @click="activateItem(0)">
              <span>Платформа Evon позволит вам увеличить продажи за счет охвата огромной партнерской
                сети</span><em>1</em>
            </li>
            <li v-bind:class="{ active: forBuilders.activeIndex === 1 }" @click="activateItem(1)">
              <span> При добавлении вашего объекта на платформу о нем узнает большинство агентств и
                частных риелторов</span><em>2</em>
            </li>
            <li v-bind:class="{ active: forBuilders.activeIndex === 2 }" @click="activateItem(2)">
              <span>Делитесь новостями со всеми партнерами в режиме реального времени. На платформе
                реализован чат с партнером /риелтором</span><em>3</em>
            </li>
          </ul>
          <p>
            Присоединение к нашей площадке агентства недвижимости - это прекрасная возможность для
            застройщиков получить широкий доступ к покупателям недвижимости. Мы предлагаем эффективную
            платформу для продажи жилой и коммерческой недвижимости, которая позволяет снизить затраты на
            маркетинг и рекламу.
          </p>
        </div>
        <div class="right">
          <img src="images/img/forBuilders/sl1.png" v-bind:class="{ active: forBuilders.activeIndex === 0 }" alt=""
            srcset="">
          <img src="images/img/forBuilders/sl2.png" v-bind:class="{ active: forBuilders.activeIndex === 1 }" alt=""
            srcset="">
          <img src="images/img/forBuilders/sl3.png" v-bind:class="{ active: forBuilders.activeIndex === 2 }" alt=""
            srcset="">

        </div>
      </div>

      <img class="bg" src="images/img/forBuilders/bg.png" alt="" srcset="">
    </div>

  </section>
  <!--!ForBuilders-->


  <!--help-->
  <section id="help">
    <div class="container">
      <h2>Помощь в сопровождении сделки</h2>
      <div class="help-cont">
        <div class="left">
          <p>
            Мы работаем только с профессионалами, которые имеют большой опыт в области недвижимости. Мы
            предоставляем все необходимые услуги, начиная от консультации по выбору недвижимости и
            заканчивая сопровождением сделки на всех этапах. Мы гарантируем нашим клиентам полную поддержку
            и надежность во всех аспектах сделки.
          </p>

          <div class="colums-info">
            <div class="block">
              <p>
                Мы предлагаем широкий выбор объектов недвижимости в различных районах Турции.
              </p>
              <img src="images/img/help/gr.png" alt="" srcset="">
            </div>
            <div class="block"></div>
            <div class="block"></div>
            <div class="block">
              <p>
                Мы гарантируем прозрачность
                и честность в наших услугах
              </p>
              <img src="images/img/help/arrow.png" alt="" srcset="">
            </div>
          </div>


        </div>
        <div class="right">
          <div class="contant">
            <div class="btn" v-for="n in 80" :key="n" @mouseenter="hideBtn" @mouseleave="showBtn">
              <img src="images/img/welcom/plus.png" alt="" srcset="">
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!--!help-->


  <!--lowSection-->
  <section id="lowSection">

    <div class="container">
      <div class="upp-row">
        <div class="lines-animations">
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
        </div>
        <div class="lines-animations">
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
        </div>
      </div>

      <h2>Авторизируйтесь как риэлтор
        или застройщик и получите полный доступ к площадке </h2>
      <button><span>Войти</span> <img src="images/img/lowSection/arrow.png" alt="" srcset=""></button>
      <h3>Скачайте наше приложение на Android или IOS</h3>

      <div class="row-soc">
        <a href="#"><img src="images/img/lowSection/andr.png" alt="" srcset=""></a>
        <a href="#"><img src="images/img/lowSection/apl.png" alt="" srcset=""></a>
      </div>


    </div>
    <div class="foot">
      <div class="container">
        <img src="images/img/lowSection/logo.png" alt="" srcset="">
        <p>
          ©Evon 2023. Все права защищены
        </p>
      </div>
    </div>

    <div class="bg-houses">
      <img src="images/img/lowSection/h2.png" alt="" srcset="">
      <img src="images/img/lowSection/h1.png" alt="" srcset="">
    </div>

  </section>
  <!--!lowSection-->


  <!--footer-->
  <footer>
    <div class="container">

      <div class="mobile-contant">
        <img class="logo" src="images/img/footer/logo.png" alt="" srcset="">
        <p>
          ©Evon 2023. Все права защищены
        </p>
        <div class="row-soc">
          <a href="#">
            <img src="images/img/footer/s1.png" alt="" srcset="">
          </a>
          <a href="#">
            <img src="images/img/footer/s2.png" alt="" srcset="">
          </a>
          <a href="#">
            <img src="images/img/footer/s3.png" alt="" srcset="">
          </a>
          <a href="#">
            <img src="images/img/footer/s4.png" alt="" srcset="">
          </a>
        </div>
      </div>

      <nav>
        <ul>
          <li>
            <span>Почта</span>
            <a href="#">evon.information@gmail.com</a>
          </li>
          <li>
            <span>WhatsApp</span>
            <a href="#">+90(544)225 85 59</a>
          </li>
          <li>
            <span>Telegram</span>
            <a href="#">evon_real_estate</a>
          </li>
          <li>
            <span>Instagram</span>
            <a href="#">evon_platform_tr</a>
          </li>
          <li>
            <span>Facebook</span>
            <a href="#">ServisEvon</a>
          </li>
        </ul>
      </nav>
      <p>
        Не является публичной офертой
      </p>
      <div class="row-ref">
        <a href="#">Политика конфиденциальности</a>
        <a href="#">Пользовательское соглашение</a>
        <a href="#">VERGI NO <span>3830916930</span></a>
      </div>
    </div>
  </footer>
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppModalAuth from "../Layouts/modal/AppModalAuth.vue"
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import AppModalRegister from "@/Layouts/modal/AppModalRegister.vue";

export default {
  name: "AppPromo",
  props: [
    'count_flats',
    'count_house',
    'count_people',
    'error',
    'userInfo'
  ],
  provide() {
    return {
      error: this.error,
    }
  },
  data() {
    return {
      openLoginRealtor: false,
      openLoginDeveloper: false,
      openRegister: false,
      language: {},
      selectLanguage: 0,
      user: [],


      isMouseDown: false,
      startX: 0,
      scrollLeft: 0,
      step: 1,
      slides: [
        {
          title: "Находим нужные объекты по фильтрам",
          infoTitle: "Фильтры для поиска объекта под запрос вашего клиента",
          infoCount: "30",
        },
        {
          title: "Ищем нужные объекты на карте",
          infoTitle: "Расположение объектов на карте",
          infoCount: "",
        },
        {
          title: "Добавляем объекты в подборку",
          infoTitle: "Полная база новостроек побережья с контактами застройщиков и отделов продаж",
          infoCount: "400",
        },
        {
          title: "Формируем подборку объектов для клиента и отправляем в один клик",
          infoTitle: "Формирование подборки под вашего клиента и отправка от вашего имени/агентства",
          infoCount: "",
        },
        {
          title: "Отправляем прайс-лист клиенту",
          infoTitle: "Актуальный прайс лист по объекту",
          infoBtn:"Обновления каждые 24 часа",
          infoCount:null
        },
      ],
      forBuilders: {
        activeIndex: 0
      },
      welcomText: {
        texts: ["строительных компаний", "частных риелторов", "агентств недвижимости"],
        text: "",
        index: 0,
        letterIndex: 0,
        isDeleting: false,
      }

    }
  },
  created() {
    if (this.userInfo.length === 0) {
      this.user = null;
    } else {
      this.user = this.userInfo;
    }

    if (this.user !== null) {
      if (this.user.lang === 0) {
        this.language = this.$ru;
      } else if (this.user.lang === 1) {
        this.language = this.$en;
      } else if (this.user.lang === 2) {
        this.language = this.$tur;
      }
    } else {
      if (this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }
    }

    this.type()
  },
  mounted() {
    /* const cont = document.querySelector('.cont');
    cont.addEventListener('mousedown', this.startDrag);
    cont.addEventListener('mouseleave', this.endDrag);
    cont.addEventListener('mouseup', this.endDrag);
    cont.addEventListener('mousemove', this.drag); */
  },
  methods: {
    startDrag(e) {
      this.isMouseDown = true;
      this.startX = e.pageX - e.currentTarget.offsetLeft;
      this.scrollLeft = e.currentTarget.scrollLeft;
    },
    endDrag(e) {
      this.isMouseDown = false;
      if (Math.abs(e.pageX - this.startX) >= 200) {
        this.animationChange();
      }
    },
    drag(e) {
      if (!this.isMouseDown) return;
      e.preventDefault();
      const x = e.pageX - e.currentTarget.offsetLeft;
      const walk = (x - this.startX) * 3;
      e.currentTarget.scrollLeft = this.scrollLeft - walk;
    },
    animationChange() {
      this.step++;
      if (this.step > 5) {
        this.step = 1;
      }
    },
    hideBtn(event) {
      event.target.classList.add('hide');
    },
    showBtn(event) {
      setTimeout(() => {
        event.target.classList.remove('hide');
      }, 3000);
    },
    type() {
      const text = this.welcomText.texts[this.welcomText.index];
      if (this.welcomText.isDeleting) {
        this.welcomText.letterIndex--;
        if (this.welcomText.letterIndex == 0) {
          this.welcomText.isDeleting = false;
        }
      } else {
        this.welcomText.text = `Evon - универсальная площадка для ${text.substring(0, this.welcomText.letterIndex + 1)}`;
        this.welcomText.letterIndex++;
        if (this.welcomText.letterIndex == text.length) {
          this.welcomText.isDeleting = true;
          setTimeout(() => {
            this.welcomText.index++;
            if (this.welcomText.index == this.welcomText.texts.length) {
              this.welcomText.index = 0;
            }
          }, 1000);
        }
      }
      setTimeout(this.type, 100)
    },

    activateItem(index) {
      this.forBuilders.activeIndex = index;
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
    closeModal() {
      this.openLoginRealtor = false
      this.openLoginDeveloper = false
      this.openRegister = false
    },
    openModalRealtor() {
      this.openLoginRealtor = true
      this.openLoginDeveloper = false
    },
    openModalDeveloper() {
      this.openLoginRealtor = false
      this.openLoginDeveloper = true
    },
    closeModalRegister() {
      this.openRegister = false
    }
  },
  components: {
    AppModalRegister,
    AppHeader,
    AppFooter,
    AppModalAuth,
  }
}
</script>

<style scoped></style>
