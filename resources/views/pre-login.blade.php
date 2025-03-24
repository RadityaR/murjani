<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pilih Sistem</title>

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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* HERO SECTION */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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
            margin-bottom: 30px;
        }
        .system-cards {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 40px;
        }
        .system-card {
            background: white;
            border-radius: 15px;
            width: 300px;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            color: var(--text-color);
            text-decoration: none;
        }
        .system-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        .system-card i {
            font-size: 3.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        .system-card h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .system-card p {
            font-size: 1rem;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <section class="hero">
        <h1 class="animate__animated animate__fadeInDown">Pilih Sistem</h1>
        
        <div class="system-cards">
            <a href="{{ route('kepegawaian') }}" class="system-card animate__animated animate__fadeInLeft">
                <i class="fas fa-users"></i>
                <h2>Kepegawaian</h2>
                <p>Sistem Informasi Manajemen Kepegawaian</p>
            </a>
            
            <a href="{{ route('diklat') }}" class="system-card animate__animated animate__fadeInRight">
                <i class="fas fa-graduation-cap"></i>
                <h2>Diklat</h2>
                <p>Sistem Informasi Manajemen Pendidikan dan Pelatihan</p>
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