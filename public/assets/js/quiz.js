
	$('#tambbah-quiz').submit(function(e) {
		e.preventDefault();

		var me = $(this);

        var form = e.target;
        var data = new FormData(form);

      	$("#submitbtn").html('Sending <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $("#submitbtn").addClass('disabled');

		// perform ajax
		$.ajax({
           xhr: function() {
    		var xhr = new window.XMLHttpRequest();

    		xhr.upload
              .addEventListener(
              	"progress",
                function(evt) {
      				if (evt.lengthComputable) {
        			var percentComplete = evt.loaded / evt.total;
        			percentComplete = parseInt(percentComplete * 100);

            $(".btnku").html('<i class="fa fa-spinner fa-spin"></i> Mengunggah... ('+percentComplete+'%)')
              .addClass('disabled');
      		}
   			 }, false);

    		return xhr;
 		  },
			url: me.attr('action'),
			type: 'post',
			data: data,
            processData: false,
            contentType: false,
			success: function(response) {

            	$("#csrfp").val(response.csrfHash);

				if (response.success == true) {
					// if success we would show message
   swal('sukses gan');
					// and also remove the error class

					$('.form-control').removeClass('is-invalid')
									.removeClass('is-valid');
					$('.text-danger').remove();

					// reset the form
					me[0].reset();
				$("#submitbtn").text('Kirim');
                  $("#submitbtn").removeClass('disabled');
				}
				else {
                  		$("#submitbtn").removeClass('disabled');
                  $("#submitbtn").text('Send quiz');
					$.each(response.messages, function(key, value) {
						var element = $('#' + key);

						element.closest('div.form-group')
						.find('.text-danger')
						.remove();

                      element.removeClass('is-invalid')
						.addClass(value.length > 0 ? 'is-invalid' : 'is-valid')

						element.after(value);
					});
				}
			}
		});
	});