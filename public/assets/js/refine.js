const BAHAN = [
  { "nama": "hematite", "nilai": 1 },
  { "nama": "iron", "nilai": 2 },
  { "nama": "high purity iron", "nilai": 3 },
  { "nama": "damascus ore", "nilai": 4},
  { "nama": "damascus steel", "nilai": 5 },
  { "nama": "high purity damascus", "nilai": 6 },
  { "nama": "mythril ore", "nilai": 7 },
  { "nama": "mythril", "nilai": 8 },
  { "nama": "high purity mythril", "nilai": 9 },
  { "nama": "orichalcum ore", "nilai": 10 },
  { "nama": "orichalcum", "nilai": 11 },
  { "nama": "high purity orichalcum", "nilai": 12}
]

const KESULITAN = [
  { "tingkat": 0, "rate": 100 },
  { "tingkat": 1, "rate": 90 }, // 1-3 = 90
  { "tingkat": 2, "rate": 90 },
  { "tingkat": 3, "rate": 90 },
  { "tingkat": 4, "rate": 80 },
  { "tingkat": 5, "rate": 70 }, // 5-6 = 70
  { "tingkat": 6, "rate": 70 },
  { "tingkat": 7, "rate": 60 },
  { "tingkat": 8, "rate": 50 },
  { "tingkat": 9, "rate": 40 },
  { "tingkat": 10, "rate": 30 },
  { "tingkat": 11, "rate": 20 }, // 11-12 = 20
  { "tingkat": 12, "rate": 20 },
  { "tingkat": 13, "rate": 10 },
  { "tingkat": 14, "rate": 0 }, // 14-15 = 0
  { "tingkat": 15, "rate": 0 },
  { "tingkat": 16, "rate": -10 },
  { "tingkat": 17, "rate": -20 }, // 17-18 = -20
  { "tingkat": 18, "rate": -20 },
  { "tingkat": 19, "rate": -30 },
  { "tingkat": 20, "rate": -40 }, // 20-21 = -40
  { "tingkat": 21, "rate": -40 },
  { "tingkat": 22, "rate": -50 },
  { "tingkat": 23, "rate": -60 }, // 23-24 = -60
  { "tingkat": 24, "rate": -60 },
  { "tingkat": 25, "rate": -70 },
  { "tingkat": 26, "rate": -80 }, // 26-27 = -80
  { "tingkat": 27, "rate": -80 },
  { "tingkat": 28, "rate": -90 },
  { "tingkat": 29, "rate": -100 }, // 29-31 = -100
  { "tingkat": 30, "rate": -100 },
  { "tingkat": 31, "rate": -100 },
  { "tingkat": 32, "rate": -110 }
]

class Refine {

  constructor(ref, bahan) {
    this.success = 1;
    this.nilai_ref = ref || 1;
    this.tingkat_sulit = 100;
    this.bahan = bahan || "hematite";
  }

  tingkatKesulitan() {
    let tingkatSulit = this.nilai_ref * 3 - this.nilaiBahan();
    let sulit;


    if(tingkatSulit >= 32)
      sulit = -110;

    if(tingkatSulit <= 0)
      sulit = 100;

    for(let diff of KESULITAN) {
      if(tingkatSulit === diff.tingkat)
        sulit = diff.rate;
    }

    return sulit;
  }

  nilaiBahan() {
    let nilai;

    for(let data of BAHAN) {
      if(this.bahan === data.nama)
        nilai = data.nilai;
    }

    return nilai;
  }

  nilaiRef(n = false) {
    let x = n ? Number(1) : Number(0)
    let value = Number(this.nilai_ref)+x,
        ref;

    switch(value) {
      case 10:
        ref = 'E';
        break;
      case 11:
        ref = 'D';
        break;
      case 12:
        ref = 'C';
        break;
      case 13:
        ref = 'B';
        break;
      case 14:
        ref = 'A';
        break;
      case 15:
        ref = 'S';
        break;
      case 16:
        ref = 'SS';
        break;
      default:
        ref = value;
    }

    return ref
  }

  risk() {
    let risk = 100 - this.success;
    let fn = 0;

    if(this.success === 100) {
      return fn
    }

    for(let r = 0; r <= risk ; r+=10) {
      fn++;
    }

    return fn;
  }

  peluang(n) {
    let peluang = (this.success/100)*Number(n)

    return Math.floor(peluang)
  }

  run() {
    let final = (this.tingkatKesulitan() + 63 + 15) * 0.8
    this.success = Math.floor(final <= 0 ? 1 : final >= 100 ? 100 : final)

    return Math.floor(this.success)
  }
}
function build_table() {
  let table = document.getElementById("t-ref");

  let buffer = `<div class="m-5"><h3>Refine success rate &amp; risk</div>
        <table class="card-table table table-striped table-bordered text-nowrap">`;
  buffer += '<thead class="thead-dark"> <th>ore &amp; ref </th>'

  for(let x = 1; x <= 14; x++) {
    let re = new Refine(x);
    buffer += `<th>+${re.nilaiRef()} to +${re.nilaiRef(true)} </th>`
  }

  buffer += '</thead>'

  for(let item of BAHAN) {
    buffer += `<tr><td><b>${item.nama}</b></td>`;
    for(let i = 1; i <=14; i++) {
     	let r = new Refine(i, item.nama)
    	buffer += `<td class="table-${r.run() > 80 ? 'success' : r.run() < 30 ? 'danger' : 'primary'}">` + r.run() + '%' + `<br /> <small class="text-muted"><b>Risk: </b> ${r.risk()} </small>` + `</td>`;
  	}
   buffer += '<tr>'
  }
  buffer += '</table>';
  buffer += '<div class="mt-3 mr-5 text-right"> <img src="/img/potum.png" class="mr-4" width="50px" height="50px"> <span class="text-primary">toram-id.info</span></div>';

  table.innerHTML = buffer
}

function getResult() {
  let d = document;
  let weapon = document.getElementById("weapon"),
      bahan = document.getElementById("bahan").value,
      nilai = document.getElementById("v-ref"),
      pn = d.getElementById("v-bahan").value,
      rate = d.getElementById("r-rate"),
      risk = d.getElementById("r-risk"),
      rWeapon = d.getElementById("r-weapon"),
      rBahan = d.getElementById("r-bahan"),
      rRef = d.getElementById("r-ref"),
      peluang = d.getElementById("r-peluang");

  let calc = new Refine(nilai.value, bahan);

  calc.run();

  rate.innerHTML = calc.run() + '%'
  risk.innerHTML = calc.risk()
  rWeapon.innerHTML = weapon.value
  rBahan.innerHTML = bahan
  rRef.innerHTML = '+' + nilai.options[nilai.selectedIndex].text + ' ke +' + calc.nilaiRef(true)
  peluang.innerHTML = calc.peluang(pn) === 0 ? 'Tergantung amal dan doa' : calc.peluang(pn) + 'x'
}

build_table()