@extends('layouts.app')

@section('title', isset($show) ? __("View Employee") : ( isset($employee) ? __("Edit Employee") : __("Create Employee")) )

@section('content')


<div class="row">
	<div class="col">
		<div class="card shadow">
			<div class="card-header">{{ isset($employee) ? __("Edit employee") . " #" . $employee->id : __("Create a new employee")  }}</div>
			<div class="card-body">
				<form @if(!isset($show)) class="ajax-form {{ isset($employee) ? 'updateEmployeeForm' : 'createEmployeeForm' }}" method="{{ isset($employee) ? 'PUT' : 'POST' }}" action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" @endif>
					
					<div class="form-group">
						<label for="name">{{ __("Name") }}:</label>
						<input {{ isset($show) ? 'readonly' : '' }}  autofocus required value="{{ isset($employee) ? $employee->name : '' }}" name="name" id="name" type="text" class="form-control">
					</div>

					<div class="form-group">
						<label for="company_id">{{ __("Company") }}:</label>
						@if(isset($show))
							<input readonly value="{{ $employee->company->name }}" type="text" class="form-control" id="company_id">
						@else
							<select   required class="select2 form-control" name="company_id" id="company_id">
								@foreach($allCompanies as $company)
	                               <option
	                               @if(isset($employee) && $employee->company_id == $company->id )
	                               		selected
	                               @elseif(!isset($employee) && request()->company_id == $company->id)
	                               		selected
	                               @endif
	                                value="{{ $company->id }}">{{ $company->name }}</option>
								@endforeach
							</select>
						@endif
					</div>



					<div class="form-group">
						<label for="email">{{ __("Email") }}:</label>
						<input {{ isset($show) ? 'readonly' : '' }} required value="{{ isset($employee) ? $employee->email : '' }}" name="email" id="email" type="text" class="form-control">
					</div>

					<div class="form-group">
						<label for="phone">{{ __("Phone") }}:</label>
						<input  {{ isset($show) ? 'readonly' : '' }} value="{{ isset($employee) ? $employee->phone : '' }}" name="phone" id="phone" type="text" class="form-control">
					</div>

					<div class="mt-4">
						@if(isset($show))
							<button class="btn btn-sm btn-primary goBack" type="button">{{ __("Back") }}</button>
						@else
							<button class="btn btn-sm btn-primary" type="submit">{{ isset($employee) ? __("Update") : __("Create") }}</button>
						@endif
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection