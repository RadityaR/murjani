<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pelatihan & Penelitian</title>

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
            --primary-color: #009688;
            --secondary-color: #00695c;
            --accent-color: #004d40;
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
            background: linear-gradient(135deg, #009688, #00695c);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 20px;
            color: #fff;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 40px;
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
        .menu-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
            max-width: 700px;
            margin-top: 20px;
        }
        .menu-item {
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .menu-icon {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }
        .menu-text {
            padding: 20px;
            font-weight: 600;
            font-size: 1.1rem;
            text-align: left;
        }
    </style>
</head>
<body>
    <section class="hero">
        <a href="{{ route('diklat') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        
        <h1 class="animate__animated animate__fadeInDown">Pelatihan & Penelitian</h1>
        <p class="animate__animated animate__fadeInUp">
            Silakan pilih menu yang ingin Anda akses
        </p>
        
        <div class="menu-items animate__animated animate__fadeInUp">
            <a href="{{ route('login') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="menu-text">DATA PELATIHAN</div>
            </a>
            
            <a href="{{ route('prosedur-penelitian') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-microscope"></i></div>
                <div class="menu-text">PROSEDUR PENELITIAN</div>
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