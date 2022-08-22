<?php

namespace Database\Seeders;

use App\Models\Band;
use Illuminate\Database\Seeder;

class BandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Band::create([
            'name' => 'S',
        ]);

        Band::create([
            'name' => 'N',
        ]);

        Band::create([
            'name' => 'M',
        ]);
    }
}
