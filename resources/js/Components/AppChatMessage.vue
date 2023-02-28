<template>
  <div class="relative chat__container overflow-y-auto flex flex-col border border-solid border-[#E5DFEE] bg-[#EDE6F6]">
    <div :class="{'chat_border__bottom--0': chatProfile}"
         class="absolute transition-all transition-[0.3s] rounded-[10px] p-4 xxl:p-3 xl:p-2.5 w-[380px] xxl:w-[320px] xl:w-[260px] bg-white m-8 xxl:m-6 xl:m-5 lg:m-3 z-10 top-0 right-0">
      <div @click="chatProfile = !chatProfile" class="flex justify-between items-center cursor-pointer">
        <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
          <img class="w-12 xxl:w-10 xl:w-8 rounded-full self-start" v-if="from_user.role === 0" :src="chat.from.image" alt="">
          <img class="w-12 xxl:w-10 xl:w-8 rounded-full self-start" v-if="from_user.role !== 0" src="/images/hom.png" alt="">
          <div class="flex flex-col gap-2 xxl:gap-1.5 xl:gap-1" v-if="chat.from.id !== user.id">
            <span class="text-lg xxl:text-[15px] xl:text-[13px] leading-none" >{{ chat.from.first_name + ' ' + (chat.from.last_name === null ? '' : chat.from.last_name) }}</span>
            <span class="text-sm xxl:text-[12px] xl:text-[10px] text-[#8A8996] leading-[1]">{{ chat.from.status }}</span>
          </div>
          <div class="flex flex-col gap-2 xxl:gap-1.5 xl:gap-1" v-if="chat.to.id !== user.id">
            <span class="text-lg xxl:text-[15px] xl:text-[13px] leading-none" >{{ chat.to.first_name + ' ' + (chat.to.last_name === null ? '' : chat.to.last_name) }}</span>
            <span class="text-sm xxl:text-[12px] xl:text-[10px] text-[#8A8996] leading-[1]">{{ chat.from.status }}</span>
          </div>
        </div>
        <img src="../../assets/svg/arrow_down_black.svg" class="w-3 xl:w-2.5 mr-4" alt="">
      </div>
      <transition name="chat-profile">
        <div v-if="chatProfile" class="">
          <div
            class="chat-profile__border flex flex-col gap-4 xxl:gap-3 xl:gap-2.5 bg-white absolute w-full top-full left-0 p-4 xxl:p-3 xl:p-2.5">
            <div
              class="flex cursor-pointer items-center text-[#6536A5] bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
              <img src="../../assets/svg/chat_tel_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
              <span class="text-center w-full text-base xxl:text-sm xl:text-xs leading-none">{{ chat_object.to.id === user.id ? chat_object.from.phone : chat_object.to.phone }}</span>
            </div>
            <div
              class="flex cursor-pointer items-center text-[#6536A5] bg-[#F6F3FA] p-4 xxl:p-3 xl:p-2.5 rounded-[5px]">
              <img src="../../assets/svg/chat_mail_purple.svg" class="w-4.5 xxl:w-4 xl:w-3.5" alt="">
              <span class="text-center w-full text-base xxl:text-sm xl:text-xs leading-none">{{ chat_object.to.id === user.id ? chat_object.from.email : chat_object.to.email }}</span>
            </div>
          </div>
        </div>
      </transition>
    </div>

    <div v-if="!error" class="h-full overflow-hidden chat__container--flex bg-blue">
      <div
        class="relative overflow__custom overflow-y-auto flex gap-5 xxl:gap-4 xl:gap-3 h-full p-7 xxl:p-5 xl:p-4 flex-col-reverse">

        <div v-for="(message, key) in chat_object.message">

          <div class="my-3 xxl:my-2.5 xl:my-2 w-full flex justify-center">
            <span
              class="text-[#6435A5] bg__chat--date py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5 text-base xxl:text-sm xl:text-xs leading-none">{{ getDate(key) }}</span>
          </div>

          <div v-for="mes in message">
            <div class="flex flex-col-reverse gap-1" v-if="mes.user_id !== user.id">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <img :src="from_user.image !== null ? from_user.image : '/images/hom.png'" class="w-8 xxl:w-7 xl:w-6 linear-gradient" style="border-radius: 50%" alt="">
                <div
                  class="flex items-baseline bg-white rounded-[100px] gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                  <span class="text-base xxl:text-sm xl:text-xs leading-none">{{ mes.message }}</span>
                  <span
                    class="text-[#8A8996] text-[12px] xxl:text-[10px] xl:text-[9px] leading-none">{{ getTime(mes.created_at) }}</span>
                </div>
              </div>
            </div>

            <div class="flex flex-col-reverse gap-1" v-else>
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <img :src="user.image !== null ? user.image : '/images/hom.png'" class="w-8 xxl:w-7 xl:w-6" style="border-radius: 50%" alt="">
                <div
                  class="relative flex items-baseline bg-[#6435A5] rounded-[100px] text-white gap-2 xxl:gap-1.5 xl:gap-1 py-1.5 xxl:py-1 px-2.5 xxl:px-2 xl:px-1.5">
                  <span class="text-base xxl:text-sm xl:text-xs leading-none">{{ mes.message }}</span>
                  <span class="text-white text-[12px] xxl:text-[10px] opacity-60 xl:text-[9px] leading-none">{{ getTime(mes.created_at) }}</span>
                  <img src="../../assets/svg/chat_check_message_white.svg" class="w-5 xxl:w-4 xl:w-3.5 self-end" alt="">
                  <img src="../../assets/svg/cloud_corner.svg" class="absolute bottom-0 -left-[6.5px]" alt="">
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
    <div
      class="bg-white h-[72px] xxl:h-[60px] xxl:h-[50px] flex items-center px-7 xxl:px-5 xl:px-4 py-5 xxl:py-4 xl:py-3">
      <input :placeholder="language.ob[44]" type="text" v-model="message"
             class="focus:ring-0 w-full text-lg xxl:text-[15px] xl:text-[13px] leading-none"
             v-on:keyup.enter="sendMessage()"
      >
      <button

        v-on:click="sendMessage()"
        class="hover__chat-arrow transition-all rounded-full h-[54px] xxl:h-[42px] x:h-[36px] w-[54px] xxl:w-[42px] x:w-[36px] flex items-center justify-center flex-shrink-0">
        <svg class="w-9 xxl:w-7 xl:w-6" width="36" height="36" viewBox="0 0 36 36" fill="none"
             xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_272_9101)">
            <path
              d="M4.5 19.5004H13.5V16.5004H4.5V2.7694C4.50002 2.63907 4.53401 2.511 4.5986 2.39781C4.66319 2.28461 4.75617 2.19021 4.86836 2.12389C4.98056 2.05757 5.1081 2.02163 5.23841 2.01962C5.36872 2.01761 5.49731 2.04958 5.6115 2.1124L33.3045 17.3434C33.4221 17.4081 33.5201 17.5033 33.5884 17.6188C33.6567 17.7344 33.6928 17.8662 33.6928 18.0004C33.6928 18.1346 33.6567 18.2664 33.5884 18.382C33.5201 18.4975 33.4221 18.5927 33.3045 18.6574L5.6115 33.8884C5.49731 33.9512 5.36872 33.9832 5.23841 33.9812C5.1081 33.9792 4.98056 33.9432 4.86836 33.8769C4.75617 33.8106 4.66319 33.7162 4.5986 33.603C4.53401 33.4898 4.50002 33.3617 4.5 33.2314V19.5004Z"
              fill="#6435A5"/>
          </g>
          <defs>
            <clipPath id="clip0_272_9101">
              <rect width="36" height="36" fill="white"/>
            </clipPath>
          </defs>
        </svg>
      </button>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['user', 'chat', 'language'],
    mounted() {

      this.month.ru = {
        0: this.language.month[0],
        1: this.language.month[1],
        2: this.language.month[2],
        3: this.language.month[3],
        4: this.language.month[4],
        5: this.language.month[5],
        6: this.language.month[6],
        7: this.language.month[7],
        8: this.language.month[8],
        9: this.language.month[9],
        10: this.language.month[10],
        11: this.language.month[11],
      }

      if(this.chat.from.id === this.user.id) {
        this.from_user = this.chat.to;
      } else {
        this.from_user = this.chat.from;
      }

      this.chat_object = this.chat;

      setInterval(() => {
        axios.post('/api/chat/reloadChat', {
          id: this.chat.id,
          token: this.user.token,
        }).then(res => {
          this.chat_object = res.data;
        }).catch(e => {
          this.error = true;
        })
      }, 5000);
    },
    methods: {
      getDate(date) {

        let data = new Date(date);

        data.setHours(data.getHours() + 3);

        let month = '';

        Object.entries(this.month.ru).forEach(item => {
          if(item[0] == data.getMonth()) {
            month = item[1];
          }
        });

        return data.getDate() + ' ' + month;

      },
      sendMessage() {

        if(this.message.length > 0 ) {
          axios.post('/api/chat/message', {
            chat_id: this.chat.id,
            message: this.message,
            user_id: this.user.id,
            visible_id: this.chat.from.id !== this.user.id ? this.chat.from.id : this.chat.to.id,
            token: this.user.token,
          }).then(res => {
            this.chat_object = res.data;
            this.message = '';
          })
        }

      },
      getTime(date) {

        let data = new Date(date);

        data.setHours(data.getHours() + 3);

        return (data.getHours() < 10 ? '0' + data.getHours() : data.getHours()) + ':' + (data.getMinutes() < 10 ? '0' + data.getMinutes() : data.getMinutes())
      }
    },
    watch: {
      language(newItem) {
        this.month.ru = {
          0: this.language.month[0],
          1: this.language.month[1],
          2: this.language.month[2],
          3: this.language.month[3],
          4: this.language.month[4],
          5: this.language.month[5],
          6: this.language.month[6],
          7: this.language.month[7],
          8: this.language.month[8],
          9: this.language.month[9],
          10: this.language.month[10],
          11: this.language.month[11],
        }
      }
    },
    data() {
      return {
        messages: [],
        message: '',
        chat_object: [],
        chatProfile: false,
        error: false,
        from_user: [],
        month: {
          'ru': {
            0: 'Января',
            1: 'Февраля',
            2: 'Марта',
            3: 'Апреля',
            4: 'Майя',
            5: 'Июня',
            6: 'Июля',
            7: 'Августа',
            8: 'Сентября',
            9: 'Октября',
            10: 'Ноября',
            11: 'Декабря',
          }
        }
      }
    }
  }
</script>

<style scoped>

</style>
