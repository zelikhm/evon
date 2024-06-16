<script>
import {QuillEditor} from '@vueup/vue-quill'
export default {
  name: "DescriptionObject",
  components: {
    QuillEditor
  },
  props:{
    object:{
      type:Object,
      default:{}
    },
    title: {
      type: String,
      default: ''
    },
    type: {
      type: String,
      default: ''
    }
  }
}
</script>

<template>
  <label  >{{title}} ({{type}})  </label>
  <QuillEditor
      id="description_object"
      style="height: 280px!important;"
      class="custom__scroll text-[#1E1D2D] h-full resize-none text-lg xxl:text-[15px] xl:text-[13px] lg:text-[16px] px-5 xxl:px-4 xl:px-3 mb-5 xxl:mb-4 xl:mb-3 leading-none border-transparent focus:border-transparent focus:ring-0"
      toolbar="full"
      v-model:content="object.description"
      content-type="html"
      theme="snow"
  />
</template>

<style scoped>
label{
  display: block;
  font-size: 16px;
  color: rgb(138 137 150  );
}
</style>
