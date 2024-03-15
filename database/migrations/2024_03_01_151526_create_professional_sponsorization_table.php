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
        Schema::create('professional_sponsorization', function (Blueprint $table) {
            $table->unsignedBigInteger('professional_id');
            $table->foreign('professional_id')->references('id')->on('professionals')->cascadeOnDelete();

            $table->unsignedBigInteger('sponsorization_id');
            $table->foreign('sponsorization_id')->references('id')->on('sponsorizations')->cascadeOnDelete();
            
            $table->dateTime('date_end_sponsorization');
            $table->primary(['professional_id', 'sponsorization_id','date_end_sponsorization']);
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_sponsorization');
    }
};
