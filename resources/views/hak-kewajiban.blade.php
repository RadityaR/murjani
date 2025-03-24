<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hak dan Kewajiban Peserta Praktik/Magang</title>

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
        .rules-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 40px;
        }
        .rules-card h2 {
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
        .rules-list {
            padding-left: 20px;
        }
        .rules-list li {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .sub-list {
            list-style-type: lower-alpha;
            padding-left: 25px;
            margin-top: 10px;
        }
        .sub-list li {
            margin-bottom: 10px;
        }
        .sub-sub-list {
            list-style-type: decimal;
            padding-left: 25px;
            margin-top: 10px;
        }
        .sub-sub-list li {
            margin-bottom: 10px;
        }
        .signature {
            text-align: right;
            margin-top: 40px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <a href="{{ route('pendidikan') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1 class="page-title animate__animated animate__fadeInDown">Hak dan Kewajiban Peserta Praktik/Magang</h1>
            <p class="page-subtitle animate__animated animate__fadeInUp">Hak dan kewajiban yang perlu diketahui oleh peserta praktik/magang</p>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="rules-card animate__animated animate__fadeIn">
                <h2>Hak dan Kewajiban</h2>
                
                <div class="section-title">1) Hak Peserta Praktik/ Magang</div>
                <ol class="sub-list">
                    <li>Mendapatkan kesempatan yang sama untuk mengikuti putaran pembelajaran klinik.</li>
                    <li>Mengetahui kompetensi yang akan diperoleh dalam setiap putaran di suatu bagian.</li>
                    <li>Mendapatkan bimbingan dari preceptor klinik selama menjalankan pembelajaran klinik.</li>
                    <li>Mengetahui aspek-aspek yang akan dinilai.</li>
                    <li>Mengikuti ujian setelah memenuhi segala persyaratan yang ditentukan oleh masing-masing bagian dan atau institusi pendidikan.</li>
                    <li>Mendapatkan penilaian seadil dan seobyektif mungkin.</li>
                    <li>Mengetahui hasil penilaian.</li>
                    <li>Dalam hal tidak terpenuhinya hak-hak tersebut diatas maka peserta praktik/ magang berhak untuk mengajukan keberatan secara tertulis yang ditujukan kepada kepala bagian institusi yang bersangkutan untuk mendapatkan penyelesaian yang adil.</li>
                </ol>

                <div class="section-title">2) Kewajiban Praktik/ Magang</div>
                <ol class="sub-list">
                    <li>Mentaati peraturan dan menjalankan seluruh kegiatan pembelajaran klinik yang ditetapkan oleh institusi pendidikan.</li>
                    <li>Mematuhi tata tertib dan peraturan yang ditetapkan di masing-masing lahan pendidikan.</li>
                    <li>Mengucapkan janji peserta didik sebelum menjalankan pembelajaran klinik.</li>
                    <li>Mengetahui jenis-jenis kewenangan yang boleh didelegasikan oleh instruktur klinik.</li>
                    <li>Melaksanakan tugas klinik yang didelegasikan oleh pembimbing klinik dan instruktur klinik sesuai dengan kewenangannya.</li>
                    <li>Terhadap pasien:
                        <ol class="sub-sub-list">
                            <li>Berlaku wajar, sopan, dan ramah</li>
                            <li>Melakukan tugas dengan sepenuh hati, tegas, dan sesuai dengan kewenangan</li>
                            <li>Tidak diperkenankan mempermainkan pasien</li>
                            <li>Memberikan pelayanan terbaik sebagai ibadah</li>
                        </ol>
                    </li>
                </ol>
                
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