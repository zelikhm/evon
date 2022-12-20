<template>
  <div class="Image-input__input-wrapper">
    Заменить изображение
    <!--    <input @change="saveImage()" class="Image-input__input" name="thumbnail" ref="file" type="file">-->
    <input type="file" name="file" ref="file" id="file-field" multiple="true"/>

    <input type="text" v-model="id">
    <input type="text" v-model="floors">
    <input type="text" v-model="statusHouse">
    <input type="text" v-model="type">

    <button v-on:click="saveImage()">
      add
    </button>

  </div>
</template>

<script>
  export default {
    name: "TestApp",
    data() {
      return {
        id: 0,
        statusHouse: '',
        floors: 0,
        type: 0,
        dop: '',
        info: '',
        toSea: 0,
        toSchool: 0,
        toShop: 0,
        toPark: 0,
        toBus: 0,
        toChildrenSchool: 0,
      }
    },
    methods: {
      saveImage() {
        let formData = new FormData();

        // for (let i = 0;this.$refs.file.files.length > i; i++) {
        formData.append('image', this.$refs.file.files[0]);
        formData.append('statusHouse', this.statusHouse);
        formData.append('house_id', 1);
        formData.append('floors', this.floors);
        formData.append('type', this.type);
        formData.append('dop', this.dop);
        formData.append('info', this.info);
        formData.append('toSea', this.toSea);
        formData.append('toSchool', this.toSchool);
        formData.append('toShop', this.toShop);
        formData.append('toPark', this.toPark);
        formData.append('toBus', this.toBus);
        formData.append('toChildrenSchool', this.toChildrenSchool);
        formData.append('token', '6f8be2a8db029ec86bd40833acbbd0c5');

        axios({
          method: "post",
          url: "/api/house/create",
          headers: {"Content-type": "multipart/form-data"},
          data: formData,
        }).then(res => {
          console.log(res.data);
        })
        // }
      }
    }
  }
</script>

<style scoped>

</style>
