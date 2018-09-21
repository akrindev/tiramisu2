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

    <div class="form-group">
    <div id="pg"></div>
    </div>
</div>
{!! form_close() !!}