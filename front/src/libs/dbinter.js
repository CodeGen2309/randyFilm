export default {
  // address: 'http://176.194.115.56:3000',
  baseapi: '/api/base',
  botapi: '/api/neiro',

  getPromts: async function (locale) {
    let link = `${this.baseapi}/get-promts.php?locale=${locale}`
    let res = await fetch(link).then(raw => raw.json())
    
    return res
  },


  getCachedFilm: async function (locale) {
    let link = `${this.baseapi}/get-cached-film.php?locale=${locale}`
    let res = await fetch(link).then(raw => raw.json())

    return res
  },


  sendPromt: async function (message) {
    let opts, link, res

    opts = {
      method: 'POST', 
      headers: { "Content-type": "application/json" },
      body: JSON.stringify({message}),
    }

    link = `${this.botapi}/send-promt.php`
    res  = await fetch(link, opts).then(raw => raw.json())
    console.log(res);
    
    return res
  },


  saveFilm: async function (locale, title, poster, desc) {
    let link = `${this.baseapi}/save-film.php`

    let res = await fetch(link, { 
      method: 'POST', 
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({locale, title, poster, desc})
    })

    return await res.text()
  },


  reportFilm: async function () {  }
}
