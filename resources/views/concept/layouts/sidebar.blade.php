<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fa fa-fw fa-user-circle"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'taxi-requests' ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="{{ $currentRoute == 'taxi-requests' ? 'true' : 'false' }}" data-target="#submenu-1" aria-controls="submenu-1">
                            <i class="fa fa-fw fa-rocket"></i>Taxi Requests
                        </a>
                        <div id="submenu-1" class="collapse submenu {{ $currentRoute == 'taxi-requests' ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('taxi-requests.index', [
                                            'from' => \Carbon\Carbon::now()->subDay()->format('d-m-Y H:i'),
                                            'to' => \Carbon\Carbon::now()->addDay()->format('d-m-Y H:i') ]) }}">
                                        Upcoming
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('taxi-requests.index', ['filter' => 'unassigned']) }}">
                                        Unassigned <span class="text-danger float-right"
                                            id="unassigned-count">{{ \App\TaxiRequest::filterByCompany()->unassigned()->count() ?: '' }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('taxi-requests.index', ['filter' => 'runningOut']) }}">
                                        Overdue <span class="text-danger float-right"
                                            id="running-out-count">{{ \App\TaxiRequest::filterByCompany()->runningOut()->count() ?: '' }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('taxi-requests.index') }}">
                                        All
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @can('access-model', 0)
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'users' ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="fas fa-fw fa-users"></i>Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'companies' ? 'active' : '' }}" href="{{ route('companies.index') }}">
                            <i class="fas fa-boxes"></i>Companies
                        </a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'passengers' ? 'active' : '' }}" href="{{ route('passengers.index') }}">
                            <i class="far fa-address-card"></i>Passengers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'drivers' ? 'active' : '' }}" href="{{ route('drivers.index') }}">
                            <i class="fas fa-address-card"></i>Drivers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'vehicles' ? 'active' : '' }}" href="{{ route('vehicles.index') }}">
                            <i class="fas fa-truck"></i>Vehicles
                        </a>
                    </li>
                    <li class="nav-divider">
                        Features
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-fw fa-inbox"></i>Apps <span class="badge badge-secondary">New</span></a>
                        <div id="submenu-7" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="inbox.html">Inbox</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="email-details.html">Email Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="email-compose.html">Email Compose</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="message-chat.html">Message Chat</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-columns"></i>Icons</a>
                        <div id="submenu-8" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="icon-fontawesome.html">FontAwesome Icons</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="icon-material.html">Material Icons</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="icon-simple-lineicon.html">Simpleline Icon</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="icon-themify.html">Themify Icon</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="icon-flag.html">Flag Icons</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="icon-weather.html">Weather Icon</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fas fa-fw fa-map-marker-alt"></i>Maps</a>
                        <div id="submenu-9" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="map-google.html">Google Maps</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="map-vector.html">Vector Maps</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder"></i>Menu Level</a>
                        <div id="submenu-10" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Level 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11">Level 2</a>
                                    <div id="submenu-11" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Level 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Level 2</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Level 3</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<script>
    setInterval(() => {
        $.ajax({
            url: "/taxi-requests/unassigned",
        }).done(function(response) {
            
            $('#unassigned-count').text(response.unassigned)
            $('#running-out-count').text(response.runningOut)

        }).fail(function(e) {
            console.log(e)
        })
    }, 10000);
</script>