<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreDeStage extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'offres_de_stage';

    // Clé primaire
    protected $primaryKey = 'offre_de_stage_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'titre',
        'description',
        'date_publication',
        'date_fin',
        'departement_id',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Département
     * Une offre de stage appartient à un département
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    /**
     * Relation avec le modèle Stage
     * Une offre de stage a plusieurs stages
     */
    public function stages()
    {
        return $this->hasMany(Stage::class, 'offre_de_stage_id');
    }

    /**
     * Relation avec le modèle Candidature
     * Une offre de stage a plusieurs candidatures
     */
    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'offre_de_stage_id');
    }
}
