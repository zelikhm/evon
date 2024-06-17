<template>

  <label v-if="title">{{title}}</label>
  <button :class="{
    'red-tr':type==1,
    'red':type==2,
    'purple':type==3,
  }">
    <slot />
    {{name}}
  </button>
</template>

<script>
export default {
  name: "Title",
  props: {
    title: {
      type: String,
      default: null
    },
    name:{
      type: String,
      default: ''
    },
    type: {
      type: Number,
      default: null
    }
  },
}
</script>

<style scoped>
label{
  display: block;
  font-size: 16px;
  color: rgb(138 137 150  );
}
button{
  display: flex;
  align-items: center;
  gap: 4px;
  justify-content: center;
}
button.red-tr{
  position: relative;
  cursor: pointer;
  outline: none;
  display: block;
  text-decoration: none;
  font-size: 16px;
  vertical-align: middle;
  border: 2px solid rgb(232 70 128);
  color: rgb(232 70 128);
  text-align: center;
  border-radius: 4px;
  background-color: transparent;
  padding: 8px 20px;
  box-sizing: border-box;
  margin-top: 10px;
  transition: background-color 0.2s;
  max-width: 250px;
}
button.red-tr:hover{
   background: rgb(232 70 128);
  color: white;
}
button.red{
  position: relative;
  cursor: pointer;
  outline: none;
  display: block;
  text-decoration: none;
  font-size: 16px;
  vertical-align: middle;
  border: 2px solid rgb(232 70 128);
  text-align: center;
  border-radius: 4px;
  background-color: rgb(232 70 128);
  color: white;
  padding: 8px 20px;
  box-sizing: border-box;
  margin-top: 10px;
  transition: background-color 0.2s;
}
button.purple{
  position: relative;
  cursor: pointer;
  outline: none;
  text-decoration: none;
  font-size: 16px;
  vertical-align: middle;
  border: 1px solid #6435A5;
  text-align: center;
  border-radius: 4px;
  background-color: transparent;
  color: #6435A5;
  padding: 8px 20px;
  box-sizing: border-box;
  margin-top: 10px;
  transition: background-color 0.2s;
}
button.purple:hover{
  background:  #6435A5;
  color: white;
}
</style>
