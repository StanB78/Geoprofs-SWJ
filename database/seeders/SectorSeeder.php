<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sectoren')->insert([
            ['naam' => 'Landmeten Field Teams'],
            ['naam' => 'Geo-ICT & Data'],
            ['naam' => 'Drone & Imaging'],
            ['naam' => 'Bedrijfsvoering'],
        ]);
    }
}
