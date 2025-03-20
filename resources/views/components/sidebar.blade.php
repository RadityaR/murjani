@auth
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <a href="">STISLA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
        <a href="">STISLA</a>
        </div>
        <ul class="sidebar-menu">
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
            <!-- Admin Menu -->
            <li class="menu-header">Menu Utama</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-th-large"></i><span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i class="fas fa-fire"></i><span>Home</span></a>
            </li>

            <li class="menu-header">Dokumen</li>
            <li class="{{ Request::is('form-templates*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('form-templates.index') }}">
                    <i class="fas fa-clipboard"></i> <span>Template Dokumen</span>
                </a>
            </li>
            <li class="{{ Request::is('form-submissions*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('form-submissions.index') }}">
                    <i class="fas fa-file-alt"></i> <span>Dokumen Masuk</span>
                </a>
            </li>
            
            <li class="menu-header">User Management</li>
            <li class="{{ Request::is('users*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Manage Users</span></a>
            </li>
            <li class="{{ Request::is('employees*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('employees.index') }}"><i class="fas fa-user-tie"></i> <span>Data Pegawai</span></a>
            </li>
            
            @if (Auth::user()->role === 'superadmin')
            <li class="menu-header">Hak Akses</li>
            <li class="{{ Request::is('hakakses') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('hakakses') }}"><i class="fas fa-user-shield"></i> <span>Hak Akses</span></a>
            </li>
            @endif

            @else
            <!-- Regular User Menu -->
            <li class="menu-header">Menu Utama</li>
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i class="fas fa-fire"></i><span>Home</span></a>
            </li>

            <!-- Profile (always accessible) -->
            <li class="menu-header">Profile</li>
            <li class="{{ Request::is('profile/change-password') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile/change-password') }}"><i class="fas fa-key"></i> <span>Ganti Password</span></a>
            </li>
            
            @if(!auth()->user()->employee)
            <!-- User without employee data -->
            <li class="{{ Request::is('employees/create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('employees.create') }}">
                    <i class="fas fa-user-edit"></i> <span>Lengkapi Data Pegawai</span>
                </a>
            </li>
            
            <!-- Disabled links for users without employee data -->
            <li class="menu-header">Dokumen</li>
            <li>
                <a href="#" class="requires-employee-data">
                    <i class="fas fa-file-upload"></i> <span>Submit Dokumen</span>
                </a>
            </li>
            <li>
                <a href="#" class="requires-employee-data">
                    <i class="fas fa-clipboard-list"></i> <span>Dokumen Saya</span>
                </a>
            </li>
            
            @else
            <!-- Regular user with employee data -->
            <li class="{{ Request::is('profile/edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile/edit') }}"><i class="far fa-user"></i> <span>Profile</span></a>
            </li>
            
            <li class="menu-header">Dokumen</li>
            <li class="{{ Request::is('form-templates/list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('form-templates.user-list') }}">
                    <i class="fas fa-file-upload"></i> <span>Submit Dokumen</span>
                </a>
            </li>
            <li class="{{ Request::is('form-submissions/my-submissions') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('form-submissions.user-submissions') }}">
                    <i class="fas fa-clipboard-list"></i> <span>Dokumen Saya</span>
                </a>
            </li>
            @endif
            @endif
        </ul>
    </aside>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Berkas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <x-file-upload-form />
            </div>
        </div>
    </div>
</div>
@endauth
