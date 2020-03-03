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
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
                        <div id="submenu-1" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.html" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">E-Commerce</a>
                                    <div id="submenu-1-2" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="../index.html">E Commerce Dashboard</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="../ecommerce-product.html">Product List</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="../ecommerce-product-single.html">Product Single</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="../ecommerce-product-checkout.html">Product Checkout</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../dashboard-finance.html">Finance</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../dashboard-sales.html">Sales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-1" aria-controls="submenu-1-1">Infulencer</a>
                                    <div id="submenu-1-1" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="../dashboard-influencer.html">Influencer</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="../influencer-finder.html">Influencer Finder</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="../influencer-profile.html">Influencer Profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'taxi-requests' ? 'active' : '' }}" href="{{ route('taxi-requests.index') }}">
                            <i class="fa fa-fw fa-rocket"></i>Taxi Requests
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'companies' ? 'active' : '' }}" href="{{ route('companies.index') }}">
                            <i class="fas fa-fw fa-chart-pie"></i>Companies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'passengers' ? 'active' : '' }}" href="{{ route('passengers.index') }}">
                            <i class="fab fa-fw fa-wpforms"></i>Passengers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'drivers' ? 'active' : '' }}" href="{{ route('drivers.index') }}">
                            <i class="fas fa-fw fa-table"></i>Drivers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $currentRoute == 'vehicles' ? 'active' : '' }}" href="{{ route('vehicles.index') }}">
                            <i class="fas fa-fw fa-file"></i>Vehicles
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