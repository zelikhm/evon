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

  <app-modal-register :oLoginRegister="openRegister" @close-modal="closeModalRegister" :language="language"
    :selectLanguage="selectLanguage" />

  <new-header @login-realtor="openLoginRealtor = !openLoginRealtor"
              @login-developer="openLoginDeveloper = !openLoginDeveloper"
    @open-register="openRegister = !openRegister" @selectLanguage="choseLanguage" :user_info="userInfo"
    :language="language"></new-header>

  <!--welcom-->
  <section id="welcom">
    <div class="container">
      <div class="welcom-cont">
        <div class="left">
          <h4 class="title"><img src="images/img/welcom/Mask.png" alt="" srcset=""> <span>{{ language.main[23] }}</span>
          </h4>
          <h1 id="text">{{ welcomText.text }}</h1>
          <p v-html="language.main[28]">

          </p>
          <button v-on:click="openRegister = !openRegister">{{ language.main[29] }}</button>
          <div class="save-prog">
            <p>
              <span>{{ language.main[30] }}</span>
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
            <span>{{ language.main[31] }}</span>
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
        <h2>{{ language.main[32] }} — {{ language.main[32] }} — {{ language.main[32] }} — {{ language.main[32] }} — {{
          language.main[32] }} —</h2>

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
            <p>{{ language.main[34] }}</p>
          </div>
          <div class="block">
            <h4>{{ count_people }}</h4>
            <p>{{ language.main[35] }}</p>
          </div>
          <div class="block">
            <h4>{{ count_flats }}</h4>
            <p>{{ language.main[36] }}</p>
          </div>
        </div>
        <div class="right">
          <p v-html="language.main[33]">

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
        <h2>{{ language.main[37] }}</h2>
        <h3>{{ language.main[38] }}</h3>
      </div>
    </div>
    <div class="container">


      <div class="cont" @mousedown="handleMouseDown" @mouseleave="handleMouseLeave" @mouseup="handleMouseUp"
    @mousemove="handleMouseMove" @touchstart="handleTouchStart" @touchend="handleTouchEnd"
    @touchmove="handleTouchMove">
        <div class="left">
          <div class="slide" v-for="(slide, index) in slides"
            :class="['slide', `slide${step}`, { active: step === (index + 1) }]" :key="index">
            <div class="slide-text">
              <h4>{{ slide.title }}</h4>
              <span>{{ index + 1 }}</span>
            </div>
            <div class="slide-info" :class="{ purple: slide.color === 1 }">
              <h5>{{ slide.infoTitle }}</h5>
              <em>
                <sub v-if="index < 1 || index > 4">{{ language.main[41] }}</sub>
                <span v-if="index!=4">{{ slide.infoCount ?? slide.infoBtn }}</span>
                <img v-if="index == 2" src="images/img/forRealtors/Mask.png" alt="" srcset="">
                <img v-if="index == 4" src="images/img/forRealtors/cl.png" alt="" srcset="">
              </em>
              <img v-if="index == 1" src="images/img/forRealtors/planet.png" alt="" srcset="">
              <img v-if="index == 3" src="images/img/forRealtors/vector.png" alt="" srcset="">

            </div>
          </div>
        </div>
        <div class="right">
          <img class="slide" v-for="(slide, index) in slides"
            :class="['slide', `slide${index + 1}`, { active: step === (index + 1) }]"
            :src="'images/img/forRealtors/s' + (index + 1) + '.png'" :alt="'Slide ' + (index + 1)" :key="index" />
          <div class="tools">
            <img class="tool" src="images/img/forRealtors/tool.png" alt="" srcset="" />
            <p v-html="language.main[42]"></p>
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
      <h2>{{ language.main[52] }}</h2>
      <div class="cont">
        <div class="left">
          <ul>
            <li v-bind:class="{ active: forBuilders.activeIndex === 0 }" @click="activateItem(0)">
              <span>{{ language.main[53] }}</span><em>1</em>
            </li>
            <li v-bind:class="{ active: forBuilders.activeIndex === 1 }" @click="activateItem(1)">
              <span> {{ language.main[54] }}</span><em>2</em>
            </li>
            <li v-bind:class="{ active: forBuilders.activeIndex === 2 }" @click="activateItem(2)">
              <span>{{ language.main[55] }}</span><em>3</em>
            </li>
          </ul>
          <p v-html="language.main[56]">

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
  <section id="help" v-if="block_show">
    <div class="container">
      <h2>{{ language.main[57] }}</h2>
      <div class="help-cont">
        <div class="left">
          <p v-html="language.main[58]">
          </p>

          <div class="colums-info">
            <div class="block">
              <p>
                {{ language.main[59] }}
              </p>
              <img src="images/img/help/gr.png" alt="" srcset="">
            </div>
            <div class="block"></div>
            <div class="block"></div>
            <div class="block">
              <p>
                {{ language.main[60] }}
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

      <h2 v-html="language.main[67]"></h2>
      <button v-on:click="openLoginDeveloper = !openLoginDeveloper"><span>{{ language.main[61] }}</span> <img
          src="images/img/lowSection/arrow.png" alt="" srcset=""></button>
      <h3>{{ language.main[62] }}</h3>

      <div class="row-soc">
        <a href="#"><img src="images/img/lowSection/andr.png" alt="" srcset=""></a>
        <a href="#"><img src="images/img/lowSection/apl.png" alt="" srcset=""></a>
      </div>


    </div>
    <div class="foot">
      <div class="container">
        <img src="images/img/lowSection/logo.png" alt="" srcset="">
        <p>
          {{ language.main[63] }}
        </p>
      </div>
    </div>

    <div class="bg-houses">
      <img src="images/img/lowSection/h2.png" alt="" srcset="">
      <img src="images/img/lowSection/h1.png" alt="" srcset="">
    </div>

  </section>
  <!--!lowSection-->

  <new-footer :language="language"></new-footer>
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppModalAuth from "../Layouts/modal/AppModalAuth.vue"
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import AppModalRegister from "@/Layouts/modal/AppModalRegister.vue";
import NewHeader from "@/Components/NewsComponent/NewHeader.vue";
import NewFooter from "@/Components/NewsComponent/NewFooter.vue";

export default {
  name: "AppPromo",
  props: [
    'count_flats',
    'count_house',
    'count_people',
    'error',
    'userInfo',
    'block_show'
  ],
  watch: {
    language(item) {
      this.editObject();
    }
  },
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
      language: this.$ru,
      selectLanguage: 0,
      user: [],


      isMouseDown: false,
      startX: 0,
      scrollLeft: 0,
      step: 1,
      slides: [],
      forBuilders: {
        activeIndex: 0
      },
      welcomText: {},
      touchStartX: 0,
      touchMoveX: 0,


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

    this.editObject();

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
    handleMouseDown(e) {
      this.isMouseDown = true;
      this.startX = e.pageX - this.$refs.cont.offsetLeft;
      this.scrollLeft = this.$refs.cont.scrollLeft;
    },
    handleMouseLeave() {
      this.isMouseDown = false;
    },
    handleMouseUp(e) {
      this.isMouseDown = false;
      if (Math.abs(e.pageX - this.startX) >= 200) {
        this.animationChange();
      }
    },
    handleMouseMove(e) {
      if (!this.isMouseDown) return;
      e.preventDefault();
      const x = e.pageX - this.$refs.cont.offsetLeft;
      const walk = (x - this.startX) * 3;
      this.$refs.cont.scrollLeft = this.scrollLeft - walk;
    },
    animationChange() {
      this.step++;
      if (this.step > 5) {
        this.step = 1;
      }
      const slides = this.$refs.cont.querySelectorAll(".slide");
      slides.forEach((element) => {
        element.classList.remove("active");
        if (element.classList.contains(`slide${this.step}`)) {
          element.classList.add("active");
        }
      });
    },
    handleTouchStart(event) {
      this.touchStartX = event.touches[0].clientX;
    },
    handleTouchEnd() {
      const touchDistance = this.touchMoveX - this.touchStartX;
      if (Math.abs(touchDistance) >= 200) {
        if (touchDistance > 0) {
          // Свайп вправо
          this.step--;
          if (this.step < 1) {
            this.step = this.slides.length;
          }
        } else {
          // Свайп влево
          this.step++;
          if (this.step > this.slides.length) {
            this.step = 1;
          }
        }
      }
    },
    handleTouchMove(event) {
      this.touchMoveX = event.touches[0].clientX;
    },
    editObject() {
      this.slides = [
        {
          title: this.language.main[39],
          infoTitle: this.language.main[40],
          infoCount: "30",
          color: 0,
        },
        {
          title: this.language.main[43],
          infoTitle: this.language.main[44],
          infoCount: "",
          color: 1,
        },
        {
          title: this.language.main[45],
          infoTitle: this.language.main[46],
          infoCount: "400",
          color: 0,
        },
        {
          title: this.language.main[47],
          infoTitle: this.language.main[48],
          infoCount: "",
          color: 1,
        },
        {
          title: this.language.main[49],
          infoTitle: this.language.main[50],
          infoBtn: this.language.main[51],
          infoCount: null,
          color: 0,
        },
      ];

      this.welcomText = {
        texts: [this.language.main[27], this.language.main[68], this.language.main[26]],
        text: "",
        index: 0,
        letterIndex: 0,
        isDeleting: false,
      }
    },
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
        this.welcomText.text = this.language.main[24] + ' ' + text.substring(0, this.welcomText.letterIndex + 1);
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
    NewHeader,
    NewFooter
  }
}
</script>

<style scoped></style>
