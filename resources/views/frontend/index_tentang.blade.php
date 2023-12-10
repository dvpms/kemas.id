@extends('frontend.layouts.app')

@section('title', __('Tentang Kami'))

@section('content')
    <div id="app" class="flex-center position-ref full-height">
        <div class="my-5 bg-transparent" id="section-about-us">
            <div class="container">
                <div class="row mb-3 align-items-center">
                    <div class="col-12 text-center">
                        <h4 class="title-sub mb-0 mt-4">TENTANG KAMI</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="my-2" id="section-4">
                        <div class="container">
                            <div class="card kemas-card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('img/Logo-kemas-white.png') }}" alt="Logo Kemas" class="logo">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title text-bold">Apa Itu Kemas.id ?</h5>
                                            <p class="card-text text-justify">Platform digital yang dirancang untuk
                                                meningkatkan
                                                kualitas hidup masyarakat melalui berbagai layanan dan fitur. Aplikasi ini
                                                bertujuan
                                                untuk menjadi jembatan penghubung antara masyarakat dengan berbagai sumber
                                                daya dan
                                                bantuan yang dapat mendukung dan memudahkan pelayanan Masyarakat di
                                                lingkungan RT.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($team_members as $member)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="team-member card h-100">
                                <img src="{{ asset($member['photo']) }}" class="card-img-top" alt="{{ $member['name'] }}">
                                <div class="card-body text-center">
                                    <h5 class="card-title p-1 m-1">{{ $member['name'] }}</h5>
                                    <h6>{{ $member['university'] }}</h6>
                                    <p class="card-text">{{ $member['position'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
