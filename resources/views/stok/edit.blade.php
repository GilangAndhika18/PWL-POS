@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($stok)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/stok/' . $stok->stok_id) }}" class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label class="col-2 col-form-label">Barang</label>
                        <div class="col-10">
                            <select name="barang_id" class="form-control" required>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->barang_id }}"
                                        {{ old('barang_id', $stok->barang_id) == $item->barang_id ? 'selected' : '' }}>
                                        {{ $item->barang_nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('barang_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-2 col-form-label">User</label>
                        <div class="col-10">
                            <select name="user_id" class="form-control" required>
                                @foreach ($user as $item)
                                    <option value="{{ $item->user_id }}"
                                        {{ old('user_id', $stok->user_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-2 col-form-label">Tanggal Stok</label>
                        <div class="col-10">
                            <input type="date" name="stok_tanggal" class="form-control"
                                value="{{ old('stok_tanggal', $stok->stok_tanggal) }}" required>
                            @error('stok_tanggal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-2 col-form-label">Jumlah</label>
                        <div class="col-10">
                            <input type="number" name="stok_jumlah" class="form-control"
                                value="{{ old('stok_jumlah', $stok->stok_jumlah) }}" min="1" required>
                            @error('stok_jumlah')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10 offset-2">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a href="{{ url('stok') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
