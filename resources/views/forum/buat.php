<?php

use Config\Database;
$db = Database::connect();
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
              <div class="col-md-8">


                <div class="card">
                  <?=form_open()?>

                  <div class='card-header'>
                    <h3 class="card-title">Buat thread</h3>
                  </div>
                  <?php if(session('gagal')):?>
                  <div class="card-alert alert alert-danger"><?=session('gagal')?></div>
				<?php endif;?>
                <div class="card-body">
                  <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control<?=$errors->hasError('judul') ? ' is-invalid' : ''?>" required value="<?=old('judul')?>">
                    <?php if($errors->hasError('judul')) echo $errors->showError('judul');?>
                  </div>

                  <div class="form-group">
                    <label>isi</label>
                    <textarea type="text" name="isi" class="form-control<?=$errors->hasError('isi') ? ' is-invalid' : ''?>" rows=14 required><?=old('isi')?></textarea>

                    <?=$errors->showError('judul','my_error');?>
                  </div>


                  <div class="form-group">
                    <label>Tags</label>
                    <select name="tags[]" id="tagsSelect" class="form-control <?=$errors->hasError('tags') ? ' is-invalid' : ''?>" multiple="multipe" onChange="maxAllowed(this,3)" required>
                      <?php
 $tags = $db->table('tags')->distinct()->get()->getResult();
                           foreach($tags as $t){ ?>
                      <option value="<?=$t->tags?>"><?=$t->tags?></option>
<?php } ?>
                      </select>
                    <small class="help-block text-muted">Max 3, min 1</small>

                    <?=$errors->showError('judul','my_error');?>
                  </div>

                  <button type="submit" class="btn btn-outline-primary btn-pill">Buat</button>
                </div>
                </div>
				<?=form_close();?>
              </div>
              <div class='col-md-4'>
              </div>
            </div>
          </div>
        </div>

<script>
  function maxAllowed(obj, maxAllowedCount) {
            var selectedOptions = jQuery('#'+obj.id+" option[value!=\'\']:selected");
            if (selectedOptions.length >= maxAllowedCount) {
                if (selectedOptions.length > maxAllowedCount) {
                    selectedOptions.each(function(i) {
                        if (i >= maxAllowedCount) {
                            jQuery(this).prop("selected",false);
                          swal({
                          title: "Maksimal 3 tags",
                          text: '',
                          icon: "warning",
                          });
                        }
                    });
                }
                jQuery('#'+obj.id+' option[value!=\'\']').not(':selected').prop("disabled",true);
            } else {
                jQuery('#'+obj.id+' option[value!=\'\']').prop("disabled",false);
            }
        }
</script>