<script setup>
  import upvote from '@/components/icons/upvote.vue';
  import { onMounted, ref } from 'vue';

  const emit = defineEmits(['like', 'google', 'toggleChat', 'updateFilm', 'addhome'])
  const props = defineProps(['isInHome'])

  let upvoteColor = ref('#cd7066')
  let aiShake = ref(false)

  function setGreen () {
    upvoteColor.value = '#27ae60'
    emit('like')
  }

  function toggleChat () {
    emit('toggleChat')
    aiShake.value = false
  }


  onMounted(() => {
    setTimeout(() => {
      aiShake.value = true
    }, 1500)
  })

</script>


<template>
<ul class="ctpanel">
  <button class="ctpanel--item ctpanel--home" @click="$emit('addhome')"  
    v-if="isInHome == 'missed'"
  >
    <img class="ctpanel--icon" src="/assets/icons/add-home.png">
  </button>


  <!-- <li class="ctpanel--item" v-if="isInHome != 'missed'" @click="emit('like')">
     <img class="ctpanel--icon" src="/assets/icons/like.svg">
  </li> -->

  <li class="ctpanel--item" @click="$emit('google')">
    <img class="ctpanel--icon" src="/assets/icons/google.svg">
  </li>

  <li class="ctpanel--item" @click="toggleChat">
    <img class="ctpanel--icon" :class="{shakeAnim: aiShake}" src="/assets/icons/ai.svg">
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

  .ctpanel--home {
    /* display: flex;
    justify-content: center;
    align-items: center; */
    flex-grow: 1;
  }

  .ctpanel--item {
    display: flex;
    justify-content: center;
    align-items: center;
    background: white;

    outline: none;
    border: none;

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


  .shakeAnim {
    animation: shake 1s ease infinite;
  }


  @keyframes shake {
    0% {
      transform: translateX(0px);
    }

    25% {
      transform: translateX(10px);
    }

    50% {
      transform: translateX(-10px);
    }

    75% {
      transform: translateX(10px);
    }

    100% {
      transform: translateX(0px);
    }
  }

</style>