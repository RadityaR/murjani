<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tata Tertib Peserta Praktik/Magang</title>

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
            <h1 class="page-title animate__animated animate__fadeInDown">Tata Tertib Peserta Praktik/Magang</h1>
            <p class="page-subtitle animate__animated animate__fadeInUp">Peraturan yang harus dipatuhi oleh peserta praktik/magang</p>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="rules-card animate__animated animate__fadeIn">
                <h2>Tata Tertib</h2>
                <ol class="rules-list">
                    <li>Peserta harus menyadari pentingnya bersikap profesional ketika berada di rumah sakit.</li>
                    <li>Peserta wajib menyesuaikan diri dengan lingkungan dan keadan rumah sakit yang berarti ikut menjaga ketenteraman, kebersihan, kelancaran kerja, dan kewibawaan rumah sakit serta dapat memelihara semua sarana prasarana yang ada.</li>
                    <li>Dilarang merokok selama mengikuti proses pendidikan.</li>
                    <li>Tidak diijinkan mengunyah permen karet selama bertugas di rumah sakit dan sarana pelayanan kesehatan lainnya.</li>
                    <li>Bersikap dan berlaku secara wajar dalam segala hal. Bekerja cepat tetapi dengan cukup ketenangan dan tidak menunjukkan ketergesaan.</li>
                    <li>Tidak berlebihan dalam bersenda gurau dalam melakukan tugas.</li>
                    <li>Dilarang melakukan perekaman atau pengambilan tulisan, suara, gambar, foto, video, dan atau sejenisnya di area privat rumah sakit, kecuali untuk kepentingan pendidikan dengan tetap mengutamakan rahasia medis.</li>
                    <li>Dilarang berfoto (selfie dan atau wefie) di hadapan pasien dan atau keluarga pasien.</li>
                    <li>Dilarang mengunggah konten tulisan, suara, gambar, foto, video, dan atau sejenisnya di area privat rumah sakit ke media sosial.</li>
                    <li>Sikap terhadap pasien:
                        <ul class="sub-list">
                            <li>Berlaku wajar, sopan, dan ramah;</li>
                            <li>Dalam melakukan tugas harus dapat bertindak tegas sesuai dengan wewenangnya; dan</li>
                            <li>Tidak diperkenankan mempermainkan pasien.</li>
                        </ul>
                    </li>
                    <li>Sikap terhadap preceptor klinik:
                        <ul class="sub-list">
                            <li>Sopan; dan</li>
                            <li>Harus dapat bekerjasama dengan baik dan saling menghormati.</li>
                        </ul>
                    </li>
                    <li>Sikap terhadap peserta didik lain:
                        <ul class="sub-list">
                            <li>Untuk kelancaran dan ketertiban kerjasama ditetapkan seorang ketua dalam kelompoknya (jika berkelompok) yang bertugas mengkoordinasikan tugas-tugas tertentu, penyampaian informasi dan lain-lain;</li>
                            <li>Saling membantu dan menghormati dalam menyelesaikan tugas.</li>
                        </ul>
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