<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('title') &mdash; Laravel - Stisla</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS (Bootstrap 4) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/reverse.css') }}">

    <!-- Additional CSS (if any) -->
    @stack('css')
</head>
<body data-employee-data-required="{{ auth()->check() && !auth()->user()->employee ? 'true' : 'false' }}" 
      data-employee-form-url="{{ route('employees.create') }}">
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('components.header')

            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('components.footer')
        </div>
    </div>

    <!-- Employee Data Required Modal -->
    @if(auth()->check() && !auth()->user()->employee)
    <div class="modal fade" id="employee-data-required-modal" tabindex="-1" role="dialog" aria-labelledby="employeeDataRequiredModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="employeeDataRequiredModalLabel">
                        <i class="fas fa-exclamation-triangle"></i> Perhatian
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda perlu melengkapi data pegawai terlebih dahulu sebelum dapat mengakses fitur ini.</p>
                    <p>Silakan lengkapi data pegawai Anda untuk mengakses semua fitur dalam sistem.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="{{ route('employees.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-edit"></i> Lengkapi Data Pegawai
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jQuery and Popper.js (required for Bootstrap 4) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Stisla JS -->
    <script src="{{ asset('js/stisla.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    
    <!-- Employee Data Check JS -->
    <script src="{{ asset('js/employee-data-check.js') }}"></script>

    <!-- Additional Scripts (if any) -->
    @stack('scripts')
</body>
</html>
