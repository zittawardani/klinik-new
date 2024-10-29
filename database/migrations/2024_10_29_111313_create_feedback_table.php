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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('nik');
            $table->string('nama_pasien');
            $table->foreignId('id_dokter')->constrained('dokters')->onDelete('cascade'); // Kunci asing untuk dokter
            $table->text('komentar')->nullable(); // Kolom untuk komentar umpan balik
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
