<script setup>
  import {Link} from '@inertiajs/inertia-vue3'
</script>

<template>
  <app-header
    @login-developer="openLoginDeveloper = !openLoginDeveloper"
    @login-realtor="openLoginRealtor = !openLoginRealtor"
    @open-register="openRegister = !openRegister"
    :user="user"
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
        />
        <app-chat-message
          v-if="openChat"
          :chat="chat_object"
          :user="user"
        ></app-chat-message>
      </div>
    </div>
  </main>
  <app-footer/>
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
      }
    },
    mounted() {
      if(this.chat) {
        this.chat_object = this.chat;
        this.openChat = true;
      }
    },
    methods: {

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
