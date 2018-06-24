
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
        <input type="text" name="nama" class="form-control" value="<?= set_value('nama');?>">
        <?= $errors->hasError('nama') ?
  		$errors->showError('nama') : ''; ?>
      </div>

      <div class="form-group <?= $errors->hasError('type') ? 'has-error': '';?>">
        <label>Type </label>
        <input type="text" name="type" class="form-control" value="<?= set_value('type');?>">
        <?= $errors->hasError('type') ?
  		$errors->showError('type') : ''; ?>
      </div>



      <div class="form-group <?= $errors->hasError('stats') ? 'has-error': '';?>">
        <label>Status</label>
        <textarea name="stats" class="form-control"> <?= set_value('stats');?></textarea>
        <?= $errors->hasError('stats') ?
  		$errors->showError('stats') : ''; ?>
      </div>

      <div class="form-group <?= $errors->hasError('slug') ? 'has-error': '';?>">
        <label>slug </label>
        <textarea name="slug" class="form-control"><?= set_value('slug');?></textarea>
        <?= $errors->hasError('slug') ?
  		$errors->showError('slug') : ''; ?>
      </div>

      <button type="submit" class="btn btn-primary">Tambah</button>
      <?=form_close();?>



    </div>
  </div>
</div>

    </div>
  </div>
</div>