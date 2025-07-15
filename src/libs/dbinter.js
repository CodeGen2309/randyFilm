export default class {
  constructor () {
    this.address = 'http://192.168.1.6:3000'
    this.pormts
  }

  async getPromts (locale) {
    let res = await fetch(`${this.address}/get-promts/${locale}`)
    let promts = await res.json()
    return promts
  }


  async getCachedFilm () {
    let link, res

    link = `${this.address}/get-cached-film/ru`
    res = await fetch(link)
    return await res.json()
  }


  async sendPromt (promt) {
    let link, res

    link = `${this.address}/send-promt/`

    res = await fetch(link, { 
      method: 'POST', 
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        "promt": promt
      })
    })

    return await res.json()
  }


  async reportFilm () {  }
}