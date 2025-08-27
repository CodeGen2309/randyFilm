<script setup>
  import upvote from '@/components/icons/upvote.vue';
  import { ref } from 'vue';

  const emit = defineEmits(['like', 'google', 'toggleChat', 'updateFilm', 'addhome'])
  const props = defineProps(['isInHome'])

  let upvoteColor = ref('#cd7066')

  function setGreen () {
    upvoteColor.value = '#27ae60'
    emit('like')
  }
</script>


<template>
<ul class="ctpanel">
  <li class="ctpanel--item" @click="$emit('addhome')"
    v-if="isInHome == 'missed'"
  >
    <img class="ctpanel--icon" src="/assets/icons/add-home.png">
  </li>


  <!-- <li class="ctpanel--item" v-if="isInHome != 'missed'" @click="emit('like')">
     <img class="ctpanel--icon" src="/assets/icons/like.svg">
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
    transition: .3s ease;
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
    object-fit: contain;
    object-position: center;
  }
</style>