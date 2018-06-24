
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">

      <div class="card-body">


      <?=form_open();?>

      <div class="form-group
        <?= $errors->hasError('nama') ? 'has-error': '';?>">
        <label>Nama </label>
        <input type="text" name="nama" class="form-control" value="<?=$data->nama ?? '';?>">
        <?= $errors->hasError('nama') ?
  		$errors->showError('nama') : ''; ?>
      </div>

      <div class="form-group <?= $errors->hasError('type') ? 'has-error': '';?>">
        <label>Type </label>
        <input type="text" name="type" class="form-control" value="<?=$data->type ?? '';?>">
        <?= $errors->hasError('type') ?
  		$errors->showError('type') : ''; ?>
      </div>



      <div class="form-group <?= $errors->hasError('stats') ? 'has-error': '';?>">
        <label>Status</label>
        <textarea name="stats" class="form-control"><?=$data->stats;?></textarea>
        <?= $errors->hasError('stats') ?
  		$errors->showError('stats') : ''; ?>
      </div>

      <div class="form-group <?= $errors->hasError('slug') ? 'has-error': '';?>">
        <label>Slug </label>
        <input type="text" name="slug" class="form-control" value="<?=$data->slug;?>">
        <?= $errors->hasError('slug') ?
  		$errors->showError('slug') : ''; ?>
      </div>



      <button type="submit" class="btn btn-primary">Ubah</button> <a onclick="confirm('Hapus data ini?')" href="/edit/<?=$data->id?>/crysta/delete" class="btn btn-danger">Hapus</a>

      <?=form_close();?>



    </div>
  </div>
</div>

    </div>
  </div>
</div>