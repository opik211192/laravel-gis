<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\UtmZone;
use App\Models\Zone;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        $provinsi = \Indonesia::allProvinces();
        $zones = Zone::all();
        $bands = Band::all();
        $utm_zones = UtmZone::all();
        //dd($provinsi);
        return view('wilayah.index', compact('provinsi', 'zones', 'bands', 'utm_zones'));  
    }

    public function store(Request $request)
    {
       dd($request);
    }
}
