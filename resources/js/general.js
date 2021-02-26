$('.select2').select2();

$('#sidebarCollapse').on('click', function() {
    $('#sidebar').toggleClass('active');
    $('#body').toggleClass('active');
});

window.clearAlerts = function() {
	$('.top-success, .top-error').text(``).addClass('d-none');
	$('.form-error').remove();
}

window.askForConfirm = function(msg , callback) {
	Swal.fire({
	  title: 'Are you sure?',
	  text: msg,
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes'
	}).then((result) => {
	  if (result.isConfirmed) {
	    callback();
	  }
	});
}


window.successAlert = function(msg) {
	let error = $('.top-error');
	if(!error.hasClass('d-none'))
		error.addClass('d-none');

	$('.top-success').html(msg).removeClass('d-none').hide().fadeIn(500);
}

window.errorAlert = function(msg) {
	let success = $('.top-success');
	if(!success.hasClass('d-none'))
		success.addClass('d-none');

	$('.top-error').html(msg).removeClass('d-none').hide().fadeIn(500);
}

window.clearAjaxSpinner = function(form){
	form.find(`[type="submit"]`).find('.ajax-spinner').remove();
}

window.spinnerForm = function(form) {
	let btn = form.find(`[type="submit"]`);
	btn.append(`<div class="ajax-spinner spinner-border-sm spinner-border ml-1" role="status">
	  <span class="sr-only">Loading...</span>
	</div>`);
}


$(document).on('submit', '.ajax-form', function(){
	spinnerForm($(this));
});

$(document).on('click', '.goBack', function(){
	  window.history.back();
});

//AJAX Pagination
$(document).on('click', '.pagination .page-link', function(e){
	e.preventDefault();

	let href = $(this).attr('href');
	let content = $('.main-content');
	content.addClass('requesting');

	window.history.pushState("", "", href);


	$.ajax({
		url: href,
		success: function(response){
			let newContent = $(response).find('.main-content').html();
			content.html(newContent).removeClass('requesting');
		}
	})

});


//AJAX SEARCHING 
$(document).on('input', '.search-table-input', function(){

	 let element = $(this);
	 let term = element.val();
	 let content = $('.main-content');
	 content.addClass('requesting');
	 let href = term.length ? element.data('href') + `?term=${term}` : element.data('href');

	 window.history.pushState("", "",href );

	 $.ajax({
	 	url : href,
	 	success:function(response){
	 		let newContent = $(response).find('.main-content').html();
	 		let contentNumber = $(response).find('.results-count').text();
			content.html(newContent).removeClass('requesting');
			$('.results-count').text(`${contentNumber}`);
	 	}
	 });

});