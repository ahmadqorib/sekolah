
<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">Pengaturan Izin Akses</span>
        <div class="dropdown-divider"></div>
            <a href="{{ route('admin.role.index') }}" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> Role
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('admin.permission.index') }}" class="dropdown-item">
                <i class="fas fa-universal-access mr-2"></i> Permission
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('admin.permission.index') }}" class="dropdown-item">
                <i class="far fa-user-circle"></i> Account Pengguna
            </a>
            <div class="dropdown-divider"></div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link text-danger" href="{{ route('admin.logout') }}">
            Keluar <i class="fas fa-sign-out-alt mr-2"></i>
        </a>
    </li>
</ul>
