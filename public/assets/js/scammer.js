  (function() {
   let hapusScammer = document.getElementById('hapus-scammer');
    let hapusComment = document.querySelectorAll('.delete-comment');

    for(let aku of hapusComment) {
      aku.addEventListener('submit', (e) => {
        e.preventDefault();

      	let the = new FormData(e.target);

        swal({
        	title: 'Yakin mau hapus komentar ini?',
          	text:'',
          	icon: 'warning',
          	buttons:true,
          	dangerMode:true
        }).then(yes => {
        	if(yes) {
              axios.post('/scammer/delete-comment', the)
              .then(res => {
              	if(res.data.success) {
                  swal('Komentar telah di hapus', {
                  	icon: 'success'
                  }).then(() => {
                  	document.getElementById('their-'+e.target.cid.value).remove();
                  });
                } else {
                  swal('aman gan!');
                }
              })
            } else {
              swal('nues');
            }
        }).catch(err => alert(err));
      });
    }

    hapusScammer.addEventListener('submit', (e) => {
      e.preventDefault();

      let data = new FormData(e.target);

    	swal({
        	title: 'Yakin mau ngehapus ini?',
          	text: '',
          	icon: 'warning',
          	buttons: true,
          	dangerMode: true
        }).then(r => {
        	if(r) {
              axios.post('/scammer/delete-by-admin', data)
              .then(res => {
              	if(res.data.success) {
                  swal("data berhasil di hapus", {
                  	icon: 'success'
                  }).then(() => {
                  	window.location.href = "/scammer";
                  });
                } else {
                  swal("Terjadi kesalahan", {
                  	icon: 'error'
                  });
                }
              }).catch(er => swal(er));
            } else {
              swal('aman');
            }
        }).catch(err => alert(err));
    });
  })();