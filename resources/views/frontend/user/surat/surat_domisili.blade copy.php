<div class="form-container" id="form-surat">
    @php
        $kk = App\Models\Warga::where('uuid', Auth::user()->uuid)->first();
        $kandidats = App\Models\Warga::where('nomorKK', $kk->nomorKK)
            ->where('statusDiKeluarga', '!=', 'Kepala Keluarga')
            ->get();
    @endphp
    <form action="{{ route('home.add_surat', ['jenis' => 'surat-ktp']) }}" method="post">
        @csrf
        <div class="form-group">
            <label>Nomor KK </label>
            <input type="text" name="nomor_ktp_kk" class="form-control" value="{{ $kk->nomorKK }}" disabled>
        </div>
        <div class="form-group">
            <label>Untuk Pemohon</label>
            <select name="pemohon" class="form-control">
                @foreach ($kandidats as $kandidat)
                    <option value="{{ $kandidat->uuid }}"> {{ $kandidat->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tempat dan Tanggal Lahir</label>
            <input type="date" name="ttl" class="form-control">
        </div>
        <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Tujuan Pembuatan Dokumen</label>
            <input type="text" name="tujuan_dokumen" class="form-control">
        </div>
        <div class="form-group">
            <label>Tanggal Pembuatan Surat</label>
            <input type="date" name="tanggal_pembuatan" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<style>
    .form-container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-size: 16px;
        color: #333;
    }

    input[type="text"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        color: #333;
    }

    ::placeholder {
        color: #999;
    }

    .btn-primary {
        width: 100%;
        padding: 10px 0;
        border: none;
        border-radius: 4px;
        background-color: #0056b3;
        color: #fff;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #003d82;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 15px;
        }

        .form-group label {
            font-size: 14px;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            padding: 8px 12px;
            font-size: 14px;
        }

        .btn-primary {
            padding: 8px 0;
            font-size: 16px;
        }
    }
</style>
