
          <?php

$db = \Config\Database::connect();
          $db->initialize();?>

<div class="divider"></div>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    <?php $maps = $db->table('mobs')->select('map')->distinct()->get()->getResult();?>
    $(function(){

    var maps = [
    <?php foreach($maps as $maap):?>
      "<?=$maap->map;?>",
      <?php endforeach;?>
    ];
      $("#map").autocomplete({
      source: maps
      });
    });
</script>
<div class="my-3 my-md-5">

<div class="container">
<div class='row'>
  <div class="col">
    <div class="card">
      <div class="card-body">
      <h3>Edit data Monster</h3>


      <?=form_open();?>

      <div class="form-group">
        <label>Nama Mobs</label>
        <input type="text" name="nama" class="form-control" value="<?=$nama?>" required>
      </div>


      <div class="form-group">
        <label>Type Mobs</label>
        <select name="type" class="form-control">
          <option value="Normal Monster" <?= $type == "Normal Monster" ? 'selected' : ''?>>Normal Mobs</option>
          <option value="Field Boss" <?= $type == "Field Boss" ? 'selected' : ''?>>Field Boss</option>
          <option value="Boss" <?= $type == "Boss" ? 'selected' : ''?>>Boss</option>
        </select>
      </div>


      <div class="form-group">
        <label>Element Mobs</label>
        <select name="element" class="form-control">

          <?php $ele = $db->table('elements')->get()->getResult();
          foreach($ele as $el):?>

          <option value="<?=$el->nama?>" <?=$element == $el->nama ? 'selected' : '';?>><?=$el->nama?></option>
          <?php endforeach;?>
        </select>
      </div>


      <div class="form-group">
        <label>HP Mobs</label>
        <input type="number" name="hp" class="form-control" value="<?=$hp?>" required>
      </div>


      <div class="form-group">
        <label>XP Mobs</label>
        <input type="number" name="xp" class="form-control" value="<?=$xp?>" required>
      </div>


      <div class="form-group">
        <label>Level Mobs</label>
        <input type="number" name="level" class="form-control" value="<?=$level?>" required>
      </div>


      <div class="form-group">
        <label>Gambar</label><br>

                          <img src="/<?=$pics != '' ? $pics: 'img/logo_toramonline.png'?>" class="rounded">
        <input type="radio" name="withimg" value="ya" > Dengan gambar
        <input type="text" name="pics" class="form-control" value="<?=$pics?>">
        <div class="help-block">upload dulu di <a href="https://ctrlq.org/images/">ctrlq.org</a> copy disini linknya</div>
      </div>


      <div class="form-group">
        <label>Peta</label>
        <input type="text" id="map" name="map" class="form-control" value="<?=$map?>" required>
      </div>


      <div class="form-group">
        <label>Dapat di jadikan pet?</label><br>
        <input type="radio" name="kandang" value="Ya" <?=$kandang == "Ya" ? 'checked' : ''?>> Ya &nbsp; &nbsp;
        <input type="radio" name="kandang" value="Tidak" <?=$kandang == "Tidak" ? 'checked' : ''?>> Tidak
      </div>


      <div class="form-group">
        <label>Drop items</label>
        <textarea rows=5 name="drop_items" class="form-control"><?=$drop_items?></textarea>
        <div class="help-block">Note: <span class="text-muted">Nama items</span> (proc),<br>
        pisahkan dengan koma</div>
      </div>


      <div class="form-group">
        <label>Drop Equip / xtall </label>
        <textarea rows=5 name="drop_equip" class="form-control"><?=$drop_equip?></textarea>
        <div class="help-block">Note: <span class="text-muted">Nama equip/xtall</span> (proc),<br>
        pisahkan dengan koma</div>
      </div>


      <div class="form-group">
        <label>Remarks / info lainmya</label>
        <textarea rows=5 name="notes" class="form-control"><?=$notes?></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Ubah</button> <a onclick="confirm('Hapus data ini?')" href="/edit/<?=$id?>/mobs/delete" class="btn btn-danger">Hapus</a>


      <?=form_close();?>


    </div>
    </div>
  </div>
</div>
</div>
</div>