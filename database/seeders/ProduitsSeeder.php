<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Couleur;

class ProduitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Création des catégories
        $categories = [];
        for ($i = 1; $i <= 5; $i++) {
            $categorie = Categorie::create([
                'nom' => "Catégorie $i"
            ]);
            $categories[] = $categorie;
        }

        // Création des couleurs
        $couleurs = [];
        $couleursNoms = ['Rouge', 'Bleu', 'Vert', 'Jaune', 'Noir'];
        foreach ($couleursNoms as $couleurNom) {
            $couleur = Couleur::create([
                'nom' => $couleurNom
            ]);
            $couleurs[] = $couleur;
        }

        // Création des produits
        for ($i = 1; $i <= 10; $i++) {
            $categorie = $categories[rand(0, 4)]; // Choix aléatoire d'une catégorie
            $produit = Produit::create([
                'nom' => "Produit $i",
                'description' => "Description du produit $i",
                'prix' => rand(10, 100),
                'categorie_id' => $categorie->id
            ]);
            // Attribution de 5 couleurs à chaque produit
            for ($j = 0; $j < 5; $j++) {
                $couleur = $couleurs[$j];
                $produit->couleurs()->attach($couleur->id, ['stock' => rand(0, 20)]);
            }
        }

        echo "Les données ont été ajoutées avec succès.";
        // Création des produits
for ($i = 1; $i <= 10; $i++) {
    $categorie = $categories[rand(0, 4)]; // Choix aléatoire d'une catégorie
    $produit = Produit::create([
        'nom' => "Produit $i",
        'description' => "Description du produit $i",
        'prix' => rand(10, 100),
        'categorie_id' => $categorie->id
    ]);

    // Attacher le produit à la catégorie
    $produit->categories()->attach($categorie->id);
    // Attribution de 5 couleurs à chaque produit
    for ($j = 0; $j < 5; $j++) {
        $couleur = $couleurs[$j];
        $produit->couleurs()->attach($couleur->id, ['stock' => rand(0, 20)]);
    }
}

    }
    
}
