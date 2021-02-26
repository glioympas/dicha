<tr data-employee-id="{{ $employee->id }}">
	<td>#{{ $employee->id }}</td>
	<td>{{ $employee->name }}</td>
	<td>
		<a href="{{ route('companies.edit', $employee->company->id) }}" class="text-primary">{{ $employee->company->name }}</a>
	</td>
	<td>{{ $employee->email }}</td>
	<td>{{ $employee->phone }}</td>
	<td>
		<div class="d-flex">
			<a title='{{ __("Edit") }}' href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>

			<a href="{{ route('employees.show', $employee->id) }}" class="btn ml-1 btn-sm btn-info"> <i class="fas fa-eye"></i></a>

			<form method="DELETE" action="{{ route('employees.destroy' , $employee->id) }}" class="deleteEmployeeForm d-inline-block ml-1">
				<button title='{{ __("Delete") }}' type="submit" class=" btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
			</form>
		</div>
	</td>
</tr>