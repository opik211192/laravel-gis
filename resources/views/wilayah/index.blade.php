@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action="{{ route('wilayah.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="kode_bm" class="col-md-3 col-form-label">Kode BM</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="kode_bm" id="kode_bm" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_registrasi" class="col-md-3 col-form-label">No. Registrasi</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="no_registrasi" id="no_registrasi" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tgl_pemasangan" class="col-md-3 col-form-label">Tanggal Pemasangan</label>
                            <div class="col-md-5">
                                <input type="date" class="form-control" name="tgl_pemasangan" id="tgl_pemasangan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tgl_pengecekan" class="col-md-3 col-form-label">Tanggal Pengecekan</label>
                            <div class="col-md-5">
                                <input type="date" class="form-control" name="tgl_pengecekan" id="tgl_pengecekan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_pekerjaan" class="col-md-3 col-form-label">Nama Pekerjaan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nama_pekerjaan" id="nama_pekerjaan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="provinsi">Provinsi</label>
                            <div class="col-md-9">
                                <select class="form-control" name="provinsi" id="provinsi" required>
                                    <option>==Pilih Salah Satu==</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="kota">Kabupaten / Kota</label>
                            <div class="col-md-9">
                                <select class="form-control" name="kota" id="kota" required>
                                    <option>==Pilih Salah Satu==</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="kecamatan">Kecamatan</label>
                            <div class="col-md-9">
                                <select class="form-control" name="kecamatan" id="kecamatan" required>
                                    <option>==Pilih Salah Satu==</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="desa">Desa</label>
                            <div class="col-md-9">
                                <select class="form-control" name="desa" id="desa" required>
                                    <option>==Pilih Salah Satu==</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="keterangan" class="col-md-3 col-form-label">Uraian Lokasi</label>
                            <div class="col-md-9">
                                <textarea name="keterangan" rows="3" class="form-control" required=""></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-md-3 col-form-label">UTM</label>
                            <div class="col-md-4">
                                Easting (x): <input class="form-control"  id="x" name="x" required="" onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="col-md-4">
                                Northing (y): <input class="form-control"  id="y" name="y" required="" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="" class="col-md-3 col-form-label">Zone</label>
                            <div class="col-md-2">
                                <select class="form-control" name="zone" id="zone">
                                    <option value="">Pilih</option>
                                    @foreach ($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="utm_zone" id="utm_zone">
                                    <option value="">pilih</option>
                                    @foreach ($utm_zones as $utm_zone)
                                        <option value="{{ $utm_zone->id }}">{{ $utm_zone->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="latitude" class="col-md-3 col-form-label">Latitude</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="latitude" id="latitude">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="longitude" class="col-md-3 col-form-label">Longitude</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="longitude" id="longitude">
                            </div>
                        </div>

                        {{-- disembunyikan --}}
                        <div class="d-none">
                            <div class="row mb-3">
                                <label for="band" class="col-md-3 col-form-label">Band</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="band" id="band">
                                    <option value="3" selected="true">M</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tinggi_orthometrik" class="col-md-3 col-form-label">Tinggi Orthometrik</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="tinggi_orthometrik" name="tinggi_orthometrik" required onkeypress="return isNumberKey(event)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tinggi_elipsoid" class="col-md-3 col-form-label">Tinggi Elipsoid</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="tinggi_elipsoid" name="tinggi_elipsoid" required onkeypress="return isNumberKey(event)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sketsa" class="col-md-3 col-form-label">Sketsa</label>
                            <div class="col-md-9">
                                <input type="file" accept="image/*" class="form-control" name="sketsa" id="sketsa" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gambar" class="col-md-3 col-form-label">Gambar</label>
                            <div class="col-md-9">
                                <input type="file" accept="image/*" class="form-control" name="gambar" id="gambar" required>
                            </div>
                        </div>
                        <button type="submit">Test</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        function onChangeSelect(url, id, name) {
            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                    $.each(data, function (key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function () {
            $('#provinsi').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
            })
        });
    </script>


<script>
    //keyboard tidak bisa ketik karakter koma
    function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
</script>
    @endpush