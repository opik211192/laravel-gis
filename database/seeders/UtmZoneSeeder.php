<?php

namespace Database\Seeders;

use App\Models\UtmZone;
use Illuminate\Database\Seeder;

class UtmZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UtmZone::create([
            'name' => 'S',
        ]);

        UtmZone::create([
            'name' => 'N',
        ]);
    }
}
