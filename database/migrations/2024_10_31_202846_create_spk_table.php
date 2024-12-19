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
        Schema::create('spk', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nomor');
            $table->integer('area_id');
            $table->integer('mesin_id');
            $table->date('tanggal');
            $table->string('jam');
            $table->string('shift');
            $table->string('kategori');
            $table->mediumText('permasalahan');
            $table->mediumText('tindakan')->nullable();
            $table->mediumText('pemeriksaan')->nullable();
            $table->mediumText('penyebab')->nullable();
            $table->mediumText('perbaikan')->nullable();
            $table->string('sparepart')->nullable();
            $table->string('jam_sparepart')->nullable();
            $table->mediumText('usulan')->nullable();
            $table->string('jam_mulai')->nullable();
            $table->string('jam_selesai')->nullable();
            $table->string('downtime')->nullable();
            $table->string('diserahkan')->nullable();
            $table->string('diterima')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spk');
    }
};
