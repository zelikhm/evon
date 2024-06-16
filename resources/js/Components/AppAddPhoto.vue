
<template>
  <div class="photo-grid">
    <div @click="targetBlockPhoto(item)" v-for="item in photos" :class="{ 'border-white': item.active !== 1 }" class="photo-banner">
      <span class="photo-banner-title">{{ item.name }}</span>
      <span class="photo-banner-count">{{ item.count }} {{ language.ob[37] }}</span>
    </div>
  </div>

  <div class="photo-section">
    <div :class="{'photo-grid-full' : myPhotos.length === 0}" class="photo-grid-full">
      <div v-for="(photo, idx) in myPhotos" :key="idx" class="photo-card">
        <div @click="deletePhoto(photo)" class="close-photo">
          <span></span>
          <span></span>
        </div>
        <div class="check-photo">
          <img src="../../assets/svg/check_icon.svg" alt="">
        </div>
        <div class="background-overlay"></div>
        <div class="photo-info">
          <div>
            <span>{{ photo.size }}</span>
          </div>
          <div class="progress-bar-container">
            <div class="progress-bar"></div>
          </div>
        </div>
        <img :src="photo.url ? (photo.isResize === 1 ? imageServiceUrl + photo.url : photo.url) : (photo.isResize === 1 ? imageServiceUrl + photo.name : photo.name)" alt="">
      </div>
      <div class="upload-card">
        <div>
          <label for="image" class="upload-label">
            <img src="../../assets/svg/upload_photo.svg" alt="">
            <span>{{ language.dob_kv_1[24] }}</span>
          </label>
          <input ref="photos" multiple id="image" type="file" class="upload-input" @change="addPhotos">
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: ['house', 'photos', 'language', 'token'],
  inject: ['user'],
  data() {
    return {
      myPhotos: [],
      avatar: false,
      files: [],
      category: 0,
      loader: false,
      image_count: 0,
      load_count: 0,
      imageServiceUrl: '',
    }
  },
  methods: {
    save(file, formatBytes) {
      let formData = new FormData();

      formData.append('image', file);
      formData.append('house_id', this.house.id);
      formData.append('category_id', this.category);
      formData.append('token', this.token);

      this.myPhotos.push({url: URL.createObjectURL(file), name: file.name, size: formatBytes, file: file})

      axios.post('/api/house/addedImages',
        formData,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
      ).then(res => {
        this.house.images.push({
          id: 15,
          name: res.data,
          house_id: this.house.id,
          category: this.category,
        });

        this.load_count += 1;

        if (this.load_count === this.image_count) {
          this.$emit('loader', false);
        }
      })

      this.photos.forEach((item, idx) => {
        item.count = this.house.images.filter(i => i.category === idx).length
      })
    },
    targetBlockPhoto(photo) {
      this.photos.forEach(item => item.active = 0)
      photo.active = 1

      this.category = photo.id;

      this.loadPhotos();
    },
    addPhotos(e) {
      this.$emit('loader', true);
      this.image_count = e.target.files.length;
      this.load_count = 0;

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

        this.save(i, formatBytes);
      })

      setTimeout(() => {
        this.$refs.progressBar.forEach((i) => {
          i.style.display = 'none'
        })
      }, 1000)
      setTimeout(() => {
        if (this.$refs.uploudBackground !== undefined) {
          this.$refs.uploudBackground.forEach((i) => {
            i.style.display = 'none'
          })
        }
      }, 1000)
    },
    deletePhoto(photo) {
      this.myPhotos.forEach((item, idx) => {
        if (photo.name === item.name) {
          this.myPhotos.splice(idx, 1)
        }
      })

      axios.post('/api/house/deletedImage', {
        house_id: this.house.id,
        image_name: photo.name,
        token: this.token
      }).then(res => {
        console.log('delete')
      })


    },
    loadPhotos() {
      this.myPhotos = [];

      this.house?.images?.forEach(item => {
        if (this.category === item.category) {
          this.myPhotos.push(item);
        }
      })

      this.photos?.forEach((item, idx) => {
        item.count = this.house?.images?.filter(i => i.category === idx).length
      })

      setTimeout(() => {
        this.$refs.uploudBackground.forEach((i) => {
          i.style.display = 'none'
        })
      }, 10)
    },
  },
  created() {
    this.loadPhotos();
    this.imageServiceUrl = this.$service;

    this.photos.forEach((item, idx) => {
      if (idx === 0) item.active = 1
      else item.active = 0
    })


    // this.myPhotos = this.house.images

    setTimeout(() => {
      this.$refs.uploudBackground.forEach((i) => {
        i.style.display = 'none'
      })
    }, 10)
  },
}

</script>


<style scoped>
.photo-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}

@media (max-width: 1024px) {
  .photo-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

.photo-banner {
  cursor: pointer;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
  border: 1px solid #6435A5;
  border-radius: 5px;
  box-shadow: 0px 8px 60px rgba(52, 23, 94, 0.08)
}

.photo-banner.border-white {
  border-color: white;
}

.photo-banner-title {
  color: #1E1D2D;
  font-size: 17px;
  line-height: 1;
}

.photo-banner-count {
  color: #8A8996;
  font-size: 14px;
  line-height: 1;
}

.photo-section {
  margin: 0px 0;
  margin-top: 10px;
}

.photo-grid-full {
  display: flex;
  grid-template-columns: repeat(5, 1fr);
  gap: 8px;
  background-color: #F6F3FA;
  padding: 4px;
  border-radius: 5px;
  align-items: center;
  justify-content: center;
  min-height: 176px;
}

@media (max-width: 768px) {
  .photo-grid-full {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media (max-width: 640px) {
  .photo-grid-full {
    grid-template-columns: repeat(2, 1fr);
  }
}

.photo-card {
  position: relative;
  width: 100%;
  height: 163px;
  border-radius: 5px;
}

.photo-card .close-photo,
.photo-card .check-photo {
  position: absolute;
  top: 0;
  z-index: 20;
  margin: 4px;
  width: 24px;
  height: 24px;
  border-radius: 3px;
}

.close-photo {
  right: 0;
  cursor: pointer;
}

.close-photo::before,
.close-photo::after {
  content: '';
  position: absolute;
  width: 80%;
  height: 2px;
  background: white;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 10px;
}

.close-photo::before {
  transform: translate(-50%, -50%) rotate(45deg);
}

.close-photo::after {
  transform: translate(-50%, -50%) rotate(-45deg);
}

.check-photo {
  left: 0;
  background-color: #30CB49;
}

.check-photo img {
  width: 100%;
}

.photo-card .background-overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: #6435A5;
  border-radius: 5px;
  z-index: 10;
}

.photo-card .photo-info {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 8px;
  width: 100%;
  z-index: 20;
  overflow: hidden;
}

.photo-card .photo-info span {
  display: block;
  color: white;
  font-size: 14px;
  font-weight: 500;
  line-height: 1;
}

.photo-card .progress-bar-container {
  height: 10px;
  width: 100%;
  background-color: white;
  border-radius: 100px;
}

.photo-card img {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 5px;
}

.upload-card {
  position: relative;
  width: fit-content;
  height: fit-content;
  border: 0px solid #E5DFEE;
  border-radius: 5px;
}

.upload-card label {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  border-radius: 5px;
  cursor: pointer;
  background-color: #F6F3FA;
}

.upload-card img {
  width: 28px;
}

.upload-card span {
  color: #6435A5;
  font-size: 14px;
  line-height: 1;
}

.upload-input {
  width: 100%;
  height: 100%;
  border-radius: 5px;
  opacity: 0;
  position: absolute;
  top: 0;
  left: 0;
  pointer-events: none;
}
</style>


