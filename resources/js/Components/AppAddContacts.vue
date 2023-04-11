<template>
  <div class="flex justify-between items-center">
    <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] lg:text-[20px]">{{ language.form_dob_ob[1] }}</h2>
    <button
        @click="$emit('open-add-contact')"
        class="flex items-center register__button--white text-[#6435A5] border border-solid border-[#6435A5] rounded-[5px] py-3 xxl:py-2.5 xl:py-2 px-4 xxl:px-3 xl:px-2.5">
      <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_519_1862)">
          <path d="M7.33398 7.33301V3.33301H8.66732V7.33301H12.6673V8.66634H8.66732V12.6663H7.33398V8.66634H3.33398V7.33301H7.33398Z" fill="#6435A5"/>
        </g>
        <defs>
          <clipPath id="clip0_519_1862">
            <rect width="16" height="16" fill="white"/>
          </clipPath>
        </defs>
      </svg>
      <span class="font-medium text-base xxl:text-sm xl:text-xs lg:text-[14px] leading-none">{{ language.dob_ob_2[1] }}</span>
    </button>
  </div>
  <div v-for="item in supports"
       class="contact__selling my-5 xxl:my-4 xl:my-3 text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] flex justify-between items-center rounded-[5px] p-1.5 xl:p-1">
    <div class="flex items-center gap-14 xxl:gap-10 xl:gap-8">
      <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3">
        <img v-if="item.avatar.length > 17" :src="item.avatar" class="object-cover h-12 xxl:h-10 xl:h-8 w-12 xxl:w-10 xl:w-8 object-cover rounded-full" alt="">
        <img v-else src="../../assets/no-img-houses.jpg" class="object-cover h-12 xxl:h-10 xl:h-8 w-12 xxl:w-10 xl:w-8 object-cover rounded-full" alt="">
        <span class="text-[#1E1D2D]">{{ item.name }}</span>
      </div>
      <span class="text-[#8A8996]">{{ item.phone }}</span>
      <span class="text-[#8A8996]">{{ item.email }}</span>
    </div>
    <div class="flex gap-7 xxl:gap-5 xl:gap-4">
      <img @click="this.$emit('open-edit-contact', item)" src="../../assets/svg/pen_icon_grey.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 lg:w-6" alt="">
      <img @click="deleteSupport(item)" src="../../assets/svg/bucket_icon_red.svg" class="cursor-pointer w-6 xxl:w-5 xl:w-4 lg:w-6" alt="">
    </div>
  </div>
</template>

<script>
export default {
  props: ['house', 'supports', 'language', 'token'],
  inject:['user'],
  name: "AppAddContacts",
  data() {
    return {
    }
  },
  methods: {
    deleteSupport(item) {
      axios.post('/api/house/deleteSupport', {
        id: item.id,
        token: this.token
      })

      this.supports.forEach((support, idx) => {
        if (item.id === support.id) {
          this.supports.splice(idx, 1)
        }
      })
    }
  },
  created() {
  },
}
</script>

<style scoped>

</style>
