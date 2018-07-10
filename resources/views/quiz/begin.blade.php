@extends('layouts.tabler')

@section('title','Toram Quiz')
@section('description','Toram Quiz, Asah otak seberapa dalam kamu tau tentang dunia pertoraman, kuy cek!')
@section('image',to_img())

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title">
        Toram Online Quiz
      </h1>
    </div>

    <div class="row">

      <div class="col-md-8">
        <div class="alert alert-primary">
          Klik <b>Simpan</b> sebelum melanjutkan ke soal berikutnya
        </div>
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">
              Quiz
            </h3>
          </div>
{!! form_open('/quiz/save',['id'=>'simpan-gan']) !!}
          <div class="card-body p-3" style="font-size:14px;font-weight:400">
<div class="dimmer">
  <div class="loader"></div>
  <div class="dimmer-content">

            <div id="kerjakan">
              <div class="my-4">wait . . .</div>
            </div>
  </div>
</div>
          </div>
{!! form_close() !!}
        </div>
      </div>
      <!-- col md 8 -->

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Terjawab
            </h3>
          </div>
          <div class="card-body p-3" style="font-size:14px;font-weight:400;">
            <div id="terjawab" class="mb-3"></div>
<div class="alert alert-primary">
  Tips: Klik tabel di atas untuk menuju soal pada nomer tertentu
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
@endsection

@section('footer')
<link href="/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css">
<script src="/assets/js/bootstrap-markdown.js">
</script>
<script src="/assets/js/markdown.js">
</script>
<script src="/assets/js/to-markdown.js">
</script>

<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/assets/js/quiz.js"></script>


<script>


  $(".dimmer").addClass('active');
    $("#kerjakan").load('/quiz/i/1',function(){
    	$(".dimmer").removeClass('active');
      	$("#terjawab").load('/ajax/terjawab');
    });

  function gantiSoal(i)
  {

  $(".dimmer").addClass('active');
    $("#kerjakan").load('/quiz/i/'+i,function(){
    	$(".dimmer").removeClass('active');
    });
  }

  function koreksi()
  {
    swal({
    	title: 'Koreksi',
      	text: 'Kamu yakin mau koreksi ?',
      	icon: 'warning',
      	buttons: true
    }).then((gas) => {
    	if(gas)
          {
            swal('oke, mengoreksi . . .');
            return window.location.href = '/quiz/koreksi';
          }
      	else
          {
            swal('fyuh');
          }
    });
  }

  $("#simpan-gan").submit(function(e){
    e.preventDefault();

    var me = $(this);

    $.ajax({
      url: me.attr('action'),
      data: me.serialize(),
      type: 'POST',
      beforeSend: function(){
        $("#btn-simpan").html('<i class="fa fa-spinner fa-spin"></i> Menyimpan');
      },
      success: function(){
        swal('ok');
      }

    }).always(function(){
    	$("#btn-simpan").html("Simpan");
      	$("#terjawab").load('/ajax/terjawab');
    });

  });
</script>


@endsection