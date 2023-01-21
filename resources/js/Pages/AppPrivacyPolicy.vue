<template>
  <div class="flex flex-col min-h-[100vh]">
    <app-header />
    <main class="_container_policy">
      <div class="mt-14 xxl:mt-12 xl:mt-10 mb-20 xxl:">
        <h1 class="text-[#3B3A45] text-center pb-7 xxl:pb-5 xl:pb-4 text-3xl xxl:text-2xl xl:text-xl">Privacy policy</h1>
        <div>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dignissim sodales ut eu sem. Vulputate odio ut enim blandit volutpat maecenas volutpat blandit aliquam. Velit aliquet sagittis id consectetur. Eget felis eget nunc lobortis mattis aliquam faucibus purus in. Ut venenatis tellus in metus vulputate eu scelerisque felis. Mattis vulputate enim nulla aliquet porttitor. Integer malesuada nunc vel risus commodo. Facilisi cras fermentum odio eu feugiat. Sapien pellentesque habitant morbi tristique senectus. Ultrices sagittis orci a scelerisque purus semper eget. Pharetra pharetra massa massa ultricies.</p>
          <p class="text-[#8A8996] text-base xxl:text-sm xl:text-xs">Diam vulputate ut pharetra sit amet aliquam id. Donec ac odio tempor orci dapibus ultrices in. Augue interdum velit euismod in pellentesque massa placerat duis ultricies. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam. Hac habitasse platea dictumst quisque sagittis purus sit amet volutpat. Sit amet mauris commodo quis imperdiet massa tincidunt nunc. Nec feugiat nisl pretium fusce id velit. Tellus in hac habitasse platea dictumst vestibulum rhoncus est pellentesque. Imperdiet sed euismod nisi porta lorem mollis aliquam ut. Est ultricies integer quis auctor elit sed vulputate mi. Ac turpis egestas integer eget. Sed blandit libero volutpat sed cras ornare arcu. Nulla facilisi etiam dignissim diam quis enim lobortis. Ac feugiat sed lectus vestibulum mattis.</p>
        </div>
      </div>
    </main>
    <app-footer class="justify-self-end"/>
  </div>
</template>

<script>
import AppHeader from "../Layouts/AppHeader.vue"
import AppFooter from "../Layouts/AppFooter.vue"

export default {
  components: {
    AppHeader,
    AppFooter,
  }
}
</script>

<style scoped>

</style>
