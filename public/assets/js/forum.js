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


  $(document).on('click','#likes',function(e){
  	e.preventDefault();


    var like_id = $(this).data('id');
    var liked = $("#count-liked-reply-"+like_id);

    $.ajax({
    	url: '/forum/likereply',
      	type: 'POST',
      	data: {
        	id: like_id
        },
      	success: function(r){
          if(r.sukses)
          {
            if(liked.data('suka') == 0) {
            liked.addClass('text-red').text("kamu menyukai ini");
            }
            else {
            liked.addClass('text-red').text("kamu dan "+liked.data('suka')+" lainnya menyukai ini");
            }
          	$(this).addClass('text-red');
          }
        },
      	error: function(j,t,y){
          alert(t+y);
        }
    });
  });