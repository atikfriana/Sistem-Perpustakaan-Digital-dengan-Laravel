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
   Schema::create('loans', function (Blueprint $table) {
    $table->id();
$table->foreignId('user_id')->constrained()->onDelete('cascade');
$table->foreignId('book_id')->constrained()->onDelete('cascade');
$table->date('tanggal_pinjam');
$table->date('tanggal_kembali');
$table->integer('jumlah');
$table->boolean('selesai')->default(false);
$table->timestamps();
});

}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
