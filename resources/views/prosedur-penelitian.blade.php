<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prosedur Penelitian</title>

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
        .header {
            background: linear-gradient(135deg, #009688, #00695c);
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
        .procedure-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 40px;
        }
        .procedure-card h2 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }
        .procedure-list {
            padding-left: 20px;
            counter-reset: item;
        }
        .procedure-list li {
            display: flex;
            margin-bottom: 20px;
            line-height: 1.6;
            counter-increment: item;
            position: relative;
        }
        .procedure-list li::before {
            content: counter(item);
            background-color: var(--primary-color);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .procedure-content {
            flex-grow: 1;
        }
        .step-highlight {
            background-color: rgba(0, 150, 136, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
        }
        .submit-btn {
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
            margin-top: 10px;
            border: none;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .signature {
            text-align: right;
            margin-top: 40px;
            font-style: italic;
            color: #666;
        }
        .procedure-diagram {
            width: 100%;
            margin: 20px 0 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <a href="{{ route('pelatihan') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1 class="page-title animate__animated animate__fadeInDown">Prosedur Penelitian</h1>
            <p class="page-subtitle animate__animated animate__fadeInUp">Tahapan pelaksanaan penelitian di RSUD dr. Murjani Sampit</p>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="procedure-card animate__animated animate__fadeIn">
                <h2>Prosedur Pelaksanaan Penelitian</h2>
                
                <ol class="procedure-list">
                    <li>
                        <div class="procedure-content">
                            Calon peneliti mengajukan izin penelitian. Pengajuan penelitian secara online di website RSUD dr. Murjani dengan mengirimkan data dan dokumen softcopy ke:
                            <div class="step-highlight">
                                <a href="https://drive.google.com/drive/folders/1wHfdiPST_V2O0ee3HK-wvAalWk9-bgm6?usp=drive_link" target="_blank" class="submit-btn">
                                    <i class="fas fa-cloud-upload-alt"></i> Upload Dokumen Penelitian
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Dokumen akan di proses dan Direksi akan mendisposisi ke Bagian Diklat;
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Bagian Diklat akan melakukan kajian dan berkoordinasi dengan Unit Kerja terkait penelitian (site penelitian);
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Dokumen tidak lengkap, Bagian Diklat akan menghubungi calon peneliti untuk melengkapi kekurangannya;
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Dokumen lengkap Bagian Diklat akan memproses/membuat kajian dan surat izin penelitian;
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Hasil Kajian dan surat izin penelitian akan di proses / di laporkan ke Direksi.
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Hasil kajian dan surat izin dikembalikan ke Bagian Diklat apabila ada kekurangan atau belum di izinkan. Bagian Diklat akan melakukan kajian dan berkoordinasi dengan Unit Kerja terkait atau menghubingi calon peneliti;
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Hasil kajian dan surat izin disetujui Direksi, Bagian Diklat akan memproses dengan menghubungi Unit Kerja Terkait dan Institusi/Instansi/calon Peneliti;
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Segala biaya yang timbul akan dikomunikasikan dengan calon peneliti dan Unit Kerja terkait;
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Setelah peneliti menerima surat Izin Penelitian dan akan memulai penelitian, maka peniliti menghubungi Bagian Diklat yang akan memberikan ID Card kepada peneliti; dan
                        </div>
                    </li>
                    <li>
                        <div class="procedure-content">
                            Peneliti sudah bisa melakukan penelitian di Unit Kerja RSUD dr. Murjani Kabupaten Kotawaringin Timur.
                        </div>
                    </li>
                </ol>
                
                <div class="signature">
                    Bagian Pendidikan dan Pelatihan<br>
                    RSUD dr. Murjani Sampit
                </div>
            </div>
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 