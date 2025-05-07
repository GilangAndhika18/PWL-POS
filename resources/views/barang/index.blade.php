@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ url('/barang/export_pdf') }}" class="btn btn-warning">
                    <i class="fa fa-file-pdf"></i> Export Barang
                </a>
                <a href="{{ url('/barang/export_excel') }}" class="btn btn-primary">
                    <i class="fa fa-file-excel"></i> Export Barang
                </a>
                <button
                onclick="modalAction('{{ url ('/barang/import')}}')" class="btn btn-info">
                Import Barang          
                </button>
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a>
                <button 
                    onclick="modalAction('{{ url('/barang/create_ajax') }}')" 
                    class="btn btn-sm btn-success mt-1">
                    Tambah (Ajax)
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif 

            <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                <thead>
                    <tr><th>ID</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th></tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" 
    data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = ''){
            $('#myModal').load(url,function(){
                $('#myModal').modal('show');
            });
        }

        var dataBarang;
        $(document).ready(function() {
                dataBarang = $('#table_barang').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('barang/list') }}",
                    "type": "POST",
                    data: function(d) {
                        d.kategori_id = $('#kategori_id').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        width: "5%",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "barang_kode",
                        className: "",
                        width: "10%",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "barang_nama",
                        className: "",
                        width: "37%",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "kategori.kategori_nama",
                        className: "",
                        width: "14%",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "harga_beli",
                        className: "text-right",
                        width: "10%",
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: "harga_jual",
                        className: "text-right",
                        width: "10%",
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        width: "14%",
                        orderable: false,
                        searchable: false
                    }
                ]
            });


            $('#kategori_id').on('change', function() {
                dataBarang.ajax.reload();
            });
        });
    </script>
@endpush