<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'departements';

    // Clé primaire
    protected $primaryKey = 'departement_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'nom_departement',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Employe
     * Un département peut avoir plusieurs employés
     */
    public function employes()
    {
        return $this->hasMany(Employe::class, 'departement_id');
    }

    /**
     * Relation avec le modèle OffreDeStage
     * Un département peut avoir plusieurs offres de stage
     */
    public function offresDeStage()
    {
        return $this->hasMany(OffreDeStage::class, 'departement_id');
    }

    /**
     * Relation avec le modèle Test
     * Un département peut avoir plusieurs tests
     */
    public function tests()
    {
        return $this->hasMany(Test::class, 'departement_id');
    }
}
