<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ route('clinic.home', clinic('id')) }}">
        <div class="mx-3 sidebar-brand-text">{{ tenant('name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="my-0 sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('clinic.home', clinic('id')) }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="my-0 sidebar-divider">

    @if (principal()->isUser())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('clinic.home', clinic('id')) }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span>
            </a>
        </li>

        <hr class="my-0 sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('clinic.home', clinic('id')) }}">
                <i class="fas fa-fw fa-user-md"></i>
                <span>Dentists</span>
            </a>
        </li>

        <hr class="my-0 sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('clinic.home', clinic('id')) }}">
                <i class="fas fa-fw fa-heartbeat"></i>
                <span>Patients</span>
            </a>
        </li>

        <hr class="my-0 sidebar-divider">
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('clinic.home', clinic('id')) }}">
                <i class="fas fa-fw fa-user-md"></i>
                <span>Treatments</span>
            </a>
        </li>

        <hr class="my-0 sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('clinic.home', clinic('id')) }}">
                <i class="fas fa-fw fa-stethoscope"></i>
                <span>Treatment Plans</span>
            </a>
        </li>
    @elseif(principal()->isDentist())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('clinic.home', clinic('id')) }}">
                <i class="fas fa-fw fa-heartbeat"></i>
                <span>Patients</span>
            </a>
        </li>

        <hr class="my-0 sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('clinic.home', clinic('id')) }}">
                <i class="fas fa-fw fa-stethoscope"></i>
                <span>Treatment Plans</span>
            </a>
        </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="mt-4 text-center d-none d-md-inline">
        <button class="border-0 rounded-circle" id="sidebarToggle"></button>
    </div>
</ul>
