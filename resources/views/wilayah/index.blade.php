@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    @if (session('pesan'))
        <div class="alert alert-success">
            {{ session('pesan') }}
        </div>
    @endif            
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Data Wilayah</div>
                <div class="card-body">
                    <a href="{{ route('wilayah.create') }}" class="btn btn-sm btn-primary mb-2">Tambah Data</a>
                    <table class="table table-bordered table-striped" id="table-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode BM</th>
                                <th>No. Registrasi</th>
                                <th>Nama Pekerjaan</th>
                                <th>X</th>
                                <th>Y</th>
                                <th>Uraian Loaksi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

<script language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script>
        $(document).ready(function(e){
            $('#table-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('wilayah.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'kode_bm', name: 'kode_bm'},
                    {data: 'no_registrasi', name: 'no_registrasi'},
                    {data: 'nama_pekerjaan', name: 'nama_pekerjaan'},
                    {data: 'x', name: 'x'},
                    {data: 'y', name: 'y'},
                    {data: 'uraian_lokasi', name: 'uraian_lokasi'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
</script>



    {{-- <script>
        $(document).ready(function(e){
            $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/user/data',
                dataType : 'json',
                success: function(data){
                    console.log(data);
                    let no = 1;
                    for (let i = 0; i < data.length; i++) {
                        const element = `<p> ${no++} ${data[i].name} ${data[i].email}</p>`;
                        $('#coba').append(element);
                    };
                }
            });
        })
    </script> --}}
@endpush
@endsection
