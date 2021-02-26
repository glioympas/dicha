@extends('layouts.app')

@section('title', __("Companies"))

@section('content')


<div class="row">
	<div class="col-md-12 col-lg-12">
	    <div class="card shadow">
	        <div class="card-header">{{ __("Companies") }} - <span class="results-count">{{ $allCount }}</span> {{  __("Results") }}</div>
	        <div class="card-body">

	        	<div class="d-flex justify-content-end">
	        
	        		<a href="{{ route('companies.create') }}" class="btn btn-sm btn-primary">{{ __("Create Company") }}</a>
	        	</div>

	        
				<div class="input-group mb-3 mt-4">
				  <input type="text" data-href="{{ route('companies.index') }}" class="search-table-input form-control" placeholder="{{ __('Search by company ID ,  Name or Email') }}">
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
		                            <th width="20%">{{ __("Company Name") }}</th>
		                            <th>{{ __("Email") }}</th>
		                            <th>{{ __("Website") }}</th>
		                            <th width="40%">{{ __("Actions") }}</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	@foreach($companies as $company)
			                        @include('companies.company_row')
		                        @endforeach
		                    </tbody>
		                </table>
		            </div>

		            <div class="mt-4 d-flex justify-content-center">
		            	{{ $companies->withQueryString()->links() }}
		            </div>

	            </div>
	        </div>
	    </div>
	</div>
</div>


@endsection