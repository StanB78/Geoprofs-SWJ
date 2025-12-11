<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class FakeUserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Sectoren: 1=Landmeten, 2=Geo-ICT, 3=Drone, 4=Bedrijfsvoering
        $users = [];

        // -------------------------------
        // Landmeten Field Teams (40 fte, 3 managers)
        // -------------------------------
        for ($i = 0; $i < 37; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'rol' => 1, // werknemer
                'leaveToken' => rand(0, 20),
                'sectorID' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // managers
        for ($i = 0; $i < 3; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'rol' => 2, // manager
                'leaveToken' => rand(0, 20),
                'sectorID' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // -------------------------------
        // Geo-ICT & Data (20 fte, 2 managers)
        // -------------------------------
        for ($i = 0; $i < 18; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'rol' => 1,
                'leaveToken' => rand(0, 20),
                'sectorID' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        for ($i = 0; $i < 2; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'rol' => 2,
                'leaveToken' => rand(0, 20),
                'sectorID' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // -------------------------------
        // Drone & Imaging (10 fte, 1 manager)
        // -------------------------------
        for ($i = 0; $i < 9; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'rol' => 1,
                'leaveToken' => rand(0, 20),
                'sectorID' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $users[] = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'rol' => 2, // manager
            'leaveToken' => rand(0, 20),
            'sectorID' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // -------------------------------
        // Bedrijfsvoering (10 fte, 1 manager, 1 admin)
        // -------------------------------
        for ($i = 0; $i < 8; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'rol' => 1,
                'leaveToken' => rand(0, 20),
                'sectorID' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // manager
        $users[] = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'rol' => 2,
            'leaveToken' => rand(0, 20),
            'sectorID' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        // administrator
        $users[] = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'rol' => 3, // administrator
            'leaveToken' => rand(0, 20),
            'sectorID' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ];


        DB::table('users')->insert($users);
    }
}
