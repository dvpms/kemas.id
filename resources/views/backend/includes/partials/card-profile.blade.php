<div class=" mb-3">
    <table>
        <tr>
            <th scope="row">Nama</th>
            <th scope="row">:</th>
            <td>{{ $warga->nama ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Alamat</th>
            <th scope="row">:</th>
            <td>{{ $warga->alamat ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Nomor KK</th>
            <th scope="row">:</th>
            <td>{{ $warga->nomorKK ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">NIK</th>
            <th scope="row">:</th>
            <td>{{ $warga->nomorKTP ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Tempat, Tanggal Lahir</th>
            <th scope="row">:</th>
            <td>{{ $warga->tempatLahir ?: '-' }},
                {{ $warga->tanggalLahir ? date('d F Y', strtotime($warga->tanggalLahir)) : '-' }}
            </td>
        </tr>
        <tr>
            <th scope="row">Jenis Kelamin</th>
            <th scope="row">:</th>
            <td>{{ $warga->jenisKelamin ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Status Perkawinan</th>
            <th scope="row">:</th>
            <td>{{ $warga->statusPerkawinan ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Pekerjaan</th>
            <th scope="row">:</th>
            <td>{{ $warga->pekerjaan ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Nomor Telepon</th>
            <th scope="row">:</th>
            <td>{{ $warga->nomorTelepon ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <th scope="row">:</th>
            <td>{{ $warga->email ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Status di Keluarga</th>
            <th scope="row">:</th>
            <td>{{ $warga->statusDiKeluarga ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Golongan Darah</th>
            <th scope="row">:</th>
            <td>{{ $warga->golonganDarah ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Kewarganegaraan</th>
            <th scope="row">:</th>
            <td>{{ $warga->kewarganegaraan ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row">Agama</th>
            <th scope="row">:</th>
            <td>{{ $warga->agama ?: '-' }}</td>
        </tr>
    </table>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        margin-bottom: 20px;
        font-weight: bold;
    }

    table {
        width: 100%;
        table-layout: fixed;
    }

    th,
    td {
        padding: 8px;
    }

    th {
        text-align: left;
        width: 40%;
        color: #6c757d;
        font-weight: bold;
    }

    th:nth-child(2) {
        width: 5%;
        text-align: center;
    }

    td {
        text-align: left;
        background-color: #f8f9fa;
        border-bottom: 1px solid #eaecef;
    }

    td:last-child {
        border-bottom: 0;
    }
</style>
