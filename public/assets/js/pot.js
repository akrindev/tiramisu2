/**
* potensi kalkulator
* version v2.1
*/

var app = new Vue({
  el: '#app',
  data: {
    str: 1,
    int: 1,
    vit: 1,
    dex: 1,
    agi: 1,
    tech: 0,
    luk: 0,

    // FOOD
    foodDEX: 0,
    foodSTR: 0,

    // status weapon
    weapSTRflat: 0,
    weapSTRperc: 0,
    weapDEXflat: 0,
    weapDEXperc: 0,

    // subWeap
    subWeap: 0,

    // status zirah
    armSTRflat: 0,
    armSTRperc: 0,
    armDEXflat: 0,
    armDEXperc: 0,

    // additional
    additional: 0,

    // special
    special: 0,

    // status pandai besi
    lvKemahiranTempa: 0,
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
    },

    // total dex flat
    totalDEX: function() {
      return Number(this.dex)+Number(this.foodDEX)+Number(this.weapDEXflat)+Number(this.subWeap)+Number(this.armDEXflat)+Number(this.additional)+Number(this.special)
    },
    totalDEXperc: function() {
      return Number(this.weapDEXperc)+Number(this.armDEXperc)
    },

    totalSTR: function() {
      return Number(this.str)+Number(this.foodSTR)+Number(this.weapSTRflat)+Number(this.armSTRflat)
    },
    totalSTRperc: function () {
      return Number(this.weapSTRperc)+Number(this.armSTRperc)
    },

    // status pandai besi player
    kesulitanPemain: function() {
      let dexflat = Number(this.dex)+Number(this.foodDEX)+Number(this.weapDEXflat)+Number(this.subWeap)+Number(this.armDEXflat)+Number(this.additional)+Number(this.special)
      let dexperc = Number(this.weapDEXperc)+Number(this.armDEXperc)
      let dex = Number(dexflat)*(Number(dexperc)/100)

      let hasil = Number(this.tech/2)+Number(dex/6)+Number(this.lvKemahiranTempa)
      return hasil.toFixed(2)
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