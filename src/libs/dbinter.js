export default {
  address: 'http://192.168.1.6:3000',

  getPromts: async function (locale) {
    let res = await fetch(`${this.address}/get-promts/${locale}`)
    let promts = await res.json()
    return promts
  },


  getCachedFilm: async function (locale) {
    let link, res

    link = `${this.address}/get-cached-film/${locale}`
    res = await fetch(link)
    return await res.json()
  },


  sendPromt: async function (promt) {
    let opts, link, res

    opts = {
      method: 'POST', 
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ promt })
    }

    link = `${this.address}/send-promt/`
    res  = await fetch(link, opts)
    return await res.json()
  },


  saveFilm: async function (locale, title, poster, desc) {
    let link = `${this.address}/save-film/`

    let res = await fetch(link, { 
      method: 'POST', 
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({locale, title, poster, desc})
    })

    return await res.json()
  },


  reportFilm: async function () {  }
}