
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />

<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
<style>
  .jssocials-share-link { border-radius: 50%; }
</style>

<div class="my-3 my-md-5">
  <div class="container">
    <div class="row">

      <div class="col-12">

                <div class="card card-profile">
                  <img src="/<?=$cover;?>" class="card-img" style="max-height:400px"/>
                  <div class="card-body text-center">

                    <h3 class="mb-3"><?=$oleh?></h3>
                    <p class="mb-4">
                    <?=nl2br((new Parsedown)->text(esc($ucapan)));?>
                    </p>
                    <button class="btn btn-outline-danger btn-pill btn-sm">
                      <span class="fa fa-heart"></span> suka
                    </button>
                    <hr>
                    <div id='share'></div><br>
                    Salin tautan dan bagikan<br>
                    <input type="text" class="form-control" value="<?=current_url();?>"/>
                  </div>
                </div>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>

<script>
  $("#share").jsSocials({
    showLabel: false,
    showCount: false,
    shares: [ "twitter", "facebook", "whatsapp"]
});
</script>