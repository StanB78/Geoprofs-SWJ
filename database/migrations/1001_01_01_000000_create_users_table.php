<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Maak eerst users tabel
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('rol')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('leaveToken')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('sectorID')->nullable();
            $table->timestamps();
        });


        Schema::table('users', function (Blueprint $table) {
            $table->foreign('sectorID')
                ->references('id')
                ->on('sectoren')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['sectorID']);
        });
        Schema::dropIfExists('users');
    }
};
