{!! form_open_multipart('', ['id' => 'form-upload']) !!}
 @csrf
  <div class="row">

     <div class="form-group col-12">
       <label class="form-label"> Deskripsi </label>
       <textarea name="body" class="form-control" required></textarea>
       <span class="text-muted help-block">Max 140 character</span>
      </div>

      <div class="form-group col-md-8">
        <div class="form-label">Upload kenangan</div>

        <div id="preview"></div>

        <div class="custom-file">
          <input type="file" class="custom-file-input mr-5" name="gambar" id="gambar" accept="image/*" required>
          <label class="custom-file-label"></label>
        </div>
      </div>

    <div class="col-md-4 mt-5 mb-4">
      <button type="submit" class="btn btn-pill btn-primary float-right" id="unggah">Unggah</button>
    </div>

    <div class="form-group" style="width:100%;display:none" id="pgs">
    <div id="pg">
      <div class="clearfix">
        <div class="float-left">
          <strong id="pgtext">0%</strong>
        </div>
        <div class="float-right">
          <small class="text-muted">mengunggah</small>
        </div>

      </div>
      <div class="progress progress-xs">
        <div class="progress-bar bg-green" id="pgbar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      </div>
    </div>
</div>
{!! form_close() !!}



<script>
let submit = document.getElementById('form-upload');

  submit.addEventListener('submit', (e) => {
  	e.preventDefault();

    let btnUpload = document.getElementById("unggah");
    let data = new FormData(e.target);
    btnUpload.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Mengunggah ";
    btnUpload.classList.add('disabled')

    const config = {
      onUploadProgress: function(progressEvent) {
      	var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
        $("#pgtext").text(percentCompleted+'%')
        $("#pgbar").css('width', percentCompleted + '%')
      }
    }

    $("#pgs").show()

    axios.post('/gallery', data, config)
     .then((res) => {
      if(res.data.success){
        swal('Gambar telah di unggah',{
        	icon: 'success'
        }).then(() => {
        	window.location.reload();
        });
      }
      btnUpload.innerHTML = "Unggah";

    })
      .finally(() => {
          $("#pgs").hide()
      })
      .catch(err => alert(err));


  });

</script>