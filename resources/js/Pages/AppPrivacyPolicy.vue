<template>
  <div class="flex flex-col min-h-[100vh]">
    <app-header :user="user" :language="language" @selectLanguage="choseLanguage"/>
    <main class="_container_policy">
      <div class="mt-14 xxl:mt-12 xl:mt-10 mb-20 xxl:">
        <h3 class="text-[#3B3A45] text-center pb-7 xxl:pb-5 xl:pb-4 text-3xl xxl:text-2xl xl:text-xl lg:text-2xl">
          Политика конфиденциальности</h3>
        <div>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">
            Настоящая Политика конфиденциальности (далее по тексту – НПК) распространяется на всю информацию, которую
            компания ООО "ЕВОН" может получить о Пользователе во время пользования
            им сайтом Компании с доменным именем https://evon-tr.com/ (далее по тексту – сайт).
          </p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px] my-3">1. ОСНОВНЫЕ ПОНЯТИЯ</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">1.1. В НПК встречается следующая
            терминология:</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">1.1.1. «Администрация сайта
            «https://evon-tr.com/» (далее – Администрация сайта)» – персонал, имеющий полномочия управлять сайтом,
            действующий от имени ООО "ЕВОН", организующий и (или) осуществляющий
            обработку данных, а также определяющий цели обработки и состав этих данных, все допустимые действия,
            выполняемые с этой информацией. </p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">1.1.2. «Данные пользователя сайта» –
            любая информация, касающаяся физлица или юрлица (субъекта данных). </p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">1.1.3. «Обработка данных
            Пользователя сайта» – любое действие (операция) или совокупность действий (операций), которые выполняются
            путем применения средств автоматизации или без них, с данными, включая сбор, фиксацию, хранение, уточнение
            (обновление, корректировку), применение в интересах Пользователя, оставившего данные, удаление и уничтожение
            полученной информации.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">1.1.4. «Конфиденциальность данных» –
            непременное для соблюдения Администрацией сайта или иным лицом, получившим доступ к информации, требование
            предотвращать ее разглашение без согласия Пользователя, предоставившего информацию, или законного
            основания.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">1.1.5. «Пользователь сайта (далее
            Пользователь)» – физлицо или юрлицо, использующее Сайт «https://evon-tr.com/». </p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">1.1.6. «Cookies» – фрагмент данных,
            отправляемый веб-сервером, хранящийся на компьютере или мобильном телефоне Пользователя, который
            пересылается веб-серверу в HTTP-запросе каждый раз при открытии Пользователем страницы сайта. </p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">1.1.7. «IP-адрес» – динамический или
            статический сетевой адрес, построенной по протоколу IP.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px] my-3">2. ОБЩИЕ ПОЛОЖЕНИЯ</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">2.1. Пользование Сайтом
            Пользователем приравнивается к его согласию с НПК и указанными условиями обработки данных.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">2.2. Если Пользователь не согласен с
            условиями, указанными в НПК, он обязан немедленно прекратить использование Сайта.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">2.3. НПК распространяется только на
            сайт https://evon-tr.com/ не контролирует и не несет ответственность за сайты третьих лиц, ссылки на которые
            размещены на Сайте Компании.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">2.4. Администрация сайта не отвечает
            за проверку и контроль достоверности информации, указываемой Пользователем.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px] my-3">3. ПРЕДМЕТ</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">3.1. Опубликованная на сайте НПК
            регламентирует обязательства Администрации сайта, касающиеся защиты конфиденциальности информации,
            предоставляемой Пользователем при заполнении форм, размещенных на Сайте. Данные могут содержать:</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– ФИО Пользователя;</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– контактный номер стационарного или
            мобильного телефона;</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– адрес электронной почты;</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– название фирмы Пользователя и
            прочее.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">3.2. Данные, автоматически
            передаваемые при просмотре блоков рекламы и при переходе на страницы сайта, на которых установлены скрипты
            статистики, также защищены от разглашения. К этой информации относятся:</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– IP-адрес;</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– информация из cookies;</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– данные о браузере или иной
            программе, через которую осуществляется доступ;</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– время посещения страниц Сайта;</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– интернет-адрес страницы, на
            которой расположен блок рекламы;</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">– интернет-адрес предыдущей
            посещенной Пользователем страницы.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">3.3. Другие данные, неописанные выше
            (включая тип браузера, ОС компьютера или смартфона и проч.), подлежат надежному хранению и неразглашению.
            Список исключений указан в п.п. 5.2. и 5.3. НПК</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px] my-3">4. ЦЕЛИ СБОРЫ ИНФОРМАЦИИ</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">4.1. Для корректной идентификации
            зарегистрированного Пользователя для формирования заказа и (или) заключения Договора купли-продажи через
            сайт https://evon-tr.com/</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">4.2. Для предоставления Пользователю
            возможности доступа к персонализированным ресурсам, размещенным на Сайте.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">4.3. Для выстраивания с
            Пользователем системы обратной связи, в т. ч. для отправки уведомлений, запросов, связанных с пользованием
            Сайта, оказанием услуг, обработки запросов, поступивших от Пользователя.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">4.4. Для уведомления Пользователя
            Сайта о статусе оформленного им Заказа или сформированной через сайт Заявки.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">4.5. Для корректного обрабатывания
            платежей и получения оплаты, подтверждения суммы налога или наличия налоговых льгот, оспаривания факта
            проведения оплаты.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">4.6. С целью демонстрации
            Пользователю, с его согласия, новинок, конструктивных изменений предлагаемых товаров, акций, предоставления
            информации о стоимости товаров и услуг, новостной рассылки и иных материалов.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">4.7. Для ведения рекламной кампании
            с Пользователем.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px] my-3">5. СПОСОБЫ И СРОКИ ОБРАБОТКИ
            ПЕРСОНАЛЬНОЙ ИНФОРМАЦИИ</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">5.1. Обработка данных, полученных от
            Пользователя сайта, не ограничена по срокам и выполняется любым законным способом, в т. ч. в различных
            информационных системах, использующих или не использующих средства автоматизации.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">5.2. Пользователь выражает согласие,
            что Администрация сайта имеет законное право передавать требуемые данные третьим лицам (курьерским службам,
            транспортным компаниям и прочим) исключительно для корректного исполнения заказа Пользователя,
            сформированного на Сайте https://evon-tr.com/ </p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">5.3. Данные Пользователя сайта могут
            быть переданы представителям уполномоченных органов госвласти РФ и Республики Турции только по основаниям и
            в порядке, указанном в законодательных актах, действующих на территории РФ и Республики Турции.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">5.4. Администрация сайта
            предпринимает меры для защиты информации, получаемой от Пользователя, от незаконного или случайного доступа
            к ней, распространения, а также от других неправомерных действий третьих лиц.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">5.5. Администрация сайта и
            Пользователь совместно предпринимают действия для предотвращения убытков или возникновения других негативных
            последствий, которые могут быть вызваны потерей или разглашением личных данных Пользователя.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px] my-3">6. ЗАКЛЮЧИТЕЛЬНЫЕ ПОЛОЖЕНИЯ</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">6.1. Администрация сайта оставляет
            за собой право вносить изменения и редактировать НПК без письменного согласия Пользователя.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">6.2. Новая Политика
            конфиденциальности начинает действовать сразу после ее публикации на Сайте, если иное не указано новой
            версией Политики конфиденциальности.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">6.2. Новая Политика
            конфиденциальности начинает действовать сразу после ее публикации на Сайте, если иное не указано новой
            версией Политики конфиденциальности.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs lg:text-[14px]">24.01.2023</p>
        </div>
      </div>
    </main>
    <app-footer class="justify-self-end" :language="language"/>
  </div>
</template>

<script>
  import AppHeader from "../Layouts/AppHeader.vue"
  import AppFooter from "../Layouts/AppFooter.vue"
  import {computed} from "vue";
  import {usePage} from "@inertiajs/inertia-vue3";

  export default {
    props: ['user'],
    data() {
      return {
        user: computed(() => usePage().props.value.auth.user),
        selectLanguage: 0,
        language: {},
      }
    },
    methods: {
      choseLanguage(language) {
        this.selectLanguage = language;

        if (this.selectLanguage === 0) {
          this.language = this.$ru;
        } else if (this.selectLanguage === 1) {
          this.language = this.$en;
        } else if (this.selectLanguage === 2) {
          this.language = this.$tur;
        }
      }
    },
    created() {
      if(this.user?.lang === 0) {
        this.language = this.$ru;
      } else if (this.user?.lang === 1) {
        this.language = this.$en;
      } else if (this.user?.lang === 2) {
        this.language = this.$tur;
      }
    },
    components: {
      AppHeader,
      AppFooter,
    }
  }
</script>

<style scoped>

</style>
