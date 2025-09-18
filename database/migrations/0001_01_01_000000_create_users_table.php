<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('maandag')->nullable();
            $table->string('dinsdag')->nullable();
            $table->string('woensdag')->nullable();
            $table->string('donderdag')->nullable();
            $table->string('vrijdag')->nullable();
            $table->string('zaterdag')->nullable();
            $table->string('zondag')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        // Voeg 5 vaste users toe
        DB::table('users')->insert([
            [
                'name' => 'Gebruiker 1',
                'email' => 'gebruiker1@test.com',
                'password' => Hash::make('gebruiker1'),
                'maandag' => '9,17',
                'dinsdag' => '9,17',
                'woensdag' => '9,17',
                'donderdag' => '9,17',
                'vrijdag' => '9,17',
                'zaterdag' => null,
                'zondag' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gebruiker 2',
                'email' => 'gebruiker2@test.com',
                'password' => Hash::make('gebruiker2'),
                'maandag' => '10,18',
                'dinsdag' => '10,18',
                'woensdag' => '10,18',
                'donderdag' => '10,18',
                'vrijdag' => '10,18',
                'zaterdag' => null,
                'zondag' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gebruiker 3',
                'email' => 'gebruiker3@test.com',
                'password' => Hash::make('gebruiker3'),
                'maandag' => '8,16',
                'dinsdag' => '8,16',
                'woensdag' => '8,16',
                'donderdag' => '8,16',
                'vrijdag' => '8,16',
                'zaterdag' => null,
                'zondag' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gebruiker 4',
                'email' => 'gebruiker4@test.com',
                'password' => Hash::make('gebruiker4'),
                'maandag' => '12,20',
                'dinsdag' => '12,20',
                'woensdag' => '12,20',
                'donderdag' => '12,20',
                'vrijdag' => '12,20',
                'zaterdag' => '12,20',
                'zondag' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gebruiker 5',
                'email' => 'gebruiker5@test.com',
                'password' => Hash::make('gebruiker5'),
                'maandag' => '7,15',
                'dinsdag' => '7,15',
                'woensdag' => '7,15',
                'donderdag' => '7,15',
                'vrijdag' => '7,15',
                'zaterdag' => '7,15',
                'zondag' => '7,15',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
