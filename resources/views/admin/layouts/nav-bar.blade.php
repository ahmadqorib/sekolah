<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
    <img src="{{ asset('assets/images/logo.png') }}" alt="" class="brand-image img-circle elevation-3"
            style="opacity: .8">
    <span class="brand-text font-weight-light">MI Miftahul Huda</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Ahmad Qorib</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link {{ Route::is('admin.home') ? 'active':'' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.profile.index') }}" class="nav-link {{ Route::is('admin.profile.*') ? 'active':'' }}">
                    <i class="nav-icon fas fa-school"></i>
                    <p>Profil Sekolah</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.album.index') }}" class="nav-link {{ Route::is('admin.album.*') ? 'active':'' }}">
                    <i class="far fa-images"></i>
                    <p>Album/Gallery</p>
                </a>
            </li>
        </ul>
    </nav>
</div>