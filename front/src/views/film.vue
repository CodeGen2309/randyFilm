<script setup>
  import { onMounted, ref } from 'vue';
  import dbase from '../libs/dbinter.js'
  import contPane from '../components/controlPanel.vue'
  import FadingRect from '@/components/loaders/fadingRect.vue';

  let promts
  let isHandShake = false
  let locale      = 'en'

  let title       = ref()
  let poster      = ref()
  let desc        = ref()
  let currMessage = ref()
  
  let showLoader  = ref( false )
  let chatIsOn    = ref( false )




  function setFilm (data) {
    title.value  = data.title
    poster.value = data.poster
    desc.value   = data.desc
  }


  async function anotherFilm () {
    let promt, res

    promt = `${promts.another} ${promts.formatter}`

    if (!isHandShake) {
      promt = `${promts.welcome} ${promts.formatter}`
      isHandShake = true
    }

    showLoader.value = true
    res  = await dbase.sendPromt(promt)
    showLoader.value = false
    setFilm(res)
  }


  async function saveFilm () {
    let req = await dbase.saveFilm(locale, title.value, poster.value, desc.value)
    console.log(req);
    return req
  }

  async function googleFilm () {
    let link = `https://www.google.com/search?q=${title.value} film watch online`
    window.open(link)
  }

  async function toggleChat () {
    chatIsOn.value = !chatIsOn.value
  }


  async function sendMessage () {
    let promt, res

    promt = currMessage.value
    chatIsOn.value = false
    currMessage.value = ''

    showLoader.value = true
    res  = await dbase.sendPromt(promt)
    showLoader.value = false

    setFilm(res)
  }


  onMounted(async () => {
    // { id, locale, start_promt, another_promt, trailer}
    let film = await dbase.getCachedFilm(locale)
    promts = await dbase.getPromts(locale)

    console.log(promts);

    title.value = film.title
    poster.value = film.poster
    desc.value = film.desc
  })

</script>

<template>
  <section class="rf">
    <!-- <div class="rf--ad">Здесь будет реклама</div> -->

    <div class="rf--film">
      <div class="rf--cover"></div>

      <div class="rf--poster">
        <img class="rf--posterImg" :src="poster" >
      </div>

      <div class="rf--content rfcont">
        <div class="rfcont--wspace"></div>

        <div class="rfcont--text">
          <p class="rf--title">{{ title }}</p>
          <hr><hr>
          <p class="rf--desc">{{ desc }}</p>
        </div>
      </div>

      <contPane class="rf--controlsList" 
        @updateFilm="anotherFilm" @like="saveFilm"
        @toggleChat="toggleChat"  @google="googleFilm"
      ></contPane>

      <transition name="fadeDownAnim">
        <form @submit.prevent="sendMessage" class="rf--chat" v-show="chatIsOn">
          <input class="rf--chatInput" v-model="currMessage" 
            type="textarea"
          >
          <input class="rf--chatSend" type="submit" value="SEND">
        </form>
      </transition>


      <transition name="fadeInAnim">
        <div v-if="showLoader" class="rf--loader">
          <FadingRect class="rf--loaderIcon"></FadingRect>
        </div>
      </transition>
    </div>

  </section>
</template>

<style scoped>
  .rf {
    position: relative;
    
    display: flex;
    flex-direction: column;

    font-size: 1rem;
    width: 100%; 
    height: 100vh;
    max-height: 100dvh;
    max-width: 500px;
    margin: auto;
  }


  .rf--film {
    position: relative;
    flex-grow: 1;
    overflow: hidden;

    box-sizing: border-box;
  }

  .rf--loader {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, .8);
    opacity: 1;
    transition: .3s;
  }


  .rf--menu {
    position: absolute;
    display: flex;

    margin: 10px;
    padding: 10px;
    box-sizing: border-box;
    border-radius: 10px;

    top: 0; left: 0;
    width: 50px; height: 50px;
    background: white;
  }


  .rf--content {}

  .rfcont {
    position: absolute;
    left: 0; top: 0;
    height: 100%;
    width: 100%;
    overflow: scroll;

    color: white;
  }

  .rfcont::-webkit-scrollbar {
    display: none;
  }

  .rfcont--wspace {
    width: 100vw;
    height: 70%;
  }

  .rfcont--text {
    position: relative;
    background: rgba(0, 0, 0, .8);
    padding: 20px;
    box-sizing: border-box;
    overflow: hidden;
    padding-bottom: 70px;
    letter-spacing: 2px;
    line-height: 1.5rem;
  }

  .rf--title {
    margin: 20px 0;
    font-size: 2rem;
    line-height: 2rem;
  }


  .rf--desc {
  }


  .rf--controlsList {
    position: absolute;
    bottom: 0; left: 0;
    right: 0;

    margin: 10px;
    border-radius: 10px;
    box-sizing: border-box;

    height: 60px;
  }


  .rf--cover {
    display: none;
  }


  .rf--poster {
    position: absolute;
    top: 0; left: 0;
    bottom: 0; right: 0;
    width: 100%; height: 100%;
  }


  .rf--posterImg {
    width: 100%; height: 100%;

    object-fit: cover;
    object-position: center;
  }

  .rf--ad {
    display: flex;
    justify-content: center;
    align-items: center;

    text-align: center;
    box-sizing: border-box;
    height: 80px;

    margin: 0; padding: 0;
  }

  .rf--chat {
    position: absolute;
    top: 0; left: 0; right: 0;
    margin: 10px;
  
    
    display: flex;
    flex-direction: column;
    gap: 10px;
    /* overflow: hidden; */

    height: 150px;
    transition: .3s;
  }


  .rf--chatSend {
    position: relative;
    color: white;
    border: none;
    background: #C02942;
    border-radius: 10px;
    padding: 10px;
    font-weight: 600;
    font-size: 1rem;
  }


  .rf--chatInput {
    flex-grow: 1;
    border: none;
    outline: none;
    background: rgba(255, 255, 255, .6);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    box-shadow: 1px 1px 120px 2px rgba(0, 0, 0, .6);
    
    font-size: 1rem;
    padding: 10px;
    opacity: 1;
    transition: .3s;
  }

  .rf--chatInput:focus {
    background: rgba(255, 255, 255, 1);
  }


  .fadeInAnim-enter-active, .fadeInAnim-leave-active {
    opacity: 0;
    backdrop-filter: blur(20px);
    transform: scale(2);
  }

  .fadeDownAnim-enter-active, .fadeDownAnim-leave-active {
    opacity: 0;
    transform: translateY(-50px);
    backdrop-filter: blur(0px);
  }

</style>
