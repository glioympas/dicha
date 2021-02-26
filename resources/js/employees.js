$('.updateEmployeeForm, .createEmployeeForm').on('submit', function(e){
	e.preventDefault();

	let form = $(this);
	let data = form.serialize();

	clearAlerts();

	$.ajax({
		url: form.attr('action'),
		method: form.attr('method'),
		data,
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

$(document).on('submit', '.deleteEmployeeForm', function(e){
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