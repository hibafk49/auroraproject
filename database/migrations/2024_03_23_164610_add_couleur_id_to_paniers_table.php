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
        Schema::table('paniers', function (Blueprint $table) {
            $table->unsignedBigInteger('couleur_id')->nullable();
            $table->foreign('couleur_id')->references('id')->on('couleurs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paniers', function (Blueprint $table) {
            $table->dropForeign(['couleur_id']); // Supprimer la contrainte de clé étrangère
            $table->dropColumn('couleur_id');
        });
    }
};
