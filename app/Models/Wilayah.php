<?php

namespace App\Models;

use App\Models\Zone;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wilayah extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function zones()
    {
        return $this->belongsTo(Zone::class, 'zone_id', 'id');
    }

    public function utm_zone()
    {
        return $this->belongsTo(UtmZone::class, 'utm_zone_id', 'id');
    }
}
