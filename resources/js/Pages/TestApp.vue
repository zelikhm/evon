<template>

  <input type="file" ref="image" alt="">
  <button v-on:click="saveImage">click</button>
</template>

<script>
  import {useForm} from '@inertiajs/inertia-vue3'
  export default {
    name: "TestApp",
    data() {
      return {
        image: [],
      }
    },
    methods: {
      saveImage() {

        const form = useForm({
          'image': this.$refs.image.files[0],
        });

        form.post('/test/image');

      }
    }
  }
</script>

<style scoped>

</style>
