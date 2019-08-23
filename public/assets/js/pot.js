/**
* potensi kalkulator
* version v1.1
*/

var app = new Vue({
  el: '#app',
  data: {
    str: 1,
    int: 1,
    vit: 1,
    dex: 1,
    agi: 1
  },
  computed: {
    pedang: function() {
      return this.getPot(this.add(this.str, this.dex))
    },
    pedangraya: function() {
      return this.getPot(this.str, true)
    },
    bow: function() {
      return this.getPot(this.add(this.str, this.dex))
    },
    bowgun: function() {
      return this.getPot(this.dex, true)
    },
    tongkat: function() {
      return this.getPot(this.int, true)
    },
    md: function() {
      return this.getPot(this.add(this.agi, this.int))
    },
    tinju: function() {
      return this.getPot(this.agi, true)
    },
    tombak: function() {
      return this.getPot(this.add(this.str, this.agi))
    },
    katana: function() {
      return this.getPot(this.add(this.dex, this.agi))
    },
    zirah: function() {
      return this.getPot(this.vit, true)
    }
  },
  methods: {
    getPot(stat, bonus = false) {
      stat = Number(stat)

      if(bonus) {
        return Number(Math.floor((stat/20)*2))
      }

      return Number(Math.floor(stat/20))
    },
    add(a, b) {
      a = Number(a)
      b = Number(b)
      var c = a+b
      return Number(c)
    }
  }
});