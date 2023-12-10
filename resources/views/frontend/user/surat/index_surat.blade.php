@extends('frontend.layouts.app')

@section('title', __('Menu Pembuatan Dokumen'))

@section('content')
    <div id="app" class="flex-center position-ref full-height">
        <div class="container my-5" id="section-menu-surat">
            <div class="row mb-3 align-items-center">
                <div class="col-6 col-md-8 d-flex align-items-center">
                    <h4 class="title-sub mb-0">MENU PENGAJUAN SURAT</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('home.add_surat', ['jenis' => 'surat-ktp']) }}" class="w-100">
                        <div class="card kemas-card mb-3">
                            <div class="row no-gutters">
                                <div class="card-body">
                                    <h5 class="card-title text-bold">Surat Pengantar Pembuatan Kartu Tanda Penduduk (KTP)
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('home.add_surat', ['jenis' => 'surat-domisili']) }}" class="w-100">
                        <div class="card kemas-card mb-3">
                            <div class="row no-gutters">
                                <div class="card-body">
                                    <h5 class="card-title text-bold">Surat Keterangan Domisili</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('home.add_surat', ['jenis' => 'surat-sktm']) }}" class="w-100">
                        <div class="card kemas-card mb-3">
                            <div class="row no-gutters">
                                <div class="card-body">
                                    <h5 class="card-title text-bold">Surat Keterangan Tidak Mampu (SKTM)</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('home.add_surat', ['jenis' => 'surat-nikah']) }}" class="w-100">
                        <div class="card kemas-card mb-3">
                            <div class="row no-gutters">
                                <div class="card-body">
                                    <h5 class="card-title text-bold">Surat Pengantar Nikah</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('home.add_surat', ['jenis' => 'surat-skck']) }}" class="w-100">
                        <div class="card kemas-card mb-3">
                            <div class="row no-gutters">
                                <div class="card-body">
                                    <h5 class="card-title text-bold">Surat Keterangan Catatan Kepolisian (SKCK)</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="w-100">
                        <div class="card kemas-card cooming-soon mb-3">
                            <div class="coming-soon-overlay">
                                <div class="coming-soon-text">FITUR AKAN DATANG</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
