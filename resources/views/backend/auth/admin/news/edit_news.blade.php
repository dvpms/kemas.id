@extends('backend.layouts.app')

@section('title', __('Berita & Pengumuman'))

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
            Update Berita atau Pengumuman <b>{{ $news->judul }}</b>
        </x-slot>

        <x-slot name="body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.update_news', $news->uuid) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Judul:</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        placeholder="Masukkan judul di sini" value="{{ $news->judul }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="file" class="form-label">Gambar:</label>
                                    <input type="file" name="file" id="file" class="form-control">
                                    <div class="small form-text">*Disarankan upload gambar dengan rasio 1:1 <br> <span
                                            class="text-danger"> *Kosongkan
                                            jika gambar tidak diubah!</span>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="detail" class="form-label">Detail:</label>
                                    <textarea name="detail" id="detail" class="areaDetail form-control" rows="4"
                                        placeholder="Masukkan detail di sini" required>{!! $news->detail !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Berita / Pengumuman</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-backend.card>
    @push('custom-scripts')
    @endpush
@endsection
