@component('mail::message')

<p>
	@if($created)
		{{ __("A new company named") }}  {{ $company->name }} {{ __("has been created successfully.") }}
	@else
		{{ __("Someone has been updated company") }} {{ $company->name }}. {{ __("You can take a look") }}
	@endif
</p>

@component('mail::button', ['url' => route('companies.edit', $company->id) ])
	{{ __("See Company") }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
