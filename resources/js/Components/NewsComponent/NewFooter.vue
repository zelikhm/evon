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
          <a href="https://wa.me/+905442258559" target="_blank">
            <img src="images/img/footer/s1.png" alt="" srcset="">
          </a>
<!--          <a href="https://m.facebook.com/people/EVON/100092335686616/" target="_blank">-->
<!--            <img src="images/img/footer/s2.png" alt="" srcset="">-->
<!--          </a>-->
          <a href="https://t.me/evon_turkey" target="_blank">
            <img src="images/img/footer/s3.png" alt="" srcset="">
          </a>
          <a href="https://instagram.com/evon_platform_tr?igshid=OGQ5ZDc2ODk2ZA==" target="_blank">
            <img src="images/img/footer/s4.png" alt="" srcset="">
          </a>
        </div>
      </div>

      <nav>
        <ul>
          <li>
            <span>{{ language.dob_ob_2[6] }}</span>
            <a href="mailto:evon.information@gmail.com" target="_blank" >evon.information@gmail.com</a>
          </li>
          <li>
            <span>WhatsApp</span>
            <a href="https://wa.me/+905442258559" target="_blank">+90(544)225 85 59</a>
          </li>
          <li>
            <span>Telegram</span>
            <a href="https://t.me/evon_turkey" target="_blank">evon_turkey</a>
          </li>
          <li>
            <span>Instagram</span>
            <a href="https://instagram.com/evon_platform_tr?igshid=OGQ5ZDc2ODk2ZA==" target="_blank">evon_platform_tr</a>
          </li>
<!--          <li>-->
<!--            <span>Facebook</span>-->
<!--            <a href="https://m.facebook.com/people/EVON/100092335686616/" target="_blank">ServisEvon</a>-->
<!--          </li>-->
        </ul>
      </nav>
      <p>
        {{ language.main[64] }}
      </p>
<!--      <p style="opacity: 1;">-->
<!--          ИП Захаров Максим Анатольевич  ИНН 583714084101 -->
<!--      </p>-->
      <div class="row-ref">
        <a href="https://evon-tr.com/privacy" target="_blank">{{ language.main[65] }}</a>
        <a href="https://evon-tr.com/agree" target="_blank">{{ language.main[66] }}</a>
        <a href="#" >VERGI NO <span>3830916930</span></a>

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
