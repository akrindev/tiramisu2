  (function() {
   let hapusScammer = document.getElementById('hapus-scammer');

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