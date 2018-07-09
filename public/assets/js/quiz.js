
	$('#tambah-quiz').submit(function(e) {
		e.preventDefault();

		var me = $(this);

        var form = e.target;
        var data = new FormData(form);

      	$("#submitbtn").html('Sending <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $("#submitbtn").addClass('disabled');

		// perform ajax
		$.ajax({
			url: me.attr('action'),
			type: 'post',
			data: me.serialize(),
			success: function(response) {

            	$("#csrfp").val(response.csrfHash);

				if (response.success == true) {
					// if success we would show message
   swal('sukses gan','Kuy buat lagi','success');
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

                  $("#submitbtn")
                    .removeClass('disabled');
                  $("#submitbtn")
                    .text('Send quiz');

					$.each(response.messages, function(key, value) {
						var element = $('#' + key);

					element
						.removeClass('is-invalid')
						.addClass(key.length > 0 ? 'is-invalid' : 'is-valid');
                      element.parent('div.form-group')
						.find('div.invalid-feedback')
						.remove();

						element.after('<div class="invalid-feedback">'+value+'</div>');
					});
				}
			}
		});
	});