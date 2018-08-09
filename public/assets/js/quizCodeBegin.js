


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
            return window.location.href = '/quiz/code/koreksi';
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