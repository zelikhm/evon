<script>
export default {
  name: "ui-input-box",
  props:{
      title:{
          type:String,
          default:''
      }
  },
  data(){
    return{
      openSelectCity:false,
      selectValue:''
    }
  }
}
</script>

<template>
  <div class="input-box">
      <label>{{title}}</label>

    <div class="select-title">
      <span v-if="selectValue !== undefined"> </span>
      <img src='../../../assets/svg/arrow_down_black.svg' class="w-3 xxl:w-2.5 xl:w-2 transition-all"
           :class="{ 'rotate-180': openSelectCity }" alt="">
    </div>
  </div>

</template>

<style scoped>
.input-box{
    padding: 16px 20px;
    border: 1px solid rgb(229 223 238 );
    border-radius: 6px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
  label{
    font-size: 16px;
    color: rgb(138 137 150  );
}
   input{
    color: rgb(30 29 45 );
}
</style>
