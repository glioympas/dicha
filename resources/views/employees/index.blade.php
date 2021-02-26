@extends('layouts.app')

@section('title', __('Employees') )

@section('content')


<div class="row">
	<div class="col-md-12 col-lg-12">
	    <div class="card shadow">
	        <div class="card-header">{{ __("Employees") }} {{ $company ? __("of company") . " " . $company->name : '' }} - <span class="results-count">{{ $allCount }}</span> {{  __("Results") }}</div>
	        <div class="card-body">

	        	<div class="d-flex justify-content-end">
	        		@if($company)
	        			<a href="{{ route('employees.create', ['company_id' => $company->id]) }}" class="btn btn-sm btn-primary">
		        			{{ __("Create a new employee for company") }} {{ $company->name }}
		        		</a>
	        		@else
		        		<a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary">
		        			{{ __("Create Employee") }}
		        		</a>
		        	@endif
	        	</div>

	        	<div class="input-group mb-3 mt-4">
				  <input type="text" data-href="{{ route('employees.index') }}" class="search-table-input form-control" placeholder="{{ __('Search by employee ID, Name or Company Name') }}">
				  <div class="input-group-append">
				    <span class="input-group-text"><i class="fas fa-search"></i></span>
				  </div>
				</div>

	            <div class="main-content">
	            	<div class="mt-4 table-responsive">
		                <table class="table table-striped">
		                    <thead>
		                        <tr>
		                        	<th>{{ __("ID") }}</th>
		                            <th>{{ __("Employee Name") }}</th>
		                            <th>{{ __("Company") }}</th>
		                            <th>{{ __("Email") }}</th>
		                            <th>{{ __("Phone") }}</th>
		                            <th>{{ __("Actions") }}</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	@foreach($employees as $employee)
			                        @include('employees.employee_row')
		                        @endforeach
		                    </tbody>
		                </table>
		            </div>

		            <div class="mt-4 d-flex justify-content-center">
		            	{{ $employees->withQueryString()->links() }}
		            </div>
	            </div>

	            
	        </div>
	    </div>
	</div>
</div>


@endsection