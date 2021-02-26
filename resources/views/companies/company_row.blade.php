<tr data-company-id="{{ $company->id }}">
	<td>#{{ $company->id }}</td>
	<td>
		{{ $company->name }}
		<div><small><a class="text-info" href="{{ route('employees.index', ['company_id' => $company->id]) }}">{{ $company->employees->count() }} {{ __("Employee(s)") }} </a></small></div>
	</td>
	<td>{{ $company->email }}</td>
	<td>
		@if($company->website)
			<a target="_blank" class="text-primary" href="{{ $company->website }}">{{ $company->website }}</a>
		@else
			-
		@endif
	</td>
	<td>
		<div class="d-flex">

			<a href="{{ route('employees.create', ['company_id' => $company->id]) }}" class="btn btn-sm btn-success">{{ __("New Employee") }}</a>

			<a href="{{ route('companies.show', $company->id) }}" class="ml-1 btn btn-sm btn-info"> <i class="fas fa-eye"></i> </a>

			<a title="{{ __('Edit') }}" href="{{ route('companies.edit' , $company->id) }}" class="ml-1 btn btn-sm btn-info"><i class="fas fa-edit"></i></a>

			<form action="{{ route('companies.destroy' , $company->id) }}" class="d-inline-block ml-1 deleteCompanyForm" method="DELETE">
				<button title="{{ __('Delete') }}" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
			</form>
		</div>
	</td>
</tr>