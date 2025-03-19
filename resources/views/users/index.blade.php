@extends('layouts.app')

@section('title', 'User Management')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    
    <style>
        .loading {
            position: relative;
            opacity: 0.6;
            pointer-events: none;
        }
        
        .loading:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            margin-top: -20px;
            margin-left: -20px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">User Management</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Users List</h4>
                            <div class="card-header-action">
                                <a href="{{ route('users.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i> Add New User</a>
                            </div>
                        </div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif

                            <!-- Filters -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <select class="form-control select2" id="status-filter">
                                        <option value="">All Status</option>
                                        <option value="active">Active</option>
                                        <option value="suspended">Suspended</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control select2" id="department-filter">
                                        <option value="">All Departments</option>
                                        @foreach($departments as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control select2" id="role-filter">
                                        <option value="">All Roles</option>
                                        <option value="admin">Admin</option>
                                        <option value="hr">HR</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="search-filter" placeholder="Search...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="search-btn">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bulk Actions -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Bulk Actions
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item bulk-action" href="#" data-action="activate">Activate Selected</a>
                                            <a class="dropdown-item bulk-action" href="#" data-action="deactivate">Deactivate Selected</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item bulk-action text-danger" href="#" data-action="delete">Delete Selected</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="users-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" class="custom-control-input" id="select-all">
                                                    <label class="custom-control-label" for="select-all"></label>
                                                </div>
                                            </th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>NIP</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Last Login</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" class="custom-control-input user-checkbox" id="user-{{ $user->id }}" value="{{ $user->id }}">
                                                        <label class="custom-control-label" for="user-{{ $user->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->nip }}</td>
                                                <td>{{ $user->employee?->department?->name ?? '-' }}</td>
                                                <td>{{ $user->position ?? '-' }}</td>
                                                <td>
                                                    <div class="badge badge-{{ $user->role == 'admin' ? 'primary' : ($user->role == 'hr' ? 'info' : 'light') }}">
                                                        {{ ucfirst($user->role) }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-{{ $user->status == 'active' ? 'success' : ($user->status == 'suspended' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($user->status) }}
                                                    </div>
                                                </td>
                                                <td>{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</td>
                                                <td>
                                                    <a href="{{ route('users.edit', $user->id) }}" 
                                                       class="btn btn-warning btn-sm"
                                                       data-toggle="tooltip" 
                                                       title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    
                                                    <form action="{{ route('users.destroy', $user->id) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm" 
                                                                data-toggle="tooltip" 
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Bulk Action Form -->
<form id="bulk-action-form" action="{{ route('users.bulk-action') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="action" id="bulk-action">
    <input type="hidden" name="user_ids" id="selected-users">
</form>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        // Define routes for JavaScript use
        var editUserRoute = "{{ route('users.edit', ':id') }}";
        var deleteUserRoute = "{{ route('users.destroy', ':id') }}";
        
        // Suppress DataTables warnings
        $.fn.dataTable.ext.errMode = 'none';
        
        // Override DataTables warning function
        if ($.fn.dataTable) {
            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                console.log('DataTables warning: ' + message);
                // Do nothing, just log the warning
            };
        }
        
        // Auto-dismiss DataTables warning dialogs
        $(document).on('click', 'button:contains("OK")', function() {
            var dialogText = $(this).closest('div').text();
            if (dialogText.includes('DataTables warning') || dialogText.includes('Requested unknown parameter')) {
                $(this).click();
            }
        });
        
        $(document).ready(function() {
            // Setup AJAX CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Auto-dismiss DataTables warning dialogs
            $(document).on('click', '.dt-button, .paginate_button, .sorting, .sorting_asc, .sorting_desc', function() {
                // Check if there's a DataTables warning dialog and dismiss it
                if ($('div:contains("DataTables warning")').length > 0) {
                    $('div:contains("DataTables warning")').find('button:contains("OK")').click();
                }
            });
            
            // Initialize Select2
            $('.select2').select2();

            // Initialize tooltips
            function initTooltips() {
                $('[data-toggle="tooltip"]').tooltip();
            }
            
            // Initialize tooltips on page load
            initTooltips();

            // Initialize DataTable
            var table = $('#users-table').DataTable({
                "ordering": true,
                "pageLength": 10,
                "responsive": true,
                "processing": false,
                "searching": false,
                "paging": true,
                "info": true,
                "autoWidth": false,
                "dom": '<"top">rt<"bottom"lip><"clear">'
            });
            
            // Load initial data into DataTable
            function loadInitialData() {
                // Get all rows from the original table
                var rows = [];
                $('#users-table tbody tr').each(function() {
                    var rowData = [];
                    $(this).find('td').each(function() {
                        rowData.push($(this).html());
                    });
                    rows.push(rowData);
                });
                
                // Clear the DataTable
                table.clear();
                
                // Add each row to the DataTable
                rows.forEach(function(row) {
                    table.row.add(row);
                });
                
                // Draw the table
                table.draw();
            }
            
            // Load initial data
            loadInitialData();

            // Handle select all checkbox
            $('#select-all').change(function() {
                $('.user-checkbox').prop('checked', $(this).prop('checked'));
            });

            // Handle bulk actions
            $('.bulk-action').click(function(e) {
                e.preventDefault();
                var action = $(this).data('action');
                var selectedUsers = $('.user-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedUsers.length === 0) {
                    alert('Please select at least one user.');
                    return;
                }

                if (confirm('Are you sure you want to ' + action + ' the selected users?')) {
                    $('#bulk-action').val(action);
                    $('#selected-users').val(JSON.stringify(selectedUsers));
                    $('#bulk-action-form').submit();
                }
            });

            // Handle filters
            function applyFilters() {
                // Show loading indicator
                $('#users-table').addClass('loading');
                
                $.ajax({
                    url: "{{ route('users.filter') }}",
                    type: "GET",
                    data: {
                        status: $('#status-filter').val(),
                        department: $('#department-filter').val(),
                        role: $('#role-filter').val(),
                        search: $('#search-filter').val()
                    },
                    success: function(data) {
                        // Clear the table
                        table.clear();
                        
                        // Add rows with the filtered data
                        data.forEach(function(user) {
                            var rowData = [
                                // Checkbox column
                                '<div class="custom-checkbox custom-control">' +
                                    '<input type="checkbox" class="custom-control-input user-checkbox" id="user-' + user.id + '" value="' + user.id + '">' +
                                    '<label class="custom-control-label" for="user-' + user.id + '"></label>' +
                                '</div>',
                                // Name
                                user.name,
                                // Email
                                user.email,
                                // NIP
                                user.nip,
                                // Department
                                user.department || '-',
                                // Position
                                user.position || '-',
                                // Role
                                '<div class="badge badge-' + (user.role == 'admin' ? 'primary' : (user.role == 'hr' ? 'info' : 'light')) + '">' +
                                    user.role.charAt(0).toUpperCase() + user.role.slice(1) +
                                '</div>',
                                // Status
                                '<div class="badge badge-' + (user.status == 'active' ? 'success' : (user.status == 'suspended' ? 'danger' : 'warning')) + '">' +
                                    user.status.charAt(0).toUpperCase() + user.status.slice(1) +
                                '</div>',
                                // Last Login
                                user.last_login_at || 'Never',
                                // Actions
                                '<a href="' + editUserRoute.replace(':id', user.id) + '" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">' +
                                    '<i class="fas fa-pencil-alt"></i>' +
                                '</a> ' +
                                '<form action="' + deleteUserRoute.replace(':id', user.id) + '" method="POST" class="d-inline">' +
                                    '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">' +
                                    '<input type="hidden" name="_method" value="DELETE">' +
                                    '<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete" ' +
                                            'onclick="return confirm(\'Are you sure you want to delete this user?\')">' +
                                        '<i class="fas fa-trash"></i>' +
                                    '</button>' +
                                '</form>'
                            ];
                            
                            // Add the row to the table
                            table.row.add(rowData);
                        });
                        
                        // Draw the table
                        table.draw();
                        
                        // Initialize tooltips after drawing the table
                        initTooltips();
                        
                        // Remove loading indicator
                        $('#users-table').removeClass('loading');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error filtering users:", error);
                        alert("An error occurred while filtering users. Please try again.");
                        
                        // Remove loading indicator
                        $('#users-table').removeClass('loading');
                    }
                });
            }

            // Apply filters on change
            $('#status-filter, #department-filter, #role-filter').change(applyFilters);
            $('#search-btn').click(applyFilters);
            $('#search-filter').keypress(function(e) {
                if (e.which == 13) applyFilters();
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
@endpush 