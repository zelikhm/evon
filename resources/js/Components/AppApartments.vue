<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
  <div class="main-container">
    <div class="frames-grid">
      <div
        @click="targetFrame(frame, idx)"
        v-for="(frame, idx) in house?.frames"
        :class="{ 'border-white': frame.active !== 1 }"
        class="frame-item"
      >
        <div class="frame-details">
          <span class="frame-name">{{ frame.name }}</span>
          <span class="frame-flats" v-if="frame.flats">{{ frame.flats.length }} {{ frame.flats.length === 1 ? language.dob_kv_1[15] : frame.flats.length === 2 || frame.flats.length === 3 || frame.flats.length === 4 ? language.dob_kv_1[16] : language.dob_kv_1[17] }}</span>
          <span class="frame-flats" v-else>0 {{language.dob_kv_1[17]}}</span>
        </div>
        <div class="frame-actions">
          <button @click="$emit('open-add-frame', frame)">
            <img class="action-icon" src="../../assets/svg/pen_icon_grey.svg" alt="">
          </button>
          <button @click="deleteConfirmOn(frame)" class="relative">
            <img class="action-icon" src="../../assets/svg/bucket_icon_red.svg" alt="">
          </button>
          <div v-if="frame.deleteConfirm" class="delete-confirm">
            <span class="confirm-text">Вы уверены что хотите удалить?</span>
            <div class="confirm-actions">
              <div class="confirm-yes" @click="deleteFrame(frame)">Да</div>
              <div class="confirm-no" @click="frame.deleteConfirm = false">Нет</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flats-grid">
      <div class="flats-header">
        <div class="flats-header-item" v-for="item in titleTable">
          <span>{{ item.title }}</span>
          <div v-if="item.filter" @click="changeFilter(item)" class="filter-icons">
            <svg class="filter-icon" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path :class="{ 'fill-[#6435A5]': item.active === 1 }" d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
            <svg class="filter-icon" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path :class="{ 'fill-[#6435A5]': item.active === 2 }" d="M4.5 7L8.39711 0.25H0.602886L4.5 7Z" fill="#E5DFEE"/>
            </svg>
          </div>
        </div>
      </div>
      <div v-for="item in 6"   class="flat-item">
        <div class="flat-details">
          <div>вфывфывфывфыв</div>
          <div>вфывфывфывфыв</div>
          <div>вфывфывфывфыв</div>
          <div>вфывфывфывфыв</div>
          <div>вфывфывфывфыв</div>
          <div class="status-container" :tabindex="tabindex" @blur="item.statusActive = false">
            <div @click="item.statusActive = !item.statusActive" class="status-toggle">
              <span> asdasdasdasdasd</span>
              <svg class="status-icon" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.00005 3.879L8.71255 0.166504L9.77305 1.227L5.00005 6L0.227051 1.227L1.28755 0.166504L5.00005 3.879Z" fill="#8A8996"/>
              </svg>
            </div>
            <div v-if="item.statusActive" class="status-options">
              <span @click="changeSelectStatus(status, item)" v-for="status in statuses" class="status-option">{{ status.status }}</span>
            </div>
          </div>
        </div>
        <div class="flat-actions">
          <button class="edit-button">
            <img @click="editFlat(item)" src="../../assets/svg/pen_icon_grey.svg" class="action-icon" alt="">
          </button>
          <button @click="deleteFlat(item)" class="delete-button">
            <img src="../../assets/svg/bucket_icon_grey.svg" class="action-icon" alt="">
          </button>
        </div>
      </div>
<!--      <div v-for="item in house?.frames[frameId]?.flats" v-if="house?.frames?.length > 0" class="flat-item">-->
<!--        <div class="flat-details">-->
<!--          <div>{{ item.number }}</div>-->
<!--          <div>{{ item.square }}</div>-->
<!--          <div>{{ item.price }}</div>-->
<!--          <div>{{ item.count }}</div>-->
<!--          <div>{{ item.floor }}</div>-->
<!--          <div class="status-container" :tabindex="tabindex" @blur="item.statusActive = false">-->
<!--            <div @click="item.statusActive = !item.statusActive" class="status-toggle">-->
<!--              <span>{{ item.status == 0 ? language.dob_kv_1[10] : item.status == 1 ? language.dob_kv_1[11] : item.status == 2 ? language.dob_kv_1[12] : item.status == 3 ? language.dob_kv_1[13] : language.dob_kv_1[9] }}</span>-->
<!--              <svg class="status-icon" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                <path d="M5.00005 3.879L8.71255 0.166504L9.77305 1.227L5.00005 6L0.227051 1.227L1.28755 0.166504L5.00005 3.879Z" fill="#8A8996"/>-->
<!--              </svg>-->
<!--            </div>-->
<!--            <div v-if="item.statusActive" class="status-options">-->
<!--              <span @click="changeSelectStatus(status, item)" v-for="status in statuses" class="status-option">{{ status.status }}</span>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="flat-actions">-->
<!--          <button class="edit-button">-->
<!--            <img @click="editFlat(item)" src="../../assets/svg/pen_icon_grey.svg" class="action-icon" alt="">-->
<!--          </button>-->
<!--          <button @click="deleteFlat(item)" class="delete-button">-->
<!--            <img src="../../assets/svg/bucket_icon_grey.svg" class="action-icon" alt="">-->
<!--          </button>-->
<!--        </div>-->
<!--      </div>-->
    </div>
  </div>
</template>

<script>

export default {
  props: ['house', 'language', 'statuses', 'titleTable', 'token'],
  emits: ['open-add-frame'],
  inject:['user'],
  data() {
    return {
      deleteConfirm: false,
      selectStatus: 0,
      id: null,
      openStatus: false,
      flats: null,
      frameId: 0,
      isEdit: false,
      tabindex: {
        type: Number,
        required: false,
        default: 0,
      },
    }
  },
  methods: {
    editFlat(item) {
      this.$emit('edit-flat', item)
    },
    changeSelectStatus(status, item) {
      item.status = status.id
      item.statusActive = !item.statusActive

      axios.post('/api/house/editStatusFlat', {
        house_id: this.house.id,
        flat_id: item.id,
        status: item.status,
        token: this.token
      }).then(response => console.log(response.data))
    },
    targetFrame(frame, idx) {
      this.house.frames.forEach(item => item.active = 0)
      frame.active = 1
      this.$emit('change-frame', frame.id)
      this.frameId = idx
      this.titleTable.forEach(item => item.active = 0)
    },
    changeFilter(item) {
      item.active += 1

      if (item.active > 2) {
        item.active = 0
      }

      this.filter(item, 'id')
      this.filter(item, 'square')
      this.filter(item, 'price')
      this.filter(item, 'floor')
    },
    filter(item, name) {
      if (item.name === name && item.active === 1) {
        this.house.frames[this.frameId].flats = this.house.frames[this.frameId].flats.sort((a, b) => a[name] - b[name])
      } else if (item.name === name && item.active === 2) {
        this.house.frames[this.frameId].flats = this.house.frames[this.frameId].flats.sort((a, b) => b[name] - a[name])
      }
    },
    deleteConfirmOn(frame) {
      this.house.frames.forEach(item => {
        item.deleteConfirm = false
      })
      frame.deleteConfirm = true
    },
    deleteFrame(frame) {
      this.house.frames.forEach((item, idx) => {
        if (frame.id === item.id) {
          this.house.frames.splice(idx, 1)
        }
      })

      axios.post('/api/house/deleteFrame', {
        frame_id: frame.id,
        token: this.token
      }).then(response => console.log(response.data))
    },
    deleteFlat(item) {
      axios.post('/api/house/deletedFlat', {
        flat_id: item.id,
        token: this.token
      }).then(response => console.log(response))

      this.house.frames.forEach((i, index) => {
        i.flats.forEach((flat, idx) => {
          if (flat.id === item.id) {
            this.house.frames[index].flats.splice(idx, 1)
          }
        })
      })
    }
  },
  created() {
    let link = +window.location.href.split('/').at(-1)

    if (Number.isInteger(link)) {
      this.isEdit = true
    }


    if (this.house?.frames?.length > 0) {
      let startFrame = this.house.frames[0].id

      this.house.frames.forEach((item, idx) => {
        if (idx === 0) {
          // this.frameId = item.id
          item.active = 1
        }
        else {
          item.active = 0
        }
      })
      this.$emit('change-frame', startFrame)

      this.house.frames.forEach(item => {
        if (item.flats) {
          item.statusActive = 0
        }
        item.deleteConfirm = false
      })
    }

  },
  updated() {
    if (this.house.frames.length === 1) {
      this.house.frames[0].active = 1
    }

    this.house.frames.forEach((item, idx) => {
      if (item.active === 1) {
        this.frameId = idx
      }
    })
  },
  watch: {
  }
}

</script>


<style scoped>
.main-container {
  display: flex;
  flex-direction: column;
}

.frames-grid {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 12px;
}

@media (max-width: 1024px) {
  .frames-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media (max-width: 640px) {
  .frames-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

.frame-item {
  display: flex;
  justify-content: space-between;
  cursor: pointer;
  border: 1px solid #6435A5;
  border-radius: 5px;
  padding: 20px 20px;
}

.frame-details {
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 14px;
}

.frame-name {
  color: #1E1D2D;
  font-size: 16px;
  white-space: nowrap;
}

.frame-flats {
  color: #8A8996;
  font-size: 14px;
  white-space: nowrap;
}

.frame-actions {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 14px;
}

.action-icon {
  width: 20px;
}

.delete-confirm {
  position: absolute;
  top: 140%;
  background: white;
  border: 1px solid #CEC3DD;
  border-radius: 5px;
  z-index: 20;
  text-align: center;
  font-size: 16px;
}

.confirm-text {
  padding: 10px;
  border-bottom: 1px solid #CEC3DD;
}

.confirm-actions {
  display: flex;
}

.confirm-yes, .confirm-no {
  width: 100%;
  padding: 10px;
  cursor: pointer;
}

.confirm-yes {
  color: red;
  border-right: 1px solid #CEC3DD;
}

.confirm-no {
  color: green;
}

.flats-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 16px;
  margin-top: 0px;
  color: #1E1D2D;
  font-size: 16px;
}

.flats-header {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  background: white;
  padding: 20px;
}

.flats-header-item {
  display: flex;
  align-items: center;
  gap: 8px;
}

.filter-icons {
  display: flex;
  flex-direction: column;
  gap: 3px;
}
.filter-icons .filter-icon:first-child{
  transform: rotate(180deg);
}
.filter-icon {
  width: 9px;
  height: 7px;
  cursor: pointer;
}

.flat-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 56px;
  border: 1px solid #E5DFEE;
  border-radius: 5px;
  padding: 20px;
}

.flat-details {
  display: flex;
  width: 100%;
  gap: 16px;
  justify-content: space-between;
}

.status-container {
  position: relative;
}

.status-toggle {
  display: flex;
  align-items: center;
  gap: 20px;
  cursor: pointer;
}

.status-icon {
  width: 10px;
}

.status-options {
  position: absolute;
  top: 130%;
  left: 0;
  background: white;
  border: 1px solid #E5DFEE;
  border-radius: 5px;
  z-index: 20;
}

.status-option {
  padding: 10px 20px;
  cursor: pointer;
}

.flat-actions {
  display: flex;
  align-items: center;
  gap: 20px;
}

.edit-button, .delete-button {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 60px;
  height: 56px;
  border-right: 1px solid #E5DFEE;
}

.delete-button {
  border-right: none;
}
</style>
