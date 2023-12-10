<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURAT PENGANTAR NIKAH</title>
    <style>
        body {
            padding: 20px;
            line-height: 1.5;
            color: #333;
        }

        .header {
            text-align: center;
            position: relative;
        }

        .header-logo {
            position: absolute;
            width: 160px;
            height: auto;
            top: 0;
            left: 0;
        }

        .header-text h2,
        .header-text h3,
        .header-text h4 {
            margin: 0;
            padding: 0;
        }

        .header-text {
            margin-left: 160px;
        }

        .double-line {
            border: none;
            height: 4px;
            background-image: linear-gradient(to bottom, black 1px, transparent 1px, transparent 3px, grey 3px);
            margin: 10px 0;
        }

        .sub-content {
            text-align: center;
            margin-bottom: 2rem;
        }

        .sub-content h4 {
            padding: 0;
            margin: 0;
        }

        .content h4 {
            position: relative;
            display: inline-block;
            text-decoration: underline
        }

        .content .nomor-surat {
            margin-top: 0;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0;
            text-align: left;
            border: 1px solid transparent;
        }

        .ttd {
            margin-top: 4rem;
            text-align: right;
        }

        .ttd img {
            width: 150px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('img/Logo-Kemas.png') }}" alt="Logo" class="header-logo">
        <div class="header-text">
            <h2>PEMERINTAH KOTA C523-PS009</h2>
            <h3>KETUA RT. 123 RW. 45 DESA DUMMY</h3>
            <h4>KECAMATAN LOREM - KABUPATEN IPSUM</h4>
        </div>
        <hr>
    </div>
    <div class="double-line"></div>
    <div class="content">
        <div class="sub-content">
            <h4>SURAT PENGANTAR NIKAH</h4>
            <p class="nomor-surat">No. {{ $surat->nomor }}</p>
        </div>
        <p>Yang bertanda tangan dibawah ini Ketua RT. 123 RW. 456 Desa Dummy Kecamatan Lorem
            Kabupaten Ipsum dengan ini menerangkan bahwa:</p>
        <table>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ $surat->nama }}</td>
            </tr>
            <tr>
                <td>Tempat, Tgl Lahir</td>
                <td>:</td>
                <td>{{ $surat->tempat_lahir }}, {{ date('d F Y', strtotime($surat->tanggal_lahir)) }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $warga->jenisKelamin }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $warga->agama }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>{{ $warga->statusPerkawinan }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $warga->pekerjaan ?: '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $warga->alamat }}</td>
            </tr>
        </table>
        <p>Yang bersangkutan di atas adalah penduduk asli Desa kami yang saat ini tinggal di RT.123
            RW.45, Desa Dummy, Kecamatan Lorem, Kabupaten Ipsum. Informasi ini diperlukan sebagai bagian dari
            persyaratan pernikahan.</p>
        <p>Demikian surat pengantar ini kami buat, untuk dapat dipergunakan sebagaimana mestinya.</p>

    </div>
    <div class="ttd">
        <p>{{ date('d F Y', strtotime($surat->tanggal_buat)) }}</p>
        <img src="{{ asset('img/ttd.png') }}" alt="Tanda Tangan">
    </div>
</body>

</html>
