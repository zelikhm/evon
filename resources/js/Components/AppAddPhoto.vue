<template>
  <h2 class="font-semibold text-[22px] xxl:text-[18px] xl:text-[15px] mb-5 xxl:mb-4 xl:mb-3">Добавить фото</h2>
  <div class="grid grid-cols-4 sm:grid-cols-2 gap-3 xxl:gap-2.5 xl:gap-2">
    <div @click="targetBlockPhoto(item)" v-for="item in photos" :class="{ border: item.active === 1 }" class="corpus__banner cursor-pointer gap-3.5 xxl:gap-3 xl:gap-2.5 rounded-[5px] border-solid border-[#6435A5] flex flex-col justify-center px-5 xxl:px-4 xl:px-3 py-5 xxl:py-4 xl:py-3 ">
      <span class="text-[#1E1D2D] text-[17px] xxl:text-[14px] xl:text-[12px] leading-none">{{ item.name }}</span>
      <span class="text-[#8A8996] text-sm xxl:text-xs xl:text-[10px] leading-none">{{ item.count }} фото</span>
    </div>
  </div>
  <div class="my-10 xxl:my-8 xl:my-6">
    <div :class="{'grid__full' : myPhotos.length === 0, 'bg-[#F6F3FA] p-1': myPhotos.length !== 0}"  class="grid grid-cols-5 md:grid-cols-4 sm:grid-cols-2 rounded-[5px] gap-2 my-10 xxl:my-8 xl:my-6">
      <div
        class="relative w-full h-[8.5vw] lg:h-[16.7vw] md:h-[20.8vw] sm:h-[42.2vw] rounded-[5px]"
        v-for="(photo, idx) in myPhotos"
        :key="idx"
      >
        <div @click="deletePhoto(photo)" class="bg__close-photo cursor-pointer absolute top-0 right-0 z-20 m-1 w-6 xxl:w-5 xl:w-4 h-6 xxl:h-5 xl:h-4 rounded-[3px]">
          <span class="absolute h-[2px] xl:h-[1px] w-[80%] bg-white top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45 rounded-[10px]"></span>
          <span class="absolute h-[2px] xl:h-[1px] w-[80%] bg-white top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 -rotate-45 rounded-[10px]"></span>
        </div>
        <div class="bg-[#30CB49] absolute top-0 left-0 z-10 m-1 w-6 xxl:w-5 xl:w-4 h-6 xxl:h-5 xl:h-4 rounded-[3px]">
          <img src="../../assets/svg/check_icon.svg" class="w-full" alt="">
        </div>
        <div ref="uploudBackground" class="absolute rounded-[5px] bg-[#6435A5] w-full h-full z-10"></div>
        <div class="overflow-hidden absolute z-20 bottom-0 left-0 p-2 w-full">
          <div class="flex flex-col gap-1.5 xl:gap-1">
            <span class="text-white text-[14px] xxl:text-[12px] xl:text-[10px] leading-none font-medium">{{ photo.size }}</span>
            <span class="text-white text-[12px] xxl:text-[10px] xl:text-[9px] leading-none">{{ photo.name }}</span>
          </div>
          <div ref="progressBar" class="bg__progress-bar h-2.5 xxl:h-2 xl:h-1.5 w-full rounded-[100px]">
            <div class="progress-bar bg-white h-full rounded-[100px]"></div>
          </div>
        </div>
        <img class="absolute w-full h-full rounded-[5px]" :src="photo.url ? photo.url : '/storage/images/' + photo.name" alt="">
      </div>
      <div class="relative border border-solid border-[#E5DFEE] w-full h-[8.5vw] lg:h-[16.7vw] md:h-[20.8vw] sm:h-[42.2vw] rounded-[5px]">
        <div class="w-full h-full rounded-[5px]">
          <div class="absolute rounded-[5px] w-full h-full top-0 left-0">
            <label for="image" class="bg__uploud-photo transition-all relative cursor-pointer flex flex-col gap-2.5 xxl:gap-2 xl:gap-1.5 items-center justify-center w-full h-full rounded-[5px]">
              <img src="../../assets/svg/upload_photo.svg" class="w-7 xxl:w-6 xl:w-5" alt="">
              <span class="text-[#6435A5] text-[14px] xxl:text-[12px] xl:text-[10px] leading-none">Загрузить фото</span>
            </label>
            <input
              ref="photos"
              multiple class="w-full h-full rounded-full opacity-0 absolute top-0 left-0 pointer-events-none"
              id="image" type="file"
              @change="addPhotos"
            >
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="my-10 xxl:my-8 xl:my-6 w-full gap-10 xxl:gap-8 xl:gap-6" @click="save">
    <button class="login__btn--bg w-full font-semibold leading-none p-5 xxl:p-4 xl:p-3 text-lg xxl:text-[15px] xl:text-[13px] text-white bg-[#E84680] rounded-[6px]">Сохранить</button>
  </div>
</template>

<script>

export default {

  props: ['house'],
  data() {
    return {
      photos: [
        { name: '3D Рендеры', count: 0 },
        { name: 'Инфраструктура', count: 11 },
        { name: 'Дизайн', count: 15 },
        { name: 'Ход строительства', count: 7 },
      ],
      myPhotos: [],
      avatar: false,
      files: [],
    }
  },
  methods: {
    save() {
      let formData = new FormData();

      this.house.images.forEach(item => {
        console.log(item)
      })

      this.myPhotos.forEach(item => {
        this.files.push(item.file)
      })

      console.log(this.files)

      this.files.forEach((item, i) => {
        let file = this.files[i];
        // console.log(file)
        // if (item.url !== undefined) file = null
        // console.log(file)
        console.log(file)
        if (file.url !== undefined) {
          formData.append('files[' + i + ']', file.file);
          console.log(file.file)
        } else {
          console.log(file)
          formData.append('files[' + i + ']', file);
        }
        formData.append('house_id', this.house.id);
        formData.append('category_id', 0);
      })

      axios.post('/api/house/addedImages',
        formData,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
      ).then(res => {
        console.log(res);
      })
    },
    targetBlockPhoto(photo) {
      this.photos.forEach(item => item.active = 0)
      photo.active = 1
    },
    addPhotos(e) {
      Array.from(e.target.files).forEach((i) => {
        let formatBytes,
          bytes = i.size,
          decimals = 2
        if (bytes === 0) {
          formatBytes = 0
        } else {
          let k = 1024,
            dm = decimals < 0 ? 0 : decimals,
            sizes = ['байт', 'КБ', 'МБ', 'ГБ', 'ТБ'],
            it = Math.floor(Math.log(bytes) / Math.log(k))
          formatBytes = parseFloat((bytes / Math.pow(k, it)).toFixed(dm)) + ' ' + sizes[it]
        }
        this.myPhotos.push({ url: URL.createObjectURL(i), name: i.name, size: formatBytes, file: i })
      })
      setTimeout(() => {
        this.$refs.progressBar.forEach((i) => {
          i.style.display = 'none'
        })
      }, 1000)
      setTimeout(() => {
        this.$refs.uploudBackground.forEach((i) => {
          i.style.display = 'none'
        })
      }, 1000)
    },
    deletePhoto(photo) {
      this.myPhotos.forEach((item, idx) => {
        if (photo.url === item.url) {
          this.myPhotos.splice(idx, 1)
        }
      })
    }
  },
  created() {
    this.photos.forEach((item, idx) => {
      if (idx === 0) item.active = 1
      else item.active = 0
    })

    this.myPhotos = this.house.images

    setTimeout(() => {
      this.$refs.uploudBackground.forEach((i) => {
        i.style.display = 'none'
      })
    }, 10)
  },
}

</script>
