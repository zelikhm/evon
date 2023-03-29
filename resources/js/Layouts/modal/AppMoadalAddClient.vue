<template>
    <div class="Modal"  >
        <div class="Modal_body">

        </div>

        <div class="Modal_bg" @click="closeAddClient"></div>

    </div>
</template>
  
<script>
export default {
    data() {
        return {}
    },
    emits: ['close-addClient'],
    methods: {
        closeAddClient() {
            this.$emit('close-addClient')
        }
    }
}
</script>
  
<style scoped>
.Modal {
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgb(0, 0, 0, 0.3);
    z-index: 100;
}
.Modal_bg{
    width: 100%;
    height: 100%;
    background-color: rgb(0, 0, 0, 0.3);
}
.Modal_body {
    width: 400px;
    height: 300px;
    background-color: white;
    border-radius: 16px;
    position: absolute;
    top: calc(50% - 170px);
    left: calc(50% - 220px);
    padding: 20px;
}
</style>
  
  