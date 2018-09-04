(function(){
  let key = document.getElementById('peta-kunci');
  let peta = document.querySelectorAll('b.kunci');

  key.addEventListener('keyup', (e) => {

    let kunci = key.value.toLowerCase()

    for(let me of peta) {
      if(me.innerText.toLowerCase().indexOf(kunci) > -1) {
        me.style.display = "block"
      } else {
        me.style.display = "none"
      }
    }

  });

})();