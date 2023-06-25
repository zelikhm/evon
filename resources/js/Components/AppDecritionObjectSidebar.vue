<template>
  <div class="bg-[#F6F3FA] p-7 xxl:p-5 xl:p-5 h-fit mb-10 xxl:mb-8 xl:mb-6 rounded-[10px]">
    <div class="text-sm xxl:text-xs xl:text-[10px] lg:text-[13px] pb-10 xxl:pb-8 xl:pb-6" v-if="news.length > 0">
      <span class="font-medium text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] pt-6 xxl:pt-5 xl:pt-4">{{
        language.ob[0] }}</span>
      <div class="py-5 xxl:py-4 xl:py-3 border__bottom" v-for="item in news">
        <span class="text-[#8A8996]">{{ new
          Date(Date.parse(item.created_at)).toISOString().replace(/^([^T]+)T(.+)$/, '$1').replace(/^(\d+)-(\d+)-(\d+)$/,
            '$3.$2.$1')
        }}</span>
        <p class="font-bold my-1 text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]">{{ item.title }}</p>
        <p v-html="item.description.slice(0, 100)"></p>
        <button class="text-[#6435A5] mt-1" @click="$emit('open-all-news')">{{ language.ob[13] }}</button>
      </div>
      <div class="flex justify-center w-full pt-5 xxl:pt-4 xl:pt-3">
        <button @click="$emit('open-all-news')" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5 animation__arrow">
          <span class="text-[#6435A5] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px]">{{ language.ob[14] }} ({{
            house.news.length }})</span>
          <img src="../../assets/svg/arrow_right_purple.svg" class="transition-all duration-300 h-4 xxl:h-3 xl:h-2.5"
            alt="Стелочка">
        </button>
      </div>
    </div>
    <div class="pb-10 xxl:pb-8 xl:pb-6">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] pb-5 xxl:pb-4 xl:pb-3 leading-none">{{
        language.rielt_1[23] }}</div>
      <div class="bg-white flex flex-col gap-5 xxl:gap-4 xl:gap-3 rounded-[10px] p-4 xxl:p-3 xl:p-2.5">
        <div class="flex items-center gap-4 xxl:gap-3 xl:gap-2.5">
          <!--          <img :src="'/storage/' + house.user.image" class="h-14 xxl:h-12 xl:h-10" alt="avatar">-->
          <div class=" flex flex-col gap-1.5 xxl:gap-1 xl:gap-0.5">
            <span class="font-medium text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] leading-none"
              v-if="house.user.first_name">{{ house.user.first_name }}</span>
            <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] lg:text-[13px] leading-none"
              v-if="house.user.status">{{ house.user.status }}</span>
          </div>
        </div>
        <button
          class="w-full bg-[#F6F3FA] text-[#6536A5] text-base xxl:text-sm xl:text-xs lg:text-[15px] rounded-[6px] py-4 xxl:py-3 xl:py-2.5"
          v-on:click="openChat(house.user.id)">{{ language.ob[9] }}</button>
      </div>
    </div>
    <div class="pb-10 xxl:pb-8 xl:pb-6" v-if="house.info.exclusive && house.info.exclusive !== 'null'">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] pb-5 xxl:pb-4 xl:pb-3 leading-none">{{
        language.ob[2] }}:</div>
      <p class="text-base text-[#8A8996] xxl:text-sm xl:text-xs">{{ house.info.exclusive }}</p>
    </div>
    <div class="pb-14 xxl:pb-10 xl:pb-8">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] pb-5 xxl:pb-4 xl:pb-3 leading-none">{{
        language.ob[3] }}</div>

      <div class="flex cursor-pointer mb-4 xxl:mb-3 xl:mb-2.5 bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
        <span
          class="leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">
        </span>
      </div>
        <div class="flex items-start gap-4 xxl:gap-3 xl:gap-2.5">
        <span class=" font-medium text-[28px] xxl:text-[22px] xl:text-[18px] lg:text-[22px]"
              v-if="house.percent !== 'null' && house.percent">{{ house.percent + '%' }}</span>
          <span class=" text-base text-[#8A8996] xxl:text-sm xl:text-xs lg:text-[15px]"
                v-if="house.comment && house.comment !== 'null'">{{ house.comment }}</span>
        </div>
      <div>
      </div>
    </div>
    <div class="pb-14 xxl:pb-10 xl:pb-8" v-if="house.supports.length > 0">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] pb-5 xxl:pb-4 xl:pb-3 leading-none">{{
        language.ob[4] }}</div>
      <div class="bg-white p-4 xxl:p-3 xl:p-2.5 rounded-[10px] mb-3" v-for="item in house.supports">
        <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 pb-5 xxl:pb-4 xl:pb-3">
          <img class="w-14 xxl:w-12 xl:w-10 h-14 xxl:h-12 xl:h-10 rounded-full object-cover"
            v-if="item.avatar.length > 17" :src="item.avatar" alt="">
          <img class="w-14 xxl:w-12 xl:w-10 h-14 xxl:h-12 xl:h-10 rounded-full object-cover" v-else
            src="../../assets/no-img-houses.jpg" alt="">
          <div class="flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5">
            <span class="text-[18px] xxl:text-[15px] xl:text-[13px] leading-none">{{ item.name }}</span>
            <span class="text-[14px] xxl:text-[12px] xl:text-[10px] text-[#8A8996] leading-none"
              v-if="item.status !== 'null' && item.status !== null">{{ item.status }}</span>
          </div>
        </div>
        <div class="text-[14px] xxl:text-[12px] xl:text-[10px] leading-none pb-4 xxl:pb-3 xl:pb-2.5"><span
            class="text-[#8A8996]" v-if="item.link !== 'null' && item.link !== null">{{ language.dob_ob_2[7] }}:</span> {{
              item.link }}</div>
        <div class=" flex cursor-pointer mb-4 xxl:mb-3 xl:mb-2.5 bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]"
          v-if="item.phone">
          <img src="../../assets/svg/chat_tel_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
          <span
            class="leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">{{
               item.phone }}</span>
        </div>
        <div class="flex cursor-pointer mb-4 xxl:mb-3 xl:mb-2.5 bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]"
          v-if="item.email">
          <img src="../../assets/svg/chat_mail_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
          <span
            class="leading-none text-center w-full text-[#6536A5] text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[15px]">{{
              item.email }}</span>
        </div>
      </div>
    </div>
    <div class="" v-if="house.files.length > 0">
      <div class="font-medium text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] pb-5 xxl:pb-4 xl:pb-3 leading-none">{{
        language.ob[5] }}</div>
      <div class="flex flex-col gap-6 xxl:gap-5 xl:gap-4">
        <a :href="link + item.name" class="flex items-center gap-3 xxl:gap-2.5 xl:gap-2 cursor-pointer"
          v-for="item in house.files">
          <img :src="`/images/file-icon_${item.name.split('.')[2]}.svg`" class="w-5 xxl:w-4 xl:w-3" alt="">
          <span class="text-[14px] xxl:text-[12px] xl:text-[10px] lg:text-[13px] leading-none">{{ item.name.split('.')[1]
            + '.' + item.name.split('.').at(-1) }}</span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  emits: ['open-all-news'],
  inject: ['user'],
  props: {
    house: [],
    language: {},
  },
  data() {
    return {
      news: null,
      link: window.location.protocol + '//' + window.location.host
    }
  },
  methods: {
    openChat(id) {
      window.location.href = '/profile/chat?to=' + this.user.id + '&from=' + id;
    }
  },
  created() {
    this.news = this.house.news.slice(0, 4).sort((a, b) => Date.parse(b.created_at) - Date.parse(a.created_at))
  }
}
</script>

<style scoped>
.transparent {
  text-align: center;
  width: 100%;
  padding: 9px;
  opacity: 0.7;
  border-radius: 10px;
  display: block;
  background: white;
}

.stars {
  opacity: 0.5;
}

.available {
  opacity: 0.7;
}

[data-tooltip]::after {
  content: attr(data-tooltip);
  /* Выводим текст */
  /*  position: absolute;
  top: 245px;
  right: 150px;
  background: rgb(246 243 250 / var(--tw-bg-opacity)); */

  position: absolute;
  top: 242px;
  right: 165px;
  box-shadow: 0px 0px 0px 1px;
  background: white;
  border-radius: 10px;
  /* opacity: 0; */
  padding: 9px 22px;
  opacity: 0;
  transition: 1s;
  pointer-events: none;

}

[data-tooltip]::after {
  opacity: 0;
}

[data-tooltip]::after {
  transition: 1s;
}

[data-tooltip]::after {
  pointer-events: none;
}

[data-tooltip]:hover::after {
  opacity: 1;
}

[data-tooltipName]::after {
  content: attr(data-tooltip);
  /* Выводим текст */
  position: absolute;
  top: 245px;
  right: 150px;
  background: rgb(246 243 250 / var(--tw-bg-opacity));

}

[data-tooltipName]::after {
  opacity: 0;
}

[data-tooltipName]::after {
  transition: 1s;
}

[data-tooltipName]::after {
  pointer-events: none;
}

[data-tooltipName]:hover::after {
  opacity: 1;
}
</style>
