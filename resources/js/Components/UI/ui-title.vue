<template>
  <component :is="tag">{{ title }}</component>
</template>

<script>
export default {
  name: "Title",
  props: {
    title: {
      type: String,
      default: ''
    },
    type: {
      type: Number,
      default: 1,
      validator: value => [1, 2, 3, 4, 5, 6].includes(value)
    }
  },
  computed: {
    tag() {
      return `h${this.type}`;
    }
  }
}
</script>

<style scoped>
h2 {
  font-weight: 600;
  font-size: 22px;
}
h3 {
  font-weight: 600;
  font-size: 18px;
}
</style>
