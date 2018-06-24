
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">

      <?php if(session('sukses')):?>
                  <div class="card-alert alert alert-success mb-0">
                    <?=session('sukses')?>
                  </div>
      <?php endif; ?>
      <div class="card-body">


      <?=form_open();?>

      <div class="form-group
        <?= $errors->hasError('type') ? 'has-error': '';?>">
        <label>Type</label>
        <select name="type" class="form-control">
          <option value="1" <?=$data->type == 1 ? 'selected':''?>>Armor</option>

          <option value="2" <?=$data->type == 2 ? 'selected':''?>>Weapon</option>
        </select>
        <?= $errors->hasError('type') ?
  		$errors->showError('type') : ''; ?>
      </div>

      <div class="form-group <?= $errors->hasError('plus') ? 'has-error': '';?>">
        <label>plus </label>
        <select name="plus" class="form-control">
          <?php for($i=10;$i<17;$i++):?>
          <option value="<?=$i?>" <?=$data->plus == $i ? 'selected':''?>><?=$i?></option>
          <?php endfor;?>
        </select>
        <?= $errors->hasError('plus') ?
  		$errors->showError('plus') : ''; ?>
      </div>



      <div class="form-group <?= $errors->hasError('stats') ? 'has-error': '';?>">
        <label>Status</label>
        <textarea name="stats" class="form-control"><?=$data->stats;?></textarea>
        <?= $errors->hasError('stats') ?
  		$errors->showError('stats') : ''; ?>
      </div>


      <div class="form-group <?= $errors->hasError('stats') ? 'has-error': '';?>">
        <label>Steps</label>
        <textarea name="steps" class="form-control"><?= $data->steps;?></textarea>
        <?= $errors->hasError('steps') ?
  		$errors->showError('steps') : ''; ?>
      </div>
      <button type="submit" class="btn btn-primary">Ubah</button> <a href="/delete/<?=$data->id;?>/fillstats" onclick="if(confirm('yakin mau hapus ini?')){return true}else{return false}" class="btn btn-danger">Hapus</a>
      <?=form_close();?>



    </div>
  </div>
</div>

    </div>
  </div>
</div>