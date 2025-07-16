<script setup>
  import { onMounted, ref } from 'vue';
  import dbase from '../libs/dbinter.js'
  import contPane from '../components/controlPanel.vue'

  let promts
  let isHandShake = false
  let locale = 'ru'

  let title = ref()
  let poster = ref()
  let desc = ref()
  let chatIsOn = ref(false)
  let currMessage = ref()



  function setFilm (data) {
    console.log(data);

    title.value = data.title
    poster.value = data.poster
    desc.value = data.desc
  }


  async function anotherFilm () {
    let promt, res

    promt = `${promts.another} ${promts.formatter}`

    if (!isHandShake) {
      promt = `${promts.welcome} ${promts.formatter}`
      isHandShake = true
    }

    console.log(promt);

    res  = await dbase.sendPromt(promt)
    setFilm(res)
  }


  async function saveFilm () {
    let req = await dbase.saveFilm(locale, title.value, poster.value, desc.value)
    console.log(req);
    return req
  }


  async function toggleChat () {
    chatIsOn.value = !chatIsOn.value
  }


  async function sendMessage () {
    let promt, res

    promt = `${currMessage.value} ${promts.formatter}`
    chatIsOn.value = false
    currMessage.value = ''

    console.log(promt);

    res  = await dbase.sendPromt(promt)
    console.log(res);
    setFilm(res)
  }


  onMounted(async () => {
    // { id, locale, start_promt, another_promt, trailer}
    promts = await dbase.getPromts(locale)
    console.log(promts);

    let film = await dbase.getCachedFilm(locale)

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

      <div class="rf--menu">
        <img src="/assets/icons/donut.svg">
      </div>

      <contPane class="rf--controlsList" 
        @updateFilm="anotherFilm"
        @like="saveFilm"
        @toggleChat="toggleChat"
      ></contPane>

      <form @submit.prevent="sendMessage" class="rf--chat" v-show="chatIsOn">
        <input
          class="rf--chatInput" v-model="currMessage"
          type="textarea"  cols="30" rows="10" wrap="soft"
        >
        <input class="rf--chatSend" type="submit" value="Отправить">
      </form>
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
  }


  .rf--film {
    position: relative;
    flex-grow: 1;
    overflow: hidden;

    box-sizing: border-box;
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
    gap: 4px;
    border-radius: 10px;
    overflow: hidden;

    height: 100px;
  }


  .rf--chatSend {
    color: white;
    border: none;
    background: green;
    padding: 10px;
    font-weight: 600;
    font-size: 1rem;
  }


  .rf--chatInput {
    flex-grow: 1;
    border: none;
    outline: none;
    background: rgba(255, 255, 255, .9);

    font-size: 1rem;
    padding: 10px;
  }
</style>
