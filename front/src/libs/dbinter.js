export default {
  address: 'http://176.194.115.56:3000',
  // address: '/api/',

  getPromts: async function (locale) {
    let res = await fetch(`${this.address}/get-promts/${locale}`)
    let promts = await res.json()
    return promts
  },


  getCachedFilm: async function (locale) {
    let link, res, midware, json

    // link = `${this.address}/get-cached-film/${locale}`
    link = `./api/`
    res = await fetch(link)
    midware = await res.json()
    json = JSON.parse(midware)

    console.log(json);

    return json
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