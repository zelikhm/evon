<script>
export default {
  name: "SalesContacts",
  props: {
    supports:{
      type:Object,
      default:{}
    }
  },
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
}
</script>

<template>
  <div v-for="item in 10" class="row-contact">
    <div class="contact">
      <img v-if="item?.avatar?.length > 17" :src="item?.avatar" class="  " alt="">
      <img v-else src="../../../assets/no-img-houses.jpg" class="  " alt="">
      <span class="name">dasdasdasd</span>
    </div>
    <span class="phone ">asdasdasd</span>
    <span class="email ">asdasdasd</span>
    <div class="tools">
      <button @click="this.$emit('open-edit-contact', item)">
        <img  src="../../../assets/svg/pen_icon_grey.svg" class=" " alt="">
      </button>
      <button @click="deleteSupport(item)">
        <img  src="../../../assets/svg/bucket_icon_red.svg" class=" " alt="">
      </button>
    </div>
  </div>
</template>

<style scoped>
.row-contact{
  display: grid;
  grid-template-columns: 0.5fr 0.4fr 1.2fr auto;
  align-items: center;
  box-shadow: 0px 8px 60px rgba(52, 23, 94, 0.05);
  padding: 6px;
}
.row-contact .contact{
  display: flex;
  gap: 20px;
  align-items: center;
}
.tools{
  display: flex;
  gap: 15px;
  align-items: center;
}
.tools button{
  cursor: pointer;
}
.row-contact .contact img{
  width: 48px;
  height: 48px;
  border-radius: 50%;
}
</style>
