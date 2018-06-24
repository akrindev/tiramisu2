
        <div class="my-3 my-md-5">
          <div class="container">
            <?=view('cari')?>
            <div class="row row-cards">
                     <!-- loop -->
  <?php
  if(count($data) > 0):
      foreach($data as $pos):
  ?>
	<div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class='h3 text-primary'><a href="/crysta/<?=$pos->slug?>"><?=$pos->nama?></a></div>
                      <br />

                    </div>

                    <div class="row">
                      <div class="col-12 mb-6">

                        <h5 class="mb-1">Stats</h5>
                        <div class="text-muted-dark"><?=$pos->stats?></div>
                      </div>
                      <div class="col-12">
                        <h5 class="mb-1">Type</h5>
                        <div class="text-muted-dark"><?=$pos->type?></div>
                      </div>
                   <br/>

        <?php if(session('user') && session('role') != 'user'):?>
                    <a href="/edit/<?=$pos->id;?>/crysta" class="btn btn-primary">edit</a>
                    <?php endif;?>

                    </div>
                  </div>

                  </div>
                </div>

              <?php
      endforeach;
   endif;
   ?>
              </div>
    </div>

  </div>