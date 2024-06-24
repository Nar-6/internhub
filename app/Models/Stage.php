<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'stages';

    // Clé primaire
    protected $primaryKey = 'stage_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'duree',
        'date_debut',
        'type',
        'date_fin',
        'statut',
        'offre_de_stage_id',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle OffreDeStage
     * Un stage appartient à une offre de stage
     */
    public function offreDeStage()
    {
        return $this->belongsTo(OffreDeStage::class, 'offre_de_stage_id');
    }
}
