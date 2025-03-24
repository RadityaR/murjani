<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Preceptor Klinik</title>

    <!-- Google Fonts: Poppins & Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3f51b5;
            --secondary-color: #1a237e;
            --accent-color: #0d1659;
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
        .header {
            background: linear-gradient(135deg, #3f51b5, #1a237e);
            color: #fff;
            padding: 20px 0;
            position: relative;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .back-link {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }
        .back-link:hover {
            color: rgba(255, 255, 255, 0.8);
        }
        .content {
            padding: 40px 0;
        }
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
        }
        .page-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-align: center;
            opacity: 0.8;
        }
        .info-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 40px;
        }
        .info-card h2 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }
        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-top: 30px;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }
        .info-list {
            padding-left: 25px;
            margin-top: 10px;
        }
        .info-list li {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .signature {
            text-align: right;
            margin-top: 40px;
            font-style: italic;
            color: #666;
        }
        .download-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background-color: var(--primary-color);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 20px;
            border: none;
            cursor: pointer;
        }
        .download-btn:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <a href="{{ route('pendidikan') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1 class="page-title animate__animated animate__fadeInDown">Preceptor Klinik</h1>
            <p class="page-subtitle animate__animated animate__fadeInUp">Informasi tentang wewenang, tanggung jawab, dan daftar preceptor klinik</p>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="info-card animate__animated animate__fadeIn">
                <h2>Preceptor Klinik</h2>
                
                <div class="section-title">1. Wewenang dan Tanggung Jawab Preceptor Klinik</div>
                <ol class="info-list" type="a">
                    <li>Melakukan bimbingan terhadap peserta didik, yaitu memberikan bekal keterampilan yang diperlukan.</li>
                    <li>Melakukan pembinaan sikap kepada peserta didik selama mengikuti pendidikan dengan melakukan pertemuan berkala secara komprehensif.</li>
                    <li>Melakukan penilaian terhadap peserta didik secara obyektif dengan mempertimbangkan masukan pihak terkait selama kegiatan pembelajaran klinik pada akhir kegiatan stase.</li>
                </ol>

                <div class="section-title">2. Daftar Nama Preceptor Klinik</div>
                <p>Daftar nama preceptor klinik tahun 2024 bisa diakses melalui tombol di bawah ini:</p>
                
                <div class="btn-container">
                    <a href="https://drive.google.com/drive/folders/1W-EdJAgTVUhBkv0PbPXNC9kcqaKuHV-M?usp=drive_link" target="_blank" class="download-btn">
                        <i class="fas fa-list-alt"></i> Lihat Daftar Preceptor Klinik 2024
                    </a>
                </div>
                
                <div class="signature">
                    Bagian Pendidikan dan Pelatihan<br>
                    RSUD Murjani Sampit
                </div>
            </div>
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 