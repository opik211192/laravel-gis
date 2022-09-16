<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Zone;
use App\Models\UtmZone;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Laravolt\Indonesia\Models\City;
use Illuminate\Support\Facades\File;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
       if ($request->ajax()) {
           $wilayahs = Wilayah::query()->latest();
           return DataTables::of($wilayahs)
           ->addIndexColumn()
           ->addColumn('action', function($row){

                 return view('wilayah.actionButton', ['id' => $row->id]);
           })
           ->rawColumns(['action'])
           ->make(true);
       }
       return view('wilayah.index');
    }

    public function data()
    {
        $wilayahs = Wilayah::all();
        return response()->json($wilayahs);
    }

    public function create()
    {
        $provinsi = \Indonesia::allProvinces();
        $zones = Zone::all();
        $bands = Band::all();
        $utm_zones = UtmZone::all();
        //dd($provinsi);
        return view('wilayah.create', compact('provinsi', 'zones', 'bands', 'utm_zones'));  
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_bm' => 'required',
            'no_registrasi' => 'required',
            'nama_pekerjaan' => 'required',
            'tgl_pemasangan' => 'required',
            'tgl_pengecekan' => 'required',
            'nama_pekerjaan' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'uraian_lokasi' => 'required',
            'x' => 'required',
            'y' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'band_id' => 'required',
            'zone_id' => 'required',
            'utm_zone_id' => 'required',
            'tinggi_orthometrik' => 'required',
            'tinggi_elipsoid' => 'required',
            'sketsa' => 'required',
            'gambar' => 'required',
        ]);

        $sketsaFile = time().'-'.str_replace(' ','-',$request->sketsa->getClientOriginalName());
        $gambarFile = time().'-'.str_replace(' ', '-', $request->gambar->getClientOriginalName());

        $request->sketsa->move(public_path()."/upload/sketsa",$sketsaFile);
        $request->gambar->move(public_path()."/upload/gambar",$gambarFile);

        $validateData['sketsa'] = $sketsaFile;
        $validateData['gambar'] = $gambarFile;

        Wilayah::create($validateData);

        return redirect()->route('wilayah.index')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function show(Wilayah $wilayah)
    {   
        return view('wilayah.detail', compact('wilayah'));
    }

    public function edit(Wilayah $wilayah)
    {
        $provinsi = \Indonesia::allProvinces();

        $kota1 =  \Indonesia::findCity($wilayah->city_id, $with = null);
        $kota = City::where('province_code', '=', $kota1->province->code)->get();

        $kecamatan1 = \Indonesia::findDistrict($wilayah->district_id, $with = null);
        $kecamatan = District::where('city_code', '=', $kecamatan1->city->code)->get();

        $desa1 = \Indonesia::findVillage($wilayah->village_id, $with = null);
        $desa = Village::where('district_code', '=', $desa1->district->code)->get();
        $zones = Zone::all();
        $bands = Band::all();
        $utm_zones = UtmZone::all();

        return view('wilayah.edit', compact('provinsi', 'zones', 'bands', 'utm_zones', 'wilayah', 'kota', 'kecamatan', 'desa'));
        
    }

    public function update(Request $request, Wilayah $wilayah)
    {
        $validateData = $request->validate([
            'kode_bm' => 'required',
            'no_registrasi' => 'required',
            'nama_pekerjaan' => 'required',
            'tgl_pemasangan' => 'required',
            'tgl_pengecekan' => 'required',
            'nama_pekerjaan' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'uraian_lokasi' => 'required',
            'x' => 'required',
            'y' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'band_id' => 'required',
            'zone_id' => 'required',
            'utm_zone_id' => 'required',
            'tinggi_orthometrik' => 'required',
            'tinggi_elipsoid' => 'required',
            'sketsa' => '',
            'gambar' => '',
        ]);

        //jika ubah sketsa dan gambar
        if($request->hasFile('sketsa') && $request->hasFile('gambar')){
            
            //nama file baru
            $sketsaFile = time().'-'.str_replace(' ','-',$request->sketsa->getClientOriginalName());
            $gambarFile = time().'-'.str_replace(' ', '-', $request->gambar->getClientOriginalName());
            
            //hapus file sebelumnya
            $path_sketsa = public_path()."/upload/sketsa/".$wilayah->sketsa;
            $path_gambar = public_path()."/upload/gambar/".$wilayah->gambar;
            unlink($path_sketsa);
            unlink($path_gambar);

            //upload file baru
            $request->sketsa->move(public_path()."/upload/sketsa",$sketsaFile);
            $request->gambar->move(public_path()."/upload/gambar",$gambarFile);
            
            //simpan nama file
            $validateData['sketsa'] = $sketsaFile;
            $validateData['gambar'] = $gambarFile;

        }
        //jika ubah hanya sketsa
        elseif ($request->hasFile('sketsa')) {

            //nama file baru
            $sketsaFile = time().'-'.str_replace(' ','-',$request->sketsa->getClientOriginalName());

            //hapus file sebelumnya
            $path_sketsa = public_path()."/upload/sketsa/".$wilayah->sketsa;
            unlink($path_sketsa);

            //upload file baru
            $request->sketsa->move(public_path()."/upload/sketsa",$sketsaFile);

            $validateData['sketsa'] = $sketsaFile;
        }
        //jika ubah hanya Gambar
        elseif($request->hasFile('gambar')){
            
            //nama file baru
            $gambarFile = time().'-'.str_replace(' ', '-', $request->gambar->getClientOriginalName());
            
            //hapus file sebelumnya
            $path_gambar = public_path()."/upload/gambar/".$wilayah->gambar;
            unlink($path_gambar);

            //upload file baru
            $request->gambar->move(public_path()."/upload/gambar",$gambarFile);

            $validateData['gambar'] = $gambarFile;
        
        }
        //tidak diubah semuanya
        else{
            $validateData['sketsa'] = $wilayah->sketsa;
            $validateData['gambar'] = $wilayah->gambar;
        }
        
        $wilayah->update($validateData);
        return redirect()->route('wilayah.index')->with('pesan', 'Berhasil diubah');
        
    }

    public function delete(Wilayah $wilayah)
    {
        $wilayah->delete();
        unlink(public_path()."/upload/sketsa/$wilayah->sketsa");
        unlink(public_path()."/upload/gambar/$wilayah->gambar");
        return redirect()->route('wilayah.index')->with('pesan', 'Data berhasil dihapus');
    }

    //untuk ajax
    public function getData(Request $request)
    {
        //keamanan ajax url
        if($request->ajax()){
            $wilayah =  Wilayah::all();
            return response()->json($wilayah);
        }

        return abort(404);
    }
}
