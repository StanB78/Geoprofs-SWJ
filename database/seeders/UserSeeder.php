<?php


//leegt de database en zet nieuw migration en data er in
// php artisan migrate:fresh --seed

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'user1',
            'email' => 'user@1.com',
            'password' => Hash::make('password'),
            'rol' => 1,
            'leaveToken' => 2,
        ]);
        User::create([
            'name' => 'user2',
            'email' => 'user@2.com',
            'password' => Hash::make('password'),
            'rol' => 2,
            'leaveToken' => 3,
        ]);
        User::create([
            'name' => 'user3',
            'email' => 'user@3.com',
            'password' => Hash::make('password'),
            'rol' => 3,
            'leaveToken' => 5,
        ]);
    }
}
