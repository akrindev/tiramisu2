// consignment board toram
// toram-id.com

class ConsignmentBoard {
  constructor() {
    this.harga = 1
    this.laba = 1
    this.fee = 1
  }

  // set harga jual
  setHarga(h) {
    this.harga = h
  }

  // get fee
  getFee() {
    this.fee = this.harga * 0.1

    return Number(this.fee)
  }

  getFeeVip() {
    let feeVip = this.getFee() * 0.6,
        fv = this.getFee() - feeVip

    return Number(fv)
  }

  // laba / untung
  getLaba() {
    return Number(this.harga - this.getFee())
  }

  // laba dengan vip tiket
  getLabaVip() {
    return Number(this.harga - this.getFeeVip())
  }

  // jika menjual di global, maka akan mendapat tax
  onGlobal(tax) {
    let see = this.harga * tax,
        saw = Number(this.harga) + Number(see)

    // yang terlihat di cb global
    return Number(saw)
  }
}

let CB = new ConsignmentBoard();
let k = document.getElementById("cek")

k.addEventListener('click', () => {
  let nfee = document.getElementById("nfee"),
      nlaba = document.getElementById("nlaba"),
      nglobal = document.getElementById("nglobal"),
      fee = document.getElementById("fee"),
      laba = document.getElementById("laba"),
      vharga = document.getElementById("harga").value,
      vtax = document.getElementById("tax").value;

  vharga = vharga.replace(/,/g, '');

  if(isNaN(vharga)) {
    alert("kesalahan masukan")
    document.getElementById("harga").value = 1
    return;
  }
  CB.setHarga(vharga);
  inp()

  nfee.innerHTML = c(Math.floor(CB.getFee()))
  nlaba.innerHTML = c(Math.ceil(CB.getLaba()))
  nglobal.innerHTML = c(Math.floor(CB.onGlobal(vtax)))
  fee.innerHTML = c(Math.floor(CB.getFeeVip()))
  laba.innerHTML = c(Math.ceil(CB.getLabaVip()))
})

function inp() {
  let vharga = document.getElementById("harga").value

  vharga = vharga.replace(/,/g, '');

  document.getElementById("harga").value = c(vharga)
}

function c(input) {
    var output = input
    if (parseFloat(input)) {
        input = new String(input); // so you can perform string operations
        var parts = input.split("."); // remove the decimal part
        parts[0] = parts[0].split("").reverse().join("").replace(/(\d{3})(?!$)/g, "$1,").split("").reverse().join("");
        output = parts.join(".");
    }

    return output;
}
