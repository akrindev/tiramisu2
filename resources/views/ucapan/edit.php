<div class="my-3 my-md-5">
  <div class="container">
    <div class="row">

      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Kirim ucapan ke temen
            </h3>
          </div>
          <?php if(session('sukses')):?>
          <div class="card-alert alert alert-success">
            <?=session('sukses');?>
          </div>
          <?php endif;?>
          <div class="card-body">
            <?=form_open_multipart('/ucapan/edit');?>
            <div class="form-group">
              <label> Kalimat ucapan </label>
              <textarea class="form-control" rows=8 name="ucapan" aria-describedby="cover" required><?=$ucapan?></textarea>
              <small id="cover" class="form-text text-muted">Markdown supported! :) </small>

            </div>
            <div class="form-group">
              <label> Cover </label><br>
              <img src="/<?=$cover?>" class="img-fluid"><br><br>
			<?=form_upload(['name'=>'cover','class'=>'form-control','accept'=>'image/*']);?>
            </div>

            <input type="hidden" name="id" value="<?=$id?>"/>
                    <input type="hidden" name="redir" value="<?=current_url()?>"/>


              <button type="submit" class="btn btn-outline-primary btn-pill">Buat! </button>
            <?=form_close();?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>