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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim');
            $table->integer('angkatan');
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('fakultas_id')->constrained('fakultas');
            $table->foreignId('prodi_id')->constrained('prodis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
