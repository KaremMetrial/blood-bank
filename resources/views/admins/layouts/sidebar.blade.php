<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column h-100" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Menu Items -->
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : ''  }} ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('clients.index') }}" class="nav-link {{ request()->routeIs('clients.index') ? 'active' : ''  }}" >
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Clients
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('governorates.index') }}" class="nav-link {{ request()->routeIs('governorates.index') ? 'active' : ''  }}" >
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Governorates
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cities.index') }}" class="nav-link {{ request()->routeIs('cities.index') ? 'active' : ''  }}" >
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Cities
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.index') ? 'active' : ''  }}" >
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('donations.index') }}" class="nav-link {{ request()->routeIs('donations.index') ? 'active' : ''  }}" >
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Donations
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contacts.index') }}" class="nav-link {{ request()->routeIs('contacts.index') ? 'active' : ''  }}" >
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Contacts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('settings') }}" class="nav-link {{ request()->routeIs('settings') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
                <div class="mt-auto"></div>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                this.closest('form').submit(); "class="btn
                            btn-danger btn-block text-white rounded">Log Out</a>
                    </form>

                </li>
            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
