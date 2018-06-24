
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
        <?= $errors->hasError('nama') ? 'has-error': '';?>">
        <label>Type</label>
        <select name="type" class="form-control">
          <option value="1">Armor</option>

          <option value="2">Weapon</option>
        </select>
        <?= $errors->hasError('nama') ?
  		$errors->showError('nama') : ''; ?>
      </div>

      <div class="form-group <?= $errors->hasError('type') ? 'has-error': '';?>">
        <label>plus </label>
        <select name="plus" class="form-control">
          <?php for($i=10;$i<17;$i++):?>
          <option value="<?=$i?>"><?=$i?></option>
          <?php endfor;?>
        </select>
        <?= $errors->hasError('plus') ?
  		$errors->showError('plus') : ''; ?>
      </div>



      <div class="form-group <?= $errors->hasError('stats') ? 'has-error': '';?>">
        <label>Status</label>
        <textarea name="stats" class="form-control"> <?= set_value('stats');?></textarea>
        <?= $errors->hasError('stats') ?
  		$errors->showError('stats') : ''; ?>
      </div>


      <div class="form-group <?= $errors->hasError('stats') ? 'has-error': '';?>">
        <label>Steps</label>
        <textarea name="steps" class="form-control" rows=7><?= set_value('steps');?></textarea>
        <?= $errors->hasError('steps') ?
  		$errors->showError('steps') : ''; ?>
      </div>
      <button type="submit" class="btn btn-primary">Tambah</button>
      <?=form_close();?>



    </div>
  </div>
</div>

    </div>
  </div>
</div>