  $("#likeme").submit(function(e){
  	e.preventDefault();

    var countliked = $("#count-liked").data('suka');
    $.ajax({
    	url: '/forum/like',
      	type: 'POST',
      	data: $(this).serialize(),
      	success: function(r){
          if(r.sukses)
          {
            if(countliked == 0) {
            $("#count-liked").text("kamu menyukai ini");
            }
            else {
            $("#count-liked").addClass('text-red').text("kamu dan "+countliked+" lainnya menyukai ini");
            }
          	$("#like").addClass('text-red');
          }
        },
      	error: function(j,t,y){
          alert(t+y);
        }
    });
  });