
        <div class="my-3 my-md-5">
          <div class="container">
            <?=view('cari')?>
            <div class="row row-cards">

              <!-- loop -->
  <?php
  if(count($data) > 0):
      foreach($data as $pos):
  ?>
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <a href="/equip/<?=$pos->slug?>" class="mb-3">
                    <img src="/<?=$pos->pics != '' ? $pos->pics: 'img/logo_toramonline.png'?>" class="rounded">
                  </a>
                  <div class="d-flex align-items-center">

                    <strong><a href="/equip/<?=$pos->slug?>"><?=$pos->nama;?></a></strong>&nbsp;&nbsp;

                    <div class="ml-auto text-danger">
           <?=$pos->type?>
                    </div>

                  </div>

                 <div>
                   <br />
                   <span class="text-muted">
                   <?=nl2br($pos->stats)?>
                   </span>
                   <br />
                   <br />
                   <strong>Drop</strong>
                   <br />
                   -
                   <br />
                   <br />
                   <strong>Quest</strong>
                   <br />
                   <span class="text-muted"><?=$pos->quest?></span>
                   <br />
                   <br />
                   <strong>Pakar padu: NPC</strong>
                   <br />
                   <span class="text-muted">
                   <?=$pos->blacksmith?>
                   </span>
                   <br /><br />
                   <strong>Pakar Padu: Player</strong>
                   <br />
                   <?=$pos->prod?>
                   <br /><br />
                   <b>proses material : </b>
                   <?=$pos->proc?>

                   <br/>

        <?php if(session('user') && session('role') != 'user'):?>
                    <a href="/edit/<?=$pos->id;?>/equip" class="btn btn-primary">edit</a>
                    <?php endif;?>


                  </div>

                </div>
              </div>
  <?php
      endforeach;
   endif;
   ?>
              <!-- yeyy -->
            </div>
          </div>
</div>