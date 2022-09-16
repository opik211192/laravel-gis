@extends('adminlte::page')

@section('title', 'BM Citanduy')

@section('styles')
    
    <style>
        #mapid {
            /* position: relative; */
            height: 550px;  /* or as desired */
            width: 100%;  /* This means "100% of the width of its container", the .col-md-8 */
        }   

    </style>
@endsection

@section('content_header')
@stop

@section('content')
    <div class="">
            <div class="">
                <div id="mapid"></div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@push('scripts')
    <script>

        //-------------------------Layer Map-----------------------------------------//
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

           var map = L.map('mapid', {
             center: [-0.9702091, 117.4225038,5],
             zoom: 5,
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
    </script>
@endpush