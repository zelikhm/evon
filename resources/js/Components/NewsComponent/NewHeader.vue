<script setup>
  import {Link} from '@inertiajs/inertia-vue3'
  import ChangeLanguage from "@/Components/ChangeLanguage.vue";
</script>

<template>
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
            <change-language @selectLanguage="selectLanguage" :selectLang="selectLang"/>
          </li>
          <li class="btns">
            <div class="logIn">
              <button class="login" @click="$emit('login-developer')">Войти</button>
              <div class="select-login">
                <button>Как риэлтор</button>
                <button>Как застройщик</button>
              </div>
            </div>
            <button class="registr" @click="$emit('open-register')">Зарегистрироваться</button>
          </li>
          <li class="user">
            <img src="images/img/header/User.png" alt="" srcset="">
          </li>
        </ul>
      </nav>
    </div>

  </header>
  <!--!header-->
</template>

<script>
  export default {
    name: "NewHeader",
    props:['user_info'],
    data() {
      return {
        openLanguage: false,
        selectLang: 0,
      }
    },
    methods: {
      selectLanguage(n) {
        this.$emit('selectLanguage', n);

        if (this.user_info !== undefined) {

          axios.post('/api/user/lang', {
            token: this.user_info.token,
            id: this.user_info.id,
            lang: n,
          })

        }
      },
    }
  }
</script>

<style scoped>

</style>
