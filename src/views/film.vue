<script setup>
  import { onMounted, ref } from 'vue';
  import db from '../libs/dbinter.js'
  import contPane from '../components/controlPanel.vue'

  let conn = new db()
  let promts

  let title = ref()
  let poster = ref()
  let desc = ref()


  function setFilm (data) {
    console.log(data);

    title.value = data.title
    poster.value = data.poster
    desc.value = data.desc
  }


  async function anotherFilm () {
    let testPromt = `
      Спасибо, обязательно посмотрю! Посоветуй что нибудь еще, веселый легкий фильм.
      Верни ответ строго в следующем формате: 
      { 
        'title' : название фильма или сериала, 
        'poster' : ссылка на картинку из фильма или сериала, ищи  картинку на сайте imdb.com 
        'desc' : описание фильма или сериала
      }
    `

    let res  = await conn.sendPromt(testPromt)
    let data = res[0]['output']
    setFilm(data)
  }


  onMounted(async () => {
    let film = await conn.getCachedFilm()
    title.value = film.title
    poster.value = film.poster
    desc.value = film.desc

    // { id, locale, start_promt, another_promt, trailer}
    promts = await conn.getPromts('ru')
    console.log(promts);
    
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
      ></contPane>
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
</style>
