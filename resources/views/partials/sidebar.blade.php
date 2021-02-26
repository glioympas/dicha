<nav id="sidebar">
    <div class="py-3 sidebar-header text-center bg-dark">
       <a href="/">
           <img height="20" src="https://www.dicha.gr/uploads/images/dicha-logo-green.png" alt="{{ config('app.name') }}">
       </a>
    </div>
    <ul class="pt-4 list-unstyled components text-secondary">
        <li>
            <a href="{{ route('companies.index') }}"><i class="fas fa-building"></i>{{ __("Companies") }}</a>
        </li>
        <li>
            <a href="{{ route('employees.index') }}"><i class="fas fa-users"></i> {{ __("Employees") }}</a>
        </li>
    </ul>
</nav>