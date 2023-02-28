<script setup>
  import {Link} from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header
    @login-developer="openLoginDeveloper = !openLoginDeveloper"
    @login-realtor="openLoginRealtor = !openLoginRealtor"
    @open-register="openRegister = !openRegister"
    :user="user"
    @selectLanguage="choseLanguage"
    :language="language"
  />
  <main class="bg-[#F6F3FA]">
    <div class="_container">
      <div @click="openContactList = !openContactList"
           class="hidden lg:flex flex-col justify-evenly py-0.5 items-center cursor-pointer h-8 w-8 rounded-[5px] bg-[#6435A5] mt-3">
        <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
        <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
        <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
      </div>
      <div class="grid__chat h-[85vh] my-14 xxl:my-10 xl:my-8 lg:my-3">
        <app-chat-contact-list
          :class="{'left__625': openContactList}"
          :chats="chats"
          :user="user"
          :language="language"
          :selectLanguage="selectLanguage"
        />
        <app-chat-message
          v-if="openChat"
          :chat="chat_object"
          :user="user"
          :language="language"
        ></app-chat-message>
      </div>
    </div>
  </main>
  <app-footer  :language="language" />
</template>

<script>
  import AppFooter from "../Layouts/AppFooter.vue"
  import AppHeader from '../Layouts/AppHeader.vue'
  import AppChatContactList from "../Components/AppChatContactList.vue"
  import AppChatMessage from "../Components/AppChatMessage.vue"

  import {computed} from "vue";
  import {usePage} from "@inertiajs/inertia-vue3";

  export default {
    props:['user', 'chats', 'chat'],
    data() {
      return {
        openContactList: false,
        openChat: false,
        chat_object: [],
        language: {},
        selectLanguage: 0,
      }
    },
    mounted() {
      if(this.chat) {
        this.chat_object = this.chat;
        this.openChat = true;

        axios.post('/api/chat/chatOpen', {
          'id': this.chat_object.id,
        }).then(res => {
          if(res.status === 200) {
            this.chat_object.visible_id = 0;

            Object.values(this.chats).forEach(item => {
              if(item.id === this.chat_object.id) {
                item.visible_id = 0;
              }
            })
          }
        })
      }
    },
    created() {
      if(this.user.lang === 0) {
        this.language = this.$ru;
      } else if (this.user.lang === 1) {
        this.language = this.$en;
      } else if (this.user.lang === 2) {
        this.language = this.$tur;
      }
    },
    methods: {
      choseLanguage(language) {
        this.selectLanguage = language;

        if(this.selectLanguage === 0) {
          this.language = this.$ru;
        } else if (this.selectLanguage === 1) {
          this.language = this.$en;
        } else if (this.selectLanguage === 2) {
          this.language = this.$tur;
        }

      },
    },
    components: {
      AppHeader,
      AppFooter,
      AppChatContactList,
      AppChatMessage,
    }
  }
</script>

<style scoped>

  .chat-profile-enter-from {
    opacity: 0;
    transition: all 0.3s;
  }

  .chat-profile-enter-to {
    opacity: 1;
    transition: all 0.3s;
  }

  .chat-profile-leave-from {
    opacity: 1;
    transition: all 0.3s;
  }

  .chat-profile-leave-to {
    opacity: 0;
    transition: all 0.3s;
  }
</style>
