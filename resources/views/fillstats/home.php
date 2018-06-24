
        <div class="my-3 my-md-5">
          <div class="container">
            <?=view('cari')?>
            <div class="row">

              <!-- loop -->

     <?php $f = new \App\Models\Fillstats();
            $fill = $f->select('type,plus')->orderBy('plus','ASC')->orderBy('type','ASC')->distinct()->get()->getResult();
            ?>
              <div class="col-12 mb-6">
              <?php foreach($fill as $fo):?>
                <a href="/fill_stats/<?=$fo->type == 1 ? 'Armor':'Weapon' ?>/<?=$fo->plus?>" class="btn btn-sm btn-pill btn-secondary">
                  <?=$fo->type == 1 ? 'Armor':'Weapon' ?><?=" (+$fo->plus)"?></a>
              <?php endforeach;?>
              </div>
              <?php

            foreach($fill as $fl):?>
              <div class="col-12">
              <h1 class="page-title">
                <?=$fl->type == 1 ? 'Armor':'Weapon' ?><?=" (+$fl->plus)"?>

              </h1>
              </div>

              <?php foreach($data as $pos): ?>
              <?php if($pos->type == $fl->type && $pos->plus == $fl->plus):?>
              <div class="col-md-6 col-xl-4">
                <div class="card card-collapsed">
                  <div class="card-status card-status-left bg-blue"></div>
                  <div class="card-header">
                    <h6 class="card-title"><?=esc($pos->stats)?></h6>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>

                    </div>
                  </div>
                  <div class="card-body">
                 <?=nl2br((new Parsedown)->text(esc($pos->steps)))?>
                  </div>


        <?php if(session('user') && session('role') != 'user'):?>
                  <div class="card-footer">
                    <a href="/edit/<?=$pos->id;?>/fillstats" class="btn btn-primary">edit</a>
                  </div>
                    <?php endif;?>

                </div>
              </div>
              <?php endif;?>
              <?php endforeach;?>


       <?php endforeach;?>

              <!-- yeyy -->
            </div>
          </div>
</div>