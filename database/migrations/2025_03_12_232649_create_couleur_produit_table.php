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
        Schema::create('couleur_produit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('couleur_id');
            $table->unsignedBigInteger('produit_id');
            $table->integer('stock')->default(0);
            $table->foreign('couleur_id')->references('id')->on('couleurs')->onDelete('cascade');
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couleur_produit');
    }
};
