<script setup>
</script>


<template>
  <ul class="ctpanel">
    <li class="ctpanel--item" @click="$emit('like')">
      <img class="ctpanel--icon" src="/assets/icons/like.svg">
    </li>

    <!-- <li class="ctpanel--item">
      <img class="ctpanel--icon" src="/assets/icons/trailer.svg">
    </li> -->

    <li class="ctpanel--item" @click="$emit('google')">
      <img class="ctpanel--icon" src="/assets/icons/google.svg">
    </li>
    
    <li class="ctpanel--item" @click="$emit('toggleChat')">
      <img class="ctpanel--icon" src="/assets/icons/ai.svg">
    </li>
    

    <li class="ctpanel--item" @click="$emit('updateFilm')">
      <img class="ctpanel--icon" src="/assets/icons/another.svg">
    </li>
  </ul>
</template>


<style scoped>
  .ctpanel {
    display: flex;
    justify-content: space-between;

    background: white;
    padding: 10px 15px;
    box-sizing: border-box;
    overflow: hidden;

    padding: 0;
    list-style: none;
  }

  .ctpanel--item {
    display: flex;
    justify-content: center;
    align-items: center;

    flex-grow: 1;
    padding: 15px;
    transition: .3s ease;
  }


  .ctpanel--item:hover {
    background: #fbc531;
  }

  .ctpanel--icon {
    width: 100%; height: 100%;
  }

</style>