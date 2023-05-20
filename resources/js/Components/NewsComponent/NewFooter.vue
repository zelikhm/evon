<template>
  <!--footer-->
  <footer>
    <div class="container">

      <div class="mobile-contant">
        <img class="logo" src="images/img/footer/logo.png" alt="" srcset="">
        <p>
          {{ language.main[63] }}
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
            <span>{{ language.dob_ob_2[6] }}</span>
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
        {{ language.main[64] }}
      </p>
      <div class="row-ref">
        <a href="#">{{ language.main[65] }}</a>
        <a href="#">{{ language.main[66] }}</a>
        <a href="#">VERGI NO <span>3830916930</span></a>
      </div>
    </div>
  </footer>
</template>

<script>
  export default {
    props: ['language'],
    name: "NewFooter"
  }
</script>

<style scoped>

</style>
