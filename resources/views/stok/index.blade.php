@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah Stok</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-1 control-label col-form-label">Filter :</label>

                                <div class="col-3">
                                    <select class="form-control" id="barang_id" name="barang_id">
                                        <option value="">- Semua Barang -</option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Nama Barang</small>
                                </div>

                                <div class="col-3">
                                    <select class="form-control" id="user_id" name="user_id">
                                        <option value="">- Semua User -</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Nama User</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>nama_user</th>
                        <th>stok</th>
                        <th>tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataStok = $('#table_stok').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('stok/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.barang_id = $('#barang_id').val();
                        d.user_id = $('#user_id').val();
                        d.stok_tanggal = $('#stok_tanggal').val();
                    }
                },
                columns: [{
                    // nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "barang.barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "user.nama",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                }, {
                    // mengambil data kategori hasil dari ORM berelasi
                    data: "stok_jumlah",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    // mengambil data kategori hasil dari ORM berelasi
                    data: "stok_tanggal",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });

            $('#barang_id, #user_id').on('change', function() {
                dataStok.ajax.reload();
            });


        });
    </script>
@endpush