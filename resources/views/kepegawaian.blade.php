<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Kepegawaian</title>

    <!-- Google Fonts: Poppins & Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- AOS (Animate On Scroll) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #6c63ff;
            --secondary-color: #3f3da1;
            --accent-color: #2b2a82;
            --light-bg: #f9f9f9;
            --text-color: #333;
        }
        body {
            font-family: 'Poppins', 'Nunito', sans-serif;
            background: var(--light-bg);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        /* HERO SECTION */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
            color: #fff;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 30px;
            max-width: 600px;
        }
        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .back-link:hover {
            color: rgba(255, 255, 255, 0.8);
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 900px;
            width: 100%;
            margin-top: 30px;
        }
        @media (max-width: 768px) {
            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 480px) {
            .menu-grid {
                grid-template-columns: 1fr;
            }
        }
        .menu-item {
            aspect-ratio: 1 / 1;
            background: white;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            text-decoration: none;
            color: var(--text-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 20px;
        }
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .menu-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        .menu-text {
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <section class="hero">
        <a href="{{ route('systems.choose') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        
        <h1 class="animate__animated animate__fadeInDown">Sistem Kepegawaian</h1>
        <p class="animate__animated animate__fadeInUp">
            Silakan pilih menu yang ingin Anda akses
        </p>
        
        <div class="menu-grid animate__animated animate__fadeIn">
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-sign-in-alt"></i></div>
                <div class="menu-text">Login Kepegawaian</div>
            </a>
            
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-user-tie"></i></div>
                <div class="menu-text">Data Pejabat Struktural</div>
            </a>
            
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-concierge-bell"></i></div>
                <div class="menu-text">Layanan Kepegawaian</div>
            </a>
            
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-file-alt"></i></div>
                <div class="menu-text">SOP dan Maklumat Pelayanan</div>
            </a>
            
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-book"></i></div>
                <div class="menu-text">Panduan Core Values ASN</div>
            </a>
            
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-handshake"></i></div>
                <div class="menu-text">MoU dan PKS</div>
            </a>
            
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="menu-text">Agenda Kegiatan</div>
            </a>
            
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="menu-text">Penilaian Kinerja Pegawai</div>
            </a>
            
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-user-shield"></i></div>
                <div class="menu-text">Pembinaan dan Pengawasan Pegawai</div>
            </a>
            
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-gavel"></i></div>
                <div class="menu-text">Regulasi</div>
            </a>
        </div>
    </section>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
        });
    </script>
</body>
</html> 