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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la commande associée
            $table->decimal('montant_total', 10, 2); // Montant total de la facture
            $table->enum('statut', ['payee', 'en_attente', 'annulee'])->default('en_attente'); // Statut de la facture
            $table->date('date_emission'); // Date d'émission de la facture
            $table->date('date_paiement')->nullable(); // Date de paiement de la facture
            $table->timestamps(); // Champs pour la création et la mise à jour automatiques
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
