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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('no_invoice');
            $table->foreignId('esmdiid_id')->constrained()->onDelete('cascade');
            $table->foreignId('espelanggan_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->longText('barang');
            $table->decimal('total_invoice', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
