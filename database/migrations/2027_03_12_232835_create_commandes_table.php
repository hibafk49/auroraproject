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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('users')->onDelete('cascade'); // ID de l'utilisateur/client associé à la commande
            $table->decimal('total', 10, 2); 
            $table->string('nom_client');
            $table->string('telephone_client')->nullable();
            $table->string('ville')->nullable(); // Ajout de la colonne pour la ville
            $table->string('adresse')->nullable(); // Ajout de la colonne pour l'adresse
            $table->text('instructions_speciales')->nullable();
            $table->string('statut')->default('en attente');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
