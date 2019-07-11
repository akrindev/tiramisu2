
// potensi kalkulator
var app = new Vue({
  el: '#app',
  data: {
    str: 1,
    int: 1,
    vit: 1,
    dex: 1,
    agi: 1,
    pedang: 1,
    pedangraya: 1,
    bow: 1,
    bowgun: 1,
    tongkat: 1,
    md: 1,
    tombak: 1,
    katana: 1,
    zirah: 1
  },
  watch: {
    str() {
      this.pedang = this.bow = this.getPot(this.str)+this.getPot(this.dex)
      this.pedangraya = this.getPot(this.str, true)
      this.tombak = this.getPot(this.str) + this.getPot(this.agi)
    },
    dex() {
      this.pedang = this.bow = this.getPot(this.str)+this.getPot(this.dex)
      this.bowgun = this.getPot(this.dex, true)
      this.katana = this.getPot(this.dex) + this.getPot(this.agi)
    },
    int() {
      this.tongkat = this.getPot(this.int, true)
      this.md = this.getPot(this.agi) + this.getPot(this.int)
    },
    agi() {
      this.katana = this.getPot(this.dex) + this.getPot(this.agi)
      this.tombak = this.getPot(this.str) + this.getPot(this.agi)
      this.tinju = this.getPot(this.agi, true)
      this.md = this.getPot(this.agi) + this.getPot(this.int)
    },
    vit() {
      this.zirah = this.getPot(this.vit, true)
    }

  },
  methods: {
    getPot(stat, bonus = false) {
      stat = Number(stat)

      if(bonus) {
        return Number(Math.floor(stat/20)*2)
      }

      return Number(Math.floor(stat/20))
    }
  }
});