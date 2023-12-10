@extends('frontend.layouts.app')

@section('title', __('Berita Terkini'))

@section('content')
    @push('statis-css')
        <style>
            .container {
                padding-top: 20px;
            }

            .custom-card {
                border: none;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .custom-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            }

            .card-header {
                background-color: #002b3a;
                color: #fdb33a;
                padding: 15px 20px;
                font-size: 1.2em;
                font-weight: bold;
                letter-spacing: 1px;
            }

            .fas.fa-chevron-down {
                color: #fdb33a;
                transition: transform 0.5s ease;
            }

            .custom-card[aria-expanded="true"] .fa-chevron-down {
                transform: rotate(180deg);
            }

            .list-group-item {
                border: none;
                transition: background-color 0.3s;
            }

            .list-group-item a {
                color: #002b3a;
                transition: color 0.3s;
            }

            .list-group-item:hover {
                background-color: #fdb33a;
            }

            .list-group-item:hover a {
                color: white;
            }
        </style>
    @endpush
    <div id="app" class="flex-center position-ref full-height">
        <div class="my-5 bg-transparent" id="section-3">
            <div class="container">
                <div class="row mb-3 align-items-center">
                    <div class="col-6 col-md-8 d-flex align-items-center">
                        <h4 class="title-sub mb-0">BERITA TERKINI</h4>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        @foreach ($endpoints as $endpoint)
                            <div class="col-md-4 mb-4">
                                <div class="card custom-card" data-toggle="collapse"
                                    data-target="#collapse{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="collapse{{ $loop->index }}">
                                    <div class="card-header text-uppercase">
                                        {{ $endpoint['name'] }}
                                        <i class="fas fa-chevron-down float-right"></i>
                                    </div>
                                    <div id="collapse{{ $loop->index }}" class="collapse">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($endpoint['paths'] as $path)
                                                <li class="list-group-item">
                                                    <a href="{{ $path['path'] }}">{{ $path['name'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>




                {{-- <div class="row my-5">
                    @if (count($news) > 0)
                        @foreach ($news as $new)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset($new->gambar) }}" class="card-img-top" alt="Gambar Berita">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size: 12pt">{{ $new->judul }}</h5>
                                        <p class="card-text">{{ date('d F Y', strtotime($new->created_at)) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex align-items-center justify-content-center alert alert-secondary mx-auto"
                            role="alert">
                            Tidak ada data berita
                        </div>
                    @endif
                </div>
                {{ $news->links() }} --}}
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('.custom-card').click(function() {
                    var collapseElementId = $(this).data('target');
                    $(collapseElementId).collapse('toggle');
                });

                $('.custom-card .list-group-item a').click(function(e) {
                    e.stopPropagation();
                });
            });
        </script>
    @endpush
@endsection
