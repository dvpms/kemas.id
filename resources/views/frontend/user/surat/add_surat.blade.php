@extends('frontend.layouts.app')

@section('title', __('Form Pembuatan Dokumen'))

@section('content')
    <div id="app" class="flex-center position-ref full-height">
        <div class="container my-5" id="section-menu-surat">
            <div class="row mb-3 align-items-center">
                <div class="col-6 col-md-8 d-flex align-items-center">
                    <h4 class="title-sub mb-0">FORM PENGAJUAN {{ ucwords(str_replace('-', ' ', $jenis)) }}</h4>
                </div>
                <div class="col-6 col-md-4 d-flex justify-content-end">
                    <a href="{{ route('home.index_surat') }}" class="lihat-semua"><i
                            class="fas fa-chevron-circle-left mr-1"></i>
                        Kembali Ke Menu </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @switch($jenis)
                        @case('surat-ktp')
                            @include('frontend.user.surat.surat_ktp')
                        @break

                        @case('surat-domisili')
                            @include('frontend.user.surat.surat_domisili')
                        @break

                        @case('surat-sktm')
                            @include('frontend.user.surat.surat_sktm')
                        @break

                        @case('surat-nikah')
                            @include('frontend.user.surat.surat_nikah')
                        @break

                        @case('surat-skck')
                            @include('frontend.user.surat.surat_skck')
                        @break

                        @default
                            <p>Form tidak ditemukan.</p>
                    @endswitch
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const flashSuccess = "{{ session('success') }}";
                if (flashSuccess) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: flashSuccess,
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        customClass: {
                            container: 'swal2-no-padding',
                        },
                        didOpen: () => {
                            document.body.classList.remove('swal2-height-auto');
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
