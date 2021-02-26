$('.updateCompanyForm , .createCompanyForm').on('submit', function(e){
	e.preventDefault();

	let form = $(this);
	let formData = new FormData(this);

	if(form.attr('method').toUpperCase() == 'PUT') {
		formData.append('_method', 'put');
	}

	clearAlerts();

	$.ajax({
		url: form.attr('action'),
		method: 'POST',
		processData: false,
		contentType: false,
		data : formData,
		success: function(response) {
			if(response.redirect) {
				window.location.href = response.redirect;
				return;
			}
		
			successAlert(response.success);
		},
		error: function(response) {
			if(response.status == 422) {
				let errors = response.responseJSON.errors;
				let errorMessages = "";
				for(let elementName in errors) {
					for(let errorMessage of errors[elementName]) {
						errorMessages  += `<li>${errorMessage}</li>`;
						$(`<div class="text-danger mt-1 form-error">${errorMessage}</div>`).insertAfter($(`[name="${elementName}"]`));
					}
				}
				errorAlert(`<ul class="m-0">${errorMessages}</ul>`);
			} else {
				errorAlert(`Something went wrong with the server`);
			}
		},
		complete: function(response) {
			clearAjaxSpinner(form);
		}
	});

});


$(document).on('submit',  '.deleteCompanyForm', function(e){
	e.preventDefault();

	let form = $(this);
	let row = form.closest('tr');

	clearAlerts();

	askForConfirm("Do you really want to delete it?", () => {

		spinnerForm(form);

		$.ajax({
			url: form.attr('action'),
			method: form.attr('method'),
			success: function(response) {
				row.fadeOut(500, function() {
					row.remove();
				});
				successAlert(response.success);
			}
		});
	});
	
});

$('.current-logo:not(.no-edit-logo)').on('click', () => {
	$('#logo').click();
});

$(".remove-logo").on('click', function() {
	$('.current-logo').addClass('no-logo').css('background-image', 'none');
	$(this).closest('form').append(`<input type="hidden" name="remove_image" value="1" />`);
});



$("#logo").change(function() {
	let input = this;

	clearAlerts();

	if (input.files && input.files[0]) {

	let fileExtension = ['png'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        errorAlert('Logo should be PNG file.');
        return;
    }

    var reader = new FileReader();
    
    reader.onload = function(e) {
      let currentLogo = $('.current-logo');
      currentLogo.removeClass('no-logo').css('background-image' , `url(${e.target.result})`);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }

});