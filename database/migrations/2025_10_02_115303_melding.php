<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meldingen', function (Blueprint $table) {
            $table->id('meldingID');
            $table->integer('userID');
            $table->integer('soort');
            $table->text('melding');
            $table->timestamps();
            $table->boolean('status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meldingen');
    }
};
