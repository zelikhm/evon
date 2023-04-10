<template>
  <div >
    <h3 class="text-[#1E1D2D] text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium leading-none mb-5 xxl:mb-4 xl:mb-3">
      {{ language.dob_kv_1[25] }}</h3>
    <div class="relative my-3 xxl:my-2.5 xl:my-2">
      <input multiple @change="changeInputFile" type="file" ref="documents" id="input_file" class="opacity-0 absolute invisible">
      <label
          class="register__button--white w-fit text-[#6435A5] flex items-center cursor-pointer gap-2 xl:gap-1.5 border border-solid border-[#6435A5] rounded-[6px] px-4 xxl:px-3 xl:px-2.5 py-3 xxl:py-2.5 xl:py-2"
          for="input_file"
      >
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
        <span class="font-medium text-base xxl:text-sm xl:text-xs lg:text-[15px] leading-none">{{ language.dob_kv_1[26] }}</span>
      </label>
    </div>
    <div class="flex flex-col gap-4 xxl:gap-3 xl:gap-2.5">
      <div v-for="input in files" class="flex justify-between items-center">
        <div class="flex items-center gap-4 xxl:gap-3 xl:gap-2.5">
          <img :src="`/images/file-icon_${input.name.split('.')[2]}.svg`" alt="">
          <span class="text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] font-medium">{{ input.name.split('.')[1] + '.' + input.name.split('.').at(-1) }}</span>
        </div>
        <button>
          <img @click="deleteFile(input)" class="w-6 xxl:w-5 xl:w-4 lg:w-6" src="../../assets/svg/bucket_icon_red.svg" alt="">
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['house', 'language', 'token'],
  inject:['user'],
  name: "AppAddFiles",
  data() {
    return {
      files: []
    }
  },
  methods: {
    save(file) {
      let formData = new FormData();

      formData.append('house_id', this.house.id);
      formData.append('file', file);
      formData.append('token', this.token);

      axios.post('/api/house/addedFiles',
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
      ).then(res => {
        console.log(res)
        this.files.push({
          id: 15,
          name: res.data.name,
          house_id: this.house.id
        })
        // this.house.images.push({
        //   id: 15,
        //   name: res.data.name,
        //   house_id: this.house.id,
        // });
      })
    },
    loadFiles() {
      this.files = [];
      this.house.files.forEach(item => {
        this.files.push(item);
      })
    },
    changeInputFile(e) {
      this.inputFile = Array.from(e.target.files)
      this.inputFile.forEach(i => {
        let obj = {
          name: i.name,
          extension: i.name.split(".")[1]
        }

        this.save(i)
      })
    },
    deleteFile(input) {
      this.files.forEach((item, idx) => {
        if (item.name === input.name) {
          this.files.splice(idx, 1)
          axios.post('/api/house/deletedFile', {
            fileName: input.name,
            house_id: this.house.id,
            token: this.token
          })
        }
      })


    },
  },
  created() {
    this.loadFiles()
  }
}
</script>

<style scoped>

</style>
