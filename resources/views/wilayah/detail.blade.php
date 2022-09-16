@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detail Wilayah</div>
                <div class="card-body">
                   <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Kode BM</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->kode_bm }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Registrasi</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->no_registrasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pekerjaan</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->nama_pekerjaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pemasangan</td>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y', strtotime($wilayah->tgl_pemasangan)); }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pengecekan</td>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y', strtotime($wilayah->tgl_pengecekan)); }}</td>
                                    </tr>
                                    <tr>
                                        <td>Provinsi</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->province->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kota/Kabupaten</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->city->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->district->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Desa</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->village->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Uraian Lokasi</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->uraian_lokasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Koordinat X</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->x }}</td>
                                    </tr>
                                    <tr>
                                        <td>Koordinat Y</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->y }}</td>
                                    </tr>
                                    <tr>
                                        <td>Latitude</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->latitude }}</td>
                                    </tr>
                                    <tr>
                                        <td>Longitude</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->longitude }}</td>
                                    </tr>
                                    <tr>
                                        <td>Zone</td>
                                        <td></td>
                                        <td>{{ $wilayah->zones->name }} {{ $wilayah->utm_zone->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi Orthometrik</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->tinggi_orthometrik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi Elipsoid</td>
                                        <td>:</td>
                                        <td>{{ $wilayah->tinggi_elipsoid }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            
                            <div style="min-height: 500px" id="mapid"></div>
                        </div>
                   </div>
                   <div class="row mt-3">
                        <div class="col-md-6">
                           <div class="card">
                                <div class="card-header text-center">Sketsa</div>
                                <div class="card-body text-center">
                                    <a data-fslightbox="lightbox" href="{{ asset('upload/sketsa/'.$wilayah->sketsa) }}">
                                        <img style="width: 100px; height: 100px;" src="{{ asset('upload/sketsa/'.$wilayah->sketsa) }}" alt="{{ $wilayah->sketsa }}">
                                    </a>
                                </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header text-center">Gambar</div>
                                <div class="card-body text-center">
                                    <a data-fslightbox href="{{ asset('upload/gambar/'.$wilayah->gambar) }}">
                                        <img style="width: 100px; height:100px;" src="{{ asset('upload/gambar/'.$wilayah->gambar) }}" alt="{{ $wilayah->gambar }}">     
                                    </a>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    {{-- ada plugin show gambar --}}        
    <script src="{{ asset('js/app.js') }}"></script>

    <script>          
        //membuat pilihan peta
            //Open Street Map
            var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                id: 'mapbox.streets',
            });

            //MAP BOX outdoor
            var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token={accessToken}', {
                maxZoom: 18,
                id: 'mapbox.outdoors',
                accessToken: 'pk.eyJ1IjoiaGl0YWRldmVsb3BlciIsImEiOiJjam40N3ljbjQwMXFoM3FtaWFhdmE0ZHU4In0.-k3XXQjWfjWM5fgL-e25sA'
            });

            //google maps
            var peta3 = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            });

            //google maps hybrid
            var peta4 = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            }); 

            //google map satelite
            var peta5 = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            });

            //google map terrain
            var peta6 = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            });

        //menampilkan peta
        var map = L.map('mapid', {
              center: [{{ $wilayah->latitude }}, {{ $wilayah->longitude }}],
              zoom: 9,
              layers: [peta1]
            });

            //menu jenis peta
            var baseLayers = {
              "Open Street Map": peta1,
              "Open street Map Outdor" : peta2,
              "Google Street" : peta3,
              "Google Hybrid" : peta4,
              "Google Satelite" : peta5,
              "Google Terain" : peta6
            };


            var overlays = {
              
            };

            L.control.layers(baseLayers).addTo(map);
            
            //mengambil koordinat
             L.marker([{{ $wilayah->latitude }}, {{ $wilayah->longitude }}]).addTo(map);
    </script>
@endpush
@endsection
