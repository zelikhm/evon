<script setup>

  import { Link } from '@inertiajs/inertia-vue3';

</script>

<template>
  <div class="chat__userlist lg:absolute lg:-left-full transition-all duration-500 lg:z-40 h-[85vh] lg:w-[50vw] md:w-[87.5vw] overflow-y-auto border border-solid border-[#E5DFEE] bg-white">
    <div class="p-4 xxl:p-3 xl:p-2.5">
      <div class="relative">
        <input v-model="searchName" class="bg-[#F7F7F9] focus:ring-[#6435A5] w-full pl-8 xxl:pl-7 xl:pl-6 py-2.5 xl:py-2 text-sm xxl:text-xs xl:text-[10px] rounded-[6px]" :placeholder="language.ob[47] + '...'" type="text">
        <img src="../../assets/svg/search_icon_grey.svg" class="absolute top-1/2 left-0 translate-x-1/2 -translate-y-1/2 w-4.5 xxl:w-4 xl:w-3.5" alt="">
      </div>
    </div>
    <div class="w-full h-[1px] bg-[#E5DFEE]"></div>
    <div v-for="chat in searchChat">
      <Link :href="'/profile/chat/' + chat.id">
        <div class="flex items-center cursor-pointer gap-4 xxl:gap-3 xl:gap-2.5 pt-4 xxl:pt-3 xl:pt-2.5 px-4 xxl:px-3 xl:px-2.5">
          <img class="w-12 xxl:w-10 xl:w-8 rounded-full self-start" :src="getPhoto(chat)" alt="">
          <div class="flex flex-col gap-1 xl:gap-0.5 w-full pb-4 xxl:pb-3 xl:pb-2.5 border__bottom--opacity">
            <div class="flex justify-between items-center">
              <div class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
            <span class="text-base xxl:text-sm xl:text-xs leading-none whitespace-nowrap">
              {{
              chat.from.id === user.id ? chat.to.first_name
              + ' '
              + (chat.to.last_name === null ? '' : chat.to.last_name ) : chat.from.first_name
              + ' '
              + (chat.from.last_name === null ? '' : chat.from.last_name)
              }}
            </span>
                <span v-bind:class="{ 'bg-[#6435A5]': chat.from.role === 1 , 'bg-[#E87746]': chat.from.role === 0, 'bg-[#E84680]': chat.from.role > 1 }" class="text-white text-[10px] xxl:text-[9px] xl:text-[8px] font-medium leading-none rounded-[3px] px-1.5 py-1 xl:px-1 py-0.5" v-if="chat.from.id !== user.id">{{ getType(chat) }}</span>
                <span v-bind:class="{ 'bg-[#6435A5]': chat.to.role === 1 , 'bg-[#E87746]': chat.to.role === 0, 'bg-[#E84680]': chat.to.role > 1 }" class="text-white text-[10px] xxl:text-[9px] xl:text-[8px] font-medium leading-none rounded-[3px] px-1.5 py-1 xl:px-1 py-0.5" v-if="chat.to.id !== user.id">{{ getType(chat) }}</span>
              </div>
              <div class="flex gap-1">
                <!--            <img src="../../assets/svg/chat_check_message.svg" class="w-5 xxl:w-4 xl:w-3.5" alt="">-->
                <span class="text-sm xxl:text-xs xl:text-[10px] whitespace-nowrap" v-if="chat.message !== null">{{ getDateTime(chat.message) }}</span>
              </div>
            </div>
            <div class="flex justify-between items-center text-sm xxl:text-xs xl:text-[10px]">
              <span class="text-[#8A8996] leading-none" v-if="chat.message !== null">{{ chat.message.message.length > 30 ? chat.message.message.slice(0, 30) + '...' : chat.message.message }}</span>
              <span class="bg-[#6435A5] text-white rounded-[100px] leading-none px-1.5 xl:px-1 py-0.5" v-if="chat.visible_id === user.id">{{  }}</span>
            </div>
          </div>
        </div>
      </Link>
    </div>
  </div>
</template>

<script>
export default {
  props:['chats', 'user', 'language', 'selectLanguage'],
  data() {
    return {
      chatProfile: false,
      chats_array: [],
      searchName: '',
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
  },
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

    this.chats_array = this.chats;

    setInterval(() => {
      axios.post('/api/chat/reloadChats', {
        user_id: this.user.id,
        token: this.user.token,
      }).then(res => {
        this.chats_array = res.data;
      })
    }, 3000);

  },
  methods: {
    getPhoto(chat) {

      if(chat.from.id !== this.user.id) {
        return chat.from.role === 0 ? chat.from.image : '/images/hom.png';
      } else if (chat.to.id !== this.user.id) {
        return chat.to.role === 0 ? chat.to.image : '/images/hom.png';
      }

    },
    getType(chat) {

      if(chat.from.id !== this.user.id) {
        if(chat.from.role === 0) {
          return this.language.ob[45]
        } else if (chat.from.role === 1) {
          return this.language.ob[46]
        } else {
          return this.language.ob[43]
        }
      } else {
        if(chat.to.role === 0) {
          return this.language.ob[45]
        } else if (chat.to.role === 1) {
          return this.language.ob[46]
        } else {
          return this.language.ob[43]
        }
      }

    },
    getDateTime(message) {

      let data = new Date(message.created_at);

      data.setHours(data.getHours() + 3);

      let month = '';

      Object.entries(this.month.ru).forEach(item => {
        if(item[0] == data.getMonth()) {
          month = item[1];
        }
      });

      return data.getDate() + ' ' + month + ', ' + (data.getHours() < 10 ? '0' + data.getHours() : data.getHours()) + ':' + (data.getMinutes() < 10 ? '0' + data.getMinutes() : data.getMinutes())

    },

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
  computed: {
    searchChat() {

      return this.chats_array.filter(chat => {
        return chat.from.first_name.toUpperCase().indexOf(this.searchName.toUpperCase()) !== -1
      })

      return this.chats_array.filter(chat => {
        return chat.from.last_name.toUpperCase().indexOf(this.searchName.toUpperCase()) !== -1
      })


    }
  }
}
</script>

<style scoped>

</style>
