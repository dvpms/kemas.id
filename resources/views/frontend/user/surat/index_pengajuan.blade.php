@extends('frontend.layouts.app')

@section('title', __('List Pengajuan Surat'))

@section('content')

    @push('statis-css')
        <style>
            .item-status {
                margin-bottom: 10px;
            }

            .item-actions {
                display: flex;
                gap: 10px;
            }

            .item-actions a,
            .item-actions button {
                flex: 0 0 auto;
            }
        </style>
    @endpush
    <div id="app" class="flex-center position-ref full-height">
        <div class="container my-5" id="section-menu-surat">
            <div class="row mb-3 align-items-center">
                <div class="col-12 col-md-12 d-flex align-items-center">
                    <h4 class="title-sub mb-0">LIST PENGAJUAN SURAT</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Surat</th>
                                <th>Nomor Tiket</th>
                                <th>Nama</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surats as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td class="text-uppercase"> {{ ucwords(str_replace('-', ' ', $surat->jenis)) }}</td>
                                    <td> <span class="badge badge-secondary text-white"> {{ $surat->uuid_antrian }} </td>
                                    </span>
                                    <td> {{ $surat->nama }} </td>
                                    <td> {{ $surat->tujuan ?: '-' }} </td>
                                    <td> {{ date('d F Y', strtotime($surat->tanggal_buat)) }} </td>
                                    <td>
                                        @if ($surat->ttd == 0)
                                            <div class="item-status">
                                                <span class="badge badge-warning">Menunggu Tanda Tangan</span>
                                            </div>
                                            <div class="item-actions">
                                                <button type="button" class="btn btn-sm btn-danger show_confirm"
                                                    data-id="{{ $surat->id }}"
                                                    data-url="{{ route('home.delete_pengajuan', ['uuid' => $surat->uuid]) }}">
                                                    <span class="fas fa-trash"></span> Hapus / Batalkan
                                                </button>
                                            </div>
                                        @elseif($surat->ttd == 1)
                                            <div class="item-status">
                                                <span class="badge badge-success">Sudah Ditanda Tangan</span>
                                            </div>

                                            <div class="item-actions">
                                                <a href="{{ route('home.generate_surat', ['jenis' => $surat->jenis, 'uuid' => $surat->uuid]) }}"
                                                    id="btnEditNews" class="btn btn-sm btn-primary">
                                                    <span class="fas fa-print btn-icon"></span>
                                                </a>
                                            </div>
                                        @else
                                            <div class="item-status">
                                                <span class="badge badge-danger">Pengajuan Ditolak</span>
                                            </div>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "ordering": false,
                    responsive: true
                });
            });

            $('.show_confirm').click(function(event) {
                var button = $(this);
                var id = button.data('id');
                var url = button.data("url");
                var row = button.closest('tr');
                event.preventDefault();

                swal.fire({
                    title: 'Apakah kamu yakin ingin menghapus data ?',
                    text: "Kamu tidak dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                $('#myTable').DataTable().row(row).remove().draw();
                                swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                            },
                            error: function(response) {
                                swal.fire('Error', 'Something went wrong.', 'error');
                            }
                        });
                    }
                })
            });
        </script>
    @endpush
@endsection
