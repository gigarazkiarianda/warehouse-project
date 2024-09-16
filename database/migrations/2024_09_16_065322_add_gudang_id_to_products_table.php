<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Tambahkan kolom foreign key
            $table->unsignedBigInteger('gudang_id')->nullable(); // Nullable jika tidak ingin wajib diisi

            // Tambahkan foreign key constraint
            $table->foreign('gudang_id')->references('id')->on('gudangs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropForeign(['gudang_id']);

            // Hapus kolom
            $table->dropColumn('gudang_id');
        });
    }
};
