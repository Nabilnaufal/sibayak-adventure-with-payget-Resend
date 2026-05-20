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
        Schema::create('bookings', function (Blueprint $table) {

            $table->id();
            $table->string('booking_code')->unique();

            // RELASI
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // DATA SEWA
            $table->date('start_date');
            $table->date('end_date');

            $table->integer('total_price');

            // DATA PENYEWA (snapshot)
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('phone');
            $table->string('ktp_number')->nullable();
            $table->text('address');

            // TAMBAHAN
            $table->text('note')->nullable();

            // STATUS
            $table->enum('status', [
                'pending',
                'aktif',
                'selesai',
                'dibatalkan',
            ])->default('pending');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
