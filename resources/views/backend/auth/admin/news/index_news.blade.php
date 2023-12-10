@extends('backend.layouts.app')

@section('title', __('Berita '))

@section('content')
    @push('statis-css')
        <style>
            .img-thumbnail {
                max-width: 100px;
                height: auto;
            }
        </style>
    @endpush
    <x-backend.card>
        <x-slot name="header">
            @lang('Tambah Berita')
        </x-slot>

        <x-slot name="body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.store_news') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Judul:</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        placeholder="Masukkan judul di sini" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="file" class="form-label">Gambar:</label>
                                    <input type="file" name="file" id="file" class="form-control" required>
                                    <div class="small form-text">*Disarankan upload gambar dengan orientasi landscape
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="detail" class="form-label">Detail:</label>
                                    <textarea name="detail" id="detail" class="areaDetail form-control" rows="4"
                                        placeholder="Masukkan detail di sini" required></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Tambah Berita </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="myTable" class="display text-center">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Image</th>
                                        <th>Judul</th>
                                        <th>Detail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $file)
                                        <tr>
                                            <td> {{ date('d F Y', strtotime($file->created_at)) }}</td>
                                            <td>
                                                <a href="{{ asset($file->gambar) }}" target="_blank">
                                                    <img src="{{ asset($file->gambar) }}" class="img-thumbnail"
                                                        alt="File">
                                                </a>
                                            </td>
                                            <td> {{ $file->judul }} </td>
                                            <td> {!! substr($file->detail, 0, 100) !!}{!! strlen($file->detail) > 100 ? '...' : '' !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit_news', ['id' => $file->uuid]) }}"
                                                    id="btnEditNews" class="btn btn-sm btn-primary"><span
                                                        class="cil-pencil btn-icon mr-2"></span>
                                                    Edit</a>
                                                <button type="button" class="btn btn-sm btn-danger show_confirm"
                                                    data-id="{{ $file->uuid }}" data-name="{{ $file->alt }}"
                                                    data-url="{{ route('admin.destroy_news', ['id' => $file->uuid]) }}">
                                                    <span class="cil-trash btn-icon mr-2"></span>
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </x-slot>
    </x-backend.card>
    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "ordering": false,
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
