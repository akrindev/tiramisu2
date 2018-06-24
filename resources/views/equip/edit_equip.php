<?php
use App\Models\Barang;

$item = new Barang();
?>
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">

      <div class="card-body">

        <h3>Edit <?=$data->nama?></h3>
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
        <select name="type" class="form-control">
          <?php foreach($item->asObject()->select('type')->distinct()->get()->getResult() as $u): ?>
          <option value="<?=$u->type?>" <?= $u->type == $data->type ? 'selected' : '';?>><?=$u->type?></option>
          <?php endforeach;?>
        </select>
        <?= $errors->hasError('type') ?
  		$errors->showError('type') : ''; ?>
      </div>

      <div class="form-group <?= $errors->hasError('pics') ? 'has-error': '';?>">
        <label>Pics</label><br>
        <?= $data->pics ? "<img src=/$data->pics class'img-responsive'>" : '' ?><br>
        <input type="radio" name="gantipics" value="ya"> Ganti pics<br>
        <input type="text" name="pics" class="form-control" value="<?=$data->pics;?>">
        <?= $errors->hasError('pics') ?
  		$errors->showError('pics') : ''; ?>
      </div>


      <div class="form-group <?= $errors->hasError('stats') ? 'has-error': '';?>">
        <label>Status</label>
        <textarea name="stats" class="form-control"><?=$data->stats;?></textarea>
        <?= $errors->hasError('stats') ?
  		$errors->showError('stats') : ''; ?>
      </div>

      <div class="form-group <?= $errors->hasError('drop') ? 'has-error': '';?>">
        <label>Drop </label>
        <textarea name="drop" class="form-control"><?=$data->drop;?></textarea>
        <?= $errors->hasError('drop') ?
  		$errors->showError('drop') : ''; ?>
      </div>


      <div class="form-group <?= $errors->hasError('drop') ? 'has-error': '';?>">
        <label>Quest </label>
        <textarea name="quest" class="form-control"><?=$data->quest;?></textarea>
        <?= $errors->hasError('quest') ?
  		$errors->showError('quest') : ''; ?>
      </div>


      <div class="form-group <?= $errors->hasError('blacksmith') ? 'has-error': '';?>">
        <label>Blacksmith</label>

        <textarea name="blacksmith" class="form-control"><?=$data->blacksmith;?></textarea>
        <?= $errors->hasError('blacksmith') ?
  		$errors->showError('blacksmith') : ''; ?>
      </div>


      <div class="form-group <?= $errors->hasError('proc') ? 'has-error': '';?>">
        <label>Proses material </label>
        <input type="text" name="proc" class="form-control" value="<?=$data->proc;?>">
        <?= $errors->hasError('proc') ?
  		$errors->showError('proc') : ''; ?>
      </div>


      <div class="form-group <?= $errors->hasError('prod') ? 'has-error': '';?>">
        <label>Produksi </label>
        <textarea name="prod" class="form-control"><?=$data->prod;?></textarea>
        <?= $errors->hasError('prod') ?
  		$errors->showError('prod') : ''; ?>
      </div>


      <button type="submit" class="btn btn-primary">Ubah</button> <a onclick="confirm('Hapus data ini?')" href="/edit/<?=$data->id?>/equip/delete" class="btn btn-danger">Hapus</a>

      <?=form_close();?>


    </div>
  </div>

    </div>
  </div>
</div>