
const app = new Vue({
  el: "#vue-root",
  data() {
    return {
      hnc: 16000,
      hbnut: 5000,
      hnwood: 4000,
      lvnow: 25,
      lvperc: 0,
      lvtarget: 190,

      // required exp
    //  lastExp: 0,
      lastNc: '',
      lastBnut: '',
      lastNwood: '',

      // required spina
      spinaNc: '',
      spinaBnut: '',
      spinaNwood: '',

      // required quest
      // quest arwah peneliti
      q1: '',
      q2: '',
      q3: '',
      q4: '',
      q5: '',
      q6: '',
      q7: '',
      q8: '',

    }
  },
  computed: {
    lastExp: function() {
      var exp = ((Number(this.lvnow)**4)/40)*(1-Number(this.lvperc)/100)+(((Number(this.lvtarget)-1)*(2*(Number(this.lvtarget)-1)+1)*Number(this.lvtarget)*(3*(Number(this.lvtarget)-1)**2+3*(Number(this.lvtarget)-1)-1))-Number(this.lvnow)*(2*Number(this.lvnow)+1)*(Number(this.lvnow)+1)*(3*Number(this.lvnow)**2+3*Number(this.lvnow)-1))/1200+((2*Number(this.lvnow))*(1-Number(this.lvperc)/100))+((Number(this.lvtarget)-1)*Number(this.lvtarget)-Number(this.lvnow)*(Number(this.lvnow)+1));

      return Math.trunc(exp)
    }
  },
  methods: {
    kalkulasi() {

      if(this.lvnow >= this.lvtarget) {
        alert('Nilai Level sekarang > level target')
      }

      // stack
      this.lastNc = this.lvnow < 50 ? 'min lv 50' :  Math.ceil(this.lastExp/297000)
      this.lastBnut = this.lvnow < 25 ? 'min lv 25' : Math.ceil(this.lastExp/14900)
      this.lastNwood = this.lvnow < 27 ? 'min lv 27' :  Math.ceil(this.lastExp/8160)

      // total spina
      this.spinaNc = this.lvnow < 50 ? 'min lv 50' : Math.round(this.lastNc*this.hnc)
      this.spinaBnut = this.lvnow < 25 ? 'min lv 25' : Math.round(this.lastBnut*this.hbnut)
      this.spinaNwood = this.lvnow < 27 ? 'min lv 27' : Math.round(this.lastNwood*this.hnwood)


      // QUEST
      this.q1 = this.lvnow < 89 ? 'Min lv 89' : Math.round(this.lastExp/150000)
      this.q2 = this.lvnow < 78 ? 'Min lv 78' : Math.round(this.lastExp/55200)
      this.q3 = this.lvnow < 86 ? 'Min lv 86' : Math.round(this.lastExp/50600)
      this.q4 = this.lvnow < 84 ? 'Min lv 84' : Math.round(this.lastExp/62800)
      this.q5 = this.lvnow < 82 ? 'Min lv 82' : Math.round(this.lastExp/41800)
      this.q6 = this.lvnow < 83 ? 'Min lv 83' : Math.round(this.lastExp/344000)
      this.q7 = this.lvnow < 81 ? 'Min lv 81' : Math.round(this.lastExp/175000)
      this.q8 = this.lvnow < 77 ? 'Min lv 77' : Math.round(this.lastExp/133000)
    }
  },
  filters: {
    numberFormat(input) {
      var output = input
      if (parseFloat(input)) {
          input = new String(input); // so you can perform string operations
          var parts = input.split("."); // remove the decimal part)
          parts[0] = parts[0].split("").reverse().join("").replace(/(\d{3})(?!$)/g, "$1,").split("").reverse().join("");
          output = parts.join(".");
      }

      return output;
    }
  }
});