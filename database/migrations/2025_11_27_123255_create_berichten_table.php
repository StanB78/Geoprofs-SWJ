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
        Schema::create('berichten', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->integer('verlofID');
            $table->text('sendmessage');
            $table->boolean('gelezen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berichten');
    }
};
