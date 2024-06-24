<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'entretiens';

    public $incrementing = true;

    // Clé primaire
    protected $primaryKey = 'entretien_id';

    // Les champs qui peuvent être remplis en masse
    protected $fillable = [
        'date',
        'heure',
        'lien',
        'statut',
        'type',
        'candidature_id',
        'employe_id',
    ];

    // Activer les timestamps
    public $timestamps = true;

    /**
     * Relation avec le modèle Candidature
     * Un entretien est lié à une candidature
     */
    public function candidature()
    {
        return $this->belongsTo(Candidature::class, 'candidature_id');
    }

    /**
     * Relation avec le modèle Employe
     * Un entretien est mené par un employé
     */
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    /**
     * Relation avec le modèle FeedbackEntretien
     * Un entretien peut avoir un feedback
     */
    public function feedback()
    {
        return $this->hasOne(FeedbackEntretien::class, 'entretien_id');
    }
}
