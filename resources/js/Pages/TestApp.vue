<template>
  <div class="Image-input__input-wrapper">
    Заменить изображение
<!--    <input @change="saveImage()" class="Image-input__input" name="thumbnail" ref="file" type="file">-->
    <input type="file" name="file" ref="file" id="file-field" multiple="true" />

    <button v-on:click="saveImage()">
add
    </button>

  </div>
</template>

<script>
    export default {
        name: "TestApp",
      methods: {
        saveImage() {
          console.log(1);
          let formData = new FormData();

          for (let i = 0;this.$refs.file.files.length > i; i++) {
            formData.append('image', this.$refs.file.files[i]);
            formData.append('house_id', 1);
            formData.append('category_id', 1);

            axios({
              method: "post",
              url: "/api/house/addedImages",
              headers: {"Content-type": "multipart/form-data"},
              data: formData,
            }).then(res => {
              console.log(res.data);
            })
          }
        }
      }
    }
</script>

<style scoped>

</style>
