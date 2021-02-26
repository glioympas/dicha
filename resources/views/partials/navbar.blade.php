<nav class="navbar navbar-expand-lg navbar-white bg-white">
    <button type="button" id="sidebarCollapse" class="btn btn-light"><i class="fas fa-bars"></i><span></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
            @auth
            <li class="nav-item">
                <a class="logout-link" href="#">{{ __("Logout") }}</a>
            </li>
            @endauth
        </ul>
    </div>
</nav>