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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table des commandes
            $table->decimal('montant', 10, 2); // Montant payé pour la commande
            $table->string('methode_paiement'); // Méthode de paiement utilisée
            $table->string('statut'); // Statut du paiement
            $table->timestamp('date_paiement')->nullable(); // Date et heure de la transaction
            // Ajoutez d'autres champs au besoin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
