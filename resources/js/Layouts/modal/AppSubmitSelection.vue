<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div class="relative bg-white rounded-[12px] p-10 xxl:p-9 xl:p-8 lg:p-5 z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
      <div class="flex justify-between items-center mb-5 xxl:mb-4 xl:mb-3">
        <h2 class="text-[22px] xxl:text-[18px] xl:text-[16px] font-semibold leading-none">{{ language?.podbor_1[1]??title }}</h2>
        <button @click="$emit('closeSubmitSelection')" class="hover__close right-0 z-50">
          <svg class="transition-all cursor-pointer w-6 xxl:w-5 xl:w-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_266_4120)">
              <path d="M11.9997 10.586L16.9497 5.63599L18.3637 7.04999L13.4137 12L18.3637 16.95L16.9497 18.364L11.9997 13.414L7.04974 18.364L5.63574 16.95L10.5857 12L5.63574 7.04999L7.04974 5.63599L11.9997 10.586Z" fill="#8A8996"/>
            </g>
            <defs>
              <clipPath id="clip0_266_4120">
                <rect width="24" height="24" fill="white"/>
              </clipPath>
            </defs>
          </svg>
        </button>
      </div>
      <span class="text-[#8A8996] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">{{ language?.podbor_1[0]??"" }}</span>
      <div class="relative mt-10 xxl:mt-8 xl:mt-6">
        <input :value="valueLink" ref="text" disabled class="copy-link w-full text-[#1E1D2D] text-[16px] focus:ring-[#6435A5] focus:border-[#6435A5] xxl:text-[14px] xl:text-[12px] pl-5 xxl:pl-4 xl:pl-3 py-3 xxl:py-2.5 xl:py-2 leading-none rounded-[5px] border border-solid border-[#E5DFEE] pr-12 xxl:pr-10 xl:pr-8" type="text">
        <!-- <span  v-if="user.subscription_info.free == 1"  class="copy-link-text">{{language.ob[50]}}</span>       -->
        <span v-if="copy_link_hint" class="copy-link-text">Ссылка скопирована</span>
        <img @click="copy" class="absolute cursor-pointer top-1/2 -translate-y-1/2 w-6 xxl:w-5 xl:w-4 right-5 xxl:right-4 xl:right-3" src="../../../assets/svg/copy_icon_purple.svg" alt="">
      </div>
    </div>
    <div @click="$emit('closeSubmitSelection')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
export default {
  props: {
    link: String,
    user: Object,
    language: {},
    title:{
      type:String,
      default:""
    },
    type:{
      type:Number,
      default:0
    }
  },
  emits: ['closeSubmitSelection'],
  data() {
    return {
      valueLink: this.type==0?'http://102895812h9051h2081102j9':this.link,
      copy_link_hint:false
    }
  },
  methods: {
    copy() {
      try {
        navigator.clipboard.writeText(this.valueLink)
        this.copy_link_hint=true
        setTimeout(() => {
          this.copy_link_hint=false
        }, 3000);
      } catch (error) {
        var textToCopy = this.valueLink;
        var input = document.createElement("textarea");
        input.value = textToCopy;
        document.body.appendChild(input);
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand("copy");
        document.body.removeChild(input);
        this.copy_link_hint=true
        setTimeout(() => {
          this.copy_link_hint=false
        }, 3000);
      }
    }
  },
  created() {
    this.valueLink = this.link
  }
}
</script>

<style scoped>
.copy-link-text {
  position: absolute;
  top: 40px;
  right: calc(50% - 84px);
  box-shadow: 0px 0px 0px 1px;
  background: white;
  color: rgb(101 54 165 );
  border-radius: 10px;
  font-size: 12px;
  padding: 2px 22px;
  transition: .7s;
  border: 7px;
  pointer-events: none;
}
.Modal .Modal_body{

}
.copy-link:hover + .copy-link-text {
  opacity: 1;
}
</style>
