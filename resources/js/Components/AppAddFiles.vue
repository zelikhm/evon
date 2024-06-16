<template>
  <div>
    <div class="file-upload-wrapper">
      <input multiple @change="changeInputFile" type="file" ref="documents" id="input_file" class="file-input">
      <label class="file-upload-label" for="input_file">
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
        <span class="file-upload-text">{{ language.dob_kv_1[26] }}</span>
      </label>
    </div>
    <div class="file-list">
      <div v-for="input in 7" class="file-item">
        <div class="file-info">
          <img  src="#" alt="">
          <span class="file-name">asdasdasdasdasdasd</span>
        </div>
        <button class="delete-button">
          <img @click="deleteFile(input)" class="delete-icon" src="../../assets/svg/bucket_icon_red.svg" alt="">
        </button>
      </div>
<!--      <div v-for="input in files" class="file-item">-->
<!--        <div class="file-info">-->
<!--          <img :src="`/images/file-icon_${input.name.split('.')[2]}.svg`" alt="">-->
<!--          <span class="file-name">{{ input.name.split('.')[1] + '.' + input.name.split('.').at(-1) }}</span>-->
<!--        </div>-->
<!--        <button class="delete-button">-->
<!--          <img @click="deleteFile(input)" class="delete-icon" src="../../assets/svg/bucket_icon_red.svg" alt="">-->
<!--        </button>-->
<!--      </div>-->
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

      formData.append('house_id', this.house?.id);
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
      this.house?.files?.forEach(item => {
        this.files.push(item);
      })
    },
    changeInputFile(e) {
      this.inputFile = Array.from(e.target.files)
      this.inputFile?.forEach(i => {
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
.file-upload-wrapper {
  position: relative;
  margin-top: 12px;
  margin-bottom: 12px;
}

.file-input {
  opacity: 0;
  position: absolute;
  visibility: hidden;
}

.file-upload-label {
  display: flex;
  align-items: center;
  cursor: pointer;
  gap: 8px;
  border: 1px solid #6435A5;
  border-radius: 6px;
  padding: 12px 16px;
  color: #6435A5;
  width: fit-content;
}

.file-upload-text {
  font-size: 16px;
  font-weight: 500;
  line-height: 1;
}

.file-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin-top: 20px;
}

.file-item {
  display: flex;
  grid-template-columns: 0.5fr auto;
  align-items: center;
  box-shadow: 0px 8px 60px rgba(52, 23, 94, 0.05);
  padding: 6px 10px;
  justify-content: space-between;
}
.file-item .file-info{
  display: flex;
  align-items: center;
  gap: 10px;
}
.file-info img{
  width: 48px;
  height: 48px;
  border-radius: 50%;
}
.file-name {
  font-size: 16px;
  font-weight: 500;
}

.delete-button {
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
}

.delete-icon {
  width: 24px;
  height: 24px;
}
</style>
