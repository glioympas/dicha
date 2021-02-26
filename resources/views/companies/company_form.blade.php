@extends('layouts.app')


@section('title', isset($show) ? __("View Company")  : ( isset($company) ? __("Edit Company") : __("Create Company")) )

@section('content')
	<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-header">
					{{ isset($company) ? __("Edit Company") . " #" . $company->id : __("Create a new company")  }}
				</div>
				<div class="card-body">
					<form @if(!isset($show)) enctype='multipart/form-data' class="ajax-form {{ isset($company) ? 'updateCompanyForm' : 'createCompanyForm' }}" method="{{ isset($company) ? 'PUT' : 'POST' }}" action="{{ isset($company) ? route('companies.update', $company->id) : route('companies.store') }}" @endif>

						<!-- Δεν βάζω csrf token γιατί το έχω κάνει set sto jQuery AJAX setup και η συγκεκριμένη φόρμα θα φεύγει με AJAX
							Αυτο διευκολύνει στο όταν στέλνω AJAX requests χωρίς φόρμες να μην χρειάζεται να το βάζω manually στο body του request κάθε φορά.
						 -->

						 <div class="form-group">
						 	<label for="logo">{{ __("Logo") }}:</label>
						 	<div class="logo-container">
						 		@if(isset($company) && $company->logo)
						 	   		<div class="d-flex align-items-center">
						 	   			<div class="current-logo {{ isset($show) ? 'no-edit-logo' : '' }}" style="background-image: url({{ $company->image_source }})"></div>

						 	   			@if(!isset($show))
						 	   			<div class="ml-4"> <span class="remove-logo font-weight-bold">&times;</span> </div>
						 	   			@endif

						 	   		</div>
							 	@else
							 	   <div class="current-logo no-logo {{ isset($show) ? 'no-edit-logo' : '' }}"></div>
							 	@endif
						 	</div>
						 	<input class="d-none" id="logo" name="logo" type="file">
						 </div>

		 				<div class="form-group">
		 					<label for="name">{{ __("Name") }}:</label>
		 					<input autofocus {{ isset($show) ? "readonly" : "" }} name="name" id="name" required value="{{ isset($company) ? $company->name : '' }}" type="text" class="form-control">
		 				</div>

		 				<div class="form-group">
		 					<label for="name">{{ __("Email") }}:</label>
		 					<input name="email" {{ isset($show) ? "readonly" : "" }} id="email" required value="{{ isset($company) ? $company->email : '' }}" type="text" class="form-control">
		 				</div>

		 				<div class="form-group">
		 					<label for="name">{{ __("Activity") }}:</label>
		 					<input name="activity" {{ isset($show)  ? "readonly" : "" }} id="activity" value="{{ isset($company) ? $company->activity : '' }}" type="text" class="form-control">
		 				</div>

		 				<div class="form-group">
		 					<label for="name">{{ __("Website") }}:</label>
		 					<input name="website" {{ isset($show)  ? "readonly" : "" }} id="website" value="{{ isset($company) ? $company->website : '' }}" type="text" class="form-control">
		 				</div>


		 				<div class="mt-4">
		 					@if(isset($show))
		 						<button type="button" class="btn btn-primary btn-sm goBack">{{ __("Back") }}</button>
		 					@else
		 						<button type="submit" class="btn btn-primary btn-sm">{{ isset($company) ? __("Update") : __("Create") }}</button>
		 					@endif
		 				</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection