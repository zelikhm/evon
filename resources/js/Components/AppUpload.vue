<template>
  <n-upload
    action="https://www.mocky.io/v2/5e4bafc63100007100d8b70f"
    :default-file-list="fileList"
    list-type="image-card"
    accept=".svg, .png, .jpg"
    multiple
  >
    <div class="flex flex-col gap-3 xxl:gap-2.5 xl:gap-2">
      <img src="../../assets/svg/upload_photo.svg" class="h-7 xxl:h-6 xl:h-4" alt="">
      <span class="text-[#6435A5]">Загрузить фото</span>
    </div>
  </n-upload>
</template>

<script>
import { NUpload } from 'naive-ui'

export default {
  data() {
    return {

    }
  },
  methods: {

  },
  components: { NUpload }
}

</script>
